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
// $Id: checkout_payment.php,v 1.3 2006/01/09 23:29:39 gorkau Exp $
//

define('NAVBAR_TITLE_1', 'Pago');
define('NAVBAR_TITLE_2', 'M�todo de pago');

define('HEADING_TITLE', 'Selecci�n de la forma de pago');

define('TABLE_HEADING_BILLING_ADDRESS', 'Direcci�n de Facturaci�n');
define('TEXT_SELECTED_BILLING_DESTINATION', 'Puede modificar la direcci�n de facturaci�n al hacer un click sobre el bot�n <em>Modificar la Direcci�n</em>.');
define('TITLE_BILLING_ADDRESS', 'Direcci�n de Facturaci�n:'); /*editado*/

define('TABLE_HEADING_PAYMENT_METHOD', 'M�todo de pago');
define('TEXT_SELECT_PAYMENT_METHOD', 'Pago de su Pedido.');
define('TITLE_PLEASE_SELECT', 'Por favor, elija');
define('TEXT_ENTER_PAYMENT_INFORMATION', 'Este es actualmente el �nico m�todo de pago disponible para usar en este pedido.');
define('TABLE_HEADING_COMMENTS', 'Instrucciones especiales o comentarios sobre el pedido');
define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', '<strong>Continuar al paso 3</strong>');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', ': confirmar su pedido.');

define('TABLE_HEADING_CONDITIONS', 'T�rminos y Condiciones');
define('TEXT_CONDITIONS_DESCRIPTION', 'Por favor, acepte los t�rminos y condiciones ligados a este pedido marcando el casillero. Puede leer los t�rminos y condiciones <a href="' . zen_href_link(FILENAME_CONDITIONS, '', 'SSL') . '"><u>aqu�</u></a>.');
define('TEXT_CONDITIONS_CONFIRM', 'He le�do y acepto los t�rminos y condiciones ligados a este pedido.');
define('TEXT_CHECKOUT_AMOUNT_DUE', 'Cantidad total a pagar: ');
define('TEXT_YOUR_TOTAL','Su total');

// Nuevas en ZenCart 1.3.6
define('TITLE_NO_PAYMENT_OPTIONS_AVAILABLE', 'No disponible en este momento');
define('TEXT_NO_PAYMENT_OPTIONS_AVAILABLE', '<span class="alert">Lo sentimos, pero por ahora no podemos aceptar pagos de esa regi�n.</span><br />Por favor, p�ngase en contacto con nosotros.');
// UHT
define('TEXT_CONDITIONS_DESCRIPTION', '<span class="termsdescription">Please acknowledge the terms and conditions bound to this order by ticking the following box. The terms and conditions can be read <a href="' . zen_href_link(FILENAME_CONDITIONS, '', 'SSL') . '"><span class="pseudolink">here</span></a>.');
// UHTFIN
?>
