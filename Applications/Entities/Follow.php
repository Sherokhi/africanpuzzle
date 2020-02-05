<?php

namespace Applications\Entities;

use Library\Sly\Database\Entity;

class Follow extends Entity
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
     * Date de modification
     *
     * @var String
     * @access protected
     */
    protected $mod_date;

     /**
     * Description du suivi
     *
     * @var String
     * @access protected
     */
    protected $content;

    /**
     * Défini les droits du suivi
	 *       1 Visible que par le maître de classe et par le créateur
     *       0 Visible par tous les collègues
     *
     * @var String
     * @access protected
     */
    protected $right;

  	/**
     * Id du prof
     *
     * @var String
     * @access protected
     */
    protected $colleague_id;

    /**
     * Nom du prof
     *
     * @var String
     * @access protected
     */
    protected $colleague_name;

    /**
     * Prénom du prof
     *
     * @var String
     * @access protected
     */
    protected $colleague_first_name;

    /**
     * Id du prof qui a modifié le suivi
     *
     * @var String
     * @access protected
     */
    protected $mod_colleague_id;

    /**
     * Nom du prof qui a modifié le suivi
     *
     * @var String
     * @access protected
     */
    protected $mod_colleague_name;

    /**
     * Prénom du prof qui a modifié le suivi
     *
     * @var String
     * @access protected
     */
    protected $mod_colleague_first_name;

    /**
     * Id de l'élève
     *
     * @var String
     * @access protected
     */
    protected $student_id;

    /**
     * Nom d'un élève
     *
     * @var String
     * @access protected
     */
    protected $student_name;

    /**
     * Prénom d'un élève
     *
     * @var String
     * @access protected
     */
    protected $student_first_name;

    /**
     * Classe de l'élève
     *
     * @var String
     * @access protected
     */
    protected $student_class;

    /**
     * Id du suivi
     *
     * @var String
     * @access protected
     */
    protected $follow_id;

    /**
     * Type du suivi
     *
     * @var String
     * @access protected
     */
    protected  $follow_type;


    /**
     * Nom du type de suivi
     *
     * @var String
     * @access protected
     */
    protected  $type_name;

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
     * Gets la date de modification.
     *
     * @return DateTime
     */
    public function mod_date()
    {
        return new \DateTime($this->mod_date);
    }

    /**
     * Sets la date de modification.
     *
     * @param DateTime $mod_date la date de modification
     */
    public function setMod_date($mod_date) {
        $this->mod_date = $mod_date;
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
     * Gets le nom du collègue.
     *
     * @return String
     */
    public function colleague_name()
    {
        return $this->colleague_name;
    }

    /**
     * Sets le nom du collègue.
     *
     * @param String $colleague_name le nom du collègue
     */
    public function setColleague_name($colleague_name) {
        $this->colleague_name = $colleague_name;
    }

    /**
     * Gets le prénom du collègue.
     *
     * @return String
     */
    public function colleague_first_name()
    {
        return $this->colleague_first_name;
    }

    /**
     * Sets le prénom du collègue.
     *
     * @param String $colleague_first_name le nom du collègue
     */
    public function setColleague_first_name($colleague_first_name) {
        $this->colleague_first_name = $colleague_first_name;
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
     * Gets le nom de l'élève.
     *
     * @return String
     */
    public function student_name()
    {
        return $this->student_name;
    }

    /**
     * Sets le nom de l'élève.
     *
     * @param String $student_name le nom de l'élève
     */
    public function setStudent_name($student_name) {
        $this->student_name = $student_name;
    }

    /**
     * Gets le prénom de l'élève.
     *
     * @return String
     */
    public function student_first_name()
    {
        return $this->student_first_name;
    }

    /**
     * Gets laa classe de l'élève.
     *
     * @return String
     */
    public function student_class()
    {
        return $this->student_class;
    }

    /**
     * Sets la classe de l'élève.
     *
     * @param String $student_class la classe de l'élève
     */
    public function setStudent_class($student_class) {
        $this->student_class = $student_class;
    }

    /**
     * Sets le prénom de l'élève.
     *
     * @param String $student_first_name le prénom de l'élève
     */
    public function setStudent_first_name($student_first_name) {
        $this->student_first_name = $student_first_name;
    }

    /**
     * Gets la description du suivi.
     *
     * @return String
     */
    public function content()
    {
        return $this->content;
    }

    /**
     * Sets le prénom du collègue.
     *
     * @param String $colleague_first_name le nom du collègue
     */
    public function setContent($content) {
        $this->content = $content;
    }

    /**
     * Gets l'id du collègue qui a modifié le suivi.
     *
     * @return String
     */
    public function mod_colleague_id()
    {
        return $this->mod_colleague_id;
    }

    /**
     * Sets l'id du collègue qui a modifié le suivi.
     *
     * @param String $mod_colleague_id l'id du collègue qui a modifié le suivi
     */
    public function setMod_colleague_id($mod_colleague_id) {
        $this->mod_colleague_id = $mod_colleague_id;
    }

    /**
     * Gets le nom du collègue qui a modifié le suivi.
     *
     * @return String
     */
    public function mod_colleague_name()
    {
        return $this->mod_colleague_name;
    }

    /**
     * Sets le nom du collègue qui a modifié le suivi.
     *
     * @param String $mod_colleague_name le nom du collègue qui a modifié le suivi
     */
    public function setMod_colleague_name($mod_colleague_name) {
        $this->mod_colleague_name = $mod_colleague_name;
    }

    /**
     * Gets le prénom du collègue qui a modifié le suivi.
     *
     * @return String
     */
    public function mod_colleague_first_name()
    {
        return $this->mod_colleague_first_name;
    }

    /**
     * Sets le prénom du collègue qui a modifié le suivi.
     *
     * @param String $mod_colleague_name le prénom du collègue qui a modifié le suivi
     */
    public function setMod_colleague_first_name($mod_colleague_first_name) {
        $this->mod_colleague_first_name = $mod_colleague_first_name;
    }

    /**
     * Gets le droit du suivi.
     *
     * @return Bool
     */
    public function right()
    {
        return $this->right;
    }

    /**
     * Sets le droit du suivi.
     *
     * @param Bool $right le droit du suivi
     */
    public function setRight($right) {
        $this->right = $right;
    }

    /**
     * Gets le type de suivi.
     *
     * @return String
     */
    public  function follow_type()
    {

       return $this->follow_type;
    }

    /**
     * Sets le type de suivi.
     *
     * @param Bool $follow_type le type de suivi
     */
    public function setFollow_type($follow_type)
    {

        $this->follow_type = $follow_type;
    }

    /**
     * Gets le nom du type de suivi.
     *
     * @return String
     */
    public  function  type_name()
    {
        return $this->type_name;

    }

    /**
     * Sets le nom du type de suivi.
     *
     * @param Bool $follow_type le type de suivi
     */
    public function setType_name($type_name)
    {

        $this->type_name = $type_name;
    }
}