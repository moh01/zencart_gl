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
//  $Id: geo_zones.php,v 1.1 2005/12/22 22:31:18 gorkau Exp $
//

define('HEADING_TITLE', 'Definición de Zonas: Impuestos, Pagos y Envíos');

define('TABLE_HEADING_COUNTRY', 'País');
define('TABLE_HEADING_COUNTRY_ZONE', 'Zona');
define('TABLE_HEADING_TAX_ZONES', 'Zonas de Impuesto');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_INFO_HEADING_NEW_ZONE', 'Nueva Zona');
define('TEXT_INFO_NEW_ZONE_INTRO', 'Por favor, ingrese la información de la nueva zona');

define('TEXT_INFO_HEADING_EDIT_ZONE', 'Editar Zona');
define('TEXT_INFO_EDIT_ZONE_INTRO', 'Por favor, haga los cambios necesarios');

define('TEXT_INFO_HEADING_DELETE_ZONE', 'Eliminar Zona');
define('TEXT_INFO_DELETE_ZONE_INTRO', '¿Seguro que desea eliminar esta zona?');

define('TEXT_INFO_HEADING_NEW_SUB_ZONE', 'Nueva Sub Zona');
define('TEXT_INFO_NEW_SUB_ZONE_INTRO', 'Por favor, ingrese la información de la nueva sub zona');

define('TEXT_INFO_HEADING_EDIT_SUB_ZONE', 'Editar Sub Zona');
define('TEXT_INFO_EDIT_SUB_ZONE_INTRO', 'Por favor, haga los cambios necesarios');

define('TEXT_INFO_HEADING_DELETE_SUB_ZONE', 'Eliminar Sub Zona');
define('TEXT_INFO_DELETE_SUB_ZONE_INTRO', '¿Seguro que desea eliminar esta sub zona?');

define('TEXT_INFO_DATE_ADDED', 'Agregado el:');
define('TEXT_INFO_LAST_MODIFIED', 'Última Modificación:');
define('TEXT_INFO_ZONE_NAME', 'Nombre de Zona:');
define('TEXT_INFO_NUMBER_ZONES', 'Número de Zonas:');
define('TEXT_INFO_ZONE_DESCRIPTION', 'Descripción:');
define('TEXT_INFO_COUNTRY', 'País:');
define('TEXT_INFO_COUNTRY_ZONE', 'Zona:');
define('TYPE_BELOW', 'Todas las Zonas');
define('PLEASE_SELECT', 'Todas las Zonas');
define('TEXT_ALL_COUNTRIES', 'Todas los Países');

define('TEXT_INFO_NUMBER_TAX_RATES','Número de Tasas de Impuestos:');
define('ERROR_TAX_RATE_EXISTS','ADVERTENCIA: hay al menos una Tasa de Impuesto definida para esta zona.  Por favor, borre las Tasas de Impuestos existentes antes de eliminar esta zona');
?>
