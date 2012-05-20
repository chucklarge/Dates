<?php
class Dates {
    const ONE_HOUR = 3600;
    const ONE_DAY  = 86400;

    protected $start_time; // incoming timestamp
    protected $timezone;   // incoming timezone
    protected $ds;         // day start
    protected $num_day;    // num day of week 0-6

    public function __construct($start_time, $timezone = 'UTC') {
        $success =  date_default_timezone_set($timezone);
        if (!$success) {
            throw new Exception("Can't set timezone to " . $timezone);
        }

        $this->start_time = $start_time;
        $this->timezone = $timezone;
        $this->ds      = date('Y-m-d', $start_time);
        $this->num_day = date('w', $start_time);
    }

    //
    public function toTimestamp() {
        return $this->start_time;
    }

    // Hour
    public function HourStart() {
        $ts = strtotime(date('Y-m-d H:00', $this->start_time));
        return new Dates($ts, $this->timezone);
    }

    public function NextHourStart() {
        $ts = strtotime(date('Y-m-d H:00', $this->start_time)) + self::ONE_HOUR;
        return new Dates($ts, $this->timezone);
    }

    public function PreviousHourStart() {
        $ts = strtotime(date('Y-m-d H:00', $this->start_time)) - self::ONE_HOUR;
        return new Dates($ts, $this->timezone);
    }

    // Day
    public function DayStart() {
        $ts = strtotime($this->ds);
        return new Dates($ts, $this->timezone);
    }

    public function NextDayStart() {
        $ts = strtotime(date("Y-m-d", strtotime("$this->ds +1 days")));
        return new Dates($ts, $this->timezone);
    }

    public function PreviousDayStart() {
        $ts = strtotime(date("Y-m-d", strtotime("$this->ds -1 days")));
        return new Dates($ts, $this->timezone);
    }

    // Week
    public function WeekStart() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        $ts = strtotime($ws);
        return new Dates($ts, $this->timezone);
    }

    public function WeekEnd() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        $we = date("Y-m-d 23:59:59", strtotime("$ws +6 days"));
        $ts = strtotime($we);
        return new Dates($ts, $this->timezone);
    }

    public function NextWeekStart() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        $ts = strtotime(date("Y-m-d", strtotime("$ws +1 weeks")));
        return new Dates($ts, $this->timezone);
    }

    public function NextWeekEnd() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        $we = date("Y-m-d", strtotime("$ws +6 days"));
        $ts = strtotime(date("Y-m-d 23:59:59", strtotime("$we +1 weeks")));
        return new Dates($ts, $this->timezone);
    }

    public function PreviousWeekStart() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        $ts = strtotime(date("Y-m-d", strtotime("$ws -1 weeks")));
        return new Dates($ts, $this->timezone);
    }

    public function PreviousWeekEnd() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        $we = date("Y-m-d", strtotime("$ws +6 days"));
        $ts = strtotime(date("Y-m-d 23:59:59", strtotime("$we -1 weeks")));
        return new Dates($ts, $this->timezone);
    }

    // Month
    public function MonthStart() {
        $ts = strtotime(date("Y-m-01", strtotime($this->ds)));
        return new Dates($ts, $this->timezone);
    }

    public function MonthEnd() {
        $ts = strtotime(date("Y-m-t 23:59:59", strtotime($this->ds)));
        return new Dates($ts, $this->timezone);
    }

    public function NextMonthStart() {
        $ts = strtotime(date("Y-m-01", strtotime("$this->ds +1 months")));
        return new Dates($ts, $this->timezone);
    }

    public function NextMonthEnd() {
        $ms = date("Y-m-01", strtotime("$this->ds +1 months"));
        $ts = strtotime(date("Y-m-t 23:59:59", strtotime($ms)));
        return new Dates($ts, $this->timezone);
    }

    public function PreviousMonthStart() {
        $ts = strtotime(date("Y-m-01", strtotime("$this->ds -1 months")));
        return new Dates($ts, $this->timezone);
    }

    public function PreviousMonthEnd() {
        $ms = date("Y-m-01", strtotime("$this->ds -1 months"));
        $ts = strtotime(date("Y-m-t 23:59:59", strtotime($ms)));
        return new Dates($ts, $this->timezone);
    }

    // Year
    public function YearStart() {
        $ts = strtotime(date("Y-01-01", strtotime($this->ds)));
        return new Dates($ts, $this->timezone);
    }

    public function YearEnd() {
        $ts = strtotime(date("Y-12-31 23:59:59", strtotime($this->ds)));
        return new Dates($ts, $this->timezone);
    }

    public function NextYearStart() {
        $ts = strtotime(date("Y-01-01", strtotime("$this->ds +1 years")));
        return new Dates($ts, $this->timezone);
    }

    public function NextYearEnd() {
        $ts = strtotime(date("Y-12-31 23:59:59", strtotime("$this->ds +1 years")));
        return new Dates($ts, $this->timezone);
    }

    public function PreviousYearStart() {
        $ts = strtotime(date("Y-01-01", strtotime("$this->ds -1 years")));
        return new Dates($ts, $this->timezone);
    }

    public function PreviousYearEnd() {
        $ts = strtotime(date("Y-12-31 23:59:59", strtotime("$this->ds -1 years")));
        return new Dates($ts, $this->timezone);
    }
}
