<?php

// Generated by Haxe 3.4.7
class tink_streams__Stream_StreamFilter_Impl_ {
	public function __construct(){}
	static function _new($data, $filter) {
		$GLOBALS['%s']->push("tink.streams._Stream.StreamFilter_Impl_::_new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this1 = new tink_streams_StreamMapFilter($data, tink_streams__Stream_StreamFilter_Impl_::lift($filter));
		{
			$tmp = $this1;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function lift($filter) {
		$GLOBALS['%s']->push("tink.streams._Stream.StreamFilter_Impl_::lift");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = array(new _hx_lambda(array(&$filter), "tink_streams__Stream_StreamFilter_Impl__0"), 'execute');
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'tink.streams._Stream.StreamFilter_Impl_'; }
}
function tink_streams__Stream_StreamFilter_Impl__0(&$filter, $x) {
	{
		$GLOBALS['%s']->push("tink.streams._Stream.StreamFilter_Impl_::lift@377");
		$__hx__spos = $GLOBALS['%s']->length;
		if(call_user_func_array($filter, array($x))) {
			$this1 = $x;
			{
				$tmp = $this1;
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