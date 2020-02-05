<?php

namespace Applications\Entities;

use Library\Sly\Database\Entity;

class Student extends Entity
{

    /**
     * Id de l'élève
     *
     * @var String
     * @access protected
     */
    protected $id;

    /**
     * Nom de l'élève
     *
     * @var String
     * @access protected
     */
    protected $name;

    /**
     * Prénom de l'élève
     *
     * @var String
     * @access protected
     */
    protected $first_name;

    /**
     * Date de naissance de l'élève
     *
     * @var DateTime
     * @access protected
     */
    protected $birth_date;

    /**
     * Numéro postal de l'élève
     *
     * @var Int
     * @access protected
     */
    protected $zip;

    /**
     * Ville de l'élève
     *
     * @var String
     * @access protected
     */
    protected $city;

    /**
     * Adresse de l'élève
     *
     * @var String
     * @access protected
     */
    protected $address;

    /**
     * Numéro de téléphone portable de l'élève
     *
     * @var String
     * @access protected
     */
    protected $mobile;

    /**
     * Numéro de téléphone de l'élève
     *
     * @var String
     * @access protected
     */
    protected $phone;

    /**
     * Email de l'élève
     *
     * @var String
     * @access protected
     */
    protected $email;

    /**
     * Date d'entrée de l'élève
     *
     * @var Int
     * @access protected
     */
    protected $entry_date;

    /**
     * Remarque sur l'élève
     *
     * @var String
     * @access protected
     */
    protected $comment;

    /**
     * Remarque sur l'élève
     *
     * @var String
     * @access protected
     */
    protected $summary;

    /**
     * Date de sortie de l'élève
     *
     * @var Int
     * @access protected
     */
    protected $exit_date;

    /**
     * Définis si l'élève est actif :
     *       1 actif
     *       0 inactif
     *      -1 abandon/renvoi
     *
     * @var Int
     * @access protected
     */
    protected $active;

    protected $profession_id;
    protected $profession_name;
	/**
     * clé du groupe dont fait
     * partie l'élève
     *
     * @var String
     * @access protected
     */
    protected $group_id;

    /**
     * Nom du groupe dont 
     * fait partie l'élève
     *
     * @var String
     * @access protected
     */
    protected $grpName;
    
    /**
     * Nom de la classe de l'élève
     *
     * @var String
     * @access protected
     */
    protected $school_class_id;

    /**
     * Maître de classe  de l'élève
     *
     * @var String
     * @access protected
     */
    protected $colleague_id;

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

    /**
     * Adjoint de délégé de classe
     *
     * @var String
     * @access protected
     */
    protected $nbreFollowUnchecked;

    /**
     * Date de d'entrée du suivi
     *
     * @var Int
     * @access protected
     */
    protected $add_date;

    public function nbreFollowUnchecked() {

        return $this->nbreFollowUnchecked;
    }

    public function isValid() {
        return true;
    }


    /**
     * Gets the id de l'élève.
     *
     * @return String
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Gets the Nom de l'élève.
     *
     * @return String
     */
    public function name()
    {
        return $this->name;
    }
	public function group_id()
    {
        return $this->group_id;
    }

    /**
     * Sets the Nom de l'élève.
     *
     * @param String $name the name
     */
    public function setGrpName($grpName)
    {
        if (is_string($grpName) && !empty($grpName)) {
            $this->grpName = $grpName;
        }
    }

    /**
     * Sets the Nom de l'élève.
     *
     * @param String $name the name
     */
    public function setName($name)
    {
        if (is_string($name) && !empty($name)) {
            $this->name = $name;
        }
    }

    /**
     * Gets the Prénom de l'élève.
     *
     * @return String
     */
    public function first_name()
    {
        return $this->first_name;
    }

    /**
     * Sets the Prénom de l'élève.
     *
     * @param String $first_name the first_name
     */
    public function setFirst_name($first_name)
    {
        if (is_string($first_name) && !empty($first_name)) {
            $this->first_name = $first_name;
        }
    }

    /**
     * Gets the Date de naissance de l'élève.
     *
     * @return DateTime
     */
    public function birth_date()
    {
        return $this->birth_date;
    }

    /**
     * Sets the Date de naissance de l'élève.
     *
     * @param DateTime $birth_date the birth_date
     */
    public function setBirth_date($birth_date)
    {
        $this->birth_date = $birth_date;
    }

    /**
     * Gets the Numéro postal de l'élève.
     *
     * @return String
     */
    public function zip()
    {
        return $this->zip;
    }

    /**
     * Sets the Numéro postal de l'élève.
     *
     * @param Int $zip the zip
     */
    public function setZip($zip)
    {
        if (!empty($zip)) {
            $this->zip = (int) $zip;
        }
    }

    /**
     * Gets the Ville de l'élève.
     *
     * @return String
     */
    public function city()
    {
        return $this->city;
    }

