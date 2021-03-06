<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx
 */

namespace tink\streams\_Stream;

use \tink\core\Outcome;
use \tink\streams\StreamStep;
use \php\Boot;
use \tink\streams\IteratorStream;
use \tink\core\TypedError;
use \tink\core\_Future\FutureObject;
use \tink\streams\ConcatStream;
use \tink\core\_Future\SyncFuture;
use \tink\streams\Generator;
use \tink\core\_Future\Future_Impl_;
use \tink\streams\StreamObject;
use \tink\core\_Lazy\LazyConst;

final class Stream_Impl_ {
	/**
	 * @param StreamObject $this
	 * 
	 * @return FutureObject
	 */
	static public function collect ($this1) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:47: characters 5-18
		$ret = new \Array_hx();
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:48: lines 48-52
		return Future_Impl_::_tryMap($this1->forEach(function ($x)  use (&$ret) {
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:49: characters 7-18
			$ret->arr[$ret->length] = $x;
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:49: characters 7-18
			++$ret->length;

			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:50: characters 7-18
			return true;
		}), function ($_)  use (&$ret) {
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:52: characters 19-29
			return $ret;
		});
	}


	/**
	 * @param StreamObject $a
	 * @param StreamObject $b
	 * 
	 * @return StreamObject
	 */
	static public function concat ($a, $b) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:56: characters 5-37
		return ConcatStream::make(\Array_hx::wrap([
			$a,
			$b,
		]));
	}


	/**
	 * @param TypedError $e
	 * 
	 * @return StreamObject
	 */
	static public function failure ($e) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:16: characters 5-61
		return Stream_Impl_::generate(function ()  use (&$e) {
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:16: characters 40-60
			return new SyncFuture(new LazyConst(StreamStep::Fail($e)));
		});
	}


	/**
	 * @param StreamObject $this
	 * @param mixed $start
	 * @param \Closure $reduce
	 * 
	 * @return FutureObject
	 */
	static public function fold ($this1, $start, $reduce) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:22: lines 22-32
		return Future_Impl_::async(function ($cb)  use (&$reduce, &$start, &$this1) {
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:23: lines 23-31
			$this1->forEach(function ($x)  use (&$reduce, &$start) {
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:24: characters 9-33
				$start = $reduce($start, $x);
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:25: characters 9-20
				return true;
			})->handle(function ($o)  use (&$start, &$cb) {
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:26: lines 26-31
				$tmp = null;
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:26: lines 26-31
				if ($o->index === 1) {
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:27: characters 22-23
					$e = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:26: lines 26-31
					$tmp = Outcome::Failure($e);
				} else {
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:26: lines 26-31
					$tmp = Outcome::Success($start);
				}
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:26: lines 26-31
				$cb($tmp);
			});
		});
	}


	/**
	 * @param StreamObject $this
	 * @param mixed $start
	 * @param \Closure $reduce
	 * 
	 * @return FutureObject
	 */
	static public function foldAsync ($this1, $start, $reduce) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:35: lines 35-44
		return Future_Impl_::async(function ($cb)  use (&$reduce, &$start, &$this1) {
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:36: lines 36-43
			$this1->forEachAsync(function ($x)  use (&$reduce, &$start) {
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:37: characters 16-78
				$ret = $reduce($start, $x)->map(function ($v)  use (&$start) {
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:37: characters 52-61
					$start = $v;
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:37: characters 63-74
					return true;
				});
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:37: characters 16-78
				return $ret->gather();
			})->handle(function ($o)  use (&$start, &$cb) {
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:38: lines 38-43
				$tmp = null;
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:38: lines 38-43
				if ($o->index === 1) {
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:39: characters 22-23
					$e = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:38: lines 38-43
					$tmp = Outcome::Failure($e);
				} else {
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:38: lines 38-43
					$tmp = Outcome::Success($start);
				}
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:38: lines 38-43
				$cb($tmp);
			});
		});
	}


	/**
	 * @param \Closure $step
	 * 
	 * @return StreamObject
	 */
	static public function generate ($step) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:19: characters 5-31
		return new Generator($step);
	}


	/**
	 * @param FutureObject $f
	 * 
	 * @return StreamObject
	 */
	static public function later ($f) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:10: characters 5-31
		return new FutureStream($f);
	}


	/**
	 * @param object $i
	 * 
	 * @return StreamObject
	 */
	static public function ofIterator ($i) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:13: characters 5-33
		return new IteratorStream($i);
	}
}


Boot::registerClass(Stream_Impl_::class, 'tink.streams._Stream.Stream_Impl_');
