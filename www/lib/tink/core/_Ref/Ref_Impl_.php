<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Ref.hx
 */

namespace tink\core\_Ref;

use \php\Boot;

final class Ref_Impl_ {


	/**
	 * @return \Array_hx
	 */
	static public function _new () {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Ref.hx:6: characters 32-53
		$this1 = new \Array_hx();
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Ref.hx:6: characters 32-53
		$this1->length = 1;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Ref.hx:6: character 10
		$this2 = $this1;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Ref.hx:6: character 10
		return $this2;
	}


	/**
	 * @param \Array_hx $this
	 * 
	 * @return mixed
	 */
	static public function get_value ($this1) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Ref.hx:8: characters 38-52
		return ($this1->arr[0] ?? null);
	}


	/**
	 * @param \Array_hx $this
	 * @param mixed $param
	 * 
	 * @return mixed
	 */
	static public function set_value ($this1, $param) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Ref.hx:9: characters 38-60
		return $this1[0] = $param;
	}


	/**
	 * @param mixed $v
	 * 
	 * @return \Array_hx
	 */
	static public function to ($v) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Ref.hx:14: characters 15-24
		$this1 = new \Array_hx();
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Ref.hx:14: characters 15-24
		$this1->length = 1;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Ref.hx:14: characters 15-24
		$this2 = $this1;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Ref.hx:14: characters 5-25
		$ret = $this2;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Ref.hx:15: characters 5-18
		$ret[0] = $v;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Ref.hx:16: characters 5-15
		return $ret;
	}


	/**
	 * @param \Array_hx $this
	 * 
	 * @return string
	 */
	static public function toString ($this1) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Ref.hx:11: characters 37-72
		return "@[" . (\Std::string(($this1->arr[0] ?? null))??'null') . "]";
	}
}


Boot::registerClass(Ref_Impl_::class, 'tink.core._Ref.Ref_Impl_');
Boot::registerGetters('tink\\core\\_Ref\\Ref_Impl_', [
	'value' => true
]);
Boot::registerSetters('tink\\core\\_Ref\\Ref_Impl_', [
	'value' => true
]);
