<?php

// Generated by Haxe 3.4.7
class tink_core__Promise_Combiner_Impl_ {
	public function __construct(){}
	static function ofSafe($f) {
		$GLOBALS['%s']->push("tink.core._Promise.Combiner_Impl_::ofSafe");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = array(new _hx_lambda(array(&$f), "tink_core__Promise_Combiner_Impl__0"), 'execute');
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function ofSync($f) {
		$GLOBALS['%s']->push("tink.core._Promise.Combiner_Impl_::ofSync");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = array(new _hx_lambda(array(&$f), "tink_core__Promise_Combiner_Impl__1"), 'execute');
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function ofSafeSync($f) {
		$GLOBALS['%s']->push("tink.core._Promise.Combiner_Impl_::ofSafeSync");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = array(new _hx_lambda(array(&$f), "tink_core__Promise_Combiner_Impl__2"), 'execute');
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'tink.core._Promise.Combiner_Impl_'; }
}
function tink_core__Promise_Combiner_Impl__0(&$f, $x1, $x2) {
	{
		$GLOBALS['%s']->push("tink.core._Promise.Combiner_Impl_::ofSafe@220");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(call_user_func_array($f, array($x1, $x2))));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Promise_Combiner_Impl__1(&$f, $x1, $x2) {
	{
		$GLOBALS['%s']->push("tink.core._Promise.Combiner_Impl_::ofSync@223");
		$__hx__spos = $GLOBALS['%s']->length;
		$f1 = call_user_func_array($f, array($x1, $x2));
		$ret = $f1->map((property_exists("tink_core_Outcome", "Success") ? tink_core_Outcome::$Success: array("tink_core_Outcome", "Success")));
		{
			$tmp = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Promise_Combiner_Impl__2(&$f, $x1, $x2) {
	{
		$GLOBALS['%s']->push("tink.core._Promise.Combiner_Impl_::ofSafeSync@226");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = tink_core__Promise_Promise_Impl_::ofOutcome(tink_core_Outcome::Success(call_user_func_array($f, array($x1, $x2))));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
