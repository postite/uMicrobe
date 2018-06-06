<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: src/microbe/control/MicrobeController.hx
 */

namespace microbe\control;

use \microbe\result\_MicrobeResult\MicrobeModelResult_Impl_;
use \ufront\web\result\TemplateSource;
use \ufront\core\SurpriseTools;
use \tink\core\_Promise\Promise_Impl_;
use \ufront\log\MessageType;
use \tink\core\Outcome;
use \ufront\web\result\PartialViewResult;
use \haxe\rtti\Meta;
use \php\Boot;
use \php\_Boot\HxException;
use \ufront\view\_TemplateHelper\TemplateHelper_Impl_;
use \tink\core\TypedError;
use \microbe\comps\wrappers\FormuleWrapper;
use \tink\core\_Future\FutureObject;
use \microbe\apis\MicrobialApiAsync;
use \tink\core\_Future\SyncFuture;
use \haxe\Log;
use \ufront\web\result\ContentResult;
use \ufront\web\Controller;
use \ufront\view\_TemplateData\TemplateData_Impl_;
use \ufront\web\result\ViewResult;
use \ufront\view\TemplatingEngines;
use \haxe\CallStack;
use \tink\core\_Lazy\LazyConst;
use \php\_Boot\HxAnon;
use \ufront\web\HttpError;

class MicrobeController extends Controller {


	/**
	 * @var string
	 */
	public $micPath;
	/**
	 * @var MicrobialApiAsync
	 */
	public $microbeApi;
	/**
	 * @var \Array_hx
	 */
	public $models;


	/**
	 * @param FutureObject $surp
	 * 
	 * @return FutureObject
	 */
	static public function asPromise ($surp) {
		#src/microbe/control/MicrobeController.hx:210: characters 3-27
		return $surp;
	}


	/**
	 * @param MicrobialApiAsync $api
	 * @param string $mod
	 * 
	 * @return FutureObject
	 */
	static public function reloadGlobalVars ($api, $mod) {
		#src/microbe/control/MicrobeController.hx:190: characters 3-8
		(Log::$trace)("reloadGlobalVars", new HxAnon([
			"fileName" => "src/microbe/control/MicrobeController.hx",
			"lineNumber" => 190,
			"className" => "microbe.control.MicrobeController",
			"methodName" => "reloadGlobalVars",
		]));
		#src/microbe/control/MicrobeController.hx:191: lines 191-200
		if (\Reflect::field(ViewResult::$globalValues, "items") === null) {
			#src/microbe/control/MicrobeController.hx:192: lines 192-200
			return Promise_Impl_::next($api->getAllModels($mod), function ($items) {
				#src/microbe/control/MicrobeController.hx:194: characters 8-50
				TemplateData_Impl_::set(ViewResult::$globalValues, "items", $items);
				#src/microbe/control/MicrobeController.hx:196: characters 8-20
				return Promise_Impl_::ofOutcome(Outcome::Success($items));
			});
		}
		#src/microbe/control/MicrobeController.hx:201: characters 3-41
		TemplateData_Impl_::set(ViewResult::$globalValues, "mod", $mod);
		#src/microbe/control/MicrobeController.hx:203: characters 3-85
		return new SyncFuture(new LazyConst(Outcome::Success(\Reflect::field(ViewResult::$globalValues, "items"))));
	}


