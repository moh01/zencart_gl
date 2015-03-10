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
//  $Id: developers_tool_kit.php 1105 2005-04-04 22:05:35Z birdbrain $
//
  define('HEADING_TITLE', 'Outils du D&eacute;veloppeur');
  define('TABLE_CONFIGURATION_TABLE', 'Recherche de D&eacute;finitions de CONSTANTES');

  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_PRICE_SORTER', '<strong>Succ&egrave;s</strong> de l\'Actualisation des Valeurs de Classement du prix des Produits');

  define('ERROR_CONFIGURATION_KEY_NOT_FOUND', '<strong>Erreur:</strong> aucune clef de configuration ne correspond.');
  define('ERROR_CONFIGURATION_KEY_NOT_ENTERED', '<strong>Erreur:</strong> aucune clef de configuration ou texte n\'ont &eacute;t&eacute; entr&eacute;s ... recherche termin&eacute;e');

  define('TEXT_INFO_PRODUCTS_PRICE_SORTER_UPDATE', '<strong>Actualiser TOUS les Classements de produits</strong><br />pour afficher un Classement par Prix: ');

  define('TEXT_CONFIGURATION_CONSTANT', '<strong>Look-up CONSTANT ou defines des fichiers de langues</strong>');
  define('TEXT_CONFIGURATION_KEY', 'Clef ou Nom:');
  define('TEXT_INFO_CONFIGURATION_UPDATE', '<strong>NOTE:</strong> Les CONSTANTES sont &eacute;crites en majuscules.<br />Les lookups de fichiers de langues, fonctions, classes, etc. sont activ&eacute;s lorsqu\'aucune information n\'a &eacute;t&eacute; trouv&eacute;e dans les tables de la base de donnn&eacute;es, si l\'option est retenue');

  define('TABLE_TITLE_KEY', '<strong>Clef:</strong>');
  define('TABLE_TITLE_TITLE', '<strong>Titre:</strong>');
  define('TABLE_TITLE_DESCRIPTION', '<strong>Description:</strong>');
  define('TABLE_TITLE_GROUP', '<strong>Groupe:</strong>');
  define('TABLE_TITLE_VALUE', '<strong>Valeur:</strong>');

  define('TEXT_LOOKUP_NONE', 'Aucune');
  define('TEXT_INFO_SEARCHING', 'Recherche ');
  define('TEXT_INFO_FILES_FOR', ' fichiers... pour: ');
  define('TEXT_INFO_MATCHES_FOUND', 'R&eacute;sultat correpsondant: ');

  define('TEXT_LANGUAGE_LOOKUPS', 'Look-ups des fichiers de Langues:');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_LANGUAGE', 'Tous les fichiers de Langues pour ' . strtoupper($_SESSION['language']) . ' - Catalogue/Admin');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG', 'Tous les fichiers de Langues Principales - Catalogue (' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . 'english.php /french.php etc.)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG_TEMPLATE', 'Tous les fichiers de Langues Principales - ' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN', 'Tous les fichiers de Langues Principales - Admin (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . 'english.php /french.php etc.)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN_LANGUAGE', 'Tous les fichiers de Langues s&eacute;lectionn&eacute;s - Admin (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ALL', 'Tous les fichiers de Langues s&eacute;lectionn&eacute;s - Catalogue/Admin');

  define('TEXT_FUNCTION_CONSTANT', '<strong>Look-up fichiers Function or ou relatifs aux fichiers Function</strong>');
  define('TEXT_FUNCTION_LOOKUPS', 'Look-ups des les fichiers Function:');
  define('TEXT_FUNCTION_LOOKUP_CURRENT', 'Tous les les fichiers Function - Catalogue/Admin');
  define('TEXT_FUNCTION_LOOKUP_CURRENT_CATALOG', 'Tous les les fichiers Function - Catalogue');
  define('TEXT_FUNCTION_LOOKUP_CURRENT_ADMIN', 'Tous les les fichiers Function - Admin');

  define('TEXT_CLASS_CONSTANT', '<strong>Look-up des fichiers Classes ou relatifs aux Classes</strong>');
  define('TEXT_CLASS_LOOKUPS', 'Look-ups des fichiers Classes:');
  define('TEXT_CLASS_LOOKUP_CURRENT', 'Tous les fichiers Classes - Catalogue/Admin');
  define('TEXT_CLASS_LOOKUP_CURRENT_CATALOG', 'Tous les fichiers Classes - Catalogue');
  define('TEXT_CLASS_LOOKUP_CURRENT_ADMIN', 'Tous les fichiers Classes - Admin');

  define('TEXT_TEMPLATE_CONSTANT', '<strong>Look-up des fichiers relatifs au Template ou relatifs aux Templates</strong>');
  define('TEXT_TEMPLATE_LOOKUPS', 'Look-ups des fichiers de Template:');
  define('TEXT_TEMPLATE_LOOKUP_CURRENT', 'Tous les fichiers de Template - /templates blocs lat&eacute;raux /pages etc.');
  define('TEXT_TEMPLATE_LOOKUP_CURRENT_TEMPLATES', 'Tous les fichiers de Template - /templates');
  define('TEXT_TEMPLATE_LOOKUP_CURRENT_SIDEBOXES', 'Tous les fichiers de Template - /blocs lat&eacute;raux');
  define('TEXT_TEMPLATE_LOOKUP_CURRENT_PAGES', 'Tous les fichiers de Template - /pages');

  define('TEXT_ALL_FILES_CONSTANT', '<strong>Look-up de tous les fichiers</strong>');
  define('TEXT_ALL_FILES_LOOKUPS', 'Look-ups de Tous les fichiers:');
  define('TEXT_ALL_FILES_LOOKUP_CURRENT', 'Tous les fichiers - Catalogue/Admin');
  define('TEXT_ALL_FILES_LOOKUP_CURRENT_CATALOG', 'Tous les fichiers - Catalogue');
  define('TEXT_ALL_FILES_LOOKUP_CURRENT_ADMIN', 'Tous les fichiers - Admin');

  define('TEXT_INFO_NO_EDIT_AVAILABLE','Aucune Edition disponible');
  define('TEXT_INFO_CONFIGURATION_HIDDEN', ' ou, CACHE');
?>