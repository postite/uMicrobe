<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Buffer.hx
 */

namespace tink\io\_Buffer;

use \php\Boot;

class Mutex {
	/**
	 * @return void
	 */
	public function __construct () {
	}


	/**
	 * @param \Closure $f
	 * 
	 * @return mixed
	 */
	public function synchronized ($f) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Buffer.hx:312: characters 53-63
		return $f();
	}
}


Boot::registerClass(Mutex::class, 'tink.io._Buffer.Mutex');