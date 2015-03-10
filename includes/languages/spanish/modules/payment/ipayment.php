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
// $Id: ipayment.php,v 1.1 2005/12/22 22:31:38 gorkau Exp $
//

  define('MODULE_PAYMENT_IPAYMENT_TEXT_TITLE', 'iPayment');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_DESCRIPTION', 'Info del Test de Tarjeta de Crédito:<br /><br />TC#: 4111111111111111<br />Expira: Cualquier día');
  define('IPAYMENT_ERROR_HEADING', 'Hubo un error al procesar su tarjeta de crédito.');
  define('IPAYMENT_ERROR_MESSAGE', '¡Por favor, revise los detalles detalles de su tarjeta de crédito!');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_CREDIT_CARD_OWNER', 'Dueño de la Tarjeta:');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_CREDIT_CARD_NUMBER', 'Número de la Tarjeta:');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_CREDIT_CARD_EXPIRES', 'Fecha de Expiración de la Tarjeta:');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_CREDIT_CARD_CHECKNUMBER', 'Número de Chequeo de la Tarjeta:');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_CREDIT_CARD_CHECKNUMBER_LOCATION', '(ubicado detrás de la tarjeta)');

  define('MODULE_PAYMENT_IPAYMENT_TEXT_JS_CC_OWNER', '* El nombre del dueño de la tarjeta debe tener al menos ' . CC_OWNER_MIN_LENGTH . ' caracteres.\n');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_JS_CC_NUMBER', '* El número de la tarjeta de crédito debe tener al menos ' . CC_NUMBER_MIN_LENGTH . ' caracteres.\n');
?>
