<?php

// Generated by Haxe 3.4.7
class tink_core_MPair {
	public function __construct($a, $b) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("tink.core.MPair::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->a = $a;
		$this->b = $b;
		$GLOBALS['%s']->pop();
	}}
	public $a;
	public $b;
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
	function __toString() { return 'tink.core.MPair'; }
}
