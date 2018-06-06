<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/php/Web.hx
 */

namespace php;

use \haxe\ds\StringMap;
use \php\_Boot\HxException;
use \php\_NativeArray\NativeArrayIterator;
use \php\_Boot\HxString;
use \haxe\io\Bytes;
use \haxe\io\_BytesData\Container;
use \haxe\ds\List_hx;
use \php\_Boot\HxAnon;

/**
 * This class is used for accessing the local Web server and the current
 * client request and information.
 */
class Web {
	/**
	 * @var StringMap
	 */
	static public $_clientHeaders;
	/**
	 * @var bool
	 */
	static public $isModNeko;


	/**
	 * Flush the data sent to the client. By default on Apache, outgoing data is buffered so
	 * this can be useful for displaying some long operation progress.
	 * 
	 * @return void
	 */
	static public function flush () {
		#/usr/local/lib/haxe/std/php/Web.hx:404: characters 3-17
		flush();
	}


	/**
	 * Returns an object with the authorization sent by the client (Basic scheme only).
	 * 
	 * @return object
	 */
	static public function getAuthorization () {
		#/usr/local/lib/haxe/std/php/Web.hx:308: lines 308-309
		if (!isset($_SERVER["PHP_AUTH_USER"])) {
			#/usr/local/lib/haxe/std/php/Web.hx:309: characters 4-15
			return null;
		}
		#/usr/local/lib/haxe/std/php/Web.hx:310: characters 17-41
		$tmp = $_SERVER["PHP_AUTH_USER"];
		#/usr/local/lib/haxe/std/php/Web.hx:310: characters 3-72
		return new HxAnon([
			"user" => $tmp,
			"pass" => $_SERVER["PHP_AUTH_PW"],
		]);
	}


	/**
	 * Retrieve a client header value sent with the request.
	 * 
	 * @param string $k
	 * 
	 * @return string
	 */
	static public function getClientHeader ($k) {
		#/usr/local/lib/haxe/std/php/Web.hx:188: characters 10-36
		return (Web::loadClientHeaders()->data[$k] ?? null);
	}


	/**
	 * Retrieve all the client headers.
	 * 
	 * @return List_hx
	 */
	static public function getClientHeaders () {
		#/usr/local/lib/haxe/std/php/Web.hx:242: characters 3-37
		$headers = Web::loadClientHeaders();
		#/usr/local/lib/haxe/std/php/Web.hx:243: characters 3-27
		$result = new List_hx();
		#/usr/local/lib/haxe/std/php/Web.hx:244: characters 14-28
		$key = new NativeArrayIterator(array_map("strval", array_keys($headers->data)));
		#/usr/local/lib/haxe/std/php/Web.hx:244: characters 14-28
		while ($key->hasNext()) {
			#/usr/local/lib/haxe/std/php/Web.hx:244: lines 244-246
			$key1 = $key->next();
			#/usr/local/lib/haxe/std/php/Web.hx:245: characters 4-53
			$result->push(new HxAnon([
				"value" => ($headers->data[$key1] ?? null),
				"header" => $key1,
			]));
		}

		#/usr/local/lib/haxe/std/php/Web.hx:247: characters 3-16
		return $result;
	}


	/**
	 * Surprisingly returns the client IP address.
	 * 
	 * @return string
	 */
	static public function getClientIP () {
		#/usr/local/lib/haxe/std/php/Web.hx:106: characters 10-32
		return $_SERVER["REMOTE_ADDR"];
	}


	/**
	 * Returns an hashtable of all Cookies sent by the client.
	 * Modifying the hashtable will not modify the cookie, use `php.Web.setCookie()`
	 * instead.
	 * 
	 * @return StringMap
	 */
	static public function getCookies () {
		#/usr/local/lib/haxe/std/php/Web.hx:288: characters 3-45
		return Lib::hashOfAssociativeArray($_COOKIE);
	}


	/**
	 * Get the current script directory in the local filesystem.
	 * 
	 * @return string
	 */
	static public function getCwd () {
		#/usr/local/lib/haxe/std/php/Web.hx:317: characters 3-51
		return (dirname($_SERVER["SCRIPT_FILENAME"])??'null') . "/";
	}


	/**
	 * Returns the local server host name.
	 * 
	 * @return string
	 */
	static public function getHostName () {
		#/usr/local/lib/haxe/std/php/Web.hx:99: characters 10-32
		return $_SERVER["SERVER_NAME"];
	}


