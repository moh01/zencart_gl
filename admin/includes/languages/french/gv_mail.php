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
//  $Id: gv_mail.php 1105 2005-04-04 22:05:35Z birdbrain $
//

  define('HEADING_TITLE', 'Envoi de ' . TEXT_GV_NAME . ' aux Clients');

  define('TEXT_CUSTOMER', 'Client:');
  define('TEXT_SUBJECT', 'Sujet:');
  define('TEXT_FROM', 'De:');
  define('TEXT_TO', 'Email &agrave;:');
  define('TEXT_AMOUNT', 'Montant:');
  define('TEXT_MESSAGE', 'Message <br />au format Text-Seulement:');
  define('TEXT_RICH_TEXT_MESSAGE', 'Message <br />au format Rich Text:');
  define('TEXT_SINGLE_EMAIL', '<span class="smallText">Envoi unique. Dans le cas contraire, choisissez la fonction dropdown.</span>');
  define('TEXT_SELECT_CUSTOMER', 'S&eacute;lection du Client');
  define('TEXT_ALL_CUSTOMERS', 'Tous les Clients');
  define('TEXT_NEWSLETTER_CUSTOMERS', 'A tous les Abonn&eacute;s &agrave; la Newsletter');

  define('NOTICE_EMAIL_SENT_TO', 'Note: Email envoy&eacute; &agrave;: %s');
  define('ERROR_NO_CUSTOMER_SELECTED', 'Erreur: aucun Client s&eacute;lectionn&eacute;.');
  define('ERROR_NO_AMOUNT_SELECTED', 'Erreur: aucun Montant s&eacute;lectionn&eacute;.');
  define('ERROR_NO_SUBJECT', 'Error: aucun sujet indiqu&eacute;.');
  define('ERROR_GV_AMOUNT', 'Veuillez indiquer un Montant sans symbole de Valeur. Exemple: 25.00');

  define('TEXT_GV_ANNOUNCE','<font color="#0000ff">Nous sommes heureux de vous offrir un ' . TEXT_GV_NAME . '</font>');
  define('TEXT_GV_WORTH', 'Ce ' . TEXT_GV_NAME . ' est d\'une valeur de  ');
  define('TEXT_TO_REDEEM', 'Pour l\'utiliser, il vous suffit de cliquer sur le lien ci-dessous. Merci de conserver soigneusement votre ' . TEXT_GV_REDEEM);
  define('TEXT_WHICH_IS', ' qui est le suivant: ');
  define('TEXT_IN_CASE', ' pour toute question relative.');
  define('TEXT_OR_VISIT', 'Nous vous donnons RDV sur le site ');
  define('TEXT_ENTER_CODE', ' afin que vous vous puissiez utiliser votre Code lors de Votre Commande.');
  define('TEXT_CLICK_TO_REDEEM','Cliquez ici pour utiliser Votre Code');

define ('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Vous avez fait il y a peu de temps un achat de  ' . TEXT_GV_NAME . ' sur notre site. Pour des questions de s&eacute;curit&eacute;, le montant de ce  ' . TEXT_GV_NAME . ' ne figure pas automatiquement sur votre compte, car nous devons le valider.');
define ('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', "\n\n" . 'La valeur de ce  ' . TEXT_GV_NAME . ' est de %s');
define ('TEXT_REDEEM_COUPON_MESSAGE_BODY', "\n\n" . 'Vous pouvez vous rendre sur notre site, vous identifier, et adresser la valeur de votre ' . TEXT_GV_NAME . ' &agrave; la personne de votre choix !');
define ('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', "\n\n");

?>