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
//  $Id: attributes_controller.php 2830 2006-01-10 17:13:18Z birdbrain $
//

define('HEADING_TITLE', 'CAT&EACUTE;GORIES: ');

  define('HEADING_TITLE_OPT', 'Options de Produits');
  define('HEADING_TITLE_VAL', 'Valeurs des Options');
  define('HEADING_TITLE_ATRIB', 'Contr&ocirc;le des Attributs');
  define('HEADING_TITLE_ATRIB_SELECT','Veuillez s&eacute;lectionner une Cat&eacute;gorie pour afficher les Attributs de Produits de...');

  define('TEXT_PRICES_AND_WEIGHTS', 'Prix et Poids');
  define('TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR', 'Facteur Prix: ');
  define('TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR_OFFSET', 'Offset: ');
  define('TABLE_HEADING_ATTRIBUTES_PRICE_ONETIME', 'Une Fois:');

  define('TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR_ONETIME', 'Facteur Une Fois: ');
  define('TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR_OFFSET_ONETIME', 'Offset: ');

  define('TABLE_HEADING_ATTRIBUTES_QTY_PRICES', 'Remise par Quantit&eacute; d\'Attributs:');
  define('TABLE_HEADING_ATTRIBUTES_QTY_PRICES_ONETIME', 'Remise Unique par Quantit&eacute; d\'Attributs:');

  define('TABLE_HEADING_ATTRIBUTES_PRICE_WORDS', 'Prix par Mot:');
  define('TABLE_HEADING_ATTRIBUTES_PRICE_WORDS_FREE', '- Mots Gratuits:');
  define('TABLE_HEADING_ATTRIBUTES_PRICE_LETTERS', 'Prix par lettre:');
  define('TABLE_HEADING_ATTRIBUTES_PRICE_LETTERS_FREE', '- Lettres Gratuites:');

  define('TABLE_HEADING_ID', 'ID');
  define('TABLE_HEADING_PRODUCT', 'Nom du Produit');
  define('TABLE_HEADING_OPT_NAME', 'Nom de l\'Option');
  define('TABLE_HEADING_OPT_VALUE', 'Valeur de l\'Option');
  define('TABLE_HEADING_OPT_PRICE', 'Prix');
  define('TABLE_HEADING_OPT_PRICE_PREFIX', 'Pr&eacute;fixe');
  define('TABLE_HEADING_ACTION', 'Action');
  define('TABLE_HEADING_DOWNLOAD', 'Produits t&eacute;l&eacute;chargeables:');
  define('TABLE_TEXT_FILENAME', 'Fichier:');
  define('TABLE_TEXT_MAX_DAYS', 'Jours avant Expiration:');
  define('TABLE_TEXT_MAX_COUNT', 'Nombre Maximum de T&eacute;l&eacute;chargements:');
  define('TABLE_HEADING_OPT_DISCOUNTED','Remis&eacute;');
  define('TABLE_HEADING_PRICE_BASE_INCLUDED','Base');
  define('TABLE_HEADING_PRICE_TOTAL','Total|Remise: Unique:');
  define('TEXT_WARNING_OF_DELETE', 'Cette option poss&egrave;de des liens avec des Produits et des Valeurs - il n\'est donc pas recommand&eacute; de la supprimer.');
  define('TEXT_OK_TO_DELETE', 'Cette option ne poss&egrave;de aucun Produit ou Valeur qui lui seraient li&eacute;s - vous pouvez donc la supprimer.');
  define('TEXT_OPTION_ID', 'ID d\'Option ');
  define('TEXT_OPTION_NAME', 'Nom de l\'Option ');

  define('ATTRIBUTE_WARNING_DUPLICATE','Duplication d\'Attribut - l\'Attribut n\'a pas &eacute;t&eacute; ajout&eacute;'); // attributes duplicate warning
  define('ATTRIBUTE_WARNING_DUPLICATE_UPDATE','La duplication d\'Attribut existe d&eacute;j&agrave; - l\'Attribut n\'a pas &eacute;t&eacute; modifi&eacute;'); // attributes duplicate warning
  define('ATTRIBUTE_WARNING_INVALID_MATCH','L\'Option d\'Attribut et la Valeur d\'Option NE correspondent pas - l\'Attribut n\'a pas &eacute;t&eacute; ajout&eacute;'); // miss matched option and options value
  define('ATTRIBUTE_WARNING_INVALID_MATCH_UPDATE','L\'Option d\'Attribut et la Valeur d\'Option NE correspondent pas - l\'Attribut n\'a pas &eacute;t&eacute; modifi&eacute;'); // miss matched option and options value
  define('ATTRIBUTE_POSSIBLE_OPTIONS_NAME_WARNING_DUPLICATE','Possible duplication des Noms des Options Ajout&eacute;es'); // Options Name Duplicate warning
  define('ATTRIBUTE_POSSIBLE_OPTIONS_VALUE_WARNING_DUPLICATE','Possible duplication des Valeurs d\Options Ajout&eacute;es'); // Options Value Duplicate warning

  define('PRODUCTS_ATTRIBUTES_EDITING','EDITION'); // title
  define('PRODUCTS_ATTRIBUTES_DELETE','EFFACEMENT'); // title
  define('PRODUCTS_ATTRIBUTES_ADDING','AJOUT DE NOUVEAUX ATTRIBUTS'); // title
  define('TEXT_DOWNLOADS_DISABLED','NOTE: les T&eacute;l&eacute;chargements sont d&eacute;sactiv&eacute;s');

  define('TABLE_TEXT_MAX_DAYS_SHORT', 'Jours:');
  define('TABLE_TEXT_MAX_COUNT_SHORT', 'Max:');

  define('TABLE_HEADING_OPTION_SORT_ORDER','Classement');
  define('TABLE_HEADING_OPTION_VALUE_SORT_ORDER','Classement par d&eacute;faut');
  define('TEXT_SORT',' Classement: ');

  define('TABLE_HEADING_OPT_WEIGHT_PREFIX','Pr&eacute;fixe');
  define('TABLE_HEADING_OPT_WEIGHT','Poids');
  define('TABLE_HEADING_OPT_SORT_ORDER','Classement');
  define('TABLE_HEADING_OPT_DEFAULT','D&eacute;faut');

  define('TABLE_HEADING_OPT_TYPE', 'Type d\'Option'); //CLR 031203 add option type column
  define('TABLE_HEADING_OPTION_VALUE_SIZE','Taille');
  define('TABLE_HEADING_OPTION_VALUE_MAX','Max');
  define('TABLE_HEADING_OPTION_VALUE_ROWS','Rangs');
  define('TABLE_HEADING_OPTION_VALUE_COMMENTS','Commentaires');

  define('TEXT_OPTION_VALUE_COMMENTS','Commentaires: ');
  define('TEXT_OPTION_VALUE_SIZE','Afficher la Taille: ');
  define('TEXT_OPTION_VALUE_MAX','Longueur Maximum: ');

  define('TEXT_ATTRIBUTES_IMAGE','Swatch des Images d\'Attributs:');
  define('TEXT_ATTRIBUTES_IMAGE_DIR','R&eacute;pertoire des Images d\'Attributs:');

  define('TEXT_ATTRIBUTES_FLAGS','Attribut<br />Drapeaux:');
  define('TEXT_ATTRIBUTES_DISPLAY_ONLY', 'Utilis&eacute; Pour<br />affichage seulement:');
  define('TEXT_ATTRIBUTES_IS_FREE', 'L\'Attribut est Gratuit<br />lorsque le produit est Gratuit:');
  define('TEXT_ATTRIBUTES_DEFAULT', 'L\'Attribut par D&eacute;faut<br />est s&eacute;lectionn&eacute;:');
  define('TEXT_ATTRIBUTE_IS_DISCOUNTED', 'Appliquer les Remises Utilis&eacute;es<br />par Promotion/Vente:');
  define('TEXT_ATTRIBUTE_PRICE_BASE_INCLUDED','Inclure dans le Prix de Base<br />lorsque prix par Attributs');
  define('TEXT_ATTRIBUTES_REQUIRED','Attribut Requis<br />pour le Texte:');

  define('LEGEND_BOX','L&eacute;gende:');
  define('LEGEND_KEYS','OFF/ON');
  define('LEGEND_ATTRIBUTES_DISPLAY_ONLY', 'Affichage Seulement');
  define('LEGEND_ATTRIBUTES_IS_FREE', 'Gratuit');
  define('LEGEND_ATTRIBUTES_DEFAULT', 'D&eacute;faut');
  define('LEGEND_ATTRIBUTE_IS_DISCOUNTED', 'Stock Epuis&eacute;');
  define('LEGEND_ATTRIBUTE_PRICE_BASE_INCLUDED','Prix de Base');
  define('LEGEND_ATTRIBUTES_REQUIRED','Requis');
  define('LEGEND_ATTRIBUTES_IMAGES','Images');
  define('LEGEND_ATTRIBUTES_DOWNLOAD','Valider/Invalider<br />le fichier');

  define('TEXT_ATTRIBUTES_UPDATE_SORT_ORDER','AU CLASSEMENT PAR DEFAUT');
  define('TEXT_PRODUCTS_LISTING','Les Listes de produits pour: ');
  define('TEXT_NO_PRODUCTS_SELECTED','Aucun Produit s&eacute;lectionn&eacute;');
  define('TEXT_NO_ATTRIBUTES_DEFINED','Aucun Attribut D&eacute;fini pour le Produit ID#');

  define('TEXT_PRODUCTS_ID','Produits ID#');
  define('TEXT_ATTRIBUTES_DELETE','EFFACER TOUT');
  define('TEXT_ATTRIBUTES_COPY_PRODUCTS','Copier vers Produit');
  define('TEXT_ATTRIBUTES_COPY_CATEGORY','Copier vers Cat&eacute;gorie');

  define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES','Changement d\'Attributs pour les Produits ID# ');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE','Effacer <strong>TOUS</strong> les Attributs de Produit pour:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO','Copier les Attributs vers un Autre Produit ou vers une Cat&eacute;gorie enti&egrave;re:<br />');

  define('TEXT_ATTRIBUTES_COPY_TO_PRODUCTS','PRODUIT');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT','Copier les Attributs vers un autre <strong>Produit</strong> depuis ID#');
  define('TEXT_INFO_ATTRIBUTES_FEATURE_COPY_TO','S&eacute;lectionnez le Produit pour en copier tous les attributs vers:');

  define('TEXT_ATTRIBUTES_COPY_TO_CATEGORY','CATEGORIE');
  define('TEXT_INFO_ATTRIBUTES_FEATURE_CATEGORIES_COPY_TO','S&eacute;lectionnez la Cat&eacute;gorie pour en copier tous les Attributs vers:');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY','Copier les Attributs vers tous les Produits dans la <strong>Cat&eacute;gorie</strong> depuis le Produit ID#');

  define('TEXT_COPY_ATTRIBUTES_CONDITIONS','<strong>Comment les attributs de produits actuels doivent-ils &ecirc;tre actualis&eacute;s ?</strong>');
  define('TEXT_COPY_ATTRIBUTES_DELETE','<strong>Effacer</strong> d\'abord, puis copier les nouveaux attributs');
  define('TEXT_COPY_ATTRIBUTES_UPDATE','<strong>Actualiser</strong> avec de nouveaux r&eacute;glages/prix, puis ajouter les nouveaux');
  define('TEXT_COPY_ATTRIBUTES_IGNORE','<strong>Ignorer</strong> et ajouter seulement les nouveaux attributs');

  define('SUCCESS_PRODUCT_UPDATE_SORT','Actualisation du Classement des Attributs effectu&eacute;e avec succsucc&egrave;ss pour ID# ');
  define('SUCCESS_PRODUCT_UPDATE_SORT_NONE','Aucun Classement des Attributs pour ID# ');
  define('SUCCESS_ATTRIBUTES_DELETED','Attributs effac&eacute;s avec succ&egrave;s');
  define('SUCCESS_ATTRIBUTES_UPDATE','Attributs actualis&eacute;s avec succ&egrave;s');

  define('WARNING_PRODUCT_COPY_TO_CATEGORY_NONE','Aucune Cat&eacute;gorie s&eacute;lectionn&eacute;e pour copie');
  define('TEXT_PRODUCT_IN_CATEGORY_NAME',' - dans la Cat&eacute;gorie: ');

  define('TEXT_DELETE_ALL_ATTRIBUTES','Etes-vous certain de vouloir Effacer tous les Attributs de l\'ID#  ?');

  define('TEXT_ATTRIBUTE_COPY_SKIPPING','<strong>Sauter vers un Nouvel Attribut </strong>');
  define('TEXT_ATTRIBUTE_COPY_INSERTING','<strong>Ins&eacute;rer un Nouvel Attribut Depuis </strong>');
  define('TEXT_ATTRIBUTE_COPY_UPDATING','<strong>Acutualisation de l\'Attribut </strong>');

