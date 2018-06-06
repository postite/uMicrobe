<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx
 */

namespace tink\streams;

use \php\Boot;
use \tink\core\_Future\FutureObject;
use \php\_Boot\HxAnon;

interface StreamObject {
	/**
	 * @param \Closure $item
	 * 
	 * @return StreamObject
	 */
	public function filter ($item) ;


	/**
	 * @param \Closure $item
	 * 
	 * @return StreamObject
	 */
	public function filterAsync ($item) ;


	/**
	 * @param \Closure $item
	 * 
	 * @return FutureObject
	 */
	public function forEach ($item) ;


	/**
	 * @param \Closure $item
	 * 
	 * @return FutureObject
	 */
	public function forEachAsync ($item) ;


	/**
	 * @param \Closure $item
	 * 
	 * @return StreamObject
	 */
	public function map ($item) ;


	/**
	 * @param \Closure $item
	 * 
	 * @return StreamObject
	 */
	public function mapAsync ($item) ;


	/**
	 * @param \Closure $item
	 * 
	 * @return StreamObject
	 */
	public function merge ($item) ;


	/**
	 * @param \Closure $item
	 * 
	 * @return StreamObject
	 */
	public function mergeAsync ($item) ;


	/**
	 * @return FutureObject
	 */
	public function next () ;
}


Boot::registerClass(StreamObject::class, 'tink.streams.StreamObject');
Boot::registerMeta(StreamObject::class, new HxAnon(["obj" => new HxAnon(["interface" => null])]));
