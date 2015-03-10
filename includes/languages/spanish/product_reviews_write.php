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
// $Id: product_reviews_write.php,v 1.2 2006/01/10 16:33:48 damage_in Exp $
//

define('NAVBAR_TITLE', 'Comentarios');

define('SUB_TITLE_FROM', 'De:');
define('SUB_TITLE_REVIEW', 'Su comentario:');
define('SUB_TITLE_RATING', 'Calificación:');

define('TEXT_NO_HTML', '<span class="coming"><strong>NOTA:</strong></span>&nbsp;Las etiquetas HTML no están permitidas.');
define('TEXT_BAD', '<span class="coming"><strong>MALO</strong></span>');
define('TEXT_GOOD', '<span class="coming"><strong>BUENO</strong></span>');

define('TEXT_PRODUCT_INFO', '<strong>Información del producto</strong>');
define('TEXT_APPROVAL_REQUIRED', '<span class="coming"><strong>NOTA:</strong></span>&nbsp;Los comentarios requieren de aprobación previa a su publicación.');

define('EMAIL_REVIEW_PENDING_SUBJECT','Comentarios pendientes de aprobación: %s');
define('EMAIL_PRODUCT_REVIEW_CONTENT_INTRO','Se ha introducido un comentario para %s y se requiere tu aprobación.'."\n\n");
define('EMAIL_PRODUCT_REVIEW_CONTENT_DETAILS','Detalles del comentario: %s');



?>
