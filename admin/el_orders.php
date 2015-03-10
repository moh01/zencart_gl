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

  if (!isset($currencies)) {
    require(DIR_WS_CLASSES . 'currencies.php');
    $currencies = new currencies();
  }


//echo $_GET['force_db'];exit;

if (  (strlen( $_GET['force_db'] )>0) || (strlen( $_['force_db'] )>0) )
{
  if ( strlen( $_POST['force_db'] )>0 )
  {
	 $_SESSION['source_db']=$_POST['force_db'];
  }
  else
  {
    $_SESSION['source_db']=$_GET['force_db'];
  }	
}  

  $oID = (isset($_GET['oID']) ? (int)$_GET['oID'] : false);
  if ($oID==0) 
  {
     // test de la saisie incomplete
	 $saisie_ok = 1;
     if ( (strlen($_GET['nc_nom'])
	      +strlen($_GET['nc_prenom'])
		  +strlen($_GET['nc_email']) )  > 0	 )
	 {
	     if ( (strlen($_GET['customers_id_fr'])
		      +strlen($_GET['customers_id_es'])
			  +strlen($_GET['customers_id_de'])
			  +strlen($_GET['customers_id_en'])			  
			  +strlen($_GET['customers_id_it'])			 			  
			  +strlen($_GET['customers_id_ns'])			 			  			  
			  +strlen($_GET['customers_id_bf'])			 			  			  			  
			  +strlen($_GET['customers_id_hp'])			 			  			  			  			  
			  +strlen($_GET['customers_id_po'])			 			  			  			  			  			  
			  +strlen($_GET['nc_country'])		  
			  +strlen($_GET['customers_id_hp'])
			  +strlen($_GET['customers_id_rq'])			  
			  +strlen($_GET['customers_id_pl'])			  
			  +strlen($_GET['customers_id_tb'])			  			  
			  +strlen($_GET['customers_id_eu']))==0 )	     
    	{
        	$saisie_ok = 0;
		}
	    if ( strlen($_GET['old_id'])==0 )
    	{
        	$saisie_ok = 0;
		}		
        if ( $saisie_ok == 0 )
        {
		   echo  'Saisie incomplete <br><br> <a href="javascript:history.go(-1)"> Cliquez ici pour reprendre </a>';
		   exit;
        }		
        if ( $saisie_ok == 0 )
        {
		   echo  'Saisie incomplete <a href="history(-1)"> Cliquez ici pour reprendre </a>';
		   exit;
        }		
	 }

     if ( (strlen($_GET['customers_id_fr'])
	      +strlen($_GET['customers_id_es'])
		  +strlen($_GET['customers_id_de'])
		  +strlen($_GET['customers_id_en'])		
		  +strlen($_GET['customers_id_it'])		  		  
		  +strlen($_GET['customers_id_bf'])		  		  		  
		  +strlen($_GET['customers_id_po'])			 			  			  			  			  			  		  
		  +strlen($_GET['nc_country'])		  
		  +strlen($_GET['customers_id_ns'])
		  +strlen($_GET['customers_id_hp'])		  
		  +strlen($_GET['customers_id_rq'])	
		  +strlen($_GET['customers_id_pl'])			    
		  +strlen($_GET['customers_id_tb'])		  		  		  
		  +strlen($_GET['customers_id_eu']))==0 )
	 {
    	echo '
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Nouvelle pièce</title>
		<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
		</head>
		<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } ">
		<form>
		        <input type="hidden" name=action value=edit>
		        <input type="hidden" name=oID value=0>
				<br><hr><br> Pour un client existant ... <br>';
	   if ( $_SESSION['source_db']=="gl" )			
	   {
   		 echo 'Base de données du client &nbsp;&nbsp;<select name="source_db">';  
			$html_string .= '<option value="">';			
			if ( $questionc )
    			$bds = array("ns");  						
			else
    			$bds = array("eu","fr","es","de","en","it","bf","po","hp","rq","tb","pl");  						
		}
		else
	   {
   		 echo 'Base de données du client &nbsp;&nbsp;<select name="source_db">';  
		 $bds = array( $_SESSION['source_db'] );		 
		}
		
			 foreach ($bds as $dtb) 
			 {
				$html_string .= '<option value="'.$dtb.'">'.$ext_db_name[$dtb];
			 }
			 $html_string .= '</select>';
			  echo eregi_replace('"'.$_GET['source_db'].'"' , '"'.$_GET['source_db'].'" SELECTED' ,$html_string );
			  echo '&nbsp;&nbsp;';
			  echo 'Critère de recherche <input name="search_criteria" value="'. $_GET['search_criteria'] .'"> &nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" name="Rechercher" value="Rechercher">';
		 if ( strlen($_GET['source_db'])>0 )		 
		 {
		    $keywords = $_GET['search_criteria'];
			$sql = "select ab.customers_id code ,
			               concat(ab.customers_id,concat('  |  ',concat(entry_company,concat('  |  ',concat(concat(customers_firstname,concat(' ',customers_lastname)),'  |  '),customers_email_address,'  |  ', entry_city,'  |  ', entry_postcode)))) description
	                  from address_book ab, customers c, countries
	                  where  ab.customers_id = c.customers_id
	                   and   c.customers_default_address_id =  ab.address_book_id 
					   and   entry_country_id = countries_id
					   and   ( 
					           c.customers_lastname like '%" . $keywords . "%' 
							   or c.customers_firstname like '%" . $keywords . "%' 
							   or c.customers_email_address like '%" . $keywords . "%'
							   or  ab.entry_company like '%" . $keywords . "%' 
							  )
					   order by concat(ab.entry_company,customers_lastname)";		 
//echo $sql;			   
    		 $db->connect($ext_db_server[$_GET['source_db']], $ext_db_username[$_GET['source_db']], $ext_db_password[$_GET['source_db']], $ext_db_database[$_GET['source_db']], USE_PCONNECT, false);				
    	     echo  '<br><br>'. $ext_db_name[$_GET['source_db']] . get_list_select ( $sql, "customers_id_".$_GET['source_db']."","" )."<br>";
		 }
		 
		echo '<br><hr><br> Pour un nouveau client ... <br>';		 
		echo '<table>';
		echo '<tr> <td>Site internet / Pays</td>';
        echo '<td colspan=3> ';
//		 $bds = array("eu","fr","es","de");

			$sql = "select countries_id, countries_name
	                  from countries order by 2";
		 
		 echo '<select name="nc_country">';
         echo '<option value="">';		 
		 
		 foreach ($bds as $dtb) 
		 {
    	    $db->connect($ext_db_server[$dtb], $ext_db_username[$dtb], $ext_db_password[$dtb], $ext_db_database[$dtb], USE_PCONNECT, false);				
			$ctry = $db->Execute($sql);
			while ( ! $ctry->EOF )
			{
			   echo '<option value="'.$dtb.'|'. $ctry->fields['countries_id'] .'">'. $ext_db_name[$dtb] . ' ' . $ctry->fields['countries_name'];
			   $ctry->MoveNext();
			}
		 }
		echo '</select>';
		echo '</td>';
		echo '<tr> <td> Entreprise / Société </td>  <td colspan=3><Input type="text" name="nc_societe" size=50></td></tr>';
		echo '<tr> <td> Nº de TVA intracom</td>  <td colspan=3><Input type="text" name="nc_intracom"></td></tr>';		
		echo '<tr> <td> M.Mme </td>  
		      <td>
			  <select name="nc_genre">
			    <option value="m">Mr
			    <option value="f">Mme
              </select>
        	  </td>
              <td></td>  <td></td>';
		echo '<tr> <td> Prénom </td>  <td><Input type="text" name="nc_prenom"></td><td> Nom </td>  <td><Input type="text" name="nc_nom" size=40></td></tr>';
		echo '<tr> <td> Email </td>  <td colspan=3><Input type="text" name="nc_email" size=40></td></tr>';
        echo '<tr><td> Adresse 1</td>  <td colspan=3><Input type="text" name="nc_addr1" size=70></td></tr>';
        echo '<tr><td> Adresse 2 </td>  <td  colspan=3><Input type="text" name="nc_addr2" size=70></td></tr>';
		echo '<tr><td> Code Postal </td>  <td><Input type="text" name="nc_code_postal"></td>  <td> Ville </td> <td><Input type="text"  size=40 name="nc_ville"></td></tr></tr>';
		echo '<tr><td> County (UK) </td>  <td><Input type="text" name="nc_state"></td>  <td> &nbsp; </td> <td> &nbsp; </td></tr></tr>';	
		echo '<tr> <td> Téléphone </td>  <td><Input type="text" name="nc_telephone"></td> <td> Fax </td>  <td><Input type="text" name="nc_fax"></td></tr>';
		echo '</table><hr>';
		
				
		 
	     echo '  Quel modèle de transaction ? ';

		 $db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);
	     echo get_select ( "select orders_id code, customers_name description from orders where orders_id<0 order by 1 desc", "old_id","" );