	/**
	 * @param string $title
	 * @param string $template
	 * @param object $data
	 * 
	 * @return ViewResult
	 */
	static public function wrapInLayout ($title, $template, $data) {
		#src/microbe/control/MicrobeController.hx:56: lines 56-61
		return (new ViewResult($data))->setVar("title", $title)->usingTemplateString($template, "<!DOCTYPE html>\x0A<html>\x0A<head>\x0A\x09<title>::title::</title>\x0A\x0A\x09\x0A\x09\x0A\x09\x09<!-- Font Awesome for awesome icons. You can redefine icons used in a plugin configuration -->\x0A\x09<link href=\"http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css\" rel=\"stylesheet\">\x0A\x09\x0A\x09<!-- CSS -->\x0A\x09<link rel=\"stylesheet\" href=\"http://linkesch.com/medium-editor-insert-plugin/bower_components/medium-editor/dist/css/medium-editor.min.css\">\x0A\x09<link rel=\"stylesheet\" href=\"http://linkesch.com/medium-editor-insert-plugin/bower_components/medium-editor/dist/css/themes/default.css\">\x0A\x09<link rel=\"stylesheet\" href=\"http://linkesch.com/medium-editor-insert-plugin/bower_components/medium-editor-insert-plugin/dist/css/medium-editor-insert-plugin.min.css\">\x0A\x09\x0A\x09<!-- JS -->\x0A\x09<script uf-reload src=\"http://linkesch.com/medium-editor-insert-plugin/bower_components/jquery/dist/jquery.min.js\"></script>\x0A\x09<script uf-reload src=\"http://linkesch.com/medium-editor-insert-plugin/bower_components/medium-editor/dist/js/medium-editor.js\"></script>\x0A\x09<script uf-reload src=\"http://linkesch.com/medium-editor-insert-plugin/bower_components/handlebars/handlebars.runtime.min.js\"></script>\x0A\x09<script uf-reload src=\"http://linkesch.com/medium-editor-insert-plugin/bower_components/jquery-sortable/source/js/jquery-sortable-min.js\"></script>\x0A\x09<script uf-reload src=\"http://linkesch.com/medium-editor-insert-plugin/bower_components/blueimp-file-upload/js/vendor/jquery.ui.widget.js\"></script>\x0A\x09<script uf-reload src=\"http://linkesch.com/medium-editor-insert-plugin/bower_components/blueimp-file-upload/js/jquery.iframe-transport.js\"></script>\x0A\x09<script uf-reload src=\"http://linkesch.com/medium-editor-insert-plugin/bower_components/blueimp-file-upload/js/jquery.fileupload.js\"></script>\x0A\x09<script uf-reload src=\"http://linkesch.com/medium-editor-insert-plugin/bower_components/medium-editor-insert-plugin/dist/js/medium-editor-insert-plugin.min.js\"></script>\x0A\x09\x0A\x0A\x0A\x09<script type=\"text/javascript\" src=\"/js/client.js\"></script>\x0A\x09<link rel=\"stylesheet\" type=\"text/css\" href=\"/js/lessie/lessie.css\">\x0A</head>\x0A<body data-uf-layout=\"layout\">\x0A::viewContent::\x0A</body>\x0A</html>");
	}


	/**
	 * @return void
	 */
	public function __construct () {
		#src/microbe/control/MicrobeController.hx:17: lines 17-357
		parent::__construct();
	}


