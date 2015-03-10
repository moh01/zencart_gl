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
//  $Id: salemaker.php 1105 2005-04-04 22:05:35Z birdbrain $
//

  define('HEADING_TITLE', 'SaleMaker');
  define('TABLE_HEADING_SALE_NAME', 'Nom de la Vente');
  define('TABLE_HEADING_SALE_DEDUCTION', 'D&eacute;duction');
  define('TABLE_HEADING_SALE_DATE_START', 'Date de D&eacute;but');
  define('TABLE_HEADING_SALE_DATE_END', 'Date de Fin');
  define('TABLE_HEADING_STATUS', 'Statut');
  define('TABLE_HEADING_ACTION', 'Action');
  define('TEXT_SALEMAKER_NAME', 'Nom de la Vente:');
  define('TEXT_SALEMAKER_DEDUCTION', 'D&eacute;duction:');
  define('TEXT_SALEMAKER_DEDUCTION_TYPE', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type:&nbsp;&nbsp;');
  define('TEXT_SALEMAKER_PRICERANGE_FROM', 'Gamme de prix des Produits:');
  define('TEXT_SALEMAKER_PRICERANGE_TO', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
  define('TEXT_SALEMAKER_SPECIALS_CONDITION', 'Si un Produit est en Promotion:');
  define('TEXT_SALEMAKER_DATE_START', 'Date de D&eacute;but:');
  define('TEXT_SALEMAKER_DATE_END', 'Date de Fin:');
  define('TEXT_SALEMAKER_CATEGORIES', '<b>Ou</b> v&eacute;rifier les cat&eacute;gories auxquelles cette vente s\'applique:');
  define('TEXT_SALEMAKER_POPUP', '<a href="javascript:session_win();"><span class="errorText"><b>Cliquez ICI pour en savoir plus sur cette fonction.</b></span></a>');
  define('TEXT_SALEMAKER_POPUP1', '<a href="javascript:session_win1();"><span class="errorText"><b>(En Savoir Plus)</b></span></a>');
  define('TEXT_SALEMAKER_IMMEDIATELY', 'Imm&eacute;diatement');
  define('TEXT_SALEMAKER_NEVER', 'Jamais');
  define('TEXT_SALEMAKER_ENTIRE_CATALOG', 'Cochez cette box pour que la Vente concerne <b>Tous les Produits</b>:');
  define('TEXT_SALEMAKER_TOP', 'Tout le Catalogue');
  define('TEXT_INFO_DATE_ADDED', 'Date d\'ajout:');
  define('TEXT_INFO_DATE_MODIFIED', 'Derni&egrave;re Modification:');
  define('TEXT_INFO_DATE_STATUS_CHANGE', 'Dernier Changement de Statut:');
  define('TEXT_INFO_SPECIALS_CONDITION', 'Condition des Promotions:');
  define('TEXT_INFO_DEDUCTION', 'D&eacute;duction:');
  define('TEXT_INFO_PRICERANGE_FROM', 'Gamme de prix des Produits:');
  define('TEXT_INFO_PRICERANGE_TO', ' &agrave; ');
  define('TEXT_INFO_DATE_START', 'Commence:');
  define('TEXT_INFO_DATE_END', 'Expire:');
  define('SPECIALS_CONDITION_DROPDOWN_0', 'Ignorer le Prix des Promotions - Ignorer le Prix des Promotions - Appliquer aux Prix Boutique et Remplacer les Promotions');
  define('SPECIALS_CONDITION_DROPDOWN_1', 'Ignorer SaleMaker - Pas de SaleMaker (vente sp&eacute;ciale) lorsque le Produit est en Promotion');
  define('SPECIALS_CONDITION_DROPDOWN_2', 'Appliquer SaleMaker aux Prix Promotionnels - autrement, appliquer aux Prix Boutique');
// moved to french.php
/*
  define('DEDUCTION_TYPE_DROPDOWN_0', 'D&eacute;duire le montant');
  define('DEDUCTION_TYPE_DROPDOWN_1', 'Pourcentage');
  define('DEDUCTION_TYPE_DROPDOWN_2', 'Nouveau prix');
*/
  define('TEXT_INFO_HEADING_COPY_SALE', 'Copier la Vente');
  define('TEXT_INFO_COPY_INTRO', 'Entrez un nom pour la copie de<br>&nbsp;&nbsp;"%s"');
  define('TEXT_INFO_HEADING_DELETE_SALE', 'Effacement de la Vente');
  define('TEXT_INFO_DELETE_INTRO', 'Etes-vous certain de vouloir effacer d&eacute;finitivement cette Vente ?');
?>