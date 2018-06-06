<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx
 */

namespace ufront\view;

use \haxe\io\Path;
use \tink\core\FutureTrigger;
use \tink\core\Outcome;
use \haxe\ds\StringMap;
use \php\Boot;
use \php\_Boot\HxException;
use \tink\core\TypedError;
use \tink\core\_Future\FutureObject;
use \tink\core\_Future\SyncFuture;
use \tink\core\MPair;
use \tink\core\_Future\Future_Impl_;
use \haxe\CallStack;
use \php\_Boot\HxAnon;
use \tink\core\_Lazy\LazyConst;

/**
 * A `UFViewEngine` is responsible for providing a ready-to-execute `UFTemplate` for a given template path.
 * This is a base class, and does not actually fetch any templates.
 * Please use a sub-class, such as `FileViewEngine` or `HttpViewEngine` instead.
 * Details:
 * - Each sub-class provides a different implementation of `this.getTemplateString()`.
 * For example, fetching it from the file system (as in `FileViewEngine`) or over the network (as in `HttpViewEngine`).
 * - `UFViewEngine` can optionally cache the `UFTemplate` objects, keeping them ready to execute quickly for future requests.
 * - `this.addTemplatingEngine()` can be used to add a list of templating engines that you support.
 * If you are using a `UfrontApplication`, the templating engines defined in your `UfrontConfiguration.templatingEngines` will be used.
 * By default, this means all engines available in `TemplatingEngines.all`.
 * - When you call `this.getTemplate()`, you specify the path of the template you want, and optionally, the templating engine.
 * The path can include the file extension of the template, but it will also work without it - using the extensions available in each templating engine instead.
 * The full process for finding a template based on the path and the templating engines is described in the documentation for `this.getTemplate()`.
 * @TODO: refactor to use an injected UFCache, rather than a map.
 */
class UFViewEngine {
	/**
	 * @var bool
	 * Should we enable view caching by default?
	 * If caching is enabled, the templates will be loaded and parsed, ready to execute, and stored in memory between requests.
	 * This will only have an effect on platforms that support maintaining static variables between requests, such as NodeJS, Client JS, or Neko when using `Web.cacheModule`.
	 * On other platforms that do not support caching across requests, templates will only be cached during the same request.
	 * By default, this is `true` normally, but `false` if being compiled in `-debug` mode.
	 * To change the default behaviour, you can either change this static variable, or you can pass the `cachingEnabled` parameter to the constructor for each instance.
	 */
	static public $cacheEnabledByDefault = false;


	/**
	 * @var StringMap
	 */
	public $cache;
	/**
	 * @var \Array_hx
	 */
	public $engines;


	/**
	 * Create a new view engine.
	 * The constructor is private, because this is an abstract class.
	 * Please use one of the sub-class implementations.
	 * @param cachingEnabled Should we cache templates between requests? If not supplied, the value of `UFViewEngine.cacheEnabledByDefault` will be used by default.
	 * 
	 * @param bool $cachingEnabled
	 * 
	 * @return void
	 */
	public function __construct ($cachingEnabled = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:59: lines 59-60
		if ($cachingEnabled === null) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:60: characters 4-42
			$cachingEnabled = UFViewEngine::$cacheEnabledByDefault;
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:61: lines 61-62
		if ($cachingEnabled) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:62: characters 4-21
			$this->cache = new StringMap();
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:63: characters 3-15
		$this->engines = new \Array_hx();
	}


