<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx
 */

namespace tink\streams;

use \php\Boot;
use \tink\streams\_Stream\StreamFilterAsync_Impl_;
use \tink\core\_Future\FutureObject;
use \tink\core\_Future\SyncFuture;
use \tink\streams\_Stream\StreamMapAsync_Impl_;
use \tink\streams\_Stream\StreamFilter_Impl_;
use \tink\core\_Lazy\LazyConst;
use \tink\streams\_Stream\StreamMap_Impl_;

class StreamMapFilter extends StreamBase {
	/**
	 * @var StreamObject
	 */
	public $data;
	/**
	 * @var \Closure
	 */
	public $transformer;


	/**
	 * @param StreamObject $data
	 * @param \Closure $transformer
	 * 
	 * @return void
	 */
	public function __construct ($data, $transformer) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:412: characters 5-21
		$this->data = $data;
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:413: characters 5-35
		$this->transformer = $transformer;
	}


	/**
	 * @param \Closure $transformer
	 * 
	 * @return StreamObject
	 */
	public function chain ($transformer) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:416: lines 416-421
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:417: lines 417-421
		return new StreamMapFilter($this->data, function ($i)  use (&$_gthis, &$transformer) {
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:420: characters 16-56
			$this1 = ($_gthis->transformer)($i);
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:420: characters 16-56
			if ($this1 !== null) {
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:420: characters 16-56
				return $transformer($this1);
			} else {
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:420: characters 16-56
				return null;
			}
		});
	}


	/**
	 * @param \Closure $transformer
	 * 
	 * @return StreamObject
	 */
	public function chainAsync ($transformer) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:439: lines 439-447
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:440: lines 440-447
		return new StreamMapFilterAsync($this->data, function ($i)  use (&$_gthis, &$transformer) {
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:443: characters 23-42
			$_g = ($_gthis->transformer)($i);
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:444: characters 16-17
			$v = $_g;
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:444: lines 444-445
			if ($v !== null) {
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:444: characters 34-54
				return $transformer($v);
			} else {
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:445: characters 20-45
				return new SyncFuture(new LazyConst(null));
			}
		});
	}


	/**
	 * @param \Closure $item
	 * 
	 * @return StreamObject
	 */
	public function filter ($item) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:459: characters 5-42
		return $this->chain(StreamFilter_Impl_::lift($item));
	}


	/**
	 * @param \Closure $item
	 * 
	 * @return StreamObject
	 */
	public function filterAsync ($item) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:450: characters 5-52
		return $this->chainAsync(StreamFilterAsync_Impl_::lift($item));
	}


	/**
	 * @param \Closure $item
	 * 
	 * @return FutureObject
	 */
	public function forEach ($item) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:423: lines 423-429
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:424: lines 424-429
		return $this->data->forEach(function ($x)  use (&$item, &$_gthis) {
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:425: characters 21-35
			$_g = ($_gthis->transformer)($x);
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:426: characters 14-15
			$v = $_g;
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:426: lines 426-427
			if ($v !== null) {
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:426: characters 32-45
				return $item($v);
			} else {
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:427: characters 18-22
				return true;
			}
		});
	}


	/**
	 * @param \Closure $item
	 * 
	 * @return FutureObject
	 */
	public function forEachAsync ($item) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:431: lines 431-437
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:432: lines 432-437
		return $this->data->forEachAsync(function ($x)  use (&$item, &$_gthis) {
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:433: characters 21-35
			$_g = ($_gthis->transformer)($x);
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:434: characters 14-15
			$v = $_g;
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:434: lines 434-435
			if ($v !== null) {
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:434: characters 32-45
				return $item($v);
			} else {
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:435: characters 18-35
				return new SyncFuture(new LazyConst(true));
			}
		});
	}


	/**
	 * @param \Closure $item
	 * 
	 * @return StreamObject
	 */
	public function map ($item) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:456: characters 5-39
		return $this->chain(StreamMap_Impl_::lift($item));
	}


	/**
	 * @param \Closure $item
	 * 
	 * @return StreamObject
	 */
	public function mapAsync ($item) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:453: characters 5-49
		return $this->chainAsync(StreamMapAsync_Impl_::lift($item));
	}
}


Boot::registerClass(StreamMapFilter::class, 'tink.streams.StreamMapFilter');
