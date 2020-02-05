<?php

namespace Applications\Frontend\Modules\Document;

use Applications\Entities\Document;
use Library\Sly\Controller\BackController;
use Library\Sly\Network\HTTPRequest;

class DocumentController extends BackController
{
    private function is_master(&$student) {
        if (!$this->app->user()->isAuthenticated()) 
        { 
            return false; 
        }

        $tmp = @$this->managers->getManagerOf('SchoolClass')->getUniqueByColleague($this->app->user()->getAttribute('user')->id());
        if ($tmp == null) 
        {
            return false;
        } 
        else 
        {
            
            foreach ($tmp as $class){

                if ($student->school_class_id() == $class->id()){
                    return true;
                }
            }
            return false;
        }
    }

    public function executeIndex(HTTPRequest $request) {
        $student = $this->managers->getManagerOf('Student')->getUnique($request->getData('id'));
		
		$manager = $this->managers->getManagerOf('Colleague');
		$colleaguesRoles = $manager->getColleagueRoles($request->getData('id'));

        $is_administrator  = ($this->app->user()->getAttribute('group')== GRP_ADMINISTRATOR);
        $is_main_master  = ($this->app->user()->getAttribute('group')== GRP_MASTERCHIEF);
        $is_direction  = ($this->app->user()->getAttribute('group')== GRP_DIRECTION);

        $is_secretary = ($this->app->user()->getAttribute('group')== GRP_SECRETARY);

        $is_profession_conseil_direction = ($this->app->user()->getAttribute('user')->profession_id()== GRP_PROFESSSION_MANAGEMENTBOARD);

        $this->page->addVar('documentTypes', $this->managers->getManagerOf('documentType')->getList());
        $this->page->addVar('documentMeta', $this->managers->getManagerOf('documentType')->getMeta());


        if ($is_administrator || $this->is_master($student) || $colleaguesRoles <= 2 || $is_main_master || $is_direction ||  $is_profession_conseil_direction || $is_secretary) {
            $this->page->addVar('student', $student);

            $this->page->addVar('title', 'Téléversement de document');
            $this->page->addVar('description', 'Téléversement de document pour l\'élèves '.$student->first_name().' '.$student->name());
            $this->page->addVar('keywords', 'téléversment, upload, document, '.$student->first_name().', '.$student->name());
        } else {
            $this->app->user()->setFlash('Vous n\'avez pas accès à cette page', 'error');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }
    }

