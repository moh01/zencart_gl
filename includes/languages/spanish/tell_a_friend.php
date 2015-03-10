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
// $Id: tell_a_friend.php,v 1.2 2006/01/10 16:33:48 damage_in Exp $
//

define('NAVBAR_TITLE', 'Avise a un amigo');

define('HEADING_TITLE', 'Avise a un amigo sobre \'%s\'');

define('FORM_TITLE_CUSTOMER_DETAILS', 'Sus detalles');
define('FORM_TITLE_FRIEND_DETAILS', 'Los detalles de su amigo');
define('FORM_TITLE_FRIEND_MESSAGE', 'Su mensaje');

define('FORM_FIELD_CUSTOMER_NAME', 'Su Nombre:');
define('FORM_FIELD_CUSTOMER_EMAIL', 'Su E-Mail:');
define('FORM_FIELD_FRIEND_NAME', 'El Nombre de su Amigo:');
define('FORM_FIELD_FRIEND_EMAIL', 'El E-Mail de su Amigo:');

define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------');

define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Su email acerca de <strong>%s</strong> fue enviado correctamente a <strong>%s</strong>.');

define('EMAIL_TEXT_HEADER','¡Aviso importante!');
define('EMAIL_TEXT_SUBJECT', 'Su amigo/a %s le ha recomendado este genial producto de %s');
define('EMAIL_TEXT_INTRO', 'Su amigo/a, %s, pensó que le interesaría %s de %s.');
define('EMAIL_TEXT_GREET', '¡Hola %s!' . "\n\n");
define('EMAIL_TELL_A_FRIEND_MESSAGE', '%s envió una nota diciendo');
define('EMAIL_TEXT_LINK', 'Para ver el producto, presione la dirección abajo indicada o copie y pegue la dirección en su navegador:' . "\n\n" . '%s');
define('EMAIL_TEXT_SIGNATURE', 'Saludos,' . "\n\n" . '%s');

define('ERROR_TO_NAME', 'Error: El campo del nombre de su amigo no debe estar vacío.');
define('ERROR_TO_ADDRESS', 'Error: El campo de e-mail de su amigo no parece ser válido. Por favor, inténtelo nuevamente.');
define('ERROR_FROM_NAME', 'Error: El campo de su nombre no debe estar vacío.');
define('ERROR_FROM_ADDRESS', 'Error: Su campo de e-mail indicado no parece ser válido. Por favor, inténtelo nuevamente.');
?>