//echo ( $_SESSION['source_db']=="gl" );exit;		 
         if ( $_SESSION['source_db']=="gl" )
		 {
		     echo ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Type de pièce ?
	                <select name="invoice_type">
					   <option value="DB">Facture Easylamps
	    			   <option value="CR">Avoir Easylamps
					   <option value="BL">BL   			
					   <option value="DH">Facture HPL
	    			   <option value="CH">Avoir HPL					   
	                </select>';
	     echo ' &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                <input name="status" value="3" type="radio">Payé &nbsp;|&nbsp;
			    <input name="status" value="2" checked="checked" type="radio">Envoyé &nbsp;|&nbsp;<input name="status" value="1" type="radio">Partiel &nbsp;|&nbsp;';
					
         }
		 else
		 {
		     echo ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Type de pièce ?
	                <select name="invoice_type">
					   <option value="CM">Commande
					   <option value="PF">Proforma					   
	                </select>';
			 echo '<input type="hidden" name="status" value="1">';
         }
		 

			
	     echo ' &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  <input type="submit">		 
		       </form>';
	     echo  '</body>';
	     echo  '</html>';

		 exit;
	 }
	 else
	 {
	    $new_customer = 0;
	    if ( strlen($_GET['customers_id_ns'])>0 )
		{
		   $customers_id = $_GET['customers_id_ns'];
		   $database_code = "ns";
		   $languages_id = 2;		   
        }		   
	    else if ( strlen($_GET['customers_id_fr'])>0 )
		{
		   $customers_id = $_GET['customers_id_fr'];
		   $database_code = "fr";
		   $languages_id = 2;		   
		}
		else if ( strlen($_GET['customers_id_es'])>0 )
		{
		   $customers_id = $_GET['customers_id_es'];		
		   $database_code = "es";
		   $languages_id = 3;		   		   
		}
        else if ( strlen($_GET['customers_id_de'])>0 )
		{
		   $customers_id = $_GET['customers_id_de'];		
		   $database_code = "de";
		   $languages_id = 4;		   		   
		}
        else if ( strlen($_GET['customers_id_en'])>0 )
		{
		   $customers_id = $_GET['customers_id_en'];		
		   $database_code = "en";
		   $languages_id = 5;		   		   
		}		
        else if ( strlen($_GET['customers_id_bf'])>0 )
		{
		   $customers_id = $_GET['customers_id_bf'];		
		   $database_code = "bf";
		   $languages_id = 2;		   		   
		}				
        else if ( strlen($_GET['customers_id_it'])>0 )
		{
//echo $_GET['customers_id_it'];exit;		
		   $customers_id = $_GET['customers_id_it'];		
		   $database_code = "it";
		   $languages_id = 6;		   		   
		}		
        else if ( strlen($_GET['customers_id_eu'])>0 )
		{
		   $customers_id = $_GET['customers_id_eu'];		
		   $database_code = "eu";
		   
		   $sql = "select languages_id from orders where orders_id = ". $_GET['old_id'];
		   $lg = $db->Execute( $sql );
		   
		   $db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);
		   $languages_id = $lg->fields['languages_id'];	
		}
        else if ( strlen($_GET['customers_id_hp'])>0 )
		{
		   $customers_id = $_GET['customers_id_hp'];		
		   $database_code = "hp";
		   
		   $sql = "select languages_id from orders where orders_id = ". $_GET['old_id'];
		   $lg = $db->Execute( $sql );
		   
		   $db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);
		   $languages_id = $lg->fields['languages_id'];	
		}		
        else if ( strlen($_GET['customers_id_rq'])>0 )
		{
		   $customers_id = $_GET['customers_id_rq'];		
		   $database_code = "rq";
		   
		   $languages_id = 2;	
		   
//echo $sql.$languages_id;exit;		   
		}				
        else if ( strlen($_GET['customers_id_pl'])>0 )
		{
		   $customers_id = $_GET['customers_id_pl'];		
		   $database_code = "pl";		   
		   $languages_id = 7;	
		}						
        else if ( strlen($_GET['customers_id_tb'])>0 )
		{
		   $customers_id = $_GET['customers_id_tb'];		
		   $database_code = "tb";
		   
		   $languages_id = 2;	
		   
//echo $sql.$languages_id;exit;		   
		}		
        else if ( strlen($_GET['customers_id_po'])>0 )
		{
		   $customers_id = $_GET['customers_id_po'];		
		   $database_code = "po";
		   
		   $sql = "select languages_id from orders where orders_id = ". $_GET['old_id'];
		   $lg = $db->Execute( $sql );
		   
		   $db->connect($ext_db_server['po'], $ext_db_username['po'], $ext_db_password['po'], $ext_db_database['po'], USE_PCONNECT, false);
		   $languages_id = 5;	
//echo $sql.$languages_id;exit;		   
		}		
		else if ( strlen($_GET['nc_country'])>0 )
		{
		    $new_customer = 1;
			$params = explode( "|", $_GET['nc_country']);
			$database_code = $params[0];
			$countries_id = $params[1];

		   $sql = "select languages_id from orders where orders_id = ". $_GET['old_id'];
		   $lg = $db->Execute( $sql );
		   
		   $db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);
		   $languages_id = $lg->fields['languages_id'];				
		}
	    $db->connect($ext_db_server[$database_code], $ext_db_username[$database_code], $ext_db_password[$database_code], $ext_db_database[$database_code], USE_PCONNECT, false);
		
         // gestion du statut de la commande générée
		 $status=$_GET['status'];
		 
		  if  (  $_GET['invoice_type']=='PF' )
		  {
		     $status = 7;
		  }		 
		 
		  if  (  $_GET['invoice_type']=='BL' )
		  {
		     $status = 5;
		  }		 
	    if ( $new_customer )	
		{
            // test de la nom existance du mail 
            $sql = "select customers_id from customers where customers_email_address = '". $_GET['nc_email']."'";		    
			$test = $db->Execute( $sql );
			
			if ( strlen($test->fields['customers_id'])>0 )
			{
			   echo  'Le email existe déjà pour le client '. $test->fields['customers_id'] . ' <br><br> <a href="javascript:history.go(-1)"> Cliquez ici pour reprendre </a>';
			   die();
			}
			   
		    $dml = " insert into customers  (
				         customers_gender, customers_firstname , customers_lastname ,
						 customers_email_address, customers_telephone, customers_fax,
						 customers_password, customers_authorization )
					 values (
				         '". $_GET['nc_genre'] . "', '". $_GET['nc_prenom'] . "' , '". $_GET['nc_nom'] . "' ,
						 '". $_GET['nc_email'] . "', '". $_GET['nc_telephone'] . "', '". $_GET['nc_fax'] . "',
						 '5dc850f7a6c8feb0760146f1dd4c0027:54', 0 ) ";
			$db->Execute($dml);
			$customers_id = mysql_insert_id();			
			
		    $dml = " insert into address_book  (
				         customers_id,  entry_gender, entry_company ,
						 entry_tva_intracom, entry_firstname, entry_lastname,
						 entry_street_address, entry_suburb, entry_postcode,
						 entry_city, entry_state, entry_country_id
						 )
					 values (
				         '". $customers_id . "', '". $_GET['nc_genre'] . "' , '". $_GET['nc_societe'] . "' ,
						 '". $_GET['nc_intracom'] . "', '". $_GET['nc_prenom'] . "', '". $_GET['nc_nom'] . "',
						 '". $_GET['nc_addr1'] . "', '". $_GET['nc_addr2'] . "', '". $_GET['nc_code_postal'] . "',
						 '". $_GET['nc_ville'] . "',  '". $_GET['nc_state'] . "', '". $countries_id . "' ) ";

			$db->Execute($dml);
			$address_id = mysql_insert_id();			
			
			$dml = "insert into customers_info ( customers_info_id ) values ( " . $customers_id . " ) ";
			$db->Execute($dml);
			
			$dml = "update customers set customers_default_address_id = " . $address_id . " where customers_id = " . $customers_id;
			$db->Execute($dml);
						 
		}
			
	 }
	 
          //clonage_order ( $p_old_order_id, $p_old_db, $p_new_db, $p_custumer_database_code, $p_new_customer );
		  if  ( invoice_type=='PF' )
		  {
		     $status = 7;
		  }
//echo $database_code;exit;
          $oldID = $_GET['old_id'];

          if ($database_code!="po")
          {		  
		    // 	      $oID = clonage_order ( $oldID, 'gl', $_SESSION['source_db'], $database_code, $customers_id, $languages_id, $status );
			$oID = clonage_order ( $oldID, 'gl', $_SESSION['source_db'] , $database_code , $customers_id, $languages_id, $status  );	
		  }
		  else
		  {
			$oID = clonage_order ( $oldID, 'gl', 'po', 'po', $customers_id, $languages_id, $status );
		  }
		  //  injection des commandes clients
		  if ( $database_code == "po" )
		  {
		     $sql =  "select short_name value from customers where customers_id =".$_GET['customers_id_po'];
		     $supplier_short_name =  exec_select ( $sql ) ;
			 $sql = "select * from orders_products where po_orders_products_id = 0 and supplier_short_name = '". $supplier_short_name . "'";
//echo $sql.'<br>';
//echo 'fv1';			  fvv
			 $rs = $db->Execute($sql);
			 while(!$rs->EOF)
			 {
				if (strlen($rs->fields['compatible_lamp_code'])>0)
				 $products_model = $rs->fields['compatible_lamp_code'];
				else
				 $products_model = $rs->fields['products_model'];

				 
			     $dml = "INSERT INTO orders_products ( orders_id, products_id, 
                               products_model, products_name, products_price, 
                               final_price, products_tax, products_quantity ) 
						VALUES  ( ". $oID . ", 0, 
						   '". $products_model  ."', '". $rs->fields['products_name'] ."', '0.0000', 
						   '". $rs->fields['unit_order_price'] ."',0,". $rs->fields['products_quantity'] . " )";
						   
//echo $dml.'<br>';

				 $db->Execute($dml);
				 
				 $sql = "select max(orders_products_id) value from orders_products";
				 $orders_products_id = exec_select ($sql);

			     $dml = "update orders_products 
				         set  po_orders_products_id = " . $orders_products_id . "
						 where orders_products_id =  ". $rs->fields['orders_products_id'];
						 
				 $db->Execute($dml);						 
				 
			     $rs->MoveNext();
			 }
		  }
		  // 

		  // attribution d'un nuéro de facture
		  if ( ($_GET['invoice_type']!='CM') && ($_GET['invoice_type']!='PF') )
		  {
    		  $invoice_id = get_invoice_id ( $oID  , $_GET['invoice_type'], 1 );
              update_standard_comment ($oID);
		  }
		  if  ( invoice_type=='PF' )
		  {
             update_standard_comment ($oID);			 
		  }
/*		  
		  if  ( invoice_type=='BL' )
		  {
		     $status = 5;
		  }
*/

          // --- redirection ------------
		  // zen_redirect('el_orders.php?oID=' . $oID  . '&action=edit');
		  // edit_frame.php?oID=200063&source_db=gl&languages_id=4&action=edit
		  zen_redirect('edit_frame.php?oID=' . $oID  . '&languages_id='. $languages_id .'&source_db=gl&action=edit');

          exit;
  }

