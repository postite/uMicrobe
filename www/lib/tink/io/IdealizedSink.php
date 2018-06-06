<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx
 */

namespace tink\io;

use \php\Boot;
use \tink\core\_Future\FutureObject;
use \tink\core\_Callback\Callback_Impl_;
use \tink\core\Noise;

class IdealizedSink extends IdealSinkBase {
	/**
	 * @var \Closure
	 */
	public $onError;
	/**
	 * @var SinkObject
	 */
	public $target;


	/**
	 * @param SinkObject $target
	 * @param \Closure $onError
	 * 
	 * @return void
	 */
	public function __construct ($target, $onError) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:43: characters 5-25
		$this->target = $target;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:44: characters 5-27
		$this->onError = $onError;
	}


	/**
	 * @return FutureObject
	 */
	public function closeSafely () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:56: lines 56-63
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:57: lines 57-63
		$ret = $this->target->close()->map(function ($o)  use (&$_gthis) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:58: lines 58-61
			if ($o->index === 1) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:59: characters 22-23
				$e = $o->params[0];
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:59: characters 26-43
				Callback_Impl_::invoke($_gthis->onError, $e);
			}
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:62: characters 7-19
			return Noise::Noise();
		});
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:57: lines 57-63
		return $ret->gather();
	}


	/**
	 * @param Buffer $from
	 * 
	 * @return FutureObject
	 */
	public function writeSafely ($from) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:47: lines 47-54
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:48: lines 48-54
		$ret = $this->target->write($from)->map(function ($o)  use (&$_gthis, &$from) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:48: lines 48-54
			switch ($o->index) {
				case 0:
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:49: characters 20-21
					$p = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:49: characters 24-25
					return $p;
					break;
				case 1:
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:50: characters 20-21
					$e = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:51: characters 9-26
					Callback_Impl_::invoke($_gthis->onError, $e);
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:52: characters 9-21
					$from->clear();
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:53: characters 9-21
					return -1;
					break;
			}
		});
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:48: lines 48-54
		return $ret->gather();
	}
}


Boot::registerClass(IdealizedSink::class, 'tink.io.IdealizedSink');
