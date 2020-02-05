<?php

namespace Applications\Frontend\Modules\Gestion;

use Library\Sly\Controller\BackController;
use Library\Sly\Network\HTTPRequest;

class GestionController extends BackController
{
    function executeIndex() {
        
        $users = $this->managers->getManagerOf('User')->getlist();
        
        $this->page->addVar('lstUsers', $users);
        
        $this->page->setLayout('gestion');
    }

    
}
