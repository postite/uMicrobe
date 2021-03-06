<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/ds/Vector.hx
 */

namespace haxe\ds\_Vector;

use \php\Boot;

final class Vector_Impl_ {


	/**
	 * Creates a new Vector of length `length`.
	 * Initially `this` Vector contains `length` neutral elements:
	 * - always null on dynamic targets
	 * - 0, 0.0 or false for Int, Float and Bool respectively on static targets
	 * - null for other types on static targets
	 * If `length` is less than or equal to 0, the result is unspecified.
	 * 
	 * @param int $length
	 * 
	 * @return \Array_hx
	 */
	static public function _new ($length) {
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:62: character 16
		$this1 = new \Array_hx();
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:83: characters 12-32
		$this1->length = $length;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:62: character 16
		return $this1;
	}


	/**
	 * Copies `length` of elements from `src` Vector, beginning at `srcPos` to
	 * `dest` Vector, beginning at `destPos`
	 * The results are unspecified if `length` results in out-of-bounds access,
	 * or if `src` or `dest` are null
	 * 
	 * @param \Array_hx $src
	 * @param int $srcPos
	 * @param \Array_hx $dest
	 * @param int $destPos
	 * @param int $len
	 * 
	 * @return void
	 */
	static public function blit ($src, $srcPos, $dest, $destPos, $len) {
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:162: lines 162-184
		if ($src === $dest) {
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:163: lines 163-179
			if ($srcPos < $destPos) {
				#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:164: characters 6-27
				$i = $srcPos + $len;
				#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:165: characters 6-28
				$j = $destPos + $len;
				#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:166: lines 166-170
				$_g1 = 0;
				#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:166: lines 166-170
				$_g = $len;
				#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:166: lines 166-170
				while ($_g1 < $_g) {
					#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:166: lines 166-170
					$_g1 = $_g1 + 1;
					#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:166: characters 11-12
					$k = $_g1 - 1;
					#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:167: characters 7-10
					$i = $i - 1;
					#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:168: characters 7-10
					$j = $j - 1;
					#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:169: characters 7-22
					$src[$j] = ($src->arr[$i] ?? null);
				}

			} else if ($srcPos > $destPos) {
				#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:172: characters 6-21
				$i1 = $srcPos;
				#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:173: characters 6-22
				$j1 = $destPos;
				#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:174: lines 174-178
				$_g11 = 0;
				#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:174: lines 174-178
				$_g2 = $len;
				#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:174: lines 174-178
				while ($_g11 < $_g2) {
					#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:174: lines 174-178
					$_g11 = $_g11 + 1;
					#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:174: characters 11-12
					$k1 = $_g11 - 1;
					#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:175: characters 7-22
					$src[$j1] = ($src->arr[$i1] ?? null);
					#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:176: characters 7-10
					$i1 = $i1 + 1;
					#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:177: characters 7-10
					$j1 = $j1 + 1;
				}

			}
		} else {
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:181: lines 181-183
			$_g12 = 0;
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:181: lines 181-183
			$_g3 = $len;
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:181: lines 181-183
			while ($_g12 < $_g3) {
				#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:181: lines 181-183
				$_g12 = $_g12 + 1;
				#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:181: characters 10-11
				$i2 = $_g12 - 1;
				#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:182: characters 6-41
				$dest[$destPos + $i2] = ($src->arr[$srcPos + $i2] ?? null);
			}
		}
	}


	/**
	 * Returns a shallow copy of `this` Vector.
	 * The elements are not copied and retain their identity, so
	 * `a[i] == a.copy()[i]` is true for any valid `i`. However,
	 * `a == a.copy()` is always false.
	 * 
	 * @param \Array_hx $this
	 * 
	 * @return \Array_hx
	 */
	static public function copy ($this1) {
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:278: characters 11-32
		$this2 = new \Array_hx();
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:278: characters 11-32
		$this2->length = $this1->length;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:278: characters 3-33
		$r = $this2;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:279: characters 3-42
		Vector_Impl_::blit($this1, 0, $r, 0, $this1->length);
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:280: characters 3-11
		return $r;
	}


	/**
	 * Creates a new Vector by copying the elements of `array`.
	 * This always creates a copy, even on platforms where the internal
	 * representation is Array.
	 * The elements are not copied and retain their identity, so
	 * `a[i] == Vector.fromArrayCopy(a).get(i)` is true for any valid i.
	 * If `array` is null, the result is unspecified.
	 * 
	 * @param \Array_hx $array
	 * 
	 * @return \Array_hx
	 */
	static public function fromArrayCopy ($array) {
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:260: characters 13-40
		$this1 = new \Array_hx();
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:260: characters 13-40
		$this1->length = $array->length;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:260: characters 3-41
		$vec = $this1;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:261: lines 261-262
		$_g1 = 0;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:261: lines 261-262
		$_g = $array->length;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:261: lines 261-262
		while ($_g1 < $_g) {
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:261: lines 261-262
			$_g1 = $_g1 + 1;
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:261: characters 8-9
			$i = $_g1 - 1;
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:262: characters 4-24
			$vec[$i] = ($array->arr[$i] ?? null);
		}

		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:263: characters 3-13
		return $vec;
	}


	/**
	 * Initializes a new Vector from `data`.
	 * Since `data` is the internal representation of Vector, this is a no-op.
	 * If `data` is null, the corresponding Vector is also `null`.
	 * 
	 * @param \Array_hx $data
	 * 
	 * @return \Array_hx
	 */
	static public function fromData ($data) {
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:229: characters 3-19
		return $data;
	}


