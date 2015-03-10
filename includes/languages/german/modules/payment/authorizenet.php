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
// $Id: authorizenet.php 1969 2005-09-13 06:57:21Z drbyte $
//

  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ADMIN_TITLE', 'Scheck');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CATALOG_TITLE', 'Scheck');  // Payment option title as displayed to the customer
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION', '
Zahlung per Check<br>
Bitte schicken Sie an die nachstehende Adresse einen Check mit dem Betrag der Bestellung, ausgestellt auf die Gesellschaft <font color=red>Easylamps</font>.<br><br>
Alleprojektorlampen<br>
Zimmermannstr. 26<br>
D-29525 Uelzen
<br><br>
Zur Info: Easylamps ist das Mutterhaus von Alleprojektorlampen<br><br>
Der Versand Ihrer Bestellung erfolgt erst nach Eingang Ihrer Bezahlung bei unserer Bank.<br>
');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_TYPE', 'Type:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_OWNER', 'Credit Card Owner:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER', 'Credit Card Number:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES', 'Credit Card Expiry Date:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_OWNER', '* The owner\'s name of the credit card must be at least ' . CC_OWNER_MIN_LENGTH . ' characters.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_NUMBER', '* The credit card number must be at least ' . CC_NUMBER_MIN_LENGTH . ' characters.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR_MESSAGE', 'There has been an error processing your credit card. Please try again.');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DECLINED_MESSAGE', 'Your credit card was declined. Please try another card or contact your bank for more info.');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR', 'Credit Card Error!');
?>