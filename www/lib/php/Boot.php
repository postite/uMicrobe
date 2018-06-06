<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/php/Boot.hx
 */

namespace php;

use \php\_Boot\HxClosure;
use \php\_Boot\HxException;
use \php\_Boot\HxDynamicStr;
use \php\_Boot\HxString;
use \php\_Boot\HxClass;
use \php\_Boot\HxEnum;
use \php\_Boot\HxAnon;

/**
 * Various Haxe->PHP compatibility utilities.
 * You should not use this class directly.
 */
class Boot {
	const PHP_PREFIX = "";


	/**
	 * @var mixed
	 * List of Haxe classes registered by their PHP class names
	 */
	static protected $aliases;
	/**
	 * @var mixed
	 * Cache of HxClass instances
	 */
	static protected $classes;
	/**
	 * @var mixed
	 * List of getters (for Reflect)
	 */
	static protected $getters;
	/**
	 * @var mixed
	 * Metadata storage
	 */
	static protected $meta;
	/**
	 * @var mixed
	 * List of setters (for Reflect)
	 */
	static protected $setters;


	/**
	 * Concat `left` and `right` if both are strings or string and null.
	 * Otherwise return sum of `left` and `right`.
	 * 
	 * @param mixed $left
	 * @param mixed $right
	 * 
	 * @return mixed
	 */
	static public function addOrConcat ($left, $right) {
		#/usr/local/lib/haxe/std/php/Boot.hx:397: lines 397-399
		if (is_string($left) || is_string($right)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:398: characters 4-41
			return ($left??'null') . ($right??'null');
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:400: characters 3-33
		return ($left + $right);
	}


	/**
	 * Unsafe cast to HxClass
	 * 
	 * @param Class $cls
	 * 
	 * @return HxClass
	 */
	static public function castClass ($cls) {
		#/usr/local/lib/haxe/std/php/Boot.hx:278: characters 3-18
		return $cls;
	}


	/**
	 * Unsafe cast to HxClosure
	 * 
	 * @param mixed $value
	 * 
	 * @return HxClosure
	 */
	static public function castClosure ($value) {
		#/usr/local/lib/haxe/std/php/Boot.hx:271: characters 3-15
		return $value;
	}


	/**
	 * Creates Haxe-compatible closure.
	 * @param type `this` for instance methods; full php class name for static methods
	 * @param func Method name
	 * 
	 * @param mixed $target
	 * @param mixed $func
	 * 
	 * @return HxClosure
	 */
	static public function closure ($target, $func) {
		#/usr/local/lib/haxe/std/php/Boot.hx:264: characters 3-37
		return new HxClosure($target, $func);
	}


	/**
	 * Returns `Class<T>` for `HxClosure`
	 * 
	 * @return HxClass
	 */
	static public function closureHxClass () {
		#/usr/local/lib/haxe/std/php/Boot.hx:285: characters 3-24
		return Boot::getClass(HxClosure::class);
	}


	/**
	 * Create Haxe-compatible anonymous structure of `data` associative array
	 * 
	 * @param mixed $data
	 * 
	 * @return mixed
	 */
	static public function createAnon ($data) {
		#/usr/local/lib/haxe/std/php/Boot.hx:502: characters 3-26
		return new HxAnon($data);
	}


	/**
	 * Helper method to avoid "Cannot use temporary expression in write context" error for expressions like this:
	 * ```
	 * (new MyClass()).fieldName = 'value';
	 * ```
	 * 
	 * @param mixed $value
	 * 
	 * @return mixed
	 */
	static public function deref ($value) {
		#/usr/local/lib/haxe/std/php/Boot.hx:495: characters 3-15
		return $value;
	}


	/**
	 * Get `field` of a dynamic `value` in a safe manner (avoid exceptions on trying to get a method)
	 * 
	 * @param mixed $value
	 * @param string $field
	 * 
	 * @return mixed
	 */
	static public function dynamicField ($value, $field) {
		#/usr/local/lib/haxe/std/php/Boot.hx:516: lines 516-518
		if (method_exists($value, $field)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:517: characters 4-32
			return new HxClosure($value, $field);
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:519: lines 519-521
		if (is_string($value)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:520: characters 4-51
			$value = new HxDynamicStr($value);
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:522: characters 23-28
		$tmp = $value;
		#/usr/local/lib/haxe/std/php/Boot.hx:522: characters 30-35
		$tmp1 = $field;
		#/usr/local/lib/haxe/std/php/Boot.hx:522: characters 3-36
		return $tmp->{$tmp1};
	}


	/**
	 * @param string $str
	 * 
	 * @return HxDynamicStr
	 */
	static public function dynamicString ($str) {
		#/usr/local/lib/haxe/std/php/Boot.hx:526: characters 3-47
		return new HxDynamicStr($str);
	}


	/**
	 * Make sure specified class is loaded
	 * 
	 * @param string $phpClassName
	 * 
	 * @return bool
	 */
	static public function ensureLoaded ($phpClassName) {
		#/usr/local/lib/haxe/std/php/Boot.hx:509: characters 10-84
		if (!class_exists($phpClassName)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:509: characters 47-84
			return interface_exists($phpClassName);
		} else {
			#/usr/local/lib/haxe/std/php/Boot.hx:509: characters 10-84
			return true;
		}
	}


	/**
	 * Check if specified values are equal
	 * 
	 * @param mixed $left
	 * @param mixed $right
	 * 
	 * @return bool
	 */
	static public function equal ($left, $right) {
		#/usr/local/lib/haxe/std/php/Boot.hx:383: lines 383-385
		if ((is_int($left) || is_float($left)) && (is_int($right) || is_float($right))) {
			#/usr/local/lib/haxe/std/php/Boot.hx:384: characters 4-36
			return ($left == $right);
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:386: lines 386-388
		if (($left instanceof HxClosure) && ($right instanceof HxClosure)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:387: characters 4-41
			return $left->equals($right);
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:389: characters 3-41
		return ($left === $right);
	}


	/**
	 * Get Class<T> instance for PHP fully qualified class name (E.g. '\some\pack\MyClass')
	 * It's always the same instance for the same `phpClassName`
	 * 
	 * @param string $phpClassName
	 * 
	 * @return HxClass
	 */
	static public function getClass ($phpClassName) {
		#/usr/local/lib/haxe/std/php/Boot.hx:168: lines 168-170
		if (((0 >= strlen($phpClassName) ? "" : $phpClassName[0])) === "\\") {
			#/usr/local/lib/haxe/std/php/Boot.hx:169: characters 4-41
			$phpClassName = HxString::substr($phpClassName, 1);
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:171: lines 171-173
		if (!isset(Boot::$classes[$phpClassName])) {
			#/usr/local/lib/haxe/std/php/Boot.hx:172: characters 4-53
			Boot::$classes[$phpClassName] = new HxClass($phpClassName);
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:175: characters 3-31
		return Boot::$classes[$phpClassName];
	}


	/**
	 * Returns either Haxe class name for specified `phpClassName` or (if no such Haxe class registered) `phpClassName`.
	 * 
	 * @param string $phpClassName
	 * 
	 * @return string
	 */
	static public function getClassName ($phpClassName) {
		#/usr/local/lib/haxe/std/php/Boot.hx:196: characters 3-40
		$hxClass = Boot::getClass($phpClassName);
		#/usr/local/lib/haxe/std/php/Boot.hx:197: characters 3-35
		$name = Boot::getHaxeName($hxClass);
		#/usr/local/lib/haxe/std/php/Boot.hx:198: characters 10-54
		if ($name === null) {
			#/usr/local/lib/haxe/std/php/Boot.hx:198: characters 26-46
			return $hxClass->phpClassName;
		} else {
			#/usr/local/lib/haxe/std/php/Boot.hx:198: characters 49-53
			return $name;
		}
	}


	/**
	 * Returns original Haxe fully qualified class name for this type (if exists)
	 * 
	 * @param HxClass $hxClass
	 * 
	 * @return string
	 */
	static public function getHaxeName ($hxClass) {
		#/usr/local/lib/haxe/std/php/Boot.hx:205: characters 11-31
		$_g = $hxClass->phpClassName;
		#/usr/local/lib/haxe/std/php/Boot.hx:205: characters 11-31
		switch ($_g) {
			case "Bool":
				#/usr/local/lib/haxe/std/php/Boot.hx:208: characters 17-30
				return "Bool";
				break;
			case "Class":
				#/usr/local/lib/haxe/std/php/Boot.hx:210: characters 18-32
				return "Class";
				break;
			case "Dynamic":
				#/usr/local/lib/haxe/std/php/Boot.hx:212: characters 20-36
				return "Dynamic";
				break;
			case "Enum":
				#/usr/local/lib/haxe/std/php/Boot.hx:211: characters 17-30
				return "Enum";
				break;
			case "Float":
				#/usr/local/lib/haxe/std/php/Boot.hx:209: characters 18-32
				return "Float";
				break;
			case "Int":
				#/usr/local/lib/haxe/std/php/Boot.hx:206: characters 16-28
				return "Int";
				break;
			case "String":
				#/usr/local/lib/haxe/std/php/Boot.hx:207: characters 19-34
				return "String";
				break;
			default:
								break;
		}

		#/usr/local/lib/haxe/std/php/Boot.hx:218: lines 218-224
		if (isset(Boot::$aliases[$hxClass->phpClassName])) {
			#/usr/local/lib/haxe/std/php/Boot.hx:219: characters 4-40
			return Boot::$aliases[$hxClass->phpClassName];
		} else if (class_exists($hxClass->phpClassName) && isset(Boot::$aliases[$hxClass->phpClassName])) {
			#/usr/local/lib/haxe/std/php/Boot.hx:221: characters 4-40
			return Boot::$aliases[$hxClass->phpClassName];
		} else if (interface_exists($hxClass->phpClassName) && isset(Boot::$aliases[$hxClass->phpClassName])) {
			#/usr/local/lib/haxe/std/php/Boot.hx:223: characters 4-40
			return Boot::$aliases[$hxClass->phpClassName];
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:226: characters 3-14
		return null;
	}


	/**
	 * Returns Class<HxAnon>
	 * 
	 * @return HxClass
	 */
	static public function getHxAnon () {
		#/usr/local/lib/haxe/std/php/Boot.hx:182: characters 3-21
		return Boot::getClass(HxAnon::class);
	}


	/**
	 * Returns Class<HxClass>
	 * 
	 * @return HxClass
	 */
	static public function getHxClass () {
		#/usr/local/lib/haxe/std/php/Boot.hx:189: characters 3-22
		return Boot::getClass(HxClass::class);
	}


	/**
	 * Retrieve metadata for specified class
	 * 
	 * @param string $phpClassName
	 * 
	 * @return mixed
	 */
	static public function getMeta ($phpClassName) {
		#/usr/local/lib/haxe/std/php/Boot.hx:134: characters 3-29
		if (!class_exists($phpClassName)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:134: characters 3-29
			interface_exists($phpClassName);
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:135: characters 10-70
		if (isset(Boot::$meta[$phpClassName])) {
			#/usr/local/lib/haxe/std/php/Boot.hx:135: characters 45-63
			return Boot::$meta[$phpClassName];
		} else {
			#/usr/local/lib/haxe/std/php/Boot.hx:135: characters 66-70
			return null;
		}
	}


	/**
	 * Find corresponding PHP class name.
	 * Returns `null` if specified class does not exist.
	 * 
	 * @param string $haxeName
	 * 
	 * @return string
	 */
	static public function getPhpName ($haxeName) {
		#/usr/local/lib/haxe/std/php/Boot.hx:234: characters 3-28
		$prefix = Boot::getPrefix();
		#/usr/local/lib/haxe/std/php/Boot.hx:235: characters 3-55
		$phpParts = (strlen($prefix) === 0 ? new \Array_hx() : \Array_hx::wrap([$prefix]));
		#/usr/local/lib/haxe/std/php/Boot.hx:237: characters 3-39
		$haxeParts = \Array_hx::wrap(explode(".", $haxeName));
		#/usr/local/lib/haxe/std/php/Boot.hx:238: lines 238-253
		$_g = 0;
		#/usr/local/lib/haxe/std/php/Boot.hx:238: lines 238-253
		while ($_g < $haxeParts->length) {
			#/usr/local/lib/haxe/std/php/Boot.hx:238: characters 8-12
			$part = ($haxeParts->arr[$_g] ?? null);
			#/usr/local/lib/haxe/std/php/Boot.hx:238: lines 238-253
			$_g = $_g + 1;
			#/usr/local/lib/haxe/std/php/Boot.hx:239: characters 12-30
			$_g1 = strtolower($part);
			#/usr/local/lib/haxe/std/php/Boot.hx:239: characters 12-30
			switch ($_g1) {
				case "__class__":
				case "__dir__":
				case "__file__":
				case "__function__":
				case "__halt_compiler":
				case "__line__":
				case "__method__":
				case "__namespace__":
				case "__trait__":
				case "abstract":
				case "and":
				case "array":
				case "as":
				case "bool":
				case "break":
				case "callable":
				case "case":
				case "catch":
				case "class":
				case "clone":
				case "const":
				case "continue":
				case "declare":
				case "default":
				case "die":
				case "do":
				case "echo":
				case "else":
				case "elseif":
				case "empty":
				case "enddeclare":
				case "endfor":
				case "endforeach":
				case "endif":
				case "endswitch":
				case "endwhile":
				case "eval":
				case "exit":
				case "extends":
				case "false":
				case "final":
				case "finally":
				case "float":
				case "for":
				case "foreach":
				case "function":
				case "global":
				case "goto":
				case "if":
				case "implements":
				case "include":
				case "include_once":
				case "instanceof":
				case "insteadof":
				case "int":
				case "interface":
				case "isset":
				case "iterable":
				case "list":
				case "namespace":
				case "new":
				case "null":
				case "object":
				case "or":
				case "parent":
				case "print":
				case "private":
				case "protected":
				case "public":
				case "require":
				case "require_once":
				case "return":
				case "static":
				case "string":
				case "switch":
				case "throw":
				case "trait":
				case "true":
				case "try":
				case "unset":
				case "use":
				case "var":
				case "void":
				case "while":
				case "xor":
				case "yield":
					#/usr/local/lib/haxe/std/php/Boot.hx:249: characters 7-20
					$part = ($part??'null') . "_hx";
					break;
				default:
										break;
			}

			#/usr/local/lib/haxe/std/php/Boot.hx:252: characters 4-23
			$phpParts->arr[$phpParts->length] = $part;
			#/usr/local/lib/haxe/std/php/Boot.hx:252: characters 4-23
			++$phpParts->length;

		}

		#/usr/local/lib/haxe/std/php/Boot.hx:255: characters 3-29
		return $phpParts->join("\\");
	}


	/**
	 * Returns root namespace based on a value of `-D php-prefix=value` compiler flag.
	 * Returns empty string if no `-D php-prefix=value` provided.
	 * 
	 * @return string
	 */
	static public function getPrefix () {
		#/usr/local/lib/haxe/std/php/Boot.hx:74: characters 3-41
		return self::PHP_PREFIX;
	}


	/**
	 * Returns a list of phpName=>haxeName for currently loaded haxe-generated classes.
	 * 
	 * @return mixed
	 */
	static public function getRegisteredAliases () {
		#/usr/local/lib/haxe/std/php/Boot.hx:160: characters 3-17
		return Boot::$aliases;
	}


	/**
	 * Returns a list of currently loaded haxe-generated classes.
	 * 
	 * @return \Array_hx
	 */
	static public function getRegisteredClasses () {
		#/usr/local/lib/haxe/std/php/Boot.hx:149: characters 3-19
		$result = new \Array_hx();
		#/usr/local/lib/haxe/std/php/Boot.hx:150: lines 150-152
		foreach ((Boot::$aliases) as $phpName => $haxeName) {
			#/usr/local/lib/haxe/std/php/Boot.hx:151: characters 4-39
			$x = Boot::getClass($phpName);
			#/usr/local/lib/haxe/std/php/Boot.hx:151: characters 4-39
			$result->arr[$result->length] = $x;
			#/usr/local/lib/haxe/std/php/Boot.hx:151: characters 4-39
			++$result->length;
		};
		#/usr/local/lib/haxe/std/php/Boot.hx:153: characters 3-16
		return $result;
	}


	/**
	 * Check if specified property has getter
	 * 
	 * @param string $phpClassName
	 * @param string $property
	 * 
	 * @return bool
	 */
	static public function hasGetter ($phpClassName, $property) {
		#/usr/local/lib/haxe/std/php/Boot.hx:95: characters 3-29
		if (!class_exists($phpClassName)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:95: characters 3-29
			interface_exists($phpClassName);
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:97: characters 3-19
		$has = false;
		#/usr/local/lib/haxe/std/php/Boot.hx:98: characters 3-71
		$phpClassName1 = $phpClassName;
		#/usr/local/lib/haxe/std/php/Boot.hx:99: lines 99-102
		while (true) {
			#/usr/local/lib/haxe/std/php/Boot.hx:100: characters 4-55
			$has = isset(Boot::$getters[$phpClassName1][$property]);
			#/usr/local/lib/haxe/std/php/Boot.hx:101: characters 4-56
			$phpClassName1 = get_parent_class($phpClassName1);
			#/usr/local/lib/haxe/std/php/Boot.hx:99: lines 99-102
			if (!(!$has && ($phpClassName1 !== false) && class_exists($phpClassName1))) {
				#/usr/local/lib/haxe/std/php/Boot.hx:99: lines 99-102
				break;
			}
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:104: characters 3-13
		return $has;
	}


	/**
	 * Check if specified property has setter
	 * 
	 * @param string $phpClassName
	 * @param string $property
	 * 
	 * @return bool
	 */
	static public function hasSetter ($phpClassName, $property) {
		#/usr/local/lib/haxe/std/php/Boot.hx:111: characters 3-29
		if (!class_exists($phpClassName)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:111: characters 3-29
			interface_exists($phpClassName);
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:113: characters 3-19
		$has = false;
		#/usr/local/lib/haxe/std/php/Boot.hx:114: characters 3-71
		$phpClassName1 = $phpClassName;
		#/usr/local/lib/haxe/std/php/Boot.hx:115: lines 115-118
		while (true) {
			#/usr/local/lib/haxe/std/php/Boot.hx:116: characters 4-55
			$has = isset(Boot::$setters[$phpClassName1][$property]);
			#/usr/local/lib/haxe/std/php/Boot.hx:117: characters 4-56
			$phpClassName1 = get_parent_class($phpClassName1);
			#/usr/local/lib/haxe/std/php/Boot.hx:115: lines 115-118
			if (!(!$has && ($phpClassName1 !== false) && class_exists($phpClassName1))) {
				#/usr/local/lib/haxe/std/php/Boot.hx:115: lines 115-118
				break;
			}
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:120: characters 3-13
		return $has;
	}


	/**
	 * `Std.is()` implementation
	 * 
	 * @param mixed $value
	 * @param HxClass $type
	 * 
	 * @return bool
	 */
	static public function is ($value, $type) {
		#/usr/local/lib/haxe/std/php/Boot.hx:407: characters 3-33
		if ($type === null) {
			#/usr/local/lib/haxe/std/php/Boot.hx:407: characters 21-33
			return false;
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:409: characters 3-35
		$phpType = $type->phpClassName;
		#/usr/local/lib/haxe/std/php/Boot.hx:410: lines 410-443
		switch ($phpType) {
			case "Bool":
				#/usr/local/lib/haxe/std/php/Boot.hx:426: characters 5-27
				return is_bool($value);
				break;
			case "Dynamic":
				#/usr/local/lib/haxe/std/php/Boot.hx:412: characters 5-16
				return true;
				break;
			case "Class":
			case "Enum":
				#/usr/local/lib/haxe/std/php/Boot.hx:432: lines 432-437
				if (($value instanceof HxClass)) {
					#/usr/local/lib/haxe/std/php/Boot.hx:433: characters 6-60
					$valuePhpClass = $value->phpClassName;
					#/usr/local/lib/haxe/std/php/Boot.hx:434: characters 6-60
					$enumPhpClass = Boot::getClass(HxEnum::class)->phpClassName;
					#/usr/local/lib/haxe/std/php/Boot.hx:435: characters 6-74
					$isEnumType = is_subclass_of($valuePhpClass, $enumPhpClass);
					#/usr/local/lib/haxe/std/php/Boot.hx:436: characters 13-59
					if ($phpType === "Enum") {
						#/usr/local/lib/haxe/std/php/Boot.hx:436: characters 34-44
						return $isEnumType;
					} else {
						#/usr/local/lib/haxe/std/php/Boot.hx:436: characters 47-58
						return !$isEnumType;
					}
				}
				break;
			case "Float":
				#/usr/local/lib/haxe/std/php/Boot.hx:424: characters 12-46
				if (!is_float($value)) {
					#/usr/local/lib/haxe/std/php/Boot.hx:424: characters 32-46
					return is_int($value);
				} else {
					#/usr/local/lib/haxe/std/php/Boot.hx:424: characters 12-46
					return true;
				}
				break;
			case "Int":
				#/usr/local/lib/haxe/std/php/Boot.hx:414: lines 414-422
				if (is_int($value) || (is_float($value) && ((int)($value) == $value) && !is_nan($value))) {
					#/usr/local/lib/haxe/std/php/Boot.hx:422: characters 9-40
					return abs($value) <= 2147483648;
				} else {
					#/usr/local/lib/haxe/std/php/Boot.hx:414: lines 414-422
					return false;
				}
				break;
			case "String":
				#/usr/local/lib/haxe/std/php/Boot.hx:428: characters 5-29
				return is_string($value);
				break;
			case "php\\NativeArray":
			case "php\\_NativeArray\\NativeArray_Impl_":
				#/usr/local/lib/haxe/std/php/Boot.hx:430: characters 5-28
				return is_array($value);
				break;
			default:
				#/usr/local/lib/haxe/std/php/Boot.hx:439: lines 439-442
				if (is_object($value)) {
					#/usr/local/lib/haxe/std/php/Boot.hx:440: characters 6-42
					$type1 = $type;
					#/usr/local/lib/haxe/std/php/Boot.hx:441: characters 31-36
					$tmp = $value;
					#/usr/local/lib/haxe/std/php/Boot.hx:441: characters 38-42
					$tmp1 = $type1;
					#/usr/local/lib/haxe/std/php/Boot.hx:441: characters 6-43
					return ($tmp instanceof $tmp1->phpClassName);
				}
				break;
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:444: characters 3-15
		return false;
	}


	/**
	 * Check if `value` is a `Class<T>`
	 * 
	 * @param mixed $value
	 * 
	 * @return bool
	 */
	static public function isClass ($value) {
		#/usr/local/lib/haxe/std/php/Boot.hx:451: characters 3-32
		return ($value instanceof HxClass);
	}


	/**
	 * Check if `value` is an enum constructor instance
	 * 
	 * @param mixed $value
	 * 
	 * @return bool
	 */
	static public function isEnumValue ($value) {
		#/usr/local/lib/haxe/std/php/Boot.hx:458: characters 3-31
		return ($value instanceof HxEnum);
	}


	/**
	 * Check if `value` is a function
	 * 
	 * @param mixed $value
	 * 
	 * @return bool
	 */
	static public function isFunction ($value) {
		#/usr/local/lib/haxe/std/php/Boot.hx:465: characters 10-60
		if (!($value instanceof \Closure)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:465: characters 36-60
			return ($value instanceof HxClosure);
		} else {
			#/usr/local/lib/haxe/std/php/Boot.hx:465: characters 10-60
			return true;
		}
	}


	/**
	 * Check if `value` is an instance of `HxClosure`
	 * 
	 * @param mixed $value
	 * 
	 * @return bool
	 */
	static public function isHxClosure ($value) {
		#/usr/local/lib/haxe/std/php/Boot.hx:472: characters 3-34
		return ($value instanceof HxClosure);
	}


	/**
	 * @param mixed $value
	 * 
	 * @return bool
	 */
	static public function isNumber ($value) {
		#/usr/local/lib/haxe/std/php/Boot.hx:376: characters 10-44
		if (!is_int($value)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:376: characters 28-44
			return is_float($value);
		} else {
			#/usr/local/lib/haxe/std/php/Boot.hx:376: characters 10-44
			return true;
		}
	}


	/**
	 * Associate PHP class name with Haxe class name
	 * 
	 * @param string $phpClassName
	 * @param string $haxeClassName
	 * 
	 * @return void
	 */
	static public function registerClass ($phpClassName, $haxeClassName) {
		#/usr/local/lib/haxe/std/php/Boot.hx:142: characters 3-40
		Boot::$aliases[$phpClassName] = $haxeClassName;
	}


	/**
	 * Register list of getters to be able to call getters using reflection
	 * 
	 * @param string $phpClassName
	 * @param mixed $list
	 * 
	 * @return void
	 */
	static public function registerGetters ($phpClassName, $list) {
		#/usr/local/lib/haxe/std/php/Boot.hx:81: characters 3-31
		Boot::$getters[$phpClassName] = $list;
	}


	/**
	 * Save metadata for specified class
	 * 
	 * @param string $phpClassName
	 * @param mixed $data
	 * 
	 * @return void
	 */
	static public function registerMeta ($phpClassName, $data) {
		#/usr/local/lib/haxe/std/php/Boot.hx:127: characters 3-28
		Boot::$meta[$phpClassName] = $data;
	}


	/**
	 * Register list of setters to be able to call getters using reflection
	 * 
	 * @param string $phpClassName
	 * @param mixed $list
	 * 
	 * @return void
	 */
	static public function registerSetters ($phpClassName, $list) {
		#/usr/local/lib/haxe/std/php/Boot.hx:88: characters 3-31
		Boot::$setters[$phpClassName] = $list;
	}


	/**
	 * Performs `left >>> right` operation
	 * 
	 * @param int $left
	 * @param int $right
	 * 
	 * @return int
	 */
	static public function shiftRightUnsigned ($left, $right) {
		#/usr/local/lib/haxe/std/php/Boot.hx:479: lines 479-485
		if ($right === 0) {
			#/usr/local/lib/haxe/std/php/Boot.hx:480: characters 4-15
			return $left;
		} else if ($left >= 0) {
			#/usr/local/lib/haxe/std/php/Boot.hx:482: characters 4-26
			return $left >> $right;
		} else {
			#/usr/local/lib/haxe/std/php/Boot.hx:484: characters 4-56
			return ($left >> $right) & (2147483647 >> ($right - 1));
		}
	}


	/**
	 * Returns string representation of `value`
	 * 
	 * @param mixed $value
	 * 
	 * @return string
	 */
	static public function stringify ($value) {
		#/usr/local/lib/haxe/std/php/Boot.hx:326: lines 326-328
		if ($value === null) {
			#/usr/local/lib/haxe/std/php/Boot.hx:327: characters 4-17
			return "null";
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:329: lines 329-331
		if (is_string($value)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:330: characters 4-16
			return $value;
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:332: lines 332-334
		if (is_int($value) || is_float($value)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:333: characters 4-31
			return (string)($value);
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:335: lines 335-337
		if (is_bool($value)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:336: characters 11-35
			if ($value) {
				#/usr/local/lib/haxe/std/php/Boot.hx:336: characters 20-24
				return "true";
			} else {
				#/usr/local/lib/haxe/std/php/Boot.hx:336: characters 29-34
				return "false";
			}
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:338: lines 338-344
		if (is_array($value)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:339: characters 4-37
			$strings = [];
			#/usr/local/lib/haxe/std/php/Boot.hx:340: lines 340-342
			foreach ($value as $key => $item) {
				#/usr/local/lib/haxe/std/php/Boot.hx:341: characters 32-71
				$tmp = ($key??'null') . " => " . (Boot::stringify($item)??'null');
				#/usr/local/lib/haxe/std/php/Boot.hx:341: characters 5-72
				array_push($strings, $tmp);
			};
			#/usr/local/lib/haxe/std/php/Boot.hx:343: characters 4-52
			return "[" . (implode(", ", $strings)??'null') . "]";
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:345: lines 345-371
		if (is_object($value)) {
			#/usr/local/lib/haxe/std/php/Boot.hx:346: lines 346-348
			if (method_exists($value, "toString")) {
				#/usr/local/lib/haxe/std/php/Boot.hx:347: characters 5-28
				return HxDynamicStr::wrap($value)->toString();
			}
			#/usr/local/lib/haxe/std/php/Boot.hx:349: lines 349-351
			if (method_exists($value, "__toString")) {
				#/usr/local/lib/haxe/std/php/Boot.hx:350: characters 5-30
				return $value->__toString();
			}
			#/usr/local/lib/haxe/std/php/Boot.hx:352: lines 352-362
			if (($value instanceof \StdClass)) {
				#/usr/local/lib/haxe/std/php/Boot.hx:353: characters 35-40
				$tmp1 = $value;
				#/usr/local/lib/haxe/std/php/Boot.hx:353: characters 43-51
				$tmp2 = "toString";
				#/usr/local/lib/haxe/std/php/Boot.hx:353: lines 353-355
				if (isset($tmp1->{$tmp2}) && is_callable(Boot::dynamicField($value, 'toString'))) {
					#/usr/local/lib/haxe/std/php/Boot.hx:354: characters 6-29
					return HxDynamicStr::wrap($value)->toString();
				}
				#/usr/local/lib/haxe/std/php/Boot.hx:356: characters 18-50
				$this1 = [];
				#/usr/local/lib/haxe/std/php/Boot.hx:356: characters 5-51
				$result = $this1;
				#/usr/local/lib/haxe/std/php/Boot.hx:357: characters 5-46
				$data = get_object_vars($value);
				#/usr/local/lib/haxe/std/php/Boot.hx:358: characters 17-34
				$_g_arr = array_keys($data);
				#/usr/local/lib/haxe/std/php/Boot.hx:358: characters 17-34
				$_g_hasMore = reset($_g_arr) !== false;
				#/usr/local/lib/haxe/std/php/Boot.hx:358: lines 358-360
				while ($_g_hasMore) {
					#/usr/local/lib/haxe/std/php/Boot.hx:358: lines 358-360
					$result1 = current($_g_arr);
					#/usr/local/lib/haxe/std/php/Boot.hx:358: lines 358-360
					$_g_hasMore = next($_g_arr) !== false;
					#/usr/local/lib/haxe/std/php/Boot.hx:358: lines 358-360
					$key1 = $result1;
					#/usr/local/lib/haxe/std/php/Boot.hx:359: characters 24-56
					$tmp3 = "" . ($key1??'null') . " : " . (Boot::stringify($data[$key1])??'null');
					#/usr/local/lib/haxe/std/php/Boot.hx:359: characters 6-57
					array_push($result, $tmp3);
				}

				#/usr/local/lib/haxe/std/php/Boot.hx:361: characters 5-54
				return "{ " . (implode(", ", $result)??'null') . " }";
			}
			#/usr/local/lib/haxe/std/php/Boot.hx:363: lines 363-365
			if (($value instanceof \Closure) || ($value instanceof HxClosure)) {
				#/usr/local/lib/haxe/std/php/Boot.hx:364: characters 5-24
				return "<function>";
			}
			#/usr/local/lib/haxe/std/php/Boot.hx:366: lines 366-370
			if (($value instanceof HxClass)) {
				#/usr/local/lib/haxe/std/php/Boot.hx:367: characters 5-72
				return "[class " . (Boot::getClassName($value->phpClassName)??'null') . "]";
			} else {
				#/usr/local/lib/haxe/std/php/Boot.hx:369: characters 5-68
				return "[object " . (Boot::getClassName(get_class($value))??'null') . "]";
			}
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:372: characters 3-8
		throw new HxException("Unable to stringify value");
	}


	/**
	 * Implementation for `cast(value, Class<Dynamic>)`
	 * @throws HxException if `value` cannot be casted to this type
	 * 
	 * @param HxClass $hxClass
	 * @param mixed $value
	 * 
	 * @return mixed
	 */
	static public function typedCast ($hxClass, $value) {
		#/usr/local/lib/haxe/std/php/Boot.hx:293: characters 11-31
		$_g = $hxClass->phpClassName;
		#/usr/local/lib/haxe/std/php/Boot.hx:293: characters 11-31
		switch ($_g) {
			case "Bool":
				#/usr/local/lib/haxe/std/php/Boot.hx:303: lines 303-305
				if (is_bool($value)) {
					#/usr/local/lib/haxe/std/php/Boot.hx:304: characters 6-18
					return $value;
				}
				break;
			case "Float":
				#/usr/local/lib/haxe/std/php/Boot.hx:299: lines 299-301
				if (is_int($value) || is_float($value)) {
					#/usr/local/lib/haxe/std/php/Boot.hx:300: characters 6-29
					return floatval($value);
				}
				break;
			case "Int":
				#/usr/local/lib/haxe/std/php/Boot.hx:295: lines 295-297
				if (is_int($value) || is_float($value)) {
					#/usr/local/lib/haxe/std/php/Boot.hx:296: characters 6-33
					return intval($value);
				}
				break;
			case "String":
				#/usr/local/lib/haxe/std/php/Boot.hx:307: lines 307-309
				if (is_string($value)) {
					#/usr/local/lib/haxe/std/php/Boot.hx:308: characters 6-18
					return $value;
				}
				break;
			case "php\\NativeArray":
				#/usr/local/lib/haxe/std/php/Boot.hx:311: lines 311-313
				if (is_array($value)) {
					#/usr/local/lib/haxe/std/php/Boot.hx:312: characters 6-18
					return $value;
				}
				break;
			default:
				#/usr/local/lib/haxe/std/php/Boot.hx:315: lines 315-317
				if (is_object($value) && Boot::is($value, $hxClass)) {
					#/usr/local/lib/haxe/std/php/Boot.hx:316: characters 6-18
					return $value;
				}
				break;
		}

		#/usr/local/lib/haxe/std/php/Boot.hx:319: characters 3-8
		throw new HxException("Cannot cast " . (\Std::string($value)??'null') . " to " . (Boot::getClassName($hxClass->phpClassName)??'null'));
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

#/usr/local/lib/haxe/std/php/Boot.hx:51: lines 51-66
if (!defined("HAXE_CUSTOM_ERROR_HANDLER") || !HAXE_CUSTOM_ERROR_HANDLER) {
	#/usr/local/lib/haxe/std/php/Boot.hx:52: characters 4-60
	$previousLevel = error_reporting(E_ALL);
	#/usr/local/lib/haxe/std/php/Boot.hx:53: lines 53-60
	$previousHandler = set_error_handler(function ($errno, $errstr, $errfile, $errline) {
		#/usr/local/lib/haxe/std/php/Boot.hx:55: lines 55-57
		if ((error_reporting() & $errno) === 0) {
			#/usr/local/lib/haxe/std/php/Boot.hx:56: characters 7-19
			return false;
		}
		#/usr/local/lib/haxe/std/php/Boot.hx:58: characters 6-11
		throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
	});
	#/usr/local/lib/haxe/std/php/Boot.hx:62: lines 62-65
	if ($previousHandler !== null) {
		#/usr/local/lib/haxe/std/php/Boot.hx:63: characters 5-42
		error_reporting($previousLevel);
		#/usr/local/lib/haxe/std/php/Boot.hx:64: characters 5-46
		set_error_handler($previousHandler);
	}
}

$this1 = [];
self::$aliases = $this1;
$this1 = [];
self::$classes = $this1;
$this1 = [];
self::$getters = $this1;
$this1 = [];
self::$setters = $this1;
$this1 = [];
self::$meta = $this1;
	}
}


Boot::__hx__init();
Boot::registerClass(Boot::class, 'php.Boot');
\php\Web::__hx__init();
\msignal\SlotList::__hx__init();
