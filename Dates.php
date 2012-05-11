<?php
class Dates {
    const ONE_HOUR = 3600;
    const ONE_DAY  = 86400;

    protected $start_time; // incoming timestamp
    protected $ds;         // day start
    protected $num_day;    // num day of week 0-6

    public function __construct($start_time, $timezone = 'UTC') {
        $success =  date_default_timezone_set($timezone);
        if (!$success) {
            throw new Exception("Can't set timezone to " . $timezone);
            die();
        }

        $this->start_time = $start_time;
        $this->ds      = date('Y-m-d', $start_time);
        $this->num_day = date('w', $start_time);
    }

    // Hour
    public function getHourStart() {
        return strtotime(date('Y-m-d H:00', $this->start_time));
    }

    public function getNextHourStart() {
        return strtotime(date('Y-m-d H:00', $this->start_time)) + self::ONE_HOUR;
    }

    public function getPreviousHourStart() {
        return strtotime(date('Y-m-d H:00', $this->start_time)) - self::ONE_HOUR;
    }

    // Day
    public function getDayStart() {
        return  strtotime($this->ds);
    }

    public function getNextDayStart() {
        return strtotime(date("Y-m-d", strtotime("$this->ds +1 days")));
    }

    public function getPreviousDayStart() {
        return strtotime(date("Y-m-d", strtotime("$this->ds -1 days")));
    }

    // Week
    public function getWeekStart() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        return strtotime($ws);
    }

    public function getNextWeekStart() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        return strtotime(date("Y-m-d", strtotime("$ws +1 weeks")));
    }

    public function getPreviousWeekStart() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        return strtotime(date("Y-m-d", strtotime("$ws -1 weeks")));
    }

    // Month
    public function getMonthStart() {
        return strtotime(date("Y-m-01", strtotime("$this->ds")));
    }

    public function getNextMonthStart() {
        return strtotime(date("Y-m-", strtotime("$this->ds +1 months")) . '01');
    }

    public function getPreviousMonthStart() {
        return strtotime(date("Y-m-", strtotime("$this->ds -1 months")) . '01');
    }

    // Year
    public function getYearStart() {
        return strtotime(date("Y", strtotime($this->ds)) . '-01-01');
    }

    public function getNextYearStart() {
        return strtotime(date("Y", strtotime("$this->ds +1 years")) . '-01-01');
    }

    public function getPreviousYearStart() {
        return strtotime(date("Y", strtotime("$this->ds -1 years")) . '-01-01');
    }
}
