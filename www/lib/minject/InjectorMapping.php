<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx
 */

namespace minject;

use \minject\provider\ValueProvider;
use \php\Boot;
use \minject\provider\ClassProvider;
use \haxe\Log;
use \minject\provider\DependencyProvider;
use \minject\provider\OtherMappingProvider;
use \minject\provider\SingletonProvider;
use \php\_Boot\HxAnon;

class InjectorMapping {
	/**
	 * @var Injector
	 */
	public $injector;
	/**
	 * @var string
	 */
	public $name;
	/**
	 * @var DependencyProvider
	 */
	public $provider;
	/**
	 * @var string
	 */
	public $type;


	/**
	 * @param string $type
	 * @param string $name
	 * 
	 * @return void
	 */
	public function __construct ($type, $name) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:19: characters 3-19
		$this->type = $type;
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:20: characters 3-19
		$this->name = $name;
	}


	/**
	 * @param Class $type
	 * 
	 * @return InjectorMapping
	 */
	public function _toClass ($type) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:53: characters 3-48
		return $this->toProvider(new ClassProvider($type));
	}


	/**
	 * @param Class $type
	 * 
	 * @return InjectorMapping
	 */
	public function _toSingleton ($type) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:66: characters 3-52
		return $this->toProvider(new SingletonProvider($type));
	}


	/**
	 * @return InjectorMapping
	 */
	public function asSingleton () {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:71: characters 3-52
		return $this->_toSingleton(\Type::resolveClass($this->type));
	}


	/**
	 * @param Injector $injector
	 * 
	 * @return mixed
	 */
	public function getValue ($injector) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:25: lines 25-26
		if ($this->injector !== null) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:26: characters 4-28
			$injector = $this->injector;
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:28: lines 28-29
		if ($this->provider !== null) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:29: characters 4-38
			return $this->provider->getValue($injector);
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:31: characters 3-56
		$parent = $injector->findMappingForType($this->type, $this->name);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:32: lines 32-33
		if ($parent !== null) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:33: characters 4-36
			return $parent->getValue($injector);
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:35: characters 3-14
		return null;
	}


	/**
	 * @param InjectorMapping $mapping
	 * 
	 * @return InjectorMapping
	 */
	public function toMapping ($mapping) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:76: characters 3-55
		return $this->toProvider(new OtherMappingProvider($mapping));
	}


	/**
	 * @param DependencyProvider $provider
	 * 
	 * @return InjectorMapping
	 */
	public function toProvider ($provider) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:82: lines 82-88
		if (($this->provider !== null) && ($provider !== null)) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:84: characters 4-9
			(Log::$trace)("Warning: Injector contains " . ($this->toString()??'null') . ".\x0AAttempting to overwrite this " . (("with mapping for " . ($provider->toString()??'null') . ".\x0AIf you have overwritten this mapping ")??'null') . "intentionally you can use `injector.unmap()` prior to your replacement mapping " . "in order to avoid seeing this message.", new HxAnon([
				"fileName" => "minject/InjectorMapping.hx",
				"lineNumber" => 84,
				"className" => "minject.InjectorMapping",
				"methodName" => "toProvider",
			]));
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:90: characters 3-27
		$this->provider = $provider;
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:91: characters 3-14
		return $this;
	}


	/**
	 * @return string
	 */
	public function toString () {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:97: characters 3-70
		$named = (($this->name !== null) && ($this->name !== "") ? " named \"" . ($this->name??'null') . "\" and" : "");
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:98: characters 3-56
		return "mapping: [" . ($this->type??'null') . "]" . ($named??'null') . " mapped to [" . (\Std::string($this->provider)??'null') . "]";
	}


	/**
	 * @param mixed $value
	 * 
	 * @return InjectorMapping
	 */
	public function toValue ($value) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/InjectorMapping.hx:40: characters 3-46
		return $this->toProvider(new ValueProvider($value));
	}


	public function __toString() {
		return $this->toString();
	}
}


Boot::registerClass(InjectorMapping::class, 'minject.InjectorMapping');
