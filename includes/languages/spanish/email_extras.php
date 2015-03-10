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
// $Id: email_extras.php,v 1.2 2006/01/11 20:45:51 gorkau Exp $
//

// office use only
  define('OFFICE_FROM', 'De:');
  define('OFFICE_EMAIL', 'Desde el email:');

  define('OFFICE_SENT_TO', 'Envíado a:');
  define('OFFICE_EMAIL_TO', 'Email destinatario:');

  define('OFFICE_USE', 'Sólo para uso de la tienda:');
  define('OFFICE_LOGIN_NAME', 'Nombre de usuario:');
  define('OFFICE_LOGIN_EMAIL', 'Email de usuario:');
  define('OFFICE_IP_ADDRESS', 'Dirección IP:');
  define('OFFICE_LOGIN_PHONE','<Teléfono:');
  define('OFFICE_HOST_ADDRESS', 'Host:');
  define('OFFICE_DATE_TIME', 'Fecha y hora:');
  define('OFFICE_IP_TO_HOST_ADDRESS', 'OFF');

// email disclaimer
  define('EMAIL_DISCLAIMER', 'Esta dirección de correo eletrónico nos fue dada por usted o por alguno de nuestros clientes. Si piensa que recibió este mensaje por error, por favor, envíe un email a %s ');
  define('EMAIL_SPAM_DISCLAIMER','Las peticiones de borrado pueden ser enviadas a esta dirección, y serán cumplidas y respetadas.');
  define('EMAIL_FOOTER_COPYRIGHT','Copyright (c) 2006 <a href="' . HTTP_SERVER . '" target="_blank">' . STORE_NAME . '</a>.');

// email advisory for all emails customer generate - tell-a-friend and GV send
  define('EMAIL_ADVISORY', '-----' . "\n" . '<strong>IMPORTANTE:</strong> Para su protección y para prevenir usos maliciosos, todos los emails enviados a través de este sitio son registrados y sus contenidos son grabados y están disponibles para los dueños de la tienda. Si piensa que recibió este mensaje por error, por favor, envíe un email a ' . STORE_OWNER_EMAIL_ADDRESS . "\n\n");

// email advisory included warning for all emails customer generate - tell-a-friend and GV send
  define('EMAIL_ADVISORY_INCLUDED_WARNING', '<strong>Este mensaje se incluye con todos los e-mails enviados desde esta página:</strong>');


// Admin additional email subjects
  define('SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_SUBJECT', '[CREAR CUENTA]');
  define('SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_SUBJECT', '[DECIRLE A UN AMIGO]');
  define('SEND_EXTRA_GV_CUSTOMER_EMAILS_TO_SUBJECT', '[VALES DE COMPRA]');
  define('SEND_EXTRA_NEW_ORDERS_EMAILS_TO_SUBJECT', '[NUEVO PEDIDO]');
  define('SEND_EXTRA_CC_EMAILS_TO_SUBJECT','[INFO EXTRA DE PEDIDO CON TARJETA] #');
// Low Stock Emails
  define('EMAIL_TEXT_SUBJECT_LOWSTOCK','Atención: stock bajo');
  define('SEND_EXTRA_LOW_STOCK_EMAIL_TITLE','Aviso de stock bajo: ');
?>
