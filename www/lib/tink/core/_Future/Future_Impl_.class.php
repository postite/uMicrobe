<?php

// Generated by Haxe 3.4.7
class tink_core__Future_Future_Impl_ {
	public function __construct(){}
	static $NULL;
	static $NOISE;
	static $NEVER;
	static function _new($f) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::_new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this1 = new tink_core__Future_SimpleFuture($f);
		{
			$tmp = $this1;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function first($this1, $other) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::first");
		$__hx__spos = $GLOBALS['%s']->length;
		$ret = new tink_core_FutureTrigger();
		$l1 = $this1->handle((property_exists($ret, "trigger") ? $ret->trigger: array($ret, "trigger")));
		$l2 = $other->handle((property_exists($ret, "trigger") ? $ret->trigger: array($ret, "trigger")));
		$ret1 = $ret;
		if($l1 !== null) {
			$this2 = $l1;
			$ret1->handle(array(new _hx_lambda(array(&$this2), "tink_core__Future_Future_Impl__0"), 'execute'));
		}
		if($l2 !== null) {
			$this3 = $l2;
			$ret1->handle(array(new _hx_lambda(array(&$this3), "tink_core__Future_Future_Impl__1"), 'execute'));
		}
		{
			$GLOBALS['%s']->pop();
			return $ret1;
		}
		$GLOBALS['%s']->pop();
	}
	static function map($this1, $f, $gather = null) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::map");
		$__hx__spos = $GLOBALS['%s']->length;
		if($gather === null) {
			$gather = true;
		}
		$ret = $this1->map($f);
		if($gather) {
			$tmp = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$GLOBALS['%s']->pop();
			return $ret;
		}
		$GLOBALS['%s']->pop();
	}
	static function flatMap($this1, $next, $gather = null) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::flatMap");
		$__hx__spos = $GLOBALS['%s']->length;
		if($gather === null) {
			$gather = true;
		}
		$ret = $this1->flatMap($next);
		if($gather) {
			$tmp = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$GLOBALS['%s']->pop();
			return $ret;
		}
		$GLOBALS['%s']->pop();
	}
	static function next($this1, $n) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::next");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this1->flatMap(array(new _hx_lambda(array(&$n), "tink_core__Future_Future_Impl__2"), 'execute'));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function merge($this1, $other, $merger, $gather = null) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::merge");
		$__hx__spos = $GLOBALS['%s']->length;
		if($gather === null) {
			$gather = true;
		}
		$ret = $this1->flatMap(array(new _hx_lambda(array(&$merger, &$other), "tink_core__Future_Future_Impl__3"), 'execute'));
		if($gather) {
			$tmp = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$GLOBALS['%s']->pop();
			return $ret;
		}
		$GLOBALS['%s']->pop();
	}
	static function flatten($f) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::flatten");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_core__Future_NestedFuture($f);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function asPromise($s) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::asPromise");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$GLOBALS['%s']->pop();
			return $s;
		}
		$GLOBALS['%s']->pop();
	}
	static function ofMany($futures, $gather = null) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::ofMany");
		$__hx__spos = $GLOBALS['%s']->length;
		if($gather === null) {
			$gather = true;
		}
		$ret = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst((new _hx_array(array()))));
		{
			$_g = 0;
			while($_g < $futures->length) {
				$f = $futures[$_g];
				$_g = $_g + 1;
				$ret1 = $ret->flatMap(array(new _hx_lambda(array(&$f), "tink_core__Future_Future_Impl__4"), 'execute'));
				$ret = $ret1;
				unset($ret1,$f);
			}
		}
		if($gather) {
			$tmp = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$GLOBALS['%s']->pop();
			return $ret;
		}
		$GLOBALS['%s']->pop();
	}
	static function fromMany($futures) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::fromMany");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = tink_core__Future_Future_Impl_::ofMany($futures, null);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function lazy($l) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::lazy");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_core__Future_SyncFuture($l);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function sync($v) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::sync");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst($v));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function async($f, $lazy = null) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::async");
		$__hx__spos = $GLOBALS['%s']->length;
		if($lazy === null) {
			$lazy = false;
		}
		if($lazy) {
			$tmp = new tink_core__Future_LazyTrigger($f);
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$op = new tink_core_FutureTrigger();
			$wrapped = $f;
			tink_core__Callback_Callback_Impl_::invoke($wrapped, (property_exists($op, "trigger") ? $op->trigger: array($op, "trigger")));
			{
				$GLOBALS['%s']->pop();
				return $op;
			}
		}
		$GLOBALS['%s']->pop();
	}
	static function hor($a, $b) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::or");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = tink_core__Future_Future_Impl_::first($a, $b);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function either($a, $b) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::either");
		$__hx__spos = $GLOBALS['%s']->length;
		$ret = $a->map((property_exists("haxe_ds_Either", "Left") ? haxe_ds_Either::$Left: array("haxe_ds_Either", "Left")));
		$ret1 = $b->map((property_exists("haxe_ds_Either", "Right") ? haxe_ds_Either::$Right: array("haxe_ds_Either", "Right")));
		{
			$tmp = tink_core__Future_Future_Impl_::first($ret, $ret1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function hand($a, $b) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::and");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = tink_core__Future_Future_Impl_::merge($a, $b, array(new _hx_lambda(array(), "tink_core__Future_Future_Impl__5"), 'execute'), null);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function _tryFailingFlatMap($f, $map) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::_tryFailingFlatMap");
		$__hx__spos = $GLOBALS['%s']->length;
		$ret = $f->flatMap(array(new _hx_lambda(array(&$map), "tink_core__Future_Future_Impl__6"), 'execute'));
		{
			$tmp = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function _tryFlatMap($f, $map) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::_tryFlatMap");
		$__hx__spos = $GLOBALS['%s']->length;
		$ret = $f->flatMap(array(new _hx_lambda(array(&$map), "tink_core__Future_Future_Impl__7"), 'execute'));
		{
			$tmp = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function _tryFailingMap($f, $map) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::_tryFailingMap");
		$__hx__spos = $GLOBALS['%s']->length;
		$ret = $f->map(array(new _hx_lambda(array(&$map), "tink_core__Future_Future_Impl__8"), 'execute'));
		{
			$tmp = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function _tryMap($f, $map) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::_tryMap");
		$__hx__spos = $GLOBALS['%s']->length;
		$ret = $f->map(array(new _hx_lambda(array(&$map), "tink_core__Future_Future_Impl__9"), 'execute'));
		{
			$tmp = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function _flatMap($f, $map) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::_flatMap");
		$__hx__spos = $GLOBALS['%s']->length;
		$ret = $f->flatMap($map);
		{
			$tmp = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function _map($f, $map) {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::_map");
		$__hx__spos = $GLOBALS['%s']->length;
		$ret = $f->map($map);
		{
			$tmp = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function trigger() {
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::trigger");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_core_FutureTrigger();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'tink.core._Future.Future_Impl_'; }
}
tink_core__Future_Future_Impl_::$NULL = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(null));
tink_core__Future_Future_Impl_::$NOISE = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Noise::$Noise));
tink_core__Future_Future_Impl_::$NEVER = tink_core__Future_NeverFuture::$inst;
function tink_core__Future_Future_Impl__0(&$this2, $_) {
	{
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::first@24");
		$__hx__spos = $GLOBALS['%s']->length;
		$this2->dissolve();
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Future_Future_Impl__1(&$this3, $_1) {
	{
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::first@26");
		$__hx__spos = $GLOBALS['%s']->length;
		$this3->dissolve();
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Future_Future_Impl__2(&$n, $v) {
	{
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::next@57");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = call_user_func_array($n, array($v));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Future_Future_Impl__3(&$merger, &$other, $t) {
	{
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::merge@63");
		$__hx__spos = $GLOBALS['%s']->length;
		$ret1 = $other->map(array(new _hx_lambda(array(&$merger, &$t), "tink_core__Future_Future_Impl__10"), 'execute'));
		{
			$GLOBALS['%s']->pop();
			return $ret1;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Future_Future_Impl__4(&$f, $results) {
	{
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::ofMany@94");
		$__hx__spos = $GLOBALS['%s']->length;
		$ret2 = $f->map(array(new _hx_lambda(array(&$results), "tink_core__Future_Future_Impl__11"), 'execute'));
		{
			$GLOBALS['%s']->pop();
			return $ret2;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Future_Future_Impl__5($a1, $b1) {
	{
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::and@151");
		$__hx__spos = $GLOBALS['%s']->length;
		$this1 = new tink_core_MPair($a1, $b1);
		{
			$tmp = $this1;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Future_Future_Impl__6(&$map, $o) {
	{
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::_tryFailingFlatMap@154");
		$__hx__spos = $GLOBALS['%s']->length;
		switch($o->index) {
		case 0:{
			$d = _hx_deref($o)->params[0];
			{
				$tmp = call_user_func_array($map, array($d));
				$GLOBALS['%s']->pop();
				return $tmp;
			}
		}break;
		case 1:{
			$f1 = _hx_deref($o)->params[0];
			{
				$tmp = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Outcome::Failure($f1)));
				$GLOBALS['%s']->pop();
				return $tmp;
			}
		}break;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Future_Future_Impl__7(&$map, $o) {
	{
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::_tryFlatMap@160");
		$__hx__spos = $GLOBALS['%s']->length;
		switch($o->index) {
		case 0:{
			$d = _hx_deref($o)->params[0];
			$this1 = call_user_func_array($map, array($d));
			$ret1 = $this1->map((property_exists("tink_core_Outcome", "Success") ? tink_core_Outcome::$Success: array("tink_core_Outcome", "Success")));
			{
				$tmp = $ret1->gather();
				$GLOBALS['%s']->pop();
				return $tmp;
			}
		}break;
		case 1:{
			$f1 = _hx_deref($o)->params[0];
			{
				$tmp = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Outcome::Failure($f1)));
				$GLOBALS['%s']->pop();
				return $tmp;
			}
		}break;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Future_Future_Impl__8(&$map, $o) {
	{
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::_tryFailingMap@166");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = tink_core_OutcomeTools::flatMap($o, tink_core__Outcome_OutcomeMapper_Impl_::withSameError($map));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Future_Future_Impl__9(&$map, $o) {
	{
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::_tryMap@169");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = tink_core_OutcomeTools::map($o, $map);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Future_Future_Impl__10(&$merger, &$t, $a) {
	{
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::trigger@64");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = call_user_func_array($merger, array($t, $a));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function tink_core__Future_Future_Impl__11(&$results, $result) {
	{
		$GLOBALS['%s']->push("tink.core._Future.Future_Impl_::trigger@96");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $results->concat((new _hx_array(array($result))));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
