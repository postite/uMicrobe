<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/Int32.hx
 */

namespace haxe\_Int32;

use \php\Boot;

final class Int32_Impl_ {
	/**
	 * @var int
	 */
	static public $extraBits;


	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function add ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:50: characters 3-40
		return (($a + $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function addInt ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:53: characters 3-40
		return (($a + $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @param int $x
	 * 
	 * @return int
	 */
	static public function clamp ($x) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:244: characters 3-39
		return ($x << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @param int $a
	 * 
	 * @return int
	 */
	static public function complement ($a) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:152: characters 3-19
		return (~$a << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function intShl ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:209: characters 4-34
		return ($a << $b << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function intShr ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:188: characters 3-29
		return (($a >> $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function intSub ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:64: characters 3-40
		return (($a - $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function mul ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:88: characters 3-99
		return (($a * ($b & 65535) + ((($a * (Boot::shiftRightUnsigned($b, 16))) << 16 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function mulInt ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:92: characters 3-19
		return Int32_Impl_::mul($a, $b);
	}


	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function or ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:163: characters 3-34
		return (($a | $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function orInt ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:165: characters 3-28
		return (($a | $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @param int $this
	 * 
	 * @return int
	 */
	static public function postDecrement ($this1) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:44: characters 13-19
		$this1 = $this1 - 1;
		#/usr/local/lib/haxe/std/haxe/Int32.hx:44: characters 3-20
		$ret = $this1 + 1;
		#/usr/local/lib/haxe/std/haxe/Int32.hx:45: characters 3-21
		$this1 = ($this1 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/usr/local/lib/haxe/std/haxe/Int32.hx:46: characters 3-13
		return $ret;
	}


	/**
	 * @param int $this
	 * 
	 * @return int
	 */
	static public function postIncrement ($this1) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:35: characters 13-19
		$this1 = $this1 + 1;
		#/usr/local/lib/haxe/std/haxe/Int32.hx:35: characters 3-20
		$ret = $this1 - 1;
		#/usr/local/lib/haxe/std/haxe/Int32.hx:36: characters 3-21
		$this1 = ($this1 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/usr/local/lib/haxe/std/haxe/Int32.hx:37: characters 3-13
		return $ret;
	}


	/**
	 * @param int $this
	 * 
	 * @return int
	 */
	static public function preDecrement ($this1) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:41: characters 23-29
		$this1 = $this1 - 1;
		#/usr/local/lib/haxe/std/haxe/Int32.hx:41: characters 17-30
		$this1 = ($this1 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/usr/local/lib/haxe/std/haxe/Int32.hx:41: characters 3-30
		return $this1;
	}


	/**
	 * @param int $this
	 * 
	 * @return int
	 */
	static public function preIncrement ($this1) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:32: characters 23-29
		$this1 = $this1 + 1;
		#/usr/local/lib/haxe/std/haxe/Int32.hx:32: characters 17-30
		$this1 = ($this1 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/usr/local/lib/haxe/std/haxe/Int32.hx:32: characters 3-30
		return $this1;
	}


	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function shl ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:203: characters 3-41
		return ($a << $b << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function shlInt ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:206: characters 3-33
		return ($a << $b << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function shr ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:184: characters 3-35
		return (($a >> $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function shrInt ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:186: characters 3-29
		return (($a >> $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function sub ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:58: characters 3-40
		return (($a - $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function subInt ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:61: characters 3-40
		return (($a - $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @param int $this
	 * 
	 * @return float
	 */
	static public function toFloat ($this1) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:221: characters 3-14
		return $this1;
	}


	/**
	 * Compare `a` and `b` in unsigned mode.
	 * 
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function ucompare ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:227: lines 227-228
		if ($a < 0) {
			#/usr/local/lib/haxe/std/haxe/Int32.hx:228: characters 11-34
			if ($b < 0) {
				#/usr/local/lib/haxe/std/haxe/Int32.hx:228: characters 19-30
				return ((((~$b << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) - ((~$a << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			} else {
				#/usr/local/lib/haxe/std/haxe/Int32.hx:228: characters 33-34
				return 1;
			}
		}
		#/usr/local/lib/haxe/std/haxe/Int32.hx:229: characters 10-30
		if ($b < 0) {
			#/usr/local/lib/haxe/std/haxe/Int32.hx:229: characters 18-20
			return -1;
		} else {
			#/usr/local/lib/haxe/std/haxe/Int32.hx:229: characters 23-30
			return (($a - $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
	}


	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function xor ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:173: characters 3-34
		return (($a ^ $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	static public function xorInt ($a, $b) {
		#/usr/local/lib/haxe/std/haxe/Int32.hx:175: characters 3-28
		return (($a ^ $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}


	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


self::$extraBits = PHP_INT_SIZE * 8 - 32;
	}
}


Boot::registerClass(Int32_Impl_::class, 'haxe._Int32.Int32_Impl_');
Int32_Impl_::__hx__init();