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
// $Id: meta_tags.php,v 1.2 2006/01/10 18:23:43 gorkau Exp $
//

// page title

define('TITLE', STORE_NAME);

// Site Tagline
define('SITE_TAGLINE', '');

// Custom Keywords
define('CUSTOM_KEYWORDS', 'ecommerce, open source, tienda, compras online');

// Review Page can have a lead in:
define('META_TAGS_REVIEW', 'Comentarios: ');

// separators for meta tag definitions
// Define Primary Section Output
  define('PRIMARY_SECTION', ' : ');
// Define Secondary Section Output
  define('SECONDARY_SECTION', ' - ');

// Define Tertiary Section Output
  define('TERTIARY_SECTION', ', ');

// Define which pages to tell robots/spiders not to index
// This is generally used for account-management pages or typical SSL pages, and usually doesn't need to be touched.
  define('ROBOTS_PAGES_TO_SKIP','login,logoff,create_account,account,account_edit,account_history,account_history_info,account_newsletters,account_notifications,account_password,address_book,advanced_search,advanced_search_result,checkout_success,checkout_process,checkout_shipping,checkout_payment,checkout_confirmation,cookie_usage,create_account_success,contact_us,download,download_timeout,customers_authorization,down_for_maintenance,password_forgotten,time_out,unsubscribe');

// favicon setting
// There is usually NO need to enable this unless you wish to specify a path and/or a different filename
//  define('FAVICON','favicon.ico');

?>
