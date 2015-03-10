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
//  $Id: products_price_manager.php,v 1.1 2005/12/22 22:31:18 gorkau Exp $
//

define('HEADING_TITLE', 'Administración de precios de productos');
define('HEADING_TITLE_PRODUCT_SELECT','Por favor, seleccione una categoría con productos para mostrar la información de tasación de ...');

define('TABLE_HEADING_PRODUCTS', 'Productos');
define('TABLE_HEADING_PRODUCTS_MODEL','Modelo');
define('TABLE_HEADING_PRODUCTS_PRICE', 'Precio/Especial/Oferta de productos');
define('TABLE_HEADING_PRODUCTS_PERCENTAGE','Porcentaje');
define('TABLE_HEADING_AVAILABLE_DATE', 'Disponible');
define('TABLE_HEADING_EXPIRES_DATE','Caduca');
define('TABLE_HEADING_STATUS', 'Estado');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_PRODUCT_INFO', 'Información del producto:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Información de precio de producto:');
define('TEXT_PRODUCTS_MODEL','Modelo:');
define('TEXT_PRICE', 'Precio');
define('TEXT_PRODUCT_AVAILABLE_DATE', 'Fecha de disponibilidad:');
define('TEXT_PRODUCTS_STATUS', 'Estado de los productos:');
define('TEXT_PRODUCT_AVAILABLE', 'En stock');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Fuera de stock');

define('TEXT_PRODUCT_INFO_NONE', 'Por favor, seleccione un producto de arriba ...');
  define('TEXT_PRODUCT_IS_FREE','El producto es gratis:');
  define('TEXT_PRODUCTS_IS_FREE_EDIT','<br />*Producto marcado GRATIS');
  define('TEXT_PRODUCT_IS_CALL','Llamar para precio:');
  define('TEXT_PRODUCTS_IS_CALL_EDIT','<br />*Producto marcado LLAMAR PARA PRECIO');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES','Tasado por atributos:');
  define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE','Sí');
  define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE','No');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT','<br />*El precio mostrado incluría el precio más bajo de atributos de grupo más el precio');
  define('TEXT_PRODUCTS_MIXED','Cdad. Min/Mezcla de unidades:');
  define('TEXT_PRODUCTS_MIXED_DISCOUNT_QUANTITY', 'Descuendo de cdad se aplica a atributos mezclados');

  define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL','Cdad. Min:');
  define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL','Unidades de Cdad:');
  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL','Cdad. Max:');
  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT','0= Ilimitado<br />1= Sin caja de cdad./Valor máximo');

define('TEXT_FEATURED_PRODUCT_INFO', 'Información de producto destacado:');
define('TEXT_FEATURED_PRODUCT', 'Producto:');
define('TEXT_FEATURED_EXPIRES_DATE', 'Fecha de caducidad:');
define('TEXT_FEATURED_AVAILABLE_DATE', 'Fecha de disponibilidad:');
define('TEXT_FEATURED_PRODUCTS_STATUS', 'Estado destacado:');
define('TEXT_FEATURED_PRODUCT_AVAILABLE', 'Activo');
define('TEXT_FEATURED_PRODUCT_NOT_AVAILABLE', 'Inactivo');
define('TEXT_FEATURED_DISABLED', '<strong>NOTA: La información de producto destacado está desactivada, caducada, o todavía no activa actualmente</strong>');

define('TEXT_SPECIALS_PRODUCT', 'Producto:');
define('TEXT_SPECIALS_SPECIAL_PRICE', 'Precio especial:');
define('TEXT_SPECIALS_EXPIRES_DATE', 'Fecha de caducidad:');
define('TEXT_SPECIALS_AVAILABLE_DATE', 'Fecha de disponibilidad:');
define('TEXT_SPECIALS_PRICE_TIP', '<b>Notas especiales:</b><ul><li>Puede introducir un porcentaje a deducir en el campo de Precio especial, por ejemplo: <b>20%</b></li><li>Si introduce un nuevo precio, el decimal separador debe ser un \'.\' (punto decimal), ejemplo: <b>49.99</b></li><li>Deje la fecha de caducidad vacía para sin caducidad</li></ul>');
define('TEXT_SPECIALS_PRODUCT_INFO', 'Información de precio especial:');
define('TEXT_SPECIALS_PRODUCTS_STATUS', 'Estado especial:');
define('TEXT_SPECIALS_PRODUCT_AVAILABLE', 'Activo');
define('TEXT_SPECIALS_PRODUCT_NOT_AVAILABLE', 'Inactivo');
define('TEXT_SPECIALS_NO_GIFTS','Sin especiales en CD');
define('TEXT_SPECIAL_DISABLED', '<strong>NOTA: Los productos especiales están desactivados, caducados, o todavía no activos actualmente.</strong>');

