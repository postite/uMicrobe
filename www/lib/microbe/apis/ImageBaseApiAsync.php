<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: src/microbe/apis/ImageBaseApi.hx
 */

namespace microbe\apis;

use \php\_Boot\HxException;
use \php\Boot;
use \tink\core\_Future\FutureObject;
use \ufront\api\UFAsyncApi;
use \minject\Injector;
use \haxe\CallStack;
use \php\_Boot\HxAnon;
use \ufront\web\HttpError;

class ImageBaseApiAsync extends UFAsyncApi {


	/**
	 * @return Class
	 */
	static public function _getClass () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/api/ApiMacros.hx:276: characters 55-79
		return Boot::getClass(ImageBaseApi::class);
	}


	/**
	 * @return void
	 */
	public function __construct () {
		#src/microbe/apis/ImageBaseApi.hx:93: characters 1-60
		parent::__construct();
	}


	/**
	 * Async call for `microbe.apis.ImageBaseApi.getResizedImage()`
	 * 
	 * @param string $path
	 * @param object $taille
	 * 
	 * @return FutureObject
	 */
	public function getResizedImage ($path, $taille = null) {
		#src/microbe/apis/ImageBaseApi.hx:51: lines 51-84
		$this1 = 3;
		#src/microbe/apis/ImageBaseApi.hx:51: lines 51-84
		return $this->_makeApiCall("getResizedImage", \Array_hx::wrap([
			$path,
			$taille,
		]), $this1, new HxAnon([
			"lineNumber" => 0,
			"fileName" => "src/microbe/apis/ImageBaseApi.hx",
			"className" => "ImageBaseApiAsync",
			"methodName" => "getResizedImage",
			"customParams" => null,
		]));
	}


	/**
	 * @param Injector $injector
	 * 
	 * @return void
	 */
	public function injectApi ($injector) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/api/ApiMacros.hx:271: lines 271-272
		$tmp = null;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/api/ApiMacros.hx:271: lines 271-272
		try {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/api/ApiMacros.hx:271: lines 271-272
			$tmp = $injector->getValueForType("microbe.apis.ImageBaseApi");
		} catch (\Throwable $__hx__caught_e) {
			CallStack::saveExceptionTrace($__hx__caught_e);
			$__hx__real_e = ($__hx__caught_e instanceof HxException ? $__hx__caught_e->e : $__hx__caught_e);
			$e = $__hx__real_e;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/api/ApiMacros.hx:272: characters 26-31
			throw new HxException(HttpError::internalServerError("Failed to inject " . (\Type::getClassName(Boot::getClass(ImageBaseApi::class))??'null') . " into " . (\Type::getClassName(\Type::getClass($this))??'null'), $e, new HxAnon([
				"fileName" => "ufront/api/ApiMacros.hx",
				"lineNumber" => 272,
				"className" => "microbe.apis.ImageBaseApiAsync",
				"methodName" => "injectApi",
			])));
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/api/ApiMacros.hx:270: lines 270-272
		$this->api = $tmp;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/api/ApiMacros.hx:274: characters 6-43
		$this->className = "microbe.apis.ImageBaseApi";
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


Boot::registerClass(ImageBaseApiAsync::class, 'microbe.apis.ImageBaseApiAsync');
Boot::registerMeta(ImageBaseApiAsync::class, new HxAnon(["obj" => new HxAnon(["rtti" => \Array_hx::wrap([\Array_hx::wrap([
	"injectApi",
	"",
	"minject.Injector",
	"",
	"",
])])])]));
ImageBaseApiAsync::__hx__init();
