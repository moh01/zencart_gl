<?php
/**
 * Authorize.net AIM Payment Module V.1.0 created by Eric Stamper - 01/30/2004 Released under GPL
 *
  * @package languageDefines
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: authorizenet_aim.php 2667 2005-12-24 05:31:58Z drbyte $
 */


// Admin Configuration Items
  define('MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_ADMIN_TITLE', 'Authorize.net (AIM)'); // Payment option title as displayed in the admin
  define('MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_DESCRIPTION', '<b>Approbation Automatique des Cartes de Cr&eacute;dit:</b><br /><br />Visa#: 4007000000027<br />MC#: 5424000000000015<br />Discover#: 6011000000000012<br />AMEX#: 370000000000002<br /><br /><b>Note:</b> Ces num&eacute;ros de Carte de Cr&eacute;dit seront refus&eacute;s en Mode Production, 
 soumis &agrave; approbation en Mode Test. Utilisez une Date situeacute;e dans le futur pour la Validiteacute; de la Carte virtuelle lors de la phase de tests, et tout code de 3 ou 4 chiffres (AMEX) pour le processus de V&eacute;rification (CVV Code).<br /><br /><b>Refus Automatique des Cartes de Cr&eacute;dit:</b><br /><br />Carte #: 4222222222222<br /><br />Ce Num&eacute;ro factice peut &ecirc;tre utilis&eacute; pour recevoir des informations de refus de paiements lors des phases de tests.<br /><br />');

  // Catalog Items
  define('MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CATALOG_TITLE', 'Carte de Cr&eacute;dit');  // Payment option title as displayed to the customer
  define('MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_TYPE', 'Type de Carte de Cr&eacute;dit:');
  define('MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_OWNER', 'Propri&eacute;taire de la Carte de Cr&eacute;dit:');
  define('MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_NUMBER', 'Num&eacute;ro de la Carte:');
  define('MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_EXPIRES', 'Date d\'Expiration de la Carte:');
  define('MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CVV', 'CVV Number (<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_CVV_HELP) . '\')">' . 'En Savoir Plus' . '</a>)');
  define('MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_JS_CC_OWNER', '* Le Nom du Propri&eacute;taire de la Carte de Cr&eacute;dit doit comporter au moins  ' . CC_OWNER_MIN_LENGTH . ' caract&egrave;
res.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_JS_CC_NUMBER', '* Le num&eacute;ro de Carte doit comporter au moins ' . CC_NUMBER_MIN_LENGTH . ' caract&egrave;
res.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_JS_CC_CVV', '* Les 3 ou 4 derniers chiffres du num&eacute;ro de V&eacute;rification qui figurent g&eacute;n&eacute;ralement au dos de la Carte de Cr&eacute;dit.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_DECLINED_MESSAGE', 'Votre Carte de Cr&eacute;dit a &eacute;t&eacute; refus&eacute;e. Veuillez essayer une autre Carte ou nous contacter pour plus d\'Information.');
  define('MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_ERROR', 'Erreur Carte de Cr&eacute;dit !');
?>