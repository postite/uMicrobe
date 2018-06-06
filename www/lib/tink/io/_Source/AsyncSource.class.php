<?php

// Generated by Haxe 3.4.7
class tink_io__Source_AsyncSource extends tink_io_SourceBase {
	public function __construct($f, $close) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("tink.io._Source.AsyncSource::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$_gthis = $this;
		$this->data = tink_io__IdealSource_IdealSource_Impl_::create();
		$this->_close = $close;
		$onData = tink_core__Signal_Signal_Impl_::trigger();
		$onEnd = new tink_core_FutureTrigger();
		$onData->handle((property_exists($this->data, "write") ? $this->data->write: array($this->data, "write")));
		$this->end = $onEnd;
		$this->end->handle(array(new _hx_lambda(array(&$_gthis), "tink_io__Source_AsyncSource_0"), 'execute'));
		$this->onError = tink_core__Future_Future_Impl_::async(array(new _hx_lambda(array(&$_gthis), "tink_io__Source_AsyncSource_1"), 'execute'), null);
		call_user_func_array($f, array($onData, $onEnd));
		$GLOBALS['%s']->pop();
	}}
	public $data;
	public $end;
	public $onError;
	public $_close;
	public function read($into, $max = null) {
		$GLOBALS['%s']->push("tink.io._Source.AsyncSource::read");
		$__hx__spos = $GLOBALS['%s']->length;
		if($max === null) {
			$max = 1073741824;
		}
		$this1 = $this->data->readSafely($into, $max);
		$ret = $this1->map((property_exists("tink_core_Outcome", "Success") ? tink_core_Outcome::$Success: array("tink_core_Outcome", "Success")));
		$tmp = $ret->gather();
		{
			$tmp2 = tink_core__Future_Future_Impl_::hor($tmp, $this->onError);
			$GLOBALS['%s']->pop();
			return $tmp2;
		}
		$GLOBALS['%s']->pop();
	}
	public function close() {
		$GLOBALS['%s']->push("tink.io._Source.AsyncSource::close");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->_close();
		$this1 = $this->data->closeSafely();
		$ret = $this1->map((property_exists("tink_core_Outcome", "Success") ? tink_core_Outcome::$Success: array("tink_core_Outcome", "Success")));
		{
			$tmp = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->__dynamics[$m]) && is_callable($this->__dynamics[$m]))
			return call_user_func_array($this->__dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call <'.$m.'>');
	}
	function __toString() { return 'tink.io._Source.AsyncSource'; }
}
function tink_io__Source_AsyncSource_0(&$_gthis, $e) {
	{
		$GLOBALS['%s']->push("tink.io._Source.AsyncSource::new@152");
		$__hx__spos = $GLOBALS['%s']->length;
		$this1 = $_gthis->data->closeSafely();
		$ret = $this1->map((property_exists("tink_core_Outcome", "Success") ? tink_core_Outcome::$Success: array("tink_core_Outcome", "Success")));
		$ret->gather();
		$GLOBALS['%s']->pop();
	}
}
function tink_io__Source_AsyncSource_1(&$_gthis, $cb) {
	{
		$GLOBALS['%s']->push("tink.io._Source.AsyncSource::new@155");
		$__hx__spos = $GLOBALS['%s']->length;
		$_gthis->end->handle(array(new _hx_lambda(array(&$cb), "tink_io__Source_AsyncSource_2"), 'execute'));
		$GLOBALS['%s']->pop();
	}
}
function tink_io__Source_AsyncSource_2(&$cb, $o) {
	{
		$GLOBALS['%s']->push("tink.io._Source.AsyncSource::close@155");
		$__hx__spos = $GLOBALS['%s']->length;
		if($o->index === 1) {
			$e1 = _hx_deref($o)->params[0];
			call_user_func_array($cb, array(tink_core_Outcome::Failure($e1)));
		}
		$GLOBALS['%s']->pop();
	}
}