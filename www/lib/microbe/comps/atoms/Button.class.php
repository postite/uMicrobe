<?php

// Generated by Haxe 3.4.7
class microbe_comps_atoms_Button extends microbe_comps_Atom implements microbe_Microbe{
	public function __construct($d, $name = null, $classes = null) { if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("microbe.comps.atoms.Button::new");
		$__hx__spos = $GLOBALS['%s']->length;
		parent::__construct($d,$name,$classes);
		$GLOBALS['%s']->pop();
	}}
	public function render() {
		$GLOBALS['%s']->push("microbe.comps.atoms.Button::render");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = null;
		if($this->data->type === null) {
			$tmp = "button";
		} else {
			$tmp = $this->data->type;
		}
		$this->data->type = $tmp;
		$tmp1 = "<input type=\"" . _hx_string_or_null($this->data->type) . "\" ";
		$tmp2 = _hx_string_or_null($tmp1) . _hx_string_or_null($this->getClasses()) . " value=\"";
		{
			$tmp3 = _hx_string_or_null($tmp2) . _hx_string_or_null($this->data->v) . "\"\" name=\"" . _hx_string_or_null($this->data->n) . "\">";
			$GLOBALS['%s']->pop();
			return $tmp3;
		}
		$GLOBALS['%s']->pop();
	}
	public function execute($ctx) {
		$GLOBALS['%s']->push("microbe.comps.atoms.Button::execute");
		$__hx__spos = $GLOBALS['%s']->length;
		haxe_Log::trace("i'ma a Button", _hx_anonymous(array("fileName" => "Button.hx", "lineNumber" => 13, "className" => "microbe.comps.atoms.Button", "methodName" => "execute")));
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'microbe.comps.atoms.Button'; }
}