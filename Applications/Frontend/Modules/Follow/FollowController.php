<?php

namespace Applications\Frontend\Modules\Follow;

use Applications\Entities\Comment;
use Library\Sly\Controller\BackController;
use Library\Sly\Network\HTTPRequest;

class FollowController extends BackController
{
	/****************************************************************************
    Nom:        is_master
    Auteur:     DLS
    Date:       07.08.2014
    But:        Indique si la personne connectée est le maitre de classe de
                l'élève passé en paramètre
    Parametre:  $student  --> éleve concerné (tableau)
    Retour:     Vrai si il s'agit du MC
     *****************************************************************************/
    private function is_master(&$student)
    {
        if (!$this->app->user()->isAuthenticated())
        {
            return false;
        }

        $arrClasses = @$this->managers->getManagerOf('SchoolClass')->getUniqueByColleague($this->app->user()->getAttribute('user')->id());
        if ($arrClasses == null)
        {
            return false;
        }
        else
        {

            foreach ($arrClasses as $class){

                if ($student->school_class_id() == $class->id()){
                    return true;
                }
            }
            return false;
        }
    } //is_master
	
     function executeIndex(HTTPRequest $request) {
        // On vérifie que l'utilisateur est authentifié
        if ($this->app->user()->isAuthenticated()) {

            // Récupère les droits de l'utilisateur
            $right = $this->app->user()->getAttribute('right');
            // On Vérifie que ce soit quelqu'un qui ait les droits d'ajout
            if (@$right[FOLLOW] & ADD) {
                $manager = $this->managers->getManagerOf('Comment');
                // Récupère la liste de suivis concernant l'élève
                $follows = $manager->getListByColleague($this->app->user()->getAttribute('user')->id());

                $this->page->addVar('title', 'Mes suivis');
                $this->page->addVar('description', 'Liste des suivis d\'un collaborateur de l\'ETML');
                $this->page->addVar('keywords', 'liste suivis');

                $this->page->addVar('follows', $follows);
            }
            else {
                $this->app->user()->setFlash('Vous n\'avez pas le droit de faire ceci', 'error');
                // Redirige l'utilisateur vers la page précédente
                $this->app->httpResponse()->redirect($request->httpReferer());
            }
        }
        else {
            $this->app->user()->setFlash('Vous devez vous authentifier', 'error');
            // Redirige l'utilisateur vers la page précédente
            $this->app->httpResponse()->redirect($request->httpReferer());
        }

     }
	 
	function executePrint(HTTPRequest $request) {
        // On vérifie que l'utilisateur est authentifié
        if ($this->app->user()->isAuthenticated()) {

            // Récupère les droits de l'utilisateur
            $right = $this->app->user()->getAttribute('right');
            // On Vérifie que ce soit quelqu'un qui ait les droits d'ajout
            if (@$right[FOLLOW] & ADD) {
                $manager = $this->managers->getManagerOf('Comment');
                // Récupère la liste de suivis concernant l'élève
                $follows = $manager->getListByColleague($this->app->user()->getAttribute('user')->id());

                $this->page->addVar('title', 'Mes suivis');
                $this->page->addVar('description', 'Liste des suivis d\'un collaborateur de l\'ETML');
                $this->page->addVar('keywords', 'liste suivis');

                $this->page->addVar('follows', $follows);
            }
            else {
                $this->app->user()->setFlash('Vous n\'avez pas le droit de faire ceci', 'error');
                // Redirige l'utilisateur vers la page précédente
                $this->app->httpResponse()->redirect($request->httpReferer());
            }
        }
        else {
            $this->app->user()->setFlash('Vous devez vous authentifier', 'error');
            // Redirige l'utilisateur vers la page précédente
            $this->app->httpResponse()->redirect($request->httpReferer());
        }


     }

