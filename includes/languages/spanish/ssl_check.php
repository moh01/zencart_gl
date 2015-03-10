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
// $Id: ssl_check.php,v 1.2 2006/01/10 16:33:48 damage_in Exp $
//

define('NAVBAR_TITLE', 'Chequeo de seguridad');
define('HEADING_TITLE', 'Chequeo de seguridad');

define('TEXT_INFORMATION', 'Detectamos que su navegador generó un ID de Sesión SSL diferente al que fue usado en nuestras páginas seguras.');
define('TEXT_INFORMATION_2', 'Por motivos de seguridad, necesitará identificarse de nuevo para continuar comprando online.');
define('TEXT_INFORMATION_3', 'Algunos navegadores, como el Konqueror 3.1, no tienen la capacidad de generar el ID de sesión SSL automáticamente. Si usted es usuario de este navegador, le recomdamos que haga uso de otro para continuar con su compra online. Si no tiene otro navegador instalado en su computadora, puede descargar uno compatible: <a href="http://www.microsoft.com/ie/" target="_blank">Microsoft Internet Explorer</a>, <a href="http://channels.netscape.com/ns/browsers/download_other.jsp" target="_blank">Netscape</a>, or <a href="http://www.mozilla.org/releases/" target="_blank">Mozilla</a>.');
define('TEXT_INFORMATION_4', 'Se ha tomado esta medida de seguridad por su bien, le pedimos disculpas por cualquier inconveniente que le haya sido causado.');
define('TEXT_INFORMATION_5', 'Por favor, contacte con la administración de la tienda si tiene cualquier cuestión relacionada con estos requerimientos, o para comprar productos de manera offline.');

define('BOX_INFORMATION_HEADING', 'Privacidad y Seguridad');
define('BOX_INFORMATION', 'Validamos el ID de sesión SSL generado automáticamente por su navegador en cada petición de página segura a este servidor.<br /><br />Esta validación nos asegura de que usted es realmente quien navega con su cuenta de usuario y no otra persona.');
?>
