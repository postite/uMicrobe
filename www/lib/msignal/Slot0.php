<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Slot.hx
 */

namespace msignal;

use \php\Boot;

/**
 * A slot that executes a listener with no arguments.
 */
class Slot0 extends Slot {
	/**
	 * @param Signal0 $signal
	 * @param \Closure $listener
	 * @param bool $once
	 * @param int $priority
	 * 
	 * @return void
	 */
	public function __construct ($signal, $listener, $once = false, $priority = 0) {
		#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Slot.hx:117: characters 3-42
		if ($once === null) {
			#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Slot.hx:117: characters 3-42
			$once = false;
		}
		#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Slot.hx:117: characters 3-42
		if ($priority === null) {
			#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Slot.hx:117: characters 3-42
			$priority = 0;
		}
		#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Slot.hx:117: characters 3-42
		parent::__construct($signal, $listener, $once, $priority);
	}


	/**
	 * Executes a listener with no arguments.
	 * 
	 * @return void
	 */
	public function execute () {
		#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Slot.hx:125: characters 3-23
		if (!$this->enabled) {
			#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Slot.hx:125: characters 17-23
			return;
		}
		#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Slot.hx:126: characters 3-21
		if ($this->once) {
			#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Slot.hx:126: characters 13-21
			$this->remove();
		}
		#/usr/local/lib/haxe/lib/msignal/1,2,4/msignal/Slot.hx:127: characters 3-13
		($this->listener)();
	}
}


Boot::registerClass(Slot0::class, 'msignal.Slot0');
