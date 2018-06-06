<?php

// Generated by Haxe 3.4.7
class sys_io_Process {
	public function __construct($cmd, $args = null) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("sys.io.Process::new");
		$__hx__spos = $GLOBALS['%s']->length;
		$pipes = array();
		$descriptorspec = array(
			array('pipe', 'r'),
			array('pipe', 'w'),
			array('pipe', 'w')
		);
		if($args !== null) {
			$_g = Sys::systemName();
			if($_g === "Windows") {
				$_g1 = (new _hx_array(array()));
				{
					$_g11 = 0;
					$_g2 = str_replace("/", "\\", $cmd);
					$_g21 = _hx_deref((new _hx_array(array($_g2))))->concat($args);
					while($_g11 < $_g21->length) {
						$a = $_g21[$_g11];
						$_g11 = $_g11 + 1;
						$_g1->push(StringTools::quoteWinArg($a, true));
						unset($a);
					}
				}
				$cmd = $_g1->join(" ");
			} else {
				$cmd = _hx_deref((new _hx_array(array($cmd))))->concat($args)->map((property_exists("StringTools", "quoteUnixArg") ? StringTools::$quoteUnixArg: array("StringTools", "quoteUnixArg")))->join(" ");
			}
		}
		$this->p = proc_open($cmd, $descriptorspec, $pipes);
		if(($this->p === false)) {
			throw new HException("Process creation failure : " . _hx_string_or_null($cmd));
		}
		$this->stdin = new sys_io__Process_Stdin($pipes[0]);
		$this->stdout = new sys_io__Process_Stdout($pipes[1]);
		$this->stderr = new sys_io__Process_Stdout($pipes[2]);
		$GLOBALS['%s']->pop();
	}}
	public $p;
	public $st;
	public $cl;
	public $stdout;
	public $stderr;
	public $stdin;
	public function close() {
		$GLOBALS['%s']->push("sys.io.Process::close");
		$__hx__spos = $GLOBALS['%s']->length;
		if(null === $this->st) {
			$this->st = proc_get_status($this->p);
		}
		$this->replaceStream($this->stderr);
		$this->replaceStream($this->stdout);
		if(null === $this->cl) {
			$this->cl = proc_close($this->p);
		}
		$GLOBALS['%s']->pop();
	}
	public function getPid() {
		$GLOBALS['%s']->push("sys.io.Process::getPid");
		$__hx__spos = $GLOBALS['%s']->length;
		$r = proc_get_status($this->p);
		{
			$tmp = $r["pid"];
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function kill() {
		$GLOBALS['%s']->push("sys.io.Process::kill");
		$__hx__spos = $GLOBALS['%s']->length;
		proc_terminate($this->p);
		$GLOBALS['%s']->pop();
	}
	public function replaceStream($input) {
		$GLOBALS['%s']->push("sys.io.Process::replaceStream");
		$__hx__spos = $GLOBALS['%s']->length;
		$fp = fopen("php://memory", "r+");
		while(true) {
			$s = fread($input->p, 8192);
			$tmp = null;
			$tmp1 = null;
			if(!($s === false)) {
				$tmp1 = $s === null;
			} else {
				$tmp1 = true;
			}
			if(!$tmp1) {
				$tmp = $s === "";
			} else {
				$tmp = true;
			}
			if($tmp) {
				break;
			}
			fwrite($fp, $s);
			unset($tmp1,$tmp,$s);
		}
		rewind($fp);
		$input->p = $fp;
		$GLOBALS['%s']->pop();
	}
	public function exitCode($block = null) {
		$GLOBALS['%s']->push("sys.io.Process::exitCode");
		$__hx__spos = $GLOBALS['%s']->length;
		if($block === null) {
			$block = true;
		}
		if(null === $this->cl) {
			$this->st = proc_get_status($this->p);
			while($this->st["running"]) {
				if($block === false) {
					$GLOBALS['%s']->pop();
					return null;
				}
				Sys::sleep(0.01);
				$this->st = proc_get_status($this->p);
			}
			$this->close();
		}
		if($this->st["exitcode"] < 0) {
			$tmp = $this->cl;
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$tmp = $this->st["exitcode"];
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
	function __toString() { return 'sys.io.Process'; }
}