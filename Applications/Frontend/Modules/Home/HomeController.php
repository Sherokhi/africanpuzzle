<?php
//*********************************************************
// Societe: ETML
// Auteur : Dimitrios Lymberis
// Date : 20.056.2019
// But : S'occupe de la page d'accueil principal du site
//*********************************************************
namespace Applications\Frontend\Modules\Home;

use Library\Sly\Controller\BackController;
use Library\Sly\Network\HTTPRequest;

class HomeController extends BackController
{
  public function executeIndexMaintenance(HTTPRequest $request) 
  {

        echo "Le site web d'African Puzzle est en cours de maintenance!";

  }

    public function executeIndex(HTTPRequest $request) 
    {
        //on vérifie si l'uilisateur est connecté 
        $isConnected =  (!$this->app->user()->isAuthenticated()? 0 : 1);

        $this->page->addVar('isConnected', $isConnected);

    }

   
}
