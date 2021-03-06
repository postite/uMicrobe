<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: src/microbe/MicrobeInjector.hx
 */

namespace microbe;

use \php\Boot;
use \minject\Injector;

class MicrobeInjector {
	/**
	 * @param Injector $injector
	 * 
	 * @return void
	 */
	static public function inject ($injector) {
		#src/microbe/MicrobeInjector.hx:7: characters 3-42
		FormGenerator::$injector = $injector;
		#src/microbe/MicrobeInjector.hx:8: characters 3-49
		$injector->mapType("String", "upsPath", null)->toValue("/ups");
		#src/microbe/MicrobeInjector.hx:9: characters 9-60
		$injector->mapType("String", "assetPath", null)->toValue("/assets");
		#src/microbe/MicrobeInjector.hx:10: characters 9-58
		$injector->mapType("String", "micPath", null)->toValue("microbe");
	}
}


Boot::registerClass(MicrobeInjector::class, 'microbe.MicrobeInjector');