if  (  (strlen( $_SESSION['source_db'] )>0) &&  ( $_SESSION['source_db'] != 'gl' ) )
{
   $db->connect($ext_db_server[$_SESSION['source_db']], $ext_db_username[$_SESSION['source_db']], $ext_db_password[$_SESSION['source_db']], $ext_db_database[$_SESSION['source_db']], USE_PCONNECT, false);
   $st = $db->Execute('select orders_status from orders where orders_id = '. $oID);
   $stat = $st->fields['orders_status'];
}

  if ( strlen($_SESSION['new_oID'])>0 )
  {
     echo '<html>
	         <script>
			    parent.document.location = \'edit_frame.php?oID='. $_SESSION['new_oID'] .'&source_db=gl&languages_id=2&action=edit\';
	         </script>
           </html>';
     $_SESSION['new_oID'] = "";
     exit;
  }
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  
  if ($oID) {
    require_once(DIR_WS_CLASSES . 'super_order.php');
    $so = new super_order($oID);
  }
  
  if (zen_not_null($action)) {
    switch ($action) {
      case 'mark_completed':
        $so->mark_completed();
        $messageStack->add_session(sprintf(SUCCESS_MARK_COMPLETED, $oID), 'success');
        zen_redirect(zen_href_link('el_orders', 'action=edit&oID=' . $oID, 'NONSSL'));
      break;
      case 'mark_cancelled':
        $so->mark_cancelled();
        $messageStack->add_session(sprintf(WARNING_MARK_CANCELLED, $oID), 'warning');
        zen_redirect(zen_href_link('el_orders', 'action=edit&oID=' . $oID, 'NONSSL'));
      break;
      case 'reopen':
        $so->reopen();
        $messageStack->add_session(sprintf(WARNING_ORDER_REOPEN, $oID), 'warning');
        zen_redirect(zen_href_link('el_orders', 'action=edit&oID=' . $oID, 'NONSSL'));
      break;
      case 'add_note':
        $oID = $_POST['oID'];

        $new_admin_note = array();
        $new_admin_note['customers_id'] = $_POST['cID'];
        $new_admin_note['date_added'] = 'now()';
        $new_admin_note['admin_id'] = $_SESSION['admin_id'];
        $new_admin_note['notes'] = zen_db_scrub_in($_POST['notes']);
        $new_admin_note['karma'] = $_POST['karma'];

        zen_db_perform(TABLE_CUSTOMERS_ADMIN_NOTES, $new_admin_note);

        $messageStack->add_session(SUCCESS_NEW_ADMIN_NOTE, 'success');
        zen_redirect(zen_href_link(FILENAME_SUPER_ORDERS, 'oID=' . $oID . '&action=edit', 'NONSSL'));
      break;
      case 'edit':
        // reset single download to on
        if ($_GET['download_reset_on'] > 0) {
          // adjust download_maxdays based on current date
          $check_status = $db->Execute("select customers_name, customers_email_address, orders_status,
                                      date_purchased from " . TABLE_ORDERS . "
                                      where orders_id = '" . $_GET['oID'] . "'");
          $zc_max_days = date_diff($check_status->fields['date_purchased'], date('Y-m-d H:i:s', time())) + DOWNLOAD_MAX_DAYS;

          $update_downloads_query = "update " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " set download_maxdays='" . $zc_max_days . "', download_count='" . DOWNLOAD_MAX_COUNT . "' where orders_id='" . $_GET['oID'] . "' and orders_products_download_id='" . $_GET['download_reset_on'] . "'";
          $db->Execute($update_downloads_query);
          unset($_GET['download_reset_on']);

          $messageStack->add_session(SUCCESS_ORDER_UPDATED_DOWNLOAD_ON, 'success');
          zen_redirect(zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('action')) . 'action=edit', 'NONSSL'));
        }
        // reset single download to off
        if ($_GET['download_reset_off'] > 0) {
          // adjust download_maxdays based on current date
          $update_downloads_query = "update " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " set download_maxdays='0', download_count='0' where orders_id='" . $_GET['oID'] . "' and orders_products_download_id='" . $_GET['download_reset_off'] . "'";
          unset($_GET['download_reset_off']);
          $db->Execute($update_downloads_query);

          $messageStack->add_session(SUCCESS_ORDER_UPDATED_DOWNLOAD_OFF, 'success');
          zen_redirect(zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('action')) . 'action=edit', 'NONSSL'));
        }
      break;
      case 'update_order':
        $status = zen_db_scrub_in($_POST['status'], true);
        $comments = zen_db_scrub_in($_POST['comments']);

        $check_status = $db->Execute("select customers_name, customers_email_address, orders_status,
                                      date_purchased from " . TABLE_ORDERS . "
                                      where orders_id = '" . (int)$oID . "'");

        if ( ($check_status->fields['orders_status'] != $status) || zen_not_null($comments)) {
          $customer_notified = '0';
          if (isset($_POST['notify']) && ($_POST['notify'] == 'on')) {
            $customer_notified = '1';
          }
          update_status($oID, $status, $customer_notified, $comments);

          if ($customer_notified == '1') {
            email_latest_status($oID);
          }

          if ($status == DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE) {
            // adjust download_maxdays based on current date
            $zc_max_days = date_diff($check_status->fields['date_purchased'], date('Y-m-d H:i:s', time())) + DOWNLOAD_MAX_DAYS;

            $update_downloads_query = "update " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " set download_maxdays='" . $zc_max_days . "', download_count='" . DOWNLOAD_MAX_COUNT . "' where orders_id='" . (int)$oID . "'";
            $db->Execute($update_downloads_query);
          } 
          $messageStack->add_session(SUCCESS_ORDER_UPDATED, 'success');
        }
        else {
          $messageStack->add_session(WARNING_ORDER_NOT_UPDATED, 'warning');
        }

        zen_redirect(zen_href_link('el_orders.php', zen_get_all_get_params(array('action')) . 'action=edit', 'NONSSL'));
        break;
      case 'deleteconfirm':
        zen_remove_order($oID, $_POST['restock']);
        $so->delete_all_data();

        zen_redirect(zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')), 'NONSSL'));
      break;
    }
  }

  if (($action == 'edit') && isset($_GET['oID'])) {
    $orders = $db->Execute("select orders_id, orders_status  from " . TABLE_ORDERS . " where orders_id = '" . $oID . "'");

    $order_exists = true;
    if ($orders->RecordCount() <= 0) {
      $order_exists = false;
      $messageStack->add(sprintf(ERROR_ORDER_DOES_NOT_EXIST, $oID), 'error');
      zen_redirect(zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')), 'NONSSL'));
    }
  }
  // fv ajoustement automatique du taux de TVA si c'est une commande 
  
  
  // fv GESTION des modifications $may_change_piece  $may_change_products 
  $saisie_bl = 0;
  $may_change_order = 1;
  $may_change_products = 1;
  
   // gestion_reliquats ( $p_orders_id, $p_orders_products_id=0, $p_ajout=0 , $p_init=0  )
//  gestion_reliquats ( $oID, 0, 0 , 1  );
//  exit;
  
  if ( $_SESSION['admin_id']==2 && (  $_SESSION['source_db']=="gl" )  )
  {
      $may_change_order = 0;
	  $may_change_products = 0;
  }
  else
  {
     if ( ( $orders->fields['orders_status']==3  ) && (  $_SESSION['source_db']!="gl" ) )
	 {
	      $may_change_order = 0;
		  $may_change_products = 0;	     
	 }
     else if ( ( $orders->fields['gl_transfered']==1  ) && (  $_SESSION['source_db']=="gl" ) )
	 {
	      $may_change_order = 0;
		  $may_change_products = 0;	     
	 }	 
     else if (  $orders->fields['orders_status']==5   )
     {
    	 $may_change_products = 0;	 
		 $saisie_bl = 1;
		 if ( strlen( $_GET['p_ajout'] )>0 )
		 {
		     gestion_reliquats ( $_GET['oID'], $_GET['orders_products_id'], $_GET['p_ajout'] , 0  );
			 recalc_total($oID);
		 }
     }	 
  }
  
//  $saisie_bl = 1;


  $orders_statuses = array();
  $orders_status_array = array();
  $orders_status = $db->Execute("select orders_status_id, orders_status_name
                                 from " . TABLE_ORDERS_STATUS . "
                                 where language_id = '" . (int)$_SESSION['languages_id'] . "'");
  while (!$orders_status->EOF) {
    $orders_statuses[] = array('id' => $orders_status->fields['orders_status_id'],
                               'text' => $orders_status->fields['orders_status_name'] . ' [' . $orders_status->fields['orders_status_id'] . ']');
    $orders_status_array[$orders_status->fields['orders_status_id']] = $orders_status->fields['orders_status_name'];
    $orders_status->MoveNext();
  }

  require(DIR_WS_CLASSES . 'order.php');
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/super_stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }

  function popupWindow(url, features) {
    window.open(url,'popupWindow',features)
  }
  // -->
</script>
</head>
<body onload="init()">
<!-- header //-->
<?php 
 // FV suppression require(DIR_WS_INCLUDES . 'header.php'); 
?>
<!-- header_eof //-->
<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
<?php if (empty($action)) {?>
<!-- search -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
         <tr><?php echo zen_draw_form('search', 'el_orders', '', 'get', '', true); ?>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td colspan="2" class="smallText" align="right">
<?php
  if ((isset($_GET['search']) && zen_not_null($_GET['search'])) or $_GET['cID'] !='') {
    echo '<a href="' . zen_href_link('el_orders', '', 'NONSSL') . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a><br />';
  }
  echo HEADING_TITLE_SEARCH_DETAIL . ' ' . zen_draw_input_field('search');
  if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
    $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
    echo '<br/ >' . TEXT_INFO_SEARCH_DETAIL_FILTER . $keywords;
  }
?>
            </td>
          </form></tr>
        </table></td>
      </tr>
<!-- search -->
<?php
  }  // END if (empty($action))
  /*
  ** ORDER DETAIL DISPLAY
  */
  if (($action == 'edit') && ($order_exists == true)) {
    $order = new order ($oID);

    if ($order->info['payment_module_code']) {
      if (file_exists(DIR_FS_CATALOG_MODULES . 'payment/' . $order->info['payment_module_code'] . '.php')) {
        require(DIR_FS_CATALOG_MODULES . 'payment/' . $order->info['payment_module_code'] . '.php');
        require(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/modules/payment/' . $order->info['payment_module_code'] . '.php');
        $module = new $order->info['payment_module_code'];
//        echo $module->admin_notification($oID);
      }
    }
    $get_prev = $db->Execute("SELECT orders_id FROM " . TABLE_ORDERS . " WHERE orders_id < '" . $oID . "' ORDER BY orders_id DESC LIMIT 1");

    if (zen_not_null($get_prev->fields['orders_id'])) {
      $prev_button = '            <INPUT TYPE="BUTTON" VALUE="<<< ' . $get_prev->fields['orders_id'] . '" ONCLICK="window.location.href=\'' . zen_href_link('el_orders', 'oID=' . $get_prev->fields['orders_id'] . '&action=edit') . '\'">';
    }
    else {
      $prev_button = '            <INPUT TYPE="BUTTON" VALUE="' . BUTTON_TO_LIST . '" ONCLICK="window.location.href=\'' . zen_href_link('el_orders') . '\'">';
    }


    $get_next = $db->Execute("SELECT orders_id FROM " . TABLE_ORDERS . " WHERE orders_id > '" . $oID . "' ORDER BY orders_id ASC LIMIT 1");

    if (zen_not_null($get_next->fields['orders_id'])) {
      $next_button = '            <INPUT TYPE="BUTTON" VALUE="' . $get_next->fields['orders_id'] . ' >>>" ONCLICK="window.location.href=\'' . zen_href_link('el_orders', 'oID=' . $get_next->fields['orders_id'] . '&action=edit') . '\'">';
    }
    else {
      $next_button = '            <INPUT TYPE="BUTTON" VALUE="' . BUTTON_TO_LIST . '" ONCLICK="window.location.href=\'' . zen_href_link('el_orders') . '\'">';
    }


	
?>
	  <?php
	    if ( $_GET['show_stock']==1 )
		{
			echo '<tr>';

			require_once("http.class.php");
			$http = new CHttp();
			
			if ( $_SERVER['SERVER_NAME']=="127.0.0.1"  )
				$url = "http://127.0.0.1/sites/zencart_gl/admin/infos_cmde.php";				
			else
				$url = "http://linats.net/admin/infos_cmde.php";				
			
			$response = $http->GetRequestArguments($url, $arguments);

			$arguments['RequestMethod'] = 'POST';
			
			if ( $_GET['force_db']>0 )
				$source_db=$_GET['force_db'];			
			else
				$source_db=$_SESSION['source_db'];
			
			$arguments["PostValues"] = array("source_db" => $source_db,
			   "orders_id"=> $_GET['oID'],
				"hide_footer"=>1 );

			$error = $http->Open($arguments);
			$error = $http->SendRequest($arguments);
			$error = $http->ReadReplyBody($body, 64000);
			
			echo $body;
			echo '</tr>';
		}
		
	  ?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE_ORDER_DETAILS . $oID; ?></td>
            <?php if ($so->status) { ?>
            <td class="main" valign="middle"><?php echo
              '<span class="status-' . $so->status . '">' . zen_datetime_short($so->status_date) . '</span>&nbsp;' .
              '<a href="' . zen_href_link('el_orders', 'action=reopen&oID=' . $oID) . '">' . zen_image(DIR_WS_IMAGES . 'icon_red_x.gif', '', '', '', '') . HEADING_REOPEN_ORDER . '</a>';
            ?></td>
            <?php } ?>
            <td align="center"><table border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td class="main" align="center" valign="bottom">
				<?php 		
				   echo "&nbsp;";				
				     // echo $prev_button;
			     ?></td>
                <td class="smallText" align="center" valign="bottom">
				  <?php
				    echo '<font size=2>Format: ' .  $ext_db_name[$order->info['database_code']]. '&nbsp;&nbsp;Lang:'. $order->info['languages_id']. '&nbsp;&nbsp;Cust:<b>'. $order->customer['id'] . '</b></font>';
                   ?>
				</td>
                <td class="main" align="center" valign="bottom">
				<?php 
				   echo "&nbsp;";
				   //echo $next_button; 
				?>
				</td>
              </tr>
            </table></td>
            <td align="right" class="pageHeading">
			<?php
			  $sql = "select invoice_type, orders_invoices_id,orders_invoices_id_comment,date_format(invoice_date,\"%Y-%c-%d\") dt  from orders_invoices where orders_id = " . $oID;
			  $check_piece = $db->Execute( $sql );
			  
              //    $invoice_id = get_invoice_id ( $oID, 'DB', 0 );
			  $invoice_type = $check_piece->fields["invoice_type"];
			  $invoice_id = $check_piece->fields["orders_invoices_id"];
			  $orders_invoices_id_comment = addslashes($check_piece->fields["orders_invoices_id_comment"]);
			  $invoice_date = $check_piece->fields["dt"];
			  
			  if ( ( $invoice_type == "DB" ) || ( $invoice_type == "DH" ) )
			     $lib = 'INVOICE #'.$invoice_id;
			  else if (  ( $invoice_type == "CR" ) || ( $invoice_type == "CH" ) )
			     $lib = 'CREDIT #'.$invoice_id;
			  else if ( $invoice_type == "PF" )
			     $lib = 'PROFORMAT #'.$invoice_id;
			  else if ( $invoice_type == "BL" )
			     $lib = 'BL #'.$invoice_id;				 
			  else
			  {
			     if ( $stat == 7  )
				 {
				     $lib = 'PROFORMA';
					 $invoice_type = "CM";				 
				 }
				 else
				 {
				     $lib = 'COMMANDE';
					 $invoice_type = "CM";					 
					 /* vérifocation et ajustement  de la TVA au besoin */
					 $check_vat = exec_select ( "select max(products_tax) value from orders_products where orders_id = ". $oID );
					 if ( ( $order->info['products_tax']==0 )  && ( $check_vat > 0 )  )
					 {
					    $dml = "update orders set products_tax = " . $check_vat . " where orders_id = " . $oID ;
						$db->Execute( $dml );
						
					    $order->info['products_tax']=$check_vat;
					 }

				 }
				 
			  }
			  
			  echo $lib . "&nbsp;" . $invoice_date . "&nbsp;&nbsp;" . $orders_invoices_id_comment;
			  // <A href="javascript:window.print()">Imprimer</A>
			  // http://127.0.0.1/sites/zencart_gl/admin/el_orders.php?show_stock=1&action=edit&oID=85883&source_db=eu
			  if ( $_GET['show_stock']==1 )
			  {
				 echo '<A href="javascript:window.print()">Imprimer</A>';
			  }
			  else
			  {
			     echo '&nbsp;&nbsp;<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $oID . '&target=clone_invoice&invoice_type=' . $invoice_type . '&invoice_id='. $invoice_id .'', 'NONSSL') . '\', \'scrollbars=yes,resizable=yes,width=400,height=400,screenX=150,screenY=300,top=100,left=150\')">Clone</a>&nbsp;&nbsp;';			  			  
				  if ( $may_change_order || $saisie_bl )
				  {
				  // FVV
					  //if ( $_SESSION["source_db"]=="gl" )
					  //{	    
					  //}
					  echo '<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $oID . '&target=edit_invoice&invoice_type=' . $invoice_type . '&invoice_id='. $invoice_id .'', 'NONSSL') . '\', \'scrollbars=yes,resizable=yes,width=400,height=400,screenX=150,screenY=300,top=100,left=150\')">Modif</a>';
				  }			  
			  }
			  
			/*
              echo '<a href="' . zen_href_link(FILENAME_SUPER_DATA_SHEET, 'oID=' . $oID) . '" target="_blank">' . zen_image_button('btn_print.gif', ICON_ORDER_PRINT) . '</a>&nbsp;&nbsp;';
              echo '<a href="' . zen_href_link(FILENAME_SUPER_INVOICE, 'oID=' . $oID) . '" target="_blank">' . zen_image_button('button_invoice.gif', ICON_ORDER_INVOICE) . '</a>&nbsp;&nbsp;';
              echo '<a href="' . zen_href_link(FILENAME_SUPER_PACKINGSLIP, 'oID=' . $oID) . '" target="_blank">' . zen_image_button('button_packingslip.gif', ICON_ORDER_PACKINGSLIP) . '</a>&nbsp;&nbsp;';
              echo '<a href="javascript:history.back()">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>';
			  */
            ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="3"><?php echo zen_draw_separator(); ?></td>
          </tr>
          <tr>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top">
                  <strong><?php echo ENTRY_CUSTOMER_ADDRESS; ?></strong><?php
                    if ( (!$so->status) && ( $may_change_order ) )
					{
                      echo '<br /><a href="javascript:popupWindow(\'' .
                      zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $oID . '&target=contact', 'NONSSL') . '\', \'scrollbars=yes,resizable=yes,width=600,height=550,screenX=150,screenY=100,top=100,left=150\')">' .
                      zen_image(DIR_WS_IMAGES . 'icon_edit3.gif', ICON_EDIT_CONTACT) . ICON_EDIT_CONTACT . '</a>';
					  
					  
                      echo 
'<br><br><form name="login"  target=_blank action="'. $ext_bd_root[$order->info['database_code']] .'/index.php?main_page=login&amp;action=process&amp;" method="post">
<input name="zenid" value="cc8f53975d4ae3d3da1ca088eed88afa" type="hidden">						
<input type="hidden" name="email_address" value="'. $order->customer['email_address'] .'">
<input type="hidden" name="password" size="27" value="raclette">
&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:document.login.submit();">address book</a>
</form>';
                    }
                ?></td>
                <td class="main"><?php echo zen_address_format($order->customer['format_id'], $order->customer, 1, '', '<br />'); ?></td>
              </tr>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top"><strong><?php echo ENTRY_BILLING_ADDRESS; ?></strong></td>
                <td class="main"><?php echo zen_address_format($order->billing['format_id'], $order->billing, 1, '', '<br />'); ?></td>
              </tr>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top"><strong><?php echo ENTRY_SHIPPING_ADDRESS; ?></strong></td>
                <td class="main"><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, '', '<br />'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td>
			<table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><strong>Telephone number:</strong></td>
                <td class="main"><?php echo $order->customer['telephone']; ?></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="main"><strong>Email address:</strong></td>
                <td class="main"><?php
                  echo $order->customer['email_address'] . '&nbsp;[<a href="mailto:' . $order->customer['email_address'] . '">' . TEXT_MAILTO . '</a>]&nbsp;[<a href="' . zen_href_link(FILENAME_MAIL, 'origin=super_orders.php&mode=NONSSL&selected_box=customers&customer=' . $order->customer['email_address'], 'NONSSL') . '">' . TEXT_STORE_EMAIL . '</a>]';
                ?></td>
				
              </tr>
              <tr>
                <td class="main"><strong>Intracom:</strong></td>
                <td class="main"><?php echo $order->customer['entry_tva_intracom']; ?></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="main"><strong>VAT Applied:</strong></td>
                <td class="main"><?php echo $order->info['products_tax'] . '&nbsp;%'  ; ?></td>
				
                <td class="main"><strong>Currency:</strong></td>
                <td class="main"><?php echo $order->info['currency']; ?></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="main"><strong>Rate:</strong></td>
                <td class="main"><?php echo $order->info['currency_value'] ; ?></td>
				
              </tr>			  
              <tr>
              </tr>
              <tr>
                <td class="main"><strong><?php echo TEXT_INFO_IP_ADDRESS; ?></strong></td>
                <?php if ($order->info['ip_address'] != '') { ?>
                <td class="main"><?php echo $order->info['ip_address'] . '&nbsp;[<a target="_blank" href="http://www.dnsstuff.com/tools/whois.ch?ip=' . $order->info['ip_address'] . '">' . TEXT_WHOIS_LOOKUP . '</a>]'; ?></td>
                <?php } else { ?>
                <td class="main"><?php echo TEXT_NONE; ?></td>
                <?php } ?>
              </tr>
              <tr>
                <td colspan="5"><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
              </tr>
              <tr>
                <td class="main"><strong>Date ordered:</strong></td>
                <td class="main"><?php echo $order->info['date_purchased']; ?></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="main"><strong>Order references:</strong></td>
                <td class="main"><?php echo $order->info['ref_info']; ?></td>
                <td class="main"><strong>Delivery type:</strong></td>
                <td class="main"><?php echo $order->info['shipping_module_code']; ?></td>				
              </tr>
              <tr>
                <td colspan="5"><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
              </tr>
              <tr>
                <td class="main"><strong><?php echo ENTRY_PAYMENT_METHOD; ?></strong></td>
                <td class="main"><?php 
				      // FV
				      echo $order->info['payment_method']; 
                   ?></td>			
				<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>				   
                <td class="main"><strong>Payment Conditions:</strong></td>
                <td class="main"><?php 
				      // FV
				      echo $order->info['payment_conditions_desc']; 
                   ?></td>					  


                <td class="main"><strong>Payment Reference:</strong></td>
                <td class="main"><?php 
				      // FV
				      echo $order->info['payment_info']; 
					  // 
					  echo ' | '. $order->info['orders_date_finished']; 
					  echo ' | '. $order->info['payment_amount']; 
					  
					  if ( $may_change_order )
					  {
	                      echo '&nbsp;&nbsp;&nbsp;<a href="javascript:popupWindow(\'' .
	                      zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $oID . '&target=payment_mode', 'NONSSL') . '\', \'scrollbars=yes,resizable=yes,width=500,height=450,screenX=150,screenY=300,top=100,left=150\')">' .
	                      zen_image(DIR_WS_IMAGES . 'icon_edit3.gif', 'Informations de paiement') . '</a>';									  
					  }
					$sql = "select 1 chk from bo_po.orders where orders_id = ".$oID;
					$rs_chk = $db->Execute($sql);
					$chk = $rs_chk->fields['chk'];
					if ( $chk ) 
					{
						echo '<font color=green> DISPATCH </font>';
					}
					else
					{
						echo '<a target="_blank"  href="replication_base_commande.php?oId='.$oID.'"><font color=red> PREDISPATCH </font></a>';					
					}
                   ?>
				   </td>					  

				   
              </tr>			  			  			  
            </table>
			</td>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <?php if (!$so->status) { ?>
      <tr>
        <td class="main">
		 <?php 
		  if ( $may_change_products )
		  {		 
		    echo '<a href="javascript:popupWindow(\'' .
                      zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $oID . '&target=edit_product&orders_products_id=0', 'NONSSL') . '\', \'scrollbars=yes,resizable=yes,width=800,height=400,screenX=150,screenY=300,top=100,left=150\')">		  
		  Add Product</a>';
		    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:popupWindow(\'' .
                      zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $oID . '&target=add_customer_products&orders_products_id=0', 'NONSSL') . '\', \'scrollbars=yes,resizable=yes,width=400,height=400,screenX=150,screenY=300,top=100,left=150\')">		  
		  Add ordered products</a>';		  
		    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:popupWindow(\'' .
                      zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $oID . '&target=add_delivered_products&orders_products_id=0', 'NONSSL') . '\', \'scrollbars=yes,resizable=yes,width=400,height=400,screenX=150,screenY=300,top=100,left=150\')">		  
		  Add delivered products</a>';		  
		  }
		  else
		  {
		     echo '&nbsp;';
		  }
        ?></td>
      </tr>
      <?php } ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr class="dataTableHeadingRow">
            <?php if (sizeof($order->products) > 0) 
			{ ?>
                <td class="dataTableHeadingContent" width="50">&nbsp;</td>
              <?php 
			} ?>
            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS_MODEL; ?></td>
			<?php
			  if ($saisie_bl==0)
			  {
			     echo '<td class="dataTableHeadingContent" align="right">Tax</td>
		               <td class="dataTableHeadingContent" align="right">Price (ex)</td>
		               <td class="dataTableHeadingContent" align="right">Total (ex)</td>
		               <td class="dataTableHeadingContent" align="right">Total (inc)</td>';
			  }
			  else
			  {
			     echo ' <td class="dataTableHeadingContent" align="center">&nbsp;</td>					
		            <td class="dataTableHeadingContent" align="center">&nbsp;</td>										
		            <td class="dataTableHeadingContent" align="center">&nbsp;</td>																
		            <td class="dataTableHeadingContent" align="left">Quantité livrée</td>';
			  }
			 ?>			
            <td class="dataTableHeadingContent" align="right">Reliquat</td>		  			
            <td class="dataTableHeadingContent" align="right">Tri</td>		  						
		</tr>
