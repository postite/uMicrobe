<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/php/NativeArray.hx
 */

namespace php\_NativeArray;

use \php\Boot;

/**
 * Allows iterating over native PHP array with Haxe for-loop
 */
class NativeArrayIterator {
	/**
	 * @var mixed
	 */
	public $arr;
	/**
	 * @var bool
	 */
	public $hasMore;


	/**
	 * @param mixed $a
	 * 
	 * @return void
	 */
	public function __construct ($a) {
		#/usr/local/lib/haxe/std/php/NativeArray.hx:54: characters 3-10
		$this->arr = $a;
		#/usr/local/lib/haxe/std/php/NativeArray.hx:55: characters 3-35
		$this->hasMore = reset($this->arr) !== false;
	}


	/**
	 * @return bool
	 */
	public function hasNext () {
		#/usr/local/lib/haxe/std/php/NativeArray.hx:59: characters 3-17
		return $this->hasMore;
	}


	/**
	 * @return mixed
	 */
	public function next () {
		#/usr/local/lib/haxe/std/php/NativeArray.hx:63: characters 3-30
		$result = current($this->arr);
		#/usr/local/lib/haxe/std/php/NativeArray.hx:64: characters 3-34
		$this->hasMore = next($this->arr) !== false;
		#/usr/local/lib/haxe/std/php/NativeArray.hx:65: characters 3-16
		return $result;
	}
}


Boot::registerClass(NativeArrayIterator::class, 'php._NativeArray.NativeArrayIterator');