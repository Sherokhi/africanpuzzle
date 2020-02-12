<?php
/********************************************************************************
 * Name:    PupilManager_PDO.php
 * Author:  Sam Pache
 * Date:    13.05.2019
 * Goal:    Model : Queries from the database to the app that concern pupils
 **********************************************************************************/

namespace Applications\Models;

//use Applications\Entities\Filleul;

class BuildingManager_PDO extends FilleulManager
{
    // Return all the pupils
    public function getList() 
    {        
        // Query that returns all the pupils
        $queryPupils ='SELECT * FROM t_building';

        $req = $this->dao->query($queryPupils);

        $buildingsArray = $req->fetchAll();
        $req->closeCursor();

        return $buildingsArray;
    }

    function filterList($search, $birthYear, $buiState)
    {
        // TODO: Implement filterList() method.
    }

    function getPupilData($idPupil)
    {
        // TODO: Implement getPupilData() method.
    }

    function addPupil($name, $firstName, $address, $parentsNames, $birthDate, $pictureName, $building, $filiation, $training, $sponsor)
    {
        // TODO: Implement addPupil() method.
    }

    function updatePupil($id, $name, $firstName, $address, $parentsNames, $birthDate, $pictureName, $building, $filiation, $training, $sponsor)
    {
        // TODO: Implement updatePupil() method.
    }

    function deletePupil($idPupil)
    {
        // TODO: Implement deletePupil() method.
    }
}
