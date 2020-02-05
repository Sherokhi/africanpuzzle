<?php
/**
 * PHP version 5
 *
 * This file is part of SlyWork.
 *
 * SlyWork is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SlyWork is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with SlyWork. If not, see <http://www.gnu.org/licenses/>.
 *
 * @author     Lanz Romain <lanz.romain@inosly.com>
 * @copyright  Copyright 2013 (c) InoSly - Lanz Romain <support@slywork.inosly.ch>
 * @version    13.3.20
 * @link       http://slywork.inosly.ch
 * @license    http://www.gnu.org/licenses/gpl.html
 */

namespace Library\Sly\Database;

abstract class Entity implements \ArrayAccess
{
    protected $errors = array();

    protected $id;

    public function __construct(array $data = array()) {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    public function hydrate(array $data) {
        foreach ($data as $attribut => $valeur) {
            $method = 'set'.ucfirst($attribut);

            if (is_callable(array($this, $method))) {
                $this->$method($valeur);
            }
        }
    }

    public function isNew() {
        return !empty($this->id);
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function offsetGet($var) {
        if (isset($this->$var) && is_callable(array($this, $var))) {
            $this->$var();
        }
    }

    public function offsetSet($var, $value) {
        $method = 'set'.ucfirst($var);

        if (isset($this->$var) && is_callable(array($this, $method))) {
            $this->$method($value);
        }
    }

    public function offsetExists($var) {
        return isset($this->$var) && is_callable(array($this, $var));
    }

    public function offsetUnset($var) {
        throw new \Exception('Impossible de supprimer quelconque valeur');
    }

    public function errors() { return $this->errors; }
    public function id() { return $this->id; }
}
