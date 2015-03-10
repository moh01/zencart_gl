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
//  $Id: customers.php 1969 2005-10-04 06:57:21Z spike00 $
//

define('HEADING_TITLE', 'Clienti');

define('TABLE_HEADING_ID', 'ID#');
define('TABLE_HEADING_FIRSTNAME', 'Nome');
define('TABLE_HEADING_LASTNAME', 'Cognome');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Account Creato');
define('TABLE_HEADING_LOGIN', 'Ultimo Accesso');
define('TABLE_HEADING_ACTION', 'Azione');
define('TABLE_HEADING_PRICING_GROUP', 'Gruppo Prezzo');
define('TABLE_HEADING_AUTHORIZATION_APPROVAL', 'Autorizzato');

define('TEXT_DATE_ACCOUNT_CREATED', 'Account Creato:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Ultima Modifica:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Ultimo Accesso:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Numero degli Accessi:');
define('TEXT_INFO_COUNTRY', 'Paese:');
define('TEXT_INFO_NUMBER_OF_REVIEWS', 'Numero Recensioni:');
define('TEXT_DELETE_INTRO', 'Davvero vuoi cancellare questo Cliente?');
define('TEXT_DELETE_REVIEWS', 'Cancella %s recensioni');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Cancella Cliente');
define('TYPE_BELOW', 'Type below');
define('PLEASE_SELECT', 'Seleziona');
define('TEXT_INFO_NUMBER_OF_ORDERS', 'Numero Ordini:');
define('TEXT_INFO_LAST_ORDER','Ultimo Ordine:');
define('TEXT_INFO_ORDERS_TOTAL', 'Totale:');
define('CUSTOMERS_REFERRAL', 'Segnalazione Cliente<br />1° Buono Sconto');

define('ENTRY_NONE', 'Nessuno');

define('TABLE_HEADING_COMPANY','Azienda');

define('CUSTOMERS_AUTHORIZATION', 'Stato Autorizzazione Clienti');
define('CUSTOMERS_AUTHORIZATION_0', 'Approvato');
define('CUSTOMERS_AUTHORIZATION_1', 'In attesa di ok - Deve essere autorizzato a navigare');
define('CUSTOMERS_AUTHORIZATION_2', 'In attesa di ok - Naviga ma senza i prezzi');
define('CUSTOMERS_AUTHORIZATION_3', 'In attesa di ok - Vede i prezzi ma non acquista');
define('ERROR_CUSTOMER_APPROVAL_CORRECTION1', 'Attenzione: shop settato per Autorizzazione senza navigazione. 
Il cliente &egrave; in attesa dell\'Autorizzazione alla navigazione del negozio.');
define('ERROR_CUSTOMER_APPROVAL_CORRECTION2', 'Attenzione: Attenzione: shop settato per Autorizzazione con navigazione ma senza prezzi a vista. Il cliente &egrave; in attesa dell\'Autorizzazione per poter vedre i prezzi.');

define('EMAIL_CUSTOMER_STATUS_CHANGE_MESSAGE', 'Il tuo stato cliente è stato aggiornato. Grazie per averci scelto..');
define('EMAIL_CUSTOMER_STATUS_CHANGE_SUBJECT', 'Stato Cliente Aggiornato');
?>