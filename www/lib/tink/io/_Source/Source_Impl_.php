<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx
 */

namespace tink\io\_Source;

use \tink\io\BlackHole;
use \tink\core\Outcome;
use \php\Boot;
use \tink\io\SinkObject;
use \tink\io\WorkerObject;
use \tink\core\TypedError;
use \tink\core\_Future\FutureObject;
use \tink\io\IdealSourceObject;
use \haxe\io\Input;
use \tink\core\MPair;
use \tink\io\StreamParser;
use \haxe\io\Bytes;
use \tink\io\Buffer;
use \tink\streams\StreamObject;
use \tink\io\Empty_hx;
use \haxe\io\_BytesData\Container;
use \tink\io\SourceObject;
use \tink\io\ByteSource;

final class Source_Impl_ {
	/**
	 * @var SourceObject
	 */
	static public $stdin;


	/**
	 * @param SourceObject $this
	 * 
	 * @return FutureObject
	 */
	static public function all ($this1) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:25: characters 5-22
		return $this1->all();
	}


	/**
	 * @param SourceObject $this
	 * @param SourceObject $other
	 * 
	 * @return SourceObject
	 */
	static public function append ($this1, $other) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:31: characters 5-30
		return $this1->append($other);
	}


	/**
	 * @param \Closure $f
	 * @param \Closure $close
	 * 
	 * @return AsyncSource
	 */
	static public function async ($f, $close) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:68: characters 5-37
		return new AsyncSource($f, $close);
	}


	/**
	 * @param SourceObject $this
	 * 
	 * @return FutureObject
	 */
	static public function close ($this1) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:22: characters 5-24
		return $this1->close();
	}


	/**
	 * @param TypedError $e
	 * 
	 * @return SourceObject
	 */
	static public function failure ($e) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:71: characters 5-31
		return new FailedSource($e);
	}


	/**
	 * @param FutureObject $s
	 * 
	 * @return SourceObject
	 */
	static public function flatten ($s) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:87: characters 5-31
		return new FutureSource($s);
	}


	/**
	 * @param Bytes $b
	 * 
	 * @return SourceObject
	 */
	static public function fromBytes ($b) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:90: characters 12-42
		if ($b === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:90: characters 12-42
			return Empty_hx::$instance;
		} else {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:90: characters 12-42
			return new ByteSource($b, 0);
		}
	}


	/**
	 * @param string $s
	 * 
	 * @return SourceObject
	 */
	static public function fromString ($s) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:93: characters 22-39
		$s1 = strlen($s);
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:93: characters 5-40
		return Source_Impl_::fromBytes(new Bytes($s1, new Container($s)));
	}


	/**
	 * @param SourceObject $this
	 * @param \Closure $onError
	 * 
	 * @return IdealSourceObject
	 */
	static public function idealize ($this1, $onError) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:37: characters 5-34
		return $this1->idealize($onError);
	}


	/**
	 * @param SourceObject $this
	 * @param int $length
	 * 
	 * @return SourceObject
	 */
	static public function limit ($this1, $length) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:65: characters 5-43
		return new LimitedSource($this1, $length);
	}


	/**
	 * @param string $name
	 * @param Input $input
	 * @param WorkerObject $worker
	 * 
	 * @return SourceObject
	 */
	static public function ofInput ($name, $input, $worker = null) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:74: characters 5-46
		return new StdSource($name, $input, $worker);
	}


	/**
	 * @param SourceObject $this
	 * @param StreamParser $parser
	 * 
	 * @return FutureObject
	 */
	static public function parse ($this1, $parser) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:40: characters 5-30
		return $this1->parse($parser);
	}


	/**
	 * @param SourceObject $this
	 * @param StreamParser $parser
	 * @param \Closure $rest
	 * 
	 * @return StreamObject
	 */
	static public function parseStream ($this1, $parser, $rest = null) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:46: characters 5-42
		return $this1->parseStream($parser, $rest);
	}


	/**
	 * @param SourceObject $this
	 * @param StreamParser $parser
	 * @param \Closure $consumer
	 * 
	 * @return FutureObject
	 */
	static public function parseWhile ($this1, $parser, $consumer) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:43: characters 5-45
		return $this1->parseWhile($parser, $consumer);
	}


	/**
	 * @param SourceObject $this
	 * @param SinkObject $dest
	 * @param object $options
	 * 
	 * @return FutureObject
	 */
	static public function pipeTo ($this1, $dest, $options = null) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:34: characters 5-38
		return $this1->pipeTo($dest, $options);
	}


	/**
	 * @param SourceObject $this
	 * @param SourceObject $other
	 * 
	 * @return SourceObject
	 */
	static public function prepend ($this1, $other) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:28: characters 5-31
		return $this1->prepend($other);
	}


	/**
	 * @param SourceObject $this
	 * @param Buffer $into
	 * @param int $max
	 * 
	 * @return FutureObject
	 */
	static public function read ($this1, $into, $max = 1073741824) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:19: characters 5-32
		if ($max === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:19: characters 5-32
			$max = 1073741824;
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:19: characters 5-32
		return $this1->read($into, $max);
	}


	/**
	 * @param SourceObject $this
	 * @param int $length
	 * 
	 * @return SourceObject
	 */
	static public function skip ($this1, $length) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:57: characters 12-48
		$this2 = Source_Impl_::limit($this1, $length);
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:57: characters 33-47
		$this3 = BlackHole::$INST;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:57: lines 57-61
		$ret = $this2->pipeTo($this3, null)->map(function ($o)  use (&$this1) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:57: lines 57-61
			switch ($o->index) {
				case 0:
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:58: characters 24-37
					return Outcome::Success($this1);
					break;
				case 3:
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:59: characters 25-26
					$e = $o->params[0];
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:59: characters 29-39
					return Outcome::Failure($e);
					break;
			}
		});
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:57: lines 57-61
		return Source_Impl_::flatten($ret->gather());
	}


	/**
	 * @param SourceObject $this
	 * @param Bytes $delim
	 * 
	 * @return MPair
	 */
	static public function split ($this1, $delim) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:49: characters 5-29
		return $this1->split($delim);
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


self::$stdin = Source_Impl_::ofInput("stdin", \Sys::stdin());
	}
}


Boot::registerClass(Source_Impl_::class, 'tink.io._Source.Source_Impl_');
Source_Impl_::__hx__init();