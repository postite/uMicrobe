<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx
 */

namespace tink\streams\_Stream;

use \php\Boot;
use \tink\streams\StreamMapFilter;
use \tink\streams\StreamObject;

final class StreamMap_Impl_ {
	/**
	 * @param StreamObject $data
	 * @param \Closure $map
	 * 
	 * @return StreamMapFilter
	 */
	static public function _new ($data, $map) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:381: character 17
		$this1 = new StreamMapFilter($data, StreamMap_Impl_::lift($map));
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:381: character 17
		return $this1;
	}


	/**
	 * @param \Closure $map
	 * 
	 * @return \Closure
	 */
	static public function lift ($map) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:385: characters 5-50
		return function ($x)  use (&$map) {
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:385: characters 32-50
			$this1 = $map($x);
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:385: characters 32-50
			return $this1;
		};
	}
}


Boot::registerClass(StreamMap_Impl_::class, 'tink.streams._Stream.StreamMap_Impl_');
