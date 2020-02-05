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

namespace Library\Sly\User;

session_start();

class User extends UserSecurity
{
    public function getAttribute($attr) {
        return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
    }

    public function getFlash() {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);

        return $flash;
    }

    public function getFlashType() {
        $flashType = $_SESSION['flashType'];
        unset($_SESSION['flashType']);

        return $flashType;
    }

    public function getFlashTitle() {
        $flashTitle = $_SESSION['flashTitle'];
        unset($_SESSION['flashTitle']);

        return $flashTitle;
    }

    public function hasFlash() {
        return isset($_SESSION['flash']);
    }

    public function isAuthenticated() {
        return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
    }

    public function setAttribute($attr, $value) {
        $_SESSION[$attr] = $value;
    }

    public function unsetAttribute($attr) {
        unset($_SESSION[$attr]);
    }

    public function setAuthenticated($authenticated = true) {
        if (!is_bool($authenticated)) {
            throw new \InvalidArgumentsException('La valeur spécifiée à la méthode User::setAuthenticated doit être un boolean');
        }

        $_SESSION['auth'] = $authenticated;
    }

    public function setFlash($value, $type = 'info', $title='') {
        $_SESSION['flash'] = $value;
        $_SESSION['flashType'] = $type;
        $_SESSION['flashTitle'] = $title;
    }
}
