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
// $Id: login.php 2471 2005-11-29 01:14:18Z drbyte $
//

  define('NAVBAR_TITLE', 'Mon Compte');
  define('HEADING_TITLE', 'Mon Compte');

  define('HEADING_NEW_CUSTOMER', 'Cr&eacute;ation de compte sur ' . STORE_NAME . '');
  define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'Commandez en ligne et b&eacute;n&eacute;ficiez de nos services!<br /> Veuillez vous enregistrer afin de profiter de nos offres personnalis&eacute;es.');

  define('HEADING_RETURNING_CUSTOMER', 'Espace Client Membre');

  define('TEXT_PASSWORD_FORGOTTEN', 'Vous avez perdu votre mot de passe ? Cliquez ici...');

define('TEXT_LOGIN_ERROR', 'Erreur: cet E-mail et ce mot de passe ne correspondent pas.');
define('TEXT_VISITORS_CART', '<strong>Info:</strong> votre panier Visiteur sera ajout&eacute; automatiquement &agrave; Votre Compte <a href="javascript:session_win();"><strong>[?]</strong></a>');

  define('TABLE_HEADING_PRIVACY_CONDITIONS', 'Politique de Confidentialit&eacute; de ' . STORE_NAME . '');
  define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', 'Merci de lire notre rubrique <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><u>S&eacute;curit&eacute; et Confidentialit&eacute;</u></a>.');
  define('TEXT_PRIVACY_CONDITIONS_CONFIRM', '<i>&quot;Je les ai lues et j\'accepte vos dispositions &agrave; ce sujet.&quot;</i>');
?>