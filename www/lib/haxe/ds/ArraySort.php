<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/ds/ArraySort.hx
 */

namespace haxe\ds;

use \php\Boot;

/**
 * ArraySort provides a stable implementation of merge sort through its `sort`
 * method. It should be used instead of `Array.sort` in cases where the order
 * of equal elements has to be retained on all targets.
 */
class ArraySort {
	/**
	 * @param \Array_hx $a
	 * @param \Closure $cmp
	 * @param int $i
	 * @param int $j
	 * 
	 * @return int
	 */
	static public function compare ($a, $cmp, $i, $j) {
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:157: characters 3-25
		return $cmp(($a->arr[$i] ?? null), ($a->arr[$j] ?? null));
	}


	/**
	 * @param \Array_hx $a
	 * @param \Closure $cmp
	 * @param int $from
	 * @param int $pivot
	 * @param int $to
	 * @param int $len1
	 * @param int $len2
	 * 
	 * @return void
	 */
	static public function doMerge ($a, $cmp, $from, $pivot, $to, $len1, $len2) {
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:69: characters 3-52
		$first_cut = null;
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:69: characters 3-52
		$second_cut = null;
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:69: characters 3-52
		$len11 = null;
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:69: characters 3-52
		$len22 = null;
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:70: lines 70-71
		if (($len1 === 0) || ($len2 === 0)) {
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:71: characters 4-10
			return;
		}
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:72: lines 72-76
		if (($len1 + $len2) === 2) {
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:73: lines 73-74
			if ($cmp(($a->arr[$pivot] ?? null), ($a->arr[$from] ?? null)) < 0) {
				#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:74: characters 5-25
				ArraySort::swap($a, $pivot, $from);
			}
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:75: characters 4-10
			return;
		}
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:77: lines 77-87
		if ($len1 > $len2) {
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:78: characters 4-21
			$len11 = $len1 >> 1;
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:79: characters 4-28
			$first_cut = $from + $len11;
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:80: characters 4-52
			$second_cut = ArraySort::lower($a, $cmp, $pivot, $to, $first_cut);
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:81: characters 4-30
			$len22 = $second_cut - $pivot;
		} else {
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:83: characters 4-21
			$len22 = $len2 >> 1;
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:84: characters 4-30
			$second_cut = $pivot + $len22;
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:85: characters 4-54
			$first_cut = ArraySort::upper($a, $cmp, $from, $pivot, $second_cut);
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:86: characters 4-28
			$len11 = $first_cut - $from;
		}
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:88: characters 3-47
		ArraySort::rotate($a, $cmp, $first_cut, $pivot, $second_cut);
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:69: characters 3-52
		$new_mid = $first_cut + $len22;
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:90: characters 3-58
		ArraySort::doMerge($a, $cmp, $from, $first_cut, $new_mid, $len11, $len22);
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:91: characters 3-71
		ArraySort::doMerge($a, $cmp, $new_mid, $second_cut, $to, $len1 - $len11, $len2 - $len22);
	}


	/**
	 * @param int $m
	 * @param int $n
	 * 
	 * @return int
	 */
	static public function gcd ($m, $n) {
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:113: lines 113-117
		while ($n !== 0) {
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:114: characters 4-18
			$t = $m % $n;
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:115: characters 4-9
			$m = $n;
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:116: characters 4-9
			$n = $t;
		}
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:118: characters 3-11
		return $m;
	}


	/**
	 * @param \Array_hx $a
	 * @param \Closure $cmp
	 * @param int $from
	 * @param int $to
	 * @param int $val
	 * 
	 * @return int
	 */
	static public function lower ($a, $cmp, $from, $to, $val) {
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:137: characters 3-34
		$len = $to - $from;
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:137: characters 3-34
		$half = null;
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:137: characters 3-34
		$mid = null;
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:138: lines 138-146
		while ($len > 0) {
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:139: characters 4-19
			$half = $len >> 1;
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:140: characters 4-21
			$mid = $from + $half;
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:141: lines 141-145
			if ($cmp(($a->arr[$mid] ?? null), ($a->arr[$val] ?? null)) < 0) {
				#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:142: characters 5-19
				$from = $mid + 1;
				#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:143: characters 5-25
				$len = $len - $half - 1;
			} else {
				#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:145: characters 5-15
				$len = $half;
			}
		}
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:147: characters 3-14
		return $from;
	}


