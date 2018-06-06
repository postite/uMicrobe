<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx
 */

namespace ufront\web\url;

use \php\Boot;
use \php\_Boot\HxAnon;

/**
 * A `PartialUrl` is an object representing a URL, but including only the path, the querystring (following a `?`), and the segment (following a `#`).
 * It does not include the protocol, the domain name, the port, or any inline authentication.
 * It is used by Ufront to filter URLs received from the web server, into a normalized format which the app can use for routing etc.
 * The related `VirtualUrl` is used for the reverse operation: transforming a normalized URL from the app into a raw path recognisable by the web server.
 */
class PartialUrl {
	/**
	 * @var string
	 * The fragment or anchor link, which follows a `#` character.
	 */
	public $fragment;
	/**
	 * @var \Array_hx
	 * The parts of the query string, following a `?` character.
	 */
	public $query;
	/**
	 * @var \Array_hx
	 * The segments in the URL path, separated by a `/`.
	 */
	public $segments;


	/**
	 * Process a URL string and feed it into the given `PartialUrl` object.
	 * 
	 * @param PartialUrl $u
	 * @param string $url
	 * 
	 * @return void
	 */
	static public function feed ($u, $url) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:40: characters 3-32
		$parts = \Array_hx::wrap(explode("#", $url));
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:41: lines 41-42
		if ($parts->length > 1) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:42: characters 4-25
			$u->fragment = ($parts->arr[1] ?? null);
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:43: characters 11-32
		$_this = ($parts->arr[0] ?? null);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:43: characters 11-32
		$parts = \Array_hx::wrap(explode("?", $_this));
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:44: lines 44-50
		if ($parts->length > 1) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:45: characters 16-37
			$_this1 = ($parts->arr[1] ?? null);
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:45: characters 4-38
			$pairs = \Array_hx::wrap(explode("&", $_this1));
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:46: lines 46-49
			$_g = 0;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:46: lines 46-49
			while ($_g < $pairs->length) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:46: characters 9-10
				$s = ($pairs->arr[$_g] ?? null);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:46: lines 46-49
				$_g = $_g + 1;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:47: characters 5-31
				$pair = \Array_hx::wrap(explode("=", $s));
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:48: characters 5-64
				$_this2 = $u->query;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:48: characters 5-64
				$_this2->arr[$_this2->length] = new HxAnon([
					"name" => ($pair->arr[0] ?? null),
					"value" => ($pair->arr[1] ?? null),
					"encoded" => true,
				]);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:48: characters 5-64
				++$_this2->length;

			}

		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:51: characters 18-39
		$_this3 = ($parts->arr[0] ?? null);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:51: characters 3-40
		$segments = \Array_hx::wrap(explode("/", $_this3));
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:52: lines 52-53
		if (($segments->arr[0] ?? null) === "") {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:53: characters 4-20
			if ($segments->length > 0) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:53: characters 4-20
				$segments->length--;
			}
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:53: characters 4-20
			array_shift($segments->arr);
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:54: lines 54-55
		if (($segments->length === 1) && (($segments->arr[0] ?? null) === "")) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:55: characters 4-18
			if ($segments->length > 0) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:55: characters 4-18
				$segments->length--;
			}
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:55: characters 4-18
			array_pop($segments->arr);
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:56: characters 3-24
		$u->segments = $segments;
	}


	/**
	 * Parse a URL into a `PartialUrl` object.
	 * 
	 * @param string $url
	 * 
	 * @return PartialUrl
	 */
	static public function parse ($url) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:33: characters 3-28
		$u = new PartialUrl();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:34: characters 3-17
		PartialUrl::feed($u, $url);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:35: characters 3-11
		return $u;
	}


	/**
	 * Create an empty `PartialUrl` object.
	 * See `PartialUrl.parse()` for iniating a URL from a `String`.
	 * 
	 * @return void
	 */
	public function __construct () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:26: characters 3-16
		$this->segments = new \Array_hx();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:27: characters 3-16
		$this->query = new \Array_hx();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:28: characters 3-18
		$this->fragment = null;
	}


	/**
	 * Print the current `query` into a query string, being sure to encode any values correctly.
	 * 
	 * @return string
	 */
	public function queryString () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:61: characters 3-19
		$params = new \Array_hx();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:62: lines 62-65
		$_g = 0;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:62: lines 62-65
		$_g1 = $this->query;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:62: lines 62-65
		while ($_g < $_g1->length) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:62: characters 8-13
			$param = ($_g1->arr[$_g] ?? null);
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:62: lines 62-65
			$_g = $_g + 1;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:63: characters 4-85
			$value = ($param->encoded ? $param->value : rawurlencode($param->value));
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:64: characters 4-39
			$params->arr[$params->length] = ($param->name??'null') . "=" . ($value??'null');
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:64: characters 4-39
			++$params->length;

		}

		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:66: characters 3-28
		return $params->join("&");
	}


	/**
	 * Print the current URL as a string, including path, querystring and fragment.
	 * 
	 * @return string
	 */
	public function toString () {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:71: characters 3-40
		$url = "/" . ($this->segments->join("/")??'null');
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:72: characters 3-26
		$qs = $this->queryString();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:73: lines 73-74
		if (strlen($qs) > 0) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:74: characters 4-19
			$url = ($url??'null') . (("?" . ($qs??'null'))??'null');
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:75: lines 75-76
		if (null !== $this->fragment) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:76: characters 4-25
			$url = ($url??'null') . (("#" . ($this->fragment??'null'))??'null');
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/PartialUrl.hx:77: characters 3-13
		return $url;
	}


	public function __toString() {
		return $this->toString();
	}
}


Boot::registerClass(PartialUrl::class, 'ufront.web.url.PartialUrl');