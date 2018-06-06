<?php

// Generated by Haxe 3.4.7
class ufront_web_session_TestSession implements ufront_web_session_UFHttpSession{
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("ufront.web.session.TestSession::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->map = new haxe_ds_StringMap();
		$this->id = ufront_core_Uuid::create();
		$GLOBALS['%s']->pop();
	}}
	public $id;
	public $map;
	public function setExpiry($e) {
		$GLOBALS['%s']->push("ufront.web.session.TestSession::setExpiry");
		$__hx__spos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}
	public function init() {
		$GLOBALS['%s']->push("ufront.web.session.TestSession::init");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Outcome::Success(tink_core_Noise::$Noise)));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function commit() {
		$GLOBALS['%s']->push("ufront.web.session.TestSession::commit");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Outcome::Success(tink_core_Noise::$Noise)));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function triggerCommit() {
		$GLOBALS['%s']->push("ufront.web.session.TestSession::triggerCommit");
		$__hx__spos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}
	public function isActive() {
		$GLOBALS['%s']->push("ufront.web.session.TestSession::isActive");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$GLOBALS['%s']->pop();
			return true;
		}
		$GLOBALS['%s']->pop();
	}
	public function isReady() {
		$GLOBALS['%s']->push("ufront.web.session.TestSession::isReady");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$GLOBALS['%s']->pop();
			return true;
		}
		$GLOBALS['%s']->pop();
	}
	public function get($name) {
		$GLOBALS['%s']->push("ufront.web.session.TestSession::get");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->map->get($name);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function set($name, $value) {
		$GLOBALS['%s']->push("ufront.web.session.TestSession::set");
		$__hx__spos = $GLOBALS['%s']->length;
		$v = $value;
		$this->map->set($name, $v);
		$GLOBALS['%s']->pop();
	}
	public function exists($name) {
		$GLOBALS['%s']->push("ufront.web.session.TestSession::exists");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->map->exists($name);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function remove($name) {
		$GLOBALS['%s']->push("ufront.web.session.TestSession::remove");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->map->remove($name);
		$GLOBALS['%s']->pop();
	}
	public function clear() {
		$GLOBALS['%s']->push("ufront.web.session.TestSession::clear");
		$__hx__spos = $GLOBALS['%s']->length;
		$key = $this->map->keys();
		while($key->hasNext()) {
			$key1 = $key->next();
			$this->map->remove($key1);
			unset($key1);
		}
		$GLOBALS['%s']->pop();
	}
	public function regenerateID() {
		$GLOBALS['%s']->push("ufront.web.session.TestSession::regenerateID");
		$__hx__spos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}
	public function close() {
		$GLOBALS['%s']->push("ufront.web.session.TestSession::close");
		$__hx__spos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}
	public function get_id() {
		$GLOBALS['%s']->push("ufront.web.session.TestSession::get_id");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->id;
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
	static $__properties__ = array("get_id" => "get_id");
	function __toString() { return 'ufront.web.session.TestSession'; }
}