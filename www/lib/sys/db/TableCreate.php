<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx
 */

namespace sys\db;

use \php\Boot;
use \php\_Boot\HxException;
use \php\_Boot\HxString;
use \haxe\CallStack;

class TableCreate {
	/**
	 * @param string $dbName
	 * 
	 * @return string
	 */
	static public function autoInc ($dbName) {
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:29: characters 10-77
		if ($dbName === "SQLite") {
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:29: characters 31-58
			return "PRIMARY KEY AUTOINCREMENT";
		} else {
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:29: characters 61-77
			return "AUTO_INCREMENT";
		}
	}


	/**
	 * @param Manager $manager
	 * @param string $engine
	 * 
	 * @return void
	 */
	static public function create ($manager, $engine = null) {
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:66: lines 66-68
		$quote = function ($v)  use (&$manager) {
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:67: characters 4-40
			return $manager->quoteField($v);
		};
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:69: characters 3-51
		$cnx = $manager->getCnx();
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:70: lines 70-71
		if ($cnx === null) {
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:71: characters 4-9
			throw new HxException("SQL Connection not initialized on Manager");
		}
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:72: characters 3-29
		$dbName = $cnx->dbName();
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:73: characters 3-33
		$infos = $manager->dbInfos();
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:74: characters 3-56
		$sql = "CREATE TABLE " . ($quote($infos->name)??'null') . " (";
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:75: characters 3-18
		$decls = new \Array_hx();
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:76: characters 3-21
		$hasID = false;
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:77: lines 77-88
		$_g = 0;
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:77: lines 77-88
		$_g1 = $infos->fields;
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:77: lines 77-88
		while ($_g < $_g1->length) {
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:77: characters 8-9
			$f = ($_g1->arr[$_g] ?? null);
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:77: lines 77-88
			$_g = $_g + 1;
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:78: characters 12-15
			$_g2 = $f->t;
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:78: characters 12-15
			switch ($_g2->index) {
				case 0:
					#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:80: characters 5-17
					$hasID = true;
					break;
				case 2:
				case 4:
					#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:82: characters 5-17
					$hasID = true;
					#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:83: lines 83-84
					if ($dbName === "SQLite") {
						#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:84: characters 6-11
						throw new HxException("S" . (HxString::substr(\Std::string($f->t), 1)??'null') . " is not supported by " . ($dbName??'null') . " : use SId instead");
					}
					break;
				default:
										break;
			}

			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:87: characters 15-55
			$x = ($quote($f->name)??'null') . " " . (TableCreate::getTypeSQL($f->t, $dbName)??'null');
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:87: characters 4-86
			$decls->arr[$decls->length] = ($x??'null') . ((($f->isNull ? "" : " NOT NULL"))??'null');
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:87: characters 4-86
			++$decls->length;

		}

		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:89: lines 89-90
		if (($dbName !== "SQLite") || !$hasID) {
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:90: characters 4-73
			$x1 = "PRIMARY KEY (" . (\Lambda::map($infos->key, $quote)->join(",")??'null') . ")";
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:90: characters 4-73
			$decls->arr[$decls->length] = $x1;
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:90: characters 4-73
			++$decls->length;
		}
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:91: characters 3-25
		$sql = ($sql??'null') . ($decls->join(",")??'null');
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:92: characters 3-13
		$sql = ($sql??'null') . ")";
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:93: lines 93-94
		if ($engine !== null) {
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:94: characters 4-27
			$sql = ($sql??'null') . (("ENGINE=" . ($engine??'null'))??'null');
		}
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:95: characters 3-19
		$cnx->request($sql);
	}


