<?php

// Generated by Haxe 3.4.7
class microbe_comps_molecules_OrderableItem extends microbe_comps_Atom implements microbe_Microbe{
	public function __construct($d, $name = null, $classes = null) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("microbe.comps.molecules.OrderableItem::new");
		$__hx__spos = $GLOBALS['%s']->length;
		parent::__construct($d,$name,$classes);
		$GLOBALS['%s']->pop();
	}}
	public $pr;
	public function render() {
		$GLOBALS['%s']->push("microbe.comps.molecules.OrderableItem::render");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = "<li data-id=\"" . Std::string(_hx_field($this->data->item, "pozID")) . "\">";
		{
			$tmp2 = _hx_string_or_null($tmp) . Std::string(_hx_field($this->data->item, "titre")) . "</li>";
			$GLOBALS['%s']->pop();
			return $tmp2;
		}
		$GLOBALS['%s']->pop();
	}
	public function execute($ctx) {
		$GLOBALS['%s']->push("microbe.comps.molecules.OrderableItem::execute");
		$__hx__spos = $GLOBALS['%s']->length;
		haxe_Log::trace("yo OrderableItem", _hx_anonymous(array("fileName" => "OrderedListWrapper.hx", "lineNumber" => 117, "className" => "microbe.comps.molecules.OrderableItem", "methodName" => "execute")));
		$GLOBALS['%s']->pop();
	}
	public function onState($url, $state) {
		$GLOBALS['%s']->push("microbe.comps.molecules.OrderableItem::onState");
		$__hx__spos = $GLOBALS['%s']->length;
		haxe_Log::trace("item url=" . _hx_string_or_null($url), _hx_anonymous(array("fileName" => "OrderedListWrapper.hx", "lineNumber" => 128, "className" => "microbe.comps.molecules.OrderableItem", "methodName" => "onState")));
		{
			$GLOBALS['%s']->pop();
			return true;
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
	function __toString() { return 'microbe.comps.molecules.OrderableItem'; }
}