<?php
    if (sizeof($order->products) > 0) {
      echo '          ' . zen_draw_form('split_packing', FILENAME_SUPER_PACKINGSLIP, '', 'get', 'target="_blank"', true) . "\n";
      echo '          ' . zen_draw_hidden_field('oID', (int)$oID) . "\n";
   //   echo '          ' . zen_draw_hidden_field('split', 'true') . "\n";
      echo '          ' . zen_draw_hidden_field('reverse_count', 0) . "\n";
    }
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) 
	{
	  if ( $saisie_bl==0
           || ( 
			         $order->products[$i]['model'] != "SHF" 
				  && $order->products[$i]['model'] != "CODF" 
				  && $order->products[$i]['model'] != "ECOF" 
				  && $order->products[$i]['model'] != "ESCF" 
				  && $order->products[$i]['model'] != "FRSH" 
              )		   
	      )
	  {
	  
      echo '          <tr class="dataTableRow">' . "\n";
      if (sizeof($order->products) > 0) {
	    /*
        echo '            <td class="dataTableContent" valign="top" width="10">' . 
		zen_draw_checkbox_field('incl_product_' . $i, 'yes') .
		'&nbsp;&nbsp;&nbsp;'.*/
        echo '            <td class="dataTableContent" valign="top" width="10">';
        echo '&nbsp;';
		
		if ( $may_change_products )
		{
			echo '<a href="javascript:popupWindow(\'' .
	         zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $oID . '&target=edit_product&orders_products_id=' . $order->products[$i]['orders_products_id'] . '', 'NONSSL') . '\', \'scrollbars=yes,resizable=yes,width=800,height=400,screenX=150,screenY=300,top=100,left=150\')">	'.	  
			  '<img  border=0 src="images/icon_edit3.gif"></a>';
		}
		echo '</td>' . "\n";
      }
      echo '      <td class="dataTableContent" valign="middle" align="left">' . $order->products[$i]['qty'] . '&nbsp;x&nbsp;' . $order->products[$i]['name'];

      if (isset($order->products[$i]['attributes']) && (sizeof($order->products[$i]['attributes']) > 0)) {
        for ($j = 0, $k = sizeof($order->products[$i]['attributes']); $j < $k; $j++) {
          echo '<br /><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
          if ($order->products[$i]['attributes'][$j]['price'] != '0') echo ' (' . $order->products[$i]['attributes'][$j]['prefix'] . $currencies->format($order->products[$i]['attributes'][$j]['price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ')';
          if ($order->products[$i]['attributes'][$j]['product_attribute_is_free'] == '1' and $order->products[$i]['product_is_free'] == '1') echo TEXT_INFO_ATTRIBUTE_FREE;
          echo '</i></small></nobr>';
        }
      }

      echo '            </td>' . "\n" .
           '            <td class="dataTableContent" valign="middle">' . $order->products[$i]['model'] . '</td>' . "\n" ;
      if (!$saisie_bl)		   
	  {
       echo    '            <td class="dataTableContent" align="right" valign="middle">' . zen_display_tax_value($order->products[$i]['tax']) . '%</td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $currencies->format($order->products[$i]['final_price'], true, $order->info['currency'], $order->info['currency_value']) .
                          ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format($order->products[$i]['onetime_charges'], true, $order->info['currency'], $order->info['currency_value']) : '') .
                        '</strong></td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $currencies->format($order->products[$i]['final_price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) .
                          ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format($order->products[$i]['onetime_charges'], true, $order->info['currency'], $order->info['currency_value']) : '') .
                        '</strong></td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) .
                          ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : '') .
                        '</strong></td>' . "\n";
	  } 
	  else
	  {
         echo '          <td class="dataTableContent" valign="middle">
		                  <a href="el_orders.php?action=edit&p_ajout=-1&oID='.$oID.'&orders_products_id=' . $order->products[$i]['orders_products_id'] . '">
						    <img src="images/minus_inline.gif" border=0></td>
						  </a>' . "\n" ;     				
         echo '          <td class="dataTableContent" valign="middle">
		                  <a href="el_orders.php?action=edit&p_ajout=1&oID='.$oID.'&orders_products_id=' . $order->products[$i]['orders_products_id'] . '">
						    <img src="images/plus_inline.gif" border=0></td>
						  </a>' . "\n" ;     				
         echo '          <td class="dataTableContent" valign="middle">
		                  <a href="el_orders.php?action=edit&p_ajout=' . $order->products[$i]['reliquat']  . '&oID='.$oID.'&orders_products_id=' . $order->products[$i]['orders_products_id'] . '">
						    <img src="images/plusplus_inline.gif" border=0></td>
						  </a>' . "\n" ;     				
						  
    	 echo '          <td class="dataTableContent" valign="middle">' . $order->products[$i]['qty'] . '</td>' . "\n" ;     
	  }
	  
      echo    '          <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $order->products[$i]['reliquat'] . '</strong></td>';												  

      echo    '          <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $order->products[$i]['sort_order'] . '</strong></td>';												  
						  
      echo '          </tr>' . "\n";
	  } // type
    } // loop
