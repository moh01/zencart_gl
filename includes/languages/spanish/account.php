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
// $Id: account.php,v 1.3 2006/01/09 23:03:48 damage_in Exp $
//

define('NAVBAR_TITLE', 'Mi cuenta');
define('HEADING_TITLE', 'Información de mi cuenta');

define('OVERVIEW_TITLE', 'Sumario');
define('OVERVIEW_SHOW_ALL_ORDERS', '(mostrar todos los pedidos)');
define('OVERVIEW_PREVIOUS_ORDERS', 'Pedidos anteriores');
define('TABLE_HEADING_DATE', 'Fecha');
define('TABLE_HEADING_ORDER_NUMBER', 'Núm.');
define('TABLE_HEADING_SHIPPED_TO', 'Enviar a');
define('TABLE_HEADING_STATUS', 'Estado');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_VIEW', 'Ver');

define('MY_ACCOUNT_TITLE', 'Mi cuenta');
if (isset($zurlan))
{
	define('MY_ACCOUNT_INFORMATION', 'Mostrar o modificar mi información de facturación.');
}
else
{
	define('MY_ACCOUNT_INFORMATION', 'Mostrar o modificar datos de mi cuenta.');
}
define('MY_ACCOUNT_ADDRESS_BOOK', 'Mostrar o modificar mis direcciones de envío.');
define('MY_ACCOUNT_PASSWORD', 'Modificar la contraseña de mi cuenta.');

define('MY_ORDERS_TITLE', 'Mis pedidos');
define('MY_ORDERS_VIEW', 'Mostrar mis pedidos.');

define('EMAIL_NOTIFICATIONS_TITLE', 'Avisos por e-mail');
define('EMAIL_NOTIFICATIONS_NEWSLETTERS', 'Darse de alta o baja del boletín.');
define('EMAIL_NOTIFICATIONS_PRODUCTS', 'Mostrar o modificar mi lista de notificaciones sobre productos.');
?>
