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
//  DESCRIPTION:   Generates a pop-up window to edit    //
//  the selected order information, broken into         //
//  sections: contact, product, history, and total.     //
//  payment_mode //
//////////////////////////////////////////////////////////
// $Id: super_edit.php 27 2006-02-03 20:06:12Z BlindSide $
*/

  //_TODO merge orders code
  // 1. Set orders_id in `orders_products`
  //                     `orders_products_attributes`
  //                     `orders_products_download`
  //                     `orders_status_history` (mark w/ original order #)
  // 2. Add a new "merged" status entry
  // 3. Recalc order total
  // 4. Remove merged order's entry in `orders` table

  // SO_TODO change payment method of an order

  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'order.php');
  require('el_fonctions_gestion.php');
  
  require(DIR_WS_CLASSES . 'super_order.php');
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
 
  
  global $db;  

if  (  (strlen( $_SESSION['source_db'] )>0) &&  ( $_SESSION['source_db'] != 'gl' ) )
{
   $db->connect($ext_db_server[$_SESSION['source_db']], $ext_db_username[$_SESSION['source_db']], $ext_db_password[$_SESSION['source_db']], $ext_db_database[$_SESSION['source_db']], USE_PCONNECT, false);
}
  
  // temporaire
  if (  ( strlen($_GET['cgt'])==0 )
        && ( strlen($_GET['payment_conditions_desc'])>0 
          || strlen($_GET['payment_method'])>0 ) 
	  )
	{
//echo 	$_GET['validation_statut'];exit;
	    if ( $_GET['validation_statut']==1 )
		{
		    $dml = "update orders set orders_status  = 3
					where  orders_status  = 2
					and orders_id = '" . $_GET['oID'] . "'";
//echo $dml;exit;
			$db->Execute($dml);					 		    
		}
		if (  strlen ( $_GET['orders_date_finished'] ) == 0 )
		{
		   $orders_date_finished = 'NULL';// el_format_bd('0000-00-00 00:00:00');
		   echo 'a';
		}  
		else
		{
			$orders_date_finished=el_format_bd($_GET['orders_date_finished']);
		}

		if (  strlen ( $_GET['orders_date_finished2'] ) == 0 )
		{
		   $orders_date_finished2 = 'NULL';// el_format_bd('0000-00-00 00:00:00');
		   echo 'a';
		}  
		else
		{
			$orders_date_finished2=el_format_bd($_GET['orders_date_finished2']);
		}
		
		
//		echo  strlen( $_GET['payment_info'] ) ;exit;
		if ( strlen( $_GET['payment_info'] )  > 0 )
        {		
			if ( ($orders_date_finished=='0000-00-00 00:00:00') 
                 || (strlen($orders_date_finished)==0)
				 || ($orders_date_finished=='NULL')			)
			   $orders_date_finished = exec_select ( "select now()  value" );
        }		
        $payment_amount = $_GET['payment_amount'];
		
		if ( strlen( $_GET['payment_info'] )  > 0 )
        {		
			if ($payment_amount==0)
			{
			   $payment_amount = exec_select ( "select order_total*currency_value value from orders where orders_id = " . $_GET['oID'] );
			}
        }		
		
	    $dml = "update orders set payment_method  = '" . $_GET['payment_method'] . "' , 
		                          payment_info  = '" . $_GET['payment_info'] . "' , 
								  orders_date_finished = '" . $orders_date_finished . "' , 
								  payment_amount = '" . $payment_amount . "' , 								  
		                          payment_info2  = '" . $_GET['payment_info2'] . "' , 
								  orders_date_finished2 = '" . $orders_date_finished2 . "' , 
								  payment_amount2 = '". $_GET['payment_amount2']. "' , 								  								  
             	                  payment_conditions_desc =  '" . $_GET['payment_conditions_desc'] . "' ,
								  last_modified = now()
								 where orders_id = '" . $_GET['oID'] . "'";
	
	
//echo  el_format_bd($_GET['orders_date_finished']);exit;
//echo $dml;exit;
								 $db->Execute($dml);					 
								 
	// force le refresh éventuel de la table
	if ($_SERVER['SERVER_NAME']=="127.0.0.1")
	  $radical="http://127.0.0.1/sites/";
	else
	  $radical="http://linats.net/admin/";
	  
	include($radical.'replication_base_commande.php');
	echo '
		<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
		<html>
		<head>
		<title><?php echo REDIRECT; ?></title>
		<script language="JavaScript" type="text/javascript">
		  <!--
		  function returnParent() {
		    window.opener.location.reload(true);
		    window.opener.focus();
		    self.close();
		  }
		  //-->
		</script>
		</head>
		<!-- header_eof //-->
		<body onload="returnParent()">
		</body>
		</html>';
	exit;
	}
  

  
  $target = $_REQUEST['target'];  // 'contact', 'product', 'history', or 'total'
  $oID = (int)$_REQUEST['oID'];
  $order = new order($oID);

  // recreate the $order->products array, adding in some extra fields
  $index = 0;
  $orders_products = $db->Execute("select orders_products_id, products_name, products_model,
                                          products_price, products_tax, products_quantity,
                                          final_price, onetime_charges,
                                          product_is_free, products_id
                                   from " . TABLE_ORDERS_PRODUCTS . "
                                   where orders_id = '" . $oID . "'");

  while (!$orders_products->EOF) {
    // convert quantity to proper decimals - account history
    if (QUANTITY_DECIMALS != 0) {
      $fix_qty = $orders_products->fields['products_quantity'];
      switch (true) {
        case (!strstr($fix_qty, '.')):
          $new_qty = $fix_qty;
        break;
        default:
          $new_qty = preg_replace('/[0]+$/', '', $orders_products->fields['products_quantity']);
        break;
      }
    } else {
      $new_qty = $orders_products->fields['products_quantity'];
    }

    $new_qty = round($new_qty, QUANTITY_DECIMALS);

    if ($new_qty == (int)$new_qty) {
      $new_qty = (int)$new_qty;
    }

    $order->products[$index] = array('qty' => $new_qty,
                                     'name' => $orders_products->fields['products_name'],
                                     'products_id' => $orders_products->fields['products_id'],
                                     'model' => $orders_products->fields['products_model'],
                                     'tax' => $orders_products->fields['products_tax'],
                                     'price' => $orders_products->fields['products_price'],
                                     'onetime_charges' => $orders_products->fields['onetime_charges'],
                                     'final_price' => $orders_products->fields['final_price'],
                                     'product_is_free' => $orders_products->fields['product_is_free'],
                                     'orders_products_id' => $orders_products->fields['orders_products_id']);

    $subindex = 0;
    $attributes = $db->Execute("select products_options, products_options_values, options_values_price,
                                       price_prefix,
                                       product_attribute_is_free
                                from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . "
                                where orders_id = '" . $oID . "'
                                and orders_products_id = '" . (int)$orders_products->fields['orders_products_id'] . "'");
    if ($attributes->RecordCount()>0) {
      while (!$attributes->EOF) {
        $order->products[$index]['attributes'][$subindex] = array('option' => $attributes->fields['products_options'],
                                                                  'value' => $attributes->fields['products_options_values'],
                                                                  'prefix' => $attributes->fields['price_prefix'],
                                                                  'price' => $attributes->fields['options_values_price'],
                                                                  'product_attribute_is_free' => $attributes->fields['product_attribute_is_free']);

        $subindex++;
        $attributes->MoveNext();
      }
    }

    $index++;
    $orders_products->MoveNext();
  }  // END while (!$orders_products->EOF) {


  if ($_POST['process'] == 1) {
    $update = array();
    switch ($target) {
	  case 'edit_invoice':	      
	  
	      if ( $_POST['suppress_invoice'] )
		  {
		     if  ( strlen( $_POST['invoice_type'] ) > 0  )
			 {
			     $dml = "update orders_invoices 
				         set order_total = 0 , 
						     orders_id = 0
						 where invoice_type='" . $_POST['invoice_type'] . "' 
						 and orders_invoices_id=".$_POST['invoice_id'];
				 $db->Execute($dml);
             }			 
			 delete_order( $_POST['oID'] );
		  }
		  else if ( $_POST['regen_po'] )
		  {
				// force le refresh éventuel de la table
				if ($_SERVER['SERVER_NAME']=="127.0.0.1")
				  $radical="http://127.0.0.1/sites/zencart_gl/admin/";
				else
				  $radical="http://linats.net/admin/";
				  
				include($radical.'replication_base_commande.php?oId='.$_POST['oID'].'&enforce=1');
				echo '
					<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
					<html>
					<head>
					<title><?php echo REDIRECT; ?></title>
					<script language="JavaScript" type="text/javascript">
					  <!--
					  function returnParent() {
						window.opener.location.reload(true);
						window.opener.focus();
						self.close();
					  }
					  //-->
					</script>
					</head>
					<!-- header_eof //-->
					<body onload="returnParent()">
					</body>
					</html>';
				exit;
		      
		  }		  
		  else
		  {
	          $dml = "update orders_invoices 
				         set invoice_date = '" . $_POST['invoice_date'] . "' ,
				         orders_invoices_id_comment = '" . addslashes($_POST['orders_invoices_id_comment']) . "' 						 
						 where invoice_type='" . $_POST['invoice_type'] . "' 
						 and orders_invoices_id=".$_POST['invoice_id'];
						 
			  $db->Execute($dml);	

			  $dml = "update orders set last_modified = now() where orders_id =" . $oID;
			  $db->Execute($dml);
			  
		  }
	  break;

	  case 'margin':	      
	     $margin = $_POST['products_quantity'] * ( $_POST['final_price']-($_POST['unit_order_price']/$_POST['usd_euro_rate'] ) );
	     $dml = "update orders_products 
	             set unit_order_price = ".$_POST['unit_order_price'].",
	                 usd_euro_rate = ". $_POST['usd_euro_rate'].",
	                 margin = ".$margin."
				 where orders_products_id = ".$_POST['opID'];
				 
	     $db->Execute($dml);
	     	  
	  break;	  
	  
	  case 'ecc':	      
//	     $margin = $_POST['products_quantity'] * ( $_POST['final_price']-($_POST['unit_order_price']/$_POST['usd_euro_rate'] ) );
         if ($_POST['supply_on_stock']==1)
		    $supply_on_stock=1;
		 else
		    $supply_on_stock=0;
		 
	     $dml = "update orders_products 
	             set supply_on_stock = ".$supply_on_stock.",
	                 supplier_short_name = '". $_POST['supplier_short_name']."',
	                 compatible_lamp_code = '". $_POST['compatible_lamp_code']."',					 
	                 unit_order_price = '". $_POST['unit_order_price']."'
				 where orders_products_id = ".$_POST['opID'];
				 
	     $db->Execute($dml);
	     	  
	  break;	  
	  
	  case 'clone_invoice':
	      if ( strlen($_POST['target_type'])>0 )
		  {
		      // clonage de la pieve 
			  //clonage_order ( $p_old_order_id, $p_old_db, $p_new_db, $p_customer_database_code , $p_new_customers_id, $p_new_languages_id, $p_new_status )
			  if (  $_POST['target_type']=="BL" )
			     $new_status = 5;			     
			  else if ( $_POST['target_type']=="CM" )
			     $new_status = 1;			     
			  else 
			     $new_status = 2;
			    
		      $new_id = clonage_order ( $_POST['oID'], $_SESSION['source_db'], $_SESSION['source_db'], '', 0, 0, $new_status );
			  
    		  //  insertion d'un commentaire
/*			  
		     $dml = "insert into orders_status_history  ( orders_id, date_added, comments )
                     values ( ". $new_id .", now(), '". 'SRC:'.$_POST['invoice_type'].'-'. $_POST['invoice_id'] ."' )";
			 $db->Execute($dml);
  */            			 
             // commentaire automatique 
			 $orders_invoices_id_comment = "";
			 if ( ( $_POST['target_type']=="CR" ) || ( $_POST['target_type']=="DB" ) )
			 {
				$sql = "select invoice_type, orders_invoices_id,orders_invoices_id_comment,date_format(invoice_date,\"%Y-%c-%d\") dt  from orders_invoices where orders_id = " . $oID;				  $check_piece = $db->Execute( $sql );
                $rs = $db->Execute($sql);
				
				$source_type = $rs->fields['invoice_type'];
				$orders_invoices_id = $rs->fields['orders_invoices_id'];
				
				if ( ($source_type=="DB") && ($_POST['target_type']=="CR") )
				{
	
				   $ON_INVOICE[2] = "sur facture ";
				   $ON_INVOICE[3] = "sobre factura ";
				   $ON_INVOICE[4] = "auf Rechnung ";
				   $ON_INVOICE[5] = "on invoice ";
				   $ON_INVOICE[6] = "su fattura ";
				   $ON_INVOICE[7] = " do faktury ";
				   
				   $orders_invoices_id_comment = $ON_INVOICE[$order->info['languages_id']].' INT'.$orders_invoices_id;
				}
				
				if ( ($source_type=="BL") && ($_POST['target_type']=="DB") )
				{				
				   $ON_BL[2] = "- Bon de livraison ";
				   $ON_BL[3] = "- Orden de expedicion ";
				   $ON_BL[4] = "- Lieferschein ";
				   $ON_BL[5] = "- Packing  List ";
				   $ON_BL[6] = "- Bulla di accompagnamento ";				

				   $orders_invoices_id_comment = $ON_BL[$order->info['languages_id']].$orders_invoices_id;
				}
				   
			 }
			 
             // création du numéro de  facture 			 
			 if ( $_POST['target_type'] != 'CM' )
			 {
	             $invoice_id = get_invoice_id ( $new_id , $_POST['target_type'] , 1, $_POST['oID'] , $orders_invoices_id_comment );

	             update_standard_comment ($new_id);
			 }
			 $_SESSION['new_oID']=$new_id;

		  }		  	  
	  break;
      case 'add_customer_products':
	         
	    foreach ((array)$_POST['select_items'] as $k => $v ) {
	
        $db->connect($ext_db_server[$order->info['database_code']], $ext_db_username[$order->info['database_code']], $ext_db_password[$order->info['database_code']], $ext_db_database[$order->info['database_code']], USE_PCONNECT, false);		 
		
        $sql = "select * from orders_products where orders_products_id = " . $v;
		
        $op = $db->Execute( $sql );
	
			 $dml = "INSERT INTO orders_products 
					( orders_id , products_id , products_model ,
					  products_name ,  final_price , products_tax ,
					  products_quantity , products_prid, ref_info,
					  reliquat )
					VALUES 
					 ( '". $oID . "',-1,'". $op->fields['products_model'] . "',
                       '". $op->fields['products_name'] . "','". $op->fields['final_price'] . "','". $op->fields['products_tax'] . "',
					   '". $op->fields['products_quantity'] . "',-1,'',
					   0)";


              $db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);		 				 
          	  $db->Execute($dml);
			  
			  
	    }

    	recalc_total($oID);
//		echo $_POST['select_items[0]'].',';
//		echo $_POST['select_items[1]'].',';
//		exit;
        
        break;
		
      case 'add_delivered_products':
	         
	    foreach ((array)$_POST['select_items'] as $k => $v ) {
	
 //       $db->connect($ext_db_server[$order->info['database_code']], $ext_db_username[$order->info['database_code']], $ext_db_password[$order->info['database_code']], $ext_db_database[$order->info['database_code']], USE_PCONNECT, false);		 
		
        $sql = "select * from orders_products where orders_products_id = " . $v;
		
        $op = $db->Execute( $sql );
	
			 $dml = "INSERT INTO orders_products 
					( orders_id , products_id , products_model ,
					  products_name ,  final_price , products_tax ,
					  products_quantity , products_prid, ref_info,
					  reliquat )
					VALUES 
					 ( '". $oID . "',-1,'". $op->fields['products_model'] . "',
                       '". $op->fields['products_name'] . "','". $op->fields['final_price'] . "','". $op->fields['products_tax'] . "',
					   '". $op->fields['products_quantity'] . "',-1,'". $op->fields['orders_id'] . "',
					   0)";


   //           $db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);		 				 
          	  $db->Execute($dml);
			  
			  
	    }

    	recalc_total($oID);
//		echo $_POST['select_items[0]'].',';
//		echo $_POST['select_items[1]'].',';
//		exit;
        
        break;
	  	  
      case 'edit_product':
	  
		  $final_price = $_POST['final_price'];
		  if ( $order->info['currency'] != 'EUR' )
		  {
		     $final_price = $final_price / $order->info['currency_value'];
		  }

          if ( $_POST['orders_products_id']>0 )	 
		  { 
		   $products_quantity = $op_qry->fields['products_quantity'];
		   $products_model = $op_qry->fields['products_model'];
		   $products_name = $op_qry->fields['products_name'];

		   $sort_order = $op_qry->fields['sort_order'];
		   $reliquat = $op_qry->fields['reliquat'];
           if ( $_POST['products_quantity'] == 0 )
		   {
		     $dml = "delete from orders_products where orders_products_id = " . $_POST['orders_products_id'];
	       }
		   else
		   {
			 $dml = "update  orders_products 
			         set products_quantity = '". $_POST['products_quantity'] . "',
					     products_model  = '". $_POST['products_model'] . "',
						 products_name  = '". $_POST['products_name'] . "',
						 sort_order  = '". $_POST['sort_order'] . "',						 
						 reliquat  = '". $_POST['reliquat'] . "',						 						 
						 final_price  = '". $final_price . "'
					  where orders_products_id = " . $_POST['orders_products_id'];
					  
			}
			 $db->Execute($dml);					 
		   
		  }
		  else
		  { 
		     // c'est une création
			 // récupération des variables
			 $tax_rate = $order->info['products_tax'];

             // dummy_product 
			 $dummy_product = -1;
			 
			 // ordre d'insertion
			 $dml = "INSERT INTO orders_products 
					( orders_id , products_id , products_model ,
					  products_name ,  final_price , products_tax ,
					  products_quantity , products_prid, sort_order,
					  reliquat )
					VALUES 
					 ( '". $oID . "','". $dummy_product . "','". $_POST['products_model'] . "',
                       '". $_POST['products_name'] . "','". $final_price . "','". $tax_rate . "',
					   '". $_POST['products_quantity'] . "','". $dummy_product . "','". $sort_order . "',
					   '". $_POST['reliquat'] . "')";
          	  $db->Execute($dml);					 
		  }
		 
         recalc_total($oID);
		  
//echo 	$_POST['orders_products_id'];exit;
        break;	  	

      case 'payment_mode':
	    $dml = "update orders set payment_method  = '" . $_POST['payment_method'] . "' , 
             	                 payment_conditions_desc =  '" . $_POST['payment_conditions_desc'] . "' 
								 where orders_id = '" . $oID . "'";

								 $db->Execute($dml);					 
	  
/*	  
	    $dml = "update orders set payment_method  = '" . _$POST['payment_method'] . "' , 
             	                 payment_module_code =  '" . _$POST['payment_module_code'] . "' 
								 where orders_id = '" . $oID . "'";
*/
//        $db->Execute($dml);
        break;	  	
      case 'contact':

        // customer address data
        if ($_POST['customers_name'] != $order->customer['name']) {
          $update['customers_name'] = zen_db_scrub_in($_POST['customers_name'], true);
        }
        if ($_POST['customers_company'] != $order->customer['company']) {
          $update['customers_company'] = zen_db_scrub_in($_POST['customers_company'], true);
        }
        if ($_POST['customers_street_address'] != $order->customer['street_address']) {
          $update['customers_street_address'] = zen_db_scrub_in($_POST['customers_street_address'], true);
        }
        if ($_POST['customers_suburb'] != $order->customer['suburb']) {
          $update['customers_suburb'] = zen_db_scrub_in($_POST['customers_suburb'], true);
        }
        if ($_POST['customers_city'] != $order->customer['city']) {
          $update['customers_city'] = zen_db_scrub_in($_POST['customers_city'], true);
        }
        if ($_POST['customers_postcode'] != $order->customer['postcode']) {
          $update['customers_postcode'] = zen_db_scrub_in($_POST['customers_postcode'], true);
        }
        if ($_POST['customers_state'] != $order->customer['state']) {
          $update['customers_state'] = zen_db_scrub_in($_POST['customers_state'], true);
        }
        if ($_POST['customers_country'] != $order->customer['country']) {
          $update['customers_country'] = zen_db_scrub_in($_POST['customers_country'], true);
        }
        if ( strlen($_POST['address_book_id'])>0 )
		{
        // delivery address data

           $db->connect($ext_db_server[$order->info['database_code']], $ext_db_username[$order->info['database_code']], $ext_db_password[$order->info['database_code']], $ext_db_database[$order->info['database_code']], USE_PCONNECT, false);

			$sql = "select ab.*, countries.countries_name
	                  from address_book ab, countries
	                  where  entry_country_id = countries_id  
                      and  address_book_id =" . $_POST['address_book_id'];	

    		  $recordSet = $db->Execute($sql);
 			  
			  $update['delivery_name'] = $recordSet->fields['entry_lastname'] . ' ' . $recordSet->fields['entry_firstname'];
			  $update['delivery_company'] = $recordSet->fields['entry_company'];
			  $update['delivery_street_address'] = $recordSet->fields['entry_street_address'];
			  $update['delivery_suburb'] = $recordSet->fields['entry_suburb'];
			  $update['delivery_city'] = $recordSet->fields['entry_city'];
			  $update['delivery_postcode'] = $recordSet->fields['entry_postcode'];
			  $update['delivery_state'] = $recordSet->fields['entry_state'];
			  $update['delivery_country'] = $recordSet->fields['countries_name'];

              $db->connect($ext_db_server[$_SESSION['source_db']], $ext_db_username[$_SESSION['source_db']], $ext_db_password[$_SESSION['source_db']], $ext_db_database[$_SESSION['source_db']], USE_PCONNECT, false);					  
			 			 
        }
		else
		{
	        if ($_POST['delivery_name'] != $order->delivery['name']) {
	          $update['delivery_name'] = zen_db_scrub_in($_POST['delivery_name'], true);
	        }
	        if ($_POST['delivery_company'] != $order->delivery['company']) {
	          $update['delivery_company'] = zen_db_scrub_in($_POST['delivery_company'], true);
	        }
	        if ($_POST['delivery_street_address'] != $order->delivery['street_address']) {
	          $update['delivery_street_address'] = zen_db_scrub_in($_POST['delivery_street_address'], true);
	        }
	        if ($_POST['delivery_suburb'] != $order->delivery['suburb']) {
	          $update['delivery_suburb'] = zen_db_scrub_in($_POST['delivery_suburb'], true);
	        }
	        if ($_POST['delivery_city'] != $order->delivery['city']) {
	          $update['delivery_city'] = zen_db_scrub_in($_POST['delivery_city'], true);
	        }
	        if ($_POST['delivery_postcode'] != $order->delivery['postcode']) {
	          $update['delivery_postcode'] = zen_db_scrub_in($_POST['delivery_postcode'], true);
	        }
	        if ($_POST['delivery_state'] != $order->delivery['state']) {
	          $update['delivery_state'] = zen_db_scrub_in($_POST['delivery_state'], true);
	        }
	        if ($_POST['delivery_country'] != $order->delivery['country']) {
	          $update['delivery_country'] = zen_db_scrub_in($_POST['delivery_country'], true);
	        }
		     
		}
        // billing address data
        if ($_POST['billing_name'] != $order->billing['name']) {
          $update['billing_name'] = zen_db_scrub_in($_POST['billing_name'], true);
        }
        if ($_POST['billing_company'] != $order->billing['company']) {
          $update['billing_company'] = zen_db_scrub_in($_POST['billing_company'], true);
        }
        if ($_POST['billing_street_address'] != $order->billing['street_address']) {
          $update['billing_street_address'] = zen_db_scrub_in($_POST['billing_street_address'], true);
        }
        if ($_POST['billing_suburb'] != $order->billing['suburb']) {
          $update['billing_suburb'] = zen_db_scrub_in($_POST['billing_suburb'], true);
        }
        if ($_POST['billing_city'] != $order->billing['city']) {
          $update['billing_city'] = zen_db_scrub_in($_POST['billing_city'], true);
        }
        if ($_POST['billing_postcode'] != $order->billing['postcode']) {
          $update['billing_postcode'] = zen_db_scrub_in($_POST['billing_postcode'], true);
        }
        if ($_POST['billing_state'] != $order->billing['state']) {
          $update['billing_state'] = zen_db_scrub_in($_POST['billing_state'], true);
        }
        if ($_POST['billing_country'] != $order->billing['country']) {
          $update['billing_country'] = zen_db_scrub_in($_POST['billing_country'], true);
        }

        // personal contact data
        if ($_POST['customers_telephone'] != $order->customer['telephone']) {
          $update['customers_telephone'] = zen_db_scrub_in($_POST['customers_telephone'], true);
        }
		
        if ($_POST['entry_tva_intracom'] != $order->customer['entry_tva_intracom']) {
          $update['entry_tva_intracom'] = zen_db_scrub_in($_POST['entry_tva_intracom'], true);
        }
        if ($_POST['products_tax'] != $order->info['products_tax']) {
		  // if ( $order->info['products_tax'] != 0 )
          $update['products_tax'] = zen_db_scrub_in($_POST['products_tax'], true);
		  // on modifie le taux des  produits
		  $dml =  "update orders_products set products_tax=".$_POST['products_tax']." where orders_id = ".$oID;
		  $db->Execute($dml);
		  // au besoin ajout ou suppression de la ligne 'dont TVA'
		  
		  $sql = "select 1  value from orders_total where class = 'ot_tax' and orders_id = ".$oID;
		  $check = exec_select($sql);
		  if  ( ($check==1)&& ( $_POST['products_tax']==0) )
		  {
		     $dml = "delete from orders_total where class = 'ot_tax' and orders_id =  ".$oID;
			 $db->Execute($dml);
		  }
		  if  ( ($check!=1)&& ( $_POST['products_tax']>0) )
		  {
		     $dml = "insert into orders_total ( orders_id, title, class, sort_order ) values ( ".$oID." ,'Included VAT/TVA Incluse' ,  'ot_tax', 300 ) ";
			 $db->Execute($dml);
		  }
		  
		  //if ( ($check)&& ( $_POST['products_tax']==0) )
		  recalc_total($oID);
        }
        if ($_POST['currency_value'] != $order->info['currency_value']) {
          $update['currency_value'] = zen_db_scrub_in($_POST['currency_value'], true);
        }		
        if ($_POST['ref_info'] != $order->info['ref_info']) {
          $update['ref_info'] = zen_db_scrub_in($_POST['ref_info'], true);
        }
        if ($_POST['currency_change'] != $order->info['currency']) {
          $update['currency'] = zen_db_scrub_in($_POST['currency_change'], true);
        }
		
        if ($_POST['customers_email_address'] != $order->customer['email_address']) {
          $update['customers_email_address'] = zen_db_scrub_in($_POST['customers_email_address'], true);
        }
        if ($_POST['date_purchased'] != $order->info['date_purchased']) 
		{
          $update['date_purchased'] = zen_db_scrub_in($_POST['date_purchased'], true);
        }
        if ($_POST['languages_id'] != $order->info['languages_id']) 
		{
          $update['languages_id'] = zen_db_scrub_in($_POST['languages_id'], true);
        }
        // targetted customer
        if ($_POST['change_customer'] == 'on' && $_POST['customers_id'] != $order->customer['id']) {
          //$update['customers_id'] = $_POST['customers_id'];
        }

        // confirm that there are changes to make to avoid a SQL error
        if (sizeof($update) >= 1) {
          zen_db_perform(TABLE_ORDERS, $update, 'update', "orders_id = '" . $oID . "'");
        }
	  $dml = "update orders set last_modified = now() where orders_id =" . $oID;
	  $db->Execute($dml);
		if ($_SERVER['SERVER_NAME']=="127.0.0.1")
		  $radical="http://127.0.0.1/sites/zencart_gl/admin/";
		else
		  $radical="http://linats.net/admin/";
		  
		include($radical.'replication_base_commande.php');
		
		
      break;


      case 'product':
 
        if (isset($_POST['split_products']) && zen_not_null($_POST['split_products'])) {
          // Duplicate order details from "orders" table
          $old_order = $db->Execute("SELECT * FROM " . TABLE_ORDERS. " WHERE orders_id = '" . $oID . "' LIMIT 1");
          $new_order = array('customers_id' => $old_order->fields['customers_id'],
                             'customers_name' => $old_order->fields['customers_name'],
                             'customers_company' => $old_order->fields['customers_company'],
                             'customers_street_address' => $old_order->fields['customers_street_address'],
                             'customers_suburb' => $old_order->fields['customers_suburb'],
                             'customers_city' => $old_order->fields['customers_city'],
                             'customers_postcode' => $old_order->fields['customers_postcode'],
                             'customers_state' => $old_order->fields['customers_state'],
                             'customers_country' => $old_order->fields['customers_country'],
                             'customers_telephone' => $old_order->fields['customers_telephone'],
                             'customers_email_address' => $old_order->fields['customers_email_address'],
                             'customers_address_format_id' => $old_order->fields['customers_address_format_id'],
                             'delivery_name' => $old_order->fields['delivery_name'],
                             'delivery_company' => $old_order->fields['delivery_company'],
                             'delivery_street_address' => $old_order->fields['delivery_street_address'],
                             'delivery_suburb' => $old_order->fields['delivery_suburb'],
                             'delivery_city' => $old_order->fields['delivery_city'],
                             'delivery_postcode' => $old_order->fields['delivery_postcode'],
                             'delivery_state' => $old_order->fields['delivery_state'],
                             'delivery_country' => $old_order->fields['delivery_country'],
                             'delivery_address_format_id' => $old_order->fields['delivery_address_format_id'],
                             'billing_name' => $old_order->fields['billing_name'],
                             'billing_company' => $old_order->fields['billing_company'],
                             'billing_street_address' => $old_order->fields['billing_street_address'],
                             'billing_suburb' => $old_order->fields['billing_suburb'],
                             'billing_city' => $old_order->fields['billing_city'],
                             'billing_postcode' => $old_order->fields['billing_postcode'],
                             'billing_state' => $old_order->fields['billing_state'],
                             'billing_country' => $old_order->fields['billing_country'],
                             'billing_address_format_id' => $old_order->fields['billing_address_format_id'],
                             'payment_method' => $old_order->fields['payment_method'],
                             'payment_module_code' => $old_order->fields['payment_module_code'],
                             'shipping_method' => $old_order->fields['shipping_method'],
                             'shipping_module_code' => $old_order->fields['shipping_module_code'],
                             'coupon_code' => $old_order->fields['coupon_code'],
                             'cc_type' => $old_order->fields['cc_type'],
                             'cc_owner' => $old_order->fields['cc_owner'],
                             'cc_number' => $old_order->fields['cc_number'],
                             'cc_expires' => $old_order->fields['cc_expires'],
                             'cc_cvv' => $old_order->fields['cc_cvv'],
                             'last_modified' => 'now()',
                             'date_purchased' => $old_order->fields['date_purchased'],
                             'orders_status' => $old_order->fields['orders_status'],                             
                             'currency' => $old_order->fields['currency'],
                             'currency_value' => $old_order->fields['currency_value'],
                             'order_total' => $old_order->fields['order_total'],
                             'order_tax' => $old_order->fields['order_tax']);
          zen_db_perform(TABLE_ORDERS, $new_order);

          // get new order ID to use with other split actions
          $new_order_id = mysql_insert_id();
          $messageStack->add_session('New order ID: ' . $new_order_id, 'warning');

          // update "orders_status_history" table
          $old_order_status_history = $db->Execute("SELECT * FROM " . TABLE_ORDERS_STATUS_HISTORY . " WHERE orders_id = '" . $oID . "'");
          while (!$old_order_status_history->EOF) {
            $new_order_status_history = array('orders_id' => $new_order_id,
                                              'orders_status_id' => $old_order_status_history->fields['orders_status_id'],
                                              'date_added' => $old_order_status_history->fields['date_added'],
                                              'customer_notified' => $old_order_status_history->fields['customer_notified'],
                                              'comments' => $old_order_status_history->fields['comments']);

            zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $new_order_status_history);
            $old_order_status_history->MoveNext();
          }

          // update "orders_total" table
          $old_order_total = $db->Execute("SELECT * FROM " . TABLE_ORDERS_TOTAL . " WHERE orders_id = '" . $oID . "'");
          while (!$old_order_total->EOF) {
            $new_order_total = array('orders_id' => $new_order_id,
                                     'title' => $old_order_total->fields['title'],
                                     'text' => $old_order_total->fields['text'],
                                     'value' => $old_order_total->fields['value'],
                                     'class' => $old_order_total->fields['class'],
                                     'sort_order' => $old_order_total->fields['sort_order']);

            zen_db_perform(TABLE_ORDERS_TOTAL, $new_order_total);
            $old_order_total->MoveNext();
          }

          // duplicate an existing Super Order payment data (if requested)
          //if (isset($_POST['copy_payments'])) {
          //SO_TODO split a credit card payment in half (if paid in full with a CC)
          if (false) {
            $so = new super_order($oID);
            if ($so->payment) {
              for ($i = 0; $i < sizeof($so->payment); $i++) {
                unset($old_payment, $new_payment);
                $old_payment = $so->payment[$i];
                $new_payment = array();

                $new_payment['orders_id'] = $new_order_id;
                $new_payment['payment_number'] = $old_payment['number'];
                $new_payment['payment_name'] = $old_payment['name'];
                $new_payment['payment_amount'] = $old_payment['amount'];
                $new_payment['payment_type'] = $old_payment['type'];
                $new_payment['date_posted'] = $old_payment['posted'];
                $new_payment['last_modified'] = $old_payment['modified'];

                zen_db_perform(TABLE_SO_PAYMENTS, $new_payment);
              }
            }

            if ($so->po_payment) {
              for ($i = 0; $i < sizeof($so->po_payment); $i++) {
                unset($old_payment, $new_payment);
                $old_payment = $so->po_payment[$i];
                $new_payment = array();

                $new_payment['orders_id'] = $new_order_id;
                $new_payment['payment_number'] = $old_payment['number'];
                $new_payment['payment_name'] = $old_payment['name'];
                $new_payment['payment_amount'] = $old_payment['amount'];
                $new_payment['payment_type'] = $old_payment['type'];
                $new_payment['date_posted'] = $old_payment['posted'];
                $new_payment['last_modified'] = $old_payment['modified'];
                $new_payment['purchase_order_id'] = $old_payment['assigned_po'];

                zen_db_perform(TABLE_SO_PAYMENTS, $new_payment);
              }
            }

            if ($so->purchase_order) {
              for ($i = 0; $i < sizeof($so->purchase_order); $i++) {
                unset($old_po, $new_po);
                $old_po = $so->purchase_order[$i];
                $new_po = array();

                $new_po['orders_id'] = $new_order_id;
                $new_po['po_number'] = $old_po['number'];
                $new_po['date_posted'] = $old_po['posted'];
                $new_po['last_modified'] = $old_po['modified'];

                zen_db_perform(TABLE_SO_PURCHASE_ORDERS, $new_po);
              }
            }

            if ($so->refund) {
              for ($i = 0; $i < sizeof($so->refund); $i++) {
                unset($old_refund, $new_refund);
                $old_refund = $so->refund[$i];
                $new_refund = array();

                $new_refund['orders_id'] = $new_order_id;
                $new_refund['payment_id'] = $old_refund['payment'];
                $new_refund['refund_number'] = $old_refund['number'];
                $new_refund['refund_name'] = $old_refund['name'];
                $new_refund['refund_amount'] = $old_refund['amount'];
                $new_refund['refund_type'] = $old_refund['type'];
                $new_refund['date_posted'] = $old_refund['posted'];
                $new_refund['last_modified'] = $old_refund['modified'];

                zen_db_perform(TABLE_SO_REFUNDS, $new_refund);
              }
            }
          }  // END if (isset($_POST['copy_payments']))

          // Reassign affected products to new order
          $split_products = $_POST['split_products'];
          foreach($split_products as $orders_products_id) {
            $db->Execute("UPDATE " . TABLE_ORDERS_PRODUCTS . " SET
                          orders_id = '" . $new_order_id . "'
                          WHERE orders_products_id = '" . $orders_products_id . "'");

            $db->Execute("UPDATE " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " SET
                          orders_id = '" . $new_order_id . "'
                          WHERE orders_products_id = '" . $orders_products_id . "'");

            $db->Execute("UPDATE " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " SET
                          orders_id = '" . $new_order_id . "'
                          WHERE orders_products_id = '" . $orders_products_id . "'");
          }

          // recalculate totals on both orders
          recalc_total($oID);
          recalc_total($new_order_id);

          // add history comments to both orders reflecting the split
          $notify_split = (isset($_POST['notify_split']) ? 1 : 0);

          // entry for original order
          $db->Execute("INSERT INTO " . TABLE_ORDERS_STATUS_HISTORY . "
                       (orders_id, orders_status_id, date_added, customer_notified, comments)
                       VALUES ('" . $oID . "',
                       '" . $new_order['orders_status'] . "',
                       now(),
                       '" . $notify_split . "',
                       '" . COMMENTS_SPLIT_OLD . $new_order_id . "')");

          // entry for new order
          $db->Execute("INSERT INTO " . TABLE_ORDERS_STATUS_HISTORY . "
                       (orders_id, orders_status_id, date_added, customer_notified, comments)
                       VALUES ('" . $new_order_id . "',
                       '" . $new_order['orders_status'] . "',
                       now(),
                       '" . $notify_split . "',
                       '" . COMMENTS_SPLIT_NEW . $oID . "')");

          // notify customer (if selected)
          if ($notify_split) {
            email_latest_status($oID);
          }
        }  // END if (isset($_POST['split_products']) && zen_not_null($_POST['split_products']))
      break;

      case 'history':
        $update_status_history = $db->Execute("SELECT * FROM " . TABLE_ORDERS_STATUS_HISTORY . "
                                               WHERE orders_id = '" . $oID . "'
                                               ORDER BY orders_status_history_id DESC");

        while (!$update_status_history->EOF) {
          $this_history_id = $update_status_history->fields['orders_status_history_id'];

          $this_status = $_POST['status_' . $this_history_id];
          $this_comments = zen_db_scrub_in($_POST['comments_' . $this_history_id]);
          $this_delete = $_POST['delete_' . $this_history_id];
          $change_exists = false;

          if ($this_delete == 1) {
            zen_db_delete(TABLE_ORDERS_STATUS_HISTORY, "orders_status_history_id = '" . $this_history_id . "'");
          }

          if ($this_status != $update_status_history->fields['orders_status_id']) {
            $update_history['orders_status_id'] = $this_status;
            $change_exists = true;
          }

          if ($this_comments != $update_status_history->fields['comments']) {
            $update_history['comments'] = $this_comments;
            $change_exists = true;
          }

          if ($change_exists) {
            zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $update_history, 'update', "orders_status_history_id  = '" . $this_history_id . "'");
          }

          $update_status_history->MoveNext();
        }

        // Re-query the orders_status_history table and reset the
        // current status and modify date in the orders table
        $update_status_history = $db->Execute("SELECT * FROM " . TABLE_ORDERS_STATUS_HISTORY . "
                                               WHERE orders_id = '" . $oID . "'
                                               ORDER BY orders_status_history_id DESC limit 1");

        $tbl_orders_history['orders_status'] = $update_status_history->fields['orders_status_id'];
        $tbl_orders_history['last_modified'] = $update_status_history->fields['date_added'];
        zen_db_perform(TABLE_ORDERS, $tbl_orders_history, 'update', "orders_id = '" . $oID . "'");
      break;


      case 'total':
//        require(DIR_WS_CLASSES . 'currencies.php');
//        $currencies = new currencies();

        $update_totals = $_POST['update_totals'];
        $running_total = 0;
        $sort_order = 0;

        foreach($update_totals as $total_index => $total_details) {
          extract($total_details, EXTR_PREFIX_ALL, "ot");

          if (trim($ot_title) && trim($ot_value)) {
            $sort_order++;

            // add values to running_total
            if($ot_class == "ot_subtotal") {
              $running_total += $ot_value;
            }

            elseif($ot_class == "ot_tax") {
              $running_total += $ot_value;
            }

            elseif($ot_class == "ot_gv" || $ot_class == "ot_coupon" || $ot_class == "ot_group_pricing") {
              $running_total -= $ot_value;
            }

            elseif($ot_class == "ot_total") {
              $ot_value = $running_total;
              $db->Execute("update " . TABLE_ORDERS . " set
                            order_total = '" . $ot_value . "'
                            where orders_id = '" . $oID . "'");
											
            }

            else {
              $running_total += $ot_value;
            }

            // format the text version of the amount
            if ($ot_class == "ot_gv" || $ot_class == "ot_coupon" || $ot_class == "ot_group_pricing") {
              $ot_text = "-" . $currencies->format($ot_value);
            }

            else {
              $ot_text = $currencies->format($ot_value);
            }

            if($ot_total_id > 0) {
              $query = "UPDATE " . TABLE_ORDERS_TOTAL . " SET
                        title = '" . $ot_title . "',
                        text = '" . $ot_text . "',
                        value = '" . $ot_value . "',
                        sort_order = '" . $sort_order . "'
                        WHERE orders_total_id = '" . $ot_total_id . "'";
              $db->Execute($query);
            }
            else {
              $query = "INSERT INTO " . TABLE_ORDERS_TOTAL . " SET
                        orders_id = '" . $oID . "',
                        title = '" . $ot_title . "',
                        text = '" . $ot_text . "',
                        value = '" . $ot_value . "',
                        class = '" . $ot_class . "',
                        sort_order = '" . $sort_order . "'";
              $db->Execute($query);
            }
			
          }
          
          // an empty line means the value should be deleted
          elseif($ot_total_id > 0) {
            zen_db_delete(TABLE_ORDERS_TOTAL, "orders_total_id = '" . $ot_total_id . "'");
          }
        }
      break;
	  
    }  // END switch ($target)
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php echo REDIRECT; ?></title>
<script language="JavaScript" type="text/javascript">
  <!--
  function returnParent() {
    window.opener.location.reload(true);
    window.opener.focus();
    self.close();
  }
  //-->
</script>
</head>
<!-- header_eof //-->
<body onload="returnParent()">
</body>
</html>
<?php
  }  // END if ($_POST['process'] == 1)
  else {
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<script language="JavaScript" type="text/javascript">
  <!--
  function closePopup() {
    window.opener.focus();
    self.close();
  }
  //-->
</script>
</head>
<!-- header_eof //-->
<body onload="self.focus()">
<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr>
<!-- body_text //-->
  <td align="center"><table border="0" cellspacing="0" cellpadding="2">
<?php
  if( $_GET['target']!='payment_mode')
  {
    echo '    ' . zen_draw_form('edit', FILENAME_SUPER_EDIT, '', 'post', '', true) . NL;  
  }
  else
  {
    echo '    ' . zen_draw_form('edit', FILENAME_SUPER_EDIT, '', 'get', '', true) . NL;  
  }
  
  echo '      ' . zen_draw_hidden_field('target', $target) . NL;
  echo '      ' . zen_draw_hidden_field('process', 1) . NL;
  echo '      ' . zen_draw_hidden_field('oID', $oID) . NL;
?>
<?php
  switch ($target) {

  case 'contact':
      $customers_sql = $db->Execute("select customers_id, customers_email_address, customers_firstname, customers_lastname
                                     from " . TABLE_CUSTOMERS . "
                                     order by customers_lastname, customers_firstname, customers_email_address");
      while(!$customers_sql->EOF) {
        $customers[] = array('id' => $customers_sql->fields['customers_id'],
                             'text' => $customers_sql->fields['customers_lastname'] . ', ' . $customers_sql->fields['customers_firstname'] . ' (' . $customers_sql->fields['customers_email_address'] . ')');

        $customer_array[$customers_sql->fields['customers_id']] = $customers_sql->fields['customers_firstname'] . ' ' . $customers_sql->fields['customers_lastname'];
        $customers_sql->MoveNext();
      }
?>
    <tr>
      <td colspan="3" align="center" class="main"><strong>
	  <?php 
           $db->connect($ext_db_server[$order->info['database_code']], $ext_db_username[$order->info['database_code']], $ext_db_password[$order->info['database_code']], $ext_db_database[$order->info['database_code']], USE_PCONNECT, false);

			$sql = "select ab.address_book_id code ,
			               concat(ab.entry_city,concat('  |  ',concat(entry_postcode,concat('  |  ',concat(countries.countries_name,'  |  '),entry_lastname)))) description
	                  from address_book ab, countries, orders
	                  where  orders.orders_id = " . $oID  . "
					   and ab.customers_id = orders.customers_id
					   and entry_country_id = countries_id  " ;		 
					   
//echo  $order->info['database_code']. $sql;exit;
					   
//    	     echo 'Changer la livraison pour..'.  get_select ( $sql, "address_book_id","","onchange='document.edit.submit();'" );
    	     echo 'Changer la livraison pour..'.  get_select ( $sql, "address_book_id","" );
    		 $db->connect($ext_db_server[$_GET['source_db']], $ext_db_username[$_GET['source_db']], $ext_db_password[$_GET['source_db']], $ext_db_database[$_GET['source_db']], USE_PCONNECT, false);				
			 
  	  ?></strong></td>
    </tr>
    <tr>
      <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
    </tr>
<!-- Begin Contact Block -->
    <tr>
      <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td class="main">&nbsp;</td>
          <td class="main"><strong><?php echo ENTRY_CUSTOMER_ADDRESS; ?></strong></td>
        </tr>
        <tr>
          <td class="main"><?php echo ENTRY_NAME; ?></td>
          <td class="main"><input name="customers_name" size="25" value="<?php echo zen_db_scrub_out($order->customer['name'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><?php echo ENTRY_COMPANY; ?></td>
          <td class="main"><input name="customers_company" size="25" value="<?php echo zen_db_scrub_out($order->customer['company'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><?php echo ENTRY_ADDRESS; ?></td>
          <td class="main"><input name="customers_street_address" size="25" value="<?php echo zen_db_scrub_out($order->customer['street_address'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><?php echo ENTRY_SUBURB; ?></td>
          <td class="main"><input name="customers_suburb" size="25" value="<?php echo zen_db_scrub_out($order->customer['suburb'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><?php echo ENTRY_CITY; ?></td>
          <td class="main"><input name="customers_city" size="25" value="<?php echo zen_db_scrub_out($order->customer['city'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><?php echo ENTRY_STATE; ?></td>
          <td class="main"><input name="customers_state" size="25" value="<?php echo zen_db_scrub_out($order->customer['state'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><?php echo ENTRY_POSTCODE; ?></td>
          <td class="main"><input name="customers_postcode" size="25" value="<?php echo zen_db_scrub_out($order->customer['postcode'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><?php echo ENTRY_COUNTRY; ?></td>
          <td class="main"><input name="customers_country" size="25" value="<?php echo zen_db_scrub_out($order->customer['country'], true); ?>"></td>
        </tr>
      </table></td>
      <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td class="main"><strong><?php echo ENTRY_BILLING_ADDRESS; ?></strong></td>
        </tr>
        <tr>
          <td class="main"><input name="billing_name" size="25" value="<?php echo zen_db_scrub_out($order->billing['name'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="billing_company" size="25" value="<?php echo zen_db_scrub_out($order->billing['company'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="billing_street_address" size="25" value="<?php echo zen_db_scrub_out($order->billing['street_address'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="billing_suburb" size="25" value="<?php echo zen_db_scrub_out($order->billing['suburb'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="billing_city" size="25" value="<?php echo zen_db_scrub_out($order->billing['city'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="billing_state" size="25" value="<?php echo zen_db_scrub_out($order->billing['state'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="billing_postcode" size="25" value="<?php echo zen_db_scrub_out($order->billing['postcode'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="billing_country" size="25" value="<?php echo zen_db_scrub_out($order->billing['country'], true); ?>"></td>
        </tr>
      </table></td>
      <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td class="main"><strong><?php echo ENTRY_SHIPPING_ADDRESS; ?></strong></td>
        </tr>
        <tr>
          <td class="main"><input name="delivery_name" size="25" value="<?php echo zen_db_scrub_out($order->delivery['name'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="delivery_company" size="25" value="<?php echo zen_db_scrub_out($order->delivery['company'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="delivery_street_address" size="25" value="<?php echo zen_db_scrub_out($order->delivery['street_address'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="delivery_suburb" size="25" value="<?php echo zen_db_scrub_out($order->delivery['suburb'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="delivery_city" size="25" value="<?php echo zen_db_scrub_out($order->delivery['city'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="delivery_state" size="25" value="<?php echo zen_db_scrub_out($order->delivery['state'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="delivery_postcode" size="25" value="<?php echo zen_db_scrub_out($order->delivery['postcode'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="delivery_country" size="25" value="<?php echo zen_db_scrub_out($order->delivery['country'], true); ?>"></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td><?php echo zen_draw_separator('pixel_trans.gif', 1, 10); ?></td>
    </tr>
    <tr>
      <td colspan="3"><table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="main"><strong><?php echo ENTRY_TELEPHONE_NUMBER; ?></strong></td>
          <td class="main"><input name='customers_telephone' size="15" value="<?php echo $order->customer['telephone']; ?>"></td>
        </tr>
        <tr>
          <td class="main"><strong>Numéro Intracom</strong></td>
          <td class="main"><input name='entry_tva_intracom' size="15" value="<?php echo $order->customer['entry_tva_intracom']; ?>"></td>
        </tr>
        <tr>
          <td class="main"><strong>TVA Applicable</strong></td>
          <td class="main"><input name='products_tax' size="15" value="<?php echo $order->info['products_tax']; ?>"></td>
        </tr>
        <tr>
          <td class="main"><strong>
<?php 
	 $html_currency =  '<select name="currency_change">
		                  <option value="EUR">EUR 		 
		                  <option value="GBP">GBP 
		                  <option value="USD">USD
		                  <option value="PLN">PLN						  
		               </select>';
	 echo  eregi_replace('"'.$order->info['currency'].'"' , '"'.$order->info['currency'].'" SELECTED' ,$html_currency ); 

?>
</strong></td>
          <td class="main"><input name='currency_value' size="15" value="<?php echo $order->info['currency_value']; ?>"></td>
        </tr>
		
        <tr>
          <td class="main"><strong>Reference commande:</strong></td>
          <td class="main"><input name='ref_info' size="30" value="<?php echo $order->info['ref_info']; ?>"></td>
        </tr>
        <tr>
          <td class="main"><strong><?php echo ENTRY_EMAIL_ADDRESS; ?></strong></td>
          <td class="main"><input name='customers_email_address' size="35" value="<?php echo $order->customer['email_address']; ?>"></td>
        </tr>
        <tr>
          <td class="main"><strong>Date de commande:</strong></td>
          <td class="main"><input name='date_purchased' size="25" value="<?php echo $order->info['date_purchased']; ?>"></td>
        </tr>
        <tr>
          <td class="main"><strong>Langue de facture:</strong></td>
          <td class="main">
		    <?php
			   $html_string = '<select name="languages_id">
			                     <option value="2">Français
			                     <option value="3">Espagnol
			                     <option value="4">Allemand
			                     <option value="5">Anglais
			                     <option value="6">Italien								 
			                     <option value="7">Polonais								 								 
			                   </select>';
			   echo eregi_replace('"'.$order->info['languages_id'].'"' , '"'.$order->info['languages_id'].'" SELECTED' ,$html_string );			   
			?>
		  </td>
        </tr>				
      </table</td>
    </tr>
    <tr>
      <td colspan="3"><table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="main"><strong><?php echo zen_draw_checkbox_field('change_customer', 'on', false) . ENTRY_CHANGE_CUSTOMER; ?></strong></td>
        </tr>
        <tr>
          <td class="main"><?php echo zen_draw_pull_down_menu('customers_id', $customers, $order->customer['id']); ?></td>
        </tr>
      </table></td>
    </tr>
<!-- End Contact Block -->
<?php
    break;


    case 'product':
      require(DIR_WS_CLASSES . 'currencies.php');
      $currencies = new currencies();

      // next available order number
      $nextID = $db->Execute("SELECT (orders_id + 1) AS nextID FROM " . TABLE_ORDERS . " ORDER BY orders_id DESC LIMIT 1");
      $nextID = $nextID->fields['nextID'];
?>
<!-- Begin Products Listing Block -->
    <tr>
      <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr class="dataTableHeadingRow">
          <?php if (sizeof($order->products) > 1) { ?>
          <td class="dataTableHeadingContent">&nbsp;</td>
          <?php } ?>
          <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
          <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS_MODEL; ?></td>
          <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TAX; ?></td>
          <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PRICE_EXCLUDING_TAX; ?></td>
          <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PRICE_INCLUDING_TAX; ?></td>
          <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_EXCLUDING_TAX; ?></td>
          <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_INCLUDING_TAX; ?></td>
          <td class="dataTableHeadingContent" align="right">Ref cmde</td>		  
        </tr>
<?php
    for ($i = 0; $i < sizeof($order->products); $i++) {
      $orders_products_id = $order->products[$i]['orders_products_id'];
      echo '        <tr class="dataTableRow">' . NL;
      if (sizeof($order->products) > 1) {
        echo '          <td class="dataTableContent" valign="top" align="center">' . zen_draw_checkbox_field('split_products[' . $i . ']', $orders_products_id) . NL;
      }
      echo '          <td class="dataTableContent" valign="middle" align="left">' . $order->products[$i]['qty'] . '&nbsp;x&nbsp;' . $order->products[$i]['name'];

      if (isset($order->products[$i]['attributes']) && (sizeof($order->products[$i]['attributes']) > 0)) {
        for ($j = 0, $k = sizeof($order->products[$i]['attributes']); $j < $k; $j++) {
          echo '<br /><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
          if ($order->products[$i]['attributes'][$j]['price'] != '0') echo ' (' . $order->products[$i]['attributes'][$j]['prefix'] . $currencies->format($order->products[$i]['attributes'][$j]['price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ')';
          if ($order->products[$i]['attributes'][$j]['product_attribute_is_free'] == '1' and $order->products[$i]['product_is_free'] == '1') echo TEXT_INFO_ATTRIBUTE_FREE;
          echo '</i></small></nobr>';
        }
      }

      echo '          </td>' . NL .
           '          <td class="dataTableContent" valign="middle">' . $order->products[$i]['model'] . '</td>' . NL .
           '          <td class="dataTableContent" align="right" valign="middle">' . zen_display_tax_value($order->products[$i]['tax']) . '%</td>' . NL .
           '          <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $currencies->format($order->products[$i]['final_price'], true, $order->info['currency'], $order->info['currency_value']) .
                          ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format($order->products[$i]['onetime_charges'], true, $order->info['currency'], $order->info['currency_value']) : '') .
                        '</strong></td>' . NL .
           '          <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) .
                          ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : '') .
                        '</strong></td>' . NL .
           '          <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $currencies->format($order->products[$i]['final_price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) .
                          ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format($order->products[$i]['onetime_charges'], true, $order->info['currency'], $order->info['currency_value']) : '') .
                        '</strong></td>' . NL .
           '          <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) .
                          ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : '') .
                        '</strong></td>' . NL;
           '          <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $order->products[$i]['ref_info'] . '</strong></td>' . NL; 
     echo '        </tr>' . NL;
    }
?>
        <tr>
          <td valign="middle"><?php echo zen_draw_checkbox_field('notify_split', 1); ?></td>
          <td valign="middle" class="smallText"><?php
            echo ENTRY_NOTIFY_CUSTOMER . '<br />';
            echo TEXT_SPLIT_EXPLAIN . '<strong>' . $nextID . '</strong>';
          ?></td>
        </tr>
      </table></td>
    </tr>
<!-- End Products Listings Block -->
<?php
    break;
    case 'payment_mode'; 
	    $payment_module_code = $order->info['payment_module_code'];
		$payment_method = $order->info['payment_method'];

	    $payment_conditions_code = $order->info['payment_conditions_code'];
		$payment_conditions_desc = $order->info['payment_conditions_desc'];		
		
		$payment_info =  $order->info['payment_info'];	
		$payment_amount =  $order->info['payment_amount'];	
		$orders_date_finished =  $order->info['orders_date_finished'];	

		$payment_info2 =  $order->info['payment_info2'];	
		$payment_amount2 =  $order->info['payment_amount2'];	
		$orders_date_finished2 =  $order->info['orders_date_finished2'];	

		
		if ( ($orders_date_finished=='0000-00-00 00:00:00') || (strlen($orders_date_finished)==0) )
  		   $orders_date_finished = "";

//echo 		   $orders_date_finished2;exit;
		   
		if ( ($orders_date_finished2=='0000-00-00') || (strlen($orders_date_finished2)==0) )
  		   $orders_date_finished2 = "";
		   
//echo 'a';exit;		
	    if ($_GET['cgt']==1)
		{
		
		   //  on place l'update et on 
		   $dml = "update orders set payment_conditions_desc='".$_GET['payment_conditions_desc']."' , payment_module_code = '".$_GET['payment_module_code']."',  payment_info = '".$_GET['payment_info']."' ,  payment_amount = '".$_GET['payment_amount']."'  where orders_id=".$_GET['oID'] ; 
		   $db->Execute( $dml );

		   $payment_module_code = $_GET['payment_module_code'];
    	   $payment_conditions_desc = $_GET['payment_conditions_desc'];
		   
		   // intitulés
		   $LIB_PAYMENT['CC'][2] = 'Carte de crédit';
		   $LIB_PAYMENT['CC'][3] = 'Tarjeta de credito';
		   $LIB_PAYMENT['CC'][4] = 'KreditKart';
		   $LIB_PAYMENT['CC'][5] = 'Credit Card';
		   $LIB_PAYMENT['CC'][6] = 'Carta di credito';
		   $LIB_PAYMENT['CC'][7] = 'Karta kredytowa';

		   $LIB_PAYMENT['LDC'][2] = 'Lettre de change';
		   $LIB_PAYMENT['LDC'][3] = 'Lettre de change';
		   $LIB_PAYMENT['LDC'][4] = 'Lettre de change';
		   $LIB_PAYMENT['LDC'][5] = 'Lettre de change';
		   $LIB_PAYMENT['LDC'][6] = 'Lettre de change';
		   $LIB_PAYMENT['LDC'][7] = 'Lettre de change';
		   
		   
		   $LIB_PAYMENT['COD'][2] = 'Contre remboursement';
		   $LIB_PAYMENT['COD'][3] = 'Contra reembolso';
		   $LIB_PAYMENT['COD'][4] = 'Nachname';
           $LIB_PAYMENT['COD'][5] = 'Cash on delivery';
		   $LIB_PAYMENT['COD'][6] = 'Contrassegno';
		   $LIB_PAYMENT['COD'][7] = 'Platnosc przy odbiorze';

		   $LIB_PAYMENT['PPL'][2] = 'Paypal';
		   $LIB_PAYMENT['PPL'][3] = 'Paypal';
		   $LIB_PAYMENT['PPL'][4] = 'Paypal';
           $LIB_PAYMENT['PPL'][5] = 'Paypal';
		   $LIB_PAYMENT['PPL'][6] = 'Paypal';
		   $LIB_PAYMENT['PPL'][7] = 'Paypal';
		   
		   $LIB_PAYMENT['CHQ'][2] = 'Chèque';
		   $LIB_PAYMENT['CHQ'][3] = 'Talon';
		   $LIB_PAYMENT['CHQ'][4] = 'Auf Rechnung';
		   $LIB_PAYMENT['CHQ'][5] = 'Scheck';
		   $LIB_PAYMENT['CHQ'][6] = 'Assegno';
		   $LIB_PAYMENT['CHQ'][7] = 'Czek';
		   
		   
		   $LIB_PAYMENT['VIR'][2] = 'Virement';
		   $LIB_PAYMENT['VIR'][3] = 'Transferencia';
		   $LIB_PAYMENT['VIR'][4] = 'Uberweisung';
		   $LIB_PAYMENT['VIR'][5] = 'Money order';	
		   $LIB_PAYMENT['VIR'][6] = 'Bonifico bancario';		   
		   $LIB_PAYMENT['VIR'][7] = 'Przelew';		   
		   

		   $LIB_PAYMENT['MKP_ebay'][2] = 'Ebay.';
		   $LIB_PAYMENT['MKP_ebay'][3] = 'Ebay.';
		   $LIB_PAYMENT['MKP_ebay'][4] = 'Ebay.';
		   $LIB_PAYMENT['MKP_ebay'][5] = 'Ebay.';		   
		   $LIB_PAYMENT['MKP_ebay'][6] = 'Ebay.';		   
		   $LIB_PAYMENT['MKP_ebay'][7] = 'Ebay.';		   

		   
		   $LIB_PAYMENT['MKP_darty'][2] = 'darty.';
		   $LIB_PAYMENT['MKP_darty'][3] = 'darty.';
		   $LIB_PAYMENT['MKP_darty'][4] = 'darty.';
		   $LIB_PAYMENT['MKP_darty'][5] = 'darty.';		   
		   $LIB_PAYMENT['MKP_darty'][6] = 'darty.';		   
		   $LIB_PAYMENT['MKP_darty'][7] = 'darty.';		   

		   $LIB_PAYMENT['MKP_allegro'][2] = 'allegro.';
		   $LIB_PAYMENT['MKP_allegro'][3] = 'allegro.';
		   $LIB_PAYMENT['MKP_allegro'][4] = 'allegro.';
		   $LIB_PAYMENT['MKP_allegro'][5] = 'allegro.';		   
		   $LIB_PAYMENT['MKP_allegro'][6] = 'allegro.';		   
		   $LIB_PAYMENT['MKP_allegro'][7] = 'allegro.';		   
		   
		   
		   $LIB_PAYMENT['interco'][2] = 'interco';
		   $LIB_PAYMENT['interco'][3] = 'interco';
		   $LIB_PAYMENT['interco'][4] = 'interco';
		   $LIB_PAYMENT['interco'][5] = 'interco';		   
		   $LIB_PAYMENT['interco'][6] = 'interco';		   
		   $LIB_PAYMENT['interco'][7] = 'interco';		   
		   
		   $LIB_PAYMENT['MKP_rdc'][2] = 'rdc.';
		   $LIB_PAYMENT['MKP_rdc'][3] = 'rdc.';
		   $LIB_PAYMENT['MKP_rdc'][4] = 'rdc.';
		   $LIB_PAYMENT['MKP_rdc'][5] = 'rdc.';		   
		   $LIB_PAYMENT['MKP_rdc'][6] = 'rdc.';		   
		   $LIB_PAYMENT['MKP_rdc'][7] = 'rdc.';		   

		   $LIB_PAYMENT['MKP_amazon'][2] = 'amazon.';
		   $LIB_PAYMENT['MKP_amazon'][3] = 'amazon.';
		   $LIB_PAYMENT['MKP_amazon'][4] = 'amazon.';
		   $LIB_PAYMENT['MKP_amazon'][5] = 'amazon.';		   
		   $LIB_PAYMENT['MKP_amazon'][6] = 'amazon.';	
		   $LIB_PAYMENT['MKP_amazon'][7] = 'amazon.';	

		   $LIB_PAYMENT['MKP_pixmania'][2] = 'pixmania.';
		   $LIB_PAYMENT['MKP_pixmania'][3] = 'pixmania.';
		   $LIB_PAYMENT['MKP_pixmania'][4] = 'pixmania.';
		   $LIB_PAYMENT['MKP_pixmania'][5] = 'pixmania.';		   
		   $LIB_PAYMENT['MKP_pixmania'][6] = 'pixmania.';		   
		   $LIB_PAYMENT['MKP_pixmania'][7] = 'pixmania.';		   
		   
		   $LIB_PAYMENT['MKP_fnac'][2] = 'fnac.';
		   $LIB_PAYMENT['MKP_fnac'][3] = 'fnac.';
		   $LIB_PAYMENT['MKP_fnac'][4] = 'fnac.';
		   $LIB_PAYMENT['MKP_fnac'][5] = 'fnac.';		   
		   $LIB_PAYMENT['MKP_fnac'][6] = 'fnac.';		   
		   $LIB_PAYMENT['MKP_fnac'][7] = 'fnac.';		   

		   $LIB_PAYMENT['MKP_pm'][2] = 'price minister.';
		   $LIB_PAYMENT['MKP_pm'][3] = 'price minister.';
		   $LIB_PAYMENT['MKP_pm'][4] = 'price minister.';
		   $LIB_PAYMENT['MKP_pm'][5] = 'price minister.';		   
		   $LIB_PAYMENT['MKP_pm'][6] = 'price minister.';		   
		   $LIB_PAYMENT['MKP_pm'][7] = 'price minister.';		   

		   $LIB_PAYMENT['MKP_cdiscount'][2] = 'CDiscount.';
		   $LIB_PAYMENT['MKP_cdiscount'][3] = 'CDiscount.';
		   $LIB_PAYMENT['MKP_cdiscount'][4] = 'CDiscount.';
		   $LIB_PAYMENT['MKP_cdiscount'][5] = 'CDiscount.';		   
		   $LIB_PAYMENT['MKP_cdiscount'][6] = 'CDiscount.';		   
		   $LIB_PAYMENT['MKP_cdiscount'][7] = 'CDiscount.';		   
		   
     	   $payment_method = $LIB_PAYMENT[$payment_module_code][$order->info['languages_id']];
		   
		}
	    else if ($_GET['cgt']==2)
		{
		   //  on place l'update et on 
		   $db->Execute("update orders set payment_method = '".$_GET['payment_method']."',  payment_conditions_code = '".$_GET['payment_conditions_code']."' where orders_id=".$_GET['oID'] );
		   $payment_conditions_code = $_GET['payment_conditions_code'];
		   $payment_method = $_GET['payment_method'];
                               
		   // intitulés
		   $LIB_PAYMENT['30JN'][2] = '30 jours nets.';
		   $LIB_PAYMENT['30JN'][3] = '30 dias netos.';
		   $LIB_PAYMENT['30JN'][4] = '30 Tage netto.';
		   $LIB_PAYMENT['30JN'][5] = '30 days.';
		   $LIB_PAYMENT['30JN'][6] = '30 giorni.';
		   $LIB_PAYMENT['30JN'][7] = '30 dni.';

		   $LIB_PAYMENT['30FM'][2] = '30 jours fin de mois.';
		   $LIB_PAYMENT['30FM'][3] = '30 dias.';
		   $LIB_PAYMENT['30FM'][4] = '30 Tage';
		   $LIB_PAYMENT['30FM'][5] = '30 days end of month';
		   $LIB_PAYMENT['30FM'][6] = '30 days dalla fine del mese';
		   $LIB_PAYMENT['30FM'][7] = '30 dni';

		   $LIB_PAYMENT['45JN'][2] = '45 jours nets.';
		   $LIB_PAYMENT['45JN'][3] = '45 dias netos.';
		   $LIB_PAYMENT['45JN'][4] = '45 Tage netto.';
		   $LIB_PAYMENT['45JN'][5] = '45 days.';		
		   $LIB_PAYMENT['45JN'][6] = '45 giorni';		
		   $LIB_PAYMENT['45JN'][7] = '45 dni';		
		   
		   $LIB_PAYMENT['60JN'][2] = '60 jours nets.';
		   $LIB_PAYMENT['60JN'][3] = '60 dias netos.';
		   $LIB_PAYMENT['60JN'][4] = '60 Tage netto.';
		   $LIB_PAYMENT['60JN'][5] = '60 days.';		   
		   $LIB_PAYMENT['60JN'][6] = '60 giorni.';		   
		   $LIB_PAYMENT['60JN'][7] = '60 dni.';		   

		   $LIB_PAYMENT['RF'][2] = 'A réception de facture.';
		   $LIB_PAYMENT['RF'][3] = 'A recepcion de su factura.';
		   $LIB_PAYMENT['RF'][4] = 'Auf Rechnung.';
		   $LIB_PAYMENT['RF'][5] = 'Upon invoice reception.';		   
		   $LIB_PAYMENT['RF'][6] = 'All recevimento.';		   
		   $LIB_PAYMENT['RF'][7] = 'Platnosci faktura.';		   

		   
		   
     	   $payment_conditions_desc = $LIB_PAYMENT[$payment_conditions_code][$order->info['languages_id']];
//     	   $payment_conditions_desc =		   $payment_conditions_code;
		}
		else if ( strlen($_GET['payment_conditions_desc'])>0 || strlen($_GET['payment_method'])>0 )
		{
		   	  echo '
			<script language="JavaScript" type="text/javascript">
			   returnParent();
			</script>
			</body>
			</html>';
			exit;
		}
		
	    echo  '<table>';
		echo  '<input type="hidden" name="cgt">';
        // sélection 1		
	    echo  '<tr><td colspan=2 bgcolor=gray align=center><b>Méthode de paiement</b></td></tr>';
		$html =  "<tr><td colspan=2  align=center><select  name=\"payment_module_code\" onchange=\"document.edit.cgt.value=1;document.edit.submit();\">"; 
		$html .=  '<option value="">Sélectionner une méthode';
			   			   
		$html .=  '<option value="'. $get_paiement_url . 'CC">Carte de crédit' ;
		$html .=  '<option value="'. $get_paiement_url . 'CHQ">Chèque / Auf Rechnung ' ;
		$html .=  '<option value="'. $get_paiement_url . 'LDC">Lettre de change' ;		
		$html .=  '<option value="'. $get_paiement_url . 'VIR">Virement' ;
		$html .=  '<option value="'. $get_paiement_url . 'COD">COD-Contre remboursement' ;		
		$html .=  '<option value="'. $get_paiement_url . 'PPL">Paypal' ;		
		$html .=  '<option value="'. $get_paiement_url . 'MKP_ebay">Mkp ebay' ;		
		$html .=  '<option value="'. $get_paiement_url . 'MKP_amazon">Mkp amazon' ;		
		$html .=  '<option value="'. $get_paiement_url . 'MKP_pixmania">Mkp pixmania' ;		
		$html .=  '<option value="'. $get_paiement_url . 'MKP_darty">Mkp darty' ;		
		$html .=  '<option value="'. $get_paiement_url . 'MKP_allegro">Mkp allegro' ;		
		$html .=  '<option value="'. $get_paiement_url . 'MKP_rdc">Mkp rdc' ;		
		$html .=  '<option value="'. $get_paiement_url . 'MKP_fnac">Mkp fnac' ;				
		$html .=  '<option value="'. $get_paiement_url . 'MKP_pm">Mkp price minister' ;		
		$html .=  '<option value="'. $get_paiement_url . 'MKP_cdiscount">Mkp cDiscount' ;				
		$html .=  '<option value="'. $get_paiement_url . 'interco">interco' ;				
		$html .=  '</select>';		
		$html .=  '</td></tr>';
		echo eregi_replace('"'.$payment_module_code.'"' , '"'.$payment_module_code.'" SELECTED' ,$html );
		
	    echo  '<tr><td>Description</td><td><input type="text" name="payment_method" value="'.$payment_method.'"></td></tr>';
									 
									 
	    echo  '<tr><td colspan=2 bgcolor=gray align=center><b>Conditions de paiement</b></td></tr>';
		$html =  "<tr><td colspan=2  align=center><select  name=\"payment_conditions_code\" onchange=\"document.edit.cgt.value=2;document.edit.submit();\">"; 
		$html .=  '<option value="">Sélectionner les conditions de payment';
			   			   
		$html .=  '<option value="'. $get_paiement_url . '30JN">30 jours nets' ;
		$html .=  '<option value="'. $get_paiement_url . '30FM">30 jours fin de mois' ;
		$html .=  '<option value="'. $get_paiement_url . '45JN">45 jours nets' ;
		$html .=  '<option value="'. $get_paiement_url . '60JN">60 jours nets' ;
		$html .=  '<option value="'. $get_paiement_url . 'RF">A réception de facture' ;
		$html .=  '<option value="'. $get_paiement_url . 'ORD">A réception de commande' ;		
		
		$html .=  '</select>';		
		$html .=  '</td></tr>';
		echo eregi_replace('"'.$payment_conditions_code.'"' , '"'.$payment_conditions_code.'" SELECTED' ,$html );
	    echo  '<tr><td>Description</td><td><input type="text" name="payment_conditions_desc" value="'.$payment_conditions_desc.'"></td></tr>';

	    echo  '<tr><td colspan=2 bgcolor=gray align=center><b>Ref Paiement</b></td></tr>';
	    echo  '<tr><td>Ref</td><td>
		       <input type="text" size=40 name="payment_info" value="'.$payment_info.'">
			   </td></tr>';
	    echo  '<tr><td>Date paiement</td><td>
		       <input type="text"  name="orders_date_finished" value="'.zen_date_short($orders_date_finished).'">
			   </td>';
	    echo  '<tr><td colspan=2> (remplie automatiquement si on saisit une référence) </td>';

	    echo  '<tr><td>Montant paiement</td><td>
		       <input type="text"  name="payment_amount" value="'.$payment_amount.'">
			   </td>';			   
			   
		if ($payment_amount==0) 
		{
		    $sql = "select order_total*currency_value value from orders where orders_id = " . $_GET['oID'];

			$payment_amount = exec_select ( $sql );		
			echo  '<tr><td colspan=2> (' . round($payment_amount,0) .  ' si on saisit une référence) </td>';
		}
		else
		{
			echo  '<tr><td colspan=2> &nbsp; </td>';		
		}		
		echo '</tr>';

	    echo  '<tr><td colspan=2 bgcolor=gray align=center><b>Ref paiement2</b></td></tr>';		
		
		echo  '<tr><td>Ref paiement 2 </td><td>
		       <input type="text"  name="payment_info2" size=40 value="'.$payment_info2 .'">
			   </td>';
	    echo  '</tr>';		

		
	    echo  '<tr><td>Date paiement 2 </td><td>
		       <input type="text"  name="orders_date_finished2" value="'.zen_date_short($orders_date_finished2).'">
			   </td>';
	    echo  '</tr>';
		
	    echo  '<tr><td>Montant paiement 2 </td><td>
		       <input type="text"  name="payment_amount2" value="'.$payment_amount2.'">
			   </td>';
	    echo  '</tr>';				
		if  ( $_SESSION['admin_id']==1 )
		{
		    echo  '<tr><td>Statut->Réglée</td>
			       <td><input type="checkbox" 
				              value=1 name="validation_statut" "'.$check_validation_statut.'"></td></tr>';		
        }		
		echo  '</table>';
			   
	  break;
   case 'add_customer_products':

			$sql = "select op.orders_products_id code,
			               concat( concat(o.orders_id,'-'), 
						   concat(op.products_quantity,concat(concat(concat(' ',products_model),concat(' ',products_name)),concat('  |  ', o.delivery_company)))) description,
						   op.reliquat,
						   op.products_quantity
	                  from   orders o, orders_products op
	                  where  o.customers_id = ". $order->customer['id'] . "
	                   and   o.orders_id  = op.orders_id
                       order by o.orders_id desc";

//echo $sql;exit;

        $db->connect($ext_db_server[$order->info['database_code']], $ext_db_username[$order->info['database_code']], $ext_db_password[$order->info['database_code']], $ext_db_database[$order->info['database_code']], USE_PCONNECT, false);		 

   $recordSet = $db->Execute( $sql );

   $html =  '<select size="10"  name="select_items[]"  multiple="multiple">';
   
            while (!$recordSet->EOF) {
                 $html .=  '<option ';


                    $html .=  ' value="'.$recordSet->fields['code'].'">'. stripslashes ( $recordSet->fields['description'] ) ."\n";
                 $recordSet->MoveNext();
              };
      $html .=  '</select> ';
      echo   $html;
	break;

   case 'add_delivered_products':

			$sql = "select op.orders_products_id code,
			               concat( concat(oi.orders_invoices_id,'-'), 
						   concat(op.products_quantity,concat(concat(concat(' ',products_model),concat(' ',products_name)),concat('  |  ', o.delivery_company)))) description,
						   op.reliquat,
						   op.products_quantity
	                  from   orders o, orders_products op, orders_invoices oi
	                  where  o.customers_id = ". $order->customer['id'] . "
					   and   products_model not in ('CODF','SHF','ECOF')						
	                   and   o.orders_id  = op.orders_id
					   and   o.orders_id  = oi.orders_id
					   and   oi.invoice_type = 'BL'
                       order by o.orders_id desc";

//echo $sql;exit;


   $recordSet = $db->Execute( $sql );

   $html =  '<select size="10"  name="select_items[]"  multiple="multiple">';
   
            while (!$recordSet->EOF) {
                 $html .=  '<option ';


                    $html .=  ' value="'.$recordSet->fields['code'].'">'. stripslashes ( $recordSet->fields['description'] ) ."\n";
                 $recordSet->MoveNext();
              };
      $html .=  '</select> ';
      echo   $html;
	break;
	
    case 'edit_product';
	
	
        if ( $_GET['orders_products_id'] > 0 )	
		{
		   $sql = "select products_quantity,products_model,products_name,final_price,orders_products.sort_order,reliquat,
		                  orders.currency,orders.currency_value
		           from orders, orders_products 
				   where orders.orders_id = orders_products.orders_id 
				   and orders_products_id =" . $_GET['orders_products_id'];
		   $op_qry = $db->Execute($sql);
		   
		   $products_quantity = $op_qry->fields['products_quantity'];
		   $products_model = $op_qry->fields['products_model'];
		   $products_name = $op_qry->fields['products_name'];

    	   $sort_order = $op_qry->fields['sort_order'];		   
    	   $reliquat = $op_qry->fields['reliquat'];		   		   
		   $currency = $op_qry->fields['currency'];		   		   
		   $currency_value = $op_qry->fields['currency_value'];

		   $final_price = round($op_qry->fields['final_price']*$currency_value,2);
		   $final_price_euro = $op_qry->fields['final_price'];
		}		
		else
		{
    	   // $get_categ_url = 
		}
    if ( !$questionc  )
	{
    $db->connect($ext_db_server['eu'], $ext_db_username['eu'], $ext_db_password['eu'], $ext_db_database['eu'], USE_PCONNECT, false);		
    // oID=21385&target=edit_product
    $get_categ_url = "super_edit.php?target=edit_product&oID=".$_GET['oID']."&orders_products_id=" . $_GET['orders_products_id'] . "&marque=";
    $get_si_url = "super_edit.php?target=edit_product&oID=".$_GET['oID']."&orders_products_id=" . $_GET['orders_products_id'] . "&si=";
		
		
    $marque = $_GET['marque'];
	$video = $_GET['video'];
	$lampe  = $_GET['lampe'];
	$frais  = $_GET['frais'];
	$si  = $_GET['si'];
	
	if ( $marque )
	{
	  $get_subcateg_url = "super_edit.php?target=edit_product&oID=".$_GET['oID']."&orders_products_id=" . $_GET['orders_products_id'] . "&marque=" . $marque . "&video=";
	}
	if ( $video )
	{
	  // $get_typlampe_url  
	  $get_typlampe_url = "super_edit.php?target=edit_product&oID=".$_GET['oID']."&orders_products_id=" . $_GET['orders_products_id'] . "&marque=" . $marque . "&video=" . $video . "&lampe=";
	}
	if ( $lampe )
	{
	  //  aller chercher les infos
      $sql = "select m.manufacturers_name,
	                 cd.categories_name,
					cstr.categories_name constructeur,
					pd.products_name
			  from products p,
			       products_description pd,
			       categories as cat,
			       categories_description cd,
			        categories_description AS cstr,				   
				   manufacturers m
			  where m.manufacturers_id = p.manufacturers_id
			   and  pd.products_id = p.products_id
			   and  pd.language_id = 2
			   AND  cat.categories_id = cd.categories_id
			   AND cstr.categories_id = cat.parent_id
              and   cd.categories_id = p.master_categories_id 
              and   p.products_id=" . $lampe;
			  
      $new_product_query = $db->Execute( $sql );
	  
	  include_once ('../el_admin/product_desc.php');

	  $prdd = get_product_desc (  $new_product_query->fields['manufacturers_name'],
	                              $new_product_query->fields['categories_name'],
								         $order->info['languages_id'],
                                  $new_product_query->fields['constructeur']	  );	  
	  
	   $products_model = $new_product_query->fields['products_name'];
	   $products_name = $prdd;
	  
	}
	if ( $si )
	{
	  //  aller chercher les infos
      $sql = "select p.products_model,
					 pd.products_name
				from tbi_fr.products_description pd, tbi_fr.products p
			  where pd.products_id = p.products_id
              and   p.products_id=" . $si;
			  
       $new_product_query = $db->Execute( $sql );
	  
	   $products_model = $new_product_query->fields['products_model'];
	   $products_name = $new_product_query->fields['products_name'];
	  
	}	
	if ( $frais )
	{
	   $LIBF['SHF'][2] = "Livraison par colis";
	   $LIBF['SHF'][3] = "Entrega por paquete";
	   $LIBF['SHF'][4] = "Versandkostenpauschale";
	   $LIBF['SHF'][5] = "Shipping fees";
	   $LIBF['SHF'][6] = "Spese di consegna ";
	   $LIBF['SHF'][7] = "Wysylka standardowa";

	   $LIBF['ECOF'][2] = "Eco-contribution";
	   $LIBF['ECOF'][3] = "Eco-contribution";
	   $LIBF['ECOF'][4] = "Eco-contribution";
	   $LIBF['ECOF'][5] = "Eco-contribution";
	   $LIBF['ECOF'][6] = "Eco-contribution";
	   $LIBF['ECOF'][7] = "Eco-contribution";

	   $LIBF['CODF'][2] = "Frais de contre-remboursement";
	   $LIBF['CODF'][3] = "Contra reembolso";
	   $LIBF['CODF'][4] = "Nachnahme";
	   $LIBF['CODF'][5] = "COD fees";
	   $LIBF['CODF'][6] = "COD fees";
	   $LIBF['CODF'][7] = "COD fees";

	   $LIBF['ESCF'][2] = "Escompte";
	   $LIBF['ESCF'][3] = "Discuento";
	   $LIBF['ESCF'][4] = "Skonto";
	   $LIBF['ESCF'][5] = "Discount";
	   $LIBF['ESCF'][6] = "Discuento";
	   $LIBF['ESCF'][7] = "Discount";

	   $LIBF['FRS'][2] = "Frais de restockage";
	   $LIBF['FRS'][3] = "Gastos de reempaquetamiento";
	   $LIBF['FRS'][4] = "Wiedereinlagerungskosten";
	   $LIBF['FRS'][5] = "Restocking fees";
	   $LIBF['FRS'][6] = "Restocking fees";
	   $LIBF['FRS'][7] = "Restocking fees";

	   $LIBF['TVA'][2] = "TVA";
	   $LIBF['TVA'][3] = "IVA";
	   $LIBF['TVA'][4] = "MwSt";
	   $LIBF['TVA'][5] = "VAT";
	   $LIBF['TVA'][6] = "IVA";
	   $LIBF['TVA'][7] = "VAT";
	   
	   $LIBF['DIVPRD'][2] = "Divers";
	   $LIBF['DIVPRD'][3] = "Divers";
	   $LIBF['DIVPRD'][4] = "Divers";
	   $LIBF['DIVPRD'][5] = "Divers";
	   $LIBF['DIVPRD'][6] = "Divers";
	   $LIBF['DIVPRD'][7] = "Divers";

	   $LIBF['ESCC'][2] = "Réduction Commerciale";
	   $LIBF['ESCC'][3] = "Reducción Comercial";
	   $LIBF['ESCC'][4] = "Handelsverminderung";
	   $LIBF['ESCC'][5] = "Commercial discount";
	   $LIBF['ESCC'][6] = "Riduzione Commerciale";
	   $LIBF['ESCC'][7] = "Commercial discount";
	   
	   
	   $products_model = $frais;
	   $products_name = $LIBF[$frais][$order->info['languages_id']];	   
	}

	$html = '<select name="categ" onchange="document.location=this.value;"> 
	          <option value="">Constructeur';

	   $sql = 'select cat.categories_id, catd.categories_name 
		  from   categories as cat, categories_description as catd 
		  where  cat.categories_id = catd.categories_id
		  and    catd.language_id= 2
		  and    cat.parent_id = 0
		  order by catd.categories_name';

      $categories_lookup = $db->Execute($sql);
      
      while (!$categories_lookup->EOF) 
      {
	     $sel = "";
		 if ( $marque )
		 {
			if ( $marque == $categories_lookup->fields['categories_id'])
			{
				 $sel .=  ' SELECTED ';
			}
		 }
	  
         $html .=  '<option value="'. $get_categ_url . $categories_lookup->fields['categories_id'] .'"  '. $sel .'>'.  $categories_lookup->fields['categories_name'] ;
         $categories_lookup->MoveNext();
      }
	  echo $html;
	  
     // sélection du modèle ---------------------------------------------------------------------------------------------
	 $html = "";
      echo '</select>
			<select name="subCateg" onchange="document.location=this.value;"> 
			   <option value="">Vidéoprojecteur';
	  if ( $marque )
	  {
		  $sql = 'select cat.categories_id, catd.categories_name 
				  from   categories as cat, categories_description as catd 
				  where  cat.categories_id = catd.categories_id
				  and    catd.language_id= 2
				  and    cat.parent_id = ' . $marque . '
				  order by catd.categories_name';

			  $subcategories_lookup = $db->Execute($sql);
			  
			  while (!$subcategories_lookup->EOF) 
			  {
				 $sel = "";
				 if ( $video )
				 {
//echo $video;				 
					if ( $video == $subcategories_lookup->fields['categories_id'])
					{
						 $sel .=  ' SELECTED ';
					}
				 }
			  
    			 $html .=  '<option value="'. $get_subcateg_url .   $subcategories_lookup->fields['categories_id'].'"  '. $sel .'>'.  $subcategories_lookup->fields['categories_name'] ;
				 $subcategories_lookup->MoveNext();
			  }
			  echo $html;
		}
		echo '</select>';

     // sélection du type ---------------------------------------------------------------------------------------------
	 $html = "";
      echo '<select name="type" onchange="document.location=this.value;"> 
			   <option value="">Type lampe';
	  if ( $video )
	  {
		  $sql = 'select prd.products_id, man.manufacturers_name 
				  from   products as prd, manufacturers as man
				  where  man.manufacturers_id = prd.manufacturers_id
				  and    prd.master_categories_id = ' . $video ;

			  $subcategories_lookup = $db->Execute($sql);
			  
			  while (!$subcategories_lookup->EOF) 
			  {
				 $sel = "";
				 if ( $lampe )
				 {
					if ( $lampe == $subcategories_lookup->fields['products_id'])
					{
						 $sel .=  ' SELECTED ';
					}
				 }
			  
    			 $html .=  '<option value="'. $get_typlampe_url .   $subcategories_lookup->fields['products_id'].'"  '. $sel .'>'.  $subcategories_lookup->fields['manufacturers_name'] ;
				 $subcategories_lookup->MoveNext();
			  }
			  echo $html;
		}
		echo '</select>';		
		echo '<hr>';
		
		echo '<select onchange="document.location=this.value;">';		
	  if ( true )
	  {
		$sql = 'SELECT products.products_id, CONCAT( parentd.categories_name, " -> ", categories_description.categories_name, " -> ", products_model, " -> ", products_name ) products_name
			FROM tbi_fr.categories, tbi_fr.categories_description, tbi_fr.products, tbi_fr.products_description, 
				tbi_fr.categories parent, tbi_fr.categories_description parentd
			WHERE categories.parent_id = parent.categories_id
			AND parentd.categories_id = parent.categories_id
			AND categories.categories_id = categories_description.categories_id
			AND products.master_categories_id = categories.categories_id
			AND products.products_id = products_description.products_id
			union 
			SELECT products.products_id, CONCAT( categories_description.categories_name, " -> ", products_model, " -> ", products_name ) products_name
			FROM categories, categories_description, products, products_description, categories parent, categories_description parentd
			WHERE categories.parent_id = 0
			AND categories.categories_id = categories_description.categories_id
			AND products.master_categories_id = categories.categories_id
			AND products.products_id = products_description.products_id
			ORDER BY 2';	
			  $subcategories_lookup = $db->Execute($sql);

 			 $html .=  '<option value="">Sélection solution interactive</option>';
			  
			  while (!$subcategories_lookup->EOF) 
			  {
				 $sel = "";
/*				 
				 if ( $video )
				 {
//echo $video;				 
					if ( $video == $subcategories_lookup->fields['categories_id'])
					{
						 $sel .=  ' SELECTED ';
					}
				 }
*/			  
    			 $html .=  '<option value="'. $get_si_url .   $subcategories_lookup->fields['products_id'].'"  '. $sel .'>'.  $subcategories_lookup->fields['products_name'] ;
				 $subcategories_lookup->MoveNext();
			  }
			  echo $html;
		}
		echo '</select>';
		echo '<hr>';
		
      echo '<select name="type" onchange="document.location=this.value;"> 
			   <option value="">Type de frais';

      $get_frais_url = "super_edit.php?target=edit_product&oID=".$_GET['oID']."&orders_products_id=" . $_GET['orders_products_id'] . "&frais=";
			   			   
		echo  '<option value="'. $get_frais_url . 'SHF">SHF Frais de port' ;
		echo  '<option value="'. $get_frais_url . 'ECOF">ECOF Eco-Contribution' ;
		echo  '<option value="'. $get_frais_url . 'CODF">CODF Frais de COD' ;
		echo  '<option value="'. $get_frais_url . 'ESCF">ESCF Escompte' ;
		echo  '<option value="'. $get_frais_url . 'ESCC">ESCC Réduction Commerciale' ;		
		echo  '<option value="'. $get_frais_url . 'FRS">FRS  Restockage' ;
		echo  '<option value="'. $get_frais_url . 'TVA">TVA' ;		
		echo  '<option value="'. $get_frais_url . 'DIVPRD">Divers' ;				
		echo '</select>';		
		echo '<hr>';
	}	
		
	    echo  '<input type="hidden" name="orders_products_id" value="'. $_GET['orders_products_id'] . '">';
		echo '<tr>
		      <td align="center">
			  <table>';
    	echo  '<tr>
		             <td colspan=2>Pour supprimer le produit,mettre la quantité à 0</td>
			   </tr>';
	    echo  '<tr>
		             <td>Quantité</td>
					 <td><input type="text" name="products_quantity" value="'.$products_quantity.'"></td>
			   </tr>';

    	echo  '<tr>
		             <td>Code</td>
					 <td><input type="text" name="products_model" value="'.$products_model.'"></td>
			   </tr>';
    	echo  '<tr>
		             <td>Description</td>
					 <td><input type="text" name="products_name" size=35 value="'.$products_name.'"></td>
			   </tr> ';		
	    echo  '<tr>
		             <td>Prix</td>
					 <td><input type="text" name="final_price" value="'.$final_price.'"></td>
			   </tr> ';	
	    echo  '<tr>
		             <td colspan=2> <hr> </td>
			   </tr> ';	
	    echo  '<tr>
		             <td>Reliquat</td>
					 <td><input type="text" name="reliquat" value="'.$reliquat.'"></td>
			   </tr> ';	
	    echo  '<tr>
		             <td>Tri</td>
					 <td><input type="text" name="sort_order" value="'.$sort_order.'"></td>
			   </tr> ';	
			   
		echo '</table></td></tr>';
		
//        echo  '.'.$order->info['payment_method'].'.'.$order->info['payment_module_code'];
		
	  break;

	  case 'edit_invoice':
	  if ( $_GET['invoice_type'] != "CM" )
	  {
	    $sql = "select * from orders_invoices where orders_invoices_id = ". $_GET['invoice_id'] . " and invoice_type = '". $_GET['invoice_type'] . "'" ;
	  	 $invoiceQry = $db->Execute( $sql);
		 $invoice_date = $invoiceQry->fields['invoice_date'];
		 $orders_invoices_id_comment = stripslashes($invoiceQry->fields['orders_invoices_id_comment']);
		 
//echo $sql;		
	      echo 'Date de facture/avoir<input type="text" name="invoice_date" value="'.$invoice_date.'">';		
	      echo '<br>Commentaire num <input type="text" name="orders_invoices_id_comment" value="'.$orders_invoices_id_comment.'">';		
		  
	      echo '<input type="hidden" name="invoice_id" value="'.$_GET['invoice_id'].'">';
	      echo '<input type="hidden" name="invoice_type" value="'.$_GET['invoice_type'].'">';	  		
	  }
	  echo '<br><br><br><br>Pour supprimer la piece courante, cocher et appuyer sur "SUBMIT". <input type="checkbox" name="suppress_invoice" value="1">';

	  echo '<br><br><br><br>Pour régénérer le l\'image PO, cocher et appuyer sur "SUBMIT". <input type="checkbox" name="regen_po" value="1">';
	  
      break;
	  
	  case 'margin':
	  if ( $_GET['opID'] > 0 )
	  {
	    $sql = "select * from orders_products where orders_products_id = ". $_GET['opID'] ;
		
	  	 $invoiceQry = $db->Execute( $sql);
		 $products_quantity = $invoiceQry->fields['products_quantity'];
		 $final_price = $invoiceQry->fields['final_price'];
		 $unit_order_price = $invoiceQry->fields['unit_order_price'];
		 $usd_euro_rate = $invoiceQry->fields['usd_euro_rate'];

		 echo '<input type=hidden name=opID value='.$_GET['opID'].'>';		 		 
		 echo '<input type=hidden name=final_price value='.$final_price.'>';		 		 		 
		 echo '<input type=hidden name=products_quantity value='.$products_quantity.'>';		 		 
		 
		 echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';		 		 
		 echo '<tr><td>Quantité vendue</td><td>'.$products_quantity.'</td></tr>';		 
		 echo '<tr><td>Prix unitaire vendu</td><td>'.round($final_price,0).'</td></tr>';
		 echo '<tr><td>Fournisseur</td><td>-</td></tr>';
		 echo '<tr><td>Prix unitaire acheté</td><td><input size=5 type=text name=unit_order_price value="'.round($unit_order_price).'"></td></tr>';		 
		 echo '<tr><td>Taux de change</td><td><input size=5 type=text name=usd_euro_rate value="'.round($usd_euro_rate,2).'"></td></tr>';
	  }      	  
      break;
	  case 'ecc':
	  if ( $_GET['opID'] > 0 )
	  {
	    $sql = "select * from orders_products where orders_products_id = ". $_GET['opID'] ;
		
	  	 $invoiceQry = $db->Execute( $sql);
		 
		 $supply_on_stock = $invoiceQry->fields['supply_on_stock'];
		 $compatible_lamp_code  = $invoiceQry->fields['compatible_lamp_code'];
		 $supplier_short_name = $invoiceQry->fields['supplier_short_name'];
		 $compatible_lamp_code = $invoiceQry->fields['compatible_lamp_code'];		 
		 $unit_order_price = $invoiceQry->fields['unit_order_price'];
		 $final_price = $invoiceQry->fields['final_price'];
		 
		 echo '<input type=hidden name=opID value='.$_GET['opID'].'>';		 		 
		 echo '<input type=hidden name=final_price value='.$final_price.'>';		 		 		 
		 echo '<input type=hidden name=products_quantity value='.$products_quantity.'>';		 		 
		 
		 echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';		 	
		 echo '<tr><td>Code lampe vendu</td><td>'.$invoiceQry->fields['products_model'].'</td></tr>';
		 echo '<tr><td>Prix unitaire vendu</td><td>'.round($final_price,0).'</td></tr>';		 
		 echo '<tr><td>Qté</td><td>'.$invoiceQry->fields['products_quantity'].'</td></tr>';
		 
		 echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';		 	
		 
		 echo '<tr><td>Code lampe compatible</td><td><input size=15 type=text name=compatible_lamp_code value="'.$compatible_lamp_code.'"></td></tr>';
		 
		 echo '<tr><td colspan=2>&nbsp;</td></tr>';		 
		 
         if ( $supply_on_stock==1)
         {
		    $checked = " CHECKED ";
         }		 		 
		 $html_check = "<input type=checkbox value=1 name=supply_on_stock ". $checked." >";
		 echo '<tr><td>Appro sur Stock</td><td>'. $html_check .'</td></tr>';		 
		 
		 // code HTML  du fournisseur :
		 $html = '<select name="supplier_short_name">';

		   $sql = 'select short_name 
		           from customers
		           order by 1';

	      $rs = $db->Execute($sql);
	      $html .=  '<option value="">';
	      
	      while (!$rs->EOF) 
	      {
		     $sel = "";			 
			 if ( $supplier_short_name )
			 {
				if ( $supplier_short_name == $rs->fields['short_name'])
				{
					 $sel .=  ' SELECTED ';
				}
			 }
		  
	         $html .=  '<option value="'. $rs->fields['short_name'] .'"  '. $sel .'>'.  $rs->fields['short_name'] ;
	         $rs->MoveNext();
	      }
		  

		 echo '<tr><td>Fournisseur</td><td>'. $html .'</td></tr>';		 
		 echo '<tr><td>Prix unitaire acheté</td><td><input size=5 type=text name=unit_order_price value="'.round($unit_order_price).'"></td></tr>';		 
	  }      	  
      break;
	  
      case clone_invoice:
	      $sql = "SELECT count( 1 ) value
					FROM orders_invoices
					WHERE ref_orders_id = ". $oID;
					
	      if ( exec_select ($sql) > 0)
		    echo '<font color="red">Attention, le cette pièce a été clonée ' . exec_select ($sql) .  ' fois  </font>';
		  
     	  echo '<br><br><br><br>Pour cloner la pièce courante, choisir le type de pièce résutant,  et appuyer sur "OK". ';	  
		  if ( $_SESSION["source_db"]=="gl" )
		  {		  
	     	  echo '<br><br><br><br><select name="target_type">
			                        <option value=""> 
			                        <option value="DB"> Facture Easylamps
			                        <option value="CR"> Avoir Easylamps				
			                        <option value="DH"> Facture HPL
			                        <option value="CH"> Avoir HPL													
			                        <option value="PF"> Proforma
			                        <option value="BL"> Bon de livraison	
	                                </select>';	  	 
          }						
          else
		  {		  
	     	  echo '<br><br><br><br><select name="target_type">
			                        <option value="CM"> Commande
	                                </select>';	  	 
          }						
		  
								
      break;	  
	  case 'history':
      $orders_statuses = array();
      $status_query = $db->Execute("select orders_status_id, orders_status_name
                                    from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$_SESSION['languages_id'] . "'");
      while (!$status_query->EOF) {
        $orders_statuses[] = array('id' => $status_query->fields['orders_status_id'],
                                   'text' => $status_query->fields['orders_status_name']);
        $status_query->MoveNext();
      }
?>
    <tr>
      <td align="center" class="pageHeading"><?php echo HEADER_EDIT_ORDER . $oID; ?></td>
    </tr>
    <tr>
      <td align="center" class="main"><strong><?php echo HEADER_EDIT_HISTORY; ?></strong></td>
    </tr>
    <tr>
      <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
    </tr>
<!-- Begin Order Status History -->
    <tr>
      <td align="center"><table border="1" cellspacing="0" cellpadding="5">
        <tr>
          <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_DATE_ADDED; ?></strong></td>
          <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_STATUS; ?></strong></td>
          <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_COMMENTS; ?></strong></td>
          <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_DELETE_COMMENTS; ?></strong></td>
        </tr>
<?php
    $orders_history = $db->Execute("select * from " . TABLE_ORDERS_STATUS_HISTORY . "
                                    where orders_id = '" . $oID . "'
                                    order by orders_status_history_id asc");
    if ($orders_history->RecordCount() > 0) {
      while (!$orders_history->EOF){
        echo '        <tr>' . NL .
             '          <td class="smallText" align="center">' . zen_datetime_short($orders_history->fields['date_added']) . '</td>' . NL;

        $status_id = 'status_' . $orders_history->fields['orders_status_history_id'];
        $status_default = $orders_history->fields['orders_status_id'];
        $comments_id  = 'comments_' . $orders_history->fields['orders_status_history_id'];
        $comments_default = zen_db_scrub_out($orders_history->fields['comments']);
        $delete_id = 'delete_' . $orders_history->fields['orders_status_history_id'];

        echo '          <td>' . zen_draw_pull_down_menu($status_id, $orders_statuses, $status_default) . '</td>' . NL;
        echo '          <td>' . zen_draw_textarea_field($comments_id, 'soft', '30', '2', $comments_default) . '</td>' . NL;
        echo '          <td align="center">' . zen_draw_checkbox_field($delete_id, 1) . '</td>' . NL;
        echo '        </tr>' . NL;

        $orders_history->MoveNext();
      }
    } else {
        echo '          <tr>' . NL .
             '            <td class="smallText" colspan="4">' . TEXT_NO_ORDER_HISTORY . '</td>' . NL .
             '          </tr>' . NL;
    }
?>
      </table></td>
    </tr>
<!-- End Order Status History -->
<?php
    break;


    case 'total':
//      require(DIR_WS_CLASSES . 'currencies.php');
//      $currencies = new currencies();
?>
    <tr>
      <td colspan="2" align="center" class="pageHeading"><?php echo HEADER_EDIT_ORDER . $oID; ?></td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="main"><strong><?php echo HEADER_EDIT_TOTAL; ?></strong></td>
    </tr>
    <tr>
      <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
    </tr>
<!-- Begin Order Total Block -->
<?php
      $TotalArray = array();
      $totals_query = $db->Execute("select * from " . TABLE_ORDERS_TOTAL . "
                                    where orders_id = '" . $oID . "' order by sort_order");
      while (!$totals_query->EOF) {
        $TotalArray[] = array("Name" => $totals_query->fields['title'],
                              "Price" => number_format($totals_query->fields['value'], 2, '.', ''),
                              "Class" => $totals_query->fields['class'],
                              "TotalID" => $totals_query->fields['orders_total_id']);

        if ($totals_query->fields['class'] == 'ot_subtotal') {
          // This blank entry allows for entering a special order adjustment
          $TotalArray[] = array("Name" => "",
                                "Price" => "",
                                "Class" => "ot_custom",
                                "TotalID" => "0");
        }
        $totals_query->MoveNext();
      }

      foreach ($TotalArray as $TotalIndex => $TotalData) {
        if($TotalData["Class"] == "ot_subtotal" || $TotalData["Class"] == "ot_total") {
          echo '    ' . zen_draw_hidden_field('update_totals[' . $TotalIndex . '][title]', trim($TotalData["Name"])) . NL;
          echo '    ' . zen_draw_hidden_field('update_totals[' . $TotalIndex . '][value]', $TotalData["Price"]) . NL;
          echo '    ' . zen_draw_hidden_field('update_totals[' . $TotalIndex . '][class]', $TotalData["Class"]) . NL;
          echo '    ' . zen_draw_hidden_field('update_totals[' . $TotalIndex . '][total_id]', $TotalData["TotalID"]) . NL;
?>
    <tr>
      <td class="main" align="right"><strong><?php echo $TotalData["Name"]; ?></strong></td>
      <td class="main" align="right"><strong><?php echo $currencies->format($TotalData["Price"]); ?></strong></td>
    </tr>
<?php
        }
        else {
          if ($TotalData["Class"] == 'ot_shipping') {
            $format_shipping = explode(" (", $TotalData["Name"], 2);
            $clean_shipping = rtrim($format_shipping[0], ":");
            $display_title = $clean_shipping . ':';
          }
          else {
            $display_title = $TotalData["Name"];
          }
          echo '    ' . zen_draw_hidden_field('update_totals[' . $TotalIndex . '][class]', $TotalData["Class"]) . NL;
          echo '    ' . zen_draw_hidden_field('update_totals[' . $TotalIndex . '][total_id]', $TotalData["TotalID"]) . NL;
?>
    <tr>
      <td align="right" class="main"><?php echo zen_draw_input_field('update_totals[' . $TotalIndex . '][title]', trim($display_title)); ?></td>
      <td align="right" class="main"><?php echo zen_draw_input_field('update_totals[' . $TotalIndex . '][value]', $TotalData["Price"], 'style="text-align:right"'); ?></td>
    </tr>
<?php
        }
      }  // END foreach
?>
<!-- End Order Total Block -->
<?php
    break;

  }  // END switch ($target)
?>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '15'); ?></td>
      </tr>
      <tr>
        <td class="main" colspan="3" align="right">
          <input type="button" value="<?php echo BUTTON_CANCEL; ?>" onclick="closePopup()">
          <input type="submit" value="<?php echo BUTTON_SUBMIT; ?>" onclick="document.edit.submit();this.disabled=true">
        </td>
      </tr>
      </form>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->
</body>
</html>
<?php
  }  // END else
?>