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
//  $Id: options_name_manager.php 2181 2005-10-20 18:37:16Z ajeh $
//

  define('HEADING_TITLE_OPT', 'Options des Produits');
  define('HEADING_TITLE_VAL', 'Valeurs des Options');
  define('HEADING_TITLE_ATRIB', 'Attributs des Produits');

  define('TABLE_HEADING_ID', 'ID');
  define('TABLE_HEADING_PRODUCT', 'Nom du Produit');
  define('TABLE_HEADING_OPT_NAME', 'Nom de l\'Option');
  define('TABLE_HEADING_OPT_VALUE', 'Valeur de l\'Option');
  define('TABLE_HEADING_OPT_PRICE', 'Prix');
  define('TABLE_HEADING_OPT_PRICE_PREFIX', 'Pr&&eacute;fixe');
  define('TABLE_HEADING_ACTION', 'Action');
  define('TABLE_HEADING_DOWNLOAD', 'Produits t&&eacute;l&&eacute;chargeables:');
  define('TABLE_TEXT_FILENAME', 'Fichier:');
  define('TABLE_TEXT_MAX_DAYS', 'Jours avant Expiration:');
  define('TABLE_TEXT_MAX_COUNT', 'Nombre Maximum de T&&eacute;l&&eacute;chargements:');

  define('TEXT_WARNING_OF_DELETE', 'Cette option poss&egrave;de des liens avec des Produits et des Valeurs - il est recommand&eacute; de ne pas la supprimer.');
  define('TEXT_OK_TO_DELETE', 'Cette option ne poss&egrave;de aucun Produit ou Valeur li&eacute;s - vous pouvez donc la supprimer.');
  define('TEXT_OPTION_ID', 'ID d\'Option ');
  define('TEXT_OPTION_NAME', 'Nom de l\'Option ');
  define('TABLE_HEADING_OPT_DISCOUNTED','Remis&eacute;');

  define('ATTRIBUTE_WARNING_DUPLICATE','Duplication d\'Attribut - l\'Attribut n\'a pas &eacute;t&eacute; ajout&eacute;'); // attributes duplicate warning
  define('ATTRIBUTE_WARNING_DUPLICATE_UPDATE','La duplication de cet Attribut existe d&eacute;j&agrave;
 - Attribut non modifi&eacute;'); // attributes duplicate warning
  define('ATTRIBUTE_WARNING_INVALID_MATCH','L\'Option d\'Attribut et la Valeur d\'Option NE correspondent pas - l\'Attribut n\'a pas &&eacute;t&&eacute; ajout&&eacute;'); // miss matched option and options value
  define('ATTRIBUTE_WARNING_INVALID_MATCH_UPDATE','L\'Option d\'Attribut et la Valeur d\'Option ne correspondent pas - Attribut non modifi&eacute;'); // miss matched option and options value
  define('ATTRIBUTE_POSSIBLE_OPTIONS_NAME_WARNING_DUPLICATE','Possible Duplication des Noms des Options Ajout&eacute;es'); // Options Name Duplicate warning
  define('ATTRIBUTE_POSSIBLE_OPTIONS_VALUE_WARNING_DUPLICATE','Possible Duplication des Valeurs d\'Options Ajout&eacute;es'); // Options Value Duplicate warning

  define('PRODUCTS_ATTRIBUTES_EDITING','EDITION'); // title
  define('PRODUCTS_ATTRIBUTES_DELETE','EFFACEMENT'); // title
  define('PRODUCTS_ATTRIBUTES_ADDING','AJOUT DE NOUVEAUX ATTRIBUTS'); // title
  define('TEXT_DOWNLOADS_DISABLED','NOTE: les T&eacute;l&eacute;chargements sont d&eacute;sactiv&eacute;s');

  define('TABLE_TEXT_MAX_DAYS_SHORT', 'Jours:');
  define('TABLE_TEXT_MAX_COUNT_SHORT', 'Max:');

  define('TABLE_HEADING_OPTION_SORT_ORDER','Classement');
  define('TABLE_HEADING_OPTION_VALUE_SORT_ORDER','Classement par d&eacute;faut');
  define('TEXT_SORT',' Classement: ');

  define('TABLE_HEADING_OPT_WEIGHT_PREFIX','Pr&&eacute;fixe');
  define('TABLE_HEADING_OPT_WEIGHT','Poids');
  define('TABLE_HEADING_OPT_SORT_ORDER','Classement');
  define('TABLE_HEADING_OPT_DEFAULT','D&&eacute;faut');

  define('TABLE_HEADING_YES','Oui');
  define('TABLE_HEADING_NO','Non');

  define('TABLE_HEADING_OPT_TYPE', 'Type d\'Option'); //CLR 031203 add option type column
  define('TABLE_HEADING_OPTION_VALUE_SIZE','Taille');
  define('TABLE_HEADING_OPTION_VALUE_MAX','Max');
  define('TABLE_HEADING_OPTION_VALUE_ROWS','Rangs');
  define('TABLE_HEADING_OPTION_VALUE_COMMENTS','Commentaires');

  define('TEXT_OPTION_VALUE_COMMENTS','Commentaires: ');
  define('TEXT_OPTION_VALUE_SIZE','Afficher la Taille: ');
  define('TEXT_OPTION_VALUE_MAX','Longueur Maximum: ');

  define('TEXT_ATTRIBUTES_IMAGE','Swatch des Images d\'Attributs:');
  define('TEXT_ATTRIBUTES_IMAGE_DIR','R&&eacute;pertoire des Images d\'Attributs:');

  define('TEXT_ATTRIBUTES_FLAGS','Attribut<br />Drapeaux:');
  define('TEXT_ATTRIBUTES_DISPLAY_ONLY', 'Utilis&&eacute; Pour<br />affichage seulement:');
  define('TEXT_ATTRIBUTES_IS_FREE', 'L\'Attribut est Gratuit<br />lorsque le Produit est Gratuit:');
  define('TEXT_ATTRIBUTES_DEFAULT', 'L\'Attribut par D&&eacute;faut<br />est s&&eacute;lectionn&&eacute;:');
  define('TEXT_ATTRIBUTE_IS_DISCOUNTED', 'Appliquer les Remises Utilis&&eacute;es<br />par Promotion/Vente:');
  define('TEXT_ATTRIBUTE_PRICE_BASE_INCLUDED','Inclure dans le Prix de Base<br />lorsque Prix par Attributs');

  define('TEXT_PRODUCT_OPTIONS_INFO','Edition des Options de Produits pour des R&eacute;glages compl&eacute;mentaires');

// updates
  define('ERROR_PRODUCTS_OPTIONS_VALUES', 'ATTENTION: aucun produit trouv&eacute;... aucune actualisation');

  define('TEXT_SELECT_PRODUCT', 'S&eacute;lectionnez un Produit');
  define('TEXT_SELECT_CATEGORY', 'S&eacute;lectionnez une Cat&eacute;gorie');
  define('TEXT_SELECT_OPTION', 'S&eacute;lectionnez un Nom d\'Option');

// add
  define('TEXT_OPTION_VALUE_ADD_ALL', '<br /><strong>Ajouter TOUTES les Valeurs d\'Options &agrave; TOUS les Produits pour Nom d\'Option</strong>');
  define('TEXT_INFO_OPTION_VALUE_ADD_ALL', 'Actualiser TOUS les Produits existants qui poss&egrave;dent au moins UNE Valeur d\'Option et Ajouter TOUTES les Valeurs d\'Options dans un Nom d\'Option');
define('SUCCESS_PRODUCTS_OPTIONS_VALUES', 'Mise &agrave; jour des options r&eacute;ussie ');
  define('TEXT_OPTION_VALUE_ADD_PRODUCT', '<br /><strong>Ajouter TOUTES les Valeurs d\'Options &agrave; UN Produit pour Nom d\'Option</strong>');
  define('TEXT_INFO_OPTION_VALUE_ADD_PRODUCT', 'Actualiser UN Produit qui poss&egrave;de au moins UNE Valeur d\'Option et Ajouter TOUTES les Valeurs d\'Options dans un Nom d\'Option');

  define('TEXT_OPTION_VALUE_ADD_CATEGORY', '<br /><strong>Ajouter TOUTES les Valeurs d\'Options &agrave; UNE Cat&eacute;gorie de Produits pour Nom d\'Option</strong>');
  define('TEXT_INFO_OPTION_VALUE_ADD_CATEGORY', 'Actualiser une Cat&eacute;gorie de Produits, lorsque le Produit poss&egrave;de au moins UNE Valeur d\'Option et Ajouter TOUTES les Valeurs d\'Options dans un Nom d\'Option');

  define('TEXT_COMMENT_OPTION_VALUE_ADD_ALL', '<strong>NOTE:</strong> Le Classement attribu&eacute; sera le Classement par D&eacute;faut des Valeurs d\'Option pour ces Produits ');

// delete
  define('TEXT_OPTION_VALUE_DELETE_ALL', '<br /><strong>Effacer TOUTES les Valeurs d\'Options &agrave; TOUS les Produits pour Nom d\'Option</strong>');
  define('TEXT_INFO_OPTION_VALUE_DELETE_ALL', 'Actualiser TOUS les Produits existants qui poss&egrave;dent au moins UNE Valeur d\'Option et effacer TOUTES les Valeurs d\'Options dans un Nom d\'Option');

  define('TEXT_OPTION_VALUE_DELETE_PRODUCT', '<br /><strong>Effacer TOUTES les Valeurs d\'Options &agrave; UN Produit pour Nom d\'Option</strong>');
  define('TEXT_INFO_OPTION_VALUE_DELETE_PRODUCT', 'Actualiser UN Produit qui poss&egrave;de au moins UNE Valeur d\'Option et effacer TOUTES les Valeurs d\'Options dans un Nom d\'Option');

  define('TEXT_OPTION_VALUE_DELETE_CATEGORY', '<br /><strong>Effacer TOUTES les Valeurs d\'Options &agrave; UNE Cat&eacute;gorie de Produits pour Nom d\'Option</strong>');
  define('TEXT_INFO_OPTION_VALUE_DELETE_CATEGORY', 'Actualiser UNE Cat&eacute;gorie de Produits, lorsque le Produit poss&egrave;de au moins UNE Valeur d\'Option et effacer TOUTES les Valeurs d\'Options dans un Nom d\'Option');

  define('TEXT_COMMENT_OPTION_VALUE_DELETE_ALL', '<strong>NOTE:</strong> Toutes les Valeurs d\'Options de Noms d\'Options seront effac&eacute;es pour le(s) produit(s) s&eacute;lectionn&eacute;(s). Cette op&eacute;ration n\'effacera pas les r&eacute;glages des Valeurs d\'Options.');

  define('TEXT_OPTION_VALUE_COPY_ALL', '<strong>Copier toutes les valeurs d\'Options vers un autre Nom d\'Option</strong>');
  define('TEXT_INFO_OPTION_VALUE_COPY_ALL', 'Toutes les Valeurs d\'Option seront copi&eacute;es depuis un Nom d\'Option vers un autre Nom d\'Option');
  define('TEXT_SELECT_OPTION_FROM', 'Copier depuis un Nom d\'Option: ');
  define('TEXT_SELECT_OPTION_TO', 'Copier Toutes les Valeurs d\'Options vers un Nom d\'Option: ');
  define('SUCCESS_OPTION_VALUES_COPIED', 'Copie R&eacute;alis&eacute;e ! ');
  define('ERROR_OPTION_VALUES_COPIED', 'Erreur - Impossible de copier les Valeurs d\'Option vers le m&ecirc;
me Nom d\'Option ! ');
  define('ERROR_OPTION_VALUES_NONE', 'Erreur - Copie depuis un Nom d\'Option qui ne contient aucune Valeur d&eacute;finie. Copie Impossible ! ');
  define('TEXT_WARNING_BACKUP', 'Important: sauvegardez votre base et les modifications !');

  define('TEXT_OPTION_ATTRIBUTE_IMAGES_PER_ROW', 'Images d\'Attributs par rang&eacute;e: ');
  define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE', 'Styles d\'Attributs pour les boutons radio et cases &agrave; cocher: ');
  define('TEXT_OPTION_ATTIBUTE_MAX_LENGTH', '<strong>Longueur Max et Taille Affich&eacute;e seulement pour les Attributs Texte:</strong><br />');
  define('TEXT_OPTION_IMAGE_STYLE', '<strong>Styles d\'Images:</strong>');
  define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_0', '0 = Les Images Sous le Nom de l\'Option');
  define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_1', '1 = L\'Element, l\'Image et la Valeur de l\'Option');
  define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_2', '2 = l\'Element, l\'Image et le Nom de l\'Option en-dessous');
  define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_3', '3 = Le Nom de l\'Option sous l\'Element et l\'Image');
  define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_4', '4 = L\'Element sous l\'Image et le Nom de l\'Option');
  define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_5', '5 = L\'Element au-dessus de l\'Image et du Nom de l\'Option');
?>