<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/remoting/Connection.hx
 */

namespace haxe\remoting;

use \php\Boot;
use \php\_Boot\HxAnon;

interface Connection {
	/**
	 * @param \Array_hx $params
	 * 
	 * @return mixed
	 */
	public function call ($params) ;


	/**
	 * @param string $name
	 * 
	 * @return Connection
	 */
	public function resolve ($name) ;
}


Boot::registerClass(Connection::class, 'haxe.remoting.Connection');
Boot::registerMeta(Connection::class, new HxAnon(["obj" => new HxAnon(["interface" => null])]));
