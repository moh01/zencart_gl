<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                                 |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: layout_controller.php 3197 2006-03-17 21:40:58Z drbyte $
//

  define('HEADING_TITLE', 'Blocs des Colonnes');

  define('TABLE_HEADING_LAYOUT_BOX_NAME', 'Nom du Bloc');
  define('TABLE_HEADING_LAYOUT_BOX_STATUS', 'Statut de la <br />COLONNE GAUCHE/<br />DROITE');
  define('TABLE_HEADING_LAYOUT_BOX_STATUS_SINGLE', 'Statut de la <br />COLONNE SEULE');
  define('TABLE_HEADING_LAYOUT_BOX_LOCATION', 'COLONNE<br />GAUCHE ou DROITE');
  define('TABLE_HEADING_LAYOUT_BOX_SORT_ORDER', 'Classement de la COLONNE<br />GAUCHE/<br />DROITE');
  define('TABLE_HEADING_LAYOUT_BOX_SORT_ORDER_SINGLE', 'Classement de la<br />COLONNE SEULE');
  define('TABLE_HEADING_ACTION', 'Action');

  define('TEXT_INFO_EDIT_INTRO', 'Veuillez effectuer les changements requis');
  define('TEXT_INFO_LAYOUT_BOX','Bloc S&eacute;lectionn&eacute;: ');
  define('TEXT_INFO_LAYOUT_BOX_NAME', 'Nom du Bloc:');
  define('TEXT_INFO_LAYOUT_BOX_LOCATION','Localisation: la seule Colonne ignore ce r&eacute;glage');
  define('TEXT_INFO_LAYOUT_BOX_STATUS', 'Statut: ');
  define('TEXT_INFO_LAYOUT_BOX_STATUS_SINGLE', 'Statut de la Colonne Seule: ');
  define('TEXT_INFO_LAYOUT_BOX_STATUS_INFO','ON = 1 OFF = 0');
  define('TEXT_INFO_LAYOUT_BOX_SORT_ORDER', 'Classement de la Colonne Gauche/Droite:');
  define('TEXT_INFO_LAYOUT_BOX_SORT_ORDER_SINGLE', 'Classement de la Colonne Seule:');
  define('TEXT_INFO_INSERT_INTRO', 'Veuillez entrer les informations du Nouveau Bloc et le contenu relatif');
  define('TEXT_INFO_DELETE_INTRO', 'Etes-vous certain de vouloir effacer ce Bloc ?');
  define('TEXT_INFO_HEADING_NEW_BOX', 'Nouveau Bloc');
  define('TEXT_INFO_HEADING_EDIT_BOX', 'Edition du Bloc');
  define('TEXT_INFO_HEADING_DELETE_BOX', 'Effacement du Bloc');
  define('TEXT_INFO_DELETE_MISSING_LAYOUT_BOX','Effacer le Bloc Manquant de la liste du Template: ');
  define('TEXT_INFO_DELETE_MISSING_LAYOUT_BOX_NOTE','NOTE: cette op&eacute;ration ne supprime pas le Fichier et il est possible de r&eacute;installer le Bloc ult&eacute;rieurement en l\'ajoutant au r&eacute;pertoire correpsondant.<br /><br /><strong>Effacer le Nom des Blocs: </strong>');
  define('TEXT_INFO_RESET_TEMPLATE_SORT_ORDER','Remettre &agrave; z&eacute;ro du Classement ORIGINAL des Blocs du Template: ');
  define('TEXT_INFO_RESET_TEMPLATE_SORT_ORDER_NOTE','Cette op&eacute;ration ne supprime pas les Blocs. Elle r&eacute;initialise seulement le Classement');
  define('TEXT_INFO_BOX_DETAILS','D&eacute;tails du Bloc: ');

////////////////

  define('HEADING_TITLE_LAYOUT_TEMPLATE', 'Mise en Page du Site');

  define('TABLE_HEADING_LAYOUT_TITLE', 'Titre');
  define('TABLE_HEADING_LAYOUT_VALUE', 'Valeur');
  define('TABLE_HEADING_ACTION', 'Action');


  define('TEXT_MODULE_DIRECTORY', 'R&eacute;pertoire de Mise en Page du Site:');
  define('TEXT_INFO_DATE_ADDED', 'Date d\'Ajout:');
  define('TEXT_INFO_LAST_MODIFIED', 'Dat de derni&egrave;re Modification:');

// layout box text in includes/boxes/layout.php
  define('BOX_HEADING_LAYOUT', 'Mise en Page');
  define('BOX_LAYOUT_COLUMNS', 'Contr&ocirc;le des Colonnes');

// file exists
  define('TEXT_GOOD_BOX',' ');
  define('TEXT_BAD_BOX','<font color="ff0000"><b>ABSENT</b></font><br />');


// Success message
  define('SUCCESS_BOX_DELETED','L\'Effacement du Template s\'est d&eacute;roul&eacute; avec succ&egrave;s pour le Bloc: ');
  define('SUCCESS_BOX_RESET','La Remise &agrave; z&eacute;ro tous les blocs &agrave; leur Valeur d\'Origine s\'est d&eacute;roul&eacute;e avec succ&egrave;s pour le Template: ');
  define('SUCCESS_BOX_UPDATED','L\'Actualisation a &eacute;t&eacute; r&eacute;alis&eacute;e avec succ&egrave;s pour le bloc: ');

  define('TEXT_ON',' ON ');
  define('TEXT_OFF',' OFF ');
  define('TEXT_LEFT',' GAUCHE ');
  define('TEXT_RIGHT',' DROITE ');

?>