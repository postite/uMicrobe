<?php

// Generated by Haxe 3.4.7
class tink_io_SinkBase implements tink_io_SinkObject{
	public function __construct(){}
	public function write($from) {
		$GLOBALS['%s']->push("tink.io.SinkBase::write");
		$__hx__spos = $GLOBALS['%s']->length;
		throw new HException("writing not implemented");
		$GLOBALS['%s']->pop();
	}
	public function finish($from) {
		$GLOBALS['%s']->push("tink.io.SinkBase::finish");
		$__hx__spos = $GLOBALS['%s']->length;
		$_gthis = $this;
		{
			$tmp = tink_core__Future_Future_Impl_::async(array(new _hx_lambda(array(&$_gthis, &$from), "tink_io_SinkBase_0"), 'execute'), null);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function close() {
		$GLOBALS['%s']->push("tink.io.SinkBase::close");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Outcome::Success(tink_core_Noise::$Noise)));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function idealize($onError) {
		$GLOBALS['%s']->push("tink.io.SinkBase::idealize");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_io_IdealizedSink($this, $onError);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'tink.io.SinkBase'; }
}
function tink_io_SinkBase_0(&$_gthis, &$from, $cb) {
	{
		$GLOBALS['%s']->push("tink.io.SinkBase::finish@198");
		$__hx__spos = $GLOBALS['%s']->length;
		tink_io__Sink_Sink_Impl_::writeFull($_gthis, $from)->handle(array(new _hx_lambda(array(&$_gthis, &$cb), "tink_io_SinkBase_1"), 'execute'));
		$GLOBALS['%s']->pop();
	}
}
function tink_io_SinkBase_1(&$_gthis, &$cb, $o) {
	{
		$GLOBALS['%s']->push("tink.io.SinkBase::idealize@199");
		$__hx__spos = $GLOBALS['%s']->length;
		switch($o->index) {
		case 0:{
			switch(_hx_deref($o)->params[0]) {
			case false:{
				call_user_func_array($cb, array(tink_core_Outcome::Success(tink_core_Noise::$Noise)));
			}break;
			case true:{
				$_gthis->close()->handle($cb);
			}break;
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
