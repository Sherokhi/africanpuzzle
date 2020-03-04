<?php

namespace Applications\Models;

use Applications\Entities\Comment;
use Library\Sly\Database\Manager;

abstract class CommentManager extends Manager
{
  abstract function getListByStudent($student_id);
  abstract function getListByColleague($colleague_id);
  abstract function getUnique($id);
  abstract function add(Comment $comment);
  abstract function delete($id);
  abstract function update(Comment $comment, Comment $followUpdate);
}