	/**
	 * @param Manager $manager
	 * 
	 * @return bool
	 */
	static public function exists ($manager) {
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:99: characters 3-51
		$cnx = $manager->getCnx();
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:100: lines 100-101
		if ($cnx === null) {
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:101: characters 4-9
			throw new HxException("SQL Connection not initialized on Manager");
		}
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:102: lines 102-107
		try {
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:103: characters 4-69
			$cnx->request("SELECT * FROM `" . ($manager->dbInfos()->name??'null') . "` LIMIT 1");
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:104: characters 4-15
			return true;
		} catch (\Throwable $__hx__caught_e) {
			CallStack::saveExceptionTrace($__hx__caught_e);
			$__hx__real_e = ($__hx__caught_e instanceof HxException ? $__hx__caught_e->e : $__hx__caught_e);
			$e = $__hx__real_e;
			#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:106: characters 4-16
			return false;
		}
	}


	/**
	 * @param RecordType $t
	 * @param string $dbName
	 * 
	 * @return string
	 */
	static public function getTypeSQL ($t, $dbName) {
		#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:33: lines 33-62
		switch ($t->index) {
			case 0:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:34: characters 13-39
				return "INTEGER " . (TableCreate::autoInc($dbName)??'null');
				break;
			case 2:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:35: characters 14-49
				return "INTEGER UNSIGNED " . (TableCreate::autoInc($dbName)??'null');
				break;
			case 3:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:37: characters 15-33
				return "INTEGER UNSIGNED";
				break;
			case 4:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:58: characters 16-41
				return "BIGINT " . (TableCreate::autoInc($dbName)??'null');
				break;
			case 5:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:57: characters 17-25
				return "BIGINT";
				break;
			case 6:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:44: characters 17-24
				return "FLOAT";
				break;
			case 7:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:45: characters 16-24
				return "DOUBLE";
				break;
			case 8:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:46: characters 15-27
				return "TINYINT(1)";
				break;
			case 9:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:47: characters 16-17
				$n = $t->params[0];
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:47: characters 20-36
				return "VARCHAR(" . ($n??'null') . ")";
				break;
			case 10:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:48: characters 15-21
				return "DATE";
				break;
			case 11:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:49: characters 19-29
				return "DATETIME";
				break;
			case 12:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:50: characters 20-41
				return "TIMESTAMP DEFAULT 0";
				break;
			case 13:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:51: characters 19-29
				return "TINYTEXT";
				break;
			case 14:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:52: characters 20-26
				return "TEXT";
				break;
			case 15:
			case 21:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:53: characters 28-40
				return "MEDIUMTEXT";
				break;
			case 16:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:54: characters 22-28
				return "BLOB";
				break;
			case 17:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:56: characters 21-31
				return "LONGBLOB";
				break;
			case 19:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:59: characters 15-16
				$n1 = $t->params[0];
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:59: characters 19-38
				return "BINARY(" . ($n1??'null') . ")";
				break;
			case 1:
			case 20:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:36: characters 24-33
				return "INTEGER";
				break;
			case 18:
			case 22:
			case 30:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:55: characters 41-53
				return "MEDIUMBLOB";
				break;
			case 23:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:60: characters 19-23
				$auto = $t->params[1];
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:60: characters 15-17
				$fl = $t->params[0];
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:60: characters 26-162
				return TableCreate::getTypeSQL(($auto ? ($fl->length <= 8 ? RecordType::DTinyUInt() : ($fl->length <= 16 ? RecordType::DSmallUInt() : ($fl->length <= 24 ? RecordType::DMediumUInt() : RecordType::DInt()))) : RecordType::DInt()), $dbName);
				break;
			case 24:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:38: characters 18-27
				return "TINYINT";
				break;
			case 26:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:40: characters 19-29
				return "SMALLINT";
				break;
			case 27:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:41: characters 20-39
				return "SMALLINT UNSIGNED";
				break;
			case 28:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:42: characters 20-31
				return "MEDIUMINT";
				break;
			case 29:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:43: characters 21-41
				return "MEDIUMINT UNSIGNED";
				break;
			case 25:
			case 31:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:39: characters 29-47
				return "TINYINT UNSIGNED";
				break;
			case 32:
			case 33:
				#/usr/local/lib/haxe/lib/record-macros/git/src/sys/db/TableCreate.hx:61: characters 26-31
				throw new HxException("assert");
				break;
		}
	}
}


Boot::registerClass(TableCreate::class, 'sys.db.TableCreate');
