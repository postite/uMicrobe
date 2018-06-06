<?php

// Generated by Haxe 3.4.7
class tink_streams_ConcatStream extends tink_streams_StreamBase {
	public function __construct($parts) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("tink.streams.ConcatStream::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->parts = $parts;
		$GLOBALS['%s']->pop();
	}}
	public $parts;
	public function filter($item) {
		$GLOBALS['%s']->push("tink.streams.ConcatStream::filter");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->transform(array(new _hx_lambda(array(&$item), "tink_streams_ConcatStream_0"), 'execute'));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function filterAsync($item) {
		$GLOBALS['%s']->push("tink.streams.ConcatStream::filterAsync");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->transform(array(new _hx_lambda(array(&$item), "tink_streams_ConcatStream_1"), 'execute'));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function map($item) {
		$GLOBALS['%s']->push("tink.streams.ConcatStream::map");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->transform(array(new _hx_lambda(array(&$item), "tink_streams_ConcatStream_2"), 'execute'));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function mapAsync($item) {
		$GLOBALS['%s']->push("tink.streams.ConcatStream::mapAsync");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->transform(array(new _hx_lambda(array(&$item), "tink_streams_ConcatStream_3"), 'execute'));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function merge($item) {
		$GLOBALS['%s']->push("tink.streams.ConcatStream::merge");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->transform(array(new _hx_lambda(array(&$item), "tink_streams_ConcatStream_4"), 'execute'));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function mergeAsync($item) {
		$GLOBALS['%s']->push("tink.streams.ConcatStream::mergeAsync");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->transform(array(new _hx_lambda(array(&$item), "tink_streams_ConcatStream_5"), 'execute'));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function transform($t) {
		$GLOBALS['%s']->push("tink.streams.ConcatStream::transform");
		$__hx__spos = $GLOBALS['%s']->length;
		$_g = (new _hx_array(array()));
		{
			$_g1 = 0;
			$_g2 = $this->parts;
			while($_g1 < $_g2->length) {
				$p = $_g2[$_g1];
				$_g1 = $_g1 + 1;
				$_g->push(call_user_func_array($t, array($p)));
				unset($p);
			}
		}
		{
			$tmp = new tink_streams_ConcatStream($_g);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function withAll($f) {
		$GLOBALS['%s']->push("tink.streams.ConcatStream::withAll");
		$__hx__spos = $GLOBALS['%s']->length;
		$_gthis = $this;
		$_g = $this->parts;
		if($_g->length === 0) {
			$tmp = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Outcome::Success(true)));
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$tmp = tink_core__Future_Future_Impl_::async(array(new _hx_lambda(array(&$_gthis, &$f), "tink_streams_ConcatStream_6"), 'execute'), null);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function hforEach($item) {
		$GLOBALS['%s']->push("tink.streams.ConcatStream::forEach");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->withAll(array(new _hx_lambda(array(&$item), "tink_streams_ConcatStream_7"), 'execute'));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function forEachAsync($item) {
		$GLOBALS['%s']->push("tink.streams.ConcatStream::forEachAsync");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->withAll(array(new _hx_lambda(array(&$item), "tink_streams_ConcatStream_8"), 'execute'));
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
	static function make($parts) {
		$GLOBALS['%s']->push("tink.streams.ConcatStream::make");
		$__hx__spos = $GLOBALS['%s']->length;
		$flat = (new _hx_array(array()));
		{
			$_g = 0;
			while($_g < $parts->length) {
				$p = $parts[$_g];
				$_g = $_g + 1;
				if(Std::is($p, _hx_qtype("tink.streams.ConcatStream"))) {
					$_g1 = 0;
					$_g2 = $p->parts;
					while($_g1 < $_g2->length) {
						$p1 = $_g2[$_g1];
						$_g1 = $_g1 + 1;
						$flat->push($p1);
						unset($p1);
					}
					unset($_g2,$_g1);
				} else {
					$flat->push($p);
				}
				unset($p);
			}
		}
		{
			$tmp = new tink_streams_ConcatStream($flat);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'tink.streams.ConcatStream'; }
}
function tink_streams_ConcatStream_0(&$item, $x) {
	{
		$GLOBALS['%s']->push("tink.streams.ConcatStream::filter@176");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $x->filter($item);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_streams_ConcatStream_1(&$item, $x) {
	{
		$GLOBALS['%s']->push("tink.streams.ConcatStream::filterAsync@179");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $x->filterAsync($item);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_streams_ConcatStream_2(&$item, $x) {
	{
		$GLOBALS['%s']->push("tink.streams.ConcatStream::map@182");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $x->map($item);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_streams_ConcatStream_3(&$item, $x) {
	{
		$GLOBALS['%s']->push("tink.streams.ConcatStream::mapAsync@185");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $x->mapAsync($item);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_streams_ConcatStream_4(&$item, $x) {
	{
		$GLOBALS['%s']->push("tink.streams.ConcatStream::merge@188");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $x->merge($item);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_streams_ConcatStream_5(&$item, $x) {
	{
		$GLOBALS['%s']->push("tink.streams.ConcatStream::mergeAsync@191");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $x->mergeAsync($item);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_streams_ConcatStream_6(&$_gthis, &$f, $cb) {
	{
		$GLOBALS['%s']->push("tink.streams.ConcatStream::withAll@201");
		$__hx__spos = $GLOBALS['%s']->length;
		call_user_func_array($f, array($_gthis->parts[0]))->handle(array(new _hx_lambda(array(&$_gthis, &$cb, &$f), "tink_streams_ConcatStream_9"), 'execute'));
		$GLOBALS['%s']->pop();
	}
}
function tink_streams_ConcatStream_7(&$item, $s) {
	{
		$GLOBALS['%s']->push("tink.streams.ConcatStream::forEach@217");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $s->hforEach($item);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_streams_ConcatStream_8(&$item, $s) {
	{
		$GLOBALS['%s']->push("tink.streams.ConcatStream::forEachAsync@220");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $s->forEachAsync($item);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_streams_ConcatStream_9(&$_gthis, &$cb, &$f, $x) {
	{
		$GLOBALS['%s']->push("tink.streams.ConcatStream::make@202");
		$__hx__spos = $GLOBALS['%s']->length;
		switch($x->index) {
		case 0:{
			$v = _hx_deref($x)->params[0];
			if($v) {
				$_gthis->parts->shift();
				$_gthis->withAll($f)->handle($cb);
			} else {
				call_user_func_array($cb, array($x));
			}
		}break;
		case 1:{
			$e = _hx_deref($x)->params[0];
			call_user_func_array($cb, array($x));
		}break;
		}
		$GLOBALS['%s']->pop();
	}
}