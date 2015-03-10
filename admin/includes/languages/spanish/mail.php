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
//  $Id: mail.php,v 1.2 2006/01/17 20:00:25 gorkau Exp $
//

define('HEADING_TITLE', 'Enviar email a los clientes');

define('TEXT_CUSTOMER', 'Cliente:');
define('TEXT_SUBJECT', 'Asunto:');
define('TEXT_FROM', 'De:');
define('TEXT_MESSAGE', 'Mensaje <br />sólo texto:');
define('TEXT_MESSAGE_HTML','Mensaje <br />texto enriquecido:');
define('TEXT_SELECT_CUSTOMER', 'Seleccionar cliente');
define('TEXT_ALL_CUSTOMERS', 'Todos los clientes');
define('TEXT_NEWSLETTER_CUSTOMERS', 'Sólo los suscriptores del boletín');
define('TEXT_ATTACHMENTS_LIST','Adjunto seleccionado: ');
define('TEXT_SELECT_ATTACHMENT','Adjunto<br />en servidor: ');
define('TEXT_SELECT_ATTACHMENT_TO_UPLOAD','Adjunto<br />a subir<br />y adjuntar: ');
define('TEXT_ATTACHMENTS_DIR','Directorio para subida: ');
define('NOTICE_EMAIL_SENT_TO', 'Aviso: Email enviado a: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Error: No ha seleccionado un cliente.');
define('ERROR_NO_SUBJECT', 'Error: No se ha introducido asunto.');
define('ERROR_ATTACHMENTS', 'Error: No puede seleccionar SUBIR y AÑADIR a la vez adjuntos separados. Seleccione sólo uno, por favor.');
?>
