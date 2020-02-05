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
 * @version    13.5.24
 * @link       http://slywork.inosly.ch
 * @license    http://www.gnu.org/licenses/gpl.html
 *
 *  Modifié le 05.10.2017 par Dimitrios Lymberis
 *  ajout construction des css et javascript de vendeur
 *
 */

namespace Library\Sly\Helper;

class HTMLHelper
{
    protected $css = null;
    protected $js = null;
    protected $cssMap = array();
    protected $v_cssMap = array();
    protected $jsMap = array();
    protected $v_jsMap = array();

    public function url($path = '') {
        return WWW_ROOT.$path;
    }

    /***
     *  retourne les heures et minute d'un champ time
     *  ex: 08:30:25 --> 08:30
     * @param $heure
     * @return string
     */
    public function hourMinute($heure) {
        // $heure de la forme hh:mm:ss
        // on enleve les secondes
        $arrayheure = explode(':',$heure);
        $newheure = $arrayheure[0].':'.$arrayheure[1];
        return $newheure; // de la forme hh:mm
    }


    /***
     * cette fonction permet de placer la bonne class CSS en fonction
     * des valeurs d'absences en pratique, théorie et arrivée tardives
     * pour l'affichage en 3 couleurs distinctes en fonction de bornes définies
     * dans bootstrap.php
     *
     * On retourne la couleur sous forme de nom de la class css
     *
     * @author     Dimitrios Lymberis
     * @param $absValue
     * @param $absType
     */
    public function SetClassColorStatAbsent($absValue,$absType){

        $classReturn="fa-color-green";

        switch ($absType) {
            case 'PT':
                if($absValue<ARR_STAT_RANGE['STAT_RANGE_STEP_ABS_1']){
                    $classReturn="fa-color-green";
                }
                elseif ($absValue>ARR_STAT_RANGE['STAT_RANGE_STEP_ABS_1'] && $absValue<ARR_STAT_RANGE['STAT_RANGE_STEP_ABS_2']){
                    $classReturn="fa-color-yellow";
                }else{
                    $classReturn="fa-color-red";
                }
                break;
            case 'AT':
                if($absValue<ARR_STAT_RANGE['STAT_RANGE_STEP_AT_1']){
                    $classReturn="fa-color-green";
                }
                elseif ($absValue>=ARR_STAT_RANGE['STAT_RANGE_STEP_AT_1'] && $absValue<ARR_STAT_RANGE['STAT_RANGE_STEP_AT_2']){
                    $classReturn="fa-color-yellow";
                }else{
                    $classReturn="fa-color-red";
                }
                break;
        }

        return $classReturn;

    } /* SetClassColorStatAbsent */

