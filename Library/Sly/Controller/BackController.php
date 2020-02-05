<?php
/**
 * PHP version 5
 *
 * This file is part of SlyWork.
 *
 * SlyWork® is free software: you can redistribute it and/or modify
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

namespace Library\Sly\Controller;

use Library\Sly\Core\Application;
use Library\Sly\Core\ApplicationComponent;
use Library\Sly\Core\Page;
use Library\Sly\Database\Managers;
use Library\Sly\Database\PDOFactory;

abstract class BackController extends ApplicationComponent
{
    /**
     * @var String
     */
    protected $action = '';


    /**
     * @var String
     */
    protected $module = '';


    /**
     * @var Page
     */
    protected $page = null;


    /**
     * @var String
     */
    protected $view = '';

    public function __construct(Application $app, $module, $action) {
        parent::__construct($app);

        if (USE_DATABASE == 'ON')
            $this->managers = new Managers('PDO', PDOFactory::getMysqlConnexion());
        $this->page = new Page($app);
        $this->page->loadHelper();

        $this->setModule($module);
        $this->setAction($action);
        $this->setView($action);
    }

    public function execute() {
        $method = 'execute'.ucfirst($this->action);

        if (!is_callable(array($this, $method))) {
            $this->app->httpResponse()->redirect404();
            //throw new \RuntimeException('L\'action "'.$this->action.'" n\'est pas définie dans ce module');
        }

        $this->$method($this->app->httpRequest());
    }

    public function in_object($pattern, $object, array $attrs, $type = 1) {
        $r = 0;
        switch ($type) {
            case 1:
                $j = count($attrs) - 1;
                foreach ($object as $obj) {
                    for ($i = 0; $i <= $j; $i++) {
                        $r |= ($pattern == $obj->$attrs[$i]());
                    }
                }
                return $r;

            case 2:
                $j = count($attrs) - 1;
                for ($i = 0; $i <= $j; $i++) {
                    $r |= ($pattern == $object->$attrs[$i]());
                }
            default:
                return null;
        }
    }

    public function setModule($module) {
        if (!is_string($module) || empty($module)) {
            throw new \InvalidArgumentException('Le module doit être une chaine de caractère valide');
        }

        $this->module = $module;
    }

    public function setAction($action) {
        if (!is_string($action) || empty($action)) {
            throw new \InvalidArgumentException('L\'action doit être une chaine de caractère valide');
        }

        $this->action = $action;
    }

    public function setView($view) {
        if (!is_string($view) || empty($view)) {
            throw new \InvalidArgumentException('La vue doit être une chaine de caractère valide');
        }

        $this->view = strtolower($view);

        $this->page->setContentFile(APP_DIR.DS.$this->app->name().DS.'Modules'.DS.$this->module.DS.'Views'.DS.$this->view.'.php');
    }

    public function page() { return $this->page; }
    public function module() { return $this->module; }
}
