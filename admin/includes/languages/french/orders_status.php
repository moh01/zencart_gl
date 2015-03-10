<?php
//
// +----------------------------------------------------------------------+
// |zen-cart French Language Pack Updated by www fweb.biz                 |
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
//  $Id: orders_status.php 1105 2005-04-04 22:05:35Z birdbrain $
//

  define('HEADING_TITLE', 'Statut des Commandes');

  define('TABLE_HEADING_ORDERS_STATUS', 'Statut des Commandes');
  define('TABLE_HEADING_ACTION', 'Action');

  define('TEXT_INFO_EDIT_INTRO', 'Veuillez effectuer les changements requis');
  define('TEXT_INFO_ORDERS_STATUS_NAME', 'Statut des Commandes:');
  define('TEXT_INFO_INSERT_INTRO', 'Veuillez renseigner les Nouvelles Commandes et entrer les informations requises');
  define('TEXT_INFO_DELETE_INTRO', 'Etes-vous certain de vouloir effacer cette Commande ?');
  define('TEXT_INFO_HEADING_NEW_ORDERS_STATUS', 'Statut des Nouvelles Commandes');
  define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', 'Edition des Statuts des Commandes');
  define('TEXT_INFO_HEADING_DELETE_ORDERS_STATUS', 'Effacement des Statuts des Commandes');

  define('ERROR_REMOVE_DEFAULT_ORDER_STATUS', 'Erreur: ce statut de Commande par d&eacute;faut ne peut &ecirc;tre effac&eacute;. Veuillez s&eacute;lectionner un autre statut par d&eacute;faut et recommencer.');
  define('ERROR_STATUS_USED_IN_ORDERS', 'Erreur: ce statut de Commande est actuellement en cours d\'utilisation pour des Commandes.');
  define('ERROR_STATUS_USED_IN_HISTORY', 'Erreur: ce statut de Commande est actuellement en cours d\'utilisation dans le statut d\'Historique des Commandes.');
?>