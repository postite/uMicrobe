<?php

// Generated by Haxe 3.4.7
class microbe_signal_OrderSignal extends msignal_Signal1 {
	public function __construct() { if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("microbe.signal.OrderSignal::new");
		$__hx__spos = $GLOBALS['%s']->length;
		parent::__construct(_hx_qtype("Dynamic"));
		$GLOBALS['%s']->pop();
	}}
	static $__properties__ = array("get_numListeners" => "get_numListeners");
	function __toString() { return 'microbe.signal.OrderSignal'; }
}