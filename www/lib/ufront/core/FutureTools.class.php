<?php

// Generated by Haxe 3.4.7
class ufront_core_FutureTools {
	public function __construct(){}
	static function asFuture($data) {
		$GLOBALS['%s']->push("ufront.core.FutureTools::asFuture");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst($data));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'ufront.core.FutureTools'; }
}
