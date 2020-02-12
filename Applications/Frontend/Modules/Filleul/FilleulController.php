<?php
/********************************************************************************
 * Name:    PupilController.php
 * Author:  Sam Pache
 * Date:    13.05.2019
 * Goal:    Controller : Manage links between models and view for the pupils
 **********************************************************************************/

namespace Applications\Frontend\Modules\Filleul;

use Library\Sly\Controller\BackController;
use Library\Sly\Network\HTTPRequest;

class FilleulController extends BackController
{
    // Get and sort data for the main pupil page
    function executeIndex()
    {
        // Execute the queries
        $pupils = $this->managers->getManagerOf('Filleul')->getList();
        
        // Sort filiations in an array
        foreach($pupils as $pupil)
        {
            $filiationsArray[] = $pupil['filName'];
        }
        
        // Make sure filiations are unique
        $filiations = array_unique($filiationsArray);

        // Set each values foreach filiations
        foreach($filiations as $filiation)
        {
            $totalTrainingCost = 0;
            foreach($pupils as $pupil) 
            {
                // If the pupil is in the filiation
                if($filiation == $pupil['filName']){
                    $totalTrainingCost += $pupil['traCost']; // Add its training cost
                }
            }
            $trainingsCost[] = $totalTrainingCost;
        }

        // Filiation = Key, Cost = value
        $filiations = array_combine($filiations, $trainingsCost);

        // Get pupils ages instead of birthdate
        foreach($pupils as $key => $value)
        {
            $dateArray = explode("-", $value['chiBirthDate']); // aaaa - mm - dd
            $chiYear = $dateArray[0];
            $actualYear = date("Y");
            $chiAge = $actualYear - $chiYear;

            $pupils[$key]['chiBirthDate'] = $chiAge;
        }
        
        $totByFiliation=array();

        // total par filiation
        $nbrByFiliation = $this->managers->getManagerOf('Filleul')->getTotByFiliation();
        foreach($nbrByFiliation as $key => $value)
        {
            $totByFiliation[$key] =  $value;

        }

        // total par filiation
        $this->page->addVar('totByFiliation', $totByFiliation);

        // Pupils list
        $this->page->addVar('pupils', $pupils);

        // Filiations names
        $this->page->addVar('filiations', $filiations);

        $this->page->setLayout('gestion');
    }

    // Execute the filters and sends the html data to the ajax function to update the page
    public function executeFilter(HTTPRequest $request)
    {

        if($request->postExists('search'))
        {
            $search = $request->postData('search');
        }
        else
        {
            $search = "";
        }

        if($request->postExists('birthYear'))
        {
            $birthYear = $request->postData('birthYear');
        }
        else
        {
            $birthYear = "";
        }

        if($request->postExists('buiState'))
        {
            $buiState = $request->postData('buiState');
        }
        else
        {
            $buiState = "";
        }

        // Execute the query
        $pupils = $this->managers->getManagerOf('Filleul')->filterList($search, $birthYear, $buiState);

        // Sort pupils
        if(!empty($pupils))
        {
            foreach($pupils as $pupil)
            {
                $filiationsArray[] = $pupil['filName'];
            }
            
            // Make sure filiations are unique
            $filiations = array_unique($filiationsArray);

            // Sort filiations costs
            foreach($filiations as $filiation)
            {
                $totalTrainingCost = 0;
                foreach($pupils as $pupil) 
                {
                    if($filiation == $pupil['filName']){
                        $totalTrainingCost += $pupil['traCost'];
                    }
                }
                $trainingsCost[] = $totalTrainingCost;
            }

            // Filiation = Key, Cost = value
            $filiations = array_combine($filiations, $trainingsCost);

            // Sort pupils age instead of birth date
            foreach($pupils as $key => $value)
            {
                $dateArray = explode("-", $value['chiBirthDate']); // aaaa - mm - dd
                $chiYear = $dateArray[0];
                $actualYear = date("Y");
                $chiAge = $actualYear - $chiYear;

                $pupils[$key]['chiBirthDate'] = $chiAge;
            }

            // Pupils list
            $this->page->addVar('pupils', $pupils);

            // Filiations names
            $this->page->addVar('filiations', $filiations);
        }

        // Do not use the template, only send $content
        $this->page->setLayout();
        $this->page->setContentFile(__DIR__.DS.'Views'.DS.'filter.php');
    }

