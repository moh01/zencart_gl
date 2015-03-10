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
// $Id: create_account.php,v 1.2 2006/01/10 18:23:43 gorkau Exp $
//

define('NAVBAR_TITLE', 'Crear cuenta');

define('HEADING_TITLE', 'Información de mi cuenta');

define('TEXT_ORIGIN_LOGIN', '<strong class="note">NOTA:</strong> Si ya tiene una cuenta con nosotros, por favor, entre en <a href="%s">su cuenta</a>.');

// greeting salutation
define('EMAIL_SUBJECT', 'Bienvenido a ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Estimado Sr. %s,' . "\n\n");	/*editado*/
define('EMAIL_GREET_MS', 'Estimada Sra. %s,' . "\n\n");	/*editado*/
define('EMAIL_GREET_NONE', 'Estimado %s' . "\n\n");

// First line of the greeting
define('EMAIL_WELCOME', 'Bienvenido a <strong>' . STORE_NAME . '</strong>.' . "\n\n");
define('EMAIL_SEPARATOR', '--------------------');
define('EMAIL_COUPON_INCENTIVE_HEADER', '¡Felicidades! Para hacer de su próxima visita a nuestra tienda online una experiencia más gratificante, ¡Aquí tiene un cupón de descuento!' . "\n\n");
// your Discount Coupon Description will be inserted before this next define
define('EMAIL_COUPON_REDEEM', 'Para usar el Cupón de Descuento, ingrese el ' . TEXT_GV_REDEEM . ':<br /> %s durante el pago.' . "\n\n");

define('EMAIL_GV_INCENTIVE_HEADER', 'Sólo para las compras de hoy, ¡le enviamos un ' . TEXT_GV_NAME . ' para %s!' . "\n\n");
define('EMAIL_GV_REDEEM', 'El ' . TEXT_GV_REDEEM . ' del ' . TEXT_GV_NAME . ' es: %s ' . "\n\n" . 'Puede ingresar el ' . TEXT_GV_REDEEM . ' durante el pago, después de haber eligido productos en la tienda.' . "\n\n");
define('EMAIL_GV_LINK', 'O puede canjearlo ahora siguiendo este link: ' . "\n\n");
// GV link will automatically be included before this line

define('EMAIL_GV_LINK_OTHER', 'Una vez que haya agregado el ' . TEXT_GV_NAME . ' a su cuenta, puede usar el ' . TEXT_GV_NAME . ' para usted, ¡o enviárselo a un amigo!' . "\n\n");

define('EMAIL_TEXT', 'Ahora usted puede tomar parte en los <strong>varios servicios</strong> que le ofrecemos. Algunos de estos servicios incluyen:' . "\n\n" . '<li><strong>Carro Permanente</strong> : Cualquier de los productos agregados a su carro online permanecen allí hasta que usted los quite, o los compre.' . "\n\n" . '<li><strong>Agenda de Direcciones</strong> : ¡Podemos ahora enviarle sus productos a otra dirección distinta de la suya! Esto es perfecto para enviar regalos de cumpleaños directamente a la persona que cumple años.' . "\n\n" . '<li><strong>Historial de Pedidos</strong> : Vea su historial de compras que haya hecho con nosotros.' . "\n\n" . '<li><strong>Comentarios de Productos</strong> : Comparta sus opiniones de los productos con nuestros otros clientes.' . "\n\n");
define('EMAIL_CONTACT', 'Si necesita ayuda con cualquiera de nuestros servicios online, por favor, envíenos un email a: ' . STORE_OWNER_EMAIL_ADDRESS . "\n\n");
define('EMAIL_GV_CLOSURE', 'Atentamente,' . "\n\n" . STORE_OWNER . "\n\n" . HTTP_SERVER . DIR_WS_CATALOG . "\n\n");

// email disclaimer - this disclaimer is seperate from all other email disclaimers
define('EMAIL_DISCLAIMER_NEW_CUSTOMER', 'Este email lo hemos obtenido a través de usted o de alguien que se ha registrado en nuestra tienda. Si no fue usted, o piensa que ha recibido este mensaje por error, por favor, envíe un email a %s ');

define('TABLE_HEADING_PRIVACY_CONDITIONS', 'Declaración de Privacidad');
define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', 'Por favor, acepte nuestra declaración de privacidad marcando el siguiente casillero. Puede leer la declaración de privacidad <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><u>aquí</u></a>.');
define('TEXT_PRIVACY_CONDITIONS_CONFIRM', 'He leído y acepto la declaración de privacidad.');

// Nuevas en ZenCart 1.3.6
define('TABLE_HEADING_ADDRESS_DETAILS', 'Dirección');
define('TABLE_HEADING_PHONE_FAX_DETAILS', 'Datos adicionales');
define('TABLE_HEADING_DATE_OF_BIRTH', 'Verifique su edad');
define('TABLE_HEADING_LOGIN_DETAILS', 'Detalles de su cuenta');
define('TABLE_HEADING_REFERRAL_DETAILS', '¿Cómo nos conoció?');
?>
