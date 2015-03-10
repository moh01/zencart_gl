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
// $Id: checkout_confirmation.php,v 1.2 2006/01/09 23:05:03 gorkau Exp $
//

define('NAVBAR_TITLE_1', 'Pago');
define('NAVBAR_TITLE_2', 'Confirmación');

define('HEADING_TITLE', 'Confirmación');

define('HEADING_BILLING_ADDRESS', 'Dirección de facturación');
define('HEADING_DELIVERY_ADDRESS', 'Dirección de entrega');
define('HEADING_SHIPPING_METHOD', 'Método de envío:');
define('HEADING_PAYMENT_METHOD', 'Método de Pago:');
define('HEADING_PRODUCTS', 'Contenido de su cesta');
define('HEADING_TAX', 'Impuesto');
define('HEADING_TOTAL', 'Total');
define('HEADING_ORDER_COMMENTS', 'Instrucciones Especiales o Comentarios');
// no comments entered
define('NO_COMMENTS_TEXT', 'Ninguno');
define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', '<strong>Paso final</strong>');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', '¡Confirmación!');

// Nuevas claves en 1.3.6
define('OUT_OF_STOCK_CAN_CHECKOUT', 'Products marked with ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' are out of stock.<br />Items not in stock will be placed on backorder.');

?>
