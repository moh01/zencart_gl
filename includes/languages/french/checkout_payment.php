<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: checkout_payment.php 3206 2006-03-19 04:04:09Z birdbrain $
 */

  define('NAVBAR_TITLE_1', 'Commander');
  define('NAVBAR_TITLE_2', 'Sélection du mode de Paiement');

  define('HEADING_TITLE', 'Sélection du mode de Paiement');

  define('TABLE_HEADING_BILLING_ADDRESS', 'Adresse de Facturation');
  define('TEXT_SELECTED_BILLING_DESTINATION', 'Vous pouvez modifier votre Adresse de Facturation en cliquant sur le bouton <em>changer l\'adresse</em>.');
  define('TITLE_BILLING_ADDRESS', 'Adresse de Facturation:');

  define('TABLE_HEADING_PAYMENT_METHOD', 'Mode de Paiement');
  define('TEXT_SELECT_PAYMENT_METHOD', 'Paiement de Votre Commande.');
  define('TITLE_PLEASE_SELECT', 'Votre Choix');
  define('TEXT_ENTER_PAYMENT_INFORMATION', 'Ci-dessous figurent les Informations et le montant de la Livraison.');
  define('TABLE_HEADING_COMMENTS', 'Instructions Sp&eacute;ciales ou Commentaires');

  define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', '<strong>Continuer vers l\'Etape 4</strong>');
  define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', 'Confirmer la Commande.');

  define('TABLE_HEADING_CONDITIONS', '<span class="termsconditions">Conditions G&eacute;n&eacute;rales</span>');
  define('TEXT_CONDITIONS_DESCRIPTION', '<span class="termsdescription">En cochant la case suivante, vous d&eacute;clarez accepter <a href="' . zen_href_link(FILENAME_CONDITIONS, '', 'SSL') . '"Nos CGV</u></a>.');
  define('TEXT_CONDITIONS_CONFIRM', '<span class="termsiagree">J\'ai lu et j\'accepte vos Conditions Gï¿½ï¿½ales de Vente.</span>');

  define('TEXT_CHECKOUT_AMOUNT_DUE', 'Montant Total D&ucirc;: ');
define('TEXT_YOUR_TOTAL','Votre total');
?>