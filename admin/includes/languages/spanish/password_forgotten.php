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
// $Id: password_forgotten.php,v 1.2 2006/01/17 20:00:25 gorkau Exp $
//

define('HEADING_TITLE', 'Reenviar contraseña');

define('TEXT_ADMIN_EMAIL', 'Email del administrador: ');

define('ERROR_WRONG_EMAIL', '<p>Introdujo una dirección de correo incorrecta.</p>');
define('ERROR_WRONG_EMAIL_NULL', '<p>Buen intento, amigo :-P</p>');
define('SUCCESS_PASSWORD_SENT', '<p>Listo: Una nueva contraseña se ha enviado a su cuenta de email.</p>');

define('TEXT_EMAIL_SUBJECT', STORE_NAME . ' - Nueva contraseña');
define('TEXT_EMAIL_FROM', EMAIL_FROM);
define('TEXT_EMAIL_MESSAGE', 'Se ha solicitado una nueva contraseña desde ' . $_SESSION['REMOTE_ADDR'] . '.' . "\n\n" . '
Su nueva contraseña de \'' . STORE_NAME . '\' es:' . "\n\n" . '   %s' . "\n\n");

?>
