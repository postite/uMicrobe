<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/log/Message.hx
 */

namespace ufront\log;

use \php\Boot;
use \php\_Boot\HxEnum;

/**
 * A simple enum to differentiate the severity of the message being logged.
 */
class MessageType extends HxEnum {
	/**
	 * @return MessageType
	 */
	static public function MError () {
		static $inst = null;
		if (!$inst) $inst = new MessageType('MError', 3, []);
		return $inst;
	}


	/**
	 * @return MessageType
	 */
	static public function MLog () {
		static $inst = null;
		if (!$inst) $inst = new MessageType('MLog', 1, []);
		return $inst;
	}


	/**
	 * @return MessageType
	 */
	static public function MTrace () {
		static $inst = null;
		if (!$inst) $inst = new MessageType('MTrace', 0, []);
		return $inst;
	}


	/**
	 * @return MessageType
	 */
	static public function MWarning () {
		static $inst = null;
		if (!$inst) $inst = new MessageType('MWarning', 2, []);
		return $inst;
	}


	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			3 => 'MError',
			1 => 'MLog',
			0 => 'MTrace',
			2 => 'MWarning',
		];
	}


	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'MError' => 0,
			'MLog' => 0,
			'MTrace' => 0,
			'MWarning' => 0,
		];
	}
}


Boot::registerClass(MessageType::class, 'ufront.log.MessageType');
