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
//  $Id: developers_tool_kit.php 1105 2005-04-04 22:05:35Z Albigin $
//
  define('HEADING_TITLE', 'Developers Tool Kit');
  define('TABLE_CONFIGURATION_TABLE', 'Vedi definizioni COSTANTI');

  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_PRICE_SORTER', '<strong>Eseguito</strong> aggiornamento per Products Price Sorter');

  define('ERROR_CONFIGURATION_KEY_NOT_FOUND', '<strong>Errore:</strong> Non sono state rilevate Configuration Keys corrispondenti ...');
  define('ERROR_CONFIGURATION_KEY_NOT_ENTERED', '<strong>Errore:</strong> Noon sono stati inseriti testi o Configuration Key da ricercare ... Ricerca chiusa');

  define('TEXT_INFO_PRODUCTS_PRICE_SORTER_UPDATE', '<strong>Aggiorna TUTTI i Products Price Sorter</strong><br />per poter elencare per prezzi impostati: ');

  define('TEXT_CONFIGURATION_CONSTANT', '<strong>Look-up CONSTANT or Language File defines</strong>');
  define('TEXT_CONFIGURATION_KEY', 'Chiave o nome:');
  define('TEXT_INFO_CONFIGURATION_UPDATE', '<strong>NOTE:</strong> CONSTANTS are written in uppercase.<br />Language file, functions, classes, etc. lookups are performed when nothing has been found in the database tables, if selected in dropdown');

  define('TABLE_TITLE_KEY', '<strong>Chiave:</strong>');
  define('TABLE_TITLE_TITLE', '<strong>Titolo:</strong>');
  define('TABLE_TITLE_DESCRIPTION', '<strong>Descrizione:</strong>');
  define('TABLE_TITLE_GROUP', '<strong>Gruppo:</strong>');
  define('TABLE_TITLE_VALUE', '<strong>Valore:</strong>');

  define('TEXT_LOOKUP_NONE', 'Nessuno');
  define('TEXT_INFO_SEARCHING', 'Ricerca in corso ');
  define('TEXT_INFO_FILES_FOR', ' file ... per: ');
  define('TEXT_INFO_MATCHES_FOUND', 'Match Lines found: ');

  define('TEXT_LANGUAGE_LOOKUPS', 'Language File Look-ups:');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_LANGUAGE', 'Tutti i file di lingua per ' . strtoupper($_SESSION['language']) . ' - Catalog/Admin');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG', 'Tutti i principali file di lingua - Catalog (' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . 'english.php /espanol.php etc.)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG_TEMPLATE', 'All Current Selected Language Files - ' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN', 'Tutti i principali file di lingua - Admin (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . 'english.php /espanol.php etc.)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN_LANGUAGE', 'All Current Selected Language Files - Admin (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ALL', 'All Current Selected Language files - Catalogo/Admin');

  define('TEXT_FUNCTION_CONSTANT', '<strong>Look-up Functions or things in Function files</strong>');
  define('TEXT_FUNCTION_LOOKUPS', 'Function File Look-ups:');
  define('TEXT_FUNCTION_LOOKUP_CURRENT', 'All Function files - Catalogo/Admin');
  define('TEXT_FUNCTION_LOOKUP_CURRENT_CATALOG', 'All Functions files - Catalogo');
  define('TEXT_FUNCTION_LOOKUP_CURRENT_ADMIN', 'All Functions files - Admin');

  define('TEXT_CLASS_CONSTANT', '<strong>Look-up Classes or things in Classes files</strong>');
  define('TEXT_CLASS_LOOKUPS', 'Classes File Look-ups:');
  define('TEXT_CLASS_LOOKUP_CURRENT', 'All Classes files - Catalogo/Admin');
  define('TEXT_CLASS_LOOKUP_CURRENT_CATALOG', 'All Classes files - Catalogo');
  define('TEXT_CLASS_LOOKUP_CURRENT_ADMIN', 'All Classes files - Admin');

  define('TEXT_TEMPLATE_CONSTANT', '<strong>Look-up Template things</strong>');
  define('TEXT_TEMPLATE_LOOKUPS', 'Template File Look-ups:');
  define('TEXT_TEMPLATE_LOOKUP_CURRENT', 'All Template files - /templates sideboxes /pages etc.');
  define('TEXT_TEMPLATE_LOOKUP_CURRENT_TEMPLATES', 'All Template files - /templates');
  define('TEXT_TEMPLATE_LOOKUP_CURRENT_SIDEBOXES', 'All Template files - /sideboxes');
  define('TEXT_TEMPLATE_LOOKUP_CURRENT_PAGES', 'All Template files - /pages');

  define('TEXT_ALL_FILES_CONSTANT', '<strong>Look-up in all files</strong>');
  define('TEXT_ALL_FILES_LOOKUPS', 'All Files Look-ups:');
  define('TEXT_ALL_FILES_LOOKUP_CURRENT', 'All Files - Catalogo/Admin');
  define('TEXT_ALL_FILES_LOOKUP_CURRENT_CATALOG', 'All Files - Catalogo');
  define('TEXT_ALL_FILES_LOOKUP_CURRENT_ADMIN', 'All Files - Admin');

  define('TEXT_INFO_NO_EDIT_AVAILABLE','No edit available');
  define('TEXT_INFO_CONFIGURATION_HIDDEN', ' or, HIDDEN');
?>