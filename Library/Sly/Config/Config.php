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
 * @version    13.3.21
 * @link       http://slywork.inosly.ch
 * @license    http://www.gnu.org/licenses/gpl.html
 */

namespace Library\Sly\Config;

use Library\Sly\Core\ApplicationComponent;

class Config extends ApplicationComponent
{
    /**
     *
     */
    protected $vars = array();

    public function get($var) {
        if (!$this->vars) {
            //$xml = new \DOMDocument;
            //$xml->load(__DIR__.'/../Applications/'.$this->app->name().'/Config/app.xml');

            $xml = simplexml_load_file(APP_DIR.DS.$this->app->name().DS.'Config'.DS.'app.xml');

            //$elements = $xml->getElementsByTagName('define');
            $elements = $xml->children();

            foreach ($elements as $element) {
                $this->vars[(string)$element->attributes()->var] = $element->attributes()->value;
            }

            if (isset($this->vars[$var])) {
                return $this->vars[$var];
            }

        return null;
        }
    }
}
