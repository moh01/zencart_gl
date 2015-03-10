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
//  $Id: whos_online.php 2663 2005-12-24 02:28:51Z Albigin $
//

define('HEADING_TITLE', 'Chi c\'&egrave; On line');

define('TABLE_HEADING_ONLINE', 'Online');
define('TABLE_HEADING_CUSTOMER_ID', 'ID');
define('TABLE_HEADING_FULL_NAME', 'Nome Completo');
define('TABLE_HEADING_IP_ADDRESS', 'Indirizzo IP');
define('TABLE_HEADING_SESSION_ID', 'Sessione');
define('TABLE_HEADING_ENTRY_TIME', 'Ora di Accesso');
define('TABLE_HEADING_LAST_CLICK', 'Ultimo Click');
define('TIME_PASSED_LAST_CLICKED', '<strong>Tempo dall\'ultimo Click:</strong> ');
define('TABLE_HEADING_LAST_PAGE_URL', 'Ultimo URL');
define('TABLE_HEADING_ACTION', 'Azione');
define('TABLE_HEADING_SHOPPING_CART', 'Utenti del Negozio');
define('TEXT_SHOPPING_CART_SUBTOTAL', 'Subtotale');
define('TEXT_NUMBER_OF_CUSTOMERS', 'Attualmente ci sono %s acquirenti online');

// Additional Definitions for whos_online.php
  define('WHOS_ONLINE_REFRESH_LIST_TEXT', 'AGGIORNA LISTA');
  define('WHOS_ONLINE_LEGEND_TEXT','Legenda:');
  define('WHOS_ONLINE_ACTIVE_TEXT','Carrello Attivo');
  define('WHOS_ONLINE_INACTIVE_TEXT','Carrello inattivo');
  define('WHOS_ONLINE_ACTIVE_NO_CART_TEXT','Nessun Carrello Attivato');
  define('WHOS_ONLINE_INACTIVE_NO_CART_TEXT','Nessun Carrello');
  define('WHOS_ONLINE_INACTIVE_LAST_CLICK_TEXT','NON attivo dall\'ultimo Click >=');
  define('WHOS_ONLINE_INACTIVE_ARRIVAL_TEXT','NON attivo dall\'accesso >');
  define('WHOS_ONLINE_REMOVED_TEXT','sar&agrave; rimosso dall\'elenco');

// whos_online.php
  define('WHOIS_TIMER_REMOVE',1200); // seconds when removed from whos_online table - 1200 default = 20 minutes
  define('WHOIS_TIMER_INACTIVE',180); // seconds when considered inactive - 180 default = 3 minutes
  define('WHOIS_TIMER_DEAD',540); // seconds when considered dead - 540 default = 9 minutes
  define('WHOIS_SHOW_HOST','1'); // show Last Clicked time and host name - 1 default
  define('WHOIS_REPEAT_LEGEND_BOTTOM','12'); // show legend on bottom when more than how many entries - 12 default
  define('OFFICE_IP_TO_HOST_ADDRESS', 'OFF');

  define('TEXT_SESSION_ID', '<strong>ID Sessione:</strong> ');
  define('TEXT_HOST', '<strong>Host:</strong> ');
  define('TEXT_USER_AGENT', '<strong>User Agent:</strong> ');
  define('TEXT_EMPTY_CART', '<strong>Car. Vuoto</strong>');
?>