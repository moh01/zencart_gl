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
//  $Id: currencies.php 1105 2005-04-04 22:05:35Z Albigin $
//

define('HEADING_TITLE', 'Valute');

define('TABLE_HEADING_CURRENCY_NAME', 'Valuta');
define('TABLE_HEADING_CURRENCY_CODES', 'Codice');
define('TABLE_HEADING_CURRENCY_VALUE', 'Valore');
define('TABLE_HEADING_ACTION', 'Azione');

define('TEXT_INFO_EDIT_INTRO', 'Effettua le modifiche necessarie');
define('TEXT_INFO_CURRENCY_TITLE', 'Titolo:');
define('TEXT_INFO_CURRENCY_CODE', 'Codice:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Simbolo Sinistra:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Simbolo Destra:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Punto Decimali:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Punto Migliaia:');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Cifre Decimali:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Ultimo Aggiornamento:');
define('TEXT_INFO_CURRENCY_VALUE', 'Valore:');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Esempio Risultato:');
define('TEXT_INFO_INSERT_INTRO', 'Inserire la nuova valuta con i relativi dati');
define('TEXT_INFO_DELETE_INTRO', 'Davvero vuoi cancellare questa valuta?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Nuova Valuta');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Modifica Valuta');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Cancella Valuta');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (richiede aggiornamento manuale dei valori della valuta)');
define('TEXT_INFO_CURRENCY_UPDATED', 'Il tasso di cambio per %s (%s) &egrave; stato aggiornato via %s.');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Errore: la valuta di default non pu&ograve; essere rimossa. Attribuire il default ad un\'altra valuta e riprovare.');
define('ERROR_CURRENCY_INVALID', 'Errore: il tasso di cambio per %s (%s) NON &egrave; stato aggiornato via %s. Il codice valuta &egrave; valido?');
define('WARNING_PRIMARY_SERVER_FAILED', 'Attenzione: Il primo server di tasso cambio (%s) non risponde per %s (%s) - prova il secondo server  di tasso cambio.'); 
?>