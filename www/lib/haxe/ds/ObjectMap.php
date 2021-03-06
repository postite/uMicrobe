<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx
 */

namespace haxe\ds;

use \haxe\IMap;
use \php\Boot;
use \php\_NativeArray\NativeArrayIterator;

/**
 * ObjectMap allows mapping of object keys to arbitrary values.
 * On static targets, the keys are considered to be strong references. Refer
 * to `haxe.ds.WeakMap` for a weak reference version.
 * See `Map` for documentation details.
 * @see https://haxe.org/manual/std-Map.html
 */
class ObjectMap implements IMap {
	/**
	 * @var mixed
	 */
	public $_keys;
	/**
	 * @var mixed
	 */
	public $_values;


	/**
	 * Creates a new ObjectMap.
	 * 
	 * @return void
	 */
	public function __construct () {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:33: characters 11-33
		$this1 = [];
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:33: characters 3-33
		$this->_keys = $this1;
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:34: characters 13-35
		$this2 = [];
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:34: characters 3-35
		$this->_values = $this2;
	}


	/**
	 * See `Map.copy`
	 * 
	 * @return ObjectMap
	 */
	public function copy () {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:71: characters 3-32
		$copied = new ObjectMap();
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:72: characters 3-27
		$copied->_values = $this->_values;
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:73: characters 3-23
		$copied->_keys = $this->_keys;
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:74: characters 3-16
		return $copied;
	}


	/**
	 * See `Map.exists`
	 * 
	 * @param mixed $key
	 * 
	 * @return bool
	 */
	public function exists ($key) {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:49: characters 3-71
		return array_key_exists(spl_object_hash($key), $this->_values);
	}


	/**
	 * See `Map.get`
	 * 
	 * @param mixed $key
	 * 
	 * @return mixed
	 */
	public function get ($key) {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:44: characters 3-40
		$id = spl_object_hash($key);
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:45: characters 10-56
		if (isset($this->_values[$id])) {
			#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:45: characters 38-49
			return $this->_values[$id];
		} else {
			#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:45: characters 52-56
			return null;
		}
	}


	/**
	 * See `Map.iterator`
	 * 
	 * @return object
	 */
	public function iterator () {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:67: characters 10-28
		return new NativeArrayIterator($this->_values);
	}


	/**
	 * See `Map.keys`
	 * 
	 * @return object
	 */
	public function keys () {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:63: characters 10-26
		return new NativeArrayIterator($this->_keys);
	}


	/**
	 * See `Map.remove`
	 * 
	 * @param mixed $key
	 * 
	 * @return bool
	 */
	public function remove ($key) {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:53: characters 3-40
		$id = spl_object_hash($key);
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:54: lines 54-59
		if (array_key_exists($id, $this->_values)) {
			#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:55: characters 4-40
			unset($this->_keys[$id], $this->_values[$id]);
			#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:56: characters 4-15
			return true;
		} else {
			#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:58: characters 4-16
			return false;
		}
	}


	/**
	 * See `Map.set`
	 * 
	 * @param mixed $key
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public function set ($key, $value) {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:38: characters 3-40
		$id = spl_object_hash($key);
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:39: characters 3-18
		$this->_keys[$id] = $key;
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:40: characters 3-22
		$this->_values[$id] = $value;
	}


	/**
	 * See `Map.toString`
	 * 
	 * @return string
	 */
	public function toString () {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:78: characters 3-15
		$s = "{";
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:79: characters 3-19
		$it = new NativeArrayIterator($this->_keys);
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:80: characters 13-15
		$i = $it;
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:80: characters 13-15
		while ($i->hasNext()) {
			#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:80: lines 80-86
			$i1 = $i->next();
			#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:81: characters 4-22
			$s = ($s??'null') . (\Std::string($i1)??'null');
			#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:82: characters 4-15
			$s = ($s??'null') . " => ";
			#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:83: characters 4-27
			$s = ($s??'null') . (\Std::string($this->get($i1))??'null');
			#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:84: lines 84-85
			if ($it->hasNext()) {
				#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:85: characters 5-14
				$s = ($s??'null') . ", ";
			}
		}

		#/usr/local/lib/haxe/std/php/_std/haxe/ds/ObjectMap.hx:87: characters 3-17
		return ($s??'null') . "}";
	}


	public function __toString() {
		return $this->toString();
	}
}


Boot::registerClass(ObjectMap::class, 'haxe.ds.ObjectMap');
