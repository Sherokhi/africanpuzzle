<?php

namespace Applications\Entities;

use Library\Sly\Database\Entity;

class Group extends Entity
{
    /**
     * Id du groupe
     *
     * @var Int
     * @access protected
     */
    protected $id;
 
	/**
     * Nom du groupe
     *
     * @var String
     * @access protected
     */
    protected $name;

     /**
     * Description du groupe
     *
     * @var String
     * @access protected
     */
    protected $content;

	/**
     * Si le proupe est visible par les autres profs
     *
     * @var Bool
     * @access protected
     */
    protected $isPublic;
	
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
     * Pr�nom du prof
     *
     * @var String
     * @access protected
     */
    protected $colleague_first_name;

    /**
     * Classe du collegue
     *
     * @var String
     * @access protected
     */
    protected $profession;


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
     * Gets si public
     *
     * @return Bool
     */
    public function isPublic()
    {
        return $this->isPublic;
    }

    /**
     * Sets si public
     *
     * @param Bool si publique on non
     */
    public function setIsPublic($isPublic) {
        $this->isPublic = $isPublic;
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
     * Gets le pr�nom du collègue.
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
     * Gets laa classe de l'élève.
     *
     * @return String
     */
    public function profession()
    {
        return $this->profession;
    }

    /**
     * Sets la classe de l'élève.
     *
     * @param String $student_class la classe de l'élève
     */
    public function setProfession($profession) {
        $this->profession = $profession;
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
     * Gets la description du suivi.
     *
     * @return String
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Sets le prénom du collègue.
     *
     * @param String $colleague_first_name le nom du collègue
     */
    public function setName($name) {
        $this->name = $name;
    }
}