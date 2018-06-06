<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx
 */

namespace minject;

use \haxe\ds\StringMap;
use \haxe\rtti\Meta;
use \php\_Boot\HxException;
use \php\Boot;
use \minject\point\MethodInjectionPoint;
use \php\_Boot\HxString;
use \haxe\ds\ArraySort;
use \minject\point\PropertyInjectionPoint;
use \minject\point\ConstructorInjectionPoint;
use \minject\point\PostInjectionPoint;

/**
 * The dependency injector
 */
class Injector {
	/**
	 * @var StringMap
	 */
	public $infos;
	/**
	 * @var StringMap
	 */
	public $mappings;
	/**
	 * @var Injector
	 * The parent of this injector
	 */
	public $parent;


	/**
	 * @param mixed $value
	 * 
	 * @return string
	 */
	static public function getValueType ($value) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:19: lines 19-20
		if (Boot::is($value, Boot::getClass('String'))) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:20: characters 4-19
			return "String";
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:21: lines 21-22
		if (Boot::is($value, Boot::getClass('Class'))) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:22: characters 4-35
			return \Type::getClassName($value);
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:23: lines 23-24
		if (Boot::is($value, Boot::getClass('Enum'))) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:24: characters 4-34
			return \Type::getEnumName($value);
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:25: lines 25-32
		$name = null;
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:25: characters 22-40
		$_g = \Type::typeof($value);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:25: characters 22-40
		switch ($_g->index) {
			case 1:
				#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:25: lines 25-32
				$name = "Int";
				break;
			case 3:
				#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:25: lines 25-32
				$name = "Bool";
				break;
			case 6:
				#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:29: characters 16-17
				$c = $_g->params[0];
				#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:25: lines 25-32
				$name = \Type::getClassName($c);
				break;
			case 7:
				#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:30: characters 15-16
				$e = $_g->params[0];
				#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:25: lines 25-32
				$name = \Type::getEnumName($e);
				break;
			default:
				#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:25: lines 25-32
				$name = null;
				break;
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:33: characters 3-32
		if ($name !== null) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:33: characters 21-32
			return $name;
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:34: characters 3-8
		throw new HxException("Could not determine type name of " . (\Std::string($value)??'null'));
	}


