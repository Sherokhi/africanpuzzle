<?php

namespace Applications\Entities;

use Library\Sly\Database\Entity;

class documentType extends Entity
{
    // It's public... because the json_encode method use the property itself... ACD / 10.2017
    public $name;
    public $description;
    public $metatype;

    public function setName() {
        if (is_string($name) && !empty($name)) {
            $this->name = $name;
        }
    }

    public function setDescription() {
        if (is_string($description) && !empty($description)) {
            $this->description = $description;
        }
    }

    public function name() { return $this->name; }
    public function description() { return $this->description; }
    public function metatype() { return $this->metatype; }
}
