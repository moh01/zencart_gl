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
//  $Id: options_values_manager.php 1148 2005-04-07 19:24:10Z drbyte $
//

  define('HEADING_TITLE_OPT', 'Options de Produits');
  define('HEADING_TITLE_VAL', 'Valeurs des Options');
  define('HEADING_TITLE_ATRIB', 'Contr&ocirc;le des Attributs');

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

  define('TEXT_WARNING_OF_DELETE', 'Cette option poss&egrave;de des liens avec des Produits et des Valeurs - il n\'est donc pas recommand&eacute; de la supprimer.');
  define('TEXT_OK_TO_DELETE', 'Cette option ne poss&egrave;de aucun Produit ou Valeur qui lui seraient li&eacute;s - vous pouvez donc la supprimer.');
  define('TEXT_OPTION_ID', 'ID d\'Option ');
  define('TEXT_OPTION_NAME', 'Nom de l\'Option ');
  define('TABLE_HEADING_OPT_DISCOUNTED','Remis&eacute;');

  define('ATTRIBUTE_WARNING_DUPLICATE','Duplication d\'Attribut - l\'Attribut n\'a pas &eacute;t&eacute; ajout&eacute;'); // attributes duplicate warning
  define('ATTRIBUTE_WARNING_DUPLICATE_UPDATE','La duplication d\'Attribut existe d&eacute;j&agrave; - l\'Attribut n\'a pas &eacute;t&eacute; modifi&eacute;'); // attributes duplicate warning
  define('ATTRIBUTE_WARNING_INVALID_MATCH','L\'Option d\'Attribut et la Valeur d\'Option NE correspondent pas - l\'Attribut n\'a pas &eacute;t&eacute; ajout&eacute;'); // miss matched option and options value
  define('ATTRIBUTE_WARNING_INVALID_MATCH_UPDATE','L\'Option d\'Attribut et la Valeur d\'Option NE correspondent pas - l\'Attribut n\'a pas &eacute;t&eacute; modifi&eacute;'); // miss matched option and options value
  define('ATTRIBUTE_POSSIBLE_OPTIONS_NAME_WARNING_DUPLICATE','Possible Duplication des Noms des Options Ajout&eacute;es'); // Options Name Duplicate warning
  define('ATTRIBUTE_POSSIBLE_OPTIONS_VALUE_WARNING_DUPLICATE','Possible Duplication des Valeurs d\Options Ajout&eacute;es'); // Options Value Duplicate warning

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
  define('TEXT_ATTRIBUTES_IMAGE_DIR','R&eacute;pertoire des Images d\'Attributs:');

  define('TEXT_ATTRIBUTES_FLAGS','Attribut<br />Drapeaux:');
  define('TEXT_ATTRIBUTES_DISPLAY_ONLY', 'Utilis&eacute; Pour<br />affichage seulement:');
  define('TEXT_ATTRIBUTES_IS_FREE', 'L\'Attribut est Gratuit<br />lorsque le produit est Gratuit:');
  define('TEXT_ATTRIBUTES_DEFAULT', 'L\'Attribut par D&eacute;faut<br />est s&eacute;lectionn&eacute;:');
  define('TEXT_ATTRIBUTE_IS_DISCOUNTED', 'Appliquer les Remises Utilis&eacute;es<br />par Promotion/Vente:');
  define('TEXT_ATTRIBUTE_PRICE_BASE_INCLUDED','Inclure dans le Prix de Base<br />lorsque prix par Attributs');

  define('TEXT_PRODUCT_OPTIONS_INFO','Edition des Options de Produits pour des R&eacute;glages compl&eacute;mentaires');

// Option Names/Values copier from one to another
  define('TEXT_OPTION_VALUE_COPY_ALL', '<strong>Copier vers TOUS les Produits ou le Nom et la Valeur de l\'Option...</strong>');
  define('TEXT_INFO_OPTION_VALUE_COPY_ALL', 'S&eacute;lectionner une Valeur et un Nom d\'Option existant pour un Produit ou des Produits que vous souahitez ensuite copier vers une autre Valeur et Nom d\'Option (pour TOUS les products poss&eacute;dant une Valeur et un Nom d\'Option');
  define('TEXT_SELECT_OPTION_FROM', 'Nom d\'Option:');
  define('TEXT_SELECT_OPTION_VALUES_FROM', 'Valeur d\'Option:');
  define('TEXT_SELECT_OPTION_TO', 'Nom d\'Option &agrave; ajouter:');
  define('TEXT_SELECT_OPTION_VALUES_TO', 'Valeur d\'Option &agrave; ajouter:');
  define('TEXT_SELECT_OPTION_VALUES_TO_CATEGORIES_ID', 'Laisser vide pour TOUS les Produits<br />entrer un ID de Cat&eacute;gorie pour les Produits &agrave; actualiser');

