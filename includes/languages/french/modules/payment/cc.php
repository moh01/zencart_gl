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
// $Id: cc.php 2424 2005-11-22 09:25:32Z drbyte $
//

  define('MODULE_PAYMENT_CC_TEXT_TITLE', 'Carte de Crédit');
  define('MODULE_PAYMENT_CC_TEXT_DESCRIPTION', 'No Test de Carte de Cr&eacute;dit<br><br>CC#: 4111111111111111<br>Date d\'expiration: Aucune');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_TYPE', 'Type de la Carte:');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER', 'Propri&eacute;taire de la Carte:');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER', 'Num&eacute;ro de la Carte:');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV', 'Num&eacute;ro CVV (<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_CVV_HELP) . '\')">' . 'Plus d\'info..' . '</a>)');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES', 'Date d\'expiration de la Carte:');
  define('MODULE_PAYMENT_CC_TEXT_JS_CC_OWNER', '* Le Nom du Propriï¿½aire de la Carte doit comporter au moins ' . CC_OWNER_MIN_LENGTH . ' caractï¿½es.\n');
  define('MODULE_PAYMENT_CC_TEXT_JS_CC_NUMBER', '* Le Numï¿½o de la Carte de Crï¿½it doit comporter au moins ' . CC_NUMBER_MIN_LENGTH . ' caractï¿½es.\n');
  define('MODULE_PAYMENT_CC_TEXT_ERROR', 'Erreur Carte de Crï¿½it !');
  define('MODULE_PAYMENT_CC_TEXT_JS_CC_CVV', '* Le Numï¿½o CVV doit comporter au moins ' . CC_CVV_MIN_LENGTH . '  caractï¿½es.\n');
  define('MODULE_PAYMENT_CC_TEXT_EMAIL_ERROR','Warning - Configuration Error: ');
  define('MODULE_PAYMENT_CC_TEXT_EMAIL_WARNING','WARNING: You have enabled the CC payment module but have not configured it to send CC information to you by email. As a result, you will not be able to process the CC number for orders placed using this method.  Go to Admin->Modules->Payment->CC->Edit and set the email address for sending CC information.' . "\n\n\n\n");
?>