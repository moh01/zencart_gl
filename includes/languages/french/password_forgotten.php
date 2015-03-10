<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: password_forgotten.php 3086 2006-03-01 00:40:57Z drbyte $
 */

  define('NAVBAR_TITLE_1', 'Connexion');
  define('NAVBAR_TITLE_2', 'Mot de Passe Oubli&eacute;');

  define('HEADING_TITLE', 'Mot de Passe Oubli&eacute;');

  define('TEXT_MAIN', 'Veuillez saisir votre Adresse E-mail de Client Membre et nous vous enverrons un message contenant votre Nouveau Mot de Passe.');

  define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Erreur: adresse E-mail inconnue. Veuillez renouveler votre essai.');

  define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Nouveau Mot de Passe');
  define('EMAIL_PASSWORD_REMINDER_BODY', 'Un nouveau mot de passe a été demandé depuis ' . $_SERVER['REMOTE_ADDR']  . '.' . "\n\n" . 'Votre nouveau mot de passe pour vous connecter en tant que Client membre sur \'' . STORE_NAME . '\' est:' . "\n\n" . '   %s' . "\n\n");

  define('SUCCESS_PASSWORD_SENT', '<p>Succ&egrave;s: un Nouveau Mot de Passe vous a &eacute;t&eacute; adress&eacute;.</p>');

?>