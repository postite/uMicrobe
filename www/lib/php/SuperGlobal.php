<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/php/SuperGlobal.hx
 */

namespace php;


class SuperGlobal {


	/**
	 * @return mixed
	 */
	static public function get_GLOBALS () {
		#/usr/local/lib/haxe/std/php/SuperGlobal.hx:8: characters 42-72
		return $GLOBALS;
	}


	/**
	 * @return mixed
	 */
	static public function get__COOKIE () {
		#/usr/local/lib/haxe/std/php/SuperGlobal.hx:38: characters 42-72
		return $_COOKIE;
	}


	/**
	 * @return mixed
	 */
	static public function get__ENV () {
		#/usr/local/lib/haxe/std/php/SuperGlobal.hx:56: characters 39-66
		return $_ENV;
	}


	/**
	 * @return mixed
	 */
	static public function get__FILES () {
		#/usr/local/lib/haxe/std/php/SuperGlobal.hx:32: characters 41-70
		return $_FILES;
	}


	/**
	 * @return mixed
	 */
	static public function get__GET () {
		#/usr/local/lib/haxe/std/php/SuperGlobal.hx:20: characters 39-66
		return $_GET;
	}


	/**
	 * @return mixed
	 */
	static public function get__POST () {
		#/usr/local/lib/haxe/std/php/SuperGlobal.hx:26: characters 40-68
		return $_POST;
	}


	/**
	 * @return mixed
	 */
	static public function get__REQUEST () {
		#/usr/local/lib/haxe/std/php/SuperGlobal.hx:50: characters 43-74
		return $_REQUEST;
	}


	/**
	 * @return mixed
	 */
	static public function get__SERVER () {
		#/usr/local/lib/haxe/std/php/SuperGlobal.hx:14: characters 42-72
		return $_SERVER;
	}


	/**
	 * @return mixed
	 */
	static public function get__SESSION () {
		#/usr/local/lib/haxe/std/php/SuperGlobal.hx:44: characters 43-74
		return $_SESSION;
	}
}


Boot::registerClass(SuperGlobal::class, 'php.SuperGlobal');
Boot::registerGetters('php\\SuperGlobal', [
	'_ENV' => true,
	'_REQUEST' => true,
	'_SESSION' => true,
	'_COOKIE' => true,
	'_FILES' => true,
	'_POST' => true,
	'_GET' => true,
	'_SERVER' => true,
	'GLOBALS' => true
]);