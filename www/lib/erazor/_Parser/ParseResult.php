<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Parser.hx
 */

namespace erazor\_Parser;

use \php\Boot;
use \php\_Boot\HxEnum;

class ParseResult extends HxEnum {
	/**
	 * @return ParseResult
	 */
	static public function doneIncludeCurrent () {
		static $inst = null;
		if (!$inst) $inst = new ParseResult('doneIncludeCurrent', 1, []);
		return $inst;
	}


	/**
	 * @return ParseResult
	 */
	static public function doneSkipCurrent () {
		static $inst = null;
		if (!$inst) $inst = new ParseResult('doneSkipCurrent', 2, []);
		return $inst;
	}


	/**
	 * @return ParseResult
	 */
	static public function keepGoing () {
		static $inst = null;
		if (!$inst) $inst = new ParseResult('keepGoing', 0, []);
		return $inst;
	}


	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			1 => 'doneIncludeCurrent',
			2 => 'doneSkipCurrent',
			0 => 'keepGoing',
		];
	}


	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'doneIncludeCurrent' => 0,
			'doneSkipCurrent' => 0,
			'keepGoing' => 0,
		];
	}
}


Boot::registerClass(ParseResult::class, 'erazor._Parser.ParseResult');
