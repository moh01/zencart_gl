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
//  $Id: specials.php 1105 2005-04-04 22:05:35Z birdbrain $
//

  define('HEADING_TITLE', 'Promotions');

  define('TABLE_HEADING_PRODUCTS', 'Produits');
  define('TABLE_HEADING_PRODUCTS_MODEL','Mod&egrave;le');
  define('TABLE_HEADING_PRODUCTS_PRICE', 'Produits Prix/promotion/Vente');
  define('TABLE_HEADING_PRODUCTS_PERCENTAGE','Pourcentage');
  define('TABLE_HEADING_AVAILABLE_DATE', 'Disponible');
  define('TABLE_HEADING_EXPIRES_DATE','Expire');
  define('TABLE_HEADING_STATUS', 'Statut');
  define('TABLE_HEADING_ACTION', 'Action');

  define('TEXT_SPECIALS_PRODUCT', 'Produit:');
  define('TEXT_SPECIALS_SPECIAL_PRICE', 'Prix Promotionnel Sp&eacute;cial:');
  define('TEXT_SPECIALS_EXPIRES_DATE', 'Date d\'Expiration:');
  define('TEXT_SPECIALS_AVAILABLE_DATE', 'Date de Disponibilit&eacute;:');
  define('TEXT_SPECIALS_PRICE_TIP', '<b>Notes Sp&eacute;ciales:</b><ul><li>Vous pouvez entrer un pourcentage &agrave; d&eacute;duire dans le champ du Prix des Promotions, par exemple: <b>20%</b></li><li>Si vous entrez un nouveau prix, le s&eacute;parateur de d&eacute;cimale doit &ecirc;tre un point \'.\' (point-d&eacute;cimale), exemple: <b>49.99</b></li><li>Laissez le champ de la date d\'expiration vide si aucune date de fin n\'est n&eacute;cessaire.</li></ul>');

  define('TEXT_INFO_DATE_ADDED', 'Date d\'Ajout:');
  define('TEXT_INFO_LAST_MODIFIED', 'Derni&egrave;re Modification:');
  define('TEXT_INFO_NEW_PRICE', 'Nouveau prix:');
  define('TEXT_INFO_ORIGINAL_PRICE', 'Prix Original:');
  define('TEXT_INFO_DISPLAY_PRICE', 'Afficher le Prix:<br />');
  define('TEXT_INFO_AVAILABLE_DATE', 'Disponible le:');
  define('TEXT_INFO_EXPIRES_DATE', 'Expire le:');
  define('TEXT_INFO_STATUS_CHANGE', 'Changement de Statut:');
  define('TEXT_IMAGE_NONEXISTENT', 'Aucune Image Existante');

  define('TEXT_INFO_HEADING_DELETE_SPECIALS', 'Effacement des Promotions');
  define('TEXT_INFO_DELETE_INTRO', 'Etes-vous certain de vouloir effacer le Prix des Produits en Promotion ?');

define('SUCCESS_SPECIALS_PRE_ADD', 'Successful: Pre-Add of Special ... please update the price and dates ...');
define('WARNING_SPECIALS_PRE_ADD_EMPTY', 'Warning: No Product ID specified ... nothing was added ...');
define('WARNING_SPECIALS_PRE_ADD_DUPLICATE', 'Warning: Product ID already on Special ... nothing was added ...');
define('TEXT_INFO_HEADING_PRE_ADD_SPECIALS', 'Manually add new Special by Product ID');
define('TEXT_INFO_PRE_ADD_INTRO', 'On large databases, you may Manually Add a Special by the Product ID<br /><br />This is best used when the page takes too long to render and trying to select a Product from the dropdown becomes difficult due to too many Products from which to choose.');
define('TEXT_PRE_ADD_PRODUCTS_ID', 'Please enter the Product ID to be Pre-Added: ');
define('TEXT_INFO_MANUAL', 'Product ID to be Manually Added as a Special');
?>