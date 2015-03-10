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
// $Id: address_book_process.php,v 1.2 2006/01/09 23:05:03 gorkau Exp $
//

define('NAVBAR_TITLE_1', 'Mi cuenta');
define('NAVBAR_TITLE_2', 'Agenda de direcciones');

define('NAVBAR_TITLE_ADD_ENTRY', 'Nueva dirección');
define('NAVBAR_TITLE_MODIFY_ENTRY', 'Actualizar dirección');
define('NAVBAR_TITLE_DELETE_ENTRY', 'Borrar dirección');

define('HEADING_TITLE_ADD_ENTRY', '<h1>Nueva dirección en la agenda</h1>');
define('HEADING_TITLE_MODIFY_ENTRY', '<h1>Actualizar dirección en la agenda</h1>');
define('HEADING_TITLE_DELETE_ENTRY', '<h1>Borrar dirección de la agenda</h1>');
define('HEADING_TITLE', 'Dirección');

define('DELETE_ADDRESS_TITLE', 'Borrar direcciones');
define('DELETE_ADDRESS_DESCRIPTION', '¿Seguro desea borrar la dirección seleccionada de su agenda de direcciones?');

define('NEW_ADDRESS_TITLE', 'Nueva dirección en la agenda');

define('SELECTED_ADDRESS', 'Dirección seleccionada');
define('SET_AS_PRIMARY', 'Establecer como dirección principal.');

define('SUCCESS_ADDRESS_BOOK_ENTRY_DELETED', 'La dirección seleccionada ha sido borrada correctamente de su agenda de direcciones.');
define('SUCCESS_ADDRESS_BOOK_ENTRY_UPDATED', 'Su agenda de direcciones ha sido actualizada correctamente.');

define('WARNING_PRIMARY_ADDRESS_DELETION', 'La dirección primaria no puede ser borrada. Por favor, establezca otra dirección como la dirección primaria e inténtelo nuevamente.');

define('ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY', 'Esa dirección no está en la agenda.');
define('ERROR_ADDRESS_BOOK_FULL', 'Su agenda de contactos está completa. Por favor, borre alguna dirección que no necesite para poder guardar una nueva.');
?>
