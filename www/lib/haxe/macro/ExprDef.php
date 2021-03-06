<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/macro/Expr.hx
 */

namespace haxe\macro;

use \php\Boot;
use \php\_Boot\HxEnum;

/**
 * Represents the kind of a node in the AST.
 */
class ExprDef extends HxEnum {
	/**
	 * Array access `e1[e2]`.
	 * 
	 * @param object $e1
	 * @param object $e2
	 * 
	 * @return ExprDef
	 */
	static public function EArray ($e1, $e2) {
		return new ExprDef('EArray', 1, [$e1, $e2]);
	}


	/**
	 * An array declaration `[el]`.
	 * 
	 * @param \Array_hx $values
	 * 
	 * @return ExprDef
	 */
	static public function EArrayDecl ($values) {
		return new ExprDef('EArrayDecl', 6, [$values]);
	}


	/**
	 * Binary operator `e1 op e2`.
	 * 
	 * @param Binop $op
	 * @param object $e1
	 * @param object $e2
	 * 
	 * @return ExprDef
	 */
	static public function EBinop ($op, $e1, $e2) {
		return new ExprDef('EBinop', 2, [$op, $e1, $e2]);
	}


	/**
	 * A block of expressions `{exprs}`.
	 * 
	 * @param \Array_hx $exprs
	 * 
	 * @return ExprDef
	 */
	static public function EBlock ($exprs) {
		return new ExprDef('EBlock', 12, [$exprs]);
	}


	/**
	 * A `break` expression.
	 * 
	 * @return ExprDef
	 */
	static public function EBreak () {
		static $inst = null;
		if (!$inst) $inst = new ExprDef('EBreak', 19, []);
		return $inst;
	}


	/**
	 * A call `e(params)`.
	 * 
	 * @param object $e
	 * @param \Array_hx $params
	 * 
	 * @return ExprDef
	 */
	static public function ECall ($e, $params) {
		return new ExprDef('ECall', 7, [$e, $params]);
	}


	/**
	 * A `cast e` or `cast (e, m)` expression.
	 * 
	 * @param object $e
	 * @param ComplexType $t
	 * 
	 * @return ExprDef
	 */
	static public function ECast ($e, $t) {
		return new ExprDef('ECast', 23, [$e, $t]);
	}


	/**
	 * A `(e:t)` expression.
	 * 
	 * @param object $e
	 * @param ComplexType $t
	 * 
	 * @return ExprDef
	 */
	static public function ECheckType ($e, $t) {
		return new ExprDef('ECheckType', 27, [$e, $t]);
	}


	/**
	 * A constant.
	 * 
	 * @param Constant $c
	 * 
	 * @return ExprDef
	 */
	static public function EConst ($c) {
		return new ExprDef('EConst', 0, [$c]);
	}


	/**
	 * A `continue` expression.
	 * 
	 * @return ExprDef
	 */
	static public function EContinue () {
		static $inst = null;
		if (!$inst) $inst = new ExprDef('EContinue', 20, []);
		return $inst;
	}


	/**
	 * Internally used to provide completion.
	 * 
	 * @param object $e
	 * @param bool $isCall
	 * 
	 * @return ExprDef
	 */
	static public function EDisplay ($e, $isCall) {
		return new ExprDef('EDisplay', 24, [$e, $isCall]);
	}


	/**
	 * Internally used to provide completion.
	 * 
	 * @param object $t
	 * 
	 * @return ExprDef
	 */
	static public function EDisplayNew ($t) {
		return new ExprDef('EDisplayNew', 25, [$t]);
	}


	/**
	 * Field access on `e.field`.
	 * 
	 * @param object $e
	 * @param string $field
	 * 
	 * @return ExprDef
	 */
	static public function EField ($e, $field) {
		return new ExprDef('EField', 3, [$e, $field]);
	}


	/**
	 * A `for` expression.
	 * 
	 * @param object $it
	 * @param object $expr
	 * 
	 * @return ExprDef
	 */
	static public function EFor ($it, $expr) {
		return new ExprDef('EFor', 13, [$it, $expr]);
	}


	/**
	 * A function declaration.
	 * 
	 * @param string $name
	 * @param object $f
	 * 
	 * @return ExprDef
	 */
	static public function EFunction ($name, $f) {
		return new ExprDef('EFunction', 11, [$name, $f]);
	}


	/**
	 * An `if(econd) eif` or `if(econd) eif else eelse` expression.
	 * 
	 * @param object $econd
	 * @param object $eif
	 * @param object $eelse
	 * 
	 * @return ExprDef
	 */
	static public function EIf ($econd, $eif, $eelse) {
		return new ExprDef('EIf', 14, [$econd, $eif, $eelse]);
	}


	/**
	 * A `@m e` expression.
	 * 
	 * @param object $s
	 * @param object $e
	 * 
	 * @return ExprDef
	 */
	static public function EMeta ($s, $e) {
		return new ExprDef('EMeta', 28, [$s, $e]);
	}


	/**
	 * A constructor call `new t(params)`.
	 * 
	 * @param object $t
	 * @param \Array_hx $params
	 * 
	 * @return ExprDef
	 */
	static public function ENew ($t, $params) {
		return new ExprDef('ENew', 8, [$t, $params]);
	}


	/**
	 * An object declaration.
	 * 
	 * @param \Array_hx $fields
	 * 
	 * @return ExprDef
	 */
	static public function EObjectDecl ($fields) {
		return new ExprDef('EObjectDecl', 5, [$fields]);
	}


