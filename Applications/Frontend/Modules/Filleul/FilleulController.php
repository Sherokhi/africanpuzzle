<?php
/********************************************************************************
 * Name:    PupilController.php
 * Author:  Sam Pache
 * Date:    13.05.2019
 * Goal:    Controller : Manage links between models and view for the pupils
 **********************************************************************************/

namespace Applications\Frontend\Modules\Filleul;

use Applications\Entities\Comment;
use Library\Sly\Controller\BackController;
use Library\Sly\Network\HTTPRequest;

class FilleulController extends BackController
{
    function getPupils() {
        return $this->managers->getManagerOf('Filleul')->getList();
    }

    function getPupilsWithAge() {
        $pupils = $this->getPupils();
        // Get pupils ages instead of birthdate
        foreach($pupils as $key => $value)
        {
            $dateArray = explode("-", $value['chiBirthDate']); // aaaa - mm - dd
            $chiYear = $dateArray[0];
            $actualYear = date("Y");
            $chiAge = $actualYear - $chiYear;

            $pupils[$key]['chiBirthDate'] = $chiAge;

        }
        return $pupils;
    }

    function getFiliationsPupils() {
        $pupils = $this->getPupils();
        foreach($pupils as $pupil)
        {
            $filiationsArray[] = $pupil['filName'];
        }

        // Make sure array is unique
        $filiations = array_unique($filiationsArray);
        return $filiations;
    }

    function getBuildingsPupils() {
        $pupils = $this->getPupils();

        foreach($pupils as $pupil)
        {
            $buildingArray[] = $pupil['buiState'];
        }

        // Make sure array is unique
        $buildings = array_unique($buildingArray);
        return $buildings;
    }

    function getFiliationsTotalTrainingCost() {
        $filiations = $this->getFiliationsPupils();
        $pupils = $this->getPupils();
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
        return $filiations;
    }

    function getTotByFiliations() {
        $totByFiliation=array();

        // total par filiation
        $nbrByFiliation = $this->managers->getManagerOf('Filleul')->getTotByFiliation();
        foreach($nbrByFiliation as $key => $value)
        {
            $totByFiliation[$key] =  $value;

        }
        return $totByFiliation;
    }

    function getTotByBuildings() {
        $pupils = $this->getPupils();
        $buildings = $this->getBuildingsPupils();
        // Set each values foreach buidings
        foreach($buildings as $building)
        {
            $totalTotInBuilding = 0;
            foreach($pupils as $pupil)
            {
                // If the pupil is in the filiation
                if($building == $pupil['buiState']){
                    $totalTotInBuilding++; // Add its training cost
                }
            }
            $totInBuilding[] = $totalTotInBuilding;
        }

        $buildings = array_combine($buildings, $totInBuilding);
        return $buildings;
    }



    function applyInterfaceVars() {
        $totByFiliation = $this->getTotByFiliations();
        $pupils = $this->getPupilsWithAge();
        $buildings = $this->getTotByBuildings();
        $filiations = $this->getFiliationsTotalTrainingCost();

        // total par filiation
        $this->page->addVar('totByFiliation', $totByFiliation);

        // Pupils list
        $this->page->addVar('pupils', $pupils);

        // Filiations names
        $this->page->addVar('filiations', $filiations);

        //Total in buildings
        $this->page->addVar('buildings', $buildings);
    }

    // Get and sort data for the main pupil page
    function executeIndex()
    {
        $errors = array();

        /* on vérifie qu'on a les bons droits .. c'est à dire qu'on fait partie du comité */
        if (!($this->app->user()->isAuthenticated() and ($this->app->user()->getAttribute('isInCD')))){

            $errors[0]="Vous nêtes pas autorisé à accéder à cette page !";
            $this->app->user()->setFlash($errors,'danger','Droits ');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }

        $this->applyInterfaceVars();

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
        if(!empty($pupils)) {
            foreach ($pupils as $pupil) {
                $filiationsArray[] = $pupil['filName'];
            }

            // Make sure filiations are unique
            $filiations = array_unique($filiationsArray);
            // Sort filiations costs
            foreach ($filiations as $filiation) {
                $totalTrainingCost = 0;
                foreach ($pupils as $pupil) {
                    if ($filiation == $pupil['filName']) {
                        $totalTrainingCost += $pupil['traCost'];
                    }
                }
                $trainingsCost[] = $totalTrainingCost;
            }
            // Filiation = Key, Cost = value
            $filiations = array_combine($filiations, $trainingsCost);
            // Sort pupils age instead of birth date
            foreach ($pupils as $key => $value) {
                $dateArray = explode("-", $value['chiBirthDate']); // aaaa - mm - dd
                $chiYear = $dateArray[0];
                $actualYear = date("Y");
                $chiAge = $actualYear - $chiYear;

                $pupils[$key]['chiBirthDate'] = $chiAge;
            }

            // Pupils list
            $this->page->addVar('pupils', $pupils);

            // Filiations names
            $this->page->addVar('filiations', $filiations);        // Do not use the template, only send $content
        }
        $this->page->setLayout();
        $this->page->setContentFile(__DIR__.DS.'Views'.DS.'filter.php');
    }


