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
// $Id: authorizenet.php 1969 2005-09-13 06:57:21Z drbyte $
//

  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ADMIN_TITLE', 'Authorize.net');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CATALOG_TITLE', 'Paiement à 30 jours (sur autorisation)');  // Payment option title as displayed to the customer
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION', 'Attention, ce délais s\'applique à la date de facture.');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_TYPE', 'Type:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_OWNER', 'Propri&eacute;taire de la Carte de Cr&eacute;dit:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER', 'Num&eacute;ro de la Carte:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES', 'Date d\'Expiration la Carte:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_OWNER', '* Le Nom du Propri&eacute;taire de la Carte de Cr&eacute;dit doit comporter au moins  ' . CC_OWNER_MIN_LENGTH . ' caract&egrave;
res.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_NUMBER', '* Le num&eacute;ro de carte doit comporter au moins ' . CC_NUMBER_MIN_LENGTH . ' caract&egrave;
res.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR_MESSAGE', 'Une erreur est survenue lors du traitement de Votre Carte. Merci de recommencer.');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DECLINED_MESSAGE', 'Votre Carte de Cr&eacute;dit a &eacute;t&eacute; refus&eacute;e. Veuillez essayer une autre Carte ou nous contacter pour plus d\'Information.');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR', 'Erreur Carte de Cr&eacute;dit !');
?>