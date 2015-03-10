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
// $Id: account_edit.php,v 1.2 2006/01/09 23:28:19 damage_in Exp $
//

define('NAVBAR_TITLE_1', 'Mi cuenta');
if (isset($zulan))
{
	define('NAVBAR_TITLE_2', 'Modificar dirección de facturación');
	define('HEADING_TITLE', 'Dirección de facturación');
}
else
{
	define('NAVBAR_TITLE_2', 'Modificar datos de mi cuenta');
	define('HEADING_TITLE', 'Mi cuenta');
}

define('HEADING_TITLE_ADDITIONAL_DATA', 'Datos adicionales');
define('SUCCESS_ACCOUNT_UPDATED', 'Su cuenta ha sido actualizada satisfactoriamente.');

?>
