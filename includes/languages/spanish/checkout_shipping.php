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
// $Id: checkout_shipping.php,v 1.3 2006/01/09 23:41:36 gorkau Exp $
//

define('NAVBAR_TITLE_1', 'Pago');
define('NAVBAR_TITLE_2', 'M�todo de env�o');

define('HEADING_TITLE', 'Informaci�n de Entrega');

define('TABLE_HEADING_SHIPPING_ADDRESS', 'Direcci�n de entrega');
define('TEXT_CHOOSE_SHIPPING_DESTINATION', 'Su pedido ser� enviado a esta direcci�n. Puede usted optar por otra direcci�n de entrega haciendo un click sobre el bot�n <em>Modificar Direcci�n</em>.');
define('TITLE_SHIPPING_ADDRESS', 'Direcci�n del env�o:');

define('TABLE_HEADING_SHIPPING_METHOD', 'Entrega');
define('TEXT_CHOOSE_SHIPPING_METHOD', 'Por favor, seleccione el m�todo de env�o preferido para usar en este pedido.');
define('TITLE_PLEASE_SELECT', 'Por favor, elija');
define('TEXT_ENTER_SHIPPING_INFORMATION', 'Este es el �nico m�todo de env�o disponible para usar en este pedido.');

define('TABLE_HEADING_COMMENTS', 'Instrucciones Especiales o Comentarios');

define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', 'Continuar a la Etapa 3');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', ': Forma de pago.');

// when free shipping for orders over $XX.00 is active
define('FREE_SHIPPING_TITLE', 'Env�o gratis');
define('FREE_SHIPPING_DESCRIPTION', 'El env�o es gratis para los pedidos superiores a %s');

// Nuevas en ZenCart 1.3.6
// UHT
define('TITLE_NO_SHIPPING_AVAILABLE', 'Not Available At This Time');
define('TEXT_NO_SHIPPING_AVAILABLE', '<span class="alert">Sorry, we are not shipping to your region at this time.</span><br />Please contact us for alternate arrangements.');

?>
