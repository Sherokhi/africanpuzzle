<?php

namespace Applications\Entities;

use Library\Sly\Database\Entity;

class Historic extends Entity
{
    protected $add_date;
    protected $type;
    protected $text;
    protected $colleague_id;

    public function __contruct() {
        parrent::__construct();
        $this->add_date = date("Y-m-d H:i:s");
    }
    public function setAdd_date($add_date) {
        if (!empty($add_date))
            $this->add_date = $add_date;
    }

    public function setType($type) {
        if (is_string($type) && !empty($type)) {
            $this->type = $type;
        }
    }

    public function setText($text) {
        if (is_string($text) && !empty($text)) {
            $this->text = $text;
        }
    }

    public function setColleague_id($id) {
        $this->colleague_id = (int) $id;
    }

    public function isValid() {
        return true;
    }

    public function add_date() { return $this->add_date; }
    public function type() { return $this->type; }
    public function text() { return $this->text; }
    public function colleague_id() { return $this->colleague_id; }
}
