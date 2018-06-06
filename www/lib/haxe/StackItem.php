<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/php/_std/haxe/CallStack.hx
 */

namespace haxe;

use \php\Boot;
use \php\_Boot\HxEnum;

/**
 * Elements return by `CallStack` methods.
 */
class StackItem extends HxEnum {
	/**
	 * @return StackItem
	 */
	static public function CFunction () {
		static $inst = null;
		if (!$inst) $inst = new StackItem('CFunction', 0, []);
		return $inst;
	}


	/**
	 * @param StackItem $s
	 * @param string $file
	 * @param int $line
	 * @param int $column
	 * 
	 * @return StackItem
	 */
	static public function FilePos ($s, $file, $line, $column = null) {
		return new StackItem('FilePos', 2, [$s, $file, $line, $column]);
	}


	/**
	 * @param int $v
	 * 
	 * @return StackItem
	 */
	static public function LocalFunction ($v = null) {
		return new StackItem('LocalFunction', 4, [$v]);
	}


	/**
	 * @param string $classname
	 * @param string $method
	 * 
	 * @return StackItem
	 */
	static public function Method ($classname, $method) {
		return new StackItem('Method', 3, [$classname, $method]);
	}


	/**
	 * @param string $m
	 * 
	 * @return StackItem
	 */
	static public function Module ($m) {
		return new StackItem('Module', 1, [$m]);
	}


	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			0 => 'CFunction',
			2 => 'FilePos',
			4 => 'LocalFunction',
			3 => 'Method',
			1 => 'Module',
		];
	}


	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'CFunction' => 0,
			'FilePos' => 4,
			'LocalFunction' => 1,
			'Method' => 2,
			'Module' => 1,
		];
	}
}


Boot::registerClass(StackItem::class, 'haxe.StackItem');