	/**
	 * Returns the value at index `index`.
	 * If `index` is negative or exceeds `this.length`, the result is
	 * unspecified.
	 * 
	 * @param \Array_hx $this
	 * @param int $index
	 * 
	 * @return mixed
	 */
	static public function get ($this1, $index) {
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:101: characters 3-21
		return ($this1->arr[$index] ?? null);
	}


	/**
	 * @param \Array_hx $this
	 * 
	 * @return int
	 */
	static public function get_length ($this1) {
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:138: characters 4-30
		return $this1->length;
	}


	/**
	 * Returns a string representation of `this` Vector, with `sep` separating
	 * each element.
	 * The result of this operation is equal to `Std.string(this[0]) + sep +
	 * Std.string(this[1]) + sep + ... + sep + Std.string(this[this.length-1])`
	 * If `this` Vector has length 0, the result is the empty String `""`.
	 * If `this` has exactly one element, the result is equal to a call to
	 * `Std.string(this[0])`.
	 * If `sep` is null, the result is unspecified.
	 * 
	 * @param \Array_hx $this
	 * @param string $sep
	 * 
	 * @return string
	 */
	static public function join ($this1, $sep) {
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:301: characters 3-27
		$b = new \StringBuf();
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:302: characters 3-13
		$i = 0;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:303: characters 3-20
		$len = $this1->length;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:304: lines 304-309
		$_g1 = 0;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:304: lines 304-309
		$_g = $len;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:304: lines 304-309
		while ($_g1 < $_g) {
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:304: lines 304-309
			$_g1 = $_g1 + 1;
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:304: characters 7-8
			$i1 = $_g1 - 1;
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:305: characters 4-31
			$b->add(\Std::string(($this1->arr[$i1] ?? null)));
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:306: lines 306-308
			if ($i1 < ($len - 1)) {
				#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:307: characters 5-15
				$b->add($sep);
			}
		}

		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:310: characters 3-22
		return $b->b;
	}


	/**
	 * Creates a new Vector by applying function `f` to all elements of `this`.
	 * The order of elements is preserved.
	 * If `f` is null, the result is unspecified.
	 * 
	 * @param \Array_hx $this
	 * @param \Closure $f
	 * 
	 * @return \Array_hx
	 */
	static public function map ($this1, $f) {
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:325: characters 3-23
		$length = $this1->length;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:326: characters 11-32
		$this2 = new \Array_hx();
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:326: characters 11-32
		$this2->length = $length;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:326: characters 3-33
		$r = $this2;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:327: characters 3-13
		$i = 0;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:328: characters 3-20
		$len = $length;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:329: lines 329-332
		$_g1 = 0;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:329: lines 329-332
		$_g = $len;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:329: lines 329-332
		while ($_g1 < $_g) {
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:329: lines 329-332
			$_g1 = $_g1 + 1;
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:329: characters 7-8
			$i1 = $_g1 - 1;
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:330: characters 4-22
			$v = $f(($this1->arr[$i1] ?? null));
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:331: characters 4-15
			$r[$i1] = $v;
		}

		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:333: characters 3-11
		return $r;
	}


	/**
	 * Sets the value at index `index` to `val`.
	 * If `index` is negative or exceeds `this.length`, the result is
	 * unspecified.
	 * 
	 * @param \Array_hx $this
	 * @param int $index
	 * @param mixed $val
	 * 
	 * @return mixed
	 */
	static public function set ($this1, $index, $val) {
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:119: characters 3-27
		return $this1[$index] = $val;
	}


	/**
	 * Sorts `this` Vector according to the comparison function `f`, where
	 * `f(x,y)` returns 0 if x == y, a positive Int if x > y and a
	 * negative Int if x < y.
	 * This operation modifies `this` Vector in place.
	 * The sort operation is not guaranteed to be stable, which means that the
	 * order of equal elements may not be retained.
	 * If `f` is null, the result is unspecified.
	 * 
	 * @param \Array_hx $this
	 * @param \Closure $f
	 * 
	 * @return void
	 */
	static public function sort ($this1, $f) {
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:355: characters 3-15
		usort($this1->arr, $f);
	}


	/**
	 * Creates a new Array, copy the content from the Vector to it, and returns it.
	 * 
	 * @param \Array_hx $this
	 * 
	 * @return \Array_hx
	 */
	static public function toArray ($this1) {
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:201: characters 4-24
		$a = new \Array_hx();
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:202: characters 4-21
		$len = $this1->length;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:207: lines 207-208
		$_g1 = 0;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:207: lines 207-208
		$_g = $len;
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:207: lines 207-208
		while ($_g1 < $_g) {
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:207: lines 207-208
			$_g1 = $_g1 + 1;
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:207: characters 9-10
			$i = $_g1 - 1;
			#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:208: characters 5-18
			$a[$i] = ($this1->arr[$i] ?? null);
		}

		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:209: characters 4-12
		return $a;
	}


	/**
	 * Extracts the data of `this` Vector.
	 * This returns the internal representation type.
	 * 
	 * @param \Array_hx $this
	 * 
	 * @return \Array_hx
	 */
	static public function toData ($this1) {
		#/usr/local/lib/haxe/std/haxe/ds/Vector.hx:219: characters 3-19
		return $this1;
	}
}


Boot::registerClass(Vector_Impl_::class, 'haxe.ds._Vector.Vector_Impl_');
Boot::registerGetters('haxe\\ds\\_Vector\\Vector_Impl_', [
	'length' => true
]);
