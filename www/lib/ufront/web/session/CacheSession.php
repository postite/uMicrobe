<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx
 */

namespace ufront\web\session;

use \ufront\core\SurpriseTools;
use \ufront\log\MessageType;
use \tink\core\Outcome;
use \ufront\web\context\HttpContext;
use \haxe\ds\StringMap;
use \ufront\cache\UFCache;
use \php\Boot;
use \php\_Boot\HxException;
use \tink\core\TypedError;
use \tink\core\_Future\FutureObject;
use \tink\core\_Future\SyncFuture;
use \tink\core\_Future\Future_Impl_;
use \ufront\web\HttpCookie;
use \ufront\cache\UFCacheConnection;
use \ufront\core\Uuid;
use \tink\core\Noise;
use \ufront\core\_MultiValueMap\MultiValueMap_Impl_;
use \tink\core\_Lazy\LazyConst;
use \php\_Boot\HxAnon;
use \ufront\web\HttpError;

/**
 * A session implementation that works with any `UFCache` implementation.
 * A `UFCache` can store data in memory, a database, a cache mechanism such as Redis, flat-files, or anything.
 * So `CacheSession` is a versatile way for you to have a session implementation with any cache engine.
 * A `UFCacheConnection` is injected, and we use the `this.savePath` variable as the cache namespace.
 * The session ID is used as the cache item ID.
 * The contents of the session are saved to the cache, and restored from the cache, for each request.
 * This will change depending on the `UFCache` implementation used.
 * For example, `MemoryCache` will merely store the session data in a `Map` in memory, and access it directly.
 * A `DBCache` on the other hand will save the session data to a database table using `SData` type, and so the data must serialize easily.
 * The session ID is sent to the client as a `HttpCookie`.
 * When reading the session ID, `HttpRequest.cookies` is checked first, followed by `HttpRequest.params`.
 * When searching the parameters or cookies for the Session ID, the name to search for is defined by the `this.sessionName` property.
 */
class CacheSession implements UFHttpSession {
	/**
	 * @var int
	 * The default expiry value.
	 * The default value is 0 (meaning the session will expire when the window is closed).
	 * You can change the default by changing this static variable.
	 */
	static public $defaultExpiry = 0;
	/**
	 * @var string
	 * The default savePath to use if none is provided by the injector.
	 * This name will be used as the namespace for the `UFCacheConnection`.
	 * The default value is "sessions".
	 * You can change this static value to set a new default.
	 */
	static public $defaultSavePath = "sessions";
	/**
	 * @var string
	 * The default session name to use if none is provided by the injector.
	 * The default value is `UfrontSessionID`.
	 * You can change this static variable to set a new default.
	 */
	static public $defaultSessionName = "UfrontSessionID";


	/**
	 * @var UFCache
	 */
	public $cache;
	/**
	 * @var bool
	 */
	public $closeFlag;
	/**
	 * @var bool
	 */
	public $commitFlag;
	/**
	 * @var HttpContext
	 * The current `HttpContext`.
	 * Supplied by dependency injection.
	 */
	public $context;
	/**
	 * @var int
	 * The lifetime / expiry of the cookie, in seconds.
	 * - A positive value sets the cookie to expire that many seconds from the current time.
	 * - A value of 0 represents expiry when the browser window is closed.
	 * - A negative value expires the cookie immediately.
	 * This is set by injecting an `Int` named `sessionExpiry`, otherwise the default `CacheSession.defaultExpiry` value is used.
	 */
	public $expiry;
	/**
	 * @var bool
	 */
	public $expiryFlag;
	/**
	 * @var string
	 */
	public $oldSessionID;
	/**
	 * @var bool
	 */
	public $regenerateFlag;
	/**
	 * @var string
	 * The save path for the session files.
	 * This is used with `UFCacheConnection.getNamespace()` to retrieve the appropriate cache.
	 * This is set by injecting a `String` named `sessionSavePath`, otherwise the default `CacheSession.defaultSavePath` value is used.
	 */
	public $savePath;
	/**
	 * @var StringMap
	 */
	public $sessionData;
	/**
	 * @var string
	 */
	public $sessionID;
	/**
	 * @var string
	 * The name of the cookie (or request parameter) that holds the session ID.
	 * This is set by injecting a `String` named `sessionName`, otherwise the default `CacheSession.defaultSessionName` value is used.
	 */
	public $sessionName;
	/**
	 * @var bool
	 */
	public $started;


