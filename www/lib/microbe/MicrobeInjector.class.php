<?php

// Generated by Haxe 3.4.7
class microbe_MicrobeInjector {
	public function __construct(){}
	static function inject($injector) {
		$GLOBALS['%s']->push("microbe.MicrobeInjector::inject");
		$__hx__spos = $GLOBALS['%s']->length;
		microbe_FormGenerator::$injector = $injector;
		$injector->mapType("String", "upsPath", null)->toValue("/ups");
		$injector->mapType("String", "assetPath", null)->toValue("/assets");
		$injector->mapType("String", "micPath", null)->toValue("microbe");
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'microbe.MicrobeInjector'; }
}
