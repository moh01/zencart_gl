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
// $Id: address_book.php,v 1.3 2006/01/09 22:49:49 gorkau Exp $
//

define('NAVBAR_TITLE_1', 'Mi cuenta');
define('NAVBAR_TITLE_2', 'Agenda de direcciones');

define('HEADING_TITLE', 'Mi agenda personal de direcciones');

define('PRIMARY_ADDRESS_TITLE', 'Dirección principal');
if (isset($zurlan))
{
	define('PRIMARY_ADDRESS_DESCRIPTION', 'Esta dirección se usa como la dirección preseleccionada para el envío de los pedidos hechos en esta tienda.<br /><br />También se usa como base para el cálculo de los gastos de envío.');
}
else
{
	define('PRIMARY_ADDRESS_DESCRIPTION', 'Esta dirección se usa como la dirección preseleccionada para el envío y el pago de los pedidos hechos en esta tienda.<br /><br />También se usa como base para el cálculo de servicios e impuestos.');
}
define('ADDRESS_BOOK_TITLE', 'Direcciones de la agenda');

define('PRIMARY_ADDRESS', '(dirección principal)');

define('TEXT_MAXIMUM_ENTRIES', '<span class="coming"><strong>NOTA:</strong></span> Está permitido un máximo de %s direcciones en la agenda.');
?>
