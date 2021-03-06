<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/ds/List.hx
 */

namespace haxe\ds;

use \php\Boot;
use \haxe\ds\_List\ListIterator;
use \haxe\ds\_List\ListNode;

/**
 * A linked-list of elements. The list is composed of element container objects
 * that are chained together. It is optimized so that adding or removing an
 * element does not imply copying the whole list content every time.
 * @see https://haxe.org/manual/std-List.html
 */
class List_hx {
	/**
	 * @var ListNode
	 */
	public $h;
	/**
	 * @var int
	 * The length of `this` List.
	 */
	public $length;
	/**
	 * @var ListNode
	 */
	public $q;


	/**
	 * Creates a new empty list.
	 * 
	 * @return void
	 */
	public function __construct () {
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:45: characters 3-13
		$this->length = 0;
	}


	/**
	 * Adds element `item` at the end of `this` List.
	 * `this.length` increases by 1.
	 * 
	 * @param mixed $item
	 * 
	 * @return void
	 */
	public function add ($item) {
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:54: characters 3-39
		$x = new ListNode($item, null);
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:55: lines 55-58
		if ($this->h === null) {
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:56: characters 4-9
			$this->h = $x;
		} else {
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:58: characters 4-14
			$this->q->next = $x;
		}
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:59: characters 3-8
		$this->q = $x;
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:60: characters 3-11
		$this->length++;
	}


	/**
	 * Empties `this` List.
	 * This function does not traverse the elements, but simply sets the
	 * internal references to null and `this.length` to 0.
	 * 
	 * @return void
	 */
	public function clear () {
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:125: characters 3-11
		$this->h = null;
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:126: characters 3-11
		$this->q = null;
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:127: characters 3-13
		$this->length = 0;
	}


	/**
	 * Returns a list filtered with `f`. The returned list will contain all
	 * elements for which `f(x) == true`.
	 * 
	 * @param \Closure $f
	 * 
	 * @return List_hx
	 */
	public function filter ($f) {
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:212: characters 3-23
		$l2 = new List_hx();
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:213: characters 3-13
		$l = $this->h;
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:214: lines 214-219
		while ($l !== null) {
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:215: characters 4-19
			$v = $l->item;
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:216: characters 4-14
			$l = $l->next;
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:217: lines 217-218
			if ($f($v)) {
				#/usr/local/lib/haxe/std/haxe/ds/List.hx:218: characters 5-14
				$l2->add($v);
			}
		}
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:220: characters 3-12
		return $l2;
	}


	/**
	 * Returns the first element of `this` List, or null if no elements exist.
	 * This function does not modify `this` List.
	 * 
	 * @return mixed
	 */
	public function first () {
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:82: characters 10-42
		if ($this->h === null) {
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:82: characters 26-30
			return null;
		} else {
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:82: characters 36-42
			return $this->h->item;
		}
	}


	/**
	 * Tells if `this` List is empty.
	 * 
	 * @return bool
	 */
	public function isEmpty () {
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:115: characters 3-21
		return $this->h === null;
	}


	/**
	 * Returns an iterator on the elements of the list.
	 * 
	 * @return ListIterator
	 */
	public function iterator () {
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:162: characters 3-32
		return new ListIterator($this->h);
	}


	/**
	 * Returns a string representation of `this` List, with `sep` separating
	 * each element.
	 * 
	 * @param string $sep
	 * 
	 * @return string
	 */
	public function join ($sep) {
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:193: characters 3-27
		$s = new \StringBuf();
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:194: characters 3-20
		$first = true;
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:195: characters 3-13
		$l = $this->h;
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:196: lines 196-203
		while ($l !== null) {
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:197: lines 197-200
			if ($first) {
				#/usr/local/lib/haxe/std/haxe/ds/List.hx:198: characters 5-18
				$first = false;
			} else {
				#/usr/local/lib/haxe/std/haxe/ds/List.hx:200: characters 5-15
				$s->add($sep);
			}
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:201: characters 4-17
			$s->add($l->item);
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:202: characters 4-14
			$l = $l->next;
		}
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:204: characters 3-22
		return $s->b;
	}


	/**
	 * Returns the last element of `this` List, or null if no elements exist.
	 * This function does not modify `this` List.
	 * 
	 * @return mixed
	 */
	public function last () {
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:91: characters 10-42
		if ($this->q === null) {
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:91: characters 26-30
			return null;
		} else {
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:91: characters 36-42
			return $this->q->item;
		}
	}