	/**
	 * @param string $id
	 * 
	 * @return bool
	 */
	static public function isValidID ($id) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:62: characters 10-42
		if ($id !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:62: characters 24-40
			return Uuid::isValid($id);
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:62: characters 10-42
			return false;
		}
	}


	/**
	 * Construct a new session object.
	 * This does not initialize the cache or read any data.
	 * Data is read during `this.init()` and written during `this.commit()`, both of which require asynchronous handling.
	 * A new session object should be created for each request, and it will then associate itself with the correct session entry for the given client.
	 * In general you should create your object using dependency injection to make sure it is initialised correctly.
	 * 
	 * @return void
	 */
	public function __construct () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:133: characters 3-18
		$this->started = false;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:134: characters 3-21
		$this->commitFlag = false;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:135: characters 3-20
		$this->closeFlag = false;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:136: characters 3-25
		$this->regenerateFlag = false;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:137: characters 3-21
		$this->expiryFlag = false;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:138: characters 3-21
		$this->sessionData = null;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:139: characters 3-19
		$this->sessionID = null;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:140: characters 3-22
		$this->oldSessionID = null;
	}


	/**
	 * @param object $pos
	 * 
	 * @return void
	 */
	public function checkStarted ($pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:427: lines 427-428
		if (!$this->started) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:428: characters 4-9
			throw new HxException(HttpError::internalServerError("Trying to access session data before calling init()", $pos, new HxAnon([
				"fileName" => "ufront/web/session/CacheSession.hx",
				"lineNumber" => 428,
				"className" => "ufront.web.session.CacheSession",
				"methodName" => "checkStarted",
			])));
		}
	}


	/**
	 * Empty all items from the current session data without closing the session.
	 * 
	 * @return void
	 */
	public function clear () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:366: lines 366-369
		if (($this->sessionData !== null) && ($this->started || ($this->get_id() !== null))) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:367: characters 4-42
			$this->sessionData = new StringMap();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:368: characters 4-21
			$this->commitFlag = true;
		}
	}


	/**
	 * Close the session.
	 * The sessionData and sessionID will be set to null, and the session will be flagged for deletion (when `this.commit` is called)
	 * 
	 * @return void
	 */
	public function close () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:411: characters 3-17
		if (!$this->started) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:411: characters 3-17
			throw new HxException(HttpError::internalServerError("Trying to access session data before calling init()", new HxAnon([
				"fileName" => "ufront/web/session/CacheSession.hx",
				"lineNumber" => 411,
				"className" => "ufront.web.session.CacheSession",
				"methodName" => "close",
			]), new HxAnon([
				"fileName" => "ufront/web/session/CacheSession.hx",
				"lineNumber" => 428,
				"className" => "ufront.web.session.CacheSession",
				"methodName" => "checkStarted",
			])));
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:412: characters 3-21
		$this->sessionData = null;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:413: characters 3-19
		$this->closeFlag = true;
	}


	/**
	 * Commit if required.
	 * Returns an Outcome, which is a Failure if the commit failed.
	 * 
	 * @return FutureObject
	 */
	public function commit () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:237: lines 237-280
		$_gthis = $this;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:239: characters 3-32
		$oldSessionID = $this->sessionID;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:240: lines 240-242
		$sessionIDSurprise = (($this->sessionID === null) || $this->regenerateFlag ? $this->findNewSessionID() : new SyncFuture(new LazyConst(Outcome::Success($this->sessionID))));
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:244: lines 244-278
		return Future_Impl_::_tryFailingFlatMap(Future_Impl_::_tryMap(Future_Impl_::_tryFailingFlatMap(Future_Impl_::_tryFailingFlatMap(Future_Impl_::_tryMap($sessionIDSurprise, function ($id)  use (&$_gthis) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:247: characters 5-24
			$_gthis->sessionID = $id;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:248: characters 5-17
			return Noise::Noise();
		}), function ($_)  use (&$_gthis, &$oldSessionID) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:251: lines 251-257
			if ($_gthis->regenerateFlag) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:253: characters 6-23
				$_gthis->commitFlag = true;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:255: lines 255-256
				if ($oldSessionID !== null) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:255: characters 33-84
					return SurpriseTools::changeFailureToError($_gthis->cache->remove($oldSessionID), null, new HxAnon([
						"fileName" => "ufront/web/session/CacheSession.hx",
						"lineNumber" => 255,
						"className" => "ufront.web.session.CacheSession",
						"methodName" => "commit",
					]));
				} else {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:256: characters 12-35
					return SurpriseTools::success();
				}
			}
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:258: characters 12-41
			return new SyncFuture(new LazyConst(Outcome::Success(Noise::Noise())));
		}), function ($_1)  use (&$_gthis) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:261: lines 261-263
			if ($_gthis->commitFlag && ($_gthis->sessionData !== null)) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:262: characters 13-18
				$_gthis1 = $_gthis->cache;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:262: characters 24-33
				$_gthis2 = $_gthis->sessionID;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:262: characters 35-46
				$this1 = new SyncFuture(new LazyConst($_gthis->sessionData));
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:262: characters 6-94
				return SurpriseTools::changeFailureToError(SurpriseTools::changeSuccessTo($_gthis1->set($_gthis2, $this1), Noise::Noise()), null, new HxAnon([
					"fileName" => "ufront/web/session/CacheSession.hx",
					"lineNumber" => 262,
					"className" => "ufront.web.session.CacheSession",
					"methodName" => "commit",
				]));
			}
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:264: characters 12-41
			return new SyncFuture(new LazyConst(Outcome::Success(Noise::Noise())));
		}), function ($_2)  use (&$_gthis) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:267: lines 267-269
			if ($_gthis->expiryFlag && !$_gthis->closeFlag) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:268: characters 6-36
				$_gthis->setCookie($_gthis->sessionID, $_gthis->expiry);
			}
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:270: characters 5-17
			return Noise::Noise();
		}), function ($_3)  use (&$_gthis) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:273: lines 273-276
			if ($_gthis->closeFlag) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:274: characters 6-25
				$_gthis->setCookie("", -1);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:275: characters 6-61
				return SurpriseTools::changeFailureToError($_gthis->cache->remove($_gthis->sessionID), null, new HxAnon([
					"fileName" => "ufront/web/session/CacheSession.hx",
					"lineNumber" => 275,
					"className" => "ufront.web.session.CacheSession",
					"methodName" => "commit",
				]));
			}
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:277: characters 12-41
			return new SyncFuture(new LazyConst(Outcome::Success(Noise::Noise())));
		});
	}


	/**
	 * Check if a session has the specified item.
	 * This will throw an error if `this.init()` has not already been called.
	 * 
	 * @param string $name
	 * 
	 * @return bool
	 */
	public function exists ($name) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:345: characters 3-17
		if (!$this->started) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:345: characters 3-17
			throw new HxException(HttpError::internalServerError("Trying to access session data before calling init()", new HxAnon([
				"fileName" => "ufront/web/session/CacheSession.hx",
				"lineNumber" => 345,
				"className" => "ufront.web.session.CacheSession",
				"methodName" => "exists",
			]), new HxAnon([
				"fileName" => "ufront/web/session/CacheSession.hx",
				"lineNumber" => 428,
				"className" => "ufront.web.session.CacheSession",
				"methodName" => "checkStarted",
			])));
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:346: characters 10-57
		if ($this->sessionData !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:346: characters 31-57
			return array_key_exists($name, $this->sessionData->data);
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:346: characters 10-57
			return false;
		}
	}


	/**
	 * @return FutureObject
	 */
	public function findNewSessionID () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:282: lines 282-300
		$_gthis = $this;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:283: characters 3-35
		$tryID = Uuid::create();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:284: lines 284-299
		$ret = $this->cache->get($tryID)->flatMap(function ($outcome)  use (&$tryID, &$_gthis) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:285: lines 285-298
			switch ($outcome->index) {
				case 0:
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:286: characters 18-25
					$outcome1 = $outcome->params[0];
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:288: characters 6-31
					return $_gthis->findNewSessionID();
					break;
				case 1:
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:285: characters 18-25
					if ($outcome->params[0]->index === 0) {
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:291: characters 6-37
						$_gthis->setCookie($tryID, $_gthis->expiry);
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:292: characters 13-18
						$_gthis1 = $_gthis->cache;
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:292: characters 31-46
						$this1 = new SyncFuture(new LazyConst(new StringMap()));
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:292: lines 292-295
						$ret1 = $_gthis1->set($tryID, $this1)->map(function ($outcome2)  use (&$tryID) {
							#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:292: lines 292-295
							switch ($outcome2->index) {
								case 0:
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:293: characters 24-45
									return Outcome::Success($tryID);
									break;
								case 1:
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:294: characters 20-23
									$err = $outcome2->params[0];
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:294: characters 26-101
									return Outcome::Failure(TypedError::withData(null, "Failed to reserve session ID " . ($tryID??'null'), $err, new HxAnon([
										"fileName" => "ufront/web/session/CacheSession.hx",
										"lineNumber" => 294,
										"className" => "ufront.web.session.CacheSession",
										"methodName" => "findNewSessionID",
									])));
									break;
							}
						});
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:292: lines 292-295
						return $ret1->gather();
					} else {
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:296: characters 18-19
						$e = $outcome->params[0];
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:297: characters 13-99
						return new SyncFuture(new LazyConst(Outcome::Failure(TypedError::withData(null, "Failed to find new session ID, cache error", $e, new HxAnon([
							"fileName" => "ufront/web/session/CacheSession.hx",
							"lineNumber" => 297,
							"className" => "ufront.web.session.CacheSession",
							"methodName" => "findNewSessionID",
						])))));
					}
					break;
			}
		});
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:284: lines 284-299
		return $ret->gather();
	}


	/**
	 * @return string
	 */
	public function generateSessionID () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:423: characters 3-23
		return Uuid::create();
	}


	/**
	 * Retrieve an item from the session data.
	 * This will throw an error if `this.init()` has not already been called.
	 * 
	 * @param string $name
	 * 
	 * @return mixed
	 */
	public function get ($name) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:320: characters 3-17
		if (!$this->started) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:320: characters 3-17
			throw new HxException(HttpError::internalServerError("Trying to access session data before calling init()", new HxAnon([
				"fileName" => "ufront/web/session/CacheSession.hx",
				"lineNumber" => 320,
				"className" => "ufront.web.session.CacheSession",
				"methodName" => "get",
			]), new HxAnon([
				"fileName" => "ufront/web/session/CacheSession.hx",
				"lineNumber" => 428,
				"className" => "ufront.web.session.CacheSession",
				"methodName" => "checkStarted",
			])));
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:321: characters 10-60
		if ($this->sessionData !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:321: characters 30-53
			return ($this->sessionData->data[$name] ?? null);
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:321: characters 56-60
			return null;
		}
	}


	/**
	 * Return the current ID, either one that has been set during `this.init()`, or one found in either `HttpRequest.cookies` or `HttpRequest.params`.
	 * 
	 * @return string
	 */
	public function get_id () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:400: characters 3-74
		if ($this->sessionID === null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:400: characters 26-74
			$this->sessionID = MultiValueMap_Impl_::get($this->context->request->get_cookies(), $this->sessionName);
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:401: characters 3-73
		if ($this->sessionID === null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:401: characters 26-73
			$this->sessionID = MultiValueMap_Impl_::get($this->context->request->get_params(), $this->sessionName);
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:402: characters 3-19
		return $this->sessionID;
	}


	/**
	 * Initiate the session.
	 * This will check for an existing session ID.
	 * If one exists, it will read and fetch the session data from that session's cache item.
	 * If a session does not exist, one will be created, including generating and reserving a new session ID.
	 * This must be called before any other operations which require access to the current session.
	 * 
	 * @return FutureObject
	 */
	public function init () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:191: lines 191-230
		$_gthis = $this;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:192: lines 192-197
		$startFreshSession = function ()  use (&$_gthis) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:193: characters 4-23
			$_gthis->regenerateID();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:194: characters 4-38
			$_gthis->sessionData = new StringMap();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:195: characters 4-23
			$_gthis->started = true;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:196: characters 4-25
			return Outcome::Success(Noise::Noise());
		};
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:199: lines 199-229
		if (!$this->started) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:200: characters 4-12
			$this->get_id();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:201: characters 9-49
			$tmp = null;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:201: characters 9-49
			if ($this->sessionID !== null) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:201: characters 29-49
				$id = $this->sessionID;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:201: characters 9-49
				$tmp = !(($id !== null) && Uuid::isValid($id));
			} else {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:201: characters 9-49
				$tmp = true;
			}
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:201: lines 201-227
			if ($tmp) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:202: characters 5-44
				return SurpriseTools::asSurprise($startFreshSession());
			} else {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:205: lines 205-226
				$ret = $this->cache->get($this->sessionID)->map(function ($outcome)  use (&$startFreshSession, &$_gthis) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:206: lines 206-225
					switch ($outcome->index) {
						case 0:
							#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:207: characters 20-24
							$data = $outcome->params[0];
							#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:208: characters 27-58
							$ret1 = (($data instanceof StringMap) ? $data : null);
							#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:208: characters 8-58
							$_gthis->sessionData = $ret1;
							#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:209: lines 209-216
							if ($_gthis->sessionData !== null) {
								#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:210: characters 9-28
								$_gthis->started = true;
								#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:211: characters 9-30
								return Outcome::Success(Noise::Noise());
							} else {
								#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:214: characters 9-151
								$_this = $_gthis->context;
								#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:214: characters 9-151
								$msg = "Failed to unserialize session " . ($_gthis->sessionID??'null') . " (Was " . (\Std::string(\Type::typeof($data))??'null') . ", expected StringMap), starting a fresh session instead.";
								#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:214: characters 9-151
								$_this1 = $_this->messages;
								#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:214: characters 9-151
								$_this1->arr[$_this1->length] = new HxAnon([
									"msg" => $msg,
									"pos" => new HxAnon([
										"fileName" => "ufront/web/session/CacheSession.hx",
										"lineNumber" => 214,
										"className" => "ufront.web.session.CacheSession",
										"methodName" => "init",
									]),
									"type" => MessageType::MWarning(),
								]);
								#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:214: characters 9-151
								++$_this1->length;


								#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:215: characters 9-35
								return $startFreshSession();
							}
							break;
						case 1:
							#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:206: characters 13-20
							switch ($outcome->params[0]->index) {
								case 0:
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:218: characters 8-133
									$_this2 = $_gthis->context->messages;
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:218: characters 8-133
									$_this2->arr[$_this2->length] = new HxAnon([
										"msg" => "Client requested session " . ($_gthis->sessionID??'null') . ", but it did not exist in the cache. Starting a fresh session instead.",
										"pos" => new HxAnon([
											"fileName" => "ufront/web/session/CacheSession.hx",
											"lineNumber" => 218,
											"className" => "ufront.web.session.CacheSession",
											"methodName" => "init",
										]),
										"type" => MessageType::MWarning(),
									]);
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:218: characters 8-133
									++$_this2->length;

									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:219: characters 8-34
									return $startFreshSession();
									break;
								case 2:
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:220: characters 38-41
									$msg1 = $outcome->params[0]->params[0];
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:221: characters 8-112
									$_this3 = $_gthis->context->messages;
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:221: characters 8-112
									$_this3->arr[$_this3->length] = new HxAnon([
										"msg" => "Failed to read cache for session " . ($_gthis->sessionID??'null') . ": " . ($msg1??'null') . ". Starting a fresh session instead.",
										"pos" => new HxAnon([
											"fileName" => "ufront/web/session/CacheSession.hx",
											"lineNumber" => 221,
											"className" => "ufront.web.session.CacheSession",
											"methodName" => "init",
										]),
										"type" => MessageType::MWarning(),
									]);
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:221: characters 8-112
									++$_this3->length;

									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:222: characters 8-34
									return $startFreshSession();
									break;
								default:
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:223: characters 20-25
									$error = $outcome->params[0];
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:224: characters 8-78
									return Outcome::Failure(TypedError::withData(null, "Failed to initialize session", $error, new HxAnon([
										"fileName" => "ufront/web/session/CacheSession.hx",
										"lineNumber" => 224,
										"className" => "ufront.web.session.CacheSession",
										"methodName" => "init",
									])));
									break;
							}
							break;
					}
				});
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:205: lines 205-226
				return $ret->gather();
			}
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:229: characters 15-44
			return new SyncFuture(new LazyConst(Outcome::Success(Noise::Noise())));
		}
	}


	/**
	 * Use the current injector to check for configuration for this session: `this.sessionName`, `this.expiry` and `this.savePath`.
	 * If no values are available in the injector, the defaults will be used.
	 * This also initialises a cache from the supplied `cacheConnection` using `this.savePath` as the namespace.
	 * This will be called automatically as part of dependency injection.
	 * 
	 * @param HttpContext $context
	 * @param UFCacheConnection $cacheConnection
	 * 
	 * @return void
	 */
	public function injectConfig ($context, $cacheConnection) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:152: characters 3-25
		$this->context = $context;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:153: lines 153-156
		$this->sessionName = ($context->injector->hasMappingForType("String", "sessionName") ? $context->injector->getValueForType("String", "sessionName") : CacheSession::$defaultSessionName);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:157: lines 157-160
		$this->expiry = ($context->injector->hasMappingForType("Int", "sessionExpiry") ? $context->injector->getValueForType("Int", "sessionExpiry") : CacheSession::$defaultExpiry);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:161: lines 161-164
		$this->savePath = ($context->injector->hasMappingForType("String", "sessionSavePath") ? $context->injector->getValueForType("String", "sessionSavePath") : CacheSession::$defaultSavePath);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:166: lines 166-167
		$tmp = null;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:166: lines 166-167
		if ($cacheConnection === null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:166: characters 33-38
			throw new HxException(HttpError::internalServerError("No UFCacheConnection was injected into CacheSession", null, new HxAnon([
				"fileName" => "ufront/web/session/CacheSession.hx",
				"lineNumber" => 166,
				"className" => "ufront.web.session.CacheSession",
				"methodName" => "injectConfig",
			])));
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:166: lines 166-167
			$tmp = $cacheConnection->getNamespace($this->savePath);
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:165: lines 165-167
		$this->cache = $tmp;
	}


	/**
	 * Return whether or not the session is active, meaning it has been initialised either in this request or in a previous request.
	 * 
	 * @return bool
	 */
	public function isActive () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:388: characters 10-35
		if (!$this->started) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:388: characters 21-35
			return $this->get_id() !== null;
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:388: characters 10-35
			return true;
		}
	}


	/**
	 * Return whether or not the session is ready to use (has been initialised).
	 * 
	 * @return bool
	 */
	public function isReady () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:393: characters 3-17
		return $this->started;
	}


	/**
	 * Trigger a regeneration of the session ID when `this.commit` is called.
	 * 
	 * @return void
	 */
	public function regenerateID () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:383: characters 3-24
		$this->regenerateFlag = true;
	}


	/**
	 * Remove an item from the session.
	 * This will throw an error if `this.init()` has not already been called.
	 * 
	 * @param string $name
	 * 
	 * @return void
	 */
	public function remove ($name) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:355: characters 3-17
		if (!$this->started) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:355: characters 3-17
			throw new HxException(HttpError::internalServerError("Trying to access session data before calling init()", new HxAnon([
				"fileName" => "ufront/web/session/CacheSession.hx",
				"lineNumber" => 355,
				"className" => "ufront.web.session.CacheSession",
				"methodName" => "remove",
			]), new HxAnon([
				"fileName" => "ufront/web/session/CacheSession.hx",
				"lineNumber" => 428,
				"className" => "ufront.web.session.CacheSession",
				"methodName" => "checkStarted",
			])));
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:356: lines 356-359
		if ($this->sessionData !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:357: characters 4-28
			$this->sessionData->remove($name);
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:358: characters 4-21
			$this->commitFlag = true;
		}
	}


	/**
	 * Set an item in the session data.
	 * Note this will not commit the value to our cache until `this.commit()` is called.
	 * This will throw an error if `this.init()` has not already been called.
	 * 
	 * @param string $name
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public function set ($name, $value) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:332: characters 3-17
		if (!$this->started) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:332: characters 3-17
			throw new HxException(HttpError::internalServerError("Trying to access session data before calling init()", new HxAnon([
				"fileName" => "ufront/web/session/CacheSession.hx",
				"lineNumber" => 332,
				"className" => "ufront.web.session.CacheSession",
				"methodName" => "set",
			]), new HxAnon([
				"fileName" => "ufront/web/session/CacheSession.hx",
				"lineNumber" => 428,
				"className" => "ufront.web.session.CacheSession",
				"methodName" => "checkStarted",
			])));
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:333: lines 333-336
		if ($this->sessionData !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:334: characters 4-34
			$this->sessionData->data[$name] = $value;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:335: characters 4-21
			$this->commitFlag = true;
		}
	}


	/**
	 * @param string $id
	 * @param int $expiryLength
	 * 
	 * @return void
	 */
	public function setCookie ($id, $expiryLength) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:303: characters 3-98
		$expireAt = ($expiryLength <= 0 ? null : \Date::fromTime(\Date::now()->getTime() + 1000.0 * $expiryLength));
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:304: characters 3-18
		$path = "/";
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:305: characters 3-21
		$domain = null;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:306: characters 3-22
		$secure = false;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:308: characters 3-89
		$sessionCookie = new HttpCookie($this->sessionName, $id, $expireAt, $domain, $path, $secure);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:309: lines 309-310
		if ($expiryLength < 0) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:310: characters 4-29
			$sessionCookie->expireNow();
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:311: characters 3-46
		$this->context->response->setCookie($sessionCookie);
	}


	/**
	 * Set the number of seconds the session should last.
	 * Note in this implementation only the cookie expiry is affected.
	 * The session is not currently deleted / expired from the cache.
	 * The user could manually override this or send the session variable in the request parameters, and the session would still work.
	 * 
	 * @param int $e
	 * 
	 * @return void
	 */
	public function setExpiry ($e) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:178: characters 3-13
		$this->expiry = $e;
	}


	/**
	 * @return string
	 */
	public function toString () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:417: characters 10-59
		if ($this->sessionData !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:417: characters 30-52
			return $this->sessionData->toString();
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:417: characters 55-59
			return "{}";
		}
	}


	/**
	 * Force the session to be committed at the end of this request.
	 * 
	 * @return void
	 */
	public function triggerCommit () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/CacheSession.hx:376: characters 3-20
		$this->commitFlag = true;
	}


	public function __toString() {
		return $this->toString();
	}


	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


	}
}


Boot::registerClass(CacheSession::class, 'ufront.web.session.CacheSession');
Boot::registerMeta(CacheSession::class, new HxAnon(["obj" => new HxAnon(["rtti" => \Array_hx::wrap([\Array_hx::wrap([
	"injectConfig",
	"",
	"ufront.web.context.HttpContext",
	"",
	"",
	"ufront.cache.UFCacheConnection",
	"",
	"",
])])])]));
Boot::registerGetters('ufront\\web\\session\\CacheSession', [
	'id' => true
]);
CacheSession::__hx__init();
