<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx
 */

namespace ufront\core\_MultiValueMap;

use \haxe\ds\StringMap;
use \php\Boot;
use \php\_NativeArray\NativeArrayIterator;
use \php\_Boot\HxString;

final class MultiValueMap_Impl_ {
	/**
	 * Create a new MultiValueMap
	 * 
	 * @return StringMap
	 */
	static public function _new () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:18: character 16
		$this1 = new StringMap();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:18: character 16
		return $this1;
	}


	/**
	 * Add a value to our MultiValueMap.
	 * If the value already exists, this value will be added after it.
	 * If the value is null, this will have no effect.
	 * If `name` is null, the result is unspecified.
	 * If the name ends with "[]", the "[]" will be stripped from the name before setting the value.
	 * Names such as this are required for PHP to have multiple values with the same name.
	 * 
	 * @param StringMap $this
	 * @param string $name
	 * @param mixed $value
	 * 
	 * @return void
	 */
	static public function add ($this1, $name, $value) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:117: lines 117-123
		if ($value !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:118: characters 26-52
			$name = ($name !== null ? (\StringTools::endsWith($name, "[]") ? HxString::substr($name, 0, strlen($name) - 2) : $name) : "");
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:119: lines 119-122
			if (array_key_exists($name, $this1->data)) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:120: characters 5-35
				$_this = ($this1->data[$name] ?? null);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:120: characters 5-35
				$_this->arr[$_this->length] = $value;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:120: characters 5-35
				++$_this->length;
			} else {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:122: characters 5-30
				$this1->data[$name] = \Array_hx::wrap([$value]);
			}
		}
	}


	/**
	 * Return an array containing the values of each parameter in this MultiValueMap.
	 * If multiple parameters have the same name, all values will be included.
	 * 
	 * @param StringMap $this
	 * 
	 * @return \Array_hx
	 */
	static public function allValues ($this1) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:49: characters 10-48
		$_g = new \Array_hx();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:49: characters 24-28
		$arr = new NativeArrayIterator($this1->data);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:49: characters 24-28
		while ($arr->hasNext()) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:49: characters 12-46
			$arr1 = $arr->next();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:49: characters 30-46
			$_g1 = 0;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:49: characters 30-46
			while ($_g1 < $arr1->length) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:49: characters 35-36
				$v = ($arr1->arr[$_g1] ?? null);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:49: characters 30-46
				$_g1 = $_g1 + 1;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:49: characters 45-46
				$_g->arr[$_g->length] = $v;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:49: characters 45-46
				++$_g->length;

			}
		}

		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:49: characters 10-48
		return $_g;
	}


	/**
	 * Create a clone of the current MultiValueMap.
	 * The clone is a shallow copy - the values point to the same objects in memory as the original map values.
	 * However the array for storing multiple values is a new array, meaning adding a new value on the cloned array will not cause the new value to appear on the original array.
	 * 
	 * @param StringMap $this
	 * 
	 * @return StringMap
	 */
	static public function clone ($this1) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:141: characters 16-35
		$this2 = new StringMap();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:141: characters 3-36
		$newMap = $this2;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:142: characters 14-25
		$k = new NativeArrayIterator(array_map("strval", array_keys($this1->data)));
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:142: characters 14-25
		while ($k->hasNext()) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:142: lines 142-146
			$k1 = $k->next();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:143: lines 143-145
			$_g = 0;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:143: lines 143-145
			$_g1 = ($this1->data[$k1] ?? null);
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:143: lines 143-145
			while ($_g < $_g1->length) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:143: characters 9-10
				$v = ($_g1->arr[$_g] ?? null);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:143: lines 143-145
				$_g = $_g + 1;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:144: characters 5-23
				MultiValueMap_Impl_::add($newMap, $k1, $v);
			}
		}

		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:147: characters 3-16
		return $newMap;
	}


	/**
	 * Combine multiple `MultiValueMap`s into a single map.
	 * 
	 * @param \Array_hx $maps
	 * 
	 * @return StringMap
	 */
	static public function combine ($maps) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:217: characters 12-31
		$this1 = new StringMap();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:217: characters 3-32
		$qm = $this1;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:218: lines 218-224
		$_g = 0;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:218: lines 218-224
		while ($_g < $maps->length) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:218: characters 9-12
			$map = ($maps->arr[$_g] ?? null);
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:218: lines 218-224
			$_g = $_g + 1;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:219: characters 17-27
			$key = new NativeArrayIterator(array_map("strval", array_keys($map->data)));
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:219: characters 17-27
			while ($key->hasNext()) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:219: lines 219-223
				$key1 = $key->next();
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:220: lines 220-222
				$_g1 = 0;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:220: lines 220-222
				$_g2 = MultiValueMap_Impl_::getAll($map, $key1);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:220: lines 220-222
				while ($_g1 < $_g2->length) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:220: characters 10-13
					$val = ($_g2->arr[$_g1] ?? null);
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:220: lines 220-222
					$_g1 = $_g1 + 1;
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:221: characters 6-24
					MultiValueMap_Impl_::add($qm, $key1, $val);
				}
			}

		}

		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:225: characters 3-12
		return $qm;
	}


	/**
	 * Check if a parameter with the given name exists.
	 * If the `name` is null, the result is unspecified.
	 * 
	 * @param StringMap $this
	 * @param string $name
	 * 
	 * @return bool
	 */
	static public function exists ($this1, $name) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:32: characters 47-73
		return array_key_exists($name, $this1->data);
	}


	/**
	 * Convert a `Map<String,T>` into a `MultiValueMap`
	 * If `map` is null, this will return an empty `MultiValueMap`
	 * 
	 * @param StringMap $map
	 * 
	 * @return StringMap
	 */
	static public function fromMap ($map) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:211: characters 88-115
		return MultiValueMap_Impl_::fromStringMap($map);
	}


	/**
	 * Implicit cast from `Map<String,Array<T>>`
	 * 
	 * @param StringMap $map
	 * 
	 * @return StringMap
	 */
	static public function fromMapOfArrays ($map) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:180: characters 3-18
		return $map;
	}


	/**
	 * Convert a `StringMap<T>` into a `MultiValueMap`
	 * If `stringMap` is null, this will return an empty `MultiValueMap`.
	 * 
	 * @param StringMap $stringMap
	 * 
	 * @return StringMap
	 */
	static public function fromStringMap ($stringMap) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:199: characters 12-31
		$this1 = new StringMap();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:199: characters 3-32
		$qm = $this1;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:200: lines 200-202
		if ($stringMap !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:200: characters 39-55
			$key = new NativeArrayIterator(array_map("strval", array_keys($stringMap->data)));
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:200: characters 39-55
			while ($key->hasNext()) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:200: lines 200-202
				$key1 = $key->next();
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:201: characters 4-37
				MultiValueMap_Impl_::set($qm, $key1, ($stringMap->data[$key1] ?? null));
			}
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:203: characters 3-12
		return $qm;
	}


	/**
	 * Get the value for a parameter with this name.
	 * If this name has more than one parameter, the final value (in the order they were set) will be used.
	 * If there is no parameter with this name, it returns null.
	 * If `name` is null, the result is unspecified.
	 * Array access is provided on this method: `trace ( myMultiValueMap['emailAddress'] )`
	 * 
	 * @param StringMap $this
	 * @param string $name
	 * 
	 * @return mixed
	 */
	static public function get ($this1, $name) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:62: lines 62-66
		if (array_key_exists($name, $this1->data)) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:63: characters 4-31
			$arr = ($this1->data[$name] ?? null);
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:64: characters 4-30
			return ($arr->arr[$arr->length - 1] ?? null);
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:66: characters 8-19
			return null;
		}
	}


	/**
	 * Get an array of values for the given parameter name.
	 * Multiple values will be returned in the order they were set.
	 * If there is only a single value, the array will have a length of `1`.
	 * If there is no parameter with this name, the array will have a length of `0`.
	 * If `name` is null, the result is unspecified.
	 * Please note the array returned is the array used internally, so modifying the contents of the array will also modify the contents of the MultiValueMap.
	 * If the field name in your HTML input ended with "[]", you do not include that here.
	 * For example, the values of `<input name='phone[]' /><input name='phone[]' />` should be accessed with `MultiValueMap.getAll('phone')`.
	 * 
	 * @param StringMap $this
	 * @param string $name
	 * 
	 * @return \Array_hx
	 */
	static public function getAll ($this1, $name) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:83: lines 83-84
		if (array_key_exists($name, $this1->data)) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:83: characters 28-51
			return ($this1->data[$name] ?? null);
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:84: characters 8-17
			return new \Array_hx();
		}
	}


	/**
	 * Return an iterator containing the values of each parameter in this MultiValueMap.
	 * If multiple parameters have the same name, all values will be included.
	 * 
	 * @param StringMap $this
	 * 
	 * @return object
	 */
	static public function iterator ($this1) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:40: characters 3-32
		return MultiValueMap_Impl_::allValues($this1)->iterator();
	}


	/**
	 * Return an iterator containing the names of all parameters in this MultiValueMap
	 * 
	 * @param StringMap $this
	 * 
	 * @return object
	 */
	static public function keys ($this1) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:25: characters 32-50
		return new NativeArrayIterator(array_map("strval", array_keys($this1->data)));
	}


	/**
	 * Remove all values for a given key
	 * If the `key` is null, the result is unspecified.
	 * 
	 * @param StringMap $this
	 * @param string $key
	 * 
	 * @return bool
	 */
	static public function remove ($this1, $key) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:131: characters 46-71
		return $this1->remove($key);
	}


	/**
	 * Set a value in our MultiValueMap.
	 * If one or more parameters already existed for this name, they will be replaced.
	 * If the value is null, this method will have no effect.
	 * If name is null, the result is unspecified.
	 * If the name ends with "[]", the "[]" will be stripped from the name before setting the value.
	 * Names such as this are required for PHP to have multiple values with the same name.
	 * Array access is provided on this method: `trace ( myMultiValueMap['emailAddress'] = 'jason@ufront.net'; )`
	 * 
	 * @param StringMap $this
	 * @param string $name
	 * @param mixed $value
	 * 
	 * @return void
	 */
	static public function set ($this1, $name, $value) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:100: lines 100-103
		if ($value !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:101: characters 11-37
			$name = (\StringTools::endsWith($name, "[]") ? HxString::substr($name, 0, strlen($name) - 2) : $name);
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:102: characters 4-29
			$this1->data[$name] = \Array_hx::wrap([$value]);
		}
	}


	/**
	 * @param StringMap $this
	 * @param string $name
	 * 
	 * @return string
	 */
	static public function stripArrayFromName ($this1, $name) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:168: characters 10-67
		if (\StringTools::endsWith($name, "[]")) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:168: characters 32-60
			return HxString::substr($name, 0, strlen($name) - 2);
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:168: characters 63-67
			return $name;
		}
	}


	/**
	 * Convert a `MultiValueMap` into a `Map<String,T>`
	 * 
	 * @param StringMap $this
	 * 
	 * @return StringMap
	 */
	static public function toMap ($this1) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:191: characters 52-72
		return MultiValueMap_Impl_::toStringMap($this1);
	}


	/**
	 * Implicit cast to `Map<String,Array<T>>`
	 * 
	 * @param StringMap $this
	 * 
	 * @return StringMap
	 */
	static public function toMapOfArrays ($this1) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:175: characters 3-19
		return $this1;
	}


	/**
	 * Create a string representation of the current map.
	 * 
	 * @param StringMap $this
	 * 
	 * @return string
	 */
	static public function toString ($this1) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:154: characters 3-28
		$sb = new \StringBuf();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:155: characters 3-16
		$sb->add("[");
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:156: characters 16-22
		$key = new NativeArrayIterator(array_map("strval", array_keys($this1->data)));
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:156: characters 16-22
		while ($key->hasNext()) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:156: lines 156-160
			$key1 = $key->next();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:157: characters 4-28
			$sb->add("\x0A\x09" . ($key1??'null') . " = [");
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:158: characters 4-36
			$sb->add(MultiValueMap_Impl_::getAll($this1, $key1)->join(", "));
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:159: characters 4-17
			$sb->add("]");
		}

		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:161: lines 161-162
		if (strlen($sb->b) > 1) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:162: characters 4-18
			$sb->add("\x0A");
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:163: characters 3-16
		$sb->add("]");
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:164: characters 3-23
		return $sb->b;
	}


	/**
	 * Convert a `MultiValueMap` into a `StringMap<T>`
	 * 
	 * @param StringMap $this
	 * 
	 * @return StringMap
	 */
	static public function toStringMap ($this1) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:185: characters 3-28
		$sm = new StringMap();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:186: characters 16-27
		$key = new NativeArrayIterator(array_map("strval", array_keys($this1->data)));
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:186: characters 16-27
		while ($key->hasNext()) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:186: characters 3-53
			$key1 = $key->next();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:186: characters 30-53
			$value = MultiValueMap_Impl_::get($this1, $key1);
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:186: characters 30-53
			$sm->data[$key1] = $value;
		}

		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/core/MultiValueMap.hx:187: characters 3-12
		return $sm;
	}
}


Boot::registerClass(MultiValueMap_Impl_::class, 'ufront.core._MultiValueMap.MultiValueMap_Impl_');
