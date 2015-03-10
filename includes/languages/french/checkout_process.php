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
// $Id: checkout_process.php 1969 2005-09-13 06:57:21Z drbyte $
//

  define('EMAIL_TEXT_SUBJECT', 'Confirmation de commande');
  define('EMAIL_TEXT_HEADER', 'Confirmation de commande');
  define('EMAIL_TEXT_FROM',' de ');  //added to the EMAIL_TEXT_HEADER, above on text-only emails
  define('EMAIL_THANKS_FOR_SHOPPING','Nous vous remercions de votre confiance !');
  define('EMAIL_DETAILS_FOLLOW','Voici les d�tails de votre commande.');
  define('EMAIL_TEXT_ORDER_NUMBER', 'Num�ro:');
  define('EMAIL_TEXT_INVOICE_URL', 'D�tails:');
  define('EMAIL_TEXT_INVOICE_URL_CLICK', 'Pour plus de d�tails, cliquez sur ce lien.');
  define('EMAIL_TEXT_DATE_ORDERED', 'Date de commande:');
  define('EMAIL_TEXT_PRODUCTS', 'Produits');
  define('EMAIL_TEXT_SUBTOTAL', 'Sous-Total:');
  define('EMAIL_TEXT_TAX', 'Taxes:        ');
  define('EMAIL_TEXT_SHIPPING', 'Livraison: ');
  define('EMAIL_TEXT_TOTAL', 'Total:    ');
  define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Adresse de Livraison');
  define('EMAIL_TEXT_BILLING_ADDRESS', 'Adresse de Facturation');
  define('EMAIL_TEXT_PAYMENT_METHOD', 'Mode de Paiement');

  define('EMAIL_SEPARATOR', '------------------------------------------------------');
  define('TEXT_EMAIL_VIA', 'via');

// suggest not using # vs No as some spamm protection block emails with these subjects
  define('EMAIL_ORDER_NUMBER_SUBJECT', ' No: ');
  define('HEADING_ADDRESS_INFORMATION','Information Adresse');
  define('HEADING_SHIPPING_METHOD','Mode de Livraison');
?>