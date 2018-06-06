<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/api/UFApi.hx
 */

namespace ufront\api;

use \ufront\log\MessageType;
use \php\Boot;
use \ufront\log\MessageList;
use \ufront\auth\UFAuthHandler;
use \php\_Boot\HxAnon;

/**
 * An API that can be used in Ufront controllers, tasks, other APIs, or remoting requests.
 * You should place all of you file system, database or network access, in a UFApi.
 * This makes it easier to interact with your app (and your server) from a `Controller` or `UFTaskSet`, on both the server and the client.
 * You should also perform the bulk of your application logic, and especially authentication checks, in a UFApi.
 * This ensures that, if your app API is available (through Haxe remoting, or a REST API for example), that an attacker can't bypass any logic checks or authentication checks by modifying the client.
 * #### Server and Client
 * UFApis are designed to run on the server, and have access to all the server resources (FileSystem, DB, Email sending etc).
 * They are also designed to be shared with clients via Haxe Remoting - so you can call your server APIs seamlessly from the client.
 **Writing APIs for the server:**
 * When you write your APIs, simple extend UFApi:
 * ```haxe
 * class LoginApi extends UFApi {
 * // You can inject anything you need to help with your API.
 * @inject public var easyAuth:EasyAuth;
 * public function attemptLogin( username:String, password:String ):User {
 * // Do some logic which might involve reading from the database, other APIs, HTTP calls etc.
 * return easyAuth.startSessionSync( new EasyAuthDBAdapter(username,password) ).sure();
 * }
 * }
 * ```
 * Some general points of advice:
 * - A UFApi is created once per request, and is discarded at the end of the request. So it can store information relevant to that request.
 * - Static variables are sometimes shared between requests on mod_neko, mod_tora and client side JS, meaning you should not rely on static variables to have a "fresh" state for each request.
 * - If your API call needs to run asynchronously, make sure it returns a `Future` or a `Surprise`.
 * - If your API returns an `Outcome` or a `Surprise` it has some special behaviour when being used with `UFAsyncApi` or `UFCallbackApi`.
 * #### Using APIs on the client:
 * There are 3 ways to call your `UFApi` from the client:
 * 1. **With a `UFAsyncApi<YourApi>` proxy.**
 * This will wrap your API, and return a `Surprise` instead of a synchronous value.
 * When you compile the client it will use asynchronous HTTP remoting calls.
 * See `UFAsyncApi` for more details.
 * 2. **With a `UFCallbackApi<YourApi>` proxy.**
 * This will wrap your API, and use callback methods for `onResult` and `onError` rather than returning a result directly.
 * When you compile the client it will use asynchronous HTTP remoting calls.
 * See `UFCallbackApi` for more details.
 * 3. **By calling your `UFApi` directly on the client.**
 * When you compile your `UFApi` on the client, it will attempt to use a synchronous remoting connection to the server.
 * This works well on sys targets like Neko and PHP, and is useful for your CLI tasks to call server APIs.
 * On Javascript however this will usually fail, because synchronous XmlHttpRequests are not supported, unless you are making the call from a Web Worker.
 * All 3 of these methods compile on both the client and the server, allowing you to call them in the same way on the client or the server.
 * #### Sharing an API for Remoting:
 * For APIs to be available over remoting, they need to be shared with the `RemotingHandler`.
 * The easiest way to do this is to create a `UFApiContext` class with each of the APIs you wish to share, and set it as the `remotingApi` in your given `UfrontConfiguration`.
 * #### Injections:
 * The following injections are required for a `UFApi` class to function correctly:
 * - `auth`: A `UFAuthHandler` that the API can use to check permissions for certain actions. (Server only).
 * - `messages`: A `MessageList` used to track `ufTrace`, `ufLog`, `ufWarn` and `uferror` calls and send them to the appropriate output. (Server only).
 * - `cnx`: A `haxe.remoting.Connection` used to send synchronous HTTP remoting calls. (Client only).
 * Because APIs are usually created through dependency injection, you can also add other injections to your APIs:
 * ```haxe
 * @inject public var mailer:UFMailer;
 * @inject public var loginApi:LoginApi;
 * @inject("contentDirectory") public var contentDir:String;
 * var doc:Document;
 * @inject public function getDocument( ds:DocumentStore ) {
 * doc = ds.get( "myDocument" );
 * }
 * ```
 * Remember that injections points must be public to be recognised by `minject`.
 * All APIs will be available in the dependency injector for each request, so you can use them in other APIs, your Controllers etc.
 * #### Logging Functions:
 * Because Ufront may be used in a multi-threaded and multi-request environment, the static `haxe.Log.trace()` function does not send output to the client unless compiled with `-debug`.
 * Similar to our `Controller` class, `UFApi` provides some helpers: `ufTrace()`, `ufLog()`, `ufWarn()` and `ufError()`.
 * These will be sent to all the relevant `UFLogHandler` instances - including to the browser console - when called through both remoting requests and regular web requests.
 * #### Checking Authorization:
 * An `auth` object is injected in each `UFApi`. You can use it to check permissions:
 * ```haxe
 * if ( auth.hasPermission( CanDeletePosts ) ) { ... }
 * auth.requirePermission( CanDeletePosts ); // Throw an error if they do not have permission.
 * if ( auth.currentUser.id!=document.owner.id ) { ... }
 * ```
 * #### Security Note:
 * It is wise to do your authentication checks in your server rather than your controllers.
 * If you choose to run your controllers on the client, or expose the API over remoting, you risk somebody bypassing the security checks.
 * Placing your checks in the API ensures they will always run on a server before you allow a certain action to take place.
 * See `UFAuthHandler` for a complete description of the API.
 */