    // Get the data and set the modAddUpdatePupil modal
    public function executeGetPupilData(HTTPRequest $request)
    {
        if($request->getExists('idPupil'))
        {
            $idPupil = $request->getData('idPupil');
        }
        else
        {
            $idPupil = "";
        }

        // Execute the query
        $pupilData = $this->managers->getManagerOf('Filleul')->getPupilData($idPupil);
        die(json_encode($pupilData));
    }

    // Add display to submit a pupil
    function executeAdd(HTTPRequest $request) {
        $errors = array();

        /* on vérifie qu'on a les bons droits .. c'est à dire qu'on fait partie du comité */
        if (!($this->app->user()->isAuthenticated() and ($this->app->user()->getAttribute('isInCD')))){
            
            $errors[0]="Vous nêtes pas autorisé à accéder à cette page !";
            $this->app->user()->setFlash($errors,'danger','Droits ');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }
        $users = $this->managers->getManagerOf('User')->getList();
        $filiations = $this->managers->getManagerOf('Filiation')->getList();
        $trainings = $this->managers->getManagerOf('Training')->getList();
        $buildings = $this->managers->getManagerOf('Building')->getList();
        $this->page->addVar('users', $users);
        $this->page->addVar('filiations', $filiations);
        $this->page->addVar('trainings', $trainings);
        $this->page->addVar('buildings', $buildings);

        /* on affiche la page add.php  dans une popup modal */
            $this->page->setLayout();
    }

    // Add a pupil to the database
    public function executeAddSubmit(HTTPRequest $request)
    {
        
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
        
        
        if ($request->postExists("pupilData")){
            $pupilData =  json_decode($request->postData("pupilData"));
            $photoName = "x";
            if ($request->postExists('pupilPhoto'))
            {
                $pupilPhoto = $request->postData('pupilPhoto');
                if( substr($pupilPhoto, 0, 4) !=="http"){

                    $dataPhoto = $pupilPhoto;

                    $image_array_1 = explode(";", $dataPhoto);

                    $image_array_2 = explode(",", $image_array_1[1]);

                    $dataPhoto = base64_decode($image_array_2[1]);

                    $photoName = time() . '.png';
                    if ($photoName!=null){

                        //on place la photo dans le répertoire des utilisateurs
                        file_put_contents(IMAGES_FOLDER.FOLDER_IMG_FILLEUL.$photoName, $dataPhoto);
                    }
                }

            }
            if(isset($pupilData->name))
            {
                $name = $pupilData->name;
            }
            else
            {
                $name = "";
            }

            if(isset($pupilData->firstName))
            {
                $firstName = $pupilData->firstName;
            }
            else
            {
                $firstName = "";
            }

            if(isset($pupilData->address))
            {
                $address = $pupilData->address;
            }
            else
            {
                $address = "";
            }

            if(isset($pupilData->dadsName, $pupilData->mothersName))
            {
                $parentsName = $pupilData->dadsName.';'.$pupilData->mothersName;
            }
            else
            {
                $parentsName = "";
            }

            if(isset($pupilData->birthDate))
            {
                $birthDate = $pupilData->birthDate;
            }
            else
            {
                $birthDate = "";
            }

            if(isset($pupilData->sponsor))
            {
                $sponsor = $pupilData->sponsor;
            }
            else
            {
                $sponsor = "";
            }

            if(isset($pupilData->building))
            {
                $building = $pupilData->building;
            }
            else
            {
                $building = "";
            }

            if(isset($pupilData->filiation))
            {
                $filiation = $pupilData->filiation;
            }
            else
            {
                $filiation = "";
            }

            if(isset($pupilData->training))
            {
                $training = $pupilData->training;
            }
            else
            {
                $training = "";
            }
            // Add the pupil to the database
            $this->managers->getManagerOf('Filleul')->addPupil($name, $firstName, $address, $parentsName, $birthDate, $photoName,$building, $filiation, $training, $sponsor);
        }

        die(true);
    }

