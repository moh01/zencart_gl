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
//  $Id: products_price_manager.php 543 2004-11-13 19:19:29Z wilt $
//

  define('HEADING_TITLE', 'Prix des Produits');
  define('HEADING_TITLE_PRODUCT_SELECT','Veuillez choisir une Cat&eacute;gorie de Produits...');

  define('TABLE_HEADING_PRODUCTS', 'Produits');
  define('TABLE_HEADING_PRODUCTS_MODEL','Mod&egrave;le');
  define('TABLE_HEADING_PRODUCTS_PRICE', 'Produits Prix/Promotion/Vente');
  define('TABLE_HEADING_PRODUCTS_PERCENTAGE','Pourcentage');
  define('TABLE_HEADING_AVAILABLE_DATE', 'Disponible');
  define('TABLE_HEADING_EXPIRES_DATE','Expire');
  define('TABLE_HEADING_STATUS', 'Statut');
  define('TABLE_HEADING_ACTION', 'Action');

  define('TEXT_PRODUCT_INFO', 'Info Produit:');
  define('TEXT_PRODUCTS_PRICE_INFO', 'Info Prix produit:');
  define('TEXT_PRODUCTS_MODEL','Mod&egrave;le:');
  define('TEXT_PRICE', 'Prix');
  define('TEXT_PRODUCT_AVAILABLE_DATE', 'Date de Disponibilit&eacute;:');
  define('TEXT_PRODUCTS_STATUS', 'Statut des Produits:');
  define('TEXT_PRODUCT_AVAILABLE', 'En Stock');
  define('TEXT_PRODUCT_NOT_AVAILABLE', 'Hors Stock');

  define('TEXT_PRODUCT_INFO_NONE', 'Veuillez s&eacute;lectionner un Produit...');
  define('TEXT_PRODUCT_IS_FREE','Le produit est GRATUIT:');
  define('TEXT_PRODUCTS_IS_FREE_EDIT','<br />*Le produit est marqu&eacute; GRATUIT');
  define('TEXT_PRODUCT_IS_CALL','Le Produit est en Prix Sur Demande:');
  define('TEXT_PRODUCTS_IS_CALL_EDIT','<br />*Le produit est marqu&eacute; PRIX SUR DEMANDE');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES','Prix des Produits Par Attributs:');
  define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE','Oui');
  define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE','Non');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT','<br />*Le Prix Affich&eacute; incluera les plus bas prix des Attributs plus le Prix');
  define('TEXT_PRODUCTS_MIXED','Qt&eacute; Min/Unit Mix:');
  define('TEXT_PRODUCTS_MIXED_DISCOUNT_QUANTITY', 'Les Remises par Qt&eacute; s\'appliquent aux Attributs Mixtes');

  define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL','Qt&eacute Minimum de Produits:');
  define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL','Qt&eacute de Produits en Unit&eacute;:');
  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL','Qt&eacute Maximum de Produits:');
  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT','0 = Illimit&eacute;<br />1 = Pas de Boxes Qt&eacute;/Valeur Max');

  define('TEXT_FEATURED_PRODUCT_INFO', 'Coup de Coeur:');
  define('TEXT_FEATURED_PRODUCT', 'Produit:');
  define('TEXT_FEATURED_EXPIRES_DATE', 'Date d\'Expiration:');
  define('TEXT_FEATURED_AVAILABLE_DATE', 'Date de Disponibilit&eacute;:');
  define('TEXT_FEATURED_PRODUCTS_STATUS', 'Statut du Coup de Coeur:');
  define('TEXT_FEATURED_PRODUCT_AVAILABLE', 'Actif');
  define('TEXT_FEATURED_PRODUCT_NOT_AVAILABLE', 'Inactif');
  define('TEXT_FEATURED_DISABLED', '<strong>NOTE: l\'Info des Coups de Coeur est actuellement d&eacute;sactiv&eacute;e, a expir&eacute; ou n\'a pas encore &eacute;t&eacute; activ&eacute;e</strong>');

  define('TEXT_SPECIALS_PRODUCT', 'Produit:');
  define('TEXT_SPECIALS_SPECIAL_PRICE', 'Prix Promotionnel Sp&eacute;cial:');
  define('TEXT_SPECIALS_EXPIRES_DATE', 'Date d\'Expiration:');
  define('TEXT_SPECIALS_AVAILABLE_DATE', 'Date de Disponibilit&eacute;:');
  define('TEXT_SPECIALS_PRICE_TIP', '<b>Notes Sp&eacute;ciales:</b><ul><li>Vous pouvez entrer un pourcentage &agrave; d&eacute;duire dans le champ du Prix des Promotions, par exemple: <b>20%</b></li><li>Si vous entrez un nouveau prix, le s&eacute;parateur de d&eacute;cimale doit &ecirc;tre un point \'.\' (point-d&eacute;cimale), exemple: <b>49.99</b></li><li>Laissez le champ de la date d\'expiration vide si aucune date de fin n\'est n&eacute;cessaire.</li></ul>');
  define('TEXT_SPECIALS_PRODUCT_INFO', 'Info Promotions:');
  define('TEXT_SPECIALS_PRODUCTS_STATUS', 'Statut des Promotions:');
  define('TEXT_SPECIALS_PRODUCT_AVAILABLE', 'Actif');
  define('TEXT_SPECIALS_PRODUCT_NOT_AVAILABLE', 'Inactif');
  define('TEXT_SPECIALS_NO_GIFTS','Pas de promotions sur les Ch&egrave;ques Cadeaux');
  define('TEXT_SPECIAL_DISABLED', '<strong>NOTE: l\'Info des Produits en promotion est d&eacute;sactiv&eacute;e, a expir&eacute; ou n\'a pas encore &eacute;t&eacute; activ&eacute;e</strong>');

  define('TEXT_INFO_DATE_ADDED', 'Date d\'Ajout:');
  define('TEXT_INFO_LAST_MODIFIED', 'Derni&egrave;re Modification:');
  define('TEXT_INFO_NEW_PRICE', 'Nouveau prix:');
  define('TEXT_INFO_ORIGINAL_PRICE', 'Prix Original:');
  define('TEXT_INFO_PERCENTAGE', 'Pourcentage:');
  define('TEXT_INFO_AVAILABLE_DATE', 'Disponible le:');
  define('TEXT_INFO_EXPIRES_DATE', 'Expire le:');
  define('TEXT_INFO_STATUS_CHANGE', 'Changement de Statut:');
  define('TEXT_IMAGE_NONEXISTENT', 'Aucune Image Existante');

  define('TEXT_INFO_HEADING_DELETE_FEATURED', 'Effacer le Coup de Coeur');
  define('TEXT_INFO_DELETE_INTRO', 'Etes-vous certain de vouloir effacer ce Coup de Coeur?');

  define('TEXT_ATTRIBUTES_INSERT_INFO', '<strong>D&eacute;finir les R&eacute;glages d\'Attribut et Envoyer</strong>');
  define('TEXT_PRICED_BY_ATTRIBUTES', 'Prix par Attribut');
  define('TEXT_PRODUCTS_PRICE', 'Prix du Produit: ');
  define('TEXT_SPECIAL_PRICE', 'Prix Promotionnel: ');
  define('TEXT_SALE_PRICE', 'Prix de Vente: ');
  define('TEXT_FREE', 'GRATUIT');
  define('TEXT_CALL_FOR_PRICE', 'PRIX SUR DEMANDE');

  define('TEXT_ADD_ADDITIONAL_DISCOUNT', 'Ajouter ' . DISCOUNT_QTY_ADD . ' Remises Suppl&eacute;mentaires par Quantit&eacute;:');
  define('TEXT_BLANKS_INFO','Toutes les Remises par Quantit&eacute; &eacute;gales &agrave; 0 seront supprim&eacute;es au moment de l\'Actualisation');
  define('TEXT_INFO_NO_DISCOUNTS', 'Aucune Remises par Quantit&eacute; n\'a &eacute;t&eacute; d&eacute;finie');
  define('TEXT_PRODUCTS_DISCOUNT_QTY_TITLE', 'Niveaux de Remises');
  define('TEXT_PRODUCTS_DISCOUNT','Remise');
  define('TEXT_PRODUCTS_DISCOUNT_QTY','Qt&eacute; Minimum ');
  define('TEXT_PRODUCTS_DISCOUNT_PRICE','Valeur de la Remise');
  define('TEXT_PRODUCTS_DISCOUNT_TYPE','Type');

  define('TEXT_PRODUCTS_DISCOUNT_PRICE_EACH','Calculer le Prix:');
  define('TEXT_PRODUCTS_DISCOUNT_PRICE_EXTENDED','Prix Etendu:');
  define('TEXT_PRODUCTS_DISCOUNT_PRICE_EACH_TAX','Calculer<br />le Prix: &nbsp; Taxes Comprises:');
  define('TEXT_PRODUCTS_DISCOUNT_PRICE_EXTENDED_TAX','Etendu<br />Prix: &nbsp; Taxes Comprises:');

  define('TEXT_EACH','ea.');
  define('TEXT_EXTENDED','total');

  define('TEXT_DISCOUNT_TYPE_INFO', 'Info Remise Produit');
  define('TEXT_DISCOUNT_TYPE','Type de Remise:');
  define('TEXT_DISCOUNT_TYPE_FROM', 'Prix Remis&eacute; depuis:');

  define('DISCOUNT_TYPE_DROPDOWN_0','Aucun');
  define('DISCOUNT_TYPE_DROPDOWN_1','Pourcentage');
  define('DISCOUNT_TYPE_DROPDOWN_2','Prix Actuel');
  define('DISCOUNT_TYPE_DROPDOWN_3','Montant remis&eacute;');

  define('DISCOUNT_TYPE_FROM_DROPDOWN_0','Prix');
  define('DISCOUNT_TYPE_FROM_DROPDOWN_1','Promotion');

  define('TEXT_UPDATE_COMMIT','Actualiser et Appliquer tous les Changements tels qu\'ils apparaissent &agrave; l\'&eacute;cran');

  define('TEXT_PRODUCTS_TAX_CLASS', 'Classe de Taxe:');

  define('TEXT_INFO_MASTER_CATEGORIES_ID_WARNING', '<strong>Attention:</strong> la Cat&eacute;gorie Principale de Produits ID# %s ne correspond pas &agrave; la Cat&eacute;gorie ID# %s et le Produit n\'est pas li&eacute; !');
  define('TEXT_INFO_MASTER_CATEGORIES_CURRENT', ' La Cat&eacute;gorie Actuelle ID# %s correspond &agrave; la Cat&eacute;gorie Principale ID# %s');
  define('TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE_TO_CURRENT', 'Actualiser les Cat&eacute;gories Principales ID# %s pour qu\'elles correspondent &agrave; la Cat&eacute;gorie Actuelle ID# %s');

  define('PRODUCT_WARNING_UPDATE', 'Veuillez effectuer les modifications et sauvegarder');
  define('PRODUCT_UPDATE_SUCCESS', 'Les Changements concernant les produits ont &eacute;t&eacute; sauvegard&eacute;s !');
  define('PRODUCT_WARNING_UPDATE_CANCEL', 'Les Changements ont &eacute;t&eacute; annul&eacute;s et n\'ont pas &eacute;t&eacute; sauvegard&eacute;s...');
  define('TEXT_INFO_EDIT_CAUTION', '<strong>Cliquez ICI pour lancer l\'Edition...</strong>');
  define('TEXT_INFO_PREVIEW_ONLY', 'Pr&eacute;visualisation Seulement ... Statut Actuel des Prix ... Pr&eacute;visualisation Seulement');
  define('TEXT_INFO_UPDATE_REMINDER', '<strong>Editez l\'Information Produit puis Actualisez pour sauvegarder</strong>');
?>