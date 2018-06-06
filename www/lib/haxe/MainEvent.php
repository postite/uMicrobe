<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/MainLoop.hx
 */

namespace haxe;

use \php\Boot;

class MainEvent {
	/**
	 * @var \Closure
	 */
	public $f;
	/**
	 * @var bool
	 * Tells if the event can lock the process from exiting (default:true)
	 */
	public $isBlocking;
	/**
	 * @var MainEvent
	 */
	public $next;
	/**
	 * @var float
	 */
	public $nextRun;
	/**
	 * @var MainEvent
	 */
	public $prev;
	/**
	 * @var int
	 */
	public $priority;


	/**
	 * @param \Closure $f
	 * @param int $p
	 * 
	 * @return void
	 */
	public function __construct ($f, $p) {
		#/usr/local/lib/haxe/std/haxe/MainLoop.hx:12: characters 33-37
		$this->isBlocking = true;
		#/usr/local/lib/haxe/std/haxe/MainLoop.hx:17: characters 3-13
		$this->f = $f;
		#/usr/local/lib/haxe/std/haxe/MainLoop.hx:18: characters 3-20
		$this->priority = $p;
		#/usr/local/lib/haxe/std/haxe/MainLoop.hx:19: characters 3-15
		$this->nextRun = -1;
	}


	/**
	 * Call the event. Will do nothing if the event has been stopped.
	 * 
	 * @return void
	 */
	public function call () {
		#/usr/local/lib/haxe/std/haxe/MainLoop.hx:34: characters 3-22
		if ($this->f !== null) {
			#/usr/local/lib/haxe/std/haxe/MainLoop.hx:34: characters 19-22
			($this->f)();
		}
	}


	/**
	 * Delay the execution of the event for the given time, in seconds.
	 * If t is null, the event will be run at tick() time.
	 * 
	 * @param float $t
	 * 
	 * @return void
	 */
	public function delay ($t) {
		#/usr/local/lib/haxe/std/haxe/MainLoop.hx:27: characters 3-52
		$this->nextRun = ($t === null ? -1 : microtime(true) + $t);
	}


	/**
	 * Stop the event from firing anymore.
	 * 
	 * @return void
	 */
	public function stop () {
		#/usr/local/lib/haxe/std/haxe/MainLoop.hx:41: characters 3-25
		if ($this->f === null) {
			#/usr/local/lib/haxe/std/haxe/MainLoop.hx:41: characters 19-25
			return;
		}
		#/usr/local/lib/haxe/std/haxe/MainLoop.hx:42: characters 3-11
		$this->f = null;
		#/usr/local/lib/haxe/std/haxe/MainLoop.hx:43: characters 3-15
		$this->nextRun = -1;
		#/usr/local/lib/haxe/std/haxe/MainLoop.hx:44: lines 44-47
		if ($this->prev === null) {
			#/usr/local/lib/haxe/std/haxe/MainLoop.hx:45: characters 20-43
			MainLoop::$pending = $this->next;
		} else {
			#/usr/local/lib/haxe/std/haxe/MainLoop.hx:47: characters 4-20
			$this->prev->next = $this->next;
		}
		#/usr/local/lib/haxe/std/haxe/MainLoop.hx:48: lines 48-49
		if ($this->next !== null) {
			#/usr/local/lib/haxe/std/haxe/MainLoop.hx:49: characters 4-20
			$this->next->prev = $this->prev;
		}
	}
}


Boot::registerClass(MainEvent::class, 'haxe.MainEvent');