    public function executeUpload(HTTPRequest $request) {

        $student = $this->managers->getManagerOf('Student')->getUnique($request->getData('id'));
		$manager = $this->managers->getManagerOf('Colleague');
		$colleagueRoles = $manager->getColleagueRoles($request->getData('id'));

        $is_administrator  = ($this->app->user()->getAttribute('group')== GRP_ADMINISTRATOR);
        $is_main_master  = ($this->app->user()->getAttribute('group')== GRP_MASTERCHIEF);
        $is_direction  = ($this->app->user()->getAttribute('group')== GRP_DIRECTION);

        $is_profession_conseil_direction = ($this->app->user()->getAttribute('user')->profession_id()== GRP_PROFESSSION_MANAGEMENTBOARD);

        $is_secretary = ($this->app->user()->getAttribute('group')== GRP_SECRETARY);
		
		if(!file_exists(ROOT.DS.'Drive'.DS.'students'.DS.$student->entry_date()))
		{
			mkdir(ROOT.DS.'Drive'.DS.'students'.DS.$student->entry_date(), 0777, true);
			mkdir(ROOT.DS.'Drive'.DS.'students'.DS.$student->entry_date().DS.$student->id(), 0777, true);
		}
		elseif(!file_exists(ROOT.DS.'Drive'.DS.'students'.DS.$student->entry_date().DS.$student->id()))
		{
			mkdir(ROOT.DS.'Drive'.DS.'students'.DS.$student->entry_date().DS.$student->id(), 0777, true);
		}
		
        if ($is_administrator || $this->is_master($student) || $colleagueRoles <= 2 || $is_main_master || $is_direction || $is_profession_conseil_direction || $is_secretary)  {
            if (isset($_FILES['upl'])) {
                $this->page->setLayout();

                $file_id = $request->postData('file-id');

                if (!$request->postsEmpty(array('security-'.$file_id, 'description-'.$file_id, 'type-'.$file_id, 'student'))) {
                    $allowed_types = array ('pdf');
                    $max_size = 8388608; // 8Mb

                    $file_name = $_FILES['upl']['name'];
                    $file_type = $_FILES['upl']['type'];
                    $file_size = $_FILES['upl']['size'];
                    $file_tmp = $_FILES['upl']['tmp_name'];
                    $drive = ROOT.DS.'Drive'.DS.'students'.DS.$student->entry_date().DS.$student->id();

                    if (!in_array(substr(strrchr($file_name,'.'),1), $allowed_types)) {
                        echo '{"status":"error", "msg":"Le fichier n\'est pas au format PDF"}';
                        die;
                    }

                    // Vérification de la taille imposée - 8Mb
                    if ($file_size > $max_size) {
                        echo '{"status":"error", "msg":"La taille du fichier dépasse la limite imposée de 8Mb"}';
                        die;
                    }

                    $file  = basename($file_name, substr($file_name, strrpos($file_name, '.')));

                    // Remplacement des caractères  accentué
                    $file_name = strtr($file_name,
                                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

                    $i = 1;
                    while (file_exists($drive.DS.$file_name)) {
                        $file_name = $file.'_'.$i.'.pdf';
                        $i++;
                    }
                    unset($i);
					error_log($file_tmp, 0);
					
                    if (move_uploaded_file($file_tmp, $drive.DS.$file_name)) {
                        $document = new Document(array(
                        'title' => $file_name,
                        'description' => $request->postData('description-'.$file_id),
                        'add_date' => date('Y-m-d H:i:s'),
                        'size' => $file_size,
                        'right' => $request->postData('security-'.$file_id),
                        'student_id' => $request->postData('student'),
                        'colleague_id' => $this->app->user()->getAttribute('user')->id(),
                        'types_document_id' => $request->postData('type-'.$file_id),
                        ));
                        $this->managers->getManagerOf('Document')->save($document);

                        echo '{"status":"success"}';

                        error_log("Document".$file_name." ajouté avec succès pour l'élève ".$student->name()." ".$student->first_name());

                        $masterClass =  $this->managers->getManagerOf('Student')->getMasterClass($request->getData('id'));

                        error_log("Maitre de classe ".$masterClass->name()." ".$masterClass->first_name());

                         $professions = $this->managers->getManagerOf('Profession')->getListSection();

                        $professionsDetails=$this->managers->getManagerOf('Profession')->getListSectionDetails();

                        foreach($professionsDetails as $profession)
                        {
                            if($masterClass->profession_id() == $profession->id())
                            {
                                $emailDoyen = $profession->doyenMail();
                                error_log("Email doyen ".$emailDoyen);
                            }
                        }

                        $this->sendMailToMasterClass($student,$masterClass,$emailDoyen,$file_name);
                    }

                    die;
                }

                echo '{"status":"error"}';
            } else {
                $this->app->httpResponse()->redirect404();
            }
        } else {
            $this->app->user()->setFlash('Vous n\'avez pas accès à cette page ', 'error');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }
    }

    private function sendMailToMasterClass($student,$masterClass,$emailDoyen, $file_name)
    {



        // TEST SEND EMAIL
        $msg = "
        <html>
            <body>
              <p>Un nouveau document concernant un élève de votre classe a été ajouté dans <a href='".$this->base_url(TRUE)."'>Gestion Elèves.</a></p>
                <p><b>Titre : </b>".$file_name."</p>
                <p><b>Elève concerné: </b><a href='".$this->base_url(TRUE)."/student/".$student->id()."'>".$student->name()." ".$student->first_name()."</a></p>
                <p></p>
            </body>
         </html>";

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'Cc: '.$emailDoyen . "\r\n";

        if($masterClass->email() != null)
        {
            $mail_address = $masterClass->email();

            // send email
            $sent = mail($mail_address,"Nouveau document dans Gestion Eleves",$msg,$headers);

            error_log("Mail send to ".$mail_address." (with copy to ".$emailDoyen.") : ".$sent);
        }

    }
    public function executeEdit(HTTPRequest $request) {
        $document = $this->managers->getManagerOf('Document')->getUnique($request->getData('id'));
        $student = $this->managers->getManagerOf('Student')->getUnique($document->student_id());

        $is_administrator  = ($this->app->user()->getAttribute('group')== GRP_ADMINISTRATOR);

        $is_profession_conseil_direction = ($this->app->user()->getAttribute('user')->profession_id()== GRP_PROFESSSION_MANAGEMENTBOARD);

        $is_main_master  = ($this->app->user()->getAttribute('group')== GRP_MASTERCHIEF);

        if ($is_administrator  || $this->is_master($student) || $document->right() <= 2 || $is_profession_conseil_direction || $is_main_master ) {

            //if ($request->postsExists(array('name', 'description', 'security', 'type'))) {
        	if ($request->postsExists(array('name', 'description', 'type'))) {

                try {
                    $student = $this->managers->getManagerOf('Student')->getUnique($document->student_id());

                    if ($document) {
                        $new_document = new Document(array(
                            'id' => $document->id(),
                            'title' => $request->postData('name'),
                            'description' => $request->postData('description'),
                            'right' => $request->postData('security'),
                            'types_document_id' => $request->postData('type')
                        ));

                        $drive = ROOT.DS.'Drive'.DS.'students'.DS.$student->entry_date().DS.$student->id().DS.$new_document->title();
                        $file  = basename($new_document->title(), substr($new_document->title(), strrpos($new_document->title(), '.')));
                        $new_document->setTitle(strtr($new_document->title(), 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'));

                        $i = 1;
                        while (file_exists($drive.DS.$new_document->title())) {
                            $new_document->setTitle($file.'_'.$i.'.pdf');
                            $i++;
                        }
                        unset($i);


                        $this->managers->getManagerOf('Document')->save($new_document);
                        rename(ROOT.DS.'Drive'.DS.'students'.DS.$student->entry_date().DS.$student->id().DS.$document->title(), ROOT.DS.'Drive'.DS.'students'.DS.$student->entry_date().DS.$student->id().DS.$new_document->title());

                        $this->app->user()->setFlash('Document modifié avec succès', 'success');
                        $this->app->httpResponse()->redirect($request->httpReferer());
                    } else {
                        $this->app->httpResponse()->redirect404();
                    }
                } catch (\Exception $e) {
                    $this->app->user()->setFlash('Une erreur c\'est produite', 'error');
                    $this->app->httpResponse()->redirect($request->httpReferer());
                }
            } else {
                $this->page->setLayout();
                $this->page->addVar('types', $this->managers->getManagerOf('documentType')->getList());
                $this->page->addVar('document', $this->managers->getManagerOf('Document')->getUnique($request->getData('id')));
            }
        } else {
            $this->app->user()->setFlash('Vous n\'avez pas accès à cette page ', 'error');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }
    }

    public function executeDelete(HTTPRequest $request) {
        $document = $this->managers->getManagerOf('Document')->getUnique($request->getData('id'));
        $student = $this->managers->getManagerOf('Student')->getUnique($document->student_id());

        $is_administrator  = ($this->app->user()->getAttribute('group')== GRP_ADMINISTRATOR);

        if ( $is_administrator  ||  $this->is_master($student) || $document->right() <= 2) {

            try {
                $this->managers->getManagerOf('Document')->delete($request->getData('id'));
                unlink(ROOT.DS.'Drive'.DS.'students'.DS.$student->entry_date().DS.$student->id().DS.$document->title());
            } catch (\Exception $e) {
                $this->app->user()->setFlash('Une erreur c\'est produite', 'error');
                $this->app->httpResponse()->redirect($request->httpReferer());
            }

            $this->app->user()->setFlash('Document supprimé avec succès', 'success');
            $this->app->httpResponse()->redirect($request->httpReferer());
        } else {
            $this->app->user()->setFlash('Vous n\'avez pas accès à cette page', 'error');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }
    }

    public function executeAction(HTTPRequest $request) {
        $this->page->setLayout();
        $document = $this->managers->getManagerOf('Document')->getUnique($request->getData('id'));
        $this->page->addVar('document', $this->managers->getManagerOf('Document')->getUnique($request->getData('id')));
    }

    public function executeDownload(HTTPRequest $request) {
        $document = $this->managers->getManagerOf('Document')->getUnique($request->getData('id'));
        $student = $this->managers->getManagerOf('Student')->getUnique($document->student_id());

        $is_administrator  = ($this->app->user()->getAttribute('group')== GRP_ADMINISTRATOR);
        $is_student = ($document->student_id()   == $this->app->user()->getAttribute('user')->id());
        $is_author  = ($document->colleague_id() == $this->app->user()->getAttribute('user')->id());
        $is_teacher  = ($document->right()==2) ;
        $is_student_visible  = ($is_student && ($document->right()==1)) ;
        $_isMainMaster = ($this->app->user()->getAttribute('group')== 10);
        $_isDirection = ($this->app->user()->getAttribute('group')== 3);
        $_isDoyen = ($this->app->user()->getAttribute('group')== 9);

        $is_ok = $is_administrator || ($is_student_visible || $this->is_master($student) || $is_author || $_isMainMaster || $_isDirection || $_isDoyen || ($is_teacher and !$is_student )) ;


        if ( $is_ok) {            
            $this->page->setLayout();
            $drive = ROOT.DS.'Drive'.DS.'students'.DS.$student->entry_date().DS.$student->id().DS.$document->title();
            header("Content-type: application/force-download");
            header("Content-Length: ".filesize($drive));
            header("Content-Disposition: attachment; filename=".basename($drive));
            readfile($drive);
        } else {
            $this->app->user()->setFlash('Vous n\'avez pas accès à cette page', 'error');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }
    }

    public function executeView(HTTPRequest $request) {
        $document = $this->managers->getManagerOf('Document')->getUnique($request->getData('id'));
        $student = $this->managers->getManagerOf('Student')->getUnique($document->student_id());

        $is_administrator  = ($this->app->user()->getAttribute('group')== GRP_ADMINISTRATOR);
        $is_student = ($document->student_id()   == $this->app->user()->getAttribute('user')->id());
        $is_author  = ($document->colleague_id() == $this->app->user()->getAttribute('user')->id());
        $is_teacher  = ($document->right()==2) ;
        $is_student_visible  = ($is_student && ($document->right()==1)) ;
        $_isMainMaster = ($this->app->user()->getAttribute('group')== 10);
        $_isDirection = ($this->app->user()->getAttribute('group')== 3);
        $_isDoyen = ($this->app->user()->getAttribute('group')== 9);
        $is_profession_conseil_direction = ($this->app->user()->getAttribute('user')->profession_id()== GRP_PROFESSSION_MANAGEMENTBOARD);

        $is_ok = $is_administrator || ($is_student_visible || $this->is_master($student) || $is_author || $_isMainMaster || $_isDirection || $_isDoyen || ($is_teacher and !$is_student ) || $is_profession_conseil_direction) ;

        if ($is_ok) {
            $drive = ROOT.DS.'Drive'.DS.'students'.DS.$student->entry_date().DS.$student->id().DS.$document->title();
            header("Content-type: application/pdf");
            header("Content-Length: ".filesize($drive));
            readfile($drive);
        } else {
            $this->app->user()->setFlash('Vous n\'avez pas accès à cette page', 'error');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }
    }

     function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf( $tmplt, $http, $hostname, $end );
        }
        else $base_url = 'http://localhost/';

        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }

        return $base_url;
    }
}
