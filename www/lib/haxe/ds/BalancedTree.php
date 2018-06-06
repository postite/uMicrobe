<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx
 */

namespace haxe\ds;

use \haxe\IMap;
use \php\Boot;
use \php\_Boot\HxException;
use \haxe\CallStack;

/**
 * BalancedTree allows key-value mapping with arbitrary keys, as long as they
 * can be ordered. By default, `Reflect.compare` is used in the `compare`
 * method, which can be overridden in subclasses.
 * Operations have a logarithmic average and worst-case cost.
 * Iteration over keys and values, using `keys` and `iterator` respectively,
 * are in-order.
 */
class BalancedTree implements IMap {
	/**
	 * @var TreeNode
	 */
	public $root;


	/**
	 * Creates a new BalancedTree, which is initially empty.
	 * 
	 * @return void
	 */
	public function __construct () {
	}


	/**
	 * @param TreeNode $l
	 * @param mixed $k
	 * @param mixed $v
	 * @param TreeNode $r
	 * 
	 * @return TreeNode
	 */
	public function balance ($l, $k, $v, $r) {
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:194: characters 3-27
		$hl = ($l === null ? 0 : $l->_height);
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:195: characters 3-27
		$hr = ($r === null ? 0 : $r->_height);
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:196: lines 196-204
		if ($hl > ($hr + 2)) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:197: characters 8-27
			$_this = $l->left;
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:197: characters 31-51
			$_this1 = $l->right;
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:197: lines 197-198
			if ((($_this === null ? 0 : $_this->_height)) >= (($_this1 === null ? 0 : $_this1->_height))) {
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:197: characters 71-77
				$l1 = $l->left;
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:197: characters 79-84
				$l2 = $l->key;
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:197: characters 86-93
				$l3 = $l->value;
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:197: characters 53-131
				return new TreeNode($l1, $l2, $l3, new TreeNode($l->right, $k, $v, $r));
			} else {
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:198: characters 27-81
				$tmp = new TreeNode($l->left, $l->key, $l->value, $l->right->left);
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:198: characters 83-94
				$l4 = $l->right->key;
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:198: characters 96-109
				$l5 = $l->right->value;
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:198: characters 9-153
				return new TreeNode($tmp, $l4, $l5, new TreeNode($l->right->right, $k, $v, $r));
			}
		} else if ($hr > ($hl + 2)) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:200: characters 8-28
			$_this2 = $r->right;
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:200: characters 31-50
			$_this3 = $r->left;
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:200: lines 200-201
			if ((($_this2 === null ? 0 : $_this2->_height)) > (($_this3 === null ? 0 : $_this3->_height))) {
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:200: characters 52-130
				return new TreeNode(new TreeNode($l, $k, $v, $r->left), $r->key, $r->value, $r->right);
			} else {
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:201: characters 27-66
				$tmp1 = new TreeNode($l, $k, $v, $r->left->left);
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:201: characters 68-78
				$r1 = $r->left->key;
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:201: characters 80-92
				$r2 = $r->left->value;
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:201: characters 9-151
				return new TreeNode($tmp1, $r1, $r2, new TreeNode($r->left->right, $r->key, $r->value, $r->right));
			}
		} else {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:203: characters 4-58
			return new TreeNode($l, $k, $v, $r, (($hl > $hr ? $hl : $hr)) + 1);
		}
	}


	/**
	 * @param mixed $k1
	 * @param mixed $k2
	 * 
	 * @return int
	 */
	public function compare ($k1, $k2) {
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:208: characters 3-33
		return \Reflect::compare($k1, $k2);
	}


	/**
	 * @return BalancedTree
	 */
	public function copy () {
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:133: characters 3-41
		$copied = new BalancedTree();
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:134: characters 3-21
		$copied->root = $this->root;
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:135: characters 3-16
		return $copied;
	}


	/**
	 * Tells if `key` is bound to a value.
	 * This method returns true even if `key` is bound to null.
	 * If `key` is null, the result is unspecified.
	 * 
	 * @param mixed $key
	 * 
	 * @return bool
	 */
	public function exists ($key) {
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:100: characters 3-19
		$node = $this->root;
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:101: lines 101-106
		while ($node !== null) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:102: characters 4-35
			$c = $this->compare($key, $node->key);
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:103: lines 103-105
			if ($c === 0) {
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:103: characters 16-27
				return true;
			} else if ($c < 0) {
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:104: characters 20-36
				$node = $node->left;
			} else {
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:105: characters 9-26
				$node = $node->right;
			}
		}
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:107: characters 3-15
		return false;
	}


	/**
	 * Returns the value `key` is bound to.
	 * If `key` is not bound to any value, `null` is returned.
	 * If `key` is null, the result is unspecified.
	 * 
	 * @param mixed $key
	 * 
	 * @return mixed
	 */
	public function get ($key) {
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:62: characters 3-19
		$node = $this->root;
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:63: lines 63-68
		while ($node !== null) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:64: characters 4-35
			$c = $this->compare($key, $node->key);
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:65: characters 4-33
			if ($c === 0) {
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:65: characters 16-33
				return $node->value;
			}
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:66: lines 66-67
			if ($c < 0) {
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:66: characters 15-31
				$node = $node->left;
			} else {
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:67: characters 9-26
				$node = $node->right;
			}
		}
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:69: characters 3-14
		return null;
	}


	/**
	 * Iterates over the bound values of `this` BalancedTree.
	 * This operation is performed in-order.
	 * 
	 * @return object
	 */
	public function iterator () {
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:116: characters 3-16
		$ret = new \Array_hx();
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:117: characters 3-26
		$this->iteratorLoop($this->root, $ret);
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:118: characters 3-24
		return $ret->iterator();
	}


	/**
	 * @param TreeNode $node
	 * @param \Array_hx $acc
	 * 
	 * @return void
	 */
	public function iteratorLoop ($node, $acc) {
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:160: lines 160-164
		if ($node !== null) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:161: characters 4-32
			$this->iteratorLoop($node->left, $acc);
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:162: characters 4-24
			$acc->arr[$acc->length] = $node->value;
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:162: characters 4-24
			++$acc->length;

			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:163: characters 4-33
			$this->iteratorLoop($node->right, $acc);
		}
	}


	/**
	 * Iterates over the keys of `this` BalancedTree.
	 * This operation is performed in-order.
	 * 
	 * @return object
	 */
	public function keys () {
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:127: characters 3-16
		$ret = new \Array_hx();
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:128: characters 3-22
		$this->keysLoop($this->root, $ret);
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:129: characters 3-24
		return $ret->iterator();
	}


	/**
	 * @param TreeNode $node
	 * @param \Array_hx $acc
	 * 
	 * @return void
	 */
	public function keysLoop ($node, $acc) {
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:168: lines 168-172
		if ($node !== null) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:169: characters 4-28
			$this->keysLoop($node->left, $acc);
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:170: characters 4-22
			$acc->arr[$acc->length] = $node->key;
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:170: characters 4-22
			++$acc->length;

			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:171: characters 4-29
			$this->keysLoop($node->right, $acc);
		}
	}


	/**
	 * @param TreeNode $t1
	 * @param TreeNode $t2
	 * 
	 * @return TreeNode
	 */
	public function merge ($t1, $t2) {
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:176: characters 3-28
		if ($t1 === null) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:176: characters 19-28
			return $t2;
		}
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:177: characters 3-28
		if ($t2 === null) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:177: characters 19-28
			return $t1;
		}
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:178: characters 3-26
		$t = $this->minBinding($t2);
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:179: characters 3-59
		return $this->balance($t1, $t->key, $t->value, $this->removeMinBinding($t2));
	}


	/**
	 * @param TreeNode $t
	 * 
	 * @return TreeNode
	 */
	public function minBinding ($t) {
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:183: lines 183-185
		if ($t === null) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:183: characters 25-30
			throw new HxException("Not_found");
		} else if ($t->left === null) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:184: characters 28-29
			return $t;
		} else {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:185: characters 8-26
			return $this->minBinding($t->left);
		}
	}


	/**
	 * Removes the current binding of `key`.
	 * If `key` has no binding, `this` BalancedTree is unchanged and false is
	 * returned.
	 * Otherwise the binding of `key` is removed and true is returned.
	 * If `key` is null, the result is unspecified.
	 * 
	 * @param mixed $key
	 * 
	 * @return bool
	 */
	public function remove ($key) {
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:83: lines 83-89
		try {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:84: characters 4-32
			$this->root = $this->removeLoop($key, $this->root);
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:85: characters 4-15
			return true;
		} catch (\Throwable $__hx__caught_e) {
			CallStack::saveExceptionTrace($__hx__caught_e);
			$__hx__real_e = ($__hx__caught_e instanceof HxException ? $__hx__caught_e->e : $__hx__caught_e);
			if (is_string($__hx__real_e)) {
				$e = $__hx__real_e;
				#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:88: characters 4-16
				return false;
			} else  throw $__hx__caught_e;
		}
	}


	/**
	 * @param mixed $k
	 * @param TreeNode $node
	 * 
	 * @return TreeNode
	 */
	public function removeLoop ($k, $node) {
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:152: characters 3-26
		if ($node === null) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:152: characters 21-26
			throw new HxException("Not_found");
		}
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:153: characters 3-32
		$c = $this->compare($k, $node->key);
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:154: lines 154-156
		if ($c === 0) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:154: characters 22-50
			return $this->merge($node->left, $node->right);
		} else if ($c < 0) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:155: characters 19-86
			return $this->balance($this->removeLoop($k, $node->left), $node->key, $node->value, $node->right);
		} else {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:156: characters 8-75
			return $this->balance($node->left, $node->key, $node->value, $this->removeLoop($k, $node->right));
		}
	}


	/**
	 * @param TreeNode $t
	 * 
	 * @return TreeNode
	 */
	public function removeMinBinding ($t) {
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:189: lines 189-190
		if ($t->left === null) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:189: characters 30-37
			return $t->right;
		} else {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:190: characters 8-66
			return $this->balance($this->removeMinBinding($t->left), $t->key, $t->value, $t->right);
		}
	}


	/**
	 * Binds `key` to `value`.
	 * If `key` is already bound to a value, that binding disappears.
	 * If `key` is null, the result is unspecified.
	 * 
	 * @param mixed $key
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public function set ($key, $value) {
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:51: characters 3-35
		$this->root = $this->setLoop($key, $value, $this->root);
	}


	/**
	 * @param mixed $k
	 * @param mixed $v
	 * @param TreeNode $node
	 * 
	 * @return TreeNode
	 */
	public function setLoop ($k, $v, $node) {
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:139: characters 3-63
		if ($node === null) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:139: characters 21-63
			return new TreeNode(null, $k, $v, null);
		}
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:140: characters 3-32
		$c = $this->compare($k, $node->key);
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:141: lines 141-148
		if ($c === 0) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:141: characters 22-87
			return new TreeNode($node->left, $k, $v, $node->right, ($node === null ? 0 : $node->_height));
		} else if ($c < 0) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:143: characters 4-38
			$nl = $this->setLoop($k, $v, $node->left);
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:144: characters 4-49
			return $this->balance($nl, $node->key, $node->value, $node->right);
		} else {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:146: characters 4-39
			$nr = $this->setLoop($k, $v, $node->right);
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:147: characters 4-48
			return $this->balance($node->left, $node->key, $node->value, $nr);
		}
	}


	/**
	 * @return string
	 */
	public function toString () {
		#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:212: characters 10-54
		if ($this->root === null) {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:212: characters 26-28
			return "{}";
		} else {
			#/usr/local/lib/haxe/std/haxe/ds/BalancedTree.hx:212: characters 33-53
			return "{" . ($this->root->toString()??'null') . "}";
		}
	}


	public function __toString() {
		return $this->toString();
	}
}


Boot::registerClass(BalancedTree::class, 'haxe.ds.BalancedTree');