	/**
	 * Get the HTTP method used by the client.
	 * 
	 * @return string
	 */
	static public function getMethod () {
		#/usr/local/lib/haxe/std/php/Web.hx:411: lines 411-414
		if (isset($_SERVER["REQUEST_METHOD"])) {
			#/usr/local/lib/haxe/std/php/Web.hx:412: characters 11-36
			return $_SERVER["REQUEST_METHOD"];
		} else {
			#/usr/local/lib/haxe/std/php/Web.hx:414: characters 4-15
			return null;
		}
	}


	/**
	 * Get the multipart parameters as an hashtable. The data
	 * cannot exceed the maximum size specified.
	 * 
	 * @param int $maxSize
	 * 
	 * @return StringMap
	 */
	static public function getMultipart ($maxSize) {
		#/usr/local/lib/haxe/std/php/Web.hx:325: characters 3-35
		$h = new StringMap();
		#/usr/local/lib/haxe/std/php/Web.hx:326: characters 3-30
		$buf = null;
		#/usr/local/lib/haxe/std/php/Web.hx:327: characters 3-22
		$curname = null;
		#/usr/local/lib/haxe/std/php/Web.hx:328: lines 328-341
		Web::parseMultipart(function ($p, $_)  use (&$buf, &$maxSize, &$curname, &$h) {
			#/usr/local/lib/haxe/std/php/Web.hx:329: lines 329-330
			if ($curname !== null) {
				#/usr/local/lib/haxe/std/php/Web.hx:330: characters 5-34
				$h->data[$curname] = $buf->b;
			}
			#/usr/local/lib/haxe/std/php/Web.hx:331: characters 4-15
			$curname = $p;
			#/usr/local/lib/haxe/std/php/Web.hx:332: characters 4-25
			$buf = new \StringBuf();
			#/usr/local/lib/haxe/std/php/Web.hx:333: characters 4-23
			$maxSize = $maxSize - strlen($p);
			#/usr/local/lib/haxe/std/php/Web.hx:334: lines 334-335
			if ($maxSize < 0) {
				#/usr/local/lib/haxe/std/php/Web.hx:335: characters 5-10
				throw new HxException("Maximum size reached");
			}
		}, function ($str, $pos, $len)  use (&$buf, &$maxSize) {
			#/usr/local/lib/haxe/std/php/Web.hx:337: characters 4-18
			$maxSize = $maxSize - $len;
			#/usr/local/lib/haxe/std/php/Web.hx:338: lines 338-339
			if ($maxSize < 0) {
				#/usr/local/lib/haxe/std/php/Web.hx:339: characters 5-10
				throw new HxException("Maximum size reached");
			}
			#/usr/local/lib/haxe/std/php/Web.hx:340: characters 4-38
			$s = $str->toString();
			#/usr/local/lib/haxe/std/php/Web.hx:340: characters 4-7
			$buf1 = $buf;
			#/usr/local/lib/haxe/std/php/Web.hx:340: characters 4-38
			$buf1->b = ($buf1->b??'null') . (HxString::substr($s, $pos, $len)??'null');

		});
		#/usr/local/lib/haxe/std/php/Web.hx:342: lines 342-343
		if ($curname !== null) {
			#/usr/local/lib/haxe/std/php/Web.hx:343: characters 4-33
			$h->data[$curname] = $buf->b;
		}
		#/usr/local/lib/haxe/std/php/Web.hx:344: characters 3-11
		return $h;
	}


