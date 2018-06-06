<?php

// Generated by Haxe 3.4.7
class minject_InjectorMapping {
	public function __construct($type, $name) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("minject.InjectorMapping::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->type = $type;
		$this->name = $name;
		$GLOBALS['%s']->pop();
	}}
	public $type;
	public $name;
	public $injector;
	public $provider;
	public function getValue($injector) {
		$GLOBALS['%s']->push("minject.InjectorMapping::getValue");
		$__hx__spos = $GLOBALS['%s']->length;
		if($this->injector !== null) {
			$injector = $this->injector;
		}
		if($this->provider !== null) {
			$tmp = $this->provider->getValue($injector);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$parent = $injector->findMappingForType($this->type, $this->name);
		if($parent !== null) {
			$tmp = $parent->getValue($injector);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		{
			$GLOBALS['%s']->pop();
			return null;
		}
		$GLOBALS['%s']->pop();
	}
	public function toValue($value) {
		$GLOBALS['%s']->push("minject.InjectorMapping::toValue");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->toProvider(new minject_provider_ValueProvider($value));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function _toClass($type) {
		$GLOBALS['%s']->push("minject.InjectorMapping::_toClass");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->toProvider(new minject_provider_ClassProvider($type));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function _toSingleton($type) {
		$GLOBALS['%s']->push("minject.InjectorMapping::_toSingleton");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->toProvider(new minject_provider_SingletonProvider($type));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function asSingleton() {
		$GLOBALS['%s']->push("minject.InjectorMapping::asSingleton");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->_toSingleton(Type::resolveClass($this->type));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function toMapping($mapping) {
		$GLOBALS['%s']->push("minject.InjectorMapping::toMapping");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this->toProvider(new minject_provider_OtherMappingProvider($mapping));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function toProvider($provider) {
		$GLOBALS['%s']->push("minject.InjectorMapping::toProvider");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = null;
		if($this->provider !== null) {
			$tmp = $provider !== null;
		} else {
			$tmp = false;
		}
		if($tmp) {
			$tmp1 = (property_exists("haxe_Log", "trace") ? haxe_Log::$trace: array("haxe_Log", "trace"));
			$tmp2 = "Warning: Injector contains " . _hx_string_or_null($this->toString()) . ".\x0AAttempting to overwrite this ";
			$tmp3 = _hx_string_or_null($tmp2) . _hx_string_or_null(("with mapping for " . _hx_string_or_null($provider->toString()) . ".\x0AIf you have overwritten this mapping ")) . "intentionally you can use `injector.unmap()` prior to your replacement mapping " . "in order to avoid seeing this message.";
			call_user_func_array($tmp1, array($tmp3, _hx_anonymous(array("fileName" => "InjectorMapping.hx", "lineNumber" => 84, "className" => "minject.InjectorMapping", "methodName" => "toProvider"))));
		}
		$this->provider = $provider;
		{
			$GLOBALS['%s']->pop();
			return $this;
		}
		$GLOBALS['%s']->pop();
	}
	public function toString() {
		$GLOBALS['%s']->push("minject.InjectorMapping::toString");
		$__hx__spos = $GLOBALS['%s']->length;
		$named = null;
		$named1 = null;
		if($this->name !== null) {
			$named1 = $this->name !== "";
		} else {
			$named1 = false;
		}
		if($named1) {
			$named = " named \"" . _hx_string_or_null($this->name) . "\" and";
		} else {
			$named = "";
		}
		$tmp = "mapping: [" . _hx_string_or_null($this->type) . "]" . _hx_string_or_null($named) . " mapped to [";
		{
			$tmp2 = _hx_string_or_null($tmp) . Std::string($this->provider) . "]";
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
	function __toString() { return $this->toString(); }
}