	/**
	 * @return FutureObject
	 */
	public function execute () {
		#src/microbe/control/MicrobeController.hx:17: lines 17-357
		$uriParts = $this->context->actionContext->get_uriParts();
		#src/microbe/control/MicrobeController.hx:17: lines 17-357
		$params = $this->context->request->get_params();
		#src/microbe/control/MicrobeController.hx:17: lines 17-357
		$method = $this->context->request->get_httpMethod();
		#src/microbe/control/MicrobeController.hx:17: lines 17-357
		$this->context->actionContext->controller = $this;
		#src/microbe/control/MicrobeController.hx:17: lines 17-357
		$this->context->actionContext->action = "execute";
		#src/microbe/control/MicrobeController.hx:17: lines 17-357
		try {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/ControllerMacros.hx:511: characters 28-65
			if (0 === $uriParts->length) {
				#src/microbe/control/MicrobeController.hx:65: lines 65-76
				$this->context->actionContext->action = "index";
				#src/microbe/control/MicrobeController.hx:65: lines 65-76
				$this->context->actionContext->args = new \Array_hx();
				#src/microbe/control/MicrobeController.hx:65: lines 65-76
				$this->context->actionContext->get_uriParts()->splice(0, 0);
				#src/microbe/control/MicrobeController.hx:65: lines 65-76
				$this1 = (Boot::dynamicField(Boot::dynamicField(Meta::getFields(Boot::getClass(MicrobeController::class)), 'index'), 'wrapResult')->arr[0] ?? null);
				#src/microbe/control/MicrobeController.hx:65: lines 65-76
				$wrappingRequired = $this1;
				#src/microbe/control/MicrobeController.hx:65: lines 65-76
				$result = $this->wrapResult($this->index(), $wrappingRequired);
				#src/microbe/control/MicrobeController.hx:65: lines 65-76
				$this->setContextActionResultWhenFinished($result);
				#src/microbe/control/MicrobeController.hx:65: lines 65-76
				return $result;
			} else if ((3 === $uriParts->length) && (($uriParts->arr[0] ?? null) === "mods") && (($uriParts->arr[1] ?? null) === "list") && (strlen(($uriParts->arr[2] ?? null)) > 0)) {
				#src/microbe/control/MicrobeController.hx:80: lines 80-98
				$name = ($uriParts->arr[2] ?? null);
				#src/microbe/control/MicrobeController.hx:80: lines 80-98
				$this->context->actionContext->action = "mods";
				#src/microbe/control/MicrobeController.hx:80: lines 80-98
				$this->context->actionContext->args = \Array_hx::wrap([$name]);
				#src/microbe/control/MicrobeController.hx:80: lines 80-98
				$this->context->actionContext->get_uriParts()->splice(0, 3);
				#src/microbe/control/MicrobeController.hx:80: lines 80-98
				$this11 = (Boot::dynamicField(Boot::dynamicField(Meta::getFields(Boot::getClass(MicrobeController::class)), 'mods'), 'wrapResult')->arr[0] ?? null);
				#src/microbe/control/MicrobeController.hx:80: lines 80-98
				$wrappingRequired1 = $this11;
				#src/microbe/control/MicrobeController.hx:80: lines 80-98
				$result1 = $this->wrapResult($this->mods($name), $wrappingRequired1);
				#src/microbe/control/MicrobeController.hx:80: lines 80-98
				$this->setContextActionResultWhenFinished($result1);
				#src/microbe/control/MicrobeController.hx:80: lines 80-98
				return $result1;
			} else if ((3 === $uriParts->length) && (($uriParts->arr[0] ?? null) === "mods") && (($uriParts->arr[1] ?? null) === "plus") && (strlen(($uriParts->arr[2] ?? null)) > 0)) {
				#src/microbe/control/MicrobeController.hx:100: lines 100-106
				$name1 = ($uriParts->arr[2] ?? null);
				#src/microbe/control/MicrobeController.hx:100: lines 100-106
				$this->context->actionContext->action = "plus";
				#src/microbe/control/MicrobeController.hx:100: lines 100-106
				$this->context->actionContext->args = \Array_hx::wrap([$name1]);
				#src/microbe/control/MicrobeController.hx:100: lines 100-106
				$this->context->actionContext->get_uriParts()->splice(0, 3);
				#src/microbe/control/MicrobeController.hx:100: lines 100-106
				$this12 = (Boot::dynamicField(Boot::dynamicField(Meta::getFields(Boot::getClass(MicrobeController::class)), 'plus'), 'wrapResult')->arr[0] ?? null);
				#src/microbe/control/MicrobeController.hx:100: lines 100-106
				$wrappingRequired2 = $this12;
				#src/microbe/control/MicrobeController.hx:100: lines 100-106
				$result2 = $this->wrapResult($this->plus($name1), $wrappingRequired2);
				#src/microbe/control/MicrobeController.hx:100: lines 100-106
				$this->setContextActionResultWhenFinished($result2);
				#src/microbe/control/MicrobeController.hx:100: lines 100-106
				return $result2;
			} else if ((2 === $uriParts->length) && (($uriParts->arr[0] ?? null) === "insert") && (strlen(($uriParts->arr[1] ?? null)) > 0)) {
				#src/microbe/control/MicrobeController.hx:111: lines 111-153
				$mod = ($uriParts->arr[1] ?? null);
				#src/microbe/control/MicrobeController.hx:111: lines 111-153
				$this->context->actionContext->action = "insert";
				#src/microbe/control/MicrobeController.hx:111: lines 111-153
				$this->context->actionContext->args = \Array_hx::wrap([$mod]);
				#src/microbe/control/MicrobeController.hx:111: lines 111-153
				$this->context->actionContext->get_uriParts()->splice(0, 2);
				#src/microbe/control/MicrobeController.hx:111: lines 111-153
				$this13 = (Boot::dynamicField(Boot::dynamicField(Meta::getFields(Boot::getClass(MicrobeController::class)), 'insert'), 'wrapResult')->arr[0] ?? null);
				#src/microbe/control/MicrobeController.hx:111: lines 111-153
				$wrappingRequired3 = $this13;
				#src/microbe/control/MicrobeController.hx:111: lines 111-153
				$result3 = $this->wrapResult($this->insert($mod), $wrappingRequired3);
				#src/microbe/control/MicrobeController.hx:111: lines 111-153
				$this->setContextActionResultWhenFinished($result3);
				#src/microbe/control/MicrobeController.hx:111: lines 111-153
				return $result3;
			} else if ((4 === $uriParts->length) && (($uriParts->arr[0] ?? null) === "affiche") && (strlen(($uriParts->arr[1] ?? null)) > 0) && (($uriParts->arr[2] ?? null) === "mod") && (strlen(($uriParts->arr[3] ?? null)) > 0)) {
				#src/microbe/control/MicrobeController.hx:155: lines 155-172
				$mod1 = ($uriParts->arr[1] ?? null);
				#src/microbe/control/MicrobeController.hx:155: lines 155-172
				$id = \Std::parseInt(($uriParts->arr[3] ?? null));
				#src/microbe/control/MicrobeController.hx:155: lines 155-172
				if ($id === null) {
					#src/microbe/control/MicrobeController.hx:155: lines 155-172
					$reason = "Could not parse parameter " . "id" . ":Int = " . (($uriParts->arr[3] ?? null)??'null');
					#src/microbe/control/MicrobeController.hx:155: lines 155-172
					$message = "Bad Request";
					#src/microbe/control/MicrobeController.hx:155: lines 155-172
					if ($reason !== null) {
						#src/microbe/control/MicrobeController.hx:155: lines 155-172
						$message = ($message??'null') . ((": " . ($reason??'null'))??'null');
					}
					#src/microbe/control/MicrobeController.hx:155: lines 155-172
					throw new HxException(new TypedError(400, $message, new HxAnon([
						"fileName" => "src/microbe/control/MicrobeController.hx",
						"lineNumber" => 155,
						"className" => "microbe.control.MicrobeController",
						"methodName" => "execute",
					])));
				}
				#src/microbe/control/MicrobeController.hx:155: lines 155-172
				$this->context->actionContext->action = "update";
				#src/microbe/control/MicrobeController.hx:155: lines 155-172
				$this->context->actionContext->args = \Array_hx::wrap([
					$mod1,
					$id,
				]);
				#src/microbe/control/MicrobeController.hx:155: lines 155-172
				$this->context->actionContext->get_uriParts()->splice(0, 4);
				#src/microbe/control/MicrobeController.hx:155: lines 155-172
				$this14 = (Boot::dynamicField(Boot::dynamicField(Meta::getFields(Boot::getClass(MicrobeController::class)), 'update'), 'wrapResult')->arr[0] ?? null);
				#src/microbe/control/MicrobeController.hx:155: lines 155-172
				$wrappingRequired4 = $this14;
				#src/microbe/control/MicrobeController.hx:155: lines 155-172
				$result4 = $this->wrapResult($this->update($mod1, $id), $wrappingRequired4);
				#src/microbe/control/MicrobeController.hx:155: lines 155-172
				$this->setContextActionResultWhenFinished($result4);
				#src/microbe/control/MicrobeController.hx:155: lines 155-172
				return $result4;
			} else if ((2 === $uriParts->length) && (($uriParts->arr[0] ?? null) === "setup") && (strlen(($uriParts->arr[1] ?? null)) > 0)) {
				#src/microbe/control/MicrobeController.hx:175: lines 175-186
				$mod2 = ($uriParts->arr[1] ?? null);
				#src/microbe/control/MicrobeController.hx:175: lines 175-186
				$this->context->actionContext->action = "setup";
				#src/microbe/control/MicrobeController.hx:175: lines 175-186
				$this->context->actionContext->args = \Array_hx::wrap([$mod2]);
				#src/microbe/control/MicrobeController.hx:175: lines 175-186
				$this->context->actionContext->get_uriParts()->splice(0, 2);
				#src/microbe/control/MicrobeController.hx:175: lines 175-186
				$this15 = (Boot::dynamicField(Boot::dynamicField(Meta::getFields(Boot::getClass(MicrobeController::class)), 'setup'), 'wrapResult')->arr[0] ?? null);
				#src/microbe/control/MicrobeController.hx:175: lines 175-186
				$wrappingRequired5 = $this15;
				#src/microbe/control/MicrobeController.hx:175: lines 175-186
				$result5 = $this->wrapResult($this->setup($mod2), $wrappingRequired5);
				#src/microbe/control/MicrobeController.hx:175: lines 175-186
				$this->setContextActionResultWhenFinished($result5);
				#src/microbe/control/MicrobeController.hx:175: lines 175-186
				return $result5;
			}
			#src/microbe/control/MicrobeController.hx:17: lines 17-357
			throw new HxException(HttpError::pageNotFound(new HxAnon([
				"fileName" => "src/microbe/control/MicrobeController.hx",
				"lineNumber" => 17,
				"className" => "microbe.control.MicrobeController",
				"methodName" => "execute",
			])));
		} catch (\Throwable $__hx__caught_e) {
			CallStack::saveExceptionTrace($__hx__caught_e);
			$__hx__real_e = ($__hx__caught_e instanceof HxException ? $__hx__caught_e->e : $__hx__caught_e);
			$e = $__hx__real_e;
			#src/microbe/control/MicrobeController.hx:17: lines 17-357
			return SurpriseTools::asSurpriseError($e, "Uncaught error while executing " . (\Std::string($this->context->actionContext->controller)??'null') . "." . ($this->context->actionContext->action??'null') . "()", new HxAnon([
				"fileName" => "src/microbe/control/MicrobeController.hx",
				"lineNumber" => 17,
				"className" => "microbe.control.MicrobeController",
				"methodName" => "execute",
			]));
		}
	}


