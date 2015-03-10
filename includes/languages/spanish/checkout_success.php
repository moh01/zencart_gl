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
// $Id: checkout_success.php,v 1.2 2006/01/09 23:50:03 gorkau Exp $
//

define('NAVBAR_TITLE_1', 'Pago');
define('NAVBAR_TITLE_2', 'Listo - Gracias');

define('HEADING_TITLE', '¡Muchas gracias por su confianza!');

define('TEXT_SUCCESS', 'Aquí deberían ir unas pocas palabras acerca del tiempo aproximado de envío. Puede cambiar este texto en: <strong>includes/languages/spanish/checkout_success.php</strong>');
define('TEXT_NOTIFY_PRODUCTS', 'Avisenme cuando haya cambios en los siguientes artículos:');
define('TEXT_SEE_ORDERS', 'Puede ver su historial de pedidos yendo a <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">Mi Cuenta</a> y pulsando en "ver todos los pedidos".');
define('TEXT_CONTACT_STORE_OWNER', 'Por favor, dirija cualquier pregunta que tenga a <a href="' . zen_href_link(FILENAME_CONTACT_US) . '">atención al cliente</a>.');
define('TEXT_THANKS_FOR_SHOPPING', '¡Muchas gracias por su confianza!');

define('TABLE_HEADING_COMMENTS', '');

define('TABLE_HEADING_DOWNLOAD_DATE', 'El enlace caduca:');
define('TABLE_HEADING_DOWNLOAD_COUNT', 'Descargas restantes:');
define('HEADING_DOWNLOAD', 'Descargue sus productos aquí:');
define('FOOTER_DOWNLOAD', 'También puede descargar sus productos más tarde en \'%s\'');

define('TABLE_HEADING_DOWNLOAD_FILENAME', 'Descargar producto:');
define('TEXT_YOUR_ORDER_NUMBER', '<strong>Su número de pedido es:</strong> ');

// Nuevas en ZenCart 1.3.6
define('TEXT_SEE_ORDERS', 'Puede ver su historial de pedidos yendo a <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">Mi cuenta</a> y pinchando en "Ver todos los pedidos".');

?>