	/**
	 * Parentheses `(e)`.
	 * 
	 * @param object $e
	 * 
	 * @return ExprDef
	 */
	static public function EParenthesis ($e) {
		return new ExprDef('EParenthesis', 4, [$e]);
	}


	/**
	 * A `return` or `return e` expression.
	 * 
	 * @param object $e
	 * 
	 * @return ExprDef
	 */
	static public function EReturn ($e = null) {
		return new ExprDef('EReturn', 18, [$e]);
	}


	/**
	 * Represents a `switch` expression with related cases and an optional.
	 * `default` case if edef != null.
	 * 
	 * @param object $e
	 * @param \Array_hx $cases
	 * @param object $edef
	 * 
	 * @return ExprDef
	 */
	static public function ESwitch ($e, $cases, $edef) {
		return new ExprDef('ESwitch', 16, [$e, $cases, $edef]);
	}


	/**
	 * A `(econd) ? eif : eelse` expression.
	 * 
	 * @param object $econd
	 * @param object $eif
	 * @param object $eelse
	 * 
	 * @return ExprDef
	 */
	static public function ETernary ($econd, $eif, $eelse) {
		return new ExprDef('ETernary', 26, [$econd, $eif, $eelse]);
	}


	/**
	 * A `throw e` expression.
	 * 
	 * @param object $e
	 * 
	 * @return ExprDef
	 */
	static public function EThrow ($e) {
		return new ExprDef('EThrow', 22, [$e]);
	}


	/**
	 * Represents a `try`-expression with related catches.
	 * 
	 * @param object $e
	 * @param \Array_hx $catches
	 * 
	 * @return ExprDef
	 */
	static public function ETry ($e, $catches) {
		return new ExprDef('ETry', 17, [$e, $catches]);
	}


	/**
	 * An unary operator `op` on `e`:
	 * e++ (op = OpIncrement, postFix = true)
	 * e-- (op = OpDecrement, postFix = true)
	 * ++e (op = OpIncrement, postFix = false)
	 * --e (op = OpDecrement, postFix = false)
	 * -e (op = OpNeg, postFix = false)
	 * !e (op = OpNot, postFix = false)
	 * ~e (op = OpNegBits, postFix = false)
	 * 
	 * @param Unop $op
	 * @param bool $postFix
	 * @param object $e
	 * 
	 * @return ExprDef
	 */
	static public function EUnop ($op, $postFix, $e) {
		return new ExprDef('EUnop', 9, [$op, $postFix, $e]);
	}


	/**
	 * An `untyped e` source code.
	 * 
	 * @param object $e
	 * 
	 * @return ExprDef
	 */
	static public function EUntyped ($e) {
		return new ExprDef('EUntyped', 21, [$e]);
	}


	/**
	 * Variable declarations.
	 * 
	 * @param \Array_hx $vars
	 * 
	 * @return ExprDef
	 */
	static public function EVars ($vars) {
		return new ExprDef('EVars', 10, [$vars]);
	}


	/**
	 * Represents a `while` expression.
	 * When `normalWhile` is `true` it is `while (...)`.
	 * When `normalWhile` is `false` it is `do {...} while (...)`.
	 * 
	 * @param object $econd
	 * @param object $e
	 * @param bool $normalWhile
	 * 
	 * @return ExprDef
	 */
	static public function EWhile ($econd, $e, $normalWhile) {
		return new ExprDef('EWhile', 15, [$econd, $e, $normalWhile]);
	}


	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			1 => 'EArray',
			6 => 'EArrayDecl',
			2 => 'EBinop',
			12 => 'EBlock',
			19 => 'EBreak',
			7 => 'ECall',
			23 => 'ECast',
			27 => 'ECheckType',
			0 => 'EConst',
			20 => 'EContinue',
			24 => 'EDisplay',
			25 => 'EDisplayNew',
			3 => 'EField',
			13 => 'EFor',
			11 => 'EFunction',
			14 => 'EIf',
			28 => 'EMeta',
			8 => 'ENew',
			5 => 'EObjectDecl',
			4 => 'EParenthesis',
			18 => 'EReturn',
			16 => 'ESwitch',
			26 => 'ETernary',
			22 => 'EThrow',
			17 => 'ETry',
			9 => 'EUnop',
			21 => 'EUntyped',
			10 => 'EVars',
			15 => 'EWhile',
		];
	}


	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'EArray' => 2,
			'EArrayDecl' => 1,
			'EBinop' => 3,
			'EBlock' => 1,
			'EBreak' => 0,
			'ECall' => 2,
			'ECast' => 2,
			'ECheckType' => 2,
			'EConst' => 1,
			'EContinue' => 0,
			'EDisplay' => 2,
			'EDisplayNew' => 1,
			'EField' => 2,
			'EFor' => 2,
			'EFunction' => 2,
			'EIf' => 3,
			'EMeta' => 2,
			'ENew' => 2,
			'EObjectDecl' => 1,
			'EParenthesis' => 1,
			'EReturn' => 1,
			'ESwitch' => 3,
			'ETernary' => 3,
			'EThrow' => 1,
			'ETry' => 2,
			'EUnop' => 3,
			'EUntyped' => 1,
			'EVars' => 1,
			'EWhile' => 3,
		];
	}
}


Boot::registerClass(ExprDef::class, 'haxe.macro.ExprDef');
