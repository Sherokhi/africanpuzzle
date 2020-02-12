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
 * @version    13.3.18
 * @link       http://slywork.inosly.ch
 * @license    http://www.gnu.org/licenses/gpl.html
 */

// Make your bootstrap !


$debug = true;

date_default_timezone_set('Europe/Zurich');

if ($debug) {
	// Afficher les erreurs à l'écran
	ini_set('display_errors', 1);
	// Enregistrer les erreurs dans un fichier de log
	ini_set('log_errors', 1);
	// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
	ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
	// Afficher les erreurs et les avertissements
	error_reporting(E_ALL);
}


/* pour les absences */
//const WEEKDAY = array('Lundi','Mardi','Mercredi','Jeudi','Vendredi');

//const WEEKDAY = array('Lundi','Mardi','Mercredi','Jeudi','Vendredi');

define('WEEKDAY', serialize(array('Lundi','Mardi','Mercredi','Jeudi','Vendredi')));

/* pour affichage générique */
/* ------------------------ */
define ('LBL_DELEGATE', 'Délégué');
define ('LBL_ADJ_DELEGATE', 'Adjoint au délégué');
define ('LBL_MASTERCLASS', 'Maître de classe');


/* pour les statistiques */
/* --------------------- */

define('ARR_STAT_MAX', serialize(array('STAT_MAX_P'=> 100,'STAT_MAX_T' => 100,'STAT_MAX_PT' => 100, 'STAT_MAX_AT' => 12, 'STAT_MAX_MP' => 10, 'STAT_MAX_SU' => 50)));
define('ARR_STAT_RANGE', serialize(array('STAT_RANGE_STEP_ABS_1'=> 24,'STAT_RANGE_STEP_ABS_2' => 40, 'STAT_RANGE_STEP_AT_1' => 3,'STAT_RANGE_STEP_AT_2' => 6,'STAT_RANGE_STEP_SU_SAN_1' => 2,'STAT_RANGE_STEP_SU_SAN_2' =>4)));

/*

const ARR_STAT_MAX = array('STAT_MAX_P'=> 100,'STAT_MAX_T' => 100,'STAT_MAX_PT' => 100, 'STAT_MAX_AT' => 12, 'STAT_MAX_MP' => 10, 'STAT_MAX_SU' => 50);
const ARR_STAT_RANGE = array('STAT_RANGE_STEP_ABS_1'=> 24,'STAT_RANGE_STEP_ABS_2' => 40, 'STAT_RANGE_STEP_AT_1' => 3,'STAT_RANGE_STEP_AT_2' => 6,
                             'STAT_RANGE_STEP_SU_SAN_1' => 2,'STAT_RANGE_STEP_SU_SAN_2' =>4);
*/

/* serveur de développement ***
define ('DB_HOST', 'mysql:host=localhost');
define ('DB_NAME', 'gesteleves');
define ('DB_USER', 'gesteleves');
define ('DB_PWD',  'RxFMcGnoEJOBsEVj');
*/


/* serveur local */
define ('DB_HOST', 'mysql:host=localhost');
define ('DB_HOST_MYSQLI', 'localhost');
define ('DB_NAME', 'db_africanpuzzle');
define ('DB_USER', 'root');
define ('DB_PWD',  'root');

/* SRV LDAP */
define ('LDAP_IP', '172.16.20.25');
define ('LDAP_DOMAIN', '@etmlnet.local');
define ('LDAP_ROOT', 'DC=etmlnet, DC=local');

/* SRV LDAP TEST 
	login : administrateur
	mdp   : etmletml

define ('LDAP_IP', '172.16.9.6');
define ('LDAP_DOMAIN', '@test-inf.local');
define ('LDAP_ROOT', 'DC=test-inf, DC=local');
*/
define ('COLLEAGUE',        '1');
define ('DEBUG',            '2');
define ('DOCUMENT',         '3');
define ('GROUP',            '4');
define ('EVENT',            '5');
define ('PROFESSION',       '6');
define ('SCHOOLCLASS',      '7');
define ('STUDENT',          '8');
define ('HISTORIC',         '9');
define ('STUDENT_SUMMARY', '10');
define ('FOLLOW',          '11');
define ('NEWS',			   '12');

/* les groupes de collaborateur */
define ('ADMINISTRATOR',   '2');


/* Définition des groupes de collaborateur
   Attention doit être identique à ce qui se trouve dans 
   la table groupe de la base de données */
define ('GRP_DEVELOPER',   '6'); /* webadmin */
define ('GRP_DIRECTION',   '1');
define ('GRP_SECRETARY',   '2');
define ('GRP_COMPTABLE',   '3');
define ('GRP_SUPPLEANT',   '4');
define ('GRP_MEMBRE',   '5');  			

/* Définition des filiations
   Attention doit être identique à ce qui se trouve dans 
   la table t_filiation de la base de données */
define ('FIL_PRIMAIRE',   '0'); 
define ('FIL_SECONDAIRE',   '1');
 	

/* Définition des  rôles d'étudiants (tables roles */
define ('ROL_DELEGUE',   '64');		        /* délégué */
define ('ROL_ASSIST_DELEGUE',   '65');		/* assistant du délégué */

define ('VIEW_ALL', 0x01);
define ('ADD',      0x02);
define ('MODIFY',   0x04);
define ('DELETE',   0x08);
define ('SPECIFIC', 0x10);
define ('R_DEBUG',  0x20);

define ('ONE_FILE_CSS', 'OFF');
define ('ONE_FILE_JS', 'OFF');

//define ('DYNAMIC_CSS', 'OFF');
//define ('DYNAMIC_JS', 'OFF');

define ('CSS_FILE_NAME', 'etml.min');
define ('JS_FILE_NAME', 'etml.min');

define ('COMPRESS_HTML', 'ON');
define ('COMPRESS_CSS', 'OFF');
define ('COMPRESS_JS', 'OFF');

define ('PHOTO_WIDTH', 180);
define ('PHOTO_HEIGHT', 240);
define ('PHOTO_TMP_DELETE', 3);

//emplacement photo utilisateurs
define ('FOLDER_IMG_USER', 'users/');

//emplacement photo filleuls
define ('FOLDER_IMG_FILLEUL', 'filleuls/');
