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
// $Id: ot_gv.php,v 1.2 2006/01/11 20:45:52 gorkau Exp $
//

  define('MODULE_ORDER_TOTAL_GV_TITLE', TEXT_GV_NAMES);
  define('MODULE_ORDER_TOTAL_GV_HEADER', TEXT_GV_NAMES . '/Cupones de descuento');
  define('MODULE_ORDER_TOTAL_GV_DESCRIPTION', TEXT_GV_NAMES);
  define('SHIPPING_NOT_INCLUDED', ' [Envío no incluido]');
  define('TAX_NOT_INCLUDED', ' [Impuestos no incluidos]');
  define('MODULE_ORDER_TOTAL_GV_USER_PROMPT', 'Aplicar saldo ->&nbsp;');
  define('MODULE_ORDER_TOTAL_GV_TEXT_ENTER_CODE', TEXT_GV_REDEEM);
  define('TEXT_INVALID_REDEEM_AMOUNT', 'Cantidad incorrecta');
  define('MODULE_ORDER_TOTAL_GV_USER_BALANCE', 'Saldo disponible: ');
  define('MODULE_ORDER_TOTAL_GV_REDEEM_INSTRUCTIONS', '<p>Para usar un vale de compra teclee la cantidad
  que quiere aplicar a este pedido en esta casilla. Deberá seleccionar el método de pago y, después,
  hacer click en el botón para aplicar el descuento al pedido.</p>');
?>
