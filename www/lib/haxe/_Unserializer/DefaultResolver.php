<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/Unserializer.hx
 */

namespace haxe\_Unserializer;

use \php\Boot;

class DefaultResolver {
	/**
	 * @return void
	 */
	public function __construct () {
	}


	/**
	 * @param string $name
	 * 
	 * @return Class
	 */
	final public function resolveClass ($name) {
		#/usr/local/lib/haxe/std/haxe/Unserializer.hx:479: characters 74-104
		return \Type::resolveClass($name);
	}


	/**
	 * @param string $name
	 * 
	 * @return Enum
	 */
	final public function resolveEnum ($name) {
		#/usr/local/lib/haxe/std/haxe/Unserializer.hx:480: characters 72-101
		return \Type::resolveEnum($name);
	}
}


Boot::registerClass(DefaultResolver::class, 'haxe._Unserializer.DefaultResolver');