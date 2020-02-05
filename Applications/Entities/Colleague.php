<?php

namespace Applications\Entities;

use Library\Sly\Database\Entity;

class Colleague extends Entity
{
    protected $name;
    protected $first_name;
    protected $inter_phone;
    protected $phone;
    protected $email;
    protected $colleague_id;
    protected $profession_name;
    protected $profession_id;
	protected $room_id;
	protected $birth_date;
	protected $Actif;

    public function setProfession_name($name) {
        if (is_string($name) && !empty($name)) {
            $this->profession_name = $name;
        }
    }
	
	public function setProfessionId($id) {
        if (is_string($id) && !empty($id)) {
            $this->$profession_id = $id;
        }
    }
	
    public function setName($name) {
        if (is_string($name) && !empty($name)) {
            $this->name = $name;
        }
    }

    public function setFirst_name($first_name) {
        if (is_string($first_name) && !empty($first_name)) {
            $this->first_name = $first_name;
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
    
    public function setColleague_id($id) {
        if (is_string($id) && !empty($id)) {
            $this->colleague_id = $id;
        }
    }
	
	public function setRoom_id($roomId) {
        if (is_string($roomId) && !empty($roomId)) {
            $this->room_id = $id;
        }
    }
	
	public function setBirthday($birth) {
        if (is_string($birth) && !empty($birth)) {
            $this->birth_date = $birth;
        }
    }
	
	public function setActif($act) {
        if (is_string($act) && !empty($act)) {
            $this->Actif = $act;
        }
    }

	
    public function name() { return $this->name; }
    public function first_name() { return $this->first_name; }
    public function inter_phone() { return $this->inter_phone; }
    public function phone() { return $this->phone; }
    public function email() { return $this->email; }
    public function profession_name() { return $this->profession_name; }
    public function colleague_id() { return $this->colleague_id; }
    public function room_id() { return $this->room_id; }
    public function birth_date() { return $this->birth_date; }
    public function profession_id() { return $this->profession_id; }
    public function Actif() { return $this->Actif; }
}
