<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Progress.hx
 */

namespace tink\io\_Progress;

use \php\Boot;

final class Progress_Impl_ {




	/**
	 * @param int $v
	 * 
	 * @return int
	 */
	static public function _new ($v) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Progress.hx:14: character 10
		$this1 = $v;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Progress.hx:14: character 10
		return $this1;
	}


	/**
	 * @param int $amount
	 * 
	 * @return int
	 */
	static public function by ($amount) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Progress.hx:17: characters 12-32
		$this1 = $amount;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Progress.hx:17: characters 12-32
		return $this1;
	}


	/**
	 * @param int $this
	 * 
	 * @return int
	 */
	static public function get_bytes ($this1) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Progress.hx:12: characters 14-35
		if ($this1 < 0) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Progress.hx:12: characters 27-28
			return 0;
		} else {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Progress.hx:12: characters 31-35
			return $this1;
		}
	}


	/**
	 * @param int $this
	 * 
	 * @return bool
	 */
	static public function get_isEof ($this1) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Progress.hx:7: characters 7-22
		return $this1 < 0;
	}


	/**
	 * @param int $this
	 * 
	 * @return bool
	 */
	static public function toBool ($this1) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/Progress.hx:20: characters 5-20
		return $this1 > 0;
	}
}


Boot::registerClass(Progress_Impl_::class, 'tink.io._Progress.Progress_Impl_');
Boot::registerGetters('tink\\io\\_Progress\\Progress_Impl_', [
	'bytes' => true,
	'isEof' => true
]);