	/**
	 * @return ViewResult
	 */
	public function index () {
		#src/microbe/control/MicrobeController.hx:67: characters 3-26
		$msg = "indox" . (\Std::string($this->models)??'null');
		#src/microbe/control/MicrobeController.hx:67: characters 3-26
		$pos = new HxAnon([
			"fileName" => "src/microbe/control/MicrobeController.hx",
			"lineNumber" => 67,
			"className" => "microbe.control.MicrobeController",
			"methodName" => "index",
		]);
		#src/microbe/control/MicrobeController.hx:67: characters 3-26
		if ($this->context !== null) {
			#src/microbe/control/MicrobeController.hx:67: characters 3-26
			$_this = $this->context->messages;
			#src/microbe/control/MicrobeController.hx:67: characters 3-26
			$_this->arr[$_this->length] = new HxAnon([
				"msg" => $msg,
				"pos" => $pos,
				"type" => MessageType::MTrace(),
			]);
			#src/microbe/control/MicrobeController.hx:67: characters 3-26
			++$_this->length;
		} else {
			#src/microbe/control/MicrobeController.hx:67: characters 3-26
			(Log::$trace)("" . (\Std::string($msg)??'null'), $pos);
		}

		#src/microbe/control/MicrobeController.hx:68: characters 3-42
		TemplateData_Impl_::set(ViewResult::$globalValues, "items", new \Array_hx());
		#src/microbe/control/MicrobeController.hx:71: characters 1-72
		$template = "<header><h1>Microbe Admin</h1>\x0A<a href=\"/::micPath::\" rel=\"pushstate\">⦿</a>\x0A</header>\x0A<div class=\"mic-walker\">\x0A\x09<div class=\"mic-walk\" data-uf-partial=\"volist\">\$\$voList()</div>\x0A\x09<div class=\"mic-walk\" data-uf-partial=\"items\">\$\$items()</div>\x0A\x09<div class=\"mic-walk\" data-uf-partial=\"form\">\$\$form()</div>\x0A</div>";
		#src/microbe/control/MicrobeController.hx:72: characters 36-38
		$obj = new HxAnon();
		#src/microbe/control/MicrobeController.hx:72: characters 36-38
		$this1 = ($obj !== null ? $obj : new HxAnon());
		#src/microbe/control/MicrobeController.hx:72: lines 72-74
		return MicrobeController::wrapInLayout("mic", $template, TemplateData_Impl_::setObject($this1, new HxAnon()))->addPartialString("microbeFarm", "hellomicrobe", TemplatingEngines::get_haxe());
	}


