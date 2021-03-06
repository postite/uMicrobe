<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx
 */

namespace tink\streams\_Stream;

use \tink\streams\StreamMapFilterAsync;
use \php\Boot;
use \tink\streams\StreamObject;

final class StreamMergeAsync_Impl_ {
	/**
	 * @param StreamObject $data
	 * @param \Closure $merger
	 * 
	 * @return StreamMapFilterAsync
	 */
	static public function _new ($data, $merger) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:479: character 17
		$this1 = new StreamMapFilterAsync($data, StreamMergeAsync_Impl_::lift($merger));
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:479: character 17
		return $this1;
	}


	/**
	 * @param \Closure $merger
	 * 
	 * @return \Closure
	 */
	static public function lift ($merger) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:483: characters 5-21
		$buffer = new \Array_hx();
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:484: lines 484-493
		return function ($x)  use (&$buffer, &$merger) {
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:485: characters 7-21
			$buffer->arr[$buffer->length] = $x;
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:485: characters 7-21
			++$buffer->length;

			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:486: lines 486-492
			$ret = $merger($buffer)->map(function ($o)  use (&$buffer) {
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:486: lines 486-492
				switch ($o->index) {
					case 0:
						#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:487: characters 19-20
						$v = $o->params[0];
						#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:488: characters 11-22
						$buffer = new \Array_hx();
						#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:489: characters 11-24
						$this1 = $v;
						#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:489: characters 11-24
						return $this1;
						break;
					case 1:
						#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:491: characters 11-23
						return null;
						break;
				}
			});
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:486: lines 486-492
			return $ret->gather();
		};
	}
}


Boot::registerClass(StreamMergeAsync_Impl_::class, 'tink.streams._Stream.StreamMergeAsync_Impl_');
