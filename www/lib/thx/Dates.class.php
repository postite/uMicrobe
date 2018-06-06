<?php

// Generated by Haxe 3.4.7
class thx_Dates {
	public function __construct(){}
	static function compare($a, $b) {
		$GLOBALS['%s']->push("thx.Dates::compare");
		$__hx__spos = $GLOBALS['%s']->length;
		$a1 = $a->getTime();
		$b1 = $b->getTime();
		if($a1 < $b1) {
			$GLOBALS['%s']->pop();
			return -1;
		} else {
			if($a1 > $b1) {
				$GLOBALS['%s']->pop();
				return 1;
			} else {
				$GLOBALS['%s']->pop();
				return 0;
			}
		}
		$GLOBALS['%s']->pop();
	}
	static function create($year, $month = null, $day = null, $hour = null, $minute = null, $second = null) {
		$GLOBALS['%s']->push("thx.Dates::create");
		$__hx__spos = $GLOBALS['%s']->length;
		if($second === null) {
			$second = 0;
		}
		if($minute === null) {
			$minute = 0;
		}
		if($hour === null) {
			$hour = 0;
		}
		if($day === null) {
			$day = 1;
		}
		if($month === null) {
			$month = 0;
		}
		$minute = $minute + Math::floor($second / 60);
		$second = _hx_mod($second, 60);
		if($second < 0) {
			$second = $second + 60;
		}
		$hour = $hour + Math::floor($minute / 60);
		$minute = _hx_mod($minute, 60);
		if($minute < 0) {
			$minute = $minute + 60;
		}
		$day = $day + Math::floor($hour / 24);
		$hour = _hx_mod($hour, 24);
		if($hour < 0) {
			$hour = $hour + 24;
		}
		if($day === 0) {
			$month = $month - 1;
			if($month < 0) {
				$month = 11;
				$year = $year - 1;
			}
			$day = thx_Dates::daysInMonth($year, $month);
		}
		$year = $year + Math::floor($month / 12);
		$month = _hx_mod($month, 12);
		if($month < 0) {
			$month = $month + 12;
		}
		$days = thx_Dates::daysInMonth($year, $month);
		while($day > $days) {
			if($day > $days) {
				$day = $day - $days;
				$month = $month + 1;
			}
			if($month > 11) {
				$month = $month - 12;
				$year = $year + 1;
			}
			$days = thx_Dates::daysInMonth($year, $month);
		}
		{
			$tmp = new Date($year, $month, $day, $hour, $minute, $second);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function daysRange($start, $end) {
		$GLOBALS['%s']->push("thx.Dates::daysRange");
		$__hx__spos = $GLOBALS['%s']->length;
		if(thx_Dates::compare($end, $start) < 0) {
			$tmp = (new _hx_array(array()));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$days = (new _hx_array(array()));
		while(!thx_Dates::sameDay($start, $end)) {
			$days->push($start);
			$start = thx_Dates::jump($start, thx_TimePeriod::$Day, 1);
		}
		$days->push($end);
		{
			$GLOBALS['%s']->pop();
			return $days;
		}
		$GLOBALS['%s']->pop();
	}
	static function equals($self, $other) {
		$GLOBALS['%s']->push("thx.Dates::equals");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = $self->getTime();
		{
			$tmp2 = _hx_equal($tmp, $other->getTime());
			$GLOBALS['%s']->pop();
			return $tmp2;
		}
		$GLOBALS['%s']->pop();
	}
	static function nearEquals($self, $other, $units = null, $period = null) {
		$GLOBALS['%s']->push("thx.Dates::nearEquals");
		$__hx__spos = $GLOBALS['%s']->length;
		if($units === null) {
			$units = 1;
		}
		if(null === $period) {
			$period = thx_TimePeriod::$Second;
		}
		if($units < 0) {
			$units = -$units;
		}
		$min = thx_Dates::jump($self, $period, -$units);
		$max = thx_Dates::jump($self, $period, $units);
		if(thx_Dates::compare($min, $other) <= 0) {
			$tmp = thx_Dates::compare($max, $other) >= 0;
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$GLOBALS['%s']->pop();
			return false;
		}
		$GLOBALS['%s']->pop();
	}
	static function greater($self, $other) {
		$GLOBALS['%s']->push("thx.Dates::greater");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::compare($self, $other) > 0;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function more($self, $other) {
		$GLOBALS['%s']->push("thx.Dates::more");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::compare($self, $other) > 0;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function less($self, $other) {
		$GLOBALS['%s']->push("thx.Dates::less");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::compare($self, $other) < 0;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function greaterEquals($self, $other) {
		$GLOBALS['%s']->push("thx.Dates::greaterEquals");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::compare($self, $other) >= 0;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function moreEqual($self, $other) {
		$GLOBALS['%s']->push("thx.Dates::moreEqual");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::compare($self, $other) >= 0;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function lessEquals($self, $other) {
		$GLOBALS['%s']->push("thx.Dates::lessEquals");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::compare($self, $other) <= 0;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function lessEqual($self, $other) {
		$GLOBALS['%s']->push("thx.Dates::lessEqual");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::compare($self, $other) <= 0;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function isLeapYear($year) {
		$GLOBALS['%s']->push("thx.Dates::isLeapYear");
		$__hx__spos = $GLOBALS['%s']->length;
		if(_hx_mod($year, 4) !== 0) {
			$GLOBALS['%s']->pop();
			return false;
		}
		if(_hx_mod($year, 100) === 0) {
			$tmp = _hx_mod($year, 400) === 0;
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		{
			$GLOBALS['%s']->pop();
			return true;
		}
		$GLOBALS['%s']->pop();
	}
	static function isInLeapYear($d) {
		$GLOBALS['%s']->push("thx.Dates::isInLeapYear");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::isLeapYear($d->getFullYear());
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function daysInMonth($year, $month) {
		$GLOBALS['%s']->push("thx.Dates::daysInMonth");
		$__hx__spos = $GLOBALS['%s']->length;
		switch($month) {
		case 1:{
			if(thx_Dates::isLeapYear($year)) {
				$GLOBALS['%s']->pop();
				return 29;
			} else {
				$GLOBALS['%s']->pop();
				return 28;
			}
		}break;
		case 0:case 2:case 4:case 6:case 7:case 9:case 11:{
			$GLOBALS['%s']->pop();
			return 31;
		}break;
		case 3:case 5:case 8:case 10:{
			$GLOBALS['%s']->pop();
			return 30;
		}break;
		default:{
			throw new HException("Invalid month \"" . _hx_string_rec($month, "") . "\".  Month should be a number, Jan=0, Dec=11");
		}break;
		}
		$GLOBALS['%s']->pop();
	}
	static function numDaysInMonth($month, $year) {
		$GLOBALS['%s']->push("thx.Dates::numDaysInMonth");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::daysInMonth($year, $month);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function daysInThisMonth($d) {
		$GLOBALS['%s']->push("thx.Dates::daysInThisMonth");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = $d->getFullYear();
		{
			$tmp2 = thx_Dates::daysInMonth($tmp, $d->getMonth());
			$GLOBALS['%s']->pop();
			return $tmp2;
		}
		$GLOBALS['%s']->pop();
	}
	static function numDaysInThisMonth($d) {
		$GLOBALS['%s']->push("thx.Dates::numDaysInThisMonth");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::daysInThisMonth($d);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function sameYear($self, $other) {
		$GLOBALS['%s']->push("thx.Dates::sameYear");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = $self->getFullYear();
		{
			$tmp2 = $tmp === $other->getFullYear();
			$GLOBALS['%s']->pop();
			return $tmp2;
		}
		$GLOBALS['%s']->pop();
	}
	static function sameMonth($self, $other) {
		$GLOBALS['%s']->push("thx.Dates::sameMonth");
		$__hx__spos = $GLOBALS['%s']->length;
		if(thx_Dates::sameYear($self, $other)) {
			$tmp = $self->getMonth();
			{
				$tmp2 = $tmp === $other->getMonth();
				$GLOBALS['%s']->pop();
				return $tmp2;
			}
		} else {
			$GLOBALS['%s']->pop();
			return false;
		}
		$GLOBALS['%s']->pop();
	}
	static function sameDay($self, $other) {
		$GLOBALS['%s']->push("thx.Dates::sameDay");
		$__hx__spos = $GLOBALS['%s']->length;
		if(thx_Dates::sameMonth($self, $other)) {
			$tmp = $self->getDate();
			{
				$tmp2 = $tmp === $other->getDate();
				$GLOBALS['%s']->pop();
				return $tmp2;
			}
		} else {
			$GLOBALS['%s']->pop();
			return false;
		}
		$GLOBALS['%s']->pop();
	}
	static function sameHour($self, $other) {
		$GLOBALS['%s']->push("thx.Dates::sameHour");
		$__hx__spos = $GLOBALS['%s']->length;
		if(thx_Dates::sameDay($self, $other)) {
			$tmp = $self->getHours();
			{
				$tmp2 = $tmp === $other->getHours();
				$GLOBALS['%s']->pop();
				return $tmp2;
			}
		} else {
			$GLOBALS['%s']->pop();
			return false;
		}
		$GLOBALS['%s']->pop();
	}
	static function sameMinute($self, $other) {
		$GLOBALS['%s']->push("thx.Dates::sameMinute");
		$__hx__spos = $GLOBALS['%s']->length;
		if(thx_Dates::sameHour($self, $other)) {
			$tmp = $self->getMinutes();
			{
				$tmp2 = $tmp === $other->getMinutes();
				$GLOBALS['%s']->pop();
				return $tmp2;
			}
		} else {
			$GLOBALS['%s']->pop();
			return false;
		}
		$GLOBALS['%s']->pop();
	}
	static function snapNext($date, $period) {
		$GLOBALS['%s']->push("thx.Dates::snapNext");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = Date::fromTime(thx__Timestamp_Timestamp_Impl_::snapNext($date->getTime(), $period));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function snapPrev($date, $period) {
		$GLOBALS['%s']->push("thx.Dates::snapPrev");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = Date::fromTime(thx__Timestamp_Timestamp_Impl_::snapPrev($date->getTime(), $period));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function snapTo($date, $period) {
		$GLOBALS['%s']->push("thx.Dates::snapTo");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = Date::fromTime(thx__Timestamp_Timestamp_Impl_::snapTo($date->getTime(), $period));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function jump($date, $period, $amount) {
		$GLOBALS['%s']->push("thx.Dates::jump");
		$__hx__spos = $GLOBALS['%s']->length;
		$sec = $date->getSeconds();
		$min = $date->getMinutes();
		$hour = $date->getHours();
		$day = $date->getDate();
		$month = $date->getMonth();
		$year = $date->getFullYear();
		switch($period->index) {
		case 0:{
			$sec = $sec + $amount;
		}break;
		case 1:{
			$min = $min + $amount;
		}break;
		case 2:{
			$hour = $hour + $amount;
		}break;
		case 3:{
			$day = $day + $amount;
		}break;
		case 4:{
			$day = $day + $amount * 7;
		}break;
		case 5:{
			$month = $month + $amount;
		}break;
		case 6:{
			$year = $year + $amount;
		}break;
		}
		{
			$tmp = thx_Dates::create($year, $month, $day, $hour, $min, $sec);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function max($self, $other) {
		$GLOBALS['%s']->push("thx.Dates::max");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = $self->getTime();
		if($tmp > $other->getTime()) {
			$GLOBALS['%s']->pop();
			return $self;
		} else {
			$GLOBALS['%s']->pop();
			return $other;
		}
		$GLOBALS['%s']->pop();
	}
	static function min($self, $other) {
		$GLOBALS['%s']->push("thx.Dates::min");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = $self->getTime();
		if($tmp < $other->getTime()) {
			$GLOBALS['%s']->pop();
			return $self;
		} else {
			$GLOBALS['%s']->pop();
			return $other;
		}
		$GLOBALS['%s']->pop();
	}
	static function snapToWeekDay($date, $day, $firstDayOfWk = null) {
		$GLOBALS['%s']->push("thx.Dates::snapToWeekDay");
		$__hx__spos = $GLOBALS['%s']->length;
		if($firstDayOfWk === null) {
			$firstDayOfWk = 0;
		}
		$d = $date->getDay();
		$s = $day;
		if($s < $firstDayOfWk) {
			$s = $s + 7;
		}
		if($d < $firstDayOfWk) {
			$d = $d + 7;
		}
		{
			$tmp = thx_Dates::jump($date, thx_TimePeriod::$Day, $s - $d);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function snapNextWeekDay($date, $day) {
		$GLOBALS['%s']->push("thx.Dates::snapNextWeekDay");
		$__hx__spos = $GLOBALS['%s']->length;
		$d = $date->getDay();
		$s = $day;
		if($s < $d) {
			$s = $s + 7;
		}
		{
			$tmp = thx_Dates::jump($date, thx_TimePeriod::$Day, $s - $d);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function snapPrevWeekDay($date, $day) {
		$GLOBALS['%s']->push("thx.Dates::snapPrevWeekDay");
		$__hx__spos = $GLOBALS['%s']->length;
		$d = $date->getDay();
		$s = $day;
		if($s > $d) {
			$s = $s - 7;
		}
		{
			$tmp = thx_Dates::jump($date, thx_TimePeriod::$Day, $s - $d);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function prevYear($d) {
		$GLOBALS['%s']->push("thx.Dates::prevYear");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::jump($d, thx_TimePeriod::$Year, -1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function nextYear($d) {
		$GLOBALS['%s']->push("thx.Dates::nextYear");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::jump($d, thx_TimePeriod::$Year, 1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function prevMonth($d) {
		$GLOBALS['%s']->push("thx.Dates::prevMonth");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::jump($d, thx_TimePeriod::$Month, -1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function nextMonth($d) {
		$GLOBALS['%s']->push("thx.Dates::nextMonth");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::jump($d, thx_TimePeriod::$Month, 1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function prevWeek($d) {
		$GLOBALS['%s']->push("thx.Dates::prevWeek");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::jump($d, thx_TimePeriod::$Week, -1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function nextWeek($d) {
		$GLOBALS['%s']->push("thx.Dates::nextWeek");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::jump($d, thx_TimePeriod::$Week, 1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function prevDay($d) {
		$GLOBALS['%s']->push("thx.Dates::prevDay");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::jump($d, thx_TimePeriod::$Day, -1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function nextDay($d) {
		$GLOBALS['%s']->push("thx.Dates::nextDay");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::jump($d, thx_TimePeriod::$Day, 1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function prevHour($d) {
		$GLOBALS['%s']->push("thx.Dates::prevHour");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::jump($d, thx_TimePeriod::$Hour, -1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function nextHour($d) {
		$GLOBALS['%s']->push("thx.Dates::nextHour");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::jump($d, thx_TimePeriod::$Hour, 1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function prevMinute($d) {
		$GLOBALS['%s']->push("thx.Dates::prevMinute");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::jump($d, thx_TimePeriod::$Minute, -1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function nextMinute($d) {
		$GLOBALS['%s']->push("thx.Dates::nextMinute");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::jump($d, thx_TimePeriod::$Minute, 1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function prevSecond($d) {
		$GLOBALS['%s']->push("thx.Dates::prevSecond");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::jump($d, thx_TimePeriod::$Second, -1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function nextSecond($d) {
		$GLOBALS['%s']->push("thx.Dates::nextSecond");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = thx_Dates::jump($d, thx_TimePeriod::$Second, 1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function withYear($date, $year) {
		$GLOBALS['%s']->push("thx.Dates::withYear");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = $date->getMonth();
		$tmp1 = $date->getDate();
		$tmp2 = $date->getHours();
		$tmp3 = $date->getMinutes();
		{
			$tmp4 = thx_Dates::create($year, $tmp, $tmp1, $tmp2, $tmp3, $date->getSeconds());
			$GLOBALS['%s']->pop();
			return $tmp4;
		}
		$GLOBALS['%s']->pop();
	}
	static function withMonth($date, $month) {
		$GLOBALS['%s']->push("thx.Dates::withMonth");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = $date->getFullYear();
		$tmp1 = $date->getDate();
		$tmp2 = $date->getHours();
		$tmp3 = $date->getMinutes();
		{
			$tmp4 = thx_Dates::create($tmp, $month, $tmp1, $tmp2, $tmp3, $date->getSeconds());
			$GLOBALS['%s']->pop();
			return $tmp4;
		}
		$GLOBALS['%s']->pop();
	}
	static function withDay($date, $day) {
		$GLOBALS['%s']->push("thx.Dates::withDay");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = $date->getFullYear();
		$tmp1 = $date->getMonth();
		$tmp2 = $date->getHours();
		$tmp3 = $date->getMinutes();
		{
			$tmp4 = thx_Dates::create($tmp, $tmp1, $day, $tmp2, $tmp3, $date->getSeconds());
			$GLOBALS['%s']->pop();
			return $tmp4;
		}
		$GLOBALS['%s']->pop();
	}
	static function withHour($date, $hour) {
		$GLOBALS['%s']->push("thx.Dates::withHour");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = $date->getFullYear();
		$tmp1 = $date->getMonth();
		$tmp2 = $date->getDate();
		$tmp3 = $date->getMinutes();
		{
			$tmp4 = thx_Dates::create($tmp, $tmp1, $tmp2, $hour, $tmp3, $date->getSeconds());
			$GLOBALS['%s']->pop();
			return $tmp4;
		}
		$GLOBALS['%s']->pop();
	}
	static function withMinute($date, $minute) {
		$GLOBALS['%s']->push("thx.Dates::withMinute");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = $date->getFullYear();
		$tmp1 = $date->getMonth();
		$tmp2 = $date->getDate();
		$tmp3 = $date->getHours();
		{
			$tmp4 = thx_Dates::create($tmp, $tmp1, $tmp2, $tmp3, $minute, $date->getSeconds());
			$GLOBALS['%s']->pop();
			return $tmp4;
		}
		$GLOBALS['%s']->pop();
	}
	static function withSecond($date, $second) {
		$GLOBALS['%s']->push("thx.Dates::withSecond");
		$__hx__spos = $GLOBALS['%s']->length;
		$tmp = $date->getFullYear();
		$tmp1 = $date->getMonth();
		$tmp2 = $date->getDate();
		$tmp3 = $date->getHours();
		{
			$tmp4 = thx_Dates::create($tmp, $tmp1, $tmp2, $tmp3, $date->getMinutes(), $second);
			$GLOBALS['%s']->pop();
			return $tmp4;
		}
		$GLOBALS['%s']->pop();
	}
	static function parseDate($s) {
		$GLOBALS['%s']->push("thx.Dates::parseDate");
		$__hx__spos = $GLOBALS['%s']->length;
		try {
			{
				$tmp = thx_Either::Right(Date::fromString($s));
				$GLOBALS['%s']->pop();
				return $tmp;
			}
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				$GLOBALS['%e'] = (new _hx_array(array()));
				while($GLOBALS['%s']->length >= $__hx__spos) {
					$GLOBALS['%e']->unshift($GLOBALS['%s']->pop());
				}
				$GLOBALS['%s']->push($GLOBALS['%e'][0]);
				{
					$tmp = thx_Either::Left("" . _hx_string_or_null($s) . " could not be parsed to a valid Date value.");
					$GLOBALS['%s']->pop();
					return $tmp;
				}
			}
		}
		$GLOBALS['%s']->pop();
	}
	static function order() { $args = func_get_args(); return call_user_func_array(self::$order, $args); }
	static $order;
	function __toString() { return 'thx.Dates'; }
}
thx_Dates::$order = thx__Ord_Ord_Impl_::fromIntComparison((property_exists("thx_Dates", "compare") ? thx_Dates::$compare: array("thx_Dates", "compare")));