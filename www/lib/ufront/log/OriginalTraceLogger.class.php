<?php

// Generated by Haxe 3.4.7
class ufront_log_OriginalTraceLogger implements ufront_app_UFInitRequired, ufront_app_UFLogHandler{
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("ufront.log.OriginalTraceLogger::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}}
	public $originalTrace;
	public function init($app) {
		$GLOBALS['%s']->push("ufront.log.OriginalTraceLogger::init");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->originalTrace = (property_exists($app, "originalTrace") ? $app->originalTrace: array($app, "originalTrace"));
		{
			$tmp = ufront_core_SurpriseTools::success();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function dispose($app) {
		$GLOBALS['%s']->push("ufront.log.OriginalTraceLogger::dispose");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = ufront_core_SurpriseTools::success();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function log($ctx, $appMessages) {
		$GLOBALS['%s']->push("ufront.log.OriginalTraceLogger::log");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$_g = 0;
			$_g1 = $ctx->messages;
			while($_g < $_g1->length) {
				$msg = $_g1[$_g];
				$_g = $_g + 1;
				$this->originalTrace($msg->msg, $msg->pos);
				unset($msg);
			}
		}
		if($appMessages !== null) {
			$_g2 = 0;
			while($_g2 < $appMessages->length) {
				$msg1 = $appMessages[$_g2];
				$_g2 = $_g2 + 1;
				$this->originalTrace($msg1->msg, $msg1->pos);
				unset($msg1);
			}
		}
		{
			$tmp = ufront_core_SurpriseTools::success();
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->__dynamics[$m]) && is_callable($this->__dynamics[$m]))
			return call_user_func_array($this->__dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call <'.$m.'>');
	}
	function __toString() { return 'ufront.log.OriginalTraceLogger'; }
}
