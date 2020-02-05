<?php
/**
 * Application index
 *
 * PHP version 5
 *
 * This file is part of SlyWork®.
 *
 * SlyWork® is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SlyWork® is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with SlyWork®.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author     Lanz Romain <lanz.romain@gmail.com>
 * @copyright  Copyright 2013 © SlyDev - Lanz Romain
 * @version    20130303
 * @license    http://www.gnu.org/licenses/gpl.html
 *
 */

require_once ('../Applications/Bootstrap.php');
require_once ('../Library/Sly/Bootstrap.php');

require_once ('../Library/Sly/PHPMailer/src/PHPMailer.php');
require_once ('../Library/Sly/PHPMailer/src/SMTP.php');
require_once ('../Library/Sly/PHPMailer/src/Exception.php');


use Applications\Frontend\FrontendApplication;

$app = new FrontendApplication;
$app->run();
