<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx
 */

namespace haxe\remoting;

use \haxe\Unserializer;
use \php\Boot;
use \php\_Boot\HxException;
use \sys\Http;
use \php\_Boot\HxString;
use \php\Web;
use \haxe\CallStack;
use \haxe\Serializer;

/**
 * Allows a synchronous connection to the given URL which should link to a Haxe server application.
 */
class HttpConnection implements Connection {
	/**
	 * @var float
	 */
	static public $TIMEOUT = 10.;


	/**
	 * @var \Array_hx
	 */
	public $__path;
	/**
	 * @var string
	 */
	public $__url;


	/**
	 * @param Context $ctx
	 * 
	 * @return bool
	 */
	static public function handleRequest ($ctx) {
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:89: characters 3-42
		$v = (Web::getParams()->data["__x"] ?? null);
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:90: lines 90-91
		if ((Web::getClientHeader("X-Haxe-Remoting") === null) || ($v === null)) {
			#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:91: characters 4-16
			return false;
		}
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:92: characters 3-39
		echo(\Std::string(HttpConnection::processRequest($v, $ctx)));
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:93: characters 3-14
		return true;
	}


	/**
	 * @param string $requestData
	 * @param Context $ctx
	 * 
	 * @return string
	 */
	static public function processRequest ($requestData, $ctx) {
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:98: lines 98-110
		try {
			#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:99: characters 4-47
			$u = new Unserializer($requestData);
			#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:100: characters 4-31
			$path = $u->unserialize();
			#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:101: characters 4-31
			$args = $u->unserialize();
			#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:102: characters 4-35
			$data = $ctx->call($path, $args);
			#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:103: characters 4-34
			$s = new Serializer();
			#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:104: characters 4-21
			$s->serialize($data);
			#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:105: characters 4-31
			return "hxr" . ($s->toString()??'null');
		} catch (\Throwable $__hx__caught_e) {
			CallStack::saveExceptionTrace($__hx__caught_e);
			$__hx__real_e = ($__hx__caught_e instanceof HxException ? $__hx__caught_e->e : $__hx__caught_e);
			$e = $__hx__real_e;
			#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:107: characters 4-34
			$s1 = new Serializer();
			#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:108: characters 4-27
			$s1->serializeException($e);
			#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:109: characters 4-31
			return "hxr" . ($s1->toString()??'null');
		}
	}


	/**
	 * @param string $url
	 * 
	 * @return HttpConnection
	 */
	static public function urlConnect ($url) {
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:74: characters 3-36
		return new HttpConnection($url, new \Array_hx());
	}


	/**
	 * @param string $url
	 * @param \Array_hx $path
	 * 
	 * @return void
	 */
	public function __construct ($url, $path) {
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:35: characters 3-14
		$this->__url = $url;
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:36: characters 3-16
		$this->__path = $path;
	}


	/**
	 * @param \Array_hx $params
	 * 
	 * @return mixed
	 */
	public function call ($params) {
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:46: characters 3-19
		$data = null;
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:47: characters 3-32
		$h = new Http($this->__url);
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:55: characters 4-26
		$h->cnxTimeout = HttpConnection::$TIMEOUT;
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:57: characters 3-33
		$s = new Serializer();
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:58: characters 3-22
		$s->serialize($this->__path);
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:59: characters 3-22
		$s->serialize($params);
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:60: characters 3-37
		$h->setHeader("X-Haxe-Remoting", "1");
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:61: characters 3-37
		$h->setParameter("__x", $s->toString());
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:62: characters 3-39
		$h->onData = function ($d)  use (&$data) {
			#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:62: characters 28-36
			$data = $d;
		};
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:63: characters 3-39
		$h->onError = function ($e) {
			#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:63: characters 29-34
			throw new HxException($e);
		};
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:64: characters 3-18
		$h->request(true);
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:65: lines 65-66
		if (HxString::substr($data, 0, 3) !== "hxr") {
			#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:66: characters 4-9
			throw new HxException("Invalid response : '" . ($data??'null') . "'");
		}
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:67: characters 3-24
		$data = HxString::substr($data, 3);
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:68: characters 3-51
		return (new Unserializer($data))->unserialize();
	}


	/**
	 * @param string $name
	 * 
	 * @return Connection
	 */
	public function resolve ($name) {
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:40: characters 30-35
		$c = $this->__url;
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:40: characters 3-51
		$c1 = new HttpConnection($c, $this->__path->copy());
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:41: characters 3-22
		$_this = $c1->__path;
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:41: characters 3-22
		$_this->arr[$_this->length] = $name;
		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:41: characters 3-22
		++$_this->length;

		#/usr/local/lib/haxe/std/haxe/remoting/HttpConnection.hx:42: characters 3-11
		return $c1;
	}
}


Boot::registerClass(HttpConnection::class, 'haxe.remoting.HttpConnection');
