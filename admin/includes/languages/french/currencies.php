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
//  $Id: currencies.php 1105 2005-04-04 22:05:35Z birdbrain $
//

  define('HEADING_TITLE', 'Devises');

  define('TABLE_HEADING_CURRENCY_NAME', 'Devise');
  define('TABLE_HEADING_CURRENCY_CODES', 'Code');
  define('TABLE_HEADING_CURRENCY_VALUE', 'Valeur');
  define('TABLE_HEADING_ACTION', 'Action');

  define('TEXT_INFO_EDIT_INTRO', 'Veuillez effectuer les changements requis');
  define('TEXT_INFO_CURRENCY_TITLE', 'Titre:');
  define('TEXT_INFO_CURRENCY_CODE', 'Code:');
  define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Symbole &agrave; Gauche:');
  define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Symbole &agrave; Droite:');
  define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Point D&eacute;cimal:');
  define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'S&eacute;parateur de Milliers:');
  define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Places des D&eacute;cimales:');
  define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Derni&egrave;re Actualisation:');
  define('TEXT_INFO_CURRENCY_VALUE', 'Valeur:');
  define('TEXT_INFO_CURRENCY_EXAMPLE', 'Example:');
  define('TEXT_INFO_INSERT_INTRO', 'Veuillez renseigner la Nouvelle Devise');
  define('TEXT_INFO_DELETE_INTRO', 'Etes-vous certain de vouloir effacer cette Devise ?');
  define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Nouvelle Devise');
  define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Editer Devise');
  define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Effacer la Devise');
  define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . '  [actualisation manuelle des taux de change]');
  define('TEXT_INFO_CURRENCY_UPDATED', 'Le taux de change de %s (%s) est dor&eacute;navant actualis&eacute; via %s.');

  define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Erreur: la Devise par d&eacute;faut ne peut &ecirc;tre supprim&eacute;e. Veuillez fixer une autre devise par d&eacute;faut.');
  define('ERROR_CURRENCY_INVALID', 'Erreur: le taux de change de %s (%s) ne peut &ecirc;tre actualis&eacute; via %s. Le Code de la Devise est-il le bon ?');
  define('WARNING_PRIMARY_SERVER_FAILED', 'Erreur: &eacute;chec sur serveur primaire de (%s). Echec pour %s (%s) - tentative sur le serveur secondaire.');
?>