<?php

// Generated by Haxe 3.4.7
class tink_io__Worker_Worker_Impl_ {
	public function __construct(){}
	static $EAGER;
	static $pool;
	static function ensure($this1) {
		$GLOBALS['%s']->push("tink.io._Worker.Worker_Impl_::ensure");
		$__hx__spos = $GLOBALS['%s']->length;
		if($this1 === null) {
			$tmp = tink_io__Worker_Worker_Impl_::get();
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$GLOBALS['%s']->pop();
			return $this1;
		}
		$GLOBALS['%s']->pop();
	}
	static function get() {
		$GLOBALS['%s']->push("tink.io._Worker.Worker_Impl_::get");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = tink_io__Worker_Worker_Impl_::$pool[Std::random(tink_io__Worker_Worker_Impl_::$pool->length)];
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function work($this1, $task) {
		$GLOBALS['%s']->push("tink.io._Worker.Worker_Impl_::work");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = $this1->work($task);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'tink.io._Worker.Worker_Impl_'; }
}
tink_io__Worker_Worker_Impl_::$EAGER = new tink_io__Worker_EagerWorker();
tink_io__Worker_Worker_Impl_::$pool = (new _hx_array(array(tink_io__Worker_Worker_Impl_::$EAGER)));