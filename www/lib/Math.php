<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/php/_std/Math.hx
 */

use \php\Boot;

/**
 * This class defines mathematical functions and constants.
 * @see https://haxe.org/manual/std-math.html
 */
class Math {
	/**
	 * @var float
	 * A special `Float` constant which denotes negative infinity.
	 * For example, this is the result of -1.0 / 0.0.
	 * Operations with `NEGATIVE_INFINITY` as an operand may result in
	 * `NEGATIVE_INFINITY`, `POSITIVE_INFINITY` or `NaN`.
	 * If this constant is converted to an `Int`, e.g. through `Std.int()`, the
	 * result is unspecified.
	 */
	static public $NEGATIVE_INFINITY;
	/**
	 * @var float
	 * A special `Float` constant which denotes an invalid number.
	 * NaN stands for "Not a Number". It occurs when a mathematically incorrect
	 * operation is executed, such as taking the square root of a negative
	 * number: Math.sqrt(-1).
	 * All further operations with `NaN` as an operand will result in `NaN`.
	 * If this constant is converted to an `Int`, e.g. through `Std.int()`, the
	 * result is unspecified.
	 * In order to test if a value is `NaN`, you should use `Math.isNaN()` function.
	 */
	static public $NaN;
	/**
	 * @var float
	 * Represents the ratio of the circumference of a circle to its diameter,
	 * specified by the constant, π. `PI` is approximately 3.141592653589793.
	 */
	static public $PI;
	/**
	 * @var float
	 * A special `Float` constant which denotes positive infinity.
	 * For example, this is the result of 1.0 / 0.0.
	 * Operations with `POSITIVE_INFINITY` as an operand may result in
	 * `NEGATIVE_INFINITY`, `POSITIVE_INFINITY` or `NaN`.
	 * If this constant is converted to an `Int`, e.g. through `Std.int()`, the
	 * result is unspecified.
	 */
	static public $POSITIVE_INFINITY;


