<?php

// Generated by Haxe 3.4.7
class thx_Orderings {
	public function __construct(){}
	static $monoid;
	static function negate($o) {
		$GLOBALS['%s']->push("thx.Orderings::negate");
		$__hx__spos = $GLOBALS['%s']->length;
		switch($o->index) {
		case 0:{
			$tmp = thx_OrderingImpl::$GT;
			$GLOBALS['%s']->pop();
			return $tmp;
		}break;
		case 1:{
			$tmp = thx_OrderingImpl::$LT;
			$GLOBALS['%s']->pop();
			return $tmp;
		}break;
		case 2:{
			$tmp = thx_OrderingImpl::$EQ;
			$GLOBALS['%s']->pop();
			return $tmp;
		}break;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'thx.Orderings'; }
}
thx_Orderings::$monoid = _hx_anonymous(array("zero" => thx_OrderingImpl::$EQ, "append" => array(new _hx_lambda(array(), "thx_Orderings_0"), 'execute')));
function thx_Orderings_0($o0, $o1) {
	{
		$GLOBALS['%s']->push("thx.Orderings::negate@29");
		$__hx__spos = $GLOBALS['%s']->length;
		switch($o0->index) {
		case 0:{
			$tmp = thx_OrderingImpl::$LT;
			$GLOBALS['%s']->pop();
			return $tmp;
		}break;
		case 1:{
			$tmp = thx_OrderingImpl::$GT;
			$GLOBALS['%s']->pop();
			return $tmp;
		}break;
		case 2:{
			$GLOBALS['%s']->pop();
			return $o1;
		}break;
		}
		$GLOBALS['%s']->pop();
	}
}