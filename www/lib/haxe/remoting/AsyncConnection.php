<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/hx3compat/git/std/haxe/remoting/AsyncConnection.hx
 */

namespace haxe\remoting;

use \php\Boot;
use \php\_Boot\HxAnon;

/**
 * For asynchronous connections, where the results are events that will be resolved later in the execution process.
 */
interface AsyncConnection {
	/**
	 * @param \Array_hx $params
	 * @param \Closure $result
	 * 
	 * @return void
	 */
	public function call ($params, $result = null) ;


	/**
	 * @param string $name
	 * 
	 * @return AsyncConnection
	 */
	public function resolve ($name) ;


	/**
	 * @param \Closure $error
	 * 
	 * @return void
	 */
	public function setErrorHandler ($error) ;
}


Boot::registerClass(AsyncConnection::class, 'haxe.remoting.AsyncConnection');
Boot::registerMeta(AsyncConnection::class, new HxAnon(["obj" => new HxAnon(["interface" => null])]));
