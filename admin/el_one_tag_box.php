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

  		echo '<html>
<body onload="makefile();">';		
echo '		
<SCRIPT LANGUAGE="JavaScript">
function makefile(){
	var fso;var thefile;
	fso = new ActiveXObject("Scripting.FileSystemObject");
		
	thefile=fso.CreateTextFile("C:\\\\eticup\\\\import\\\\cmd_'.$_SESSION['source_db'].'_'.$_GET['ord_id'].'.csv",true);
    thefile.writeline(document.tags.ups_xml.value);
	
	thefile.close();
    alert(\'Le fichier est crée.\');	
}
  </SCRIPT>';
  
       $sourcedb = $_SESSION['source_db'];
  	   $db->connect($ext_db_server[$sourcedb], $ext_db_username[$sourcedb], $ext_db_password[$sourcedb], $ext_db_database[$sourcedb], USE_PCONNECT, false);
		
	   $sql = "select orders_id, products_name, products_model from orders_products where orders_products.orders_products_id = ".$_GET['orders_products_id'];	
	   $rs=$db->Execute( $sql );
	   
	   $orders_id = $rs->fields['orders_id'];
	   $products_name = $rs->fields['products_name'];
	   $products_model = $rs->fields['products_model'];
       
echo '<h2>Etiquette Boite Unitaire</h2>';
echo '<form name="tags" action="el_box_tags.php">';

echo '<input type="hidden" name="orders_id" value="'.$orders_id.'">';
echo '<input type="hidden" name="products_model" value="'.$products_model.'">';

echo '<table>';
echo '<tr>';
echo '<th>Libelle initial</th><td> '. $products_name.'</td>';
echo '</tr>';

echo '<tr>';
echo '<th>Libelle pour modification</th><td><input type=text name="modified_label" size=60 value="'. get_english_lamp_label($products_name,$products_model) .'"></td>';		
echo '</tr>';

echo '<tr>';
echo '<td colspan=2><input type="submit" value="Produire étiquette"></td>';
echo '</tr>';

echo '</form>';
echo '</body>';
?>