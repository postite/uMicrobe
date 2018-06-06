<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/macro/Expr.hx
 */

namespace haxe\macro;

use \php\Boot;
use \php\_Boot\HxEnum;

/**
 * Represents the field type in the AST.
 */
class FieldType extends HxEnum {
	/**
	 * Represents a function field type.
	 * 
	 * @param object $f
	 * 
	 * @return FieldType
	 */
	static public function FFun ($f) {
		return new FieldType('FFun', 1, [$f]);
	}


	/**
	 * Represents a property with getter and setter field type.
	 * 
	 * @param string $get
	 * @param string $set
	 * @param ComplexType $t
	 * @param object $e
	 * 
	 * @return FieldType
	 */
	static public function FProp ($get, $set, $t = null, $e = null) {
		return new FieldType('FProp', 2, [$get, $set, $t, $e]);
	}


	/**
	 * Represents a variable field type.
	 * 
	 * @param ComplexType $t
	 * @param object $e
	 * 
	 * @return FieldType
	 */
	static public function FVar ($t, $e = null) {
		return new FieldType('FVar', 0, [$t, $e]);
	}


	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			1 => 'FFun',
			2 => 'FProp',
			0 => 'FVar',
		];
	}


	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'FFun' => 1,
			'FProp' => 4,
			'FVar' => 2,
		];
	}
}


Boot::registerClass(FieldType::class, 'haxe.macro.FieldType');
