<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx
 */

namespace erazor;

use \hscript\Parser as HscriptParser;
use \php\_Boot\HxClosure;
use \haxe\ds\StringMap;
use \php\Boot;
use \php\_NativeArray\NativeArrayIterator;
use \hscript\Interp;
use \erazor\hscript\EnhancedInterp;

class Template {
	/**
	 * @var \Closure
	 */
	public $escape;
	/**
	 * @var StringMap
	 */
	public $helpers;
	/**
	 * @var string
	 */
	public $template;
	/**
	 * @var StringMap
	 */
	public $variables;


	/**
	 * @param string $template
	 * 
	 * @return void
	 */
	public function __construct ($template) {
		if (!$this->__hx__default__escape) {
			$this->__hx__default__escape = new HxClosure($this, 'escape');
			if ($this->escape === null) $this->escape = $this->__hx__default__escape;
		}
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:24: characters 3-27
		$this->template = $template;
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:25: characters 3-37
		$this->helpers = new StringMap();
	}


	/**
	 * @param string $name
	 * @param mixed $helper
	 * 
	 * @return void
	 */
	public function addHelper ($name, $helper) {
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:35: characters 3-28
		$this->helpers->data[$name] = $helper;
	}


	/**
	 * @param string $str
	 * 
	 * @return string
	 */
	public function escape ($str)
	{
		if ($this->escape !== $this->__hx__default__escape) return call_user_func_array($this->escape, func_get_args());
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:30: characters 3-13
		return $str;
	}
	protected $__hx__default__escape;


	/**
	 * @param mixed $content
	 * 
	 * @return string
	 */
	public function execute ($content = null) {
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:40: characters 3-35
		$buffer = new Output($this->escape);
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:43: characters 3-51
		$parsedBlocks = (new Parser())->parse($this->template);
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:46: characters 3-63
		$script = (new ScriptBuilder("__b__"))->build($parsedBlocks);
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:49: characters 3-37
		$parser = new HscriptParser();
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:50: characters 3-44
		$program = $parser->parseString($script);
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:52: characters 3-37
		$interp = new EnhancedInterp();
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:54: characters 3-31
		$this->variables = $interp->variables;
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:56: characters 3-24
		$bufferStack = new \Array_hx();
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:58: characters 3-38
		$this->setInterpreterVars($interp, $this->helpers);
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:59: characters 3-38
		$this->setInterpreterVars($interp, $content);
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:61: characters 3-40
		$interp->variables->data["__b__"] = $buffer;
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:62: lines 62-65
		$interp->variables->data["__string_buf__"] = function ($current)  use (&$bufferStack) {
			#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:63: characters 4-29
			$bufferStack->arr[$bufferStack->length] = $current;
			#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:63: characters 4-29
			++$bufferStack->length;

			#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:64: characters 4-26
			return new \StringBuf();
		};
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:67: lines 67-69
		$interp->variables->data["__restore_buf__"] = function ()  use (&$bufferStack) {
			#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:68: characters 11-28
			if ($bufferStack->length > 0) {
				#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:68: characters 11-28
				$bufferStack->length--;
			}
			#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:68: characters 11-28
			return array_pop($bufferStack->arr);
		};
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:71: characters 3-26
		$interp->execute($program);
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:74: characters 3-27
		return $buffer->b;
	}


	/**
	 * @param Interp $interp
	 * @param mixed $content
	 * 
	 * @return void
	 */
	public function setInterpreterVars ($interp, $content) {
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:79: lines 79-95
		if (($content instanceof StringMap)) {
			#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:81: characters 4-44
			$hash = $content;
			#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:83: characters 17-28
			$field = new NativeArrayIterator(array_map("strval", array_keys($hash->data)));
			#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:83: characters 17-28
			while ($field->hasNext()) {
				#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:83: lines 83-86
				$field1 = $field->next();
				#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:85: characters 5-49
				$this1 = $interp->variables;
				#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:85: characters 5-49
				$value = ($hash->data[$field1] ?? null);
				#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:85: characters 5-49
				$this1->data[$field1] = $value;
			}

		} else if ($content !== null) {
			#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:91: lines 91-94
			$_g = 0;
			#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:91: lines 91-94
			$_g1 = \Reflect::fields($content);
			#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:91: lines 91-94
			while ($_g < $_g1->length) {
				#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:91: characters 9-14
				$field2 = ($_g1->arr[$_g] ?? null);
				#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:91: lines 91-94
				$_g = $_g + 1;
				#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:93: characters 6-64
				$this2 = $interp->variables;
				#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:93: characters 6-64
				$value1 = \Reflect::field($content, $field2);
				#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/Template.hx:93: characters 6-64
				$this2->data[$field2] = $value1;

			}
		}
	}
}


Boot::registerClass(Template::class, 'erazor.Template');
