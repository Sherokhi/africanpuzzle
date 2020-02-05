<?php

namespace Applications\Models;

use Applications\Entities\Document;
use Library\Sly\Database\Manager;

abstract class DocumentManager extends Manager
{
    abstract public function getList();
    abstract public function getListOf($id);
    abstract public function getUnique($id);
    abstract public function add(Document $document);
    abstract public function modify(Document $document);
    abstract public function delete($id);

    public function save(Document $document) {
        $document->isNew() ? $this->modify($document) :  $this->add($document);
    }

}