	/**
	 * Returns an Array of Strings built using GET / POST values.
	 * If you have in your URL the parameters `a[]=foo;a[]=hello;a[5]=bar;a[3]=baz` then
	 * `php.Web.getParamValues("a")` will return `["foo","hello",null,"baz",null,"bar"]`.
	 * 
	 * @param string $param
	 * 
	 * @return \Array_hx
	 */
	static public function getParamValues ($param) {
		#/usr/local/lib/haxe/std/php/Web.hx:61: characters 3-74
		$reg = new \EReg("^" . ($param??'null') . "(\\[|%5B)([0-9]*?)(\\]|%5D)=(.*?)\$", "");
		#/usr/local/lib/haxe/std/php/Web.hx:62: characters 3-33
		$res = new \Array_hx();
		#/usr/local/lib/haxe/std/php/Web.hx:63: lines 63-76
		$explore = function ($data)  use (&$reg, &$res) {
			#/usr/local/lib/haxe/std/php/Web.hx:64: lines 64-65
			if (($data === null) || (strlen($data) === 0)) {
				#/usr/local/lib/haxe/std/php/Web.hx:65: characters 5-11
				return;
			}
			#/usr/local/lib/haxe/std/php/Web.hx:66: lines 66-75
			$_g = 0;
			#/usr/local/lib/haxe/std/php/Web.hx:66: lines 66-75
			$_g1 = \Array_hx::wrap(explode("&", $data));
			#/usr/local/lib/haxe/std/php/Web.hx:66: lines 66-75
			while ($_g < $_g1->length) {
				#/usr/local/lib/haxe/std/php/Web.hx:66: characters 9-13
				$part = ($_g1->arr[$_g] ?? null);
				#/usr/local/lib/haxe/std/php/Web.hx:66: lines 66-75
				$_g = $_g + 1;
				#/usr/local/lib/haxe/std/php/Web.hx:67: lines 67-74
				if ($reg->match($part)) {
					#/usr/local/lib/haxe/std/php/Web.hx:68: characters 6-31
					$idx = $reg->matched(2);
					#/usr/local/lib/haxe/std/php/Web.hx:69: characters 6-54
					$val = urldecode($reg->matched(4));
					#/usr/local/lib/haxe/std/php/Web.hx:70: lines 70-73
					if ($idx === "") {
						#/usr/local/lib/haxe/std/php/Web.hx:71: characters 7-20
						$res->arr[$res->length] = $val;
						#/usr/local/lib/haxe/std/php/Web.hx:71: characters 7-20
						++$res->length;
					} else {
						#/usr/local/lib/haxe/std/php/Web.hx:73: characters 11-28
						$explore1 = \Std::parseInt($idx);
						#/usr/local/lib/haxe/std/php/Web.hx:73: characters 7-35
						$res[$explore1] = $val;
					}
				}
			}

		};
		#/usr/local/lib/haxe/std/php/Web.hx:77: characters 3-60
		$explore(\StringTools::replace(Web::getParamsString(), ";", "&"));
		#/usr/local/lib/haxe/std/php/Web.hx:78: characters 3-25
		$explore(Web::getPostData());
		#/usr/local/lib/haxe/std/php/Web.hx:80: lines 80-88
		if ($res->length === 0) {
			#/usr/local/lib/haxe/std/php/Web.hx:81: characters 4-76
			$post = Lib::hashOfAssociativeArray($_POST);
			#/usr/local/lib/haxe/std/php/Web.hx:82: characters 4-31
			$data1 = ($post->data[$param] ?? null);
			#/usr/local/lib/haxe/std/php/Web.hx:83: lines 83-87
			if (is_array($data1)) {
				#/usr/local/lib/haxe/std/php/Web.hx:84: lines 84-86
				foreach ($data1 as $key => $value) {
					#/usr/local/lib/haxe/std/php/Web.hx:85: characters 6-22
					$res[$key] = $value;
				};
			}
		}
		#/usr/local/lib/haxe/std/php/Web.hx:90: lines 90-91
		if ($res->length === 0) {
			#/usr/local/lib/haxe/std/php/Web.hx:91: characters 4-15
			return null;
		}
		#/usr/local/lib/haxe/std/php/Web.hx:92: characters 3-13
		return $res;
	}


	/**
	 * Returns the GET and POST parameters.
	 * 
	 * @return StringMap
	 */
	static public function getParams () {
		#/usr/local/lib/haxe/std/php/Web.hx:51: characters 3-62
		return Lib::hashOfAssociativeArray(array_merge($_GET, $_POST));
	}


	/**
	 * Returns all the GET parameters `String`
	 * 
	 * @return string
	 */
	static public function getParamsString () {
		#/usr/local/lib/haxe/std/php/Web.hx:254: lines 254-257
		if (isset($_SERVER["QUERY_STRING"])) {
			#/usr/local/lib/haxe/std/php/Web.hx:255: characters 11-34
			return $_SERVER["QUERY_STRING"];
		} else {
			#/usr/local/lib/haxe/std/php/Web.hx:257: characters 4-13
			return "";
		}
	}


	/**
	 * Returns all the POST data. POST Data is always parsed as
	 * being application/x-www-form-urlencoded and is stored into
	 * the getParams hashtable. POST Data is maximimized to 256K
	 * unless the content type is multipart/form-data. In that
	 * case, you will have to use `php.Web.getMultipart()` or
	 * `php.Web.parseMultipart()` methods.
	 * 
	 * @return string
	 */
	static public function getPostData () {
		#/usr/local/lib/haxe/std/php/Web.hx:269: characters 3-37
		$h = fopen("php://input", "r");
		#/usr/local/lib/haxe/std/php/Web.hx:270: characters 3-20
		$bsize = 8192;
		#/usr/local/lib/haxe/std/php/Web.hx:271: characters 3-16
		$max = 32;
		#/usr/local/lib/haxe/std/php/Web.hx:272: characters 3-28
		$data = null;
		#/usr/local/lib/haxe/std/php/Web.hx:273: characters 3-19
		$counter = 0;
		#/usr/local/lib/haxe/std/php/Web.hx:274: lines 274-277
		while (!feof($h) && ($counter < $max)) {
			#/usr/local/lib/haxe/std/php/Web.hx:275: characters 11-47
			$data = ($data . fread($h, $bsize));
			#/usr/local/lib/haxe/std/php/Web.hx:276: characters 4-13
			$counter = $counter + 1;
		}
		#/usr/local/lib/haxe/std/php/Web.hx:278: characters 3-12
		fclose($h);
		#/usr/local/lib/haxe/std/php/Web.hx:279: characters 3-14
		return $data;
	}


