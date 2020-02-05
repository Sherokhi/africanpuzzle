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

namespace Library\Sly\Routing;

class Router
{
    const NO_ROUTE = 1;

    /**
     * Routes of the application
     *
     * @var array of Route
     * @access protected
     */
    protected $routes = array();

    /**
     * Add a route to $routes
     *
     * @param Route $route Route to add
     * @access public
     * @return void
     */
    public function addRoute(Route $route) {
        if (!in_array($route, $this->routes)) {
            $this->routes[] = $route;
        }
    }

    /**
     *
     *
     * @param String $url url to parse
     * @access public
     * @return Route $route
     */
    public function getRoute($url) {
        foreach ($this->routes as $route) {

            if (($varsValues = $route->match($url)) != false) {

                if($route->hasVars()) {
                    $varsNames  = $route->varsNames();
                    $listVars   = array();

                    foreach ($varsValues as $key => $match) {
                        if ($key !== 0) {
                            $listVars[$varsNames[$key - 1]] = $match;
                        }
                    }
                    $route->setVars($listVars);
                }
                return $route;
            }
        }
        throw new \RuntimeException('Aucune route ne correspond à l\'url', self::NO_ROUTE);
    }
}
