<?php

// Generated by Haxe 3.4.7
class microbe_result__MicrobeResult_MicrobeModelResultOrderedList_Impl_ {
	public function __construct(){}
	static function _new($data, $model, $wrapper, $formUrl = null, $classes = null) {
		$GLOBALS['%s']->push("microbe.result._MicrobeResult.MicrobeModelResultOrderedList_Impl_::_new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this1 = null;
		$listComp = new microbe_comps_molecules_OrderedListWrapper($data, $classes);
		$this2 = new microbe_result_DataPartialResult($data, "/microbe/OrderedlistModel.html", null);
		$this3 = $listComp->render();
		$this4 = $this2->addPartialString("listed", $this3, ufront_view_TemplatingEngines::get_haxe());
		$this5 = _hx_deref(new microbe_ModelFormGenerator($formUrl, $classes))->setData($wrapper->data)->generate($wrapper);
		$this6 = $this4->addPartialString("addon", $this5, ufront_view_TemplatingEngines::get_haxe());
		$this7 = Type::getClassName(_hx_qtype("microbe.result.MicrobeListAction"));
		$this1 = ufront_web_result_AddClientActionResult::addClientAction($this6, $this7, $listComp);
		{
			$tmp = $this1;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'microbe.result._MicrobeResult.MicrobeModelResultOrderedList_Impl_'; }
}