	/**
	 * Returns the original request URL (before any server internal redirections).
	 * 
	 * @return string
	 */
	static public function getURI () {
		#/usr/local/lib/haxe/std/php/Web.hx:113: characters 3-43
		$s = $_SERVER["REQUEST_URI"];
		#/usr/local/lib/haxe/std/php/Web.hx:114: characters 3-25
		return (\Array_hx::wrap(explode("?", $s))->arr[0] ?? null);
	}


	/**
	 * Based on https://github.com/ralouphie/getallheaders
	 * 
	 * @return StringMap
	 */
	static public function loadClientHeaders () {
		#/usr/local/lib/haxe/std/php/Web.hx:197: characters 3-51
		if (Web::$_clientHeaders !== null) {
			#/usr/local/lib/haxe/std/php/Web.hx:197: characters 30-51
			return Web::$_clientHeaders;
		}
		#/usr/local/lib/haxe/std/php/Web.hx:199: characters 3-17
		Web::$_clientHeaders = new StringMap();
		#/usr/local/lib/haxe/std/php/Web.hx:201: lines 201-206
		if (function_exists("getallheaders")) {
			#/usr/local/lib/haxe/std/php/Web.hx:202: lines 202-204
			foreach ((getallheaders()) as $key => $value) {
				#/usr/local/lib/haxe/std/php/Web.hx:203: characters 5-47
				$this1 = Web::$_clientHeaders;
				#/usr/local/lib/haxe/std/php/Web.hx:203: characters 5-47
				$value1 = \Std::string($value);
				#/usr/local/lib/haxe/std/php/Web.hx:203: characters 5-47
				$this1->data[$key] = $value1;
			};
			#/usr/local/lib/haxe/std/php/Web.hx:205: characters 4-25
			return Web::$_clientHeaders;
		}
		#/usr/local/lib/haxe/std/php/Web.hx:208: lines 208-212
		$copyServer_data = null;
		#/usr/local/lib/haxe/std/php/Web.hx:208: lines 208-212
		$this2 = [];
		#/usr/local/lib/haxe/std/php/Web.hx:208: lines 208-212
		$copyServer_data = $this2;
		#/usr/local/lib/haxe/std/php/Web.hx:208: lines 208-212
		$copyServer_data["CONTENT_TYPE"] = "Content-Type";
		#/usr/local/lib/haxe/std/php/Web.hx:208: lines 208-212
		$copyServer_data["CONTENT_LENGTH"] = "Content-Length";
		#/usr/local/lib/haxe/std/php/Web.hx:208: lines 208-212
		$copyServer_data["CONTENT_MD5"] = "Content-Md5";
		#/usr/local/lib/haxe/std/php/Web.hx:213: lines 213-223
		foreach (($_SERVER) as $key1 => $value2) {
			#/usr/local/lib/haxe/std/php/Web.hx:214: lines 214-222
			if (substr($key1, 0, 5) === "HTTP_") {
				#/usr/local/lib/haxe/std/php/Web.hx:215: characters 5-8
				$key1 = substr($key1, 5);
				#/usr/local/lib/haxe/std/php/Web.hx:216: lines 216-219
				if (!array_key_exists($key1, $copyServer_data) || !isset($_SERVER[$key1])) {
					#/usr/local/lib/haxe/std/php/Web.hx:217: characters 6-9
					$key1 = str_replace(" ", "-", ucwords(strtolower(str_replace("_", " ", $key1))));
					#/usr/local/lib/haxe/std/php/Web.hx:218: characters 6-45
					$this3 = Web::$_clientHeaders;
					#/usr/local/lib/haxe/std/php/Web.hx:218: characters 6-45
					$v = \Std::string($value2);
					#/usr/local/lib/haxe/std/php/Web.hx:218: characters 6-45
					$this3->data[$key1] = $v;

				}
			} else if (($copyServer_data[$key1] ?? null) !== null) {
				#/usr/local/lib/haxe/std/php/Web.hx:221: characters 5-56
				$this4 = Web::$_clientHeaders;
				#/usr/local/lib/haxe/std/php/Web.hx:221: characters 5-56
				$k = ($copyServer_data[$key1] ?? null);
				#/usr/local/lib/haxe/std/php/Web.hx:221: characters 5-56
				$v1 = \Std::string($value2);
				#/usr/local/lib/haxe/std/php/Web.hx:221: characters 5-56
				$this4->data[$k] = $v1;
			}
		};
		#/usr/local/lib/haxe/std/php/Web.hx:224: lines 224-233
		if (!array_key_exists("Authorization", Web::$_clientHeaders->data)) {
			#/usr/local/lib/haxe/std/php/Web.hx:225: lines 225-232
			if (isset($_SERVER["REDIRECT_HTTP_AUTHORIZATION"])) {
				#/usr/local/lib/haxe/std/php/Web.hx:226: characters 5-89
				$this5 = Web::$_clientHeaders;
				#/usr/local/lib/haxe/std/php/Web.hx:226: characters 5-89
				$v2 = \Std::string($_SERVER["REDIRECT_HTTP_AUTHORIZATION"]);
				#/usr/local/lib/haxe/std/php/Web.hx:226: characters 5-89
				$this5->data["Authorization"] = $v2;
			} else if (isset($_SERVER["PHP_AUTH_USER"])) {
				#/usr/local/lib/haxe/std/php/Web.hx:228: characters 5-94
				$basic_pass = (isset($_SERVER["PHP_AUTH_PW"]) ? \Std::string($_SERVER["PHP_AUTH_PW"]) : "");
				#/usr/local/lib/haxe/std/php/Web.hx:229: characters 5-108
				$this6 = Web::$_clientHeaders;
				#/usr/local/lib/haxe/std/php/Web.hx:229: characters 5-108
				$v3 = "Basic " . (base64_encode((\Std::string($_SERVER["PHP_AUTH_USER"])??'null') . ":" . ($basic_pass??'null'))??'null');
				#/usr/local/lib/haxe/std/php/Web.hx:229: characters 5-108
				$this6->data["Authorization"] = $v3;

			} else if (isset($_SERVER["PHP_AUTH_DIGEST"])) {
				#/usr/local/lib/haxe/std/php/Web.hx:231: characters 5-77
				$this7 = Web::$_clientHeaders;
				#/usr/local/lib/haxe/std/php/Web.hx:231: characters 5-77
				$v4 = \Std::string($_SERVER["PHP_AUTH_DIGEST"]);
				#/usr/local/lib/haxe/std/php/Web.hx:231: characters 5-77
				$this7->data["Authorization"] = $v4;
			}
		}
		#/usr/local/lib/haxe/std/php/Web.hx:235: characters 3-24
		return Web::$_clientHeaders;
	}


