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
//  $Id: mail.php 1969 2005-09-13 06:57:21Z drbyte $
//

define('HEADING_TITLE', 'Invia Email ai Clienti');

define('TEXT_CUSTOMER', 'Cliente:');
define('TEXT_SUBJECT', 'Oggetto:');
define('TEXT_FROM', 'da:');
define('TEXT_MESSAGE', 'Messaggio <br />solo Testo:');
define('TEXT_MESSAGE_HTML','Messaggio <br />HTML:');
define('TEXT_SELECT_CUSTOMER', 'Seleziona Cliente');
define('TEXT_ALL_CUSTOMERS', 'Tutti i Clienti');
define('TEXT_NEWSLETTER_CUSTOMERS', 'A tutti gli abbonati alla Newsletter');
define('TEXT_ATTACHMENTS_LIST','Allegato Selezionato: ');
define('TEXT_SELECT_ATTACHMENT','Allegato<br />sul server: ');
define('TEXT_SELECT_ATTACHMENT_TO_UPLOAD','Allegato<br />da caricare<br />&amp; allegare: ');
define('TEXT_ATTACHMENTS_DIR','Cartella per upload: ');

define('NOTICE_EMAIL_SENT_TO', 'Nota bene - Email inviata a: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Errore: devi selezionare un Cliente.');
define('ERROR_NO_SUBJECT', 'Errore: devi inserire un Oggetto.');
define('ERROR_ATTACHMENTS', 'Errore: non si possono selezionare allegati diversi allo stesso tempo per Upload e Aggiungi. Scegline uno solo.');
?>