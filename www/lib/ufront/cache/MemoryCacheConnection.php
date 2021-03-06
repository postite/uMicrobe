<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/MemoryCache.hx
 */

namespace ufront\cache;

use \haxe\ds\StringMap;
use \php\Boot;

/**
 * A `UFCacheConnection` that works with `MemoryCache`.
 * You should assign this to a variable that will persist through requests, meaning:
 * - On Neko, assigning it to a static variable: `static var memoryCacheCnx = new MemoryCacheConnection()`.
 * - On NodeJS, assign this to a variable that lives outside of the current request context.
 * - On PHP, this cache will not last longer than the current request.
 */
class MemoryCacheConnection implements UFCacheConnectionSync, UFCacheConnection {
	/**
	 * @var StringMap
	 */
	public $caches;


	/**
	 * @return void
	 */
	public function __construct () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/MemoryCache.hx:20: characters 3-21
		$this->caches = new StringMap();
	}


	/**
	 * @param string $namespace
	 * 
	 * @return MemoryCache
	 */
	public function getNamespace ($namespace) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/MemoryCache.hx:30: characters 3-39
		return $this->getNamespaceSync($namespace);
	}


	/**
	 * @param string $namespace
	 * 
	 * @return MemoryCache
	 */
	public function getNamespaceSync ($namespace) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/MemoryCache.hx:24: lines 24-27
		if (array_key_exists($namespace, $this->caches->data)) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/MemoryCache.hx:25: characters 5-22
			return ($this->caches->data[$namespace] ?? null);
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/MemoryCache.hx:27: characters 5-42
			$this1 = $this->caches;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/MemoryCache.hx:27: characters 5-42
			$v = new MemoryCache();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/MemoryCache.hx:27: characters 5-42
			$this1->data[$namespace] = $v;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/cache/MemoryCache.hx:27: characters 5-42
			return $v;
		}
	}
}


Boot::registerClass(MemoryCacheConnection::class, 'ufront.cache.MemoryCacheConnection');
