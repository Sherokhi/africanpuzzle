<?php

namespace Applications\Models;

use Applications\Entities\Follow;

class FollowManager_PDO extends FollowManager
{
    public function getListByStudent($student_id) {
        $req = $this->dao->prepare('SELECT follows.*, follows_types.type_name AS type_name , colleagues.name AS colleague_name, colleagues.first_name AS colleague_first_name, mod_colleagues.name AS mod_colleague_name, mod_colleagues.first_name AS mod_colleague_first_name
                                  FROM follows
                                  INNER JOIN follows_types ON follows.follow_type = follows_types.id
                                  INNER JOIN colleagues ON follows.colleague_id = colleagues.id 
                                  LEFT OUTER JOIN colleagues AS mod_colleagues ON follows.mod_colleague_id = mod_colleagues.id
                                  WHERE follows.student_id = :id
                                  ORDER BY add_date DESC');
        $req->bindValue(':id', $student_id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\Follow');

        $follows = $req->fetchAll();
        $req->closeCursor();

        return $follows;
    }

    public function getListByColleague($colleague_id) {
        $req = $this->dao->prepare('SELECT follows.*,  students.school_class_id as student_class,
                                  students.name AS student_name, students.first_name AS student_first_name,
                                  mod_colleagues.name AS mod_colleague_name,
                                  mod_colleagues.first_name AS mod_colleague_first_name
                                  FROM follows
                                  INNER JOIN students ON follows.student_id = students.id
                                  LEFT OUTER JOIN colleagues AS mod_colleagues ON follows.mod_colleague_id = mod_colleagues.id
                                  WHERE follows.colleague_id = :id and students.active=1
                                  ORDER BY add_date DESC');
        $req->bindValue(':id', $colleague_id);
        $req->execute();
        
        
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\Follow');

        $follows = $req->fetchAll();
        $req->closeCursor();

        return $follows;
    }

    public function getListByMaster($colleague_id) {

        /* $req = $this->dao->prepare('SELECT follows.*, colleagues.name AS colleague_name, colleagues.first_name AS colleague_first_name, mod_colleagues.name AS mod_colleague_name, mod_colleagues.first_name AS mod_colleague_first_name, students.name AS student_name, students.first_name AS student_first_name
                                  FROM follows 
                                  INNER JOIN colleagues ON follows.colleague_id = colleagues.id
                                  INNER JOIN students ON follows.student_id = students.id 
                                  LEFT OUTER JOIN colleagues AS mod_colleagues ON follows.mod_colleague_id = mod_colleagues.id
                                  WHERE follows.student_id IN (SELECT students.id
                                                                FROM students
                                                                WHERE students.school_class_id = (SELECT school_classes.id
                                                                                                    FROM school_classes
                                                                                                    WHERE school_classes.colleague_id = :id))
                                  ORDER BY add_date DESC');
        */

        $query = 'SELECT follows.*, students.school_class_id as student_class, colleagues.name AS colleague_name,
                                    colleagues.first_name AS colleague_first_name,
                                    mod_colleagues.name AS mod_colleague_name,
                                    mod_colleagues.first_name AS mod_colleague_first_name,
                                    students.name AS student_name, students.first_name AS student_first_name
                                    FROM ((follows INNER JOIN students ON follows.student_id = students.id)
                                    INNER JOIN colleagues ON follows.colleague_id = colleagues.id)
                                    LEFT  JOIN colleagues AS mod_colleagues ON follows.mod_colleague_id = mod_colleagues.id
                                    LEFT JOIN school_classes ON students.school_class_id = school_classes.id
                                    WHERE school_classes.colleague_id=:id and students.active=1 ORDER BY add_date DESC';

        $req = $this->dao->prepare($query);



        $req->bindValue(':id', $colleague_id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\Follow');
        
        $follows = $req->fetchAll();
        $req->closeCursor();

        return $follows;
    }

    /***
     * -----------------------------------------------------------------
     * *** 	    getCountFollowUncheckedForMasterClass 	    		 ***
     * -----------------------------------------------------------------
     * ETML
     * Auteur 				: DLS
     * Date 				: 06.04.2017
     * Description 			: recherche les suivis d'un maître de
     *                        classe qui ne soient pas checkés
     *                        utilisé pour la notification lors
     *                        de la conection
     *
     * @param $idMasterClass	--> identifiant du maître de classe
     * @return                  --> le nombre de follow pas checkés
     * -----------------------------------------------------------------
     */
    public function getCountFollowUncheckedForMasterClass($idMasterClass)
    {
        $query = "SELECT count(* ) as nbreFollow
                    FROM(students INNER JOIN school_classes ON students.school_class_id = school_classes . id) INNER JOIN follows ON students . id = follows.student_id
                    WHERE  (follows.isChecked=False and school_classes.colleague_id = :id)";

        $req = $this->dao->prepare($query);

        $req->bindValue(':id', $idMasterClass);
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_ASSOC);
        $result = $req->fetchAll();
        $req->closeCursor();

        return $result;

    }// getCountFollowUncheckedForMasterClass

    /***
     * -----------------------------------------------------------------
     * *** 	 getCountFollowUncheckedForMasterClassStudent 			 ***
     * -----------------------------------------------------------------
     * ETML
     * Auteur 				: DLS
     * Date 				: 06.04.2017
     * Description 			: recherche les suivis d'un  élève qui ne
     *                        soient pas checkés (pour MC)
     *                        utilisé pour la notification lors
     *                        de la conection
     *
     * @param $idMasterClass	--> identifiant du maître de classe
     * @param $idStudent    	--> identifiant dde l'élève
     * @return                  --> le nombre de follow pas checkés
     * -----------------------------------------------------------------
     */
    public function getCountFollowUncheckedForMasterClassStudent($idMasterClass)
    {
        $query = "SELECT students.school_class_id, Count(follows.id) AS nbreUncheckedFollow, school_classes.colleague_id
                  FROM (follows LEFT JOIN students ON follows.student_id = students.id) LEFT JOIN school_classes ON students.school_class_id = school_classes.id
                  GROUP BY students.school_class_id, follows.isChecked, students.active, school_classes.colleague_id
                  HAVING (((follows.isChecked)=0) AND ((students.active)=1) and (school_classes.colleague_id = :idMasterClass))";


        $req = $this->dao->prepare($query);

        $req->bindValue(':idMasterClass',$idMasterClass );

        $req->execute();

        $req->setFetchMode(\PDO::FETCH_ASSOC);
        $result = $req->fetchAll();
        $req->closeCursor();

        return $result;

    }// getCountFollowUncheckedForMasterClass

    public function getListByMainMaster($profession_id) {

        $query = "SELECT follows.*, students.school_class_id as student_class, colleagues.name AS colleague_name,
                                    colleagues.first_name AS colleague_first_name,
                                    students.name AS student_name, students.first_name AS student_first_name
                    FROM school_classes
                    INNER JOIN students
                    ON students.school_class_id = school_classes.id
                    INNER JOIN follows
                    ON follows.student_id = students.id
                    INNER JOIN colleagues
                    ON colleagues.id = follows.colleague_id
                    WHERE school_classes.profession_id = :id
                    ORDER BY add_date DESC";

        $req = $this->dao->prepare($query);

        $req->bindValue(':id', $profession_id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\Follow');

        $follows = $req->fetchAll();
        $req->closeCursor();

        return $follows;


    }

    public function getUnique($id) {
        $req = $this->dao->prepare('SELECT follows.*
                                  FROM follows 
                                  WHERE follows.id = :id');
        $req->bindValue(':id', $id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\Follow');

        $follow = $req->fetch();
        $req->closeCursor();

        return $follow;
    }

    public function getFollowTypes()
    {
        $req = $this->dao->prepare('SELECT id as follow_type, type_name FROM `follows_types`');
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\Follow');

        $followTypes = $req->fetchAll();
        $req->closeCursor();

        return $followTypes;

    }

    public function add(Follow $follow,$checked=0) {
        $req = $this->dao->prepare('INSERT INTO follows (`content`,`follow_type`,  `add_date`, `right`, `student_id`, `colleague_id`, isChecked)
                                    VALUES (:content, :followType, NOW(), :right, :student_id, :colleague_id, :isChecked)');
        $req->bindValue(':content', $follow->content());
        $req->bindValue(':followType', $follow->follow_type());
        $req->bindValue(':right', 0, \PDO::PARAM_INT);
        $req->bindValue(':student_id', $follow->student_id());
        $req->bindValue(':colleague_id', $follow->colleague_id());
		$req->bindValue(':isChecked', $checked);
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

    public function update(Follow $follow, Follow $followUpdate,$checked=0) {



        $req = $this->dao->prepare('INSERT INTO follows_updates (`content`,`follow_type`, `add_date`, `right`, `follow_id`, `colleague_id`)
                                    VALUES (:content, :followType, :add_date, :right, :follow_id, :colleague_id);
                                    UPDATE follows
                                    SET `content` = :update_content,`follow_type`= :update_followType,  `right` = :update_right, `mod_date` = NOW(), `mod_colleague_id` = :update_mod_colleague_id, `isChecked` = :update_checked
                                    WHERE id = :follow_id');

        $req->bindValue(':content', $follow->content());
        $req->bindValue(':followType', $follow->follow_type());
        $req->bindValue(':add_date', ($follow->mod_date() != null) ? $follow->mod_date()->format('Y-m-d H:i:s') : $follow->add_date()->format('Y-m-d H:i:s'));
        $req->bindValue(':right', 0, \PDO::PARAM_INT);
        $req->bindValue(':colleague_id', ($follow->mod_colleague_id() != null) ? $follow->mod_colleague_id() : $follow->colleague_id());

        $req->bindValue(':follow_id', $followUpdate->id());

        $req->bindValue(':update_content', $followUpdate->content());
        $req->bindValue(':update_followType', $followUpdate->follow_type());
        $req->bindValue(':update_right', ($followUpdate->right() == 1) ? 1 : 0, \PDO::PARAM_INT);
        $req->bindValue(':update_mod_colleague_id', $followUpdate->mod_colleague_id());
        $req->bindValue(':update_checked', $checked);

  

        $success = $req->execute();
        $req->closeCursor();

        return $success;
    }

        public function updateIsChecked($follow,$checked=0){
            $req = $this->dao->prepare('UPDATE follows SET `isChecked` = :update_checked WHERE id = :follow_id');

            $req->bindValue(':follow_id', $follow->id());
            $req->bindValue(':update_checked', $checked);

            $success = $req->execute();
            $req->closeCursor();

            return $success;
        }
}