?>
          <tr>
            <?php if (sizeof($order->products) > 0) { ?>
            <td valign="top" colspan="2"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top">&nbsp;&nbsp;<?php  //echo zen_image(DIR_WS_IMAGES . 'arrow_south_east.gif'); ?></td>
                <td valign="bottom" class="main">&nbsp;<?php // echo '<input type="submit" value="'. BUTTON_SPLIT . '">' ; ?></td>
              </tr>
              <tr>
                <td class="smallText">&nbsp;</td>
                <td class="smallText" valign="top" align="center"><?php // echo TEXT_DISPLAY_ONLY; ?></td>
              </tr>
            </table></td>
            </form>
<?php
             $colspan = 7;
           } else {
             $colspan = 8;
           }
?>
            <td align="right" colspan="<? echo $colspan; ?>"><table border="0" cellspacing="0" cellpadding="2">
<?php
    // Short shipping display
    // Formats shipping entry to remove the TEXT_WAY define
    for ($i = 0, $n = sizeof($order->totals); $i < $n; $i++) {
      if ($order->totals[$i]['class'] == 'ot_shipping') {
        $format_shipping = explode(" (", $order->totals[$i]['title'], 2);
        $clean_shipping = rtrim($format_shipping[0], ":");
        $display_title = $clean_shipping . ':';
      }
      else {
        $display_title = $order->totals[$i]['title'];
      }
      echo '              <tr>' . "\n" .
           '                <td align="right" class="'. str_replace('_', '-', $order->totals[$i]['class']) . '-Text">' . $display_title . '</td>' . "\n" .
           '                <td align="right" class="'. str_replace('_', '-', $order->totals[$i]['class']) . '-Amount">' . $order->totals[$i]['text'] . '</td>' . "\n" .
           '              </tr>' . "\n";
    }

          if ( ( true) && (  (!$so->status)  && ( $may_change_order ) ) )
		  { 
		      ?>
              <tr>
                <td colspan="2" align="right"><?php echo '<a href="javascript:popupWindow(\'' .
                   zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $oID . '&target=total', 'NONSSL') . '\', \'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=650,height=450,screenX=150,screenY=100,top=100,left=150\')">' .
                   zen_image(DIR_WS_IMAGES . 'icon_edit3.gif', ICON_EDIT_TOTAL) . ICON_EDIT_TOTAL . '</a>';
                ?></td>
              </tr>
			  <?php
           } 
	
    // determine what to display on the "Amount Applied" and "Balance Due" lines
    $amount_applied = $currencies->format($so->amount_applied);
    $balance_due = $currencies->format($so->balance_due);

    // determine display format of the number
    // 'balanceDueRem' = customer still owes money
    // 'balanceDueNeg' = customer is due a refund
    // 'balanceDueNone' = order is all paid up
    // 'balanceDueNull' = balance nullified by order status
    switch ($so->status) {
      case 'completed':
        switch ($so->balance_due) {
          case 0:
            $class = 'balanceDueNone';
          break;
          case $so->balance_due < 0:
            $class = 'balanceDueNeg';
          break;
          case $so->balance_due > 0:
            $class = 'balanceDueRem';
          break;
        }
      break;

      case 'cancelled':
        switch ($so->balance_due) {
          case 0:
            $class = 'balanceDueNone';
          break;
          case $so->balance_due < 0:
            $class = 'balanceDueNeg';
          break;
          case $so->balance_due > 0:
            $class = 'balanceDueRem';
          break;
        }
      break;

      default:
        switch ($so->balance_due) {
          case 0:
            $class = 'balanceDueNone';
          break;
          case $so->balance_due < 0:
            $class = 'balanceDueNeg';
          break;
          case $so->balance_due > 0:
            $class = 'balanceDueRem';
          break;
        }
      break;
    }
