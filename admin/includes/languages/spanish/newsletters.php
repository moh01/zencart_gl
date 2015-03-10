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
//  $Id: newsletters.php,v 1.2 2006/01/17 20:00:25 gorkau Exp $
//

define('HEADING_TITLE', 'Boletín de noticias');

define('TABLE_HEADING_NEWSLETTERS', 'Boletines');
define('TABLE_HEADING_SIZE', 'Tamaño');
define('TABLE_HEADING_MODULE', 'Módulo');
define('TABLE_HEADING_SENT', 'Enviado');
define('TABLE_HEADING_STATUS', 'Estado');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_NEWSLETTER_MODULE', 'Módulo:');
define('TEXT_NEWSLETTER_TITLE', 'Título del Boletín:');
define('TEXT_NEWSLETTER_CONTENT', 'Contenido <br />de sólo texto:');
define('TEXT_NEWSLETTER_CONTENT_HTML', 'Contenido <br />de texto enriquecido:');

define('TEXT_NEWSLETTER_DATE_ADDED', 'Agregado el:');
define('TEXT_NEWSLETTER_DATE_SENT', 'Fecha de Envío:');

define('TEXT_INFO_DELETE_INTRO', '¿Seguro que desea eliminar este boletín?');

define('TEXT_PLEASE_WAIT', 'Por favor, espere .. enviando emails ..<br><br>¡No interrumpa este proceso!');
define('TEXT_FINISHED_SENDING_EMAILS', '¡Envío de e-mails finalizado!');

define('TEXT_AFTER_EMAIL_INSTRUCTIONS','%s correos procesados. <br /><br />Revise su bandjea de entrada de correo ('.EMAIL_FROM.') para:<UL><LI>a) mensajes rebotados</LI><LI>b) direcciones de correo que ya no son válidas</LI><LI>c) peticiones de borrado.</LI></UL>Las peticiones de borrado pueden ser procesadas editando la información del cliente en el menú Admin | Clientes.');
define('ERROR_NEWSLETTER_TITLE', 'Error: Hace falta el título del boletín');
define('ERROR_NEWSLETTER_MODULE', 'Error: Hafe falta el módulo del boletín');
define('ERROR_PLEASE_SELECT_AUDIENCE','Error: Por favor, seleccione la audiencia a la que va destinada el boletín');
define('ERROR_REMOVE_UNLOCKED_NEWSLETTER', 'Error: Por favor, cierre el boletín antes de eliminarlo.');
define('ERROR_EDIT_UNLOCKED_NEWSLETTER', 'Error: Por favor, cierre el boletín antes de editarlo.');
define('ERROR_SEND_UNLOCKED_NEWSLETTER', 'Error: Por favor, cierre el boletín antes de enviarlo.');
?>
