<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/StreamStep.hx
 */

namespace tink\streams;

use \php\Boot;
use \tink\core\TypedError;
use \php\_Boot\HxEnum;

class StreamStep extends HxEnum {
	/**
	 * @param mixed $data
	 * 
	 * @return StreamStep
	 */
	static public function Data ($data) {
		return new StreamStep('Data', 0, [$data]);
	}


	/**
	 * @return StreamStep
	 */
	static public function End () {
		static $inst = null;
		if (!$inst) $inst = new StreamStep('End', 1, []);
		return $inst;
	}


	/**
	 * @param TypedError $e
	 * 
	 * @return StreamStep
	 */
	static public function Fail ($e) {
		return new StreamStep('Fail', 2, [$e]);
	}


	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			0 => 'Data',
			1 => 'End',
			2 => 'Fail',
		];
	}


	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'Data' => 1,
			'End' => 0,
			'Fail' => 1,
		];
	}
}


Boot::registerClass(StreamStep::class, 'tink.streams.StreamStep');
