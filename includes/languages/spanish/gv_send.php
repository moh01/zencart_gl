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
// $Id: gv_send.php,v 1.2 2006/01/10 18:23:43 gorkau Exp $
//

define('HEADING_TITLE', 'Enviar ' . TEXT_GV_NAME);
define('NAVBAR_TITLE', 'Enviar ' . TEXT_GV_NAME);
define('EMAIL_SUBJECT', 'Mensaje de ' . STORE_NAME);
define('HEADING_TEXT', '<br />Por favor, introduzca aquí debajo los detalles del ' . TEXT_GV_NAME . ' que desea enviar. Para más información, por favor, vea nuestro <a href="' . zen_href_link(FILENAME_GV_FAQ, '', 'NONSSL').'">' . GV_FAQ . '.</a><br />');
define('ENTRY_NAME', 'Nombre del destinatario:');
define('ENTRY_EMAIL', 'E-Mail del destinatario:');
define('ENTRY_MESSAGE', 'Mensaje al destinatario:');
define('ENTRY_AMOUNT', 'Cantidad del ' . TEXT_GV_NAME . ':');
define('ERROR_ENTRY_AMOUNT_CHECK', '&nbsp;&nbsp;<span class="errorText">Cantidad errónea</span>');
define('ERROR_ENTRY_EMAIL_ADDRESS_CHECK', '&nbsp;&nbsp;<span class="errorText">Email no válido</span>');
define('MAIN_MESSAGE', 'Va a enviar un ' . TEXT_GV_NAME . ' que  vale %s a %s cuyo email es %s<br /><br />El texto acompañando el email dirá<br /><br />Estimado/a %s<br /><br />' .
                        'Le han enviado un ' . TEXT_GV_NAME . ' que vale %s por %s');

define('PERSONAL_MESSAGE', '%s dice');
define('TEXT_SUCCESS', 'Enhorabuena, su ' . TEXT_GV_NAME . ' ha sido enviado correctamente');

define('TEXT_AVAILABLE_BALANCE','Balance actual disponible: ');

define('EMAIL_GV_TEXT_SUBJECT', 'Un regalo de %s');
define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------');
define('EMAIL_GV_TEXT_HEADER', 'Enhorabuena, ha recibido un ' . TEXT_GV_NAME . ' que vale %s');
define('EMAIL_GV_FROM', 'Este ' . TEXT_GV_NAME . ' le fue enviado por %s');
define('EMAIL_GV_MESSAGE', 'con un mensaje que dice ');
define('EMAIL_GV_SEND_TO', 'Hola, %s');
define('EMAIL_GV_REDEEM', 'Para canjear este ' . TEXT_GV_NAME . ' haga click en el enlace de aquí abajo. Por favor, escriba también el ' . TEXT_GV_REDEEM . ': que es %s ' . "\n\n" . 'Sólo en caso que tenga algún problema.');
define('EMAIL_GV_LINK', 'Para canjearlo, por favor, pulse ');
define('EMAIL_GV_VISIT', ' o visite ');
define('EMAIL_GV_ENTER', ' e ingrese el ' . TEXT_GV_REDEEM . ' ');
define('EMAIL_GV_FIXED_FOOTER', 'Si tiene problemas al canjear el código ' . TEXT_GV_NAME . ' usando el enlace de aquí arriba, ' . "\n" .
                                'puede ingresar también el ' . TEXT_GV_REDEEM . ' del ' . TEXT_GV_NAME . ' durante el pago en nuestra tienda.');
define('EMAIL_GV_SHOP_FOOTER', '');

// Nuevas en ZenCart 1.3.6
// UHT
define('HEADING_TITLE_CONFIRM_SEND', 'Send ' . TEXT_GV_NAME . ' Confirmation');
define('HEADING_TEXT','Please enter the name, email address and amount of the ' . TEXT_GV_NAME . ' you wish to send. For more information, please see our <a href="' . zen_href_link(FILENAME_GV_FAQ, '', 'NONSSL').'">' . GV_FAQ . '.</a>');
define('ERROR_ENTRY_TO_NAME_CHECK', 'We did not get the Recipient\'s Name. Please fill it in below. ');
define('MAIN_MESSAGE', 'You are sending a ' . TEXT_GV_NAME . ' worth %s to %s,  whose email address is %s. If these details are not correct, you may edit your message by clicking the <strong>edit</strong> button.<br /><br />The message you are sending is:<br /><br />');
define('SECONDARY_MESSAGE', 'Dear %s,<br /><br />' . 'You have been sent a ' . TEXT_GV_NAME . ' worth %s by %s');
define('TEXT_SEND_ANOTHER', 'Would you like to send another ' . TEXT_GV_NAME . '?');
?>
