<?php
/**
 * Bootstrap of SlyWork
 *
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
 * @version    13.5.6
 * @link       http://slywork.inosly.ch
 * @license    http://www.gnu.org/licenses/gpl.html
 *
 * Modifié le 05.10.2017 par Dimitrios Lymberis
 * ajout de la possibilité de séparer les fichiers css et js de l'application d'avec des plugins vendeur
 *
 */

define('SLY_VERSION', '13.5.7');

/**
 * Get the time at the launch of application for
 * calculate the generation time.
 */
define('TIME_START', microtime(true));

/**
 * @see http://php.net/manual/en/errorfunc.constants.php
 */
if (!defined('E_DEPRECATED')) { define('E_DEPRECATED', 8192); }
if (!defined('E_USER_DEPRECATED')) { define('E_USER_DEPRECATED', E_USER_NOTICE); }

/**
 * @see http://php.net/manual/en/function.error-reporting.php
 */
error_reporting(E_ALL & ~E_DEPRECATED);

/**
 * DIRECTORY_SEPARATOR alias
 * Use the DS to separate the directories
 */
define('DS', DIRECTORY_SEPARATOR);

/**
 * Define if SlyWork compress your HTML
 */
if (!defined('COMPRESS_HTML')) { define('COMPRESS_HTML', 'ON'); }

/**
 * Define if SlyWork compress your CSS
 */
if (!defined('COMPRESS_CSS')) { define('COMPRESS_CSS', 'ON'); }

/**
 * Define if SlyWork compress your JS
 */
if (!defined('COMPRESS_JS')) { define('COMPRESS_JS', 'ON'); }

if (!defined('ONE_FILE_CSS')) { define('ONE_FILE_CSS', 'ON'); }
if (!defined('ONE_FILE_JS')) { define('ONE_FILE_JS', 'ON'); }

//if (!defined('DYNAMIC_CSS')) { define('DYNAMIC_CSS', 'OFF'); }
//if (!defined('DYNAMIC_JS')) { define('DYNAMIC_JS', 'OFF'); }

if (!defined('CSS_FILE_NAME')) { define('CSS_FILE_NAME', 'slywork.min'); }
if (!defined('JS_FILE_NAME')) { define('JS_FILE_NAME', 'slywork.min'); }

if (!defined('USE_DATABASE')) { define('USE_DATABASE', 'ON'); }

/**
 * Root directory of SlyWork
 */
define('ROOT', dirname(dirname(dirname(__FILE__))));

/**
 * Sly directory
 */
if (!defined('SLY')) { define('SLY', ROOT.DS.'Library'.DS.'Sly'.DS); }

/**
 * Application directory
 */
if (!defined('APP_DIR')) { define('APP_DIR', ROOT.DS.'Applications'); }

/**
 * Entity directory
 */
if (!defined('ENTITY_DIR')) { define('ENTITY_DIR', 'Applications'.DS.'Entities'); }

/**
 * Errors directory
 */
if (!defined('ERROR_DIR')) { define('ERROR_DIR', APP_DIR.DS.'Errors'); }

/**
 * Models directory
 */
if (!defined('MODEL_DIR')) { define('MODEL_DIR', 'Applications'.DS.'Models'); }

/**
 * Webroot directory
 */
if (!defined('WEBROOT')) { define('WEBROOT', ROOT.DS.'httpdocs'.DS); }

/**
 * CSS directory.
 */
if (!defined('CSS')) { define('CSS', WEBROOT.'css'.DS); }

/**
 * JavaScript directory.
 */
if (!defined('JS')) { define('JS', WEBROOT.'js'.DS); }

/**
 * Vendor directory.
 */
if (!defined('VENDOR')) { define('VENDOR', WEBROOT.'vendor'.DS); }


/**
 * Images directory.
 */
if (!defined('IMAGES')) { define('IMAGES', WEBROOT.'images'.DS); }

/**
 * Protocol
 */
define('HTTP', @$_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://');

/**
 * Web root directory
 */
if (dirname(dirname($_SERVER['SCRIPT_NAME'])) == '\\') {


    // ACD : 22.11.2017 : ProblĂ¨me si server_name ne finit pas par /
 
     $len = strlen($_SERVER['SERVER_NAME']);
 
     if(substr($_SERVER['SERVER_NAME'],$len-1,$len-1) != '/' )
     {
 
         define('WWW_ROOT', HTTP.$_SERVER['SERVER_NAME'].'/');
 
     }
     else
         define('WWW_ROOT', HTTP.$_SERVER['SERVER_NAME']);
 
 
 }
 else {
     define('WWW_ROOT', HTTP.$_SERVER['SERVER_NAME'].dirname(dirname($_SERVER['SCRIPT_NAME'])));
 }

/**
 * CSS Web directory.
 */
if (!defined('WWW_CSS')) { define('WWW_CSS', WWW_ROOT.'/css/');
}

/**
 * JavaScript Web directory.
 */
if (!defined('WWW_JS')) { define('WWW_JS', WWW_ROOT.'/js/'); }

/**
 * JavaScript Vendor directory.
 */
if (!defined('WWW_VENDOR')) { define('WWW_VENDOR', WWW_ROOT.'/plugins/'); }


/**
 * Images Web directory.
 */
if (!defined('WWW_IMAGES')) { define('WWW_IMAGES', WWW_ROOT.'/images/'); }

/**
 * Images folder directory.
 */
if (!defined('IMAGES_FOLDER')) { define('IMAGES_FOLDER', 'images/'); }

require_once SLY.'Core'.DS.'_autoload.php';
require_once SLY.'Core'.DS.'Application.php';
