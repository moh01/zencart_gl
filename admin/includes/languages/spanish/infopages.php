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
//  $Id: infopages.php 2005-2-19
//
define('HEADING_TITLE', 'Information Pages');
define('TABLE_HEADING_PAGES', 'Título de la página');
define('TABLE_HEADING_ACTION', 'Acción');
define('TABLE_HEADING_VSORT_ORDER', 'Orden vertical');
define('TABLE_HEADING_HSORT_ORDER', 'Orden horizontal');
define('TEXT_PAGES_TITLE', 'Título de la página:');
define('TEXT_PAGES_HTML_TEXT', 'Contenido de la página (HTML):');
define('TABLE_HEADING_DATE_ADDED', 'Fecha añadido:');
define('TEXT_PAGES_STATUS_CHANGE', 'Cambiar estado: %s');
define('TEXT_INFO_DELETE_INTRO', '¿Estás seguro de querer borrar esta página?');
define('SUCCESS_PAGE_INSERTED', 'La página se ha añadido correctamente.');
define('SUCCESS_PAGE_UPDATED', 'La página se ha actualizado correctamente.');
define('SUCCESS_PAGE_REMOVED', 'La página ha sido eliminada.');
define('SUCCESS_PAGE_STATUS_UPDATED', 'El estado de la página se ha cambiado correctamente.');
define('ERROR_PAGE_TITLE_REQUIRED', 'Error: es necesario introducir un título.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Error: estado desconocido.');
define('TABLE_HEADING_STATUS', 'Estado');
define('TEXT_DISPLAY_NUMBER_OF_PAGES', 'Mostrando <b>%d</b> a <b>%d</b> (de <b>%d</b> páginas)');
define('IMAGE_NEW_PAGE', 'Nueva página');
define('TEXT_INFO_PAGE_IMAGE', 'Imagen');
define('TEXT_INFO_CURRENT_IMAGE', 'Imagen actual:');
define('TEXT_VERTICAL_SORT_ORDER', 'Orden vertical:');
define('TEXT_HORIZONTAL_SORT_ORDER', 'Orden horizontal:');
define('TEXT_VSORT_ORDER_EXPLAIN', 'El orden vertical se usa cuando se quiere listar las páginas en el cuadro lateral. Este valor debe ser
mayor que cero para que aparezca en el cuadro lateral.');
define('TEXT_HSORT_ORDER_EXPLAIN', 'El orden horizontal se usa cuando se quiere listar las páginas en el pie de la página. Este valor debe ser
mayor que cero para que aparezca en el pie.');
define('TEXT_ALT_URL', 'Enlace alternativo:');
define('TEXT_ALT_URL_EXPLAIN', 'Si se indica un enlace altarnetivo el contedido de la página será ignorado y este campo se usará
para hacer un enlace.');
?>
