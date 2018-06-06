<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ 3018ab1)
 * Haxe source file: /usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx
 */

namespace thx\_Ord;

use \php\Boot;
use \thx\OrderingImpl;

final class Ord_Impl_ {
	/**
	 * @param \Closure $this
	 * @param \Closure $f
	 * 
	 * @return \Closure
	 */
	static public function contramap ($this1, $f) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:64: characters 5-59
		return function ($b0, $b1)  use (&$f, &$this1) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:64: characters 43-48
			$tmp = $f($b0);
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:64: characters 50-55
			$tmp1 = $f($b1);
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:64: characters 31-56
			return $this1($tmp, $tmp1);
		};
	}


	/**
	 * @param \Closure $this
	 * @param mixed $a0
	 * @param mixed $a1
	 * 
	 * @return bool
	 */
	static public function equal ($this1, $a0, $a1) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:61: characters 5-30
		return $this1($a0, $a1) === OrderingImpl::EQ();
	}


	/**
	 * @return \Closure
	 */
	static public function forComparable () {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:80: characters 5-77
		return function ($a, $b) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:80: characters 35-74
			return Ordering_Impl_::fromInt($a->compareTo($b));
		};
	}


	/**
	 * @return \Closure
	 */
	static public function forComparableOrd () {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:83: characters 5-59
		return function ($a, $b) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:83: characters 35-56
			return $a->compareTo($b);
		};
	}


	/**
	 * @param \Closure $f
	 * 
	 * @return \Closure
	 */
	static public function fromIntComparison ($f) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:77: characters 5-72
		return function ($a, $b)  use (&$f) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:77: characters 37-69
			return Ordering_Impl_::fromInt($f($a, $b));
		};
	}


	/**
	 * @param \Closure $this
	 * @param mixed $a0
	 * @param mixed $a1
	 * 
	 * @return int
	 */
	static public function intComparison ($this1, $a0, $a1) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:70: characters 19-31
		$_g = $this1($a0, $a1);
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:70: characters 19-31
		switch ($_g->index) {
			case 0:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:71: characters 16-18
				return -1;
				break;
			case 1:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:73: characters 16-17
				return 1;
				break;
			case 2:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:72: characters 16-17
				return 0;
				break;
		}
	}


	/**
	 * @param \Closure $this
	 * 
	 * @return \Closure
	 */
	static public function inverse ($this1) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:67: characters 5-59
		return function ($a0, $a1)  use (&$this1) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:67: characters 37-56
			return $this1($a1, $a0);
		};
	}


	/**
	 * @param \Closure $this
	 * @param mixed $a0
	 * @param mixed $a1
	 * 
	 * @return mixed
	 */
	static public function max ($this1, $a0, $a1) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:49: characters 19-31
		$_g = $this1($a0, $a1);
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:49: characters 19-31
		switch ($_g->index) {
			case 1:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:51: characters 16-18
				return $a0;
				break;
			case 0:
			case 2:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:50: characters 21-23
				return $a1;
				break;
		}
	}


	/**
	 * @param \Closure $this
	 * @param mixed $a0
	 * @param mixed $a1
	 * 
	 * @return mixed
	 */
	static public function min ($this1, $a0, $a1) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:55: characters 19-31
		$_g = $this1($a0, $a1);
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:55: characters 19-31
		switch ($_g->index) {
			case 1:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:57: characters 16-18
				return $a1;
				break;
			case 0:
			case 2:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:56: characters 21-23
				return $a0;
				break;
		}
	}


	/**
	 * @param \Closure $this
	 * @param mixed $a0
	 * @param mixed $a1
	 * 
	 * @return OrderingImpl
	 */
	static public function order ($this1, $a0, $a1) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Ord.hx:46: characters 5-24
		return $this1($a0, $a1);
	}
}


Boot::registerClass(Ord_Impl_::class, 'thx._Ord.Ord_Impl_');
