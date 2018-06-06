<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx
 */

namespace tink\io\_IdealSink;

use \tink\io\IdealSinkBase;
use \php\Boot;
use \php\_Boot\HxException;
use \haxe\io\BytesBuffer;
use \tink\core\_Future\FutureObject;
use \tink\core\_Future\SyncFuture;
use \haxe\io\Bytes;
use \tink\io\Buffer;
use \tink\core\_Callback\Callback_Impl_;
use \tink\core\_Lazy\LazyConst;
use \haxe\io\Error;

class MemorySink extends IdealSinkBase {
	/**
	 * @var BytesBuffer
	 */
	public $buffer;
	/**
	 * @var \Closure
	 */
	public $whenDone;


	/**
	 * @param \Closure $whenDone
	 * @param BytesBuffer $buffer
	 * 
	 * @return void
	 */
	public function __construct ($whenDone, $buffer) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:88: characters 5-29
		$this->whenDone = $whenDone;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:89: lines 89-92
		$tmp = null;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:89: lines 89-92
		if ($buffer === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:89: lines 89-92
			$tmp = new BytesBuffer();
		} else {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:91: characters 12-13
			$v = $buffer;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:89: lines 89-92
			$tmp = $v;
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:89: lines 89-92
		$this->buffer = $tmp;
	}


	/**
	 * @return FutureObject
	 */
	public function closeSafely () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:108: lines 108-112
		if ($this->buffer !== null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:109: characters 7-30
			Callback_Impl_::invoke($this->whenDone, $this->buffer);
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:110: characters 7-20
			$this->buffer = null;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:111: characters 7-22
			$this->whenDone = null;
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:113: characters 5-31
		return parent::closeSafely();
	}


	/**
	 * @param Bytes $b
	 * @param int $pos
	 * @param int $len
	 * 
	 * @return int
	 */
	public function writeBytes ($b, $pos, $len) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:96: characters 5-33
		$_this = $this->buffer;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:96: characters 5-33
		if (($pos < 0) || ($len < 0) || (($pos + $len) > $b->length)) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:96: characters 5-33
			throw new HxException(Error::OutsideBounds());
		} else {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:96: characters 5-33
			$left = $_this->b;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:96: characters 5-33
			$this_s = substr($b->b->s, $pos, $len);
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:96: characters 5-33
			$_this->b = ($left . $this_s);
		}

		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:97: characters 5-15
		return $len;
	}


	/**
	 * @param Buffer $from
	 * 
	 * @return FutureObject
	 */
	public function writeSafely ($from) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSink.hx:102: lines 102-105
		return new SyncFuture(new LazyConst(($this->buffer === null ? -1 : $from->writeTo($this))));
	}
}


Boot::registerClass(MemorySink::class, 'tink.io._IdealSink.MemorySink');