// Option Name/Value to Option Name for Category with Product defaults
  define('TEXT_OPTION_VALUE_COPY_OPTIONS_TO', '<strong>Copier le Nom/Valeur de l\'Option vers les Produits avec Nom de l\'Option existante...</strong>');
  define('TEXT_INFO_OPTION_VALUE_COPY_OPTIONS_TO', 'S&eacute;lectionner un Nom et Valeur d\'Option qui existant pour un Produit ou des Produits &agrave; ajouter &agrave; tous les Produits ou &agrave; tous les Produits d\'une Cat&eacute;gorie s&eacute;lectionn&eacute;e poss&eacute;dant le Nom de l\'Option.
                                                   <br /><strong>Exemple:</strong> Ajouter un Nom d\'Option: Valeur de l\'Option Couleur: Rouge &agrave; Tous les Produits poss&eacute;dant le Nom d\'Option: Taille
                                                   <br /><strong>Exemple:</strong> Ajouter un Nom d\'Option: Valeur de l\'Option Couleur: Vert avec les Valeurs par d&eacute;faut depuis le Produit ID: 34 vers Tous les Produits poss&eacute;dant le Nom d\'Option: Taille
                                                   <br /><strong>Exemple:</strong> Ajouter un Nom d\'Option: Valeur de l\'Option Couleur: Vert avec les Valeurs par d&eacute;faut depuis le Produit ID: 34 vers Tous les Produits poss&eacute;dant le Nom d\'Option: Taille pour les Cat&eacute;gories ID: 65
        ');
  define('TEXT_SELECT_OPTION_TO_ADD_TO', 'Nom d\'Option &agrave; Ajouter &agrave;:');
  define('TEXT_SELECT_OPTION_FROM_ADD', 'Nom d\'Option &agrave; Ajouter:');
  define('TEXT_SELECT_OPTION_VALUES_FROM_ADD', 'Valeur d\'Option &agrave; Ajouter:');
  define('TEXT_SELECT_OPTION_FROM_PRODUCTS_ID', 'Nouvelles Valeurs d\'Attribut par d&eacute;faut depuis le Produit ID# ou laisser vide pour aucunes valeurs par d&eacute;faut:');
  define('TEXT_COPY_ATTRIBUTES_CONDITIONS','<strong>Comment les Attributs de Produit existants doivent-ils &ecirc;tre trait&eacute;s ?</strong>');
  define('TEXT_COPY_ATTRIBUTES_DELETE','<strong>Effacer</strong> d\'abord, puis copier les nouveaux Attributs');
  define('TEXT_COPY_ATTRIBUTES_UPDATE','<strong>Actualiser</strong> les Attributs existants avec les nouveaux r&eacute;glages/prix');
  define('TEXT_COPY_ATTRIBUTES_IGNORE','<strong>Ignorer</strong> les Attributs existants et ajouter seulement les nouveaux Attributs');

  define('TEXT_INFO_FROM', ' de: ');
  define('TEXT_INFO_TO', ' vers: ');
  define('ERROR_OPTION_VALUES_COPIED', 'Erreur: Duplication de Nom et de Valeur d\'Option');
  define('ERROR_OPTION_VALUES_COPIED_MISMATCH', 'Erreur: le Nom et la Valeur de cette Option ne correspondent pas');
  define('ERROR_OPTION_VALUES_NONE', 'Erreur: aucun &eacute;l&eacute;ment copiable');
define('SUCCESS_OPTION_VALUES_COPIED', 'Copie r&eacute;ussie! '); 
  define('ERROR_OPTION_VALUES_COPIED_MISMATCH_PRODUCTS_ID', 'Erreur: Manque de valeur/option de produit ID#');

  define('TEXT_OPTION_VALUE_DELETE_ALL', '<strong>Effacement de l\'Attribut de TOUS les Produits ou le Nom d\'Option et la Valeur...</strong>');
  define('TEXT_INFO_OPTION_VALUE_DELETE_ALL', 'S&eacute;lectionnez un Nom d\'Option et une Valeur existant pour un Produit ou des Produits que vous souahitez effacer de TOUS les Produits, ou TOUS les Produits d\'une Cat&eacute;gorie');
  define('TEXT_SELECT_DELETE_OPTION_FROM', 'Nom d\'Option:');
  define('TEXT_SELECT_DELETE_OPTION_VALUES_FROM', 'Valeur d\'Option:');

  define('ERROR_OPTION_VALUES_DELETE_MISMATCH', 'Erreur: le Nom et la Valeur de cette Option ne correspondent pas');

  define('SUCCESS_OPTION_VALUES_DELETE', 'Effacement avec succ&egrave;s de: ');
?>