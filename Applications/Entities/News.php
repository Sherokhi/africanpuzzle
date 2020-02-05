<?php
//*********************************************************
// Societe: ETML
// Auteur : Alexis Gonzalez
// Date : 26.05.2014
// But : Fichier Entities du module news
//*********************************************************
// Modifications:
// Date : 
// Auteur : 
// Raison : 
//*********************************************************
// Date :
// Auteur :
// Raison :
//*********************************************************

namespace Applications\Entities;

use Library\Sly\Database\Entity;

class News extends Entity
{
    // Initialise toutes les variables en protected
    protected $add_date;
    protected $student_id;
    protected $colleague_id;
    protected $types_happenings_id;
    protected $title;
    protected $content;
    protected $start_date;
    protected $mod_date;
    protected $end_date;
    protected $right;
    protected $rights;
    protected $colleague;
    protected $classe;
    protected $idx_schoolClasse;
    protected $idx_colleague;
    protected $SearchContent;

    //Déclaration de la variable idx_schoolClasse
    public function setIdx_schoolClasse($string) {
        $this->idx_schoolClasse = (string) $string;
    } 
    //Déclaration de la variable idx_schoolClasse
    public function setSearchContent($string) {
        $this->SearchContent = (string) $string;
    }

    

    //Déclaration de la variable idx_colleague
    public function setIdx_colleague($string) {
        $this->idx_colleague = (string) $string;
    }

    //Déclaration de la variable colleague
    public function setColleague($string) {
        $this->colleague = (string) $string;
    }

    //Déclaration de la variable classe
    public function setClasse($string) {
        $this->classe = (string) $string;
    }

    //Déclaration de la variable Title
    public function setTitle($string) {
        $this->title = (string) $string;
    }

    //Déclaration de la variable Content
    public function setContent($string) {
        $this->content = (string) $string;
    }

    //Déclaration de la variable du début d'affichage
    public function setStart_date($string) {
    $this->start_date = (string) $string;
    }

    //Déclaration de la variable de modification
    public function setMod_date($string) {
    $this->mod_date = (string) $string;
    }

    //Déclaration de la variable de la fin de l'affichage
    public function setEnd_date($string) {
    $this->end_date = (string) $string;
    }

    // La deuxième variable "rights" est là car il y avait des conflit avec la "right" car le nom "right" et déjà utilisé dans le framework pour autre chose

    //Déclaration de la variable droit de la news
    public function setRight($string) {
    $this->right = (string) $string;
    }   

    //Déclaration de la variable droit de la news
    public function setRights($int) {
    $this->rights = (int) $int;
    }   
    
    //Déclaration de la variable d'ajout de la news
    public function setAdd_date($date) {
        if (is_string($date) && !empty($date)) {
            $this->add_date = $date;
        }
    }

    // Déclaration de la variable contenant l'id de l'etudiant
    public function setStudent_id($id) {
        if (is_int($id) && !empty($id)) {
            $this->student_id = $id;
        }
    }
    
    // Déclaration de la variable contenant l'id du colleague
    public function setColleague_id($id) {
        if (is_int($id) && !empty($id)) {
            $this->colleague_id = $id;
        }
    }

    //Retourne toute les variables déclarées plus haut    
    public function title() { return $this->title; }
    public function idx_colleague() { return $this->idx_colleague; }
    public function classe() { return $this->classe; }
    public function content() { return $this->content; }
    public function start_date() { return $this->start_date; }
    public function mod_date() { return $this->mod_date; }
    public function end_date() { return $this->end_date; }
    public function right() { return $this->right; }
    public function rights() { return $this->rights; }
    public function colleague() { return $this->colleague; }
    public function idx_schoolClasse() { return $this->idx_schoolClasse; }    
    public function add_date() { return $this->add_date; }
    public function student_id() { return $this->student_id; }
    public function colleague_id() { return $this->colleague_id; }
    public function SearchContent() { return $this->SearchContent; }
    
    
}
