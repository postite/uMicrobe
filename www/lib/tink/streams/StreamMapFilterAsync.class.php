<?php

// Generated by Haxe 3.4.7
class tink_streams_StreamMapFilterAsync extends tink_streams_StreamBase {
	public function __construct($data, $transformer) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("tink.streams.StreamMapFilterAsync::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->data = $data;
		$this->transformer = $transformer;
		$GLOBALS['%s']->pop();
	}}
	public $transformer;
	public $data;
	public function chain($transformer) {
		$GLOBALS['%s']->push("tink.streams.StreamMapFilterAsync::chain");
		$__hx__spos = $GLOBALS['%s']->length;
		$_gthis = $this;
		{
			$tmp = new tink_streams_StreamMapFilterAsync($this->data, array(new _hx_lambda(array(&$_gthis, &$transformer), "tink_streams_StreamMapFilterAsync_0"), 'execute'));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function chainAsync($transformer) {
		$GLOBALS['%s']->push("tink.streams.StreamMapFilterAsync::chainAsync");
		$__hx__spos = $GLOBALS['%s']->length;
		$_gthis = $this;
		{
			$tmp = new tink_streams_StreamMapFilterAsync($this->data, array(new _hx_lambda(array(&$_gthis, &$transformer), "tink_streams_StreamMapFilterAsync_1"), 'execute'));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function forEachAsync($item) {
		$GLOBALS['%s']->push("tink.streams.StreamMapFilterAsync::forEachAsync");
		$__hx__spos = $GLOBALS['%s']->length;
		$_gthis = $this;
		{
			$tmp = $this->data->forEachAsync(array(new _hx_lambda(array(&$_gthis, &$item), "tink_streams_StreamMapFilterAsync_2"), 'execute'));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function filterAsync($item) {
		$GLOBALS['%s']->push("tink.streams.StreamMapFilterAsync::filterAsync");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->chainAsync(tink_streams__Stream_StreamFilterAsync_Impl_::lift($item));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function mapAsync($item) {
		$GLOBALS['%s']->push("tink.streams.StreamMapFilterAsync::mapAsync");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->chainAsync(tink_streams__Stream_StreamMapAsync_Impl_::lift($item));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function mergeAsync($item) {
		$GLOBALS['%s']->push("tink.streams.StreamMapFilterAsync::mergeAsync");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->chainAsync(tink_streams__Stream_StreamMergeAsync_Impl_::lift($item));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function filter($item) {
		$GLOBALS['%s']->push("tink.streams.StreamMapFilterAsync::filter");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->chain(tink_streams__Stream_StreamFilter_Impl_::lift($item));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function map($item) {
		$GLOBALS['%s']->push("tink.streams.StreamMapFilterAsync::map");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->chain(tink_streams__Stream_StreamMap_Impl_::lift($item));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function merge($item) {
		$GLOBALS['%s']->push("tink.streams.StreamMapFilterAsync::merge");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->chain(tink_streams__Stream_StreamMerge_Impl_::lift($item));
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
	function __toString() { return 'tink.streams.StreamMapFilterAsync'; }
}
function tink_streams_StreamMapFilterAsync_0(&$_gthis, &$transformer, $i) {
	{
		$GLOBALS['%s']->push("tink.streams.StreamMapFilterAsync::chain@509");
		$__hx__spos = $GLOBALS['%s']->length;
		$this1 = $_gthis->transformer($i);
		$ret = $this1->map(array(new _hx_lambda(array(&$transformer), "tink_streams_StreamMapFilterAsync_3"), 'execute'));
		{
			$tmp = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_streams_StreamMapFilterAsync_1(&$_gthis, &$transformer, $i) {
	{
		$GLOBALS['%s']->push("tink.streams.StreamMapFilterAsync::chainAsync@516");
		$__hx__spos = $GLOBALS['%s']->length;
		$this1 = $_gthis->transformer($i);
		$ret = $this1->flatMap(array(new _hx_lambda(array(&$transformer), "tink_streams_StreamMapFilterAsync_4"), 'execute'));
		{
			$tmp = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_streams_StreamMapFilterAsync_2(&$_gthis, &$item, $x) {
	{
		$GLOBALS['%s']->push("tink.streams.StreamMapFilterAsync::forEachAsync@524");
		$__hx__spos = $GLOBALS['%s']->length;
		$this1 = $_gthis->transformer($x);
		$ret = $this1->flatMap(array(new _hx_lambda(array(&$item), "tink_streams_StreamMapFilterAsync_5"), 'execute'));
		{
			$GLOBALS['%s']->pop();
			return $ret;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_streams_StreamMapFilterAsync_3(&$transformer, $o) {
	{
		$GLOBALS['%s']->push("tink.streams.StreamMapFilterAsync::merge@510");
		$__hx__spos = $GLOBALS['%s']->length;
		if($o !== null) {
			$tmp = call_user_func_array($transformer, array($o));
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$GLOBALS['%s']->pop();
			return null;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_streams_StreamMapFilterAsync_4(&$transformer, $o) {
	{
		$GLOBALS['%s']->push("tink.streams.StreamMapFilterAsync::merge@517");
		$__hx__spos = $GLOBALS['%s']->length;
		$v = $o;
		if($v !== null) {
			$tmp = call_user_func_array($transformer, array($v));
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$tmp = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(null));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_streams_StreamMapFilterAsync_5(&$item, $x1) {
	{
		$GLOBALS['%s']->push("tink.streams.StreamMapFilterAsync::merge@525");
		$__hx__spos = $GLOBALS['%s']->length;
		$v = $x1;
		if($v !== null) {
			$tmp = call_user_func_array($item, array($v));
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$tmp = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(true));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