    public function modalbox($modalid,$title,$content,$footer)
    {
        $modal=('
        <div class="modal fade" id="'.$modalid.'" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true"> style="display:none;"
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ModalLabel">'.$title.'</h4>
              </div>
              <div class="modal-body">
                '.$content.'
              </div>
              <div class="modal-footer">
                '.$footer.'
              </div>
            </div>
          </div>
        </div>');

        return $modal;
    }

    public function optionmenu($links)
    {
        $intNbrLien = 0;
         $menu=(' <div id="wrap">
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                             <div class="logo">
                            <a href="/">ETML - Gestion Elèves</a>
                        </div>
                        <?php // Bouton en haut à droit de l\'écran  ?>
                        <a class="btn btn-navbar visible-phone visible-tablet" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                                <ul class="pull-right nav">
                                  
                                 <li class="dropdown">
                                        <a class="dropdown-toggle connect" data-toggle="dropdown" href="#">
                                            <i class="icon-wrench icon-white"></i>
                                            Options
                                        </a>
                               <ul class="dropdown-menu p10">
                                        ');

        
		for ($i=5; $i < count($links); $i++) 
        { 
            if(@$links[4][$links[3]] & $links[$i+4])
            {
                //défini la variable controller et object id à rien
                $controller="";
                $objectid="";

                //Vérifie si il y a un nom de controller ou un id d'objet
                if($links[0] != "")
                {
                    $controller=$links[0];
                }
                if($links[1] != "")
                {
                    $objectid='/'.$links[1];
                }

               //verifie si c'est un menu de type modalbox
               if($links[$i+2]=="Modal")
               {

                //creer le lien qui va ouvrir la modalbox
                //Ajoute les infos [$i] = nom de l'action [$i+1] = l'action a faire (p.e. modal) [$i+2] = l'id de la modalbox
                 $menu.=('  
                 <li>               
                    <a href="" data-toggle="modal" data-target="#'.$links[$i+3].'">
                      '.$links[$i].'
                    </a>
                    </li>
                ');
                
                

               }
               else if($links[$i+2]=="ModalPage")
               {

                //creer le lien qui va ouvrir une page dans la modalbox
                //Ajoute les infos [$i] = nom de l'action [$i+1] = l'action a faire (p.e. modal ou /add) [$i+2] = l'id de la modalbox
                 $menu.=('  
                 <li>               
                    <a href="'.WWW_ROOT.$controller.$objectid.''.$links[$i+1].'" data-toggle="modal" data-target="#'.$links[$i+3].'">
                      '.$links[$i].'
                    </a>
                    </li>
                ');
                

               }
               else
               {
                   
                    //Ajoute les infos [0]= nom du controlleur  [1] = ID de l'objet (class,eleves,etc...) [$i] = nom de l'action [$i+1] = l'action a faire (p.e. /add)
                    $menu.=('
                                <li>
                                    <a href="'.WWW_ROOT.$controller.$objectid.''.$links[$i+1].'">'.$links[$i].'</a>
                                </li>
                            ');
                   
                    //$menu.=$links[$i];
                }
                $intNbrLien++;
                $i+=4;
            }
            else
            {
                $i+=4;
            }
        }

        $menu.=('
                 </ul></li>
                                    <li>
                                        <a href="'.WWW_ROOT.'logout">
                                            <i class="icon-off icon-white"></i>
                                            Déconnexion
                                        </a>
                                    </li>
                 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            ');

            if($intNbrLien != 0)
            {
                return $menu;
            }
            
    }

    public function img($path) {
        if (empty($path))
            throw new \RuntimeException("Function img() can't have 0 or null argument");
        else
            return WWW_IMAGES.$path;
    }

    public function css($path,$vendor=false) {
        if (empty($path))
            throw new \RuntimeException("Function css() can't have 0 or null argument");
        else
			if($vendor)
				$this->cssMap[] = WWW_VENDOR.$path;
			else
				$this->cssMap[] = WWW_CSS.$path;
    }

    public function v_css($path,$vendor=false) {
        if (empty($path))
            throw new \RuntimeException("Function css() can't have 0 or null argument");
        else
			if($vendor)
					$this->v_cssMap[] = WWW_VENDOR.$path;
				else					
					$this->v_cssMap[] = WWW_CSS.$path;
    }

    public function js($path,$vendor=false) {
        if (empty($path))
            throw new \RuntimeException("Function js() can't have 0 or null argument");
        else
			if($vendor)
				$this->jsMap[] = WWW_VENDOR.$path;
			else
				$this->jsMap[] = WWW_JS.$path;
    }

    public function v_js($path,$vendor=false) {
        if (empty($path))
            throw new \RuntimeException("Function js() can't have 0 or null argument");
        else
			if($vendor)
				$this->v_jsMap[] = WWW_VENDOR.$path;
			else
				$this->v_jsMap[] = WWW_JS.$path;
    }

    public function display($type) {
        switch ($type) {
            case 'css':
                $j = count($this->cssMap);
                if (ONE_FILE_CSS == 'ON') {

                    for ($i = 0; $i < $j; $i++) {
                        $this->css .= file_get_contents($this->cssMap[$i]);
                    }

                    if (COMPRESS_CSS == 'ON') { $this->compress('css'); }

                    echo '<style type="text/css">'.$this->css.'</style>';
                } else {
                    for ($i = 0; $i < $j; $i++) {
                        echo '<link rel="stylesheet" type="text/css" href="'.$this->cssMap[$i].'">';
                    }

                    $j = count($this->v_cssMap);
                    for ($i = 0; $i < $j; $i++) {
                        echo '<link rel="stylesheet" type="text/css" href="'.$this->v_cssMap[$i].'">';
                    }
                }
                break;

            case 'js':
                $j = count($this->jsMap);
                if (ONE_FILE_JS == 'ON') {
                    for ($i = 0; $i < $j; $i++) {
                        $this->js .= file_get_contents($this->jsMap[$i]);
                    }

                    if (COMPRESS_JS == 'ON') { $this->compress('js'); }

                    echo '<script type="text/javascript">'.$this->js.'</script>';
                } else {

                    for ($i = 0; $i < $j; $i++) {
                        echo '<script type="text/javascript" src="'.$this->jsMap[$i].'"></script>';
                    }

                    $j = count($this->v_jsMap);
                    for ($i = 0; $i < $j; $i++) {
                        echo '<script type="text/javascript" src="'.$this->v_jsMap[$i].'"></script>';
                    }
                }
                break;
        }
    }

    public function compress($type) {
        switch ($type) {
            //return preg_replace(array('/ {2,}/', '/<!--.*?-->|\t|(?:\r?\n[\t]*)+/s'), array(' ', ''), $html);
            case 'css':
                $this->css = str_replace(array("\r","\n"), '', $this->css);
                $this->css = preg_replace('`([^*/])\/\*([^*]|[*](?!/)){5,}\*\/([^*/])`Us', '$1$3', $this->css);
                $this->css = preg_replace('`\s*({|}|,|:|;)\s*`', '$1', $this->css);
                $this->css = str_replace(';}', '}', $this->css);
                $this->css = preg_replace('`(?=|})[^{}]+{}`', '', $this->css);
                $this->css = preg_replace('`[\s]+`', ' ', $this->css);
                $this->css = preg_replace('#/\*(.*)\*/#isU','',$this->css);
                //$this->css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $this->css);
                //$this->css = preg_replace('/(\r\n|\n|\r|\t)/', '', $this->css);
                //$this->css = preg_replace(array('/ {2,}/', '/<!--.*?-->|\t|(?:\r?\n[\t]*)+/s'), array(' ', ''), $this->css);
                //$this->css = str_replace(array("\r\n","\r","\n","\t",'  ','    ','     '), '', $this->css);
                //$this->css = preg_replace(array('(( )+{)','({( )+)'), '{', $this->css);
                //$this->css = preg_replace(array('(( )+})','(}( )+)','(;( )*})'), '}', $this->css);
                //$this->css = preg_replace(array('(;( )+)','(( )+;)'), ';', $this->css);
                break;
            case 'js':
                    $this->js = preg_replace("/((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:\/\/.*))/", "", $this->js);
                    $this->js = str_replace(array("\r\n","\r","\t","\n",'  ','    ','     '), '', $this->js);
                    $this->js = preg_replace(array('(( )+\))','(\)( )+)'), ')', $this->js);
                break;
        }
    }
}
