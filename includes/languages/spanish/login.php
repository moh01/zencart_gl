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
// $Id: login.php,v 1.3 2006/01/10 23:06:55 gorkau Exp $
//

define('NAVBAR_TITLE', 'Mi cuenta');
define('HEADING_TITLE', 'Mi cuenta');

define('HEADING_NEW_CUSTOMER', 'Compre en línea y benefíciese de nuestros servicios!');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'Regístrate y aprovéchate de nuestras ofertas personalizadas.');

define('HEADING_RETURNING_CUSTOMER', 'Zona de socios:');

//define('TEXT_PASSWORD_FORGOTTEN', '¿Olvidó su contraseña?');
define('TEXT_PASSWORD_FORGOTTEN', 'Si no recuerda su contraseña pinche aquí');


define('TEXT_LOGIN_ERROR', 'Tu información de identificación no es válida. Inténtalo de nuevo.');
define('TEXT_VISITORS_CART', '<strong class="note">Nota:</strong> Los artículos que están en su &quot;Carro de la compra&quot; pasarán a su carro de la compra de usuario registrado. <a href="javascript:session_win();">[Más Info]</a>');
define('TABLE_HEADING_PRIVACY_CONDITIONS', 'Declaración de Privacidad');
define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', 'Por favor, acepte nuestra declaración de privacidad marcando el siguiente casillero. Puede leer la declaración de privacidad <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><u>aquí</u></a>.');
define('TEXT_PRIVACY_CONDITIONS_CONFIRM', '<span class="privacyagree">He leído y acepto la declaración de privacidad.</span>');
?>
