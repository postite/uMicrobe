<?php

// Generated by Haxe 3.4.7
class tink_io_IdealSinkBase extends tink_io_SinkBase implements tink_io_IdealSinkObject{
	public function idealize($onError) {
		$GLOBALS['%s']->push("tink.io.IdealSinkBase::idealize");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$GLOBALS['%s']->pop();
			return $this;
		}
		$GLOBALS['%s']->pop();
	}
	public function writeSafely($from) {
		$GLOBALS['%s']->push("tink.io.IdealSinkBase::writeSafely");
		$__hx__spos = $GLOBALS['%s']->length;
		throw new HException("not implemented");
		$GLOBALS['%s']->pop();
	}
	public function closeSafely() {
		$GLOBALS['%s']->push("tink.io.IdealSinkBase::closeSafely");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Noise::$Noise));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function write($from) {
		$GLOBALS['%s']->push("tink.io.IdealSinkBase::write");
		$__hx__spos = $GLOBALS['%s']->length;
		$this1 = $this->writeSafely($from);
		$ret = $this1->map((property_exists("tink_core_Outcome", "Success") ? tink_core_Outcome::$Success: array("tink_core_Outcome", "Success")));
		{
			$tmp = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function close() {
		$GLOBALS['%s']->push("tink.io.IdealSinkBase::close");
		$__hx__spos = $GLOBALS['%s']->length;
		$this1 = $this->closeSafely();
		$ret = $this1->map((property_exists("tink_core_Outcome", "Success") ? tink_core_Outcome::$Success: array("tink_core_Outcome", "Success")));
		{
			$tmp = $ret->gather();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'tink.io.IdealSinkBase'; }
}
