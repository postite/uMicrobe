<?php

// Generated by Haxe 3.4.7
class ufront_web_HttpCookie {
	public function __construct($name, $value, $expires = null, $domain = null, $path = null, $secure = null, $httpOnly = null) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("ufront.web.HttpCookie::new");
		$__hx__spos = $GLOBALS['%s']->length;
		if($httpOnly === null) {
			$httpOnly = false;
		}
		if($secure === null) {
			$secure = false;
		}
		$this->name = $name;
		$this->value = $value;
		$this->expires = $expires;
		$this->domain = $domain;
		$this->path = $path;
		$this->secure = $secure;
		$this->httpOnly = $httpOnly;
		$GLOBALS['%s']->pop();
	}}
	public $domain;
	public $expires;
	public $name;
	public $path;
	public $secure;
	public $httpOnly;
	public $value;
	public function expireNow() {
		$GLOBALS['%s']->push("ufront.web.HttpCookie::expireNow");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->expires = Date::fromTime(0);
		$GLOBALS['%s']->pop();
	}
	public function toString() {
		$GLOBALS['%s']->push("ufront.web.HttpCookie::toString");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = "" . _hx_string_or_null($this->name) . ": ";
		{
			$tmp2 = _hx_string_or_null($tmp) . _hx_string_or_null($this->get_description());
			$GLOBALS['%s']->pop();
			return $tmp2;
		}
		$GLOBALS['%s']->pop();
	}
	public function get_description() {
		$GLOBALS['%s']->push("ufront.web.HttpCookie::get_description");
		$__hx__spos = $GLOBALS['%s']->length;
		$buf = new StringBuf();
		$buf->add($this->value);
		if($this->expires !== null) {
			if(ufront_web_HttpCookie::$tzOffset === null) {
				ufront_web_HttpCookie::$tzOffset = intval(date('Z', $this->expires->__t));;
			}
			$t = ufront_web_HttpCookie::$tzOffset;
			$gmtExpires = Date::fromTime($this->expires->getTime() + $t);
			$zeroPad = array(new _hx_lambda(array(), "ufront_web_HttpCookie_0"), 'execute');
			$day = ufront_web_HttpCookie::$dayNames[$gmtExpires->getDay()];
			$date = call_user_func_array($zeroPad, array($gmtExpires->getDate()));
			$month = ufront_web_HttpCookie::$monthNames[$gmtExpires->getMonth()];
			$year = $gmtExpires->getFullYear();
			$hour = call_user_func_array($zeroPad, array($gmtExpires->getHours()));
			$minute = call_user_func_array($zeroPad, array($gmtExpires->getMinutes()));
			$second = call_user_func_array($zeroPad, array($gmtExpires->getSeconds()));
			$dateStr = "" . _hx_string_or_null($day) . ", " . _hx_string_or_null($date) . "-" . _hx_string_or_null($month) . "-" . _hx_string_rec($year, "") . " " . _hx_string_or_null($hour) . ":" . _hx_string_or_null($minute) . ":" . _hx_string_or_null($second) . " GMT";
			ufront_web_HttpCookie::addPair($buf, "expires", $dateStr, null);
		}
		ufront_web_HttpCookie::addPair($buf, "domain", $this->domain, null);
		ufront_web_HttpCookie::addPair($buf, "path", $this->path, null);
		if($this->secure) {
			ufront_web_HttpCookie::addPair($buf, "secure", null, true);
		}
		{
			$tmp = $buf->b;
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
	static $dayNames;
	static $monthNames;
	static $tzOffset;
	static function addPair($buf, $name, $value = null, $allowNullValue = null) {
		$GLOBALS['%s']->push("ufront.web.HttpCookie::addPair");
		$__hx__spos = $GLOBALS['%s']->length;
		if($allowNullValue === null) {
			$allowNullValue = false;
		}
		$tmp = null;
		if(!$allowNullValue) {
			$tmp = null === $value;
		} else {
			$tmp = false;
		}
		if($tmp) {
			$GLOBALS['%s']->pop();
			return;
		}
		$buf->add("; ");
		$buf->add($name);
		if(null === $value) {
			$GLOBALS['%s']->pop();
			return;
		}
		$buf->add("=");
		$buf->add($value);
		$GLOBALS['%s']->pop();
	}
	static $__properties__ = array("get_description" => "get_description");
	function __toString() { return $this->toString(); }
}
ufront_web_HttpCookie::$dayNames = (new _hx_array(array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat")));
ufront_web_HttpCookie::$monthNames = (new _hx_array(array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec")));
function ufront_web_HttpCookie_0($i) {
	{
		$GLOBALS['%s']->push("ufront.web.HttpCookie::get_description@83");
		$__hx__spos = $GLOBALS['%s']->length;
		$str = "" . _hx_string_rec($i, "");
		while(strlen($str) < 2) {
			$str = "0" . _hx_string_or_null($str);
		}
		{
			$GLOBALS['%s']->pop();
			return $str;
		}
		$GLOBALS['%s']->pop();
	}
}
