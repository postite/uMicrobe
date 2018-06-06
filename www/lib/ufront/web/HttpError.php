<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx
 */

namespace ufront\web;

use \php\Boot;
use \php\_Boot\HxException;
use \tink\core\TypedError;
use \ufront\remoting\RemotingError;
use \php\_Boot\HxAnon;
use \ufront\auth\AuthError;

/**
 * Helper functions to create `tink.core.Error` objects that are common in Http requests.
 */
class HttpError {
	/**
	 * A shortcut for an error when a method is abstract and should be overridden (Http 500).
	 * @param pos (optional) The position of the error. Can be supplied, otherwise the call site of this function is used.
	 * @return A wrapped `Error` object, with the error code 500.
	 * 
	 * @param object $pos
	 * 
	 * @return TypedError
	 */
	static public function abstractMethod ($pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:162: characters 3-57
		$methodName = ($pos->className??'null') . "." . ($pos->methodName??'null');
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:163: characters 3-130
		return new TypedError(500, "Internal Server Error: " . ($methodName??'null') . " is an abstract method and should be overridden by a subclass", $pos);
	}


	/**
	 * A Http 401 "Unauthorized Access" error based on an `AuthError`.
	 * @param error The AuthError that has been raised.
	 * @param pos (optional) The position of the error. Can be supplied, otherwise the call site of this function is used.
	 * @return A wrapped `Error` object, with the error code 401.
	 * 
	 * @param AuthError $error
	 * @param object $pos
	 * 
	 * @return TypedError
	 */
	static public function authError ($error, $pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:105: lines 105-110
		$msg = null;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:105: lines 105-110
		switch ($error->index) {
			case 0:
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:105: lines 105-110
				$msg = "Not Logged In";
				break;
			case 1:
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:107: characters 23-26
				$msg1 = $error->params[0];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:105: lines 105-110
				$msg = "Login Failed: " . ($msg1??'null');
				break;
			case 2:
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:108: characters 25-26
				$u = $error->params[0];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:105: lines 105-110
				$msg = "Not Logged In As " . (\Std::string($u)??'null');
				break;
			case 3:
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:109: characters 24-25
				$p = $error->params[0];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:105: lines 105-110
				$msg = "Permission " . (\Std::string($p)??'null') . " denied";
				break;
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:111: characters 3-45
		return TypedError::typed(401, $msg, $error, $pos);
	}


	/**
	 * A Http 400 "Bad Request" error.
	 * @param reason (optional) If supplied, the error message will be `Bad Request: $reason`.
	 * @param pos (optional) The position of the error. Can be supplied, otherwise the call site of this function is used.
	 * @return A wrapped `Error` object, with the error code 400.
	 * 
	 * @param string $reason
	 * @param object $pos
	 * 
	 * @return TypedError
	 */
	static public function badRequest ($reason = null, $pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:38: characters 3-31
		$message = "Bad Request";
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:39: lines 39-40
		if ($reason !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:40: characters 4-26
			$message = ($message??'null') . ((": " . ($reason??'null'))??'null');
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:41: characters 3-38
		return new TypedError(400, $message, $pos);
	}


	/**
	 * Generate a fake `haxe.PosInfos` position for a given class, method and args.
	 * This is used by some ufront internals to give an accurate position for messages and errors, when we have details about the context but not the actual position.
	 * For example, `MVCHandler` knows the Controller, Action and Arguments that were called, but if an exception is thrown it does not have a valid position.
	 * This allows us to fake a "close enough" position, to aid in debugging.
	 * @param obj - The object (controller / module / handler) from which we derive the class name. Must be a class instance.
	 * @param method - The method name to use in our position
	 * @param args - Any arguments parsed to that method.  If not given, an empty array will be used.
	 * 
	 * @param mixed $obj
	 * @param string $method
	 * @param \Array_hx $args
	 * 
	 * @return object
	 */
	static public function fakePosition ($obj, $method, $args = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:192: lines 192-198
		return new HxAnon([
			"methodName" => $method,
			"lineNumber" => -1,
			"fileName" => "",
			"customParams" => $args,
			"className" => \Type::getClassName(\Type::getClass($obj)),
		]);
	}


	/**
	 * A Http 500 "Internal Server Error", optionally containing the inner error.
	 * @param msg (optional) The error message. The default message is "Internal Server Error".
	 * @param inner (optional) The inner data of the error, if any.
	 * @param pos (optional) The position of the error. Can be supplied, otherwise the call site of this function is used.
	 * @return A wrapped `Error` object, with the error code 500.
	 * 
	 * @param string $msg
	 * @param mixed $inner
	 * @param object $pos
	 * 
	 * @return TypedError
	 */
	static public function internalServerError ($msg = "Internal Server Error", $inner = null, $pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:53: characters 3-48
		if ($msg === null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:53: characters 3-48
			$msg = "Internal Server Error";
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:53: characters 3-48
		return TypedError::withData(500, $msg, $inner, $pos);
	}


	/**
	 * A Http 405 "Method Not Allowed" error.
	 * @param pos (optional) The position of the error. Can be supplied, otherwise the call site of this function is used.
	 * @return A wrapped `Error` object, with the error code 405.
	 * 
	 * @param object $pos
	 * 
	 * @return TypedError
	 */
	static public function methodNotAllowed ($pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:63: characters 3-53
		return new TypedError(405, "Method Not Allowed", $pos);
	}


	/**
	 * A shortcut for an error when a method is not implemented (Http 500).
	 * @param pos (optional) The position of the error. Can be supplied, otherwise the call site of this function is used.
	 * @return A wrapped `Error` object, with the error code 500.
	 * 
	 * @param object $pos
	 * 
	 * @return TypedError
	 */
	static public function notImplemented ($pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:151: characters 3-57
		$methodName = ($pos->className??'null') . "." . ($pos->methodName??'null');
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:152: characters 3-105
		return new TypedError(500, "Internal Server Error: " . ($methodName??'null') . " is not implemented on this platform", $pos);
	}


	/**
	 * A Http 404 "Page Not Found" error.
	 * @param pos (optional) The position of the error. Can be supplied, otherwise the call site of this function is used.
	 * @return A wrapped `Error` object, with the error code 404.
	 * 
	 * @param object $pos
	 * 
	 * @return TypedError
	 */
	static public function pageNotFound ($pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:73: characters 3-49
		return new TypedError(404, "Page Not Found", $pos);
	}


	/**
	 * A Http 500 "Internal Server Error" error based on a `RemotingError`.
	 * @param error The AuthError that has been raised.
	 * @param pos (optional) The position of the error. Can be supplied, otherwise the call site of this function is used.
	 * @return A wrapped `Error` object, with the error code 401.
	 * 
	 * @param RemotingError $error
	 * @param object $pos
	 * 
	 * @return TypedError
	 */
	static public function remotingError ($error, $pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:122: lines 122-141
		switch ($error->index) {
			case 0:
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:123: characters 55-67
				$responseData = $error->params[2];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:123: characters 41-53
				$responseCode = $error->params[1];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:123: characters 21-39
				$remotingCallString = $error->params[0];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:123: characters 71-165
				return TypedError::typed($responseCode, "HTTP " . ($responseCode??'null') . " Error during " . ($remotingCallString??'null'), $error, $pos);
				break;
			case 1:
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:124: characters 43-55
				$errorMessage = $error->params[1];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:124: characters 23-41
				$remotingCallString1 = $error->params[0];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:124: characters 59-150
				return TypedError::typed(404, "Remoting API " . ($remotingCallString1??'null') . " not found: " . ($errorMessage??'null'), $error, $pos);
				break;
			case 2:
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:125: characters 54-59
				$stack = $error->params[2];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:125: characters 51-52
				$e = $error->params[1];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:125: characters 31-49
				$remotingCallString2 = $error->params[0];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:126: characters 20-44
				$value = $e;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:126: characters 5-45
				$errorObj = (($value instanceof TypedError) ? $value : null);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:127: lines 127-130
				if ($errorObj !== null) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:128: characters 6-64
					return TypedError::typed($errorObj->code, $errorObj->message, $error, $pos);
				} else {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:130: characters 6-97
					return TypedError::typed(500, "Internal Server Error while executing " . ($remotingCallString2??'null'), $error, $pos);
				}
				break;
			case 3:
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:131: characters 55-56
				$e1 = $error->params[1];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:131: characters 35-53
				$remotingCallString3 = $error->params[0];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:131: characters 60-145
				return TypedError::typed(500, "Error during callback after " . ($remotingCallString3??'null') . ": " . (\Std::string($e1)??'null'), $error, $pos);
				break;
			case 4:
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:132: characters 62-65
				$err = $error->params[2];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:132: characters 49-60
				$troubleLine = $error->params[1];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:132: characters 29-47
				$remotingCallString4 = $error->params[0];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:132: characters 69-193
				return TypedError::typed(422, "Remoting serialization failed for call " . ($remotingCallString4??'null') . ": could not process " . ($troubleLine??'null'), $error, $pos);
				break;
			case 5:
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:133: characters 48-60
				$responseData1 = $error->params[1];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:133: characters 28-46
				$remotingCallString5 = $error->params[0];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:133: characters 64-169
				return TypedError::typed(500, "Error with response for " . ($remotingCallString5??'null') . ": no remoting response found", $error, $pos);
				break;
			case 6:
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:134: characters 42-46
				$data = $error->params[1];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:134: characters 22-40
				$remotingCallString6 = $error->params[0];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:135: lines 135-139
				if (($data instanceof TypedError)) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:136: characters 6-30
					$e2 = $data;
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:137: characters 6-52
					return TypedError::typed($e2->code, $e2->message, $error, $e2->pos);
				} else {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:139: characters 10-85
					return TypedError::typed(500, "Call to " . ($remotingCallString6??'null') . " failed: " . (\Std::string($data)??'null'), $error, $pos);
				}
				break;
			case 7:
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:140: characters 28-29
				$e3 = $error->params[0];
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:140: characters 33-105
				return TypedError::typed(500, "Unknown exception during remoting call", $error, $pos);
				break;
		}
	}


	/**
	 * A shortcut to throw an `Error` if a particular value is `null` (Http 500).
	 * @param val The value to check.
	 * @param name (optional) The name of the argument that is being checked, to provide a more helpful error message. Default is "argument".
	 * @param pos (optional) The position of the error. Can be supplied, otherwise the call site of this function is used.
	 * @throws A wrapped `Error` object, with the error code 500, if `val` was null.
	 * 
	 * @param mixed $val
	 * @param string $name
	 * @param object $pos
	 * 
	 * @return void
	 */
	static public function throwIfNull ($val, $name = "argument", $pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:175: lines 175-176
		if ($name === null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:175: lines 175-176
			$name = "argument";
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:175: lines 175-176
		if ($val === null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:176: characters 4-9
			throw new HxException(new TypedError(500, "" . ($name??'null') . " should not be null", $pos));
		}
	}


	/**
	 * A Http 401 "Unauthorized Access" error.
	 * @param message (optional) A description of the error. Default is "Unauthorized Access".
	 * @param pos (optional) The position of the error. Can be supplied, otherwise the call site of this function is used.
	 * @return A wrapped `Error` object, with the error code 401.
	 * 
	 * @param string $message
	 * @param object $pos
	 * 
	 * @return TypedError
	 */
	static public function unauthorized ($message = "Unauthorized Access", $pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:84: characters 3-40
		if ($message === null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:84: characters 3-40
			$message = "Unauthorized Access";
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:84: characters 3-40
		return new TypedError(401, $message, $pos);
	}


	/**
	 * A Http 422 "Unprocessable Entity" error.
	 * @param pos (optional) The position of the error. Can be supplied, otherwise the call site of this function is used.
	 * @return A wrapped `Error` object, with the error code 422.
	 * 
	 * @param object $pos
	 * 
	 * @return TypedError
	 */
	static public function unprocessableEntity ($pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:94: characters 3-55
		return new TypedError(422, "Unprocessable Entity", $pos);
	}


	/**
	 * Wrap an existing error into a Error
	 * - If it was a `tink.core.Error` already, return it as is.
	 * - If it was a normal exception, use code 500, with "Internal Server Error" as the message, the exception as the data, and the call site as the pos.
	 * @param e The original exception.
	 * @param msg (optional) The message to use with the error.  The default message is "Internal Server Error".
	 * @param pos (optional) The position of the error. Can be supplied, otherwise the call site of this function is used.
	 * @return A wrapped `Error` object, with the error code 500.
	 * 
	 * @param mixed $e
	 * @param string $msg
	 * @param object $pos
	 * 
	 * @return TypedError
	 */
	static public function wrap ($e, $msg = "Internal Server Error", $pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:26: lines 26-27
		if ($msg === null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:26: lines 26-27
			$msg = "Internal Server Error";
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:26: lines 26-27
		if (($e instanceof TypedError)) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:26: characters 27-40
			return $e;
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/HttpError.hx:27: characters 8-69
			return TypedError::withData(500, $msg, $e, $pos);
		}
	}
}


Boot::registerClass(HttpError::class, 'ufront.web.HttpError');
