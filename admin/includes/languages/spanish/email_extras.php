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
// $Id: email_extras.php,v 1.1 2005/12/22 22:31:18 gorkau Exp $
//

// office use only
  define('OFFICE_FROM', 'De:');
  define('OFFICE_EMAIL', 'E-mail:');

  define('OFFICE_SENT_TO', 'Enviar a:');
  define('OFFICE_EMAIL_TO', 'E-mail:');

  define('OFFICE_USE', 'Sólo para uso interno:');
  define('OFFICE_LOGIN_NAME', 'Nombre de usuario:');
  define('OFFICE_LOGIN_EMAIL', 'E-mail de usuario:');
  define('OFFICE_LOGIN_PHONE','<strong>Teléfono:</strong>');
  define('OFFICE_IP_ADDRESS', 'Dirección IP:');

  define('OFFICE_HOST_ADDRESS', 'Host:');
  define('OFFICE_DATE_TIME', 'Fecha y Hora:');

// email disclaimer
  define('EMAIL_DISCLAIMER', 'Este email lo hemos obtenido a través de usted o de alguien que se ha registrado en nuestra tienda. Si no fue usted, o piensa que ha recibido este mensaje por error, por favor, envíe un email a ' . STORE_OWNER_EMAIL_ADDRESS . "\n\n");
  define('EMAIL_SPAM_DISCLAIMER','This e-mail is sent in accordance with the US CAN-SPAM Law in effect 01/01/2004. Removal requests can be sent to this address and will be honored and respected.');

  define('EMAIL_FOOTER_COPYRIGHT','Copyright &copy; 2005 <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a>. Powered by <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a>');
  define('SEND_EXTRA_GV_ADMIN_EMAILS_TO_SUBJECT','[VALES DE COMPRA]');
  define('SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_SUBJECT','[CUPONES DE DESCUENTO]');
  define('SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT','[ESTADO DE LOS PEDIDOS]');
  define('TEXT_UNSUBSCRIBE', "\n\nPara dejar de recibir futuros boletiones y correos promocionales, simplemente haga clic en el siguient enlace: \n");

// for whos_online when gethost is off
  define('OFFICE_IP_TO_HOST_ADDRESS', 'Desactivado');
?>