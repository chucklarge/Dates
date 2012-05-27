<?php
require_once './Dates.php';

/**
 * Test suite for the Dates class.
 */
class DatesTest extends PHPUnit_Framework_TestCase {

    protected $date; // date object

    protected function setUp() {
        $ts  = strtotime('2012-12-09 13:33');
        $this->date = new Dates($ts, 'America/New_York');
    }

    // Hour
    function testHourStart() {
        $actual = $this->date->HourStart()->toTimestamp();
        $expected = strtotime('2012-12-09 13:00');
        $this->assertEquals($expected, $actual);
    }

    function testNextHourStart() {
        $actual = $this->date->NextHourStart()->toTimestamp();
        $expected = strtotime('2012-12-09 14:00');
        $this->assertEquals($expected, $actual);
    }

    function testPreviousHourStart() {
        $actual = $this->date->PreviousHourStart()->toTimestamp();
        $expected = strtotime('2012-12-09 12:00');
        $this->assertEquals($expected, $actual);
    }

    // Day
    function testDayStart() {
        $actual = $this->date->DayStart()->toTimestamp();
        $expected = strtotime('2012-12-09 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testNextDayStart() {
        $actual = $this->date->NextDayStart()->toTimestamp();
        $expected = strtotime('2012-12-10 00:00');
        $this->assertEquals($expected, $actual);
    }


    function testPreviousDayStart() {
        $actual = $this->date->PreviousDayStart()->toTimestamp();
        $expected = strtotime('2012-12-08 00:00');
        $this->assertEquals($expected, $actual);
    }

    // Week
    function testWeekStart() {
        $actual = $this->date->WeekStart()->toTimestamp();
        $expected = strtotime('2012-12-09 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testWeekEnd() {
        $actual = $this->date->WeekEnd()->toTimestamp();
        $expected = strtotime('2012-12-15 23:59:59');
        $this->assertEquals($expected, $actual);
    }

    function testNextWeekStart() {
        $actual = $this->date->NextWeekStart()->toTimestamp();
        $expected = strtotime('2012-12-16 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testNextWeekEnd() {
        $actual = $this->date->NextWeekEnd()->toTimestamp();
        $expected = strtotime('2012-12-22 23:59:59');
        $this->assertEquals($expected, $actual);
    }

    function testPreviousWeekStart() {
        $actual = $this->date->PreviousWeekStart()->toTimestamp();
        $expected = strtotime('2012-12-02 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testPreviousWeekEnd() {
        $actual = $this->date->PreviousWeekEnd()->toTimestamp();
        $expected = strtotime('2012-12-08 23:59:59');
        $this->assertEquals($expected, $actual);
    }

    // Month
    function testMonthStart() {
        $actual = $this->date->MonthStart()->toTimestamp();
        $expected = strtotime('2012-12-01 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testMonthEnd() {
        $actual = $this->date->MonthEnd()->toTimestamp();
        $expected = strtotime('2012-12-31 23:59:59');
        $this->assertEquals($expected, $actual);
    }

    function testNextMonthStart() {
        $actual = $this->date->NextMonthStart()->toTimestamp();
        $expected = strtotime('2013-01-01 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testNextMonthEnd() {
        $actual = $this->date->NextMonthEnd()->toTimestamp();
        $expected = strtotime('2013-01-31 23:59:59');
        $this->assertEquals($expected, $actual);
    }

    function testPreviousMonthStart() {
        $actual = $this->date->PreviousMonthStart()->toTimestamp();
        $expected = strtotime('2012-11-01 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testPreviousMonthEnd() {
        $actual = $this->date->PreviousMonthEnd()->toTimestamp();
        $expected = strtotime('2012-11-30 23:59:59');
        $this->assertEquals($expected, $actual);
    }

    // Year
    function testYearStart() {
        $actual = $this->date->YearStart()->toTimestamp();
        $expected = strtotime('2012-01-01 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testYearEnd() {
        $actual = $this->date->YearEnd()->toTimestamp();
        $expected = strtotime('2012-12-31 23:59:59');
        $this->assertEquals($expected, $actual);
    }

    function testNextYearStart() {
        $actual = $this->date->NextYearStart()->toTimestamp();
        $expected = strtotime('2013-01-01 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testNextYearEnd() {
        $actual = $this->date->NextYearEnd()->toTimestamp();
        $expected = strtotime('2013-12-31 23:59:59');
        $this->assertEquals($expected, $actual);
    }

    function testPreviousYearStart() {
        $actual = $this->date->PreviousYearStart()->toTimestamp();
        $expected = strtotime('2011-01-01 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testPreviousYearEnd() {
        $actual = $this->date->PreviousYearEnd()->toTimestamp();
        $expected = strtotime('2011-12-31 23:59:59');
        $this->assertEquals($expected, $actual);
    }

    // Timezone
    function testTimezoneUTC() {
        $ts = strtotime('2012-05-09 13:00');
        $date = new Dates($ts, 'UTC');
        $timezone = new DateTimeZone('UTC');
        $dateTime = new DateTime(date('Y-m-d\TH:i:s', $date->DayStart()->toTimestamp()), $timezone);
        $actual = abs($timezone->getOffset($dateTime)) / Dates::ONE_HOUR;

        $expected = 0;
        $this->assertEquals($expected, $actual);
    }

    function testTimezoneEST() {
        $ts = strtotime('2012-05-09 13:00');
        $date = new Dates($ts, 'America/New_York');
        $timezone = new DateTimeZone('America/New_York');
        $dateTime = new DateTime(date('Y-m-d\TH:i:s', $date->DayStart()->toTimestamp()), $timezone);
        $actual = abs($timezone->getOffset($dateTime)) / Dates::ONE_HOUR;

        $expected = 4;
        $this->assertEquals($expected, $actual);
    }

    function testTimezoneDayLightSavingsUTC() {
        $ts = strtotime('2012-12-09 13:00');
        $date = new Dates($ts, 'UTC');
        $timezone = new DateTimeZone('UTC');
        $dateTime = new DateTime(date('Y-m-d\TH:i:s', $date->DayStart()->toTimestamp()), $timezone);
        $actual = abs($timezone->getOffset($dateTime)) / Dates::ONE_HOUR;

        $expected = 0;
        $this->assertEquals($expected, $actual);
    }

    function testTimezoneDayLightSavingsEST() {
        $ts = strtotime('2012-12-09 13:00');
        $date = new Dates($ts, 'America/New_York');
        $timezone = new DateTimeZone('America/New_York');
        $dateTime = new DateTime(date('Y-m-d\TH:i:s', $date->DayStart()->toTimestamp()), $timezone);
        $actual = abs($timezone->getOffset($dateTime)) / Dates::ONE_HOUR;

        $expected = 5;
        $this->assertEquals($expected, $actual);
    }

    // Leap Year
    function testDayStartLeapYear() {
        $ts  = strtotime('2012-02-29 13:33');
        $est = new Dates($ts, 'America/New_York');
        $actual = $est->DayStart()->toTimestamp();
        $expected = strtotime('2012-02-29 00:00');
        $this->assertEquals($actual , $expected);
    }

    function testPreviousDayStartLeapYear() {
        $ts  = strtotime('2012-02-29 13:33');
        $est = new Dates($ts, 'America/New_York');
        $actual = $est->PreviousDayStart()->toTimestamp();
        $expected = strtotime('2012-02-28 00:00');
        $this->assertEquals($actual , $expected);
    }

    function testNextDayStartLeapYear() {
        $ts  = strtotime('2012-02-29 13:33');
        $est = new Dates($ts, 'America/New_York');
        $actual = $est->NextDayStart()->toTimestamp();
        $expected = strtotime('2012-03-01 00:00');
        $this->assertEquals($actual , $expected);
    }

    // Chaining
    function testChainingHour() {
        $actual = $this->date->PreviousHourStart()->PreviousHourStart()->PreviousHourStart()->toTimestamp();
        $expected = strtotime('2012-12-09 10:00');
        $this->assertEquals($expected, $actual);
    }

    function testChainingDay() {
        $actual = $this->date->PreviousDayStart()->PreviousDayStart()->toTimestamp();
        $expected = strtotime('2012-12-07 00:00');
        $this->assertEquals($expected, $actual);
    }

    // Date Format
    function testDateFormat() {
        $actual = (string)$this->date->PreviousMonthStart();
        $expected  = '2012-11-01 00:00:00';
        $this->assertEquals($expected, $actual);
    }

    function testSetDateFormat() {
        $this->date->setDateFormat('Y-m-d');
        $actual = (string)$this->date->PreviousMonthStart();
        $expected  = '2012-11-01';
        $this->assertEquals($expected, $actual);
    }

    function testToString() {
        $actual = $this->date->PreviousMonthStart()->NextWeekStart()->toString();
        $expected  = '2012-11-04 00:00:00';
        $this->assertEquals($expected, $actual);
    }
}
