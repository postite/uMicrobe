<?php

// Generated by Haxe 3.4.7
class tink_io__IdealSink_IdealSink_Impl_ {
	public function __construct(){}
	static function inMemory($whenDone, $buffer = null) {
		$GLOBALS['%s']->push("tink.io._IdealSink.IdealSink_Impl_::inMemory");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_io__IdealSink_MemorySink($whenDone, $buffer);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'tink.io._IdealSink.IdealSink_Impl_'; }
}