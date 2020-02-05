<?php

namespace Applications\Models;

use Applications\Entities\documentType;

class documentTypeManager_PDO extends documentTypeManager
{
    public function getList() {

        $req = $this->dao->prepare('SELECT * FROM types_documents');
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\documentType');

        $documentTypes = $req->fetchAll();
        $req->closeCursor();

        return $documentTypes;
    }

    public function getUnique($id) {
        $req = $this->dao->prepare('SELECT types_documents.*
                                        FROM types_documents
                                        WHERE types_documents.id = :id
                                        ORDER BY types_documents.name ASC');
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\documentType');

        $documentType = $req->fetch();
        $req->closeCursor();

        return $documentType;
    }

    public function getMeta()
    {
        $req = $this->dao->prepare('SELECT DISTINCT(metatype) FROM types_documents');
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\documentType');

        $documentMetaTypes = $req->fetchAll();
        $req->closeCursor();

        return $documentMetaTypes;

    }

    public function add(documentType $documentType) {

    }

    public function modify(documentType $documentType) {

    }

    public function delete($id) {

    }
}
