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
//  $Id: whos_online.php,v 1.2 2006/01/11 21:11:49 gorkau Exp $
//

define('HEADING_TITLE', 'Quién está online');

define('TABLE_HEADING_ONLINE', 'Online');
define('TABLE_HEADING_CUSTOMER_ID', 'ID');
define('TABLE_HEADING_FULL_NAME', 'Nombre completo');
define('TABLE_HEADING_IP_ADDRESS', 'Dirección IP');
define('TABLE_HEADING_ENTRY_TIME', 'Hora de llegada');
define('TABLE_HEADING_LAST_CLICK', 'Último Click');
define('TABLE_HEADING_LAST_PAGE_URL', 'Última URL');
define('TABLE_HEADING_ACTION', 'Acción');
define('TABLE_HEADING_SHOPPING_CART', 'Carro de Compras de los Usuarios');
define('TEXT_SHOPPING_CART_SUBTOTAL', 'Subtotal');
define('TEXT_NUMBER_OF_CUSTOMERS', 'Actualmente hay %s clientes online');

// Additional Definitions for whos_online.php
  define('WHOS_ONLINE_REFRESH_LIST_TEXT', 'ACTUALIZAR LISTA');
  define('WHOS_ONLINE_LEGEND_TEXT','Leyenda:');
  define('WHOS_ONLINE_ACTIVE_TEXT','Cesta activa');
  define('WHOS_ONLINE_INACTIVE_TEXT','Cesta inactiva');
  define('WHOS_ONLINE_ACTIVE_NO_CART_TEXT','Activo sin cesta');
  define('WHOS_ONLINE_INACTIVE_NO_CART_TEXT','Inactivo sin cesta');
  define('WHOS_ONLINE_INACTIVE_LAST_CLICK_TEXT','Inactivos desde el último click >=');
  define('WHOS_ONLINE_INACTIVE_ARRIVAL_TEXT','Inactivos desde la llegada >');
  define('WHOS_ONLINE_REMOVED_TEXT','serán eliminados');

// whos_online.php
  define('WHOIS_TIMER_REMOVE',1200); // seconds when removed from whos_online table - 1200 default = 20 minutes
  define('WHOIS_TIMER_INACTIVE',180); // seconds when considered inactive - 180 default = 3 minutes
  define('WHOIS_TIMER_DEAD',540); // seconds when considered dead - 540 default = 9 minutes
  define('WHOIS_SHOW_HOST','1'); // show Last Clicked time and host name - 1 default
  define('WHOIS_REPEAT_LEGEND_BOTTOM','12'); // show legend on bottom when more than how many entries - 12 default

?>
