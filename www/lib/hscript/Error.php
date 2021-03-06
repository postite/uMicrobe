<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/hscript/2,2,0/hscript/Expr.hx
 */

namespace hscript;

use \php\Boot;
use \php\_Boot\HxEnum;

class Error extends HxEnum {
	/**
	 * @param string $msg
	 * 
	 * @return Error
	 */
	static public function ECustom ($msg) {
		return new Error('ECustom', 9, [$msg]);
	}


	/**
	 * @param string $f
	 * 
	 * @return Error
	 */
	static public function EInvalidAccess ($f) {
		return new Error('EInvalidAccess', 8, [$f]);
	}


	/**
	 * @param int $c
	 * 
	 * @return Error
	 */
	static public function EInvalidChar ($c) {
		return new Error('EInvalidChar', 0, [$c]);
	}


	/**
	 * @param string $v
	 * 
	 * @return Error
	 */
	static public function EInvalidIterator ($v) {
		return new Error('EInvalidIterator', 6, [$v]);
	}


	/**
	 * @param string $op
	 * 
	 * @return Error
	 */
	static public function EInvalidOp ($op) {
		return new Error('EInvalidOp', 7, [$op]);
	}


	/**
	 * @param string $msg
	 * 
	 * @return Error
	 */
	static public function EInvalidPreprocessor ($msg) {
		return new Error('EInvalidPreprocessor', 4, [$msg]);
	}


	/**
	 * @param string $s
	 * 
	 * @return Error
	 */
	static public function EUnexpected ($s) {
		return new Error('EUnexpected', 1, [$s]);
	}


	/**
	 * @param string $v
	 * 
	 * @return Error
	 */
	static public function EUnknownVariable ($v) {
		return new Error('EUnknownVariable', 5, [$v]);
	}


	/**
	 * @return Error
	 */
	static public function EUnterminatedComment () {
		static $inst = null;
		if (!$inst) $inst = new Error('EUnterminatedComment', 3, []);
		return $inst;
	}


	/**
	 * @return Error
	 */
	static public function EUnterminatedString () {
		static $inst = null;
		if (!$inst) $inst = new Error('EUnterminatedString', 2, []);
		return $inst;
	}


	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			9 => 'ECustom',
			8 => 'EInvalidAccess',
			0 => 'EInvalidChar',
			6 => 'EInvalidIterator',
			7 => 'EInvalidOp',
			4 => 'EInvalidPreprocessor',
			1 => 'EUnexpected',
			5 => 'EUnknownVariable',
			3 => 'EUnterminatedComment',
			2 => 'EUnterminatedString',
		];
	}


	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'ECustom' => 1,
			'EInvalidAccess' => 1,
			'EInvalidChar' => 1,
			'EInvalidIterator' => 1,
			'EInvalidOp' => 1,
			'EInvalidPreprocessor' => 1,
			'EUnexpected' => 1,
			'EUnknownVariable' => 1,
			'EUnterminatedComment' => 0,
			'EUnterminatedString' => 0,
		];
	}
}


Boot::registerClass(Error::class, 'hscript.Error');
