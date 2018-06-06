<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/app/UFMiddleware.hx
 */

namespace ufront\app;

use \ufront\web\context\HttpContext;
use \php\Boot;
use \tink\core\_Future\FutureObject;
use \php\_Boot\HxAnon;

/**
 * Middleware that runs after the request has been processed.
 * #### Examples:
 * - Modify or append the response.
 * - Cache the response for fututre requests.
 * - Save data from the request for analytics.
 * - Write session data from the request to the disk.
 * #### Details:
 * This middleware has full access to the `HttpContext` of the current request, so can modify the request details or write to the response.
 * You can modify the values of `ctx.completion` to skip remaining response middleware, the logging or flushing stages of the request. See `HttpContext.requestCompletion`.
 */
interface UFResponseMiddleware {
	/**
	 * Perform an action on the current request.
	 * @param ctx The current `HttpContext`, allowing you to read `HttpRequest` details, or write to the `HttpResponse`.
	 * @return A `Surprise` indicating the middleware has completed and the request may continue. If a `Failure` is returned the `UFErrorHandler` modules will be run.
	 * 
	 * @param HttpContext $ctx
	 * 
	 * @return FutureObject
	 */
	public function responseOut ($ctx) ;
}


Boot::registerClass(UFResponseMiddleware::class, 'ufront.app.UFResponseMiddleware');
Boot::registerMeta(UFResponseMiddleware::class, new HxAnon(["obj" => new HxAnon(["interface" => null])]));