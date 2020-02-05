<?php

namespace Applications\Entities;

use Library\Sly\Database\Entity;

class User extends Entity
{
    protected $idUser;
    protected $idTitle;
    protected $fkTitle;
    protected $useTitle;
    protected $useName;
    protected $useFirstName;
    protected $useAddress;
    protected $usePstcode;
    protected $useLocality;
    protected $useEmail;
    protected $usePhone;
    protected $useMobilePhone;
    protected $useIsMember;
    protected $useActif;
    protected $useGroup;
    protected $useGroupName;
    protected $logName;
    protected $logPassword;
    protected $usePicture;
    protected $is_godParent;
    protected $is_donateur;
    protected $is_comite;
    protected $fkGroup;

    public function setIdUser($idUser) {
        if ( !empty($idUser)) {
            $this->idUser = (int)$idUser;
        }
    }

    public function setIdTitle($idTitle) {
        if ( !empty($idTitle)) {
            $this->idTitle = (int)$idTitle;
        }
    }

    public function setFkTitle($fkTitle) {
        if ( !empty($fkTitle)) {
            $this->fkTitle = (int)$fkTitle;
        }
    }
    public function setUseTitle($useTitle){
        if (is_string($useTitle) && !empty($useTitle)) {
            $this->useTitle = $useTitle;
        }
    }

    public function setUseName($useName) {
        if (is_string($useName) && !empty($useName)) {
            $this->useName = $useName;
        }
    }

    public function setUseFirstName($useFirstName) {
        if (is_string($useFirstName) && !empty($useFirstName)) {
            $this->useFirstName = $useFirstName;
        }
    }

    public function setUseAddress($useAddress) {
        if (is_string($useAddress) && !empty($useAddress)) {
            $this->useAddress = $useAddress;
        }
    }

    public function setUsePstcode($usePstCode) {
        if (is_string($usePstCode) && !empty($usePstCode)) {
            $this->usePstcode = $usePstCode;
        }
    }

    public function setUseLocality($useLocality) {
        if (is_string($useLocality) && !empty($useLocality)) {
            $this->useLocality = $useLocality;
        }
    }

    public function setUseEmail($useEmail) {
        if (is_string($useEmail) && !empty($useEmail)) {
            $this->useEmail = $useEmail;
        }
    }

    public function setUsePhone($usePhone) {
        if (is_string($usePhone) && !empty($usePhone)) {
            $this->usePhone = $usePhone;
        }
    }

    public function setUseMobilePhone($useMobilePhone) {
        if (is_string($useMobilePhone) && !empty($useMobilePhone)) {
            $this->useMobilePhone = $useMobilePhone;
        }
    }

    public function setUseIsMember($useIsMember) {
        if (is_string($useIsMember) && !empty($useIsMember)) {
            $this->useIsMember = $useIsMember;
        }
    }

    public function setUseActif($useActif) {
        if (is_string($useActif) && !empty($useActif)) {
            $this->useActif = $useActif;
        }
    }

    public function setUseGroupName($useGroupName) {
        if (is_string($useGroupName) && !empty($useGroupName)) {
            $this->useGroupName = $useGroupName;
        }
    }

    public function setUseGroup($useGroup) {
        if (is_string($useGroup) && !empty($useGroup)) {
            $this->useGroup = $useGroup;
        }
    }

    public function setLogName($logName) {
        if (is_string($logName) && !empty($logName)) {
            $this->logName = $logName;
        }
    }

    public function setLogPassword($logPassword) {
        if (is_string($logPassword) && !empty($logPassword)) {
            $this->logPassword = $logPassword;
        }
    }
    public function setUsePicture($usePicture) {
        if (is_string($usePicture) && !empty($usePicture)) {
            $this->usePicture = $usePicture;
        }
    }

    public function setIs_godParent($is_godParent) {
        if (is_string($is_godParent) && !empty($is_godParent)) {
            $this->is_godParent = $is_godParent;
        }
    }

    public function setIs_donateur($is_donateur) {
        if (is_string($is_donateur) && !empty($is_donateur)) {
            $this->is_donateur = $is_donateur;
        }
    }

    public function setIs_comite($is_comite) {
        if (is_string($is_comite) && !empty($is_comite)) {
            $this->is_comite = $is_comite;
        }
    }

    public function setFkGroup($fkGroup) {
        if ( !empty($fkGroup)) {
            $this->fkGroup = (int)$fkGroup;
        }
    }

    public function idUser() { return $this->idUser; }
    public function idTitle() { return $this->idTitle; }
    public function fkTitle() { return $this->fkTitle; }
    public function useTitle() { return $this->useTitle; }
    public function useName() { return $this->useName; }
    public function useFirstName() { return $this->useFirstName; }
    public function useAddress() { return $this->useAddress; }
    public function usePstcode() { return $this->usePstcode; }
    public function useLocality() { return $this->useLocality; }
    public function useEmail() { return $this->useEmail; }
    public function usePhone() { return $this->usePhone; }
    public function useMobilePhone() { return $this->useMobilePhone; }
    public function useIsMember() { return $this->useIsMember; }
    public function useActif() { return $this->useActif; }
    public function useGroup() { return $this->useGroup; }
    public function useGroupName() { return $this->useGroupName; }
    public function logName() { return $this->logName; }
    public function logPassword() { return $this->logPassword; }
    public function usePicture() { return $this->usePicture; }
    public function is_godParent() { return $this->is_godParent; }
    public function is_donateur() { return $this->is_donateur; }
    public function is_comite() { return $this->is_comite; }
    public function fkGroup() { return $this->fkGroup; }



    public function toJson() {
        return '{"idUser": ' . $this->idUser() . ',' .
            '"idTitle": "' . $this->idUser() .  '",' .
            '"useTitle": "' . $this->useTitle() . '",' .
            '"useName": "' . $this->useName() . '",' .
            '"useFirstName": "' . $this->useFirstName() . '",' .
            '"useAddress": "' . $this->useAddress() . '",' .
            '"usePstcode": "' . $this->usePstcode() . '",' .
            '"useLocality": "' . $this->useLocality() . '",' .
            '"useEmail": "' . $this->useEmail() . '",' .
            '"usePhone": "' . $this->usePhone() . '",' .
            '"useMobilePhone": "' . $this->useMobilePhone() . '",' .
            '"useIsMember": "' . $this->useIsMember() . '",' .
            '"useActif": "' . $this->useActif() . '",' .
            '"useGroup": "' . $this->useGroup() . '",' .
            '"useGroupName": "' . $this->useGroupName() . '",' .
            '"logName": "' . $this->logName() . '",' .
            '"logPassword": "' . $this->logPassword() . '",' .
            '"usePicture": "' . $this->usePicture() . '",' .
            '"is_godParent": "' . $this->is_godParent() . '",' .
            '"is_donateur": "' . $this->is_donateur() . '",' .
            '"is_comite": "' . $this->is_comite() . '"'
            ."}";
//         $idUser
//         $useTitle
//         $useName
//         $useFirstName
//         $useAddress
//         $useEmail
//         $usePhone
//         $useMobilePhone
//         $useMembership
    }

}
