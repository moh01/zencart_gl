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
//  $Id: invoice.php 1109 2005-04-04 23:55:35Z drbyte $
//

  define('TABLE_HEADING_COMMENTS', 'Commentaires');
  define('TABLE_HEADING_PRODUCTS_MODEL', 'Mod&egrave;le');
  define('TABLE_HEADING_PRODUCTS', 'Produits');
  define('TABLE_HEADING_TAX', 'Taxe');
  define('TABLE_HEADING_TOTAL', 'Total');
  define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Prix (HT)');
  define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Prix (TTC)');
  define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Total (HT)');
  define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Total (TTC)');

  define('ENTRY_CUSTOMER', 'CLIENT:');

  define('ENTRY_SOLD_TO', 'VENDU A:');
  define('ENTRY_SHIP_TO', 'LIVRE A:');
  define('ENTRY_PAYMENT_METHOD', 'Mode de Paiement:');
  define('ENTRY_SUB_TOTAL', 'Sous-Total:');
  define('ENTRY_TAX', 'Taxes:');
  define('ENTRY_SHIPPING', 'Livraison:');
  define('ENTRY_TOTAL', 'Total:');
  define('ENTRY_DATE_PURCHASED', 'Date de Commande:');

  define('ENTRY_ORDER_ID','Facture No. ');
  define('TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;GRATUIT');
?>