?>
            </table></td>
          </tr>
		  
        </table></td>
      </tr>
    
<?php
  // show downloads
  require(DIR_WS_MODULES . 'orders_download.php');
?>

      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><strong><?php echo TABLE_HEADING_STATUS_HISTORY; ?></strong></td>
      </tr>
      <tr>
        <td valign="top" class="main"><table border="1" cellspacing="0" cellpadding="5">
          <tr>
            <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_DATE_ADDED; ?></strong></td>
            <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_CUSTOMER_NOTIFIED; ?></strong></td>
            <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_STATUS; ?></strong></td>
            <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_COMMENTS; ?></strong></td>
          </tr>
<?php
    $orders_history = $db->Execute("select orders_status_id, date_added, customer_notified, comments
                                    from " . TABLE_ORDERS_STATUS_HISTORY . "
                                    where orders_id = '" . $oID . "'
                                    order by date_added");

    if ($orders_history->RecordCount() > 0) {
      while (!$orders_history->EOF) {
        echo '          <tr>' . "\n" .
             '            <td class="smallText" align="center">' . zen_datetime_short($orders_history->fields['date_added']) . '</td>' . "\n" .
             '            <td class="smallText" align="center">';
        if ($orders_history->fields['customer_notified'] == '1') {
          echo zen_image(DIR_WS_ICONS . 'tick.gif', ICON_TICK) . "</td>\n";
        } else {
          echo zen_image(DIR_WS_ICONS . 'cross.gif', ICON_CROSS) . "</td>\n";
        }
        echo '            <td class="smallText">' . $orders_status_array[$orders_history->fields['orders_status_id']] . '</td>' . "\n";
        echo '            <td class="smallText">' . nl2br(zen_db_scrub_out($orders_history->fields['comments'])) . '&nbsp;</td>' . "\n" .
             '          </tr>' . "\n";
        $orders_history->MoveNext();
      }
    } else {
        echo '          <tr>' . "\n" .
             '            <td class="smallText" colspan="5">' . TEXT_NO_ORDER_HISTORY . '</td>' . "\n" .
             '          </tr>' . "\n";
    }
?>
        </table></td>
      </tr>
      <?php if ( (!$so->status) && ( $may_change_order ) )  
	        { ?>
      <tr>
        <td><?php echo '<a href="javascript:popupWindow(\'' .
                   zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $oID . '&target=history', 'NONSSL') . '\', \'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=650,height=450,screenX=150,screenY=100,top=100,left=150\')">' .
                   zen_image(DIR_WS_IMAGES . 'icon_edit3.gif', ICON_EDIT_HISTORY) . ICON_EDIT_HISTORY . '</a>';
        ?></td>
      </tr>
      <?php } ?>
<?php
    // hide status-updating code and cancel/complete buttons
    // if the order is already closed
    if ( (!$so->status) && ( $may_change_order ) ) {
?>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0"><tr>
          <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="main"><strong><?php echo TABLE_HEADING_ADD_COMMENTS; ?></strong></td>
            </tr>
            <tr>
              <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
            </tr>
            <tr><?php echo zen_draw_form('status', 'el_orders.php', zen_get_all_get_params(array('action')) . 'action=update_order', 'post', '', true); ?>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td class="main"><?php echo zen_draw_textarea_field('comments', 'soft', '60', '5'); ?></td>
                  <td class="main" valign="center"><strong><?php
                    echo zen_draw_checkbox_field('notify', '', false); echo '&nbsp;' . ENTRY_NOTIFY_CUSTOMER . '<br /><br />';
                    echo zen_draw_checkbox_field('notify_comments', '', true); echo '&nbsp;' . ENTRY_NOTIFY_COMMENTS;
                  ?></strong>
				  
				  </td>
                </tr>
                <tr>
                  <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
                </tr>
                <tr>
                  <td class="main"><strong><?php echo ENTRY_STATUS; ?></strong> 
				  <?php   
//*****


//				   echo zen_draw_pull_down_menu('status', $orders_statuses, $order->info['orders_status']); 
				   //function get_select ( $sql_stmt, $name, $value);
				   if ( ($_SESSION['admin_id']!=1) && ( $_SESSION['source_db'] == "gl" ) )
				   {
					   $sql = "select orders_status_id code, concat(orders_status_name,'-',orders_status_id) description 
					           from orders_status
	                           where orders_status_id <> 3
							   and language_id = " . $order->info['languages_id']  . " order by 1";
				   }
				   else
				   {
					   $sql = "select orders_status_id code, concat(orders_status_name,'-',orders_status_id) description 
					           from orders_status
	                           where language_id = " . $order->info['languages_id']  . " order by 1";
				   }
				   
				   if ( ($_SESSION['admin_id']!=1) && ( $_SESSION['source_db'] == "gl" ) &&  ( $order->info['orders_status']=="3" ) )
				   {
				       echo "Payée";
				   }
				   else
				   {
     				   echo get_select($sql,'status',$order->info['orders_status']);
        			   echo '</td><td>'.zen_image_submit('button_update.gif', IMAGE_UPDATE); 
				   }
				  ?></td>
                  <td valign="top" align="right">&nbsp;
                </tr>
              </table></td>
            </form></tr>
          </table>
		  </td>
          <td align="right" valign="bottom">
		   &nbsp;
		  </td>
<?php } ?>
        </tr></table></td>
      </tr>
