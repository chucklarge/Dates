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
        $actual = $this->date->getHourStart();
        $expected = strtotime('2012-12-09 13:00');
        $this->assertEquals($expected, $actual);
    }

    function testPreviousHourStart() {
        $actual = $this->date->getPreviousHourStart();
        $expected = strtotime('2012-12-09 12:00');
        $this->assertEquals($expected, $actual);
    }

    function testNextHourStart() {
        $actual = $this->date->getNextHourStart();
        $expected = strtotime('2012-12-09 14:00');
        $this->assertEquals($expected, $actual);
    }

    // Day
    function testDayStart() {
        $actual = $this->date->getDayStart();
        $expected = strtotime('2012-12-09 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testPreviousDayStart() {
        $actual = $this->date->getPreviousDayStart();
        $expected = strtotime('2012-12-08 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testNextDayStart() {
        $actual = $this->date->getNextDayStart();
        $expected = strtotime('2012-12-10 00:00');
        $this->assertEquals($expected, $actual);
    }

    // Week
    function testWeekStart() {
        $actual = $this->date->getWeekStart();
        $expected = strtotime('2012-12-09 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testPreviousWeekStart() {
        $actual = $this->date->getPreviousWeekStart();
        $expected = strtotime('2012-12-02 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testNextWeekStart() {
        $actual = $this->date->getNextWeekStart();
        $expected = strtotime('2012-12-16 00:00');
        $this->assertEquals($expected, $actual);
    }

    // Month
    function testMonthStart() {
        $actual = $this->date->getMonthStart();
        $expected = strtotime('2012-12-01 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testPreviousMonthStart() {
        $actual = $this->date->getPreviousMonthStart();
        $expected = strtotime('2012-11-01 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testNextMonthStart() {
        $actual = $this->date->getNextMonthStart();
        $expected = strtotime('2013-01-01 00:00');
        $this->assertEquals($expected, $actual);
    }

    // Year
    function testYearStart() {
        $actual = $this->date->getYearStart();
        $expected = strtotime('2012-01-01 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testNextYearStart() {
        $actual = $this->date->getNextYearStart();
        $expected = strtotime('2013-01-01 00:00');
        $this->assertEquals($expected, $actual);
    }

    function testPreviousYearStart() {
        $actual = $this->date->getPreviousYearStart();
        $expected = strtotime('2011-01-01 00:00');
        $this->assertEquals($expected, $actual);
    }

    // Timezone
    function testTimezoneUTC() {
        $ts = strtotime('2012-05-09 13:00');
        $date = new Dates($ts, 'UTC');
        $timezone = new DateTimeZone('UTC');
        $dateTime = new DateTime(date('Y-m-d\TH:i:s', $date->getDayStart()), $timezone);
        $actual = abs($timezone->getOffset($dateTime)) / Dates::ONE_HOUR;

        $expected = 0;
        $this->assertEquals($expected, $actual);
    }

    function testTimezoneEST() {
        $ts = strtotime('2012-05-09 13:00');
        $date = new Dates($ts, 'America/New_York');
        $timezone = new DateTimeZone('America/New_York');
        $dateTime = new DateTime(date('Y-m-d\TH:i:s', $date->getDayStart()), $timezone);
        $actual = abs($timezone->getOffset($dateTime)) / Dates::ONE_HOUR;

        $expected = 4;
        $this->assertEquals($expected, $actual);
    }

    function testTimezoneDayLightSavingsUTC() {
        $ts = strtotime('2012-12-09 13:00');
        $date = new Dates($ts, 'UTC');
        $timezone = new DateTimeZone('UTC');
        $dateTime = new DateTime(date('Y-m-d\TH:i:s', $date->getDayStart()), $timezone);
        $actual = abs($timezone->getOffset($dateTime)) / Dates::ONE_HOUR;

        $expected = 0;
        $this->assertEquals($expected, $actual);
    }

    function testTimezoneDayLightSavingsEST() {
        $ts = strtotime('2012-12-09 13:00');
        $date = new Dates($ts, 'America/New_York');
        $timezone = new DateTimeZone('America/New_York');
        $dateTime = new DateTime(date('Y-m-d\TH:i:s', $date->getDayStart()), $timezone);
        $actual = abs($timezone->getOffset($dateTime)) / Dates::ONE_HOUR;

        $expected = 5;
        $this->assertEquals($expected, $actual);
    }

    // Leap Year
    function testDayStartLeapYear() {
        $ts  = strtotime('2012-02-29 13:33');
        $est = new Dates($ts, 'America/New_York');
        $actual = $est->getDayStart();
        $expected = strtotime('2012-02-29 00:00');
        $this->assertEquals($actual , $expected);
    }

    function testPreviousDayStartLeapYear() {
        $ts  = strtotime('2012-02-29 13:33');
        $est = new Dates($ts, 'America/New_York');
        $actual = $est->getPreviousDayStart();
        $expected = strtotime('2012-02-28 00:00');
        $this->assertEquals($actual , $expected);
    }

    function testNextDayStartLeapYear() {
        $ts  = strtotime('2012-02-29 13:33');
        $est = new Dates($ts, 'America/New_York');
        $actual = $est->getNextDayStart();
        $expected = strtotime('2012-03-01 00:00');
        $this->assertEquals($actual , $expected);
    }
}