     function executeClass(HTTPRequest $request) {
        // On vérifie que l'utilisateur est authentifié
        if ($this->app->user()->isAuthenticated()) {

            // Charge le manager des classes
            $class_manager = $this->managers->getManagerOf('SchoolClass');
            // Récupère la classe de l'utilisateur authentifié
            $master_class = $class_manager->getUniqueByColleague($this->app->user()->getAttribute('user')->id());

            // Vérifie que ce soit un maître de classe
            if ($master_class ) {


                $manager = $this->managers->getManagerOf('Comment');
                // Récupère la liste de suivis concernant l'élève
                $follows = $manager->getListByMaster($this->app->user()->getAttribute('user')->id());

                $this->page->addVar('title', 'Les suivis de ma classe');
                $this->page->addVar('description', 'Liste des suivis de la classe d\'un collaborateur de l\'ETML');
                $this->page->addVar('keywords', 'liste suivis classe');

                $this->page->addVar('follows', $follows);
            }
            else if (($this->app->user()->getAttribute('group') == 10)) {

                $manager = $this->managers->getManagerOf('Comment');
                // Récupère la liste de suivis concernant l'élève
                $follows = $manager->getListByMainMaster($this->app->user()->getAttribute('user')->profession_id);

                $this->page->addVar('title', 'Les suivis de mes classes');
                $this->page->addVar('description', 'Liste des suivis de la classe d\'un collaborateur de l\'ETML');
                $this->page->addVar('keywords', 'liste suivis classe');

                $this->page->addVar('follows', $follows);
            }
            else {
                $this->app->user()->setFlash('Vous n\'êtes pas un maître de classe', 'error');
                // Redirige l'utilisateur vers la page précédente
                $this->app->httpResponse()->redirect($request->httpReferer());
            }
        }
        else {
            $this->app->user()->setFlash('Vous devez vous authentifier', 'error');
            // Redirige l'utilisateur vers la page précédente
            $this->app->httpResponse()->redirect($request->httpReferer());
        }

     }
	 
	 function executeClassprint(HTTPRequest $request) {
        // On vérifie que l'utilisateur est authentifié
        if ($this->app->user()->isAuthenticated()) {

            // Charge le manager des classes
            $class_manager = $this->managers->getManagerOf('SchoolClass');
            // Récupère la classe de l'utilisateur authentifié
            $master_class = $class_manager->getUniqueByColleague($this->app->user()->getAttribute('user')->id());
			$right = $this->app->user()->getAttribute('right');
            // On Vérifie que ce soit quelqu'un qui ait les droits d'ajout
            if (@$right[FOLLOW] & ADD) {
				// Vérifie que ce soit un maître de classe
				if ($master_class ) {


					$manager = $this->managers->getManagerOf('Comment');
					// Récupère la liste de suivis concernant l'élève
					$follows = $manager->getListByMaster($this->app->user()->getAttribute('user')->id());

					$this->page->addVar('title', 'Les suivis de ma classe');
					$this->page->addVar('description', 'Liste des suivis de la classe d\'un collaborateur de l\'ETML');
					$this->page->addVar('keywords', 'liste suivis classe');

					$this->page->addVar('follows', $follows);
					}
					else if (($this->app->user()->getAttribute('group') == 10)) {

					$manager = $this->managers->getManagerOf('Comment');
					// Récupère la liste de suivis concernant l'élève
					$follows = $manager->getListByMainMaster($this->app->user()->getAttribute('user')->profession_id);

					$this->page->addVar('title', 'Les suivis de mes classes');
					$this->page->addVar('description', 'Liste des suivis de la classe d\'un collaborateur de l\'ETML');
					$this->page->addVar('keywords', 'liste suivis classe');

					$this->page->addVar('follows', $follows);
				}
				else {
					$this->app->user()->setFlash('Vous n\'êtes pas un maître de classe', 'error');
					// Redirige l'utilisateur vers la page précédente
					$this->app->httpResponse()->redirect($request->httpReferer());
				}
			}
        }
        else {
            $this->app->user()->setFlash('Vous devez vous authentifier', 'error');
            // Redirige l'utilisateur vers la page précédente
            $this->app->httpResponse()->redirect($request->httpReferer());
        }
    } 

