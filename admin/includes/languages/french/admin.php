<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: admin.php 1105 2005-04-04 22:05:35Z birdbrain $
//

  define('HEADING_TITLE', 'R&eacute;glages Admin');

  define('TABLE_HEADING_ADMINS_NAME', 'Nom Admin');
  define('TABLE_HEADING_ADMINS_ID', 'ID');
  define('TABLE_HEADING_ADMINS_EMAIL', 'E-mail');
  define('TABLE_HEADING_ACTION', 'Action');

  define('TEXT_HEADING_NEW_ADMIN', 'Nouveau');
  define('TEXT_HEADING_EDIT_ADMIN', 'Editer');
  define('TEXT_HEADING_DELETE_ADMIN', 'Effacer');
  define('TEXT_HEADING_RESET_PASSWORD', 'Nouveau Mot de Passe');

  define('TEXT_ADMINS', 'Admin:');
  define('TEXT_ADMINS_EMAIL', 'E-mail:');

  define('TEXT_NEW_INTRO', 'Veuillez renseigner les informations requises pour ce nouvel Admin');
  define('TEXT_EDIT_INTRO', 'Veuillez effectuer les changements requis');

  define('TEXT_ADMINS_NAME', 'Nom Admins:');
  define('TEXT_ADMINS_PASSWORD', 'Mot de Passe:');
  define('TEXT_ADMINS_CONFIRM_PASSWORD', 'Confirmation du Mot de Passe:');

  define('TEXT_DELETE_INTRO', 'Etes-vous certain de vouloir effacer cet Admin ?');
  define('TEXT_DELETE_IMAGE', 'Effacer l\'image d\'Admins ?');


  define('ENTRY_PASSWORD_NEW_ERROR', 'Votre Nouveau Mot de Passe doit contenir un minimum de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caractères');
  define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'La Confirmation et votre Mot de Passe doivent correspondre.');

  define('TEXT_ADMINS_LEVEL','Niveau de cet Admin:');
  define('TEXT_ADMIN_LEVEL_INSTRUCTIONS','Un r&eacute;glage d\'Admin sur 1 autorisera cet Admin &agrave; utiliser les fonctions d\'effacement lorsque Admin Demo sera activ&eacute;. Seul un niveau 1 aura la possibilit&eacute; de modifier le Login/Mot de Passe lorsque Admin Demo sera activ&eacute;.');
  define('TEXT_ADMIN_DEMO','Le mode Admin Demo transforme la fonction Admin en une fonction semi-fonctionnelle, afin de s&eacute;curiser l\'Administration du site lors de pr&eacute;sentations publiques. Seuls les Logins de Niveau 1 ont la possibilit&eacute; de modifier ce r&eacute;glage et ils conservent la ma&icirc;trise totale de l\'Administration lorsque le mode Admin Demo est actif.<br />Assurez-vous d\'avoir d&eacute;fini un login de d&eacute;mo de niveau z&eacute;ro (0) avant d\'activer ce r&eacute;glage');
  define('TEXT_DEMO_STATUS','Le mode Admin Demo est sur:');
  define('TEXT_DEMO_OFF','Off');
  define('TEXT_DEMO_ON','On');
?>