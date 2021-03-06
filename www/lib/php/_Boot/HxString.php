<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/php/Boot.hx
 */

namespace php\_Boot;

use \php\Boot;

/**
 * `String` implementation
 */
class HxString {
	/**
	 * @param string $str
	 * @param int $index
	 * 
	 * @return string
	 */
	static public function charAt ($str, $index) {
		#/usr/local/lib/haxe/std/php/Boot.hx:637: lines 637-641
		if (($index < 0) || ($index >= strlen($str))) {
			#/usr/local/lib/haxe/std/php/Boot.hx:638: characters 4-13
			return "";
		} else {
			#/usr/local/lib/haxe/std/php/Boot.hx:640: characters 4-36
			return $str[$index];
		}
	}


	/**
	 * @param string $str
	 * @param int $index
	 * 
	 * @return int
	 */
	static public function charCodeAt ($str, $index) {
		#/usr/local/lib/haxe/std/php/Boot.hx:645: lines 645-649
		if (($index < 0) || ($index >= strlen($str))) {
			#/usr/local/lib/haxe/std/php/Boot.hx:646: characters 4-15
			return null;
		} else {
			#/usr/local/lib/haxe/std/php/Boot.hx:648: characters 4-48
			return ord($str[$index]);
		}
	}


	/**
	 * @param int $code
	 * 
	 * @return string
	 */
	static public function fromCharCode ($code) {
		#/usr/local/lib/haxe/std/php/Boot.hx:714: characters 3-26
		return chr($code);
	}


	/**
	 * @param string $str
	 * @param string $search
	 * @param int $startIndex
	 * 
	 * @return int
	 */
	static public function indexOf ($str, $search, $startIndex = null) {
		#/usr/local/lib/haxe/std/php/Boot.hx:653: lines 653-657
		if ($startIndex === null) {
			#/usr/local/lib/haxe/std/php/Boot.hx:654: characters 4-18
			$startIndex = 0;
		} else if ($startIndex < 0) {
			#/usr/local/lib/haxe/std/php/Boot.hx:656: characters 4-28
			$startIndex = $startIndex + strlen($str);
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:658: characters 3-54
		$index = strpos($str, $search, $startIndex);
		#/usr/local/lib/haxe/std/php/Boot.hx:659: characters 10-39
		if ($index === false) {
			#/usr/local/lib/haxe/std/php/Boot.hx:659: characters 28-30
			return -1;
		} else {
			#/usr/local/lib/haxe/std/php/Boot.hx:659: characters 33-38
			return $index;
		}
	}


	/**
	 * @param string $str
	 * @param string $search
	 * @param int $startIndex
	 * 
	 * @return int
	 */
	static public function lastIndexOf ($str, $search, $startIndex = null) {
		#/usr/local/lib/haxe/std/php/Boot.hx:663: characters 3-95
		$index = strrpos($str, $search, ($startIndex === null ? 0 : $startIndex - strlen($str)));
		#/usr/local/lib/haxe/std/php/Boot.hx:664: lines 664-668
		if ($index === false) {
			#/usr/local/lib/haxe/std/php/Boot.hx:665: characters 4-13
			return -1;
		} else {
			#/usr/local/lib/haxe/std/php/Boot.hx:667: characters 4-16
			return $index;
		}
	}


	/**
	 * @param string $str
	 * @param string $delimiter
	 * 
	 * @return \Array_hx
	 */
	static public function split ($str, $delimiter) {
		#/usr/local/lib/haxe/std/php/Boot.hx:672: lines 672-676
		if ($delimiter === "") {
			#/usr/local/lib/haxe/std/php/Boot.hx:673: characters 4-60
			return \Array_hx::wrap(str_split($str));
		} else {
			#/usr/local/lib/haxe/std/php/Boot.hx:675: characters 4-69
			return \Array_hx::wrap(explode($delimiter, $str));
		}
	}


	/**
	 * @param string $str
	 * @param int $pos
	 * @param int $len
	 * 
	 * @return string
	 */
	static public function substr ($str, $pos, $len = null) {
		#/usr/local/lib/haxe/std/php/Boot.hx:680: lines 680-684
		if ($pos < -strlen($str)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:681: characters 4-11
			$pos = 0;
		} else if ($pos >= strlen($str)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:683: characters 4-13
			return "";
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:685: lines 685-690
		if ($len === null) {
			#/usr/local/lib/haxe/std/php/Boot.hx:686: characters 4-34
			return substr($str, $pos);
		} else {
			#/usr/local/lib/haxe/std/php/Boot.hx:688: characters 4-46
			$result = substr($str, $pos, $len);
			#/usr/local/lib/haxe/std/php/Boot.hx:689: characters 11-42
			if ($result === false) {
				#/usr/local/lib/haxe/std/php/Boot.hx:689: characters 30-32
				return "";
			} else {
				#/usr/local/lib/haxe/std/php/Boot.hx:689: characters 35-41
				return $result;
			}
		}
	}


	/**
	 * @param string $str
	 * @param int $startIndex
	 * @param int $endIndex
	 * 
	 * @return string
	 */
	static public function substring ($str, $startIndex, $endIndex = null) {
		#/usr/local/lib/haxe/std/php/Boot.hx:694: lines 694-698
		if ($endIndex === null) {
			#/usr/local/lib/haxe/std/php/Boot.hx:695: characters 4-25
			$endIndex = strlen($str);
		} else if ($endIndex < 0) {
			#/usr/local/lib/haxe/std/php/Boot.hx:697: characters 4-16
			$endIndex = 0;
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:699: characters 3-37
		if ($startIndex < 0) {
			#/usr/local/lib/haxe/std/php/Boot.hx:699: characters 23-37
			$startIndex = 0;
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:700: lines 700-704
		if ($startIndex > $endIndex) {
			#/usr/local/lib/haxe/std/php/Boot.hx:701: characters 4-23
			$tmp = $endIndex;
			#/usr/local/lib/haxe/std/php/Boot.hx:702: characters 4-25
			$endIndex = $startIndex;
			#/usr/local/lib/haxe/std/php/Boot.hx:703: characters 4-20
			$startIndex = $tmp;
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:705: characters 3-70
		$result = substr($str, $startIndex, $endIndex - $startIndex);
		#/usr/local/lib/haxe/std/php/Boot.hx:706: characters 10-41
		if ($result === false) {
			#/usr/local/lib/haxe/std/php/Boot.hx:706: characters 29-31
			return "";
		} else {
			#/usr/local/lib/haxe/std/php/Boot.hx:706: characters 34-40
			return $result;
		}
	}


	/**
	 * @param string $str
	 * 
	 * @return string
	 */
	static public function toLowerCase ($str) {
		#/usr/local/lib/haxe/std/php/Boot.hx:633: characters 3-32
		return strtolower($str);
	}


	/**
	 * @param string $str
	 * 
	 * @return string
	 */
	static public function toString ($str) {
		#/usr/local/lib/haxe/std/php/Boot.hx:710: characters 3-13
		return $str;
	}


	/**
	 * @param string $str
	 * 
	 * @return string
	 */
	static public function toUpperCase ($str) {
		#/usr/local/lib/haxe/std/php/Boot.hx:629: characters 3-32
		return strtoupper($str);
	}
}


Boot::registerClass(HxString::class, 'php._Boot.HxString');
