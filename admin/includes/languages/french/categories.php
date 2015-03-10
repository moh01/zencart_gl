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
//  $Id: categories.php 3396 2006-04-09 00:02:03Z ajeh $
//

  define('HEADING_TITLE', 'Cat&eacute;gories / Produits');
  define('HEADING_TITLE_GOTO', 'Aller &agrave;:');

  define('TABLE_HEADING_ID', 'ID');
  define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Cat&eacute;gories / Produits');
  define('TABLE_HEADING_CATEGORIES_SORT_ORDER', 'Classement');

  define('TABLE_HEADING_PRICE','Prix/Sp&eacute;cial/Vente');
  define('TABLE_HEADING_QUANTITY','Quantit&eacute;');

  define('TABLE_HEADING_ACTION', 'Action');
  define('TABLE_HEADING_STATUS', 'Statut');

  define('TEXT_CATEGORIES', 'Cat&eacute;gories:');
  define('TEXT_SUBCATEGORIES', 'Sous-Cat&eacute;gories:');
  define('TEXT_PRODUCTS', 'Produits:');
  define('TEXT_PRODUCTS_PRICE_INFO', 'Prix:');
  define('TEXT_PRODUCTS_TAX_CLASS', 'Classe de Taxe:');
  define('TEXT_PRODUCTS_AVERAGE_RATING', 'Evaluation Moyenne:');
  define('TEXT_PRODUCTS_QUANTITY_INFO', 'Quantit&eacute;:');
  define('TEXT_DATE_ADDED', 'Date d\'Ajout:');
  define('TEXT_DATE_AVAILABLE', 'Date de Disponibilit&eacute;:');
  define('TEXT_LAST_MODIFIED', 'Derni&egrave;re Modification:');
  define('TEXT_IMAGE_NONEXISTENT', 'IMAGE INEXISTANTE');
  define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Veuillez ins&eacute;rer une Nouvelle Cat&eacute;gorie ou un Produit &agrave; ce Niveau.');
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
  define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Editer Cat&eacute;gorie');
  define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Effacer la Cat&eacute;gorie');
  define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'D&eacute;placer Cat&eacute;gorie');
  define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Effacer le Produit');
  define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'D&eacute;placer le Produit');
  define('TEXT_INFO_HEADING_COPY_TO', 'Copier vers');

  define('TEXT_DELETE_CATEGORY_INTRO', 'Etes-vous certain de vouloir effacer cette Cat&eacute;gorie ?');
