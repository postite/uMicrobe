<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx
 */

namespace tink\core\_Future;

use \php\_Boot\HxClosure;
use \tink\core\FutureTrigger;
use \tink\core\OutcomeTools;
use \tink\core\Outcome;
use \php\Boot;
use \tink\core\_Outcome\OutcomeMapper_Impl_;
use \tink\core\MPair;
use \tink\core\_Callback\Callback_Impl_;
use \tink\core\Noise;
use \tink\core\_Lazy\LazyObject;
use \haxe\ds\Either;
use \tink\core\_Lazy\LazyConst;

final class Future_Impl_ {
	/**
	 * @var FutureObject
	 */
	static public $NEVER;
	/**
	 * @var FutureObject
	 */
	static public $NOISE;
	/**
	 * @var FutureObject
	 */
	static public $NULL;


	/**
	 * @param FutureObject $f
	 * @param \Closure $map
	 * 
	 * @return FutureObject
	 */
	static public function _flatMap ($f, $map) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:172: characters 12-26
		$ret = $f->flatMap($map);
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:172: characters 12-26
		return $ret->gather();
	}


	/**
	 * @param FutureObject $f
	 * @param \Closure $map
	 * 
	 * @return FutureObject
	 */
	static public function _map ($f, $map) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:175: characters 12-22
		$ret = $f->map($map);
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:175: characters 12-22
		return $ret->gather();
	}


	/**
	 * @param \Closure $f
	 * 
	 * @return FutureObject
	 */
	static public function _new ($f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:12: character 17
		$this1 = new SimpleFuture($f);
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:12: character 17
		return $this1;
	}


	/**
	 * @param FutureObject $f
	 * @param \Closure $map
	 * 
	 * @return FutureObject
	 */
	static public function _tryFailingFlatMap ($f, $map) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:154: lines 154-157
		$ret = $f->flatMap(function ($o)  use (&$map) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:154: lines 154-157
			switch ($o->index) {
				case 0:
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:155: characters 20-21
					$d = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:155: characters 24-30
					return $map($d);
					break;
				case 1:
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:156: characters 20-21
					$f1 = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:156: characters 24-47
					return new SyncFuture(new LazyConst(Outcome::Failure($f1)));
					break;
			}
		});
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:154: lines 154-157
		return $ret->gather();
	}


	/**
	 * @param FutureObject $f
	 * @param \Closure $map
	 * 
	 * @return FutureObject
	 */
	static public function _tryFailingMap ($f, $map) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:166: characters 12-53
		$ret = $f->map(function ($o)  use (&$map) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:166: characters 31-52
			return OutcomeTools::flatMap($o, OutcomeMapper_Impl_::withSameError($map));
		});
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:166: characters 12-53
		return $ret->gather();
	}


	/**
	 * @param FutureObject $f
	 * @param \Closure $map
	 * 
	 * @return FutureObject
	 */
	static public function _tryFlatMap ($f, $map) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:160: lines 160-163
		$ret = $f->flatMap(function ($o)  use (&$map) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:160: lines 160-163
			switch ($o->index) {
				case 0:
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:161: characters 20-21
					$d = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:161: characters 24-43
					$ret1 = $map($d)->map(new HxClosure(Outcome::class, 'Success'));
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:161: characters 24-43
					return $ret1->gather();
					break;
				case 1:
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:162: characters 20-21
					$f1 = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:162: characters 24-47
					return new SyncFuture(new LazyConst(Outcome::Failure($f1)));
					break;
			}
		});
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:160: lines 160-163
		return $ret->gather();
	}


	/**
	 * @param FutureObject $f
	 * @param \Closure $map
	 * 
	 * @return FutureObject
	 */
	static public function _tryMap ($f, $map) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:169: characters 12-49
		$ret = $f->map(function ($o)  use (&$map) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:169: characters 31-48
			return OutcomeTools::map($o, $map);
		});
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:169: characters 12-49
		return $ret->gather();
	}


	/**
	 *  Uses `Pair` to merge two futures
	 * 
	 * @param FutureObject $a
	 * @param FutureObject $b
	 * 
	 * @return FutureObject
	 */
	static public function and ($a, $b) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:151: characters 5-61
		return Future_Impl_::merge($a, $b, function ($a1, $b1) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:151: characters 46-60
			$this1 = new MPair($a1, $b1);
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:151: characters 46-60
			return $this1;
		});
	}


	/**
	 *  Casts a Surprise into a Promise
	 * 
	 * @param FutureObject $s
	 * 
	 * @return FutureObject
	 */
	static public function asPromise ($s) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:85: characters 5-13
		return $s;
	}


	/**
	 *  Creates an async future
	 *  Example: `var i = Future.async(function(cb) cb(1)); // Future<Int>`
	 * 
	 * @param \Closure $f
	 * @param bool $lazy
	 * 
	 * @return FutureObject
	 */
	static public function async ($f, $lazy = false) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:126: lines 126-133
		if ($lazy === null) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:126: lines 126-133
			$lazy = false;
		}
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:126: lines 126-133
		if ($lazy) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:127: characters 7-32
			return new LazyTrigger($f);
		} else {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:129: characters 7-26
			$op = new FutureTrigger();
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:130: characters 7-41
			$wrapped = $f;
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:131: characters 7-33
			Callback_Impl_::invoke($wrapped, new HxClosure($op, 'trigger'));
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:132: characters 7-16
			return $op;
		}
	}


	/**
	 *  Same as `first`, but use `Either` to handle the two different types
	 * 
	 * @param FutureObject $a
	 * @param FutureObject $b
	 * 
	 * @return FutureObject
	 */
	static public function either ($a, $b) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:145: characters 12-37
		$ret = $a->map(new HxClosure(Either::class, 'Left'));
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:145: characters 44-70
		$ret1 = $b->map(new HxClosure(Either::class, 'Right'));
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:145: characters 5-71
		return Future_Impl_::first($ret, $ret1);
	}


	/**
	 *  Creates a future that contains the first result from `this` or `other`
	 * 
	 * @param FutureObject $this
	 * @param FutureObject $other
	 * 
	 * @return FutureObject
	 */
	static public function first ($this1, $other) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:19: characters 5-32
		$ret = new FutureTrigger();
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:20: characters 5-39
		$l1 = $this1->handle(new HxClosure($ret, 'trigger'));
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:21: characters 5-40
		$l2 = $other->handle(new HxClosure($ret, 'trigger'));
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:22: characters 5-30
		$ret1 = $ret;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:23: lines 23-24
		if ($l1 !== null) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:24: characters 18-20
			$this2 = $l1;
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:24: characters 7-21
			$ret1->handle(function ($_)  use (&$this2) {
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:24: characters 18-20
				$this2->dissolve();
			});
		}
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:25: lines 25-26
		if ($l2 !== null) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:26: characters 18-20
			$this3 = $l2;
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:26: characters 7-21
			$ret1->handle(function ($_1)  use (&$this3) {
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:26: characters 18-20
				$this3->dissolve();
			});
		}
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:27: characters 5-15
		return $ret1;
	}


	/**
	 *  Creates a new future by applying a transform function to the result.
	 *  Different from `map`, the transform function of `flatMap` returns a `Future`
	 * 
	 * @param FutureObject $this
	 * @param \Closure $next
	 * @param bool $gather
	 * 
	 * @return FutureObject
	 */
	static public function flatMap ($this1, $next, $gather = true) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:45: lines 45-50
		if ($gather === null) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:45: lines 45-50
			$gather = true;
		}
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:46: characters 5-34
		$ret = $this1->flatMap($next);
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:48: lines 48-49
		if ($gather) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:48: characters 19-31
			return $ret->gather();
		} else {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:49: characters 12-15
			return $ret;
		}
	}


	/**
	 *  Flattens `Future<Future<A>>` into `Future<A>`
	 * 
	 * @param FutureObject $f
	 * 
	 * @return FutureObject
	 */
	static public function flatten ($f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:71: characters 5-31
		return new NestedFuture($f);
	}


	/**
	 * @param \Array_hx $futures
	 * 
	 * @return FutureObject
	 */
	static public function fromMany ($futures) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:108: characters 5-27
		return Future_Impl_::ofMany($futures);
	}


	/**
	 * @param LazyObject $l
	 * 
	 * @return FutureObject
	 */
	static public function lazy ($l) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:112: characters 5-29
		return new SyncFuture($l);
	}


	/**
	 *  Creates a new future by applying a transform function to the result.
	 *  Different from `flatMap`, the transform function of `map` returns a sync value
	 * 
	 * @param FutureObject $this
	 * @param \Closure $f
	 * @param bool $gather
	 * 
	 * @return FutureObject
	 */
	static public function map ($this1, $f, $gather = true) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:34: lines 34-39
		if ($gather === null) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:34: lines 34-39
			$gather = true;
		}
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:35: characters 5-27
		$ret = $this1->map($f);
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:37: lines 37-38
		if ($gather) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:37: characters 19-31
			return $ret->gather();
		} else {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:38: characters 12-15
			return $ret;
		}
	}


	/**
	 *  Merges two futures into one by applying the merger function on the two future values
	 * 
	 * @param FutureObject $this
	 * @param FutureObject $other
	 * @param \Closure $merger
	 * @param bool $gather
	 * 
	 * @return FutureObject
	 */
	static public function merge ($this1, $other, $merger, $gather = true) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:63: lines 63-65
		if ($gather === null) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:63: lines 63-65
			$gather = true;
		}
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:63: lines 63-65
		$ret = $this1->flatMap(function ($t)  use (&$other, &$merger) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:64: characters 14-66
			$ret1 = $other->map(function ($a)  use (&$t, &$merger) {
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:64: characters 39-58
				return $merger($t, $a);
			});
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:64: characters 14-66
			return $ret1;
		});
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:63: lines 63-65
		if ($gather) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:63: lines 63-65
			return $ret->gather();
		} else {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:63: lines 63-65
			return $ret;
		}
	}


	/**
	 *  Like `map` and `flatMap` but with a polymorphic transformer and return a `Promise`
	 *  @see `Next`
	 * 
	 * @param FutureObject $this
	 * @param \Closure $n
	 * 
	 * @return FutureObject
	 */
	static public function next ($this1, $n) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:57: characters 5-50
		return $this1->flatMap(function ($v)  use (&$n) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:57: characters 38-49
			return $n($v);
		});
	}


	/**
	 *  Merges multiple futures into Future<Array<A>>
	 * 
	 * @param \Array_hx $futures
	 * @param bool $gather
	 * 
	 * @return FutureObject
	 */
	static public function ofMany ($futures, $gather = true) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:90: lines 90-105
		if ($gather === null) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:90: lines 90-105
			$gather = true;
		}
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:91: characters 5-24
		$ret = new SyncFuture(new LazyConst(new \Array_hx()));
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:92: lines 92-101
		$_g = 0;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:92: lines 92-101
		while ($_g < $futures->length) {
			unset($f);
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:92: characters 10-11
			$f = ($futures->arr[$_g] ?? null);
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:92: lines 92-101
			$_g = $_g + 1;
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:93: lines 93-101
			$ret1 = $ret->flatMap(function ($results)  use (&$f) {
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:95: lines 95-99
				$ret2 = $f->map(function ($result)  use (&$results) {
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:97: characters 15-46
					return $results->concat(\Array_hx::wrap([$result]));
				});
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:95: lines 95-99
				return $ret2;
			});
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:93: lines 93-101
			$ret = $ret1;
		}

		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:103: lines 103-104
		if ($gather) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:103: characters 19-31
			return $ret->gather();
		} else {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:104: characters 12-15
			return $ret;
		}
	}


	/**
	 *  Same as `first`
	 * 
	 * @param FutureObject $a
	 * @param FutureObject $b
	 * 
	 * @return FutureObject
	 */
	static public function or ($a, $b) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:139: characters 5-22
		return Future_Impl_::first($a, $b);
	}


	/**
	 *  Creates a sync future.
	 *  Example: `var i = Future.sync(1); // Future<Int>`
	 * 
	 * @param mixed $v
	 * 
	 * @return FutureObject
	 */
	static public function sync ($v) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:119: characters 5-29
		return new SyncFuture(new LazyConst($v));
	}


	/**
	 *  Creates a new `FutureTrigger`
	 * 
	 * @return FutureTrigger
	 */
	static public function trigger () {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Future.hx:181: characters 5-31
		return new FutureTrigger();
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


self::$NULL = new SyncFuture(new LazyConst(null));
self::$NOISE = new SyncFuture(new LazyConst(Noise::Noise()));
self::$NEVER = NeverFuture::$inst;
	}
}


Boot::registerClass(Future_Impl_::class, 'tink.core._Future.Future_Impl_');
Future_Impl_::__hx__init();