	function executeAdd(HTTPRequest $request) {

        if($request->postsExists(array('content', 'student_id'))){
            // Vérifié que l'utilisateur soit authentifié
            if ($this->app->user()->isAuthenticated()) {

                // Récupère les droits de l'utilisateur
                $right = $this->app->user()->getAttribute('right');
                // Vérifie que l'utilisateur ait les droits d'ajout
                if(@$right[FOLLOW] & ADD) {
                    if (!$request->postsEmpty(array('content', 'student_id'))){
                        
						// Récupère les données de l'étudiant
                        $student = $this->managers->getManagerOf('Student')->getUnique($request->postData('student_id'));

                        /* si la personne connectee est le maitre de classe de l'élève alors
                           le suivi est considéré comme lu */
                        $setFollowUnread=   ($this->is_master($student)) ? 1 : 0;

                        // On encode les caractères spéciaux
                        $contentSpecial = htmlspecialchars($request->postData('content'));

                        // Vérifie que la requête nous ait retourné quelque chose
                        if ($student) {
                            // Récupère le manager du module Comment
                            $follows_manager = $this->managers->getManagerOf('Comment');
                            $follow = new Comment(array(
                                'content' => $contentSpecial,
                                'follow_type' => $request->postData('followType'),
                                'right' => $request->postData('right'),
                                'student_id' => $student->id(),
                                'colleague_id' => $this->app->user()->getAttribute('user')->id()));
                            $success = $follows_manager->add($follow, $setFollowUnread);

                            if ($success) {
                                $this->app->user()->setFlash('Le suivi a été ajouté', 'success');
                            } else {
                                $this->app->user()->setFlash('Une erreur c\'est produite lors de l\'ajout du suivi', 'error');
                            }
                        }
                        else {
                            $this->app->user()->setFlash('L\'élève spécifié n\'existe pas', 'error');
                        }
                    }
                    else {
                        $this->app->user()->setFlash('Il manque des données, vérifiez que vous avez rempli tous les champs');
                    }
                }
                else {
                    $this->app->user()->setFlash('Vous n\'avez pas le droit de faire ceci', 'error');
                }
            }
            else {
                $this->app->user()->setFlash('Vous devez vous authentifier', 'error');
            }
            // Redirige l'utilisateur vers la page précédente
            $this->app->httpResponse()->redirect($request->httpReferer());
        }
        else {
            // Redirige l'utilisateur vers une page de type 404
            $this->app->httpResponse()->redirect404();
        }
	 } //executeAdd


	 function executeEdit(HTTPRequest $request) {

         // On vérifie que l'utilisateur soit autentifié
         if ($this->app->user()->isAuthenticated()) {

             // on autorise l'édition du suivi que pour l'autheur du suivi, le Maître de classe
             // Le maître principal et le doyen de la profession, la direction les membre du conseil de direction et les administrateurs du soft
             $boolEdit = $this->isFollowEditable($request->getData('id'));

             if ($boolEdit) {

                 $followTypes = $this->managers->getManagerOf('Comment')->getFollowTypes();
                 $this->page()->addVar('followTypes', $followTypes);

                 // Supprime le template par defaut de la page
                 $this->page->setLayout();

                 $manager = $this->managers->getManagerOf('Comment');
                 $follow = $manager->getUnique($request->getData('id'));

                 // On vérifie que le suivi existe
                 if ($follow) {
                     $errors = '';

                     if($request->postExists('content')){
                         if (!$request->postEmpty('content')){

                             // Charge le manager des classes
                             $class_manager = $this->managers->getManagerOf('SchoolClass');
                             // Récupère la classe de l'utilisateur authentifié
                             $master_class = $class_manager->getUniqueByColleague($this->app->user()->getAttribute('user')->id());
                             // Cherge le manager des élèves
                             $student_manager = $this->managers->getManagerOf('Student');

                             // Récupère l'élève concerné par le suivi
                             $student = $student_manager->getUnique($follow->student_id());

                             // Vérifie si l'utilisateur identifié est le maître de classe de l'élève
                             $is_master =($this->is_master($student)) ? 1 : 0;

                             // check if colleague connected is the author of the follow
                             $is_author = ($this->app->user()->getAttribute('user')->id() == $follow->colleague_id()) ? 1 : 0;


                             // Récupère les droits de l'utilisateur
                             $right = $this->app->user()->getAttribute('right');

                             // Défini le droit de supression du suivi de l'utilisateur authentifié
                             $modify_right = 0;
                             if (@$right[FOLLOW] & MODIFY || $is_master || $is_author) {
                                 $modify_right = 1;
                             }

                             // On vérifie que l'utilisateur ait les droits de modification
                             if ($modify_right) {



                                 //on change le flag du check de suivi
                                 $checked=(($is_master or false) ? 1 : 0);

                                 $followUpdate = new Comment(array(
                                     'id' => $request->getData('id'),
                                     'content' => $request->postData('content'),
                                     'follow_type' => $request->postData('followType'),
                                     'right' => $request->postData('right'),
                                     'mod_colleague_id' => $this->app->user()->getAttribute('user')->id()
                                 ));
                                 $success = $manager->update($follow, $followUpdate,$checked);

                                 if ($success) {
                                     $this->app->user()->setFlash('Le suivi a été modifié', 'success');
                                 } else {
                                     $this->app->user()->setFlash('Une erreur c\'est produite lors de la modification du suivi', 'error');
                                 }
                             }
                             else {
                                 $this->app->user()->setFlash('Vous n\'avez pas le droit de faire ceci', 'error');
                             }

                         }
                         else {
                             $this->app->user()->setFlash('Il manque des données, vérifiez que vous avez rempli tous les champs');
                         }
                         // Redirige l'utilisateur à la page précédente
                         $this->app->httpResponse()->redirect($request->httpReferer());
                     }
                     // Envois les le suivi ainsi que l'id à la vue
                     $this->page->addVar('id', $request->getData('id'));
                     $this->page->addVar('follow', $follow);
                 }
                 else {
                     $this->app->user()->setFlash('Le suivi que vous essayez de modifier n\'existe pas', 'error');
                     // Redirige l'utilisateur vers la page précédente
                     $this->app->httpResponse()->redirect($request->httpReferer());
                 }

             }else{

                 $this->app->user()->setFlash('Vous n\'avez pas les autorisations nécessaire pour visualiser cette page', 'error');
             }
             $this->page->addVar('boolEdit', $boolEdit);
         }else{

             $this->app->user()->setFlash('Vous devez vous authentifier', 'error');
         }

    } //executeEdit

