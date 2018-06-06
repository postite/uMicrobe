<?php

// Generated by Haxe 3.4.7
class tink_io__Source_Source_Impl_ {
	public function __construct(){}
	static function read($this1, $into, $max = null) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::read");
		$__hx__spos = $GLOBALS['%s']->length;
		if($max === null) {
			$max = 1073741824;
		}
		{
			$tmp = $this1->read($into, $max);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function close($this1) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::close");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this1->close();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function all($this1) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::all");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this1->all();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function prepend($this1, $other) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::prepend");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this1->prepend($other);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function append($this1, $other) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::append");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this1->append($other);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function pipeTo($this1, $dest, $options = null) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::pipeTo");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this1->pipeTo($dest, $options);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function idealize($this1, $onError) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::idealize");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this1->idealize($onError);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function parse($this1, $parser) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::parse");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this1->parse($parser);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function parseWhile($this1, $parser, $consumer) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::parseWhile");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this1->parseWhile($parser, $consumer);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function parseStream($this1, $parser, $rest = null) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::parseStream");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this1->parseStream($parser, $rest);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function split($this1, $delim) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::split");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this1->split($delim);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function skip($this1, $length) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::skip");
		$__hx__spos = $GLOBALS['%s']->length;
		$this2 = tink_io__Source_Source_Impl_::limit($this1, $length);
		$this3 = tink_io_BlackHole::$INST;
		$this4 = $this2->pipeTo($this3, null);
		$ret = $this4->map(array(new _hx_lambda(array(&$this1), "tink_io__Source_Source_Impl__0"), 'execute'));
		{
			$tmp = tink_io__Source_Source_Impl_::flatten($ret->gather());
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function limit($this1, $length) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::limit");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_io__Source_LimitedSource($this1, $length);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function async($f, $close) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::async");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_io__Source_AsyncSource($f, $close);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function failure($e) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::failure");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_io__Source_FailedSource($e);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function ofInput($name, $input, $worker = null) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::ofInput");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_io__Source_StdSource($name, $input, $worker);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static $stdin;
	static function flatten($s) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::flatten");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_io__Source_FutureSource($s);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function fromBytes($b) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::fromBytes");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = null;
		if($b === null) {
			$tmp = tink_io_Empty::$instance;
		} else {
			$tmp = new tink_io_ByteSource($b, 0);
		}
		{
			$tmp2 = $tmp;
			$GLOBALS['%s']->pop();
			return $tmp2;
		}
		$GLOBALS['%s']->pop();
	}
	static function fromString($s) {
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::fromString");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = tink_io__Source_Source_Impl_::fromBytes(haxe_io_Bytes::ofString($s));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'tink.io._Source.Source_Impl_'; }
}
tink_io__Source_Source_Impl_::$stdin = tink_io__Source_Source_Impl_::ofInput("stdin", Sys::stdin(), null);
function tink_io__Source_Source_Impl__0(&$this1, $o) {
	{
		$GLOBALS['%s']->push("tink.io._Source.Source_Impl_::skip@57");
		$__hx__spos = $GLOBALS['%s']->length;
		switch($o->index) {
		case 0:{
			$tmp = tink_core_Outcome::Success($this1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}break;
		case 3:{
			$e = _hx_deref($o)->params[0];
			{
				$tmp = tink_core_Outcome::Failure($e);
				$GLOBALS['%s']->pop();
				return $tmp;
			}
		}break;
		}
		$GLOBALS['%s']->pop();
	}
}