	/**
	 * @return void
	 */
	public function init () {
		#src/microbe/control/MicrobeController.hx:36: characters 2-44
		TemplateData_Impl_::set(ViewResult::$globalValues, "mods", $this->models);
		#src/microbe/control/MicrobeController.hx:37: characters 2-48
		TemplateData_Impl_::set(ViewResult::$globalValues, "micPath", $this->micPath);
		#src/microbe/control/MicrobeController.hx:38: characters 2-66
		$this1 = ViewResult::$globalHelpers;
		#src/microbe/control/MicrobeController.hx:38: characters 2-66
		$value = TemplateHelper_Impl_::from1(function ($n) {
			#src/microbe/control/MicrobeController.hx:38: characters 56-65
			return "";
		});
		#src/microbe/control/MicrobeController.hx:38: characters 2-66
		$this1->data["microbeFarm"] = $value;

		#src/microbe/control/MicrobeController.hx:39: characters 2-101
		$this11 = ViewResult::$globalPartials;
		#src/microbe/control/MicrobeController.hx:39: characters 2-101
		$value1 = TemplateSource::TFromEngine("/microbe/voList.html", TemplatingEngines::get_haxe());
		#src/microbe/control/MicrobeController.hx:39: characters 2-101
		$this11->data["voList"] = $value1;

		#src/microbe/control/MicrobeController.hx:41: characters 2-99
		$this12 = ViewResult::$globalPartials;
		#src/microbe/control/MicrobeController.hx:41: characters 2-99
		$value2 = TemplateSource::TFromEngine("/microbe/items.html", TemplatingEngines::get_haxe());
		#src/microbe/control/MicrobeController.hx:41: characters 2-99
		$this12->data["items"] = $value2;

		#src/microbe/control/MicrobeController.hx:43: characters 2-97
		$this13 = ViewResult::$globalPartials;
		#src/microbe/control/MicrobeController.hx:43: characters 2-97
		$value3 = TemplateSource::TFromEngine("/microbe/form.html", TemplatingEngines::get_haxe());
		#src/microbe/control/MicrobeController.hx:43: characters 2-97
		$this13->data["form"] = $value3;

	}


