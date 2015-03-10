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
//  $Id: orders.php 2652 2005-12-22 18:30:59Z Albigin $
//

define('HEADING_TITLE', 'Ordini');
define('HEADING_TITLE_SEARCH', 'ID Ordini:');
define('HEADING_TITLE_STATUS', 'Stato:');

define('TABLE_HEADING_PAYMENT_METHOD', 'Modalit&agrave; pagamento');
define('TABLE_HEADING_ORDERS_ID','ID');

define('TEXT_BILLING_SHIPPING_MISMATCH','Fatturazione e Spedizione non corrispondono ');

define('TABLE_HEADING_COMMENTS', 'Commenti');
define('TABLE_HEADING_CUSTOMERS', 'Clienti');
define('TABLE_HEADING_ORDER_TOTAL', 'Totale Ordine');
define('TABLE_HEADING_DATE_PURCHASED', 'Data Acquisto');
define('TABLE_HEADING_STATUS', 'Stato');
define('TABLE_HEADING_TYPE', 'Tipo Ordine');
define('TABLE_HEADING_ACTION', 'Azione');
define('TABLE_HEADING_QUANTITY', 'Q.t&agrave;');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Modello');
define('TABLE_HEADING_PRODUCTS', 'Prodotti');
define('TABLE_HEADING_TAX', 'Tassa');
define('TABLE_HEADING_TOTAL', 'Totale');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Prezzo (esc)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Prezzo (inc)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Totale (esc)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Totale (inc)');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Cliente Avvisato');
define('TABLE_HEADING_DATE_ADDED', 'Inserito il');

define('ENTRY_CUSTOMER', 'Cliente:');
define('ENTRY_SOLD_TO', 'VENDUTO A:');
define('ENTRY_DELIVERY_TO', 'Consegnare a:');
define('ENTRY_SHIP_TO', 'SPEDIRE A:');
define('ENTRY_SHIPPING_ADDRESS', 'Indirizzo Spedizione:');
define('ENTRY_BILLING_ADDRESS', 'Indirizzo Fatturazione:');
define('ENTRY_PAYMENT_METHOD', 'Metodo Pagamento:');
define('ENTRY_CREDIT_CARD_TYPE', 'Tipo Carta Credito:');
define('ENTRY_CREDIT_CARD_OWNER', 'Titolare Carta Credito:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Numero Carta Credito:');
define('ENTRY_CREDIT_CARD_CVV', 'Numero CVV Carta Credito:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Scadenza Carta Credito:');
define('ENTRY_SUB_TOTAL', 'Totale Parziale:');
define('ENTRY_TAX', 'Tassa:');
define('ENTRY_SHIPPING', 'Spedizione:');
define('ENTRY_TOTAL', 'Totale:');
define('ENTRY_DATE_PURCHASED', 'Data Acquisto:');
define('ENTRY_STATUS', 'Stato:');
define('ENTRY_DATE_LAST_UPDATED', 'Ultimo Aggiornamento il:');
define('ENTRY_NOTIFY_CUSTOMER', 'Informa Cliente:');
define('ENTRY_NOTIFY_COMMENTS', 'Aggiungi Commenti:');
define('ENTRY_PRINTABLE', 'Stampa Fattura');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Cancella Ordine');
define('TEXT_INFO_DELETE_INTRO', 'Davvero vuoi cancellare questo ordine?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Reimmetti in magazzino');
define('TEXT_DATE_ORDER_CREATED', 'Data Creazione:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Ultima Modifica:');
define('TEXT_INFO_PAYMENT_METHOD', 'Metodo Pagamento:');
define('TEXT_PAID', 'Pagato');
define('TEXT_UNPAID', 'Non pagato');

define('TEXT_ALL_ORDERS', 'Tutti gli Ordini');
define('TEXT_NO_ORDER_HISTORY', 'Nessuna Cronologia Ordini');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Aggiornamento Ordine');
define('EMAIL_TEXT_ORDER_NUMBER', 'Numero Ordine:');
define('EMAIL_TEXT_INVOICE_URL', 'Fattura Dettagliata:');
define('EMAIL_TEXT_DATE_ORDERED', 'Data Ordine:');
define('EMAIL_TEXT_COMMENTS_UPDATE', '<em>I commenti al tuo ordine sono: </em>');
define('EMAIL_TEXT_STATUS_UPDATED', 'Il tuo ordine � stato aggiornato allo stato:' . "\n");
define('EMAIL_TEXT_STATUS_LABEL', '<strong>Nuovo stato:</strong> %s' . "\n\n");
define('EMAIL_TEXT_STATUS_PLEASE_REPLY', 'Se hai domande da porre rispondi pure a questa Email.' . "\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Errore: Ordine non esistente.');
define('SUCCESS_ORDER_UPDATED', 'Fatto: Ordine aggiornato regolarmente.');
define('WARNING_ORDER_NOT_UPDATED', 'Avviso: nulla da cambiare. Ordine non aggiornato.');

define('ENTRY_ORDER_ID','Fattura #');
define('TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;<span class="alert">GRATIS</span>');

define('TEXT_DOWNLOAD_TITLE', 'Stato Ordine Download');
define('TEXT_DOWNLOAD_STATUS', '');
define('TEXT_DOWNLOAD_FILENAME', 'Nome File');
define('TEXT_DOWNLOAD_MAX_DAYS', 'Giorni');
define('TEXT_DOWNLOAD_MAX_COUNT', 'Count');

define('TEXT_DOWNLOAD_AVAILABLE', 'Disponibile');
define('TEXT_DOWNLOAD_EXPIRED', 'Scaduto');
define('TEXT_DOWNLOAD_MISSING', 'Non sul Server');


define('SUCCESS_ORDER_UPDATED_DOWNLOAD_ON', 'Il download &egrave; stato abilitato con successo');
define('SUCCESS_ORDER_UPDATED_DOWNLOAD_OFF', 'Il download &egrave; stato disabilitato con successo');
define('TEXT_MORE', '... altro');

define('TEXT_INFO_IP_ADDRESS', 'Indirizzo IP: ');
define('TEXT_DELETE_CVV_FROM_DATABASE','Cancella CVV dal database');
define('TEXT_DELETE_CVV_REPLACEMENT','Cancellato');
define('TEXT_MASK_CC_NUMBER','Maschera questo numero');
?>