<?php

// Generated by Haxe 3.4.7
class tink_io__Source_FutureSource extends tink_io_SourceBase {
	public function __construct($s) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("tink.io._Source.FutureSource::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->s = $s;
		$GLOBALS['%s']->pop();
	}}
	public $s;
	public function read($into, $max = null) {
		$GLOBALS['%s']->push("tink.io._Source.FutureSource::read");
		$__hx__spos = $GLOBALS['%s']->length;
		if($max === null) {
			$max = 1073741824;
		}
		{
			$tmp = tink_core__Future_Future_Impl_::_tryFailingFlatMap($this->s, array(new _hx_lambda(array(&$into, &$max), "tink_io__Source_FutureSource_0"), 'execute'));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function close() {
		$GLOBALS['%s']->push("tink.io._Source.FutureSource::close");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = tink_core__Future_Future_Impl_::_tryFailingFlatMap($this->s, array(new _hx_lambda(array(), "tink_io__Source_FutureSource_1"), 'execute'));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function toString() {
		$GLOBALS['%s']->push("tink.io._Source.FutureSource::toString");
		$__hx__spos = $GLOBALS['%s']->length;
		$ret = "PENDING";
		$this->s->handle(array(new _hx_lambda(array(&$ret), "tink_io__Source_FutureSource_2"), 'execute'));
		{
			$tmp = "[FutureSource " . _hx_string_or_null($ret) . "]";
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
	function __toString() { return $this->toString(); }
}
function tink_io__Source_FutureSource_0(&$into, &$max, $s) {
	{
		$GLOBALS['%s']->push("tink.io._Source.FutureSource::read@297");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $s->read($into, $max);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_io__Source_FutureSource_1($s) {
	{
		$GLOBALS['%s']->push("tink.io._Source.FutureSource::close@300");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $s->close();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_io__Source_FutureSource_2(&$ret, $o) {
	{
		$GLOBALS['%s']->push("tink.io._Source.FutureSource::toString@304");
		$__hx__spos = $GLOBALS['%s']->length;
		$ret = Std::string($o);
		$GLOBALS['%s']->pop();
	}
}