	/**
	 * Parse the multipart data. Call `onPart` when a new part is found
	 * with the part name and the filename if present
	 * and `onData` when some part data is readed. You can this way
	 * directly save the data on hard drive in the case of a file upload.
	 * 
	 * @param \Closure $onPart
	 * @param \Closure $onData
	 * 
	 * @return void
	 */
	static public function parseMultipart ($onPart, $onData) {
		#/usr/local/lib/haxe/std/php/Web.hx:354: lines 354-357
		foreach (($_POST) as $key => $value) {
			#/usr/local/lib/haxe/std/php/Web.hx:355: characters 4-19
			$onPart($key, "");
			#/usr/local/lib/haxe/std/php/Web.hx:356: characters 11-32
			$s = $value;
			#/usr/local/lib/haxe/std/php/Web.hx:356: characters 11-32
			$s1 = strlen($s);
			#/usr/local/lib/haxe/std/php/Web.hx:356: characters 11-32
			$tmp = new Bytes($s1, new Container($s));
			#/usr/local/lib/haxe/std/php/Web.hx:356: characters 37-50
			$tmp1 = strlen($value);
			#/usr/local/lib/haxe/std/php/Web.hx:356: characters 4-51
			$onData($tmp, 0, $tmp1);
		};
		#/usr/local/lib/haxe/std/php/Web.hx:359: characters 3-28
		if (!isset($_FILES)) {
			#/usr/local/lib/haxe/std/php/Web.hx:359: characters 22-28
			return;
		}
		#/usr/local/lib/haxe/std/php/Web.hx:360: lines 360-396
		foreach (($_FILES) as $part => $data) {
			#/usr/local/lib/haxe/std/php/Web.hx:361: lines 361-388
			$handleFile = function ($tmp2, $file, $err)  use (&$onData, &$part, &$onPart) {
				#/usr/local/lib/haxe/std/php/Web.hx:362: characters 5-29
				$fileUploaded = true;
				#/usr/local/lib/haxe/std/php/Web.hx:363: lines 363-373
				if ($err > 0) {
					#/usr/local/lib/haxe/std/php/Web.hx:364: lines 364-372
					switch ($err) {
						case 1:
							#/usr/local/lib/haxe/std/php/Web.hx:365: characters 15-20
							throw new HxException("The uploaded file exceeds the max size of " . (ini_get("upload_max_filesize")??'null'));
							break;
						case 2:
							#/usr/local/lib/haxe/std/php/Web.hx:366: characters 15-20
							throw new HxException("The uploaded file exceeds the max file size directive specified in the HTML form (max is" . (ini_get("post_max_size")??'null') . ")");
							break;
						case 3:
							#/usr/local/lib/haxe/std/php/Web.hx:367: characters 15-20
							throw new HxException("The uploaded file was only partially uploaded");
							break;
						case 4:
							#/usr/local/lib/haxe/std/php/Web.hx:368: characters 15-27
							$fileUploaded = false;
							break;
						case 6:
							#/usr/local/lib/haxe/std/php/Web.hx:369: characters 15-20
							throw new HxException("Missing a temporary folder");
							break;
						case 7:
							#/usr/local/lib/haxe/std/php/Web.hx:370: characters 15-20
							throw new HxException("Failed to write file to disk");
							break;
						case 8:
							#/usr/local/lib/haxe/std/php/Web.hx:371: characters 15-20
							throw new HxException("File upload stopped by extension");
							break;
					}
				}
				#/usr/local/lib/haxe/std/php/Web.hx:374: lines 374-387
				if ($fileUploaded) {
					#/usr/local/lib/haxe/std/php/Web.hx:375: characters 6-24
					$onPart($part, $file);
					#/usr/local/lib/haxe/std/php/Web.hx:376: lines 376-386
					if ("" !== $file) {
						#/usr/local/lib/haxe/std/php/Web.hx:378: characters 7-31
						$h = fopen($tmp2, "r");
						#/usr/local/lib/haxe/std/php/Web.hx:379: characters 7-24
						$bsize = 8192;
						#/usr/local/lib/haxe/std/php/Web.hx:380: lines 380-384
						while (!feof($h)) {
							#/usr/local/lib/haxe/std/php/Web.hx:381: characters 8-43
							$buf = fread($h, $bsize);
							#/usr/local/lib/haxe/std/php/Web.hx:382: characters 8-37
							$size = strlen($buf);
							#/usr/local/lib/haxe/std/php/Web.hx:383: characters 15-34
							$buf1 = strlen($buf);
							#/usr/local/lib/haxe/std/php/Web.hx:383: characters 8-44
							$onData(new Bytes($buf1, new Container($buf)), 0, $size);
						}
						#/usr/local/lib/haxe/std/php/Web.hx:385: characters 7-16
						fclose($h);
					}
				}
			};
			#/usr/local/lib/haxe/std/php/Web.hx:389: lines 389-395
			if (is_array($data["name"])) {
				#/usr/local/lib/haxe/std/php/Web.hx:390: characters 18-42
				$_g_arr = array_keys($data["name"]);
				#/usr/local/lib/haxe/std/php/Web.hx:390: characters 18-42
				$_g_hasMore = reset($_g_arr) !== false;
				#/usr/local/lib/haxe/std/php/Web.hx:390: lines 390-392
				while ($_g_hasMore) {
					#/usr/local/lib/haxe/std/php/Web.hx:390: lines 390-392
					$result = current($_g_arr);
					#/usr/local/lib/haxe/std/php/Web.hx:390: lines 390-392
					$_g_hasMore = next($_g_arr) !== false;
					#/usr/local/lib/haxe/std/php/Web.hx:390: lines 390-392
					$index = $result;
					#/usr/local/lib/haxe/std/php/Web.hx:391: characters 6-84
					$handleFile($data["tmp_name"][$index], $data["name"][$index], $data["error"][$index]);
				}
			} else {
				#/usr/local/lib/haxe/std/php/Web.hx:394: characters 5-62
				$handleFile($data["tmp_name"], $data["name"], $data["error"]);
			}
		};
	}