    // Execute the filters and sends the html data to the ajax function to update the page
    public function executeView(HTTPRequest $request)
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

        if($search !== '' && $buiState !== "" && $birthYear !== '') {
            // Execute the query
            $pupils = $this->managers->getManagerOf('Filleul')->getList();
        }
        else {
            // Execute the query
            $pupils = $this->managers->getManagerOf('Filleul')->filterList($search, $birthYear, $buiState);
        }
        // Sort pupils
        if(!empty($pupils)) {
            foreach ($pupils as $pupil) {
                $filiationsArray[] = $pupil['filName'];
            }

            // Make sure filiations are unique
            $filiations = array_unique($filiationsArray);
            // Sort filiations costs
            foreach ($filiations as $filiation) {
                $totalTrainingCost = 0;
                foreach ($pupils as $pupil) {
                    if ($filiation == $pupil['filName']) {
                        $totalTrainingCost += $pupil['traCost'];
                    }
                }
                $trainingsCost[] = $totalTrainingCost;
            }
            // Filiation = Key, Cost = value
            $filiations = array_combine($filiations, $trainingsCost);
            // Sort pupils age instead of birth date
            foreach ($pupils as $key => $value) {
                $dateArray = explode("-", $value['chiBirthDate']); // aaaa - mm - dd
                $chiYear = $dateArray[0];
                $actualYear = date("Y");
                $chiAge = $actualYear - $chiYear;

                $pupils[$key]['chiAge'] = $chiAge;
            }

            // Pupils list
            $this->page->addVar('pupils', $pupils);

            // Filiations names
            $this->page->addVar('filiations', $filiations);        // Do not use the template, only send $content
        }
        $this->page->setLayout();
        $this->page->setContentFile(__DIR__.DS.'Views'.DS.'view.php');
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
            $results['totByFiliation']=$this->getTotByFiliations();
            $results['totByBuilding']=$this->getTotByBuildings();
        }

        die(json_encode($results));
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
                if( substr($pupilPhoto, 0, 4) !== "http"){

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
                else {
                    $photoLinkParts = explode('/', $pupilPhoto);
                    $photoName = end($photoLinkParts);
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
            $results['totByFiliation']=$this->getTotByFiliations();
            $results['totByBuilding']=$this->getTotByBuildings();
        }
        die(json_encode($results));
    }

    function executeDelete(HTTPRequest $request) {
        $errors = array();

        /* on vérifie qu'on a les bons droits .. c'est à dire qu'on fait partie du comité */
        if (!($this->app->user()->isAuthenticated() and ($this->app->user()->getAttribute('isInCD')))){

            $errors[0]="Vous nêtes pas autorisé à accéder à cette page !";
            $this->app->user()->setFlash($errors,'danger','Droits ');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }

        $pupilId=$request->getData('id');

        $manager = $this->managers->getManagerOf('Filleul');
        $pupil = $manager->getPupildata($pupilId);
        $this->page->addVar('pupil', $pupil);

        $this->page->setLayout();
    }
    // Delete a pupil in the database
    public function executeDeleteSubmit(HTTPRequest $request)
    {
        $id = $request->getData('id');
        $manager = $this->managers->getManagerOf('Filleul');
        $pupil = $manager->getPupildata($id);

        $results=[];

        $this->page->addVar('pupil', $pupil);
        $this->managers->getManagerOf('Filleul')->deletePupil($id);

        $results['pupil']=$pupil['chiName']." ".$pupil['chiFirstName'];
        $results['totByFiliation']=$this->getTotByFiliations();
        $results['totByBuilding']=$this->getTotByBuildings();
        die(json_encode($results));
    }

    public function executeAddComment(HTTPRequest $request)
    {
        $errors = array();

        /* on vérifie qu'on a les bons droits .. c'est à dire qu'on fait partie du comité */
        if (!($this->app->user()->isAuthenticated() and ($this->app->user()->getAttribute('isInCD')))){

            $errors[0]="Vous nêtes pas autorisé à accéder à cette page !";
            $this->app->user()->setFlash($errors,'danger','Droits ');
            $this->app->httpResponse()->redirect($request->httpReferer());
        }
        $idChild = $request->getData('id');
        $this->page->addVar('idChild', $idChild);
        /* on affiche la page add.php  dans une popup modal */
        $this->page->setLayout();
    }

    // Delete a pupil in the database
    public function executeAddCommentSubmit(HTTPRequest $request)
    {
        $idChild = $request->getData('id');
        $commentMsg = $request->postData('comment');
        $commentManager = $this->managers->getManagerOf('Comment');
        $filleulManager = $this->managers->getManagerOf('Filleul');
        $comment  = new Comment();
        $comment->setComment($commentMsg);
        $comment->setStudent_id($idChild);
        $comment->setColleague_id($this->app->user()->getAttribute('user')->idUser());

        $pupil = $filleulManager->getPupildata($idChild);
        $commentManager->add($comment);

        $results=[];
        $results['msgErr']='';
        $results['msgTitle']="$commentMsg";
        $results['pupil']=$pupil['chiName']." ".$pupil['chiFirstName'];

        die(json_encode($results));
    }
}