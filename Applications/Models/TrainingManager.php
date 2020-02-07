<?php
/********************************************************************************
 * Name:    pupilManager.php
 * Author:  Sam Pache
 * Date:    13.05.2019
 * Goal:    Structure of PupilManager_PDO.php
 **********************************************************************************/

namespace Applications\Models;

use Library\Sly\Database\Manager;

abstract class TrainingManager extends Manager
{
    abstract function getList();
}
