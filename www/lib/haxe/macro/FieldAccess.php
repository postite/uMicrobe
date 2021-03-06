<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/macro/Type.hx
 */

namespace haxe\macro;

use \php\Boot;
use \php\_Boot\HxEnum;

/**
 * Represents the kind of field access in the typed AST.
 */
class FieldAccess extends HxEnum {
	/**
	 * Access of field `cf` on an anonymous structure.
	 * 
	 * @param object $cf
	 * 
	 * @return FieldAccess
	 */
	static public function FAnon ($cf) {
		return new FieldAccess('FAnon', 2, [$cf]);
	}


	/**
	 * Closure field access of field `cf` on a class instance `c` with type
	 * parameters `params`.
	 * 
	 * @param object $c
	 * @param object $cf
	 * 
	 * @return FieldAccess
	 */
	static public function FClosure ($c, $cf) {
		return new FieldAccess('FClosure', 4, [$c, $cf]);
	}


	/**
	 * Dynamic field access of a field named `s`.
	 * 
	 * @param string $s
	 * 
	 * @return FieldAccess
	 */
	static public function FDynamic ($s) {
		return new FieldAccess('FDynamic', 3, [$s]);
	}


	/**
	 * Field access to an enum constructor `ef` of enum `e`.
	 * 
	 * @param object $e
	 * @param object $ef
	 * 
	 * @return FieldAccess
	 */
	static public function FEnum ($e, $ef) {
		return new FieldAccess('FEnum', 5, [$e, $ef]);
	}


	/**
	 * Access of field `cf` on a class instance `c` with type parameters
	 * `params`.
	 * 
	 * @param object $c
	 * @param \Array_hx $params
	 * @param object $cf
	 * 
	 * @return FieldAccess
	 */
	static public function FInstance ($c, $params, $cf) {
		return new FieldAccess('FInstance', 0, [$c, $params, $cf]);
	}


	/**
	 * Static access of a field `cf` on a class `c`.
	 * 
	 * @param object $c
	 * @param object $cf
	 * 
	 * @return FieldAccess
	 */
	static public function FStatic ($c, $cf) {
		return new FieldAccess('FStatic', 1, [$c, $cf]);
	}


	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			2 => 'FAnon',
			4 => 'FClosure',
			3 => 'FDynamic',
			5 => 'FEnum',
			0 => 'FInstance',
			1 => 'FStatic',
		];
	}


	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'FAnon' => 1,
			'FClosure' => 2,
			'FDynamic' => 1,
			'FEnum' => 2,
			'FInstance' => 3,
			'FStatic' => 2,
		];
	}
}


Boot::registerClass(FieldAccess::class, 'haxe.macro.FieldAccess');
