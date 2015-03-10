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
// $Id: product_info.php,v 1.3 2006/01/10 18:34:00 damage_in Exp $
//

define('TEXT_PRODUCT_NOT_FOUND', 'Disculpe, no se encontró el producto.');
define('TEXT_CURRENT_REVIEWS', 'Comentarios actuales:');
define('TEXT_MORE_INFORMATION', 'Para más información, visite la <a href="%s" target="_blank">web oficial</a> de este producto.');
define('TEXT_DATE_ADDED', 'Este producto fue introducido en nuestro catálogo el %s.');
define('TEXT_DATE_AVAILABLE', '<font color="#ff0000">Este producto permanecerá en stock el %s.</font>');
define('TEXT_ALSO_PURCHASED_PRODUCTS', 'Puede que también le interese...');
define('TEXT_PRODUCT_OPTIONS', '<strong>Por favor, elija:</strong>');
define('TEXT_PRODUCT_MANUFACTURER', 'Fabricado por: ');
define('TEXT_PRODUCT_WEIGHT', 'Peso de Envío: ');
define('TEXT_PRODUCT_WEIGHT_UNIT', ' Kgs');
define('TEXT_PRODUCT_QUANTITY', ' Unidades en Stock');
define('TEXT_PRODUCT_MODEL', 'ISBN: ');



// previous next product
define('PREV_NEXT_PRODUCT', 'Producto ');
define('PREV_NEXT_FROM', ' de ');
define('IMAGE_BUTTON_PREVIOUS', 'Artículo anterior');
define('IMAGE_BUTTON_NEXT', 'Siguiente artículo');
define('IMAGE_BUTTON_RETURN_TO_PRODUCT_LIST', 'Volver a la lista de productos');

// missing products
define('TABLE_HEADING_NEW_PRODUCTS', 'Nuevos productos de %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Próximos productos');
define('TABLE_HEADING_DATE_EXPECTED', 'Fecha estimada');

define('TEXT_ATTRIBUTES_PRICE_WAS',' [antes: ');
define('TEXT_ATTRIBUTE_IS_FREE',' ahora: Gratis]');

define('TEXT_ONETIME_CHARGE_DESCRIPTION', ' Los cargos se aplicarán una sola vez');
define('TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK','Disponibles descuentos por cantidad');
define('ATTRIBUTES_QTY_PRICE_SYMBOL', zen_image(DIR_WS_TEMPLATE_ICONS . 'icon_status_green.gif', TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK, 10, 10) . '&nbsp;');

// Nuevas en ZenCart 1.3.6
define('TEXT_ONETIME_CHARGE_SYMBOL', ' *');
?>
