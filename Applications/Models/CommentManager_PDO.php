<?php

namespace Applications\Models;

use Applications\Entities\Comment;

class CommentManager_PDO extends CommentManager
{
    public function getListByStudent($student_id) {
        $req = $this->dao->prepare('SELECT * FROM t_comment
                                  WHERE t_comment.fkChild = :id
                                  ORDER BY add_date DESC');
        $req->bindValue(':id', $student_id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\Comment');

        $comments = $req->fetchAll();
        $req->closeCursor();

        return $comments;
    }

    public function getListByColleague($colleague_id) {
        $req = $this->dao->prepare('SELECT * FROM t_comment
                                  WHERE t_comment.fkUser = :id
                                  ORDER BY add_date DESC');
        $req->bindValue(':id', $colleague_id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\Comment');

        $comments = $req->fetchAll();
        $req->closeCursor();

        return $comments;
    }

    public function getUnique($id) {
        $req = $this->dao->prepare('SELECT * FROM t_comment
                                  WHERE t_comment.idComment = :id
                                  ORDER BY add_date DESC');
        $req->bindValue(':id', $id);
        $req->execute();

        $comments = $req->fetch();
        $req->closeCursor();

        return $comments;
    }

    public function add(Comment $comment) {
        $link = mysqli_connect(DB_HOST_MYSQLI, DB_USER, DB_PWD, DB_NAME);
        $req = $this->dao->prepare('INSERT INTO t_comment (`comComment`,  `comDate`, `fkChild`, `fkUser`)
                                    VALUES (:content, NOW(),:student_id, :colleague_id)');

        $comment->setComment(mysqli_real_escape_string($link, $comment->comment()));
        $comment->setStudent_id(mysqli_real_escape_string($link, $comment->student_id()));
        $comment->setColleague_id(mysqli_real_escape_string($link, $comment->colleague_id()));

        $req->bindValue(':content', $comment->comment());
        $req->bindValue(':student_id', $comment->student_id());
        $req->bindValue(':colleague_id', $comment->colleague_id());
        $success = $req->execute();
        $req->closeCursor();

        return $success;
    }

    public function delete($id) {
        $req = $this->dao->prepare('DELETE FROM follows WHERE id = :id;
                                    DELETE FROM follows_updates WHERE follow_id = :id');
        $req->bindValue(':id', $id);
        $success = $req->execute();
        $req->closeCursor();

        return $success;
    }

    public function update(Comment $comment, Comment $followUpdate) {

        $req = $this->dao->prepare('INSERT INTO follows_updates (`content`,`follow_type`, `add_date`, `right`, `follow_id`, `colleague_id`)
                                    VALUES (:content, :followType, :add_date, :right, :follow_id, :colleague_id);
                                    UPDATE follows
                                    SET `content` = :update_content,`follow_type`= :update_followType,  `right` = :update_right, `mod_date` = NOW(), `mod_colleague_id` = :update_mod_colleague_id, `isChecked` = :update_checked
                                    WHERE id = :follow_id');

        $req->bindValue(':content', $comment->content());
        $req->bindValue(':followType', $follow->follow_type());
        $req->bindValue(':add_date', ($follow->mod_date() != null) ? $follow->mod_date()->format('Y-m-d H:i:s') : $follow->add_date()->format('Y-m-d H:i:s'));
        $req->bindValue(':right', 0, \PDO::PARAM_INT);
        $req->bindValue(':colleague_id', ($follow->mod_colleague_id() != null) ? $follow->mod_colleague_id() : $follow->colleague_id());

        $req->bindValue(':follow_id', $followUpdate->id());

        $req->bindValue(':update_content', $followUpdate->content());
        $req->bindValue(':update_followType', $followUpdate->follow_type());
        $req->bindValue(':update_right', ($followUpdate->right() == 1) ? 1 : 0, \PDO::PARAM_INT);
        $req->bindValue(':update_mod_colleague_id', $followUpdate->mod_colleague_id());

  

        $success = $req->execute();
        $req->closeCursor();

        return $success;
    }
}