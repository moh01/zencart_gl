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
//  $Id: orders_status.php,v 1.2 2006/01/17 20:00:25 gorkau Exp $
//

define('HEADING_TITLE', 'Estado de los pedidos');

define('TABLE_HEADING_ORDERS_STATUS', 'Estado de los pedidos');
define('TABLE_HEADING_ACTION', 'Acciones');

define('TEXT_INFO_EDIT_INTRO', 'Por favor, haga los cambios necesarios');
define('TEXT_INFO_ORDERS_STATUS_NAME', 'Estado de los pedidos:');
define('TEXT_INFO_INSERT_INTRO', 'Por favor, introduzca el nuevo estado de pedidos con sus datos relacionados');
define('TEXT_INFO_DELETE_INTRO', '¿Seguro que desea eliminar este estado de pedidos?');
define('TEXT_INFO_HEADING_NEW_ORDERS_STATUS', 'Nuevo estado de pedidos');
define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', 'Editar pstado de pedidos');
define('TEXT_INFO_HEADING_DELETE_ORDERS_STATUS', 'Borra estado de pedidos');

define('ERROR_REMOVE_DEFAULT_ORDER_STATUS', 'Error: No se puede eliminar el estado de pedido por defecto. Por favor, establezca otro estado de pedido por defecto e inténtelo nuevamente.');
define('ERROR_STATUS_USED_IN_ORDERS', 'Error: Este estado de pedido actualmente está siendo usado en los pedidos.');
define('ERROR_STATUS_USED_IN_HISTORY', 'Error: Este estado de pedido actualmente está siendo usado en el historial del estado del pedido.');
?>
