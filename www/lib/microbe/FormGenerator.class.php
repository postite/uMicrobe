<?php

// Generated by Haxe 3.4.7
class microbe_FormGenerator {
	public function __construct($formurl = null, $classes = null) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("microbe.FormGenerator::new");
		$__hx__spos = $GLOBALS['%s']->length;
		if($formurl === null) {
			$formurl = "";
		}
		$this->formurl = $formurl;
		$tmp = null;
		if($classes !== null) {
			$tmp = $classes;
		} else {
			$tmp = (new _hx_array(array()));
		}
		$this->classes = $tmp;
		$GLOBALS['%s']->pop();
	}}
	public $formurl;
	public $classes;
	public $data;
	public function setData($d) {
		$GLOBALS['%s']->push("microbe.FormGenerator::setData");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->data = $d;
		{
			$GLOBALS['%s']->pop();
			return $this;
		}
		$GLOBALS['%s']->pop();
	}
	public function generate($m) {
		$GLOBALS['%s']->push("microbe.FormGenerator::generate");
		$__hx__spos = $GLOBALS['%s']->length;
		$m->setData($this->data);
		$c = $this->classes->join(" ");
		$tmp = "\x0A\x09\x09<style> input{\x0A\x09\x09\x09display:block;\x0A\x09\x09}\x0A\x09\x09</style>\x0A\x09\x09<form action=\"" . _hx_string_or_null($this->formurl) . "\" class=\"" . _hx_string_or_null($c) . "\" rel=\"pushstate\" method=\"POST\">\x0A\x09\x09";
		{
			$tmp2 = _hx_string_or_null($tmp) . _hx_string_or_null($m->render()) . "\x0A\x09\x09</form>";
			$GLOBALS['%s']->pop();
			return $tmp2;
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
	static $injector;
	static function instanciateComp($comp, $data, $name) {
		$GLOBALS['%s']->push("microbe.FormGenerator::instanciateComp");
		$__hx__spos = $GLOBALS['%s']->length;
		$fullClassPath = "microbe.comps.atoms." . _hx_string_or_null($comp);
		if(_hx_index_of($comp, ".", null) !== -1) {
			$fullClassPath = $comp;
		}
		$mic = Type::createInstance(Type::resolveClass($fullClassPath), (new _hx_array(array($data, $name))));
		try {
			microbe_FormGenerator::$injector->injectInto($mic);
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
			$msg = $_ex_;
			{
				$GLOBALS['%e'] = (new _hx_array(array()));
				while($GLOBALS['%s']->length >= $__hx__spos) {
					$GLOBALS['%e']->unshift($GLOBALS['%s']->pop());
				}
				$GLOBALS['%s']->push($GLOBALS['%e'][0]);
				throw new HException(" no injector found in FormGenerator do it via App please" . Std::string(microbe_FormGenerator::$injector->getValueForType("String", "upsPath")));
			}
		}
		{
			$GLOBALS['%s']->pop();
			return $mic;
		}
		$GLOBALS['%s']->pop();
	}
	static function instanciateWrapper($wrapper, $data, $name) {
		$GLOBALS['%s']->push("microbe.FormGenerator::instanciateWrapper");
		$__hx__spos = $GLOBALS['%s']->length;
		$wrap = Type::createInstance($wrapper, (new _hx_array(array($data, $name))));
		try {
			microbe_FormGenerator::$injector->injectInto($wrap);
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
			$msg = $_ex_;
			{
				$GLOBALS['%e'] = (new _hx_array(array()));
				while($GLOBALS['%s']->length >= $__hx__spos) {
					$GLOBALS['%e']->unshift($GLOBALS['%s']->pop());
				}
				$GLOBALS['%s']->push($GLOBALS['%e'][0]);
				throw new HException(" no injector found in FormGenerator do it via App please");
			}
		}
		{
			$GLOBALS['%s']->pop();
			return $wrap;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'microbe.FormGenerator'; }
}
