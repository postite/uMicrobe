<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: src/microbe/comps/molecules/OrderedListWrapper.hx
 */

namespace microbe\comps\molecules;

use \microbe\Microbe;
use \microbe\comps\Atom;
use \ufront\web\context\HttpContext;
use \php\Boot;
use \haxe\Log;
use \php\_Boot\HxAnon;

class OrderableItem extends Atom implements Microbe {
	/**
	 * @var mixed
	 */
	public $pr;


	/**
	 * @param mixed $d
	 * @param string $name
	 * @param \Array_hx $classes
	 * 
	 * @return void
	 */
	public function __construct ($d, $name = null, $classes = null) {
		#src/microbe/comps/molecules/OrderedListWrapper.hx:101: lines 101-143
		parent::__construct($d, $name, $classes);
	}


	/**
	 * @param HttpContext $ctx
	 * 
	 * @return void
	 */
	public function execute ($ctx) {
		#src/microbe/comps/molecules/OrderedListWrapper.hx:117: characters 3-8
		(Log::$trace)("yo OrderableItem", new HxAnon([
			"fileName" => "src/microbe/comps/molecules/OrderedListWrapper.hx",
			"lineNumber" => 117,
			"className" => "microbe.comps.molecules.OrderableItem",
			"methodName" => "execute",
		]));
	}


	/**
	 * @param string $url
	 * @param mixed $state
	 * 
	 * @return bool
	 */
	public function onState ($url, $state) {
		#src/microbe/comps/molecules/OrderedListWrapper.hx:128: characters 3-8
		(Log::$trace)("item url=" . ($url??'null'), new HxAnon([
			"fileName" => "src/microbe/comps/molecules/OrderedListWrapper.hx",
			"lineNumber" => 128,
			"className" => "microbe.comps.molecules.OrderableItem",
			"methodName" => "onState",
		]));
		#src/microbe/comps/molecules/OrderedListWrapper.hx:140: characters 3-14
		return true;
	}


	/**
	 * @return string
	 */
	public function render () {
		#src/microbe/comps/molecules/OrderedListWrapper.hx:105: characters 3-68
		return "<li data-id=\"" . (\Std::string(Boot::dynamicField($this->data->item, 'pozID'))??'null') . "\">" . (\Std::string(Boot::dynamicField($this->data->item, 'titre'))??'null') . "</li>";
	}
}


Boot::registerClass(OrderableItem::class, 'microbe.comps.molecules.OrderableItem');
