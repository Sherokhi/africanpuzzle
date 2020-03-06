<?php
/********************************************************************************
 * Name:    PupilManager_PDO.php
 * Author:  Sam Pache
 * Date:    13.05.2019
 * Goal:    Model : Queries from the database to the app that concern pupils
 **********************************************************************************/

namespace Applications\Models;


class FilleulManager_PDO extends FilleulManager
{
    // Return all the pupils
    public function getList()
    {
        // Query that returns all the pupils
        $queryPupils = 'SELECT t_child.idChild, t_child.chiName, t_child.chiFirstName, t_child.chiAddress, t_child.chiParentsNames, t_child.chiBirthDate, 
        t_child.chiPicture, t_building.buiState, t_filiation.filName, t_training.traCost, t_user.useName, 
        t_user.useFirstName FROM t_child LEFT OUTER JOIN t_building ON t_child.fkBuilding = t_building.idBuilding 
        LEFT OUTER JOIN t_filiation ON t_child.fkFiliation = t_filiation.idFiliation LEFT OUTER JOIN t_training 
        ON t_child.fkTraining = t_training.idTraining LEFT OUTER JOIN t_user ON t_child.fkUser = t_user.idUser WHERE 1=1 ORDER BY t_child.fkFiliation ASC, t_child.chiName ASC, t_child.chiFirstName ASC';

        $req = $this->dao->query($queryPupils);

        $pupilsArray = $req->fetchAll();
        $req->closeCursor();

        return $pupilsArray;
    }

    // Return the filtered list of pupils 
    public function filterList($filName, $birthYear, $buiState)
    {
        $link = mysqli_connect(DB_HOST_MYSQLI, DB_USER, DB_PWD, DB_NAME);
        $filName = mysqli_real_escape_string($link, $filName);
        $birthYear = mysqli_real_escape_string($link, $birthYear);
        $filName = str_replace('primaire', "'primaire'", $filName);
        $filName = str_replace('secondaire', "'secondaire'", $filName);
        $buiState = mysqli_real_escape_string($link, $buiState);
        if ($buiState !== '' && $filName !== '') {
            // Query that returns the filtered pupils list
            $filterQuery = "SELECT t_child.idChild, t_child.chiName, t_child.chiFirstName, t_child.chiAddress, t_child.chiParentsNames, t_child.chiBirthDate, 
        t_child.chiPicture, t_building.buiState, t_filiation.filName, t_training.traCost, t_user.useName, t_user.useFirstName 
        FROM t_child LEFT OUTER JOIN t_building ON t_child.fkBuilding = t_building.idBuilding LEFT OUTER JOIN t_filiation ON 
        t_child.fkFiliation = t_filiation.idFiliation LEFT OUTER JOIN t_training ON t_child.fkTraining = t_training.idTraining 
        LEFT OUTER JOIN t_user ON t_child.fkUser = t_user.idUser WHERE (t_building.buiState = $buiState) AND (t_child.chiBirthDate LIKE '$birthYear%') 
        AND (t_filiation.filName = $filName) ORDER BY t_child.chiName ASC, t_child.chiFirstName ASC";
            $req = $this->dao->query($filterQuery);
            $pupilsArray = $req->fetchAll();
            $req->closeCursor();
        }
        else {
            $pupilsArray = [];
        }

        return $pupilsArray;
    }

    // Return the filtered list of pupils
    public function getTotByFiliation()
    {
        // Query that returns the filtered pupils list
        $strQuery = "SELECT t_child.fkFiliation, t_filiation.filName, Count(t_child.chiName) AS tot_by_filiation 
                        FROM t_child INNER JOIN t_filiation ON t_child.fkFiliation = t_filiation.idFiliation 
                        GROUP BY t_child.fkFiliation, t_filiation.filName";

        $req = $this->dao->query($strQuery);

        $result = $req->fetchAll();
        $req->closeCursor();

        return $result;
    }

    // Get the pupil data for the modal modAddUpdatePupil
    public function getPupilData($idPupil)
    {
        // Get the data of a pupil depending on its id
        $pupilDataQuery = "SELECT t_child.idChild, t_child.chiName, t_child.chiFirstName, t_child.chiAddress, t_child.chiParentsNames, t_child.chiBirthDate, 
        t_child.chiPicture, t_child.fkUser, t_child.fkFiliation, t_child.fkTraining, t_child.fkBuilding, t_building.buiState, t_building.buiName, t_filiation.filName, t_training.traCost, t_user.useName, 
        t_user.useFirstName FROM t_child LEFT OUTER JOIN t_building ON t_child.fkBuilding = t_building.idBuilding 
        LEFT OUTER JOIN t_filiation ON t_child.fkFiliation = t_filiation.idFiliation LEFT OUTER JOIN t_training 
        ON t_child.fkTraining = t_training.idTraining LEFT OUTER JOIN t_user ON t_child.fkUser = t_user.idUser WHERE t_child.idChild = '$idPupil'";

        $req = $this->dao->query($pupilDataQuery);

        $pupilData = $req->fetchAll();
        $req->closeCursor();

        return $pupilData[0];
    }

