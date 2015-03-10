<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: shopping_cart.php 3183 2006-03-14 07:58:59Z Albigin $
 */

define('NAVBAR_TITLE', 'Contenuto carrello');
define('HEADING_TITLE', 'Ecco il contenuto del carrello:');
define('HEADING_TITLE_EMPTY', 'Il tuo Carrello');
define('TEXT_INFORMATION', 'Puoi voler aggiungere alcune istruzioni per l\'uso del carrello qui. (definito in includes/languages/italian/shopping_cart.php)');
define('TABLE_HEADING_REMOVE', 'Cancella');
define('TABLE_HEADING_QUANTITY', 'Qt.&agrave;');
define('TABLE_HEADING_MODEL', 'Modello');
define('TABLE_HEADING_PRICE','Prezzo');
define('TEXT_CART_EMPTY', 'Il tuo carrello &egrave; ancora vuoto.');
define('SUB_TITLE_SUB_TOTAL', 'Totale imponibile:');
define('SUB_TITLE_TOTAL', 'Totale:');

define('OUT_OF_STOCK_CANT_CHECKOUT', 'I prodotti segnalati con ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' sono esauriti oppure presenti in quantitativi insufficienti a soddisfare la tua richiesta.<br />Rivedi per favore il quantitativo dei prodotti contrassegnati come (' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '). Grazie');
define('OUT_OF_STOCK_CAN_CHECKOUT', 'I prodotti segnalati con ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' sono esauriti.<br />I prodotti esauriti saranno riordinati.');

define('TEXT_TOTAL_ITEMS', 'Totale prodotti: ');
define('TEXT_TOTAL_WEIGHT', '&nbsp;&nbsp;Peso: ');
define('TEXT_TOTAL_AMOUNT', '&nbsp;&nbsp;Ammontare: ');

define('TEXT_VISITORS_CART', '<a href="javascript:session_win();">[help (?)]</a>');
define('TEXT_OPTION_DIVIDER', '&nbsp;-&nbsp;');
?>