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
 * @version    13.3.26
 * @link       http://slywork.inosly.ch
 * @license    http://www.gnu.org/licenses/gpl.html
 */

namespace Library\Sly\Network;

use Library\Sly\Core\ApplicationComponent;

class HTTPRequest extends ApplicationComponent
{

    /**
     * Vérifie la présence d'un COOKIE. Dans le cas où le COOKIE
     * est présent, il est renvoyé, sinon, un NULL est renvoyé.
     *
     * @param String $key - Nom du COOKIE
     * @access public
     * @return COOKIE | Boolean - Si le COOKIE existe ou non
     */
    public function cookieData($key) {
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
    }


    /**
     * Vérifie la présence d'un COOKIE.
     *
     * @param String $key - Nom du COOKIE
     * @access public
     * @return Boolean - Si le COOKIE existe ou non
     */
    public function cookieExists($key) {
        return isset($_COOKIE[$key]);
    }

    public function cookiesExists($key = array()) {
        $r = array();
        foreach ($key as $val) {
            $r[] = isset($_COOKIE[$val]);
        }
        return $r;
    }


    /**
     * Vérifie la présence d'une variable GET. Dans le cas où la variable
     * est présente, elle est renvoyée, sinon, un NULL est renvoyé.
     *
     * @param String $key - Nom de la variable
     * @return Valeur | Boolean - Si la variable existe ou non
     * @version 20130120
     */
    public function getData($key) {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }


    /**
     * Vérifie la présence d'une variable GET.
     *
     * @param String $key - Nom de la variable
     * @return Boolean - Si la variable existe ou non
     * @version 20130120
     */
    public function getExists($key) {
        return isset($_GET[$key]);
    }

    public function getsExists($key = array()) {
        $r = 1;
        foreach ($key as $val) {
            $r &= isset($_GET[$val]);
        }
        return $r;
    }

    public function getEmpty($key) {
        return empty($_GET[$key]);
    }

    public function getsEmpty($key = array()) {
        $r = 0;
        foreach ($key as $val) {
            $r |= empty($_GET[$val]);
        }
        return $r;
    }


    /**
     * Vérifie la présence d'une variable POST. Dans le cas où la variable
     * est présente, elle est renvoyée, sinon, un NULL est renvoyé.
     *
     * @param String $key - Nom de la variable
     * @return Valeur | Boolean - Si la variable existe ou non
     * @version 20130120
     */
    public function postData($key) {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }


    /**
     * Vérifie la présence d'une variable POST.
     *
     * @param String $key - Nom de la variable
     * @return Boolean - Si la variable existe ou non
     * @version 20130120
     */
    public function postExists($key) {
        return isset($_POST[$key]);
    }

    public function postsExists($key = array()) {
        $r = 1;
        foreach ($key as $val) {
            $r &= isset($_POST[$val]);
        }
        return $r;
    }

    public function postEmpty($key) {
        return empty($_POST[$key]);
    }

    public function postsEmpty($key = array()) {
        $r = 0;
        foreach ($key as $val) {
            $r |= empty($_POST[$val]);
        }
        return $r;
    }

    public function fileData($key) {
        return isset($_FILES[$key]) ? $_FILES[$key] : null;
    }

    public function fileExists($key) {
        return isset($_FILES[$key]);
    }

    public function filesExists($key = array()) {
        $r = 1;
        foreach ($key as $val) {
            $r &= isset($_FILES[$val]);
        }
        return $r;
    }


    /**
     * Retourne la méthode de requête utilisée
     *
     * @return Méthode de requête utilisée
     * @version 20130120
     */
    public function method() {
        return $_SERVER['REQUEST_METHOD'];
    }


    /**
     * Retourne l'URL entrée
     *
     * @return URL entrée
     * @version 20130120
     */
    public function requestURI() {
        return $_SERVER['REQUEST_URI'];
    }

    public function httpReferer() {
        if (isset($_SERVER['HTTP_REFERER']))
            return $_SERVER['HTTP_REFERER'];
        else
            return WWW_ROOT;
    }

    public function httpHome()
    {

        return WWW_ROOT;

    }
}
