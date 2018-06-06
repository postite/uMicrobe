<?php

// Generated by Haxe 3.4.7
class tink_io__Source_FailedSource extends tink_io_SourceBase {
	public function __construct($error) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("tink.io._Source.FailedSource::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->error = $error;
		$GLOBALS['%s']->pop();
	}}
	public $error;
	public function read($into, $max = null) {
		$GLOBALS['%s']->push("tink.io._Source.FailedSource::read");
		$__hx__spos = $GLOBALS['%s']->length;
		if($max === null) {
			$max = 1073741824;
		}
		{
			$tmp = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Outcome::Failure($this->error)));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function close() {
		$GLOBALS['%s']->push("tink.io._Source.FailedSource::close");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Outcome::Failure($this->error)));
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
	function __toString() { return 'tink.io._Source.FailedSource'; }
}
