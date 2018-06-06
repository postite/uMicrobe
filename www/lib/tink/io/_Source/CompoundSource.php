<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx
 */

namespace tink\io\_Source;

use \tink\core\Outcome;
use \php\Boot;
use \tink\io\SinkObject;
use \tink\core\TypedError;
use \tink\core\_Future\FutureObject;
use \tink\core\_Future\SyncFuture;
use \tink\io\SourceBase;
use \tink\core\_Future\Future_Impl_;
use \tink\io\PipeResult;
use \tink\io\Buffer;
use \tink\core\Noise;
use \tink\io\SourceObject;
use \php\_Boot\HxAnon;
use \tink\core\_Lazy\LazyConst;

class CompoundSource extends SourceBase {
	/**
	 * @var \Array_hx
	 */
	public $parts;


	/**
	 * @param SourceObject $a
	 * @param SourceObject $b
	 * 
	 * @return CompoundSource
	 */
	static public function of ($a, $b) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:462: characters 48-79
		$_g = (($b instanceof CompoundSource) ? $b : null);
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:462: characters 15-46
		$_g1 = (($a instanceof CompoundSource) ? $a : null);
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:462: lines 462-471
		$tmp = null;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:463: lines 463-470
		if ($_g1 === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:463: lines 463-466
			if ($_g === null) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:462: lines 462-471
				$tmp = \Array_hx::wrap([
					$a,
					$b,
				]);
			} else {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:465: characters 30-31
				$p = $_g->parts;
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:462: lines 462-471
				$tmp = (\Array_hx::wrap([$a]))->concat($p);
			}
		} else if ($_g === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:467: characters 24-25
			$p1 = $_g1->parts;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:462: lines 462-471
			$tmp = $p1->concat(\Array_hx::wrap([$b]));
		} else {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:469: characters 24-26
			$p11 = $_g1->parts;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:469: characters 39-41
			$p2 = $_g->parts;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:462: lines 462-471
			$tmp = $p11->concat($p2);
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:461: lines 461-472
		return new CompoundSource($tmp);
	}


	/**
	 * @param \Array_hx $parts
	 * 
	 * @return void
	 */
	public function __construct ($parts) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:399: characters 5-23
		$this->parts = $parts;
	}


	/**
	 * @return FutureObject
	 */
	public function close () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:420: characters 5-62
		if ($this->parts->length === 0) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:420: characters 35-62
			return new SyncFuture(new LazyConst(Outcome::Success(Noise::Noise())));
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:421: lines 421-424
		$_g = new \Array_hx();
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:422: lines 422-423
		$_g1 = 0;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:422: lines 422-423
		$_g2 = $this->parts;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:422: lines 422-423
		while ($_g1 < $_g2->length) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:422: characters 12-13
			$p = ($_g2->arr[$_g1] ?? null);
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:422: lines 422-423
			$_g1 = $_g1 + 1;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:423: characters 9-18
			$x = $p->close();
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:423: characters 9-18
			$_g->arr[$_g->length] = $x;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:423: characters 9-18
			++$_g->length;

		}

		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:421: lines 421-424
		$ret = Future_Impl_::ofMany($_g);
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:425: characters 5-15
		$this->parts = new \Array_hx();
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:426: lines 426-441
		$ret1 = $ret->map(function ($outcomes) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:427: characters 7-25
			$failures = new \Array_hx();
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:428: lines 428-433
			$_g11 = 0;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:428: lines 428-433
			while ($_g11 < $outcomes->length) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:428: characters 12-13
				$o = ($outcomes->arr[$_g11] ?? null);
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:428: lines 428-433
				$_g11 = $_g11 + 1;
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:429: lines 429-433
				if ($o->index === 1) {
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:430: characters 24-25
					$f = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:431: characters 13-29
					$failures->arr[$failures->length] = $f;
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:431: characters 13-29
					++$failures->length;

				}
			}

			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:435: lines 435-440
			if ($failures->length === 0) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:437: characters 11-25
				return Outcome::Success(Noise::Noise());
			} else {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:439: characters 11-69
				return Outcome::Failure(TypedError::withData(null, "Error closing sources", $failures, new HxAnon([
					"fileName" => "tink/io/Source.hx",
					"lineNumber" => 439,
					"className" => "tink.io._Source.CompoundSource",
					"methodName" => "close",
				])));
			}
		});
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:426: lines 426-441
		return $ret1->gather();
	}


	/**
	 * @param SinkObject $dest
	 * @param object $options
	 * 
	 * @return FutureObject
	 */
	public function pipeTo ($dest, $options = null) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:401: lines 401-417
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:402: lines 402-417
		return Future_Impl_::async(function ($cb)  use (&$dest, &$_gthis, &$options) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:403: lines 403-414
			$next = null;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:403: lines 403-414
			$next = function ()  use (&$next, &$dest, &$_gthis, &$cb, &$options) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:404: characters 16-21
				$_g = $_gthis->parts;
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:404: characters 16-21
				if ($_g->length === 0) {
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:405: characters 20-34
					$cb(PipeResult::AllWritten());
				} else {
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:406: characters 16-17
					$v = $_g;
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:407: lines 407-413
					($_gthis->parts->arr[0] ?? null)->pipeTo($dest, ($_gthis->parts->length === 1 ? $options : null))->handle(function ($x)  use (&$next, &$_gthis, &$cb) {
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:407: lines 407-413
						if ($x->index === 0) {
							#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:409: characters 17-30
							$_this = $_gthis->parts;
							#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:409: characters 17-30
							if ($_this->length > 0) {
								#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:409: characters 17-30
								$_this->length--;
							}
							#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:409: characters 17-38
							array_shift($_this->arr)->close();

							#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:410: characters 17-23
							$next();
						} else {
							#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:412: characters 17-22
							$cb($x);
						}
					});
				}
			};
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:403: lines 403-414
			$next1 = $next;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:416: characters 7-13
			$next1();
		});
	}


	/**
	 * @param Buffer $into
	 * @param int $max
	 * 
	 * @return FutureObject
	 */
	public function read ($into, $max = 1073741824) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:444: lines 444-458
		if ($max === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:444: lines 444-458
			$max = 1073741824;
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:444: lines 444-458
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:445: characters 19-24
		$_g = $this->parts;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:445: characters 19-24
		if ($_g->length === 0) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:447: characters 9-43
			return new SyncFuture(new LazyConst(Outcome::Success(-1)));
		} else {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:449: lines 449-457
			$ret = ($this->parts->arr[0] ?? null)->read($into, 1073741824)->flatMap(function ($o)  use (&$_gthis, &$into, &$max) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:450: lines 450-456
				if ($o->index === 0) {
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:451: characters 26-33
					$_hx_tmp = $o->params[0] < 0;
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:451: characters 26-33
					if ($_hx_tmp === true) {
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:452: characters 15-28
						$_this = $_gthis->parts;
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:452: characters 15-28
						if ($_this->length > 0) {
							#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:452: characters 15-28
							$_this->length--;
						}
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:452: characters 15-36
						array_shift($_this->arr)->close();

						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:453: characters 15-30
						return $_gthis->read($into, $max);
					} else {
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:455: characters 15-29
						return new SyncFuture(new LazyConst($o));
					}
				} else {
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:455: characters 15-29
					return new SyncFuture(new LazyConst($o));
				}
			});
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:449: lines 449-457
			return $ret->gather();
		}
	}
}


Boot::registerClass(CompoundSource::class, 'tink.io._Source.CompoundSource');
