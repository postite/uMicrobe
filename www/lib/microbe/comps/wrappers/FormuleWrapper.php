<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: src/microbe/comps/wrappers/FormuleWrapper.hx
 */

namespace microbe\comps\wrappers;

use \ufront\web\context\HttpContext;
use \msignal\Signal1;
use \haxe\ds\StringMap;
use \php\Boot;
use \microbe\comps\atoms\NopeButton;
use \tink\core\_Future\FutureObject;
use \microbe\comps\Wrapper;
use \microbe\FormGenerator;
use \php\_NativeArray\NativeArrayIterator;
use \microbe\IMicrobeWrapper;
use \minject\Injector;
use \php\_Boot\HxAnon;
use \microbe\comps\atoms\OkButton;

class FormuleWrapper extends Wrapper implements IMicrobeWrapper {
	/**
	 * @var HttpContext
	 */
	public $ctx;
	/**
	 * @var NopeButton
	 */
	public $deleteButton;
	/**
	 * @var FutureObject
	 */
	public $fdata;
	/**
	 * @var FutureObject
	 */
	public $fexec;
	/**
	 * @var FutureObject
	 */
	public $fvalid;
	/**
	 * @var Injector
	 */
	public $injector;
	/**
	 * @var \Array_hx
	 */
	public $mics;
	/**
	 * @var OkButton
	 */
	public $okButton;
	/**
	 * @var Signal1
	 */
	public $status;
	/**
	 * @var bool
	 */
	public $valide;


	/**
	 * @param mixed $d
	 * @param string $name
	 * @param \Array_hx $classes
	 * 
	 * @return void
	 */
	public function __construct ($d, $name = null, $classes = null) {
		#src/microbe/comps/wrappers/FormuleWrapper.hx:113: characters 18-23
		$this->valide = false;
		#src/microbe/comps/wrappers/FormuleWrapper.hx:33: characters 2-23
		parent::__construct($d, $name, $classes);
		#src/microbe/comps/wrappers/FormuleWrapper.hx:34: characters 2-22
		$this->status = new Signal1();
		#src/microbe/comps/wrappers/FormuleWrapper.hx:35: characters 2-23
		$this->status->dispatch(Status::None());
	}


	/**
	 * @return void
	 */
	public function delete () {
	}


	/**
	 * @param HttpContext $ctx
	 * 
	 * @return void
	 */
	public function execute ($ctx) {
		#src/microbe/comps/wrappers/FormuleWrapper.hx:111: characters 4-25
		$this->status->dispatch(Status::Exec());
	}


	/**
	 * @return StringMap
	 */
	public function gatherData () {
		#src/microbe/comps/wrappers/FormuleWrapper.hx:118: characters 3-30
		$formule = $this->data;
		#src/microbe/comps/wrappers/FormuleWrapper.hx:171: characters 3-17
		return $formule;
	}


	/**
	 * @return void
	 */
	public function reload () {
	}


	/**
	 * @return string
	 */
	public function render () {
		#src/microbe/comps/wrappers/FormuleWrapper.hx:39: characters 3-12
		$this->mics = new \Array_hx();
		#src/microbe/comps/wrappers/FormuleWrapper.hx:41: characters 4-29
		$buf = new \StringBuf();
		#src/microbe/comps/wrappers/FormuleWrapper.hx:42: characters 4-48
		$buf->add("<div " . ($this->getId()??'null') . " " . ($this->getClasses()??'null') . " >");
		#src/microbe/comps/wrappers/FormuleWrapper.hx:43: characters 17-28
		$field = new NativeArrayIterator(array_map("strval", array_keys($this->data->data)));
		#src/microbe/comps/wrappers/FormuleWrapper.hx:43: characters 17-28
		while ($field->hasNext()) {
			#src/microbe/comps/wrappers/FormuleWrapper.hx:43: lines 43-57
			$field1 = $field->next();
			#src/microbe/comps/wrappers/FormuleWrapper.hx:44: characters 4-31
			if ($field1 === "model") {
				#src/microbe/comps/wrappers/FormuleWrapper.hx:44: characters 23-31
				continue;
			}
			#src/microbe/comps/wrappers/FormuleWrapper.hx:45: characters 4-35
			$comp = Boot::dynamicField(($this->data->data[$field1] ?? null), 'comp');
			#src/microbe/comps/wrappers/FormuleWrapper.hx:46: characters 4-35
			$data = Boot::dynamicField(($this->data->data[$field1] ?? null), 'data');
			#src/microbe/comps/wrappers/FormuleWrapper.hx:47: characters 4-23
			$mic = FormGenerator::instanciateComp($comp, new HxAnon([
				"v" => $data,
				"n" => $field1,
			]), $field1);
			#src/microbe/comps/wrappers/FormuleWrapper.hx:51: characters 4-25
			$buf->add($mic->render());
			#src/microbe/comps/wrappers/FormuleWrapper.hx:53: characters 4-18
			$_this = $this->mics;
			#src/microbe/comps/wrappers/FormuleWrapper.hx:53: characters 4-18
			$_this->arr[$_this->length] = $mic;
			#src/microbe/comps/wrappers/FormuleWrapper.hx:53: characters 4-18
			++$_this->length;

		}

		#src/microbe/comps/wrappers/FormuleWrapper.hx:60: characters 3-71
		$this->okButton = new OkButton(new HxAnon([
			"v" => "ok",
			"type" => "Submit",
			"n" => "submit",
		]), null, \Array_hx::wrap(["okbutt"]));
		#src/microbe/comps/wrappers/FormuleWrapper.hx:61: characters 3-29
		$buf->add($this->okButton->render());
		#src/microbe/comps/wrappers/FormuleWrapper.hx:62: characters 3-82
		$this->deleteButton = new NopeButton(new HxAnon([
			"v" => "efface",
			"type" => "button",
			"n" => "submit",
		]), null, \Array_hx::wrap(["delbutt"]));
		#src/microbe/comps/wrappers/FormuleWrapper.hx:63: characters 3-33
		$buf->add($this->deleteButton->render());
		#src/microbe/comps/wrappers/FormuleWrapper.hx:64: characters 3-20
		$buf->add("</div>");
		#src/microbe/comps/wrappers/FormuleWrapper.hx:65: characters 3-26
		$this->status->dispatch(Status::Render());
		#src/microbe/comps/wrappers/FormuleWrapper.hx:66: characters 3-24
		return $buf->b;
	}


	/**
	 * @param StringMap $errors
	 * 
	 * @return void
	 */
	public function validateComps ($errors) {
	}
}


Boot::registerClass(FormuleWrapper::class, 'microbe.comps.wrappers.FormuleWrapper');