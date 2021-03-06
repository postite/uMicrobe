<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx
 */

namespace tink\core;

use \php\Boot;
use \php\_Boot\HxException;
use \haxe\CallStack;

class TypedError {
	/**
	 * @var \Array_hx
	 */
	public $callStack;
	/**
	 * @var int
	 */
	public $code;
	/**
	 * @var mixed
	 */
	public $data;
	/**
	 * @var \Array_hx
	 */
	public $exceptionStack;
	/**
	 * @var bool
	 */
	public $isTinkError;
	/**
	 * @var string
	 */
	public $message;
	/**
	 * @var object
	 */
	public $pos;


	/**
	 * @param mixed $v
	 * 
	 * @return TypedError
	 */
	static public function asError ($v) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:112: characters 9-31
		$value = $v;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:112: characters 9-31
		if (($value instanceof TypedError)) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:112: characters 9-31
			return $value;
		} else {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:112: characters 9-31
			return null;
		}
	}


	/**
	 * @param \Closure $f
	 * @param \Closure $report
	 * @param object $pos
	 * 
	 * @return Outcome
	 */
	static public function catchExceptions ($f, $report = null, $pos = null) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:117: lines 117-129
		try {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:118: characters 9-21
			return Outcome::Success($f());
		} catch (\Throwable $__hx__caught_e) {
			CallStack::saveExceptionTrace($__hx__caught_e);
			$__hx__real_e = ($__hx__caught_e instanceof HxException ? $__hx__caught_e->e : $__hx__caught_e);
			$e = $__hx__real_e;
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:121: characters 18-28
			$_g = TypedError::asError($e);
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:121: lines 121-128
			$tmp = null;
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:122: lines 122-127
			if ($_g === null) {
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:121: lines 121-128
				$tmp = ($report === null ? TypedError::withData(null, "Unexpected Error", $e, $pos) : $report($e));
			} else {
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:127: characters 20-21
				$e1 = $_g;
				#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:121: lines 121-128
				$tmp = $e1;
			}
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:120: lines 120-129
			return Outcome::Failure($tmp);
		}
	}


	/**
	 * @param int $code
	 * @param string $message
	 * @param object $pos
	 * 
	 * @return \Closure
	 */
	static public function reporter ($code = null, $message, $pos = null) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:132: lines 132-133
		return function ($e)  use (&$pos, &$message, &$code) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:133: characters 28-72
			return TypedError::withData($code, $message, $e, $pos);
		};
	}


	/**
	 * @param mixed $any
	 * 
	 * @return mixed
	 */
	static public function rethrow ($any) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:139: characters 7-27
		throw (is_object($__hx__throw = $any) && $__hx__throw instanceof \Throwable ? $__hx__throw : new HxException($__hx__throw));
	}


	/**
	 * @param \Closure $f
	 * @param \Closure $cleanup
	 * 
	 * @return mixed
	 */
	static public function tryFinally ($f, $cleanup) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:153: lines 153-161
		try {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:154: characters 7-21
			$ret = $f();
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:155: characters 7-16
			$cleanup();
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:156: characters 7-17
			return $ret;
		} catch (\Throwable $__hx__caught_e) {
			CallStack::saveExceptionTrace($__hx__caught_e);
			$__hx__real_e = ($__hx__caught_e instanceof HxException ? $__hx__caught_e->e : $__hx__caught_e);
			$e = $__hx__real_e;
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:159: characters 7-16
			$cleanup();
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:160: characters 14-24
			throw (is_object($__hx__throw = $e) && $__hx__throw instanceof \Throwable ? $__hx__throw : new HxException($__hx__throw));
		}
	}


	/**
	 * @param int $code
	 * @param string $message
	 * @param mixed $data
	 * @param object $pos
	 * 
	 * @return TypedError
	 */
	static public function typed ($code = null, $message, $data, $pos = null) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:96: characters 5-50
		$ret = new TypedError($code, $message, $pos);
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:97: characters 5-20
		$ret->data = $data;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:98: characters 5-15
		return $ret;
	}


	/**
	 * @param int $code
	 * @param string $message
	 * @param mixed $data
	 * @param object $pos
	 * 
	 * @return TypedError
	 */
	static public function withData ($code = null, $message, $data, $pos = null) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:92: characters 5-43
		return TypedError::typed($code, $message, $data, $pos);
	}


	/**
	 * @param int $code
	 * @param string $message
	 * @param object $pos
	 * 
	 * @return void
	 */
	public function __construct ($code = 500, $message, $pos = null) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:44: lines 44-164
		if ($code === null) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:44: lines 44-164
			$code = 500;
		}
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:51: characters 21-25
		$this->isTinkError = true;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:54: characters 5-21
		$this->code = $code;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:55: characters 5-27
		$this->message = $message;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:56: characters 5-19
		$this->pos = $pos;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:57: characters 5-98
		$this->exceptionStack = new \Array_hx();
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:58: characters 5-88
		$this->callStack = new \Array_hx();
	}


	/**
	 * @return string
	 */
	public function printPos () {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:61: lines 61-67
		return ($this->pos->className??'null') . "." . ($this->pos->methodName??'null') . ":" . ($this->pos->lineNumber??'null');
	}


	/**
	 * @return mixed
	 */
	public function throwSelf () {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:88: characters 9-22
		throw new HxException($this);
	}


	/**
	 * @return string
	 */
	public function toString () {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:71: characters 5-39
		$ret = "Error#" . ($this->code??'null') . ": " . ($this->message??'null');
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:73: lines 73-74
		if ($this->pos !== null) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:74: characters 7-30
			$ret = ($ret??'null') . ((" @ " . ($this->printPos()??'null'))??'null');
		}
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Error.hx:76: characters 5-15
		return $ret;
	}


	public function __toString() {
		return $this->toString();
	}
}


Boot::registerClass(TypedError::class, 'tink.core.TypedError');
