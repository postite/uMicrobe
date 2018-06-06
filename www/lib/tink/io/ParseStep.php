<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx
 */

namespace tink\io;

use \php\Boot;
use \tink\core\TypedError;
use \php\_Boot\HxEnum;

class ParseStep extends HxEnum {
	/**
	 * @param mixed $r
	 * 
	 * @return ParseStep
	 */
	static public function Done ($r) {
		return new ParseStep('Done', 1, [$r]);
	}


	/**
	 * @param TypedError $e
	 * 
	 * @return ParseStep
	 */
	static public function Failed ($e) {
		return new ParseStep('Failed', 0, [$e]);
	}


	/**
	 * @return ParseStep
	 */
	static public function Progressed () {
		static $inst = null;
		if (!$inst) $inst = new ParseStep('Progressed', 2, []);
		return $inst;
	}


	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			1 => 'Done',
			0 => 'Failed',
			2 => 'Progressed',
		];
	}


	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'Done' => 1,
			'Failed' => 1,
			'Progressed' => 0,
		];
	}
}


Boot::registerClass(ParseStep::class, 'tink.io.ParseStep');