// preview
  define('TEXT_ATTRIBUTES_PREVIEW','PREVISUALISER LES ATTRIBUTS');
  define('TEXT_ATTRIBUTES_PREVIEW_DISPLAY','PREVISUALISER LES ATTRIBUTS A AFFICHER POUR ID#');
  define('TEXT_PRODUCT_OPTIONS', '<strong>S&eacute;lectionnez:</strong>');

  define('TEXT_ATTRIBUTES_INSERT_INFO', '<strong>D&eacute;finir les R&eacute;glages d\'Attribut et Envoyer</strong>');
  define('TEXT_PRICED_BY_ATTRIBUTES', 'Prix par Attribut');
  define('TEXT_PRODUCTS_PRICE', 'Prix du Produit: ');
  define('TEXT_SPECIAL_PRICE', 'Prix Promotionnel: ');
  define('TEXT_SALE_PRICE', 'Prix de Vente: ');
  define('TEXT_FREE', 'GRATUIT');
  define('TEXT_CALL_FOR_PRICE', 'PRIX SUR DEMANDE');
  define('TEXT_SAVE_CHANGES','METTRE A JOUR ET SAUVEGARDER:');

  define('TEXT_INFO_ID', 'ID#');
  define('TEXT_INFO_ALLOW_ADD_TO_CART_NO', 'Pas d\'Ajout au Panier');

  define('TEXT_DELETE_ATTRIBUTES_OPTION_NAME_VALUES', 'Confirmez la suppression de TOUTES LES valeurs d\'option de produit pour le nom d\'option ...');
  define('TEXT_INFO_PRODUCT_NAME', '<strong>Nom du produit: </strong>');
  define('TEXT_INFO_PRODUCTS_OPTION_NAME', '<strong>Nom de l\'Option: </strong>');
  define('TEXT_INFO_PRODUCTS_OPTION_ID', '<strong>ID#</strong>');
  define('SUCCESS_ATTRIBUTES_DELETED_OPTION_NAME_VALUES', 'Suppression riussie de toutes les valeurs d\'option pour le nom d\'option  ');
?>