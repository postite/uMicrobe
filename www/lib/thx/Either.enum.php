<?php

// Generated by Haxe 3.4.7
class thx_Either extends Enum {
	public static function Left($value) { return new thx_Either("Left", 0, array($value)); }
	public static function Right($value) { return new thx_Either("Right", 1, array($value)); }
	public static $__constructors = array(0 => 'Left', 1 => 'Right');
	}
