<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/remoting/RemotingError.hx
 */

namespace ufront\remoting;

use \php\Boot;
use \php\_Boot\HxEnum;

/**
 * A RemotingError describes different possible reasons that a Haxe/Ufront remoting call may fail.
 * It allows you to provide more fine grained error-recovery or error reporting.
 */
class RemotingError extends HxEnum {
	/**
	 * The remoting API was expected to return an `Outcome` or `Surprise`, and it did - it returned a Failure containing some data. (Note: The API and remoting mechanism functioned correctly).
	 * 
	 * @param string $remotingCallString
	 * @param mixed $data
	 * 
	 * @return RemotingError
	 */
	static public function RApiFailure ($remotingCallString, $data) {
		return new RemotingError('RApiFailure', 6, [$remotingCallString, $data]);
	}


	/**
	 * The server did not have an API or method matching the remoting call, or it was not shared in the remoting context.
	 * 
	 * @param string $remotingCallString
	 * @param string $errorMessage
	 * 
	 * @return RemotingError
	 */
	static public function RApiNotFound ($remotingCallString, $errorMessage) {
		return new RemotingError('RApiNotFound', 1, [$remotingCallString, $errorMessage]);
	}


	/**
	 * The Client threw an exception while executing the callback for the remoting call.
	 * 
	 * @param string $remotingCallString
	 * @param mixed $e
	 * 
	 * @return RemotingError
	 */
	static public function RClientCallbackException ($remotingCallString, $e) {
		return new RemotingError('RClientCallbackException', 3, [$remotingCallString, $e]);
	}


	/**
	 * The HttpError gave a response code other than 200.
	 * 
	 * @param string $remotingCallString
	 * @param int $responseCode
	 * @param string $responseData
	 * 
	 * @return RemotingError
	 */
	static public function RHttpError ($remotingCallString, $responseCode, $responseData) {
		return new RemotingError('RHttpError', 0, [$remotingCallString, $responseCode, $responseData]);
	}


	/**
	 * A response was received, but no remoting response line (beginning with "hxr") was found.
	 * 
	 * @param string $remotingCallString
	 * @param string $responseData
	 * 
	 * @return RemotingError
	 */
	static public function RNoRemotingResult ($remotingCallString, $responseData) {
		return new RemotingError('RNoRemotingResult', 5, [$remotingCallString, $responseData]);
	}


	/**
	 * The Server threw an exception during the remoting call.
	 * 
	 * @param string $remotingCallString
	 * @param mixed $e
	 * @param string $stack
	 * 
	 * @return RemotingError
	 */
	static public function RServerSideException ($remotingCallString, $e, $stack) {
		return new RemotingError('RServerSideException', 2, [$remotingCallString, $e, $stack]);
	}


	/**
	 * An unknown error occured.
	 * 
	 * @param mixed $e
	 * 
	 * @return RemotingError
	 */
	static public function RUnknownException ($e) {
		return new RemotingError('RUnknownException', 7, [$e]);
	}


	/**
	 * The result sent from the server could not be unserialized by the client.  Often this is due to the server and client having different versions of a particular class that are not compatible.
	 * 
	 * @param string $remotingCallString
	 * @param string $troubleLine
	 * @param string $err
	 * 
	 * @return RemotingError
	 */
	static public function RUnserializeFailed ($remotingCallString, $troubleLine, $err) {
		return new RemotingError('RUnserializeFailed', 4, [$remotingCallString, $troubleLine, $err]);
	}


	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			6 => 'RApiFailure',
			1 => 'RApiNotFound',
			3 => 'RClientCallbackException',
			0 => 'RHttpError',
			5 => 'RNoRemotingResult',
			2 => 'RServerSideException',
			7 => 'RUnknownException',
			4 => 'RUnserializeFailed',
		];
	}


	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'RApiFailure' => 2,
			'RApiNotFound' => 2,
			'RClientCallbackException' => 2,
			'RHttpError' => 3,
			'RNoRemotingResult' => 2,
			'RServerSideException' => 3,
			'RUnknownException' => 1,
			'RUnserializeFailed' => 3,
		];
	}
}


Boot::registerClass(RemotingError::class, 'ufront.remoting.RemotingError');