<?php

namespace Applications\Models;

use Applications\Entities\Follow;
use Library\Sly\Database\Manager;

abstract class FollowManager extends Manager
{
  abstract function getListByStudent($student_id);
  abstract function getUnique($id);
  abstract function getFollowTypes();
  abstract function add(Follow $follow);
  abstract function delete($id);
  abstract function update(Follow $follow, Follow $followUpdate);
}