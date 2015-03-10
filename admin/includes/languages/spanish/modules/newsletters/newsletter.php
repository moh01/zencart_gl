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
//  $Id: newsletter.php,v 1.1 2005/12/22 22:31:32 gorkau Exp $
//

define('TEXT_COUNT_CUSTOMERS', 'Clientes recibiendo el boletín de noticias: %s');
define('HEADING_TITLE', 'Administrador de boletín de noticias');

define('TABLE_HEADING_NEWSLETTERS', 'Boletines');
define('TABLE_HEADING_SIZE', 'Tamaño');
define('TABLE_HEADING_MODULE', 'Módulo');
define('TABLE_HEADING_SENT', 'Enviado');
define('TABLE_HEADING_STATUS', 'Estado');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_NEWSLETTER_MODULE', 'Módulo:');
define('TEXT_NEWSLETTER_TITLE', 'Asunto:');
define('TEXT_NEWSLETTER_CONTENT', 'Contenido <br />sólo texto:');
define('TEXT_NEWSLETTER_CONTENT_HTML', 'Contenido <br />texto enriquecido:');

define('TEXT_NEWSLETTER_DATE_ADDED', 'Añadido el:');
define('TEXT_NEWSLETTER_DATE_SENT', 'Enviado el:');

define('TEXT_INFO_DELETE_INTRO', '¿Está seguro de que desea borrar este boletín?');

define('TEXT_PLEASE_SELECT_AUDIENCE','Por favor, seleccione la audiencia para este envío de boletín: ');
define('TEXT_PLEASE_WAIT', 'Espere, por favor .. enviando correos ..<br /><br />Por favor, ¡no interrumpa este proceso!');
define('TEXT_FINISHED_SENDING_EMAILS', '¡Finalizó el envío de emails!');

define('ERROR_NEWSLETTER_TITLE', 'Error: Título de boletín requerido');
define('ERROR_NEWSLETTER_MODULE', 'Error: Módulo de boletín requerido');
define('ERROR_REMOVE_UNLOCKED_NEWSLETTER', 'Error: Por favor, bloquee el boletín antes de borrarlo.');
define('ERROR_EDIT_UNLOCKED_NEWSLETTER', 'Error: Por favor, bloquee el boletín antes de editarlo.');
define('ERROR_SEND_UNLOCKED_NEWSLETTER', 'Error: Por favor, bloquee el boletín antes de enviarlo.');
?>
