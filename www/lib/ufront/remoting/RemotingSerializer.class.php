<?php

// Generated by Haxe 3.4.7
class ufront_remoting_RemotingSerializer extends haxe_Serializer {
	public function __construct($dir = null) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("ufront.remoting.RemotingSerializer::new");
		$__hx__spos = $GLOBALS['%s']->length;
		parent::__construct();
		$this->direction = $dir;
		$this1 = new haxe_ds_StringMap();
		$this->uploads = $this1;
		$GLOBALS['%s']->pop();
	}}
	public $uploads;
	public $direction;
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
	static function run($obj, $direction = null) {
		$GLOBALS['%s']->push("ufront.remoting.RemotingSerializer::run");
		$__hx__spos = $GLOBALS['%s']->length;
		$s = new ufront_remoting_RemotingSerializer($direction);
		$s->serialize($obj);
		{
			$tmp = $s->toString();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'ufront.remoting.RemotingSerializer'; }
}
