<?php

namespace Applications\Frontend\Modules\User;

use Library\Sly\Controller\BackController;
use Library\Sly\Network\HTTPRequest;



class UserController extends BackController
{
    /* la liste des utilisateurs */
    function executeIndex(HTTPRequest $request) {
        $errors = array();

        /* on vérifie qu'on a les bons droits .. c'est à dire qu'on fait partie du comité */
        if (!($this->app->user()->isAuthenticated() and ($this->app->user()->getAttribute('isInCD')))){
            
            $errors[0]="Vous nêtes pas autorisé à accéder à cette page !";
            $this->app->user()->setFlash($errors,'danger','Droits ');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }  
        
        $users = $this->managers->getManagerOf('User')->getlist();
        
        /* on récupère le nombre de parrainage */
        $nbrePM = $this->managers->getManagerOf('User')->getNbreParrainage();

        /* on récupère le nombre de membre */
        $nbreM = $this->managers->getManagerOf('User')->getNbreMember();

        $this->page->addVar('lstUsers', $users);
        $this->page->addVar('nbrePM', $nbrePM);
        $this->page->addVar('nbreM', $nbreM);
        
        $this->page->setLayout('gestion');
    }

    /* affichage de l'interface d'ajout d'un utilisateur */
    function executeAdd(HTTPRequest $request) {

        $errors = array();

        /* on vérifie qu'on a les bons droits .. c'est à dire qu'on fait partie du comité */
        if (!($this->app->user()->isAuthenticated() and ($this->app->user()->getAttribute('isInCD')))){
            
            $errors[0]="Vous nêtes pas autorisé à accéder à cette page !";
            $this->app->user()->setFlash($errors,'danger','Droits ');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }  
            /* on affiche la page add.php  dans une popup modal */
            $this->page->setLayout();            
    }

    /* Description : ici on ajoute l'utilisateur */
    function executeSubmitAdd(HTTPRequest $request) {  

        $errors = array();

        /* on vérifie qu'on a les bons droits .. c'est à dire qu'on fait partie du comité */
        if (!($this->app->user()->isAuthenticated() and ($this->app->user()->getAttribute('isInCD')))){
            
            $errors[0]="Vous nêtes pas autorisé à accéder à cette page !";
            $this->app->user()->setFlash($errors,'danger','Droits ');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }

        // le retour de l'appel Ajax
        $results=[];
        $results['msgErr']='';
        $results['msgTitle']='';

        // au départ le nom de la photo est null
        $photoName=null;

        if ((isset($_POST["userData"]))){
            $userData =  $_POST["userData"];
        
            if (isset($_POST["userPhoto"]))
            {
                $userData =  json_decode($_POST["userData"]);
       
                $userPhoto = $_POST["userPhoto"];
              
                if( substr($userPhoto, 0, 4) !=="http"){

                    $dataPhoto = $_POST["userPhoto"];
                        
                    $image_array_1 = explode(";", $dataPhoto);

                    $image_array_2 = explode(",", $image_array_1[1]);

                    $dataPhoto = base64_decode($image_array_2[1]);

                    $photoName = time() . '.png';

                }
                
            }

            $userManager = $this->managers->getManagerOf('User');
            
            $res=null;
            $res = $userManager->add($userData,$photoName);

            if ($res==null ){
                if ($photoName!=null){

                    //on place la photo dans le répertoire des utilisateurs
                    file_put_contents(IMAGES_FOLDER.FOLDER_IMG_USER.$photoName, $dataPhoto);
                } 
                //on récupère le nombre de membre et de parrain et marraine pour le mettre à jour dans ajax Gestion.js
                //submit_add_user()
                $nbreParrainage = $userManager->getNbreParrainage();
                $nbreMembre = $userManager->getNbreMember();
                $results['nbreParrainage']=$nbreParrainage;
                $results['nbreMembre']=$nbreMembre;                     
            }
            else{
                $results['msgErr']=$res;
                $results['msgTitle']="! Erreur -> Ajout !";
            }
   
        }

        $this->page->setLayout();
    
        die(json_encode($results));          
    }

    /* Description : ici on modifie  l'utilisateur */
    function executeEdit(HTTPRequest $request) {
    
        $errors = array();

        /* on vérifie qu'on a les bons droits .. c'est à dire qu'on fait partie du comité */
        if (!($this->app->user()->isAuthenticated() and ($this->app->user()->getAttribute('isInCD')))){
            
            $errors[0]="Vous nêtes pas autorisé à accéder à cette page !";
            $this->app->user()->setFlash($errors,'danger','Droits ');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }  

            $manager = $this->managers->getManagerOf('User');

            /* on récupère la liste des titres */
            $titles = $manager->getTitle();

            /* on récupère la liste des groupes */
            $groups = $manager->getGroup();
   
            $userId=$request->getData('id');
        
           
            $user = $manager->getUnique($userId);   
             
            $this->page->addVar('user', $user);
            $this->page->addVar('titles', $titles);
            $this->page->addVar('groups', $groups);

            $this->page->setLayout();
        
    }