    // Add a pupil to the database
    public function addPupil($name, $firstName, $address, $parentsNames, $birthDate, $pictureName, $building, $filiation, $training, $sponsor)
    {
        $link = mysqli_connect(DB_HOST_MYSQLI, DB_USER, DB_PWD, DB_NAME);
        $name = mysqli_real_escape_string($link, $name);
        $firstName = mysqli_real_escape_string($link, $firstName);
        $address = mysqli_real_escape_string($link, $address);
        $parentsNames = mysqli_real_escape_string($link, $parentsNames);
        $birthDate = mysqli_real_escape_string($link, $birthDate);
        $pictureName = mysqli_real_escape_string($link, $pictureName);
        $building = mysqli_real_escape_string($link, $building);
        $filiation = mysqli_real_escape_string($link, $filiation);
        $training = mysqli_real_escape_string($link, $training);
        $sponsor = mysqli_real_escape_string($link, $sponsor);

        // Add the pupil
        if ($sponsor == "NULL") // If the pupil has no sponsor
        {
            $addPupilQuery = "INSERT INTO t_child (chiName, chiFirstName, chiAddress, chiParentsNames, chiBirthDate, chiPicture, fkBuilding, 
            fkFiliation, fkTraining, fkUser) VALUES ('$name', '$firstName', '$address', '$parentsNames', '$birthDate', '$pictureName', '$building', '$filiation', '$training', $sponsor)";
        } else // If the pupil has a sponsor
        {
            $addPupilQuery = "INSERT INTO t_child (chiName, chiFirstName, chiAddress, chiParentsNames, chiBirthDate, chiPicture, fkBuilding, 
            fkFiliation, fkTraining, fkUser) VALUES ('$name', '$firstName', '$address', '$parentsNames', '$birthDate', '$pictureName', '$building', '$filiation', '$training', '$sponsor')";
        }
        $req = $this->dao->query($addPupilQuery);
    }

    // Update a pupil in the database
    public function updatePupil($id, $name, $firstName, $address, $parentsNames, $birthDate, $pictureName, $building, $filiation, $training, $sponsor)
    {
        $link = mysqli_connect(DB_HOST_MYSQLI, DB_USER, DB_PWD, DB_NAME);
        $name = mysqli_real_escape_string($link, $name);
        $firstName = mysqli_real_escape_string($link, $firstName);
        $address = mysqli_real_escape_string($link, $address);
        $parentsNames = mysqli_real_escape_string($link, $parentsNames);
        $birthDate = mysqli_real_escape_string($link, $birthDate);
        $pictureName = mysqli_real_escape_string($link, $pictureName);
        $building = mysqli_real_escape_string($link, $building);
        $filiation = mysqli_real_escape_string($link, $filiation);
        $training = mysqli_real_escape_string($link, $training);
        $sponsor = mysqli_real_escape_string($link, $sponsor);

        // Update the pupil
        if ($sponsor == "NULL") // If the pupil has no sponsor
        {
            $updatePupilQuery = "UPDATE t_child SET chiName = '$name', chiFirstName = '$firstName', chiAddress = '$address', chiParentsNames = '$parentsNames', 
            chiBirthDate = '$birthDate', chiPicture = '$pictureName', fkBuilding = '$building', fkFiliation = '$filiation', fkTraining = '$training', fkUser = $sponsor
            WHERE t_child.idChild = '$id'";
        } else // If the pupil has a sponsor
        {
            $updatePupilQuery = "UPDATE t_child SET chiName = '$name', chiFirstName = '$firstName', chiAddress = '$address', chiParentsNames = '$parentsNames', 
            chiBirthDate = '$birthDate', chiPicture = '$pictureName', fkBuilding = '$building', fkFiliation = '$filiation', fkTraining = '$training', fkUser = '$sponsor' 
            WHERE t_child.idChild = '$id'";
        }

        $req = $this->dao->query($updatePupilQuery);
    }

    // Delete a pupil in the database
    public function deletePupil($idPupil)
    {
        // Delete a pupil depdending on its id
        $deletePupilQuery = "DELETE FROM t_child WHERE idChild = '$idPupil'";

        $req = $this->dao->query($deletePupilQuery);
    }

}
