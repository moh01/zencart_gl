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

    if (
	     ( strpos ( $_SERVER['REQUEST_URI'] , 'questionc'  ) )
		  ||
	     ( strpos ( 'A'.$_SERVER['SERVER_NAME'] , '123questionnaires'  ) )
		)  
	{
	   $questionc = 1;
	}
	else
	{
	   $questionc = 0;
	}
	
	if ( $_SERVER['SERVER_NAME'] == '127.0.0.1' ) 
	{
		$local = 1;
	}   
	else
	{
		$local = 0;
	}   
	
  if ( $local )
  {
	  define('HTTP_SERVER', 'http://127.0.0.1');
	  define('HTTPS_SERVER', 'https://127.0.0.1');
	  define('HTTP_CATALOG_SERVER', 'http://127.0.0.1');
	  define('HTTPS_CATALOG_SERVER', 'https://127.0.0.1');
  }
  else
  {
     //mysql5-15
	  if ( $questionc )
	  {
		  define('HTTP_SERVER', 'http://123questionnaires.com/zencart_gl');
		  define('HTTPS_SERVER', 'https://123questionnaires.com/zencart_gl');
		  define('HTTP_CATALOG_SERVER', 'http://123questionnaires.com/zencart_gl');
		  define('HTTPS_CATALOG_SERVER', 'https://123questionnaires.com/zencart_gl');	 	  	  
	  }
	  else
	  {
		  define('HTTP_SERVER', 'http://linats.net');
		  define('HTTPS_SERVER', 'https://linats.net');
		  define('HTTP_CATALOG_SERVER', 'http://linats.net');
		  define('HTTPS_CATALOG_SERVER', 'https://linats.net');	 
	  }
  }

  // Use secure webserver for catalog module and/or admin areas?
  define('ENABLE_SSL_CATALOG', 'false');
  define('ENABLE_SSL_ADMIN', 'false');

// NOTE: be sure to leave the trailing '/' at the end of these lines if you make changes!
// * DIR_WS_* = Webserver directories (virtual/URL)
  // these paths are relative to top of your webspace ... (ie: under the public_html or httpdocs folder)
//echo strpos ($_SERVER['REQUEST_URI'] , 'site_gl'  );exit;  
  if ( $local )
  {
   if ($questionc)
   {
	   define('DIR_WS_ADMIN', '/questionc_gl/admin/');
	   define('DIR_WS_CATALOG', '/questionc_gl/');
	   define('DIR_WS_HTTPS_ADMIN', '/questionc_gl/admin/');
	   define('DIR_WS_HTTPS_CATALOG', '/questionc_gl/');
   }
   else
   {
       define('DIR_WS_ADMIN', '/sites/zencart_gl/admin/');
	   define('DIR_WS_CATALOG', '/sites/zencart_gl/');
	   define('DIR_WS_HTTPS_ADMIN', '/sites/zencart_gl/admin/');
	   define('DIR_WS_HTTPS_CATALOG', '/sites/zencart_gl/');
   
   }
   
  }
  else
  {
   define('DIR_WS_ADMIN', '/admin/');
   define('DIR_WS_CATALOG', '/');
   define('DIR_WS_HTTPS_ADMIN', '/admin/');
   define('DIR_WS_HTTPS_CATALOG', '/');
  }
  
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
  if ( $local )
  {
	  define('DIR_FS_ADMIN', 'c:/sites/zencart_gl/admin/');
	  define('DIR_FS_CATALOG', 'c:/sites/zencart_gl/');
	  // identification NS
  }
  else
  {
//echo   $questionc;exit;
      if ($questionc)
	  {
		  define('DIR_FS_ADMIN', '/home/questionc/public_html/zencart_gl/');
		  define('DIR_FS_CATALOG', '/home/questionc/public_html/zencart_gl/');
//		  define('DIR_FS_ADMIN', '/home/easylamp/www/lvp/zencart_fr/admin/');
//		  define('DIR_FS_CATALOG', '/home/easylamp/www/lvp/zencart_fr/');
		  
	  }
	  else
	  {
		  define('DIR_FS_ADMIN', '/home/easylamp/www/zencart_gl/admin/');
		  define('DIR_FS_CATALOG', '/home/easylamp/www/zencart_gl/');
	  }	  
  }
  
  
  define('DIR_FS_CATALOG_LANGUAGES', DIR_FS_CATALOG . 'includes/languages/');
  define('DIR_FS_CATALOG_IMAGES', DIR_FS_CATALOG . 'images/');
  define('DIR_FS_CATALOG_MODULES', DIR_FS_CATALOG . 'includes/modules/');
  define('DIR_FS_CATALOG_TEMPLATES', DIR_FS_CATALOG . 'includes/templates/');
  define('DIR_FS_BACKUP', DIR_FS_ADMIN . 'backups/');
  define('DIR_FS_EMAIL_TEMPLATES', DIR_FS_CATALOG . 'email/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');


  define('DB_TYPE', 'mysql');
  define('DB_PREFIX', '');