define('TEXT_INFO_DATE_ADDED', 'Añadido el:');
define('TEXT_INFO_LAST_MODIFIED', 'Última modificación:');
define('TEXT_INFO_NEW_PRICE', 'Nuevo precio:');
define('TEXT_INFO_ORIGINAL_PRICE', 'Precio original:');
define('TEXT_INFO_PERCENTAGE', 'Porcentaje:');
define('TEXT_INFO_AVAILABLE_DATE', 'Disponible el:');
define('TEXT_INFO_EXPIRES_DATE', 'Caduca el:');
define('TEXT_INFO_STATUS_CHANGE', 'Cambio de estado:');
define('TEXT_IMAGE_NONEXISTENT', 'No existe la imagen');

define('TEXT_INFO_HEADING_DELETE_FEATURED', 'Borrar destacado');
define('TEXT_INFO_DELETE_INTRO', '¿Estás seguro de que deseas borrar el producto destacado?');

  define('TEXT_ATTRIBUTES_INSERT_INFO', '<strong>Defina el parámetro de atributo y presione insertar para aplicar</strong>');
  define('TEXT_PRICED_BY_ATTRIBUTES', 'Tasado por atributos');
  define('TEXT_PRODUCTS_PRICE', 'Precio de productos: ');
  define('TEXT_SPECIAL_PRICE', 'Precio especial: ');
  define('TEXT_SALE_PRICE', 'Precio de oferta: ');
  define('TEXT_FREE', 'GRATIS');
  define('TEXT_CALL_FOR_PRICE', 'Llamar para precio');

define('TEXT_ADD_ADDITIONAL_DISCOUNT', 'Añadir ' . DISCOUNT_QTY_ADD . ' Descientas de cdad. en blanco:');
define('TEXT_BLANKS_INFO','Todos los descuentos de cantidad 0 serán borrados al actualizar');
define('TEXT_INFO_NO_DISCOUNTS', 'No se han definido descuentos de cantidad');
define('TEXT_PRODUCTS_DISCOUNT_QTY_TITLE', 'Niveles de descuento');
define('TEXT_PRODUCTS_DISCOUNT','Descuento');
define('TEXT_PRODUCTS_DISCOUNT_QTY','Cdad. mínima');
define('TEXT_PRODUCTS_DISCOUNT_PRICE','Valor de descuento');
define('TEXT_PRODUCTS_DISCOUNT_TYPE','Tipo');

define('TEXT_PRODUCTS_DISCOUNT_PRICE_EACH','Calcular precio:');
define('TEXT_PRODUCTS_DISCOUNT_PRICE_EXTENDED','Precio extendido:');
define('TEXT_PRODUCTS_DISCOUNT_PRICE_EACH_TAX','Calcular<br />Precio: &nbsp; Impuestos:');
define('TEXT_PRODUCTS_DISCOUNT_PRICE_EXTENDED_TAX','Precio<br />extendido: &nbsp; Impuestos:');

define('TEXT_EACH','ea.');
define('TEXT_EXTENDED','total');

define('TEXT_DISCOUNT_TYPE_INFO', 'Información de descuento de producto');
define('TEXT_DISCOUNT_TYPE','Tipo dedescuento:');
define('TEXT_DISCOUNT_TYPE_FROM', 'Descuento calculado desde:');

define('DISCOUNT_TYPE_DROPDOWN_0','Ninguno');
define('DISCOUNT_TYPE_DROPDOWN_1','Porcentaje');
define('DISCOUNT_TYPE_DROPDOWN_2','Precio actual');
define('DISCOUNT_TYPE_DROPDOWN_3','Cantidad descontada');

define('DISCOUNT_TYPE_FROM_DROPDOWN_0','Precio');
define('DISCOUNT_TYPE_FROM_DROPDOWN_1','Especial');

define('TEXT_UPDATE_COMMIT','Actualizar y realizar todos los cambios para la pantalla mostrada actualmente');

define('TEXT_PRODUCTS_TAX_CLASS', 'Clase de impuesto:');

define('TEXT_INFO_MASTER_CATEGORIES_ID_WARNING', '<strong>Atención:</strong> ¡El ID de categoría principal de producto número %s no concuerda con el ID de categoría actual %s y el producto no está enlazado!');
define('TEXT_INFO_MASTER_CATEGORIES_CURRENT', ' El ID de categoría actual %s coincide con el ID de categoría principal %s');
define('TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE_TO_CURRENT', 'Actualizar el ID de categoría principal %s para que coincida con el de la categoría actual %s');

define('PRODUCT_WARNING_UPDATE', 'Por favor, realice los cambios y presione actualizar para guardarlos');
define('PRODUCT_UPDATE_SUCCESS', '¡Actualización de cambios de producto exitosa!');
define('PRODUCT_WARNING_UPDATE_CANCEL', 'Los cambios fueron cancelados y no se guardaron ...');
define('TEXT_INFO_EDIT_CAUTION', '<strong>Clic para comenzar a editar ...</strong>');
define('TEXT_INFO_PREVIEW_ONLY', 'Sólo vista previa ... Estado actual de precio ... Sólo vista previa');
define('TEXT_INFO_UPDATE_REMINDER', '<strong>Edite la información de producto y luego actualice para salvar</strong>');
?>