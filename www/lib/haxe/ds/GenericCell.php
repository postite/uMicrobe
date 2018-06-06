<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/ds/GenericStack.hx
 */

namespace haxe\ds;

use \php\Boot;

/**
 * A cell of `haxe.ds.GenericStack`.
 * @see https://haxe.org/manual/std-GenericStack.html
 */
class GenericCell {
	/**
	 * @var mixed
	 */
	public $elt;
	/**
	 * @var GenericCell
	 */
	public $next;


	/**
	 * @param mixed $elt
	 * @param GenericCell $next
	 * 
	 * @return void
	 */
	public function __construct ($elt, $next) {
		#/usr/local/lib/haxe/std/haxe/ds/GenericStack.hx:35: characters 34-48
		$this->elt = $elt;
		#/usr/local/lib/haxe/std/haxe/ds/GenericStack.hx:35: characters 50-66
		$this->next = $next;
	}
}


Boot::registerClass(GenericCell::class, 'haxe.ds.GenericCell');
