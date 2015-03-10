<?php
//
/**
 *
 * @package Configuration Settings
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

define('EN',   1);
define('FR',    2);
define('BL',    3);
define ('STYLE', '' );


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
//echo $_SERVER['REQUEST_URI'];	
	if (  ( $_SERVER['SERVER_NAME'] == 'capsulecaoua.com' ) 
	       ||
	     ( strpos ( $_SERVER['REQUEST_URI'] , 'gl_histo'  ) ) )

	{
		$histo = 1;
	}   
	else
	{
		$histo = 0;
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
		  define('HTTP_SERVER', 'http://'.$_SERVER['SERVER_NAME']);
		  define('HTTPS_SERVER', 'https://'.$_SERVER['SERVER_NAME']);
		  define('HTTP_CATALOG_SERVER', 'http://'.$_SERVER['SERVER_NAME']);
		  define('HTTPS_CATALOG_SERVER', 'https://'.$_SERVER['SERVER_NAME']);	 		  
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
	  if ($histo)
	  {
	       define('DIR_WS_ADMIN', '/gl_histo/admin/');
		   define('DIR_WS_CATALOG', '/gl_histo/');
		   define('DIR_WS_HTTPS_ADMIN', '/gl_histo/admin/');
		   define('DIR_WS_HTTPS_CATALOG', '/gl_histo/');	  
      }
	  else
	  {
	       define('DIR_WS_ADMIN', '/sites/zencart_gl/admin/');
		   define('DIR_WS_CATALOG', '/sites/zencart_gl/');
		   define('DIR_WS_HTTPS_ADMIN', '/sites/zencart_gl/admin/');
		   define('DIR_WS_HTTPS_CATALOG', '/sites/zencart_gl/');
      }
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
		  define('DIR_FS_ADMIN', '/homez.55/questionc/www/zencart_gl/admin/');
		  define('DIR_FS_CATALOG', '/homez.55/questionc/www/zencart_gl/');
	  }
	  else
	  {
		  define('DIR_FS_ADMIN', '/home/yeaslmps/www/zencart_gl/admin/');
		  define('DIR_FS_CATALOG', '/home/yeaslmps/www/zencart_gl/');
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
  $ext_bd_root['bf'] = 'http://www.easybatteries.fr';  
  $ext_bd_root['fr'] = 'http://www.lampevideoprojecteur.fr';
  $ext_bd_root['es'] = 'http://www.lamparasparaproyectores.com';
  $ext_bd_root['de'] = 'http://www.alleprojektorlampen.com';
  $ext_bd_root['eu'] = 'http://www.easylamps.eu';
  $ext_bd_root['en'] = 'http://www.justprojectorlamps.com';
  $ext_bd_root['it'] = 'http://www.lampadeproiettori.com';
  $ext_bd_root['tb'] = 'http://www.tbi-direct.fr';
  
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
//echo strpos(' '. $_SERVER['SERVER_NAME'],"capsulacaffe");	 
	     if ($histo)
		 {
			$ext_db_database['gl'] = 'zen_histo_gl';
		 }
		 else
		 {		 
			$ext_db_database['gl'] = 'bo_gl';			
		 }
	     $ext_db_server['gl'] = 'localhost';
	     $ext_db_username['gl'] = 'root';
	     $ext_db_password['gl'] = '';
	     $ext_db_type['gl'] = 'A';	 
	     $ext_db_name['gl'] = 'Compta';	 

		 $ext_db_database['po'] = 'bo_po';
	     $ext_db_server['po'] = 'localhost';
	     $ext_db_username['po'] = 'root';
	     $ext_db_password['po'] = '';
	     $ext_db_type['po'] = 'A';	 
	     $ext_db_name['po'] = 'PO';	 
		 
		 
	     $ext_db_database['fr'] = 'lampe_fr';
	     $ext_db_server['fr'] = 'localhost';
	     $ext_db_username['fr'] = 'root';
	     $ext_db_password['fr'] = '';
	     $ext_db_type['fr'] = 'E';	 
	     $ext_db_name['fr'] = 'LVP fr';	 

	     $ext_db_database['es'] = 'lampe_sp';
	     $ext_db_server['es'] = 'localhost';
	     $ext_db_username['es'] = 'root';
	     $ext_db_password['es'] = '';
	     $ext_db_type['es'] = 'E';	 
	     $ext_db_name['es'] = 'LPP es';	 	 
		 
	     $ext_db_database['eu'] = 'rv_lampe_eu';
	     $ext_db_server['eu'] = 'localhost';
	     $ext_db_username['eu'] = 'root';
	     $ext_db_password['eu'] = '';
	     $ext_db_type['eu'] = 'R';	 
	     $ext_db_name['eu'] = 'RV eu';	 	 
		 
	     $ext_db_database['de'] = 'lampe_de';
	     $ext_db_server['de'] = 'localhost';
	     $ext_db_username['de'] = 'root';
	     $ext_db_password['de'] = '';
	     $ext_db_type['de'] = 'E';	 
	     $ext_db_name['de'] = 'APL de';	 	 

	     $ext_db_database['en'] = 'lampe_en';
	     $ext_db_server['en'] = 'localhost';
	     $ext_db_username['en'] = 'root';
	     $ext_db_password['en'] = '';
	     $ext_db_type['en'] = 'E';	 
	     $ext_db_name['en'] = 'JPL uk';	 	 
		 
	     $ext_db_database['it'] = 'lampe_it';
	     $ext_db_server['it'] = 'localhost';
	     $ext_db_username['it'] = 'root';
	     $ext_db_password['it'] = '';
	     $ext_db_type['it'] = 'E';	 
	     $ext_db_name['it'] = 'LPI it';	 	 

	     $ext_db_database['bf'] = 'pcp_eu';
	     $ext_db_server['bf'] = 'localhost';
	     $ext_db_username['bf'] = 'root';
	     $ext_db_password['bf'] = '';
	     $ext_db_type['bf'] = 'E';	 
	     $ext_db_name['bf'] = 'EYB fr';	 	 

		 $ext_db_database['hp'] = 'bis_lampe_eu';
	     $ext_db_server['hp'] = 'localhost';
	     $ext_db_username['hp'] = 'root';
	     $ext_db_password['hp'] = '';
	     $ext_db_type['hp'] = 'A';	 
	     $ext_db_name['hp'] = 'HPL eu';	 
		 
		 $ext_db_database['rq'] = 'rqdl_fr';
	     $ext_db_server['rq'] = 'localhost';
	     $ext_db_username['rq'] = 'root';
	     $ext_db_password['rq'] = '';
	     $ext_db_type['rq'] = 'A';	 
	     $ext_db_name['rq'] = 'RQDL';	 
		 
	     $ext_db_database['tb'] = 'tbi_fr';
	     $ext_db_server['tb'] = 'localhost';
	     $ext_db_username['tb'] = 'root';
	     $ext_db_password['tb'] = '';
	     $ext_db_type['tb'] = 'E';	 
	     $ext_db_name['tb'] = 'TBI2';			 
		 
		 
		 $ext_db_database['pl'] = 'lampe_pl';
	     $ext_db_server['pl'] = 'localhost';
	     $ext_db_username['pl'] = 'root';
	     $ext_db_password['pl'] = '';
	     $ext_db_type['pl'] = 'A';	 
	     $ext_db_name['pl'] = 'ZDP pl';	 
	     $ext_bd_root['hp'] = 'http://www.zarowki-do-projektorow.pl/';
		 
		 
     }

	 define('DIR_FS_SQL_CACHE', 'c:/sites/zencart_gl/cache');
	 
  }
  else
  {
     if ($questionc)
	 {

	     $ext_db_database['gl'] = 'questionc_gl';
	     $ext_db_server['gl'] = 'mysql5-20';
	     $ext_db_username['gl'] = 'questionc_gl';
	     $ext_db_password['gl'] = 'abidjan';
	     $ext_db_type['gl'] = 'A';	 
	     $ext_db_name['gl'] = 'Compta';	 
		 
	     $ext_db_database['ns'] = 'questionctel';
	     $ext_db_server['ns'] = 'mysql5-7';
	     $ext_db_username['ns'] = 'questionctel';
	     $ext_db_password['ns'] = 'abidjan5';
	     $ext_db_type['ns'] = 'E';	 
	     $ext_db_name['ns'] = 'NS ';	 	 
	 }
	 else
	 {
	     if ($histo)
		 {
		     $ext_db_database['gl'] = 'bo_gl_2013';
		     $ext_db_server['gl'] = 'localhost';
		     $ext_db_username['gl'] = 'lampe_batterie';
		     $ext_db_password['gl'] = 'abidjan51';
		     $ext_db_type['gl'] = 'A';	 
		     $ext_db_name['gl'] = 'Histo';	 
			 $ext_bd_root['gl'] = 'http://www.easylamps.eu';
		 
          }
		 else if(strpos(' '. $_SERVER['SERVER_NAME'],"capsulacaffe")>0)
		 {
			$ext_db_database['gl'] = 'bo_gl_2012';			
		     $ext_db_server['gl'] = 'localhost';
		     $ext_db_username['gl'] = 'lampe_batterie';
		     $ext_db_password['gl'] = 'abidjan51';
		     $ext_db_type['gl'] = 'A';	 
		     $ext_db_name['gl'] = 'Compta';	 
			 $ext_bd_root['gl'] = 'http://www.easylamps.eu';			
		 }		  
		  else
		  {

			 $ext_db_database['gl'] = 'bo_gl';
		     $ext_db_server['gl'] = 'localhost';
		     $ext_db_username['gl'] = 'lampe_batterie';
		     $ext_db_password['gl'] = 'abidjan51';
		     $ext_db_type['gl'] = 'A';	 
		     $ext_db_name['gl'] = 'Compta';	 
			 $ext_bd_root['gl'] = 'http://www.easylamps.eu';
			 
// - Base de données privée
/* 

		     $ext_db_database['gl'] = 'easylamp_gl';
		     $ext_db_server['gl'] = '10.0.208.26';
		     $ext_db_username['gl'] = 'root';
		     $ext_db_password['gl'] = 'abidjan';
		     $ext_db_type['gl'] = 'A';	 
		     $ext_db_name['gl'] = 'Compta';	 
			 $ext_bd_root['gl'] = 'http://www.easylamps.eu';		  
			 */		  

          }
		  
		 $ext_db_database['po'] = 'bo_po';
	     $ext_db_server['po'] = 'localhost';
	     $ext_db_username['po'] = 'lampe_batterie';
	     $ext_db_password['po'] = 'abidjan51';
	     $ext_db_type['po'] = 'A';	 
	     $ext_db_name['po'] = 'PO';	 
		
	     $ext_db_database['fr'] = 'lampe_fr';
	     $ext_db_server['fr'] = 'localhost';
	     $ext_db_username['fr'] = 'lampe_batterie';
	     $ext_db_password['fr'] = 'abidjan51';
	     $ext_db_type['fr'] = 'E';	 
	     $ext_db_name['fr'] = 'LVP fr';	 

		 
	     $ext_db_database['es'] = 'lampe_sp';
	     $ext_db_server['es'] = 'localhost';
	     $ext_db_username['es'] = 'lampe_batterie';
	     $ext_db_password['es'] = 'abidjan51';
	     $ext_db_type['es'] = 'E';	 
	     $ext_db_name['es'] = 'LPP es';	 	 
		 $ext_bd_root['es'] = 'http://www.lamparasparaproyectores.com';

	     $ext_db_database['eu'] = 'rv_lampe_eu';
	     $ext_db_server['eu'] = 'localhost';
	     $ext_db_username['eu'] = 'lampe_batterie';
	     $ext_db_password['eu'] = 'abidjan51';
	     $ext_db_type['eu'] = 'R';	 
	     $ext_db_name['eu'] = 'RV eu';	 	 
		 $ext_bd_root['eu'] = 'http://www.easylamps.eu';
		 
		 
	     $ext_db_database['de'] = 'lampe_de';
	     $ext_db_server['de'] = 'localhost';
	     $ext_db_username['de'] = 'lampe_batterie';
	     $ext_db_password['de'] = 'abidjan51';
	     $ext_db_type['de'] = 'E';	 
	     $ext_db_name['de'] = 'APL de';	 	 
		 $ext_bd_root['de'] = 'http://www.alleprojektorlampen.com';

		 
	     $ext_db_database['en'] = 'lampe_en';
	     $ext_db_server['en'] = 'localhost';
	     $ext_db_username['en'] = 'lampe_batterie';
	     $ext_db_password['en'] = 'abidjan51';
	     $ext_db_type['en'] = 'E';	 
	     $ext_db_name['en'] = 'JPL uk';	 	 
		 $ext_bd_root['en'] = 'http://www.justprojectorlamps.com';
					
	     $ext_db_database['it'] = 'lampe_it';
	     $ext_db_server['it'] = 'localhost';
	     $ext_db_username['it'] = 'lampe_batterie';
	     $ext_db_password['it'] = 'abidjan51';
	     $ext_db_type['it'] = 'E';	 
	     $ext_db_name['it'] = 'LPI it';	 	 
	     $ext_bd_root['it'] = 'http://www.lampadeproiettori.com';

	     $ext_db_database['bf'] = 'pcp_eu';
	     $ext_db_server['bf'] = 'localhost';
	     $ext_db_username['bf'] = 'lampe_batterie';
	     $ext_db_password['bf'] = 'abidjan51';
	     $ext_db_type['bf'] = 'E';	 
	     $ext_db_name['bf'] = 'PCP eu';	 	 
	     $ext_bd_root['bf'] = 'http://www.easybatteries.fr';
		 
	     $ext_db_database['hp'] = 'bis_lampe_eu';
	     $ext_db_server['hp'] = 'localhost';
	     $ext_db_username['hp'] = 'lampe_batterie';
	     $ext_db_password['hp'] = 'abidjan51';
	     $ext_db_type['hp'] = 'E';	 
	     $ext_db_name['hp'] = 'HPL eu';	 	 
	     $ext_bd_root['hp'] = 'http://www.hotprojectorlamps.fr';

		 $ext_db_database['rq'] = 'rqdl_fr';
	     $ext_db_server['rq'] = 'localhost';
	     $ext_db_username['rq'] = 'lampe_batterie';
	     $ext_db_password['rq'] = 'abidjan51';
	     $ext_db_type['rq'] = 'A';	 
	     $ext_db_name['rq'] = 'RQDL';	 
	     $ext_bd_root['hp'] = 'http://www.rienquedeslampes.fr';

		 
		 $ext_db_database['tb'] = 'tbi_fr';
	     $ext_db_server['tb'] = 'localhost';
	     $ext_db_username['tb'] = 'lampe_batterie';
	     $ext_db_password['tb'] = 'abidjan51';
	     $ext_db_type['tb'] = 'A';	 
	     $ext_db_name['tb'] = 'TBI';	 
		 
		 $ext_db_database['pl'] = 'lampe_pl';
	     $ext_db_server['pl'] = 'localhost';
	     $ext_db_username['pl'] = 'lampe_batterie';
	     $ext_db_password['pl'] = 'abidjan51';
	     $ext_db_type['pl'] = 'A';	 
	     $ext_db_name['pl'] = 'ZDP pl';	 
	     $ext_bd_root['hp'] = 'http://www.zarowki-do-projektorow.pl/';
		 
		 
	 } 
     define('DIR_FS_SQL_CACHE', '/home/yeaslmps/www/zencart_gl/cache');
	 
  }  

  define('DB_SERVER', $ext_db_server['gl']);
  define('DB_SERVER_USERNAME', $ext_db_username['gl']);
  define('DB_SERVER_PASSWORD', $ext_db_password['gl']);
  define('DB_DATABASE', $ext_db_database['gl']);        
  
//echo DB_DATABASE;  
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