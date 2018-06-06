<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/record-macros/git/src/sys/db/RecordInfos.hx
 */

namespace sys\db;

use \php\Boot;
use \php\_Boot\HxEnum;

class RecordType extends HxEnum {
	/**
	 * @return RecordType
	 */
	static public function DBigId () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DBigId', 4, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DBigInt () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DBigInt', 5, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DBinary () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DBinary', 18, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DBool () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DBool', 8, []);
		return $inst;
	}


	/**
	 * @param int $n
	 * 
	 * @return RecordType
	 */
	static public function DBytes ($n) {
		return new RecordType('DBytes', 19, [$n]);
	}


	/**
	 * @return RecordType
	 */
	static public function DData () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DData', 30, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DDate () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DDate', 10, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DDateTime () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DDateTime', 11, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DEncoded () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DEncoded', 20, []);
		return $inst;
	}


	/**
	 * @param string $name
	 * 
	 * @return RecordType
	 */
	static public function DEnum ($name) {
		return new RecordType('DEnum', 31, [$name]);
	}


	/**
	 * @param \Array_hx $flags
	 * @param bool $autoSize
	 * 
	 * @return RecordType
	 */
	static public function DFlags ($flags, $autoSize) {
		return new RecordType('DFlags', 23, [$flags, $autoSize]);
	}


	/**
	 * @return RecordType
	 */
	static public function DFloat () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DFloat', 7, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DId () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DId', 0, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DInt () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DInt', 1, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DInterval () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DInterval', 32, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DLongBinary () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DLongBinary', 17, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DMediumInt () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DMediumInt', 28, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DMediumUInt () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DMediumUInt', 29, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DNekoSerialized () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DNekoSerialized', 22, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DNull () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DNull', 33, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DSerialized () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DSerialized', 21, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DSingle () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DSingle', 6, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DSmallBinary () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DSmallBinary', 16, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DSmallInt () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DSmallInt', 26, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DSmallText () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DSmallText', 14, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DSmallUInt () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DSmallUInt', 27, []);
		return $inst;
	}


	/**
	 * @param int $n
	 * 
	 * @return RecordType
	 */
	static public function DString ($n) {
		return new RecordType('DString', 9, [$n]);
	}


	/**
	 * @return RecordType
	 */
	static public function DText () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DText', 15, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DTimeStamp () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DTimeStamp', 12, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DTinyInt () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DTinyInt', 24, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DTinyText () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DTinyText', 13, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DTinyUInt () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DTinyUInt', 25, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DUId () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DUId', 2, []);
		return $inst;
	}


	/**
	 * @return RecordType
	 */
	static public function DUInt () {
		static $inst = null;
		if (!$inst) $inst = new RecordType('DUInt', 3, []);
		return $inst;
	}


	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			4 => 'DBigId',
			5 => 'DBigInt',
			18 => 'DBinary',
			8 => 'DBool',
			19 => 'DBytes',
			30 => 'DData',
			10 => 'DDate',
			11 => 'DDateTime',
			20 => 'DEncoded',
			31 => 'DEnum',
			23 => 'DFlags',
			7 => 'DFloat',
			0 => 'DId',
			1 => 'DInt',
			32 => 'DInterval',
			17 => 'DLongBinary',
			28 => 'DMediumInt',
			29 => 'DMediumUInt',
			22 => 'DNekoSerialized',
			33 => 'DNull',
			21 => 'DSerialized',
			6 => 'DSingle',
			16 => 'DSmallBinary',
			26 => 'DSmallInt',
			14 => 'DSmallText',
			27 => 'DSmallUInt',
			9 => 'DString',
			15 => 'DText',
			12 => 'DTimeStamp',
			24 => 'DTinyInt',
			13 => 'DTinyText',
			25 => 'DTinyUInt',
			2 => 'DUId',
			3 => 'DUInt',
		];
	}


	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'DBigId' => 0,
			'DBigInt' => 0,
			'DBinary' => 0,
			'DBool' => 0,
			'DBytes' => 1,
			'DData' => 0,
			'DDate' => 0,
			'DDateTime' => 0,
			'DEncoded' => 0,
			'DEnum' => 1,
			'DFlags' => 2,
			'DFloat' => 0,
			'DId' => 0,
			'DInt' => 0,
			'DInterval' => 0,
			'DLongBinary' => 0,
			'DMediumInt' => 0,
			'DMediumUInt' => 0,
			'DNekoSerialized' => 0,
			'DNull' => 0,
			'DSerialized' => 0,
			'DSingle' => 0,
			'DSmallBinary' => 0,
			'DSmallInt' => 0,
			'DSmallText' => 0,
			'DSmallUInt' => 0,
			'DString' => 1,
			'DText' => 0,
			'DTimeStamp' => 0,
			'DTinyInt' => 0,
			'DTinyText' => 0,
			'DTinyUInt' => 0,
			'DUId' => 0,
			'DUInt' => 0,
		];
	}
}


Boot::registerClass(RecordType::class, 'sys.db.RecordType');