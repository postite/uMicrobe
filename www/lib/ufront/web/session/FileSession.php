<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx
 */

namespace ufront\web\session;

use \haxe\io\Path;
use \ufront\core\SurpriseTools;
use \php\_Boot\HxClosure;
use \ufront\log\MessageType;
use \haxe\Unserializer;
use \ufront\web\context\HttpContext;
use \haxe\ds\StringMap;
use \php\Boot;
use \php\_Boot\HxException;
use \tink\core\_Future\FutureObject;
use \tink\core\_Future\Future_Impl_;
use \ufront\web\HttpCookie;
use \ufront\core\Uuid;
use \sys\io\File;
use \tink\core\Noise;
use \ufront\core\_MultiValueMap\MultiValueMap_Impl_;
use \haxe\CallStack;
use \php\_Boot\HxAnon;
use \haxe\Serializer;
use \ufront\web\HttpError;

/**
 * A session implementation using flat files.
 * Files are saved to the folder `savePath`, with one file per session.
 * The folder must be writeable by the web server.
 * Each session has a unique ID, which is randomly generated and used as the file name.
 * The contents of the file are a serialized `StringMap` representing the current session.
 * The serialization is done using `haxe.Serializer` and `haxe.Unserializer`.
 * The session ID is sent to the client as a `HttpCookie`.
 * When reading the session ID, `HttpRequest.cookies` is checked first, followed by `HttpRequest.params`.
 * When searching the parameters or cookies for the session ID, the name to search for is defined by the `this.sessionName` property.
 */
class FileSession implements UFHttpSession {
	/**
	 * @var int
	 * The default expiry value.
	 * The default value is 0 (expire when window is closed).
	 * You can change the default by changing this static variable.
	 */
	static public $defaultExpiry = 0;
	/**
	 * @var string
	 * The default savePath.
	 * This should be relative to the `HttpContext.contentDirectory`, or absolute.
	 * The default value is `sessions/`.
	 * You can change this static value to set a new default.
	 */
	static public $defaultSavePath = "sessions/";
	/**
	 * @var string
	 * The default session name to use if none is provided.
	 * The default value is `UfrontSessionID`.
	 * You can change this static variable to set a new default.
	 */
	static public $defaultSessionName = "UfrontSessionID";


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
	 * The current HttpContext, should be supplied by injection.
	 */
	public $context;
	/**
	 * @var int
	 * The lifetime/expiry of the cookie, in seconds.
	 * - A positive value sets the cookie to expire that many seconds from the current time.
	 * - A value of 0 represents expiry when the browser window is closed.
	 * - A negative value expires the cookie immediately.
	 * This is set by injecting an `Int` named `sessionExpiry`, otherwise the default `FileSession.defaultExpiry` value is used.
	 */
	public $expiry;
	/**
	 * @var bool
	 */
	public $expiryFlag;
	/**
	 * @var bool
	 */
	public $regenerateFlag;
	/**
	 * @var string
	 * The save path for the session files.
	 * This should be absolute, or relative to the `HttpContext.contentDirectory`
	 * Relative paths should not have a leading slash.
	 * If a trailing slash is not included, it will be added.
	 * This is set by injecting a `String` named `sessionSavePath`, otherwise the default `FileSession.defaultSavePath` value is used.
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
	 * The variable name to reference the session ID.
	 * This will be the name set in the cookie sent to the client, or the name to search for in the parameters or cookies.
	 * This is set by injecting a String named `sessionName`, otherwise the default `FileSession.defaultSessionName` value is used.
	 */
	public $sessionName;
	/**
	 * @var bool
	 */
	public $started;


	/**
	 * @param object $p
	 * 
	 * @return FutureObject
	 */
	static public function notImplemented ($p = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:517: characters 3-80
		return SurpriseTools::asSurpriseError("FileSession is not implemented on this platform", null, $p);
	}


