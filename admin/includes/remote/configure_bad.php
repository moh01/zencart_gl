<?php
//
/**
 *
 * @package Configuration Settings
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */


// Define the webserver and path parameters
  // Main webserver: eg, http://localhost - should not be empty for productive servers
  // HTTP_SERVER is your Main webserver: eg, http://www.yourdomain.com
  // HTTPS_SERVER is your Secure webserver: eg, https://www.yourdomain.com
  // HTTP_CATALOG_SERVER is your Main webserver: eg, http://www.yourdomain.com
  // HTTPS_CATALOG_SERVER is your Secure webserver: eg, https://www.yourdomain.com
  /* 
   * URLs for your site will be built via:  
   *     HTTP_SERVER plus DIR_WS_ADMIN or
   *     HTTPS_SERVER plus DIR_WS_HTTPS_ADMIN or 
   *     HTTP_SERVER plus DIR_WS_CATALOG or 
   *     HTTPS_SERVER plus DIR_WS_HTTPS_CATALOG
   * ...depending on your system configuration settings
   */
  define('HTTP_SERVER', 'http://www.cyber-sphinx.com');
  define('HTTPS_SERVER', 'https://www.cyber-sphinx.com');
  define('HTTP_CATALOG_SERVER', 'http://www.cyber-sphinx.com');
  define('HTTPS_CATALOG_SERVER', 'https://www.cyber-sphinx.com');

  // Use secure webserver for catalog module and/or admin areas?
  define('ENABLE_SSL_CATALOG', 'false');
  define('ENABLE_SSL_ADMIN', 'false');

// NOTE: be sure to leave the trailing '/' at the end of these lines if you make changes!
// * DIR_WS_* = Webserver directories (virtual/URL)
  // these paths are relative to top of your webspace ... (ie: under the public_html or httpdocs folder)
  define('DIR_WS_ADMIN', '/zenCart/admin/');
  define('DIR_WS_CATALOG', '/zenCart/');
  define('DIR_WS_HTTPS_ADMIN', '/zenCart/admin/');
  define('DIR_WS_HTTPS_CATALOG', '/zenCart/');

  define('DIR_WS_IMAGES', 'images/');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  define('DIR_WS_CATALOG_IMAGES', HTTP_CATALOG_SERVER . DIR_WS_CATALOG . 'images/');
  define('DIR_WS_CATALOG_TEMPLATE', HTTP_CATALOG_SERVER . DIR_WS_CATALOG . 'includes/templates/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');
  define('DIR_WS_CATALOG_LANGUAGES', HTTP_CATALOG_SERVER . DIR_WS_CATALOG . 'includes/languages/');

// * DIR_FS_* = Filesystem directories (local/physical)
  //the following path is a COMPLETE path to your Zen Cart files. eg: /var/www/vhost/accountname/public_html/store/
  define('DIR_FS_ADMIN', '/home/hcyber13/public_html/zenCart/admin/');
  define('DIR_FS_CATALOG', '/home/hcyber13/public_html/zenCart/');

  define('DIR_FS_CATALOG_LANGUAGES', DIR_FS_CATALOG . 'includes/languages/');
  define('DIR_FS_CATALOG_IMAGES', DIR_FS_CATALOG . 'images/');
  define('DIR_FS_CATALOG_MODULES', DIR_FS_CATALOG . 'includes/modules/');
  define('DIR_FS_CATALOG_TEMPLATES', DIR_FS_CATALOG . 'includes/templates/');
  define('DIR_FS_BACKUP', DIR_FS_ADMIN . 'backups/');
  define('DIR_FS_EMAIL_TEMPLATES', DIR_FS_CATALOG . 'email/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');

// define our database connection
  define('DB_TYPE', 'mysql');
  define('DB_PREFIX', '');
  define('DB_SERVER', 'localhost');
  define('DB_SERVER_USERNAME', 'hcyber13_sxdynsi');
  define('DB_SERVER_PASSWORD', 'kenya');
  define('DB_DATABASE', 'hcyber13_zencart');
  define('USE_PCONNECT', 'false'); // use persistent connections?
  define('STORE_SESSIONS', 'db'); // use 'db' for best support, or '' for file-based storage

  // The next 2 "defines" are for SQL cache support.
  // For SQL_CACHE_METHOD, you can select from:  none, database, or file
  // If you choose "file", then you need to set the DIR_FS_SQL_CACHE to a directory where your apache 
  // or webserver user has write privileges (chmod 666 or 777). We recommend using the "cache" folder inside the Zen Cart folder
  // ie: /path/to/your/webspace/public_html/zen/cache   -- leave no trailing slash  
  define('SQL_CACHE_METHOD', 'none'); 
  define('DIR_FS_SQL_CACHE', '/home/hcyber13/public_html/zenCart/cache');

?>