    // Add display to submit a pupil
    function executeUpdate(HTTPRequest $request) {
        $errors = array();

        /* on vérifie qu'on a les bons droits .. c'est à dire qu'on fait partie du comité */
        if (!($this->app->user()->isAuthenticated() and ($this->app->user()->getAttribute('isInCD')))){

            $errors[0]="Vous nêtes pas autorisé à accéder à cette page !";
            $this->app->user()->setFlash($errors,'danger','Droits ');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }
        $users = $this->managers->getManagerOf('User')->getList();
        $filiations = $this->managers->getManagerOf('Filiation')->getList();
        $trainings = $this->managers->getManagerOf('Training')->getList();
        $buildings = $this->managers->getManagerOf('Building')->getList();
        $pupilEdit = $this->managers->getManagerOf('Filleul')->getPupilData($request->getData('id'));
        $this->page->addVar('users', $users);
        $this->page->addVar('filiations', $filiations);
        $this->page->addVar('trainings', $trainings);
        $this->page->addVar('buildings', $buildings);
        $this->page->addVar('pupil', $pupilEdit);
        /* on affiche la page add.php  dans une popup modal */
        $this->page->setLayout();
    }
    // Update a pupil in the database
    public function executeUpdateSubmit(HTTPRequest $request)
    {
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


        if ($request->postExists("pupilData")){
            $pupilData =  json_decode($request->postData("pupilData"));
            $photoName = "x";
            if ($request->postExists('pupilPhoto'))
            {
                $pupilPhoto = $request->postData('pupilPhoto');
                if( substr($pupilPhoto, 0, 4) !=="http"){

                    $dataPhoto = $pupilPhoto;

                    $image_array_1 = explode(";", $dataPhoto);

                    $image_array_2 = explode(",", $image_array_1[1]);

                    $dataPhoto = base64_decode($image_array_2[1]);

                    $photoName = time() . '.png';
                    if ($photoName!=null){

                        //on place la photo dans le répertoire des utilisateurs
                        file_put_contents(IMAGES_FOLDER.FOLDER_IMG_FILLEUL.$photoName, $dataPhoto);
                    }
                }

            }
            if($request->postExists("idPupil"))
            {
                $id = $request->postData('idPupil');
            }
            else
            {
                $id = "";
            }
            if(isset($pupilData->name))
            {
                $name = $pupilData->name;
            }
            else
            {
                $name = "";
            }

            if(isset($pupilData->firstName))
            {
                $firstName = $pupilData->firstName;
            }
            else
            {
                $firstName = "";
            }

            if(isset($pupilData->address))
            {
                $address = $pupilData->address;
            }
            else
            {
                $address = "";
            }

            if(isset($pupilData->dadsName, $pupilData->mothersName))
            {
                $parentsName = $pupilData->dadsName.';'.$pupilData->mothersName;
            }
            else
            {
                $parentsName = "";
            }

            if(isset($pupilData->birthDate))
            {
                $birthDate = $pupilData->birthDate;
            }
            else
            {
                $birthDate = "";
            }

            if(isset($pupilData->sponsor))
            {
                $sponsor = $pupilData->sponsor;
            }
            else
            {
                $sponsor = "";
            }

            if(isset($pupilData->building))
            {
                $building = $pupilData->building;
            }
            else
            {
                $building = "";
            }

            if(isset($pupilData->filiation))
            {
                $filiation = $pupilData->filiation;
            }
            else
            {
                $filiation = "";
            }

            if(isset($pupilData->training))
            {
                $training = $pupilData->training;
            }
            else
            {
                $training = "";
            }
            // Add the pupil to the database
            $this->managers->getManagerOf('Filleul')->updatePupil($id, $name, $firstName, $address, $parentsName, $birthDate, $photoName,$building, $filiation, $training, $sponsor);
        }
        die(true);
    }

    // Delete a pupil in the database
    public function executeDeletePupil(HTTPRequest $request)
    {
        if($request->postExists('id'))
        {
            $id = $request->postData('id');
            $this->managers->getManagerOf('Filleul')->deletePupil($id);
            die();
        }
        else
        {
            die();
        }
    }
}