<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Named.hx
 */

namespace tink\core;

use \php\Boot;

class NamedWith {
	/**
	 * @var mixed
	 */
	public $name;
	/**
	 * @var mixed
	 */
	public $value;


	/**
	 * @param mixed $name
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public function __construct ($name, $value) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Named.hx:11: characters 5-21
		$this->name = $name;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Named.hx:12: characters 5-23
		$this->value = $value;
	}
}


Boot::registerClass(NamedWith::class, 'tink.core.NamedWith');