//echo DIR_FS_ADMIN;exit;     
//echo DB_DATABASE;
//echo DB_SERVER;exit;

  $dev = 1;
  $ext_bd_root['fr'] = 'http://www.lampevideoprojecteur.fr';
  $ext_bd_root['es'] = 'http://www.lamparasparaproyectores.com';
  $ext_bd_root['de'] = 'http://www.alleprojektorlampen.com';
  $ext_bd_root['eu'] = 'http://www.easylamps.eu';
  $ext_bd_root['en'] = 'http://www.justprojectorlamps.com';
  
  if ( $local )
  {
     if ($questionc)
	 {
	     $ext_db_database['gl'] = 'questionc_gl';
	     $ext_db_server['gl'] = 'localhost';
	     $ext_db_username['gl'] = 'root';
	     $ext_db_password['gl'] = '';
	     $ext_db_type['gl'] = 'A';	 
	     $ext_db_name['gl'] = 'Compta';	 

	     $ext_db_database['ns'] = 'questionc_ns';
	     $ext_db_server['ns'] = 'localhost';
	     $ext_db_username['ns'] = 'root';
	     $ext_db_password['ns'] = '';
	     $ext_db_type['ns'] = 'E';	 
	     $ext_db_name['ns'] = 'NS ';	 	 
	 }
	 else
	 {
	     $ext_db_database['gl'] = 'zencart_gl';
	     $ext_db_server['gl'] = 'localhost';
	     $ext_db_username['gl'] = 'root';
	     $ext_db_password['gl'] = '';
	     $ext_db_type['gl'] = 'A';	 
	     $ext_db_name['gl'] = 'Compta';	 

	     $ext_db_database['fr'] = 'zencart_fr';
	     $ext_db_server['fr'] = 'localhost';
	     $ext_db_username['fr'] = 'root';
	     $ext_db_password['fr'] = '';
	     $ext_db_type['fr'] = 'E';	 
	     $ext_db_name['fr'] = 'LVP fr';	 

	     $ext_db_database['es'] = 'zencart_sp';
	     $ext_db_server['es'] = 'localhost';
	     $ext_db_username['es'] = 'root';
	     $ext_db_password['es'] = '';
	     $ext_db_type['es'] = 'E';	 
	     $ext_db_name['es'] = 'LPP es';	 	 
		 
	     $ext_db_database['eu'] = 'zencart_eu';
	     $ext_db_server['eu'] = 'localhost';
	     $ext_db_username['eu'] = 'root';
	     $ext_db_password['eu'] = '';
	     $ext_db_type['eu'] = 'R';	 
	     $ext_db_name['eu'] = 'RV eu';	 	 
		 
	     $ext_db_database['de'] = 'zencart_de';
	     $ext_db_server['de'] = 'localhost';
	     $ext_db_username['de'] = 'root';
	     $ext_db_password['de'] = '';
	     $ext_db_type['de'] = 'E';	 
	     $ext_db_name['de'] = 'APL de';	 	 

	     $ext_db_database['en'] = 'zencart_en';
	     $ext_db_server['en'] = 'localhost';
	     $ext_db_username['en'] = 'root';
	     $ext_db_password['en'] = '';
	     $ext_db_type['en'] = 'E';	 
	     $ext_db_name['en'] = 'JPL uk';	 	 
		 
	     $ext_db_database['it'] = 'zencart_it';
	     $ext_db_server['it'] = 'localhost';
	     $ext_db_username['it'] = 'root';
	     $ext_db_password['it'] = '';
	     $ext_db_type['it'] = 'E';	 
	     $ext_db_name['it'] = 'LPI it';	 	 
		 
		 
     }

	 define('DIR_FS_SQL_CACHE', 'c:/sites/zencart_gl/cache');
	 
  }
  else
  {
     if ($questionc)
	 {

	     $ext_db_database['gl'] = 'bo_tsr';
	     $ext_db_server['gl'] = 'localhost';
	     $ext_db_username['gl'] = 'questionnaires';
	     $ext_db_password['gl'] = 'william102';
	     $ext_db_type['gl'] = 'A';	 
	     $ext_db_name['gl'] = 'Compta';	 

	     $ext_db_database['ns'] = 'bo_tel';
	     $ext_db_server['ns'] = 'localhost';
	     $ext_db_username['ns'] = 'questionnaires';
	     $ext_db_password['ns'] = 'william102';
	     $ext_db_type['ns'] = 'E';	 
	     $ext_db_name['ns'] = 'NS ';	 	 
	 }
	 else
	 {
	     $ext_db_database['gl'] = 'easylamp_gl';
	     $ext_db_server['gl'] = 'mysql5-15';
	     $ext_db_username['gl'] = 'easylamp_gl';
	     $ext_db_password['gl'] = 'comptable';
	     $ext_db_type['gl'] = 'A';	 
	     $ext_db_name['gl'] = 'Compta';	 
		 $ext_bd_root['gl'] = 'http://www.easylamps.eu';

	     $ext_db_database['fr'] = 'easylampzen2';
	     $ext_db_server['fr'] = 'mysql5-2';
	     $ext_db_username['fr'] = 'easylampzen2';
	     $ext_db_password['fr'] = 'bVuNuuCP';
	     $ext_db_type['fr'] = 'E';	 
	     $ext_db_name['fr'] = 'LVP fr';	 

		 
	     $ext_db_database['es'] = 'lamparaslampas';
	     $ext_db_server['es'] = 'mysql5-5';
	     $ext_db_username['es'] = 'lamparaslampas';
	     $ext_db_password['es'] = 'lampas';
	     $ext_db_type['es'] = 'E';	 
	     $ext_db_name['es'] = 'LPP es';	 	 
		 $ext_bd_root['es'] = 'http://www.lamparasparaproyectores.com';

	     $ext_db_database['eu'] = 'easylamp_eu';
	     $ext_db_server['eu'] = 'mysql5-10';
	     $ext_db_username['eu'] = 'easylamp_eu';
	     $ext_db_password['eu'] = 'abidjan';
	     $ext_db_type['eu'] = 'R';	 
	     $ext_db_name['eu'] = 'RV eu';	 	 
		 $ext_bd_root['eu'] = 'http://www.easylamps.eu';
		 
		 
	     $ext_db_database['de'] = 'easylampgerman';
	     $ext_db_server['de'] = 'mysql5-8';
	     $ext_db_username['de'] = 'easylampgerman';
	     $ext_db_password['de'] = 'german';
	     $ext_db_type['de'] = 'E';	 
	     $ext_db_name['de'] = 'APL de';	 	 
		 $ext_bd_root['de'] = 'http://www.alleprojektorlampen.com';

		 
	     $ext_db_database['en'] = 'easylamp_en';
	     $ext_db_server['en'] = 'mysql5-12';
	     $ext_db_username['en'] = 'easylamp_en';
	     $ext_db_password['en'] = 'abidjan';
	     $ext_db_type['en'] = 'E';	 
	     $ext_db_name['en'] = 'JPL uk';	 	 
		 $ext_bd_root['en'] = 'http://www.justprojectorlamps.com';
					
	     $ext_db_database['it'] = 'easylampitaly';
	     $ext_db_server['it'] = 'mysql5-14';
	     $ext_db_username['it'] = 'easylampitaly';
	     $ext_db_password['it'] = 'abidjan';
	     $ext_db_type['it'] = 'E';	 
	     $ext_db_name['it'] = 'LPI it';	 	 
	     $ext_bd_root['it'] = 'http://www.lampadeproiettori.com';
	 } 
     define('DIR_FS_SQL_CACHE', '/home/easylamp/www/zencart_gl/cache');
	 
  }  

  define('DB_SERVER', $ext_db_server['gl']);
  define('DB_SERVER_USERNAME', $ext_db_username['gl']);
  define('DB_SERVER_PASSWORD', $ext_db_password['gl']);
  define('DB_DATABASE', $ext_db_database['gl']);        
  
//  if ( strlen($_SESSION['source_db']) ==0 )
//  {
//  }
//  else
//  {
//   define('DB_SERVER', $ext_db_server[$_SESSION['source_db']] );
//   define('DB_SERVER_USERNAME', $ext_db_username[$_SESSION['source_db']] );
//   define('DB_SERVER_PASSWORD', $ext_db_password[$_SESSION['source_db']] );
//   define('DB_DATABASE', $ext_db_database[$_SESSION['source_db']] );        
//  }
//  $ext_db["fr"]='zencart_fr';

	 
  define('USE_PCONNECT', 'false'); // use persistent connections?
  define('STORE_SESSIONS', ''); // use 'db' for best support, or '' for file-based storage

  // The next 2 "defines" are for SQL cache support.
  // For SQL_CACHE_METHOD, you can select from:  none, database, or file
  // If you choose "file", then you need to set the DIR_FS_SQL_CACHE to a directory where your apache 
  // or webserver user has write privileges (chmod 666 or 777). We recommend using the "cache" folder inside the Zen Cart folder
  // ie: /path/to/your/webspace/public_html/zen/cache   -- leave no trailing slash  
  define('SQL_CACHE_METHOD', 'none'); 

?>