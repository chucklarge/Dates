<?php
class Dates {
    const ONE_HOUR = 3600;
    const ONE_DAY  = 86400;

    protected $start_time; // incoming timestamp
    protected $timezone;   // incoming timezone
    protected $ds;         // day start
    protected $num_day;    // num day of week 0-6
    protected $date_format;// toString() format

    public function __construct($start_time, $timezone = 'UTC', $date_format = 'Y-m-d H:i:s') {
        $success =  date_default_timezone_set($timezone);
        if (!$success) {
            throw new Exception("Can't set timezone to " . $timezone);
        }

        $this->start_time = $start_time;
        $this->timezone = $timezone;
        $this->date_format = $date_format;
        $this->ds      = date('Y-m-d', $start_time);
        $this->num_day = date('w', $start_time);
    }

    public function setDateFormat($format) {
        $this->date_format = $format;
    }

    public function __toString() {
        return date($this->date_format, $this->start_time);
    }

    public function toString() {
        return (string)$this;
    }

    public function toTimestamp() {
        return $this->start_time;
    }

    // Hour
    public function HourStart() {
        $ts = strtotime(date('Y-m-d H:00', $this->start_time));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function NextHourStart() {
        $ts = strtotime(date('Y-m-d H:00', $this->start_time)) + self::ONE_HOUR;
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function PreviousHourStart() {
        $ts = strtotime(date('Y-m-d H:00', $this->start_time)) - self::ONE_HOUR;
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    // Day
    public function DayStart() {
        $ts = strtotime($this->ds);
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function NextDayStart() {
        $ts = strtotime(date("Y-m-d", strtotime("$this->ds +1 days")));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function PreviousDayStart() {
        $ts = strtotime(date("Y-m-d", strtotime("$this->ds -1 days")));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    // Week
    public function WeekStart() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        $ts = strtotime($ws);
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function WeekEnd() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        $we = date("Y-m-d 23:59:59", strtotime("$ws +6 days"));
        $ts = strtotime($we);
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function NextWeekStart() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        $ts = strtotime(date("Y-m-d", strtotime("$ws +1 weeks")));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function NextWeekEnd() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        $we = date("Y-m-d", strtotime("$ws +6 days"));
        $ts = strtotime(date("Y-m-d 23:59:59", strtotime("$we +1 weeks")));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function PreviousWeekStart() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        $ts = strtotime(date("Y-m-d", strtotime("$ws -1 weeks")));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function PreviousWeekEnd() {
        $ws = date("Y-m-d", strtotime("$this->ds -$this->num_day days"));
        $we = date("Y-m-d", strtotime("$ws +6 days"));
        $ts = strtotime(date("Y-m-d 23:59:59", strtotime("$we -1 weeks")));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    // Month
    public function MonthStart() {
        $ts = strtotime(date("Y-m-01", strtotime($this->ds)));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function MonthEnd() {
        $ts = strtotime(date("Y-m-t 23:59:59", strtotime($this->ds)));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function NextMonthStart() {
        $ts = strtotime(date("Y-m-01", strtotime("$this->ds +1 months")));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function NextMonthEnd() {
        $ms = date("Y-m-01", strtotime("$this->ds +1 months"));
        $ts = strtotime(date("Y-m-t 23:59:59", strtotime($ms)));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function PreviousMonthStart() {
        $ts = strtotime(date("Y-m-01", strtotime("$this->ds -1 months")));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function PreviousMonthEnd() {
        $ms = date("Y-m-01", strtotime("$this->ds -1 months"));
        $ts = strtotime(date("Y-m-t 23:59:59", strtotime($ms)));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    // Year
    public function YearStart() {
        $ts = strtotime(date("Y-01-01", strtotime($this->ds)));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function YearEnd() {
        $ts = strtotime(date("Y-12-31 23:59:59", strtotime($this->ds)));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function NextYearStart() {
        $ts = strtotime(date("Y-01-01", strtotime("$this->ds +1 years")));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function NextYearEnd() {
        $ts = strtotime(date("Y-12-31 23:59:59", strtotime("$this->ds +1 years")));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function PreviousYearStart() {
        $ts = strtotime(date("Y-01-01", strtotime("$this->ds -1 years")));
        return new Dates($ts, $this->timezone, $this->date_format);
    }

    public function PreviousYearEnd() {
        $ts = strtotime(date("Y-12-31 23:59:59", strtotime("$this->ds -1 years")));
        return new Dates($ts, $this->timezone, $this->date_format);
    }
}
