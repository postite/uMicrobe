<?php

// Generated by Haxe 3.4.7
class ufront_web_result_PartialViewResult extends ufront_web_result_ViewResult {
	public function __construct($data = null, $viewPath = null, $templatingEngine = null) { if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("ufront.web.result.PartialViewResult::new");
		$__hx__spos = $GLOBALS['%s']->length;
		parent::__construct($data,$viewPath,$templatingEngine);
		$GLOBALS['%s']->pop();
	}}
	static $transitionTimeout = 0;
	static function create($data) {
		$GLOBALS['%s']->push("ufront.web.result.PartialViewResult::create");
		$__hx__spos = $GLOBALS['%s']->length;
		$obj = _hx_anonymous(array());
		$this1 = null;
		if($obj !== null) {
			$this1 = $obj;
		} else {
			$this1 = _hx_anonymous(array());
		}
		{
			$tmp = new ufront_web_result_PartialViewResult(ufront_view__TemplateData_TemplateData_Impl_::setObject($this1, $data), null, null);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function startLoadingAnimations() {
		$GLOBALS['%s']->push("ufront.web.result.PartialViewResult::startLoadingAnimations");
		$__hx__spos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'ufront.web.result.PartialViewResult'; }
}