	 function executeView(HTTPRequest $request) {

         // Vérifié que l'utilisateur soit authentifié
         if ($this->app->user()->isAuthenticated()) {

             // on autorise la vue du suivi pour l'autheur du suivi, le Maître de classe, l'élève concerné
             // Le maître principal et le doyen de la profession, la direction les membre du conseil de direction et les administrateurs du soft
             $boolVisible = $this->isFollowVisible($request->getData('id'));

             if ($boolVisible) {

                 $follow = $this->managers->getManagerOf('Comment')->getUnique($request->getData('id'));

                 // Récupère les infos de l'élève concerné par le suivi
                 $student = $this->managers->getManagerOf('Student')->getUnique($follow->student_id());

                 // Vérifie si l'utilisateur identifié est le maître de classe de l'élève
                 $is_master =($this->is_master($student)) ? 1 : 0;

                 //on met à jour le check comme quoi on a bien lu le suivi seulement si on est le maître de classe de l'élève
				 if($is_master)
					$success = $this->managers->getManagerOf('Comment')->updateIsChecked($follow, $is_master);

                 $this->page->addVar('follow', $follow);

                 // Supprime le template par defaut de la page
                 $this->page->setLayout();
             } else {
                 $this->app->user()->setFlash('Vous n\'avez pas les autorisations nécessaire pour visualiser cette page', 'error');

             }
             $this->page->addVar('boolVisible', $boolVisible);
         }
         else{
             $this->app->user()->setFlash('Vous devez vous authentifier', 'error');
         }
    } //executeView



	 /***
     * --------------------------------------------------------
     * *** 			      executegetUnchecked           	***
     * --------------------------------------------------------
     *
     * ETML
     * Auteur 		: Dimitrios Lymberis
     * Date 		: 21.03.2017
     * Description 	: Récupère les infos du rattrapage passé en GET
     *
     * @param HTTPRequest $request
     * ---------------------------------------------------------
     */
    public function executeGetUnchecked(HTTPRequest $request) {

        $uncheckedFollow="";

        // on verifie que l'on a l'id du maitre de classe
        if ($request->getExists('id')) {

            $idMasterClass = $request->getData('id');
            $uncheckedFollow = $this->managers->getManagerOf('Comment')->getCountFollowUncheckedForMasterClassStudent($idMasterClass);

            header("Content-Type: application/json", true);
        }

        die (json_encode($uncheckedFollow));

    } //executegetUnchecked

