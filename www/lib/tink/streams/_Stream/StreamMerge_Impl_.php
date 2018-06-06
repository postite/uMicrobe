<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx
 */

namespace tink\streams\_Stream;

use \php\Boot;
use \tink\streams\StreamMapFilter;
use \tink\streams\StreamObject;

final class StreamMerge_Impl_ {
	/**
	 * @param StreamObject $data
	 * @param \Closure $merger
	 * 
	 * @return StreamMapFilter
	 */
	static public function _new ($data, $merger) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:389: character 17
		$this1 = new StreamMapFilter($data, StreamMerge_Impl_::lift($merger));
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:389: character 17
		return $this1;
	}


	/**
	 * @param \Closure $merger
	 * 
	 * @return \Closure
	 */
	static public function lift ($merger) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:393: characters 5-21
		$buffer = new \Array_hx();
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:394: lines 394-403
		return function ($x)  use (&$buffer, &$merger) {
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:395: characters 7-21
			$buffer->arr[$buffer->length] = $x;
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:395: characters 7-21
			++$buffer->length;

			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:396: characters 21-35
			$_g = $merger($buffer);
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:396: characters 21-35
			switch ($_g->index) {
				case 0:
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:397: characters 19-20
					$v = $_g->params[0];
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:398: characters 11-22
					$buffer = new \Array_hx();
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:399: characters 11-24
					$this1 = $v;
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:399: characters 11-24
					return $this1;
					break;
				case 1:
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:401: characters 11-23
					return null;
					break;
			}
		};
	}
}


Boot::registerClass(StreamMerge_Impl_::class, 'tink.streams._Stream.StreamMerge_Impl_');
