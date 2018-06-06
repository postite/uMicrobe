<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Signal.hx
 */

namespace tink\core;

use \php\Boot;
use \tink\core\_Callback\LinkObject;
use \tink\core\_Callback\CallbackList_Impl_;

class SignalTrigger implements SignalObject {
	/**
	 * @var \Array_hx
	 */
	public $handlers;


	/**
	 * @return void
	 */
	public function __construct () {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Signal.hx:146: characters 18-39
		$this1 = new \Array_hx();
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Signal.hx:146: characters 18-39
		$this->handlers = $this1;
	}


	/**
	 * @return SignalObject
	 */
	public function asSignal () {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Signal.hx:171: characters 5-16
		return $this;
	}


	/**
	 *  Clear all handlers
	 * 
	 * @return void
	 */
	public function clear () {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Signal.hx:168: characters 5-21
		CallbackList_Impl_::clear($this->handlers);
	}


	/**
	 *  Gets the number of handlers registered
	 * 
	 * @return int
	 */
	public function getLength () {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Signal.hx:159: characters 5-27
		return $this->handlers->length;
	}


	/**
	 * @param \Closure $cb
	 * 
	 * @return LinkObject
	 */
	public function handle ($cb) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Signal.hx:162: characters 5-28
		return CallbackList_Impl_::add($this->handlers, $cb);
	}


	/**
	 *  Emits a value for this signal
	 * 
	 * @param mixed $event
	 * 
	 * @return void
	 */
	public function trigger ($event) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Signal.hx:153: characters 5-27
		CallbackList_Impl_::invoke($this->handlers, $event);
	}
}


Boot::registerClass(SignalTrigger::class, 'tink.core.SignalTrigger');