	/**
	 * Returns the absolute value of `v`.
	 * If `v` is positive or 0, the result is unchanged. Otherwise the result
	 * is -`v`.
	 * If `v` is `NEGATIVE_INFINITY` or `POSITIVE_INFINITY`, the result is
	 * `POSITIVE_INFINITY`.
	 * If `v` is `NaN`, the result is `NaN`.
	 * 
	 * @param float $v
	 * 
	 * @return float
	 */
	static public function abs ($v) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:33: characters 55-75
		return abs($v);
	}


	/**
	 * Returns the trigonometric arc cosine of the specified angle `v`,
	 * in radians.
	 * If `v` is `NaN` or infinite, the result is `NaN`.
	 * 
	 * @param float $v
	 * 
	 * @return float
	 */
	static public function acos ($v) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:48: characters 56-77
		return acos($v);
	}


	/**
	 * Returns the trigonometric arc of the specified angle `v`, in radians.
	 * If `v` is `NaN` or infinite, the result is `NaN`.
	 * 
	 * @param float $v
	 * 
	 * @return float
	 */
	static public function asin ($v) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:47: characters 56-77
		return asin($v);
	}


	/**
	 * Returns the trigonometric arc tangent of the specified angle `v`,
	 * in radians.
	 * If `v` is `NaN` or infinite, the result is `NaN`.
	 * 
	 * @param float $v
	 * 
	 * @return float
	 */
	static public function atan ($v) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:46: characters 56-77
		return atan($v);
	}


	/**
	 * Returns the trigonometric arc tangent whose tangent is the quotient of
	 * two specified numbers, in radians.
	 * If parameter `x` or `y`  is `NaN`, `NEGATIVE_INFINITY` or `POSITIVE_INFINITY`,
	 * the result is `NaN`.
	 * 
	 * @param float $y
	 * @param float $x
	 * 
	 * @return float
	 */
	static public function atan2 ($y, $x) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:38: characters 66-91
		return atan2($y, $x);
	}


	/**
	 * Returns the smallest integer value that is not less than `v`.
	 * If `v` is outside of the signed `Int32` range, or is `NaN`, `NEGATIVE_INFINITY`
	 * or `POSITIVE_INFINITY`, the result is unspecified.
	 * 
	 * @param float $v
	 * 
	 * @return int
	 */
	static public function ceil ($v) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:45: characters 61-87
		return (int)(ceil($v));
	}


	/**
	 * Returns the trigonometric cosine of the specified angle `v`, in radians.
	 * If `v` is `NaN` or infinite, the result is `NaN`.
	 * 
	 * @param float $v
	 * 
	 * @return float
	 */
	static public function cos ($v) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:37: characters 55-75
		return cos($v);
	}


	/**
	 * Returns Euler's number, raised to the power of `v`.
	 * exp(1.0) is approximately 2.718281828459.
	 * If `v` is `POSITIVE_INFINITY`, the result is `POSITIVE_INFINITY`.
	 * If `v` is `NEGATIVE_INFINITY`, the result is `0.0`.
	 * If `v` is `NaN`, the result is `NaN`.
	 * 
	 * @param float $v
	 * 
	 * @return float
	 */
	static public function exp ($v) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:40: characters 55-75
		return exp($v);
	}


	/**
	 * @param float $v
	 * 
	 * @return float
	 */
	static public function fceil ($v) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:56: characters 57-78
		return ceil($v);
	}


	/**
	 * @param float $v
	 * 
	 * @return float
	 */
	static public function ffloor ($v) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:55: characters 58-80
		return floor($v);
	}


	/**
	 * Returns the largest integer value that is not greater than `v`.
	 * If `v` is outside of the signed `Int32` range, or is `NaN`, `NEGATIVE_INFINITY`
	 * or `POSITIVE_INFINITY`, the result is unspecified.
	 * 
	 * @param float $v
	 * 
	 * @return int
	 */
	static public function floor ($v) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:44: characters 62-89
		return (int)(floor($v));
	}


	/**
	 * @param float $v
	 * 
	 * @return float
	 */
	static public function fround ($v) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:54: characters 58-86
		return floor($v + 0.5);
	}


	/**
	 * Tells if `f` is a finite number.
	 * If `f` is `POSITIVE_INFINITY`, `NEGATIVE_INFINITY` or `NaN`, the result
	 * is `false`, otherwise the result is `true`.
	 * 
	 * @param float $f
	 * 
	 * @return bool
	 */
	static public function isFinite ($f) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:52: characters 59-85
		return is_finite($f);
	}


	/**
	 * Tells if `f` is not a valid number.
	 * If `f` is `NaN`, the result is `true`, otherwise the result is `false`.
	 * In particular, both `POSITIVE_INFINITY` and `NEGATIVE_INFINITY` are
	 * not considered `NaN`.
	 * 
	 * @param float $f
	 * 
	 * @return bool
	 */
	static public function isNaN ($f) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:51: characters 56-79
		return is_nan($f);
	}


	/**
	 * Returns the natural logarithm of `v`.
	 * This is the mathematical inverse operation of exp,
	 * i.e. `log(exp(v)) == v` always holds.
	 * If `v` is negative (including `NEGATIVE_INFINITY`) or `NaN`, the result
	 * is `NaN`.
	 * If `v` is `POSITIVE_INFINITY`, the result is `POSITIVE_INFINITY`.
	 * If `v` is `0.0`, the result is `NEGATIVE_INFINITY`.
	 * 
	 * @param float $v
	 * 
	 * @return float
	 */
	static public function log ($v) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:41: characters 55-75
		return log($v);
	}


	/**
	 * Returns the greater of values `a` and `b`.
	 * If `a` or `b` are `NaN`, the result is `NaN`.
	 * If `a` or `b` are `POSITIVE_INFINITY`, the result is `POSITIVE_INFINITY`.
	 * If `a` and `b` are `NEGATIVE_INFINITY`, the result is `NEGATIVE_INFINITY`.
	 * 
	 * @param float $a
	 * @param float $b
	 * 
	 * @return float
	 */
	static public function max ($a, $b) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:35: characters 71-116
		if (is_nan($a) || is_nan($b)) {
			#/usr/local/lib/haxe/std/php/_std/Math.hx:35: characters 94-97
			return Math::$NaN;
		} else {
			#/usr/local/lib/haxe/std/php/_std/Math.hx:35: characters 100-116
			return max($a, $b);
		}
	}


	/**
	 * Returns the smaller of values `a` and `b`.
	 * If `a` or `b` are `NaN`, the result is `NaN`.
	 * If `a` or `b` are `NEGATIVE_INFINITY`, the result is `NEGATIVE_INFINITY`.
	 * If `a` and `b` are `POSITIVE_INFINITY`, the result is `POSITIVE_INFINITY`.
	 * 
	 * @param float $a
	 * @param float $b
	 * 
	 * @return float
	 */
	static public function min ($a, $b) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:34: characters 71-116
		if (is_nan($a) || is_nan($b)) {
			#/usr/local/lib/haxe/std/php/_std/Math.hx:34: characters 94-97
			return Math::$NaN;
		} else {
			#/usr/local/lib/haxe/std/php/_std/Math.hx:34: characters 100-116
			return min($a, $b);
		}
	}


	/**
	 * Returns a specified base `v` raised to the specified power `exp`.
	 * 
	 * @param float $v
	 * @param float $exp
	 * 
	 * @return float
	 */
	static public function pow ($v, $exp) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:49: characters 66-91
		return ($v ** $exp);
	}


	/**
	 * Returns a pseudo-random number which is greater than or equal to 0.0,
	 * and less than 1.0.
	 * 
	 * @return float
	 */
	static public function random () {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:50: characters 49-97
		return mt_rand() / mt_getrandmax();
	}


	/**
	 * Rounds `v` to the nearest integer value.
	 * Ties are rounded up, so that `0.5` becomes `1` and `-0.5` becomes `0`.
	 * If `v` is outside of the signed `Int32` range, or is `NaN`, `NEGATIVE_INFINITY`
	 * or `POSITIVE_INFINITY`, the result is unspecified.
	 * 
	 * @param float $v
	 * 
	 * @return int
	 */
	static public function round ($v) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:43: characters 62-95
		return (int)(floor($v + 0.5));
	}


	/**
	 * Returns the trigonometric sine of the specified angle `v`, in radians.
	 * If `v` is `NaN` or infinite, the result is `NaN`.
	 * 
	 * @param float $v
	 * 
	 * @return float
	 */
	static public function sin ($v) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:36: characters 55-75
		return sin($v);
	}


	/**
	 * Returns the square root of `v`.
	 * If `v` is negative (including `NEGATIVE_INFINITY`) or `NaN`, the result
	 * is `NaN`.
	 * If `v` is `POSITIVE_INFINITY`, the result is `POSITIVE_INFINITY`.
	 * If `v` is `0.0`, the result is `0.0`.
	 * 
	 * @param float $v
	 * 
	 * @return float
	 */
	static public function sqrt ($v) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:42: characters 56-77
		return sqrt($v);
	}


	/**
	 * Returns the trigonometric tangent of the specified angle `v`, in radians.
	 * If `v` is `NaN` or infinite, the result is `NaN`.
	 * 
	 * @param float $v
	 * 
	 * @return float
	 */
	static public function tan ($v) {
		#/usr/local/lib/haxe/std/php/_std/Math.hx:39: characters 55-75
		return tan($v);
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


self::$PI = M_PI;
self::$NaN = NAN;
self::$POSITIVE_INFINITY = INF;
self::$NEGATIVE_INFINITY = -INF;
	}
}


Boot::registerClass(Math::class, 'Math');
Math::__hx__init();
