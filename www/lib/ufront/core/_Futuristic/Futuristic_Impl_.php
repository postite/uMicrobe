<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/Futuristic.hx
 */

namespace ufront\core\_Futuristic;

use \php\Boot;
use \tink\core\_Future\FutureObject;
use \tink\core\_Future\SyncFuture;
use \tink\core\_Lazy\LazyConst;

final class Futuristic_Impl_ {
	/**
	 * @param FutureObject $f
	 * 
	 * @return FutureObject
	 */
	static public function _new ($f) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/Futuristic.hx:26: character 9
		$this1 = $f;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/Futuristic.hx:26: character 9
		return $this1;
	}


	/**
	 * @param FutureObject $this
	 * 
	 * @return FutureObject
	 */
	static public function asFuture ($this1) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/Futuristic.hx:33: characters 3-14
		return $this1;
	}


	/**
	 * @param mixed $v
	 * 
	 * @return FutureObject
	 */
	static public function fromSync ($v) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/Futuristic.hx:30: characters 10-42
		$this1 = new SyncFuture(new LazyConst($v));
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/Futuristic.hx:30: characters 10-42
		return $this1;
	}
}


Boot::registerClass(Futuristic_Impl_::class, 'ufront.core._Futuristic.Futuristic_Impl_');
