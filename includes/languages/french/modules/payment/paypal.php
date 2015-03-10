<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: paypal.php 2644 2005-12-21 16:56:32Z drbyte $
 */

  define('MODULE_PAYMENT_PAYPAL_TEXT_ADMIN_TITLE', 'Paypal IPN');
  define('MODULE_PAYMENT_PAYPAL_TEXT_CATALOG_TITLE', 'Paypal');

  if (IS_ADMIN_FLAG === true) {
    define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', '<strong>PayPal IPN</strong><br /><font color="green">Configuration Instructions:</font><br />On www.paypal.com, under "Profile",<ul><li>set your <strong>Instant Payment Notification Preferences</strong> URL to:<br />'.str_replace('index.php?main_page=index','ipn_main_handler.php',zen_catalog_href_link(FILENAME_DEFAULT, '', 'SSL')) . ' </li><li>in <strong>Website Payments Preferences</strong> set your <strong>Automatic Return URL</strong> to:<br />'.zen_catalog_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL',false).'</li>' . (defined('MODULE_PAYMENT_PAYPAL_STATUS') ? '' : '<li>... and click "install" above to enable PayPal support... and "edit" to tell Zen Cart your PayPal settings.</li>') . '</ul><font color="green"><hr /></font>' );
  } else {
    define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', '<strong>PayPal IPN</strong>');
  }
  define('MODULE_PAYMENT_PAYPAL_ENTRY_FIRST_NAME', 'Pr&eacute;nom:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_LAST_NAME', 'Nom:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_BUSINESS_NAME', 'Raison Sociale:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_NAME', 'Adresse Nom:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STREET', 'Adresse Rue:');
 
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_CITY', 'Adresse Ville:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATE', 'Adresse Etat/D&eacute;p/Prov/:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_ZIP', 'Adresse Code Postal:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_COUNTRY', 'Adresse Pays:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_EMAIL_ADDRESS', 'Email du Payeur:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_EBAY_ID', ' ID Ebay:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_ID', 'ID du Payeur:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_STATUS', 'Statut du Payeur:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATUS', 'Statut de l\'Adresse:');

  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_TYPE', 'Type de Paiement:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_STATUS', 'Statut du Paiement:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PENDING_REASON', 'Motif de Mise en Attente:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_INVOICE', 'Facture:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_DATE', 'Date de Paiement:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_CURRENCY', 'Devise:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_GROSS_AMOUNT', 'Montant Global:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_FEE', 'Paiement des Commissions:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_EXCHANGE_RATE', 'Taux de Change:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_CART_ITEMS', 'Produits du Panier:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_TXN_TYPE', 'Type de Trans.:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_TXN_ID', 'ID de Trans.:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PARENT_TXN_ID', 'ID de Trans. Parent:');

  ?>