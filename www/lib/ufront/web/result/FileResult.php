<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/FileResult.hx
 */

namespace ufront\web\result;

use \haxe\io\Path;
use \ufront\core\SurpriseTools;
use \ufront\web\context\ActionContext;
use \haxe\ds\StringMap;
use \php\Boot;
use \tink\core\_Future\FutureObject;
use \php\_Boot\HxAnon;
use \ufront\web\HttpError;

/**
 * A base `ActionResult` that is used to send binary file content to the client response.
 * This is an abstract class, please see `BytesResult` and `FilePathResult` for implementations you can use.
 */
class FileResult extends ActionResult {
	/**
	 * @var StringMap
	 * A mapping of common file extensions to mime content types.
	 */
	static public $extMap;


	/**
	 * @var string
	 * The content type to use for the response.
	 * If it is not supplied in the constructor, but a filename is supplied, the content type will be set using the mappings in `extMap`.
	 * If it is null, no content-type header will be set, and the client will do its best to guess the type.
	 */
	public $contentType;
	/**
	 * @var string
	 * The file name for the current download.
	 * If this is a non-null value, the client will force the file to display a download window with the specified filename.
	 * This is achieved by setting the HTTP Header `content-disposition: attachment; filename=$fileDownloadName`.
	 */
	public $fileDownloadName;


	/**
	 * @param string $contentType
	 * @param string $fileDownloadName
	 * 
	 * @return void
	 */
	public function __construct ($contentType, $fileDownloadName) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/FileResult.hx:59: characters 3-33
		$this->contentType = $contentType;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/FileResult.hx:60: characters 3-43
		$this->fileDownloadName = $fileDownloadName;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/FileResult.hx:61: lines 61-63
		if (null === $contentType) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/FileResult.hx:62: characters 4-30
			$this->setContentTypeByFilename();
		}
	}


	/**
	 * @param ActionContext $actionContext
	 * 
	 * @return FutureObject
	 */
	public function executeResult ($actionContext) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/FileResult.hx:79: characters 3-58
		HttpError::throwIfNull($actionContext, "actionContext", new HxAnon([
			"fileName" => "ufront/web/result/FileResult.hx",
			"lineNumber" => 79,
			"className" => "ufront.web.result.FileResult",
			"methodName" => "executeResult",
		]));
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/FileResult.hx:81: lines 81-82
		if (null !== $this->contentType) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/FileResult.hx:82: characters 4-64
			$actionContext->httpContext->response->set_contentType($this->contentType);
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/FileResult.hx:84: lines 84-85
		if (null !== $this->fileDownloadName) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/FileResult.hx:85: characters 4-115
			$actionContext->httpContext->response->setHeader("content-disposition", "attachment; filename=" . ($this->fileDownloadName??'null'));
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/FileResult.hx:87: characters 3-33
		return SurpriseTools::success();
	}


	/**
	 * Using the extension of a filename, attempt to use the correct content-type.
	 * If `filename` is not supplied, and fileDownloadName exists, it will be used instead.
	 * 
	 * @param string $filename
	 * 
	 * @return void
	 */
	public function setContentTypeByFilename ($filename = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/FileResult.hx:71: characters 3-52
		if ($filename === null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/FileResult.hx:71: characters 25-52
			$filename = $this->fileDownloadName;
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/FileResult.hx:72: lines 72-75
		if (null !== $filename) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/FileResult.hx:73: characters 4-35
			$ext = Path::extension($filename);
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/FileResult.hx:74: characters 4-55
			if (array_key_exists($ext, FileResult::$extMap->data)) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/FileResult.hx:74: characters 30-55
				$this->contentType = (FileResult::$extMap->data[$ext] ?? null);
			}
		}
	}


	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


$_g = new StringMap();
$_g->data["jpg"] = "image/jpeg";
$_g->data["jpeg"] = "image/jpeg";
$_g->data["png"] = "image/png";
$_g->data["gif"] = "image/gif";
$_g->data["svg"] = "image/svg+xml";
$_g->data["tiff"] = "image/tiff";
$_g->data["zip"] = "application/zip";
$_g->data["atom"] = "application/atom+xml";
$_g->data["json"] = "application/json";
$_g->data["js"] = "application/javascript";
$_g->data["ogg"] = "application/ogg";
$_g->data["pdf"] = "application/pdf";
$_g->data["ps"] = "application/postscript";
$_g->data["rdf"] = "application/rdf";
$_g->data["rss"] = "application/rss";
$_g->data["woff"] = "application/woff";
$_g->data["xml"] = "application/xml";
$_g->data["dtd"] = "application/xml-dtd";
$_g->data["gz"] = "application/gzip";
self::$extMap = $_g;
	}
}


Boot::registerClass(FileResult::class, 'ufront.web.result.FileResult');
FileResult::__hx__init();
