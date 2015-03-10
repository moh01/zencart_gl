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
// $Id: email_extras.php 2081 2005-10-03 05:34:18Z Albigin $
//

// office use only
  define('OFFICE_FROM','Da:');
  define('OFFICE_EMAIL','Email:');

  define('OFFICE_SENT_TO','A:');
  define('OFFICE_EMAIL_TO','Email:');
  define('OFFICE_USE','Solo per uso interno:');
  define('OFFICE_LOGIN_NAME','Nome di login:');
  define('OFFICE_LOGIN_EMAIL','Login Email:');
  define('OFFICE_LOGIN_PHONE','<strong>Telefono:</strong>');
  define('OFFICE_IP_ADDRESS','Indirizzo IP:');
  define('OFFICE_HOST_ADDRESS','Indirizzo Host:');
  define('OFFICE_DATE_TIME','Data e Ora:');

// email disclaimer
  define('EMAIL_DISCLAIMER', 'Questo indirizzo Email ci &egrave; stato fornito da uno dei nostri Clienti. Se il presente messaggio &egrave; stato ricevuto per errore, inviare una Email a %s');
  define('EMAIL_SPAM_DISCLAIMER','This e-mail is sent in accordance with the US CAN-SPAM Law in effect 01/01/2004. Removal requests can be sent to this address and will be honored and respected.');
  define('EMAIL_FOOTER_COPYRIGHT','Copyright &copy; 2004 <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a>. Powered by <a href="http://www.zen-cart.it" target="_blank">Zen-Cart.it</a>');
  define('SEND_EXTRA_GV_ADMIN_EMAILS_TO_SUBJECT','[GV ADMIN SENT]');
  define('SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_SUBJECT','[DISCOUNT COUPONS]');
  define('SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT','[ORDERS STATUS]');
   define('TEXT_UNSUBSCRIBE', "\n\nPer rinunciare a future newsletter e offerte promozionali, basta cliccare il seguente link: \n");

// for whos_online when gethost is off
  define('OFFICE_IP_TO_HOST_ADDRESS', 'Disabilitato');
?>