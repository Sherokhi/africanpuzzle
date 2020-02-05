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
 * @version    20130312
 * @link       http://slywork.inosly.ch
 * @license    http://www.gnu.org/licenses/gpl.html
 */

namespace Library\Sly\Network;

use Library\Sly\Core\ApplicationComponent;
use Library\Sly\Core\Page;

class HTTPResponse extends ApplicationComponent
{
    /**
     * @var Page
     */
    protected $page;


    /**
     * Ajoute un header spécifique
     *
     * @param String $header Header à ajouter
     * @version 20130120
     */
    public function addHeader($header) {
        header($header);
    }


    /**
     * Redirige l'utilisateur
     *
     * @param String $location Chemin de la page
     * @version 20130120
     */
    public function redirect($location) {
        header('Location: '.$location);
        exit;
    }


    /**
     * Redirige l'utilisateur sur une erreur 404
     *
     * @version 20130120
     */
    public function redirect404() {
        $this->page = new Page($this->app);
        $this->page->loadHelper();
        $this->page->setContentFile(ERROR_DIR.DS.'404.php');

        $this->addHeader('HTTP/1.0 404 Not Found');

        $this->send();
    }


    /**
     * Renvoie la réponse en générant la page
     *
     * @version 20130120
     */
    public function send() {
        $this->page->addVar('generateTime', round(microtime(true) - TIME_START, 4));
        exit($this->page->getGeneratedPage());
    }


    /**
     * Assigne une page
     *
     * @param Page $page Page à assigner
     * @version 20130120
     */
    public function setPage(Page $page) {
        $this->page = $page;
    }


    /**
     * Ajoute une Cookie
     *
     * @param String $name
     * @param
     * @version 20130120
     */
    public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true) {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }
}
