<?php

// Generated by Haxe 3.4.7
class ufront_web_result_HttpAuthResult extends ufront_web_result_ActionResult {
	public function __construct($message, $failureMessage) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("ufront.web.result.HttpAuthResult::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->message = $message;
		$tmp = null;
		if($failureMessage !== null) {
			$tmp = $failureMessage;
		} else {
			$tmp = $message;
		}
		$this->failureMessage = $tmp;
		$GLOBALS['%s']->pop();
	}}
	public $message;
	public $failureMessage;
	public function executeResult($actionContext) {
		$GLOBALS['%s']->push("ufront.web.result.HttpAuthResult::executeResult");
		$__hx__spos = $GLOBALS['%s']->length;
		$actionContext->httpContext->response->requireAuthentication($this->message);
		$actionContext->httpContext->response->write($this->failureMessage);
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
	static function requireAuth($context, $username, $password, $message = null, $failureMessage = null, $successFn) {
		$GLOBALS['%s']->push("ufront.web.result.HttpAuthResult::requireAuth");
		$__hx__spos = $GLOBALS['%s']->length;
		$auth = $context->request->get_authorization();
		$tmp = null;
		$tmp1 = null;
		if($auth !== null) {
			$tmp1 = $auth->user === $username;
		} else {
			$tmp1 = false;
		}
		if($tmp1) {
			$tmp = $auth->pass === $password;
		} else {
			$tmp = false;
		}
		if($tmp) {
			$tmp2 = call_user_func($successFn);
			$GLOBALS['%s']->pop();
			return $tmp2;
		} else {
			$result = new ufront_web_result_HttpAuthResult($message, $failureMessage);
			{
				$tmp2 = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Outcome::Success($result)));
				$GLOBALS['%s']->pop();
				return $tmp2;
			}
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'ufront.web.result.HttpAuthResult'; }
}