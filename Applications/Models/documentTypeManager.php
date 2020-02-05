<?php

namespace Applications\Models;

use Applications\Entities\documentType;
use Library\Sly\Database\Manager;

abstract class documentTypeManager extends Manager
{
    abstract public function getList();
    abstract public function getMeta();
    abstract public function getUnique($id);
    abstract public function add(documentType $documentType);
    abstract public function modify(documentType $documentType);
    abstract public function delete($id);

    public function save(documentType $documentType) {
        $documentType->isNew() ? $this->modify($documentType) :  $this->add($documentType);
    }

}
