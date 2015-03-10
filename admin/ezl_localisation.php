<?php
/**
 *
 * @package Configuration Settings
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
	require_once 'ezl_utile.php';
	$langue = NULL;		  
	define('LG_CODE', CODE_LANGUE_ALLEMAND);
	
	if ( $_SERVER['SERVER_NAME'] == '127.0.0.1' ) 
	{
		$local = true;
		if ( strpos ( $_SERVER['REQUEST_URI'] , 'site_en'  ) )
			$lg_code = CODE_LANGUE_ANGLAIS;
		else if ( strpos ( $_SERVER['REQUEST_URI'] , 'site_fr'  ) )
			$lg_code = CODE_LANGUE_FRANCAIS;
	}
	else
	{
		$local = false;
		if ( $_SERVER['SERVER_NAME'] == 'www.justprojectorlamps.com' )
			$lg_code = CODE_LANGUE_ANGLAIS;
		else
			$lg_code = CODE_LANGUE_FRANCAIS;
	}

	$langue = new ezl_langue($lg_code);		  
	
?>