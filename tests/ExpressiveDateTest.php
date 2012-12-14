<?php

use Mockery as m;

class DateTest extends PHPUnit_Framework_TestCase {


	public function tearDown()
	{
		m::close();
	}


	public function setUp()
	{
		date_default_timezone_set('Australia/Melbourne');
	}


	public function testDateIsCreatedFromNow()
	{
		$date = new ExpressiveDate;
		$this->assertEquals(time(), $date->getTimestamp());
	}


	public function testDateIsCreatedFromStaticMethod()
	{
		$date = ExpressiveDate::make();
		$this->assertEquals(time(), $date->getTimestamp());
	}


	public function testDateIsCreatedWithDifferentTimezone()
	{
		$date = new ExpressiveDate(null, 'Europe/Paris');
		date_default_timezone_set('Europe/Paris');
		$this->assertEquals(time(), $date->getTimestamp());
		date_default_timezone_set('Australia/Melbourne');
		$date = new ExpressiveDate(null, new DateTimeZone('Europe/Paris'));
		date_default_timezone_set('Europe/Paris');
		$this->assertEquals(time(), $date->getTimestamp());
	}


	public function testDateIsCreatedWithCustomTimeString()
	{
		$date = new ExpressiveDate('31 January 1991');
		$this->assertEquals('31/01/1991', $date->format('d/m/Y'));
		$date = new ExpressiveDate('+1 day');
		$this->assertEquals(time() + 86400, $date->getTimestamp());
		$date = new ExpressiveDate('-1 day');
		$this->assertEquals(time() - 86400, $date->getTimestamp());
	}


	public function testCannotCreateDateWithInvalidTimezone()
	{
		$this->setExpectedException('InvalidArgumentException');
		$date = new ExpressiveDate(null, 'Australia/JasonsPlace');
	}


	public function testUseTomorrowsDateAndTime()
	{
		$date = new ExpressiveDate;
		$date->tomorrow();
		$this->assertEquals(strtotime('tomorrow'), $date->getTimestamp());
	}


	public function testUseYesterdaysDateAndTime()
	{
		$date = new ExpressiveDate;
		$date->yesterday();
		$this->assertEquals(strtotime('yesterday'), $date->getTimestamp());
	}


	public function testStartOfDay()
	{
		$date = new ExpressiveDate;
		$date->startOfDay();
		$this->assertEquals(strtotime('today'), $date->getTimestamp());
	}


	public function testEndOfDay()
	{
		$date = new ExpressiveDate;
		$date->endOfDay();
		$this->assertEquals(strtotime('tomorrow -1 second'), $date->getTimestamp());
	}


	public function testStartOfMonth()
	{
		$date = new ExpressiveDate('January');
		$date->startOfMonth();
		$this->assertEquals(strtotime('January 1'), $date->getTimestamp());
	}


	public function testEndOfMonth()
	{
		$date = new ExpressiveDate('January');
		$date->endOfMonth();
		$this->assertEquals(strtotime('February 1 -1 second'), $date->getTimestamp());
	}


	public function testAddingDays()
	{
		$date = new ExpressiveDate;
		$date->addOneDay();
		$this->assertEquals(strtotime('+1 day'), $date->getTimestamp());
		$date->addDays(3);
		$this->assertEquals(strtotime('+4 days'), $date->getTimestamp());
	}


	public function testSubtractingDays()
	{
		$date = new ExpressiveDate;
		$date->minusOneDay();
		$this->assertEquals(strtotime('-1 day'), $date->getTimestamp());
		$date->minusDays(3);
		$this->assertEquals(strtotime('-4 days'), $date->getTimestamp());
	}


	public function testAddingMonths()
	{
		$date = new ExpressiveDate;
		$date->addOneMonth();
		$this->assertEquals(strtotime('+1 month'), $date->getTimestamp());
		$date->addMonths(3);
		$this->assertEquals(strtotime('+4 months'), $date->getTimestamp());
	}


	public function testSubtractingMonths()
	{
		$date = new ExpressiveDate;
		$date->minusOneMonth();
		$this->assertEquals(strtotime('-1 month'), $date->getTimestamp());
		$date->minusMonths(3);
		$this->assertEquals(strtotime('-4 months'), $date->getTimestamp());
	}


	public function testAddingYears()
	{
		$date = new ExpressiveDate;
		$date->addOneYear();
		$this->assertEquals(strtotime('+1 year'), $date->getTimestamp());
		$date->addYears(3);
		$this->assertEquals(strtotime('+4 years'), $date->getTimestamp());
	}


	public function testSubtractingYears()
	{
		$date = new ExpressiveDate;
		$date->minusOneYear();
		$this->assertEquals(strtotime('-1 year'), $date->getTimestamp());
		$date->minusYears(3);
		$this->assertEquals(strtotime('-4 years'), $date->getTimestamp());
	}


