<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx
 */

namespace tink\io\_Source;

use \php\Boot;
use \tink\core\_Future\FutureObject;
use \tink\io\SourceBase;
use \tink\io\Buffer;

class SimpleSource extends SourceBase {
	/**
	 * @var \Closure
	 */
	public $closer;
	/**
	 * @var \Closure
	 */
	public $reader;


	/**
	 * @param \Closure $reader
	 * @param \Closure $closer
	 * 
	 * @return void
	 */
	public function __construct ($reader, $closer = null) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:102: characters 5-25
		$this->reader = $reader;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:103: characters 5-25
		$this->closer = $closer;
	}


	/**
	 * @return FutureObject
	 */
	public function close () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:108: lines 108-109
		if ($this->closer === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:108: characters 32-45
			return parent::close();
		} else {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:109: characters 12-20
			return ($this->closer)();
		}
	}


	/**
	 * @param Buffer $into
	 * @param int $max
	 * 
	 * @return FutureObject
	 */
	public function read ($into, $max = 1073741824) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:112: characters 5-29
		if ($max === null) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:112: characters 5-29
			$max = 1073741824;
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Source.hx:112: characters 5-29
		return ($this->reader)($into, $max);
	}
}


Boot::registerClass(SimpleSource::class, 'tink.io._Source.SimpleSource');
