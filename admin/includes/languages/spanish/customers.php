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
//  $Id: customers.php,v 1.2 2006/01/14 13:32:20 damage_in Exp $
//

define('HEADING_TITLE', 'Clientes');
define('TABLE_HEADING_ID', 'ID#');

define('TABLE_HEADING_FIRSTNAME', 'Nombre');
define('TABLE_HEADING_LASTNAME', 'Apellido');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Cuenta creada');
define('TABLE_HEADING_LOGIN', 'Último acceso');
define('TABLE_HEADING_ACTION', 'Acción');
define('TABLE_HEADING_PRICING_GROUP', 'Precio por grupo');
define('TABLE_HEADING_AUTHORIZATION_APPROVAL', 'Autorizado');
define('TABLE_HEADING_COMPANY','Empresa');
define('TABLE_HEADING_TAXID','CIF/NIF');

define('TEXT_DATE_ACCOUNT_CREATED', 'Cuenta creada:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Última modificación:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Último ingreso:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Número de ingresos:');
define('TEXT_INFO_COUNTRY', 'País:');
define('TEXT_INFO_NUMBER_OF_REVIEWS', 'Número de comentarios:');
define('TEXT_DELETE_INTRO', '¿Seguro que desea eliminar este cliente?');
define('TEXT_DELETE_REVIEWS', 'Eliminar %s comentario(s)');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Eliminar cliente');
define('TYPE_BELOW', 'Escribir aquí debajo');
define('PLEASE_SELECT', 'Elegir uno');
define('TEXT_INFO_NUMBER_OF_ORDERS', 'Número de pedidos:');
define('TEXT_INFO_LAST_ORDER','Último pedido:');
define('TEXT_INFO_ORDERS_TOTAL', 'Total:');
define('CUSTOMERS_REFERRAL', 'Referencia del cliente<br />1er Cupón de descuento');

define('ENTRY_NONE', 'Ninguno');
define('CUSTOMERS_AUTHORIZATION', 'Estado de autorización de cliente');
define('CUSTOMERS_AUTHORIZATION_0', 'Aprobado');
define('CUSTOMERS_AUTHORIZATION_1', 'Pendiente de aprobación - Sin navegación');
define('CUSTOMERS_AUTHORIZATION_2', 'Pendiende de aprobación - Navegación sin precios');
define('CUSTOMERS_AUTHORIZATION_3', 'Pendiende de aprobación - Navegación con precios sin compra');
define('ERROR_CUSTOMER_APPROVAL_CORRECTION1', 'Atención: Su tienda está configurada para "Aprobación sin navegación". Los clientes se han configurado a "Pendiente de aprobación - Sin navegación"');
define('ERROR_CUSTOMER_APPROVAL_CORRECTION2', 'Atención: Su tienda está configurada para "Aprobración sin precios". Los clientes se han configurado a "Pendiente de aprobación - Navegación sin precios"');

define('ENTRY_TAXID', 'CIF/NIF:');

?>
