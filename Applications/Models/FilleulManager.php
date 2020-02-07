<?php
/********************************************************************************
 * Name:    pupilManager.php
 * Author:  Sam Pache
 * Date:    13.05.2019
 * Goal:    Structure of PupilManager_PDO.php
 **********************************************************************************/

namespace Applications\Models;

use Library\Sly\Database\Manager;

abstract class FilleulManager extends Manager
{
    abstract function getList();
    abstract function filterList($search, $birthYear, $buiState);
    abstract function getPupilData($idPupil);
    abstract function addPupil($name, $firstName, $address, $parentsNames, $birthDate, $pictureName, $building, $filiation, $training, $sponsor);
    abstract function updatePupil($id, $name, $firstName, $address, $parentsNames, $birthDate, $building, $filiation, $training, $sponsor);
    abstract function deletePupil($idPupil);
}
