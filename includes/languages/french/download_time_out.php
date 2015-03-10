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
// $Id: download_time_out.php 1040 2005-03-18 07:13:59Z ajeh $
//

define('NAVBAR_TITLE', 'Votre T&eacute;l&eacute;chargement...');
define('HEADING_TITLE', 'Votre T&eacute;l&eacute;chargement...');

define('TEXT_INFORMATION', 'Nous sommes au regret de vous informer que votre session de t&eacute;l&eacute;chargement a expir&eacute;.<br /><br />
  Si vous devez &agrave;
 nouveau effectuer des t&eacute;l&eacute;chargements,
  veuiller vous rendre sur la page <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">Mon Compte</a> afin de visualiser votre commande.<br /><br />
  Si vous rencontrez de nouvelles difficult&eacute;s, nous vous demandons de bien vouloir <a href="' . zen_href_link(FILENAME_CONTACT_US) . '">Nous Contacter</a> <br /><br />
  Merci!
  ');
?>