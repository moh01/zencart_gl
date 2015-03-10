<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
//  $Id: product.php 2830 2006-01-10 17:13:18Z birdbrain $
//

  define('HEADING_TITLE', 'Cat&eacute;gories / Produits');
  define('HEADING_TITLE_GOTO', 'Aller &agrave;:');

  define('TABLE_HEADING_ID', 'ID');
  define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Cat&eacute;gories / Produits');
  define('TABLE_HEADING_CATEGORIES_SORT_ORDER', 'Classement');

  define('TABLE_HEADING_PRICE','Prix/Promotion/Vente');
  define('TABLE_HEADING_QUANTITY','Quantit&eacute;');

  define('TABLE_HEADING_ACTION', 'Action');
  define('TABLE_HEADING_STATUS', 'Statut');

  define('TEXT_CATEGORIES', 'Cat&eacute;gories:');
  define('TEXT_SUBCATEGORIES', 'Sous-cat&eacute;gories:');
  define('TEXT_PRODUCTS', 'Produits:');
  define('TEXT_PRODUCTS_PRICE_INFO', 'Prix:');
  define('TEXT_PRODUCTS_TAX_CLASS', 'Classe de Taxe:');
  define('TEXT_PRODUCTS_AVERAGE_RATING', 'Note Moyenne:');
  define('TEXT_PRODUCTS_QUANTITY_INFO', 'Quantit&eacute;:');
  define('TEXT_DATE_ADDED', 'Date d\'Ajout:');
  define('TEXT_DATE_AVAILABLE', 'Date de Disponibilit&eacute;:');
  define('TEXT_LAST_MODIFIED', 'Derni&egrave;re Modification:');
  define('TEXT_IMAGE_NONEXISTENT', 'IMAGE INEXISTANTE');
  define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Veuillez ins&eacute;rer une Nouvelle Cat&eacute;gorie ou un Produit');
  define('TEXT_PRODUCT_MORE_INFORMATION', 'Pour en savoir plus, vous pouvez consulter cette <a href="http://%s" target="blank">page Web</a>.');
  define('TEXT_PRODUCT_DATE_ADDED', 'Ce produit a &eacute;t&eacute; ajout&eacute; &agrave; notre catalogue le %s.');
  define('TEXT_PRODUCT_DATE_AVAILABLE', 'Ce produit sera en stock le %s.');

  define('TEXT_EDIT_INTRO', 'Veuillez effectuer les changements requis');
  define('TEXT_EDIT_CATEGORIES_ID', 'ID de Cat&eacute;gorie:');
  define('TEXT_EDIT_CATEGORIES_NAME', 'Nom de la Cat&eacute;gorie:');
  define('TEXT_EDIT_CATEGORIES_IMAGE', 'Image de la Cat&eacute;gorie:');
  define('TEXT_EDIT_SORT_ORDER', 'Classement:');

  define('TEXT_INFO_COPY_TO_INTRO', 'Veuillez choisir une Nouvelle Cat&eacute;gorie vers laquelle vous souhaitez copier ce Produit');
  define('TEXT_INFO_CURRENT_CATEGORIES', 'Cat&eacute;gorie Actuelles: ');

  define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nouvelle Cat&eacute;gorie');
  define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Editer la Cat&eacute;gorie');
  define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Effacer la Cat&eacute;gorie');
  define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'D&eacute;placer la Cat&eacute;gorie');
  define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Effacer le Produit');
  define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'D&eacute;placer le Produit');
  define('TEXT_INFO_HEADING_COPY_TO', 'Copier vers');

  define('TEXT_DELETE_CATEGORY_INTRO', 'Etes-vous certain de vouloir effacer cette Cat&eacute;gorie ?');
  define('TEXT_DELETE_PRODUCT_INTRO', 'Etes-vous certain de vouloir effacer ce produit de fa&ccedil;on permanente ?');

  define('TEXT_DELETE_WARNING_CHILDS', '<b>ATTENTION:</b> Il y a %s Cat&eacute;gorie(-enfant) toujours li&eacute;e(s) &agrave; cette Cat&eacute;gorie !');
  define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ATTENTION:</b> Il y a %s Produits toujours li&eacute;(s) &agrave; cette Cat&eacute;gorie !');

  define('TEXT_MOVE_PRODUCTS_INTRO', 'Veuillez s&eacute;lectionner la Cat&eacute;gorie <b>%s</b> de r&eacute;sidence');
  define('TEXT_MOVE_CATEGORIES_INTRO', 'Veuillez s&eacute;lectionner la Cat&eacute;gorie <b>%s</b> de r&eacute;sidence');
  define('TEXT_MOVE', 'D&eacute;placer <b>%s</b> vers:');

  define('TEXT_NEW_CATEGORY_INTRO', 'Veuillez renseigner les informations requises pour cette Nouvelle Cat&eacute;gorie');
  define('TEXT_CATEGORIES_NAME', 'Nom de Cat&eacute;gorie:');
  define('TEXT_CATEGORIES_IMAGE', 'Image de Cat&eacute;gorie:');
  define('TEXT_SORT_ORDER', 'Classement:');

  define('TEXT_PRODUCTS_STATUS', 'Statut:');
  define('TEXT_PRODUCTS_VIRTUAL', 'Produit virtuel?');
  define('TEXT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', 'Livraison Gratuite:');
  define('TEXT_PRODUCTS_QTY_BOX_STATUS', 'Quantit&eacute;:');
  define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Date de Disponibilit&eacute;:');
  define('TEXT_PRODUCT_AVAILABLE', 'En Stock');
  define('TEXT_PRODUCT_NOT_AVAILABLE', 'Hors Stock');
  define('TEXT_PRODUCT_IS_VIRTUAL', 'Oui (sans Livraison)');
  define('TEXT_PRODUCT_NOT_VIRTUAL', 'Non, Adresse de Livraison requise');
  define('TEXT_PRODUCT_IS_ALWAYS_FREE_SHIPPING', 'Oui, Livraison Gratuite');
  define('TEXT_PRODUCT_NOT_ALWAYS_FREE_SHIPPING', 'Non, R&egrave;gles de Livraisons');
