<?php

// Generated by Haxe 3.4.7
class haxe_io_Output {
	public function __construct(){}
	public function writeByte($c) {
		$GLOBALS['%s']->push("haxe.io.Output::writeByte");
		$__hx__spos = $GLOBALS['%s']->length;
		throw new HException("Not implemented");
		$GLOBALS['%s']->pop();
	}
	public function writeBytes($s, $pos, $len) {
		$GLOBALS['%s']->push("haxe.io.Output::writeBytes");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = null;
		$tmp1 = null;
		if($pos >= 0) {
			$tmp1 = $len < 0;
		} else {
			$tmp1 = true;
		}
		if(!$tmp1) {
			$tmp = $pos + $len > $s->length;
		} else {
			$tmp = true;
		}
		if($tmp) {
			throw new HException(haxe_io_Error::$OutsideBounds);
		}
		$b = $s->b;
		$k = $len;
		while($k > 0) {
			$this->writeByte(ord($b->s[$pos]));
			$pos = $pos + 1;
			$k = $k - 1;
		}
		{
			$GLOBALS['%s']->pop();
			return $len;
		}
		$GLOBALS['%s']->pop();
	}
	public function flush() {
		$GLOBALS['%s']->push("haxe.io.Output::flush");
		$__hx__spos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}
	public function close() {
		$GLOBALS['%s']->push("haxe.io.Output::close");
		$__hx__spos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}
	public function write($s) {
		$GLOBALS['%s']->push("haxe.io.Output::write");
		$__hx__spos = $GLOBALS['%s']->length;
		$l = $s->length;
		$p = 0;
		while($l > 0) {
			$k = $this->writeBytes($s, $p, $l);
			if($k === 0) {
				throw new HException(haxe_io_Error::$Blocked);
			}
			$p = $p + $k;
			$l = $l - $k;
			unset($k);
		}
		$GLOBALS['%s']->pop();
	}
	public function writeFullBytes($s, $pos, $len) {
		$GLOBALS['%s']->push("haxe.io.Output::writeFullBytes");
		$__hx__spos = $GLOBALS['%s']->length;
		while($len > 0) {
			$k = $this->writeBytes($s, $pos, $len);
			$pos = $pos + $k;
			$len = $len - $k;
			unset($k);
		}
		$GLOBALS['%s']->pop();
	}
	public function prepare($nbytes) {
		$GLOBALS['%s']->push("haxe.io.Output::prepare");
		$__hx__spos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}
	public function writeString($s) {
		$GLOBALS['%s']->push("haxe.io.Output::writeString");
		$__hx__spos = $GLOBALS['%s']->length;
		$b = haxe_io_Bytes::ofString($s);
		$this->writeFullBytes($b, 0, $b->length);
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'haxe.io.Output'; }
}