define('TEXT_DELETE_CATEGORY_INTRO_LINKED_PRODUCTS', '<strong>Warning:</strong> Linked Products whose Master Categories ID are deleted will not price properly. You should first assure that when deleting a Category that contains Linked Products that you reset the Product(s) Master Categories ID to another Category before removing a Category');
  define('TEXT_DELETE_PRODUCT_INTRO', 'Etes-vous certain de vouloir effacer ce produit de fa&ccedil;on permanente ?');

  define('TEXT_DELETE_WARNING_CHILDS', '<b>ATTENTION:</b> Il y a %s Cat&eacute;gorie(-enfant) toujours li&eacute;e(s) &agrave; cette Cat&eacute;gorie !');
  define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ATTENTION:</b> Il y a %s Produits toujours li&eacute;(s) &agrave; cette Cat&eacute;gorie !');

  define('TEXT_MOVE_PRODUCTS_INTRO', 'Veuillez s&eacute;lectionner la Cat&eacute;gorie <b>%s</b> de r&eacute;sidence');
  define('TEXT_MOVE_CATEGORIES_INTRO', 'Veuillez s&eacute;lectionner la Cat&eacute;gorie <b>%s</b> de r&eacute;sidence');
  define('TEXT_MOVE', 'D&eacute;placer <b>%s</b> vers:');

  define('TEXT_NEW_CATEGORY_INTRO', 'Veuillez rensigner les informations concernant la Nouvelle Cat&eacute;gorie');
  define('TEXT_CATEGORIES_NAME', 'Cat&eacute;gorie Nom:');
  define('TEXT_CATEGORIES_IMAGE', 'Cat&eacute;gorie Image:');
  define('TEXT_SORT_ORDER', 'Classement:');

  define('TEXT_PRODUCTS_STATUS', 'Statut des Produits:');
  define('TEXT_PRODUCTS_VIRTUAL', 'Le Produit est Virtuel:');
  define('TEXT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', 'Livraison Toujours Gratuite:');
  define('TEXT_PRODUCTS_QTY_BOX_STATUS', 'La box Quantit&eacute; des Produits affiche:');
  define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Date de Disponibilit&eacute;:');
  define('TEXT_PRODUCT_AVAILABLE', 'En Stock');
  define('TEXT_PRODUCT_NOT_AVAILABLE', 'Hors Stock');
  define('TEXT_PRODUCT_IS_VIRTUAL', 'Oui, passer l\Adresse de Livraison');
  define('TEXT_PRODUCT_NOT_VIRTUAL', 'Non, l\Adresse de Livraison est requise');
  define('TEXT_PRODUCT_IS_ALWAYS_FREE_SHIPPING', 'Oui, Livraison Toujours Gratuite');
  define('TEXT_PRODUCT_NOT_ALWAYS_FREE_SHIPPING', 'Non, R&egrave;gles de Livraisons habituelles');

  define('TEXT_PRODUCTS_QTY_BOX_STATUS_ON', 'Oui, afficher la box Quantit&eacute;');
  define('TEXT_PRODUCTS_QTY_BOX_STATUS_OFF', 'Non, ne pas afficher la box Quantit&eacute;');

  define('TEXT_PRODUCTS_MANUFACTURER', 'Fabricant:');
  define('TEXT_PRODUCTS_NAME', 'Nom des Produits:');
  define('TEXT_PRODUCTS_DESCRIPTION', 'Description:');
  define('TEXT_PRODUCTS_QUANTITY', 'Quantit&eacute;:');
  define('TEXT_PRODUCTS_MODEL', 'R&eacute;f&eacute;rence:');
  define('TEXT_PRODUCTS_IMAGE', 'Image:');
  define('TEXT_PRODUCTS_IMAGE_DIR', 'T&eacute;l&eacute;charger vers le R&eacute;pertoire:');
  define('TEXT_PRODUCTS_URL', 'URL des Produits:');
  define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(sans http://)</small>');
  define('TEXT_PRODUCTS_PRICE_NET', 'Prix des Produits (HT):');
  define('TEXT_PRODUCTS_PRICE_GROSS', 'Prix des Produits (TTC):');
  define('TEXT_PRODUCTS_WEIGHT', 'Poids des Produits:');

  define('EMPTY_CATEGORY', 'Cat&eacute;gorie Vide');

  define('TEXT_HOW_TO_COPY', 'M&eacute;thode de Copie:');
  define('TEXT_COPY_AS_LINK', 'Lier le produit');
  define('TEXT_COPY_AS_DUPLICATE', 'Dupliquer le produit');

  define('TEXT_RESTRICT_PRODUCT_TYPE', 'Restreindre au type de produit');
  define('TEXT_CATEGORY_HAS_RESTRICTIONS', 'Cette Cat&eacute;gorie est restreinte &agrave; ces Types de Produits');
  define('ERROR_CANNOT_ADD_PRODUCT_TYPE','Le type de Produit sp&eacute;cifi&eacute; ne peut &ecirc;tre ajout&eacute; &agrave; cette cat&eacute;gorie. Veuillez v&eacute;rifier vos restrictions.');

// Products and Attribute Copy Options
  define('TEXT_COPY_ATTRIBUTES_ONLY','Utilis&eacute; seulement pour Dupliquer les Produits...');
  define('TEXT_COPY_ATTRIBUTES','Copier les Attributs de Produits vers Dupliquer ?');
  define('TEXT_COPY_ATTRIBUTES_YES','Oui');
  define('TEXT_COPY_ATTRIBUTES_NO','Non');

  define('TEXT_INFO_CURRENT_PRODUCT', 'Produit Actuel: ');
  define('TABLE_HEADING_MODEL', 'Mod&egrave;le');

  define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES','Changer les Attributs pour les Produits ID# ');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE','Effacer <strong>TOUS</strong> les Attributs des Produit pour:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO','Copier les Attributs vers un autre Produit ou vers une Cat&eacute;gorie enti&egrave;re:<br />');

  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT','Copier les Attributs vers un autre <strong>produit</strong> depuis:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY','Copier les Attributs vers une autre <strong>cat&eacute;gorie</strong> depuis:<br />');

  define('TEXT_COPY_ATTRIBUTES_CONDITIONS','<strong>Comment les attributs de produits actuels doivent-ils &ecirc;tre actualis&eacute;s ?</strong>');
  define('TEXT_COPY_ATTRIBUTES_DELETE','<strong>Effacer</strong> d\'abord, puis copier les nouveaux attributs');
  define('TEXT_COPY_ATTRIBUTES_UPDATE','<strong>Actualiser</strong> avec de nouveaux r&eacute;glages/prix, puis ajouter les nouveaux');
  define('TEXT_COPY_ATTRIBUTES_IGNORE','<strong>Ignorer</strong> et ajouter seulement les nouveaux attributs');

  define('SUCCESS_ATTRIBUTES_DELETED','Attributs effac&eacute;s avec succ&egrave;s');
  define('SUCCESS_ATTRIBUTES_UPDATE','Attributs actualis&eacute;s avec succ&egrave;s');

  define('ICON_ATTRIBUTES','Caract&eacute;ristiques d\'Attributs');

  define('TEXT_CATEGORIES_IMAGE_DIR','T&eacute;l&eacute;charger vers le R&eacute;pertoire:');

  define('TEXT_VIRTUAL_PREVIEW','Attention: Ce produit est marqu&eacute; - Livraison Gratuite et Passer l\'Adresse de Livraison');
  define('TEXT_VIRTUAL_EDIT','Attention: Ce produit est marqu&eacute; - Livraison Gratuite et Passer l\'Adresse de Livraison');
  define('TEXT_FREE_SHIPPING_PREVIEW','Attention: Ce produit est marqu&eacute; - Livraison Gratuite, Adresse de Livraison requise');
  define('TEXT_FREE_SHIPPING_EDIT','Attention: Oui rend le produit - Livraison Gratuite, Adresse de Livraison requise');

  define('TEXT_PRODUCTS_QTY_BOX_STATUS_PREVIEW','Attention: box des Quantit&eacute;s non affich&eacute;e, la Qt&eacute; pr d&eacute;faut est de 1');
  define('TEXT_PRODUCTS_QTY_BOX_STATUS_EDIT','Attention: box des Quantit&eacute;s non affich&eacute;e, la Qt&eacute; pr d&eacute;faut est de 1');

  define('TEXT_PRODUCT_OPTIONS', '<strong>Veuillez s&eacute;lectionner:</strong>');
  define('TEXT_PRODUCTS_ATTRIBUTES_INFO','Caract&eacute;ristiques des Attributs Pour:');
  define('TEXT_PRODUCT_ATTRIBUTES_DOWNLOADS','T&eacute;l&eacute;chargements: ');

  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES','Prix des Produits Par Attributs:');
  define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE','Oui');
  define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE','Non');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_PREVIEW','*Le Prix Affich&eacute; incluera les plus bas prix des Attributs plus le Prix');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT','*Le Prix Affich&eacute; incluera les plus bas prix des Attributs plus le Prix');

  define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL','Qt&eacute Minimum de Produits:');
  define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL','Qt&eacute de Produits en Unit&eacute;:');
  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL','Qt&eacute Maximum de Produits:');

  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT','0 = Illimit&eacute;, 1 = Pas de Boxes Qt&eacute; Boxes Min ou Max ##');

  define('TEXT_PRODUCTS_MIXED','Produit Qt&eacute; Min/Unit Mix:');

  define('PRODUCTS_PRICE_IS_FREE_TEXT', 'Produit Gratuit');
  define('TEXT_PRODUCT_IS_FREE','Le Produit est Gratuit:');
  define('TEXT_PRODUCTS_IS_FREE_PREVIEW','*Le produit est marqu&eacute; GRATUIT');
  define('TEXT_PRODUCTS_IS_FREE_EDIT','*Le produit est marqu&eacute; GRATUIT');

  define('TEXT_PRODUCT_IS_CALL','Le Produit est en Prix Sur Demande:');
  define('TEXT_PRODUCTS_IS_CALL_PREVIEW','*Le produit est marqu&eacute; PRIX SUR DEMANDE');
  define('TEXT_PRODUCTS_IS_CALL_EDIT','*Le produit est marqu&eacute; PRIX SUR DEMANDE');

  define('TEXT_ATTRIBUTE_COPY_SKIPPING','<strong>Sauter vers un Attribut </strong>');
  define('TEXT_ATTRIBUTE_COPY_INSERTING','<strong>Ins&eacute;rer un Nouvel Attribut depuis </strong>');
  define('TEXT_ATTRIBUTE_COPY_UPDATING','<strong>Actualiser depuis l\'Attribut </strong>');

  define('TEXT_SHIPPING_INFO',
  '<strong>Les Produits Virtuels</strong> ne sont pas assujettis au frais de livraisons et ne requi&egrave;rent pas d\'Adresse de Livraison pour les Service de , ' . TEXT_GV_NAMES . ', etc.<br />' .
  '<strong>Les Livraisons Toujours Gratuites</strong> ne sont pas assujettis au frais de livraisons, mais requi&egrave;rent une adresse de livraison<br />' .
  '<strong>Les T&eacute;l&eacute;chargements</strong> sont suppos&eacute;s &ecirc;tre des Produits Virtuels - Il n\'est pas n&eacute;cessaire de mentionner d\'Options<br />'
  );

  define('TEXT_ANY_TYPE', 'Tout Type');
  define('TABLE_HEADING_PRODUCT_TYPES', 'Type(s) de Produits');

