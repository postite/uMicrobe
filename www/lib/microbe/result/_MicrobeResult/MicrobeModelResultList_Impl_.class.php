<?php

// Generated by Haxe 3.4.7
class microbe_result__MicrobeResult_MicrobeModelResultList_Impl_ {
	public function __construct(){}
	static function _new($data, $model, $wrapper, $formUrl = null, $classes = null) {
		$GLOBALS['%s']->push("microbe.result._MicrobeResult.MicrobeModelResultList_Impl_::_new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this1 = null;
		$this2 = new microbe_result_DataPartialResult($data, "/microbe/listModel.html", null);
		$this1 = $this2->addPartialString("addon", "select !", ufront_view_TemplatingEngines::get_haxe());
		{
			$tmp = $this1;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'microbe.result._MicrobeResult.MicrobeModelResultList_Impl_'; }
}
