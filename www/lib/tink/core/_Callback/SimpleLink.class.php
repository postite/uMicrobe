<?php

// Generated by Haxe 3.4.7
class tink_core__Callback_SimpleLink implements tink_core__Callback_LinkObject{
	public function __construct($f) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("tink.core._Callback.SimpleLink::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->f = $f;
		$GLOBALS['%s']->pop();
	}}
	public $f;
	public function dissolve() {
		$GLOBALS['%s']->push("tink.core._Callback.SimpleLink::dissolve");
		$__hx__spos = $GLOBALS['%s']->length;
		if($this->f !== null) {
			$this->f();
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
	function __toString() { return 'tink.core._Callback.SimpleLink'; }
}