	/**
	 * Tell the client to redirect to the given url ("Location" header).
	 * 
	 * @param string $url
	 * 
	 * @return void
	 */
	static public function redirect ($url) {
		#/usr/local/lib/haxe/std/php/Web.hx:121: characters 3-29
		header("Location: " . ($url??'null'));
	}


	/**
	 * Set a Cookie value in the HTTP headers. Same remark as `php.Web.setHeader()`.
	 * 
	 * @param string $key
	 * @param string $value
	 * @param \Date $expire
	 * @param string $domain
	 * @param string $path
	 * @param bool $secure
	 * @param bool $httpOnly
	 * 
	 * @return void
	 */
	static public function setCookie ($key, $value, $expire = null, $domain = null, $path = null, $secure = null, $httpOnly = null) {
		#/usr/local/lib/haxe/std/php/Web.hx:296: characters 3-65
		$t = ($expire === null ? 0 : (int)($expire->getTime() / 1000.0));
		#/usr/local/lib/haxe/std/php/Web.hx:297: characters 3-30
		if ($path === null) {
			#/usr/local/lib/haxe/std/php/Web.hx:297: characters 20-30
			$path = "/";
		}
		#/usr/local/lib/haxe/std/php/Web.hx:298: characters 3-33
		if ($domain === null) {
			#/usr/local/lib/haxe/std/php/Web.hx:298: characters 22-33
			$domain = "";
		}
		#/usr/local/lib/haxe/std/php/Web.hx:299: characters 3-36
		if ($secure === null) {
			#/usr/local/lib/haxe/std/php/Web.hx:299: characters 22-36
			$secure = false;
		}
		#/usr/local/lib/haxe/std/php/Web.hx:300: characters 3-40
		if ($httpOnly === null) {
			#/usr/local/lib/haxe/std/php/Web.hx:300: characters 24-40
			$httpOnly = false;
		}
		#/usr/local/lib/haxe/std/php/Web.hx:301: characters 3-59
		setcookie($key, $value, $t, $path, $domain, $secure, $httpOnly);
	}


