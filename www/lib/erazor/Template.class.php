<?php

// Generated by Haxe 3.4.7
class erazor_Template {
	public function __construct($template) {
		if(!isset($this->escape)) $this->escape = array(new _hx_lambda(array(&$this), "erazor_Template_0"), 'execute');
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("erazor.Template::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->template = $template;
		$this->helpers = new haxe_ds_StringMap();
		$GLOBALS['%s']->pop();
	}}
	public $template;
	public $variables;
	public $helpers;
	public function escape($str) { return call_user_func_array($this->escape, array($str)); }
	public $escape = null;
	public function addHelper($name, $helper) {
		$GLOBALS['%s']->push("erazor.Template::addHelper");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->helpers->set($name, $helper);
		$GLOBALS['%s']->pop();
	}
	public function execute($content = null) {
		$GLOBALS['%s']->push("erazor.Template::execute");
		$__hx__spos = $GLOBALS['%s']->length;
		$buffer = new erazor_Output((property_exists($this, "escape") ? $this->escape: array($this, "escape")));
		$parsedBlocks = _hx_deref(new erazor_Parser())->parse($this->template);
		$script = _hx_deref(new erazor_ScriptBuilder("__b__"))->build($parsedBlocks);
		$parser = new hscript_Parser();
		$program = $parser->parseString($script, null);
		$interp = new erazor_hscript_EnhancedInterp();
		$this->variables = $interp->variables;
		$bufferStack = (new _hx_array(array()));
		$this->setInterpreterVars($interp, $this->helpers);
		$this->setInterpreterVars($interp, $content);
		$interp->variables->set("__b__", $buffer);
		$interp->variables->set("__string_buf__", array(new _hx_lambda(array(&$bufferStack), "erazor_Template_1"), 'execute'));
		$interp->variables->set("__restore_buf__", array(new _hx_lambda(array(&$bufferStack), "erazor_Template_2"), 'execute'));
		$interp->execute($program);
		{
			$tmp = $buffer->b;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function setInterpreterVars($interp, $content) {
		$GLOBALS['%s']->push("erazor.Template::setInterpreterVars");
		$__hx__spos = $GLOBALS['%s']->length;
		if(Std::is($content, _hx_qtype("haxe.ds.StringMap"))) {
			$hash = $content;
			{
				$field = $hash->keys();
				while($field->hasNext()) {
					$field1 = $field->next();
					$this1 = $interp->variables;
					$this1->set($field1, $hash->get($field1));
					unset($this1,$field1);
				}
			}
		} else {
			if($content !== null) {
				$_g = 0;
				$_g1 = Reflect::fields($content);
				while($_g < $_g1->length) {
					$field2 = $_g1[$_g];
					$_g = $_g + 1;
					{
						$this2 = $interp->variables;
						$this2->set($field2, Reflect::field($content, $field2));
						unset($this2);
					}
					unset($field2);
				}
			}
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
	function __toString() { return 'erazor.Template'; }
}
function erazor_Template_0(&$__hx__this, $str) {
	{
		$GLOBALS['%s']->push("erazor.Template::new");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$GLOBALS['%s']->pop();
			return $str;
		}
		$GLOBALS['%s']->pop();
	}
}
function erazor_Template_1(&$bufferStack, $current) {
	{
		$GLOBALS['%s']->push("erazor.Template::execute@62");
		$__hx__spos = $GLOBALS['%s']->length;
		$bufferStack->push($current);
		{
			$tmp = new StringBuf();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function erazor_Template_2(&$bufferStack) {
	{
		$GLOBALS['%s']->push("erazor.Template::execute@67");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $bufferStack->pop();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}