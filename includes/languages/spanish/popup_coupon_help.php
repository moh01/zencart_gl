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
// $Id: popup_coupon_help.php,v 1.3 2006/01/10 21:20:32 damage_in Exp $
//

define('HEADING_COUPON_HELP', 'Ayuda de los cupones descuento');
define('TEXT_CLOSE_WINDOW', 'Cerrar ventana');
define('TEXT_COUPON_HELP_HEADER', 'Felicidades, ha canjeado un cupón de descuento.');
define('TEXT_COUPON_HELP_NAME', '<br /><br />Nombre del vale : %s');
define('TEXT_COUPON_HELP_FIXED', '<br /><br />Este vale tiene la cantidad de %s de descuento en su pedido');
define('TEXT_COUPON_HELP_MINORDER', '<br /><br />Necesita gastar %s para usar este cupón de descuento');
define('TEXT_COUPON_HELP_FREESHIP', '<br /><br />Este cupón de descuento le permite el envío gratis de su pedido');
define('TEXT_COUPON_HELP_DESC', '<br /><br />Descripción del vale : %s');
define('TEXT_COUPON_HELP_DATE', '<br /><br />Este vale es válido desde %s al %s');
define('TEXT_COUPON_HELP_RESTRICT', '<br /><br />Restriccion de Productos/Categorías');
define('TEXT_COUPON_HELP_CATEGORIES', 'Categoría');
define('TEXT_COUPON_HELP_PRODUCTS', 'Productos');
define('TEXT_ALLOW', 'Permitir');
define('TEXT_DENY', 'Negar');
define('TEXT_ALLOWED', ' (Permitido)');
define('TEXT_DENIED', ' (Denegado)');

// gift certificates cannot be purchased with Discount Coupons
define('TEXT_COUPON_GV_RESTRICTION', 'Los cupones descuento no se aplican a la compra de ' . TEXT_GV_NAMES . '.');
?>
