<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx
 */

namespace haxe\ds;

use \haxe\IMap;
use \php\Boot;
use \php\_NativeArray\NativeArrayIterator;

/**
 * IntMap allows mapping of Int keys to arbitrary values.
 * See `Map` for documentation details.
 * @see https://haxe.org/manual/std-Map.html
 */
class IntMap implements IMap {
	/**
	 * @var mixed
	 */
	public $data;


	/**
	 * Creates a new IntMap.
	 * 
	 * @return void
	 */
	public function __construct () {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:37: characters 10-34
		$this1 = [];
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:37: characters 3-34
		$this->data = $this1;
	}


	/**
	 * See `Map.copy`
	 * 
	 * @return IntMap
	 */
	public function copy () {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:88: characters 3-29
		$copied = new IntMap();
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:89: characters 3-21
		$copied->data = $this->data;
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:90: characters 3-16
		return $copied;
	}


	/**
	 * See `Map.exists`
	 * 
	 * @param int $key
	 * 
	 * @return bool
	 */
	public function exists ($key) {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:58: characters 3-44
		return array_key_exists($key, $this->data);
	}


	/**
	 * See `Map.get`
	 * 
	 * @param int $key
	 * 
	 * @return mixed
	 */
	public function get ($key) {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:51: characters 10-42
		return ($this->data[$key] ?? null);
	}


	/**
	 * See `Map.iterator`
	 * 
	 * @return object
	 */
	public function iterator () {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:84: characters 10-46
		return new NativeArrayIterator(array_values($this->data));
	}


	/**
	 * See `Map.keys`
	 * 
	 * @return object
	 */
	public function keys () {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:77: characters 10-44
		return new NativeArrayIterator(array_keys($this->data));
	}


	/**
	 * See `Map.remove`
	 * 
	 * @param int $key
	 * 
	 * @return bool
	 */
	public function remove ($key) {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:65: lines 65-68
		if (array_key_exists($key, $this->data)) {
			#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:66: characters 4-27
			unset($this->data[$key]);
			#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:67: characters 4-15
			return true;
		}
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:70: characters 3-15
		return false;
	}


	/**
	 * See `Map.set`
	 * 
	 * @param int $key
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public function set ($key, $value) {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:44: characters 3-20
		$this->data[$key] = $value;
	}


	/**
	 * See `Map.toString`
	 * 
	 * @return string
	 */
	public function toString () {
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:97: characters 15-32
		$this1 = [];
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:97: characters 3-33
		$parts = $this1;
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:98: lines 98-100
		foreach (($this->data) as $key => $value) {
			#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:99: characters 29-59
			$tmp = "" . ($key??'null') . " => " . (\Std::string($value)??'null');
			#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:99: characters 4-60
			array_push($parts, $tmp);
		};
		#/usr/local/lib/haxe/std/php/_std/haxe/ds/IntMap.hx:102: characters 3-49
		return "{" . (implode(", ", $parts)??'null') . "}";
	}


	public function __toString() {
		return $this->toString();
	}
}


Boot::registerClass(IntMap::class, 'haxe.ds.IntMap');