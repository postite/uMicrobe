<?php

// Generated by Haxe 3.4.7
class tink_streams__Stream_StreamFilterAsync_Impl_ {
	public function __construct(){}
	static function _new($data, $filter) {
		$GLOBALS['%s']->push("tink.streams._Stream.StreamFilterAsync_Impl_::_new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this1 = new tink_streams_StreamMapFilterAsync($data, tink_streams__Stream_StreamFilterAsync_Impl_::lift($filter));
		{
			$tmp = $this1;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function lift($filter) {
		$GLOBALS['%s']->push("tink.streams._Stream.StreamFilterAsync_Impl_::lift");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = array(new _hx_lambda(array(&$filter), "tink_streams__Stream_StreamFilterAsync_Impl__0"), 'execute');
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'tink.streams._Stream.StreamFilterAsync_Impl_'; }
}
function tink_streams__Stream_StreamFilterAsync_Impl__0(&$filter, $x) {
	{
		$GLOBALS['%s']->push("tink.streams._Stream.StreamFilterAsync_Impl_::lift@467");
		$__hx__spos = $GLOBALS['%s']->length;
		$this1 = call_user_func_array($filter, array($x));
		$ret = $this1->map(array(new _hx_lambda(array(&$x), "tink_streams__Stream_StreamFilterAsync_Impl__1"), 'execute'));
		{
			$tmp = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_streams__Stream_StreamFilterAsync_Impl__1(&$x, $matches) {
	{
		$GLOBALS['%s']->push("tink.streams._Stream.StreamFilterAsync_Impl_::lift@467");
		$__hx__spos = $GLOBALS['%s']->length;
		if($matches) {
			$this2 = $x;
			{
				$tmp = $this2;
				$GLOBALS['%s']->pop();
				return $tmp;
			}
		} else {
			$GLOBALS['%s']->pop();
			return null;
		}
		$GLOBALS['%s']->pop();
	}
}