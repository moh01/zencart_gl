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
//  $Id: coupon_admin.php,v 1.2 2006/01/14 13:32:20 damage_in Exp $
//

define('TOP_BAR_TITLE', 'Estadísticas');
define('HEADING_TITLE', 'Cupones descuento');
define('HEADING_TITLE_STATUS', 'Estado: ');
define('TEXT_CUSTOMER', 'Cliente:');
define('TEXT_COUPON', 'Nombre de Cupón');
define('TEXT_COUPON_ALL', 'Todos los Cupones');
define('TEXT_COUPON_ACTIVE', 'Cupones activos');
define('TEXT_COUPON_INACTIVE', 'Cupones inactivos');
define('TEXT_SUBJECT', 'Asunto:');
define('TEXT_UNLIMITED', 'Ilimitado');
define('TEXT_FROM', 'De:');
define('TEXT_FREE_SHIPPING', 'Envío gratis');
define('TEXT_MESSAGE', 'Mensaje:');
define('TEXT_RICH_TEXT_MESSAGE','Mensaje de texto enriquecido:');
define('TEXT_SELECT_CUSTOMER', 'Seleccionar usuario');
define('TEXT_ALL_CUSTOMERS', 'Todos los clientes');
define('TEXT_NEWSLETTER_CUSTOMERS', 'A todos los suscritores del boletín');
define('TEXT_CONFIRM_DELETE', '¿Seguro que desea eliminar este cupón?');
define('TEXT_SEE_RESTRICT', 'Restricciones aplicadas');

define('TEXT_COUPON_ANNOUNCE','Nos satisface ofrecerle un cupón de nuestra tienda');
define('TEXT_TO_REDEEM', 'Puede canjear este cupón durante el pago. Sólo introduzca el código en el casillero asignado, y pulse sobre el botón de canjear.');
define('TEXT_IN_CASE', ' en caso que tenga algún problema. ');
define('TEXT_VOUCHER_IS', 'El código del cupón es ');
define('TEXT_REMEMBER', 'No pierda el código del cupón, asegúrese de guardar bien el código, de esta manera puede beneficiarse de esta oferta especial.');
define('TEXT_VISIT', 'Visítenos en ' . HTTP_SERVER . DIR_WS_CATALOG);
define('TEXT_ENTER_CODE', ' e introduzca el código ');

define('TABLE_HEADING_ACTION', 'Acción');

define('CUSTOMER_ID', 'ID de cliente');
define('CUSTOMER_NAME', 'Nombre del cliente');
define('REDEEM_DATE', 'Fecha de canje');
define('IP_ADDRESS', 'Dirección IP');

define('TEXT_REDEMPTIONS', 'Canjes');
define('TEXT_REDEMPTIONS_TOTAL', 'En total');
define('TEXT_REDEMPTIONS_CUSTOMER', 'De este cliente');
define('TEXT_NO_FREE_SHIPPING', 'El envío no es gratis');

define('NOTICE_EMAIL_SENT_TO', 'Aviso: Email enviado a: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Error: No seleccionó ningún cliente.');
define('ERROR_NO_SUBJECT', 'Error: No se ha introducido ningún asunto.');
define('COUPON_NAME', 'Nombre del cupón');
//define('COUPON_VALUE', 'Valor del Cupón);
define('COUPON_AMOUNT', 'Cantidad del cupón');
define('COUPON_CODE', 'Código del cupón');
define('COUPON_STARTDATE', 'Fecha de inicio');
define('COUPON_FINISHDATE', 'Fecha final');
define('COUPON_FREE_SHIP', 'Envío gratis');
define('COUPON_DESC', 'Descripción del cupón');
define('COUPON_MIN_ORDER', 'Mínimo del pedido para obtener cupón');
define('COUPON_USES_COUPON', 'Usos por cupón');
define('COUPON_USES_USER', 'Usos por cliente');
define('COUPON_PRODUCTS', 'Lista de productos válidos');
define('COUPON_CATEGORIES', 'Lista de categorías válidas');
define('VOUCHER_NUMBER_USED', 'Número usado');
define('DATE_CREATED', 'Fecha de creación');
define('DATE_MODIFIED', 'Fecha de modificación');
define('TEXT_HEADING_NEW_COUPON', 'Crear nuevo cupón');
define('TEXT_NEW_INTRO', 'Por favor, introduzca la siguiente información para el nuevo cupón.<br>');

define('ERROR_NO_COUPON_AMOUNT', 'No ingresó una cantidad para el cupón');
define('ERROR_NO_COUPON_NAME', 'No ingresó un nombre para el cupón ');
define('ERROR_COUPON_EXISTS', 'Ya existe un cupón con ese código');

define('COUPON_NAME_HELP', 'Nombre demasiado corto para el cupón');
define('COUPON_AMOUNT_HELP', 'El valor del descuento para el cupón, puede ser un valor fijo o agregue un % al final para un porcentaje de descuento.');
define('COUPON_CODE_HELP', 'Puede ingresar aquí su propio código, o dejarlo en blanco para que se genere automaticamente.');
define('COUPON_STARTDATE_HELP', 'La fecha desde la que el cupón será válido');
define('COUPON_FINISHDATE_HELP', 'La fecha en la que caduca el cupón');
define('COUPON_FREE_SHIP_HELP', 'El cupón permite el envío gratis en un pedido Nota: esto está por encima de la figura la cantidad_del_cupón, pero respeta el valor mínimo del pedido');
define('COUPON_DESC_HELP', 'Una descripción del cupón para el cliente');
define('COUPON_MIN_ORDER_HELP', 'El mínimo valor del pedido para que el cupón sea válido');
define('COUPON_USES_COUPON_HELP', 'La máximas veces que el cupón puede ser usado, dejar en blanco si no hay límite.');
define('COUPON_USES_USER_HELP', 'La máxima cantidad de veces que un usuario puede usar un cupón, dejar en blanco si no hay límite.');
define('COUPON_PRODUCTS_HELP', 'Un lista de product_ids (IDs de productos) separados por coma para los que este cupón puede ser usado. Dejar en blanco si no hay restricciones.');
define('COUPON_CATEGORIES_HELP', 'Un lista de cpaths (rutas de categoría) separadas por coma para los que este cupón puede ser usado, dejar en blanco si no hay restricciones.');
define('COUPON_BUTTON_PREVIEW', 'Vista previa');
define('COUPON_BUTTON_CONFIRM', 'Confirmar');
define('COUPON_BUTTON_BACK', 'Volver');
?>
