<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Signal.hx
 */

namespace msignal;

use \php\Boot;

/**
 * Signal that executes listeners with one arguments.
 */
class Signal1 extends Signal {
	/**
	 * @param mixed $type
	 * 
	 * @return void
	 */
	public function __construct ($type = null) {
		#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Signal.hx:215: characters 3-16
		parent::__construct(\Array_hx::wrap([$type]));
	}


	/**
	 * @param \Closure $listener
	 * @param bool $once
	 * @param int $priority
	 * 
	 * @return Slot1
	 */
	public function createSlot ($listener, $once = false, $priority = 0) {
		#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Signal.hx:234: characters 3-59
		if ($once === null) {
			#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Signal.hx:234: characters 3-59
			$once = false;
		}
		#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Signal.hx:234: characters 3-59
		if ($priority === null) {
			#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Signal.hx:234: characters 3-59
			$priority = 0;
		}
		#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Signal.hx:234: characters 3-59
		return new Slot1($this, $listener, $once, $priority);
	}


	/**
	 * Executes the signals listeners with one arguement.
	 * 
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public function dispatch ($value) {
		#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Signal.hx:223: characters 3-30
		$slotsToProcess = $this->slots;
		#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Signal.hx:225: lines 225-229
		while ($slotsToProcess->nonEmpty) {
			#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Signal.hx:227: characters 4-38
			$slotsToProcess->head->execute($value);
			#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Signal.hx:228: characters 4-40
			$slotsToProcess = $slotsToProcess->tail;
		}
	}
}


Boot::registerClass(Signal1::class, 'msignal.Signal1');