	/**
	 * @param string $mod
	 * 
	 * @return FutureObject
	 */
	public function insert ($mod) {
		#src/microbe/control/MicrobeController.hx:111: lines 111-153
		$_gthis = $this;
		#src/microbe/control/MicrobeController.hx:113: lines 113-133
		$f = function ($n) {
			#src/microbe/control/MicrobeController.hx:132: characters 4-68
			return new SyncFuture(new LazyConst(new ContentResult(\Std::string("erreur" . (\Std::string($n)??'null')))));
		};
		#src/microbe/control/MicrobeController.hx:113: lines 113-133
		$ret = Promise_Impl_::next($this->microbeApi->getFormuleFromString($mod), function ($formule)  use (&$mod, &$_gthis) {
			#src/microbe/control/MicrobeController.hx:122: characters 4-20
			$pos = new HxAnon([
				"fileName" => "src/microbe/control/MicrobeController.hx",
				"lineNumber" => 122,
				"className" => "microbe.control.MicrobeController",
				"methodName" => "insert",
			]);
			#src/microbe/control/MicrobeController.hx:122: characters 4-20
			if ($_gthis->context !== null) {
				#src/microbe/control/MicrobeController.hx:122: characters 4-20
				$_this = $_gthis->context->messages;
				#src/microbe/control/MicrobeController.hx:122: characters 4-20
				$_this->arr[$_this->length] = new HxAnon([
					"msg" => $formule,
					"pos" => $pos,
					"type" => MessageType::MTrace(),
				]);
				#src/microbe/control/MicrobeController.hx:122: characters 4-20
				++$_this->length;
			} else {
				#src/microbe/control/MicrobeController.hx:122: characters 4-20
				(Log::$trace)("" . ($formule->toString()??'null'), $pos);
			}

			#src/microbe/control/MicrobeController.hx:124: lines 124-128
			return Promise_Impl_::ofOutcome(Outcome::Success(MicrobeModelResult_Impl_::_new($mod, new FormuleWrapper($formule), "")));
		})->flatMap(function ($o)  use (&$f) {
			#src/microbe/control/MicrobeController.hx:113: lines 113-133
			switch ($o->index) {
				case 0:
					#src/microbe/control/MicrobeController.hx:113: lines 113-133
					$d = $o->params[0];
					#src/microbe/control/MicrobeController.hx:113: lines 113-133
					return new SyncFuture(new LazyConst($d));
					break;
				case 1:
					#src/microbe/control/MicrobeController.hx:113: lines 113-133
					$e = $o->params[0];
					#src/microbe/control/MicrobeController.hx:113: lines 113-133
					return $f($e);
					break;
			}
		});
		#src/microbe/control/MicrobeController.hx:113: lines 113-133
		return $ret->gather();
	}


