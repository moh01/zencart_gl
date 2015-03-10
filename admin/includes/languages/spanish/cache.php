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
//  $Id: cache.php,v 1.2 2006/01/14 13:32:20 damage_in Exp $
//

define('HEADING_TITLE', 'Control del caché');

define('TABLE_HEADING_CACHE', 'Bloques caché');
define('TABLE_HEADING_DATE_CREATED', 'Fecha de creación');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_FILE_DOES_NOT_EXIST', 'No existe el fichero');
define('TEXT_CACHE_DIRECTORY', 'Directorio caché:');

define('ERROR_CACHE_DIRECTORY_DOES_NOT_EXIST', 'Error: No existe el directorio de caché. Por favor, establézcalo en Configuración->Caché.');
define('ERROR_CACHE_DIRECTORY_NOT_WRITEABLE', 'Error: No se puede escribir en el directorio caché.');
?>
