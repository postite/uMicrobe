<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/php/_std/sys/io/Process.hx
 */

namespace sys\io\_Process;

use \haxe\io\Eof;
use \php\Boot;
use \php\_Boot\HxException;
use \haxe\io\Input;
use \haxe\io\Bytes;
use \haxe\io\_BytesData\Container;
use \haxe\io\Error;

class ReadablePipe extends Input {
	/**
	 * @var mixed
	 */
	public $pipe;
	/**
	 * @var Bytes
	 */
	public $tmpBytes;


	/**
	 * @param mixed $pipe
	 * 
	 * @return void
	 */
	public function __construct ($pipe) {
		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:46: characters 3-19
		$this->pipe = $pipe;
		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:47: characters 3-28
		$this->tmpBytes = Bytes::alloc(1);
	}


	/**
	 * @return void
	 */
	public function close () {
		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:51: characters 3-16
		fclose($this->pipe);
	}


	/**
	 * @return int
	 */
	public function readByte () {
		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:55: characters 3-44
		if ($this->readBytes($this->tmpBytes, 0, 1) === 0) {
			#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:55: characters 39-44
			throw new HxException(Error::Blocked());
		}
		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:56: characters 10-25
		return ord($this->tmpBytes->b->s[0]);
	}


	/**
	 * @param Bytes $s
	 * @param int $pos
	 * @param int $len
	 * 
	 * @return int
	 */
	public function readBytes ($s, $pos, $len) {
		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:60: characters 3-24
		if (feof($this->pipe)) {
			#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:60: characters 19-24
			throw new HxException(new Eof());
		}
		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:62: characters 3-32
		$result = fread($this->pipe, $len);
		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:63: characters 3-25
		if ($result === "") {
			#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:63: characters 20-25
			throw new HxException(new Eof());
		}
		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:64: characters 3-35
		if ($result === false) {
			#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:64: characters 30-35
			throw new HxException(Error::Custom("Failed to read process output"));
		}
		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:65: characters 3-30
		$result1 = $result;
		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:67: characters 15-37
		$result2 = strlen($result1);
		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:67: characters 3-38
		$bytes = new Bytes($result2, new Container($result1));
		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:68: characters 3-39
		$len1 = strlen($result1);
		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:68: characters 3-39
		if (($pos < 0) || ($len1 < 0) || (($pos + $len1) > $s->length) || ($len1 > $bytes->length)) {
			#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:68: characters 3-39
			throw new HxException(Error::OutsideBounds());
		} else {
			#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:68: characters 3-39
			$this1 = $s->b;
			#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:68: characters 3-39
			$src = $bytes->b;
			#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:68: characters 3-39
			$this1->s = ((substr($this1->s, 0, $pos) . substr($src->s, 0, $len1)) . substr($this1->s, $pos + $len1));
		}

		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:69: characters 3-23
		return strlen($result1);
	}
}


Boot::registerClass(ReadablePipe::class, 'sys.io._Process.ReadablePipe');