<?php
/*
//_TODO move this to its own file after building customer class

      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator(); ?></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
      <tr>
        <?php $admin_notes = get_admin_notes($order->customer['id']); ?>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><strong><?php echo TABLE_HEADING_ADMIN_NOTES . '<span class="alert">' . TEXT_WARN_NOT_VISIBLE . '</span>'; ?></strong></td>
          </tr>
          <?php if ($admin_notes) { ?>
          <tr>
            <td><table border="1" cellspacing="0" cellpadding="5">
              <tr>
                <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_DATE_ADDED; ?></strong></td>
                <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_KARMA; ?></strong></td>
                <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_AUTHOR; ?></strong></td>
                <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_COMMENTS; ?></strong></td>
              </tr>
<?php
    for ($i = 0; $i < sizeof($admin_notes); $i++) {
      $total_karma += $admin_notes[$i]['karma'];
?>
              <tr>
                <td class="smallText" align="center"><?php echo zen_datetime_short($admin_notes[$i]['date']); ?></td>
                <td class="smallText" align="center"><?php echo $admin_notes[$i]['karma']; ?></td>
                <td class="smallText" align="center"><?php echo $admin_notes[$i]['name'] . ' (' . $admin_notes[$i]['email'] . ')'; ?></td>
                <td class="smallText" align="left"><?php echo zen_db_scrub_out($admin_notes[$i]['notes']); ?></td>
              </tr>
<?php
    }
?>
              <tr>
                <td class="main" colspan="4"><?php echo TEXT_TOTAL_KARMA . $total_karma; ?></td>
              </tr>
            </table></td>
          </tr>
          <?php } else { ?>
          <tr>
            <td class="main"><?php echo TEXT_ADMIN_NOTES_NONE; ?></td>
          </tr>
          <?php } ?>
          <tr>
            <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
          </tr>
          <tr>
          <?php echo zen_draw_form('status', FILENAME_SUPER_ORDERS, 'oID=' . $oID . '&action=add_note', 'post', '', true); ?>
          <?php echo zen_draw_hidden_field('cID', $order->customer['id']); ?>
          <?php echo zen_draw_hidden_field('oID', $oID); ?>
            <td><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><strong><?php echo TABLE_HEADING_ADD_NOTES; ?></strong></td>
                <td class="main" align="center"><strong><?php echo TABLE_HEADING_KARMA; ?></strong></td>
              </tr>
              <tr>
                <td><?php echo zen_draw_textarea_field('notes', 'soft', '60', '5'); ?></td>
                <td><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="main" valign="left"><strong><?php echo zen_draw_radio_field('karma', '-1') . 'Poor'; ?></strong></td>
                    <td class="main" valign="center"><strong><?php echo zen_draw_radio_field('karma', '0') . 'Neutral'; ?></strong></td>
                    <td class="main" valign="right"><strong><?php echo zen_draw_radio_field('karma', '1') . 'Good'; ?></strong></td>
                  </tr>
                  <tr>
                    <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '25'); ?></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" valign="bottom"><?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE); ?></td>
                  </tr>
                </table></td>
              </form></tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
*/
// check if order has open gv
        $gv_check = $db->Execute("select order_id, unique_id
                                  from " . TABLE_COUPON_GV_QUEUE ."
                                  where order_id = '" . $_GET['oID'] . "' and release_flag='N' limit 1");
        if ($gv_check->RecordCount() > 0) {
          $goto_gv = '<a href="' . zen_href_link(FILENAME_GV_QUEUE, 'order=' . $_GET['oID']) . '">' . zen_image_button('button_gift_queue.gif',IMAGE_GIFT_QUEUE) . '</a>';
          echo '      <tr><td align="right"><table width="225"><tr>';
          echo '        <td align="center">';
          echo $goto_gv . '&nbsp;&nbsp;';
          echo '        </td>';
          echo '      </tr></table></td></tr>';
        }
?>
<?php
  }

  /*
  ** ORDER LISTING DISPLAY
  */
  else {
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE_ORDERS_LISTING . '&nbsp;&nbsp;' .
              '<INPUT TYPE="BUTTON" VALUE="' . BOX_CUSTOMERS_SUPER_BATCH_STATUS . '" ONCLICK="window.location.href=\'' . zen_href_link(FILENAME_SUPER_BATCH_STATUS, '') . '\'">' .
              '&nbsp;&nbsp;' .
              '<INPUT TYPE="BUTTON" VALUE="' . BOX_CUSTOMERS_SUPER_BATCH_FORMS . '" ONCLICK="window.location.href=\'' . zen_href_link(FILENAME_SUPER_BATCH_FORMS, '') . '\'">';
            ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr><?php echo zen_draw_form('orders', FILENAME_SUPER_ORDERS, '', 'get', '', true); ?>
                <td class="smallText" align="right"><?php echo HEADING_TITLE_SEARCH . ' ' . zen_draw_input_field('oID', '', 'size="12"') . zen_draw_hidden_field('action', 'edit'); ?></td>
              </form></tr>
              <tr><?php echo zen_draw_form('status', FILENAME_SUPER_ORDERS, '', 'get', '', true); ?>
                <td class="smallText" align="right"><?php
                  echo HEADING_TITLE_STATUS . ' ' . zen_draw_pull_down_menu('status', array_merge(array(array('id' => '', 'text' => TEXT_ALL_ORDERS)), $orders_statuses), $_GET['status'], 'onChange="this.form.submit();"');
                ?></td>
              </form></tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
<?php
// Sort Listing
          switch ($_GET['list_order']) {
              case "id-asc":
              $disp_order = "c.customers_id";
              break;
              case "firstname":
              $disp_order = "c.customers_firstname";
              break;
              case "firstname-desc":
              $disp_order = "c.customers_firstname DESC";
              break;
              case "lastname":
              $disp_order = "c.customers_lastname, c.customers_firstname";
              break;
              case "lastname-desc":
              $disp_order = "c.customers_lastname DESC, c.customers_firstname";
              break;
              case "company":
              $disp_order = "a.entry_company";
              break;
              case "company-desc":
              $disp_order = "a.entry_company DESC";
              break;
              default:
              $disp_order = "c.customers_id DESC";
          }
?>
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_ORDERS_ID; ?></td>
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_CUSTOMERS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ORDER_TOTAL; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_DATE_PURCHASED; ?></td>
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_PAYMENT_METHOD; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>

<?php
// create search filter
  $search = '';
  if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
    $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
    $search = " and (o.customers_city like '%" . $keywords . "%' or o.customers_postcode like '%" . $keywords . "%' or o.date_purchased like '%" . $keywords . "%' or o.billing_name like '%" . $keywords . "%' or o.billing_company like '%" . $keywords . "%' or o.billing_street_address like '%" . $keywords . "%' or o.delivery_city like '%" . $keywords . "%' or o.delivery_postcode like '%" . $keywords . "%' or o.delivery_name like '%" . $keywords . "%' or o.delivery_company like '%" . $keywords . "%' or o.delivery_street_address like '%" . $keywords . "%' or o.billing_city like '%" . $keywords . "%' or o.billing_postcode like '%" . $keywords . "%' or o.customers_email_address like '%" . $keywords . "%' or o.customers_name like '%" . $keywords . "%' or o.customers_company like '%" . $keywords . "%' or o.customers_street_address  like '%" . $keywords . "%' or o.customers_telephone like '%" . $keywords . "%' or o.ip_address  like '%" . $keywords . "%')";
  }
  $new_fields = ", o.customers_street_address, o.delivery_name, o.delivery_street_address, o.billing_name, o.billing_street_address, o.payment_module_code, o.shipping_module_code, o.ip_address ";
  if (isset($_GET['cID'])) {
    $cID = zen_db_prepare_input($_GET['cID']);
    $orders_query_raw = "select o.orders_id, o.customers_id, o.customers_name, o.customers_id, o.payment_method, o.shipping_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, ot.text as order_total" . $new_fields . " from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$cID . "' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$_SESSION['languages_id'] . "' and ot.class = 'ot_total' order by orders_id DESC";
  } elseif ($_GET['status'] != '') {
    $status = zen_db_prepare_input($_GET['status']);
    $orders_query_raw = "select o.orders_id, o.customers_id, o.customers_name, o.payment_method, o.shipping_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, ot.text as order_total" . $new_fields . " from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.orders_status = s.orders_status_id and s.language_id = '" . (int)$_SESSION['languages_id'] . "' and s.orders_status_id = '" . (int)$status . "' and ot.class = 'ot_total'  " . $search . " order by o.orders_id DESC";
  } else {
    $orders_query_raw = "select o.orders_id, o.customers_id, o.customers_name, o.payment_method, o.shipping_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, ot.text as order_total" . $new_fields . " from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.orders_status = s.orders_status_id and s.language_id = '" . (int)$_SESSION['languages_id'] . "' and ot.class = 'ot_total'  " . $search . " order by o.orders_id DESC";
  }
  $orders_query_numrows = '';
  $orders_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS_ORDERS, $orders_query_raw, $orders_query_numrows);
  $orders = $db->Execute($orders_query_raw);
  while (!$orders->EOF) {
    if ((!isset($_GET['oID']) || (isset($_GET['oID']) && ($_GET['oID'] == $orders->fields['orders_id']))) && !isset($oInfo)) {
      $oInfo = new objectInfo($orders->fields);
    }

    // format shipping method to remove ()
    $clean_shipping = explode(" (", $oInfo->shipping_method, 2);
    $clean_shipping = rtrim($clean_shipping[0], ":");
    $shipping_method = $clean_shipping;

    if (isset($oInfo) && is_object($oInfo) && ($orders->fields['orders_id'] == $oInfo->orders_id)) {
      echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit', 'NONSSL') . '\'">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $orders->fields['orders_id'], 'NONSSL') . '\'">' . "\n";
    }
    //_TODO add new warning to diff between =! name and =! address
    $show_difference = '';
    if (($orders->fields['delivery_name'] != $orders->fields['billing_name'] and $orders->fields['delivery_name'] != '')) {
      $show_difference = '&nbsp;' . zen_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
    }
    if (($orders->fields['delivery_street_address'] != $orders->fields['billing_street_address'] and $orders->fields['delivery_street_address'] != '')) {
      $show_difference = '&nbsp;' . zen_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
    }
    //$show_payment_type = $orders->fields['payment_module_code'] . '<br />' . $orders->fields['shipping_module_code'];
    //<td class="dataTableContent" align="left" width="50"><?php echo $show_payment_type; </td>

    $close_status = so_close_status($orders->fields['orders_id']);
    if ($close_status) $class = "status-" . $close_status['type'];
    else $class = "dataTableContent";
?>
                <td class="<? echo $class; ?>" align="left"><?php echo $orders->fields['orders_id'] . $show_difference; ?></td>
                <td class="dataTableContent"><?php
                  echo '<a href="' . zen_href_link(FILENAME_CUSTOMERS, 'cID=' . $orders->fields['customers_id'] . '&action=edit', 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_cust_info.gif', MINI_ICON_INFO) . '</a>&nbsp;';
                  echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, 'cID=' . $orders->fields['customers_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_cust_orders.gif', MINI_ICON_ORDERS) . '</a>&nbsp;';
                  echo '<a href="' . zen_href_link(FILENAME_MAIL, 'origin=super_orders.php&mode=NONSSL&selected_box=tools&customer=' . $orders->fields['customers_email_address'] . '&cID=' . (int)$cID, 'NONSSL') . '">' . $orders->fields['customers_name'] . '</a>';
                ?></td>
                <td class="dataTableContent" align="right"><?php echo strip_tags($orders->fields['order_total']); ?></td>
                <td class="dataTableContent" align="center"><?php echo zen_datetime_short($orders->fields['date_purchased']); ?></td>
                <td class="dataTableContent" align="left"><?php echo $orders->fields['payment_method']; ?></td>
                <td class="dataTableContent" align="right"><?php echo $orders->fields['orders_status_name']; ?></td>

                <td class="dataTableContent" align="right"><?php
                  if (isset($oInfo) && is_object($oInfo) && ($orders->fields['orders_id'] == $oInfo->orders_id)) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '');
                  } else {
                    //echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID')) . 'oID=' . $orders->fields['orders_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>';
                    echo '<a href="' . zen_href_link(FILENAME_SUPER_DATA_SHEET, 'oID=' . $orders->fields['orders_id']) . '" target="_blank">' . zen_image(DIR_WS_IMAGES . 'icon_print.gif', ICON_ORDER_PRINT) . '</a>&nbsp;';
                    echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, 'oID=' . $orders->fields['orders_id'] . '&action=edit', 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_details.gif', ICON_ORDER_DETAILS) . '</a>&nbsp';
                    echo '<a href="' . zen_href_link(FILENAME_SUPER_INVOICE, 'oID=' . $orders->fields['orders_id']) . '" TARGET="_blank">' . zen_image(DIR_WS_IMAGES . 'icon_invoice.gif', ICON_ORDER_INVOICE) . '</a>&nbsp;';
                    echo '<a href="' . zen_href_link(FILENAME_SUPER_PACKINGSLIP, 'oID=' . $orders->fields['orders_id']) . '" TARGET="_blank">' . zen_image(DIR_WS_IMAGES . 'icon_packingslip.gif', ICON_ORDER_PACKINGSLIP) . '</a>&nbsp;';
                    echo '<a href="' . zen_href_link(FILENAME_SUPER_SHIPPING_LABEL, 'oID=' . $orders->fields['orders_id']) . '" TARGET="_blank">' . zen_image(DIR_WS_IMAGES . 'icon_shipping_label.gif', ICON_ORDER_SHIPPING_LABEL) . '</a>&nbsp;';
                    echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, 'oID=' . $orders->fields['orders_id'] . '&action=delete', 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_delete2.gif', ICON_ORDER_DELETE) . '</a>';
                  }
                ?>&nbsp;</td>
              </tr>
