<?php

// Generated by Haxe 3.4.7
class tink_core__Promise_Recover_Impl_ {
	public function __construct(){}
	static function ofSync($f) {
		$GLOBALS['%s']->push("tink.core._Promise.Recover_Impl_::ofSync");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = array(new _hx_lambda(array(&$f), "tink_core__Promise_Recover_Impl__0"), 'execute');
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'tink.core._Promise.Recover_Impl_'; }
}
function tink_core__Promise_Recover_Impl__0(&$f, $e) {
	{
		$GLOBALS['%s']->push("tink.core._Promise.Recover_Impl_::ofSync@213");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(call_user_func_array($f, array($e))));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}