<?php

// Generated by Haxe 3.4.7
class microbe_comps_atoms_Select extends microbe_comps_Atom implements microbe_Microbe{
	public function __construct($d, $name, $classes = null, $size = null, $multiple = null) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("microbe.comps.atoms.Select::new");
		$__hx__spos = $GLOBALS['%s']->length;
		if($multiple === null) {
			$multiple = true;
		}
		parent::__construct($d,$name,$classes);
		$this->size = $size;
		$this->multiple = $multiple;
		$this->nullMessage = "indefini";
		$this->value = "selected";
		$GLOBALS['%s']->pop();
	}}
	public $nullMessage;
	public $onChange;
	public $size;
	public $multiple;
	public $value;
	public function render() {
		$GLOBALS['%s']->push("microbe.comps.atoms.Select::render");
		$__hx__spos = $GLOBALS['%s']->length;
		$s = "";
		$s1 = "<select name=\"" . _hx_string_or_null($this->name) . "\" ";
		$s2 = _hx_string_or_null($s1) . _hx_string_or_null($this->getId()) . "  class=\"";
		$s3 = _hx_string_or_null($s2) . _hx_string_or_null($this->getClasses()) . "\" onChange=\"";
		$s4 = null;
		if($this->multiple) {
			$s4 = "multiple";
		} else {
			$s4 = "";
		}
		$s = _hx_string_or_null($s) . _hx_string_or_null((_hx_string_or_null($s3) . _hx_string_or_null($this->onChange) . _hx_string_or_null(("\" size=\"" . _hx_string_rec($this->size, "") . "\" ")) . _hx_string_or_null($s4) . ">"));
		if($this->nullMessage !== "") {
			$s5 = null;
			if(Std::string($this->value) === "") {
				$s5 = "selected";
			} else {
				$s5 = "";
			}
			$s = _hx_string_or_null($s) . _hx_string_or_null(("<option value=\"\" " . _hx_string_or_null($s5) . ">" . _hx_string_or_null($this->nullMessage) . "</option>"));
		}
		if($this->data->v !== null) {
			$_g = 0;
			$_g1 = $this->data->v;
			while($_g < $_g1->length) {
				$row = $_g1[$_g];
				$_g = $_g + 1;
				$s6 = "<option value=\"" . Std::string($row->id) . "\" ";
				$s7 = null;
				if($row->inside) {
					$s7 = "selected ";
				} else {
					$s7 = "";
				}
				$s = _hx_string_or_null($s) . _hx_string_or_null((_hx_string_or_null($s6) . _hx_string_or_null($s7) . " >" . Std::string($row->value) . "</option>"));
				unset($s7,$s6,$row);
			}
		}
		$s = _hx_string_or_null($s) . "</select>";
		{
			$GLOBALS['%s']->pop();
			return $s;
		}
		$GLOBALS['%s']->pop();
	}
	public function execute($ctx) {
		$GLOBALS['%s']->push("microbe.comps.atoms.Select::execute");
		$__hx__spos = $GLOBALS['%s']->length;
		haxe_Log::trace("i'm a Select", _hx_anonymous(array("fileName" => "Select.hx", "lineNumber" => 42, "className" => "microbe.comps.atoms.Select", "methodName" => "execute")));
		haxe_Log::trace($this->data, _hx_anonymous(array("fileName" => "Select.hx", "lineNumber" => 43, "className" => "microbe.comps.atoms.Select", "methodName" => "execute")));
		$GLOBALS['%s']->pop();
	}
	public function getData() {
		$GLOBALS['%s']->push("microbe.comps.atoms.Select::getData");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$GLOBALS['%s']->pop();
			return null;
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
	function __toString() { return 'microbe.comps.atoms.Select'; }
}
