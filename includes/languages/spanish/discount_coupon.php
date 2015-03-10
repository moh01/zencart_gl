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
// $Id: discount_coupon.php 3253 2006-03-25 17:26:14Z birdbrain $
//

define('NAVBAR_TITLE', 'Cupones de descuento');
define('HEADING_TITLE', 'Cupones de descuento');

define('TEXT_INFORMATION', '');
define('TEXT_COUPON_FAILED', '<span class="alert important">%s</span> no parece ser un cupón de descuento válido. Pruebe a teclearlo de nuevo.');

define('HEADING_COUPON_HELP', 'Ayuda');
define('TEXT_CLOSE_WINDOW', 'Cerrar ventana [x]');
define('TEXT_COUPON_HELP_HEADER', '<p class="bold">El código del cupón de descuento que ha introducido es para  ');
define('TEXT_COUPON_HELP_NAME', '\'%s\'. </p>');
define('TEXT_COUPON_HELP_FIXED', '');
define('TEXT_COUPON_HELP_MINORDER', '');
define('TEXT_COUPON_HELP_FREESHIP', '');
define('TEXT_COUPON_HELP_DESC', '<p><span class="bold">Discount Offer:</span> %s</p><p class="smallText">Es posible que se apliquen otras restricciones. Consulte debajo para más detalles.</p>');
define('TEXT_COUPON_HELP_DATE', '<p>El cupón es válido entre %s y %s</p>');
define('TEXT_COUPON_HELP_RESTRICT', '<p class="biggerText bold">Restricciones del cupón de descuento</p>');
define('TEXT_COUPON_HELP_CATEGORIES', '<p class="bold">Restricciones en categorías:</p>');
define('TEXT_COUPON_HELP_PRODUCTS', '<p class="bold">Restricciones en productos:</p>');
define('TEXT_ALLOW', 'Permitido');
define('TEXT_DENY', 'No permitido');
define('TEXT_NO_CAT_RESTRICTIONS', '<p>Este cupón es válido para cualquier categoría.</p>');
define('TEXT_NO_PROD_RESTRICTIONS', '<p>Este cupón es válido para todos los productos.</p>');
define('TEXT_CAT_ALLOWED', ' (Válido para esta categoría)');
define('TEXT_CAT_DENIED', ' (No permitido en esta categoría)');
define('TEXT_PROD_ALLOWED', ' (Válido para este producto)');
define('TEXT_PROD_DENIED', ' (No permitido para este producto)');
// gift certificates cannot be purchased with Discount Coupons
define('TEXT_COUPON_GV_RESTRICTION','<p class="smallText">Los cupones de descuento no pueden aplicarse para la compra de ' . TEXT_GV_NAMES . '. Sólo puede usarse un cupón por pedido.</p>');

define('TEXT_DISCOUNT_COUPON_ID_INFO', 'Buscar cupón de descuento ... ');
define('TEXT_DISCOUNT_COUPON_ID', 'Su código: ');

// Nuevas en ZenCart 1.3.6
// UHT
define('TEXT_COUPON_GV_RESTRICTION_ZONES', 'Billing Address Restrictions apply.');
?>