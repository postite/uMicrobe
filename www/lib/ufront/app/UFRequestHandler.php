<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/app/UFRequestHandler.hx
 */

namespace ufront\app;

use \ufront\web\context\HttpContext;
use \php\Boot;
use \tink\core\_Future\FutureObject;
use \php\_Boot\HxAnon;

/**
 * Represents an object that can handle a `HttpRequest`, process as required, and write the `HttpResponse`.
 * The two most common handlers for ufront include `MVCHandler` and `RemotingHandler`.
 * Multiple request handlers can exist in an application.
 * They will be called one at a time (in the order they were added) until one of them successfully handles the request.
 * The first to successfully handle the request should mark `ctx.completion.requestHandler=true` so that other handlers do not also run. See `HttpContext.completion`.
 */
interface UFRequestHandler {
	/**
	 * Handle the current request.
	 * @param ctx The `HttpContext` of the current request, giving you access to the `HttpRequest` to process input and the `HttpResponse` to write output.
	 * @return A `Surprise`, indicating when the request handler has finished, and if it encountered an error.
	 * 
	 * @param HttpContext $ctx
	 * 
	 * @return FutureObject
	 */
	public function handleRequest ($ctx) ;


	/**
	 * The `toString()` method should return the name of the current handler.
	 * This is used for logging / debugging purposes.
	 * 
	 * @return string
	 */
	public function toString () ;
}


Boot::registerClass(UFRequestHandler::class, 'ufront.app.UFRequestHandler');
Boot::registerMeta(UFRequestHandler::class, new HxAnon(["obj" => new HxAnon(["interface" => null])]));
