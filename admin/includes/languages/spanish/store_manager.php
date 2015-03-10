<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
//  $Id: store_manager.php,v 1.1 2005/12/22 22:31:18 gorkau Exp $
//
//
  define('HEADING_TITLE', 'Administración de tienda');
  define('TABLE_CONFIGURATION_TABLE', 'Buscar definiciones CONSTANTES');

  define('SUCCESS_PRODUCT_UPDATE_SORT_ALL', 'Actualización <strong>exitosa</strong> para la ordenación de atributos');
  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_PRICE_SORTER', 'Actualización <strong>exitosa</strong> para los valores de ordenación de precios de productos');
  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_VIEWED', 'Reinicio <strong>exitoso</strong> de productos vistos a 0');
  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_ORDERED', 'Reinicio <strong>exitoso</strong> de pedidos a 0');
  define('SUCCESS_UPDATE_ALL_MASTER_CATEGORIES_ID', 'Reinicio <strong>exitoso</strong> de todas las caracteristicas principales para productos enlazados');
  define('SUCCESS_UPDATE_COUNTER', '<strong>Actualización exitosa</strong> del contador a: ');
  define('SUCCESS_CLEAN_ADMIN_ACTIVITY_LOG', '<strong>Actualización exitosa</strong> del registro de actividades de los administradores.');

  define('ERROR_CONFIGURATION_KEY_NOT_FOUND', '<strong>Error:</strong> No se encontró configuración coincidente ...');
  define('ERROR_CONFIGURATION_KEY_NOT_ENTERED', '<strong>Error:</strong> No se introdujo clave de configuración o texto a buscar ... la búsqueda finalizó');

  define('TEXT_INFO_COUNTER_UPDATE', '<strong>Actualizar contador</strong><br />a un nuevo valor: ');
  define('TEXT_INFO_PRODUCTS_PRICE_SORTER_UPDATE', '<strong>Actualizar TODOS los ordenadores de precio de productos</strong><br />para que puedan ordenar por los precios mostrados: ');
  define('TEXT_INFO_PRODUCTS_VIEWED_UPDATE', '<strong>Reiniciar TODOS los productos vistos</strong><br />Reiniciar cuenta de productos vistos a 0: ');
  define('TEXT_INFO_PRODUCTS_ORDERED_UPDATE', '<strong>Reiniciar TODOS los pedidos</strong><br />Reiniciar cuenta de pedidos a 0: ');
  define('TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE', '<strong>Reiniciar TODOS los ID de categoría principal</strong><br />Para ser usados en productos enlazados y tasaciones: ');
  define('TEXT_INFO_ADMIN_ACTIVITY_LOG', '<strong>Vaciar el registro de activades del admin<br />ATENCIÓN: Haga una copia de seguridad de la base de datos antes de realizar esta acción!</strong><br />El registro de la actividad del admin registra toda la actividad de los administradores. Debido a su naturaleza puede hacerse muy grande rápidamente y es necesario hacer una limpieza cada cierto tiempo.<br />Se mostrará un aviso al llegar a los 50.000 registros o cuando pasen 60 días desde la última limpieza.');

  define('TEXT_ORDERS_ID_UPDATE', '<strong>Reiniciar el ID de pedido actual</strong>');
  define('TEXT_INFO_ORDERS_ID_UPDATE', '<strong>NOTA: Antes de actualizar el ID de pedido actual ...</strong><br /><br />Cree un pedido de prueba primero. Luego, usando este ID del dpedido de prueba, complete la información de debajo.<br />El nuevo ID de pedido para el siguiente pedido real debe ser introducido como 1 menos que el ID de pedido que quieres usar.<br /><strong>Ejemplo:</strong; Si quieres que el siguiente ID de pedido real sea el 1224<br /><br /><strong>ATENCIÓN:</strong> Sólo puede reiniciar el ID de pedido hacia alante, no hacia atrás.</br>Así que si configura el ID de pedidos a 25, y después lo cambias de nuevo a 20, el siguiente ID de pedido será aun 26.');
  define('TEXT_OLD_ORDERS_ID', 'ID de pedido antigo');
  define('TEXT_NEW_ORDERS_ID', 'ID de pedido nuevo');

  define('TEXT_CONFIGURATION_CONSTANT', '<strong>Buscar CONSTANTES definiciones de archivos de idioma</strong>');
  define('TEXT_CONFIGURATION_KEY', 'Clave o nombre:');
  define('TEXT_INFO_CONFIGURATION_UPDATE', '<strong>NOTA:</strong> las CONSTANTES están escritas en mayúscula.<br />Las búsquedas de archivos de idioma pueden ser una búsqueda alternativa cuando no se encuentra nada en las tablas de la base de datos.');


  define('TEXT_CONFIGURATION_CONSTANT_FILES', '<strong>Buscar en definiciones de archivos de idiomas</strong>');
  define('TEXT_CONFIGURATION_KEY_FILES', 'Buscar texto:');
  define('TEXT_INFO_CONFIGURATION_UPDATE_FILES', '<strong>NOTA:</strong> Los términos de búsqueda en archivos de idioma pueden estar tanto en mayúsculas como en minúsculas');

  define('TABLE_TITLE_KEY', '<strong>Clave:</strong>');
  define('TABLE_TITLE_TITLE', '<strong>Título:</strong>');
  define('TABLE_TITLE_DESCRIPTION', '<strong>Descripción:</strong>');
  define('TABLE_TITLE_GROUP', '<strong>Grupo:</strong>');
  define('TABLE_TITLE_VALUE', '<strong>Valor:</strong>');

  define('TEXT_LANGUAGE_LOOKUPS', 'Búsquedas en archivos de idioma:');
  define('TEXT_LANGUAGE_LOOKUP_NONE', 'Ninguno');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_LANGUAGE', 'Todos los archivos de idioma para ' . strtoupper($_SESSION['language']) . ' - Catálogo/Admin');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG', 'Todos los archivos principales de idioma - Catálogo (' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . 'english.php /spanish.php etc.)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG_TEMPLATE', 'Todos los archivos de idioma seleccionados actualmente - ' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN', 'Todos los archivos principales de idioma - Admin (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . 'english.php /spanish.php etc.)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN_LANGUAGE', 'Todos los archivos de idioma seleccionados actualmente - Admin (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ALL', 'Todos los archivos de idioma seleccionados actualmente - Catálogo/Admin');

  define('TEXT_INFO_NO_EDIT_AVAILABLE','Edición no disponible');
  define('TEXT_INFO_CONFIGURATION_HIDDEN', ' u, OCULTO');
  
  define('TEXT_INFO_DATABASE_OPTIMIZE', '<strong>Optimizar base de datos</strong> para quitar el espacio de registros borrados.<br />Se recomienda hacerlo mensualmente o semanalmente en una tienda con mucho movimiento (Es recomendable optimizar la base de datos en horario de poca afluencia de visitantes).');
  define('SUCCESS_DB_OPTIMIZE', 'Optimización de la base de datos - Tablas procesadas: ');
?>