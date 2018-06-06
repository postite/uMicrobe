<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: src/microbe/result/MicrobeResult.hx
 */

namespace microbe\result\_MicrobeResult;

use \microbe\Microbe;
use \php\Boot;
use \microbe\FormGenerator;
use \microbe\result\DataPartialResult;
use \microbe\result\MicrobeAction;
use \ufront\view\_TemplateData\TemplateData_Impl_;
use \ufront\view\TemplatingEngines;
use \php\_Boot\HxAnon;
use \ufront\web\result\AddClientActionResult;

final class MicrobeResult_Impl_ {
	/**
	 * @param Microbe $comp
	 * @param string $formUrl
	 * @param \Array_hx $classes
	 * 
	 * @return AddClientActionResult
	 */
	static public function _new ($comp, $formUrl = null, $classes = null) {
		#src/microbe/result/MicrobeResult.hx:22: characters 37-39
		$obj = new HxAnon();
		#src/microbe/result/MicrobeResult.hx:22: characters 37-39
		$this1 = ($obj !== null ? $obj : new HxAnon());
		#src/microbe/result/MicrobeResult.hx:22: lines 22-23
		$this2 = (new DataPartialResult(TemplateData_Impl_::setObject($this1, new HxAnon()), "/microbe/index.html"))->addPartialString("microbeForm", (new FormGenerator($formUrl, $classes))->setData($comp->data)->generate($comp), TemplatingEngines::get_haxe());
		#src/microbe/result/MicrobeResult.hx:24: characters 20-33
		$this11 = \Type::getClassName(Boot::getClass(MicrobeAction::class));
		#src/microbe/result/MicrobeResult.hx:21: character 9
		$this3 = AddClientActionResult::addClientAction($this2, $this11, $comp);
		#src/microbe/result/MicrobeResult.hx:21: character 9
		return $this3;
	}
}


Boot::registerClass(MicrobeResult_Impl_::class, 'microbe.result._MicrobeResult.MicrobeResult_Impl_');