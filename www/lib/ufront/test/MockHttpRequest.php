<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx
 */

namespace ufront\test;

use \haxe\ds\StringMap;
use \php\Boot;
use \php\_Boot\HxException;
use \ufront\web\UserAgent;
use \tink\core\_Future\FutureObject;
use \ufront\web\context\HttpRequest;
use \ufront\core\_MultiValueMap\MultiValueMap_Impl_;
use \php\_Boot\HxAnon;
use \ufront\web\HttpError;

/**
 * A mock HttpRequest class that allows you to emulate HTTP requests.
 * This is used throughout by `ufront.test.TestUtils`.
 * Each property has a corresponding setter method, for example `params` and `setParams()`.
 * The setter methods return the `MockHttpRequest`, and can be used in a fluid way:
 * ```haxe
 * var request =
 * new MockHttpRequest( "/index.html" )
 * .setHttpMethod( "POST" )
 * .setPost([ "name": "Jason O'Neil" ])
 * .setCookies([ "sessionID": "0" ])
 * .setIsMultipart( false );
 * ```
 */
class MockHttpRequest extends HttpRequest {
	/**
	 * Create a new MockHttpRequest, optionally specifying the uri.
	 * If the uri is not specified, the default "/" will be used.
	 * 
	 * @param string $uri
	 * 
	 * @return void
	 */
	public function __construct ($uri = "/") {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:35: lines 35-51
		if ($uri === null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:35: lines 35-51
			$uri = "/";
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:36: characters 3-23
		$this->setQueryString("");
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:37: characters 3-22
		$this->setPostString("");
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:38: characters 3-24
		$this->setQuery(new StringMap());
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:39: characters 3-23
		$this->setPost(new StringMap());
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:40: characters 3-24
		$this->setFiles(new StringMap());
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:41: characters 3-26
		$this->setCookies(new StringMap());
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:42: characters 3-29
		$this->setHostName("localhost");
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:43: characters 3-29
		$this->setClientIP("127.0.0.1");
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:44: characters 3-16
		$this->setUri($uri);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:45: characters 21-55
		$this1 = new StringMap();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:45: characters 21-55
		$this2 = $this1;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:45: characters 3-57
		$this->setClientHeaders($this2);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:46: characters 3-119
		$this->setUserAgent(UserAgent::fromString("Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0"));
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:47: characters 3-25
		$this->setHttpMethod("GET");
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:48: characters 3-36
		$this->setScriptDirectory("/var/www/");
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:49: characters 3-27
		$this->setAuthorization(null);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:50: characters 3-26
		$this->setIsMultipart(false);
	}


	/**
	 * @return object
	 */
	public function get_authorization () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:140: characters 69-89
		return $this->authorization;
	}