    /**
     * Sets the Ville de l'élève.
     *
     * @param String $city the city
     */
    public function setCity($city)
    {
        if (is_string($city) && !empty($city)) {
            $this->city = $city;
        }
    }

    /**
     * Gets the Adresse de l'élève.
     *
     * @return String
     */
    public function address()
    {
        return $this->address;
    }

    /**
     * Sets the Adresse de l'élève.
     *
     * @param String $address the address
     */
    public function setAddress($address)
    {
        if (is_string($address) && !empty($address)) {
            $this->address = $address;
        }
    }

    /**
     * Gets the Numéro de téléphone portable de l'élève.
     *
     * @return String
     */
    public function mobile()
    {
        return $this->mobile;
    }

    /**
     * Sets the Numéro de téléphone portable de l'élève.
     *
     * @param String $mobile the mobile
     */
    public function setMobile($mobile)
    {
        if (is_string($mobile) && !empty($mobile)) {
            $this->mobile = '-';
        } else {
            $this->mobile = '-';
        }
    }

    /**
     * Gets the Numéro de téléphone de l'élève.
     *
     * @return String
     */
    public function phone()
    {
        return $this->phone;
    }

    /**
     * Sets the Numéro de téléphone de l'élève.
     *
     * @param String $phone the phone
     */
    public function setPhone($phone)
    {
        if (is_string($phone) && !empty($phone)) {
            $this->phone = $phone;
        }
    }

    /**
     * Gets the Email de l'élève.
     *
     * @return String
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * Sets the Email de l'élève.
     *
     * @param String $email the email
     */
    public function setEmail($email)
    {
        if (is_string($email) && !empty($email)) {
            $this->email = $email;
        }
    }

    /**
     * Gets the Date d'entrée de l'élève.
     *
     * @return Int
     */
    public function entry_date()
    {
        return $this->entry_date;
    }

    /**
     * Sets the Date d'entrée de l'élève.
     *
     * @param Int $entry_date the entry_date
     */
    public function setEntry_date($entry_date)
    {
        if (!empty($entry_date)) {
            $this->entry_date = (int) $entry_date;
        }
    }

    /**
     * Gets the Remarque sur l'élève.
     *
     * @return String
     */
    public function comment()
    {
        return $this->comment;
    }

    /**
     * Sets the Remarque sur l'élève.
     *
     * @param String $comment the comment
     */
    public function setComment($comment)
    {
        if (is_string($comment) && !empty($comment)) {
            $this->comment = $comment;
        }
    }

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
     * Gets le résumé de l'élève.
     *
     * @return String
     */
    public function summary()
    {
        return $this->summary;
    }

    /**
     * Sets le résumé de l'élève.
     *
     * @param String $summary le résumé
     */
    public function setSummary($summary)
    {
        if (is_string($summary) && !empty($summary)) {
            $this->summary = $summary;
        }
    }

    /**
     * Gets the Volée de l'élève.
     *
     * @return String
     */
    public function exit_date()
    {
        return $this->exit_date;
    }

    /**
     * Sets the Date d'entrée du suivi.
     *
     * @param Int $add_date the add_date
     */
    public function setAdd_date($add_date)
    {
        if (!empty($add_date)) {
            $this->add_date = (int) $add_date;
        }
    }

    /**
     * Sets the Volée de l'élève.
     *
     * @param Int $period the period
     */
    public function setExit_date($exit_date)
    {
        if (!empty($exit_date)) {
            $this->exit_date = (int) $exit_date;
        }
    }

    /**
     * Gets the Définis si l'élève est actif
     *
     * @return Int
     */
    public function active()
    {
        return $this->active;
    }

    /**
     * Sets the Définis si l'élève est actif
     *
     * @param Int $active the active
     */
    public function setActive($active)
    {
        if (is_int($active) && !empty($active)) {
            $this->active = (int) $active;
        }
    }

    public function setProfession_id($id) {
        if (!empty($id)) {
            $this->profession_id = (int) $id;
        }
    }

    public function profession_id() { return $this->profession_id; }

    public function setProfession_name($name) {
        if (is_string($name) && !empty($name)) {
            $this->profession_name = $name;
        }
    }

    public function profession_name() { return $this->profession_name; }

    /**
     * Gets the Nom de la classe de l'élève.
     *
     * @return String
     */
    public function school_class_id()
    {
        return $this->school_class_id;
    }

    /**
     * Gets the Nom du maître de classe de l'élève.
     *
     * @return String
     */
    public function colleague_id()
    {
        return $this->colleague_id;
    }

    /**
     * Sets the Nom de la classe de l'élève.
     *
     * @param String $school_class_id the school_class_id
     */
    public function setSchool_class_id($school_class_id)
    {
        if (is_string($school_class_id) && !empty($school_class_id)) {
            $this->school_class_id = $school_class_id;
        }
    }
   


}
