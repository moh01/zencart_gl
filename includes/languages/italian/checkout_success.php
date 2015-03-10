<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: checkout_success.php 3198 2006-03-18 00:36:08Z Albigin $
 */

define('NAVBAR_TITLE_1', 'Conferma Ordine');
define('NAVBAR_TITLE_2', 'Ordine confermato - Grazie');

define('HEADING_TITLE', 'Arrivederci! Torna a trovarci');

define('TEXT_SUCCESS', 'Qui puoi inserire indicazioni sui tempi di consegna od altro. Per modificare questo testo: <strong>includes/ languages/ TUA_LINGUA/ checkout_success.php</strong>');
define('TEXT_NOTIFY_PRODUCTS', 'Vorrei essere aggiornato per:');
define('TEXT_SEE_ORDERS', 'Puoi visualizzare lo storico dei tuoi ordini andando alla pagina <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">Il tuo account</a> e cliccando su Visualizza tutti gli ordini.');
define('TEXT_CONTACT_STORE_OWNER', 'Per informazioni o problemi scrivi al <a href="' . zen_href_link(FILENAME_CONTACT_US) . '">servizio clienti</a>.');
define('TEXT_THANKS_FOR_SHOPPING', 'Grazie per aver fatto acquisti Online con noi!');

define('TABLE_HEADING_COMMENTS', '');

define('TABLE_HEADING_DOWNLOAD_DATE', 'Link scade:');
define('TABLE_HEADING_DOWNLOAD_COUNT', 'Download rimanenti:');
define('HEADING_DOWNLOAD', 'Scarica i tuoi prodotti da qui:');
define('FOOTER_DOWNLOAD', 'Puoi anche scaricare i tuoi prodotti in un secondo tempo da \'%s\'');

define('TABLE_HEADING_DOWNLOAD_FILENAME','Download del prodotto:');
define('TEXT_YOUR_ORDER_NUMBER', '<strong>Il Numero del tuo ordine &egrave;:</strong> ');
?>