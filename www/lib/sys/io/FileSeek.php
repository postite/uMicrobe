<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/sys/io/FileSeek.hx
 */

namespace sys\io;

use \php\Boot;
use \php\_Boot\HxEnum;

class FileSeek extends HxEnum {
	/**
	 * @return FileSeek
	 */
	static public function SeekBegin () {
		static $inst = null;
		if (!$inst) $inst = new FileSeek('SeekBegin', 0, []);
		return $inst;
	}


	/**
	 * @return FileSeek
	 */
	static public function SeekCur () {
		static $inst = null;
		if (!$inst) $inst = new FileSeek('SeekCur', 1, []);
		return $inst;
	}


	/**
	 * @return FileSeek
	 */
	static public function SeekEnd () {
		static $inst = null;
		if (!$inst) $inst = new FileSeek('SeekEnd', 2, []);
		return $inst;
	}


	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			0 => 'SeekBegin',
			1 => 'SeekCur',
			2 => 'SeekEnd',
		];
	}


	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'SeekBegin' => 0,
			'SeekCur' => 0,
			'SeekEnd' => 0,
		];
	}
}


Boot::registerClass(FileSeek::class, 'sys.io.FileSeek');