	/**
	 * @param string $name
	 * 
	 * @return FutureObject
	 */
	public function mods ($name) {
		#src/microbe/control/MicrobeController.hx:80: lines 80-98
		$_gthis = $this;
		#src/microbe/control/MicrobeController.hx:82: lines 82-95
		$f = function ($n)  use (&$name, &$_gthis) {
			#src/microbe/control/MicrobeController.hx:91: characters 5-18
			$pos = new HxAnon([
				"fileName" => "src/microbe/control/MicrobeController.hx",
				"lineNumber" => 91,
				"className" => "microbe.control.MicrobeController",
				"methodName" => "mods",
			]);
			#src/microbe/control/MicrobeController.hx:91: characters 5-18
			if ($_gthis->context !== null) {
				#src/microbe/control/MicrobeController.hx:91: characters 5-18
				$_this = $_gthis->context->messages;
				#src/microbe/control/MicrobeController.hx:91: characters 5-18
				$_this->arr[$_this->length] = new HxAnon([
					"msg" => "mods",
					"pos" => $pos,
					"type" => MessageType::MLog(),
				]);
				#src/microbe/control/MicrobeController.hx:91: characters 5-18
				++$_this->length;
			} else {
				#src/microbe/control/MicrobeController.hx:91: characters 5-18
				(Log::$trace)("Log: " . "mods", $pos);
			}

			#src/microbe/control/MicrobeController.hx:93: characters 39-58
			$obj = new HxAnon();
			#src/microbe/control/MicrobeController.hx:93: characters 39-58
			$this1 = ($obj !== null ? $obj : new HxAnon());
			#src/microbe/control/MicrobeController.hx:93: characters 5-78
			return new SyncFuture(new LazyConst(new PartialViewResult(TemplateData_Impl_::setObject($this1, new HxAnon([
				"mod" => $name,
				"items" => new \Array_hx(),
			])), "index")));
		};
		#src/microbe/control/MicrobeController.hx:82: lines 82-95
		$ret = Promise_Impl_::next($this->microbeApi->getAllModels($name), function ($items)  use (&$name, &$_gthis) {
			#src/microbe/control/MicrobeController.hx:83: characters 1-25
			$msg = "back" . (\Std::string($items)??'null') . ($name??'null');
			#src/microbe/control/MicrobeController.hx:83: characters 1-25
			$pos1 = new HxAnon([
				"fileName" => "src/microbe/control/MicrobeController.hx",
				"lineNumber" => 83,
				"className" => "microbe.control.MicrobeController",
				"methodName" => "mods",
			]);
			#src/microbe/control/MicrobeController.hx:83: characters 1-25
			if ($_gthis->context !== null) {
				#src/microbe/control/MicrobeController.hx:83: characters 1-25
				$_this1 = $_gthis->context->messages;
				#src/microbe/control/MicrobeController.hx:83: characters 1-25
				$_this1->arr[$_this1->length] = new HxAnon([
					"msg" => $msg,
					"pos" => $pos1,
					"type" => MessageType::MLog(),
				]);
				#src/microbe/control/MicrobeController.hx:83: characters 1-25
				++$_this1->length;
			} else {
				#src/microbe/control/MicrobeController.hx:83: characters 1-25
				(Log::$trace)("Log: " . (\Std::string($msg)??'null'), $pos1);
			}

			#src/microbe/control/MicrobeController.hx:84: characters 5-47
			TemplateData_Impl_::set(ViewResult::$globalValues, "items", $items);
			#src/microbe/control/MicrobeController.hx:85: characters 5-44
			TemplateData_Impl_::set(ViewResult::$globalValues, "mod", $name);
			#src/microbe/control/MicrobeController.hx:86: characters 33-55
			$obj1 = new HxAnon();
			#src/microbe/control/MicrobeController.hx:86: characters 33-55
			$this11 = ($obj1 !== null ? $obj1 : new HxAnon());
			#src/microbe/control/MicrobeController.hx:86: characters 4-64
			return Promise_Impl_::ofOutcome(Outcome::Success(new PartialViewResult(TemplateData_Impl_::setObject($this11, new HxAnon([
				"mod" => $name,
				"items" => $items,
			])), "index")));
		})->flatMap(function ($o)  use (&$f) {
			#src/microbe/control/MicrobeController.hx:82: lines 82-95
			switch ($o->index) {
				case 0:
					#src/microbe/control/MicrobeController.hx:82: lines 82-95
					$d = $o->params[0];
					#src/microbe/control/MicrobeController.hx:82: lines 82-95
					return new SyncFuture(new LazyConst($d));
					break;
				case 1:
					#src/microbe/control/MicrobeController.hx:82: lines 82-95
					$e = $o->params[0];
					#src/microbe/control/MicrobeController.hx:82: lines 82-95
					return $f($e);
					break;
			}
		});
		#src/microbe/control/MicrobeController.hx:82: lines 82-95
		return $ret->gather();
	}


