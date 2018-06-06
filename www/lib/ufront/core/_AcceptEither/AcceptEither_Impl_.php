<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/AcceptEither.hx
 */

namespace ufront\core\_AcceptEither;

use \php\Boot;
use \haxe\ds\Either;

final class AcceptEither_Impl_ {


	/**
	 * @param Either $e
	 * 
	 * @return Either
	 */
	static public function _new ($e) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/AcceptEither.hx:23: character 9
		$this1 = $e;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/AcceptEither.hx:23: character 9
		return $this1;
	}


	/**
	 * @param mixed $v
	 * 
	 * @return Either
	 */
	static public function fromA ($v) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/AcceptEither.hx:33: characters 68-95
		$this1 = Either::Left($v);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/AcceptEither.hx:33: characters 68-95
		return $this1;
	}


	/**
	 * @param mixed $v
	 * 
	 * @return Either
	 */
	static public function fromB ($v) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/AcceptEither.hx:34: characters 68-96
		$this1 = Either::Right($v);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/AcceptEither.hx:34: characters 68-96
		return $this1;
	}


	/**
	 * @param Either $this
	 * 
	 * @return Either
	 */
	static public function get_type ($this1) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/AcceptEither.hx:32: characters 34-45
		return $this1;
	}


	/**
	 * @param Either $this
	 * 
	 * @return mixed
	 */
	static public function get_value ($this1) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/AcceptEither.hx:31: characters 37-80
		switch ($this1->index) {
			case 0:
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/AcceptEither.hx:31: characters 61-62
				$v = $this1->params[0];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/AcceptEither.hx:31: characters 76-77
				return $v;
				break;
			case 1:
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/AcceptEither.hx:31: characters 72-73
				$v1 = $this1->params[0];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/AcceptEither.hx:31: characters 76-77
				return $v1;
				break;
		}
	}
}


Boot::registerClass(AcceptEither_Impl_::class, 'ufront.core._AcceptEither.AcceptEither_Impl_');
Boot::registerGetters('ufront\\core\\_AcceptEither\\AcceptEither_Impl_', [
	'type' => true,
	'value' => true
]);
