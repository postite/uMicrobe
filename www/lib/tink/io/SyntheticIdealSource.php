<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx
 */

namespace tink\io;

use \tink\core\FutureTrigger;
use \php\Boot;
use \tink\core\_Future\FutureObject;
use \tink\core\_Future\SyncFuture;
use \haxe\io\Bytes;
use \haxe\io\BytesInput;
use \tink\core\Noise;
use \tink\core\_Lazy\LazyConst;

class SyntheticIdealSource extends IdealSourceBase {
	/**
	 * @var \Array_hx
	 */
	public $buf;
	/**
	 * @var \Array_hx
	 */
	public $queue;
	/**
	 * @var bool
	 */
	public $writable;


	/**
	 * @return void
	 */
	public function __construct () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:107: characters 45-49
		$this->writable = true;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:114: characters 5-13
		$this->buf = new \Array_hx();
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:115: characters 5-15
		$this->queue = new \Array_hx();
	}


	/**
	 * @return FutureObject
	 */
	public function closeSafely () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:159: lines 159-166
		if ($this->buf !== null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:160: characters 7-17
			$this->buf = null;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:162: lines 162-163
			$_g = 0;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:162: lines 162-163
			$_g1 = $this->queue;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:162: lines 162-163
			while ($_g < $_g1->length) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:162: characters 12-13
				$q = ($_g1->arr[$_g] ?? null);
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:162: lines 162-163
				$_g = $_g + 1;
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:163: characters 9-25
				$q->trigger(Noise::Noise());
			}

			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:165: characters 7-19
			$this->queue = null;
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:167: characters 5-30
		return new SyncFuture(new LazyConst(Noise::Noise()));
	}


	/**
	 * @param Buffer $into
	 * @param int $max
	 * 
	 * @return int
	 */
	public function doRead ($into, $max) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:119: characters 5-55
		if (($this->buf === null) || ($this->buf->length === 0)) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:119: characters 36-55
			return -1;
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:120: characters 5-22
		$src = ($this->buf->arr[0] ?? null);
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:121: characters 5-39
		$ret = $into->readFrom($src, $max);
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:122: lines 122-123
		if ($src->pos === $src->totlen) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:123: characters 7-18
			$_this = $this->buf;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:123: characters 7-18
			if ($_this->length > 0) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:123: characters 7-18
				$_this->length--;
			}
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:123: characters 7-18
			array_shift($_this->arr);
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:124: characters 5-15
		return $ret;
	}


	/**
	 * @return void
	 */
	public function end () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:128: characters 5-21
		$this->writable = false;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:129: lines 129-130
		if ($this->queue->length > 0) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:130: characters 7-20
			$this->closeSafely();
		}
	}


	/**
	 * @return bool
	 */
	public function get_closed () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:111: characters 7-25
		return $this->buf === null;
	}


	/**
	 * @param Buffer $into
	 * @param int $max
	 * 
	 * @return FutureObject
	 */
	public function readSafely ($into, $max = 268435456) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:133: lines 133-145
		if ($max === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:133: lines 133-145
			$max = 268435456;
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:133: lines 133-145
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:134: lines 134-135
		if ($this->buf === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:135: characters 7-39
			return new SyncFuture(new LazyConst(-1));
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:137: lines 137-138
		if (($this->buf->length > 0) || !$this->writable) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:138: characters 14-44
			return new SyncFuture(new LazyConst($this->doRead($into, $max)));
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:140: characters 5-36
		$trigger = new FutureTrigger();
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:142: characters 5-24
		$_this = $this->queue;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:142: characters 5-24
		$_this->arr[$_this->length] = $trigger;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:142: characters 5-24
		++$_this->length;

		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:144: characters 12-73
		$ret = $trigger->map(function ($_)  use (&$_gthis, &$into, &$max) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:144: characters 48-72
			return $_gthis->doRead($into, $max);
		});
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:144: characters 12-73
		return $ret->gather();
	}


	/**
	 * @param Bytes $bytes
	 * 
	 * @return bool
	 */
	public function write ($bytes) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:148: lines 148-149
		if (($this->buf === null) || !$this->writable) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:149: characters 7-19
			return false;
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:151: characters 5-36
		$_this = $this->buf;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:151: characters 5-36
		$x = new BytesInput($bytes);
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:151: characters 5-36
		$_this->arr[$_this->length] = $x;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:151: characters 5-36
		++$_this->length;

		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:152: lines 152-153
		if (($this->queue->length > 0) && (($this->buf->length > 0) || !$this->writable)) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:153: characters 7-20
			$_this1 = $this->queue;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:153: characters 7-20
			if ($_this1->length > 0) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:153: characters 7-20
				$_this1->length--;
			}
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:153: characters 7-35
			array_shift($_this1->arr)->trigger(Noise::Noise());
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:155: characters 5-16
		return true;
	}
}


Boot::registerClass(SyntheticIdealSource::class, 'tink.io.SyntheticIdealSource');
Boot::registerGetters('tink\\io\\SyntheticIdealSource', [
	'closed' => true
]);