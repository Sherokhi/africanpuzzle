<?php

namespace Applications\Models;

use Applications\Entities\Document;

class DocumentManager_PDO extends DocumentManager
{
    public function getList() {
        $req = $this->dao->prepare('SELECT * FROM documents');
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\Document');

        $documents = $req->fetchAll();
        $req->closeCursor();

        return $documents;
    }

    public function getListOf($id) {
        /*$req = $this->dao->prepare('SELECT * FROM documents WHERE documents.student_id = :id');*/


        $req = $this->dao->prepare('SELECT documents.*, types_documents.`name` AS types_document_name  FROM types_documents, documents WHERE documents.student_id = :id  AND documents.types_document_id = types_documents.id');


        $req->bindValue(':id', $id);
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\Document');

        $documents = $req->fetchAll();
        $req->closeCursor();

        return $documents;
    }

    public function getUnique($id) {
        $req = $this->dao->prepare('SELECT documents.*, types_documents.`id` AS types_document_id, types_documents.`name` AS types_document_name
                                    FROM types_documents, documents
                                    WHERE documents.id = :id
                                    AND documents.types_document_id = types_documents.id');
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Applications\Entities\Document');

        $document = $req->fetch();
        $req->closeCursor();

        return $document;
    }

    public function add(Document $document) {

        $req = $this->dao->prepare('INSERT INTO documents (`title`, `description`, `add_date`, `size`, `right`, `student_id`, `colleague_id`, `types_document_id`)
                                    VALUES (:title, :description, :add_date, :size, :right, :student_id, :colleague_id, :types_document_id)');
        $req->bindValue(':title', $document->title());
        $req->bindValue(':description', $document->description());
        $req->bindValue(':add_date', date_format($document->add_date(), 'Y-m-d H:i:s'));
        $req->bindValue(':size', $document->size(), \PDO::PARAM_INT);
        $req->bindValue(':right', $document->right(), \PDO::PARAM_INT);
        $req->bindValue(':student_id', $document->student_id());
        $req->bindValue(':colleague_id', $document->colleague_id());
        $req->bindValue(':types_document_id', $document->types_document_id(), \PDO::PARAM_INT);
        $success = $req->execute();
        $req->closeCursor();

        return $success;
    }

    public function modify(Document $document) {
        $req = $this->dao->prepare('UPDATE documents SET documents.title = :title, documents.description = :description, documents.right = :right, documents.types_document_id = :types_document_id
        WHERE documents.id =:id;');
        $req->bindValue(':title', $document->title());
        $req->bindValue(':description', $document->description());
        $req->bindValue(':right', $document->right(), \PDO::PARAM_INT);
        $req->bindValue(':types_document_id', $document->types_document_id(), \PDO::PARAM_INT);
        $req->bindValue(':id', $document->id(), \PDO::PARAM_INT);

        $success = $req->execute();
        $req->closeCursor();

        return $success;
    }

    public function delete($id) {
        $req = $this->dao->prepare('DELETE FROM documents WHERE id = :id');
        $req->bindValue(':id', $id, \PDO::PARAM_INT);

        $success = $req->execute();
        $req->closeCursor();

        return $success;
    }
}
