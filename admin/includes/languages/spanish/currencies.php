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
//  $Id: currencies.php,v 1.2 2006/01/14 13:32:20 damage_in Exp $
//

define('HEADING_TITLE', 'Monedas');

define('TABLE_HEADING_CURRENCY_NAME', 'Moneda');
define('TABLE_HEADING_CURRENCY_CODES', 'Código');
define('TABLE_HEADING_CURRENCY_VALUE', 'Valor');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_INFO_EDIT_INTRO', 'Por favor, haga los cambios necesarios');
define('TEXT_INFO_CURRENCY_TITLE', 'Título:');
define('TEXT_INFO_CURRENCY_CODE', 'Código:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Símbolo izquierdo:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Símbolo derecho:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Punto decimal:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Punto de mil:');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Lugares decimales:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Última actualización:');
define('TEXT_INFO_CURRENCY_VALUE', 'Valor:');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Ejemplo de muestra:');
define('TEXT_INFO_INSERT_INTRO', 'Por favor, ingresa la nueva moneda con su información relacionada');
define('TEXT_INFO_DELETE_INTRO', '¿Seguro que desea eliminar esta moneda?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Nueva moneda');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Editar moneda');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Eliminar moneda');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (se necesita una actualización manual de los valores de la moneda)');
define('TEXT_INFO_CURRENCY_UPDATED', 'La tasa de cambio para %s (%s) fue actualizada correctamente via %s.');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Error: No se puede eliminar la moneda por defecto. Por favor, establezca otra moneda por defecto e inténtelo nuevamente.');
define('ERROR_CURRENCY_INVALID', 'Error: La tasa de cambio para %s (%s) no fue actualizada via %s. ¿Es un código de moneda correcto?');
define('WARNING_PRIMARY_SERVER_FAILED', 'Advertencia: El servidor primario de tasas de cambio (%s) falló para %s (%s); inténtelo con el servidor de tasa de cambio secundario.');
?>
