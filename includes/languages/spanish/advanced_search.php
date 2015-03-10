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
// $Id: advanced_search.php,v 1.2 2006/01/09 23:05:03 gorkau Exp $
//

define('NAVBAR_TITLE_1', 'Búsqueda avanzada');
define('NAVBAR_TITLE_2', 'Resultados de la búsqueda');

define('HEADING_TITLE_1', 'Búsqueda avanzada');
define('HEADING_TITLE_2', 'Productos que cumplen con el criterio de búsqueda');

define('HEADING_SEARCH_CRITERIA', 'Criterio de búsqueda');

define('TEXT_SEARCH_IN_DESCRIPTION', 'Buscar en la descripción del producto');
define('ENTRY_CATEGORIES', 'Categorías:');
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Incluir subcategorías');
define('ENTRY_MANUFACTURERS', 'Fabricantes:');
define('ENTRY_PRICE_FROM', 'Precio Desde:');
define('ENTRY_PRICE_TO', 'Precio Hasta:');
define('ENTRY_DATE_FROM', 'Fecha Desde:');
define('ENTRY_DATE_TO', 'Fecha Hasta:');

define('TEXT_SEARCH_HELP_LINK', 'Ayuda de la Búsqueda [?]');

define('TEXT_ALL_CATEGORIES', 'Todas las categorías');
define('TEXT_ALL_MANUFACTURERS', 'Todos los fabricantes');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'ISBN');
define('TABLE_HEADING_PRODUCTS', 'Nombre del producto');
define('TABLE_HEADING_MANUFACTURER', 'Fabricante');
define('TABLE_HEADING_QUANTITY', 'Cantidad');
define('TABLE_HEADING_PRICE', 'Precio');
define('TABLE_HEADING_WEIGHT', 'Peso');
define('TABLE_HEADING_BUY_NOW', 'Comprar ahora');

define('TEXT_NO_PRODUCTS', 'No hay productos que coincidan con su criterio de búsqueda.');

define('ERROR_AT_LEAST_ONE_INPUT', 'Debe rellenar al menos uno de los campos.');
define('ERROR_INVALID_FROM_DATE', 'Fecha "desde" no válida.');
define('ERROR_INVALID_TO_DATE', 'Fecha "hasta" no válida.');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'La "Fecha Hasta" debe ser mayor o igual a la "Fecha Desde".');
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'El "Precio Desde" debe ser un número.');
define('ERROR_PRICE_TO_MUST_BE_NUM', 'El Precio Hasta debe ser un número.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'El Precio Hasta debe ser mayor o igual al Precio Desde.');
define('ERROR_INVALID_KEYWORDS', 'Palabras no válidas.');

// Nuevas claves en 1.3.6
define('ENTRY_PRICE_RANGE', 'Buscar por rango de precios');
define('ENTRY_DATE_RANGE', 'Buscar por fecha de entrada en catálogo');
define('KEYWORD_FORMAT_STRING', 'keywords');

?>
