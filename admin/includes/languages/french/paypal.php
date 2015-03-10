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
// |                                                                      |
// |   DevosC, Developing open source Code                                |
// |   Copyright (c) 2004 DevosC.com                                      |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: paypal.php 3016 2006-02-12 05:26:46Z ajeh $
//

  // sort orders
  define('TEXT_PAYPAL_IPN_SORT_ORDER_INFO', 'Afficher la Commande: ');
define('TEXT_SORT_PAYPAL_ID_DESC', 'Commande PayPal re&ccedil;ue (nouveau - ancien)');
define('TEXT_SORT_PAYPAL_ID', 'Commande PayPal re&ccedil;ue (nouveau - ancien)');
define('TEXT_SORT_ZEN_ORDER_ID_DESC', 'Commande ID (haut - bas), Commande PayPal re&ccedil;ue');
define('TEXT_SORT_ZEN_ORDER_ID', 'Commande ID (bas - haut), Commande PayPal re&ccedil;ue');
define('TEXT_PAYMENT_AMOUNT_DESC', 'Montant de la commande (haut - bas)');
define('TEXT_PAYMENT_AMOUNT', 'Mantant de la commande (bas - haut)');

  //begin ADMIN text
  define('HEADING_ADMIN_TITLE', 'Notifications de Paiement Instantan&eacute; PayPal');
  define('HEADING_PAYMENT_STATUS', 'Statut du Paiement');
  define('TEXT_ALL_IPNS', 'Tout');

  define('TABLE_HEADING_ORDER_NUMBER', 'Commande No');
  define('TABLE_HEADING_PAYPAL_ID', 'PayPal #');
  define('TABLE_HEADING_TXN_TYPE', 'Type de Transaction');
  define('TABLE_HEADING_PAYMENT_STATUS', 'Statut du Paiement');
  define('TABLE_HEADING_PAYMENT_AMOUNT', 'Montant');
  define('TABLE_HEADING_ACTION', 'Action');
  define('TABLE_HEADING_DATE_ADDED', 'Date d\'Ajout');
  define('TABLE_HEADING_NUM_HISTORY_ENTRIES', 'Nombre d\'entr&eacute;es dans de Statut de l\'Historique');
  define('TABLE_HEADING_ENTRY_NUM', 'Num&eacute;ro d\'Entr&eacute;e');
  define('TABLE_HEADING_TRANS_ID', 'ID de Trans.');



  define('TEXT_INFO_PAYPAL_IPN_HEADING', 'PayPal IPN');
  define('TEXT_DISPLAY_NUMBER_OF_TRANSACTIONS', 'Afficher <strong>%d</strong> &agrave; <strong>%d</strong> (sur <strong>%d</strong> IPN)');

  //Details section
  define('HEADING_DEATILS_CUSTOMER_REGISTRATION_TITLE', 'D&eacute;tails Enregistrement Client PayPal');
  define('HEADING_DETAILS_REGISTRATION_TITLE', 'Notifications de Paiement Instantan&eacute; PayPal');
  define('TEXT_INFO_ENTRY_ADDRESS', 'Adresse');
  define('TEXT_INFO_ORDER_NUMBER', 'Num&eacute;ro de Commande');
  define('TEXT_INFO_TXN_TYPE', 'Type de Transaction');
  define('TEXT_INFO_PAYMENT_STATUS', 'Statut du Paiement');
  define('TEXT_INFO_PAYMENT_AMOUNT', 'Montant');
  define('ENTRY_FIRST_NAME', 'Pr&eacute;nom');
  define('ENTRY_LAST_NAME', 'Nom');
  define('ENTRY_BUSINESS_NAME', 'Raison Sociale');
  define('ENTRY_ADDRESS', 'Adresse');
  //EMAIL ALREADY DEFINED IN ORDERS
  define('ENTRY_PAYER_ID', 'ID du Payeur');
  define('ENTRY_PAYER_STATUS', 'Statut du Payeur');
  define('ENTRY_ADDRESS_STATUS', 'Statut de l\'Adresse');
  define('ENTRY_PAYMENT_TYPE', 'Type de Paiement');
  define('TABLE_HEADING_ENTRY_PAYMENT_STATUS', 'Statut du Paiement');
  define('TABLE_HEADING_PENDING_REASON', 'Motif de Mise en Attente');
  define('TABLE_HEADING_IPN_DATE', 'Date IPN');
  define('ENTRY_INVOICE', 'Facture');
  define('ENTRY_PAYPAL_IPN_TXN', 'ID de Transaction');
  define('ENTRY_PAYMENT_DATE', 'Date de Paiement');
  define('ENTRY_PAYMENT_LAST_MODIFIED', 'Derni&egrave;re Modification');
  define('ENTRY_MC_CURRENCY', 'MC Devise');
  define('ENTRY_MC_GROSS', 'MC Global');
  define('ENTRY_MC_FEE', 'MC Commission');
  define('ENTRY_PAYMENT_GROSS', 'Paiement Global');
  define('ENTRY_PAYMENT_FEE', 'Commission de Paiement');
  define('ENTRY_SETTLE_AMOUNT', 'D&eacute;finir le Montant');
  define('ENTRY_SETTLE_CURRENCY', 'Choix de La Devise');
  define('ENTRY_EXCHANGE_RATE', 'Taux de Change');
  define('ENTRY_CART_ITEMS', 'Produits du Panier');
  define('ENTRY_CUSTOMER_COMMENTS', 'Customer Comments');
  define('TEXT_NO_IPN_HISTORY', 'Aucun Historique IPN disponible');
  define('TEXT_TXN_SIGNATURE', 'Signature de la Transaction');
  //end ADMIN text
?>
