<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/asys/0,3,0/asys/io/Process.hx
 */

namespace asys\io;

use \tink\core\FutureTrigger;
use \php\Boot;
use \tink\io\SinkObject;
use \tink\core\_Future\FutureObject;
use \sys\io\Process as IoProcess;
use \tink\io\_Source\Source_Impl_;
use \tink\io\SourceObject;
use \tink\io\_Sink\Sink_Impl_;

class Process {
	/**
	 * @var FutureTrigger
	 */
	public $exitTrigger;
	/**
	 * @var IoProcess
	 */
	public $process;
	/**
	 * @var SourceObject
	 */
	public $stderr;
	/**
	 * @var SinkObject
	 */
	public $stdin;
	/**
	 * @var SourceObject
	 */
	public $stdout;


	/**
	 * @param string $cmd
	 * @param \Array_hx $args
	 * 
	 * @return void
	 */
	public function __construct ($cmd, $args = null) {
		#/usr/local/lib/haxe/lib/asys/0,3,0/asys/io/Process.hx:18: characters 20-36
		$this->exitTrigger = new FutureTrigger();
		#/usr/local/lib/haxe/lib/asys/0,3,0/asys/io/Process.hx:30: characters 3-42
		$this->process = new IoProcess($cmd, $args);
		#/usr/local/lib/haxe/lib/asys/0,3,0/asys/io/Process.hx:31: characters 3-48
		$this->stdin = Sink_Impl_::ofOutput("stdin", $this->process->stdin);
		#/usr/local/lib/haxe/lib/asys/0,3,0/asys/io/Process.hx:32: characters 3-52
		$this->stderr = Source_Impl_::ofInput("stderr", $this->process->stderr);
		#/usr/local/lib/haxe/lib/asys/0,3,0/asys/io/Process.hx:33: characters 3-52
		$this->stdout = Source_Impl_::ofInput("stdout", $this->process->stdout);
		#/usr/local/lib/haxe/lib/asys/0,3,0/asys/io/Process.hx:34: characters 3-42
		$this->exitTrigger->trigger($this->process->exitCode());
	}


	/**
	 * @return void
	 */
	public function close () {
		#/usr/local/lib/haxe/lib/asys/0,3,0/asys/io/Process.hx:47: characters 3-18
		$this->process->close();
	}


	/**
	 * @return FutureObject
	 */
	public function exitCode () {
		#/usr/local/lib/haxe/lib/asys/0,3,0/asys/io/Process.hx:42: characters 3-32
		return $this->exitTrigger;
	}


	/**
	 * @return int
	 */
	public function getPid () {
		#/usr/local/lib/haxe/lib/asys/0,3,0/asys/io/Process.hx:39: characters 3-55
		return $this->process->getPid();
	}


	/**
	 * @return void
	 */
	public function kill () {
		#/usr/local/lib/haxe/lib/asys/0,3,0/asys/io/Process.hx:52: characters 3-17
		$this->process->kill();
	}
}


Boot::registerClass(Process::class, 'asys.io.Process');
