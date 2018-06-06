<?php

// Generated by Haxe 3.4.7
class tink_core__Signal_Signal_Impl_ {
	public function __construct(){}
	static function _new($f) {
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::_new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this1 = new tink_core__Signal_SimpleSignal($f);
		{
			$tmp = $this1;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function map($this1, $f, $gather = null) {
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::map");
		$__hx__spos = $GLOBALS['%s']->length;
		if($gather === null) {
			$gather = true;
		}
		$this2 = new tink_core__Signal_SimpleSignal(array(new _hx_lambda(array(&$f, &$this1), "tink_core__Signal_Signal_Impl__0"), 'execute'));
		$ret = $this2;
		if($gather) {
			$tmp = tink_core__Signal_Signal_Impl_::gather($ret);
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$GLOBALS['%s']->pop();
			return $ret;
		}
		$GLOBALS['%s']->pop();
	}
	static function flatMap($this1, $f, $gather = null) {
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::flatMap");
		$__hx__spos = $GLOBALS['%s']->length;
		if($gather === null) {
			$gather = true;
		}
		$this2 = new tink_core__Signal_SimpleSignal(array(new _hx_lambda(array(&$f, &$this1), "tink_core__Signal_Signal_Impl__1"), 'execute'));
		$ret = $this2;
		if($gather) {
			$tmp = tink_core__Signal_Signal_Impl_::gather($ret);
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$GLOBALS['%s']->pop();
			return $ret;
		}
		$GLOBALS['%s']->pop();
	}
	static function filter($this1, $f, $gather = null) {
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::filter");
		$__hx__spos = $GLOBALS['%s']->length;
		if($gather === null) {
			$gather = true;
		}
		$this2 = new tink_core__Signal_SimpleSignal(array(new _hx_lambda(array(&$f, &$this1), "tink_core__Signal_Signal_Impl__2"), 'execute'));
		$ret = $this2;
		if($gather) {
			$tmp = tink_core__Signal_Signal_Impl_::gather($ret);
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$GLOBALS['%s']->pop();
			return $ret;
		}
		$GLOBALS['%s']->pop();
	}
	static function select($this1, $selector, $gather = null) {
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::select");
		$__hx__spos = $GLOBALS['%s']->length;
		if($gather === null) {
			$gather = true;
		}
		$this2 = new tink_core__Signal_SimpleSignal(array(new _hx_lambda(array(&$selector, &$this1), "tink_core__Signal_Signal_Impl__3"), 'execute'));
		$ret = $this2;
		if($gather) {
			$tmp = tink_core__Signal_Signal_Impl_::gather($ret);
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$GLOBALS['%s']->pop();
			return $ret;
		}
		$GLOBALS['%s']->pop();
	}
	static function join($this1, $other, $gather = null) {
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::join");
		$__hx__spos = $GLOBALS['%s']->length;
		if($gather === null) {
			$gather = true;
		}
		$this2 = new tink_core__Signal_SimpleSignal(array(new _hx_lambda(array(&$other, &$this1), "tink_core__Signal_Signal_Impl__4"), 'execute'));
		$ret = $this2;
		if($gather) {
			$tmp = tink_core__Signal_Signal_Impl_::gather($ret);
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$GLOBALS['%s']->pop();
			return $ret;
		}
		$GLOBALS['%s']->pop();
	}
	static function nextTime($this1, $condition = null) {
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::nextTime");
		$__hx__spos = $GLOBALS['%s']->length;
		$ret = new tink_core_FutureTrigger();
		$link = null;
		$immediate = false;
		$link = $this1->handle(array(new _hx_lambda(array(&$condition, &$immediate, &$link, &$ret), "tink_core__Signal_Signal_Impl__5"), 'execute'));
		if($immediate) {
			if($link !== null) {
				$link->dissolve();
			}
		}
		{
			$tmp = $ret;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function next($this1, $condition = null) {
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::next");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = tink_core__Signal_Signal_Impl_::nextTime($this1, $condition);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function noise($this1) {
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::noise");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = tink_core__Signal_Signal_Impl_::map($this1, array(new _hx_lambda(array(), "tink_core__Signal_Signal_Impl__6"), 'execute'), null);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function gather($this1) {
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::gather");
		$__hx__spos = $GLOBALS['%s']->length;
		$ret = tink_core__Signal_Signal_Impl_::trigger();
		$this1->handle(array(new _hx_lambda(array(&$ret), "tink_core__Signal_Signal_Impl__7"), 'execute'));
		{
			$tmp = $ret;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function generate($generator) {
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::generate");
		$__hx__spos = $GLOBALS['%s']->length;
		$ret = tink_core__Signal_Signal_Impl_::trigger();
		call_user_func_array($generator, array((property_exists($ret, "trigger") ? $ret->trigger: array($ret, "trigger"))));
		{
			$GLOBALS['%s']->pop();
			return $ret;
		}
		$GLOBALS['%s']->pop();
	}
	static function trigger() {
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::trigger");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_core_SignalTrigger();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function ofClassical($add, $remove, $gather = null) {
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::ofClassical");
		$__hx__spos = $GLOBALS['%s']->length;
		if($gather === null) {
			$gather = true;
		}
		$this1 = new tink_core__Signal_SimpleSignal(array(new _hx_lambda(array(&$add, &$remove), "tink_core__Signal_Signal_Impl__8"), 'execute'));
		$ret = $this1;
		if($gather) {
			$tmp = tink_core__Signal_Signal_Impl_::gather($ret);
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$GLOBALS['%s']->pop();
			return $ret;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'tink.core._Signal.Signal_Impl_'; }
}
function tink_core__Signal_Signal_Impl__0(&$f, &$this1, $cb) {
	{
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::map@16");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this1->handle(array(new _hx_lambda(array(&$cb, &$f), "tink_core__Signal_Signal_Impl__9"), 'execute'));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Signal_Signal_Impl__1(&$f, &$this1, $cb) {
	{
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::flatMap@27");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this1->handle(array(new _hx_lambda(array(&$cb, &$f), "tink_core__Signal_Signal_Impl__10"), 'execute'));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Signal_Signal_Impl__2(&$f, &$this1, $cb) {
	{
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::filter@37");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this1->handle(array(new _hx_lambda(array(&$cb, &$f), "tink_core__Signal_Signal_Impl__11"), 'execute'));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Signal_Signal_Impl__3(&$selector, &$this1, $cb) {
	{
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::select@44");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this1->handle(array(new _hx_lambda(array(&$cb, &$selector), "tink_core__Signal_Signal_Impl__12"), 'execute'));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Signal_Signal_Impl__4(&$other, &$this1, $cb) {
	{
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::join@59");
		$__hx__spos = $GLOBALS['%s']->length;
		$a = $this1->handle($cb);
		{
			$tmp = new tink_core__Callback_LinkPair($a, $other->handle($cb));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Signal_Signal_Impl__5(&$condition, &$immediate, &$link, &$ret, $v) {
	{
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::nextTime@75");
		$__hx__spos = $GLOBALS['%s']->length;
		$link1 = null;
		if($condition !== null) {
			$link1 = call_user_func_array($condition, array($v));
		} else {
			$link1 = true;
		}
		if($link1) {
			$ret->trigger($v);
			if($link === null) {
				$immediate = true;
			} else {
				if($link !== null) {
					$link->dissolve();
				}
			}
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Signal_Signal_Impl__6($_) {
	{
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::noise@97");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = tink_core_Noise::$Noise;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Signal_Signal_Impl__7(&$ret, $x) {
	{
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::gather@106");
		$__hx__spos = $GLOBALS['%s']->length;
		tink_core__Callback_CallbackList_Impl_::invoke($ret->handlers, $x);
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Signal_Signal_Impl__8(&$add, &$remove, $cb) {
	{
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::ofClassical@127");
		$__hx__spos = $GLOBALS['%s']->length;
		$f = array(new _hx_lambda(array(&$cb), "tink_core__Signal_Signal_Impl__13"), 'execute');
		call_user_func_array($add, array($f));
		$this2 = null;
		$f1 = $remove;
		$a1 = $f;
		$this2 = new tink_core__Callback_SimpleLink(array(new _hx_lambda(array(&$a1, &$f1), "tink_core__Signal_Signal_Impl__14"), 'execute'));
		{
			$tmp = $this2;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Signal_Signal_Impl__9(&$cb, &$f, $result) {
	{
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::ofClassical@16");
		$__hx__spos = $GLOBALS['%s']->length;
		$this3 = call_user_func_array($f, array($result));
		tink_core__Callback_Callback_Impl_::invoke($cb, $this3);
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Signal_Signal_Impl__10(&$cb, &$f, $result) {
	{
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::ofClassical@27");
		$__hx__spos = $GLOBALS['%s']->length;
		call_user_func_array($f, array($result))->handle($cb);
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Signal_Signal_Impl__11(&$cb, &$f, $result) {
	{
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::ofClassical@37");
		$__hx__spos = $GLOBALS['%s']->length;
		if(call_user_func_array($f, array($result))) {
			tink_core__Callback_Callback_Impl_::invoke($cb, $result);
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Signal_Signal_Impl__12(&$cb, &$selector, $result) {
	{
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::ofClassical@44");
		$__hx__spos = $GLOBALS['%s']->length;
		$_g = call_user_func_array($selector, array($result));
		switch($_g->index) {
		case 0:{
			$v = _hx_deref($_g)->params[0];
			tink_core__Callback_Callback_Impl_::invoke($cb, $v);
		}break;
		case 1:{}break;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Signal_Signal_Impl__13(&$cb, $a) {
	{
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::ofClassical@128");
		$__hx__spos = $GLOBALS['%s']->length;
		tink_core__Callback_Callback_Impl_::invoke($cb, $a);
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Signal_Signal_Impl__14(&$a1, &$f1) {
	{
		$GLOBALS['%s']->push("tink.core._Signal.Signal_Impl_::ofClassical@130");
		$__hx__spos = $GLOBALS['%s']->length;
		call_user_func_array($f1, array($a1));
		$GLOBALS['%s']->pop();
	}
}
