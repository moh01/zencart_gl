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
// $Id: icon_names.php,v 1.1 2005/12/22 22:31:32 gorkau Exp $
//

// define the icon images used in the project
define('ICON_IMAGE_ERROR', 'error.gif');
define('ICON_IMAGE_WARNING', 'warning.gif');
define('ICON_IMAGE_SUCCESS', 'success.gif');
define('ICON_IMAGE_TRASH', 'small_delete.gif');
define('ICON_IMAGE_UPDATE', 'button_update_cart.gif');
define('ICON_IMAGE_TINYCART', 'cart.gif');

//alt tags for buttons

define('ICON_ARROW_RIGHT_ALT', 'más');
define('ICON_CART_ALT', 'En carro');
define('ICON_ERROR_ALT', 'Error');
define('ICON_SUCCESS_ALT', 'Éxito');
define('ICON_WARNING_ALT', 'Aviso');
define('ICON_TRASH_ALT', 'Elimine este artículo de la cesta pinchando este icono.');
define('ICON_UPDATE_ALT', 'Cambie la cantidad y actualice el pedido haciendo click aquí.');
define('ICON_TINYCART_ALT', 'Add this product to your cart by clicking here.');

// duplicate until message class merge for ICON_ERROR_ALT, ICON_WARNING_ALT
define('ICON_ERROR', 'Error');
define('ICON_WARNING', 'Aviso');
?>