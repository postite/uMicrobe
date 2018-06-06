<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx
 */

namespace tink\io;

use \haxe\io\Output;
use \php\Boot;
use \tink\io\_Worker\Worker_Impl_;
use \tink\core\TypedError;
use \tink\core\_Future\FutureObject;
use \tink\core\Noise;
use \tink\core\_Lazy\LazyFunc;
use \php\_Boot\HxAnon;

class StdSink extends SinkBase {
	/**
	 * @var string
	 */
	public $name;
	/**
	 * @var Output
	 */
	public $target;
	/**
	 * @var WorkerObject
	 */
	public $worker;


	/**
	 * @param string $name
	 * @param Output $target
	 * @param WorkerObject $worker
	 * 
	 * @return void
	 */
	public function __construct ($name, $target, $worker = null) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:137: characters 5-21
		$this->name = $name;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:138: characters 5-25
		$this->target = $target;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:139: characters 5-34
		$this->worker = Worker_Impl_::ensure($worker);
	}


	/**
	 * @return FutureObject
	 */
	public function close () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:151: lines 151-162
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:152: lines 152-161
		return Worker_Impl_::work($this->worker, new LazyFunc(function ()  use (&$_gthis) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:154: lines 154-160
			return TypedError::catchExceptions(function ()  use (&$_gthis) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:156: characters 13-27
				$_gthis->target->close();
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:157: characters 13-25
				return Noise::Noise();
			}, TypedError::reporter(null, "Failed to close " . ($_gthis->name??'null'), new HxAnon([
				"fileName" => "tink/io/Sink.hx",
				"lineNumber" => 159,
				"className" => "tink.io.StdSink",
				"methodName" => "close",
			])), new HxAnon([
				"fileName" => "tink/io/Sink.hx",
				"lineNumber" => 154,
				"className" => "tink.io.StdSink",
				"methodName" => "close",
			]));
		}));
	}


	/**
	 * @return string
	 */
	public function toString () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:165: characters 5-16
		return $this->name;
	}


	/**
	 * @param Buffer $from
	 * 
	 * @return FutureObject
	 */
	public function write ($from) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:142: lines 142-149
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:143: lines 143-149
		return Worker_Impl_::work($this->worker, new LazyFunc(function ()  use (&$_gthis, &$from) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:146: characters 11-53
			$ret = $from->tryWritingTo($_gthis->name, $_gthis->target);
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:147: characters 11-25
			$_gthis->target->flush();
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:148: characters 11-21
			return $ret;
		}));
	}


	public function __toString() {
		return $this->toString();
	}
}


Boot::registerClass(StdSink::class, 'tink.io.StdSink');