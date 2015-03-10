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
// $Id: credit_cards.php 1969 2005-09-13 06:57:21Z drbyte $
//

/*

D&eacute;claration du define des Cartes de Cr&eacute;dits pour qu'elles s'accordent avec les enregistrements actuels de la table de configuration.

Exemple pour la Carte Visa:
TEXT_CC_ENABLED_VISA ou IMAGE_CC_ENABLED_VISA sont utilis&eacute;s pour CC_ENABLED_VISA

Si une nouvelle Carte de Cr&eacute;dit est ajout&eacute;e mais qu'il n'y a pas de define correspondant, elle ne peut &ecirc;
tre utilis&eacute;e par la fonction zen_get_cc_enabled()

Utilisez la fonction zen_get_cc_enabled() pour obtenir une liste des Cartes de Cr&eacute;dit Accept&eacute;es 

Exemple:

echo TEXT_ACCEPTED_CREDIT_CARDS . zen_get_cc_enabled();

*/

  define('TEXT_ACCEPTED_CREDIT_CARDS', '<strong>Nous Acceptons:</strong> ');

// cc enabled text
  define('TEXT_CC_ENABLED_VISA','Visa');
  define('TEXT_CC_ENABLED_MC','MC');
  define('TEXT_CC_ENABLED_AMEX','AmEx');
  define('TEXT_CC_ENABLED_DINERS_CLUB','Diners Club');
  define('TEXT_CC_ENABLED_DISCOVER','Discover');
  define('TEXT_CC_ENABLED_JCB','JCB');
  define('TEXT_CC_ENABLED_AUSTRALIAN_BANKCARD','Australian Bankcard');

// for images define these as:
//  define('IMAGE_CC_ENABLED_VISA',zen_image(DIR_WS_IMAGES . 'filename.jpg');
// use the function
// echo zen_get_cc_enabled('IMAGE_');

// cc enabled image
  define('IMAGE_CC_ENABLED_VISA', zen_image($template->get_template_dir('cc1.gif', DIR_WS_TEMPLATE, $current_page_base,'images/icons'). '/' . 'cc1.gif'));
  define('IMAGE_CC_ENABLED_MC', zen_image($template->get_template_dir('cc2.gif', DIR_WS_TEMPLATE, $current_page_base,'images/icons'). '/' . 'cc2.gif'));
  define('IMAGE_CC_ENABLED_AMEX', zen_image($template->get_template_dir('cc3.gif', DIR_WS_TEMPLATE, $current_page_base,'images/icons'). '/' . 'cc3.gif'));
  define('IMAGE_CC_ENABLED_DINERS_CLUB', zen_image($template->get_template_dir('cc4.gif', DIR_WS_TEMPLATE, $current_page_base,'images/icons'). '/' . 'cc4.gif'));
  define('IMAGE_CC_ENABLED_DISCOVER', zen_image($template->get_template_dir('cc5.gif', DIR_WS_TEMPLATE, $current_page_base,'images/icons'). '/' . 'cc5.gif'));
  define('IMAGE_CC_ENABLED_JCB', zen_image($template->get_template_dir('cc6.gif', DIR_WS_TEMPLATE, $current_page_base,'images/icons'). '/' . 'cc6.gif'));
  define('IMAGE_CC_ENABLED_AUSTRALIAN_BANKCARD', zen_image($template->get_template_dir('cc7.gif', DIR_WS_TEMPLATE, $current_page_base,'images/icons'). '/' . 'cc7.gif'));
?>