<?php

// Generated by Haxe 3.4.7
class tink_io__Sink_Sink_Impl_ {
	public function __construct(){}
	static function writeFull($this1, $buffer) {
		$GLOBALS['%s']->push("tink.io._Sink.Sink_Impl_::writeFull");
		$__hx__spos = $GLOBALS['%s']->length;
		$self = $this1;
		{
			$tmp = tink_core__Future_Future_Impl_::async(array(new _hx_lambda(array(&$buffer, &$self), "tink_io__Sink_Sink_Impl__0"), 'execute'), null);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function inMemory() {
		$GLOBALS['%s']->push("tink.io._Sink.Sink_Impl_::inMemory");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = tink_io__Sink_Sink_Impl_::ofOutput("Memory sink", new haxe_io_BytesOutput(), tink_io__Worker_Worker_Impl_::$EAGER);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function async($writer, $closer) {
		$GLOBALS['%s']->push("tink.io._Sink.Sink_Impl_::async");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_io_AsyncSink($writer, $closer);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function flatten($s) {
		$GLOBALS['%s']->push("tink.io._Sink.Sink_Impl_::flatten");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_io_FutureSink($s);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function ofOutput($name, $target, $worker = null) {
		$GLOBALS['%s']->push("tink.io._Sink.Sink_Impl_::ofOutput");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_io_StdSink($name, $target, $worker);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static $stdout;
	function __toString() { return 'tink.io._Sink.Sink_Impl_'; }
}
tink_io__Sink_Sink_Impl_::$stdout = tink_io__Sink_Sink_Impl_::ofOutput("stdout", Sys::stdout(), null);
function tink_io__Sink_Sink_Impl__0(&$buffer, &$self, $cb) {
	{
		$GLOBALS['%s']->push("tink.io._Sink.Sink_Impl_::writeFull@21");
		$__hx__spos = $GLOBALS['%s']->length;
		$flush = null;
		$flush = array(new _hx_lambda(array(&$buffer, &$cb, &$flush, &$self), "tink_io__Sink_Sink_Impl__1"), 'execute');
		$flush1 = $flush;
		call_user_func($flush1);
		$GLOBALS['%s']->pop();
	}
}
function tink_io__Sink_Sink_Impl__1(&$buffer, &$cb, &$flush, &$self) {
	{
		$GLOBALS['%s']->push("tink.io._Sink.Sink_Impl_::ofOutput@22");
		$__hx__spos = $GLOBALS['%s']->length;
		if($buffer->available === 0) {
			call_user_func_array($cb, array(tink_core_Outcome::Success(true)));
		} else {
			$self->write($buffer)->handle(array(new _hx_lambda(array(&$cb, &$flush), "tink_io__Sink_Sink_Impl__2"), 'execute'));
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_io__Sink_Sink_Impl__2(&$cb, &$flush, $o) {
	{
		$GLOBALS['%s']->push("tink.io._Sink.Sink_Impl_::ofOutput@28");
		$__hx__spos = $GLOBALS['%s']->length;
		switch($o->index) {
		case 0:{
			$p = _hx_deref($o)->params[0];
			if($p < 0) {
				call_user_func_array($cb, array(tink_core_Outcome::Success(false)));
			} else {
				call_user_func($flush);
			}
		}break;
		case 1:{
			$e = _hx_deref($o)->params[0];
			call_user_func_array($cb, array(tink_core_Outcome::Failure($e)));
		}break;
		}
		$GLOBALS['%s']->pop();
	}
}
