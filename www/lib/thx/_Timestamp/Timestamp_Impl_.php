<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ 3018ab1)
 * Haxe source file: /usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx
 */

namespace thx\_Timestamp;

use \thx\TimePeriod;
use \thx\Dates;
use \php\Boot;

final class Timestamp_Impl_ {
	/**
	 * @param float $t
	 * @param float $v
	 * 
	 * @return float
	 */
	static public function c ($t, $v) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:138: characters 5-33
		return ceil($t / $v) * $v;
	}


	/**
	 * Creates a timestamp by using the passed year, month, day, hour, minute, second.
	 * Note that each argument can overflow its normal boundaries (e.g. a month value of `-33` is perfectly valid)
	 * and the method will normalize that value by offsetting the other arguments by the right amount.
	 * 
	 * @param int $year
	 * @param int $month
	 * @param int $day
	 * @param int $hour
	 * @param int $minute
	 * @param int $second
	 * 
	 * @return float
	 */
	static public function create ($year, $month = null, $day = null, $hour = null, $minute = null, $second = null) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:24: characters 5-74
		return Dates::create($year, $month, $day, $hour, $minute, $second)->getTime();
	}


	/**
	 * @param float $t
	 * @param float $v
	 * 
	 * @return float
	 */
	static public function f ($t, $v) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:136: characters 5-34
		return floor($t / $v) * $v;
	}


	/**
	 * @param \Date $d
	 * 
	 * @return float
	 */
	static public function fromDate ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:30: characters 5-23
		return $d->getTime();
	}


	/**
	 * @param string $s
	 * 
	 * @return float
	 */
	static public function fromString ($s) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:33: characters 5-40
		return \Date::fromString($s)->getTime();
	}


	/**
	 * @return float
	 */
	static public function now () {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:27: characters 12-32
		return \Date::now()->getTime();
	}


	/**
	 * @param float $t
	 * @param float $v
	 * 
	 * @return float
	 */
	static public function r ($t, $v) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:134: characters 5-34
		return floor($t / $v + 0.5) * $v;
	}


	/**
	 * Snaps a time to the next second, minute, hour, day, week, month or year.
	 * @param time The unix time in milliseconds.  See date.getTime()
	 * @param period Either: Second, Minute, Hour, Day, Week, Month or Year
	 * @return The unix time of the snapped date (In milliseconds).
	 * 
	 * @param float $this
	 * @param TimePeriod $period
	 * 
	 * @return float
	 */
	static public function snapNext ($this1, $period) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:49: lines 49-69
		switch ($period->index) {
			case 0:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:51: characters 9-24
				return ceil($this1 / 1000.0) * 1000.0;
				break;
			case 1:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:53: characters 9-25
				return ceil($this1 / 60000.0) * 60000.0;
				break;
			case 2:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:55: characters 9-27
				return ceil($this1 / 3600000.0) * 3600000.0;
				break;
			case 3:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:57: characters 9-26
				$d = \Date::fromTime($this1);
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:58: characters 9-72
				return Dates::create($d->getFullYear(), $d->getMonth(), $d->getDate() + 1, 0, 0, 0)->getTime();
				break;
			case 4:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:60: lines 60-61
				$d1 = \Date::fromTime($this1);
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:60: lines 60-61
				$wd = $d1->getDay();
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:62: characters 9-77
				return Dates::create($d1->getFullYear(), $d1->getMonth(), $d1->getDate() + 7 - $wd, 0, 0, 0)->getTime();
				break;
			case 5:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:64: characters 9-26
				$d2 = \Date::fromTime($this1);
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:65: characters 9-62
				return Dates::create($d2->getFullYear(), $d2->getMonth() + 1, 1, 0, 0, 0)->getTime();
				break;
			case 6:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:67: characters 9-26
				$d3 = \Date::fromTime($this1);
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:68: characters 9-51
				return Dates::create($d3->getFullYear() + 1, 0, 1, 0, 0, 0)->getTime();
				break;
		}
	}


	/**
	 * Snaps a time to the previous second, minute, hour, day, week, month or year.
	 * @param time The unix time in milliseconds.  See date.getTime()
	 * @param period Either: Second, Minute, Hour, Day, Week, Month or Year
	 * @return The unix time of the snapped date (In milliseconds).
	 * 
	 * @param float $this
	 * @param TimePeriod $period
	 * 
	 * @return float
	 */
	static public function snapPrev ($this1, $period) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:79: lines 79-99
		switch ($period->index) {
			case 0:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:81: characters 9-24
				return floor($this1 / 1000.0) * 1000.0;
				break;
			case 1:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:83: characters 9-25
				return floor($this1 / 60000.0) * 60000.0;
				break;
			case 2:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:85: characters 9-27
				return floor($this1 / 3600000.0) * 3600000.0;
				break;
			case 3:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:87: characters 9-26
				$d = \Date::fromTime($this1);
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:88: characters 9-68
				return Dates::create($d->getFullYear(), $d->getMonth(), $d->getDate(), 0, 0, 0)->getTime();
				break;
			case 4:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:90: lines 90-91
				$d1 = \Date::fromTime($this1);
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:90: lines 90-91
				$wd = $d1->getDay();
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:92: characters 9-73
				return Dates::create($d1->getFullYear(), $d1->getMonth(), $d1->getDate() - $wd, 0, 0, 0)->getTime();
				break;
			case 5:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:94: characters 9-26
				$d2 = \Date::fromTime($this1);
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:95: characters 9-58
				return Dates::create($d2->getFullYear(), $d2->getMonth(), 1, 0, 0, 0)->getTime();
				break;
			case 6:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:97: characters 9-26
				$d3 = \Date::fromTime($this1);
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:98: characters 9-47
				return Dates::create($d3->getFullYear(), 0, 1, 0, 0, 0)->getTime();
				break;
		}
	}


	/**
	 * Snaps a time to the nearest second, minute, hour, day, week, month or year.
	 * @param period Either: Second, Minute, Hour, Day, Week, Month or Year
	 * 
	 * @param float $this
	 * @param TimePeriod $period
	 * 
	 * @return float
	 */
	static public function snapTo ($this1, $period) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:107: lines 107-131
		switch ($period->index) {
			case 0:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:109: characters 9-24
				return floor($this1 / 1000.0 + 0.5) * 1000.0;
				break;
			case 1:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:111: characters 9-25
				return floor($this1 / 60000.0 + 0.5) * 60000.0;
				break;
			case 2:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:113: characters 9-27
				return floor($this1 / 3600000.0 + 0.5) * 3600000.0;
				break;
			case 3:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:115: lines 115-116
				$d = \Date::fromTime($this1);
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:115: lines 115-116
				$mod = ($d->getHours() >= 12 ? 1 : 0);
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:117: characters 9-74
				return Dates::create($d->getFullYear(), $d->getMonth(), $d->getDate() + $mod, 0, 0, 0)->getTime();
				break;
			case 4:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:119: lines 119-121
				$d1 = \Date::fromTime($this1);
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:119: lines 119-121
				$wd = $d1->getDay();
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:119: lines 119-121
				$mod1 = ($wd < 3 ? -$wd : ($wd > 3 ? 7 - $wd : ($d1->getHours() < 12 ? -$wd : 7 - $wd)));
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:122: characters 9-74
				return Dates::create($d1->getFullYear(), $d1->getMonth(), $d1->getDate() + $mod1, 0, 0, 0)->getTime();
				break;
			case 5:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:124: lines 124-125
				$d2 = \Date::fromTime($this1);
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:124: lines 124-125
				$mod2 = ($d2->getDate() > (int)(floor(\DateTools::getMonthDays($d2) / 2 + 0.5)) ? 1 : 0);
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:126: characters 9-64
				return Dates::create($d2->getFullYear(), $d2->getMonth() + $mod2, 1, 0, 0, 0)->getTime();
				break;
			case 6:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:128: lines 128-129
				$d3 = \Date::fromTime($this1);
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:128: lines 128-129
				$mod3 = ($this1 > (new \Date($d3->getFullYear(), 6, 2, 0, 0, 0))->getTime() ? 1 : 0);
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:130: characters 9-53
				return Dates::create($d3->getFullYear() + $mod3, 0, 1, 0, 0, 0)->getTime();
				break;
		}
	}


	/**
	 * @param float $this
	 * 
	 * @return \Date
	 */
	static public function toDate ($this1) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:36: characters 5-31
		return \Date::fromTime($this1);
	}


	/**
	 * @param float $this
	 * 
	 * @return string
	 */
	static public function toString ($this1) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Timestamp.hx:39: characters 5-31
		return \Date::fromTime($this1)->toString();
	}
}


Boot::registerClass(Timestamp_Impl_::class, 'thx._Timestamp.Timestamp_Impl_');