<?php
      $orders->MoveNext();
    }
?>
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $orders_split->display_count($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_ORDERS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_ORDERS); ?></td>
                    <td class="smallText" align="right"><?php echo $orders_split->display_links($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_ORDERS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], zen_get_all_get_params(array('page', 'oID', 'action'))); ?></td>
                  </tr>
<?php
  if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
?>
                  <tr>
                    <td class="smallText" align="right" colspan="2">
                      <?php
                        echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, '', 'NONSSL') . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>';
                        if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
                          $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
                          echo '<br/ >' . TEXT_INFO_SEARCH_DETAIL_FILTER . $keywords;
                        }
                      ?>
                    </td>
                  </tr>
<?php
  }
?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'delete':
      $heading[] = array('text' => '<strong>' . TEXT_INFO_HEADING_DELETE_ORDER . $oInfo->orders_id . '</strong>');

      $contents = array('form' => zen_draw_form('orders', FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=deleteconfirm', 'post', '', true));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO . '<br /><br /><strong>' . ENTRY_ORDER_ID . $oInfo->orders_id . '<br />' . $oInfo->order_total . '<br />' . $oInfo->customers_name . '</strong>');
      $contents[] = array('text' => '<br />' . zen_draw_checkbox_field('restock') . ' ' . TEXT_INFO_RESTOCK_PRODUCT_QUANTITY);
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id, 'NONSSL') . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (isset($oInfo) && is_object($oInfo)) {
        $heading[] = array('text' => '<strong>[' . $oInfo->orders_id . ']&nbsp;&nbsp;' . zen_datetime_short($oInfo->date_purchased) . '</strong>');
//        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit', 'NONSSL') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=delete', 'NONSSL') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
//        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ORDERS_INVOICE, 'oID=' . $oInfo->orders_id) . '" TARGET="_blank">' . zen_image_button('button_invoice.gif', IMAGE_ORDERS_INVOICE) . '</a> <a href="' . zen_href_link(FILENAME_ORDERS_PACKINGSLIP, 'oID=' . $oInfo->orders_id) . '" TARGET="_blank">' . zen_image_button('button_packingslip.gif', IMAGE_ORDERS_PACKINGSLIP) . '</a>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit', 'NONSSL') . '">' . zen_image_button('button_details.gif', IMAGE_EDIT) . '</a>&nbsp;<a href="' . zen_href_link(FILENAME_SUPER_SHIPPING_LABEL, 'oID=' . $oInfo->orders_id) . '" TARGET="_blank">' . zen_image_button('button_shippinglabel.gif', IMAGE_SHIPPING_LABEL) . '</a>');
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_SUPER_INVOICE, 'oID=' . $oInfo->orders_id) . '" TARGET="_blank">' . zen_image_button('button_invoice.gif', IMAGE_ORDERS_INVOICE) . '</a> <a href="' . zen_href_link(FILENAME_SUPER_PACKINGSLIP, 'oID=' . $oInfo->orders_id) . '" TARGET="_blank">' . zen_image_button('button_packingslip.gif', IMAGE_ORDERS_PACKINGSLIP) . '</a>');
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_SUPER_DATA_SHEET, 'oID=' . $oInfo->orders_id) . '" target="_blank">' . zen_image_button('btn_print.gif', ICON_ORDER_PRINT) . '</a>&nbsp;<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=delete', 'NONSSL') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br />' . TEXT_DATE_ORDER_CREATED . ' ' . zen_date_short($oInfo->date_purchased));
        if (zen_not_null($oInfo->last_modified)) $contents[] = array('text' => TEXT_DATE_ORDER_LAST_MODIFIED . ' ' . zen_date_short($oInfo->last_modified));
        $contents[] = array('text' => '<br />' . TEXT_INFO_PAYMENT_METHOD . ' '  . $oInfo->payment_method);
        $contents[] = array('text' => TEXT_INFO_SHIPPING_METHOD . ' '  . $shipping_method);
        $contents[] = array('text' => TEXT_INFO_IP_ADDRESS . ' ' . $oInfo->ip_address);

// check if order has open gv
        $gv_check = $db->Execute("select order_id, unique_id
                                  from " . TABLE_COUPON_GV_QUEUE ."
                                  where order_id = '" . $oInfo->orders_id . "' and release_flag='N' limit 1");
        if ($gv_check->RecordCount() > 0) {
          $goto_gv = '<a href="' . zen_href_link(FILENAME_GV_QUEUE, 'order=' . $oInfo->orders_id) . '">' . zen_image_button('button_gift_queue.gif',IMAGE_GIFT_QUEUE) . '</a>';
          $contents[] = array('text' => '<br />' . zen_image(DIR_WS_IMAGES . 'pixel_black.gif','','100%','3'));
          $contents[] = array('align' => 'center', 'text' => $goto_gv);
        }
      }

// indicate if comments exist
      $orders_history_query = $db->Execute("select orders_status_id, date_added, customer_notified, comments from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '" . $oInfo->orders_id . "' and comments like '#%' and comments !='" . "'" );
      if ($orders_history_query->number_of_rows > 0) {
        $contents[] = array('align' => 'left', 'text' => '<br />' . TABLE_HEADING_COMMENTS);
      }

      $contents[] = array('text' => '<br />' . zen_image(DIR_WS_IMAGES . 'pixel_black.gif','','100%','3'));
      $order = new order($oInfo->orders_id);
      $contents[] = array('text' => 'Products Ordered: ' . sizeof($order->products) );
      for ($i=0; $i<sizeof($order->products); $i++) {
        $contents[] = array('text' => $order->products[$i]['qty'] . '&nbsp;x&nbsp;' . $order->products[$i]['name']);

        if (sizeof($order->products[$i]['attributes']) > 0) {
          for ($j=0; $j<sizeof($order->products[$i]['attributes']); $j++) {
            $contents[] = array('text' => '&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'] . '</i></nobr>' );
          }
        }
        if ($i > MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING and MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING != 0) {
          $contents[] = array('align' => 'left', 'text' => TEXT_MORE);
          break;
        }
      }

      if (sizeof($order->products) > 0) {
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit', 'NONSSL') . '">' . zen_image_button('button_details.gif', IMAGE_EDIT) . '</a>');
      }
      break;
  }

  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
?>
            <td width="25%" valign="top"><table border="0" cellspacing="0" cellpadding="0" width="100%" valign="top">
              <tr>
                <td colspan="2" valign="top">
<?php
    $box = new box;
    echo $box->infoBox($heading, $contents);
?>
                </td>
              </tr>
              <!-- SHORTCUT ICON LEGEND BOF-->
              <tr>
                <td><table border="0" cellspacing="0" cellpadding="2" width="100%" valign="top">
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="smallText" colspan="2"><strong><?php echo TEXT_ICON_LEGEND; ?></strong><br />&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10); ?></td>
                    <td class="smallText"><?php echo TEXT_BILLING_SHIPPING_MISMATCH; ?></td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_cust_info.gif', MINI_ICON_INFO); ?></td>
                    <td class="smallText"><?php echo MINI_ICON_INFO; ?></td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_cust_orders.gif', MINI_ICON_ORDERS); ?></td>
                    <td class="smallText"><?php echo MINI_ICON_ORDERS; ?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><?php echo zen_draw_separator('pixel_black.gif'); ?></td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_print.gif', ICON_ORDER_PRINT); ?></td>
                    <td class="smallText"><?php echo ICON_ORDER_PRINT; ?></td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_details.gif', ICON_ORDER_DETAILS); ?></td>
                    <td class="smallText"><?php echo ICON_ORDER_DETAILS; ?></td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_invoice.gif', ICON_ORDER_INVOICE); ?></td>
                    <td class="smallText"><?php echo ICON_ORDER_INVOICE; ?></td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_packingslip.gif', ICON_ORDER_PACKINGSLIP); ?></td>
                    <td class="smallText"><?php echo ICON_ORDER_PACKINGSLIP; ?></td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_shipping_label.gif', ICON_ORDER_SHIPPING_LABEL); ?></td>
                    <td class="smallText"><?php echo ICON_ORDER_SHIPPING_LABEL; ?></td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_delete2.gif', ICON_ORDER_DELETE); ?></td>
                    <td class="smallText"><?php echo ICON_ORDER_DELETE; ?></td>
                  </tr>
                </table></td>
              </tr>
              <!-- SHORTCUT ICON LEGEND EOF -->
            </table></td>
<?php
  }  // END if ( (zen_not_null($heading)) && (zen_not_null($contents)) )
?>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>