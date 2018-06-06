<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx
 */

namespace ufront\web\upload;

use \haxe\io\Path;
use \haxe\Unserializer;
use \php\Boot;
use \php\_Boot\HxException;
use \ufront\remoting\RemotingUnserializer;
use \ufront\remoting\RemotingSerializer;
use \ufront\core\Uuid;
use \ufront\core\_MultiValueMap\MultiValueMap_Impl_;
use \haxe\Serializer;

/**
 * The `BaseUpload` is a base class that can be used when implementing `UFFileUpload`.
 * It's main purpose is to make it easier for transferring uploads from the client to the server as serialized objects.
 * When a `BaseUpload` object is serialized via `RemotingSerializer`, and the purpose is to send the upload to the server, it will serialize the metadata about the object, and ask `RemotingSerializer` to attach the file to the remoting HTTP request.
 * When the `RemotingUnserializer` tries to unpack a `BaseUpload` object, it will attach the corresponding `UFFileUpload` to `attachedUpload`.
 */
class BaseUpload {
	/**
	 * @var UFFileUpload
	 * The `UFFileUpload` that was attached to the HTTP request.
	 * Because of the way Haxe remoting and serialization works, a `BrowserFileUpload` sent to the server will be unserialized as a `BrowserFileUpload` object, even though on the server it was received as a different type, like `TmpFileUpload`.
	 * During de-serialization, we attach the type the server uses (eg `TmpFileUpload`) to the `attachedUpload` variable.
	 * In `RemotingHandler`, we swap any instance of `BaseUpload` for the `UFFileUpload` the server is actually using.
	 * In each sub-class, such as `TmpFileUpload` and `BrowserFileUpload`, we check if `attachedUpload` is present, and if so, all calls to `getBytes()`, `getString()` and `process()` etc should be forwarded to the `attachedUpload` object.
	 */
	public $attachedUpload;
	/**
	 * @var string
	 * The contentType of the upload.
	 * Please note this is not verified, so do not rely on this for security.
	 */
	public $contentType;
	/**
	 * @var string
	 * The original name of this file on the client.
	 */
	public $originalFileName;
	/**
	 * @var string
	 * The name of the POST argument (that is, the name of the file input) that this file was uploaded with.
	 */
	public $postName;
	/**
	 * @var int
	 * The size of the upload in Bytes
	 */
	public $size;


	/**
	 * Create a new `TempFileUploadSync`.
	 * It should already be saved to a temporary file by `TmpFileUploadMiddleware` when this object is created.
	 * Please note that `originalFileName` will be sanitised using `haxe.io.Path.withoutDirectory()`.
	 * 
	 * @param string $postName
	 * @param string $originalFileName
	 * @param int $size
	 * @param string $contentType
	 * 
	 * @return void
	 */
	public function __construct ($postName, $originalFileName, $size, $contentType = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:54: characters 3-27
		$this->postName = $postName;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:55: characters 3-62
		$this->originalFileName = Path::withoutDirectory($originalFileName);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:56: characters 3-19
		$this->size = $size;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:57: characters 3-33
		$this->contentType = $contentType;
	}


	/**
	 * @param Serializer $s
	 * 
	 * @return void
	 */
	public function hxSerialize ($s) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:61: characters 3-50
		$rs = (($s instanceof RemotingSerializer) ? $s : null);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:62: characters 3-74
		$attachingUpload = null;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:62: characters 25-73
		if ($rs !== null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:62: characters 37-49
			$_g = $rs->direction;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:62: characters 3-74
			$attachingUpload = $_g->index === 0;
		} else {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:62: characters 3-74
			$attachingUpload = false;
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:63: characters 3-33
		$s->serialize($attachingUpload);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:64: lines 64-71
		if ($attachingUpload) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:66: lines 66-67
			if (($this instanceof UFFileUpload) === false) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:67: characters 5-10
				throw new HxException("BaseUpload can only be serialized if the sub-class matches the UFFileUpload interface");
			}
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:68: characters 4-52
			$uniquePostName = ($this->postName??'null') . "_" . (Uuid::create()??'null');
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:69: characters 4-47
			MultiValueMap_Impl_::add($rs->uploads, $uniquePostName, $this);
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:70: characters 4-33
			$s->serialize($uniquePostName);
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:72: characters 3-26
		$s->serialize($this->postName);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:73: characters 3-34
		$s->serialize($this->originalFileName);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:74: characters 3-22
		$s->serialize($this->size);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:75: characters 3-29
		$s->serialize($this->contentType);
	}


	/**
	 * @param Unserializer $s
	 * 
	 * @return void
	 */
	public function hxUnserialize ($s) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:79: characters 3-45
		$uploadAttached = $s->unserialize();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:81: characters 3-52
		$rs = (($s instanceof RemotingUnserializer) ? $s : null);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:82: lines 82-92
		if ($uploadAttached) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:83: lines 83-84
			if ($rs === null) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:84: characters 5-10
				throw new HxException("Unable to Unserialize upload. It was serialized with RemotingSerializer, it must be unserialized with RemotingUnserializer");
			}
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:87: characters 4-48
			$uniquePostName = $s->unserialize();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:88: lines 88-91
			if (array_key_exists($uniquePostName, $rs->uploads->data)) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:89: characters 5-53
				$this->attachedUpload = MultiValueMap_Impl_::get($rs->uploads, $uniquePostName);
			} else {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:91: characters 9-14
				throw new HxException("Unable to find upload attached as " . ($uniquePostName??'null'));
			}
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:94: characters 3-34
		$this->postName = $s->unserialize();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:95: characters 3-42
		$this->originalFileName = $s->unserialize();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:96: characters 3-30
		$this->size = $s->unserialize();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/upload/BaseUpload.hx:97: characters 3-37
		$this->contentType = $s->unserialize();
	}
}


Boot::registerClass(BaseUpload::class, 'ufront.web.upload.BaseUpload');
