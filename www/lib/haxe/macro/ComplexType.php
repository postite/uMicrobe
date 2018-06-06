<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/macro/Expr.hx
 */

namespace haxe\macro;

use \php\Boot;
use \php\_Boot\HxEnum;

/**
 * Represents a type syntax in the AST.
 */
class ComplexType extends HxEnum {
	/**
	 * Represents an anonymous structure type.
	 * @see https://haxe.org/manual/types-anonymous-structure.html
	 * 
	 * @param \Array_hx $fields
	 * 
	 * @return ComplexType
	 */
	static public function TAnonymous ($fields) {
		return new ComplexType('TAnonymous', 2, [$fields]);
	}


	/**
	 * Represents typedef extensions `> Iterable<T>`.
	 * The array `p` holds the type paths to the given types.
	 * @see https://haxe.org/manual/type-system-extensions.html
	 * 
	 * @param \Array_hx $p
	 * @param \Array_hx $fields
	 * 
	 * @return ComplexType
	 */
	static public function TExtend ($p, $fields) {
		return new ComplexType('TExtend', 4, [$p, $fields]);
	}


	/**
	 * Represents a function type.
	 * @see https://haxe.org/manual/types-function.html
	 * 
	 * @param \Array_hx $args
	 * @param ComplexType $ret
	 * 
	 * @return ComplexType
	 */
	static public function TFunction ($args, $ret) {
		return new ComplexType('TFunction', 1, [$args, $ret]);
	}


	/**
	 * Represents a type with a name.
	 * 
	 * @param string $n
	 * @param ComplexType $t
	 * 
	 * @return ComplexType
	 */
	static public function TNamed ($n, $t) {
		return new ComplexType('TNamed', 6, [$n, $t]);
	}


	/**
	 * Represents an optional type.
	 * 
	 * @param ComplexType $t
	 * 
	 * @return ComplexType
	 */
	static public function TOptional ($t) {
		return new ComplexType('TOptional', 5, [$t]);
	}


	/**
	 * Represents parentheses around a type, e.g. the `(Int -> Void)` part in
	 * `(Int -> Void) -> String`.
	 * 
	 * @param ComplexType $t
	 * 
	 * @return ComplexType
	 */
	static public function TParent ($t) {
		return new ComplexType('TParent', 3, [$t]);
	}


	/**
	 * Represents the type path.
	 * 
	 * @param object $p
	 * 
	 * @return ComplexType
	 */
	static public function TPath ($p) {
		return new ComplexType('TPath', 0, [$p]);
	}


	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			2 => 'TAnonymous',
			4 => 'TExtend',
			1 => 'TFunction',
			6 => 'TNamed',
			5 => 'TOptional',
			3 => 'TParent',
			0 => 'TPath',
		];
	}


	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'TAnonymous' => 1,
			'TExtend' => 2,
			'TFunction' => 2,
			'TNamed' => 2,
			'TOptional' => 1,
			'TParent' => 1,
			'TPath' => 1,
		];
	}
}


Boot::registerClass(ComplexType::class, 'haxe.macro.ComplexType');
