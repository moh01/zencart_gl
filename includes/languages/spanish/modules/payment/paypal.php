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
// $Id: paypal.php,v 1.2 2006/01/11 17:38:23 damage_in Exp $
//
  define('MODULE_PAYMENT_PAYPAL_TEXT_ADMIN_TITLE', 'Paypal IPN');
  define('MODULE_PAYMENT_PAYPAL_TEXT_CATALOG_TITLE', 'Paypal');
  if (IS_ADMIN_FLAG === true) {
    define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', '<strong>PayPal IPN</strong><br /><font color="green">Configuration Instructions:</font><br />On www.paypal.com, under "Profile",<ul><li>set your <strong>Instant Payment Notification Preferences</strong> URL to:<br />'.str_replace('index.php?main_page=index','ipn_main_handler.php',zen_catalog_href_link(FILENAME_DEFAULT, '', 'SSL')) . ' </li><li>in <strong>Website Payments Preferences</strong> set your <strong>Automatic Return URL</strong> to:<br />'.zen_catalog_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL',false).'</li>' . (defined('MODULE_PAYMENT_PAYPAL_STATUS') ? '' : '<li>... and click "install" above to enable PayPal support... and "edit" to tell Zen Cart your PayPal settings.</li>') . '</ul><font color="green"><hr /></font>' );
  } else {
    define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', '<strong>PayPal IPN</strong>');
  }

  define('MODULE_PAYMENT_PAYPAL_ENTRY_FIRST_NAME', 'Nombre');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_LAST_NAME', 'Apellidos:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_BUSINESS_NAME', 'Empresa:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_NAME', 'Dirección:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STREET', 'Calle:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_CITY', 'Localidad:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATE', 'Provincia:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_ZIP', 'Código postal:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_COUNTRY', 'País:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_EMAIL_ADDRESS', 'Email del pagador:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_EBAY_ID', 'Ebay ID:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_ID', 'ID del pagador:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_STATUS', 'Estado del pagador:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATUS', 'Estado de la dirección:');

  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_TYPE', 'Tipo de pago:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_STATUS', 'Estado del pago:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PENDING_REASON', 'Razón de pendiente:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_INVOICE', 'Factura:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_DATE', 'Fecha de pago:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_CURRENCY', 'Moneda:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_GROSS_AMOUNT', 'Cantidad bruta:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_FEE', 'Costo de pago:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_EXCHANGE_RATE', 'Tasa de cambio:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_CART_ITEMS', 'Productos en la cesta:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_TXN_TYPE', 'Tipo de transacción:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_TXN_ID', 'ID de transacción:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PARENT_TXN_ID', 'ID de transacción padre:');

  define('MODULE_PAYMENT_PAYPAL_PURCHASE_DECRIPTION_TITLE', STORE_NAME . '');
?>