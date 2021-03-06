<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx
 */

namespace tink\io;

use \tink\core\Outcome;
use \php\Boot;
use \tink\io\_Worker\Worker_Impl_;
use \tink\core\_Future\FutureObject;
use \tink\core\_Future\SyncFuture;
use \tink\core\_Future\Future_Impl_;
use \tink\core\Noise;
use \tink\io\_Source\Source_Impl_;
use \tink\core\_Lazy\LazyFunc;
use \tink\core\_Lazy\LazyConst;

class ParserSink extends SinkBase {
	/**
	 * @var int
	 */
	static public $idCounter = 0;


	/**
	 * @var int
	 */
	public $callCounter;
	/**
	 * @var int
	 */
	public $id;
	/**
	 * @var \Closure
	 */
	public $onResult;
	/**
	 * @var StreamParser
	 */
	public $parser;
	/**
	 * @var Outcome
	 */
	public $state;
	/**
	 * @var FutureObject
	 */
	public $wait;
	/**
	 * @var WorkerObject
	 */
	public $worker;


	/**
	 * @param StreamParser $parser
	 * @param \Closure $onResult
	 * @param WorkerObject $worker
	 * 
	 * @return void
	 */
	public function __construct ($parser, $onResult, $worker = null) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:225: characters 21-22
		$this->callCounter = 0;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:224: characters 16-27
		$this->id = ParserSink::$idCounter++;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:228: characters 5-25
		$this->parser = $parser;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:229: characters 5-29
		$this->onResult = $onResult;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:230: characters 5-34
		$this->wait = new SyncFuture(new LazyConst(true));
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:231: characters 5-31
		$this->worker = Worker_Impl_::$EAGER;
	}


	/**
	 * @return FutureObject
	 */
	public function close () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:282: characters 5-14
		$this->doClose();
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:283: characters 12-39
		return new SyncFuture(new LazyConst(Outcome::Success(Noise::Noise())));
	}


	/**
	 * @return void
	 */
	public function doClose () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:235: lines 235-236
		if ($this->state === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:236: characters 7-36
			$this->state = Outcome::Success(-1);
		}
	}


	/**
	 * @param SourceObject $s
	 * @param mixed $options
	 * 
	 * @return FutureObject
	 */
	public function parse ($s, $options = null) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:286: lines 286-300
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:287: lines 287-300
		return Future_Impl_::async(function ($cb)  use (&$_gthis, &$s) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:288: characters 17-18
			$this1 = $s;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:288: characters 20-24
			$this2 = $_gthis;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:288: lines 288-299
			Pipe::make($this1, $this2, Buffer::sufficientWidthFor($_gthis->parser->minSize()), null, function ($rest, $res)  use (&$s, &$cb) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:289: lines 289-298
				$tmp = null;
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:289: lines 289-298
				switch ($res->index) {
					case 0:
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:289: lines 289-298
						$tmp = Outcome::Success($s);
						break;
					case 1:
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:294: characters 27-28
						$e = $res->params[0];
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:289: lines 289-298
						$tmp = Outcome::Failure($e);
						break;
					case 2:
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:293: characters 21-57
						$other = Source_Impl_::fromBytes($rest->content());
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:289: lines 289-298
						$tmp = Outcome::Success($s->prepend($other));
						break;
					case 3:
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:296: characters 29-30
						$e1 = $res->params[0];
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:289: lines 289-298
						$tmp = Outcome::Failure($e1);
						break;
				}
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:289: lines 289-298
				$cb($tmp);
			});
		});
	}


	/**
	 * @param Buffer $from
	 * 
	 * @return FutureObject
	 */
	public function write ($from) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:238: lines 238-280
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:239: characters 5-30
		$call = $this->callCounter++;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:241: lines 241-279
		if ($this->state !== null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:242: characters 9-32
			return new SyncFuture(new LazyConst($this->state));
		} else {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:244: lines 244-279
			$ret = $this->wait->flatMap(function ($resume)  use (&$_gthis, &$from) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:246: lines 246-278
				if (!$resume) {
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:247: characters 15-24
					$_gthis->doClose();
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:248: characters 15-38
					return new SyncFuture(new LazyConst($_gthis->state));
				} else {
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:251: lines 251-278
					return Worker_Impl_::work($_gthis->worker, new LazyFunc(function ()  use (&$_gthis, &$from) {
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:252: characters 17-43
						$last = $from->available;
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:254: lines 254-277
						if (($last === 0) && !$from->writable) {
							#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:255: characters 28-40
							$_g = $_gthis->parser->eof();
							#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:255: characters 28-40
							switch ($_g->index) {
								case 0:
									#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:256: characters 36-37
									$v = $_g->params[0];
									#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:257: characters 25-34
									$_gthis->doClose();
									#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:258: characters 25-48
									$_gthis->wait = ($_gthis->onResult)($v);
									#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:259: characters 25-46
									return Outcome::Success(-1);
									break;
								case 1:
									#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:260: characters 36-37
									$e = $_g->params[0];
									#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:261: characters 25-43
									return $_gthis->state = Outcome::Failure($e);
									break;
							}
						} else {
							#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:264: characters 28-49
							$_g1 = $_gthis->parser->progress($from);
							#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:264: characters 28-49
							switch ($_g1->index) {
								case 0:
									#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:265: characters 36-37
									$d = $_g1->params[0];
									#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:267: lines 267-271
									switch ($d->index) {
										case 0:
											#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:268: characters 37-38
											$v1 = $d->params[0];
											#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:269: characters 29-52
											$_gthis->wait = ($_gthis->onResult)($v1);
											break;
										case 1:
																						break;
									}
									#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:273: characters 33-67
									$this1 = $last - $from->available;
									#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:273: characters 25-68
									return Outcome::Success($this1);
									break;
								case 1:
									#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:275: characters 36-37
									$f = $_g1->params[0];
									#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:276: characters 25-43
									return $_gthis->state = Outcome::Failure($f);
									break;
							}
						}
					}));
				}
			});
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:244: lines 244-279
			return $ret->gather();
		}
	}
}


Boot::registerClass(ParserSink::class, 'tink.io.ParserSink');
