<?php

// Generated by Haxe 3.4.7
class thx__Ord_Ord_Impl_ {
	public function __construct(){}
	static function order($this1, $a0, $a1) {
		$GLOBALS['%s']->push("thx._Ord.Ord_Impl_::order");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = call_user_func_array($this1, array($a0, $a1));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function max($this1, $a0, $a1) {
		$GLOBALS['%s']->push("thx._Ord.Ord_Impl_::max");
		$__hx__spos = $GLOBALS['%s']->length;
		$_g = call_user_func_array($this1, array($a0, $a1));
		switch($_g->index) {
		case 1:{
			$GLOBALS['%s']->pop();
			return $a0;
		}break;
		case 0:case 2:{
			$GLOBALS['%s']->pop();
			return $a1;
		}break;
		}
		$GLOBALS['%s']->pop();
	}
	static function min($this1, $a0, $a1) {
		$GLOBALS['%s']->push("thx._Ord.Ord_Impl_::min");
		$__hx__spos = $GLOBALS['%s']->length;
		$_g = call_user_func_array($this1, array($a0, $a1));
		switch($_g->index) {
		case 1:{
			$GLOBALS['%s']->pop();
			return $a1;
		}break;
		case 0:case 2:{
			$GLOBALS['%s']->pop();
			return $a0;
		}break;
		}
		$GLOBALS['%s']->pop();
	}
	static function equal($this1, $a0, $a1) {
		$GLOBALS['%s']->push("thx._Ord.Ord_Impl_::equal");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = (is_object($_t = call_user_func_array($this1, array($a0, $a1))) && ($_t instanceof Enum) ? $_t == thx_OrderingImpl::$EQ : _hx_equal($_t, thx_OrderingImpl::$EQ));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function contramap($this1, $f) {
		$GLOBALS['%s']->push("thx._Ord.Ord_Impl_::contramap");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = array(new _hx_lambda(array(&$f, &$this1), "thx__Ord_Ord_Impl__0"), 'execute');
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function inverse($this1) {
		$GLOBALS['%s']->push("thx._Ord.Ord_Impl_::inverse");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = array(new _hx_lambda(array(&$this1), "thx__Ord_Ord_Impl__1"), 'execute');
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function intComparison($this1, $a0, $a1) {
		$GLOBALS['%s']->push("thx._Ord.Ord_Impl_::intComparison");
		$__hx__spos = $GLOBALS['%s']->length;
		$_g = call_user_func_array($this1, array($a0, $a1));
		switch($_g->index) {
		case 0:{
			$GLOBALS['%s']->pop();
			return -1;
		}break;
		case 1:{
			$GLOBALS['%s']->pop();
			return 1;
		}break;
		case 2:{
			$GLOBALS['%s']->pop();
			return 0;
		}break;
		}
		$GLOBALS['%s']->pop();
	}
	static function fromIntComparison($f) {
		$GLOBALS['%s']->push("thx._Ord.Ord_Impl_::fromIntComparison");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = array(new _hx_lambda(array(&$f), "thx__Ord_Ord_Impl__2"), 'execute');
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function forComparable() {
		$GLOBALS['%s']->push("thx._Ord.Ord_Impl_::forComparable");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = array(new _hx_lambda(array(), "thx__Ord_Ord_Impl__3"), 'execute');
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function forComparableOrd() {
		$GLOBALS['%s']->push("thx._Ord.Ord_Impl_::forComparableOrd");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = array(new _hx_lambda(array(), "thx__Ord_Ord_Impl__4"), 'execute');
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'thx._Ord.Ord_Impl_'; }
}
function thx__Ord_Ord_Impl__0(&$f, &$this1, $b0, $b1) {
	{
		$GLOBALS['%s']->push("thx._Ord.Ord_Impl_::contramap@64");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = call_user_func_array($f, array($b0));
		$tmp1 = call_user_func_array($f, array($b1));
		{
			$tmp2 = call_user_func_array($this1, array($tmp, $tmp1));
			$GLOBALS['%s']->pop();
			return $tmp2;
		}
		$GLOBALS['%s']->pop();
	}
}
function thx__Ord_Ord_Impl__1(&$this1, $a0, $a1) {
	{
		$GLOBALS['%s']->push("thx._Ord.Ord_Impl_::inverse@67");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = call_user_func_array($this1, array($a1, $a0));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function thx__Ord_Ord_Impl__2(&$f, $a, $b) {
	{
		$GLOBALS['%s']->push("thx._Ord.Ord_Impl_::fromIntComparison@77");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx__Ord_Ordering_Impl_::fromInt(call_user_func_array($f, array($a, $b)));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function thx__Ord_Ord_Impl__3($a, $b) {
	{
		$GLOBALS['%s']->push("thx._Ord.Ord_Impl_::forComparable@80");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx__Ord_Ordering_Impl_::fromInt($a->compareTo($b));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function thx__Ord_Ord_Impl__4($a, $b) {
	{
		$GLOBALS['%s']->push("thx._Ord.Ord_Impl_::forComparableOrd@83");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $a->compareTo($b);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
