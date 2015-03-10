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
// $Id: popup_cvv_help.php 1969 2005-09-13 06:57:21Z drbyte $
//

  define('HEADING_CVV', 'Que signifie CVV ?');
  define('TEXT_CVV_HELP1', '<strong>Card Verification Number. Il s\'agit du cryptogramme des cartes bancaires Visa, Mastercard, Discover...</strong><br /><br />
                    Pour votre s&eacute;curit&eacute; et la protection de vos donn&eacute;es personnelles, nous vous demandons d\'entrer le num&eacute;ro de v&eacute;rification de votre carte bancaire.<br /><br />
                    Ce num&eacute;ro de v&eacute;rification est form&eacute; par les 3 derniers chiffres qui figurent au dos de votre carte.
                    Ces chiffres sont habituellement imprim&eacute;s &agrave; droite ou &agrave; gauche de votre num&eacute;ro principal.<br /><br />' .
                    zen_image(DIR_WS_TEMPLATE_ICONS . 'cvv2visa.gif'));

  define('TEXT_CVV_HELP2', '<strong>Cryptogramme &agrave; 4 chiffres des Cartes American Express</strong><br /><br />
                    Pour votre s&eacute;curit&eacute; et la protection de vos donn&eacute;es personnelles, nous vous demandons d\'entrer le num&eacute;ro de v&eacute;rification de votre carte bancaire.<br />
                    Le num&eacute;ro de v&eacute;rification est le num&eacute;ro form&eacute; par les 3 derniers chiffres qui figurent au recto de votre carte.
                    Ces chiffres sont habituellement imprim&eacute;s &agrave; droite de votre num&eacute;ro principal.<br /><br />' .
                    zen_image(DIR_WS_TEMPLATE_ICONS . 'cvv2amex.gif'));

  define('TEXT_CLOSE_CVV_WINDOW', '[ Fermer [x] ]');
?>