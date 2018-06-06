<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx
 */

namespace tink\io;

use \php\Boot;
use \php\_Boot\HxException;
use \tink\core\_Future\FutureObject;
use \tink\core\_Future\SyncFuture;
use \tink\core\_Future\Future_Impl_;
use \haxe\io\Bytes;
use \tink\core\Noise;
use \haxe\io\_BytesData\Container;
use \tink\io\_Sink\Sink_Impl_;
use \tink\core\_Lazy\LazyConst;
use \haxe\io\Error;

class ByteSource extends IdealSourceBase {
	/**
	 * @var Bytes
	 */
	public $data;
	/**
	 * @var int
	 */
	public $pos;


	/**
	 * @param Bytes $data
	 * @param int $offset
	 * 
	 * @return void
	 */
	public function __construct ($data, $offset = 0) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:209: lines 209-212
		if ($offset === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:209: lines 209-212
			$offset = 0;
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:210: characters 5-21
		$this->data = $data;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:211: characters 5-22
		$this->pos = $offset;
	}


	/**
	 * @return FutureObject
	 */
	public function allSafely () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:230: lines 230-232
		$ret = null;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:231: lines 231-232
		if ($this->pos === 0) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:230: lines 230-232
			$ret = $this->data;
		} else {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:232: characters 12-44
			$_this = $this->data;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:232: characters 12-44
			$pos = $this->pos;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:232: characters 12-44
			$len = $this->data->length - $this->pos;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:232: characters 12-44
			if (($pos < 0) || ($len < 0) || (($pos + $len) > $_this->length)) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:232: characters 12-44
				throw new HxException(Error::OutsideBounds());
			} else {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:230: lines 230-232
				$ret = new Bytes($len, new Container(substr($_this->b->s, $pos, $len)));
			}
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:234: characters 5-29
		$this->data = Buffer::$ZERO_BYTES;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:235: characters 5-12
		$this->pos = 0;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:237: characters 5-28
		return new SyncFuture(new LazyConst($ret));
	}


	/**
	 * @param SourceObject $other
	 * 
	 * @return SourceObject
	 */
	public function append ($other) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:243: characters 14-45
		$_g = (($other instanceof ByteSource) ? $other : null);
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:244: lines 244-245
		if ($_g === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:244: characters 20-39
			return parent::append($other);
		} else {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:245: characters 14-15
			$v = $_g;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:245: characters 17-30
			return $this->merge($v);
		}
	}


	/**
	 * @return FutureObject
	 */
	public function closeSafely () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:302: characters 5-29
		$this->data = Buffer::$ZERO_BYTES;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:303: characters 5-12
		$this->pos = 0;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:304: characters 5-30
		return new SyncFuture(new LazyConst(Noise::Noise()));
	}


	/**
	 * @param ByteSource $that
	 * 
	 * @return ByteSource
	 */
	public function merge ($that) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:257: lines 257-258
		$l1 = $this->data->length - $this->pos;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:257: lines 257-258
		$l2 = $that->data->length - $that->pos;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:260: characters 5-38
		$bytes = Bytes::alloc($l1 + $l2);
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:261: characters 5-43
		$src = $this->data;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:261: characters 5-43
		$srcpos = $this->pos;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:261: characters 5-43
		if (($srcpos < 0) || ($l1 < 0) || ($l1 > $bytes->length) || (($srcpos + $l1) > $src->length)) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:261: characters 5-43
			throw new HxException(Error::OutsideBounds());
		} else {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:261: characters 5-43
			$this1 = $bytes->b;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:261: characters 5-43
			$src1 = $src->b;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:261: characters 5-43
			$this1->s = ((substr($this1->s, 0, 0) . substr($src1->s, $srcpos, $l1)) . substr($this1->s, $l1));
		}

		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:262: characters 5-44
		$src2 = $that->data;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:262: characters 5-44
		$srcpos1 = $that->pos;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:262: characters 5-44
		if (($l1 < 0) || ($srcpos1 < 0) || ($l2 < 0) || (($l1 + $l2) > $bytes->length) || (($srcpos1 + $l2) > $src2->length)) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:262: characters 5-44
			throw new HxException(Error::OutsideBounds());
		} else {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:262: characters 5-44
			$this2 = $bytes->b;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:262: characters 5-44
			$src3 = $src2->b;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:262: characters 5-44
			$this2->s = ((substr($this2->s, 0, $l1) . substr($src3->s, $srcpos1, $l2)) . substr($this2->s, $l1 + $l2));
		}

		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:264: characters 5-36
		return new ByteSource($bytes, 0);
	}


	/**
	 * @param SinkObject $dest
	 * @param object $options
	 * 
	 * @return FutureObject
	 */
	public function pipeTo ($dest, $options = null) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:267: lines 267-293
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:268: characters 5-26
		$dest1 = $dest;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:269: characters 5-57
		$buf = Buffer::wrap($this->data, $this->pos, $this->data->length - $this->pos);
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:270: characters 5-33
		$initial = $buf->available;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:272: lines 272-292
		return Future_Impl_::async(function ($cb)  use (&$buf, &$_gthis, &$initial, &$dest1, &$options) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:274: lines 274-291
			Sink_Impl_::writeFull($dest1, $buf)->handle(function ($o)  use (&$buf, &$_gthis, &$initial, &$dest1, &$cb, &$options) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:276: characters 11-14
				$_gthis1 = $_gthis;
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:276: characters 11-41
				$_gthis1->pos = $_gthis1->pos + ($buf->available - $initial);
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:278: lines 278-287
				$tmp = null;
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:278: lines 278-287
				switch ($o->index) {
					case 0:
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:278: characters 26-27
						switch ($o->params[0]) {
							case false:
								#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:278: lines 278-287
								$tmp = PipeResult::SinkEnded();
								break;
							case true:
								#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:280: lines 280-281
								if (($options !== null) && $options->end) {
									#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:281: characters 17-29
									$dest1->close();
								}
								#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:278: lines 278-287
								$tmp = PipeResult::AllWritten();
								break;
						}
						break;
					case 1:
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:285: characters 26-27
						$e = $o->params[0];
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:278: lines 278-287
						$tmp = PipeResult::SinkFailed($e);
						break;
				}
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:278: lines 278-287
				$cb($tmp);
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:289: characters 11-48
				if ($_gthis->pos === $_gthis->data->length) {
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:289: characters 35-48
					$_gthis->closeSafely();
				}
			});
		});
	}


	/**
	 * @param SourceObject $other
	 * 
	 * @return SourceObject
	 */
	public function prepend ($other) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:250: characters 14-45
		$_g = (($other instanceof ByteSource) ? $other : null);
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:251: lines 251-252
		if ($_g === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:251: characters 20-39
			return parent::append($other);
		} else {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:252: characters 14-15
			$v = $_g;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:252: characters 17-30
			return $v->merge($this);
		}
	}


	/**
	 * @param Bytes $into
	 * @param int $offset
	 * @param int $len
	 * 
	 * @return int
	 */
	public function readBytes ($into, $offset, $len) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:216: lines 216-226
		if ($this->pos >= $this->data->length) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:217: characters 9-21
			return -1;
		} else if ($len <= 0) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:219: characters 9-22
			return 0;
		} else if (($this->pos + $len) > $this->data->length) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:221: characters 9-51
			return $this->readBytes($into, $offset, $this->data->length - $this->pos);
		} else {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:223: characters 9-42
			$src = $this->data;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:223: characters 9-42
			$srcpos = $this->pos;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:223: characters 9-42
			if (($offset < 0) || ($srcpos < 0) || ($len < 0) || (($offset + $len) > $into->length) || (($srcpos + $len) > $src->length)) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:223: characters 9-42
				throw new HxException(Error::OutsideBounds());
			} else {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:223: characters 9-42
				$this1 = $into->b;
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:223: characters 9-42
				$src1 = $src->b;
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:223: characters 9-42
				$this1->s = ((substr($this1->s, 0, $offset) . substr($src1->s, $srcpos, $len)) . substr($this1->s, $offset + $len));
			}

			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:224: characters 9-12
			$tmp = $this;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:224: characters 9-19
			$tmp->pos = $tmp->pos + $len;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:225: characters 9-12
			return $len;
		}
	}


	/**
	 * @param Buffer $into
	 * @param int $max
	 * 
	 * @return FutureObject
	 */
	public function readSafely ($into, $max = 268435456) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:299: characters 12-49
		if ($max === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:299: characters 12-49
			$max = 268435456;
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:299: characters 12-49
		return new SyncFuture(new LazyConst($into->readFrom($this, $max)));
	}


	/**
	 * @return string
	 */
	public function toString () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/IdealSource.hx:296: characters 5-47
		return "[Byte Source " . ($this->pos??'null') . "/" . ($this->data->length??'null') . "]";
	}


	public function __toString() {
		return $this->toString();
	}
}


Boot::registerClass(ByteSource::class, 'tink.io.ByteSource');