	public function testAddingHours()
	{
		$date = new ExpressiveDate;
		$date->addOneHour();
		$this->assertEquals(strtotime('+1 hour'), $date->getTimestamp());
		$date->addHours(3);
		$this->assertEquals(strtotime('+4 hours'), $date->getTimestamp());
	}


	public function testSubtractingHours()
	{
		$date = new ExpressiveDate;
		$date->minusOneHour();
		$this->assertEquals(strtotime('-1 hour'), $date->getTimestamp());
		$date->minusHours(3);
		$this->assertEquals(strtotime('-4 hours'), $date->getTimestamp());
	}


	public function testAddingMinutes()
	{
		$date = new ExpressiveDate;
		$date->addOneMinute();
		$this->assertEquals(strtotime('+1 minute'), $date->getTimestamp());
		$date->addMinutes(3);
		$this->assertEquals(strtotime('+4 minutes'), $date->getTimestamp());
	}


	public function testSubtractingMinutes()
	{
		$date = new ExpressiveDate;
		$date->minusOneMinute();
		$this->assertEquals(strtotime('-1 minute'), $date->getTimestamp());
		$date->minusMinutes(3);
		$this->assertEquals(strtotime('-4 minutes'), $date->getTimestamp());
	}


	public function testAddingSeconds()
	{
		$date = new ExpressiveDate;
		$date->addOneSecond();
		$this->assertEquals(strtotime('+1 second'), $date->getTimestamp());
		$date->addSeconds(3);
		$this->assertEquals(strtotime('+4 seconds'), $date->getTimestamp());
	}


	public function testSubtractingSeconds()
	{
		$date = new ExpressiveDate;
		$date->minusOneSecond();
		$this->assertEquals(strtotime('-1 second'), $date->getTimestamp());
		$date->minusSeconds(3);
		$this->assertEquals(strtotime('-4 seconds'), $date->getTimestamp());
	}


	public function testAddingWeeks()
	{
		$date = new ExpressiveDate;
		$date->addOneWeek();
		$this->assertEquals(strtotime('+1 week'), $date->getTimestamp());
		$date->addWeeks(3);
		$this->assertEquals(strtotime('+4 weeks'), $date->getTimestamp());
	}


	public function testSubtractingWeeks()
	{
		$date = new ExpressiveDate;
		$date->minusOneWeek();
		$this->assertEquals(strtotime('-1 week'), $date->getTimestamp());
		$date->minusWeeks(3);
		$this->assertEquals(strtotime('-4 weeks'), $date->getTimestamp());
	}


	public function testSettingTimezoneDuringRuntime()
	{
		$date = new ExpressiveDate;
		$date->setTimezone('Europe/Paris');
		$this->assertEquals(new DateTimeZone('Europe/Paris'), $date->getTimezone());
	}


	public function testSetTimestampFromString()
	{
		$date = new ExpressiveDate;
		$date->setTimestampFromString('Next week');
		$this->assertEquals(strtotime('Next week'), $date->getTimestamp());
	}


	public function testCanCheckIfDateIsWeekday()
	{
		$date = new ExpressiveDate('Sunday');
		$this->assertFalse($date->isWeekday());
		$date->addOneDay();
		$this->assertTrue($date->isWeekday());
	}


	public function testCanCheckIfDateIsWeekend()
	{
		$date = new ExpressiveDate('Sunday');
		$this->assertTrue($date->isWeekend());
		$date->addOneDay();
		$this->assertFalse($date->isWeekend());
	}

	public function testGetDateDifferenceInYears()
	{
		$past = new ExpressiveDate('January 2010');
		$future = new ExpressiveDate('January 2013');
		$this->assertEquals(-3, $future->getDifferenceInYears($past));
		$this->assertEquals(3, $past->getDifferenceInYears($future));
	}


	public function testGetDateDifferenceInMonths()
	{
		$past = new ExpressiveDate('January 2012');
		$future = new ExpressiveDate('December 2013');
		$this->assertEquals(-22, $future->getDifferenceInMonths($past));
		$this->assertEquals(22, $past->getDifferenceInMonths($future));
	}


	public function testGetDateDifferenceInDays()
	{
		$past = new ExpressiveDate('January 12');
		$future = new ExpressiveDate('February 15');
		$this->assertEquals(-34, $future->getDifferenceInDays($past));
		$this->assertEquals(34, $past->getDifferenceInDays($future));
	}


	public function testGetDateDifferenceInHours()
	{
		$past = new ExpressiveDate('-10 hours');
		$future = new ExpressiveDate('+1 hour');
		$this->assertEquals(-11, $future->getDifferenceInHours($past));
		$this->assertEquals(11, $past->getDifferenceInHours($future));
	}


