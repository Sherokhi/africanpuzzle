<?php

namespace Applications\Entities;

use Library\Sly\Database\Entity;

class Comment extends Entity
{
    /**
     * Id du suivi
     *
     * @var Int
     * @access protected
     */
    protected $id;

    /**
     * Date de création
     *
     * @var String
     * @access protected
     */
    protected $add_date;

     /**
     * Description du suivi
     *
     * @var String
     * @access protected
     */
    protected $comment;

  	/**
     * Id du prof
     *
     * @var String
     * @access protected
     */
    protected $colleague_id;

    /**
     * Id de l'élève
     *
     * @var String
     * @access protected
     */
    protected $student_id;

    /**
     * Gets l'id du suivi
     *
     * @return Int
     */
    public function id()
    {
        return ($this->id);
    }

    /**
     * Gets la date de création.
     *
     * @return DateTime
     */
    public function add_date()
    {
        return new \DateTime($this->add_date);
    }

    /**
     * Sets la date de création.
     *
     * @param DateTime $add_date la date de création
     */
    public function setAdd_date($add_date) {
        $this->add_date = $add_date;
    }

    /**
     * Gets l'id du collègue.
     *
     * @return String
     */
    public function colleague_id()
    {
        return $this->colleague_id;
    }

    /**
     * Sets l'id du collègue.
     *
     * @param String $colleague_id l'id du collègue
     */
    public function setColleague_id($colleague_id) {
        $this->colleague_id = $colleague_id;
    }

    /**
     * Gets l'id de l'élève.
     *
     * @return String
     */
    public function student_id()
    {
        return $this->student_id;
    }

    /**
     * Sets l'id de l'élève.
     *
     * @param String $student_id l'id de l'élève
     */
    public function setStudent_id($student_id) {
        $this->student_id = $student_id;
    }

    /**
     * Gets la description du suivi.
     *
     * @return String
     */
    public function comment()
    {
        return $this->comment;
    }

    /**
     * Sets le prénom du collègue.
     *
     * @param String $colleague_first_name le nom du collègue
     */
    public function setComment($content) {
        $this->comment = $content;
    }

}