	/**
	 * Add support for a templating engine.
	 * A supplied `TemplatingEngine` will transform a template `String` into a ready-to-execute `UFTemplate`.
	 * See `TemplatingEngines` for a list of templating engines that are available and ready to use.
	 * Notes:
	 * - If the engine specifies one or more file extensions, any views found with those extension will use this templating engine.
	 * - If multiple templating engines use the same extension, the first templating engine added will be the used to process the template.
	 * - If no extension is specified for this engine, then the engine will be used for any view regardless of the extension.
	 * 
	 * @param object $engine
	 * 
	 * @return void
	 */
	public function addTemplatingEngine ($engine) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:242: characters 3-25
		$_this = $this->engines;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:242: characters 3-25
		$_this->arr[$_this->length] = $engine;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:242: characters 3-25
		++$_this->length;
	}


	/**
	 * Fetch a template for the given path.
	 * Behaviour:
	 * - **If caching is enabled, and a cache for this request exists, return the cached `UFTemplate` immediately.**
	 * - **If a templating engine is specified, and the path has an extension:**
	 * The exact path will used, with the given templating engine, regardless of whether the extensions match or not.
	 * - **If a templating engine is specified, and the path does not have an extension:**
	 * For each extension that this templating engine supports, look for an available template.
	 * The first match will be used.
	 * - **If no templating engine is specified, and the path has an extension:**
	 * Go through the available templating engines, in the order they were added.
	 * If the engine supports our extension, check for a matching template.
	 * The first match will be used.
	 * - **If no templating engine is specified, and the path does not have an extension:**
	 * Go through the available templating engines, in the order they were added.
	 * For each extension that the engine supports, check for a matching template.
	 * The first match will be used.
	 * - In each case, if no match is found, this will fail with the appropriate error.
	 * - Once the template is found, the appropriate engine will be used to generate a `UFTemplate`, ready to execute.
	 * - If there is an error parsing or initializing a template, this will return a failure.
	 * - If a template was initialized successfully, and caching is being used, it will be added to the cache.
	 * This operation is asynchronous (returing a `Surprise`), and should result in a `Failure` if the view is not found or could not be parsed.
	 * 
	 * @param string $path
	 * @param object $templatingEngine
	 * 
	 * @return FutureObject
	 */
	public function getTemplate ($path, $templatingEngine = null) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:97: lines 97-208
		$_gthis = $this;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:99: lines 99-103
		if (($this->cache !== null) && array_key_exists($path, $this->cache->data)) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:100: characters 4-29
			$cached = ($this->cache->data[$path] ?? null);
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:101: lines 101-102
			if (($templatingEngine === null) || ($templatingEngine->type === $cached->a)) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:102: characters 12-44
				return new SyncFuture(new LazyConst(Outcome::Success($cached->b)));
			}
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:105: characters 3-75
		$tplStrReady = new FutureTrigger();
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:106: characters 3-30
		$ext = Path::extension($path);
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:107: characters 3-31
		$finalPath = null;
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:109: lines 109-189
		if (($templatingEngine !== null) && ($ext !== "")) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:111: characters 4-20
			$finalPath = $path;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:112: lines 112-116
			$this->getTemplateString($finalPath)->handle(function ($result)  use (&$tplStrReady, &$path) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:112: lines 112-116
				switch ($result->index) {
					case 0:
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:112: characters 68-74
						switch ($result->params[0]->index) {
							case 0:
								#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:114: characters 23-26
								$tpl = $result->params[0]->params[0];
								#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:114: characters 30-65
								$tplStrReady->trigger(Outcome::Success($tpl));
								break;
							case 1:
								#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:115: characters 46-92
								$tmp = Outcome::Failure(new TypedError(null, "Template " . ($path??'null') . " not found", new HxAnon([
									"fileName" => "ufront/view/UFViewEngine.hx",
									"lineNumber" => 115,
									"className" => "ufront.view.UFViewEngine",
									"methodName" => "getTemplate",
								])));
								#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:115: characters 25-94
								$tplStrReady->trigger($tmp);
								break;
						}
						break;
					case 1:
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:113: characters 18-21
						$err = $result->params[0];
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:113: characters 24-59
						$tplStrReady->trigger(Outcome::Failure($err));
						break;
				}
			});
		} else if (($templatingEngine !== null) && ($ext === "")) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:120: characters 4-50
			$exts = $templatingEngine->extensions->copy();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:121: lines 121-132
			$testNextExtension = null;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:121: lines 121-132
			$testNextExtension = function ()  use (&$exts, &$finalPath, &$tplStrReady, &$testNextExtension, &$_gthis, &$templatingEngine, &$path) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:122: lines 122-131
				if ($exts->length > 0) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:123: characters 16-28
					if ($exts->length > 0) {
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:123: characters 16-28
						$exts->length--;
					}
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:123: characters 6-29
					$ext1 = array_shift($exts->arr);
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:124: characters 6-41
					$finalPath = Path::withExtension($path, $ext1);
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:125: lines 125-129
					$_gthis->getTemplateString($finalPath)->handle(function ($result1)  use (&$tplStrReady, &$testNextExtension) {
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:125: lines 125-129
						switch ($result1->index) {
							case 0:
								#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:125: characters 70-76
								switch ($result1->params[0]->index) {
									case 0:
										#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:127: characters 25-28
										$tpl1 = $result1->params[0]->params[0];
										#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:127: characters 32-67
										$tplStrReady->trigger(Outcome::Success($tpl1));
										break;
									case 1:
										#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:128: characters 27-46
										$testNextExtension();
										break;
								}
								break;
							case 1:
								#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:126: characters 20-23
								$err1 = $result1->params[0];
								#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:126: characters 26-61
								$tplStrReady->trigger(Outcome::Failure($err1));
								break;
						}
					});
				} else {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:131: characters 50-123
					$testNextExtension1 = "No template found for " . ($path??'null') . " with extensions " . (\Std::string($templatingEngine->extensions)??'null');
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:131: characters 31-127
					$testNextExtension2 = Outcome::Failure(new TypedError(null, $testNextExtension1, new HxAnon([
						"fileName" => "ufront/view/UFViewEngine.hx",
						"lineNumber" => 131,
						"className" => "ufront.view.UFViewEngine",
						"methodName" => "getTemplate",
					])));
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:131: characters 10-129
					$tplStrReady->trigger($testNextExtension2);
				}
			};
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:121: lines 121-132
			$testNextExtension3 = $testNextExtension;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:133: characters 4-23
			$testNextExtension3();
		} else if (($templatingEngine === null) && ($ext !== "")) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:136: characters 4-36
			$tplEngines = $this->engines->copy();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:137: lines 137-152
			$testNextEngine = null;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:137: lines 137-152
			$testNextEngine = function ()  use (&$finalPath, &$tplStrReady, &$ext, &$_gthis, &$testNextEngine, &$tplEngines, &$templatingEngine, &$path) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:138: lines 138-151
				if ($tplEngines->length > 0) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:139: characters 19-37
					if ($tplEngines->length > 0) {
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:139: characters 19-37
						$tplEngines->length--;
					}
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:139: characters 6-38
					$engine = array_shift($tplEngines->arr);
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:140: lines 140-149
					if (\Lambda::has($engine->extensions, $ext)) {
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:141: characters 7-47
						$finalPath = Path::normalize($path);
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:142: lines 142-148
						$_gthis->getTemplateString($finalPath)->handle(function ($result2)  use (&$tplStrReady, &$templatingEngine, &$engine, &$path) {
							#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:142: lines 142-148
							switch ($result2->index) {
								case 0:
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:142: characters 71-77
									switch ($result2->params[0]->index) {
										case 0:
											#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:144: characters 26-29
											$tpl2 = $result2->params[0]->params[0];
											#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:145: characters 9-34
											$templatingEngine = $engine;
											#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:146: characters 9-44
											$tplStrReady->trigger(Outcome::Success($tpl2));

											break;
										case 1:
											#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:147: characters 49-95
											$testNextEngine1 = Outcome::Failure(new TypedError(null, "Template " . ($path??'null') . " not found", new HxAnon([
												"fileName" => "ufront/view/UFViewEngine.hx",
												"lineNumber" => 147,
												"className" => "ufront.view.UFViewEngine",
												"methodName" => "getTemplate",
											])));
											#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:147: characters 28-97
											$tplStrReady->trigger($testNextEngine1);
											break;
									}
									break;
								case 1:
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:143: characters 21-24
									$err2 = $result2->params[0];
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:143: characters 27-62
									$tplStrReady->trigger(Outcome::Failure($err2));
									break;
							}
						});
					} else {
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:149: characters 13-29
						$testNextEngine();
					}
				} else {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:151: characters 31-119
					$testNextEngine2 = Outcome::Failure(new TypedError(null, "No templating engine found for " . ($path??'null') . " (None support extension " . ($ext??'null') . ")", new HxAnon([
						"fileName" => "ufront/view/UFViewEngine.hx",
						"lineNumber" => 151,
						"className" => "ufront.view.UFViewEngine",
						"methodName" => "getTemplate",
					])));
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:151: characters 10-121
					$tplStrReady->trigger($testNextEngine2);
				}
			};
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:137: lines 137-152
			$testNextEngine3 = $testNextEngine;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:153: characters 4-20
			$testNextEngine3();
		} else if (($templatingEngine === null) && ($ext === "")) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:156: characters 4-36
			$tplEngines1 = $this->engines->copy();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:158: characters 4-39
			$engine1 = null;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:159: characters 4-38
			$extensions = new \Array_hx();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:160: characters 4-42
			$extensionsUsed = new \Array_hx();
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:161: characters 4-26
			$ext2 = null;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:163: lines 163-187
			$testNextEngineOrExtension = null;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:163: lines 163-187
			$testNextEngineOrExtension = function ()  use (&$testNextEngineOrExtension, &$ext2, &$extensions, &$engine1, &$tplStrReady, &$finalPath, &$tplEngines1, &$_gthis, &$templatingEngine, &$extensionsUsed, &$path) {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:164: lines 164-173
				if (($extensions->length === 0) && ($tplEngines1->length === 0)) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:165: characters 46-105
					$testNextEngineOrExtension1 = "No template found for " . ($path??'null') . " with extensions " . (\Std::string($extensionsUsed)??'null');
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:165: characters 27-108
					$testNextEngineOrExtension2 = Outcome::Failure(new TypedError(null, $testNextEngineOrExtension1, new HxAnon([
						"fileName" => "ufront/view/UFViewEngine.hx",
						"lineNumber" => 165,
						"className" => "ufront.view.UFViewEngine",
						"methodName" => "getTemplate",
					])));
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:165: characters 6-110
					$tplStrReady->trigger($testNextEngineOrExtension2);
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:166: characters 6-12
					return;
				} else if ($extensions->length === 0) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:169: characters 15-33
					if ($tplEngines1->length > 0) {
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:169: characters 15-33
						$tplEngines1->length--;
					}
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:169: characters 6-33
					$engine1 = array_shift($tplEngines1->arr);
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:170: characters 6-43
					$extensions = $engine1->extensions->copy();
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:171: characters 12-30
					if ($extensions->length > 0) {
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:171: characters 12-30
						$extensions->length--;
					}
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:171: characters 6-30
					$ext2 = array_shift($extensions->arr);
				} else {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:173: characters 16-34
					if ($extensions->length > 0) {
						#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:173: characters 16-34
						$extensions->length--;
					}
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:173: characters 10-34
					$ext2 = array_shift($extensions->arr);
				}
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:175: characters 5-31
				$extensionsUsed->arr[$extensionsUsed->length] = $ext2;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:175: characters 5-31
				++$extensionsUsed->length;

				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:178: characters 5-40
				$finalPath = Path::withExtension($path, $ext2);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:179: lines 179-185
				$_gthis->getTemplateString($finalPath)->handle(function ($result3)  use (&$testNextEngineOrExtension, &$engine1, &$tplStrReady, &$templatingEngine) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:179: lines 179-185
					switch ($result3->index) {
						case 0:
							#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:179: characters 69-75
							switch ($result3->params[0]->index) {
								case 0:
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:181: characters 24-27
									$tpl3 = $result3->params[0]->params[0];
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:182: characters 7-32
									$templatingEngine = $engine1;
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:183: characters 7-42
									$tplStrReady->trigger(Outcome::Success($tpl3));

									break;
								case 1:
									#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:184: characters 26-53
									$testNextEngineOrExtension();
									break;
							}
							break;
						case 1:
							#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:180: characters 19-22
							$err3 = $result3->params[0];
							#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:180: characters 25-60
							$tplStrReady->trigger(Outcome::Failure($err3));
							break;
					}
				});
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:186: characters 5-11
				return;
			};
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:163: lines 163-187
			$testNextEngineOrExtension3 = $testNextEngineOrExtension;
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:188: characters 4-31
			$testNextEngineOrExtension3();
		}
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:195: lines 195-207
		return Future_Impl_::_tryFailingMap($tplStrReady, function ($tplStr)  use (&$finalPath, &$e, &$_gthis, &$templatingEngine, &$path) {
			#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:198: lines 198-206
			try {
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:199: characters 6-60
				$tpl4 = $templatingEngine->factory($tplStr);
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:200: lines 200-201
				if ($_gthis->cache !== null) {
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:201: characters 7-59
					$this1 = $_gthis->cache;
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:201: characters 21-59
					$this2 = new MPair($templatingEngine->type, $tpl4);
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:201: characters 7-59
					$v = $this2;
					#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:201: characters 7-59
					$this1->data[$path] = $v;
				}
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:202: characters 6-27
				return Outcome::Success($tpl4);
			} catch (\Throwable $__hx__caught_e) {
				CallStack::saveExceptionTrace($__hx__caught_e);
				$__hx__real_e = ($__hx__caught_e instanceof HxException ? $__hx__caught_e->e : $__hx__caught_e);
				$e = $__hx__real_e;
				#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:205: characters 6-111
				return Outcome::Failure(TypedError::withData(null, "Failed to parse template " . ($finalPath??'null') . " using " . ($templatingEngine->type??'null'), $e, new HxAnon([
					"fileName" => "ufront/view/UFViewEngine.hx",
					"lineNumber" => 205,
					"className" => "ufront.view.UFViewEngine",
					"methodName" => "getTemplate",
				])));
			}
		});
	}


	/**
	 * Fetch the template string for an exact path.
	 * Each sub-class must provide it's own implementation.
	 * For example, `HttpViewEngine` will fetch the template string from the network using `haxe.Http`.
	 * Alternatively, `FileViewEngine` will fetch the template string from the filesystem using `sys.io.File`.
	 * The default implementation in `UFViewEngine.getTemplateString()` will always return a failure - you must use a subclass.
	 * The return type is a `Surprise<Option<String>,Error>`.
	 * - This allows a `UFViewEngine` implementation to work asynchronously.
	 * - A `Success(Some(s:String))` means that a template was found, and the given template string is supplied.
	 * - A `Success(None)` means that no template with the specified path was found.
	 * - A `Failure(e:Error)` will describe an error that occured (for example, if network connectivity failed).
	 * 
	 * @param string $path
	 * 
	 * @return FutureObject
	 */
	public function getTemplateString ($path) {
		#/Users/ut/Documents/LAB/ufront-mvc/src/ufront/view/UFViewEngine.hx:226: characters 10-180
		return new SyncFuture(new LazyConst(Outcome::Failure(new TypedError(null, "Attempting to fetch template " . ($path??'null') . " with UFViewEngine.  This is an abstract class, you must use one of the ViewEngine implementations.", new HxAnon([
			"fileName" => "ufront/view/UFViewEngine.hx",
			"lineNumber" => 226,
			"className" => "ufront.view.UFViewEngine",
			"methodName" => "getTemplateString",
		])))));
	}
}


Boot::registerClass(UFViewEngine::class, 'ufront.view.UFViewEngine');
