<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/rtti/Meta.hx
 */

namespace haxe\rtti;

use \php\_Boot\HxException;
use \php\Boot;
use \php\_Boot\HxAnon;

/**
 * An API to access classes and enums metadata at runtime.
 * @see <https://haxe.org/manual/cr-rtti.html>
 */
class Meta {
	/**
	 * Returns the metadata that were declared for the given class fields or enum constructors
	 * 
	 * @param mixed $t
	 * 
	 * @return mixed
	 */
	static public function getFields ($t) {
		#/usr/local/lib/haxe/std/haxe/rtti/Meta.hx:94: characters 3-25
		$meta = Meta::getMeta($t);
		#/usr/local/lib/haxe/std/haxe/rtti/Meta.hx:95: characters 10-66
		if (($meta === null) || ($meta->fields === null)) {
			#/usr/local/lib/haxe/std/haxe/rtti/Meta.hx:95: characters 50-52
			return new HxAnon();
		} else {
			#/usr/local/lib/haxe/std/haxe/rtti/Meta.hx:95: characters 55-66
			return $meta->fields;
		}
	}


	/**
	 * @param mixed $t
	 * 
	 * @return object
	 */
	static public function getMeta ($t) {
		#/usr/local/lib/haxe/std/haxe/rtti/Meta.hx:60: characters 4-43
		return Boot::getMeta(Boot::dynamicField($t, 'phpClassName'));
	}


	/**
	 * Returns the metadata that were declared for the given class static fields
	 * 
	 * @param mixed $t
	 * 
	 * @return mixed
	 */
	static public function getStatics ($t) {
		#/usr/local/lib/haxe/std/haxe/rtti/Meta.hx:86: characters 3-25
		$meta = Meta::getMeta($t);
		#/usr/local/lib/haxe/std/haxe/rtti/Meta.hx:87: characters 10-68
		if (($meta === null) || ($meta->statics === null)) {
			#/usr/local/lib/haxe/std/haxe/rtti/Meta.hx:87: characters 51-53
			return new HxAnon();
		} else {
			#/usr/local/lib/haxe/std/haxe/rtti/Meta.hx:87: characters 56-68
			return $meta->statics;
		}
	}


	/**
	 * Returns the metadata that were declared for the given type (class or enum)
	 * 
	 * @param mixed $t
	 * 
	 * @return mixed
	 */
	static public function getType ($t) {
		#/usr/local/lib/haxe/std/haxe/rtti/Meta.hx:41: characters 3-25
		$meta = Meta::getMeta($t);
		#/usr/local/lib/haxe/std/haxe/rtti/Meta.hx:42: characters 10-60
		if (($meta === null) || ($meta->obj === null)) {
			#/usr/local/lib/haxe/std/haxe/rtti/Meta.hx:42: characters 47-49
			return new HxAnon();
		} else {
			#/usr/local/lib/haxe/std/haxe/rtti/Meta.hx:42: characters 52-60
			return $meta->obj;
		}
	}


	/**
	 * @param mixed $t
	 * 
	 * @return bool
	 */
	static public function isInterface ($t) {
		#/usr/local/lib/haxe/std/haxe/rtti/Meta.hx:54: characters 4-9
		throw new HxException("Something went wrong");
	}
}


Boot::registerClass(Meta::class, 'haxe.rtti.Meta');