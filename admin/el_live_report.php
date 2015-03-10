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
//  $Id: stats_products_viewed.php 1969 2005-09-13 06:57:21Z drbyte $
//
  require('includes/application_top.php');

  if ( strlen($_GET['updating'] == 0 ) )
  {
	  echo "<form name=frm>";
	  echo "<input type=hidden value=1 name=updating>";
	  echo "<input type=hidden value=".$_GET['request_id']." name=request_id>";
	  
	  if  ( ( ($_GET['request_id'] == 4 )
            || 	($_GET['request_id'] == 3 ) )
			&& strlen($_GET['age_jour'])==0 )
	  {
	     echo "Nombre de jours de recherche <input type=text name=age_jour value=30><br><br>";
	  }
	  echo "N'afficher que les <input type=text name=limite_ligne value=> premières lignes <br><br>";
	  echo "<input type=submit name=Confirmer>";
      echo "</form>";
	  
  }
  else
  {
    include('bi_reporter.php');
	$request = new BI_REPORTER;

	$response_file_name = $request->age_jour=$_GET['age_jour'];
    $response_file_name = $request->do_request($_GET['request_id']);
	
	echo '<a href="../outputs/'.$response_file_name.'">Le fichier pourrait être disponible derrière ce lien..</a>';
  }
  
  
?>

