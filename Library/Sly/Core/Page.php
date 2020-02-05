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

namespace Library\Sly\Core;

use Library\Sly\Helper\HTMLHelper;

class Page extends ApplicationComponent
{
    protected $contentFile;
    protected $layout = 'default';
    protected $vars = array();

    /**
     * HtmlHelper
     *
     * @var HtmlHelper
     * @access protected
     */
    protected $html;

    public function loadHelper() {
        $this->html = new HTMLHelper;
    }

    public function addVar($var, $value) {
        if (!is_string($var) || is_numeric($var) || empty($var)) {
            throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de caractère non nulle');
        }
        $this->vars[$var] = $value;
    }

    public function h($string) {
        return htmlentities($string, ENT_QUOTES, 'UTF-8');
    }

	
    public function getGeneratedPage() {



        if (!file_exists($this->contentFile)) {



            $this->app->httpResponse()->redirect404();
            throw new \RuntimeException('La vue spécifiée n\'existe pas');
        }

        $user = $this->app->user();

        extract($this->vars);

        ob_start();
        if ($this->layout !== null) {
            require $this->contentFile;
            $content = ob_get_clean();

            ob_start();

            require APP_DIR.DS.$this->app->name().DS.'Templates'.DS.$this->layout.'.php';
        } else {
            require $this->contentFile;
        }

        $page = ob_get_clean();

        if (COMPRESS_HTML == 'ON') {
            return $this->compress($page);
        } else {
            return $page;
        }
    }

    public function compress($html) {
        return preg_replace(array('/ {2,}/', '/<!--.*?-->|\t|(?:\r?\n[ \t]*)+/s'), array(' ', ''), $html);
    }

    public function setContentFile($contentFile) {
        if (!is_string($contentFile) || empty ($contentFile)) {
            throw new \InvalidArgumentException('La vue spécifiée est invalide');
        }

        $this->contentFile = $contentFile;
    }

    public function setLayout($name = null) {
        $this->layout = $name;
    }

    public function layout() { return $this->layout; }
    public function html() { return $this->html; }
}
