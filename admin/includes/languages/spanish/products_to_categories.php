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
//  $Id: products_to_categories.php,v 1.2 2006/01/17 20:00:25 gorkau Exp $
//

define('HEADING_TITLE','Administrador de enlace de productos a multiples categorías ...');

define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_AVAILABLE', 'Categorías con productos que están disponibles para enlazar ...');

define('TABLE_HEADING_PRODUCTS_ID', 'Prod ID');
define('TABLE_HEADING_PRODUCT', 'Nombre del producto');
define('TABLE_HEADING_MODEL', 'Modelo');
define('TABLE_HEADING_ACTION', 'Actción');

define('TEXT_INFO_HEADING_EDIT_PRODUCTS_TO_CATEGORIES', 'EDITANDO PRODUCTO A INFORMACIÓN DE CATEGORÍAS');
define('TEXT_PRODUCTS_ID', 'Nº de ID del producto ');
define('TEXT_PRODUCTS_NAME', 'Producto: ');
define('TEXT_PRODUCTS_MODEL', 'Modelo: ');
define('TEXT_PRODUCTS_PRICE', 'Precios: ');
define('BUTTON_UPDATE_CATEGORY_LINKS', 'Actualizar enlaces de categoría');
define('BUTTON_NEW_PRODUCTS_TO_CATEGORIES', 'Seleccionar producto a enlazar');
define('TEXT_SET_PRODUCTS_TO_CATEGORIES_LINKS', 'Configurar producto a categorías de enlaces para: ');
define('TEXT_INFO_LINKED_TO_COUNT', '&nbsp;&nbsp;Número actual de categorías enlazadas: ');

define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER_INTRO',
'El enlazador de productos a categorías está diseñado para poder enlazar de manera rápida el producto actual a una o más categorías.<br />También puedes enlazar todos los productos de una categoría a otra categoría o eliminar un producto enlazado de una categoría que está en otra categoría (ver más abajo para instrucciones)');

define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER',
'Para poder ser tasados, cada producto requiere una categoría principal, sin importar a cuántas categorias esté enlazado. Esta puede ser configurada a través de la lista desplegable de categoría principal.<br />
El producto está enlazado actualmente a la categoría o categorías que están seleccionadas arriba. Para añadir una nueva categoría o categorías simplemente revise el checkbox al lado del nombre de la categoría. Para borrar una categoría o categorías enlazadas existentes, simplemente deseleccione el checkbox al lado del nombre de la categoría.<br />
Cuando haya revisado todas las categorías que quería enlazar con este producto, presione el' . BUTTON_UPDATE_CATEGORY_LINKS . '<br />'
);

define('HEADER_CATEGORIES_GLOBAL_CHANGES', 'Cambioas en categoría enlazada gobal y reinicio del ID de categoría principal');

// copy category to category linked
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Copiar TODOS los productos en una categoría como productos ENLAZADOS a otra categoría ...</strong><br />Ejemplo: Usando 8 y 22 quiero enlazar TODOS los productos de la categoría 8 a la categoría 22');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Seleccionar todos los productos en una categoría: ');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Enlace a categoría: ');
define('BUTTON_COPY_CATEGORY_LINKED', 'Copiar producto como enlazado ');

define('WARNING_COPY_LINKED', 'ATENCIÓN: ');
define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Categoría inválida desde la que enlazar productos: ');
define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Categoría inválida a la que enlazar productos: ');
define('SUCCESS_COPY_LINKED', 'Actualización exitos de productos como enlazados ... ');
define('SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Categoría válida desde la que enlazar productos: ');
define('SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Categoría válida a la que enlazar productos: ');

define('WARNING_COPY_FROM_IN_TO_LINKED', '<strong>ATENCIÓN: No se realizaron cambios, los productos ya estaban enlazados ... </strong>');

// remove category to category linked
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Borrar TODOS los productos en una categoría que están ENLAZADOS a otra categoría ...</strong><br />Ejemplo: Usando 8 y 22 quiero desenlazar TODOS los productos de la categoría 8 de la categoría 22');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Seleccionar todos los productos en una categoría: ');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Quitar el enlace del producto a categoría: ');
define('BUTTON_REMOVE_CATEGORY_LINKED', 'Quitar productos como enlazados ');

define('WARNING_REMOVE_LINKED', 'WARNING: ');
define('WARNING_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Categoría inválida desde la que quitar productos enlazados: ');
define('WARNING_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Categoría inválida para quitar productos enlazados: ');
define('SUCCESS_REMOVE_LINKED', 'Borrado exitoso de productos como enlazados ... ');
define('SUCCESS_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Categoría válida desde la que quitar productos enlazados: ');
define('SUCCESS_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Categoría válida para quitar productos enlazados: ');

define('WARNING_REMOVE_FROM_IN_TO_LINKED', '<strong>ATENCIÓN: No se realizaron cambios, no hay productos enlazados ... </strong>');

define('WARNING_MASTER_CATEGORIES_ID_CONFLICT', '<strong>ATENCIÓN: ¡¡CONFLICTO DE ID DE CATEGORÍAS PRINCIPALES!! </strong>');
define('TEXT_INFO_MASTER_CATEGORIES_ID_CONFLICT', '<strong>El ID de categoría principal es: </strong>');
define('TEXT_INFO_MASTER_CATEGORIES_ID_PURPOSE', 'NOTA: La categoría principal se usa sólo con objeto de tasas en las que la categoría del producto afecta el precio en un producto enlazado, ejemplo: Ofetas<br />');
define('WARNING_MASTER_CATEGORIES_ID_CONFLICT_FIX', 'Para arreglar este problema, ha sido redirigido al primer producto conflictivo. Reasinge el ID de categoría principal para que no siga siendo el ID de la categoría principal de productos para la categoría desde la que está intentando borrar e inténtelo de nuievo. Cuando todos los conflictos estén corregidos, podrá completar el borrado que ha requerido.');
define('TEXT_MASTER_CATEGORIES_ID_CONFLICT_FROM', ' Conflicto desde categoría: ');
define('TEXT_MASTER_CATEGORIES_ID_CONFLICT_TO', ' Conflicto a categoría: ');
define('SUCCESS_MASTER_CATEGORIES_ID', 'Actualización exitosa de enlaces de categorías a productos ...');
define('WARNING_MASTER_CATEGORIES_ID', 'ATENCIÓN: ¡No se ha configurado una categoría principal!');

define('TEXT_PRODUCTS_ID_INVALID', 'ATENCIÓN: ID DE PRODUCTO INVÁLIDO O NO SE SELECCIONÓ UN PRODUCTO');
define('TEXT_PRODUCTS_ID_NOT_REQUIRED', 'Nota: Un ID de producto no necesita ser configurado para usar enlace a todos los productos desde una categoría a otra categoría<br />Sin embargo, configurar un ID de productos válido mostrará todas las categorías disponibles y sus números de ID.');

// reset all products to new master_categories_id
// copy category to category linked
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_MASTER', '<strong>Reiniciar TODOS los productos en la categoría seleccionada para usar la categoría seleccionada como un nuevo ID de categoría principal ...</strong><br />Ejemplo: Reiniciar categoría 22 configuraría TODOS los productos de la categoría 22 para que usasen la categoría 22 como ID de categoría principal');
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Reiniciar el ID de categoría principal para todos los productos en la categoría: ');
define('BUTTON_RESET_CATEGORY_MASTER', 'Reiniciar el ID de categoría principal');

define('WARNING_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'ATENCIÓN: Categoría seleccionada no válida ...');
define('SUCCESS_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Actualización exitosa de todos los productos a un nuevo ID de categoría principal para la categoría: ');

?>