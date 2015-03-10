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
// $Id: create_account_success.php 1969 2005-09-13 06:57:21Z drbyte $
//

  define('NAVBAR_TITLE_1', 'Cr&eacute;ation de compte');
  define('NAVBAR_TITLE_2', 'Votre compte');
  define('HEADING_TITLE', 'Votre compte est cr&eacute;&eacute;&nbsp;!');
  define('TEXT_ACCOUNT_CREATED', '<br>Votre compte est en attente de validation par notre équipe commerciale.<br><br> 
                                  Vous recevrez très prochaînement une notification de son activation.<br><br> 
								  Une confirmation a &eacute;t&eacute; envoy&eacute;e &agrave; l\'adresse email de votre compte. Si vous ne l\'avez pas re&ccedil;ue sous peu, veuillez v&eacute;rifier votre connexion et vos logiciels de messagerie, et <a href="' . zen_href_link(FILENAME_CONTACT_US) . '">informez-nous</a> le cas &eacute;ch&eacute;ant. Merci.');
?>