	public function testGetDateDifferenceInMinutes()
	{
		$past = new ExpressiveDate('-10 minutes');
		$future = new ExpressiveDate('+1 minute');
		$this->assertEquals(-11, $future->getDifferenceInMinutes($past));
		$this->assertEquals(11, $past->getDifferenceInMinutes($future));
	}


	public function testGetDateDifferenceInSeconds()
	{
		$past = new ExpressiveDate('-1 day');
		$future = new ExpressiveDate('+1 day');
		$this->assertEquals(86400 * 2 * -1, $future->getDifferenceInSeconds($past));
		$this->assertEquals(86400 * 2, $past->getDifferenceInSeconds($future));
	}


	public function testGetDateAsRelativeDate()
	{
		$date = new ExpressiveDate;
		$date->minusOneDay();
		$this->assertEquals('1 day ago', $date->getRelativeDate());
		$date->minusDays(2);
		$this->assertEquals('3 days ago', $date->getRelativeDate());
		$date->addDays(4);
		$this->assertEquals('1 day from now', $date->getRelativeDate());
		$date->addMonths(4);
		$this->assertEquals('4 months from now', $date->getRelativeDate());
		$date->minusMonths(5)->minusOneYear();
		$this->assertEquals('1 year ago', $date->getRelativeDate());
		$date->minusYears(10);
		$this->assertEquals('11 years ago', $date->getRelativeDate());
	}


	public function testGetDateString()
	{
		$date = new ExpressiveDate('31 January 1991');
		$this->assertEquals('1991-01-31', $date->getDate());
	}


	public function testGetDateTimeString()
	{
		$date = new ExpressiveDate('31 January 1991');
		$this->assertEquals('1991-01-31 00:00:00', $date->getDateTime());
	}


	public function testGetShortDateString()
	{
		$date = new ExpressiveDate('31 January 1991');
		$this->assertEquals('Jan 31, 1991', $date->getShortDate());
	}


	public function testGetLongDateString()
	{
		$date = new ExpressiveDate('31 January 1991');
		$this->assertEquals('January 31st, 1991 at 12:00am', $date->getLongDate());
	}


	public function testGetTimeString()
	{
		$date = new ExpressiveDate('31 January 1991');
		$this->assertEquals('00:00:00', $date->getTime());
	}


	public function testGetDayOfWeek()
	{
		$date = new ExpressiveDate('31 January 1991');
		$this->assertEquals('Thursday', $date->getDayOfWeek());
	}


	public function testGetDayOfWeekAsNumeric()
	{
		$date = new ExpressiveDate('31 January 1991');
		$this->assertEquals(4, $date->getDayOfWeekAsNumeric());
	}


	public function testGetDaysInMonth()
	{
		$date = new ExpressiveDate('31 January 1991');
		$this->assertEquals(31, $date->getDaysInMonth());
	}


	public function testGetDayOfYear()
	{
		$date = new ExpressiveDate('31 January 1991');
		$this->assertEquals(30, $date->getDayOfYear());
	}


	public function testGetDaySuffix()
	{
		$date = new ExpressiveDate('31 January 1991');
		$this->assertEquals('st', $date->getDaySuffix());
	}


	public function testIsLeapYear()
	{
		$date = new ExpressiveDate('31 January 1991');
		$this->assertFalse($date->isLeapYear());
	}


	public function testIsAmOrPm()
	{
		$date = new ExpressiveDate('31 January 1991');
		$this->assertEquals('AM', $date->isAmOrPm());
	}


	public function testIsDaylightSavings()
	{
		$date = new ExpressiveDate('31 January 1991');
		$this->assertTrue($date->isDaylightSavings());
	}


	public function testGetGmtDifference()
	{
		$date = new ExpressiveDate('31 January 1991');
		$this->assertEquals('+1100', $date->getGmtDifference());
	}


	public function testSecondsSinceEpoch()
	{
		$date = new ExpressiveDate('31 January 1991');
		$this->assertEquals(strtotime('31 January 1991') - strtotime('January 1 1970 00:00:00 GMT'), $date->getSecondsSinceEpoch());
	}


	public function testGetTimezoneName()
	{
		$date = new ExpressiveDate('31 January 1991');
		$this->assertEquals('Australia/Melbourne', $date->getTimezoneName());
	}


	public function testGettingInvalidDateAttributeThrowsException()
	{
		$this->setExpectedException('InvalidArgumentException');
		$date = new ExpressiveDate;
		$date->getInvalidDateAttribute();
	}


	public function testSettingInvalidDateAttributeThrowsException()
	{
		$this->setExpectedException('InvalidArgumentException');
		$date = new ExpressiveDate;
		$date->setInvalidDateAttribute('foo');
	}


}