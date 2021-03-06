<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx
 */

namespace tink\streams;

use \tink\core\Outcome;
use \php\Boot;
use \tink\core\_Future\FutureObject;
use \tink\core\_Future\SyncFuture;
use \tink\core\_Future\Future_Impl_;
use \tink\core\_Lazy\LazyConst;

class StepWise extends StreamBase {
	/**
	 * @param \Closure $item
	 * 
	 * @return FutureObject
	 */
	public function forEach ($item) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:273: lines 273-298
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:274: lines 274-298
		return Future_Impl_::async(function ($cb)  use (&$item, &$_gthis) {
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:275: lines 275-296
			$next = null;
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:275: lines 275-296
			$next = function ()  use (&$item, &$next, &$_gthis, &$cb) {
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:276: lines 276-295
				while (true) {
					unset($touched);
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:277: characters 11-31
					$touched = false;
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:278: lines 278-289
					$_gthis->next()->handle(function ($step)  use (&$item, &$next, &$touched, &$cb) {
						#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:278: lines 278-289
						switch ($step->index) {
							case 0:
								#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:279: characters 23-27
								$data = $step->params[0];
								#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:280: lines 280-284
								if (!$item($data)) {
									#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:281: characters 17-35
									$cb(Outcome::Success(false));
								} else if ($touched) {
									#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:283: characters 30-36
									$next();
								} else {
									#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:284: characters 22-36
									$touched = true;
								}
								break;
							case 1:
								#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:288: characters 15-32
								$cb(Outcome::Success(true));
								break;
							case 2:
								#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:285: characters 23-24
								$e = $step->params[0];
								#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:286: characters 15-29
								$cb(Outcome::Failure($e));
								break;
						}
					});
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:291: lines 291-294
					if (!$touched) {
						#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:292: characters 13-27
						$touched = true;
						#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:293: characters 13-18
						break;
					}
				}
			};
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:275: lines 275-296
			$next1 = $next;
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:297: characters 7-13
			$next1();
		});
	}


	/**
	 * @param \Closure $item
	 * 
	 * @return FutureObject
	 */
	public function forEachAsync ($item) {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:300: lines 300-328
		$_gthis = $this;
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:301: lines 301-327
		return Future_Impl_::async(function ($cb)  use (&$item, &$_gthis) {
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:302: lines 302-325
			$next = null;
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:302: lines 302-325
			$next = function ()  use (&$item, &$next, &$_gthis, &$cb) {
				#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:303: lines 303-324
				while (true) {
					unset($touched);
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:304: characters 11-31
					$touched = false;
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:305: lines 305-318
					$_gthis->next()->handle(function ($step)  use (&$item, &$next, &$touched, &$cb) {
						#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:305: lines 305-318
						switch ($step->index) {
							case 0:
								#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:306: characters 23-27
								$data = $step->params[0];
								#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:307: lines 307-313
								$item($data)->handle(function ($resume)  use (&$next, &$touched, &$cb) {
									#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:308: lines 308-312
									if (!$resume) {
										#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:309: characters 19-37
										$cb(Outcome::Success(false));
									} else if ($touched) {
										#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:311: characters 32-38
										$next();
									} else {
										#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:312: characters 24-38
										$touched = true;
									}
								});
								break;
							case 1:
								#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:317: characters 15-32
								$cb(Outcome::Success(true));
								break;
							case 2:
								#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:314: characters 23-24
								$e = $step->params[0];
								#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:315: characters 15-29
								$cb(Outcome::Failure($e));
								break;
						}
					});
					#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:320: lines 320-323
					if (!$touched) {
						#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:321: characters 13-27
						$touched = true;
						#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:322: characters 13-18
						break;
					}
				}
			};
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:302: lines 302-325
			$next1 = $next;
			#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:326: characters 7-13
			$next1();
		});
	}


	/**
	 * @return FutureObject
	 */
	public function next () {
		#/usr/local/lib/haxe/lib/tink_streams/0,2,1/src/tink/streams/Stream.hx:271: characters 5-28
		return new SyncFuture(new LazyConst(StreamStep::End()));
	}
}


Boot::registerClass(StepWise::class, 'tink.streams.StepWise');
