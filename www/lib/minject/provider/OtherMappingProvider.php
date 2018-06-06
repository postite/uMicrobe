<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/minject/git/src/lib/minject/provider/OtherMappingProvider.hx
 */

namespace minject\provider;

use \php\Boot;
use \minject\InjectorMapping;
use \minject\Injector;

class OtherMappingProvider implements DependencyProvider {
	/**
	 * @var InjectorMapping
	 */
	public $mapping;


	/**
	 * @param InjectorMapping $mapping
	 * 
	 * @return void
	 */
	public function __construct ($mapping) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/provider/OtherMappingProvider.hx:14: characters 3-25
		$this->mapping = $mapping;
	}


	/**
	 * @param Injector $injector
	 * 
	 * @return mixed
	 */
	public function getValue ($injector) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/provider/OtherMappingProvider.hx:19: characters 3-36
		return $this->mapping->getValue($injector);
	}


	/**
	 * @return string
	 */
	public function toString () {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/provider/OtherMappingProvider.hx:25: characters 3-28
		return $this->mapping->toString();
	}


	public function __toString() {
		return $this->toString();
	}
}


Boot::registerClass(OtherMappingProvider::class, 'minject.provider.OtherMappingProvider');