<?php
/**
 * Generated by Haxe 3.4.7
 * Haxe source file: /usr/local/lib/haxe/lib/ufront-mvc/git/src/ufront/cache/DBCache.hx
 */

namespace ufront\cache;

use \php\Boot;

/**
 * A `UFCacheConnection` that works with `DBCache`, using a database table to store cache items.
 */
class DBCacheConnection implements UFCacheConnectionSync, UFCacheConnection {
	/**
	 * @return void
	 */
	public function __construct () {
	}


	/**
	 * @param string $namespace
	 * 
	 * @return DBCache
	 */
	public function getNamespace ($namespace) {
		#/usr/local/lib/haxe/lib/ufront-mvc/git/src/ufront/cache/DBCache.hx:22: characters 2-38
		return $this->getNamespaceSync($namespace);
	}


	/**
	 * @param string $namespace
	 * 
	 * @return DBCache
	 */
	public function getNamespaceSync ($namespace) {
		#/usr/local/lib/haxe/lib/ufront-mvc/git/src/ufront/cache/DBCache.hx:19: characters 2-33
		return new DBCache($namespace);
	}
}


Boot::registerClass(DBCacheConnection::class, 'ufront.cache.DBCacheConnection');