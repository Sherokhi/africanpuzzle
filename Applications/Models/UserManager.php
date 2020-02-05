<?php

namespace Applications\Models;

use Applications\Entities\User;
use Library\Sly\Database\Manager;

abstract class UserManager extends Manager
{
  abstract function getList(); 
  abstract function getTitle();
  abstract function getUniqueLogin($login);
  abstract function add($userData,$photoName);
  abstract function modify();
  abstract function deleteUser($id);
  abstract function updateLoginUser($login,$password);

  
}