	 function executeDelete(HTTPRequest $request) {
	 	if ($request->getExists('id')) {
            // On vérifie que l'utilisateur est authentifié
            if ($this->app->user()->isAuthenticated()) {

                // Récupère les droits de l'utilisateur
                $right = $this->app->user()->getAttribute('right');

    	 		$manager = $this->managers->getManagerOf('Comment');
                // Charge le manager des classes
                $class_manager = $this->managers->getManagerOf('SchoolClass');
                // Récupère la classe de l'utilisateur authentifié
                $master_class = $class_manager->getUniqueByColleague($this->app->user()->getAttribute('user')->id());
                // Cherge le manager des élèves
                $student_manager = $this->managers->getManagerOf('Student');

                // Récupère le suivi
                $follow = $manager->getUnique($request->getData('id'));
                // Récupère l'élève concerné par le suivi
                $student = $student_manager->getUnique($follow->student_id());

                // Vérifie si l'utilisateur identifié est le maître de classe de l'élève
                $is_master = (($master_class) && ($master_class[0]->id() == $student->school_class_id())) ? 1 : 0;

                // check if colleague connected is the author of the follow
                $is_author = ($this->app->user()->getAttribute('user')->id() == $follow->colleague_id()) ? 1 : 0;

                //Défini le droit de supression du suivi de l'utilisateur authentifié
                $delete_right = 0;
                /*if (@$right[FOLLOW] & DELETE) {
                    if(@!($right[FOLLOW] & SPECIFIC))     
                        $delete_right = 1;
                }*/
				
				if (@$right[FOLLOW] & DELETE || $is_author) {
					$delete_right = 1;
				}
				
                // Vérifie si l'utilisateur à le droit de le suprimmer
                if ($delete_right) {

                    //if (confirm('Voulez vous vraiment supprimer ce suivi ?')){
                        $success = $manager->delete($request->getData('id'));

                        if ($success) {
                            $this->app->user()->setFlash('Le suivi a été correctement supprimé', 'success');
                        } else {
                            $this->app->user()->setFlash('Une erreur c\'est produite lors de la suppression du suivi', 'error');
                        }

                        $this->app->httpResponse()->redirect($request->httpReferer());
                    //}
                }
                else {
                    $this->app->user()->setFlash('Vous n\'avez pas le droit de faire ceci', 'error');
                }
            }
            else {
                $this->app->user()->setFlash('Vous devez vous authentifier', 'error');
            }

            $this->app->httpResponse()->redirect($request->httpReferer());
        } else {
            $this->app->httpResponse()->redirect404();
        }
    }
	
	

    /***
     * @param $idFollow
     *
     *  Vérifie si la personne connectée à le droit de voir un suivi
     *
     * @return bool
     */
    private function isFollowVisible($Id_Follow){

		
        // Récupère la ou les classes de l'utilisateur authentifié
        $master_classes = $this->managers->getManagerOf('SchoolClass')->getUniqueByColleague($this->app->user()->getAttribute('user')->id());

        $manager = $this->managers->getManagerOf('Comment');
        $follow = $manager->getUnique($Id_Follow);

        // Récupère l'élève concerné par le suivi
        $student = $this->managers->getManagerOf('Student')->getUnique($follow->student_id());


        //on verifie les droits selon la personne qui s'est connectee
        //-----------------------------------------------------------

        // Vérifie si l'utilisateur identifié est le maître de classe de l'élève
        $is_master =false;
        foreach ($master_classes as $master_class){
            $is_master = $is_master || (($master_class->id() == $student->school_class_id()) ? 1 : 0);
        }
        // check if colleague connected is the author of the follow
        $is_author = ($this->app->user()->getAttribute('user')->id() == $follow->colleague_id()) ? 1 : 0;

        // Vérifie si l'utilisateur identifié est l'élève concerné par le suivi
        $is_student = ($this->app->user()->getAttribute('user')->id() == $follow->student_id()) ? 1 : 0;



        // la personne connectée est-elle le maitre principal  de l'eleve (selon sa profession)
        $isProfessionMainMaster  = (($this->app->user()->getAttribute('group') == GRP_MASTERCHIEF) &&  ($this->app->user()->getAttribute('user')->profession_id() == $student->profession_id())) ? 1 : 0;
        // est-ce le doyen ... de la profession
        $isProfessionDean  = (($this->app->user()->getAttribute('group') == GRP_DEAN) &&  ($this->app->user()->getAttribute('user')->profession_id() == $student->profession_id())) ? 1 : 0;

        // fait-il partie du groupe des administrateurs du programme
        $isAdministrator  = ($this->app->user()->getAttribute('group')== GRP_ADMINISTRATOR)? 1 : 0;
        // fait-il partie du groupe de la direction
        $isDirection  = ($this->app->user()->getAttribute('group') == GRP_DIRECTION) ? 1 : 0;
        // fait-il partie du groupe du conseil de direction
        $isInManagerBoard  = $this->app->user()->getAttribute('isInCD');


        // on autorise la vue du suivi pour l'autheur du suivi, le Maître de classe, l'élève concerné
        // Le maître principal et le doyen de la profession, la direction les membre du conseil de direction et les administrateurs du soft
        return $boolVisible = $is_master || $is_author || $is_student || $isProfessionMainMaster || $isProfessionDean || $isDirection || $isInManagerBoard || $isAdministrator;

    } //isFollowVisible

