<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/HtmlTemplate.hx
 */

namespace erazor;

use \php\_Boot\HxClosure;
use \php\Boot;

class HtmlTemplate extends Template {
	/**
	 * @var \Closure
	 */
	public $escape;


	/**
	 * @param mixed $str
	 * 
	 * @return TString
	 */
	static public function raw ($str) {
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/HtmlTemplate.hx:21: characters 3-41
		return new TString(\Std::string($str));
	}


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
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/HtmlTemplate.hx:10: characters 3-18
		parent::__construct($template);
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/HtmlTemplate.hx:11: characters 3-24
		$this->addHelper("raw", new HxClosure(HtmlTemplate::class, 'raw'));
	}


	/**
	 * @param string $str
	 * 
	 * @return string
	 */
	public function escape ($str)
	{
		if ($this->escape !== $this->__hx__default__escape) return call_user_func_array($this->escape, func_get_args());
		#/usr/local/lib/haxe/lib/erazor/1,0,2/src/erazor/HtmlTemplate.hx:16: characters 3-43
		return htmlspecialchars($str, ENT_QUOTES | ENT_HTML401);
	}
	protected $__hx__default__escape;
}


Boot::registerClass(HtmlTemplate::class, 'erazor.HtmlTemplate');
