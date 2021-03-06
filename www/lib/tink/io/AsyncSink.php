<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx
 */

namespace tink\io;

use \tink\core\Outcome;
use \php\Boot;
use \tink\core\_Future\FutureObject;
use \tink\core\_Future\SyncFuture;
use \tink\core\_Future\Future_Impl_;
use \tink\core\_Callback\Callback_Impl_;
use \tink\core\_Lazy\LazyConst;

class AsyncSink extends SinkBase {
	/**
	 * @var \Closure
	 */
	public $closer;
	/**
	 * @var FutureObject
	 */
	public $closing;
	/**
	 * @var FutureObject
	 */
	public $last;
	/**
	 * @var \Closure
	 */
	public $writer;


	/**
	 * @param FutureObject $f
	 * 
	 * @return FutureObject
	 */
	static public function cause ($f) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:94: characters 5-31
		$f->handle(Callback_Impl_::fromNiladic(function () {
		}));
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:95: characters 5-13
		return $f;
	}


	/**
	 * @param \Closure $writer
	 * @param \Closure $closer
	 * 
	 * @return void
	 */
	public function __construct ($writer, $closer) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:79: characters 5-25
		$this->closer = $closer;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:80: characters 5-25
		$this->writer = $writer;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:81: characters 5-47
		$this->last = new SyncFuture(new LazyConst(Outcome::Success(0)));
	}


	/**
	 * @return FutureObject
	 */
	public function close () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:98: lines 98-103
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:99: lines 99-100
		if ($this->closing === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:100: characters 23-65
			$ret = $this->last->flatMap(function ($_)  use (&$_gthis) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:100: characters 49-64
				return ($_gthis->closer)();
			});
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:100: characters 7-66
			AsyncSink::cause($this->closing = $ret->gather());
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:102: characters 5-19
		return $this->closing;
	}


	/**
	 * @param Buffer $from
	 * 
	 * @return FutureObject
	 */
	public function write ($from) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:84: lines 84-91
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:85: lines 85-86
		if ($this->closing !== null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:86: characters 14-48
			return new SyncFuture(new LazyConst(Outcome::Success(-1)));
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:88: lines 88-90
		return AsyncSink::cause($this->last = Future_Impl_::_tryFailingFlatMap($this->last, function ($p)  use (&$_gthis, &$from) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Sink.hx:89: characters 7-26
			return ($_gthis->writer)($from);
		}));
	}
}


Boot::registerClass(AsyncSink::class, 'tink.io.AsyncSink');
