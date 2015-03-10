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
// $Id: download_time_out.php,v 1.2 2006/01/10 23:59:23 damage_in Exp $
//

define('NAVBAR_TITLE', 'Su descarga ...');
define('HEADING_TITLE', 'Su descarga ...');

define('TEXT_INFORMATION', 'Lo sentimos, pero su descarga ha expirado. <br /><br />
  Si tenía otras descargas, y desea utilizarlas,
  por favor, dirígiase a su <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">cuenta</a> para ver su pedido.<br /><br />
  O, si piensa que existe algún problema con su pedido, por favor, <a href="' . zen_href_link(FILENAME_CONTACT_US) . '">contacte con nosotros</a> <br /><br />
  ¡Gracias!
  ');
?>