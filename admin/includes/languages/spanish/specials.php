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
//  $Id: specials.php,v 1.2 2006/01/11 21:11:49 gorkau Exp $
//

define('HEADING_TITLE', 'Ofertas');

define('TABLE_HEADING_PRODUCTS', 'Productos');
define('TABLE_HEADING_PRODUCTS_MODEL','Modelo');
define('TABLE_HEADING_PRODUCTS_PRICE', 'Precio de los Productos/Ofertas/Rebajas');
define('TABLE_HEADING_PRODUCTS_PERCENTAGE','Porcentaje');
define('TABLE_HEADING_AVAILABLE_DATE', 'Disponible');
define('TABLE_HEADING_EXPIRES_DATE','Caduca');
define('TABLE_HEADING_STATUS', 'Estado');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_SPECIALS_PRODUCT', 'Producto:');
define('TEXT_SPECIALS_SPECIAL_PRICE', 'Precio de Oferta:');
define('TEXT_SPECIALS_EXPIRES_DATE', 'Fecha de Caducidad:');
define('TEXT_SPECIALS_AVAILABLE_DATE', 'Fecha de disponibilidad:');
define('TEXT_SPECIALS_PRICE_TIP', '<b>Notas sobre las ofertas:</b><ul><li>Puede ingresar un porcentaje en la celda "Precio de Oferta", por ejemplo: <b>20%</b></li><li>Si ingresa un nuevo precio, el separador decimal debe ser un \'.\' (punto-decimal), ejemplo: <b>49.99</b></li><li>Deje la fecha de caducidad vacía para que haya expiración</li></ul>');

define('TEXT_INFO_DATE_ADDED', 'Agregado el:');
define('TEXT_INFO_LAST_MODIFIED', 'Última modificación:');
define('TEXT_INFO_NEW_PRICE', 'Nuevo Precio:');
define('TEXT_INFO_ORIGINAL_PRICE', 'Precio original:');
define('TEXT_INFO_DISPLAY_PRICE', 'Mostrar precio:<br />');
define('TEXT_INFO_AVAILABLE_DATE', 'Disponible el:');
define('TEXT_INFO_EXPIRES_DATE', 'Expira el:');
define('TEXT_INFO_STATUS_CHANGE', 'Estado del cambio:');
define('TEXT_IMAGE_NONEXISTENT', 'La imagen no existe');

define('TEXT_INFO_HEADING_DELETE_SPECIALS', 'Eliminar oferta');
define('TEXT_INFO_DELETE_INTRO', '¿Seguro que desea eliminar el precio de oferta del producto?');
?>
