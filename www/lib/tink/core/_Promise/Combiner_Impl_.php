<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx
 */

namespace tink\core\_Promise;

use \php\_Boot\HxClosure;
use \tink\core\Outcome;
use \php\Boot;
use \tink\core\_Future\SyncFuture;
use \tink\core\_Lazy\LazyConst;

final class Combiner_Impl_ {
	/**
	 * @param \Closure $f
	 * 
	 * @return \Closure
	 */
	static public function ofSafe ($f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:220: characters 5-46
		return function ($x1, $x2)  use (&$f) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:220: characters 30-46
			return new SyncFuture(new LazyConst($f($x1, $x2)));
		};
	}


	/**
	 * @param \Closure $f
	 * 
	 * @return \Closure
	 */
	static public function ofSafeSync ($f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:226: characters 5-46
		return function ($x1, $x2)  use (&$f) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:226: characters 30-46
			return Promise_Impl_::ofOutcome(Outcome::Success($f($x1, $x2)));
		};
	}


	/**
	 * @param \Closure $f
	 * 
	 * @return \Closure
	 */
	static public function ofSync ($f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:223: characters 5-46
		return function ($x1, $x2)  use (&$f) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:223: characters 30-46
			$ret = $f($x1, $x2)->map(new HxClosure(Outcome::class, 'Success'));
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:223: characters 30-46
			return $ret->gather();
		};
	}
}


Boot::registerClass(Combiner_Impl_::class, 'tink.core._Promise.Combiner_Impl_');
