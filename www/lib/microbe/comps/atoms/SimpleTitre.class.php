<?php

// Generated by Haxe 3.4.7
class microbe_comps_atoms_SimpleTitre extends microbe_comps_Atom implements microbe_Microbe{
	public function __construct($d, $name = null, $classes = null) { if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("microbe.comps.atoms.SimpleTitre::new");
		$__hx__spos = $GLOBALS['%s']->length;
		parent::__construct($d,$name,$classes);
		$GLOBALS['%s']->pop();
	}}
	public function init() {
		$GLOBALS['%s']->push("microbe.comps.atoms.SimpleTitre::init");
		$__hx__spos = $GLOBALS['%s']->length;
		if($this->data->level === null) {
			$this->data->level = 2;
		}
		$GLOBALS['%s']->pop();
	}
	public function render() {
		$GLOBALS['%s']->push("microbe.comps.atoms.SimpleTitre::render");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = "<h" . _hx_string_rec($this->data->level, "") . " ";
		$tmp1 = _hx_string_or_null($tmp) . _hx_string_or_null($this->getClasses()) . " \">";
		{
			$tmp2 = _hx_string_or_null($tmp1) . _hx_string_or_null($this->data->v) . "</h" . _hx_string_rec($this->data->level, "") . ">";
			$GLOBALS['%s']->pop();
			return $tmp2;
		}
		$GLOBALS['%s']->pop();
	}
	public function execute($ctx) {
		$GLOBALS['%s']->push("microbe.comps.atoms.SimpleTitre::execute");
		$__hx__spos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'microbe.comps.atoms.SimpleTitre'; }
}