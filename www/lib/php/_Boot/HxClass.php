<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/php/Boot.hx
 */

namespace php\_Boot;

use \php\Boot;

/**
 * Class<T> implementation for Haxe->PHP internals.
 */
class HxClass {
	/**
	 * @var string
	 */
	public $phpClassName;


	/**
	 * @param string $phpClassName
	 * 
	 * @return void
	 */
	public function __construct ($phpClassName) {
		#/usr/local/lib/haxe/std/php/Boot.hx:541: characters 3-35
		$this->phpClassName = $phpClassName;
	}


	/**
	 * Magic method to call static methods of this class, when `HxClass` instance is in a `Dynamic` variable.
	 * 
	 * @param string $method
	 * @param mixed $args
	 * 
	 * @return mixed
	 */
	public function __call ($method, $args) {
		#/usr/local/lib/haxe/std/php/Boot.hx:549: characters 3-115
		$callback = ((($this->phpClassName === "String" ? Boot::getClass(HxString::class)->phpClassName : $this->phpClassName))??'null') . "::" . ($method??'null');
		#/usr/local/lib/haxe/std/php/Boot.hx:550: characters 3-53
		return call_user_func_array($callback, $args);
	}


	/**
	 * Magic method to get static vars of this class, when `HxClass` instance is in a `Dynamic` variable.
	 * 
	 * @param string $property
	 * 
	 * @return mixed
	 */
	public function __get ($property) {
		#/usr/local/lib/haxe/std/php/Boot.hx:558: lines 558-566
		if (defined("" . ($this->phpClassName??'null') . "::" . ($property??'null'))) {
			#/usr/local/lib/haxe/std/php/Boot.hx:559: characters 4-54
			return constant("" . ($this->phpClassName??'null') . "::" . ($property??'null'));
		} else if (Boot::hasGetter($this->phpClassName, $property)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:561: characters 29-41
			$tmp = $this->phpClassName;
			#/usr/local/lib/haxe/std/php/Boot.hx:561: characters 44-57
			$tmp1 = "get_" . ($property??'null');
			#/usr/local/lib/haxe/std/php/Boot.hx:561: characters 4-59
			return $tmp::{$tmp1}();
		} else if (method_exists($this->phpClassName, $property)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:563: characters 4-48
			return new HxClosure($this->phpClassName, $property);
		} else {
			#/usr/local/lib/haxe/std/php/Boot.hx:565: characters 33-45
			$tmp2 = $this->phpClassName;
			#/usr/local/lib/haxe/std/php/Boot.hx:565: characters 47-55
			$tmp3 = $property;
			#/usr/local/lib/haxe/std/php/Boot.hx:565: characters 4-56
			return $tmp2::${$tmp3};
		}
	}


	/**
	 * Magic method to set static vars of this class, when `HxClass` instance is in a `Dynamic` variable.
	 * 
	 * @param string $property
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public function __set ($property, $value) {
		#/usr/local/lib/haxe/std/php/Boot.hx:574: lines 574-578
		if (Boot::hasSetter($this->phpClassName, $property)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:575: characters 22-34
			$tmp = $this->phpClassName;
			#/usr/local/lib/haxe/std/php/Boot.hx:575: characters 37-50
			$tmp1 = "set_" . ($property??'null');
			#/usr/local/lib/haxe/std/php/Boot.hx:575: characters 4-59
			$tmp::{$tmp1}($value);
		} else {
			#/usr/local/lib/haxe/std/php/Boot.hx:577: characters 26-38
			$tmp2 = $this->phpClassName;
			#/usr/local/lib/haxe/std/php/Boot.hx:577: characters 40-48
			$tmp3 = $property;
			#/usr/local/lib/haxe/std/php/Boot.hx:577: characters 4-56
			$tmp2::${$tmp3} = $value;
		}
	}
}


Boot::registerClass(HxClass::class, 'php._Boot.HxClass');