	/**
	 * @param Injector $parent
	 * 
	 * @return void
	 */
	public function __construct ($parent = null) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:46: characters 14-45
		$this->infos = new StringMap();
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:43: characters 17-60
		$this->mappings = new StringMap();
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:50: characters 3-23
		$this->parent = $parent;
	}


	/**
	 * @param Class $type
	 * 
	 * @return mixed
	 */
	public function _construct ($type) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:272: characters 3-28
		$info = $this->getInfo($type);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:273: characters 3-46
		return $info->ctor->createInstance($type, $this);
	}


	/**
	 * @param Class $type
	 * 
	 * @return mixed
	 */
	public function _instantiate ($type) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:301: characters 3-35
		$instance = $this->_construct($type);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:302: characters 3-23
		$this->injectInto($instance);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:303: characters 3-18
		return $instance;
	}


	/**
	 * @param Class $forClass
	 * @param InjectorInfo $info
	 * @param \Array_hx $injected
	 * 
	 * @return void
	 */
	public function addClassToInfo ($forClass, $info, $injected) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:371: characters 3-37
		$meta = Meta::getType($forClass);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:374: lines 374-375
		if (($meta !== null) && \Reflect::hasField($meta, "interface")) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:375: characters 4-9
			throw new HxException("Interfaces can't be used as instantiatable classes.");
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:378: characters 3-52
		$fields = Boot::dynamicField($meta, 'rtti');
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:380: lines 380-411
		if ($fields !== null) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:382: lines 382-410
			$_g = 0;
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:382: lines 382-410
			while ($_g < $fields->length) {
				#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:382: characters 9-14
				$field = ($fields->arr[$_g] ?? null);
				#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:382: lines 382-410
				$_g = $_g + 1;
				#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:384: characters 5-25
				$name = ($field->arr[0] ?? null);
				#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:386: characters 5-46
				if ($injected->indexOf($name) > -1) {
					#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:386: characters 38-46
					continue;
				}
				#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:387: characters 5-24
				$injected->arr[$injected->length] = $name;
				#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:387: characters 5-24
				++$injected->length;

				#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:389: lines 389-409
				if ($field->length === 3) {
					#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:391: characters 6-76
					$_this = $info->fields;
					#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:391: characters 6-76
					$x = new PropertyInjectionPoint($name, ($field->arr[1] ?? null), ($field->arr[2] ?? null));
					#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:391: characters 6-76
					$_this->arr[$_this->length] = $x;
					#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:391: characters 6-76
					++$_this->length;
				} else if ($name === "new") {
					#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:395: characters 6-63
					$info->ctor = new ConstructorInjectionPoint($field->slice(2));
				} else {
					#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:399: characters 6-30
					$orderStr = ($field->arr[1] ?? null);
					#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:400: lines 400-408
					if ($orderStr === "") {
						#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:402: characters 7-71
						$_this1 = $info->fields;
						#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:402: characters 7-71
						$x1 = new MethodInjectionPoint($name, $field->slice(2));
						#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:402: characters 7-71
						$_this1->arr[$_this1->length] = $x1;
						#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:402: characters 7-71
						++$_this1->length;
					} else {
						#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:406: characters 7-42
						$order = \Std::parseInt($orderStr);
						#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:407: characters 7-76
						$_this2 = $info->fields;
						#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:407: characters 7-76
						$x2 = new PostInjectionPoint($name, $field->slice(2), $order);
						#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:407: characters 7-76
						$_this2->arr[$_this2->length] = $x2;
						#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:407: characters 7-76
						++$_this2->length;

					}
				}
			}
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:413: characters 3-49
		$superClass = \Type::getSuperClass($forClass);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:414: characters 3-69
		if ($superClass !== null) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:414: characters 27-69
			$this->addClassToInfo($superClass, $info, $injected);
		}
	}


	/**
	 * Create an injector that inherits mappings from its parent
	 * @returns The injector
	 * 
	 * @return Injector
	 */
	public function createChildInjector () {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:334: characters 3-28
		return new Injector($this);
	}


	/**
	 * @param Class $forClass
	 * 
	 * @return InjectorInfo
	 */
	public function createInfo ($forClass) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:351: characters 3-41
		$info = new InjectorInfo(null, new \Array_hx());
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:352: characters 3-37
		$this->addClassToInfo($forClass, $info, new \Array_hx());
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:354: lines 354-364
		ArraySort::sort($info->fields, function ($p1, $p2) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:355: characters 4-52
			$post1 = (($p1 instanceof PostInjectionPoint) ? $p1 : null);
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:356: characters 4-52
			$post2 = (($p2 instanceof PostInjectionPoint) ? $p2 : null);
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:357: lines 357-363
			if ($post1 === null) {
				#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:359: lines 359-360
				if ($post2 === null) {
					#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:359: characters 23-24
					return 0;
				} else {
					#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:360: characters 20-22
					return -1;
				}
			} else if ($post2 === null) {
				#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:361: characters 20-21
				return 1;
			} else {
				#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:362: characters 14-39
				return $post1->order - $post2->order;
			}
		});
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:365: characters 3-71
		if ($info->ctor === null) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:365: characters 26-71
			$info->ctor = new ConstructorInjectionPoint(new \Array_hx());
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:366: characters 3-14
		return $info;
	}


	/**
	 * Determines if this injector or any of it's ancestors has a mapping with a provider for the
	 * provided `type` and `name`
	 * @param type The mapping type identifier
	 * @param name The optional name provided when the mapping was created
	 * @returns The mapping, if it exists, or `null`
	 * 
	 * @param string $type
	 * @param string $name
	 * 
	 * @return InjectorMapping
	 */
	public function findMappingForType ($type, $name) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:194: characters 17-56
		$this1 = $this->mappings;
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:194: characters 17-56
		$key = $this->getMappingKey($type, $name);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:194: characters 3-57
		$mapping = ($this1->data[$key] ?? null);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:195: lines 195-196
		if (($mapping !== null) && ($mapping->provider !== null)) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:196: characters 4-18
			return $mapping;
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:197: lines 197-198
		if ($this->parent !== null) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:198: characters 4-48
			return $this->parent->findMappingForType($type, $name);
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:199: characters 3-14
		return null;
	}


	/**
	 * @param Class $forClass
	 * 
	 * @return InjectorInfo
	 */
	public function getInfo ($forClass) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:341: characters 3-42
		$type = \Type::getClassName($forClass);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:342: lines 342-343
		if (array_key_exists($type, $this->infos->data)) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:343: characters 11-26
			return ($this->infos->data[$type] ?? null);
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:344: characters 3-35
		$info = $this->createInfo($forClass);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:345: characters 3-24
		$this->infos->data[$type] = $info;
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:346: characters 3-14
		return $info;
	}


	/**
	 * Create or retrieve an instance of the given class
	 * @param type The class to retrieve.
	 * @param name An optional name
	 * @return An instance
	 * 
	 * @param Class $type
	 * @param string $name
	 * 
	 * @return mixed
	 */
	public function getInstance ($type, $name = null) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:315: characters 3-38
		$type1 = \Type::getClassName($type);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:316: characters 3-48
		$mapping = $this->findMappingForType($type1, $name);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:318: lines 318-322
		if ($mapping === null) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:320: characters 4-9
			throw new HxException("Error while getting mapping response: No mapping defined for class \"" . ($type1??'null') . "\" " . (("name \"" . ($name??'null') . "\"")??'null'));
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:324: characters 3-32
		return $mapping->getValue($this);
	}


	/**
	 * @param string $type
	 * @param string $name
	 * 
	 * @return string
	 */
	public function getMappingKey ($type, $name) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:419: characters 3-30
		if ($name === null) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:419: characters 21-30
			$name = "";
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:420: characters 3-23
		return "" . ($type??'null') . "#" . ($name??'null');
	}


	/**
	 * Returns the injectors response for the provided `type` and `name`
	 * If a matching mapping is not found then `null` is returned.
	 * @param type The mapping type identifier
	 * @param name The optional name provided when the mapping was created
	 * @returns The injector response, if a mapping exists, or `null`
	 * 
	 * @param string $type
	 * @param string $name
	 * 
	 * @return mixed
	 */
	public function getValueForType ($type, $name = null) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:230: characters 3-48
		$mapping = $this->findMappingForType($type, $name);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:231: characters 3-53
		if ($mapping !== null) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:231: characters 24-53
			return $mapping->getValue($this);
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:234: characters 3-33
		$index = HxString::indexOf($type, "<");
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:235: characters 3-76
		if ($index > -1) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:235: characters 19-76
			$mapping = $this->findMappingForType(HxString::substr($type, 0, $index), $name);
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:236: characters 3-53
		if ($mapping !== null) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:236: characters 24-53
			return $mapping->getValue($this);
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:238: characters 3-14
		return null;
	}


	/**
	 * Determines if this injector has a mapping for the provided `type` and `name`
	 * @param type The mapping type identifier
	 * @param name The optional name provided when the mapping was created
	 * @returns Whether such a mapping exists
	 * 
	 * @param string $type
	 * @param string $name
	 * 
	 * @return bool
	 */
	public function hasMappingForType ($type, $name = null) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:181: characters 3-48
		return $this->findMappingForType($type, $name) !== null;
	}


	/**
	 * Perform an injection into `target`, satisfying all it's dependencies.
	 * @param target The object to inject into - the Injectee
	 * 
	 * @param mixed $target
	 * 
	 * @return void
	 */
	public function injectInto ($target) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:250: characters 3-45
		$info = $this->getInfo(\Type::getClass($target));
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:253: characters 3-27
		if ($info === null) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:253: characters 21-27
			return;
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:255: lines 255-256
		$_g = 0;
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:255: lines 255-256
		$_g1 = $info->fields;
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:255: lines 255-256
		while ($_g < $_g1->length) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:255: characters 8-13
			$field = ($_g1->arr[$_g] ?? null);
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:255: lines 255-256
			$_g = $_g + 1;
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:256: characters 4-38
			$field->applyInjection($target, $this);
		}

	}


	/**
	 * @param mixed $value
	 * @param string $name
	 * 
	 * @return InjectorMapping
	 */
	public function mapRuntimeTypeOf ($value, $name = null) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:97: characters 3-44
		return $this->mapType(Injector::getValueType($value), $name);
	}


	/**
	 * Returns an `InjectorMapping` for the type identifier `type` with optional `name`
	 * This method is called by `map`, but can also be used to explicitly map a type identifier
	 * where it is not possible to provide it, such as for types with type parameters.
	 * ```haxe
	 * var injector = new Injector();
	 * injector.mapType('Array<Int>', [0, 1, 2]);
	 * ```
	 * @param type The type identifier to map
	 * @param name The optional name for the mapping
	 * 
	 * @param string $type
	 * @param string $name
	 * @param mixed $value
	 * 
	 * @return InjectorMapping
	 */
	public function mapType ($type, $name = null, $value = null) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:122: characters 3-39
		$key = $this->getMappingKey($type, $name);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:123: lines 123-124
		if (array_key_exists($key, $this->mappings->data)) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:124: characters 4-33
			return ($this->mappings->data[$key] ?? null);
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:125: characters 3-49
		$mapping = new InjectorMapping($type, $name);
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:126: characters 3-29
		$this->mappings->data[$key] = $mapping;
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:127: characters 3-22
		return $mapping;
	}


	/**
	 * Remove a mapping from the injector
	 * @param type The type identifier to unmap
	 * @param name The optional name provided when the mapping was created
	 * 
	 * @param string $type
	 * @param string $name
	 * 
	 * @return void
	 */
	public function unmapType ($type, $name = null) {
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:151: characters 8-50
		$this1 = $this->mappings;
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:151: lines 151-152
		if (!array_key_exists($this->getMappingKey($type, $name), $this1->data)) {
			#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:152: characters 4-9
			throw new HxException("Error while removing an mapping: No mapping defined for type \"" . ($type??'null') . "\", name \"" . ($name??'null') . "\"");
		}
		#/usr/local/lib/haxe/lib/minject/git/src/lib/minject/Injector.hx:154: characters 3-45
		$this->mappings->remove($this->getMappingKey($type, $name));
	}
}


Boot::registerClass(Injector::class, 'minject.Injector');
