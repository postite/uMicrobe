<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: src/microbe/tools/PostData.hx
 */

namespace microbe\tools;

use \php\Boot;

class PostData {
	/**
	 * @param mixed $state
	 * 
	 * @return mixed
	 */
	static public function serializeStatePostData ($state) {
		#src/microbe/tools/PostData.hx:8: characters 4-38
		$buf = new \StringBuf();
		#src/microbe/tools/PostData.hx:10: lines 10-33
		$_g = 0;
		#src/microbe/tools/PostData.hx:10: lines 10-33
		$_g1 = \Reflect::fields($state);
		#src/microbe/tools/PostData.hx:10: lines 10-33
		while ($_g < $_g1->length) {
			#src/microbe/tools/PostData.hx:10: characters 9-10
			$a = ($_g1->arr[$_g] ?? null);
			#src/microbe/tools/PostData.hx:10: lines 10-33
			$_g = $_g + 1;
			#src/microbe/tools/PostData.hx:12: characters 13-27
			console->log($a);
			#src/microbe/tools/PostData.hx:13: characters 13-48
			console->log(\Reflect::field($state, $a));
			#src/microbe/tools/PostData.hx:14: characters 13-61
			console->log(\Type::typeof(\Reflect::field($state, $a)));
			#src/microbe/tools/PostData.hx:16: characters 5-36
			$val = \Reflect::field($state, $a);
			#src/microbe/tools/PostData.hx:17: characters 5-32
			if ($a === "__postData") {
				#src/microbe/tools/PostData.hx:17: characters 24-32
				continue;
			}
			#src/microbe/tools/PostData.hx:18: lines 18-28
			if (($val instanceof \Array_hx)) {
				#src/microbe/tools/PostData.hx:20: characters 15-41
				console->log("isaArray " . ($a??'null'));
				#src/microbe/tools/PostData.hx:22: characters 18-46
				$it = $val->iterator();
				#src/microbe/tools/PostData.hx:22: characters 18-46
				while ($it->hasNext()) {
					#src/microbe/tools/PostData.hx:22: lines 22-26
					$it1 = $it->next();
					#src/microbe/tools/PostData.hx:23: characters 7-23
					$p = $it1;
					#src/microbe/tools/PostData.hx:24: characters 6-33
					$_a = ($a??'null') . "=" . (rawurlencode($p)??'null');
					#src/microbe/tools/PostData.hx:25: characters 4-19
					$buf->add(($_a??'null') . "&");
				}

				#src/microbe/tools/PostData.hx:27: characters 6-14
				continue;
			}
			#src/microbe/tools/PostData.hx:29: characters 5-41
			$p1 = \Reflect::field($state, $a);
			#src/microbe/tools/PostData.hx:30: characters 5-32
			$_a1 = ($a??'null') . "=" . (rawurlencode($p1)??'null');
			#src/microbe/tools/PostData.hx:31: characters 3-18
			$buf->add(($_a1??'null') . "&");
		}

		#src/microbe/tools/PostData.hx:35: characters 4-55
		\Reflect::setField($state, "__postData", $buf->b);
		#src/microbe/tools/PostData.hx:38: characters 4-16
		return $state;
	}
}


Boot::registerClass(PostData::class, 'microbe.tools.PostData');
