<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx
 */

namespace tink\core\_Outcome;

use \tink\core\Outcome;
use \php\Boot;
use \haxe\ds\Either;
use \php\_Boot\HxAnon;

final class OutcomeMapper_Impl_ {
	/**
	 * @param \Closure $f
	 * 
	 * @return object
	 */
	static public function _new ($f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:150: character 3
		$this1 = new HxAnon(["f" => $f]);
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:150: character 3
		return $this1;
	}


	/**
	 * @param object $this
	 * @param Outcome $o
	 * 
	 * @return Outcome
	 */
	static public function apply ($this1, $o) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:152: characters 5-21
		return $this1->f($o);
	}


	/**
	 * @param \Closure $f
	 * 
	 * @return object
	 */
	static public function withEitherError ($f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:164: lines 164-173
		return OutcomeMapper_Impl_::_new(function ($o)  use (&$f) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:165: lines 165-172
			switch ($o->index) {
				case 0:
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:166: characters 22-23
					$d = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:167: characters 18-22
					$_g = $f($d);
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:167: characters 18-22
					switch ($_g->index) {
						case 0:
							#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:168: characters 26-27
							$d1 = $_g->params[0];
							#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:168: characters 30-40
							return Outcome::Success($d1);
							break;
						case 1:
							#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:169: characters 26-27
							$f1 = $_g->params[0];
							#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:169: characters 30-47
							return Outcome::Failure(Either::Right($f1));
							break;
					}
					break;
				case 1:
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:171: characters 22-23
					$f2 = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:171: characters 26-42
					return Outcome::Failure(Either::Left($f2));
					break;
			}
		});
	}


	/**
	 * @param \Closure $f
	 * 
	 * @return object
	 */
	static public function withSameError ($f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:155: lines 155-160
		return OutcomeMapper_Impl_::_new(function ($o)  use (&$f) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:156: lines 156-159
			switch ($o->index) {
				case 0:
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:157: characters 22-23
					$d = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:157: characters 26-30
					return $f($d);
					break;
				case 1:
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:158: characters 22-23
					$f1 = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Outcome.hx:158: characters 26-36
					return Outcome::Failure($f1);
					break;
			}
		});
	}
}


Boot::registerClass(OutcomeMapper_Impl_::class, 'tink.core._Outcome.OutcomeMapper_Impl_');