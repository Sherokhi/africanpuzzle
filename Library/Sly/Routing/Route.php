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

namespace Library\Sly\Routing;

class Route
{
    /**
     * Action to execute
     *
     * @var String
     * @access protected
     */
    protected $action;

    /**
     * Module used
     *
     * @var String
     * @access protected
     */
    protected $module;

    /**
     * URL to parse
     *
     * @var String
     * @access protected
     */
    protected $url;

    /**
     * Variable's name
     *
     * @var array
     * @access protected
     */
    protected $varsNames;

    /**
     * Route's get variable
     *
     * @var array
     * @access protected
     */
    protected $vars = array();

    /**
     * Set values
     *
     * @param String $url URL to parse
     * @param String $module Module used
     * @param String $action Action to execute
     * @param Array $varsNames Variable's name
     * @access public
     * @return void
     */
    public function __construct($url, $module, $action, array $varsNames) {
        $this->setUrl($url);
        $this->setModule($module);
        $this->setAction($action);
        $this->setVarsNames($varsNames);
    }

    /**
     * Return the route's variables
     *
     * @access public
     * @return Variable's name
     */
    public function hasVars() {
        return !empty($this->varsNames);
    }

    /**
     * Match value with a regex
     *
     * @param String $url URL to match
     * @access public
     * @return Boolean success
     */
    public function match($url) {
        if (preg_match('`^'.dirname(dirname($_SERVER['SCRIPT_NAME'])).$this->url.'$`', $url, $matches) OR preg_match('`^'.$this->url.'$`', $url, $matches)) {
            return $matches;
        } else {
            return false;
        }
    }

    /**
     * Set $action
     *
     * @param String $action Action to execute
     * @access public
     * @return void
     */
    public function setAction($action) {
        if (is_string($action)) {
            $this->action = $action;
        }
    }

    /**
     * Set $module
     *
     * @param String $module Module to use
     * @access public
     * @return void
     */
    public function setModule($module) {
        if (is_string($module)) {
            $this->module = $module;
        }
    }

    /**
     * Set $url
     *
     * @param String $url URL to match
     * @access public
     * @return void
     */
    public function setUrl($url) {
        if (is_string($url)) {
            $this->url = $url;
        }
    }

    /**
     * Set $varsNames
     *
     * @param Array $varsName Variable's name
     * @access public
     * @return void
     */
    public function setVarsNames(array $varsNames) {
        $this->varsNames = $varsNames;
    }

    /**
     * Set $vars
     *
     * @param Array $vars Route's get variable
     * @access public
     * @return void
     */
    public function setVars(array $vars) {
        $this->vars = $vars;
    }

    /**
     * Getter's function
     */
    public function action() { return $this->action; }
    public function module() { return $this->module; }
    public function vars() { return $this->vars; }
    public function varsNames() { return $this->varsNames; }
}
