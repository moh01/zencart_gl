<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION:   Replaces admin/orders.php, adding    //
//  new features, navigation options, and an advanced   //
//  payment management system.                          //
//////////////////////////////////////////////////////////685
// $Id: super_orders.php 43 2006-08-29 14:05:21Z BlindSide $
*/

//_TODO add admin account id to status history record
//_TODO form verifications on edit & payment popup forms
//_TODO payment_types table interface
//_TODO popup class to build/display help or additional data in new window
//_TODO make following replacements in all SO files...
//                 <br> --> <br />
//                  <b> --> <strong>
//        zen_db_output --> zen_db_scrub_out($x)
//         zen_db_input --> zen_db_scrub_in($x, true/false)
// zen_db_prepare_input --> zen_db_scrub_in($x, true/false)

  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
//	thefile=fso.CreateTextFile("\\\\\\\\Serveur-at\\\\gls\\\\winexpe6\\\\DAT\\\\OrIMP\\\\cmd_'.$_SESSION['source_db'].'_'.$_GET['ord_id'].'.csv",true);
// 	thefile=fso.CreateTextFile("c:\\\\gls\\\\cmd_'.$_SESSION['source_db'].'_'.$_GET['ord_id'].'.csv",true);

  		echo '<html>
<body onload="makefile();">';		
echo '		
<SCRIPT LANGUAGE="JavaScript">
function makefile(){
	var fso;var thefile;
	fso = new ActiveXObject("Scripting.FileSystemObject");
	thefile=fso.CreateTextFile("c:\\\\gls\\\\winexpe6\\\\DAT\\\\OrIMP\\\\cmd_'.$_SESSION['source_db'].'_'.$_GET['ord_id'].'.csv",true);		
    thefile.writeline(document.tags.ups_xml.value);
	
	thefile.close();
    alert(\'Le fichier est crée.\');	
}
  </SCRIPT>';
  
       $sourcedb = $_SESSION['source_db'];
  	   $db->connect($ext_db_server[$sourcedb], $ext_db_username[$sourcedb], $ext_db_password[$sourcedb], $ext_db_database[$sourcedb], USE_PCONNECT, false);

        $ups_xml = get_flux_gls_p($_GET['ord_id'],$_SESSION['source_db']);
		
       
echo '<h2>Flux de XML</h2>';
		echo '<form name="tags">';
		echo '<table><tr><td>';
		echo '<textarea cols=80 rows=20 name="ups_xml">';
		echo  $ups_xml;
		echo '</textarea>';		
		echo '</td><td>';
		echo '<a href="javascript:makefile();">Re Impression <br> étiquette</a>';
		echo '</td></tr></table>';

echo '</form>';
echo '</body>';
?>