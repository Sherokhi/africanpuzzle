<?php

namespace Applications\Models;

use Applications\Entities\User;
use PDOException;

class UserManager_PDO extends UserManager
{

    public function getUnique($id) {
        ;

        $req = $this->dao->prepare('SELECT t_user.*, groGroup as  useGroupName,  titTitle as useTitle
                                    FROM (t_user LEFT JOIN t_group ON t_user.fkGroup = t_group.idGroup) 
                                    LEFT JOIN t_title ON t_user.fkTitle = t_title.idTitle WHERE idUser = :id');
        $req->bindValue(':id', $id);
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\User');

        $result = $req->fetch();
        $req->closeCursor();

        return $result;
    }

    public function getTitle() {
 
        $req = $this->dao->query('SELECT idTitle, titTitle as useTitle FROM  t_title ');

        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\User');

        $result = $req->fetchAll();
        $req->closeCursor();

        return $result;
    }

    public function getGroup() {
 
        $req = $this->dao->query('SELECT idGroup as fkGroup, groGroup as useGroupName FROM  t_group ');

        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\User');

        $result = $req->fetchAll();
        $req->closeCursor();

        return $result;
    }

    public function getNbreParrainage() {
        $req = $this->dao->prepare('SELECT distinct t_user.idUser FROM t_user INNER JOIN t_child ON t_user.idUser = t_child.fkUser');
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\User');

        $result = $req->fetchAll();
        $req->closeCursor();

        return count($result);
    }

    public function getNbreMember() {
        $req = $this->dao->prepare('SELECT Count(t_user.idUser) AS nbreMember FROM t_user where (useIsMember=True And useActif=True)');
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_ASSOC);

        $result = $req->fetch();
        $req->closeCursor();

        return $result['nbreMember'];
    }

    public function getList($filterUser=null) {

        $whereCondition="v_lstuser.useActif=1";

        if (!is_null($filterUser)){

            $whereCondition=$filterUser;
        }

        $req = $this->dao->query('SELECT v_lstuser.* FROM  v_lstuser where '.$whereCondition.' ORDER BY v_lstuser.useName');

        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\User');

        $result = $req->fetchAll();
        $req->closeCursor();

        return $result;
    }

    public function add($userData,$photoName) {
        
       
        $msgError=null;

        try {
           
  
            $this->dao->beginTransaction();
                      
              $req = $this->dao->prepare("INSERT INTO t_user (idUser,  useName, useFirstName, useAddress, usePstcode, useLocality,
                        useEmail, usePhone, useMobilePhone, usePicture,useIsMember, useActif, fkTitle, fkGroup) VALUES 
                        (null,'".$userData->useName."','".$userData->useFirstName."','".$userData->useAddress."','".$userData->useNpa."','".$userData->useLocalite."',
                        '".$userData->useMail."','".$userData->usePhone."','".$userData->useMobilePhone."','".$photoName."',".$userData->useIsMember.",1,".$userData->useTitle.",".$userData->useGroup.")");

            
               //Commencer une transaction           
              $req->execute();
              
          
              //Valider les requête et arrêter la transaction
              $this->dao->commit();
              $req->closeCursor();

          
          } catch (PDOException $e) {  //Gestion des erreurs causées par les requêtes PDO
              
              //Annuler la transaction
              if ($req)  $this->dao->rollBack();
              //Afficher l'erreur
              $msgError=$e->getMessage();
              
          }

          return $msgError;
    }

    public function edit($userData,$photoName,$idUser) {
       
        $msgError=null;

        try {
           
  
            $this->dao->beginTransaction();

            
                   
            $req = $this->dao->prepare("UPDATE t_user set useName='".$userData->useName."', 
                                                            useFirstName='".$userData->useFirstName."',
                                                            useAddress='".$userData->useAddress."', 
                                                            usePstcode='".$userData->useNpa."', 
                                                            useLocality='".$userData->useLocalite."',                        
                                                            useEmail='".$userData->useMail."', 
                                                            usePhone='".$userData->useTel2."', 
                                                            useMobilePhone='".$userData->useTel1."', 
                                                            usePicture='".$photoName."',
                                                            useIsMember='".$userData->useIsMember."', 
                                                            useActif='".$userData->useIsActif."', 
                                                            fkTitle=".$userData->useTitle.",
                                                            fkGroup=".$userData->useGroup." 
                                        WHERE idUser='".$idUser."'");


             
                        
            
               //Commencer une transaction           
              $req->execute();
              
          
              //Valider les requête et arrêter la transaction
              $this->dao->commit();
              $req->closeCursor();

          
          } catch (PDOException $e) {  //Gestion des erreurs causées par les requêtes PDO
              
              //Annuler la transaction
              if ($req)  $this->dao->rollBack();
              //Afficher l'erreur
              $msgError=$e->getMessage();
              
          }

          return $msgError;
    }

    public function getUniqueLogin($login) {
        $req = $this->dao->prepare('SELECT t_login.logName, t_login.logPassword, v_lstuser.*, v_lstuser.fkGroup AS useGroup, v_lstuser.fkTitle AS useTitle, t_group.groGroup as useGroupName 
                                    FROM (t_login INNER JOIN v_lstuser ON t_login.fkUser = v_lstuser.idUser )  INNER JOIN t_group ON v_lstuser.fkGroup = t_group.idGroup 
                                    WHERE t_login.logName = :login');
        $req->bindValue(':login', $login);
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\User');

        $result = $req->fetch();
        $req->closeCursor();

        return $result;
    }

    public function getUniqueMail($Email) {
        $req = $this->dao->prepare('SELECT * FROM t_user WHERE t_user.useEmail = :Email');
        $req->bindValue(':Email', $Email);
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\User');

        $result = $req->fetch();
        $req->closeCursor();

        return $result;    }

    
        public function modify() {

    }

    public function deleteUser($id) {

    
        $query = "DELETE FROM `t_user` WHERE `idUser` = '".$id."'";

        $req = $this->dao->query($query);

        $req->closeCursor();

    }

    public function updateLoginUser($login,$password){

        $req = $this->dao->prepare('UPDATE t_login SET logPassword = :password WHERE logName = :login');
        
        $req->bindValue(':login', $login);
        $req->bindValue(':password', $password);

        $req->execute();

        $req->closeCursor();
    }

    public function updateRememberTokenLogin($login,$remember_token){

        $req = $this->dao->prepare('UPDATE t_login SET logRemember_token = :remember_token WHERE logName = :login');
        
        $req->bindValue(':login', $login);
        $req->bindValue(':remember_token', $remember_token);

        $req->execute();

        $req->closeCursor();
    }

    public function checkLoginUser($login,$password){

        error_log("login : ".$login . " password: ".$password);
        $req = $this->dao->prepare('select * from t_login  WHERE logName = :login');
        
        $req->bindValue(':login', $login);

        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\User');

        $result = $req->fetch();

        $req->closeCursor();

        if (!empty($result)){
            if (password_verify($password,$result->logPassword())){
                return $result;
            }
        }

            return null;

        
    }

    
}
