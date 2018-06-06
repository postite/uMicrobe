<?php

// Generated by Haxe 3.4.7
class tink_io_SyntheticIdealSource extends tink_io_IdealSourceBase {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("tink.io.SyntheticIdealSource::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->writable = true;
		$this->buf = (new _hx_array(array()));
		$this->queue = (new _hx_array(array()));
		$GLOBALS['%s']->pop();
	}}
	public $buf;
	public $queue;
	public $writable;
	public function get_closed() {
		$GLOBALS['%s']->push("tink.io.SyntheticIdealSource::get_closed");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->buf === null;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function doRead($into, $max) {
		$GLOBALS['%s']->push("tink.io.SyntheticIdealSource::doRead");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = null;
		if($this->buf !== null) {
			$tmp = $this->buf->length === 0;
		} else {
			$tmp = true;
		}
		if($tmp) {
			$tmp2 = -1;
			$GLOBALS['%s']->pop();
			return $tmp2;
		}
		$src = $this->buf[0];
		$ret = $into->readFrom($src, $max);
		if($src->pos === $src->totlen) {
			$this->buf->shift();
		}
		{
			$GLOBALS['%s']->pop();
			return $ret;
		}
		$GLOBALS['%s']->pop();
	}
	public function end() {
		$GLOBALS['%s']->push("tink.io.SyntheticIdealSource::end");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->writable = false;
		if($this->queue->length > 0) {
			$this->closeSafely();
		}
		$GLOBALS['%s']->pop();
	}
	public function readSafely($into, $max = null) {
		$GLOBALS['%s']->push("tink.io.SyntheticIdealSource::readSafely");
		$__hx__spos = $GLOBALS['%s']->length;
		if($max === null) {
			$max = 268435456;
		}
		$_gthis = $this;
		if($this->buf === null) {
			$tmp = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(-1));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$tmp = null;
		if($this->buf->length <= 0) {
			$tmp = !$this->writable;
		} else {
			$tmp = true;
		}
		if($tmp) {
			$tmp2 = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst($this->doRead($into, $max)));
			$GLOBALS['%s']->pop();
			return $tmp2;
		}
		$trigger = new tink_core_FutureTrigger();
		$this->queue->push($trigger);
		$ret = $trigger->map(array(new _hx_lambda(array(&$_gthis, &$into, &$max), "tink_io_SyntheticIdealSource_0"), 'execute'));
		{
			$tmp2 = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp2;
		}
		$GLOBALS['%s']->pop();
	}
	public function write($bytes) {
		$GLOBALS['%s']->push("tink.io.SyntheticIdealSource::write");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = null;
		if($this->buf !== null) {
			$tmp = !$this->writable;
		} else {
			$tmp = true;
		}
		if($tmp) {
			$GLOBALS['%s']->pop();
			return false;
		}
		$tmp1 = $this->buf;
		$tmp1->push(new haxe_io_BytesInput($bytes, null, null));
		$tmp2 = null;
		if($this->queue->length > 0) {
			if($this->buf->length <= 0) {
				$tmp2 = !$this->writable;
			} else {
				$tmp2 = true;
			}
		} else {
			$tmp2 = false;
		}
		if($tmp2) {
			$this->queue->shift()->trigger(tink_core_Noise::$Noise);
		}
		{
			$GLOBALS['%s']->pop();
			return true;
		}
		$GLOBALS['%s']->pop();
	}
	public function closeSafely() {
		$GLOBALS['%s']->push("tink.io.SyntheticIdealSource::closeSafely");
		$__hx__spos = $GLOBALS['%s']->length;
		if($this->buf !== null) {
			$this->buf = null;
			{
				$_g = 0;
				$_g1 = $this->queue;
				while($_g < $_g1->length) {
					$q = $_g1[$_g];
					$_g = $_g + 1;
					$q->trigger(tink_core_Noise::$Noise);
					unset($q);
				}
			}
			$this->queue = null;
		}
		{
			$tmp = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Noise::$Noise));
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
	static $__properties__ = array("get_closed" => "get_closed");
	function __toString() { return 'tink.io.SyntheticIdealSource'; }
}
function tink_io_SyntheticIdealSource_0(&$_gthis, &$into, &$max, $_) {
	{
		$GLOBALS['%s']->push("tink.io.SyntheticIdealSource::readSafely@144");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $_gthis->doRead($into, $max);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}