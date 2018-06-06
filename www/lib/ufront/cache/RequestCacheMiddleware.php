<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx
 */

namespace ufront\cache;

use \ufront\core\SurpriseTools;
use \ufront\log\MessageType;
use \tink\core\Outcome;
use \ufront\app\UFMiddleware;
use \ufront\web\context\HttpContext;
use \php\Boot;
use \haxe\rtti\Meta;
use \tink\core\_Future\FutureObject;
use \tink\core\_Future\SyncFuture;
use \tink\core\_Future\Future_Impl_;
use \tink\core\Noise;
use \php\_Boot\HxAnon;
use \tink\core\_Lazy\LazyConst;

/**
 * A very simple request caching middleware.
 * At the end of a request, if a the controller / action had the `@cacheRequest` metadata, the response will be cached.
 * At the start of a request, if the URI matches an already matched request, the response from the cache will be used and no further processing is required.
 * Please note this middleware currently does not provide an easy way to expire a cache on certain pages - please be aware of this and handle cache expiration in a way that suits you.
 * @author Jason O'Neil
 */
class RequestCacheMiddleware implements UFMiddleware {
	/**
	 * @var string
	 */
	const namespace = "ufront.middleware.RequestCache";


	/**
	 * @var \Array_hx
	 */
	static public $contentTypesToCache;
	/**
	 * @var string
	 */
	static public $metaName = "cacheRequest";


	/**
	 * @var UFCache
	 */
	public $cache;
	/**
	 * @var UFCacheConnection
	 * The cache system to use.
	 * Will be injected by the `ufront.app.HttpApplication` when the middleware is added.
	 */
	public $cacheConnection;


	/**
	 * @param mixed $meta
	 * 
	 * @return bool
	 */
	static public function hasCacheMeta ($meta) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:140: characters 3-41
		return \Reflect::hasField($meta, RequestCacheMiddleware::$metaName);
	}


	/**
	 * @return void
	 */
	public function __construct () {
	}


	/**
	 * Clear all cached pages.
	 * 
	 * @return FutureObject
	 */
	public function invalidate () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:136: characters 3-23
		return $this->cache->clear();
	}


	/**
	 * See if a cache exists for this URI.
	 * If it does, mirror the cached request and mark the request as complete.
	 * If compiled with `-debug`, it will behave as if there is no cache.
	 * 
	 * @param HttpContext $ctx
	 * 
	 * @return FutureObject
	 */
	public function requestIn ($ctx) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:63: characters 4-34
		return SurpriseTools::success();
	}


	/**
	 * Check if the request was cacheable.  If it was, attempt to cache it.
	 * 
	 * @param HttpContext $ctx
	 * 
	 * @return FutureObject
	 */
	public function responseOut ($ctx) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:103: lines 103-105
		if ($this->cache === null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:104: characters 4-53
			$this->cache = $this->cacheConnection->getNamespace("ufront.middleware.RequestCache");
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:106: lines 106-128
		if ((strtolower($ctx->request->get_httpMethod()) === "get") && ($ctx->actionContext !== null) && ($ctx->actionContext->controller !== null) && ($ctx->actionContext->action !== null)) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:109: lines 109-127
			if (RequestCacheMiddleware::$contentTypesToCache->indexOf($ctx->response->get_contentType()) > -1) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:110: characters 5-51
				$controller = $ctx->actionContext->controller;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:111: characters 5-43
				$cls = \Type::getClass($controller);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:112: characters 5-46
				$controllerMeta = Meta::getType($cls);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:113: characters 5-84
				$fieldMeta = \Reflect::field(Meta::getFields($cls), $ctx->actionContext->action);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:115: lines 115-126
				if (RequestCacheMiddleware::hasCacheMeta($controllerMeta) || RequestCacheMiddleware::hasCacheMeta($fieldMeta)) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:116: characters 6-32
					$uri = $ctx->request->get_uri();
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:117: characters 13-18
					$tmp = $this->cache;
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:117: characters 29-41
					$this1 = new SyncFuture(new LazyConst($ctx->response));
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:117: lines 117-125
					return Future_Impl_::_map($tmp->set($uri, $this1), function ($result)  use (&$uri, &$ctx) {
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:118: lines 118-123
						if ($result->index === 1) {
							#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:119: characters 21-22
							$e = $result->params[0];
							#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:121: characters 9-59
							$msg = "Failed to save cache for " . ($uri??'null') . ": " . (\Std::string($e)??'null');
							#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:121: characters 9-59
							$_this = $ctx->messages;
							#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:121: characters 9-59
							$_this->arr[$_this->length] = new HxAnon([
								"msg" => $msg,
								"pos" => new HxAnon([
									"fileName" => "ufront/cache/RequestCacheMiddleware.hx",
									"lineNumber" => 121,
									"className" => "ufront.cache.RequestCacheMiddleware",
									"methodName" => "responseOut",
								]),
								"type" => MessageType::MError(),
							]);
							#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:121: characters 9-59
							++$_this->length;


						}
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:124: characters 7-30
						return Outcome::Success(Noise::Noise());
					});
				}
			}
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/RequestCacheMiddleware.hx:129: characters 3-33
		return SurpriseTools::success();
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


self::$contentTypesToCache = \Array_hx::wrap([
	"text/plain",
	"text/html",
	"text/xml",
	"text/css",
	"text/csv",
	"application/json",
	"application/javascript",
	"application/atom+xml",
	"application/rdf+xml",
	"application/rss+xml",
	"application/soap+xml",
	"application/xhtml+xml",
	"application/xml",
	"application/xml-dtd",
]);
	}
}


Boot::registerClass(RequestCacheMiddleware::class, 'ufront.cache.RequestCacheMiddleware');
Boot::registerMeta(RequestCacheMiddleware::class, new HxAnon(["obj" => new HxAnon(["rtti" => \Array_hx::wrap([\Array_hx::wrap([
	"cacheConnection",
	"ufront.cache.UFCacheConnection",
	"",
])])])]));
RequestCacheMiddleware::__hx__init();