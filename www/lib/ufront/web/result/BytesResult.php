<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/BytesResult.hx
 */

namespace ufront\web\result;

use \ufront\core\SurpriseTools;
use \ufront\web\context\ActionContext;
use \php\Boot;
use \tink\core\_Future\FutureObject;
use \haxe\io\Bytes;

/**
 * An `ActionResult` that writes `Bytes` (arbitrary binary content) to the client response.
 */
class BytesResult extends FileResult {
	/**
	 * @var Bytes
	 * The bytes of the file to be written to the response
	 */
	public $bytes;


	/**
	 * @param bytes The bytes to write to the response.
	 * @param contentType The content type to specify. If not specified, it will be guessed from `fileDownloadName`, or left blank, in which case the client will guess the type.
	 * @param fileDownloadName The name of the file download. If set, it will force a download dialogue on the client, using the given `fileDownloadName` as the default filename.
	 * 
	 * @param Bytes $bytes
	 * @param string $contentType
	 * @param string $fileDownloadName
	 * 
	 * @return void
	 */
	public function __construct ($bytes = null, $contentType = null, $fileDownloadName = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/BytesResult.hx:20: characters 3-39
		parent::__construct($contentType, $fileDownloadName);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/BytesResult.hx:21: characters 3-21
		$this->bytes = $bytes;
	}


	/**
	 * @param ActionContext $actionContext
	 * 
	 * @return FutureObject
	 */
	public function executeResult ($actionContext) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/BytesResult.hx:25: characters 3-37
		parent::executeResult($actionContext);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/BytesResult.hx:26: characters 3-72
		$actionContext->httpContext->response->writeBytes($this->bytes, 0, $this->bytes->length);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/BytesResult.hx:27: characters 3-33
		return SurpriseTools::success();
	}
}


Boot::registerClass(BytesResult::class, 'ufront.web.result.BytesResult');
