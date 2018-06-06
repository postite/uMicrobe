<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFTemplate.hx
 */

namespace ufront\view\_UFTemplate;

use \haxe\ds\StringMap;
use \php\Boot;
use \ufront\view\_TemplateHelper\TemplateHelper_Impl_;
use \php\_NativeArray\NativeArrayIterator;
use \ufront\view\_TemplateData\TemplateData_Impl_;
use \php\_Boot\HxAnon;

final class UFTemplate_Impl_ {
	/**
	 * @param \Closure $cb
	 * 
	 * @return \Closure
	 */
	static public function _new ($cb) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFTemplate.hx:29: character 9
		$this1 = $cb;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFTemplate.hx:29: character 9
		return $this1;
	}


	/**
	 * Execute the template with the given data and helpers.
	 * Please see `TemplateData` and `TemplateHelper` for an explanation of the different data types that can be accepted through the implicit casts.
	 * `UFTemplate` also has `@:callable` metadata, so you can call it directly: `myTemplate( data, helpers )`.
	 * 
	 * @param \Closure $this
	 * @param object $data
	 * @param StringMap $helpers
	 * 
	 * @return string
	 */
	static public function execute ($this1, $data, $helpers = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFTemplate.hx:56: characters 3-31
		return $this1($data, $helpers);
	}


	/**
	 * If a templating engine combines data and helpers in a single object, you can create a UFTemplate from a single `TemplateData->String` function.
	 * This will combine the `data` and `helpers` objects into a single object, and pass it to the callback.
	 * 
	 * @param \Closure $cb
	 * 
	 * @return \Closure
	 */
	static public function fromSimpleCallback ($cb) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFTemplate.hx:36: lines 36-45
		return UFTemplate_Impl_::_new(function ($data, $helpers)  use (&$cb) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFTemplate.hx:37: characters 23-41
			$this1 = new HxAnon();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFTemplate.hx:37: characters 4-42
			$combinedData = $this1;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFTemplate.hx:38: lines 38-42
			if ($helpers !== null) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFTemplate.hx:39: characters 25-39
				$helperName = new NativeArrayIterator(array_map("strval", array_keys($helpers->data)));
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFTemplate.hx:39: characters 25-39
				while ($helperName->hasNext()) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFTemplate.hx:39: lines 39-41
					$helperName1 = $helperName->next();
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFTemplate.hx:40: characters 6-65
					TemplateData_Impl_::set($combinedData, $helperName1, TemplateHelper_Impl_::getFn(($helpers->data[$helperName1] ?? null)));
				}
			}
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFTemplate.hx:43: characters 4-34
			TemplateData_Impl_::setObject($combinedData, $data);
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFTemplate.hx:44: characters 4-29
			return $cb($combinedData);
		});
	}
}


Boot::registerClass(UFTemplate_Impl_::class, 'ufront.view._UFTemplate.UFTemplate_Impl_');