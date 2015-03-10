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
//  $Id: downloads_manager.php,v 1.2 2006/01/14 13:32:20 damage_in Exp $
//

define('HEADING_TITLE','Administrador de descargas');
define('TABLE_HEADING_ATTRIBUTES_ID', 'ID de Atrib.');
define('TABLE_HEADING_PRODUCTS_ID', 'ID de producto');
define('TABLE_HEADING_PRODUCT', 'Nombre de producto');
define('TABLE_HEADING_MODEL', 'Modelo');
define('TABLE_HEADING_OPT_NAME', 'Nombre de opción');
define('TABLE_HEADING_OPT_VALUE', 'Nombre de valor de opción');
define('TABLE_TEXT_FILENAME', 'Archivo');
define('TABLE_TEXT_MAX_DAYS', 'Días');
define('TABLE_TEXT_MAX_COUNT', 'Cuenta');
define('TABLE_HEADING_ACTION', 'Acción');

define('TABLE_HEADING_OPT_PRICE', 'Precio');
define('TABLE_HEADING_OPT_PRICE_PREFIX', 'Prefijo');

define('TEXT_PRODUCTS_NAME', 'Producto: ');
define('TEXT_PRODUCTS_MODEL', 'Modelo: ');

define('TEXT_INFO_HEADING_EDIT_PRODUCTS_DOWNLOAD', 'EDITANDO INFORMACIÓN DE DESCARGA');
define('TEXT_INFO_HEADING_DELETE_PRODUCTS_DOWNLOAD', 'CONFIRMAR BORRADO DE DESCARGA');
define('TEXT_INFO_EDIT_INTRO', 'Editar la información de descarga:');
define('TEXT_DELETE_INTRO', 'Los siguientes archivos serán quitados de la base de datos. Esto no borrará el archivo del servidor:');

define('TEXT_INFO_FILENAME', 'Nombre de archivo ');
define('TEXT_INFO_MAX_DAYS', 'Días máximos: ');
define('TEXT_INFO_MAX_COUNT', 'Descargas máximas: ');

define('TEXT_INFO_FILENAME_MISSING','&nbsp;Falta nombre de archivo');
define('TEXT_INFO_FILENAME_GOOD','&nbsp;Nombre de archivo válido');
?>