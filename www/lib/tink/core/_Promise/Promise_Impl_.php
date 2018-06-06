<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx
 */

namespace tink\core\_Promise;

use \php\_Boot\HxClosure;
use \tink\core\OutcomeTools;
use \tink\core\Outcome;
use \php\Boot;
use \tink\core\TypedError;
use \tink\core\_Future\FutureObject;
use \tink\core\_Future\SyncFuture;
use \tink\core\MPair;
use \tink\core\_Future\Future_Impl_;
use \tink\core\Noise;
use \tink\core\_Lazy\LazyObject;
use \tink\core\_Callback\CallbackLink_Impl_;
use \tink\core\_Callback\LinkObject;
use \tink\core\_Lazy\LazyConst;

final class Promise_Impl_ {
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
	 * @param FutureObject $a
	 * @param FutureObject $b
	 * 
	 * @return FutureObject
	 */
	static public function and ($a, $b) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:63: characters 5-61
		return Promise_Impl_::merge($a, $b, function ($a1, $b1) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:63: characters 46-60
			$this1 = new MPair($a1, $b1);
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:63: characters 39-60
			return Promise_Impl_::ofOutcome(Outcome::Success($this1));
		});
	}


	/**
	 * @param \Closure $gen
	 * 
	 * @return \Closure
	 */
	static public function cache ($gen) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:167: characters 5-18
		$p = null;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:168: lines 168-185
		return function ()  use (&$gen, &$p) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:169: characters 7-19
			$ret = $p;
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:170: lines 170-180
			if ($ret === null) {
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:171: characters 9-26
				$sync = false;
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:172: lines 172-178
				$ret = Promise_Impl_::next($gen(), function ($o)  use (&$sync, &$p) {
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:173: lines 173-176
					$o->b->handle(function ($_)  use (&$sync, &$p) {
						#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:174: characters 13-24
						$sync = true;
						#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:175: characters 13-21
						$p = null;
					});
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:177: characters 11-21
					return Promise_Impl_::ofOutcome(Outcome::Success($o->a));
				});
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:179: characters 9-26
				if (!$sync) {
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:179: characters 19-26
					$p = $ret;
				}
			}
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:181: lines 181-184
			$ret1 = $ret->map(function ($o1)  use (&$p) {
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:182: characters 9-36
				if (!OutcomeTools::isSuccess($o1)) {
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:182: characters 28-36
					$p = null;
				}
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:183: characters 9-17
				return $o1;
			});
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:181: lines 181-184
			return $ret1->gather();
		};
	}


	/**
	 * @param FutureObject $this
	 * 
	 * @return FutureObject
	 */
	static public function eager ($this1) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:12: characters 5-24
		return $this1->eager();
	}


	/**
	 * @param FutureObject $this
	 * @param \Closure $f
	 * 
	 * @return FutureObject
	 */
	static public function flatMap ($this1, $f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:18: characters 12-27
		$ret = $this1->flatMap($f);
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:18: characters 12-27
		return $ret->gather();
	}


	/**
	 * @param FutureObject $this
	 * @param \Closure $cb
	 * 
	 * @return LinkObject
	 */
	static public function handle ($this1, $cb) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:39: characters 5-27
		return $this1->handle($cb);
	}


	/**
	 * @param \Array_hx $a
	 * @param bool $lazy
	 * 
	 * @return FutureObject
	 */
	static public function inParallel ($a, $lazy = null) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:113: lines 113-149
		if ($a->length === 0) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:113: characters 25-49
			return new SyncFuture(new LazyConst(Outcome::Success(new \Array_hx())));
		} else {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:114: lines 114-149
			return Future_Impl_::async(function ($cb)  use (&$a) {
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:115: lines 115-118
				$result = new \Array_hx();
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:115: lines 115-118
				$pending = $a->length;
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:115: lines 115-118
				$links = null;
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:115: lines 115-118
				$sync = false;
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:120: lines 120-124
				$done = function ($o)  use (&$sync, &$links, &$cb) {
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:121: lines 121-122
					if ($links === null) {
						#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:121: characters 30-41
						$sync = true;
					} else if ($links !== null) {
						#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:122: characters 16-32
						$links->dissolve();
					}
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:123: characters 11-16
					$cb($o);
				};
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:126: lines 126-128
				$fail = function ($e)  use (&$done) {
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:127: characters 11-27
					$done(Outcome::Failure($e));
				};
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:129: lines 129-133
				$set = function ($index, $value)  use (&$pending, &$result, &$done) {
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:130: characters 11-32
					$result[$index] = $value;
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:131: characters 15-24
					$pending = $pending - 1;
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:131: lines 131-132
					if ($pending === 0) {
						#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:132: characters 13-34
						$done(Outcome::Success($result));
					}
				};
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:135: characters 9-28
				$linkArray = new \Array_hx();
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:137: lines 137-143
				$_g1 = 0;
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:137: lines 137-143
				$_g = $a->length;
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:137: lines 137-143
				while ($_g1 < $_g) {
					unset($i);
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:137: lines 137-143
					$_g1 = $_g1 + 1;
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:137: characters 14-15
					$i = $_g1 - 1;
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:138: characters 11-26
					if ($sync) {
						#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:138: characters 21-26
						break;
					}
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:139: lines 139-142
					$x = ($a->arr[$i] ?? null)->handle(function ($o1)  use (&$set, &$fail, &$i) {
						#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:139: lines 139-142
						switch ($o1->index) {
							case 0:
								#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:140: characters 26-27
								$v = $o1->params[0];
								#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:140: characters 30-39
								$set($i, $v);
								break;
							case 1:
								#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:141: characters 26-27
								$e1 = $o1->params[0];
								#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:141: characters 30-37
								$fail($e1);
								break;
						}
					});
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:139: lines 139-142
					$linkArray->arr[$linkArray->length] = $x;
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:139: lines 139-142
					++$linkArray->length;

				}

				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:145: characters 9-26
				$links = CallbackLink_Impl_::fromMany($linkArray);
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:147: lines 147-148
				if ($sync) {
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:148: characters 11-27
					if ($links !== null) {
						#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:148: characters 11-27
						$links->dissolve();
					}
				}
			}, $lazy);
		}
	}


	/**
	 * @param \Array_hx $a
	 * 
	 * @return FutureObject
	 */
	static public function inSequence ($a) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:153: lines 153-161
		$loop = null;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:153: lines 153-161
		$loop = function ($index)  use (&$loop, &$a) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:155: lines 155-161
			if ($index === $a->length) {
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:155: characters 32-34
				return Promise_Impl_::ofOutcome(Outcome::Success(new \Array_hx()));
			} else {
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:157: lines 157-161
				return Promise_Impl_::next(($a->arr[$index] ?? null), function ($head)  use (&$index, &$loop) {
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:158: lines 158-160
					return Promise_Impl_::next($loop($index + 1), function ($tail)  use (&$head) {
						#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:159: characters 31-57
						return Promise_Impl_::ofOutcome(Outcome::Success((\Array_hx::wrap([$head]))->concat($tail)));
					});
				});
			}
		};
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:153: lines 153-161
		$loop1 = $loop;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:163: characters 5-19
		return $loop1(0);
	}


	/**
	 * @param FutureObject $this
	 * 
	 * @return FutureObject
	 */
	static public function isSuccess ($this1) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:45: characters 12-55
		$ret = $this1->map(function ($o) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:45: characters 34-54
			return OutcomeTools::isSuccess($o);
		});
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:45: characters 12-55
		return $ret->gather();
	}


	/**
	 * @param object $promises
	 * @param \Closure $yield
	 * @param FutureObject $finally
	 * @param bool $lazy
	 * 
	 * @return FutureObject
	 */
	static public function iterate ($promises, $yield, $finally, $lazy = null) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:67: lines 67-85
		return Future_Impl_::async(function ($cb)  use (&$yield, &$finally, &$promises) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:68: characters 7-38
			$iter = $promises->iterator();
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:69: lines 69-83
			$next = null;
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:69: lines 69-83
			$next = function ()  use (&$yield, &$next, &$iter, &$finally, &$cb) {
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:70: lines 70-82
				if ($iter->hasNext()) {
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:71: lines 71-80
					$iter->next()->handle(function ($o)  use (&$yield, &$next, &$cb) {
						#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:71: lines 71-80
						switch ($o->index) {
							case 0:
								#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:72: characters 26-27
								$v = $o->params[0];
								#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:73: lines 73-77
								$yield($v)->handle(function ($o1)  use (&$next, &$cb) {
									#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:73: lines 73-77
									switch ($o1->index) {
										case 0:
											#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:73: characters 50-51
											switch ($o1->params[0]->index) {
												case 0:
													#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:74: characters 35-38
													$ret = $o1->params[0]->params[0];
													#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:74: characters 42-58
													$cb(Outcome::Success($ret));
													break;
												case 1:
													#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:75: characters 37-43
													$next();
													break;
											}
											break;
										case 1:
											#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:76: characters 30-31
											$e = $o1->params[0];
											#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:76: characters 34-48
											$cb(Outcome::Failure($e));
											break;
									}
								});
								break;
							case 1:
								#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:78: characters 26-27
								$e1 = $o->params[0];
								#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:79: characters 15-29
								$cb(Outcome::Failure($e1));
								break;
						}
					});
				} else {
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:82: characters 11-29
					$finally->handle($cb);
				}
			};
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:69: lines 69-83
			$next1 = $next;
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:84: characters 7-13
			$next1();
		}, $lazy);
	}


	/**
	 * @param LazyObject $p
	 * 
	 * @return FutureObject
	 */
	static public function lazy ($p) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:109: characters 5-63
		return Future_Impl_::async(function ($cb)  use (&$p) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:109: characters 38-56
			$p->get()->handle($cb);
		}, true);
	}


	/**
	 * @param FutureObject $p
	 * 
	 * @return FutureObject
	 */
	static public function lift ($p) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:190: characters 5-13
		return $p;
	}


	/**
	 * @param FutureObject $this
	 * @param \Closure $f
	 * 
	 * @return FutureObject
	 */
	static public function map ($this1, $f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:15: characters 12-23
		$ret = $this1->map($f);
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:15: characters 12-23
		return $ret->gather();
	}


	/**
	 * @param FutureObject $this
	 * @param \Closure $f
	 * 
	 * @return FutureObject
	 */
	static public function mapError ($this1, $f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:33: lines 33-36
		$ret = $this1->map(function ($o)  use (&$f) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:33: lines 33-36
			switch ($o->index) {
				case 0:
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:34: characters 24-25
					return $o;
					break;
				case 1:
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:35: characters 20-21
					$e = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:35: characters 24-37
					return Outcome::Failure($f($e));
					break;
			}
		});
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:33: lines 33-36
		return $ret->gather();
	}


	/**
	 * @param FutureObject $this
	 * @param FutureObject $other
	 * @param \Closure $merger
	 * @param bool $gather
	 * 
	 * @return FutureObject
	 */
	static public function merge ($this1, $other, $merger, $gather = true) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:60: characters 5-97
		if ($gather === null) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:60: characters 5-97
			$gather = true;
		}
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:60: characters 5-97
		return Promise_Impl_::next($this1, function ($t)  use (&$other, &$merger) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:60: characters 30-88
			return Promise_Impl_::next($other, function ($a)  use (&$t, &$merger) {
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:60: characters 61-80
				return $merger($t, $a);
			}, false);
		}, $gather);
	}


	/**
	 * @param FutureObject $this
	 * @param \Closure $f
	 * @param bool $gather
	 * 
	 * @return FutureObject
	 */
	static public function next ($this1, $f, $gather = true) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:48: lines 48-51
		if ($gather === null) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:48: lines 48-51
			$gather = true;
		}
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:48: lines 48-51
		$ret = $this1->flatMap(function ($o)  use (&$f) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:48: lines 48-51
			switch ($o->index) {
				case 0:
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:49: characters 22-23
					$d = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:49: characters 26-30
					return $f($d);
					break;
				case 1:
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:50: characters 22-23
					$f1 = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:50: characters 26-49
					return new SyncFuture(new LazyConst(Outcome::Failure($f1)));
					break;
			}
		});
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:48: lines 48-51
		if ($gather) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:48: lines 48-51
			return $ret->gather();
		} else {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:48: lines 48-51
			return $ret;
		}
	}


	/**
	 * @param FutureObject $this
	 * 
	 * @return FutureObject
	 */
	static public function noise ($this1) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:42: characters 5-61
		return Promise_Impl_::next($this1, function ($v) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:42: characters 48-60
			return Promise_Impl_::ofOutcome(Outcome::Success(Noise::Noise()));
		});
	}


	/**
	 * @param mixed $d
	 * 
	 * @return FutureObject
	 */
	static public function ofData ($d) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:106: characters 5-33
		return Promise_Impl_::ofOutcome(Outcome::Success($d));
	}


	/**
	 * @param TypedError $e
	 * 
	 * @return FutureObject
	 */
	static public function ofError ($e) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:103: characters 5-33
		return Promise_Impl_::ofOutcome(Outcome::Failure($e));
	}


	/**
	 * @param FutureObject $f
	 * 
	 * @return FutureObject
	 */
	static public function ofFuture ($f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:97: characters 12-26
		$ret = $f->map(new HxClosure(Outcome::class, 'Success'));
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:97: characters 12-26
		return $ret->gather();
	}


	/**
	 * @param Outcome $o
	 * 
	 * @return FutureObject
	 */
	static public function ofOutcome ($o) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:100: characters 5-26
		return new SyncFuture(new LazyConst($o));
	}


	/**
	 * @param FutureObject $s
	 * 
	 * @return FutureObject
	 */
	static public function ofSpecific ($s) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:94: characters 5-36
		return $s;
	}


	/**
	 * @param FutureObject $this
	 * @param \Closure $f
	 * 
	 * @return FutureObject
	 */
	static public function recover ($this1, $f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:27: lines 27-30
		$ret = $this1->flatMap(function ($o)  use (&$f) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:27: lines 27-30
			switch ($o->index) {
				case 0:
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:28: characters 20-21
					$d = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:28: characters 24-38
					return new SyncFuture(new LazyConst($d));
					break;
				case 1:
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:29: characters 20-21
					$e = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:29: characters 24-28
					return $f($e);
					break;
			}
		});
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:27: lines 27-30
		return $ret->gather();
	}


	/**
	 * @param FutureObject $this
	 * @param mixed $v
	 * 
	 * @return FutureObject
	 */
	static public function swap ($this1, $v) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:54: characters 5-40
		return Future_Impl_::_tryMap($this1, function ($_)  use (&$v) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:54: characters 32-40
			return $v;
		});
	}


	/**
	 * @param FutureObject $this
	 * @param TypedError $e
	 * 
	 * @return FutureObject
	 */
	static public function swapError ($this1, $e) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:57: characters 5-42
		return Promise_Impl_::mapError($this1, function ($_)  use (&$e) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:57: characters 33-41
			return $e;
		});
	}


	/**
	 * @param FutureObject $this
	 * @param \Closure $f
	 * 
	 * @return FutureObject
	 */
	static public function tryRecover ($this1, $f) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:21: lines 21-24
		$ret = $this1->flatMap(function ($o)  use (&$f) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:21: lines 21-24
			switch ($o->index) {
				case 0:
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:22: characters 20-21
					$d = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:22: characters 24-38
					return new SyncFuture(new LazyConst($o));
					break;
				case 1:
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:23: characters 20-21
					$e = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:23: characters 24-28
					return $f($e);
					break;
			}
		});
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Promise.hx:21: lines 21-24
		return $ret->gather();
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


self::$NULL = new SyncFuture(new LazyConst(Outcome::Success(null)));
self::$NOISE = new SyncFuture(new LazyConst(Outcome::Success(Noise::Noise())));
$ret = Future_Impl_::$NEVER->map(new HxClosure(Outcome::class, 'Success'));
self::$NEVER = $ret->gather();
	}
}


Boot::registerClass(Promise_Impl_::class, 'tink.core._Promise.Promise_Impl_');
Promise_Impl_::__hx__init();