	/**
	 * Set an output header value. If some data have been printed, the headers have
	 * already been sent so this will raise an exception.
	 * 
	 * @param string $h
	 * @param string $v
	 * 
	 * @return void
	 */
	static public function setHeader ($h, $v) {
		#/usr/local/lib/haxe/std/php/Web.hx:129: characters 3-19
		header("" . ($h??'null') . ": " . ($v??'null'));
	}


	/**
	 * Set the HTTP return code. Same remark as `php.Web.setHeader()`.
	 * See status code explanation here: http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
	 * 
	 * @param int $r
	 * 
	 * @return void
	 */
	static public function setReturnCode ($r) {
		#/usr/local/lib/haxe/std/php/Web.hx:137: characters 3-21
		$code = null;
		#/usr/local/lib/haxe/std/php/Web.hx:138: lines 138-180
		switch ($r) {
			case 100:
				#/usr/local/lib/haxe/std/php/Web.hx:139: characters 14-35
				$code = "100 Continue";
				break;
			case 101:
				#/usr/local/lib/haxe/std/php/Web.hx:140: characters 14-46
				$code = "101 Switching Protocols";
				break;
			case 200:
				#/usr/local/lib/haxe/std/php/Web.hx:141: characters 14-29
				$code = "200 OK";
				break;
			case 201:
				#/usr/local/lib/haxe/std/php/Web.hx:142: characters 14-34
				$code = "201 Created";
				break;
			case 202:
				#/usr/local/lib/haxe/std/php/Web.hx:143: characters 14-35
				$code = "202 Accepted";
				break;
			case 203:
				#/usr/local/lib/haxe/std/php/Web.hx:144: characters 14-56
				$code = "203 Non-Authoritative Information";
				break;
			case 204:
				#/usr/local/lib/haxe/std/php/Web.hx:145: characters 14-37
				$code = "204 No Content";
				break;
			case 205:
				#/usr/local/lib/haxe/std/php/Web.hx:146: characters 14-40
				$code = "205 Reset Content";
				break;
			case 206:
				#/usr/local/lib/haxe/std/php/Web.hx:147: characters 14-42
				$code = "206 Partial Content";
				break;
			case 300:
				#/usr/local/lib/haxe/std/php/Web.hx:148: characters 14-43
				$code = "300 Multiple Choices";
				break;
			case 301:
				#/usr/local/lib/haxe/std/php/Web.hx:149: characters 14-44
				$code = "301 Moved Permanently";
				break;
			case 302:
				#/usr/local/lib/haxe/std/php/Web.hx:150: characters 14-32
				$code = "302 Found";
				break;
			case 303:
				#/usr/local/lib/haxe/std/php/Web.hx:151: characters 14-36
				$code = "303 See Other";
				break;
			case 304:
				#/usr/local/lib/haxe/std/php/Web.hx:152: characters 14-39
				$code = "304 Not Modified";
				break;
			case 305:
				#/usr/local/lib/haxe/std/php/Web.hx:153: characters 14-36
				$code = "305 Use Proxy";
				break;
			case 307:
				#/usr/local/lib/haxe/std/php/Web.hx:154: characters 14-45
				$code = "307 Temporary Redirect";
				break;
			case 400:
				#/usr/local/lib/haxe/std/php/Web.hx:155: characters 14-38
				$code = "400 Bad Request";
				break;
			case 401:
				#/usr/local/lib/haxe/std/php/Web.hx:156: characters 14-39
				$code = "401 Unauthorized";
				break;
			case 402:
				#/usr/local/lib/haxe/std/php/Web.hx:157: characters 14-43
				$code = "402 Payment Required";
				break;
			case 403:
				#/usr/local/lib/haxe/std/php/Web.hx:158: characters 14-36
				$code = "403 Forbidden";
				break;
			case 404:
				#/usr/local/lib/haxe/std/php/Web.hx:159: characters 14-36
				$code = "404 Not Found";
				break;
			case 405:
				#/usr/local/lib/haxe/std/php/Web.hx:160: characters 14-45
				$code = "405 Method Not Allowed";
				break;
			case 406:
				#/usr/local/lib/haxe/std/php/Web.hx:161: characters 14-41
				$code = "406 Not Acceptable";
				break;
			case 407:
				#/usr/local/lib/haxe/std/php/Web.hx:162: characters 14-56
				$code = "407 Proxy Authentication Required";
				break;
			case 408:
				#/usr/local/lib/haxe/std/php/Web.hx:163: characters 14-42
				$code = "408 Request Timeout";
				break;
			case 409:
				#/usr/local/lib/haxe/std/php/Web.hx:164: characters 14-35
				$code = "409 Conflict";
				break;
			case 410:
				#/usr/local/lib/haxe/std/php/Web.hx:165: characters 14-31
				$code = "410 Gone";
				break;
			case 411:
				#/usr/local/lib/haxe/std/php/Web.hx:166: characters 14-42
				$code = "411 Length Required";
				break;
			case 412:
				#/usr/local/lib/haxe/std/php/Web.hx:167: characters 14-46
				$code = "412 Precondition Failed";
				break;
			case 413:
				#/usr/local/lib/haxe/std/php/Web.hx:168: characters 14-51
				$code = "413 Request Entity Too Large";
				break;
			case 414:
				#/usr/local/lib/haxe/std/php/Web.hx:169: characters 14-47
				$code = "414 Request-URI Too Long";
				break;
			case 415:
				#/usr/local/lib/haxe/std/php/Web.hx:170: characters 14-49
				$code = "415 Unsupported Media Type";
				break;
			case 416:
				#/usr/local/lib/haxe/std/php/Web.hx:171: characters 14-58
				$code = "416 Requested Range Not Satisfiable";
				break;
			case 417:
				#/usr/local/lib/haxe/std/php/Web.hx:172: characters 14-45
				$code = "417 Expectation Failed";
				break;
			case 500:
				#/usr/local/lib/haxe/std/php/Web.hx:173: characters 14-48
				$code = "500 Internal Server Error";
				break;
			case 501:
				#/usr/local/lib/haxe/std/php/Web.hx:174: characters 14-42
				$code = "501 Not Implemented";
				break;
			case 502:
				#/usr/local/lib/haxe/std/php/Web.hx:175: characters 14-38
				$code = "502 Bad Gateway";
				break;
			case 503:
				#/usr/local/lib/haxe/std/php/Web.hx:176: characters 14-46
				$code = "503 Service Unavailable";
				break;
			case 504:
				#/usr/local/lib/haxe/std/php/Web.hx:177: characters 14-42
				$code = "504 Gateway Timeout";
				break;
			case 505:
				#/usr/local/lib/haxe/std/php/Web.hx:178: characters 14-53
				$code = "505 HTTP Version Not Supported";
				break;
			default:
				#/usr/local/lib/haxe/std/php/Web.hx:179: characters 13-33
				$code = \Std::string($r);
				break;
		}
		#/usr/local/lib/haxe/std/php/Web.hx:181: characters 3-38
		header("HTTP/1.1 " . ($code??'null'), true, $r);
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

#/usr/local/lib/haxe/std/php/Web.hx:420: characters 3-27
Web::$isModNeko = 0 !== strncasecmp(PHP_SAPI, "cli", 3);

	}
}


Boot::registerClass(Web::class, 'php.Web');
Web::__hx__init();
