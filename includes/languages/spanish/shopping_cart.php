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
// $Id: shopping_cart.php,v 1.3 2006/01/10 18:34:00 damage_in Exp $
//

define('NAVBAR_TITLE', 'Contenido de su cesta');
define('HEADING_TITLE', 'La cesta de la compra contiene:');
define('TABLE_HEADING_REMOVE', 'Quitar');
define('TABLE_HEADING_QUANTITY', 'Cantidad');
define('TABLE_HEADING_MODEL', 'ISBN');
define('TEXT_INFORMATION', '');
define('TABLE_HEADING_PRODUCTS', 'Producto(s)');
define('TABLE_HEADING_PRICE','Precio');
define('TABLE_HEADING_TOTAL', 'Total');
define('TEXT_CART_EMPTY', 'Su cesta de la compra está vacía.');
define('SUB_TITLE_SUB_TOTAL', 'Subtotal:');
define('SUB_TITLE_TOTAL', 'Total:');

define('OUT_OF_STOCK_CANT_CHECKOUT', 'Los productos marcados con ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' están agotados o no hay suficientes para atender su pedido.<br />Por favor, modifique la cantidad de productos marcados con (' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '). Gracias');
define('OUT_OF_STOCK_CAN_CHECKOUT', 'Los productos marcados con ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' están agotados.<br />Dichos artículos serán puestos en un pedido de espera.');

define('TEXT_TOTAL_ITEMS', 'Artículos: ');
define('TEXT_TOTAL_WEIGHT', '&nbsp;&nbsp;Peso: ');
define('TEXT_TOTAL_AMOUNT', '&nbsp;&nbsp;Cantidad: ');

define('TEXT_VISITORS_CART', '<a href="javascript:session_win();">[Ayuda (?)]</a>');
define('TEXT_OPTION_DIVIDER', '&nbsp;-&nbsp;');

// Nuevas en ZenCart 1.3.6
define('HEADING_TITLE_EMPTY', 'Contenido de su cesta');

?>
