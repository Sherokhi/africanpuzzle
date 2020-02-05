<?php

namespace Applications\Frontend\Modules\Historic;

use Library\Sly\Controller\BackController;
use Library\Sly\Network\HTTPRequest;

class HistoricController extends BackController
{
    public function executeIndex() {
        $this->page->addVar('title', 'Historique');
        $this->page->addVar('description', 'Historique de l\'application');
        $this->page->addVar('keywords', 'historique application');

        $manager = $this->managers->getManagerOf('Historic');
        $historics = $manager->getList();

        $this->page->addVar('historics', $historics);
    }
}