class UFApi {


	/**
	 * @var UFAuthHandler
	 * The current `UFAuthHandler`.
	 * You can use this to check permissions etc.
	 * This is inserted via dependency injection.
	 * This property only exists when compiled with `-D server`.
	 */
	public $auth;
	/**
	 * @var MessageList
	 * The messages list.
	 * When called from a web context, this will usually result in the HttpContext's `messages` array being pushed to so your log handlers can handle the messages appropriately.
	 * This is inserted via dependency injection, and must be injected for `ufTrace`, `ufLog`, `ufWarn` and `ufError` to function correctly.
	 * This property only exists when compiled with `-D server`.
	 */
	public $messages;


	/**
	 * An empty constructor.
	 * It is recommended you use dependency injection to get instances of your APIs.
	 * 
	 * @return void
	 */
	public function __construct () {
	}


	/**
	 * Print the current class name.
	 * 
	 * @return string
	 */
	public function toString () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/api/UFApi.hx:236: characters 3-50
		return \Type::getClassName(\Type::getClass($this));
	}


	/**
	 * A shortcut to `HttpContext.ufError`
	 * A `messages` array must be injected for these to function correctly.  Use `ufront.web.MVCHandler` and `ufront.remoting.RemotingHandler` to inject this correctly.
	 * 
	 * @param mixed $msg
	 * @param object $pos
	 * 
	 * @return void
	 */
	public function ufError ($msg, $pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/api/UFApi.hx:207: characters 4-54
		$this->messages->push(new HxAnon([
			"msg" => $msg,
			"pos" => $pos,
			"type" => MessageType::MError(),
		]));
	}


	/**
	 * A shortcut to `HttpContext.ufLog`
	 * A `messages` array must be injected for these to function correctly.  Use `ufront.web.MVCHandler` and `ufront.remoting.RemotingHandler` to inject this correctly.
	 * 
	 * @param mixed $msg
	 * @param object $pos
	 * 
	 * @return void
	 */
	public function ufLog ($msg, $pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/api/UFApi.hx:187: characters 4-52
		$this->messages->push(new HxAnon([
			"msg" => $msg,
			"pos" => $pos,
			"type" => MessageType::MLog(),
		]));
	}


	/**
	 * A shortcut to `HttpContext.ufTrace`
	 * A `messages` array must be injected for these to function correctly.  Use `ufront.web.MVCHandler` and `ufront.remoting.RemotingHandler` to inject this correctly.
	 * 
	 * @param mixed $msg
	 * @param object $pos
	 * 
	 * @return void
	 */
	public function ufTrace ($msg, $pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/api/UFApi.hx:177: characters 4-54
		$this->messages->push(new HxAnon([
			"msg" => $msg,
			"pos" => $pos,
			"type" => MessageType::MTrace(),
		]));
	}


	/**
	 * A shortcut to `HttpContext.ufWarn`
	 * A `messages` array must be injected for these to function correctly.  Use `ufront.web.MVCHandler` and `ufront.remoting.RemotingHandler` to inject this correctly.
	 * 
	 * @param mixed $msg
	 * @param object $pos
	 * 
	 * @return void
	 */
	public function ufWarn ($msg, $pos = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/api/UFApi.hx:197: characters 4-56
		$this->messages->push(new HxAnon([
			"msg" => $msg,
			"pos" => $pos,
			"type" => MessageType::MWarning(),
		]));
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


Boot::registerClass(UFApi::class, 'ufront.api.UFApi');
Boot::registerMeta(UFApi::class, new HxAnon(["obj" => new HxAnon(["rtti" => \Array_hx::wrap([
	\Array_hx::wrap([
		"auth",
		"ufront.auth.UFAuthHandler",
		"",
	]),
	\Array_hx::wrap([
		"messages",
		"ufront.log.MessageList",
		"",
	]),
])])]));
UFApi::__hx__init();
