<?php

// Generated by Haxe 3.4.7
class microbe_comps_atoms_OkButton extends microbe_comps_Atom implements microbe_Microbe{
	public function __construct($d, $name = null, $classes = null) { if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("microbe.comps.atoms.OkButton::new");
		$__hx__spos = $GLOBALS['%s']->length;
		parent::__construct($d,$name,$classes);
		$GLOBALS['%s']->pop();
	}}
	public function render() {
		$GLOBALS['%s']->push("microbe.comps.atoms.OkButton::render");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = null;
		if($this->data->type === null) {
			$tmp = "button";
		} else {
			$tmp = $this->data->type;
		}
		$this->data->type = $tmp;
		$tmp1 = "<div " . _hx_string_or_null($this->getId()) . " ><input  type=\"";
		$tmp2 = _hx_string_or_null($tmp1) . _hx_string_or_null($this->data->type) . "\" ";
		$tmp3 = _hx_string_or_null($tmp2) . _hx_string_or_null($this->getClasses()) . " value=\"";
		{
			$tmp4 = _hx_string_or_null($tmp3) . _hx_string_or_null($this->data->v) . "\"\" name=\"" . _hx_string_or_null($this->data->n) . "\"><span id=\"retour\">x</span> </div>";
			$GLOBALS['%s']->pop();
			return $tmp4;
		}
		$GLOBALS['%s']->pop();
	}
	public function execute($ctx) {
		$GLOBALS['%s']->push("microbe.comps.atoms.OkButton::execute");
		$__hx__spos = $GLOBALS['%s']->length;
		haxe_Log::trace("i'ma a Button", _hx_anonymous(array("fileName" => "OkButton.hx", "lineNumber" => 13, "className" => "microbe.comps.atoms.OkButton", "methodName" => "execute")));
		$GLOBALS['%s']->pop();
	}
	public function stateGood() {
		$GLOBALS['%s']->push("microbe.comps.atoms.OkButton::stateGood");
		$__hx__spos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'microbe.comps.atoms.OkButton'; }
}