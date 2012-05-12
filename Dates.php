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

    public function getWeekEnd() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        $we = date("Y-m-d 23:59:59", strtotime("$ws +6 days"));
        return strtotime($we);
    }

    public function getNextWeekStart() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        return strtotime(date("Y-m-d", strtotime("$ws +1 weeks")));
    }

    public function getNextWeekEnd() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        $we = date("Y-m-d", strtotime("$ws +6 days"));
        return strtotime(date("Y-m-d 23:59:59", strtotime("$we +1 weeks")));
    }

    public function getPreviousWeekStart() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        return strtotime(date("Y-m-d", strtotime("$ws -1 weeks")));
    }

    public function getPreviousWeekEnd() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        $we = date("Y-m-d", strtotime("$ws +6 days"));
        return strtotime(date("Y-m-d 23:59:59", strtotime("$we -1 weeks")));
    }

    // Month
    public function getMonthStart() {
        return strtotime(date("Y-m-01", strtotime($this->ds)));
    }

    public function getMonthEnd() {
        return strtotime(date("Y-m-t 23:59:59", strtotime($this->ds)));
    }

    public function getNextMonthStart() {
        return strtotime(date("Y-m-01", strtotime("$this->ds +1 months")));
    }

    public function getNextMonthEnd() {
        $ms = date("Y-m-01", strtotime("$this->ds +1 months"));
        return strtotime(date("Y-m-t 23:59:59", strtotime($ms)));
    }

    public function getPreviousMonthStart() {
        return strtotime(date("Y-m-01", strtotime("$this->ds -1 months")));
    }

    public function getPreviousMonthEnd() {
        $ms = date("Y-m-01", strtotime("$this->ds -1 months"));
        return strtotime(date("Y-m-t 23:59:59", strtotime($ms)));
    }

    // Year
    public function getYearStart() {
        return strtotime(date("Y-01-01", strtotime($this->ds)));
    }

    public function getYearEnd() {
        return strtotime(date("Y-12-31 23:59:59", strtotime($this->ds)));
    }

    public function getNextYearStart() {
        return strtotime(date("Y-01-01", strtotime("$this->ds +1 years")));
    }

    public function getNextYearEnd() {
        return strtotime(date("Y-12-31 23:59:59", strtotime("$this->ds +1 years")));
    }

    public function getPreviousYearStart() {
        return strtotime(date("Y-01-01", strtotime("$this->ds -1 years")));
    }

    public function getPreviousYearEnd() {
        return strtotime(date("Y-12-31 23:59:59", strtotime("$this->ds -1 years")));
    }
}
