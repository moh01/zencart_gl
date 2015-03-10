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

define('HEADING_NEW_CUSTOMER', 'Compre en l�nea y benef�ciese de nuestros servicios!');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'Reg�strate y aprov�chate de nuestras ofertas personalizadas.');

define('HEADING_RETURNING_CUSTOMER', 'Zona de socios:');

//define('TEXT_PASSWORD_FORGOTTEN', '�Olvid� su contrase�a?');
define('TEXT_PASSWORD_FORGOTTEN', 'Si no recuerda su contrase�a pinche aqu�');


define('TEXT_LOGIN_ERROR', 'Tu informaci�n de identificaci�n no es v�lida. Int�ntalo de nuevo.');
define('TEXT_VISITORS_CART', '<strong class="note">Nota:</strong> Los art�culos que est�n en su &quot;Carro de la compra&quot; pasar�n a su carro de la compra de usuario registrado. <a href="javascript:session_win();">[M�s Info]</a>');
define('TABLE_HEADING_PRIVACY_CONDITIONS', 'Declaraci�n de Privacidad');
define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', 'Por favor, acepte nuestra declaraci�n de privacidad marcando el siguiente casillero. Puede leer la declaraci�n de privacidad <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><u>aqu�</u></a>.');
define('TEXT_PRIVACY_CONDITIONS_CONFIRM', '<span class="privacyagree">He le�do y acepto la declaraci�n de privacidad.</span>');
?>
