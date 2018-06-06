<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: src/microbe/comps/wrappers/FormuleWrapper.hx
 */

namespace microbe\comps\wrappers;

use \php\Boot;
use \php\_Boot\HxEnum;

class Status extends HxEnum {
	/**
	 * @return Status
	 */
	static public function Abort () {
		static $inst = null;
		if (!$inst) $inst = new Status('Abort', 4, []);
		return $inst;
	}


	/**
	 * @return Status
	 */
	static public function Exec () {
		static $inst = null;
		if (!$inst) $inst = new Status('Exec', 2, []);
		return $inst;
	}


	/**
	 * @return Status
	 */
	static public function None () {
		static $inst = null;
		if (!$inst) $inst = new Status('None', 0, []);
		return $inst;
	}


	/**
	 * @param int $id
	 * 
	 * @return Status
	 */
	static public function Rec ($id) {
		return new Status('Rec', 3, [$id]);
	}


	/**
	 * @return Status
	 */
	static public function Render () {
		static $inst = null;
		if (!$inst) $inst = new Status('Render', 1, []);
		return $inst;
	}


	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			4 => 'Abort',
			2 => 'Exec',
			0 => 'None',
			3 => 'Rec',
			1 => 'Render',
		];
	}


	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'Abort' => 0,
			'Exec' => 0,
			'None' => 0,
			'Rec' => 1,
			'Render' => 0,
		];
	}
}


Boot::registerClass(Status::class, 'microbe.comps.wrappers.Status');
