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
//  $Id: mail.php 1969 2005-09-13 06:57:21Z drbyte $
//

  define('HEADING_TITLE', 'Envoi d\'Emails aux Clients');

  define('TEXT_CUSTOMER', 'Client:');
  define('TEXT_SUBJECT', 'Sujet:');
  define('TEXT_FROM', 'De:');
  define('TEXT_MESSAGE', 'Message <br />au format Text-Seulement:');
  define('TEXT_MESSAGE_HTML','Message <br />au format Rich Text:');
  define('TEXT_SELECT_CUSTOMER', 'S&eacute;lection du Client');
  define('TEXT_ALL_CUSTOMERS', 'Tous les Clients');
  define('TEXT_NEWSLETTER_CUSTOMERS', 'A tous les Abonn&eacute;s &agrave; la Newsletter');
  define('TEXT_ATTACHMENTS_LIST','Pi&egrave;ces Jointes: ');
  define('TEXT_SELECT_ATTACHMENT','Pi&egrave;ces Jointes<br />sur Serveur: ');
  define('TEXT_SELECT_ATTACHMENT_TO_UPLOAD','Pi&egrave;ces Jointes<br />&agrave; t&eacute;l&eacute;charger<br />&amp; joindre: ');
  define('TEXT_ATTACHMENTS_DIR','R&eacute;pertoire de t&eacute;l&eacute;chargement: ');

  define('NOTICE_EMAIL_SENT_TO', 'Note: E-mail envoy&eacute; &agrave;: %s');
  define('ERROR_NO_AMOUNT_SELECTED', 'Erreur: aucun Montant s&eacute;lectionn&eacute;.');
  define('ERROR_NO_SUBJECT', 'Erreur: aucun Sujet indiqu&eacute;.');
  define('ERROR_ATTACHMENTS', 'Erreur: vous ne pouvez pas s&eacute;lectionner &agrave; la fois TELECHARGER et AJOUTER des pi&egrave;ces jointes. 1 seul choix possible.');
?>