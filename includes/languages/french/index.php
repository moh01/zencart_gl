<?php
/**
 * @package languageDefines FRENCH
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: index.php July 2006 www.fweb.biz $
 */
define('TEXT_MAIN','This is the main define statement for the page for english when no template defined file exists. It is located in: <strong>/includes/languages/english/index.php</strong>');
// Showcase vs Store
if (STORE_STATUS == '0') {
  define('TEXT_GREETING_GUEST', 'Welcome <span class="greetUser">Guest!</span> Would you like to <a href="%s">log yourself in</a>?');
} else {
  define('TEXT_GREETING_GUEST', 'Welcome, please enjoy our online showcase.');
}
define('TEXT_GREETING_PERSONAL', 'Hello <span class="greetUser">%s</span>! Would you like to see our <a href="%s">newest additions</a>?');
define('TEXT_INFORMATION', 'Define your main Index page copy here.');
//moved to french
//  define('TABLE_HEADING_FEATURED_PRODUCTS','Produits Coups de Coeur');

//  define('TABLE_HEADING_NEW_PRODUCTS', 'Nouveaut&eacute;s pour %s');
//  define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Produits Attendus');
//  define('TABLE_HEADING_DATE_EXPECTED', 'Date estim&eacute;e');
if ( ($category_depth == 'products') || (zen_check_url_get_terms()) ) {
  // This section deals with product-listing page contents
  define('HEADING_TITLE', 'Produits disponibles');
  define('TABLE_HEADING_IMAGE', 'Image');
  define('TABLE_HEADING_MODEL', 'Mod&egrave;le');
  define('TABLE_HEADING_PRODUCTS', 'Nom');
  define('TABLE_HEADING_MANUFACTURER', 'Fabricant');
  define('TABLE_HEADING_QUANTITY', 'Quantit&eacute;');
  define('TABLE_HEADING_PRICE', 'Prix');
  define('TABLE_HEADING_WEIGHT', 'Poids');
  define('TABLE_HEADING_BUY_NOW', 'Acheter');
  define('TEXT_NO_PRODUCTS', 'Aucun Produit n\'est disponible dans cette Cat&eacute;gorie.');
  define('TEXT_NO_PRODUCTS2', 'Aucun Produit n\'est disponible chez ce Fabricant.');
  define('TEXT_NUMBER_OF_PRODUCTS', 'Quantit&eacute;: ');
  define('TEXT_SHOW', '<strong>Classement:</strong> ');
  define('TEXT_BUY', 'Acheter 1 \'');
  define('TEXT_NOW', '\' maintenant');
  define('TEXT_ALL_CATEGORIES', 'Toutes Cat&eacute;gories');
  define('TEXT_ALL_MANUFACTURERS', 'Tous Fabricants');
} elseif ($category_depth == 'top') {
  // This section deals with the "home" page at the top level with no options/products selected
  /*Replace this text with the headline you would like for your shop. For example: 'Welcome to My SHOP!'*/
  define('HEADING_TITLE', 'Congratulations! You have successfully installed your fweb Cart&trade; french language pack');
} elseif ($category_depth == 'nested') {
  // This section deals with displaying a subcategory
  define('HEADING_TITLE', 'Congratulations! You have successfully installed your fweb Cart&trade; french language pack'); /*Replace this line with the headline you would like for your shop. For example: Welcome to My SHOP!*/
}
?>
