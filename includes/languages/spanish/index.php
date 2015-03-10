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
// $Id: index.php,v 1.4 2006/01/18 10:25:16 gorkau Exp $
//

define('TEXT_MAIN','Esta es la definición del saludo principal para la página en castellano cuando no existe ninguna plantilla definida. Está ubicada en: <strong>/includes/languages/spanish/index.php</strong>');

// Showcase vs Store
if (STORE_STATUS == '0') {
  define('TEXT_GREETING_GUEST', '¡Bienvenido/a <span class="greetUser">Invitado/a</span>! ¿Quiere <a href="%s">identificarse</a>?');
} else {
  define('TEXT_GREETING_GUEST', 'Bienvenido, esperamos que disfrute de nuestro escaparate virtual.');
}

define('TEXT_GREETING_PERSONAL', '¡Hola <span class="greetUser">%s</span>! ¿Quiere ver nuestras <a href="%s">últimas novedades</a>?');

define('TEXT_INFORMATION', 'Defina aquí su página Index principal.');

//moved to english
//define('TABLE_HEADING_FEATURED_PRODUCTS','Productos destacados');

//define('TABLE_HEADING_NEW_PRODUCTS', 'Nuevos productos el %s');
//define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Próximos productos');
//define('TABLE_HEADING_DATE_EXPECTED', 'Fecha esperada');

if ( ($category_depth == 'products') || (zen_check_url_get_terms()) ) {
  define('HEADING_TITLE', 'Productos disponibles');
  define('TABLE_HEADING_IMAGE', 'Imagen del producto');
  define('TABLE_HEADING_MODEL', 'Modelo');
  define('TABLE_HEADING_PRODUCTS', 'Nombre del producto');
  define('TABLE_HEADING_MANUFACTURER', 'Fabricante');
  define('TABLE_HEADING_QUANTITY', 'Cantidad');
  define('TABLE_HEADING_PRICE', 'Precio');
  define('TABLE_HEADING_WEIGHT', 'Peso');
  define('TABLE_HEADING_BUY_NOW', 'Comprar ahora');
  define('TEXT_NO_PRODUCTS', 'No hay productos disponibles en esta categoría.');
  define('TEXT_NO_PRODUCTS2', 'No hay productos disponibles en este fabricante.');
  define('TABLE_HEADING_BUY_NOW', 'Comprar');
  define('TEXT_NO_PRODUCTS', 'No hay productos disponibles en esta categoría.');
  define('TEXT_NO_PRODUCTS2', 'No hay productos disponibles en este fabricante.');
  define('TEXT_NUMBER_OF_PRODUCTS', 'Número de productos: ');
  define('TEXT_SHOW', '<strong>Filtrar:</strong> ');
  define('TEXT_BUY', 'Comprar 1 \'');
  define('TEXT_NOW', '\' ahora');
  define('TEXT_ALL_CATEGORIES', 'Todas las categorías');
  define('TEXT_ALL_MANUFACTURERS', 'Todos los fabricantes');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', ''); /*Replace this line with the headline you would like for your shop. For example: Welcome to My SHOP!*/
} elseif ($category_depth == 'nested') {
  // this will also be used on Top Level
  define('HEADING_TITLE', ''); /*Replace this line with the headline you would like for your shop. For example: Welcome to My SHOP!*/
}
?>