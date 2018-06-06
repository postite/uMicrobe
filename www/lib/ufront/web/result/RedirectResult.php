<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/RedirectResult.hx
 */

namespace ufront\web\result;

use \ufront\core\SurpriseTools;
use \ufront\web\context\ActionContext;
use \php\Boot;
use \tink\core\_Future\FutureObject;
use \php\_Boot\HxAnon;
use \ufront\web\HttpError;

/**
 * An `ActionResult` that redirects the client to a new location.
 * This works using `HttpResponse.redirect(url)` or `HttpResponse.permanentRedirect(url)`.
 * Virtual links (beginning with `~/`) will be processed using `ActionResult.transformUri()`.
 */
class RedirectResult extends ActionResult {
	/**
	 * @var bool
	 * Indicates whether the redirection should be permanent.
	 */
	public $permanentRedirect;
	/**
	 * @var string
	 * The target URL.
	 */
	public $url;


	/**
	 * A shortcut to create a temporary redirect.
	 * This is useful when you are waiting for a Future: `return getFutureUrl() >> RedirectResult.create;`
	 * 
	 * @param string $url
	 * 
	 * @return RedirectResult
	 */
	static public function create ($url) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/RedirectResult.hx:22: characters 61-100
		return new RedirectResult($url, false);
	}


	/**
	 * A shortcut to create a permanent redirect.
	 * This is useful when you are waiting for a Future: `return getFutureUrl() >> RedirectResult.createPermanent;`
	 * 
	 * @param string $url
	 * 
	 * @return RedirectResult
	 */
	static public function createPermanent ($url) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/RedirectResult.hx:29: characters 70-108
		return new RedirectResult($url, true);
	}


	/**
	 * @param string $url
	 * @param bool $permanentRedirect
	 * 
	 * @return void
	 */
	public function __construct ($url, $permanentRedirect = false) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/RedirectResult.hx:37: lines 37-41
		if ($permanentRedirect === null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/RedirectResult.hx:37: lines 37-41
			$permanentRedirect = false;
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/RedirectResult.hx:38: characters 3-38
		HttpError::throwIfNull($url, "url", new HxAnon([
			"fileName" => "ufront/web/result/RedirectResult.hx",
			"lineNumber" => 38,
			"className" => "ufront.web.result.RedirectResult",
			"methodName" => "new",
		]));
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/RedirectResult.hx:39: characters 3-17
		$this->url = $url;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/RedirectResult.hx:40: characters 3-45
		$this->permanentRedirect = $permanentRedirect;
	}


	/**
	 * @param ActionContext $actionContext
	 * 
	 * @return FutureObject
	 */
	public function executeResult ($actionContext) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/RedirectResult.hx:44: characters 3-58
		HttpError::throwIfNull($actionContext, "actionContext", new HxAnon([
			"fileName" => "ufront/web/result/RedirectResult.hx",
			"lineNumber" => 44,
			"className" => "ufront.web.result.RedirectResult",
			"methodName" => "executeResult",
		]));
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/RedirectResult.hx:47: characters 3-52
		$actionContext->httpContext->response->clearContent();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/RedirectResult.hx:48: characters 3-52
		$actionContext->httpContext->response->clearHeaders();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/RedirectResult.hx:50: characters 3-72
		$transformedUrl = ActionResult::transformUri($actionContext, $this->url);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/RedirectResult.hx:51: lines 51-54
		if ($this->permanentRedirect) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/RedirectResult.hx:52: characters 4-74
			$actionContext->httpContext->response->permanentRedirect($transformedUrl);
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/RedirectResult.hx:54: characters 4-65
			$actionContext->httpContext->response->redirect($transformedUrl);
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/result/RedirectResult.hx:56: characters 3-33
		return SurpriseTools::success();
	}
}


Boot::registerClass(RedirectResult::class, 'ufront.web.result.RedirectResult');
