<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx
 */

namespace tink\io;

use \tink\core\Outcome;
use \php\Boot;
use \php\_Boot\HxException;
use \haxe\io\BytesBuffer;
use \haxe\io\Bytes;
use \haxe\ds\Option;
use \haxe\io\Error;

class Splitter implements StreamParser {
	/**
	 * @var bool
	 */
	public $atEnd;
	/**
	 * @var Bytes
	 */
	public $delim;
	/**
	 * @var BytesBuffer
	 */
	public $out;
	/**
	 * @var Option
	 */
	public $result;


	/**
	 * @param Bytes $delim
	 * 
	 * @return void
	 */
	public function __construct ($delim) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:33: characters 5-23
		$this->delim = $delim;
	}


	/**
	 * @return Outcome
	 */
	public function eof () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:84: characters 5-35
		return Outcome::Success($this->out->getBytes());
	}


	/**
	 * @return int
	 */
	public function minSize () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:30: characters 5-24
		return $this->delim->length;
	}


	/**
	 * @param Buffer $buffer
	 * 
	 * @return Outcome
	 */
	public function progress ($buffer) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:70: lines 70-73
		if ($this->result !== Option::None()) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:71: characters 7-14
			$this->reset();
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:72: characters 7-20
			$this->result = Option::None();
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:75: lines 75-76
		if (($buffer->bytes->length - $buffer->zero) <= $this->delim->length) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:76: characters 7-21
			$buffer->align();
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:78: characters 5-29
		$this->atEnd = !$buffer->writable;
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:79: characters 5-25
		$buffer->writeTo($this);
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:81: characters 5-27
		return Outcome::Success($this->result);
	}


	/**
	 * @return void
	 */
	public function reset () {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:38: characters 5-33
		$this->out = new BytesBuffer();
	}


	/**
	 * @param Bytes $bytes
	 * @param int $start
	 * @param int $length
	 * 
	 * @return int
	 */
	public function writeBytes ($bytes, $start, $length) {
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:43: lines 43-45
		if (!$this->atEnd) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:44: characters 7-44
			if ($length < $this->delim->length) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:44: characters 34-40
				$length = 0;
			}
		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:47: lines 47-64
		if ($length > 0) {
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:48: lines 48-62
			$_g1 = 0;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:48: lines 48-62
			$_g = $length;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:48: lines 48-62
			while ($_g1 < $_g) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:48: lines 48-62
				$_g1 = $_g1 + 1;
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:48: characters 12-13
				$i = $_g1 - 1;
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:49: characters 9-26
				$found = true;
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:50: lines 50-55
				$_g3 = 0;
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:50: lines 50-55
				$_g2 = $this->delim->length;
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:50: lines 50-55
				while ($_g3 < $_g2) {
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:50: lines 50-55
					$_g3 = $_g3 + 1;
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:50: characters 14-18
					$dpos = $_g3 - 1;
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:51: lines 51-54
					if (ord($bytes->b->s[$start + $i + $dpos]) !== ord($this->delim->b->s[$dpos])) {
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:52: characters 13-18
						$found = false;
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:53: characters 13-18
						break;
					}
				}

				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:56: lines 56-61
				if ($found) {
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:57: characters 11-40
					$_this = $this->out;
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:57: characters 11-40
					if (($start < 0) || ($i < 0) || (($start + $i) > $bytes->length)) {
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:57: characters 11-40
						throw new HxException(Error::OutsideBounds());
					} else {
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:57: characters 11-40
						$left = $_this->b;
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:57: characters 11-40
						$this_s = substr($bytes->b->s, $start, $i);
						#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:57: characters 11-40
						$_this->b = ($left . $this_s);
					}

					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:58: characters 11-17
					$this->result = Option::Some($this->out->getBytes());
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:59: characters 11-18
					$this->reset();
					#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:60: characters 11-34
					return $i + $this->delim->length;
				}
			}

			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:63: characters 7-41
			$_this1 = $this->out;
			#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:63: characters 7-41
			if (($start < 0) || ($length < 0) || (($start + $length) > $bytes->length)) {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:63: characters 7-41
				throw new HxException(Error::OutsideBounds());
			} else {
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:63: characters 7-41
				$left1 = $_this1->b;
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:63: characters 7-41
				$this_s1 = substr($bytes->b->s, $start, $length);
				#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:63: characters 7-41
				$_this1->b = ($left1 . $this_s1);
			}

		}
		#/usr/local/lib/haxe/lib/tink_io/0,5,0/src/tink/io/StreamParser.hx:66: characters 5-18
		return $length;
	}
}


Boot::registerClass(Splitter::class, 'tink.io.Splitter');