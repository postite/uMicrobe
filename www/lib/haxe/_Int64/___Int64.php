<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/Int64.hx
 */

namespace haxe\_Int64;

use \php\Boot;

class ___Int64 {
	/**
	 * @var int
	 */
	public $high;
	/**
	 * @var int
	 */
	public $low;


	/**
	 * @param int $high
	 * @param int $low
	 * 
	 * @return void
	 */
	public function __construct ($high, $low) {
		#/usr/local/lib/haxe/std/haxe/Int64.hx:460: characters 3-19
		$this->high = $high;
		#/usr/local/lib/haxe/std/haxe/Int64.hx:461: characters 3-17
		$this->low = $low;
	}


	/**
	 * We also define toString here to ensure we always get a pretty string
	 * when tracing or calling Std.string. This tends not to happen when
	 * toString is only in the abstract.
	 * 
	 * @return string
	 */
	public function toString () {
		#/usr/local/lib/haxe/std/haxe/Int64.hx:470: characters 3-34
		return Int64_Impl_::toString($this);
	}


	public function __toString() {
		return $this->toString();
	}
}


Boot::registerClass(___Int64::class, 'haxe._Int64.___Int64');
