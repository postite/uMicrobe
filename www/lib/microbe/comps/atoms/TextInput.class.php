<?php

// Generated by Haxe 3.4.7
class microbe_comps_atoms_TextInput extends microbe_comps_Atom implements microbe_Microbe{
	public function __construct($d, $name = null, $classes = null) { if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("microbe.comps.atoms.TextInput::new");
		$__hx__spos = $GLOBALS['%s']->length;
		parent::__construct($d,$name,$classes);
		$GLOBALS['%s']->pop();
	}}
	public function render() {
		$GLOBALS['%s']->push("microbe.comps.atoms.TextInput::render");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = "<input " . _hx_string_or_null($this->getId()) . " type=\"text\" name=\"";
		$tmp1 = _hx_string_or_null($tmp) . _hx_string_or_null($this->data->n) . "\" ";
		$tmp2 = _hx_string_or_null($tmp1) . _hx_string_or_null($this->getClasses()) . " value=\"";
		{
			$tmp3 = _hx_string_or_null($tmp2) . _hx_string_or_null($this->data->v) . "\">";
			$GLOBALS['%s']->pop();
			return $tmp3;
		}
		$GLOBALS['%s']->pop();
	}
	public function execute($ctx) {
		$GLOBALS['%s']->push("microbe.comps.atoms.TextInput::execute");
		$__hx__spos = $GLOBALS['%s']->length;
		haxe_Log::trace("i'ma a text Input", _hx_anonymous(array("fileName" => "TextInput.hx", "lineNumber" => 20, "className" => "microbe.comps.atoms.TextInput", "methodName" => "execute")));
		$GLOBALS['%s']->pop();
	}
	public function getData() {
		$GLOBALS['%s']->push("microbe.comps.atoms.TextInput::getData");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$GLOBALS['%s']->pop();
			return null;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'microbe.comps.atoms.TextInput'; }
}