	/**
	 * @return StringMap
	 */
	public function get_clientHeaders () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:116: characters 77-97
		return $this->clientHeaders;
	}


	/**
	 * @return string
	 */
	public function get_clientIP () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:104: characters 42-57
		return $this->clientIP;
	}


	/**
	 * @return StringMap
	 */
	public function get_cookies () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:92: characters 56-70
		return $this->cookies;
	}


	/**
	 * @return StringMap
	 */
	public function get_files () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:86: characters 60-72
		return $this->files;
	}


	/**
	 * @return string
	 */
	public function get_hostName () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:98: characters 42-57
		return $this->hostName;
	}


	/**
	 * @return string
	 */
	public function get_httpMethod () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:128: characters 44-61
		return $this->httpMethod;
	}


	/**
	 * @return StringMap
	 */
	public function get_post () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:80: characters 53-64
		return $this->post;
	}


	/**
	 * @return string
	 */
	public function get_postString () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:68: characters 44-61
		return $this->postString;
	}


	/**
	 * @return StringMap
	 */
	public function get_query () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:74: characters 54-66
		return $this->query;
	}


	/**
	 * @return string
	 */
	public function get_queryString () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:62: characters 45-63
		return $this->queryString;
	}


	/**
	 * @return string
	 */
	public function get_scriptDirectory () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:134: characters 49-71
		return $this->scriptDirectory;
	}


	/**
	 * @return string
	 */
	public function get_uri () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:110: characters 37-47
		return $this->uri;
	}


	/**
	 * @return UserAgent
	 */
	public function get_userAgent () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:122: characters 46-62
		return $this->userAgent;
	}


	/**
	 * Please note, `parseMultipart` is not supported and cannot be mocked.
	 * You can instead use `this.setPost` and `this.setFiles` to mock the higher level API.
	 * 
	 * @param \Closure $onPart
	 * @param \Closure $onData
	 * @param \Closure $onEndPart
	 * 
	 * @return FutureObject
	 */
	public function parseMultipart ($onPart = null, $onData = null, $onEndPart = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:158: characters 151-156
		throw new HxException(HttpError::wrap("parseMultipart is not supported in MockHttpRequest", null, new HxAnon([
			"fileName" => "ufront/test/MockHttpRequest.hx",
			"lineNumber" => 158,
			"className" => "ufront.test.MockHttpRequest",
			"methodName" => "parseMultipart",
		])));
	}


	/**
	 * @param object $authorization
	 * 
	 * @return MockHttpRequest
	 */
	public function setAuthorization ($authorization) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:142: characters 3-37
		$this->authorization = $authorization;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:143: characters 3-14
		return $this;
	}


	/**
	 * @param StringMap $clientHeaders
	 * 
	 * @return MockHttpRequest
	 */
	public function setClientHeaders ($clientHeaders) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:118: characters 3-37
		$this->clientHeaders = $clientHeaders;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:119: characters 3-14
		return $this;
	}


	/**
	 * @param string $clientIP
	 * 
	 * @return MockHttpRequest
	 */
	public function setClientIP ($clientIP) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:106: characters 3-27
		$this->clientIP = $clientIP;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:107: characters 3-14
		return $this;
	}


	/**
	 * @param StringMap $cookies
	 * 
	 * @return MockHttpRequest
	 */
	public function setCookies ($cookies) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:94: characters 3-25
		$this->cookies = $cookies;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:95: characters 3-14
		return $this;
	}


	/**
	 * @param StringMap $files
	 * 
	 * @return MockHttpRequest
	 */
	public function setFiles ($files) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:88: characters 3-21
		$this->files = $files;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:89: characters 3-14
		return $this;
	}


	/**
	 * @param string $hostName
	 * 
	 * @return MockHttpRequest
	 */
	public function setHostName ($hostName) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:100: characters 3-27
		$this->hostName = $hostName;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:101: characters 3-14
		return $this;
	}


	/**
	 * @param string $httpMethod
	 * 
	 * @return MockHttpRequest
	 */
	public function setHttpMethod ($httpMethod) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:130: characters 3-31
		$this->httpMethod = $httpMethod;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:131: characters 3-14
		return $this;
	}


	/**
	 * @param bool $isMultipart
	 * 
	 * @return MockHttpRequest
	 */
	public function setIsMultipart ($isMultipart) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:147: lines 147-150
		if ($isMultipart) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:148: characters 4-77
			MultiValueMap_Impl_::set($this->get_clientHeaders(), strtolower("Content-Type"), "multipart/form-data; charset=UTF-8");
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:150: characters 4-91
			MultiValueMap_Impl_::set($this->get_clientHeaders(), strtolower("Content-Type"), "application/x-www-form-urlencoded; charset=UTF-8");
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:151: characters 3-14
		return $this;
	}


	/**
	 * Set a custom `params` map.
	 * If you do not set this, `params` will default to the combined values of `post`, `query`, and `cookies` the first time it is accessed.
	 * 
	 * @param StringMap $params
	 * 
	 * @return MockHttpRequest
	 */
	public function setParams ($params) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:58: characters 3-23
		$this->params = $params;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:59: characters 3-14
		return $this;
	}


	/**
	 * @param StringMap $post
	 * 
	 * @return MockHttpRequest
	 */
	public function setPost ($post) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:82: characters 3-19
		$this->post = $post;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:83: characters 3-14
		return $this;
	}


	/**
	 * @param string $ps
	 * 
	 * @return MockHttpRequest
	 */
	public function setPostString ($ps) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:70: characters 3-23
		$this->postString = $ps;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:71: characters 3-14
		return $this;
	}


	/**
	 * @param StringMap $query
	 * 
	 * @return MockHttpRequest
	 */
	public function setQuery ($query) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:76: characters 3-21
		$this->query = $query;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:77: characters 3-14
		return $this;
	}


	/**
	 * @param string $qs
	 * 
	 * @return MockHttpRequest
	 */
	public function setQueryString ($qs) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:64: characters 2-18
		$this->queryString = $qs;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:65: characters 2-13
		return $this;
	}


	/**
	 * @param string $scriptDirectory
	 * 
	 * @return MockHttpRequest
	 */
	public function setScriptDirectory ($scriptDirectory) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:136: characters 3-41
		$this->scriptDirectory = $scriptDirectory;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:137: characters 3-14
		return $this;
	}


	/**
	 * @param string $uri
	 * 
	 * @return MockHttpRequest
	 */
	public function setUri ($uri) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:112: characters 3-17
		$this->uri = $uri;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:113: characters 3-14
		return $this;
	}


	/**
	 * @param UserAgent $userAgent
	 * 
	 * @return MockHttpRequest
	 */
	public function setUserAgent ($userAgent) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:124: characters 3-29
		$this->userAgent = $userAgent;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/test/MockHttpRequest.hx:125: characters 3-14
		return $this;
	}
}


Boot::registerClass(MockHttpRequest::class, 'ufront.test.MockHttpRequest');
