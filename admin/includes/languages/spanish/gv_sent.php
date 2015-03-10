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
//  $Id: gv_sent.php,v 1.1 2005/12/22 22:31:18 gorkau Exp $
//

define('HEADING_TITLE', 'Vales de Compra Enviados');

define('TABLE_HEADING_SENDERS_NAME', 'Remitentes');
define('TABLE_HEADING_VOUCHER_VALUE', 'Valor del ' . TEXT_GV_NAME);
define('TABLE_HEADING_VOUCHER_CODE', TEXT_GV_REDEEM);
define('TABLE_HEADING_DATE_SENT', 'Fecha de Envío');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_INFO_SENDERS_ID', 'ID de Remitentes:');
define('TEXT_INFO_AMOUNT_SENT', 'Cantidad Enviada:');
define('TEXT_INFO_DATE_SENT', 'Fecha de Envío:');
define('TEXT_INFO_VOUCHER_CODE', TEXT_GV_REDEEM . ':');
define('TEXT_INFO_EMAIL_ADDRESS', 'Email:');
define('TEXT_INFO_DATE_REDEEMED', 'Fecha de Canje:');
define('TEXT_INFO_IP_ADDRESS', 'Dirección IP:');
define('TEXT_INFO_CUSTOMERS_ID', 'ID de Cliente:');
define('TEXT_INFO_NOT_REDEEMED', 'Sin Canjear');
?>
