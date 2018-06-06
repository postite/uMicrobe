<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/auth/NobodyAuthHandler.hx
 */

namespace ufront\auth;

use \php\Boot;
use \php\_Boot\HxException;
use \php\_Boot\HxAnon;
use \ufront\web\HttpError;

/**
 * An AuthHandler which always gives no permissions.
 * This is used when another auth handler isn't available, and will return false (or throw errors) for all permission checks.
 * Who would trust you anyway? *You're a nobody.* ;)
 * @author Jason O'Neil
 */
class NobodyAuthHandler implements UFAuthHandler {


	/**
	 * @return void
	 */
	public function __construct () {
	}


	/**
	 * @return UFAuthUser
	 */
	public function get_currentUser () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/auth/NobodyAuthHandler.hx:37: characters 29-40
		return null;
	}


	/**
	 * @param mixed $permission
	 * 
	 * @return bool
	 */
	public function hasPermission ($permission) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/auth/NobodyAuthHandler.hx:26: characters 56-68
		return false;
	}


	/**
	 * @param object $permissions
	 * 
	 * @return bool
	 */
	public function hasPermissions ($permissions) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/auth/NobodyAuthHandler.hx:28: characters 68-80
		return false;
	}


	/**
	 * @return bool
	 */
	public function isLoggedIn () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/auth/NobodyAuthHandler.hx:18: characters 31-43
		return false;
	}


	/**
	 * @param UFAuthUser $user
	 * 
	 * @return bool
	 */
	public function isLoggedInAs ($user) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/auth/NobodyAuthHandler.hx:22: characters 50-62
		return false;
	}


	/**
	 * @return void
	 */
	public function requireLogin () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/auth/NobodyAuthHandler.hx:20: characters 33-38
		throw new HxException(HttpError::authError(AuthError::ANotLoggedIn(), new HxAnon([
			"fileName" => "ufront/auth/NobodyAuthHandler.hx",
			"lineNumber" => 20,
			"className" => "ufront.auth.NobodyAuthHandler",
			"methodName" => "requireLogin",
		])));
	}


	/**
	 * @param UFAuthUser $user
	 * 
	 * @return void
	 */
	public function requireLoginAs ($user) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/auth/NobodyAuthHandler.hx:24: characters 52-57
		throw new HxException(HttpError::authError(AuthError::ANotLoggedInAs($user), new HxAnon([
			"fileName" => "ufront/auth/NobodyAuthHandler.hx",
			"lineNumber" => 24,
			"className" => "ufront.auth.NobodyAuthHandler",
			"methodName" => "requireLoginAs",
		])));
	}


	/**
	 * @param mixed $permission
	 * 
	 * @return void
	 */
	public function requirePermission ($permission) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/auth/NobodyAuthHandler.hx:30: characters 60-65
		throw new HxException(HttpError::authError(AuthError::ANoPermission($permission), new HxAnon([
			"fileName" => "ufront/auth/NobodyAuthHandler.hx",
			"lineNumber" => 30,
			"className" => "ufront.auth.NobodyAuthHandler",
			"methodName" => "requirePermission",
		])));
	}


	/**
	 * @param object $permissions
	 * 
	 * @return void
	 */
	public function requirePermissions ($permissions) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/auth/NobodyAuthHandler.hx:32: characters 82-93
		$p = $permissions->iterator();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/auth/NobodyAuthHandler.hx:32: characters 82-93
		while ($p->hasNext()) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/auth/NobodyAuthHandler.hx:32: characters 72-100
			$p1 = $p->next();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/auth/NobodyAuthHandler.hx:32: characters 95-100
			throw new HxException(HttpError::authError(AuthError::ANoPermission($p1), new HxAnon([
				"fileName" => "ufront/auth/NobodyAuthHandler.hx",
				"lineNumber" => 32,
				"className" => "ufront.auth.NobodyAuthHandler",
				"methodName" => "requirePermissions",
			])));
		}
	}


	/**
	 * @return string
	 */
	public function toString () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/auth/NobodyAuthHandler.hx:34: characters 29-55
		return "NobodyAuthHandler";
	}


	public function __toString() {
		return $this->toString();
	}
}


Boot::registerClass(NobodyAuthHandler::class, 'ufront.auth.NobodyAuthHandler');
Boot::registerGetters('ufront\\auth\\NobodyAuthHandler', [
	'currentUser' => true
]);