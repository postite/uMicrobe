<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx
 */

namespace tink\io\_Source;

use \tink\core\Outcome;
use \php\Boot;
use \tink\core\_Future\FutureObject;
use \tink\core\_Future\SyncFuture;
use \tink\io\SourceBase;
use \tink\core\_Future\Future_Impl_;
use \tink\io\Buffer;
use \tink\io\SourceObject;
use \tink\core\_Lazy\LazyConst;

class LimitedSource extends SourceBase {
	/**
	 * @var int
	 */
	public $bytesRead;
	/**
	 * @var int
	 */
	public $limit;
	/**
	 * @var int
	 */
	public $surplus;
	/**
	 * @var SourceObject
	 */
	public $target;


	/**
	 * @param SourceObject $target
	 * @param int $limit
	 * 
	 * @return void
	 */
	public function __construct ($target, $limit) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:263: characters 17-18
		$this->surplus = 0;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:261: characters 19-20
		$this->bytesRead = 0;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:266: characters 5-25
		$this->target = $target;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:267: characters 5-23
		$this->limit = $limit;
	}


	/**
	 * @param Buffer $into
	 * @param int $maxb
	 * 
	 * @return FutureObject
	 */
	public function read ($into, $maxb = 1073741824) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:270: lines 270-285
		if ($maxb === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:270: lines 270-285
			$maxb = 1073741824;
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:270: lines 270-285
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:272: lines 272-285
		if ($this->bytesRead >= $this->limit) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:273: characters 9-43
			return new SyncFuture(new LazyConst(Outcome::Success(-1)));
		} else {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:275: lines 275-285
			return Future_Impl_::async(function ($cb)  use (&$_gthis, &$into, &$maxb) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:276: lines 276-277
				if ($maxb > ($_gthis->limit - $_gthis->bytesRead)) {
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:277: characters 13-37
					$maxb = $_gthis->limit - $_gthis->bytesRead;
				}
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:278: lines 278-284
				$_gthis->target->read($into, $maxb)->handle(function ($x)  use (&$_gthis, &$cb) {
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:279: lines 279-282
					if ($x->index === 0) {
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:280: characters 28-29
						$p = $x->params[0];
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:280: characters 32-41
						$_gthis1 = $_gthis;
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:280: characters 32-52
						$_gthis1->bytesRead = $_gthis1->bytesRead + (($p < 0 ? 0 : $p));
					}
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:283: characters 13-18
					$cb($x);
				});
			});
		}
	}
}


Boot::registerClass(LimitedSource::class, 'tink.io._Source.LimitedSource');
