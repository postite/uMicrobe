<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/php/_std/sys/io/Process.hx
 */

namespace sys\io\_Process;

use \php\Boot;

final class ProcessPipes_Impl_ {


	/**
	 * @param mixed $this
	 * 
	 * @return mixed
	 */
	static public function get_stderr ($this1) {
		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:38: characters 31-45
		return $this1[2];
	}


	/**
	 * @param mixed $this
	 * 
	 * @return mixed
	 */
	static public function get_stdin ($this1) {
		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:36: characters 30-44
		return $this1[0];
	}


	/**
	 * @param mixed $this
	 * 
	 * @return mixed
	 */
	static public function get_stdout ($this1) {
		#/usr/local/lib/haxe/std/php/_std/sys/io/Process.hx:37: characters 31-45
		return $this1[1];
	}
}


Boot::registerClass(ProcessPipes_Impl_::class, 'sys.io._Process.ProcessPipes_Impl_');
Boot::registerGetters('sys\\io\\_Process\\ProcessPipes_Impl_', [
	'stderr' => true,
	'stdout' => true,
	'stdin' => true
]);