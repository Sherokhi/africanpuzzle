<?php

namespace Applications\Entities;

use Library\Sly\Database\Entity;

class schoolClass extends Entity
{
    /**
     * Id de la classe
     *
     * @var string
     * @access protected
     */
    // It's public... because the json_encode method use the property itself... ACD / 10.2017
    public $id;

    protected $profession_name;
    protected $profession_id;

    protected $colleague_id;
    protected $colleague_name;
    protected $colleague_inter_phone;
    protected $colleague_phone;
    protected $colleague_mail;

    protected $student_nbre;

    /**
     * Maître de classe  de l'élève
     *
     * @var String
     * @access protected
     */
    protected $delegate_id;

    /**
     * Délégé de classe
     *
     * @var String
     * @access protected
     */
    protected $adjdelegate_id;

    public function setProfession_name($name) {
        if (is_string($name) && !empty($name)) {
            $this->profession_name = $name;
        }
    }

    public function setProfession_id($id) {
        if (is_int($id) && !empty($id)) {
            $this->profession_id = (int) $id;
        }
    }

    public function setColleague_id($id) {
        if (is_string($id) && !empty($id)) {
            $this->colleague_id = $id;
        }
    }

    public function setColleague_name($value) {
        if (is_string($value) && !empty($value)) {
            $this->colleague_name = $value;
        }
    }

    public function setColleague_inter_phone($value) {
        if (is_string($value) && !empty($value)) {
            $this->colleague_inter_phone = $value;
        }
    }

    public function setColleague_phone($value) {
        if (is_string($value) && !empty($value)) {
            $this->colleague_phone = $value;
        }
    }

    public function setColleague_mail($value) {
        if (is_string($value) && !empty($value)) {
            $this->colleague_mail = $value;
        }
    }

    public function setStudent_nbre($nbre) {
        if (is_string($nbre) && !empty($nbre)) {
            $this->student_nbre = $nbre;
        }
    }

/**
     * Gets l'id de la classe
     *
     * @return string
     */
    public function id()
    {
        return ($this->id);
    }

    public function profession_name() { return $this->profession_name; }
    public function profession_id() { return $this->profession_id; }

    public function colleague_id() { return $this->colleague_id; }
    public function colleague_name() { return $this->colleague_name; }
    public function colleague_inter_phone() { return $this->colleague_inter_phone; }
    public function colleague_phone() { return $this->colleague_phone; }
    public function colleague_mail() { return $this->colleague_mail; }

    public function student_nbre() { return $this->student_nbre; }

    /**
     * Gets the Delegate de classe.
     *
     * @return String
     */
    public function delegate_id()
    {
        return $this->delegate_id;
    }

    /**
     * Sets the Delegate de classe.
     *
     * @param String $comment the comment
     */
    public function setDelegate_id($delegate_id)
    {
        if (is_string($delegate_id) && !empty($delegate_id)) {
            $this->delegate_id = $delegate_id;
        }
    }

    /**
     * Gets the adjoint au délégué de classe.
     *
     * @return String
     */
    public function adjdelegate_id()
    {
        return $this->adjdelegate_id;
    }

    /**
     * Sets the adjoint au délégué de classe.
     *
     * @param String $comment the comment
     */
    public function setAdjdelegate_id($adjdelegate_id)
    {
        if (is_string($adjdelegate_id) && !empty($adjdelegate_id)) {
            $this->adjdelegate_id = $adjdelegate_id;
        }
    }
    /**
     * Gets the Delegate de classe.
     *
     * @return String
     */
    public function delegate_name()
    {
        return $this->delegate_name;
    }

    /**
     * Sets the Delegate de classe.
     *
     * @param String $comment the comment
     */
    public function setDelegate_name($delegate_name)
    {
        if (is_string($delegate_name) && !empty($delegate_name)) {
            $this->delegate_name = $delegate_name;
        }
    }

    /**
     * Gets the adjoint au délégué de classe.
     *
     * @return String
     */
    public function adjdelegate_name()
    {
        return $this->adjdelegate_name;
    }

    /**
     * Sets the adjoint au délégué de classe.
     *
     * @param String $comment the comment
     */
    public function setAdjdelegate_name($adjdelegate_name)
    {
        if (is_string($adjdelegate_name) && !empty($adjdelegate_name)) {
            $this->adjdelegate_id = $adjdelegate_name;
        }
    }
}