	/**
	 * @param string $id
	 * 
	 * @return bool
	 */
	static public function testValidId ($id) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:513: characters 10-42
		if ($id !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:513: characters 24-40
			return Uuid::isValid($id);
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:513: characters 10-42
			return false;
		}
	}


	/**
	 * Construct a new session object.
	 * This does not create the session file or commit any data, rather, it sets up the object so that read or writes can then happen.
	 * Data is read during `this.init()` and written during `this.commit()`.
	 * A new session object should be created for each request, and it will then associate itself with the correct session file for the given user.
	 * In general you should create your object using dependency injections, so that everything is initialized correctly.
	 * 
	 * @return void
	 */
	public function __construct () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:101: characters 3-18
		$this->started = false;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:102: characters 3-21
		$this->commitFlag = false;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:103: characters 3-20
		$this->closeFlag = false;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:104: characters 3-25
		$this->regenerateFlag = false;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:105: characters 3-21
		$this->expiryFlag = false;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:106: characters 3-21
		$this->sessionData = null;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:107: characters 3-19
		$this->sessionID = null;
	}


	/**
	 * @param object $pos
	 * 
	 * @return void
	 */
	public function checkStarted ($pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:508: lines 508-509
		if (!$this->started) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:509: characters 4-9
			throw new HxException(HttpError::internalServerError("Trying to access session data before init() has been run", null, new HxAnon([
				"fileName" => "ufront/web/session/FileSession.hx",
				"lineNumber" => 509,
				"className" => "ufront.web.session.FileSession",
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
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:443: lines 443-446
		if (($this->sessionData !== null) && ($this->started || ($this->get_id() !== null))) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:444: characters 4-42
			$this->sessionData = new StringMap();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:445: characters 4-21
			$this->commitFlag = true;
		}
	}


	/**
	 * Close the session.
	 * The sessionData and sessionID will be set to null, and the session will be flagged for deletion (when `this.commit()` is called)
	 * 
	 * @return void
	 */
	public function close () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:488: characters 3-17
		if (!$this->started) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:488: characters 3-17
			throw new HxException(HttpError::internalServerError("Trying to access session data before init() has been run", null, new HxAnon([
				"fileName" => "ufront/web/session/FileSession.hx",
				"lineNumber" => 509,
				"className" => "ufront.web.session.FileSession",
				"methodName" => "checkStarted",
			])));
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:489: characters 3-21
		$this->sessionData = null;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:490: characters 3-19
		$this->closeFlag = true;
	}


	/**
	 * Commit if required.
	 * Returns a `Surprise`, which is a Failure if the commit failed, usually because of not having permission to write to disk.
	 * 
	 * @return FutureObject
	 */
	public function commit () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:281: lines 281-282
		if (($this->sessionID === null) && ($this->sessionData !== null)) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:282: characters 4-23
			$this->regenerateID();
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:284: lines 284-288
		return Future_Impl_::_tryFailingFlatMap(Future_Impl_::_tryFailingFlatMap(Future_Impl_::_tryFailingFlatMap($this->doRegenerateID(), new HxClosure($this, 'doSaveSessionContent')), new HxClosure($this, 'doSetExpiry')), new HxClosure($this, 'doCloseSession'));
	}


	/**
	 * @param Noise $_
	 * 
	 * @return FutureObject
	 */
	public function doCloseSession ($_) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:372: lines 372-386
		if ($this->closeFlag) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:373: characters 4-23
			$this->setCookie("", -1);
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:374: characters 4-51
			$filename = "" . ($this->savePath??'null') . ($this->sessionID??'null') . ".sess";
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:376: lines 376-379
			return SurpriseTools::tryCatchSurprise(function ()  use (&$filename) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:377: characters 6-39
				unlink($filename);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:378: characters 6-18
				return Noise::Noise();
			}, null, new HxAnon([
				"fileName" => "ufront/web/session/FileSession.hx",
				"lineNumber" => 376,
				"className" => "ufront.web.session.FileSession",
				"methodName" => "doCloseSession",
			]));
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:386: characters 8-38
			return SurpriseTools::success();
		}
	}


	/**
	 * @return FutureObject
	 */
	public function doCreateSessionDirectory () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:201: characters 3-46
		$dir = Path::removeTrailingSlashes($this->savePath);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:203: lines 203-208
		return SurpriseTools::tryCatchSurprise(function ()  use (&$dir) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:204: lines 204-206
			if (file_exists($dir) === false) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:205: characters 6-39
				if (!is_dir($dir)) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:205: characters 6-39
					mkdir($dir, 493, true);
				}
			}
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:207: characters 5-17
			return Noise::Noise();
		}, "Failed to create directory " . ($dir??'null'), new HxAnon([
			"fileName" => "ufront/web/session/FileSession.hx",
			"lineNumber" => 203,
			"className" => "ufront.web.session.FileSession",
			"methodName" => "doCreateSessionDirectory",
		]));
	}


	/**
	 * @param Noise $_
	 * 
	 * @return FutureObject
	 */
	public function doReadSessionFile ($_) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:224: characters 8-30
		$id = $this->sessionID;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:224: lines 224-246
		if (($id !== null) && Uuid::isValid($id)) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:225: characters 4-56
			$filename = "" . ($this->savePath??'null') . ($this->sessionID??'null') . ".sess";
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:228: lines 228-229
			try {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:228: characters 10-54
				return SurpriseTools::asGoodSurprise(File::getContent($filename));
			} catch (\Throwable $__hx__caught_e) {
				CallStack::saveExceptionTrace($__hx__caught_e);
				$__hx__real_e = ($__hx__caught_e instanceof HxException ? $__hx__caught_e->e : $__hx__caught_e);
				$e = $__hx__real_e;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:229: characters 26-62
				return SurpriseTools::asGoodSurprise(null);
			}
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:243: characters 4-77
			$_this = $this->context->messages;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:243: characters 4-77
			$_this->arr[$_this->length] = new HxAnon([
				"msg" => "Session ID " . ($this->sessionID??'null') . " was invalid, resetting session.",
				"pos" => new HxAnon([
					"fileName" => "ufront/web/session/FileSession.hx",
					"lineNumber" => 243,
					"className" => "ufront.web.session.FileSession",
					"methodName" => "doReadSessionFile",
				]),
				"type" => MessageType::MWarning(),
			]);
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:243: characters 4-77
			++$_this->length;

			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:244: characters 4-20
			$this->sessionID = null;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:245: characters 4-47
			return SurpriseTools::asGoodSurprise(null);
		}
	}


	/**
	 * @return FutureObject
	 */
	public function doRegenerateID () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:291: lines 291-338
		$_gthis = $this;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:292: lines 292-337
		if ($this->regenerateFlag) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:293: characters 4-33
			$oldSessionID = $this->sessionID;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:295: lines 295-315
			return SurpriseTools::tryCatchSurprise(function ()  use (&$_gthis, &$oldSessionID) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:296: characters 6-22
				$file = null;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:297: lines 297-300
				while (true) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:298: characters 7-38
					$_gthis->sessionID = Uuid::create();
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:299: characters 7-45
					$file = "" . ($_gthis->savePath??'null') . ($_gthis->sessionID??'null') . ".sess";
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:297: lines 297-300
					if (!file_exists($file)) {
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:297: lines 297-300
						break;
					}
				}
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:303: characters 6-36
				$_gthis->setCookie($_gthis->sessionID, $_gthis->expiry);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:304: lines 304-312
				if ($oldSessionID !== null) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:305: characters 7-57
					$filePath = "" . ($_gthis->savePath??'null') . ($oldSessionID??'null') . ".sess";
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:308: lines 308-311
					if (file_exists($filePath)) {
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:309: characters 8-43
						rename($filePath, $file);
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:310: characters 8-20
						return Noise::Noise();
					}
				}
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:313: characters 6-34
				File::saveContent($file, "");
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:314: characters 6-18
				return Noise::Noise();
			}, null, new HxAnon([
				"fileName" => "ufront/web/session/FileSession.hx",
				"lineNumber" => 295,
				"className" => "ufront.web.session.FileSession",
				"methodName" => "doRegenerateID",
			]));
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:337: characters 8-38
			return SurpriseTools::success();
		}
	}


	/**
	 * @param Noise $_
	 * 
	 * @return FutureObject
	 */
	public function doSaveSessionContent ($_) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:341: lines 341-361
		if ($this->commitFlag && ($this->sessionData !== null)) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:342: characters 4-51
			$filePath = "" . ($this->savePath??'null') . ($this->sessionID??'null') . ".sess";
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:343: characters 4-23
			$content = null;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:345: lines 345-348
			try {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:346: characters 5-42
				$content = Serializer::run($this->sessionData);
			} catch (\Throwable $__hx__caught_e) {
				CallStack::saveExceptionTrace($__hx__caught_e);
				$__hx__real_e = ($__hx__caught_e instanceof HxException ? $__hx__caught_e->e : $__hx__caught_e);
				$e = $__hx__real_e;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:348: characters 5-70
				return $e->asSurpriseError("Failed to serialize session content");
			}
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:351: lines 351-354
			return SurpriseTools::tryCatchSurprise(function ()  use (&$filePath, &$content) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:352: characters 6-43
				File::saveContent($filePath, $content);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:353: characters 6-18
				return Noise::Noise();
			}, null, new HxAnon([
				"fileName" => "ufront/web/session/FileSession.hx",
				"lineNumber" => 351,
				"className" => "ufront.web.session.FileSession",
				"methodName" => "doSaveSessionContent",
			]));
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:361: characters 8-38
			return SurpriseTools::success();
		}
	}


	/**
	 * @param Noise $_
	 * 
	 * @return FutureObject
	 */
	public function doSetExpiry ($_) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:365: lines 365-367
		if ($this->expiryFlag) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:366: characters 4-34
			$this->setCookie($this->sessionID, $this->expiry);
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:368: characters 3-33
		return SurpriseTools::success();
	}


	/**
	 * @param string $content
	 * 
	 * @return Noise
	 */
	public function doUnserializeSessionData ($content) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:250: lines 250-258
		if ($content !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:251: lines 251-257
			try {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:252: characters 5-72
				$this->sessionData = Boot::typedCast(Boot::getClass(StringMap::class), Unserializer::run($content));
			} catch (\Throwable $__hx__caught_e) {
				CallStack::saveExceptionTrace($__hx__caught_e);
				$__hx__real_e = ($__hx__caught_e instanceof HxException ? $__hx__caught_e->e : $__hx__caught_e);
				$e = $__hx__real_e;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:256: characters 5-63
				$_this = $this->context;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:256: characters 5-63
				$msg = "Failed to unserialize session data: " . (\Std::string($e)??'null');
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:256: characters 5-63
				$_this1 = $_this->messages;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:256: characters 5-63
				$_this1->arr[$_this1->length] = new HxAnon([
					"msg" => $msg,
					"pos" => new HxAnon([
						"fileName" => "ufront/web/session/FileSession.hx",
						"lineNumber" => 256,
						"className" => "ufront.web.session.FileSession",
						"methodName" => "doUnserializeSessionData",
					]),
					"type" => MessageType::MWarning(),
				]);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:256: characters 5-63
				++$_this1->length;

			}
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:259: characters 3-15
		return Noise::Noise();
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
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:420: characters 3-17
		if (!$this->started) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:420: characters 3-17
			throw new HxException(HttpError::internalServerError("Trying to access session data before init() has been run", null, new HxAnon([
				"fileName" => "ufront/web/session/FileSession.hx",
				"lineNumber" => 509,
				"className" => "ufront.web.session.FileSession",
				"methodName" => "checkStarted",
			])));
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:421: characters 10-57
		if ($this->sessionData !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:421: characters 31-57
			return array_key_exists($name, $this->sessionData->data);
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:421: characters 10-57
			return false;
		}
	}


	/**
	 * @return string
	 */
	public function generateSessionID () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:504: characters 3-23
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
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:395: characters 3-17
		if (!$this->started) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:395: characters 3-17
			throw new HxException(HttpError::internalServerError("Trying to access session data before init() has been run", null, new HxAnon([
				"fileName" => "ufront/web/session/FileSession.hx",
				"lineNumber" => 509,
				"className" => "ufront.web.session.FileSession",
				"methodName" => "checkStarted",
			])));
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:396: characters 10-60
		if ($this->sessionData !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:396: characters 30-53
			return ($this->sessionData->data[$name] ?? null);
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:396: characters 56-60
			return null;
		}
	}


	/**
	 * @param string $id
	 * 
	 * @return string
	 */
	public function getSessionFilePath ($id) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:500: characters 3-29
		return "" . ($this->savePath??'null') . ($id??'null') . ".sess";
	}


	/**
	 * Return the current ID, either one that has been set during `this.init()`, or one found in either `HttpRequest.cookies` or `HttpRequest.params`.
	 * 
	 * @return string
	 */
	public function get_id () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:477: characters 3-74
		if ($this->sessionID === null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:477: characters 26-74
			$this->sessionID = MultiValueMap_Impl_::get($this->context->request->get_cookies(), $this->sessionName);
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:478: characters 3-73
		if ($this->sessionID === null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:478: characters 26-73
			$this->sessionID = MultiValueMap_Impl_::get($this->context->request->get_params(), $this->sessionName);
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:479: characters 3-19
		return $this->sessionID;
	}


	/**
	 * Initiate the session.
	 * This will check for an existing session ID.
	 * If one exists, it will read and unserialize the session data from that session's file.
	 * If a session does not exist, one will be created, including generating and reserving a new session ID.
	 * This must be called before any other operations which require access to the current session.
	 * 
	 * @return FutureObject
	 */
	public function init () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:186: lines 186-198
		$_gthis = $this;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:187: lines 187-197
		if (!$this->started) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:188: characters 4-12
			$this->get_id();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:189: characters 4-38
			$this->sessionData = new StringMap();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:191: lines 191-195
			return Future_Impl_::_tryMap(Future_Impl_::_tryMap(Future_Impl_::_tryFailingFlatMap($this->doCreateSessionDirectory(), new HxClosure($this, 'doReadSessionFile')), new HxClosure($this, 'doUnserializeSessionData')), function ($n)  use (&$_gthis) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:195: characters 25-44
				$_gthis->started = true;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:195: characters 46-58
				return Noise::Noise();
			});
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:197: characters 8-38
			return SurpriseTools::success();
		}
	}


	/**
	 * Use the current injector to check for configuration for this session: `this.sessionName`, `this.expiry` and `this.savePath`.
	 * If no values are available in the injector, the defaults will be used.
	 * 
	 * @param HttpContext $context
	 * 
	 * @return void
	 */
	public function injectConfig ($context) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:115: lines 115-118
		$this->sessionName = ($context->injector->hasMappingForType("String", "sessionName") ? $context->injector->getValueForType("String", "sessionName") : FileSession::$defaultSessionName);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:119: lines 119-122
		$this->expiry = ($context->injector->hasMappingForType("Int", "sessionExpiry") ? $context->injector->getValueForType("Int", "sessionExpiry") : FileSession::$defaultExpiry);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:123: lines 123-126
		$this->savePath = ($context->injector->hasMappingForType("String", "sessionSavePath") ? $context->injector->getValueForType("String", "sessionSavePath") : FileSession::$defaultSavePath);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:129: characters 3-47
		$this->savePath = Path::addTrailingSlash($this->savePath);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:130: lines 130-131
		if (!\StringTools::startsWith($this->savePath, "/")) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:131: characters 4-50
			$this->savePath = ($context->get_contentDirectory()??'null') . ($this->savePath??'null');
		}
	}


	/**
	 * Return whether or not the session is active, meaning it has been initialised either in this request or in a previous request.
	 * 
	 * @return bool
	 */
	public function isActive () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:465: characters 10-35
		if (!$this->started) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:465: characters 21-35
			return $this->get_id() !== null;
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:465: characters 10-35
			return true;
		}
	}


	/**
	 * Return whether or not the session is ready to use (has been initialised).
	 * 
	 * @return bool
	 */
	public function isReady () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:470: characters 3-17
		return $this->started;
	}


	/**
	 * Trigger a regeneration of the session ID when `this.commit()` is called.
	 * 
	 * @return void
	 */
	public function regenerateID () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:460: characters 3-24
		$this->regenerateFlag = true;
	}


	/**
	 * Remove an item from the session.
	 * Note this will not commit the value to a file until `this.commit()` is called (generally at the end of a request).
	 * This will throw an error if `this.init()` has not already been called.
	 * 
	 * @param string $name
	 * 
	 * @return void
	 */
	public function remove ($name) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:432: characters 3-17
		if (!$this->started) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:432: characters 3-17
			throw new HxException(HttpError::internalServerError("Trying to access session data before init() has been run", null, new HxAnon([
				"fileName" => "ufront/web/session/FileSession.hx",
				"lineNumber" => 509,
				"className" => "ufront.web.session.FileSession",
				"methodName" => "checkStarted",
			])));
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:433: lines 433-436
		if ($this->sessionData !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:434: characters 4-28
			$this->sessionData->remove($name);
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:435: characters 4-21
			$this->commitFlag = true;
		}
	}


	/**
	 * Set an item in the session data.
	 * Note this will not commit the value to a file until `this.commit()` is called (generally at the end of a request).
	 * This will throw an error if `this.init()` has not already been called.
	 * 
	 * @param string $name
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public function set ($name, $value) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:407: characters 3-17
		if (!$this->started) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:407: characters 3-17
			throw new HxException(HttpError::internalServerError("Trying to access session data before init() has been run", null, new HxAnon([
				"fileName" => "ufront/web/session/FileSession.hx",
				"lineNumber" => 509,
				"className" => "ufront.web.session.FileSession",
				"methodName" => "checkStarted",
			])));
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:408: lines 408-411
		if ($this->sessionData !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:409: characters 4-34
			$this->sessionData->data[$name] = $value;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:410: characters 4-21
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
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:263: characters 3-98
		$expireAt = ($expiryLength <= 0 ? null : \Date::fromTime(\Date::now()->getTime() + 1000.0 * $expiryLength));
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:264: characters 3-18
		$path = "/";
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:265: characters 3-21
		$domain = null;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:266: characters 3-22
		$secure = false;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:268: characters 3-89
		$sessionCookie = new HttpCookie($this->sessionName, $id, $expireAt, $domain, $path, $secure);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:269: lines 269-270
		if ($expiryLength < 0) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:270: characters 4-29
			$sessionCookie->expireNow();
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:271: characters 3-46
		$this->context->response->setCookie($sessionCookie);
	}


	/**
	 * Set the number of seconds the session should last before expiring.
	 * Note in this implementation only the cookie expiry is affected - the file is not deleted from the server.
	 * The user could manually override this or send the session variable in the request parameters, and the session would still work.
	 * 
	 * @param int $e
	 * 
	 * @return void
	 */
	public function setExpiry ($e) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:173: characters 3-13
		$this->expiry = $e;
	}


	/**
	 * @return string
	 */
	public function toString () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:494: characters 10-59
		if ($this->sessionData !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:494: characters 30-52
			return $this->sessionData->toString();
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:494: characters 55-59
			return "{}";
		}
	}


	/**
	 * Force the session to be committed at the end of this request
	 * 
	 * @return void
	 */
	public function triggerCommit () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/session/FileSession.hx:453: characters 3-20
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


Boot::registerClass(FileSession::class, 'ufront.web.session.FileSession');
Boot::registerMeta(FileSession::class, new HxAnon(["obj" => new HxAnon(["rtti" => \Array_hx::wrap([
	\Array_hx::wrap([
		"context",
		"ufront.web.context.HttpContext",
		"",
	]),
	\Array_hx::wrap([
		"injectConfig",
		"",
		"ufront.web.context.HttpContext",
		"",
		"",
	]),
])])]));
Boot::registerGetters('ufront\\web\\session\\FileSession', [
	'id' => true
]);
FileSession::__hx__init();
