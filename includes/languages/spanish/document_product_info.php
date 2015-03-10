<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
// $Id: document_product_info.php,v 1.2 2006/01/10 18:34:00 damage_in Exp $
//

define('TEXT_PRODUCT_NOT_FOUND', 'Lo sentimos, producto no encontrado.');
define('TEXT_CURRENT_REVIEWS', 'Comentarios actuales:');
define('TEXT_MORE_INFORMATION', 'Para más información, por favor, visite la <a href="%s" target="_blank">web oficial de este producto</a>.');
define('TEXT_DATE_ADDED', 'Este producto fue introducido en nuestro catálogo el %s.');
define('TEXT_DATE_AVAILABLE', '<font color="#ff0000">Este producto permanecerá en stock el %s.</font>');
define('TEXT_ALSO_PURCHASED_PRODUCTS', 'Los clientes que compraron este producto, también compraron...');
define('TEXT_PRODUCT_OPTIONS', '<strong>Escoja, por favor:</strong>');
define('TEXT_PRODUCT_MANUFACTURER', 'Fabricado por: ');
define('TEXT_PRODUCT_WEIGHT', 'Peso: ');
define('TEXT_PRODUCT_WEIGHT_UNIT', ' Kgs');
define('TEXT_PRODUCT_QUANTITY', ' Unidades en stock');
define('TEXT_PRODUCT_MODEL', 'ISBN: ');



// previous next product
define('PREV_NEXT_PRODUCT', 'Producto ');
define('PREV_NEXT_FROM', ' desde ');
define('IMAGE_BUTTON_PREVIOUS','Producto anterior');
define('IMAGE_BUTTON_NEXT','Siguiente producto');
define('IMAGE_BUTTON_RETURN_TO_PRODUCT_LIST','Regresar a la lista de productos');

// missing products
//define('TABLE_HEADING_NEW_PRODUCTS', 'Nuevos productos el %s');
//define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Próximos productos');
//define('TABLE_HEADING_DATE_EXPECTED', 'Fecha esperada');

define('TEXT_ATTRIBUTES_PRICE_WAS',' [costaba: ');
define('TEXT_ATTRIBUTE_IS_FREE',' ahora cuesta: Gratis]');
define('TEXT_ONETIME_CHARGE_SYMBOL', ' *');
define('TEXT_ONETIME_CHARGE_DESCRIPTION', ' Los cargos se aplicarán una sola vez');
define('TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK','Disponibles descuentos por cantidad');
define('ATTRIBUTES_QTY_PRICE_SYMBOL', zen_image(DIR_WS_TEMPLATE_ICONS . 'icon_status_green.gif', TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK, 10, 10) . '&nbsp;');
?>