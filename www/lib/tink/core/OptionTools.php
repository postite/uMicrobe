<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx
 */

namespace tink\core;

use \php\_Boot\HxException;
use \php\Boot;
use \haxe\ds\Option as DsOption;
use \tink\core\_Lazy\LazyObject;

class OptionTools {
	/**
	 *  Returns `true` if the option is `Some` and the value is equal to `v`, otherwise `false`
	 * 
	 * @param DsOption $o
	 * @param mixed $v
	 * 
	 * @return bool
	 */
	static public function equals ($o, $v) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:58: characters 12-60
		if ($o->index === 0) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:58: characters 12-60
			$v1 = $o->params[0];
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:58: characters 49-59
			return Boot::equal($v1, $v);
		} else {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:58: characters 12-60
			return false;
		}
	}


	/**
	 *  Returns `Some(value)` if the option is `Some` and the filter function evaluates to `true`, otherwise `None`
	 * 
	 * @param DsOption $o
	 * @param \Closure $f
	 * 
	 * @return DsOption
	 */
	static public function filter ($o, $f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:40: lines 40-43
		if ($o->index === 0) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:41: characters 17-21
			$_hx_tmp = $f($o->params[0]);
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:41: characters 17-21
			if ($_hx_tmp === false) {
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:41: characters 33-37
				return DsOption::None();
			} else {
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:42: characters 16-17
				return $o;
			}
		} else {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:42: characters 16-17
			return $o;
		}
	}


	/**
	 *  Transforms the option value with a transform function
	 *  Different from `map`, the transform function of `flatMap` returns an `Option`
	 * 
	 * @param DsOption $o
	 * @param \Closure $f
	 * 
	 * @return DsOption
	 */
	static public function flatMap ($o, $f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:75: lines 75-78
		if ($o->index === 0) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:76: characters 17-18
			$v = $o->params[0];
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:76: characters 21-25
			return $f($v);
		} else {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:77: characters 16-20
			return DsOption::None();
		}
	}


	/**
	 *  Extracts the value if the option is `Some`, throws an `Error` otherwise
	 * 
	 * @param DsOption $o
	 * @param object $pos
	 * 
	 * @return mixed
	 */
	static public function force ($o, $pos = null) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:11: lines 11-16
		if ($o->index === 0) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:12: characters 17-18
			$v = $o->params[0];
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:13: characters 9-10
			return $v;
		} else {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:15: characters 9-14
			throw new HxException(new TypedError(404, "Some value expected but none found", $pos));
		}
	}


	/**
	 *  Creates an iterator from the option.
	 *  The iterator has one item if the option is `Some`, and no items if it is `None`
	 * 
	 * @param DsOption $o
	 * 
	 * @return OptionIter
	 */
	static public function iterator ($o) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:85: characters 5-29
		return new OptionIter($o);
	}


	/**
	 *  Transforms the option value with a transform function
	 *  Different from `flatMap`, the transform function of `map` returns a plain value
	 * 
	 * @param DsOption $o
	 * @param \Closure $f
	 * 
	 * @return DsOption
	 */
	static public function map ($o, $f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:65: lines 65-68
		if ($o->index === 0) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:66: characters 17-18
			$v = $o->params[0];
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:66: characters 21-31
			return DsOption::Some($f($v));
		} else {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:67: characters 16-20
			return DsOption::None();
		}
	}


	/**
	 *  Extracts the value if the option is `Some`, uses the fallback value otherwise
	 * 
	 * @param DsOption $o
	 * @param LazyObject $l
	 * 
	 * @return mixed
	 */
	static public function or ($o, $l) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:22: lines 22-25
		if ($o->index === 0) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:23: characters 17-18
			$v = $o->params[0];
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:23: characters 21-22
			return $v;
		} else {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:24: characters 16-23
			return $l->get();
		}
	}


	/**
	 *  Extracts the value if the option is `Some`, otherwise `null`
	 * 
	 * @param DsOption $o
	 * 
	 * @return mixed
	 */
	static public function orNull ($o) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:31: lines 31-34
		if ($o->index === 0) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:32: characters 17-18
			$v = $o->params[0];
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:32: characters 21-22
			return $v;
		} else {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:33: characters 16-20
			return null;
		}
	}


	/**
	 *  Returns `true` if the option is `Some` and the filter function evaluates to `true`, otherwise `false`
	 * 
	 * @param DsOption $o
	 * @param \Closure $f
	 * 
	 * @return bool
	 */
	static public function satisfies ($o, $f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:49: lines 49-52
		if ($o->index === 0) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:50: characters 17-18
			$v = $o->params[0];
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:50: characters 21-25
			return $f($v);
		} else {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:51: characters 16-21
			return false;
		}
	}


	/**
	 *  Creates an array from the option.
	 *  The array has one item if the option is `Some`, and no items if it is `None`
	 * 
	 * @param DsOption $o
	 * 
	 * @return \Array_hx
	 */
	static public function toArray ($o) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:92: lines 92-95
		if ($o->index === 0) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:93: characters 17-18
			$v = $o->params[0];
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:93: characters 21-24
			return \Array_hx::wrap([$v]);
		} else {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Option.hx:94: characters 16-18
			return new \Array_hx();
		}
	}
}


Boot::registerClass(OptionTools::class, 'tink.core.OptionTools');