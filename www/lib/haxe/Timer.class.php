<?php

// Generated by Haxe 3.4.7
class haxe_Timer {
	public function __construct($time_ms) {
		if(!isset($this->run)) $this->run = array(new _hx_lambda(array(&$this), "haxe_Timer_0"), 'execute');
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("haxe.Timer::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$_gthis = $this;
		$dt = $time_ms / 1000;
		$this->event = haxe_MainLoop::add(array(new _hx_lambda(array(&$_gthis, &$dt), "haxe_Timer_1"), 'execute'), null);
		$this->event->delay($dt);
		$GLOBALS['%s']->pop();
	}}
	public $event;
	public function stop() {
		$GLOBALS['%s']->push("haxe.Timer::stop");
		$__hx__spos = $GLOBALS['%s']->length;
		if($this->event !== null) {
			$this->event->stop();
			$this->event = null;
		}
		$GLOBALS['%s']->pop();
	}
	public function run() { return call_user_func($this->run); }
	public $run = null;
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
	static function delay($f, $time_ms) {
		$GLOBALS['%s']->push("haxe.Timer::delay");
		$__hx__spos = $GLOBALS['%s']->length;
		$t = new haxe_Timer($time_ms);
		$t->run = array(new _hx_lambda(array(&$f, &$t), "haxe_Timer_2"), 'execute');
		{
			$GLOBALS['%s']->pop();
			return $t;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'haxe.Timer'; }
}
function haxe_Timer_0(&$__hx__this) {
	{
		$GLOBALS['%s']->push("haxe.Timer::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}
}
function haxe_Timer_1(&$_gthis, &$dt) {
	{
		$GLOBALS['%s']->push("haxe.Timer::new@72");
		$__hx__spos = $GLOBALS['%s']->length;
		$_gthis1 = $_gthis->event;
		$_gthis1->nextRun = $_gthis1->nextRun + $dt;
		$_gthis->run();
		$GLOBALS['%s']->pop();
	}
}
function haxe_Timer_2(&$f, &$t) {
	{
		$GLOBALS['%s']->push("haxe.Timer::delay@138");
		$__hx__spos = $GLOBALS['%s']->length;
		$t->stop();
		call_user_func($f);
		$GLOBALS['%s']->pop();
	}
}
