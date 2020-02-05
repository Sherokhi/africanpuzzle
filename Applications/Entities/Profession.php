<?php

namespace Applications\Entities;

use Library\Sly\Database\Entity;

class Profession extends Entity
{


    protected $name;
    protected $filter;
    protected $first_name;
    protected $profession_id;
    protected $doyenNom;
    protected $doyenMail;
    protected $idDoyen;
    protected $headTeacher;
    protected $inter_phone;
    protected $phone;
    protected $email;
    protected $student_nbre;
    protected $class_nbre;

    public function setName($name) {
        if (is_string($name) && !empty($name)) {
            $this->name = $name;
        }
    }

    public function setFilter($bit) {
        if (!empty($bit)) {
            $this->filter = $bit;
        }
    }

    public function setFirst_name($name) {
        if (is_string($name) && !empty($name)) {
            $this->first_name = $name;
        }
    }

    public function setDoyenNom($name) {
        if (is_string($name) && !empty($name)) {
            $this->doyenNom = $name;
        }
    }

    public function setIdDoyen($name) {
        if (is_string($name) && !empty($name)) {
            $this->idDoyen = $name;
        }
    }

    public function setHeadTeacher($name) {
        if (is_string($name) && !empty($name)) {
            $this->headTeacher = $name;
        }
    }

    public function setInter_phone($inter_phone) {
        if (is_string($inter_phone) && !empty($inter_phone)) {
            $this->inter_phone = $inter_phone;
        }
    }

    public function setPhone($phone) {
        if (is_string($phone) && !empty($phone)) {
            $this->phone = $phone;
        }
    }

    public function setEmail($email) {
        if (is_string($email) && !empty($email)) {
            $this->email = $email;
        }
    }

    public function setProfession_id($id) {
        if (is_int($id) && !empty($id)) {
            $this->profession_id = (int) $id;
        }
    }



    public function setStudent_nbre($nbre) {
        if (is_string($nbre) && !empty($nbre)) {
            $this->student_nbre = $nbre;
        }
    }

    public function setClass_nbre($nbre) {
        if (is_string($nbre) && !empty($nbre)) {
            $this->class_nbre = $nbre;
        }
    }

    public function name() { return $this->name; }
    public function first_name() { return $this->first_name; }
    public function doyenNom() { return $this->doyenNom; }
    public function doyenMail() { return $this->doyenMail; }
    public function inter_phone() { return $this->inter_phone; }
    public function phone() { return $this->phone; }
    public function email() { return $this->email; }
    public function idDoyen() { return $this->idDoyen; }
    public function headTeacher() { return $this->headTeacher; }
    public function profession_id() { return $this->profession_id; }
    public function filter() { return $this->filter; }
    public function student_nbre() { return $this->student_nbre; }
    public function class_nbre() { return $this->class_nbre; }

}
