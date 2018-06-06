<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx
 */

namespace tink\io\_Sink;

use \tink\core\Outcome;
use \haxe\io\Output;
use \php\Boot;
use \tink\io\WorkerObject;
use \tink\io\_Worker\Worker_Impl_;
use \tink\io\SinkObject;
use \tink\io\FutureSink;
use \tink\core\_Future\FutureObject;
use \tink\io\StdSink;
use \tink\core\_Future\Future_Impl_;
use \tink\io\Buffer;
use \tink\io\AsyncSink;
use \haxe\io\BytesOutput;

final class Sink_Impl_ {
	/**
	 * @var SinkObject
	 */
	static public $stdout;


	/**
	 * @param \Closure $writer
	 * @param \Closure $closer
	 * 
	 * @return SinkObject
	 */
	static public function async ($writer, $closer) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:52: characters 5-41
		return new AsyncSink($writer, $closer);
	}


	/**
	 * @param FutureObject $s
	 * 
	 * @return SinkObject
	 */
	static public function flatten ($s) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:55: characters 5-29
		return new FutureSink($s);
	}


	/**
	 * @return SinkObject
	 */
	static public function inMemory () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:49: characters 5-68
		return Sink_Impl_::ofOutput("Memory sink", new BytesOutput(), Worker_Impl_::$EAGER);
	}


	/**
	 * @param string $name
	 * @param Output $target
	 * @param WorkerObject $worker
	 * 
	 * @return SinkObject
	 */
	static public function ofOutput ($name, $target, $worker = null) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:58: characters 5-45
		return new StdSink($name, $target, $worker);
	}


	/**
	 * @param SinkObject $this
	 * @param Buffer $buffer
	 * 
	 * @return FutureObject
	 */
	static public function writeFull ($this1, $buffer) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:20: characters 5-21
		$self = $this1;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:21: lines 21-45
		return Future_Impl_::async(function ($cb)  use (&$self, &$buffer) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:22: lines 22-42
			$flush = null;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:22: lines 22-42
			$flush = function ()  use (&$self, &$flush, &$buffer, &$cb) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:23: lines 23-41
				if ($buffer->available === 0) {
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:25: characters 11-28
					$cb(Outcome::Success(true));
				} else {
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:28: lines 28-41
					$self->write($buffer)->handle(function ($o)  use (&$flush, &$cb) {
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:28: lines 28-41
						switch ($o->index) {
							case 0:
								#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:30: characters 26-27
								$p = $o->params[0];
								#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:32: lines 32-35
								if ($p < 0) {
									#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:33: characters 17-35
									$cb(Outcome::Success(false));
								} else {
									#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:35: characters 17-24
									$flush();
								}
								break;
							case 1:
								#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:37: characters 26-27
								$e = $o->params[0];
								#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:39: characters 15-29
								$cb(Outcome::Failure($e));
								break;
						}
					});
				}
			};
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:22: lines 22-42
			$flush1 = $flush;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:44: characters 7-14
			$flush1();
		});
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


self::$stdout = Sink_Impl_::ofOutput("stdout", \Sys::stdout());
	}
}


Boot::registerClass(Sink_Impl_::class, 'tink.io._Sink.Sink_Impl_');
Sink_Impl_::__hx__init();