	/**
	 * @param \Array_hx $a
	 * @param \Closure $cmp
	 * @param int $from
	 * @param int $to
	 * 
	 * @return void
	 */
	static public function rec ($a, $cmp, $from, $to) {
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:48: characters 3-33
		$middle = ($from + $to) >> 1;
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:49: lines 49-62
		if (($to - $from) < 12) {
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:50: characters 4-26
			if ($to <= $from) {
				#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:50: characters 20-26
				return;
			}
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:51: lines 51-60
			$_g1 = $from + 1;
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:51: lines 51-60
			$_g = $to;
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:51: lines 51-60
			while ($_g1 < $_g) {
				#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:51: lines 51-60
				$_g1 = $_g1 + 1;
				#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:51: characters 9-10
				$i = $_g1 - 1;
				#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:52: characters 5-15
				$j = $i;
				#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:53: lines 53-59
				while ($j > $from) {
					#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:54: lines 54-57
					if ($cmp(($a->arr[$j] ?? null), ($a->arr[$j - 1] ?? null)) < 0) {
						#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:55: characters 7-24
						ArraySort::swap($a, $j - 1, $j);
					} else {
						#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:57: characters 7-12
						break;
					}
					#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:58: characters 6-9
					$j = $j - 1;
				}
			}

			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:61: characters 4-10
			return;
		}
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:63: characters 3-28
		ArraySort::rec($a, $cmp, $from, $middle);
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:64: characters 3-26
		ArraySort::rec($a, $cmp, $middle, $to);
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:65: characters 3-64
		ArraySort::doMerge($a, $cmp, $from, $middle, $to, $middle - $from, $to - $middle);
	}


	/**
	 * @param \Array_hx $a
	 * @param \Closure $cmp
	 * @param int $from
	 * @param int $mid
	 * @param int $to
	 * 
	 * @return void
	 */
	static public function rotate ($a, $cmp, $from, $mid, $to) {
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:96: characters 3-39
		if (($from === $mid) || ($mid === $to)) {
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:96: characters 33-39
			return;
		}
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:95: characters 3-9
		$n = ArraySort::gcd($to - $from, $mid - $from);
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:98: lines 98-109
		while (true) {
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:98: characters 10-13
			$n = $n - 1;
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:98: lines 98-109
			if (!(($n + 1) !== 0)) {
				#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:98: lines 98-109
				break;
			}
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:99: characters 4-26
			$val = ($a->arr[$from + $n] ?? null);
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:100: characters 4-27
			$shift = $mid - $from;
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:101: characters 4-45
			$p1 = $from + $n;
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:101: characters 4-45
			$p2 = $from + $n + $shift;
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:102: lines 102-107
			while ($p2 !== ($from + $n)) {
				#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:103: characters 5-18
				$a[$p1] = ($a->arr[$p2] ?? null);
				#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:104: characters 5-12
				$p1 = $p2;
				#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:105: lines 105-106
				if (($to - $p2) > $shift) {
					#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:105: characters 26-37
					$p2 = $p2 + $shift;
				} else {
					#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:106: characters 10-41
					$p2 = $from + ($shift - ($to - $p2));
				}
			}
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:108: characters 4-15
			$a[$p1] = $val;
		}
	}


	/**
	 * Sorts Array `a` according to the comparison function `cmp`, where
	 * `cmp(x,y)` returns 0 if `x == y`, a positive Int if `x > y` and a
	 * negative Int if `x < y`.
	 * This operation modifies Array `a` in place.
	 * This operation is stable: The order of equal elements is preserved.
	 * If `a` or `cmp` are null, the result is unspecified.
	 * 
	 * @param \Array_hx $a
	 * @param \Closure $cmp
	 * 
	 * @return void
	 */
	static public function sort ($a, $cmp) {
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:44: characters 3-27
		ArraySort::rec($a, $cmp, 0, $a->length);
	}


	/**
	 * @param \Array_hx $a
	 * @param int $i
	 * @param int $j
	 * 
	 * @return void
	 */
	static public function swap ($a, $i, $j) {
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:151: characters 3-18
		$tmp = ($a->arr[$i] ?? null);
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:152: characters 3-14
		$a[$i] = ($a->arr[$j] ?? null);
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:153: characters 3-13
		$a[$j] = $tmp;
	}


	/**
	 * @param \Array_hx $a
	 * @param \Closure $cmp
	 * @param int $from
	 * @param int $to
	 * @param int $val
	 * 
	 * @return int
	 */
	static public function upper ($a, $cmp, $from, $to, $val) {
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:122: characters 3-34
		$len = $to - $from;
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:122: characters 3-34
		$half = null;
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:122: characters 3-34
		$mid = null;
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:123: lines 123-132
		while ($len > 0) {
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:124: characters 4-19
			$half = $len >> 1;
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:125: characters 4-21
			$mid = $from + $half;
			#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:126: lines 126-131
			if ($cmp(($a->arr[$val] ?? null), ($a->arr[$mid] ?? null)) < 0) {
				#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:127: characters 5-15
				$len = $half;
			} else {
				#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:129: characters 5-19
				$from = $mid + 1;
				#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:130: characters 5-25
				$len = $len - $half - 1;
			}
		}
		#/usr/local/lib/haxe/std/haxe/ds/ArraySort.hx:133: characters 3-14
		return $from;
	}
}


Boot::registerClass(ArraySort::class, 'haxe.ds.ArraySort');
