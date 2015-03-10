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
// $Id: password_forgotten.php 1105 2005-04-04 22:05:35Z Albigin $
//

define('HEADING_TITLE', 'Rispedisci Password');

define('TEXT_ADMIN_EMAIL', 'Indirizzo Email Admin: ');

define('ERROR_WRONG_EMAIL', '<p>Inserito un indirizzo Email errato.</p>');
define('ERROR_WRONG_EMAIL_NULL', '<p>Attenzione!</p>');
define('SUCCESS_PASSWORD_SENT', '<p>Fatto: abbiamo inviato una nuova Password al tuo indirizzo Email.</p>');

define('TEXT_EMAIL_SUBJECT', 'La modifica da te chiesta');
define('TEXT_EMAIL_FROM', EMAIL_DA);
define('TEXT_EMAIL_MESSAGE', 'Una nuova Password è stata chiesta da ' . $_SESSION['REMOTE_ADDR'] . '.' . "\n\n" . 'La tua nuova Password per \'' . STORE_NAME . '\' è:' . "\n\n" . '   %s' . "\n\n");

?>