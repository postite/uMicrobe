<?php

// Generated by Haxe 3.4.7
class erazor_TString {
	public function __construct($str) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("erazor.TString::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->s = $str;
		$GLOBALS['%s']->pop();
	}}
	public $s;
	public function toString() {
		$GLOBALS['%s']->push("erazor.TString::toString");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->s;
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
