<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: time_out.php 3027 2006-02-13 17:15:51Z drbyte $
 */

  define('NAVBAR_TITLE', 'Déconnexion Automatique');
  define('HEADING_TITLE', 'Déconnexion Automatique');
define('HEADING_TITLE_LOGGED_IN', 'Vous n\'êtes pas autorisé à
 effectuer cette opération.');
  define('TEXT_INFORMATION', 'Nous vous prions de bien Vouloir nous Excuser, mais compte tenu de la Dur&eacute;e de Votre Connexion sur une Page S&eacute;curis&eacute;e, le Temps Maximum de Votre Session est &eacute;puis&eacute;. 
  Si vous &ecirc;tiez sur le point de Passer Commande, veuillez <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '">Vous Connecter</a>
  et Votre Panier sera restaur&eacute; tel que vous l\'avez laiss&eacute; au moment de la d&eacute;connexion. Vous pourrez alors reprendre le cours de Vos Achats.<br /><br />
  Si vous venez de Passer Commande et que vous souhaitez visualiser ' .
  (DOWNLOAD_ENABLED == 'true' ? ', ou si vous devez reprendre un t&eacute;l&eacute;chargement': '') . ', merci de vous rendre sur la page <ahref="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">Mon Compte</a>.  ');

define('TEXT_INFORMATION_LOGGED_IN', 'Vous etes encore identifi&eacute;, vous pouvez continuer &agrave;
 magasiner.');

define('HEADING_RETURNING_CUSTOMER', 'S\'identifier');
define('TEXT_PASSWORD_FORGOTTEN', 'Vous avez oubli&eacute; vote mot de passe?')
?>