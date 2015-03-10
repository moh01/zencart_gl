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
// $Id: cc.php,v 1.2 2006/01/11 17:38:23 damage_in Exp $
//

  define('MODULE_PAYMENT_CC_TEXT_TITLE', 'Tarjeta de Cr�dito');
  define('MODULE_PAYMENT_CC_TEXT_DESCRIPTION', 'Informacion sobre test de tarjeta de cr�dito:<br /><br />TC#: 4111111111111111<br />Expira: Cualquier d�a');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_TYPE', 'Tipo de tarjeta:');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER', 'Nombre del titular de la tarjeta:');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER', 'N�mero de tarjeta:');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV', 'N�mero CVV (<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_CVV_HELP) . '\')">' . 'M�s informaci�n' . '</a>)');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES', 'Caducidad:');
  define('MODULE_PAYMENT_CC_TEXT_JS_CC_OWNER', '* El nombre del titular de la tarjeta debe tener al menos ' . CC_OWNER_MIN_LENGTH . ' car�cteres.\n');
  define('MODULE_PAYMENT_CC_TEXT_JS_CC_NUMBER', '* El n�mero de la tarjeta de cr�dito debe tener al menos ' . CC_NUMBER_MIN_LENGTH . ' car�cteres.\n');
  define('MODULE_PAYMENT_CC_TEXT_ERROR', 'Error en la tarjeta de cr�dito:');
  define('MODULE_PAYMENT_CC_TEXT_JS_CC_CVV', '* El n�mero CVV debe tener al menos ' . CC_CVV_MIN_LENGTH . ' car�cteres.\n');
?>
