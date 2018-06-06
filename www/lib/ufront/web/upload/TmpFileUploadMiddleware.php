<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx
 */

namespace ufront\web\upload;

use \haxe\io\Path;
use \ufront\core\SurpriseTools;
use \ufront\log\MessageType;
use \tink\core\Outcome;
use \ufront\app\UFMiddleware;
use \ufront\web\context\HttpContext;
use \php\Boot;
use \tink\core\_Future\FutureObject;
use \ufront\core\Uuid;
use \sys\io\File;
use \ufront\core\_MultiValueMap\MultiValueMap_Impl_;
use \php\_Boot\HxAnon;
use \ufront\web\HttpError;

/**
 * A middleware to take any file uploads, save them to a temporary file, and make them available to the `HttpRequest`.
 * If the `HttpRequest` is multipart, this will parse the multipart data and store any uploads in a temporary file, adding them to `HttpRequest.files`.
 * This middleware will need to be called before `HttpRequest.post` or `HttpRequest.params` are ever accessed.
 * It is probably wise to run this as your very first middleware.
 * The response middleware will delete the temporary file at the end of the request.
 * This is only available on `sys` platforms currently.
 * @author Jason O'Neil
 */
class TmpFileUploadMiddleware implements UFMiddleware {
	/**
	 * @var string
	 * Sub-directory to save temporary uploads to.
	 * This should represent a path, relative to `context.contentDirectory`.
	 * If the chosen `subDir` does not exist, the middleware will attempt to create it during `this.requestIn`.
	 * Default is "uf-upload-tmp"
	 */
	static public $subDir = "uf-upload-tmp";


	/**
	 * @return void
	 */
	public function __construct () {
	}


	/**
	 * If the request is a multipart POST request, use `HttpRequest.parseMultipart()` to save the uploads to temporary files.
	 * 
	 * @param HttpContext $ctx
	 * 
	 * @return FutureObject
	 */
	public function requestIn ($ctx) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:51: lines 51-111
		if ((strtolower($ctx->request->get_httpMethod()) === "post") && $ctx->request->isMultipart()) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:53: lines 53-59
			$file = null;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:53: lines 53-59
			$postName = null;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:53: lines 53-59
			$origFileName = null;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:53: lines 53-59
			$size = 0;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:53: lines 53-59
			$tmpFilePath = null;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:53: lines 53-59
			$dateStr = \DateTools::format(\Date::now(), "%Y%m%d-%H%M");
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:53: lines 53-59
			$dir = ($ctx->get_contentDirectory()??'null') . (Path::addTrailingSlash(TmpFileUploadMiddleware::$subDir)??'null');
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:61: characters 5-62
			$path = Path::removeTrailingSlashes($dir);
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:61: characters 5-62
			if (!is_dir($path)) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:61: characters 5-62
				mkdir($path, 493, true);
			}

			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:63: lines 63-75
			$onPart = function ($pName, $fName)  use (&$size, &$dateStr, &$postName, &$file, &$dir, &$tmpFilePath, &$origFileName) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:65: characters 6-22
				$postName = $pName;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:66: characters 6-26
				$origFileName = $fName;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:67: characters 6-14
				$size = 0;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:68: lines 68-73
				while ($file === null) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:69: characters 7-57
					$tmpFilePath = ($dir??'null') . ($dateStr??'null') . "-" . (Uuid::create()??'null') . ".tmp";
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:70: lines 70-72
					if (!file_exists($tmpFilePath)) {
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:71: characters 8-40
						$file = File::write($tmpFilePath);
					}
				}
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:74: characters 6-36
				return SurpriseTools::success();
			};
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:76: lines 76-81
			$onData = function ($bytes, $pos, $len)  use (&$size, &$file) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:78: characters 6-17
				$size = $size + $len;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:79: characters 6-40
				$file->writeBytes($bytes, $pos, $len);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:80: characters 6-36
				return SurpriseTools::success();
			};
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:82: lines 82-91
			$onEndPart = function ()  use (&$size, &$postName, &$file, &$ctx, &$tmpFilePath, &$origFileName) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:84: lines 84-89
				if ($file !== null) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:85: characters 7-19
					$file->close();
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:86: characters 7-18
					$file = null;
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:87: characters 7-84
					$tmpFile = new TmpFileUpload($tmpFilePath, $postName, $origFileName, $size);
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:88: characters 7-49
					MultiValueMap_Impl_::add($ctx->request->get_files(), $postName, $tmpFile);
				}
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:90: characters 6-36
				return SurpriseTools::success();
			};
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:93: lines 93-98
			$ret = $ctx->request->parseMultipart($onPart, $onData, $onEndPart)->map(function ($result) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:94: lines 94-97
				switch ($result->index) {
					case 0:
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:95: characters 21-22
						$s = $result->params[0];
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:95: characters 25-44
						return Outcome::Success($s);
						break;
					case 1:
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:96: characters 21-22
						$f = $result->params[0];
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:96: characters 25-60
						return Outcome::Failure(HttpError::wrap($f, null, new HxAnon([
							"fileName" => "ufront/web/upload/TmpFileUploadMiddleware.hx",
							"lineNumber" => 96,
							"className" => "ufront.web.upload.TmpFileUploadMiddleware",
							"methodName" => "requestIn",
						])));
						break;
				}
			});
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:93: lines 93-98
			return $ret->gather();
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:111: characters 8-38
			return SurpriseTools::success();
		}
	}


	/**
	 * Delete the temporary file at the end of the request.
	 * 
	 * @param HttpContext $ctx
	 * 
	 * @return FutureObject
	 */
	public function responseOut ($ctx) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:118: lines 118-130
		if ((strtolower($ctx->request->get_httpMethod()) === "post") && $ctx->request->isMultipart()) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:119: characters 15-32
			$f = MultiValueMap_Impl_::iterator($ctx->request->get_files());
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:119: characters 15-32
			while ($f->hasNext()) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:119: lines 119-129
				$f1 = $f->next();
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:120: characters 5-52
				$tmpFile = (($f1 instanceof TmpFileUpload) ? $f1 : null);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:121: lines 121-128
				if ($tmpFile !== null) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:122: characters 13-42
					$_g = $tmpFile->deleteTemporaryFile();
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:122: characters 13-42
					if ($_g->index === 1) {
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:123: characters 21-22
						$e = $_g->params[0];
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:125: characters 8-24
						$_this = $ctx->messages;
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:125: characters 8-24
						$_this->arr[$_this->length] = new HxAnon([
							"msg" => $e,
							"pos" => new HxAnon([
								"fileName" => "ufront/web/upload/TmpFileUploadMiddleware.hx",
								"lineNumber" => 125,
								"className" => "ufront.web.upload.TmpFileUploadMiddleware",
								"methodName" => "responseOut",
							]),
							"type" => MessageType::MError(),
						]);
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:125: characters 8-24
						++$_this->length;

					}
				}
			}
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/TmpFileUploadMiddleware.hx:131: characters 3-33
		return SurpriseTools::success();
	}
}


Boot::registerClass(TmpFileUploadMiddleware::class, 'ufront.web.upload.TmpFileUploadMiddleware');