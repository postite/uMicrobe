<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/php/_std/Array.hx
 */

use \php\_Boot\HxClosure;
use \_Array\ArrayIterator;
use \php\_Boot\HxException;
use \php\Boot;
use \haxe\CallStack;

final /**
 * An Array is a storage for values. You can access it using indexes or
 * with its API.
 * @see https://haxe.org/manual/std-Array.html
 * @see https://haxe.org/manual/lf-array-comprehension.html
 */
class Array_hx implements \ArrayAccess {
	/**
	 * @var mixed
	 */
	public $arr;
	/**
	 * @var int
	 * The length of `this` Array.
	 */
	public $length;


	/**
	 * @param mixed $arr
	 * 
	 * @return Array_hx
	 */
	static public function wrap ($arr) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:222: characters 3-23
		$a = new Array_hx();
		#/usr/local/lib/haxe/std/php/_std/Array.hx:223: characters 3-14
		$a->arr = $arr;
		#/usr/local/lib/haxe/std/php/_std/Array.hx:224: characters 3-31
		$a->length = count($arr);
		#/usr/local/lib/haxe/std/php/_std/Array.hx:225: characters 3-11
		return $a;
	}


	/**
	 * Creates a new Array.
	 * 
	 * @return void
	 */
	public function __construct () {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:33: characters 9-36
		$this1 = [];
		#/usr/local/lib/haxe/std/php/_std/Array.hx:33: characters 3-36
		$this->arr = $this1;
		#/usr/local/lib/haxe/std/php/_std/Array.hx:34: characters 3-13
		$this->length = 0;
	}


	/**
	 * Returns a new Array by appending the elements of `a` to the elements of
	 * `this` Array.
	 * This operation does not modify `this` Array.
	 * If `a` is the empty Array `[]`, a copy of `this` Array is returned.
	 * The length of the returned Array is equal to the sum of `this.length`
	 * and `a.length`.
	 * If `a` is `null`, the result is unspecified.
	 * 
	 * @param Array_hx $a
	 * 
	 * @return Array_hx
	 */
	public function concat ($a) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:38: characters 3-46
		return Array_hx::wrap(array_merge($this->arr, $a->arr));
	}


	/**
	 * Returns a shallow copy of `this` Array.
	 * The elements are not copied and retain their identity, so
	 * `a[i] == a.copy()[i]` is true for any valid `i`. However,
	 * `a == a.copy()` is always false.
	 * 
	 * @return Array_hx
	 */
	public function copy () {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:42: characters 3-19
		return Array_hx::wrap($this->arr);
	}


	/**
	 * Returns an Array containing those elements of `this` for which `f`
	 * returned true.
	 * The individual elements are not duplicated and retain their identity.
	 * If `f` is null, the result is unspecified.
	 * 
	 * @param \Closure $f
	 * 
	 * @return Array_hx
	 */
	public function filter ($f) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:46: characters 3-35
		$result = [];
		#/usr/local/lib/haxe/std/php/_std/Array.hx:47: lines 47-51
		$_g1 = 0;
		#/usr/local/lib/haxe/std/php/_std/Array.hx:47: lines 47-51
		$_g = $this->length;
		#/usr/local/lib/haxe/std/php/_std/Array.hx:47: lines 47-51
		while ($_g1 < $_g) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:47: lines 47-51
			$_g1 = $_g1 + 1;
			#/usr/local/lib/haxe/std/php/_std/Array.hx:47: characters 7-8
			$i = $_g1 - 1;
			#/usr/local/lib/haxe/std/php/_std/Array.hx:48: lines 48-50
			if ($f($this->arr[$i])) {
				#/usr/local/lib/haxe/std/php/_std/Array.hx:49: characters 5-24
				$result[] = $this->arr[$i];
			}
		}

		#/usr/local/lib/haxe/std/php/_std/Array.hx:52: characters 3-22
		return Array_hx::wrap($result);
	}


	/**
	 * Returns position of the first occurrence of `x` in `this` Array, searching front to back.
	 * If `x` is found by checking standard equality, the function returns its index.
	 * If `x` is not found, the function returns -1.
	 * If `fromIndex` is specified, it will be used as the starting index to search from,
	 * otherwise search starts with zero index. If it is negative, it will be taken as the
	 * offset from the end of `this` Array to compute the starting index. If given or computed
	 * starting index is less than 0, the whole array will be searched, if it is greater than
	 * or equal to the length of `this` Array, the function returns -1.
	 * 
	 * @param mixed $x
	 * @param int $fromIndex
	 * 
	 * @return int
	 */
	public function indexOf ($x, $fromIndex = null) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:56: lines 56-63
		if (($fromIndex === null) && !($x instanceof HxClosure) && !(is_int($x) || is_float($x))) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:57: characters 4-50
			$index = array_search($x, $this->arr, true);
			#/usr/local/lib/haxe/std/php/_std/Array.hx:58: lines 58-62
			if ($index === false) {
				#/usr/local/lib/haxe/std/php/_std/Array.hx:59: characters 5-14
				return -1;
			} else {
				#/usr/local/lib/haxe/std/php/_std/Array.hx:61: characters 5-17
				return $index;
			}
		}
		#/usr/local/lib/haxe/std/php/_std/Array.hx:64: lines 64-69
		if ($fromIndex === null) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:65: characters 4-17
			$fromIndex = 0;
		} else {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:67: characters 4-42
			if ($fromIndex < 0) {
				#/usr/local/lib/haxe/std/php/_std/Array.hx:67: characters 23-42
				$fromIndex = $fromIndex + $this->length;
			}
			#/usr/local/lib/haxe/std/php/_std/Array.hx:68: characters 4-36
			if ($fromIndex < 0) {
				#/usr/local/lib/haxe/std/php/_std/Array.hx:68: characters 23-36
				$fromIndex = 0;
			}
		}
		#/usr/local/lib/haxe/std/php/_std/Array.hx:70: lines 70-74
		while ($fromIndex < $this->length) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:71: lines 71-72
			if (Boot::equal($this->arr[$fromIndex], $x)) {
				#/usr/local/lib/haxe/std/php/_std/Array.hx:72: characters 5-21
				return $fromIndex;
			}
			#/usr/local/lib/haxe/std/php/_std/Array.hx:73: characters 4-15
			$fromIndex = $fromIndex + 1;
		}
		#/usr/local/lib/haxe/std/php/_std/Array.hx:75: characters 3-12
		return -1;
	}


	/**
	 * Inserts the element `x` at the position `pos`.
	 * This operation modifies `this` Array in place.
	 * The offset is calculated like so:
	 * - If `pos` exceeds `this.length`, the offset is `this.length`.
	 * - If `pos` is negative, the offset is calculated from the end of `this`
	 * Array, i.e. `this.length + pos`. If this yields a negative value, the
	 * offset is 0.
	 * - Otherwise, the offset is `pos`.
	 * If the resulting offset does not exceed `this.length`, all elements from
	 * and including that offset to the end of `this` Array are moved one index
	 * ahead.
	 * 
	 * @param int $pos
	 * @param mixed $x
	 * 
	 * @return void
	 */
	public function insert ($pos, $x) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:79: characters 3-11
		$this->length++;
		#/usr/local/lib/haxe/std/php/_std/Array.hx:80: characters 3-56
		array_splice($this->arr, $pos, 0, [$x]);
	}


	/**
	 * Returns an iterator of the Array values.
	 * 
	 * @return object
	 */
	public function iterator () {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:85: characters 3-33
		return new ArrayIterator($this);
	}


	/**
	 * Returns a string representation of `this` Array, with `sep` separating
	 * each element.
	 * The result of this operation is equal to `Std.string(this[0]) + sep +
	 * Std.string(this[1]) + sep + ... + sep + Std.string(this[this.length-1])`
	 * If `this` is the empty Array `[]`, the result is the empty String `""`.
	 * If `this` has exactly one element, the result is equal to a call to
	 * `Std.string(this[0])`.
	 * If `sep` is null, the result is unspecified.
	 * 
	 * @param string $sep
	 * 
	 * @return string
	 */
	public function join ($sep) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:89: characters 3-62
		return implode($sep, array_map("strval", $this->arr));
	}


	/**
	 * Returns position of the last occurrence of `x` in `this` Array, searching back to front.
	 * If `x` is found by checking standard equality, the function returns its index.
	 * If `x` is not found, the function returns -1.
	 * If `fromIndex` is specified, it will be used as the starting index to search from,
	 * otherwise search starts with the last element index. If it is negative, it will be
	 * taken as the offset from the end of `this` Array to compute the starting index. If
	 * given or computed starting index is greater than or equal to the length of `this` Array,
	 * the whole array will be searched, if it is less than 0, the function returns -1.
	 * 
	 * @param mixed $x
	 * @param int $fromIndex
	 * 
	 * @return int
	 */
	public function lastIndexOf ($x, $fromIndex = null) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:93: characters 3-71
		if (($fromIndex === null) || ($fromIndex >= $this->length)) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:93: characters 49-71
			$fromIndex = $this->length - 1;
		}
		#/usr/local/lib/haxe/std/php/_std/Array.hx:94: characters 3-41
		if ($fromIndex < 0) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:94: characters 22-41
			$fromIndex = $fromIndex + $this->length;
		}
		#/usr/local/lib/haxe/std/php/_std/Array.hx:95: lines 95-99
		while ($fromIndex >= 0) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:96: lines 96-97
			if (Boot::equal($this->arr[$fromIndex], $x)) {
				#/usr/local/lib/haxe/std/php/_std/Array.hx:97: characters 5-21
				return $fromIndex;
			}
			#/usr/local/lib/haxe/std/php/_std/Array.hx:98: characters 4-15
			$fromIndex = $fromIndex - 1;
		}
		#/usr/local/lib/haxe/std/php/_std/Array.hx:100: characters 3-12
		return -1;
	}


	/**
	 * Creates a new Array by applying function `f` to all elements of `this`.
	 * The order of elements is preserved.
	 * If `f` is null, the result is unspecified.
	 * 
	 * @param \Closure $f
	 * 
	 * @return Array_hx
	 */
	public function map ($f) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:104: characters 3-35
		$result = [];
		#/usr/local/lib/haxe/std/php/_std/Array.hx:105: lines 105-107
		$_g1 = 0;
		#/usr/local/lib/haxe/std/php/_std/Array.hx:105: lines 105-107
		$_g = $this->length;
		#/usr/local/lib/haxe/std/php/_std/Array.hx:105: lines 105-107
		while ($_g1 < $_g) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:105: lines 105-107
			$_g1 = $_g1 + 1;
			#/usr/local/lib/haxe/std/php/_std/Array.hx:105: characters 7-8
			$i = $_g1 - 1;
			#/usr/local/lib/haxe/std/php/_std/Array.hx:106: characters 4-26
			$result[] = $f($this->arr[$i]);
		}

		#/usr/local/lib/haxe/std/php/_std/Array.hx:108: characters 3-22
		return Array_hx::wrap($result);
	}


	/**
	 * @param int $offset
	 * 
	 * @return bool
	 */
	public function offsetExists ($offset) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:190: characters 3-25
		return $offset < $this->length;
	}


	/**
	 * @param int $offset
	 * 
	 * @return mixed
	 */
	public function &offsetGet ($offset) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:195: lines 195-199
		try {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:196: characters 4-22
			return $this->arr[$offset];
		} catch (\Throwable $__hx__caught_e) {
			CallStack::saveExceptionTrace($__hx__caught_e);
			$__hx__real_e = ($__hx__caught_e instanceof HxException ? $__hx__caught_e->e : $__hx__caught_e);
			$e = $__hx__real_e;
			#/usr/local/lib/haxe/std/php/_std/Array.hx:198: characters 4-15
			return null;
		}
	}


	/**
	 * @param int $offset
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public function offsetSet ($offset, $value) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:204: lines 204-209
		if ($this->length <= $offset) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:205: lines 205-207
			if ($this->length < $offset) {
				#/usr/local/lib/haxe/std/php/_std/Array.hx:206: characters 5-50
				$this->arr = array_pad($this->arr, $offset + 1, null);
			}
			#/usr/local/lib/haxe/std/php/_std/Array.hx:208: characters 4-23
			$this->length = $offset + 1;
		}
		#/usr/local/lib/haxe/std/php/_std/Array.hx:210: characters 3-22
		$this->arr[$offset] = $value;
	}


	/**
	 * @param int $offset
	 * 
	 * @return void
	 */
	public function offsetUnset ($offset) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:215: lines 215-218
		if (($offset >= 0) && ($offset < $this->length)) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:216: characters 4-39
			array_splice($this->arr, $offset, 1);
			#/usr/local/lib/haxe/std/php/_std/Array.hx:217: characters 4-12
			--$this->length;
		}
	}


	/**
	 * Removes the last element of `this` Array and returns it.
	 * This operation modifies `this` Array in place.
	 * If `this` has at least one element, `this.length` will decrease by 1.
	 * If `this` is the empty Array `[]`, null is returned and the length
	 * remains 0.
	 * 
	 * @return mixed
	 */
	public function pop () {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:112: characters 3-27
		if ($this->length > 0) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:112: characters 19-27
			$this->length--;
		}
		#/usr/local/lib/haxe/std/php/_std/Array.hx:113: characters 3-31
		return array_pop($this->arr);
	}


	/**
	 * Adds the element `x` at the end of `this` Array and returns the new
	 * length of `this` Array.
	 * This operation modifies `this` Array in place.
	 * `this.length` increases by 1.
	 * 
	 * @param mixed $x
	 * 
	 * @return int
	 */
	public function push ($x) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:117: characters 3-18
		$this->arr[$this->length] = $x;
		#/usr/local/lib/haxe/std/php/_std/Array.hx:118: characters 3-18
		return ++$this->length;
	}


	/**
	 * Removes the first occurrence of `x` in `this` Array.
	 * This operation modifies `this` Array in place.
	 * If `x` is found by checking standard equality, it is removed from `this`
	 * Array and all following elements are reindexed accordingly. The function
	 * then returns true.
	 * If `x` is not found, `this` Array is not changed and the function
	 * returns false.
	 * 
	 * @param mixed $x
	 * 
	 * @return bool
	 */
	public function remove ($x) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:122: lines 122-128
		$_g1 = 0;
		#/usr/local/lib/haxe/std/php/_std/Array.hx:122: lines 122-128
		$_g = $this->length;
		#/usr/local/lib/haxe/std/php/_std/Array.hx:122: lines 122-128
		while ($_g1 < $_g) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:122: lines 122-128
			$_g1 = $_g1 + 1;
			#/usr/local/lib/haxe/std/php/_std/Array.hx:122: characters 8-9
			$i = $_g1 - 1;
			#/usr/local/lib/haxe/std/php/_std/Array.hx:123: lines 123-127
			if (Boot::equal($this->arr[$i], $x)) {
				#/usr/local/lib/haxe/std/php/_std/Array.hx:124: characters 5-35
				array_splice($this->arr, $i, 1);
				#/usr/local/lib/haxe/std/php/_std/Array.hx:125: characters 5-13
				$this->length--;
				#/usr/local/lib/haxe/std/php/_std/Array.hx:126: characters 5-16
				return true;
			}
		}

		#/usr/local/lib/haxe/std/php/_std/Array.hx:129: characters 3-15
		return false;
	}


	/**
	 * Set the length of the Array.
	 * If `len` is shorter than the array's current size, the last
	 * `length - len` elements will be removed. If `len` is longer, the Array
	 * will be extended, with new elements set to a target-specific default
	 * value:
	 * - always null on dynamic targets
	 * - 0, 0.0 or false for Int, Float and Bool respectively on static targets
	 * - null for other types on static targets
	 * 
	 * @param int $len
	 * 
	 * @return void
	 */
	public function resize ($len) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:180: lines 180-184
		if ($this->length < $len) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:181: characters 4-42
			$this->arr = array_pad($this->arr, $len, null);
		} else if ($this->length > $len) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:183: characters 4-47
			array_splice($this->arr, $len, $this->length - $len);
		}
		#/usr/local/lib/haxe/std/php/_std/Array.hx:185: characters 3-15
		$this->length = $len;
	}


	/**
	 * Reverse the order of elements of `this` Array.
	 * This operation modifies `this` Array in place.
	 * If `this.length < 2`, `this` remains unchanged.
	 * 
	 * @return void
	 */
	public function reverse () {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:133: characters 3-34
		$this->arr = array_reverse($this->arr);
	}


	/**
	 * Removes the first element of `this` Array and returns it.
	 * This operation modifies `this` Array in place.
	 * If `this` has at least one element, `this`.length and the index of each
	 * remaining element is decreased by 1.
	 * If `this` is the empty Array `[]`, `null` is returned and the length
	 * remains 0.
	 * 
	 * @return mixed
	 */
	public function shift () {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:137: characters 3-27
		if ($this->length > 0) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:137: characters 19-27
			$this->length--;
		}
		#/usr/local/lib/haxe/std/php/_std/Array.hx:138: characters 3-33
		return array_shift($this->arr);
	}


	/**
	 * Creates a shallow copy of the range of `this` Array, starting at and
	 * including `pos`, up to but not including `end`.
	 * This operation does not modify `this` Array.
	 * The elements are not copied and retain their identity.
	 * If `end` is omitted or exceeds `this.length`, it defaults to the end of
	 * `this` Array.
	 * If `pos` or `end` are negative, their offsets are calculated from the
	 * end of `this` Array by `this.length + pos` and `this.length + end`
	 * respectively. If this yields a negative value, 0 is used instead.
	 * If `pos` exceeds `this.length` or if `end` is less than or equals
	 * `pos`, the result is `[]`.
	 * 
	 * @param int $pos
	 * @param int $end
	 * 
	 * @return Array_hx
	 */
	public function slice ($pos, $end = null) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:142: characters 3-29
		if ($pos < 0) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:142: characters 16-29
			$pos = $pos + $this->length;
		}
		#/usr/local/lib/haxe/std/php/_std/Array.hx:143: characters 3-23
		if ($pos < 0) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:143: characters 16-23
			$pos = 0;
		}
		#/usr/local/lib/haxe/std/php/_std/Array.hx:144: lines 144-153
		if ($end === null) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:145: characters 4-45
			return Array_hx::wrap(array_slice($this->arr, $pos));
		} else {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:147: characters 4-30
			if ($end < 0) {
				#/usr/local/lib/haxe/std/php/_std/Array.hx:147: characters 17-30
				$end = $end + $this->length;
			}
			#/usr/local/lib/haxe/std/php/_std/Array.hx:148: lines 148-152
			if ($end <= $pos) {
				#/usr/local/lib/haxe/std/php/_std/Array.hx:149: characters 5-14
				return new Array_hx();
			} else {
				#/usr/local/lib/haxe/std/php/_std/Array.hx:151: characters 5-57
				return Array_hx::wrap(array_slice($this->arr, $pos, $end - $pos));
			}
		}
	}


	/**
	 * Sorts `this` Array according to the comparison function `f`, where
	 * `f(x,y)` returns 0 if x == y, a positive Int if x > y and a
	 * negative Int if x < y.
	 * This operation modifies `this` Array in place.
	 * The sort operation is not guaranteed to be stable, which means that the
	 * order of equal elements may not be retained. For a stable Array sorting
	 * algorithm, `haxe.ds.ArraySort.sort()` can be used instead.
	 * If `f` is null, the result is unspecified.
	 * 
	 * @param \Closure $f
	 * 
	 * @return void
	 */
	public function sort ($f) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:157: characters 3-15
		usort($this->arr, $f);
	}


	/**
	 * Removes `len` elements from `this` Array, starting at and including
	 * `pos`, an returns them.
	 * This operation modifies `this` Array in place.
	 * If `len` is < 0 or `pos` exceeds `this`.length, an empty Array [] is
	 * returned and `this` Array is unchanged.
	 * If `pos` is negative, its value is calculated from the end	of `this`
	 * Array by `this.length + pos`. If this yields a negative value, 0 is
	 * used instead.
	 * If the sum of the resulting values for `len` and `pos` exceed
	 * `this.length`, this operation will affect the elements from `pos` to the
	 * end of `this` Array.
	 * The length of the returned Array is equal to the new length of `this`
	 * Array subtracted from the original length of `this` Array. In other
	 * words, each element of the original `this` Array either remains in
	 * `this` Array or becomes an element of the returned Array.
	 * 
	 * @param int $pos
	 * @param int $len
	 * 
	 * @return Array_hx
	 */
	public function splice ($pos, $len) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:161: characters 3-25
		if ($len < 0) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:161: characters 16-25
			return new Array_hx();
		}
		#/usr/local/lib/haxe/std/php/_std/Array.hx:162: characters 3-57
		$result = Array_hx::wrap(array_splice($this->arr, $pos, $len));
		#/usr/local/lib/haxe/std/php/_std/Array.hx:163: characters 3-9
		$tmp = $this;
		#/usr/local/lib/haxe/std/php/_std/Array.hx:163: characters 3-26
		$tmp->length = $tmp->length - $result->length;
		#/usr/local/lib/haxe/std/php/_std/Array.hx:164: characters 3-16
		return $result;
	}


	/**
	 * Returns a string representation of `this` Array.
	 * The result will include the individual elements' String representations
	 * separated by comma. The enclosing [ ] may be missing on some platforms,
	 * use `Std.string()` to get a String representation that is consistent
	 * across platforms.
	 * 
	 * @return string
	 */
	public function toString () {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:172: characters 3-36
		$strings = [];
		#/usr/local/lib/haxe/std/php/_std/Array.hx:173: lines 173-175
		foreach (($this->arr) as $index => $value) {
			#/usr/local/lib/haxe/std/php/_std/Array.hx:174: characters 4-42
			$val = Boot::stringify($value);
			#/usr/local/lib/haxe/std/php/_std/Array.hx:174: characters 4-42
			$strings[$index] = $val;
		};
		#/usr/local/lib/haxe/std/php/_std/Array.hx:176: characters 3-50
		return "[" . (implode(",", $strings)??'null') . "]";
	}


	/**
	 * Adds the element `x` at the start of `this` Array.
	 * This operation modifies `this` Array in place.
	 * `this.length` and the index of each Array element increases by 1.
	 * 
	 * @param mixed $x
	 * 
	 * @return void
	 */
	public function unshift ($x) {
		#/usr/local/lib/haxe/std/php/_std/Array.hx:168: characters 3-40
		$this->length = array_unshift($this->arr, $x);
	}


	public function __toString() {
		return $this->toString();
	}
}


Boot::registerClass(Array_hx::class, 'Array');
