<?php

// Generated by Haxe 3.4.7
class microbe_comps_atoms_MediumEditor extends microbe_comps_Atom implements microbe_Microbe{
	public function __construct($d, $name = null, $classes = null) { if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("microbe.comps.atoms.MediumEditor::new");
		$__hx__spos = $GLOBALS['%s']->length;
		parent::__construct($d,$name,$classes);
		$GLOBALS['%s']->pop();
	}}
	public function render() {
		$GLOBALS['%s']->push("microbe.comps.atoms.MediumEditor::render");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->addClass("editable");
		$tmp = "<div " . _hx_string_or_null($this->getId()) . " ";
		$tmp1 = _hx_string_or_null($tmp) . _hx_string_or_null($this->getClasses()) . " name=";
		{
			$tmp2 = _hx_string_or_null($tmp1) . _hx_string_or_null($this->data->n) . ">" . _hx_string_or_null($this->data->v) . "</div>\x0A\x09\x09";
			$GLOBALS['%s']->pop();
			return $tmp2;
		}
		$GLOBALS['%s']->pop();
	}
	public function execute($ctx) {
		$GLOBALS['%s']->push("microbe.comps.atoms.MediumEditor::execute");
		$__hx__spos = $GLOBALS['%s']->length;
		haxe_Log::trace("i'ma a meditor", _hx_anonymous(array("fileName" => "MediumEditor.hx", "lineNumber" => 27, "className" => "microbe.comps.atoms.MediumEditor", "methodName" => "execute")));
		$GLOBALS['%s']->pop();
	}
	public function getData() {
		$GLOBALS['%s']->push("microbe.comps.atoms.MediumEditor::getData");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$GLOBALS['%s']->pop();
			return null;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'microbe.comps.atoms.MediumEditor'; }
}
