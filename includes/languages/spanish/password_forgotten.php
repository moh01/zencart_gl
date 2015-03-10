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
// $Id: password_forgotten.php,v 1.2 2006/01/10 18:23:43 gorkau Exp $
//

define('NAVBAR_TITLE_1', 'Ingresar');
define('NAVBAR_TITLE_2', 'Contraseña olvidada');

define('HEADING_TITLE', 'Contraseña olvidada');

define('TEXT_MAIN', 'Introduzca su email y le enviaremos un mensaje por correo electrónico con su nueva contraseña.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Falta la dirección de correo electrónico o no se puede reconocer.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' : Nueva contraseña');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Su nueva contraseña para \'' . STORE_NAME . '\' es:' . "\n\n" . '   %s' . "\n\n");


define('SUCCESS_PASSWORD_SENT', 'Contraseña cambiada. Acabamos de enviar a su email una nueva contraseña.');
?>
