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

use Library\Sly\Config\Config;
use Library\Sly\Network\HTTPRequest;
use Library\Sly\Network\HTTPResponse;
use Library\Sly\Routing\Route;
use Library\Sly\Routing\Router;
use Library\Sly\User\User;

abstract class Application
{
    /**
     * User request
     *
     * @var HTTPRequest
     * @access protected
     */
    protected $httpRequest;

    /**
     * Server response
     *
     * @var HTTPResponse
     * @access protected
     */
    protected $httpResponse;

    /**
     * Web application's user
     *
     * @var User
     * @access protected
     */
    protected $user;


    /**
     * Application's configuration
     *
     * @var Config
     * @access protected
     */
    protected $config;

    /**
     * Application's name (Frontend/Backend)
     *
     * @var string
     * @access protected
     */
    protected $name;

    /**
     * Run the application
     *
     * @access public
     * @return void
     */
    abstract public function run();

    /**
     * Prepare the application to run
     *
     * @access public
     * @return void
     */
    public function __construct() {
        $this->config = new Config($this);
        $this->httpRequest = new HTTPRequest($this);
        $this->httpResponse = new HTTPResponse($this);
        $this->user = new User($this);
        $this->name = '';
    }

    /**
     * Search and load controller
     *
     * @access public
     * @return Controller
     */
    public function getController() {
        $router = new Router;

        //$xml = \DOMDocument::load(APP_DIR.DS.$this->name.'/Config/routes.xml');
        //$routes = $xml->getElementsByTagName('route');

        $xml = simplexml_load_file(APP_DIR.DS.$this->name.DS.'Config'.DS.'routes.xml');
        $routes = $xml->children();

        foreach ($routes as $route) {
            $vars = array();

            if (isset($route->attributes()->vars)) {
                $vars = explode(',', (string) $route->attributes()->vars);
            }

            $router->addRoute(new Route((string) $route->attributes()->url,
                                (string) $route->attributes()->module,
                                (string) $route->attributes()->action,
                                $vars));
        }

        try {
            $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
        } catch (\RuntimeException $e) {
            if ($e->getCode() == Router::NO_ROUTE) {
                $this->httpResponse->redirect404();
            }
        }

        $_GET = array_merge($_GET, $matchedRoute->vars());
        $controllerClass = 'Applications\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';
        $path = ROOT.DS.str_replace('\\', DS, $controllerClass).'.php';
        if (file_exists($path)) {
            return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
        } else {
            throw new \RuntimeException('Le module spécifié n\'existe pas');
        }
    }

    /* fonction utilisée pour le debug --> affichage d'un tableau 
       exemple d'utilisation : <?php echo $this->app()->debug($post); ?> 
    */
    public function debug($variable) {
        return '<pre>'.print_r($variable,true).'</pre>';
    }

    /***
     *
     * création d'un token de longueur $length selon le paramètre
     *
     *
     * @param  $length     longueur du token
     *
     * @return string  un token de longueur $length
     */
    public function str_random($length) {
        $alphabet="0123456789aqswyxcderfvbgtzhnujmkiolpAWSQYXCDERFVBGTZHNMJUIKLOP";

        return substr(str_shuffle(str_repeat($alphabet,$length)),0,$length);
    }
    
    /***
     *
     * fonction global vérifiant les droits selon la personne qui s'est connectée
     *
     *
     * @param null $idColleague     l'id du maître de classe d'un élève concerné
     * @param null $id_Profession   profession d'un élève concerné
     *
     * @return array  un tableau associatif indiquant
     *                  dans quel groupe se situe la personne connectée
     */
    public function getWhoIsConnect($idColleague=null,$id_Profession=null){

        // si on est pas connecté tout est à 0
        if($this->user()->getAttribute('user')  != null){

            // fait-il partie du groupe des administrateurs du programme
            $isAdministrator  = ($this->user()->getAttribute('group')== GRP_ADMINISTRATOR)? 1 : 0;
            // est-ce un doyen ... independament de la profession
            $isDoyen  = ($this->user()->getAttribute('group') == GRP_DEAN) ? 1 : 0;
            // fait-il partie du groupe de la direction
            $isDirection  = ($this->user()->getAttribute('group') == GRP_DIRECTION) ? 1 : 0;
            // fait-il partie du groupe des administrateurs du programme
            $isAdmin  = ($this->user()->getAttribute('group') == GRP_ADMINISTRATOR) ? 1 : 0;
            // fait-il partie du groupe des secrétaire
            $isSecretary  = ($this->user()->getAttribute('group') == GRP_SECRETARY) ? 1 : 0;
            // fait-il partie du groupe du conseil de direction
            $isInManagerBoard  = ($this->user()->getAttribute('group') == GRP_MANAGEMENTBOARD) ? 1 : 0;
            // est-il maître principal
            $isMasterChief =  ($this->user()->getAttribute('group') == GRP_MASTERCHIEF)  ? 1 : 0;
            // est-il le maître de classe d'un élève concerné
            $isMasterClass =  ($this->user()->getAttribute('user')->id() == $idColleague) ? 1 : 0;
            // la personne connectée est-elle le maitre principal  de l'eleve (selon sa profession)
            $isProfessionMainMaster  = ($isMasterChief &&  ($this->user()->getAttribute('user')->profession_id() == $id_Profession)) ? 1 : 0;
            // est-ce le doyen ... de la profession
            $isProfessionDean  = ( $isDoyen &&  ($this->user()->getAttribute('user')->profession_id() == $id_Profession)) ? 1 : 0;
            // attention !! les doyens d'une profession peuvent faire partie du conseil de direction,
            // ce qui les place plustôt dans le groupe conseil de direction qui prime sur doyen
            $isConseilDirection = ($this->user()->getAttribute('user')->profession_id()== GRP_PROFESSSION_MANAGEMENTBOARD)?1:0;
        }
        else{
            $isAdministrator=0;
            $isDoyen=0;
            $isDirection=0;
            $isAdmin=0;
            $isSecretary=0;
            $isInManagerBoard =0;
            $isMasterChief=0;
            $isMasterClass=0;
            $isProfessionMainMaster=0;
            $isProfessionDean=0;
            $isConseilDirection=0;
        }


        $arrwho_is_connect = [
            "isAdministrator" => $isAdministrator,
            "isDoyen" => $isDoyen,
            "isDirection" => $isDirection,
            "isAdmin" => $isAdmin,
            "isSecretary" =>$isSecretary,
            "isInManagerBoard" =>$isInManagerBoard,
            "isMasterChief"=>$isMasterChief,
            "isMasterClass"=>$isMasterClass,
            "isConseilDirection" => $isConseilDirection,
            "isProfessionMainMaster" => $isProfessionMainMaster,
            "isProfessionDean" => $isProfessionDean
        ];

        return $arrwho_is_connect;

    } //WhoIsConnect

    /**
     * Getter's function
     */
    public function httpRequest() { return $this->httpRequest; }
    public function httpResponse() { return $this->httpResponse; }
    public function name() { return $this->name; }
    public function user() { return $this->user; }
    public function config() { return $this->config; }
}
