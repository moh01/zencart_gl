<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: shopping_cart.php 3183 2006-03-14 07:58:59Z birdbrain $
 */

  define('NAVBAR_TITLE', 'Mon Panier');
  define('HEADING_TITLE', 'Contenu du panier');
  define('HEADING_TITLE_EMPTY', 'Mon panier');
define('TEXT_INFORMATION', 'You may want to add some instructions for using the shopping cart here. (defined in includes/languages/english/shopping_cart.php)');
  define('TABLE_HEADING_REMOVE', 'Suppr.');
define('TABLE_HEADING_QUANTITY', 'Qty.');
define('TABLE_HEADING_MODEL', 'Mod&egrave;le');
define('TABLE_HEADING_PRICE','Unit&eacute;');
define('TEXT_CART_EMPTY', 'Votre panier est vide.');
define('SUB_TITLE_SUB_TOTAL', 'Sous-Total:');
define('SUB_TITLE_TOTAL', 'Total:');

  define('OUT_OF_STOCK_CANT_CHECKOUT', 'Les Produits marqu&eacute;s ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' ne sont pas en quantit&eacute; suffisante pour r&eacute;pondre &agrave; votre positivement &agrave; Votre Commande.<br />Veuillez modifier la qauntit�des produits marqu&eacute;s (' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '). Merci');
  define('OUT_OF_STOCK_CAN_CHECKOUT', 'Les Produits marqu&eacute;s ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' ne sont pas en stock.<br />Les Articles Hors Stock vous seront livr&eacute;s d&egrave;s qu\'ils seront disponibles.');

  define('TEXT_TOTAL_ITEMS', 'Nombre d\'articles: ');
  define('TEXT_TOTAL_WEIGHT', '&nbsp;&nbsp;Poids: ');
  define('TEXT_TOTAL_AMOUNT', '&nbsp;&nbsp;Montant: ');

define('TEXT_VISITORS_CART', '<a href="javascript:session_win();">[Aide (?)]</a>');
define('TEXT_OPTION_DIVIDER', '&nbsp;-&nbsp;');
?>