     /* Description : ici on modifie l'utilisateur */
     function executeSubmitEdit(HTTPRequest $request) {  

        $errors = array();

        /* on vérifie qu'on a les bons droits .. c'est à dire qu'on fait partie du comité */
        if (!($this->app->user()->isAuthenticated() and ($this->app->user()->getAttribute('isInCD')))){
            
            $errors[0]="Vous nêtes pas autorisé à accéder à cette page !";
            $this->app->user()->setFlash($errors,'danger','Droits ');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }

        // pour des messages d'erreurs éventuelles
        $results=[];
        $results['msgErr']='';
        $results['msgTitle']='';

        // au départ le nom de la photo est null
        $photoName=null;

        if ((isset($_POST["userData"]))){
            $userData =  $_POST["userData"];
            $idUser=$_POST["idUser"];
        
            if (isset($_POST["userPhoto"]))
            {
                $userData =  json_decode($_POST["userData"]);
       
                $userPhoto = $_POST["userPhoto"];
              
                if( substr($userPhoto, 0, 4) !=="http"){

                    $dataPhoto = $_POST["userPhoto"];
                        
                    $image_array_1 = explode(";", $dataPhoto);

                    $image_array_2 = explode(",", $image_array_1[1]);

                    $dataPhoto = base64_decode($image_array_2[1]);

                    $photoName = time() . '.png';

                }
                
            }

            $userManager = $this->managers->getManagerOf('User');
            
            $res=null;
            $res = $userManager->edit($userData,$photoName,$idUser);

            if ($res==null ){
                if ($photoName!=null){

                    //on place la photo dans le répertoire des utilisateurs
                    file_put_contents(IMAGES_FOLDER.FOLDER_IMG_USER.$photoName, $dataPhoto);
                }  
                    //on récupère le nombre de membre et de parrain et marraine pour le mettre à jour dans ajax Gestion.js
                    //submit_edit_user()
                    $nbreParrainage = $userManager->getNbreParrainage();
                    $nbreMembre = $userManager->getNbreMember();
                    $results['nbreParrainage']=$nbreParrainage;
                    $results['nbreMembre']=$nbreMembre;        
                                      
            }
            else{
                $results['msgErr']=$res;
                $results['msgTitle']="! Erreur ->  Modification !";
            }
   
        }

        $this->page->setLayout();
    
        die(json_encode($results));          
    }

    function executeView(HTTPRequest $request) {
        
        $filterUser="";

        $view_all = $request->postData('view_all');
        if($view_all == "false"){

            $useActif=(($request->postData('view_actual')=='false')?0:1);
            $useisMember=(($request->postData('view_member')=='false')?0:1);
            $is_comite=(($request->postData('view_incommittee')=='false')?0:1);
            $is_godParent=(($request->postData('view_godparent')=='false')?0:1);
            $is_donateur=(($request->postData('view_giver')=='false')?0:1);

            if($useActif){
                $filterUser .=($filterUser==''?'useActif=1':' and useActif=1');
            }
            else{
                $filterUser .=($filterUser==''?'useActif=0':' and useActif=0');
            }
            
            if ($useisMember) {
           
                $filterUser .=($filterUser==''?'useisMember=1':' and useisMember=1');
                
            }
            if ($is_comite) {

                $filterUser .=($filterUser==''?'is_comite=1':' and is_comite=1');
            }
            if ($is_godParent) {

                $filterUser .=($filterUser==''?'is_godParent=1':' and is_godParent=1');

            }
            if ($is_donateur) {

                $filterUser .=($filterUser==''?'is_donateur=1':' and is_donateur=1');

            }
            
          
        } else {
            $filterUser=null;
        }
        $users = $this->managers->getManagerOf('User')->getlist($filterUser);
        
        $this->page->addVar('lstUsers', $users);

        $this->page->setLayout();
    }

    /* affichage de la mise en garde de la suppression d'un utilisateur */
    function executeDelete(HTTPRequest $request) {
        $errors = array();

        /* on vérifie qu'on a les bons droits .. c'est à dire qu'on fait partie du comité */
        if (!($this->app->user()->isAuthenticated() and ($this->app->user()->getAttribute('isInCD')))){
            
            $errors[0]="Vous nêtes pas autorisé à accéder à cette page !";
            $this->app->user()->setFlash($errors,'danger','Droits ');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }  

        $userId=$request->getData('id');
        
        $manager = $this->managers->getManagerOf('User');
        $user = $manager->getUnique($userId);     
        $this->page->addVar('user', $user);

        $this->page->setLayout();


    }   

    /* Description : Méthode qui supprime l'utilisateur */
    function executeSubmitDelete(HTTPRequest $request){

        $errors = array();

        /* on vérifie qu'on a les bons droits .. c'est à dire qu'on fait partie du comité */
        if (!($this->app->user()->isAuthenticated() and ($this->app->user()->getAttribute('isInCD')))){
            
            $errors[0]="Vous nêtes pas autorisé à accéder à cette page !";
            $this->app->user()->setFlash($errors,'danger','Droits ');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }  

        // recupère l'id de l'utilisateur à supprimer
        $idUser = $request->getData('id');

        // on récupère les infos de l'utilisateur
        $user = $this->managers->getManagerOf('User')->getUnique($idUser);  

        // suppréssion de l'utilisateur dans la base de données 
        $this->managers->getManagerOf('User')->deleteUser($idUser);

        //on récupère le nombre de membre et de parrain et marraine pour le mettre à jour dans ajax Gestion.js
        //submit_add_user()
        $nbreParrainage = $this->managers->getManagerOf('User')->getNbreParrainage();
        $nbreMembre = $this->managers->getManagerOf('User')->getNbreMember();
        
        $results=[];
        $results['user']=$user->useName()." ".$user->useFirstName();
        $results['nbreParrainage']=$nbreParrainage;
        $results['nbreMembre']=$nbreMembre;  
        
       
        
        // fin de la requête
        die(json_encode($results));
    }
}
    
    

    

    



