<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx
 */

namespace tink\io;

use \tink\io\_Source\CompoundSource;
use \tink\io\_Source\ParserStream;
use \tink\core\Outcome;
use \php\Boot;
use \php\_Boot\HxException;
use \tink\core\_Future\FutureObject;
use \tink\core\_Future\SyncFuture;
use \tink\io\_Source\FutureSource;
use \tink\core\MPair;
use \tink\core\_Future\Future_Impl_;
use \haxe\io\Bytes;
use \tink\streams\StreamObject;
use \tink\core\Noise;
use \tink\io\_Source\Source_Impl_;
use \haxe\io\BytesOutput;
use \tink\io\_Sink\Sink_Impl_;
use \php\_Boot\HxAnon;
use \tink\core\_Lazy\LazyConst;

class SourceBase implements SourceObject {
	/**
	 * @return FutureObject
	 */
	public function all () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:193: lines 193-202
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:194: characters 5-33
		$out = new BytesOutput();
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:195: lines 195-201
		return Future_Impl_::async(function ($cb)  use (&$out, &$_gthis) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:196: characters 14-49
			$this1 = Sink_Impl_::ofOutput("memory buffer", $out);
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:196: lines 196-200
			$_gthis->pipeTo($this1)->handle(function ($r)  use (&$out, &$cb) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:196: lines 196-200
				$tmp = null;
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:196: lines 196-200
				switch ($r->index) {
					case 0:
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:196: lines 196-200
						$tmp = Outcome::Success($out->getBytes());
						break;
					case 3:
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:197: characters 27-28
						$e = $r->params[0];
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:196: lines 196-200
						$tmp = Outcome::Failure($e);
						break;
					default:
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:199: characters 18-23
						throw new HxException("assert");
						break;
				}
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:196: lines 196-200
				$cb($tmp);
			});
		});
	}


	/**
	 * @param SourceObject $other
	 * 
	 * @return SourceObject
	 */
	public function append ($other) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:182: characters 5-42
		return CompoundSource::of($this, $other);
	}


	/**
	 * @return FutureObject
	 */
	public function close () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:188: characters 12-39
		return new SyncFuture(new LazyConst(Outcome::Success(Noise::Noise())));
	}


	/**
	 * @param \Closure $onError
	 * 
	 * @return IdealSourceObject
	 */
	public function idealize ($onError) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:176: characters 5-46
		return new IdealizedSource($this, $onError);
	}


	/**
	 * @param StreamParser $parser
	 * 
	 * @return FutureObject
	 */
	public function parse ($parser) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:206: characters 5-20
		$ret = null;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:207: lines 207-209
		return Future_Impl_::_tryMap($this->parseWhile($parser, function ($x)  use (&$ret) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:208: characters 41-48
			$ret = $x;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:208: characters 50-75
			return new SyncFuture(new LazyConst(false));
		}), function ($s)  use (&$ret) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:209: characters 30-59
			return new HxAnon([
				"data" => $ret,
				"rest" => $s,
			]);
		});
	}


	/**
	 * @param StreamParser $parser
	 * @param \Closure $rest
	 * 
	 * @return StreamObject
	 */
	public function parseStream ($parser, $rest = null) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:216: characters 5-48
		return new ParserStream($this, $parser, $rest);
	}


	/**
	 * @param StreamParser $parser
	 * @param \Closure $cond
	 * 
	 * @return FutureObject
	 */
	public function parseWhile ($parser, $cond) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:213: characters 5-52
		return (new ParserSink($parser, $cond))->parse($this);
	}


	/**
	 * @param SinkObject $dest
	 * @param object $options
	 * 
	 * @return FutureObject
	 */
	public function pipeTo ($dest, $options = null) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:190: lines 190-191
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:191: characters 5-97
		return Future_Impl_::async(function ($cb)  use (&$dest, &$_gthis, &$options) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:191: characters 49-53
			$this1 = $_gthis;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:191: characters 39-96
			Pipe::make($this1, $dest, null, $options, function ($_, $res)  use (&$cb) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:191: characters 88-95
				$cb($res);
			});
		});
	}


	/**
	 * @param SourceObject $other
	 * 
	 * @return SourceObject
	 */
	public function prepend ($other) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:179: characters 5-42
		return CompoundSource::of($other, $this);
	}


	/**
	 * @param Buffer $into
	 * @param int $max
	 * 
	 * @return FutureObject
	 */
	public function read ($into, $max = 1073741824) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:185: characters 12-17
		if ($max === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:185: characters 12-17
			$max = 1073741824;
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:185: characters 12-17
		throw new HxException("not implemented");
	}


	/**
	 * @param Bytes $delim
	 * 
	 * @return MPair
	 */
	public function split ($delim) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:220: characters 5-40
		$f = $this->parse(new Splitter($delim));
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:221: lines 221-224
		$a = new FutureSource(Future_Impl_::_tryMap($f, function ($d) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:222: characters 72-96
			return Source_Impl_::fromBytes($d->data);
		}));
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:221: lines 221-224
		$this1 = new MPair($a, new FutureSource(Future_Impl_::_tryMap($f, function ($d1) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:223: characters 72-85
			return $d1->rest;
		})));
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:221: lines 221-224
		return $this1;
	}
}


Boot::registerClass(SourceBase::class, 'tink.io.SourceBase');