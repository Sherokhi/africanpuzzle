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
    function executeAddPupil(HTTPRequest $request) {

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

    // Add a pupil to the database
    public function executeAddSubmitPupil(HTTPRequest $request)
    {
        if($request->postExists('name'))
        {
            $name = $request->postData('name');
        }
        else
        {
            $name = "";
        }

        if($request->postExists('firstName'))
        {
            $firstName = $request->postData('firstName');
        }
        else
        {
            $firstName = "";
        }

        if($request->postExists('address'))
        {
            $address = $request->postData('address');
        }
        else
        {
            $address = "";
        }

        if($request->postExists('parentsName'))
        {
            $parentsName = $request->postData('parentsName');
        }
        else
        {
            $parentsName = "";
        }

        if($request->postExists('birthDate'))
        {
            $birthDate = $request->postData('birthDate');
        }
        else
        {
            $birthDate = "";
        }

        if($request->postExists('sponsor'))
        {
            $sponsor = $request->postData('sponsor');
        }
        else
        {
            $sponsor = "";
        }

        if($request->postExists('building'))
        {
            $building = $request->postData('building');
        }
        else
        {
            $building = "";
        }

        if($request->postExists('filiation'))
        {
            $filiation = $request->postData('filiation');
        }
        else
        {
            $filiation = "";
        }

        if($request->postExists('training'))
        {
            $training = $request->postData('training');
        }
        else
        {
            $training = "";
        }

        // Add the pupil to the database
        $this->managers->getManagerOf('Filleul')->addPupil($name, $firstName, $address, $parentsName, $birthDate, $building, $filiation, $training, $sponsor);
        die();
    }

    // Update a pupil in the database
    public function executeUpdatePupil(HTTPRequest $request)
    {
        if($request->postExists('id'))
        {
            $id = $request->postData('id');
        }
        else
        {
            $id = "";
        }

        if($request->postExists('name'))
        {
            $name = $request->postData('name');
        }
        else
        {
            $name = "";
        }

        if($request->postExists('firstName'))
        {
            $firstName = $request->postData('firstName');
        }
        else
        {
            $firstName = "";
        }

        if($request->postExists('address'))
        {
            $address = $request->postData('address');
        }
        else
        {
            $address = "";
        }

        if($request->postExists('parentsName'))
        {
            $parentsName = $request->postData('parentsName');
        }
        else
        {
            $parentsName = "";
        }

        if($request->postExists('birthDate'))
        {
            $birthDate = $request->postData('birthDate');
        }
        else
        {
            $birthDate = "";
        }

        if($request->postExists('sponsor'))
        {
            $sponsor = $request->postData('sponsor');
        }
        else
        {
            $sponsor = "";
        }

        if($request->postExists('building'))
        {
            $building = $request->postData('building');
        }
        else
        {
            $building = "";
        }

        if($request->postExists('filiation'))
        {
            $filiation = $request->postData('filiation');
        }
        else
        {
            $filiation = "";
        }

        if($request->postExists('training'))
        {
            $training = $request->postData('training');
        }
        else
        {
            $training = "";
        }

        // Update the pupil in the database
        $this->managers->getManagerOf('Filleul')->updatePupil($id, $name, $firstName, $address, $parentsName, $birthDate, $building, $filiation, $training, $sponsor);
        die();
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