<?php

// Generated by Haxe 3.4.7
class ufront_web_url_filter_DirectoryUrlFilter implements ufront_web_url_filter_UFUrlFilter{
	public function __construct($directory) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("ufront.web.url.filter.DirectoryUrlFilter::new");
		$__hx__spos = $GLOBALS['%s']->length;
		if(StringTools::startsWith($directory, "/")) {
			$directory = _hx_substr($directory, 1, strlen($directory));
		}
		if(StringTools::endsWith($directory, "/")) {
			$directory = _hx_substr($directory, 0, strlen($directory) - 1);
		}
		$this->directory = $directory;
		$tmp = null;
		if($directory !== "") {
			$tmp = _hx_explode("/", $directory);
		} else {
			$tmp = (new _hx_array(array()));
		}
		$this->segments = $tmp;
		$GLOBALS['%s']->pop();
	}}
	public $directory;
	public $segments;
	public function filterIn($url) {
		$GLOBALS['%s']->push("ufront.web.url.filter.DirectoryUrlFilter::filterIn");
		$__hx__spos = $GLOBALS['%s']->length;
		$pos = 0;
		while(true) {
			$tmp = null;
			if($url->segments->length > 0) {
				$pos = $pos + 1;
				$tmp = $url->segments[0] === $this->segments[$pos - 1];
			} else {
				$tmp = false;
			}
			if(!$tmp) {
				break;
			}
			$url->segments->shift();
			unset($tmp);
		}
		$GLOBALS['%s']->pop();
	}
	public function filterOut($url) {
		$GLOBALS['%s']->push("ufront.web.url.filter.DirectoryUrlFilter::filterOut");
		$__hx__spos = $GLOBALS['%s']->length;
		$url->segments = $this->segments->concat($url->segments);
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
	function __toString() { return 'ufront.web.url.filter.DirectoryUrlFilter'; }
}