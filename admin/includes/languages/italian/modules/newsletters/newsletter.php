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
//  $Id: newsletter.php 1105 2006-10-04 17:56:35Z spike00 $
//

define('TEXT_COUNT_CUSTOMERS', 'Iscritti a cui viene inviata la Newsletter: %s');
define('HEADING_TITLE', 'Gestore Newsletter');

define('TABLE_HEADING_NEWSLETTERS', 'Newsletters');
define('TABLE_HEADING_SIZE', 'Dimensione');
define('TABLE_HEADING_MODULE', 'Modulo');
define('TABLE_HEADING_SENT', 'Inviata');
define('TABLE_HEADING_STATUS', 'Stato');
define('TABLE_HEADING_ACTION', 'Azione');

define('TEXT_NEWSLETTER_MODULE', 'Modulo:');
define('TEXT_NEWSLETTER_TITLE', 'Soggetto:');
define('TEXT_NEWSLETTER_CONTENT', 'Solo Testo <br />Contenuto:');
define('TEXT_NEWSLETTER_CONTENT_HTML', 'Testo e HTML <br />Contenuto:');

define('TEXT_NEWSLETTER_DATE_ADDED', 'Data Inserimento:');
define('TEXT_NEWSLETTER_DATE_SENT', 'Data Invio:');

define('TEXT_INFO_DELETE_INTRO', 'Sicuro di voler cancellare questa newsletter?');

define('TEXT_PLEASE_SELECT_AUDIENCE','Seleziona i destinatari per questa newsletter: ');
define('TEXT_PLEASE_WAIT', 'Cortesemente attendi ... invio Newsletter in corso ...<br /><br />Attenzione! NON interrompere questo processo!');
define('TEXT_FINISHED_SENDING_EMAILS', 'Invio Newsletter effettuato!');

define('ERROR_NEWSLETTER_TITLE', 'Errore: occorre un titolo per la Newsletter');
define('ERROR_NEWSLETTER_MODULE', 'Errore: occorre un modulo per la Newsletter');
?>