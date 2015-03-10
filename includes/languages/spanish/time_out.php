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
// $Id: time_out.php,v 1.3 2006/01/10 18:34:00 damage_in Exp $
//

define('NAVBAR_TITLE', 'Expiró el tiempo de sesión');
define('HEADING_TITLE', 'Expiró el tiempo de sesión');

define('HEADING_TITLE_LOGGED_IN', 'Lo sentimos, no se puede realizar la operación solicitada.');
define('TEXT_INFORMATION', 'Lo sentimos, pero para su seguridad,
  debido al largo intervalo de tiempo mientras realizaba su pago
  o estaba en una página segura, la sesión expiró.<br /><br />
  Si estaba realizando un pedido, por favor,
  <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '">identifiquese</a>
  de nuevo y su cesta de la compra será recuperada. Deberá volver a realizar el pago y completar su última compra.<br /><br />
  Si completó su pedido y desea revisarlo' .
  (DOWNLOAD_ENABLED == 'true' ? ', o tiene una descarga y desea completarla' : '') . ',
  por favor, vaya a <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">Mi cuenta</a> para visualizar su pedido.
  ');
define('TEXT_INFORMATION_LOGGED_IN', 'Aún está conectado a su cuenta y puede seguir comprando.');

define('HEADING_RETURNING_CUSTOMER', 'Entrar de nuevo');
define('TEXT_PASSWORD_FORGOTTEN', '¿Ha olvidado su contraseña?');

?>
