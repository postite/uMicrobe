<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx
 */

namespace tink\io;

use \php\_Boot\HxClosure;
use \php\Boot;
use \haxe\ds\List_hx;

class Pipe {
	/**
	 * @var List_hx
	 */
	static public $suspended;


	/**
	 * @var bool
	 */
	public $autoClose;
	/**
	 * @var Buffer
	 */
	public $buffer;
	/**
	 * @var int
	 */
	public $bufferWidth;
	/**
	 * @var SinkObject
	 */
	public $dest;
	/**
	 * @var \Closure
	 */
	public $onDone;
	/**
	 * @var \Closure
	 */
	public $releaseBuffer;
	/**
	 * @var SourceObject
	 */
	public $source;


	/**
	 * @param SourceObject $from
	 * @param SinkObject $to
	 * @param int $bufferWidth
	 * @param object $options
	 * @param \Closure $cb
	 * 
	 * @return void
	 */
	static public function make ($from, $to, $bufferWidth = null, $options = null, $cb) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:107: lines 107-109
		(new Pipe($from, $to, $bufferWidth, ($options !== null) && $options->end, function ($buf, $res)  use (&$cb) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:108: characters 7-24
			$cb($buf, $res);
		}))->resume();
	}


	/**
	 * @param SourceObject $source
	 * @param SinkObject $dest
	 * @param int $bufferWidth
	 * @param bool $autoClose
	 * @param \Closure $onDone
	 * 
	 * @return void
	 */
	public function __construct ($source, $dest, $bufferWidth = null, $autoClose = false, $onDone) {
		if (!$this->__hx__default__releaseBuffer) {
			$this->__hx__default__releaseBuffer = new HxClosure($this, 'releaseBuffer');
			if ($this->releaseBuffer === null) $this->releaseBuffer = $this->__hx__default__releaseBuffer;
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:17: lines 17-28
		if ($autoClose === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:17: lines 17-28
			$autoClose = false;
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:19: lines 19-21
		$this->bufferWidth = ($bufferWidth !== null ? $bufferWidth : 15);
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:23: characters 5-31
		$this->autoClose = $autoClose;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:24: characters 5-25
		$this->source = $source;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:25: characters 5-21
		$this->dest = $dest;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:27: characters 5-25
		$this->onDone = $onDone;
	}


	/**
	 * @param int $repeat
	 * 
	 * @return void
	 */
	public function flush ($repeat = 1) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:79: lines 79-104
		if ($repeat === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:79: lines 79-104
			$repeat = 1;
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:79: lines 79-104
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:80: lines 80-103
		if ($this->buffer->writable || !$this->autoClose) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:81: lines 81-95
			$this->dest->write($this->buffer)->handle(function ($o)  use (&$repeat, &$_gthis) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:81: lines 81-95
				switch ($o->index) {
					case 0:
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:82: characters 22-29
						$_hx_tmp = $o->params[0] < 0;
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:82: characters 22-29
						if ($_hx_tmp === true) {
							#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:83: characters 11-73
							$_gthis->terminate(($_gthis->buffer->available > 0 ? PipeResult::SinkEnded() : PipeResult::AllWritten()));
						} else {
							#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:84: characters 22-23
							$v = $o->params[0];
							#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:85: lines 85-91
							if ($repeat > 0) {
								#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:86: characters 13-45
								$_gthis->flush($repeat - (($v === 0 ? 1 : 0)));
							} else if ($_gthis->buffer->writable) {
								#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:89: characters 15-21
								$_gthis->read();
							} else {
								#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:91: characters 15-22
								$_gthis->flush();
							}
						}
						break;
					case 1:
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:92: characters 22-23
						$f = $o->params[0];
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:93: characters 11-25
						$_gthis->source->close();
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:94: characters 11-35
						$_gthis->terminate(PipeResult::SinkFailed($f));

						break;
				}
			});
		} else {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:98: lines 98-103
			$this->dest->finish($this->buffer)->handle(function ($o1)  use (&$_gthis) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:98: lines 98-103
				switch ($o1->index) {
					case 0:
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:100: characters 11-73
						$_gthis->terminate(($_gthis->buffer->available > 0 ? PipeResult::SinkEnded() : PipeResult::AllWritten()));
						break;
					case 1:
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:101: characters 22-23
						$f1 = $o1->params[0];
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:102: characters 11-35
						$_gthis->terminate(PipeResult::SinkFailed($f1));
						break;
				}
			});
		}
	}


	/**
	 * @return void
	 */
	public function read () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:64: lines 64-77
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:65: lines 65-77
		$this->source->read($this->buffer, 1073741824)->handle(function ($o)  use (&$_gthis) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:65: lines 65-77
			switch ($o->index) {
				case 0:
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:66: characters 20-27
					$_hx_tmp = $o->params[0] < 0;
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:66: characters 20-27
					if ($_hx_tmp === true) {
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:67: characters 9-23
						$_gthis->source->close();
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:68: characters 9-22
						$_gthis->buffer->seal();
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:69: characters 9-16
						$_gthis->flush();
					} else {
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:70: characters 20-21
						$v = $o->params[0];
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:71: lines 71-74
						if (($v === 0) && ($_gthis->buffer->available === 0)) {
							#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:72: characters 11-20
							$_gthis->suspend();
						} else {
							#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:74: characters 11-18
							$_gthis->flush();
						}
					}
					break;
				case 1:
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:75: characters 20-21
					$e = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:76: characters 9-35
					$_gthis->terminate(PipeResult::SourceFailed($e));
					break;
			}
		});
	}


	/**
	 * @return void
	 */
	public function releaseBuffer ()
	{
		if ($this->releaseBuffer !== $this->__hx__default__releaseBuffer) return call_user_func_array($this->releaseBuffer, func_get_args());
			}
	protected $__hx__default__releaseBuffer;


	/**
	 * @return void
	 */
	public function resume () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:57: lines 57-60
		if ($this->buffer === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:58: characters 7-51
			$this->buffer = Buffer::alloc($this->bufferWidth);
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:59: characters 7-43
			$this->releaseBuffer = $this->buffer->retain();
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:61: characters 5-16
		$this->read();
	}


	/**
	 * @return void
	 */
	public function suspend () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:45: lines 45-53
		if ($this->bufferWidth > 0) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:46: characters 14-29
			$_g = Pipe::$suspended->pop();
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:47: lines 47-51
			if ($_g === null) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:47: characters 20-26
				$this->read();
			} else {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:48: characters 14-18
				$next = $_g;
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:49: characters 11-26
				$this->releaseBuffer();
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:50: characters 11-30
				Pipe::$suspended->add($this);
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:51: characters 11-24
				$next->resume();

			}
		} else {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:53: characters 10-16
			$this->read();
		}
	}


	/**
	 * @param PipeResult $s
	 * 
	 * @return void
	 */
	public function terminate ($s) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:31: characters 5-22
		($this->onDone)($this->buffer, $s);
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Pipe.hx:32: characters 5-20
		$this->releaseBuffer();
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


self::$suspended = new List_hx();
	}
}


Boot::registerClass(Pipe::class, 'tink.io.Pipe');
Pipe::__hx__init();
