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
// $Id: moneyorder.php,v 1.1 2003/11/25 17:09:07 wilt Exp $
//

  define('MODULE_PAYMENT_TRANSFERENCIA_TEXT_TITLE', 'Transferencia Bancaria');
  define('MODULE_PAYMENT_TRANSFERENCIA_TEXT_DESCRIPTION', '
    * Antes de hacer la transferencia o el ingreso en cuenta<br>
  espere a que confirmemos la disponibilidad de los<br>
  artículos solicitados. Cuando reciba el aviso, puede hacernos<br>
  el ingreso en la cuenta:<br><br>
  ' . MODULE_PAYMENT_TRANSFERENCIA_ACCOUNT_NUMBER . '<br><br>
  indicando su nombre y número de pedido (a ser posible).<br>
  Una vez recibido el pago enviaremos el paquete.');
  define('MODULE_PAYMENT_TRANSFERENCIA_TEXT_EMAIL_FOOTER', '
Antes de hacer la transferencia o el ingreso en cuenta espere a que confirmemos 
la disponibilidad de los artículos solicitados. Cuando reciba el aviso, puede
hacernos el ingreso en la cuenta:

' . MODULE_PAYMENT_TRANSFERENCIA_ACCOUNT_NUMBER . '

indicando su nombre y número de pedido (a ser posible). Una vez recibido el pago 
enviaremos el paquete.');


?>
