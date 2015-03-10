<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                                 |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: layout_controller.php,v 1.2 2006/01/17 20:00:25 gorkau Exp $
//

define('HEADING_TITLE', 'Columna de cuadros');

define('TABLE_HEADING_LAYOUT_BOX_NAME', 'Nombre del fichero cuadro');
define('TABLE_HEADING_LAYOUT_BOX_STATUS', 'COLUMNA IZQ/DER<br />Estado');
define('TABLE_HEADING_LAYOUT_BOX_STATUS_SINGLE', 'COLUMNA SIMPLE<br />Estado');
define('TABLE_HEADING_LAYOUT_BOX_LOCATION', 'COLUMNA<br />IZQ/DER');
define('TABLE_HEADING_LAYOUT_BOX_SORT_ORDER', 'COLUMNA IZQ/DER<br />Orden');
define('TABLE_HEADING_LAYOUT_BOX_SORT_ORDER_SINGLE', 'COLUMNA SIMPLE<br />Orden');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_INFO_EDIT_INTRO', 'Por favor, haga los cambios necesarios');
define('TEXT_INFO_LAYOUT_BOX','Cuadro seleccionado: ');
define('TEXT_INFO_LAYOUT_BOX_NAME', 'Nombre del cuadro:');
define('TEXT_INFO_LAYOUT_BOX_LOCATION','Ubicación: (la Columna Simple ignora este dato)');
define('TEXT_INFO_LAYOUT_BOX_STATUS', 'Estado de Columna Izquierda/Derecha: ');
define('TEXT_INFO_LAYOUT_BOX_STATUS_SINGLE', 'Estado de Columna Simple: ');
define('TEXT_INFO_LAYOUT_BOX_STATUS_INFO','ON= 1 OFF=0');
define('TEXT_INFO_LAYOUT_BOX_SORT_ORDER', 'Orden de Columna Izquierda/Derecha:');
define('TEXT_INFO_LAYOUT_BOX_SORT_ORDER_SINGLE', 'Orden de Columna Simple:');
define('TEXT_INFO_INSERT_INTRO', 'Por favor, introduzca el nuevo cuadro con su información relacionada');
define('TEXT_INFO_DELETE_INTRO', '¿Seguro que desea eliminar este cuadro?');
define('TEXT_INFO_HEADING_NEW_BOX', 'Nuevo cuadro');
define('TEXT_INFO_HEADING_EDIT_BOX', 'Editar cuadro');
define('TEXT_INFO_HEADING_DELETE_BOX', 'Eliminar cuadro');
define('TEXT_INFO_DELETE_MISSING_LAYOUT_BOX','Eliminar cuadro faltante de la lista de la Plantilla: ');
define('TEXT_INFO_DELETE_MISSING_LAYOUT_BOX_NOTE','NOTA: Esto no elimina ficheros así que puede volver a añadir el cuadro en cualquier momento sólo agregándolo al directorio correcto.<br /><br /><strong>Eliminar nombre de cuadro: </strong>');
define('TEXT_INFO_RESET_TEMPLATE_SORT_ORDER','Restablecer todo el orden de los cuadros para que coincidan con el orden por DEFECTO para esta Plantilla: ');
define('TEXT_INFO_RESET_TEMPLATE_SORT_ORDER_NOTE','Esto no elimina ninguno de los cuadros. Sólo restablecerá el orden actual por defecto');
define('TEXT_INFO_BOX_DETAILS','Detalles de recuadro: ');

////////////////

define('HEADING_TITLE_LAYOUT_TEMPLATE', 'Disposición de la Plantilla del Sitio');

define('TABLE_HEADING_LAYOUT_TITLE', 'Título');
define('TABLE_HEADING_LAYOUT_VALUE', 'Valor');
define('TABLE_HEADING_ACTION', 'Acción');


define('TEXT_MODULE_DIRECTORY', 'Directorio de la disposición del sitio:');
define('TEXT_INFO_DATE_ADDED', 'Añadido el:');
define('TEXT_INFO_LAST_MODIFIED', 'Última modificación:');

// layout box text in includes/boxes/layout.php
define('BOX_HEADING_LAYOUT', 'Disposición');
define('BOX_LAYOUT_COLUMNS', 'Controlador de Columnas');

// file exists
define('TEXT_GOOD_BOX',' ');
define('TEXT_BAD_BOX','<font color="ff0000"><b>FALTANTE</b></font><br />');


// Success message
define('SUCCESS_BOX_DELETED', 'Borrado correctamente de la plantilla del cuadro: ');
define('SUCCESS_BOX_RESET', 'Laa configuración de todos los cuadros fue restablecida correctamente al configuración por defecto de la Plantilla: ');
define('SUCCESS_BOX_UPDATED', 'Configuración del cuadro Actualizada correctamente: ');

define('TEXT_ON', ' ON ');
define('TEXT_OFF', ' OFF ');
define('TEXT_LEFT', ' IZQ ');
define('TEXT_RIGHT', ' DER ');

?>