// categories status
  define('TEXT_INFO_HEADING_STATUS_CATEGORY', 'Changer le Statut de Cat&eacute;gorie Pour:');
  define('TEXT_CATEGORIES_STATUS_INTRO', 'Changer le Statut de Cat&eacute;gorie Pour: ');
  define('TEXT_CATEGORIES_STATUS_OFF', 'OFF');
  define('TEXT_CATEGORIES_STATUS_ON', 'ON');
  define('TEXT_PRODUCTS_STATUS_INFO', 'Changer TOUS les Statuts de Produits en: ');
  define('TEXT_PRODUCTS_STATUS_OFF', 'OFF');
  define('TEXT_PRODUCTS_STATUS_ON', 'ON');
  define('TEXT_PRODUCTS_STATUS_NOCHANGE', 'Inchang&eacute;');
  define('TEXT_CATEGORIES_STATUS_WARNING', '<strong>ATTENTION...</strong><br />Note: D&eacute;sactiver une Cat&eacute;gorie d&eacute;sactivera tous les Produits de cette Cat&eacute;gorie. Les Produits li&eacute;s situ&eacute;s &agrave; cette Cat&eacute;gorie, et qui sont &eacute;galement partag&eacute;s avec d\'autres Cat&eacute;gories, seront &eacute;galement effac&eacute;es.');

  define('TEXT_PRODUCTS_STATUS_ON_OF',' de ');
  define('TEXT_PRODUCTS_STATUS_ACTIVE',' actif ');

  define('TEXT_CATEGORIES_DESCRIPTION', 'Description des Cat&eacute;gories:');
  define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT', 'Le produit est en Prix sur Demande');

// Metatags
  define('TEXT_INFO_HEADING_EDIT_CATEGORY_META_TAGS', 'D&eacute;finission des Meta Tags des Categories');   
 define('TEXT_EDIT_CATEGORIES_META_TAGS_INTRO', 'D&eacute;finission des Meta Tags perso');
  define('TEXT_EDIT_CATEGORIES_META_TAGS_TITLE', 'Titre:');
  define('TEXT_EDIT_CATEGORIES_META_TAGS_KEYWORDS', 'Mot Clefs:');
  define('TEXT_EDIT_CATEGORIES_META_TAGS_DESCRIPTION', 'Description:');

define('WARNING_PRODUCTS_IN_TOP_INFO', 'WARNING: You have Products in the Top Level Category. This will cause pricing to not work properly in the Catalog. Products found: ');


?>