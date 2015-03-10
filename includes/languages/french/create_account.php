<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: create_account.php 3027 2006-02-13 17:15:51Z drbyte $
 */

  define('NAVBAR_TITLE', 'Cr&eacute;ation de Compte');

  define('HEADING_TITLE', 'Mes Informations');

  define('TEXT_ORIGIN_LOGIN', '<strong class="note">NOTE:</strong> si vous avez d&eacute;j&agrave; un compte, veuillez vous identifier &agrave; la <a href="%s">page de Connexion</a>.');

// greeting salutation
  define('EMAIL_SUBJECT', 'Bienvenue chez ' . STORE_NAME);
  define('EMAIL_GREET_MR', 'Cher Mr. %s,' . "\n\n");
  define('EMAIL_GREET_MS', 'Chère Mme. %s,' . "\n\n");
  define('EMAIL_GREET_NONE', 'Cher %s' . "\n\n");

// First line of the greeting
  define('EMAIL_WELCOME', 'Nous sommes heureux de vous accueillir chez <strong>' . STORE_NAME . '</strong>.' . "\n\n");
  define('EMAIL_SEPARATOR', '--------------------');
  define('EMAIL_COUPON_INCENTIVE_HEADER', 'F&eacute;licitations ! Pour vous remercier de votre passage dans notre Boutique, nous vous adressons par E-mail un Coupon de R&eacute;duction !' . "\n\n");
// your Discount Coupon Description will be inserted before this next define
  define('EMAIL_COUPON_REDEEM', 'Pour utiliser ce Coupon, entrez son Code lors de la Validation de Votre Commande :  <strong>%s</strong>' . "\n\n");

  define('EMAIL_GV_INCENTIVE_HEADER', 'En guise de Bienvenue, nous vous adressons un ' . TEXT_GV_NAME . ' d\une valeur de %s !' . "\n");
  define('EMAIL_GV_REDEEM', 'Le Code de votre ' . TEXT_GV_NAME . ' est: %s ' . "\n\n" . 'Vous pourrez vous en servir lors de Votre Commande, comme moyen de paiement.');
  define('EMAIL_GV_LINK', ' Vous pouvez aussi suivre ce lien: ' . "\n");
// GV link will automatically be included before this line

  define('EMAIL_GV_LINK_OTHER','Lorsque vous ajoutez un ' . TEXT_GV_NAME . ' à Votre Compte, vous pouvez utiliser ce ' . TEXT_GV_NAME . ' pour vous, ou pour en faire profiter la personne de votre choix !' . "\n\n");

  define('EMAIL_TEXT', 'Votre Compte sur notre site vous offre de nombreux <strong>services</strong>, parmi lesquels figurent entre autres :' . "\n\n" . '<li><strong>Un Panier Permanent</strong> - Ajoutez ou supprimer les Produits comme vous le voulez.' . "\n\n" . '<li><strong>Un Carnet d\'Adresses</strong> - Livraison selon votre convenance (pour un cadeau...) ! ' . "\n\n" . '<li><strong>Votre Historique</strong> - Consultation des Commandes et Suivi.' . "\n\n" . '<li><strong>Des Avis de Clients</strong> - Pour savoir ce que les Clients aiment et choisissent.' . "\n\n");

  define('EMAIL_GV_CLOSURE','Cordialement,' . "\n\n" . STORE_OWNER . "\nLa Direction\n\n". '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'.HTTP_SERVER . DIR_WS_CATALOG ."</a>\n\n");

// email disclaimer - this disclaimer is seperate from all other email disclaimers
  define('EMAIL_DISCLAIMER_NEW_CUSTOMER', '');

//moved definitions to french.php
//define('TABLE_HEADING_PRIVACY_CONDITIONS', 'Privacy Statement');
//define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', 'Please acknowledge you agree with our privacy statement by ticking the following box. The privacy statement can be read <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><span class="pseudolink">here</span></a>.');
//define('TEXT_PRIVACY_CONDITIONS_CONFIRM', 'I have read and agreed to your privacy statement.');
//define('TABLE_HEADING_ADDRESS_DETAILS', 'Address Details');
//define('TABLE_HEADING_PHONE_FAX_DETAILS', 'Additional Contact Details');
//define('TABLE_HEADING_DATE_OF_BIRTH', 'Verify Your Age');
//define('TABLE_HEADING_LOGIN_DETAILS', 'Login Details');
//define('TABLE_HEADING_REFERRAL_DETAILS', 'Were You Referred to Us?');
?>
