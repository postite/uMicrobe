<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/ds/HashMap.hx
 */

namespace haxe\ds\_HashMap;

use \php\Boot;
use \php\_NativeArray\NativeArrayIterator;

final class HashMap_Impl_ {
	/**
	 * Creates a new HashMap.
	 * 
	 * @return HashMapData
	 */
	static public function _new () {
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:35: character 16
		$this1 = new HashMapData();
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:35: character 16
		return $this1;
	}


	/**
	 * See `Map.copy`
	 * 
	 * @param HashMapData $this
	 * 
	 * @return HashMapData
	 */
	static public function copy ($this1) {
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:80: characters 3-34
		$copied = new HashMapData();
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:81: characters 3-33
		$copied->keys = $this1->keys->copy();
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:82: characters 3-37
		$copied->values = $this1->values->copy();
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:83: characters 3-21
		return $copied;
	}


	/**
	 * See `Map.exists`
	 * 
	 * @param HashMapData $this
	 * @param mixed $k
	 * 
	 * @return bool
	 */
	static public function exists ($this1, $k) {
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:58: characters 10-42
		$_this = $this1->values;
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:58: characters 10-42
		return array_key_exists($k->hashCode(), $_this->data);
	}


	/**
	 * See `Map.get`
	 * 
	 * @param HashMapData $this
	 * @param mixed $k
	 * 
	 * @return mixed
	 */
	static public function get ($this1, $k) {
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:51: characters 10-39
		$_this = $this1->values;
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:51: characters 10-39
		$key = $k->hashCode();
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:51: characters 10-39
		return ($_this->data[$key] ?? null);
	}


	/**
	 * See `Map.iterator`
	 * 
	 * @param HashMapData $this
	 * 
	 * @return object
	 */
	static public function iterator ($this1) {
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:90: characters 10-32
		return new NativeArrayIterator(array_values($this1->values->data));
	}


	/**
	 * See `Map.keys`
	 * 
	 * @param HashMapData $this
	 * 
	 * @return object
	 */
	static public function keys ($this1) {
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:73: characters 10-30
		return new NativeArrayIterator(array_values($this1->keys->data));
	}


	/**
	 * See `Map.remove`
	 * 
	 * @param HashMapData $this
	 * @param mixed $k
	 * 
	 * @return bool
	 */
	static public function remove ($this1, $k) {
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:65: characters 3-35
		$this1->values->remove($k->hashCode());
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:66: characters 3-40
		return $this1->keys->remove($k->hashCode());
	}


	/**
	 * See `Map.set`
	 * 
	 * @param HashMapData $this
	 * @param mixed $k
	 * @param mixed $v
	 * 
	 * @return void
	 */
	static public function set ($this1, $k, $v) {
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:43: characters 3-33
		$_this = $this1->keys;
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:43: characters 3-33
		$key = $k->hashCode();
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:43: characters 3-33
		$_this->data[$key] = $k;

		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:44: characters 3-35
		$_this1 = $this1->values;
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:44: characters 3-35
		$key1 = $k->hashCode();
		#/usr/local/lib/haxe/std/haxe/ds/HashMap.hx:44: characters 3-35
		$_this1->data[$key1] = $v;

	}
}


Boot::registerClass(HashMap_Impl_::class, 'haxe.ds._HashMap.HashMap_Impl_');
