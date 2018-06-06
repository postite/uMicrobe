<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: src/microbe/control/HomeController.hx
 */

namespace microbe\control;

use \ufront\core\SurpriseTools;
use \ufront\log\MessageType;
use \haxe\rtti\Meta;
use \php\Boot;
use \php\_Boot\HxException;
use \tink\core\_Future\FutureObject;
use \haxe\Log;
use \ufront\web\Controller;
use \haxe\CallStack;
use \php\_Boot\HxAnon;
use \ufront\web\result\RedirectResult;
use \ufront\web\HttpError;

class HomeController extends Controller {


	/**
	 * @var MicrobeController
	 */
	public $mic;


	/**
	 * @return void
	 */
	public function __construct () {
		#src/microbe/control/HomeController.hx:9: lines 9-23
		parent::__construct();
	}


	/**
	 * @return FutureObject
	 */
	public function execute () {
		#src/microbe/control/HomeController.hx:9: lines 9-23
		$uriParts = $this->context->actionContext->get_uriParts();
		#src/microbe/control/HomeController.hx:9: lines 9-23
		$params = $this->context->request->get_params();
		#src/microbe/control/HomeController.hx:9: lines 9-23
		$method = $this->context->request->get_httpMethod();
		#src/microbe/control/HomeController.hx:9: lines 9-23
		$this->context->actionContext->controller = $this;
		#src/microbe/control/HomeController.hx:9: lines 9-23
		$this->context->actionContext->action = "execute";
		#src/microbe/control/HomeController.hx:9: lines 9-23
		try {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/ControllerMacros.hx:511: characters 28-65
			if (0 === $uriParts->length) {
				#src/microbe/control/HomeController.hx:12: lines 12-19
				$this->context->actionContext->action = "index";
				#src/microbe/control/HomeController.hx:12: lines 12-19
				$this->context->actionContext->args = new \Array_hx();
				#src/microbe/control/HomeController.hx:12: lines 12-19
				$this->context->actionContext->get_uriParts()->splice(0, 0);
				#src/microbe/control/HomeController.hx:12: lines 12-19
				$this1 = (Boot::dynamicField(Boot::dynamicField(Meta::getFields(Boot::getClass(HomeController::class)), 'index'), 'wrapResult')->arr[0] ?? null);
				#src/microbe/control/HomeController.hx:12: lines 12-19
				$wrappingRequired = $this1;
				#src/microbe/control/HomeController.hx:12: lines 12-19
				$result = $this->wrapResult($this->index(), $wrappingRequired);
				#src/microbe/control/HomeController.hx:12: lines 12-19
				$this->setContextActionResultWhenFinished($result);
				#src/microbe/control/HomeController.hx:12: lines 12-19
				return $result;
			} else if ((1 <= $uriParts->length) && (($uriParts->arr[0] ?? null) === "microbe")) {
				#src/microbe/control/HomeController.hx:21: characters 8-34
				$this->context->actionContext->action = "execute_mic";
				#src/microbe/control/HomeController.hx:21: characters 8-34
				$this->context->actionContext->args = new \Array_hx();
				#src/microbe/control/HomeController.hx:21: characters 8-34
				$this->context->actionContext->get_uriParts()->splice(0, 1);
				#src/microbe/control/HomeController.hx:21: characters 8-34
				$this11 = (Boot::dynamicField(Boot::dynamicField(Meta::getFields(Boot::getClass(HomeController::class)), 'execute_mic'), 'wrapResult')->arr[0] ?? null);
				#src/microbe/control/HomeController.hx:21: characters 8-34
				$wrappingRequired1 = $this11;
				#src/microbe/control/HomeController.hx:21: characters 8-34
				$result1 = $this->wrapResult($this->execute_mic(), $wrappingRequired1);
				#src/microbe/control/HomeController.hx:21: characters 8-34
				$this->setContextActionResultWhenFinished($result1);
				#src/microbe/control/HomeController.hx:21: characters 8-34
				return $result1;
			}
			#src/microbe/control/HomeController.hx:9: lines 9-23
			throw new HxException(HttpError::pageNotFound(new HxAnon([
				"fileName" => "src/microbe/control/HomeController.hx",
				"lineNumber" => 9,
				"className" => "microbe.control.HomeController",
				"methodName" => "execute",
			])));
		} catch (\Throwable $__hx__caught_e) {
			CallStack::saveExceptionTrace($__hx__caught_e);
			$__hx__real_e = ($__hx__caught_e instanceof HxException ? $__hx__caught_e->e : $__hx__caught_e);
			$e = $__hx__real_e;
			#src/microbe/control/HomeController.hx:9: lines 9-23
			return SurpriseTools::asSurpriseError($e, "Uncaught error while executing " . (\Std::string($this->context->actionContext->controller)??'null') . "." . ($this->context->actionContext->action??'null') . "()", new HxAnon([
				"fileName" => "src/microbe/control/HomeController.hx",
				"lineNumber" => 9,
				"className" => "microbe.control.HomeController",
				"methodName" => "execute",
			]));
		}
	}


	/**
	 * @return FutureObject
	 */
	public function execute_mic () {
		#src/microbe/control/HomeController.hx:21: characters 8-34
		return $this->context->injector->_instantiate(Boot::getClass(MicrobeController::class))->execute();
	}


	/**
	 * @return RedirectResult
	 */
	public function index () {
		#src/microbe/control/HomeController.hx:14: characters 5-20
		$pos = new HxAnon([
			"fileName" => "src/microbe/control/HomeController.hx",
			"lineNumber" => 14,
			"className" => "microbe.control.HomeController",
			"methodName" => "index",
		]);
		#src/microbe/control/HomeController.hx:14: characters 5-20
		if ($this->context !== null) {
			#src/microbe/control/HomeController.hx:14: characters 5-20
			$_this = $this->context->messages;
			#src/microbe/control/HomeController.hx:14: characters 5-20
			$_this->arr[$_this->length] = new HxAnon([
				"msg" => "yuzu",
				"pos" => $pos,
				"type" => MessageType::MTrace(),
			]);
			#src/microbe/control/HomeController.hx:14: characters 5-20
			++$_this->length;
		} else {
			#src/microbe/control/HomeController.hx:14: characters 5-20
			(Log::$trace)("yuzu", $pos);
		}

		#src/microbe/control/HomeController.hx:18: characters 5-42
		return new RedirectResult("/microbe");
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


	}
}


Boot::registerClass(HomeController::class, 'microbe.control.HomeController');
Boot::registerMeta(HomeController::class, new HxAnon(["fields" => new HxAnon([
	"index" => new HxAnon(["wrapResult" => \Array_hx::wrap([3])]),
	"execute_mic" => new HxAnon(["wrapResult" => \Array_hx::wrap([0])]),
])]));
HomeController::__hx__init();
