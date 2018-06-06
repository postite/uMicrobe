<?php

// Generated by Haxe 3.4.7
class tink_io__Source_SimpleSource extends tink_io_SourceBase {
	public function __construct($reader, $closer = null) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("tink.io._Source.SimpleSource::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->reader = $reader;
		$this->closer = $closer;
		$GLOBALS['%s']->pop();
	}}
	public $closer;
	public $reader;
	public function close() {
		$GLOBALS['%s']->push("tink.io._Source.SimpleSource::close");
		$__hx__spos = $GLOBALS['%s']->length;
		if($this->closer === null) {
			$tmp = parent::close();
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$tmp = $this->closer();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function read($into, $max = null) {
		$GLOBALS['%s']->push("tink.io._Source.SimpleSource::read");
		$__hx__spos = $GLOBALS['%s']->length;
		if($max === null) {
			$max = 1073741824;
		}
		{
			$tmp = $this->reader($into, $max);
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
	function __toString() { return 'tink.io._Source.SimpleSource'; }
}