	/**
	 * Returns a new list where all elements have been converted by the
	 * function `f`.
	 * 
	 * @param \Closure $f
	 * 
	 * @return List_hx
	 */
	public function map ($f) {
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:228: characters 3-22
		$b = new List_hx();
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:229: characters 3-13
		$l = $this->h;
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:230: lines 230-234
		while ($l !== null) {
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:231: characters 4-19
			$v = $l->item;
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:232: characters 4-14
			$l = $l->next;
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:233: characters 4-15
			$b->add($f($v));
		}
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:235: characters 3-11
		return $b;
	}


	/**
	 * Returns the first element of `this` List, or null if no elements exist.
	 * The element is removed from `this` List.
	 * 
	 * @return mixed
	 */
	public function pop () {
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:101: lines 101-102
		if ($this->h === null) {
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:102: characters 4-15
			return null;
		}
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:103: characters 3-18
		$x = $this->h->item;
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:104: characters 3-13
		$this->h = $this->h->next;
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:105: lines 105-106
		if ($this->h === null) {
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:106: characters 4-12
			$this->q = null;
		}
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:107: characters 3-11
		$this->length--;
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:108: characters 3-11
		return $x;
	}


	/**
	 * Adds element `item` at the beginning of `this` List.
	 * `this.length` increases by 1.
	 * 
	 * @param mixed $item
	 * 
	 * @return void
	 */
	public function push ($item) {
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:69: characters 3-36
		$x = new ListNode($item, $this->h);
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:70: characters 3-8
		$this->h = $x;
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:71: lines 71-72
		if ($this->q === null) {
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:72: characters 4-9
			$this->q = $x;
		}
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:73: characters 3-11
		$this->length++;
	}


	/**
	 * Removes the first occurrence of `v` in `this` List.
	 * If `v` is found by checking standard equality, it is removed from `this`
	 * List and the function returns true.
	 * Otherwise, false is returned.
	 * 
	 * @param mixed $v
	 * 
	 * @return bool
	 */
	public function remove ($v) {
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:139: characters 3-31
		$prev = null;
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:140: characters 3-13
		$l = $this->h;
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:141: lines 141-154
		while ($l !== null) {
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:142: lines 142-151
			if (Boot::equal($l->item, $v)) {
				#/usr/local/lib/haxe/std/haxe/ds/List.hx:143: lines 143-146
				if ($prev === null) {
					#/usr/local/lib/haxe/std/haxe/ds/List.hx:144: characters 6-16
					$this->h = $l->next;
				} else {
					#/usr/local/lib/haxe/std/haxe/ds/List.hx:146: characters 6-24
					$prev->next = $l->next;
				}
				#/usr/local/lib/haxe/std/haxe/ds/List.hx:147: lines 147-148
				if ($this->q === $l) {
					#/usr/local/lib/haxe/std/haxe/ds/List.hx:148: characters 6-14
					$this->q = $prev;
				}
				#/usr/local/lib/haxe/std/haxe/ds/List.hx:149: characters 5-13
				$this->length--;
				#/usr/local/lib/haxe/std/haxe/ds/List.hx:150: characters 5-16
				return true;
			}
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:152: characters 4-12
			$prev = $l;
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:153: characters 4-14
			$l = $l->next;
		}
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:155: characters 3-15
		return false;
	}


	/**
	 * Returns a string representation of `this` List.
	 * The result is enclosed in { } with the individual elements being
	 * separated by a comma.
	 * 
	 * @return string
	 */
	public function toString () {
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:172: characters 3-27
		$s = new \StringBuf();
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:173: characters 3-20
		$first = true;
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:174: characters 3-13
		$l = $this->h;
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:175: characters 3-13
		$s->add("{");
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:176: lines 176-183
		while ($l !== null) {
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:177: lines 177-180
			if ($first) {
				#/usr/local/lib/haxe/std/haxe/ds/List.hx:178: characters 5-18
				$first = false;
			} else {
				#/usr/local/lib/haxe/std/haxe/ds/List.hx:180: characters 5-16
				$s->add(", ");
			}
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:181: characters 4-29
			$s->add(\Std::string($l->item));
			#/usr/local/lib/haxe/std/haxe/ds/List.hx:182: characters 4-14
			$l = $l->next;
		}
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:184: characters 3-13
		$s->add("}");
		#/usr/local/lib/haxe/std/haxe/ds/List.hx:185: characters 3-22
		return $s->b;
	}


	public function __toString() {
		return $this->toString();
	}
}


Boot::registerClass(List_hx::class, 'haxe.ds.List');
