<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/CaseInsensitiveMultiValueMap.hx
 */

namespace ufront\core\_CaseInsensitiveMultiValueMap;

use \haxe\ds\StringMap;
use \php\Boot;
use \ufront\core\_MultiValueMap\MultiValueMap_Impl_;

final class CaseInsensitiveMultiValueMap_Impl_ {
	/**
	 * @return StringMap
	 */
	static public function _new () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/CaseInsensitiveMultiValueMap.hx:13: characters 38-57
		$this1 = new StringMap();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/CaseInsensitiveMultiValueMap.hx:13: character 16
		$this2 = $this1;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/CaseInsensitiveMultiValueMap.hx:13: character 16
		return $this2;
	}


	/**
	 * @param StringMap $this
	 * @param string $name
	 * @param mixed $value
	 * 
	 * @return void
	 */
	static public function add ($this1, $name, $value) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/CaseInsensitiveMultiValueMap.hx:18: characters 53-90
		MultiValueMap_Impl_::add($this1, strtolower($name), $value);
	}


	/**
	 * @param StringMap $this
	 * 
	 * @return StringMap
	 */
	static public function clone ($this1) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/CaseInsensitiveMultiValueMap.hx:20: characters 65-89
		return MultiValueMap_Impl_::clone($this1);
	}


	/**
	 * @param StringMap $this
	 * @param string $name
	 * 
	 * @return bool
	 */
	static public function exists ($this1, $name) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/CaseInsensitiveMultiValueMap.hx:14: characters 54-87
		return array_key_exists(strtolower($name), $this1->data);
	}


	/**
	 * @param StringMap $this
	 * @param string $name
	 * 
	 * @return mixed
	 */
	static public function get ($this1, $name) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/CaseInsensitiveMultiValueMap.hx:16: characters 66-103
		return MultiValueMap_Impl_::get($this1, strtolower($name));
	}


	/**
	 * @param StringMap $this
	 * @param string $name
	 * 
	 * @return \Array_hx
	 */
	static public function getAll ($this1, $name) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/CaseInsensitiveMultiValueMap.hx:15: characters 56-96
		return MultiValueMap_Impl_::getAll($this1, strtolower($name));
	}


	/**
	 * @param StringMap $this
	 * @param string $key
	 * 
	 * @return bool
	 */
	static public function remove ($this1, $key) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/CaseInsensitiveMultiValueMap.hx:19: characters 53-85
		return $this1->remove(strtolower($key));
	}


	/**
	 * @param StringMap $this
	 * @param string $name
	 * @param mixed $value
	 * 
	 * @return void
	 */
	static public function set ($this1, $name, $value) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/CaseInsensitiveMultiValueMap.hx:17: characters 67-104
		MultiValueMap_Impl_::set($this1, strtolower($name), $value);
	}
}


Boot::registerClass(CaseInsensitiveMultiValueMap_Impl_::class, 'ufront.core._CaseInsensitiveMultiValueMap.CaseInsensitiveMultiValueMap_Impl_');