    /***
     * @param $idFollow
     *
     *  Vérifie si la personne connectée à le droit d'éditer un suivi
     *
     * @return bool
     */
    private function isFollowEditable($Id_Follow){

        // Récupère la ou les classes de l'utilisateur authentifié
        $master_classes = $this->managers->getManagerOf('SchoolClass')->getUniqueByColleague($this->app->user()->getAttribute('user')->id());

        $manager = $this->managers->getManagerOf('Comment');
        $follow = $manager->getUnique($Id_Follow);

        // Récupère l'élève concerné par le suivi
        $student = $this->managers->getManagerOf('Student')->getUnique($follow->student_id());


        //on verifie les droits selon la personne qui s'est connectee
        //-----------------------------------------------------------

        // Vérifie si l'utilisateur identifié est le maître de classe de l'élève
        $is_master =false;
        foreach ($master_classes as $master_class){
            $is_master = $is_master || (($master_class->id() == $student->school_class_id()) ? 1 : 0);
        }

        // check if colleague connected is the author of the follow
        $is_author = ($this->app->user()->getAttribute('user')->id() == $follow->colleague_id()) ? 1 : 0;

        // Vérifie si l'utilisateur identifié est l'élève concerné par le suivi
        $is_student = ($this->app->user()->getAttribute('user')->id() == $follow->student_id()) ? 1 : 0;



        // la personne connectée est-elle le maitre principal  de l'eleve (selon sa profession)
        $isProfessionMainMaster  = (($this->app->user()->getAttribute('group') == GRP_MASTERCHIEF) &&  ($this->app->user()->getAttribute('user')->profession_id() == $student->profession_id())) ? 1 : 0;
        // est-ce le doyen ... de la profession
        $isProfessionDean  = (($this->app->user()->getAttribute('group') == GRP_DEAN) &&  ($this->app->user()->getAttribute('user')->profession_id() == $student->profession_id())) ? 1 : 0;

        // fait-il partie du groupe des administrateurs du programme
        $isAdministrator  = ($this->app->user()->getAttribute('group')== GRP_ADMINISTRATOR)? 1 : 0;
        // fait-il partie du groupe de la direction
        $isDirection  = ($this->app->user()->getAttribute('group') == GRP_DIRECTION) ? 1 : 0;
        // fait-il partie du groupe du conseil de direction
        $isInManagerBoard  = $this->app->user()->getAttribute('isInCD');


        // on autorise la vue du suivi pour l'autheur du suivi, le Maître de classe, l'élève concerné
        // Le maître principal et le doyen de la profession, la direction les membre du conseil de direction et les administrateurs du soft
        return $boolEditable = ($is_master || $is_author ||  $isProfessionMainMaster || $isProfessionDean || $isDirection || $isInManagerBoard || $isAdministrator) and !$is_student;

    } //isFollowEditable


}