	/**
	 * @param string $name
	 * 
	 * @return FutureObject
	 */
	public function plus ($name) {
		#src/microbe/control/MicrobeController.hx:103: characters 3-22
		return $this->insert($name);
	}


	/**
	 * @param string $mod
	 * 
	 * @return FutureObject
	 */
	public function setup ($mod) {
		#src/microbe/control/MicrobeController.hx:176: lines 176-185
		$ret = Promise_Impl_::next($this->microbeApi->setupTable($mod), function ($l) {
			#src/microbe/control/MicrobeController.hx:178: characters 7-49
			return Promise_Impl_::ofOutcome(Outcome::Success(new ContentResult("ok table créée")));
		})->flatMap(function ($o) {
			#src/microbe/control/MicrobeController.hx:176: lines 176-185
			switch ($o->index) {
				case 0:
					#src/microbe/control/MicrobeController.hx:176: lines 176-185
					$d = $o->params[0];
					#src/microbe/control/MicrobeController.hx:176: lines 176-185
					return new SyncFuture(new LazyConst($d));
					break;
				case 1:
					#src/microbe/control/MicrobeController.hx:176: lines 176-185
					$e = $o->params[0];
					#src/microbe/control/MicrobeController.hx:183: characters 12-16
					return null;
					break;
			}
		});
		#src/microbe/control/MicrobeController.hx:176: lines 176-185
		return $ret->gather();
	}


	/**
	 * @param string $mod
	 * @param int $id
	 * 
	 * @return FutureObject
	 */
	public function update ($mod, $id) {
		#src/microbe/control/MicrobeController.hx:156: lines 156-167
		$ret = $this->microbeApi->getDataFormule($mod, $id)->map(function ($o)  use (&$mod) {
			#src/microbe/control/MicrobeController.hx:158: lines 158-166
			switch ($o->index) {
				case 0:
					#src/microbe/control/MicrobeController.hx:159: characters 19-26
					$formule = $o->params[0];
					#src/microbe/control/MicrobeController.hx:160: lines 160-163
					return MicrobeModelResult_Impl_::_new($mod, new FormuleWrapper($formule), "");
					break;
				case 1:
					#src/microbe/control/MicrobeController.hx:164: characters 19-20
					$r = $o->params[0];
					#src/microbe/control/MicrobeController.hx:165: characters 6-50
					return new ContentResult(\Std::string($r));
					break;
			}
		});
		#src/microbe/control/MicrobeController.hx:156: lines 156-167
		return $ret->gather();
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


Boot::registerClass(MicrobeController::class, 'microbe.control.MicrobeController');
Boot::registerMeta(MicrobeController::class, new HxAnon([
	"obj" => new HxAnon([
		"rtti" => \Array_hx::wrap([
			\Array_hx::wrap([
				"microbeApi",
				"microbe.apis.MicrobialApiAsync",
				"",
			]),
			\Array_hx::wrap([
				"models",
				"Array<Dynamic>",
				"models",
			]),
			\Array_hx::wrap([
				"micPath",
				"String",
				"micPath",
			]),
			\Array_hx::wrap([
				"init",
				"1",
			]),
		]),
		"viewFolder" => \Array_hx::wrap(["microbe"]),
	]),
	"fields" => new HxAnon([
		"index" => new HxAnon(["wrapResult" => \Array_hx::wrap([3])]),
		"mods" => new HxAnon(["wrapResult" => \Array_hx::wrap([6])]),
		"plus" => new HxAnon(["wrapResult" => \Array_hx::wrap([6])]),
		"insert" => new HxAnon(["wrapResult" => \Array_hx::wrap([6])]),
		"update" => new HxAnon(["wrapResult" => \Array_hx::wrap([6])]),
		"setup" => new HxAnon(["wrapResult" => \Array_hx::wrap([6])]),
	]),
]));
MicrobeController::__hx__init();