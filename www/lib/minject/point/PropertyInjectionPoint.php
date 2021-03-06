<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/minject/git/src/lib/minject/point/PropertyInjectionPoint.hx
 */

namespace minject\point;

use \php\Boot;
use \php\_Boot\HxException;
use \minject\Injector;

class PropertyInjectionPoint implements InjectionPoint {
	/**
	 * @var string
	 */
	public $field;
	/**
	 * @var string
	 */
	public $name;
	/**
	 * @var string
	 */
	public $type;


	/**
	 * @param string $field
	 * @param string $type
	 * @param string $name
	 * 
	 * @return void
	 */
	public function __construct ($field, $type, $name = null) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/point/PropertyInjectionPoint.hx:15: characters 3-21
		$this->field = $field;
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/point/PropertyInjectionPoint.hx:16: characters 3-19
		$this->type = $type;
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/point/PropertyInjectionPoint.hx:17: characters 3-19
		$this->name = $name;
	}


	/**
	 * @param mixed $target
	 * @param Injector $injector
	 * 
	 * @return mixed
	 */
	public function applyInjection ($target, $injector) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/point/PropertyInjectionPoint.hx:22: characters 3-55
		$response = $injector->getValueForType($this->type, $this->name);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/point/PropertyInjectionPoint.hx:25: lines 25-30
		if ($response === null) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/point/PropertyInjectionPoint.hx:27: characters 4-62
			$targetName = \Type::getClassName(\Type::getClass($target));
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/point/PropertyInjectionPoint.hx:28: characters 4-9
			throw new HxException("Injector is missing a mapping to handle injection into property \"" . ($this->field??'null') . "\" of " . (("object \"" . ($targetName??'null') . "\". Target dependency: \"" . ($this->type??'null') . "\", named \"" . ($this->name??'null') . "\"")??'null'));
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/point/PropertyInjectionPoint.hx:33: characters 3-47
		\Reflect::setProperty($target, $this->field, $response);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/point/PropertyInjectionPoint.hx:34: characters 3-16
		return $target;
	}
}


Boot::registerClass(PropertyInjectionPoint::class, 'minject.point.PropertyInjectionPoint');
