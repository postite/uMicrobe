<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Callback.hx
 */

namespace tink\core\_Callback;

use \php\Boot;
use \php\_Boot\HxException;

class ListCell implements LinkObject {
	/**
	 * @var \Closure
	 */
	public $cb;
	/**
	 * @var \Array_hx
	 */
	public $list;


	/**
	 * @param \Closure $cb
	 * @param \Array_hx $list
	 * 
	 * @return void
	 */
	public function __construct ($cb, $list) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Callback.hx:115: characters 5-26
		if ($cb === null) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Callback.hx:115: characters 21-26
			throw new HxException("callback expected but null received");
		}
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Callback.hx:116: characters 5-17
		$this->cb = $cb;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Callback.hx:117: characters 5-21
		$this->list = $list;
	}


	/**
	 * @return void
	 */
	public function clear () {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Callback.hx:125: characters 5-16
		$this->list = null;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Callback.hx:126: characters 5-14
		$this->cb = null;
	}


	/**
	 * @return void
	 */
	public function dissolve () {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Callback.hx:130: characters 12-16
		$_g = $this->list;
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Callback.hx:131: lines 131-132
		if ($_g !== null) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Callback.hx:132: characters 12-13
			$v = $_g;
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Callback.hx:132: characters 15-22
			$this->clear();
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Callback.hx:132: characters 24-38
			$v->remove($this);

		}
	}


	/**
	 * @param mixed $data
	 * 
	 * @return void
	 */
	public function invoke ($data) {
		#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Callback.hx:121: lines 121-122
		if ($this->cb !== null) {
			#/usr/local/lib/haxe/lib/tink_core/1,17,0/src/tink/core/Callback.hx:122: characters 7-22
			Callback_Impl_::invoke($this->cb, $data);
		}
	}
}


Boot::registerClass(ListCell::class, 'tink.core._Callback.ListCell');
