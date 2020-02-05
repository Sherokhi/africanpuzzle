<?php

namespace Applications\Entities;

use Library\Sly\Database\Entity;

class Calendar extends Entity
{
    protected $day;
    protected $number;
    protected $branch;
    protected $room;
    protected $colleague_id;

    public function setDay($day) {
        $this->day = (int) $day;
    }

    public function setNumber($nb) {
        $this->number = (int) $nb;
    }

    public function setBranch($branch) {
        if (is_string($branch) && !empty($branch)) {
            $this->branch = $branch;
        }
    }

    public function setRoom($room) {
        if (is_string($room) && !empty($room)) {
            $this->room = $room;
        }
    }

    public function setColleague_id($id) {
        $this->colleague_id = $id;
    }

    public function day() { return $this->day; }
    public function number() { return $this->number; }
    public function branch() { return $this->branch; }
    public function room() { return $this->room; }
    public function colleague_id() { return $this->colleague_id; }
}
