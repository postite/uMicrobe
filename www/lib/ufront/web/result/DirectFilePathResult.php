<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/DirectFilePathResult.hx
 */

namespace ufront\web\result;

use \haxe\io\Path;
use \ufront\web\context\ActionContext;
use \php\Boot;
use \php\_Boot\HxException;
use \tink\core\_Future\FutureObject;
use \php\_Boot\HxString;
use \php\_Boot\HxAnon;
use \ufront\web\HttpError;

/**
 * An `ActionResult` that picks the best way to direct a user to download a file.
 * Given a path to a file on the local system, pass onto the client either:
 * - A redirect to the HTTP location of the file, if the file path is inside the `scriptDirectory` (and therefore accessible from the web), or
 * - A FilePathResult, streaming the file's contents to the client.
 */
class DirectFilePathResult extends ActionResult {
	/**
	 * @var string
	 * The path to the file that is to be sent to the client.
	 * If the file is inside the script directory, and therefore visible to the world, the result will be a redirect to the path's direct file.
	 * If the file is outside the script directory, and therefore not directly accessible, the file will be streamed via a FilePathResult.
	 * If this value is null during `executeResult` an exception will be thrown.
	 */
	public $filePath;


	/**
	 * @param string $filePath
	 * 
	 * @return void
	 */
	public function __construct ($filePath = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/DirectFilePathResult.hx:31: characters 3-27
		$this->filePath = $filePath;
	}


	/**
	 * @param ActionContext $actionContext
	 * 
	 * @return FutureObject
	 */
	public function executeResult ($actionContext) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/DirectFilePathResult.hx:35: characters 3-41
		HttpError::throwIfNull($actionContext, null, new HxAnon([
			"fileName" => "ufront/web/result/DirectFilePathResult.hx",
			"lineNumber" => 35,
			"className" => "ufront.web.result.DirectFilePathResult",
			"methodName" => "executeResult",
		]));
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/DirectFilePathResult.hx:37: characters 4-35
		$this->filePath = Path::normalize($this->filePath);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/DirectFilePathResult.hx:38: lines 38-40
		if (!file_exists($this->filePath)) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/DirectFilePathResult.hx:39: characters 5-10
			throw new HxException(HttpError::pageNotFound(new HxAnon([
				"fileName" => "ufront/web/result/DirectFilePathResult.hx",
				"lineNumber" => 39,
				"className" => "ufront.web.result.DirectFilePathResult",
				"methodName" => "executeResult",
			])));
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/DirectFilePathResult.hx:41: characters 4-70
		$scriptDir = $actionContext->httpContext->request->get_scriptDirectory();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/DirectFilePathResult.hx:42: lines 42-50
		if (\StringTools::startsWith($this->filePath, $scriptDir)) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/DirectFilePathResult.hx:43: characters 5-75
			$url = HxString::substr($this->filePath, strlen(Path::removeTrailingSlashes($scriptDir)));
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/DirectFilePathResult.hx:44: characters 5-74
			return (new RedirectResult($url, true))->executeResult($actionContext);
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/DirectFilePathResult.hx:47: characters 5-49
			$result = new FilePathResult($this->filePath);
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/DirectFilePathResult.hx:48: characters 5-67
			$result->setContentTypeByFilename(Path::withoutDirectory($this->filePath));
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/DirectFilePathResult.hx:49: characters 5-49
			return $result->executeResult($actionContext);
		}
	}
}


Boot::registerClass(DirectFilePathResult::class, 'ufront.web.result.DirectFilePathResult');
