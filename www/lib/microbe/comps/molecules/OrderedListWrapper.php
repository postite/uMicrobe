<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: src/microbe/comps/molecules/OrderedListWrapper.hx
 */

namespace microbe\comps\molecules;

use \php\_Boot\HxClosure;
use \microbe\Microbe;
use \ufront\web\context\HttpContext;
use \haxe\ds\StringMap;
use \php\Boot;
use \tink\core\_Future\FutureObject;
use \tink\core\_Future\SyncFuture;
use \haxe\Log;
use \microbe\signal\OrderSignal;
use \tink\core\_Future\Future_Impl_;
use \microbe\comps\Molecule;
use \tink\core\_Lazy\LazyConst;
use \php\_Boot\HxAnon;

class OrderedListWrapper extends Molecule implements Microbe {
	/**
	 * @var OrderSignal
	 */
	static public $signal;


	/**
	 * @var FutureObject
	 */
	public $fdata;
	/**
	 * @var FutureObject
	 */
	public $fexec;


	/**
	 * @param mixed $d
	 * @param \Array_hx $classes
	 * 
	 * @return void
	 */
	public function __construct ($d, $classes = null) {
		#src/microbe/comps/molecules/OrderedListWrapper.hx:15: lines 15-99
		parent::__construct($d, $classes);
	}


	/**
	 * @param HttpContext $ctx
	 * 
	 * @return void
	 */
	public function execute ($ctx) {
		#src/microbe/comps/molecules/OrderedListWrapper.hx:41: characters 3-8
		(Log::$trace)("i'm a Listwrapper", new HxAnon([
			"fileName" => "src/microbe/comps/molecules/OrderedListWrapper.hx",
			"lineNumber" => 41,
			"className" => "microbe.comps.molecules.OrderedListWrapper",
			"methodName" => "execute",
		]));
	}


	/**
	 * @return StringMap
	 */
	public function gatherData () {
		#src/microbe/comps/molecules/OrderedListWrapper.hx:79: characters 3-14
		return null;
	}


	/**
	 * @return string
	 */
	public function render () {
		#src/microbe/comps/molecules/OrderedListWrapper.hx:22: characters 3-19
		$xarray = new \Array_hx();
		#src/microbe/comps/molecules/OrderedListWrapper.hx:23: characters 3-19
		$darray = new \Array_hx();
		#src/microbe/comps/molecules/OrderedListWrapper.hx:24: characters 3-28
		$buf = new \StringBuf();
		#src/microbe/comps/molecules/OrderedListWrapper.hx:25: characters 3-26
		$buf->add("ordered list");
		#src/microbe/comps/molecules/OrderedListWrapper.hx:26: characters 3-54
		$buf->add("<ul id=\"orderedList\" class=\"list-group\">");
		#src/microbe/comps/molecules/OrderedListWrapper.hx:27: characters 16-26
		$_g_head = $this->data->liste->h;
		#src/microbe/comps/molecules/OrderedListWrapper.hx:27: lines 27-33
		while ($_g_head !== null) {
			#src/microbe/comps/molecules/OrderedListWrapper.hx:27: lines 27-33
			$val = $_g_head->item;
			#src/microbe/comps/molecules/OrderedListWrapper.hx:27: lines 27-33
			$_g_head = $_g_head->next;
			#src/microbe/comps/molecules/OrderedListWrapper.hx:27: lines 27-33
			$item = $val;
			#src/microbe/comps/molecules/OrderedListWrapper.hx:28: characters 4-55
			$editLink = ($this->data->action??'null') . (("/" . ($this->data->mod??'null') . "/" . ($item->id??'null'))??'null');
			#src/microbe/comps/molecules/OrderedListWrapper.hx:29: characters 4-58
			$item1 = new OrderableItem(new HxAnon([
				"item" => $item,
				"link" => $editLink,
			]));
			#src/microbe/comps/molecules/OrderedListWrapper.hx:30: characters 4-26
			$buf->add($item1->render());
			#src/microbe/comps/molecules/OrderedListWrapper.hx:31: characters 4-42
			$x = new SyncFuture(new LazyConst(new HxClosure($item1, 'execute')));
			#src/microbe/comps/molecules/OrderedListWrapper.hx:31: characters 4-42
			$xarray->arr[$xarray->length] = $x;
			#src/microbe/comps/molecules/OrderedListWrapper.hx:31: characters 4-42
			++$xarray->length;

			#src/microbe/comps/molecules/OrderedListWrapper.hx:32: characters 4-42
			$x1 = new SyncFuture(new LazyConst(new HxClosure($item1, 'getData')));
			#src/microbe/comps/molecules/OrderedListWrapper.hx:32: characters 4-42
			$darray->arr[$darray->length] = $x1;
			#src/microbe/comps/molecules/OrderedListWrapper.hx:32: characters 4-42
			++$darray->length;

		}

		#src/microbe/comps/molecules/OrderedListWrapper.hx:34: characters 3-8
		$this->fexec = Future_Impl_::ofMany($xarray);
		#src/microbe/comps/molecules/OrderedListWrapper.hx:35: characters 3-8
		$this->fdata = Future_Impl_::ofMany($darray);
		#src/microbe/comps/molecules/OrderedListWrapper.hx:36: characters 3-19
		$buf->add("</ul>");
		#src/microbe/comps/molecules/OrderedListWrapper.hx:37: characters 3-24
		return $buf->b;
	}


	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


self::$signal = new OrderSignal();
	}
}


Boot::registerClass(OrderedListWrapper::class, 'microbe.comps.molecules.OrderedListWrapper');
OrderedListWrapper::__hx__init();
