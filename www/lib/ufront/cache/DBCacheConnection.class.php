<?php

// Generated by Haxe 3.4.7
class ufront_cache_DBCacheConnection implements ufront_cache_UFCacheConnectionSync, ufront_cache_UFCacheConnection{
	public function __construct() { if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("ufront.cache.DBCacheConnection::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}}
	public function getNamespaceSync($namespace) {
		$GLOBALS['%s']->push("ufront.cache.DBCacheConnection::getNamespaceSync");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new ufront_cache_DBCache($namespace);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function getNamespace($namespace) {
		$GLOBALS['%s']->push("ufront.cache.DBCacheConnection::getNamespace");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->getNamespaceSync($namespace);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'ufront.cache.DBCacheConnection'; }
}