define('TEXT_PRODUCT_SPECIAL_ALWAYS_FREE_SHIPPING', 'Special, le produit/t&eacute;l&eacute;chargement exige une adresse de livraison');
  define('TEXT_PRODUCTS_SORT_ORDER', 'Classement:');

  define('TEXT_PRODUCTS_QTY_BOX_STATUS_ON', 'Oui, afficher la Qt&eacute;');
  define('TEXT_PRODUCTS_QTY_BOX_STATUS_OFF', 'Non, ne pas afficher la Qt&eacute;');

  define('TEXT_PRODUCTS_MANUFACTURER', 'Fabricant:');
  define('TEXT_PRODUCTS_NAME', 'Nom:');
  define('TEXT_PRODUCTS_DESCRIPTION', 'Description:');
  define('TEXT_PRODUCTS_QUANTITY', 'Quantit&eacute;:');
  define('TEXT_PRODUCTS_MODEL', 'R&eacute;f&eacute;rence:');
  define('TEXT_PRODUCTS_IMAGE', 'Image:');
  define('TEXT_PRODUCTS_IMAGE_DIR', 'T&eacute;l&eacute;charger vers le R&eacute;pertoire:');
  define('TEXT_PRODUCTS_URL', 'URL des Produits:');
  define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(sans http://)</small>');
  define('TEXT_PRODUCTS_PRICE_NET', 'Prix (HT):');
  define('TEXT_PRODUCTS_PRICE_GROSS', 'Prix (TTC):');
  define('TEXT_PRODUCTS_WEIGHT', 'Poids:');

  define('EMPTY_CATEGORY', 'Cat&eacute;gorie Vide');

  define('TEXT_HOW_TO_COPY', 'M&eacute;thode de Copie:');
  define('TEXT_COPY_AS_LINK', 'Lier le Produit');
  define('TEXT_COPY_AS_DUPLICATE', 'Dupliquer le Produit');

// Products and Attribute Copy Options
  define('TEXT_COPY_ATTRIBUTES_ONLY','Utilis&eacute; seulement pour Dupliquer les Produits...');
  define('TEXT_COPY_ATTRIBUTES','Copier les Attributs de Produits vers Dupliquer?');
  define('TEXT_COPY_ATTRIBUTES_YES','Oui');
  define('TEXT_COPY_ATTRIBUTES_NO','Non');

// Products and Discount Copy Options
  define('TEXT_COPY_DISCOUNTS_ONLY','Utilis&eacute; seulement pour Dupliquer les Produits avec Remises...');
  define('TEXT_COPY_DISCOUNTS','Copier les Remises de Produits vers Dupliquer?');
  define('TEXT_COPY_DISCOUNTS_YES','Oui');
  define('TEXT_COPY_DISCOUNTS_NO','Non');

  define('TEXT_INFO_CURRENT_PRODUCT', 'Produit Actuel: ');
  define('TABLE_HEADING_MODEL', 'Mod&egrave;le');

  define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES','Changement d\'Attributs pour les Produits ID# ');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE','Effacer <strong>TOUS</strong> les Attributs de Produit pour:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO','Copier les Attributs vers un Autre Produit ou vers une Cat&eacute;gorie enti&egrave;re:<br />');

  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT','Copier les Attributs vers un autre <strong>Produit</strong> depuis:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY','Copier les Attributs vers une autre <strong>Cat&eacute;gorie</strong> depuis:<br />');

  define('TEXT_COPY_ATTRIBUTES_CONDITIONS','<strong>Comment les attributs de produits actuels doivent-ils &ecirc;tre actualis&eacute;s?</strong>');
  define('TEXT_COPY_ATTRIBUTES_DELETE','<strong>Effacer</strong> d\'abord, puis copier les nouveaux attributs');
  define('TEXT_COPY_ATTRIBUTES_UPDATE','<strong>Actualiser</strong> avec de nouveaux r&eacute;glages/prix, puis ajouter les nouveaux');
  define('TEXT_COPY_ATTRIBUTES_IGNORE','<strong>Ignorer</strong> et ajouter seulement les nouveaux attributs');

  define('SUCCESS_ATTRIBUTES_DELETED','Attributs effac&eacute;s avec succ&egrave;s');
  define('SUCCESS_ATTRIBUTES_UPDATE','Attributs actualis&eacute;s avec succ&egrave;s');

  define('ICON_ATTRIBUTES','Caract&eacute;ristiques d\'Attributs');

  define('TEXT_CATEGORIES_IMAGE_DIR','T&eacute;l&eacute;charger vers le R&eacute;pertoire:');

  define('TEXT_VIRTUAL_PREVIEW','Attention: Ce produit est marqu&eacute; - Livraison Gratuite et Passer l\'Adresse de Livraison');
  define('TEXT_VIRTUAL_EDIT','Attention: Ce produit est marqu&eacute; - Livraison Gratuite et Passer l\'Adresse de Livraison');

  define('TEXT_PRODUCT_OPTIONS', '<strong>Veuillez s&eacute;lectionner:</strong>');
  define('TEXT_PRODUCTS_ATTRIBUTES_INFO','Caract&eacute;ristiques des Attributs Pour:');
  define('TEXT_PRODUCT_ATTRIBUTES_DOWNLOADS','T&eacute;l&eacute;chargements: ');

  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES','Prix par Attributs:');
  define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE','Oui');
  define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE','Non');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_PREVIEW','*Le Prix Affich&eacute; incluera les plsu bas prix des Attributs plus le Prix');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT','*Le Prix Affich&eacute; incluera les plsu bas prix des Attributs plus le Prix');

  define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL','Qt&eacute Minimum:');
  define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL','Qt&eacute en Unit&eacute;(s):');
  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL','Qt&eacute Maximum:');

  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT','0 = Illimit&eacute;, 1 = Pas de Qt&eacute; Min/Max');

  define('TEXT_PRODUCTS_MIXED','Qt&eacute; Min/Unit Mix:');

  define('PRODUCTS_PRICE_IS_FREE_TEXT', 'Produit Gratuit');
  define('TEXT_PRODUCT_IS_FREE','Produit Gratuit:');
  define('TEXT_PRODUCTS_IS_FREE_PREVIEW','*Le produit est marqu&eacute; GRATUIT');
  define('TEXT_PRODUCTS_IS_FREE_EDIT','*Le produit est marqu&eacute; GRATUIT');

  define('TEXT_PRODUCT_IS_CALL','Prix sur Demande:');
  define('TEXT_PRODUCTS_IS_CALL_PREVIEW','*Le Produit est en PRIX SUR DEMANDE');
  define('TEXT_PRODUCTS_IS_CALL_EDIT','*Le Produit est en PRIX SUR DEMANDE');

  define('TEXT_ATTRIBUTE_COPY_SKIPPING','<strong>Sauter vers un Attribut </strong>');
  define('TEXT_ATTRIBUTE_COPY_INSERTING','<strong>Ins&eacute;rer un Nouvel Attribut depuis </strong>');
  define('TEXT_ATTRIBUTE_COPY_UPDATING','<strong>Actualiser depuis l\'Attribut </strong>');

// meta tags
  define('TEXT_META_TAG_TITLE_INCLUDES','<strong>Marquer ce que le Titre du Meta Tag du Produit doit inclure:</strong>');
  define('TEXT_PRODUCTS_METATAGS_PRODUCTS_NAME_STATUS','<strong>Nom du Produit:</strong>');
  define('TEXT_PRODUCTS_METATAGS_TITLE_STATUS','<strong>Titre:</strong>');
  define('TEXT_PRODUCTS_METATAGS_MODEL_STATUS','<strong>Mod&egrave;le:</strong>');
  define('TEXT_PRODUCTS_METATAGS_PRICE_STATUS','<strong>Prix:</strong>');
  define('TEXT_PRODUCTS_METATAGS_TITLE_TAGLINE_STATUS','<strong>Titre/Tagline:</strong>');
  define('TEXT_META_TAGS_TITLE','<strong>Titre du Meta Tag:</strong>');
  define('TEXT_META_TAGS_KEYWORDS','<strong>Mots Clef du Meta Tag:</strong>');
  define('TEXT_META_TAGS_DESCRIPTION','<strong>Description du Meta Tag:</strong>');
  define('TEXT_META_EXCLUDED', '<span class="alert">EXCLURE</span>');

?>