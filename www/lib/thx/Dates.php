<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ 3018ab1)
 * Haxe source file: /usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx
 */

namespace thx;

use \php\_Boot\HxClosure;
use \php\Boot;
use \php\_Boot\HxException;
use \thx\_Timestamp\Timestamp_Impl_;
use \haxe\CallStack;
use \thx\_Ord\Ord_Impl_;

/**
 * `Dates` provides additional extension methods on top of the `Date` type.
 * ```
 * using Dates;
 * ```
 * @author Jason O'Neil
 * @author Franco Ponticelli
 */
class Dates {
	/**
	 * @var \Closure
	 */
	static public $order;


	/**
	 * It compares two dates.
	 * 
	 * @param \Date $a
	 * @param \Date $b
	 * 
	 * @return int
	 */
	static public function compare ($a, $b) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:20: characters 12-52
		$a1 = $a->getTime();
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:20: characters 12-52
		$b1 = $b->getTime();
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:20: characters 12-52
		if ($a1 < $b1) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:20: characters 12-52
			return -1;
		} else if ($a1 > $b1) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:20: characters 12-52
			return 1;
		} else {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:20: characters 12-52
			return 0;
		}
	}


	/**
	 * Creates a Date by using the passed year, month, day, hour, minute, second.
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
	 * @return \Date
	 */
	static public function create ($year, $month = 0, $day = 1, $hour = 0, $minute = 0, $second = 0) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:29: lines 29-70
		if ($month === null) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:29: lines 29-70
			$month = 0;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:29: lines 29-70
		if ($day === null) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:29: lines 29-70
			$day = 1;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:29: lines 29-70
		if ($hour === null) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:29: lines 29-70
			$hour = 0;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:29: lines 29-70
		if ($minute === null) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:29: lines 29-70
			$minute = 0;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:29: lines 29-70
		if ($second === null) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:29: lines 29-70
			$second = 0;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:31: characters 5-38
		$minute = $minute + (int)(floor($second / 60));
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:32: characters 5-25
		$second = $second % 60;
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:33: characters 5-32
		if ($second < 0) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:33: characters 20-32
			$second = $second + 60;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:35: characters 5-36
		$hour = $hour + (int)(floor($minute / 60));
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:36: characters 5-25
		$minute = $minute % 60;
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:37: characters 5-32
		if ($minute < 0) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:37: characters 20-32
			$minute = $minute + 60;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:39: characters 5-33
		$day = $day + (int)(floor($hour / 24));
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:40: characters 5-21
		$hour = $hour % 24;
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:41: characters 5-28
		if ($hour < 0) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:41: characters 18-28
			$hour = $hour + 24;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:43: lines 43-50
		if ($day === 0) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:44: characters 7-16
			$month = $month - 1;
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:45: lines 45-48
			if ($month < 0) {
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:46: characters 9-19
				$month = 11;
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:47: characters 9-17
				$year = $year - 1;
			}
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:49: characters 7-37
			$day = Dates::daysInMonth($year, $month);
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:52: characters 5-35
		$year = $year + (int)(floor($month / 12));
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:53: characters 5-23
		$month = $month % 12;
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:54: characters 5-30
		if ($month < 0) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:54: characters 19-30
			$month = $month + 12;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:56: characters 5-41
		$days = Dates::daysInMonth($year, $month);
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:57: lines 57-67
		while ($day > $days) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:58: lines 58-61
			if ($day > $days) {
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:59: characters 13-24
				$day = $day - $days;
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:60: characters 13-20
				$month = $month + 1;
			}
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:62: lines 62-65
			if ($month > 11) {
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:63: characters 13-24
				$month = $month - 12;
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:64: characters 13-19
				$year = $year + 1;
			}
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:66: characters 9-40
			$days = Dates::daysInMonth($year, $month);
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:69: characters 5-60
		return new \Date($year, $month, $day, $hour, $minute, $second);
	}


	/**
	 * Returns the number of days in a month.
	 * @param month An integer representing the month. (Jan=0, Dec=11)
	 * @param year An 4 digit integer representing the year.
	 * @return Int, the number of days in the month.
	 * @throws Error if the month is not between 0 and 11.
	 * 
	 * @param int $year
	 * @param int $month
	 * 
	 * @return int
	 */
	static public function daysInMonth ($year, $month) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:184: lines 184-189
		switch ($month) {
			case 1:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:187: characters 15-41
				if (Dates::isLeapYear($year)) {
					#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:187: characters 34-36
					return 29;
				} else {
					#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:187: characters 39-41
					return 28;
				}
				break;
			case 0:
			case 2:
			case 4:
			case 6:
			case 7:
			case 9:
			case 11:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:185: characters 34-36
				return 31;
				break;
			case 3:
			case 5:
			case 8:
			case 10:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:186: characters 25-27
				return 30;
				break;
			default:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:188: characters 16-21
				throw new HxException("Invalid month \"" . ($month??'null') . "\".  Month should be a number, Jan=0, Dec=11");
				break;
		}
	}


	/**
	 * Tells how many days in the month of the given date.
	 * @param date The date representing the month we are checking.
	 * @return Int, the number of days in the month.
	 * 
	 * @param \Date $d
	 * 
	 * @return int
	 */
	static public function daysInThisMonth ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:202: characters 5-54
		return Dates::daysInMonth($d->getFullYear(), $d->getMonth());
	}


	/**
	 * Creates an array of dates that begin at `start` and end at `end` included.
	 * Time values are pick from the `start` value except for the last value that will
	 * match `end`. No interpolation is made.
	 * 
	 * @param \Date $start
	 * @param \Date $end
	 * 
	 * @return \Array_hx
	 */
	static public function daysRange ($start, $end) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:79: characters 5-35
		if (Dates::compare($end, $start) < 0) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:79: characters 26-35
			return new \Array_hx();
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:80: characters 5-19
		$days = new \Array_hx();
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:81: lines 81-84
		while (!Dates::sameDay($start, $end)) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:82: characters 7-23
			$days->arr[$days->length] = $start;
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:82: characters 7-23
			++$days->length;

			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:83: characters 7-29
			$start = Dates::jump($start, TimePeriod::Day(), 1);
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:85: characters 5-19
		$days->arr[$days->length] = $end;
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:85: characters 5-19
		++$days->length;

		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:86: characters 5-16
		return $days;
	}


	/**
	 * Returns `true` if the passed dates are the same.
	 * 
	 * @param \Date $self
	 * @param \Date $other
	 * 
	 * @return bool
	 */
	static public function equals ($self, $other) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:93: characters 5-45
		return Boot::equal($self->getTime(), $other->getTime());
	}


	/**
	 * Returns `true` if the `self` date is greater than `other`.
	 * 
	 * @param \Date $self
	 * @param \Date $other
	 * 
	 * @return bool
	 */
	static public function greater ($self, $other) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:116: characters 5-36
		return Dates::compare($self, $other) > 0;
	}


	/**
	 * Returns `true` if the `self` date is greater than or equal to `other`.
	 * 
	 * @param \Date $self
	 * @param \Date $other
	 * 
	 * @return bool
	 */
	static public function greaterEquals ($self, $other) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:132: characters 5-37
		return Dates::compare($self, $other) >= 0;
	}


	/**
	 * Tells if the given date is inside a leap year.
	 * @param date The date object to check.
	 * @return True if it is in a leap year, false otherwise.
	 * 
	 * @param \Date $d
	 * 
	 * @return bool
	 */
	static public function isInLeapYear ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:170: characters 56-90
		return Dates::isLeapYear($d->getFullYear());
	}


	/**
	 * Tells if a year is a leap year.
	 * @param year The year, represented as a 4 digit integer
	 * @return True if a leap year, false otherwise.
	 * 
	 * @param int $year
	 * 
	 * @return bool
	 */
	static public function isLeapYear ($year) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:156: characters 5-38
		if (($year % 4) !== 0) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:156: characters 26-38
			return false;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:158: lines 158-159
		if (($year % 100) === 0) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:159: characters 7-33
			return ($year % 400) === 0;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:161: characters 5-16
		return true;
	}


	/**
	 * Get a date relative to the current date, shifting by a set period of time.
	 * Please note this works by constructing a new date object, rather than using `DateTools.delta()`.
	 * The key difference is that this allows us to jump over a period that may not be a set number of seconds.
	 * For example, jumping between months (which have different numbers of days), leap years, leap seconds, daylight savings time changes etc.
	 * @param date The starting date.
	 * @param period The TimePeriod you wish to jump by, Second, Minute, Hour, Day, Week, Month or Year.
	 * @param amount The multiple of `period` that you wish to jump by. A positive amount moves forward in time, a negative amount moves backward.
	 * 
	 * @param \Date $date
	 * @param TimePeriod $period
	 * @param int $amount
	 * 
	 * @return \Date
	 */
	static public function jump ($date, $period, $amount) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:280: lines 280-285
		$sec = $date->getSeconds();
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:280: lines 280-285
		$min = $date->getMinutes();
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:280: lines 280-285
		$hour = $date->getHours();
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:280: lines 280-285
		$day = $date->getDate();
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:280: lines 280-285
		$month = $date->getMonth();
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:280: lines 280-285
		$year = $date->getFullYear();
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:287: lines 287-295
		switch ($period->index) {
			case 0:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:288: characters 20-35
				$sec = $sec + $amount;
				break;
			case 1:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:289: characters 20-35
				$min = $min + $amount;
				break;
			case 2:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:290: characters 20-35
				$hour = $hour + $amount;
				break;
			case 3:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:291: characters 20-35
				$day = $day + $amount;
				break;
			case 4:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:292: characters 20-39
				$day = $day + $amount * 7;
				break;
			case 5:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:293: characters 20-35
				$month = $month + $amount;
				break;
			case 6:
				#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:294: characters 20-35
				$year = $year + $amount;
				break;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:297: characters 5-52
		return Dates::create($year, $month, $day, $hour, $min, $sec);
	}


	/**
	 * Returns `true` if the `self` date is lesser than `other`.
	 * 
	 * @param \Date $self
	 * @param \Date $other
	 * 
	 * @return bool
	 */
	static public function less ($self, $other) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:126: characters 5-36
		return Dates::compare($self, $other) < 0;
	}


	/**
	 * @param \Date $self
	 * @param \Date $other
	 * 
	 * @return bool
	 */
	static public function lessEqual ($self, $other) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:146: characters 5-35
		return Dates::compare($self, $other) <= 0;
	}


	/**
	 * Returns `true` if the `self` date is lesser than or equal to `other`.
	 * 
	 * @param \Date $self
	 * @param \Date $other
	 * 
	 * @return bool
	 */
	static public function lessEquals ($self, $other) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:142: characters 5-37
		return Dates::compare($self, $other) <= 0;
	}


	/**
	 * Finds and returns which of the two passed dates is the newest.
	 * 
	 * @param \Date $self
	 * @param \Date $other
	 * 
	 * @return \Date
	 */
	static public function max ($self, $other) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:304: characters 12-59
		if ($self->getTime() > $other->getTime()) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:304: characters 47-51
			return $self;
		} else {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:304: characters 54-59
			return $other;
		}
	}


	/**
	 * Finds and returns which of the two passed dates is the oldest.
	 * 
	 * @param \Date $self
	 * @param \Date $other
	 * 
	 * @return \Date
	 */
	static public function min ($self, $other) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:310: characters 12-59
		if ($self->getTime() < $other->getTime()) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:310: characters 47-51
			return $self;
		} else {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:310: characters 54-59
			return $other;
		}
	}


	/**
	 * @param \Date $self
	 * @param \Date $other
	 * 
	 * @return bool
	 */
	static public function more ($self, $other) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:120: characters 5-32
		return Dates::compare($self, $other) > 0;
	}


	/**
	 * @param \Date $self
	 * @param \Date $other
	 * 
	 * @return bool
	 */
	static public function moreEqual ($self, $other) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:136: characters 5-38
		return Dates::compare($self, $other) >= 0;
	}


	/**
	 * Returns `true` if the dates are approximately equals. The amount of delta
	 * allowed is determined by `units` and it spans that amount equally before and
	 * after the `self` date. The default `unit` value is `1`.
	 * The default `period` range is `Second`.
	 * 
	 * @param \Date $self
	 * @param \Date $other
	 * @param int $units
	 * @param TimePeriod $period
	 * 
	 * @return bool
	 */
	static public function nearEquals ($self, $other, $units = 1, $period = null) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:102: lines 102-110
		if ($units === null) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:102: lines 102-110
			$units = 1;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:103: lines 103-104
		if (null === $period) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:104: characters 7-22
			$period = TimePeriod::Second();
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:105: lines 105-106
		if ($units < 0) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:106: characters 7-21
			$units = -$units;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:107: lines 107-108
		$min = Dates::jump($self, $period, -$units);
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:107: lines 107-108
		$max = Dates::jump($self, $period, $units);
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:109: characters 12-63
		if (Dates::compare($min, $other) <= 0) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:109: characters 38-63
			return Dates::compare($max, $other) >= 0;
		} else {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:109: characters 12-63
			return false;
		}
	}


	/**
	 * Returns a new date, exactly 1 day after the given date/time.
	 * 
	 * @param \Date $d
	 * 
	 * @return \Date
	 */
	static public function nextDay ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:414: characters 5-25
		return Dates::jump($d, TimePeriod::Day(), 1);
	}


	/**
	 * Returns a new date, exactly 1 hour after the given date/time.
	 * 
	 * @param \Date $d
	 * 
	 * @return \Date
	 */
	static public function nextHour ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:426: characters 5-26
		return Dates::jump($d, TimePeriod::Hour(), 1);
	}


	/**
	 * Returns a new date, exactly 1 minute after the given date/time.
	 * 
	 * @param \Date $d
	 * 
	 * @return \Date
	 */
	static public function nextMinute ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:438: characters 5-28
		return Dates::jump($d, TimePeriod::Minute(), 1);
	}


	/**
	 * Returns a new date, exactly 1 month after the given date/time.
	 * 
	 * @param \Date $d
	 * 
	 * @return \Date
	 */
	static public function nextMonth ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:390: characters 5-27
		return Dates::jump($d, TimePeriod::Month(), 1);
	}


	/**
	 * Returns a new date, exactly 1 second after the given date/time.
	 * 
	 * @param \Date $d
	 * 
	 * @return \Date
	 */
	static public function nextSecond ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:450: characters 5-28
		return Dates::jump($d, TimePeriod::Second(), 1);
	}


	/**
	 * Returns a new date, exactly 1 week after the given date/time.
	 * 
	 * @param \Date $d
	 * 
	 * @return \Date
	 */
	static public function nextWeek ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:402: characters 5-26
		return Dates::jump($d, TimePeriod::Week(), 1);
	}


	/**
	 * Returns a new date, exactly 1 year after the given date/time.
	 * 
	 * @param \Date $d
	 * 
	 * @return \Date
	 */
	static public function nextYear ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:378: characters 5-26
		return Dates::jump($d, TimePeriod::Year(), 1);
	}


	/**
	 * @param int $month
	 * @param int $year
	 * 
	 * @return int
	 */
	static public function numDaysInMonth ($month, $year) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:193: characters 5-36
		return Dates::daysInMonth($year, $month);
	}


	/**
	 * @param \Date $d
	 * 
	 * @return int
	 */
	static public function numDaysInThisMonth ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:206: characters 5-30
		return Dates::daysInThisMonth($d);
	}


	/**
	 * Safely parse a string value to a date.
	 * 
	 * @param string $s
	 * 
	 * @return Either
	 */
	static public function parseDate ($s) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:492: lines 492-496
		try {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:493: characters 7-39
			return Either::Right(\Date::fromString($s));
		} catch (\Throwable $__hx__caught_e) {
			CallStack::saveExceptionTrace($__hx__caught_e);
			$__hx__real_e = ($__hx__caught_e instanceof HxException ? $__hx__caught_e->e : $__hx__caught_e);
			$e = $__hx__real_e;
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:495: characters 7-67
			return Either::Left("" . ($s??'null') . " could not be parsed to a valid Date value.");
		}
	}


	/**
	 * Returns a new date, exactly 1 day before the given date/time.
	 * 
	 * @param \Date $d
	 * 
	 * @return \Date
	 */
	static public function prevDay ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:408: characters 5-26
		return Dates::jump($d, TimePeriod::Day(), -1);
	}


	/**
	 * Returns a new date, exactly 1 hour before the given date/time.
	 * 
	 * @param \Date $d
	 * 
	 * @return \Date
	 */
	static public function prevHour ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:420: characters 5-27
		return Dates::jump($d, TimePeriod::Hour(), -1);
	}


	/**
	 * Returns a new date, exactly 1 minute before the given date/time.
	 * 
	 * @param \Date $d
	 * 
	 * @return \Date
	 */
	static public function prevMinute ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:432: characters 5-29
		return Dates::jump($d, TimePeriod::Minute(), -1);
	}


	/**
	 * Returns a new date, exactly 1 month before the given date/time.
	 * 
	 * @param \Date $d
	 * 
	 * @return \Date
	 */
	static public function prevMonth ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:384: characters 5-28
		return Dates::jump($d, TimePeriod::Month(), -1);
	}


	/**
	 * Returns a new date, exactly 1 second before the given date/time.
	 * 
	 * @param \Date $d
	 * 
	 * @return \Date
	 */
	static public function prevSecond ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:444: characters 5-29
		return Dates::jump($d, TimePeriod::Second(), -1);
	}


	/**
	 * Returns a new date, exactly 1 week before the given date/time.
	 * 
	 * @param \Date $d
	 * 
	 * @return \Date
	 */
	static public function prevWeek ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:396: characters 5-27
		return Dates::jump($d, TimePeriod::Week(), -1);
	}


	/**
	 * Returns a new date, exactly 1 year before the given date/time.
	 * 
	 * @param \Date $d
	 * 
	 * @return \Date
	 */
	static public function prevYear ($d) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:372: characters 5-27
		return Dates::jump($d, TimePeriod::Year(), -1);
	}


	/**
	 * Returns true if the 2 dates share the same year, month and day.
	 * 
	 * @param \Date $self
	 * @param \Date $other
	 * 
	 * @return bool
	 */
	static public function sameDay ($self, $other) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:224: characters 12-71
		if (Dates::sameMonth($self, $other)) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:224: characters 38-71
			return $self->getDate() === $other->getDate();
		} else {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:224: characters 12-71
			return false;
		}
	}


	/**
	 * Returns true if the 2 dates share the same year, month, day and hour.
	 * 
	 * @param \Date $self
	 * @param \Date $other
	 * 
	 * @return bool
	 */
	static public function sameHour ($self, $other) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:230: characters 12-71
		if (Dates::sameDay($self, $other)) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:230: characters 36-71
			return $self->getHours() === $other->getHours();
		} else {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:230: characters 12-71
			return false;
		}
	}


	/**
	 * Returns true if the 2 dates share the same year, month, day, hour and minute.
	 * 
	 * @param \Date $self
	 * @param \Date $other
	 * 
	 * @return bool
	 */
	static public function sameMinute ($self, $other) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:236: characters 12-76
		if (Dates::sameHour($self, $other)) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:236: characters 37-76
			return $self->getMinutes() === $other->getMinutes();
		} else {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:236: characters 12-76
			return false;
		}
	}


	/**
	 * Returns true if the 2 dates share the same year and month.
	 * 
	 * @param \Date $self
	 * @param \Date $other
	 * 
	 * @return bool
	 */
	static public function sameMonth ($self, $other) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:218: characters 14-74
		if (Dates::sameYear($self, $other)) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:218: characters 39-74
			return $self->getMonth() === $other->getMonth();
		} else {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:218: characters 14-74
			return false;
		}
	}


	/**
	 * Returns true if the 2 dates share the same year.
	 * 
	 * @param \Date $self
	 * @param \Date $other
	 * 
	 * @return bool
	 */
	static public function sameYear ($self, $other) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:212: characters 7-55
		return $self->getFullYear() === $other->getFullYear();
	}


	/**
	 * Snaps a Date to the next second, minute, hour, day, week, month or year.
	 * @param date The date to snap.  See Date.
	 * @param period Either: Second, Minute, Hour, Day, Week, Month or Year
	 * @return The snapped date.
	 * 
	 * @param \Date $date
	 * @param TimePeriod $period
	 * 
	 * @return \Date
	 */
	static public function snapNext ($date, $period) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:246: characters 5-47
		return \Date::fromTime(Timestamp_Impl_::snapNext($date->getTime(), $period));
	}


	/**
	 * Snaps a date to the next given weekday.  The time within the day will stay the same.
	 * If you are already on the given day, the date will not change.
	 * @param date The date value to snap
	 * @param day Day to snap to.  Either `Sunday`, `Monday`, `Tuesday` etc.
	 * @return The date of the day you have snapped to.
	 * 
	 * @param \Date $date
	 * @param int $day
	 * 
	 * @return \Date
	 */
	static public function snapNextWeekDay ($date, $day) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:342: lines 342-343
		$d = $date->getDay();
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:342: lines 342-343
		$s = $day;
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:346: characters 5-25
		if ($s < $d) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:346: characters 16-25
			$s = $s + 7;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:347: characters 5-34
		return Dates::jump($date, TimePeriod::Day(), $s - $d);
	}


	/**
	 * Snaps a Date to the previous second, minute, hour, day, week, month or year.
	 * @param date The date to snap.  See Date.
	 * @param period Either: Second, Minute, Hour, Day, Week, Month or Year
	 * @return The snapped date.
	 * 
	 * @param \Date $date
	 * @param TimePeriod $period
	 * 
	 * @return \Date
	 */
	static public function snapPrev ($date, $period) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:256: characters 5-47
		return \Date::fromTime(Timestamp_Impl_::snapPrev($date->getTime(), $period));
	}


	/**
	 * Snaps a date to the previous given weekday.  The time within the day will stay the same.
	 * If you are already on the given day, the date will not change.
	 * @param date The date value to snap
	 * @param day Day to snap to.  Either `Sunday`, `Monday`, `Tuesday` etc.
	 * @return The date of the day you have snapped to.
	 * 
	 * @param \Date $date
	 * @param int $day
	 * 
	 * @return \Date
	 */
	static public function snapPrevWeekDay ($date, $day) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:360: lines 360-361
		$d = $date->getDay();
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:360: lines 360-361
		$s = $day;
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:364: characters 5-25
		if ($s > $d) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:364: characters 16-25
			$s = $s - 7;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:365: characters 5-34
		return Dates::jump($date, TimePeriod::Day(), $s - $d);
	}


	/**
	 * Snaps a Date to the nearest second, minute, hour, day, week, month or year.
	 * @param date The date to snap.  See Date.
	 * @param period Either: Second, Minute, Hour, Day, Week, Month or Year
	 * @return The snapped date.
	 * 
	 * @param \Date $date
	 * @param TimePeriod $period
	 * 
	 * @return \Date
	 */
	static public function snapTo ($date, $period) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:266: characters 5-45
		return \Date::fromTime(Timestamp_Impl_::snapTo($date->getTime(), $period));
	}


	/**
	 * Snaps a date to the given weekday inside the current week.  The time within the day will stay the same.
	 * If you are already on the given day, the date will not change.
	 * @param date The date value to snap
	 * @param day Day to snap to.  Either `Sunday`, `Monday`, `Tuesday` etc.
	 * @param firstDayOfWk The first day of the week.  Default to `Sunday`.
	 * @return The date of the day you have snapped to.
	 * 
	 * @param \Date $date
	 * @param int $day
	 * @param int $firstDayOfWk
	 * 
	 * @return \Date
	 */
	static public function snapToWeekDay ($date, $day, $firstDayOfWk = 0) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:322: lines 322-330
		if ($firstDayOfWk === null) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:322: lines 322-330
			$firstDayOfWk = 0;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:323: lines 323-324
		$d = $date->getDay();
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:323: lines 323-324
		$s = $day;
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:327: characters 5-44
		if ($s < $firstDayOfWk) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:327: characters 35-44
			$s = $s + 7;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:328: characters 5-44
		if ($d < $firstDayOfWk) {
			#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:328: characters 35-44
			$d = $d + 7;
		}
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:329: characters 5-34
		return Dates::jump($date, TimePeriod::Day(), $s - $d);
	}


	/**
	 * Returns a new date that is modified only by the day.
	 * 
	 * @param \Date $date
	 * @param int $day
	 * 
	 * @return \Date
	 */
	static public function withDay ($date, $day) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:468: characters 5-121
		return Dates::create($date->getFullYear(), $date->getMonth(), $day, $date->getHours(), $date->getMinutes(), $date->getSeconds());
	}


	/**
	 * Returns a new date that is modified only by the hour.
	 * 
	 * @param \Date $date
	 * @param int $hour
	 * 
	 * @return \Date
	 */
	static public function withHour ($date, $hour) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:474: characters 5-121
		return Dates::create($date->getFullYear(), $date->getMonth(), $date->getDate(), $hour, $date->getMinutes(), $date->getSeconds());
	}


	/**
	 * Returns a new date that is modified only by the minute.
	 * 
	 * @param \Date $date
	 * @param int $minute
	 * 
	 * @return \Date
	 */
	static public function withMinute ($date, $minute) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:480: characters 5-121
		return Dates::create($date->getFullYear(), $date->getMonth(), $date->getDate(), $date->getHours(), $minute, $date->getSeconds());
	}


	/**
	 * Returns a new date that is modified only by the month (remember that month indexes begin at zero).
	 * 
	 * @param \Date $date
	 * @param int $month
	 * 
	 * @return \Date
	 */
	static public function withMonth ($date, $month) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:462: characters 5-122
		return Dates::create($date->getFullYear(), $month, $date->getDate(), $date->getHours(), $date->getMinutes(), $date->getSeconds());
	}


	/**
	 * Returns a new date that is modified only by the second.
	 * 
	 * @param \Date $date
	 * @param int $second
	 * 
	 * @return \Date
	 */
	static public function withSecond ($date, $second) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:486: characters 5-121
		return Dates::create($date->getFullYear(), $date->getMonth(), $date->getDate(), $date->getHours(), $date->getMinutes(), $second);
	}


	/**
	 * Returns a new date that is modified only by the year.
	 * 
	 * @param \Date $date
	 * @param int $year
	 * 
	 * @return \Date
	 */
	static public function withYear ($date, $year) {
		#/usr/local/lib/haxe/lib/thx,core/git/src/thx/Dates.hx:456: characters 5-118
		return Dates::create($year, $date->getMonth(), $date->getDate(), $date->getHours(), $date->getMinutes(), $date->getSeconds());
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


self::$order = Ord_Impl_::fromIntComparison(new HxClosure(Dates::class, 'compare'));
	}
}


Boot::registerClass(Dates::class, 'thx.Dates');
Dates::__hx__init();
