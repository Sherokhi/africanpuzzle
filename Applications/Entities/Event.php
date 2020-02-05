<?php

namespace Applications\Entities;

use Library\Sly\Database\Entity;

class Event extends Entity
{
    protected $is_annonced;
    protected $is_excused;
    protected $is_canceled;
    protected $is_processed;
    protected $is_restraint;
    protected $add_date;
    protected $student_id;
    protected $colleague_id;
    protected $types_happenings_id;

    public function setIs_annonced($bool) {
        $this->is_annonced = (bool) $bool;
    }

    public function setIs_excused($bool) {
        $this->is_excused = (bool) $bool;
    }

    public function setIs_canceled($bool) {
        $this->is_canceled = (bool) $bool;
    }

    public function setIs_processed($bool) {
        $this->is_processed = (bool) $bool;
    }

    public function setIs_restraint($bool) {
        $this->is_restraint = (bool) $bool;
    }

    public function setAdd_date($date) {
        if (is_string($date) && !empty($date)) {
            $this->add_date = $date;
        }
    }

    public function setStudent_id($id) {
        if (is_int($id) && !empty($id)) {
            $this->student_id = $id;
        }
    }

    public function setColleague_id($id) {
        if (is_int($id) && !empty($id)) {
            $this->colleague_id = $id;
        }
    }

    public function setTypes_happening_id($id) {
        if (is_int($id) && !empty($id)) {
            $this->$types_happenings_id = $id;
        }
    }

    public function is_annonced() { return $this->is_annonced; }
    public function is_excused() { return $this->is_excused; }
    public function is_canceled() { return $this->is_canceled; }
    public function is_processed() { return $this->is_processed; }
    public function is_restraint() { return $this->is_restraint; }
    public function add_date() { return $this->add_date; }
    public function student_id() { return $this->student_id; }
    public function colleague_id() { return $this->colleague_id; }
    public function types_happening_id() { return $this->types_happenning_id; }
}
