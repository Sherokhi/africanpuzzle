<?php

namespace Applications\Entities;

use Library\Sly\Database\Entity;

class Document extends Entity
{
    protected $title;
    protected $description;
    protected $size;
    protected $add_date;
    protected $right;
    protected $student_id;
    protected $colleague_id;
    protected $types_document_id;
    protected $types_document_name;

    public function setTitle($title) {
        if (is_string($title) && !empty($title)) {
            $this->title = $title;
        }
    }

    public function setDescription($description) {
        if (is_string($description) && !empty($description)) {
            $this->description = $description;
        }
    }

    public function setSize($size) {
        $this->size = (int) $size;
    }

    public function setAdd_date($add_date) {
        $this->add_date = $add_date;
    }

    public function setRight($right) {
        $this->right = (int) $right;
    }

    public function setStudent_id($student_id) {
        if (is_string($student_id) && !empty($student_id)) {
            $this->student_id = $student_id;
        }
    }

    public function setColleague_id($colleague_id) {
        if (is_string($colleague_id) && !empty($colleague_id)) {
            $this->colleague_id = $colleague_id;
        }
    }

    public function setTypes_document_id($types_document_id) {
        $this->types_document_id = (int) $types_document_id;
    }

    public function setTypes_document_name($types_document_name) {
        if (is_string($types_document_name) && !empty($types_document_name)) {
            $this->types_document_name = $types_document_name;
        }
    }

    public function title() { return $this->title; }
    public function size() { return $this->size; }
    public function description() { return $this->description; }
    public function add_date() { return new \DateTime($this->add_date); }
    public function right() { return $this->right; }
    public function student_id() { return $this->student_id; }
    public function colleague_id() { return $this->colleague_id; }
    public function types_document_id() { return $this->types_document_id; }
    public function types_document_name() { return $this->types_document_name; }
}
