<?php

// Generated by Haxe 3.4.7
class ufront_core_CallbackTools {
	public function __construct(){}
	static function asVoidSurprise($cb, $pos = null) {
		$GLOBALS['%s']->push("ufront.core.CallbackTools::asVoidSurprise");
		$__hx__spos = $GLOBALS['%s']->length;
		$t = new tink_core_FutureTrigger();
		call_user_func_array($cb, array(array(new _hx_lambda(array(&$pos, &$t), "ufront_core_CallbackTools_0"), 'execute')));
		{
			$tmp = $t;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function asSurprise($cb, $pos = null) {
		$GLOBALS['%s']->push("ufront.core.CallbackTools::asSurprise");
		$__hx__spos = $GLOBALS['%s']->length;
		$t = new tink_core_FutureTrigger();
		call_user_func_array($cb, array(array(new _hx_lambda(array(&$pos, &$t), "ufront_core_CallbackTools_1"), 'execute')));
		{
			$tmp = $t;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function asSurprisePair($cb, $pos = null) {
		$GLOBALS['%s']->push("ufront.core.CallbackTools::asSurprisePair");
		$__hx__spos = $GLOBALS['%s']->length;
		$t = new tink_core_FutureTrigger();
		call_user_func_array($cb, array(array(new _hx_lambda(array(&$pos, &$t), "ufront_core_CallbackTools_2"), 'execute')));
		{
			$tmp = $t;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'ufront.core.CallbackTools'; }
}
function ufront_core_CallbackTools_0(&$pos, &$t, $error) {
	{
		$GLOBALS['%s']->push("ufront.core.CallbackTools::asVoidSurprise@214");
		$__hx__spos = $GLOBALS['%s']->length;
		if($error !== null) {
			$e = "" . Std::string($error);
			$e1 = tink_core_TypedError::withData(500, $e, $pos, _hx_anonymous(array("fileName" => "AsyncTools.hx", "lineNumber" => 216, "className" => "ufront.core.CallbackTools", "methodName" => "asVoidSurprise")));
			$t->trigger(tink_core_Outcome::Failure($e1));
		} else {
			$t->trigger(tink_core_Outcome::Success(tink_core_Noise::$Noise));
		}
		$GLOBALS['%s']->pop();
	}
}
function ufront_core_CallbackTools_1(&$pos, &$t, $error, $val) {
	{
		$GLOBALS['%s']->push("ufront.core.CallbackTools::asSurprise@239");
		$__hx__spos = $GLOBALS['%s']->length;
		if($error !== null) {
			$e = "" . Std::string($error);
			$e1 = tink_core_TypedError::withData(500, $e, $pos, _hx_anonymous(array("fileName" => "AsyncTools.hx", "lineNumber" => 241, "className" => "ufront.core.CallbackTools", "methodName" => "asSurprise")));
			$t->trigger(tink_core_Outcome::Failure($e1));
		} else {
			$t->trigger(tink_core_Outcome::Success($val));
		}
		$GLOBALS['%s']->pop();
	}
}
function ufront_core_CallbackTools_2(&$pos, &$t, $error, $val1, $val2) {
	{
		$GLOBALS['%s']->push("ufront.core.CallbackTools::asSurprisePair@264");
		$__hx__spos = $GLOBALS['%s']->length;
		if($error !== null) {
			$e = "" . Std::string($error);
			$e1 = tink_core_TypedError::withData(500, $e, $pos, _hx_anonymous(array("fileName" => "AsyncTools.hx", "lineNumber" => 266, "className" => "ufront.core.CallbackTools", "methodName" => "asSurprisePair")));
			$t->trigger(tink_core_Outcome::Failure($e1));
		} else {
			$this1 = new tink_core_MPair($val1, $val2);
			$t->trigger(tink_core_Outcome::Success($this1));
		}
		$GLOBALS['%s']->pop();
	}
}