<?php
use \app\App;
use \haxe\EntryPoint;

set_include_path(__DIR__.'/lib');
spl_autoload_register(
	function($class){
		$file = stream_resolve_include_path(str_replace('\\', '/', $class) .'.php');
		if ($file) {
			include_once $file;
		}
	}
);
\php\Boot::__hx__init();
#(unknown)
App::main();
#(unknown)
EntryPoint::run();
