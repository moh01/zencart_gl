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
//  $Id: cache.php 1105 2005-04-04 22:05:35Z Albigin $
//

define('HEADING_TITLE', 'Comandi Cache');

define('TABLE_HEADING_CACHE', 'Blocco di Cache');
define('TABLE_HEADING_DATE_CREATED', 'Data Creazione');
define('TABLE_HEADING_ACTION', 'Azione');

define('TEXT_FILE_DOES_NOT_EXIST', 'Il File non esiste');
define('TEXT_CACHE_DIRECTORY', 'Cartella di Cache:');

define('ERROR_CACHE_DIRECTORY_DOES_NOT_EXIST', 'Errore: la Cartella di Cache NON esiste. Effettua settaggio in Configurazione->Cache.');
define('ERROR_CACHE_DIRECTORY_NOT_WRITEABLE', 'Errore: la Cartella di Cache NON &egrave; scrivibile.');
?>