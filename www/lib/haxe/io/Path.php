<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/std/haxe/io/Path.hx
 */

namespace haxe\io;

use \php\Boot;
use \php\_Boot\HxString;

/**
 * This class provides a convenient way of working with paths. It supports the
 * common path formats:
 * - directory1/directory2/filename.extension
 * - directory1\directory2\filename.extension
 */
class Path {
	/**
	 * @var bool
	 * True if the last directory separator is a backslash, false otherwise.
	 */
	public $backslash;
	/**
	 * @var string
	 * The directory.
	 * This is the leading part of the path that is not part of the file name
	 * and the extension.
	 * Does not end with a `/` or `\` separator.
	 * If the path has no directory, the value is null.
	 */
	public $dir;
	/**
	 * @var string
	 * The file extension.
	 * It is separated from the file name by a dot. This dot is not part of
	 * the extension.
	 * If the path has no extension, the value is null.
	 */
	public $ext;
	/**
	 * @var string
	 * The file name.
	 * This is the part of the part between the directory and the extension.
	 * If there is no file name, e.g. for ".htaccess" or "/dir/", the value
	 * is the empty String "".
	 */
	public $file;


	/**
	 * Adds a trailing slash to `path`, if it does not have one already.
	 * If the last slash in `path` is a backslash, a backslash is appended to
	 * `path`.
	 * If the last slash in `path` is a slash, or if no slash is found, a slash
	 * is appended to `path`. In particular, this applies to the empty String
	 * `""`.
	 * If `path` is null, the result is unspecified.
	 * 
	 * @param string $path
	 * 
	 * @return string
	 */
	static public function addTrailingSlash ($path) {
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:263: lines 263-264
		if (strlen($path) === 0) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:264: characters 4-14
			return "/";
		}
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:265: characters 3-34
		$c1 = HxString::lastIndexOf($path, "/");
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:266: characters 3-35
		$c2 = HxString::lastIndexOf($path, "\\");
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:267: lines 267-273
		if ($c1 < $c2) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:268: lines 268-269
			if ($c2 !== (strlen($path) - 1)) {
				#/usr/local/lib/haxe/std/haxe/io/Path.hx:268: characters 31-42
				return ($path??'null') . "\\";
			} else {
				#/usr/local/lib/haxe/std/haxe/io/Path.hx:269: characters 9-13
				return $path;
			}
		} else if ($c1 !== (strlen($path) - 1)) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:271: characters 31-41
			return ($path??'null') . "/";
		} else {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:272: characters 9-13
			return $path;
		}
	}


	/**
	 * Returns the directory of `path`.
	 * If the directory is null, the empty String `""` is returned.
	 * If `path` is null, the result is unspecified.
	 * 
	 * @param string $path
	 * 
	 * @return string
	 */
	static public function directory ($path) {
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:148: characters 3-26
		$s = new Path($path);
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:149: lines 149-150
		if ($s->dir === null) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:150: characters 4-13
			return "";
		}
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:151: characters 3-15
		return $s->dir;
	}


	/**
	 * @param string $path
	 * @param bool $allowSlashes
	 * 
	 * @return string
	 */
	static public function escape ($path, $allowSlashes = false) {
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:313: lines 313-316
		if ($allowSlashes === null) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:313: lines 313-316
			$allowSlashes = false;
		}
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:314: characters 3-76
		$regex = ($allowSlashes ? new \EReg("[^A-Za-z0-9_/\\\\\\.]", "g") : new \EReg("[^A-Za-z0-9_\\.]", "g"));
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:315: characters 3-79
		return $regex->map($path, function ($v) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:315: characters 52-78
			$_this = $v->matched(0);
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:315: characters 38-78
			return "-x" . (((0 >= strlen($_this) ? null : ord($_this[0])))??'null');
		});
	}


	/**
	 * Returns the extension of `path`.
	 * If the extension is null, the empty String `""` is returned.
	 * If `path` is null, the result is unspecified.
	 * 
	 * @param string $path
	 * 
	 * @return string
	 */
	static public function extension ($path) {
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:162: characters 3-26
		$s = new Path($path);
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:163: lines 163-164
		if ($s->ext === null) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:164: characters 4-13
			return "";
		}
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:165: characters 3-15
		return $s->ext;
	}


	/**
	 * Returns true if the path is an absolute path, and false otherwise.
	 * 
	 * @param string $path
	 * 
	 * @return bool
	 */
	static public function isAbsolute ($path) {
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:302: characters 3-53
		if (\StringTools::startsWith($path, "/")) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:302: characters 42-53
			return true;
		}
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:303: characters 3-41
		if (((1 >= strlen($path) ? "" : $path[1])) === ":") {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:303: characters 30-41
			return true;
		}
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:304: characters 3-56
		if (\StringTools::startsWith($path, "\\\\")) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:304: characters 45-56
			return true;
		}
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:305: characters 3-15
		return false;
	}


	/**
	 * Joins all paths in `paths` together.
	 * If `paths` is empty, the empty String `""` is returned. Otherwise the
	 * paths are joined with a slash between them.
	 * If `paths` is null, the result is unspecified.
	 * 
	 * @param \Array_hx $paths
	 * 
	 * @return string
	 */
	static public function join ($paths) {
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:190: characters 15-68
		$result = [];
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:190: characters 15-68
		$_g1 = 0;
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:190: characters 15-68
		$_g = $paths->length;
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:190: characters 15-68
		while ($_g1 < $_g) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:190: characters 15-68
			$_g1 = $_g1 + 1;
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:190: characters 15-68
			$i = $_g1 - 1;
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:190: characters 40-67
			$s = $paths->arr[$i];
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:190: characters 15-68
			if (($s !== null) && ($s !== "")) {
				#/usr/local/lib/haxe/std/haxe/io/Path.hx:190: characters 15-68
				$result[] = $paths->arr[$i];
			}
		}

		#/usr/local/lib/haxe/std/haxe/io/Path.hx:190: characters 3-69
		$paths1 = \Array_hx::wrap($result);
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:191: lines 191-193
		if ($paths1->length === 0) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:192: characters 4-13
			return "";
		}
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:194: characters 3-23
		$path = ($paths1->arr[0] ?? null);
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:195: lines 195-198
		$_g11 = 1;
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:195: lines 195-198
		$_g2 = $paths1->length;
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:195: lines 195-198
		while ($_g11 < $_g2) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:195: lines 195-198
			$_g11 = $_g11 + 1;
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:195: characters 8-9
			$i1 = $_g11 - 1;
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:196: characters 4-33
			$path = Path::addTrailingSlash($path);
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:197: characters 4-20
			$path = ($path??'null') . (($paths1->arr[$i1] ?? null)??'null');
		}

		#/usr/local/lib/haxe/std/haxe/io/Path.hx:199: characters 3-25
		return Path::normalize($path);
	}


	/**
	 * Normalize a given `path` (e.g. make '/usr/local/../lib' to '/usr/lib').
	 * Also replaces backslashes \ with slashes / and afterwards turns
	 * multiple slashes into a single one.
	 * If `path` is null, the result is unspecified.
	 * 
	 * @param string $path
	 * 
	 * @return string
	 */
	static public function normalize ($path) {
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:211: characters 3-19
		$slash = "/";
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:212: characters 3-38
		$path = \Array_hx::wrap(explode("\\", $path))->join($slash);
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:213: characters 3-34
		if ($path === $slash) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:213: characters 22-34
			return $slash;
		}
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:215: characters 3-19
		$target = new \Array_hx();
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:217: lines 217-223
		$_g = 0;
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:217: lines 217-223
		$_g1 = \Array_hx::wrap(($slash === "" ? str_split($path) : explode($slash, $path)));
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:217: lines 217-223
		while ($_g < $_g1->length) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:217: characters 8-13
			$token = ($_g1->arr[$_g] ?? null);
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:217: lines 217-223
			$_g = $_g + 1;
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:218: lines 218-222
			if (($token === "..") && ($target->length > 0) && (($target->arr[$target->length - 1] ?? null) !== "..")) {
				#/usr/local/lib/haxe/std/haxe/io/Path.hx:219: characters 5-17
				if ($target->length > 0) {
					#/usr/local/lib/haxe/std/haxe/io/Path.hx:219: characters 5-17
					$target->length--;
				}
				#/usr/local/lib/haxe/std/haxe/io/Path.hx:219: characters 5-17
				array_pop($target->arr);
			} else if ($token !== ".") {
				#/usr/local/lib/haxe/std/haxe/io/Path.hx:221: characters 5-23
				$target->arr[$target->length] = $token;
				#/usr/local/lib/haxe/std/haxe/io/Path.hx:221: characters 5-23
				++$target->length;
			}
		}

		#/usr/local/lib/haxe/std/haxe/io/Path.hx:225: characters 3-32
		$tmp = $target->join($slash);
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:226: characters 3-29
		$regex = new \EReg("([^:])/+", "g");
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:227: characters 3-48
		$result = $regex->replace($tmp, "\$1" . ($slash??'null'));
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:228: characters 3-29
		$acc = new \StringBuf();
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:229: characters 3-21
		$colon = false;
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:230: characters 3-23
		$slashes = false;
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:231: lines 231-246
		$_g11 = 0;
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:231: lines 231-246
		$_g2 = strlen($tmp);
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:231: lines 231-246
		while ($_g11 < $_g2) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:231: lines 231-246
			$_g11 = $_g11 + 1;
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:231: characters 8-9
			$i = $_g11 - 1;
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:232: characters 12-42
			$_g21 = (strlen($tmp) === $i ? 0 : ord($tmp[$i]));
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:232: characters 12-42
			switch ($_g21) {
				case 47:
					#/usr/local/lib/haxe/std/haxe/io/Path.hx:236: lines 236-244
					if (!$colon) {
						#/usr/local/lib/haxe/std/haxe/io/Path.hx:237: characters 6-20
						$slashes = true;
					} else {
						#/usr/local/lib/haxe/std/haxe/io/Path.hx:238: characters 10-15
						$i1 = $_g21;
						#/usr/local/lib/haxe/std/haxe/io/Path.hx:239: characters 6-19
						$colon = false;
						#/usr/local/lib/haxe/std/haxe/io/Path.hx:240: lines 240-243
						if ($slashes) {
							#/usr/local/lib/haxe/std/haxe/io/Path.hx:241: characters 7-19
							$acc->add("/");
							#/usr/local/lib/haxe/std/haxe/io/Path.hx:242: characters 7-22
							$slashes = false;
						}
						#/usr/local/lib/haxe/std/haxe/io/Path.hx:244: characters 6-9
						$acc1 = $acc;
						#/usr/local/lib/haxe/std/haxe/io/Path.hx:244: characters 6-20
						$acc1->b = ($acc1->b??'null') . (chr($i1)??'null');

					}
					break;
				case 58:
					#/usr/local/lib/haxe/std/haxe/io/Path.hx:234: characters 6-18
					$acc->add(":");
					#/usr/local/lib/haxe/std/haxe/io/Path.hx:235: characters 6-18
					$colon = true;
					break;
				default:
					#/usr/local/lib/haxe/std/haxe/io/Path.hx:238: characters 10-15
					$i2 = $_g21;
					#/usr/local/lib/haxe/std/haxe/io/Path.hx:239: characters 6-19
					$colon = false;
					#/usr/local/lib/haxe/std/haxe/io/Path.hx:240: lines 240-243
					if ($slashes) {
						#/usr/local/lib/haxe/std/haxe/io/Path.hx:241: characters 7-19
						$acc->add("/");
						#/usr/local/lib/haxe/std/haxe/io/Path.hx:242: characters 7-22
						$slashes = false;
					}
					#/usr/local/lib/haxe/std/haxe/io/Path.hx:244: characters 6-9
					$acc2 = $acc;
					#/usr/local/lib/haxe/std/haxe/io/Path.hx:244: characters 6-20
					$acc2->b = ($acc2->b??'null') . (chr($i2)??'null');

					break;
			}

		}

		#/usr/local/lib/haxe/std/haxe/io/Path.hx:247: characters 3-24
		return $acc->b;
	}


	/**
	 * Removes trailing slashes from `path`.
	 * If `path` does not end with a `/` or `\`, `path` is returned unchanged.
	 * Otherwise the substring of `path` excluding the trailing slashes or
	 * backslashes is returned.
	 * If `path` is null, the result is unspecified.
	 * 
	 * @param string $path
	 * 
	 * @return string
	 */
	static public function removeTrailingSlashes ($path) {
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:288: lines 288-293
		while (true) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:289: characters 11-43
			$index = strlen($path) - 1;
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:289: characters 11-43
			$_g = (($index < 0) || ($index >= strlen($path)) ? null : ord($path[$index]));
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:289: lines 289-291
			if ($_g === null) {
				#/usr/local/lib/haxe/std/haxe/io/Path.hx:291: characters 13-18
				break;
			} else {
				#/usr/local/lib/haxe/std/haxe/io/Path.hx:289: characters 11-43
				switch ($_g) {
					case 47:
					case 92:
						#/usr/local/lib/haxe/std/haxe/io/Path.hx:290: characters 32-57
						$path = HxString::substr($path, 0, -1);
						break;
					default:
						#/usr/local/lib/haxe/std/haxe/io/Path.hx:291: characters 13-18
						break 2;
						break;
				}
			}
		};
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:294: characters 3-14
		return $path;
	}


	/**
	 * @param string $path
	 * 
	 * @return string
	 */
	static public function unescape ($path) {
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:309: characters 3-34
		$regex = new \EReg("-x([0-9][0-9])", "g");
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:310: characters 3-101
		return $regex->map($path, function ($regex1) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:310: characters 49-100
			return chr(\Std::parseInt($regex1->matched(1)));
		});
	}


	/**
	 * Returns a String representation of `path` where the extension is `ext`.
	 * If `path` has no extension, `ext` is added as extension.
	 * If `path` or `ext` are null, the result is unspecified.
	 * 
	 * @param string $path
	 * @param string $ext
	 * 
	 * @return string
	 */
	static public function withExtension ($path, $ext) {
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:176: characters 3-26
		$s = new Path($path);
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:177: characters 3-14
		$s->ext = $ext;
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:178: characters 3-22
		return $s->toString();
	}


	/**
	 * Returns the String representation of `path` without the directory.
	 * If `path` is null, the result is unspecified.
	 * 
	 * @param string $path
	 * 
	 * @return string
	 */
	static public function withoutDirectory ($path) {
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:135: characters 3-26
		$s = new Path($path);
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:136: characters 3-15
		$s->dir = null;
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:137: characters 3-22
		return $s->toString();
	}


	/**
	 * Returns the String representation of `path` without the file extension.
	 * If `path` is null, the result is unspecified.
	 * 
	 * @param string $path
	 * 
	 * @return string
	 */
	static public function withoutExtension ($path) {
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:124: characters 3-26
		$s = new Path($path);
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:125: characters 3-15
		$s->ext = null;
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:126: characters 3-22
		return $s->toString();
	}


	/**
	 * Creates a new Path instance by parsing `path`.
	 * Path information can be retrieved by accessing the dir, file and ext
	 * properties.
	 * 
	 * @param string $path
	 * 
	 * @return void
	 */
	public function __construct ($path) {
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:77: lines 77-82
		switch ($path) {
			case ".":
			case "..":
				#/usr/local/lib/haxe/std/haxe/io/Path.hx:79: characters 5-15
				$this->dir = $path;
				#/usr/local/lib/haxe/std/haxe/io/Path.hx:80: characters 5-14
				$this->file = "";
				#/usr/local/lib/haxe/std/haxe/io/Path.hx:81: characters 5-11
				return;
				break;
		}
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:83: characters 3-34
		$c1 = HxString::lastIndexOf($path, "/");
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:84: characters 3-35
		$c2 = HxString::lastIndexOf($path, "\\");
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:85: lines 85-93
		if ($c1 < $c2) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:86: characters 4-27
			$this->dir = HxString::substr($path, 0, $c2);
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:87: characters 4-28
			$path = HxString::substr($path, $c2 + 1);
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:88: characters 4-20
			$this->backslash = true;
		} else if ($c2 < $c1) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:90: characters 4-27
			$this->dir = HxString::substr($path, 0, $c1);
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:91: characters 4-28
			$path = HxString::substr($path, $c1 + 1);
		} else {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:93: characters 4-14
			$this->dir = null;
		}
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:94: characters 3-34
		$cp = HxString::lastIndexOf($path, ".");
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:95: lines 95-101
		if ($cp !== -1) {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:96: characters 4-27
			$this->ext = HxString::substr($path, $cp + 1);
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:97: characters 4-28
			$this->file = HxString::substr($path, 0, $cp);
		} else {
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:99: characters 4-14
			$this->ext = null;
			#/usr/local/lib/haxe/std/haxe/io/Path.hx:100: characters 4-15
			$this->file = $path;
		}
	}


	/**
	 * Returns a String representation of `this` path.
	 * If `this.backslash` is true, backslash is used as directory separator,
	 * otherwise slash is used. This only affects the separator between
	 * `this.dir` and `this.file`.
	 * If `this.directory` or `this.extension` is null, their representation
	 * is the empty String "".
	 * 
	 * @return string
	 */
	public function toString () {
		#/usr/local/lib/haxe/std/haxe/io/Path.hx:115: characters 3-120
		return ((($this->dir === null ? "" : ($this->dir??'null') . ((($this->backslash ? "\\" : "/"))??'null')))??'null') . ($this->file??'null') . ((($this->ext === null ? "" : "." . ($this->ext??'null')))??'null');
	}


	public function __toString() {
		return $this->toString();
	}
}


Boot::registerClass(Path::class, 'haxe.io.Path');