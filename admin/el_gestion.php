<?php
  set_time_limit(10000);


/*  PDF Order Center 1.0 for Zen Cart v1.2.6d
 *  By Grayson Morris, 2006
 *  Printing sections based on Batch Print Center for osCommerce by Shaun Flanagan
  * Released under the Gnu General Public License (see GPL.txt)
 *
 * admin/pdfoc.php
 *
 *
 * PHP values:
 *  $_GET params : action, page, oID, mkey, form
 *  $_POST params : file_type, status, use_selected_orders,
 *                  omit_selected_orders, customer_data, order_numbers, startdate, enddate,
 *                  pull_status, orders_begin, orders_end, notify_comments, notify,
 *                  show_comments, orderlist[] to hold checked orders
 *  $_SESSION : ['pdfoc']['order_query'], ['pdfoc'][x] where x is a $_POST key
 *
 *
 * Three forms:
 * 1) pdfoc_selection: submits orderID info for selection and display of orders.
 * 2) pdfoc_action: submits action paramters for acting on the current order selection.
 * 3) pdfoc_deletion: deletes the current order selection.
 */
function mailup_mail($sender, $to, $mailID, $parameters, $file, $time){
	$url = 'http://easylamps.eu:9000/send-mail';
	$mailsProperties = array('mail-id' => $mailID, 'email-adress' => $to);
	
	if(!empty($sender))
		$mailsProperties['email-sender'] = $sender;
	if(!empty($file))
		$mailsProperties['file1'] = "@".$file;
	if(!empty($time))
		$mailsProperties['time'] = $time;

	$fields = array_merge($mailsProperties, $parameters);
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

//$_SESSION['admin_id']=2;

require('includes/application_top.php');
//echo $_GET['page'];
require('includes/common_sets.php');

require(DIR_WS_CLASSES . 'currencies.php');
require(DIR_WS_CLASSES . 'order.php');
require('el_fonctions_gestion.php');

  if ( ( $_SESSION['admin_id']==5 ) &&(strlen($_SESSION['source_db'])==0) )
  {
      $_SESSION['source_db'] = "po";	  	  
  }
  else if ( ($_SESSION['source_db']=="po") && ( $_SESSION['admin_id']!=5 ) )
  {
      $_SESSION["what"] = "";	  	  
  }

if (strlen($_GET['source_db'])>0)
{
	$_SESSION['source_db']=$_GET['source_db'];
}
  
  //echo 'LLLLLLLLLLLLLLL'.$_SESSION['admin_id'].'LLLLLLLLLLLLLLL'.$_SESSION['source_db'].'LLLLLLLLLLLLLLL';

if (strlen($_SESSION['init_batch'])==0)
{
   init_batch_items();
} 

  // récupération des tickets
  
	$tickets = get_tickets(0,1);	
  
  if ( $_SESSION['admin_id']==2 )
  {
      $may_change_order = 0;
  }
  else
  {
      $may_change_order = 1;    
  }

if  (  ( strlen($_POST['ord_id']) == 0 )  )
{
		if  ($_GET['action']<>'el_refresh')  
	{
//echo '.'.$_GET['source_db'].'.';
/*
		  if ( ( $_SESSION['source_db']=='po' ) 
		        && strlen($_SESSION['what']==0) )
		  {
		     $_SESSION['what']="PO";
		  }
		  else
		  */
		  {		  
/*
		  
		     if ( 
			       ( $_SESSION["what"]=="po" ) ||  ( $_SESSION["what"]=="ecc" ) 
				   && ( $_SESSION["source_db"]!="po" )
				)
			 {
				$_SESSION["what"] = "CMD";
			 }
			 else */
			 if (  ( strlen($_GET["what"])==0 )
			        && ( $_SESSION["source_db"]=="po" ) 
			        && (strlen($_SESSION['what']==0))  )
			 {
			   $_SESSION['what']="po";
			 }			 
			 else if ( strlen($_GET["what"])>0 )
			 {
				$_SESSION["what"] = $_GET['what'];
			 }			
	      }
//echo  $_SESSION['what'];exit; 
		  
    	$_SESSION['order_numbers'] = $_GET['order_numbers'];
		$_SESSION['el_pull_status'] = $_GET['el_pull_status'];	  
		$_SESSION['customer_data'] = $_GET['customer_data'];
		$_SESSION['customer_id'] = $_GET['customer_id'];
		$_SESSION['numero_facture'] = $_GET['numero_facture'];
		$_SESSION['montant'] = $_GET['montant'];		
		$_SESSION['critere_tri'] = $_GET['critere_tri'];
		$_SESSION['critere_produit'] = $_GET['critere_produit'];	
		
		$_SESSION['produit_si'] = $_GET['produit_si'];		
		
		$_SESSION['site_internet'] = $_GET['site_internet'];
		$_SESSION['ref_cmd'] = $_GET['ref_cmd'];
		$_SESSION['type_piece'] = $_GET['type_piece'];				
		$_SESSION['zone_geo'] = $_GET['zone_geo'];						
/*		
		if (( strlen($_GET["submit_cmm"])>0 ) || ( $_GET['source_db'] != "gl" ) )
    		$_SESSION['type_piece'] = $_GET['type_piece'];		
		else
       	    $_SESSION['type_piece'] = 'FA';		
*/		
		$_SESSION['type_paiement'] = $_GET['type_paiement'];		
		$_SESSION['type_date'] = $_GET['type_date'];				
		$_SESSION['startdate'] = $_GET['startdate'];		
		$_SESSION['enddate'] = $_GET['enddate'];		

		// modifications de forcées de critères --------
/*		
        if ($_SESSION['what']=="rc")
		{
		    if ($_SESSION['el_pull_status']==0)
			    $_SESSION['el_pull_status']=2;
				
			if  (strlen($_SESSION['critere_tri'])==0)
		        $_SESSION['critere_tri']="RETARD";
		}		
*/		
	}
	else
	{
	   // echo 'el_refresh' ;
	}
}

//echo $_GET['action'];
// fonction popup
/// la requete de base
    if ( $_SESSION['source_db'] == "po" )
	{
	  $add_select .= ",o.treatment_date"; 	
	}
    if ( $_SESSION['what'] == "cmmv" )
	{
	  $add_select .= ", rvc.client_load"; 		
	  $add_from .= " LEFT OUTER JOIN el_rv_customers rvc ON ( o.customers_id = rvc.customers_id ) "; 	
	}

	if  ( 
		( $_GET['form']!='action' ) &&
		(  ( $_SESSION["what"]=="prd" ) || ( $_SESSION["what"]=="frs" ) || ( $_SESSION["what"]=="po" )
       	||  ( $_SESSION["what"]=="fo" ) ||  ( $_SESSION["what"]=="ecc" ) )
		)
	{ 
//echo 'in a';	
	  $add_select .= ",orders_products.products_model, 
					 orders_products.products_name,
					 orders_products.products_price, 
					 orders_products.final_price ,
					 orders_products.products_tax ,
					 orders_products.products_quantity";
//echo  $_SESSION["what"];exit;					 
	  // FV 
	  if ( $_GET['form']!='action' )
	  {
		  if ( ( $_SESSION["what"]=="po" ) ||  ( $_SESSION["what"]=="ecc" ) ||  ( $_SESSION["what"]=="fo" )  )
		  {
		  $add_select .= " ,
						 orders_products.po_orders_products_id,
						 orders_products.unit_order_price,
						 orders_products.usd_euro_rate,
						 orders_products.margin,
						 orders_products.orders_products_id,
						 orders_products.supply_on_stock,					 
						 orders_products.compatible_lamp_code,					 
						 orders_products.supplier_short_name,
						 orders_products.orders_products_id					 
						 ";
		  }
	   }
	  $add_from = " , orders_products ";
	  if ( $_SESSION["what"]=="frs" )
	  {
		  $add_where = " and orders_products.orders_id = o.orders_id 
		   and products_model  in ('SHF','CODF','ECOF','ESCF','ESCC','FRSH','FRS') ";
	  }
	  else
	  {
		  $add_where = " and orders_products.orders_id = o.orders_id 
		   and products_model not in ('SHF','CODF','ECOF','ESCF','ESCC','FRSH','FRS') ";	  
	  }
	  if ( strlen ( $_SESSION['critere_produit'] ) >  0 )
	  {
	     $add_where .= " and ( ( orders_products.products_model like '%". $_SESSION['critere_produit'] ."%' )
		                      or ( orders_products.products_name like '%". $_SESSION['critere_produit'] ."%' ) ) ";
	  }
	  if ( strlen ( $_SESSION['produit_si'] ) >  0 )
	  {
	     $add_where .= " and (  orders_products.products_model 
		                      in ( 
									select ref_constructeur_composant 
									from rv_lampe_eu.el_v_composants_sans_prix 
									where libelle_constructeur = 'SI' 
									) ) ";
	  }
	  
//	  $add_where = " and orders_products.orders_id = o.orders_id ";	  
	}
	else
	{
	  if ( strlen ( $_SESSION['critere_produit'] ) >  0 )
	  {
	     $add_where = " and ( o.orders_id in 
                               ( select orders_products.orders_id
                               from orders_products
							   where 
							     ( ( orders_products.products_model like '%". $_SESSION['critere_produit'] ."%' )
		                        or ( orders_products.products_name like '%". $_SESSION['critere_produit'] ."%' ) )
							  )
                            )	";
	  }	
	}
	 // FV po
     if ( $_SESSION['source_db'] == "po" )
	 {
	   if ( $_SESSION["what"] == "fo" )
	   {
//			$add_where_po = " and o.orders_id>99999 ";	   
//			$add_where_po = " and exists (select 1 from customers where o.customers_id = customers.customers_id )";	   
			$add_where_po = " and o.database_code = 'po' ";	   	   
	   }
	   else
	   {
			$add_where_po = " and o.database_code <> 'po' ";	   	   
	   }	   
	 }
	 $mstr_orders_query = "select o.orders_id, o.customers_id, o.billing_name, 
		                        o.billing_company, o.customers_email_address, o.customers_telephone, 
								 o.customers_country,o.date_purchased, o.orders_status, 
								o.ref_info, ot.text as order_total ,
								o.order_total as totalttc, 
								o.payment_module_code,
								o.payment_method, 
								o.orders_date_finished,
								o.payment_conditions_code, 							
								o.payment_conditions_desc, 
								oi.orders_invoices_id,
								oi.invoice_type,
								oi.invoice_date,
								o.payment_info,
								o.payment_amount,
								CASE WHEN payment_conditions_code = '60JN' 
									THEN DATEDIFF(now(),oi.invoice_date)-60
									WHEN payment_conditions_code = '30FM' 
									THEN DATEDIFF(now(),LAST_DAY(oi.invoice_date))-30
									ELSE  
									DATEDIFF(now(),oi.invoice_date)-30 
									END retard,
								o.database_code " .  $add_select  . ",
								o.currency,
								o.currency_value					 
					      from orders o left join orders_total ot  
						             on (o.orders_id = ot.orders_id) 
							         LEFT OUTER JOIN orders_invoices oi
	                                 ON ( o.orders_id = oi.orders_id ) " .  $add_from  . "
							where o.orders_id>0 	" . $add_where_po . $add_where  . "					
							and (ot.class = 'ot_total')	";
						
//echo	$mstr_orders_query;					
echo '
<script type="text/javascript">
  <!--
  function popupWindow(url, features) {
    window.open(url,\'popupWindow\',features)
  }
  // -->
</script>
</head>';
// multiples validations
$ord_ids=explode(',',$_POST['ord_id']);

$force_dbs=explode(',',$_POST['force_db']);
//echo count($ord_ids);
$premier_passage=1;
$cnt_cmd=0;

foreach ($ord_ids as $order_id) 
{

	$force_db=$force_dbs[$cnt_cmd];
	$cnt_cmd++;
	if (  (strlen( $_GET['source_db'] )>0) || (strlen( $force_db )>0) )
	{
	  if ( strlen( $force_db )>0 )
	     $_SESSION['source_db']=$force_db;
	  else
	     $_SESSION['source_db']=$_GET['source_db'];
	}

	if  ( strlen( $_SESSION['source_db'] )==0 )
	{
	   $_SESSION['source_db'] = 'gl';
	}
	if  (  (strlen( $_SESSION['source_db'] )>0) &&  ( $_SESSION['source_db'] != 'gl' ) )
	{
	    // affichage des quantités en stock
	   if ( ( $_SESSION['source_db'] == "po" ) && ( strlen( $_SESSION['init_quantities']  )==0 )  ) 
	   {
	      init_stock_quantities();
	   }
	   $db->connect($ext_db_server[$_SESSION['source_db']], $ext_db_username[$_SESSION['source_db']], $ext_db_password[$_SESSION['source_db']], $ext_db_database[$_SESSION['source_db']], USE_PCONNECT, false);
	}

	 $status = zen_db_prepare_input($_POST['status']);

	// duplication de  la commande dans la base de facture si on facture un site externe ---
	if ( $_POST['invoice_mode']=='final' &&  ($_SESSION['source_db'] != 'gl')  )
	{
			if ($premier_passage)
			{ 
		        require_once(DIR_WS_CLASSES . 'super_order.php');
		        // require(DIR_WS_CLASSES . 'currencies.php');
		        $currencies = new currencies();
			}
			$oID = $order_id;
			
		    $old_order = $db->Execute("SELECT * FROM " . TABLE_ORDERS. " WHERE orders_id = '" . $oID . "' LIMIT 1");
			if ( ($old_order->fields['orders_status']==3) || ($old_order->fields['orders_status']==2) )
			{
			  echo 'La commande '. $oID.' etait déjà expédiée ou payée'."<br>";
			  $commande_expediee=1;
			}  
			else
			{
			  $commande_expediee=0;
			}
	        if ($commande_expediee==0) 
			{
	          // Duplicate order details from "orders" table
			  // information de référénce
			  if ( strlen($old_order->fields['ref_info'])>0  )
			  {
			     $ref_info = $old_order->fields['ref_info'];
			  }
			  else
			  {
			     $ref_info = $old_order->fields['orders_id'];
			  }        
			  if  (true)  
			  {
				  // en cas de batch on applique les factures MKP avec un statut 1
				  if ( strlen($_POST['batch_id'])>0 )
				  {
				      if (  
					       ( substr($old_order->fields['payment_module_code'],0,3)=="MKP")
						   &&
						   ( $old_order->fields['payment_module_code']!="MKP_ebay" )
						   )
						   {
						       $status=2;
						   }
						   else
						   {
						       $status=3;						   
						   }
				  }
			  
	   		      // vérifier l'existence d'une commande pré-existante
				  $db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);        			  
				  
				  $test = $db->Execute('select orders_id from orders_invoices where  orders_id = '.$oID ) ;

				  // if (  true )
				  if ( strlen($test->fields['orders_id'] ) > 0  )			  
				  {
					 $maxQry = $db->Execute('select max(orders_id)+1 new_oid from orders') ;			 
					 $newID  = $maxQry->fields['new_oid']; 		  
				  }
				  else
				  {
				      $newID = 	$oID;	   
				  }	
				  if ( $status == 1 )
				  {
					  // pour les BL on produit la référence 
					  $sql = "select count(1) cnt
					          from orders_invoices 
							  where ref_orders_id = " . $oID;
					  $cnt = $db->Execute($sql);
					  $nb_bl = $cnt->fields['cnt']+1;
					  if ( strlen($old_order->fields['ref_info'])>0 )
					  {
					      $ref_info = $old_order->fields['ref_info'].'-'.$nb_bl;
					  }
					  else
					  {
					      $ref_info = $old_order->fields['orders_id'].'-'.$nb_bl;		      
					  }		  			  
				  }
				  $db->connect($ext_db_server[$_SESSION['source_db']], $ext_db_username[$_SESSION['source_db']], $ext_db_password[$_SESSION['source_db']], $ext_db_database[$_SESSION['source_db']], USE_PCONNECT, false);        			  
			  }
			  else
			  {
	              $newID = 	$oID;	     
			  }
	          if  (   ( $old_order->fields['billing_name'] == $old_order->fields['delivery_name'] )
			         && (  strlen ( $old_order->fields['billing_company']  ) > 0 ) )
			   {
			       $billing_name = "";
			   }
			   else
			   {
			       $billing_name = $old_order->fields['billing_name'];
			   }
				 
			  if ( $status == 1 )
			  {
			    $new_status = 5;
			  }
			  else
			  {
			    // $new_status = $old_order->fields['orders_status'];
				$new_status = $status;
			  }
			  // on va chercher le Intracom
			  $intracom_select = " select ab.entry_tva_intracom 
		                  from address_book ab, customers c, countries
		                  where  ab.customers_id = c.customers_id
		                   and   c.customers_default_address_id =  ab.address_book_id 
						   and   entry_country_id = countries_id
						   and   ab.customers_id = " . $old_order->fields['customers_id'] ;
						   
			  $recordSet = $db->Execute( $intracom_select );
			  $intracom = $recordSet->fields['entry_tva_intracom'];
						   
			          
	          $new_order = array('orders_id' => $newID,
	                             'customers_id' => $old_order->fields['customers_id'],
	                             'customers_name' => $old_order->fields['customers_name'],
	                             'entry_tva_intracom' => $intracom,							 
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
	                             'billing_name' => $billing_name,
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
	                             'payment_conditions_desc' => $old_order->fields['payment_conditions_desc'],
	                             'payment_conditions_code' => $old_order->fields['payment_conditions_code'],							 
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
	                             'orders_status' => $new_status,                             
	                             'currency' => $old_order->fields['currency'],
	                             'currency_value' => $old_order->fields['currency_value'],
	                             'order_total' => $old_order->fields['order_total'],
	                             'languages_id' => $old_order->fields['languages_id'],
	                             'database_code' => $old_order->fields['database_code'],	
	                             'ref_info' => $ref_info,							 							 							 
	                             'orders_date_finished' => $old_order->fields['orders_date_finished'],							 							 							 							 							 
	                             'payment_info' => $old_order->fields['payment_info'],							 							 							 							 
	                             'payment_amount' => $old_order->fields['payment_amount'],							 							 							 							 							 
	                             'products_tax' => $old_order->fields['products_tax'],							 							 							 
	                             'order_tax' => $old_order->fields['order_tax']);
			  

	          // update "orders_status_history" table
	          $status_cnt = 0;
	          $old_order_status_history = $db->Execute("SELECT * FROM " . TABLE_ORDERS_STATUS_HISTORY . " WHERE orders_id = '" . $oID . "'");
			  
	          while (!$old_order_status_history->EOF) 
			  {
	            $status_cnt++;                                  
			    $new_order_status_history[$status_cnt] = array('orders_id' => $newID,
	                                              'orders_status_id' => $old_order_status_history->fields['orders_status_id'],
	                                              'date_added' => $old_order_status_history->fields['date_added'],
	                                              'customer_notified' => $old_order_status_history->fields['customer_notified'],
	                                              'comments' => $old_order_status_history->fields['comments']);
	            $old_order_status_history->MoveNext();
	          }
	          // les produits --------------------------------------
	          $products_cnt = 0;
	          $old_products = $db->Execute("SELECT * FROM orders_products WHERE orders_id = '" . $oID . "' order by sort_order,  orders_products_id desc");
			  $totalht = 0;
	          while (!$old_products->EOF) 
			  {
	            $products_cnt++;  					  
				if ( $old_products->fields['sort_order'] > 0 )
				  $sort_order = $old_products->fields['sort_order'];
				else
				  $sort_order = $products_cnt*10;
				  
	    		$new_products[$products_cnt] = array('orders_id' => $newID,
	                                              'products_id' => $old_products->fields['products_id'],
	                                              'products_model' => $old_products->fields['products_model'],
	                                              'products_name' => $old_products->fields['products_name'],
	                                              'final_price' => $old_products->fields['final_price'],
	                                              'products_tax' => $old_products->fields['products_tax'],
	                                              'products_quantity' => $old_products->fields['products_quantity'],
												  'sort_order'=>$sort_order,
	                                              'products_prid' => $old_products->fields['products_prid'] );
												  
		        $pprice = $old_products->fields['final_price'];
				$qty = $old_products->fields['products_quantity'];
		        $detailht = $pprice*$qty;

	            $totalht += $detailht;
												  
				$tax = $old_products->fields['products_tax'];
	            $old_products->MoveNext();
	          }
			  /// les totaux --------------------------------------------
			  
	          $order_total_cnt = 0;
			  $new_order_total = array();
			  
			  $sql = "SELECT * FROM " . TABLE_ORDERS_TOTAL . " WHERE value <> 0 and orders_id = " . $oID ;
	          $old_order_total = $db->Execute($sql);
			  
			  $ot_coupon_exists = 0;
	          while (!$old_order_total->EOF) {
			    
			    // gestion specifique des frais de port, COD et eco-contribution --
	            if (  ( $old_order_total->fields['class']=='ot_shipping' )
	                 || ( $old_order_total->fields['class']=='ot_cod_fee' )
	                 || ( $old_order_total->fields['class']=='ot_payment' )					 
	                 || ( $old_order_total->fields['class']=='ot_coupon' )					 
	                 || ( $old_order_total->fields['class']=='ot_loworderfee' ) )
	            {
	                 // $p_product_type=="ot_shipping" || $p_product_type=="ot_cod_fee"
					 $new_name = strip_tags( strip_tags($old_order_total->fields['title']) );
					 $new_name  = str_replace ( ":","",$new_name);
					 
	                 if ( $old_order_total->fields['class'] == 'ot_shipping' )
					 {
					   $new_model = 'SHF';
					   if ( $old_order->fields['languages_id'] == 4 )
					   {
					      $new_name = 'Versandkostenpauschale';
					   }					  
					 }
					 else if ( $old_order_total->fields['class'] == 'ot_cod_fee'  )
					 {
					   $new_model = 'CODF';
					 }
					 else if ( $old_order_total->fields['class'] == 'ot_payment'  )
					 {
					   $new_model = 'FFRAIS';
					 }					 
					 else if ( $old_order_total->fields['class'] == 'ot_loworderfee'  )
					 {
					   $new_model = 'ECOF';
	    			   $new_name  = "Eco-contribution"; 
					 }
					 $new_price = $old_order_total->fields['value'];				 				 				 
					 if ( ( $old_order->fields['database_code'] != 'eu' ) && (  strpos($new_name,'RSCF') ==0 ) )
					 {
	    			    $new_price = round ( $new_price / ( 1 + ( $tax / 100 ) ),2);
				     }	
					 if ( $old_order_total->fields['class'] == 'ot_shipping'  )
					 {
					    $sql = "SELECT count(1) cnt FROM " . TABLE_ORDERS_TOTAL . " WHERE class='ot_coupon' and orders_id =" . $oID ;
						$rs3 = $db->Execute($sql);
						
						$ot_coupon_exists = $rs3->fields['cnt'];
					 }
					 
//  $dml = "insert into bo_po.dbg ( txt) values ('before  coupon". $old_order_total->fields['class'] . " ')";  
//  $db->Execute($dml);
					 
					 if ( ( $old_order_total->fields['class'] == 'ot_coupon'  )
					      && (  strpos($new_name,'RSCF')>0 ) )
					 {
					    //						$db->
 					  $dml = "insert into bo_po.dbg ( txt) values ('in coupon')";
					  $db->Execute($dml);

						 $products_cnt++;  					  				 
						 $new_price = -1 * $new_price;
						 $new_products[$products_cnt] = array('orders_id' => $newID,
			                                              'products_id' => -1,
			                                              'products_model' => 'REDUCTION',
			                                              'products_name' => $new_name,
			                                              'final_price' => $new_price,
			                                              'products_tax' => $tax,
			                                              'products_quantity' => 1,
														  'sort_order'=>$products_cnt*100,
			                                              'products_prid' => -1 );						
						 $totalht += $new_price;
														  
					 }
					 else if ( 
					       ! (
  						      (  ( $old_order_total->fields['class'] == 'ot_coupon'  ) )
						        || 
						      (   ( ( $old_order_total->fields['class'] == 'ot_shipping'  ) && (  $ot_coupon_exists==1 )  ) )
							 )
						  )
					{
					 
						 $totalht += $new_price;
						 
						 $products_cnt++;  					  				 
						 $new_products[$products_cnt] = array('orders_id' => $newID,
			                                              'products_id' => -1,
			                                              'products_model' => $new_model,
			                                              'products_name' => $new_name,
			                                              'final_price' => $new_price,
			                                              'products_tax' => $tax,
			                                              'products_quantity' => 1,
														  'sort_order'=>$products_cnt*100,
			                                              'products_prid' => -1 );
					}
	            } 
	            else
	            {
	    		   $order_total_cnt++;
				   $new_title = $old_order_total->fields['title'];
				   if ( $old_order_total->fields['class'] == 'ot_subtotal' )
				   {
				      $new_title = str_replace('TTC','' ,$new_title );
				   }

	               $new_order_total[$order_total_cnt] = array('orders_id' => $newID,
	                                        'title' => $new_title,
	                                        'text' => $old_order_total->fields['text'],
	                                        'value' => $old_order_total->fields['value'],
	                                        'class' => $old_order_total->fields['class'],
	                                        'sort_order' => $old_order_total->fields['sort_order']);
	            }
	            $old_order_total->MoveNext();
	          }
	          // modification du statut de la commande source pour envoyée
			  if ( $status == 1 )		  
			  {
			     $dml = "update orders set orders_status = 4 where orders_id = " . $oID ;
	    		  $db->Execute( $dml );		 
			  }
			  else if ( $status != 4 )
			  {
			     $dml = "update orders set orders_status = 3 where orders_id = " . $oID ;
	    		 $db->Execute( $dml );
			  }
			  
			  /// insertions ---------------------------------------------------------------------------------------------------------------------------
	          $db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);
	          zen_db_perform(TABLE_ORDERS, $new_order);

	          /// historique 		---------------------------  
			  $loop = true;
			  $iter = 1;
			  if ( $status_cnt>0 )
			  {
				  while ($loop) 
				  {
		             zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $new_order_status_history[$iter]);
				     $iter++;
				     if ( $iter > $status_cnt )
		    		     $loop = false;
				  }
			  }
			  // produits ---------------------------------------------------
			  $loop = true;
			  $iter = 1;
			  while ($loop) 
			  {
			     // ordre remplacé à cause de phénomènes de génération de ligne en double...
	             zen_db_perform(TABLE_ORDERS_PRODUCTS, $new_products[$iter]);
/*				 
				 $dml="
				 insert into orders_total
					(	orders_id,
						title,
						text,
						value,
						class,
						sort_order)
					values
					 (". $new_order_total[$iter]['orders_id'].",
					  '".$new_order_total[$iter]['title']."',
					  '".$new_order_total[$iter]['text']."',
					  '".$new_order_total[$iter]['value']."',
					  '".$new_order_total[$iter]['class']."',
					  '".$new_order_total[$iter]['sort_order']."')";
echo $dml.'<br>';
                 $db->Execute($dml);					  
				 */
				 
			     $iter++;
			     if ( $iter > $products_cnt )
	    		     $loop = false;
			  }
			  // totaux -------------------------------------
			  $loop = true;
			  $iter = 1;
			  
			  while ($loop) 
			  {			  
	             zen_db_perform(TABLE_ORDERS_TOTAL, $new_order_total[$iter]);
			     $iter++;
			     if ( $iter > $order_total_cnt )
	    		     $loop = false;
			  }
			  // fin des insertions -------------------------------------------------------------------------------------------------
			  /* code caduque suite à l'appel systématique order_total
			  //  correction des montant HT et total Tax sur orders et orders total 
			  $totalttc = $old_order->fields['order_total'];
			  $totaltax = $totalttc - $totalht;

			  $ot_text = $currencies->format($totalht);
			  
	          $dml = "update orders_total set value = " . $totalht . ", text = '".  $ot_text . "' where orders_id = " . $newID . " and class = 'ot_subtotal' ";
			  $db->Execute($dml);
			  
			  $ot_text = $currencies->format($totaltax);
	          $dml = "update orders_total set value = " . $totaltax . ", text = '".  $ot_text . "' where orders_id = " . $newID . " and class = 'ot_tax' ";
			  $db->Execute($dml);
			  
	          $dml = "update orders set products_tax = " . $tax . ", order_tax = ". $totaltax . "  where orders_id = " . $newID;
			  $db->Execute($dml);
			  */		  		  
			  // attribution d'un nuéro de facture
			  
			  if ( $status == 1 )
			  {
				  $invoice_type = 'BL';
			  }
	          else 
			  {
				  if  ( ($_SESSION['source_db']=='hp') || ($_SESSION['source_db']=='rq') || ($_SESSION['source_db']=='tb') )
					$invoice_type = 'DH';
				  else
					$invoice_type = 'DB';
			  }
	//echo ".".$invoice_type.',';		  
			  $invoice_id = get_invoice_id ( $newID  , $invoice_type , 1, $oID );
			  
	//echo 'l'. $invoice_id . 'l';		  
			  // on applique un double sur la base de données  source
	          $db->connect($ext_db_server[$_SESSION['source_db']], $ext_db_username[$_SESSION['source_db']], $ext_db_password[$_SESSION['source_db']], $ext_db_database[$_SESSION['source_db']], USE_PCONNECT, false);

	          $dml = "delete from orders_invoices where invoice_type = '" . $invoice_type . "' and orders_invoices_id = ". $invoice_id ;
			  $db->Execute($dml);
			  
	          $dml = "insert into orders_invoices ( orders_invoices_id ,invoice_type, orders_id, order_total, invoice_date, ref_orders_id )
					   values ( ". $invoice_id .",'" . $invoice_type . "',". $newID . ", 1, now() , " .  $oID . " )";
					   
//echo $_SESSION['source_db'].$dml;	exit;
//echo $dml.'..before2<br>'.$_SESSION['source_db'];					   				   
			  $db->Execute($dml);
//echo $dml.'..after2<br>';					   				   
			  
	          // on se reconnecte sous gl		  
	          $db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);
			  
			  // ----------  dans le cadre des BL gestion des reliquats   --------------------------
//			  if (!$order)
//			  {
	    		  $order = new order($newID);
//			  }		  
			  if ( $status == 1 )
			  {		  
				  // gestion_reliquats ( $p_orders_id, $p_orders_products_id=0, $p_ajout=0 , $p_init=0  )
	              gestion_reliquats ( $newID, 0, 0 , 1 );
				  recalc_total($oID);
	          }
			  else 
			  {
			      /// le recalc_total rajoute  le RIB
				  recalc_total($oID);			  
//echo '.....';exit;			
				  
			  }
		    }
	}


	//echo $ext_db["fr"];
	/*
	if  (  (strlen( $_GET['source_db'] )>0) &&  ( $_GET['source_db'] != 'gl' ) )
	            $db->connect($ext_db_server[$_SESSION['source_db']], $ext_db_username[$_SESSION['source_db']], $ext_db_password[$_SESSION['source_db']], $ext_db_database[$_SESSION['source_db']], USE_PCONNECT, false);
	*/

	// bof PDFOC orders statuses
	// bof if (isset($_SESSION['pull_status'])
	    if ( (strlen($order_id)==0)  && isset($_SESSION['pull_status']) && $_SESSION['pull_status']!='0') {
	        // the $_SESSION['pull_status'] overrules al other parameters and selects all orders having a certain order status
	        // links to select and set $_SESSION['pull_status'] are inserted into pdfoc_body.php
							
	        $orders_query = $mstr_orders_query ." and (o.orders_status = '". zen_db_input(zen_db_prepare_input($_SESSION['pull_status'])) . "') ";

	        $_SESSION['pdfoc']['orders_query'] = $orders_query; // needed?
	    } else {
	// eof PDFOC orders statuses


	     $all_orders_query = $mstr_orders_query . " order by o.orders_id desc ";
//echo $all_orders_query;
	// Step 1 :: Error checking
	// First check for an error message
	//
	if ($_GET['mkey']) { // there is an error message; abort any intended action and display error message instead
	                     // Note: this still displays last customer-selected orders in orders list
	  $key = $_GET['mkey'];
	  $message = $pdfoc_error[$key];  // $pdfoc_error[] is defined in admin/includes/languages/<language>/pdfoc.php

	  // want to redisplay the selected order list
	  
	  if (isset($_SESSION['pdfoc']['orders_query'])) {

	    $orders_query = $_SESSION['pdfoc']['orders_query'];

	  } else { // just get all orders
	//echo 'hello';
	    $orders_query = $all_orders_query;		
	  }
	  
	  $_GET['form'] = ''; // null out any specified action

	}

	// Step 2 :: Process the submitted form
	//

	//echo 'l'.$_GET['form'].'l';
	//echo 'l'.$_GET['customer_data'].'l';


	if (isset($_GET['form'])) {

	  switch ($_GET['form']) {

	    case 'selection':  // ------------- BOF selection -----------------------------------

		
	     // Determine which orders have been selected; if none specified, let
	     // the user know.

	    // First initialize some query variables so they don't give problems in the
	    // query if the corresponding selection method isn't set
	    //
	    $cdata_query = "1";
	    $order_checked_query = "1";
	    $order_numbers_query = "1";
	    $date_query = "1";
	    $status_query = "1";
	    $orders_query = $mstr_orders_query;
							
	    $order_checked_array=array();
	    $order_unchecked_array=array();
	    $checked_exist = 0;

	    // Determine which orders (if any) have been checked in the orders list
	    //
		if (  strlen ( $_SESSION['active_batches'] )>0 && isset( $_GET['orderlist'] ) )
		{
		    $batch_name = $_GET['use_selected_orders'];
			$batch_name = str_replace('+','',$batch_name);
			$db->connect($ext_db_server["gl"], $ext_db_username["gl"], $ext_db_password["gl"], $ext_db_database["gl"], USE_PCONNECT, false);

            $sql = "select batch_id value from el_batch where batch_name =ltrim(rtrim('". $batch_name."'))";
			
			$batch_id = exec_select ( $sql );
			
			if (strlen($batch_id)>0)
			{
			    foreach ((array)$_GET['orderlist'] as $k => $v ) 
				{
			        $order_checked_array[] = zen_db_prepare_input($v);
					$sql = "select 1 ok 
					       from el_batch_items 
						   where batch_id=".$batch_id ."  
						   and  item_id = ". zen_db_prepare_input($v)."  
						   or  subitem_id = ". zen_db_prepare_input($v);
					
					$rs = $db->Execute($sql);
					$exists=$rs->fields['ok'];
					if ( $exists==0 )
					{
						//if (true)
						if ( ( $_SESSION["what"]=="po" ) ||  ( $_SESSION["what"]=="ecc" ) ||  ( $_SESSION["what"]=="fo" ) )
						{
							$db->connect($ext_db_server[$_SESSION['source_db']], $ext_db_username[$_SESSION['source_db']], $ext_db_password[$_SESSION['source_db']], $ext_db_database[$_SESSION['source_db']], USE_PCONNECT, false);
						
							$subord_id = zen_db_prepare_input($v);
							$sql = "select orders_products.orders_id, products_model,products_name,
							               orders.database_code
								    from orders_products,orders 
							        where orders_products.orders_id = orders.orders_id 
									and orders_products_id = ". $subord_id;
							$rsk = $db->Execute($sql);
							
							$ord_id = $rsk->fields['orders_id'];
							$products_model = $rsk->fields['products_model'];
							$desc2 = $rsk->fields['products_name'];
							$dtb_code = $rsk->fields['database_code'];
							if ( ($dtb_code=="en") || ($dtb_code=="es") || ($dtb_code=="it")  || ($dtb_code=="de")  )
							{
							   if ( TRUE )								   
									$locc = 1;
								else 									
									$locc = 0;								
							}
							else
							{
							   $locc = 0;
							}
							// FV temporaire 
							$locc = 1;
//echo 	$products_model.'|'.$desc2;	exit;					
						}
						else
						{
							$ord_id = zen_db_prepare_input($v);
							$dtb_code = $_SESSION['source_db'];
							$db->connect($ext_db_server[$_SESSION['source_db']], $ext_db_username[$_SESSION['source_db']], $ext_db_password[$_SESSION['source_db']], $ext_db_database[$_SESSION['source_db']], USE_PCONNECT, false);							
							$locc=0;
						}

						
		                $sql = "select concat( ".$ord_id.",' - ', customers_company ,'  |  ',customers_name,'  |  ',customers_email_address,'  |  ', customers_country,'  |  ', customers_city ) value
			                  from orders
			                  where  orders.orders_id = ".$ord_id;
							  
					    $desc=addslashes(exec_select($sql));
						$db->connect($ext_db_server["gl"], $ext_db_username["gl"], $ext_db_password["gl"], $ext_db_database["gl"], USE_PCONNECT, false);
							   
						$dml = "insert into el_batch_items ( batch_id, item_id, database_code, description, subitem_id, description2, products_model, locc  ) 
				            	values	( " . $batch_id . ", " . $ord_id . ", '".$dtb_code."','".$desc."','".$subord_id ."','".$desc2."','".$products_model."',".$locc.")" ;
								
						$db->Execute($dml);
				    }
			        $checked_exist++;
					// FV
					$checked_exist = 0;
			    }
			}
	    	$db->connect($ext_db_server[$_SESSION['source_db']], $ext_db_username[$_SESSION['source_db']], $ext_db_password[$_SESSION['source_db']], $ext_db_database[$_SESSION['source_db']], USE_PCONNECT, false);
		}

	    // Option 0 :: the user has checked orders but pressed "submit" or "enter"
	    // instead of "use" or "omit". In this case redisplay the previous query
	    // and notify the user of the confusion. This prevents accidentally, say,
	    // deleting orders that the user didn't intend.
	    //
	    if ($checked_exist > 0 && !array_key_exists('omit_selected_orders',$_GET) && !array_key_exists('use_selected_orders',$_GET)) {

	      pdfoc_message_handler('PDFOC_ERROR_CONFLICTING_SPECIFICATION');

	    }

	    // Option 1 :: the user has pressed "use" or "omit".
	    //
			
	    if ($checked_exist==0 && array_key_exists('omit_selected_orders',$_GET)) { // none checked, pressed Omit, so show all; "order by" clause gets added below

	      $orders_query = $mstr_orders_query;

	    } elseif ($checked_exist==0 && array_key_exists('use_selected_orders',$_GET)) { // none checked, pressed Use, so let user know

	//      pdfoc_message_handler('PDFOC_NO_ORDERS');

	    } elseif ($checked_exist > 0 && array_key_exists('use_selected_orders',$_GET)) { // use checked orders

	      $order_checked = implode(',',$order_checked_array);
	      $order_checked_query = "o.orders_id in (" . zen_db_input($order_checked) . ")";
	      $orders_query .= " and (" . $order_checked_query . ")";

	    } elseif ($checked_exist > 0 && array_key_exists('omit_selected_orders',$_GET)) {  // use UNCHECKED orders

	      // first get the previously selected orders so we don't
	      // suddenly include things in the begin/end range that
	      // weren't included before
	      //
	      if (isset($_SESSION['pdfoc']['orders_query'])) {  // get previous query if there was one

	        $orders_query_check = $_SESSION['pdfoc']['orders_query'];

	      } else { // just get all orders
	        $orders_query = $all_orders_query;
	      }
	//echo 	  $orders_query ;
	      $orders = $db->Execute($orders_query_check);

	      while (!$orders->EOF) {
	        $oNos[$orders->fields['orders_id']] = true;
	        $orders->MoveNext();
	      }
	      $ocount=0;

	      for ($i=(int)$_POST['orders_begin']; $i<= (int)$_POST['orders_end']; $i++) {

	        if (!in_array($i, $order_checked_array) && isset($oNos[$i])) {

	          $order_unchecked_array[] = $i;
	          $ocount++;

	        }

	      }
	      // Just in case the user decided to omit everything....
	      //
	//      if ($ocount==0) { pdfoc_message_handler('PDFOC_NO_ORDERS'); }

	      $order_unchecked = implode(',',$order_unchecked_array);
	      $order_unchecked_query = "o.orders_id in (" . zen_db_input($order_unchecked) . ")";
	      $orders_query .= " and (" . $order_unchecked_query . ")";

	//echo 	  'jj'.$orders_query;

	    } else {  // didn't select orders from orders list

		
	      // Option 2 :: the user has  pressed the "submit" button or the "enter" key.
	      //
	      if (isset($_SESSION['customer_data']) && $_SESSION['customer_data']!='') {  // search for orders containing this data
	// billing_tva_intracom
	        $cdata = zen_db_input(zen_db_prepare_input($_SESSION['customer_data']));
	        $cdata_query = "(o.entry_tva_intracom like '%" . $cdata . "%') or  (o.customers_city like '%" . $cdata . "%') or (o.customers_postcode like '%" . $cdata . "%') or (o.billing_name like '%" . $cdata . "%') or (o.billing_company like '%" . $cdata . "%') or (o.billing_street_address like '%" . $cdata . "%') or (o.delivery_city like '%" . $cdata . "%') or (o.delivery_postcode like '%" . $cdata . "%') or (o.delivery_name like '%" . $cdata . "%') or (o.delivery_company like '%" . $cdata . "%') or (o.delivery_street_address like '%" . $cdata . "%') or (o.billing_city like '%" . $cdata . "%') or (o.billing_postcode like '%" . $cdata . "%') or (o.customers_email_address like '%" . $cdata . "%') or (o.customers_name like '%" . $cdata . "%') or (o.customers_company like '%" . $cdata . "%') or (o.customers_street_address  like '%" . $cdata . "%') or (o.customers_telephone like '%" . $cdata . "%') or (o.ip_address like '%" . $cdata . "%') or (o.payment_info like '%" . $cdata . "%')";
	        $orders_query .= " and (" . $cdata_query . ")";

	      }  // EOIF isset($_GET['customer_data'])


	      if ( isset($_SESSION['order_numbers']) && $_SESSION['order_numbers']!='')  
		  {  // use the orders whose ids are listed

	        // Check invoice number(s) entered and convert to comma-separated list.
	        $order_numbers = zen_db_prepare_input($_SESSION['order_numbers']);
	        $arr_no = explode(',',$order_numbers);

	        foreach ($arr_no as $key=>$value) { // if ranges were entered, convert them to comma-separated list

	          $arr_no[$key]=trim($value);

	        }  // EOFOREACH $arr_no

	        $order_numbers=implode(',',$arr_no);
	        $order_numbers_query = "o.orders_id in (" . zen_db_input($order_numbers) . ")";

	        $orders_query .= " and (" . $order_numbers_query . ")";
			
			
	      }  // EOIF isset($_SESSION['order_numbers'])

	      if ( isset($_SESSION['numero_facture']) && $_SESSION['numero_facture']!='')  
		  {  
	        $numero_facture = zen_db_prepare_input($_SESSION['numero_facture']);
	        $orders_query .= " and o.orders_id in ( select orders_id from orders_invoices where orders_invoices_id in (  " . $numero_facture . ")  ) ";
	      }  // EOIF isset($_SESSION['order_numbers'])

	      if ( isset($_SESSION['montant']) && $_SESSION['montant']!='')  
		  {  
	        $montant = zen_db_prepare_input($_SESSION['montant']);
	        $orders_query .= " and o.orders_id in ( select orders_id from orders where order_total =  " . $montant . " ) ";
	      }  // EOIF isset($_SESSION['order_numbers'])
		  /*
		  		                   <option value="T">Tous
							   <option value="FA">Factures et avoirs
							   <option value="BL">BL
							   <option value="PF">Proforma 
		      */
	      if ( isset($_SESSION['type_paiement']) && strlen($_SESSION['type_paiement'])>0)  
		  {  
	        $type_paiement = zen_db_prepare_input($_SESSION['type_paiement']);

			if ( $type_paiement == "cc" ) 
			{
			   $orders_query .= "  and o.payment_module_code in('CC','cc')";
			}
			else if ( $type_paiement == "paypal" ) 
			{
			   $orders_query .= "  and o.payment_module_code  in('PAYPAL','paypal')";
			}		
			else if ( $type_paiement == "OTH" ) 
			{
			   $orders_query .= "  and o.payment_module_code  not in('CC','cc','MKP_ebay','MKP_amazon','MKP_pix','MKP_darty','MKP_allegro','MKP_rdc','MKP_fnac','MKP_pm','MKP_cdiscount')";
			}
			else if ( $type_paiement == "MKP" ) 
			{
			   $orders_query .= "  and o.payment_module_code  like 'MKP%' ";
			}			
			else if ( $type_paiement == "hors_MKP" ) 
			{
			   $orders_query .= "  and o.payment_module_code  not like 'MKP%' and o.payment_module_code  not like 'interco' ";
			}			
			else if ( $type_paiement == "saisie_INTERNET" ) 
			{
			   $orders_query .= "  and ascii(payment_module_code) = ascii(lower(payment_module_code))  ";
			}						
			else 
			{
			   $orders_query .= "  and o.payment_module_code = '". $type_paiement ."' ";
			}
	      }  // EOIF isset($_SESSION['order_numbers'])

	      if ( isset($_SESSION['zone_geo']) && strlen($_SESSION['zone_geo'])>0)  
		  {
		      if ( $_SESSION['zone_geo'] != 'un' )
	  		     $orders_query .= " and o.customers_country in ( " . $zone_geo_values[$_SESSION['zone_geo']] . " )";
			  else 
			  {
	  		     $orders_query .= " and o.customers_country not in ( " . $zone_geo_values['de'] . " )
				                    and o.customers_country not in ( " . $zone_geo_values['eu'] . " )
				                    and o.customers_country not in ( " . $zone_geo_values['fr'] . " )								
				                    and o.customers_country not in ( " . $zone_geo_values['it'] . " )
				                    and o.customers_country not in ( " . $zone_geo_values['uk'] . " )								
				                    and o.customers_country not in ( " . $zone_geo_values['ot'] . " )								
				                    and o.customers_country not in ( " . $zone_geo_values['pl'] . " )								
				                    and o.customers_country not in ( " . $zone_geo_values['sp'] . " )";
			   }
		  }
	      if ( isset($_SESSION['type_piece']) && $_SESSION['type_piece']!='T')  
		  {  
	        $type_piece = zen_db_prepare_input($_SESSION['type_piece']);

			if ( $type_piece == "FA" ) 
			{
			   $orders_query .= " and  ( oi.invoice_type in ( 'CR','DB' ) ) ";
			}
			else if ( $type_piece == "BL" ) 
			{
			   $orders_query .= " and oi.invoice_type = 'BL' ";
			}
			else if ( $type_piece == "HP" ) 
			{
			   $orders_query .= " and  ( oi.invoice_type in ( 'CH','DH' ) ) ";
			}
			else if ( $type_piece == "FE" ) 
			{
			   $orders_query .= " and  ( oi.invoice_type in ( 'DB' ) ) ";
			}
			else if ( $type_piece == "FH" ) 
			{
			   $orders_query .= " and  ( oi.invoice_type in ( 'DH' ) ) ";
			}
			
	      }  // EOIF isset($_SESSION['order_numbers'])
	//echo $orders_query;exit;
	      if ( isset($_SESSION['site_internet']) && $_SESSION['site_internet']!='to')  
		  {  
	        $site_internet = zen_db_prepare_input($_SESSION['site_internet']);
			
	        $orders_query .= " and o.database_code = '" . $site_internet . "' ";
	      }  
	      if ( isset($_SESSION['ref_cmd']) && strlen($_SESSION['ref_cmd'])>0)  
		  {  		
	        $orders_query .= " and o.ref_info like '%" . $_SESSION['ref_cmd'] . "%'";
	      }	  
		  
	      if ( isset($_SESSION['customer_id']) && $_SESSION['customer_id']!='')  
		  {  
	        $customer_id = zen_db_prepare_input($_SESSION['customer_id']);
	        $orders_query .= " and o.customers_id = " . $customer_id;
	      }  // EOIF isset($_SESSION['order_numbers'])
	      if ( isset($_SESSION['el_pull_status']) 
		       && $_SESSION['el_pull_status']!=''
			   && $_SESSION['el_pull_status']!=0)  
		  {  
	        $orders_query .= " and o.orders_status = '" . $_SESSION['el_pull_status'] ."'";	  
	      }

	//   echo strlen($_GET['startdate']);exit;		
		  
	      if ((isset($_SESSION['startdate']) && $_SESSION['startdate']!='' 
		      && isset($_SESSION['enddate']) && $_SESSION['enddate']!='') ||
	          ($_SESSION['type_date']=="PAN")
			  )
		   {
	//		  echo $_GET['startdate'];exit;		
	//        if ((strlen($_GET['startdate']) != 10) || pdfoc_verify_date($_GET['startdate'])) { pdfoc_message_handler('PDFOC_ERROR_BAD_DATE'); }
	//        if ((strlen($_GET['enddate']) != 10) || pdfoc_verify_date($_GET['enddate'])) { pdfoc_message_handler('PDFOC_ERROR_BAD_DATE'); }

	        $start = $_SESSION['startdate'];
	        $end = $_SESSION['enddate'];

//	        $start = zen_db_prepare_input(el_format_bd($start));
//	        $end = zen_db_prepare_input(el_format_bd($end));
			
			if ($_SESSION['type_date']=="TRT")
	           $date_query = "o.treatment_date between '" . zen_db_input($start) . "' and '" . zen_db_input($end) . " 23:59:59'";			
			else if ($_SESSION['type_date']=="CMD")
	           $date_query = "o.date_purchased between '" . zen_db_input($start) . "' and '" . zen_db_input($end) . " 23:59:59'";
			else if ($_SESSION['type_date']=="FAC")
	           $date_query = "oi.invoice_date between '" . zen_db_input($start) . "' and '" . zen_db_input($end) . " 23:59:59'";
			else if ($_SESSION['type_date']=="PAY")
	           $date_query = "o.orders_date_finished between '" . zen_db_input($start) . "' and '" . zen_db_input($end) . " 23:59:59'";
			else if ($_SESSION['type_date']=="PAN")
	           $date_query = "o.orders_date_finished is null";

	        $orders_query .= " and (" . $date_query . ")";

	      } // EOIF isset($_GET['startdate'])


	      if (isset($_SESSION['pull_status']) && $_SESSION['pull_status']!='0') {

	        $status_query = "o.orders_status = '". zen_db_input(zen_db_prepare_input($_SESSION['pull_status'])) . "'";

	        $orders_query .= " and (" . $status_query . ")";

	      } // EOIF isset($_SESSION['pull_status'])

	    } // EOIF $checked_exist


	    // however we got them, we have our query conditions; now
	    // finish off the query and check to see if any orders have
	    // been selected.
	    //
	    if (isset($_SESSION['critere_tri']) && $_SESSION['critere_tri']!='') 
		{
		    $critere = $_SESSION['critere_tri'];
	//echo  '.'.$critere.'.';
			
		    if ( $critere == "DATEFDESC" )
		      $orders_query .= " order by invoice_date DESC";
	        else if ( $critere == "DATEF" )		   
		      $orders_query .= " order by invoice_date ";
	        else if ( $critere == "RETARD" )		   
		      $orders_query .= " order by retard ";		  
	        else if ( $critere == "RETARDDESC" )		   
		      $orders_query .= " order by retard desc";		  		  
		    else if ( $critere == "DATEPDESC" )
		      $orders_query .= " order by orders_date_finished DESC";
	        else if ( $critere == "DATEP" )		   
		      $orders_query .= " order by orders_date_finished ";
			else if ( $critere == "NUMFDESC" )
		      $orders_query .= " order by orders_invoices_id DESC";
	        else if ( $critere == "NUMF" )		   
		      $orders_query .= " order by orders_invoices_id ";
			else if ( $critere == "DATECDESC" )
		      $orders_query .= " order by date_purchased DESC";
	        else if ( $critere == "DATEC" )		   
		      $orders_query .= " order by date_purchased";
	        else if ( $critere == "MONTANT" )		   
		      $orders_query .= " order by o.order_total desc";
	        else if ( $critere == "SOCIETEDATE" )		   
		      $orders_query .= " order by customers_company, invoice_date ";				
	        else if ( $critere == "TYPEPIECE" )		   
		      $orders_query .= " order by oi.invoice_type, oi.invoice_date desc";				
	        else if ( $critere == "MOYENPAIEMENT" )		   
		      $orders_query .= " order by o.payment_method";				
	        else if ( $critere == "CONDITIONSPAIEMENT" )		   
		      $orders_query .= " order by o.payment_conditions_desc";				
	        else if ( $critere == "SITESOURCE" )		   
		      $orders_query .= " order by o.database_code";						  
		}
		else
		{
		   if ( $_SESSION['source_db']=="gl" )
		      $orders_query .= " order by invoice_date DESC";
		   else
		      $orders_query .= " order by date_purchased DESC";
		}
//echo 	$orders_query.'<br>';
	    $orders = $db->Execute($orders_query);
//echo 	$orders_query.'<br>';


	  // save the orders query so it can be
	  // retrieved when reloading the page (on an error, on a refresh, or
	  // on delete_confirm, for example)
	  //
	  $_SESSION['pdfoc']['orders_query'] = $orders_query;

	    break;   // ------------------- EOF selection --------------------------------------

	  case 'action':  // ------------- BOF action -----------------------------------------

	     // get the currently selected orders to act upon
	     //
	     if ( strlen($order_id) > 0   )
		 {
	        $orders_query = $mstr_orders_query;
	        $order_numbers_query = "o.orders_id in (" . zen_db_input( $order_id ) . ")";
	        $orders_query .= " and (" . $order_numbers_query . ")";
	        $orders_query .= " order by date_purchased DESC ";
			

	     }	 
	     else if (isset($_SESSION['pdfoc']['orders_query'])) {

	       $orders_query = $_SESSION['pdfoc']['orders_query'];

	     } else { // just get all o"rders
	//echo 'hello';

	       $orders_query = $all_orders_query;

	     }

	     // determine what action to take
	     // order of precedence if many things are selected (the first that matches will be the winner):
	     //
	     // 1. refresh
	     // 2. print credit if credit is confirmed (only occurs if user clicks on "yes" link at top); will also change status if was provided initially
	     // 3. ask for credit confirmation if credit has been checked and file type is "Credit"
	     // 4. if a file type (not "Credit") and/or status has been specified, print and/or update status

	     if (isset($_GET['action']) && ($_GET['action']=='refresh' || $_GET['action']=='credit_confirm_no')) { $action = 'refresh'; }

	     elseif (isset($_GET['action']) && $_GET['action']=='credit_confirm') {

	        $action = 'credit_confirm';

	        // restore the post vars (whether to print order number, telephone, etc.)
	        //
	        foreach ($_SESSION['pdfoc'] as $k => $v) {
	          $_POST[$k] = $v;
	        }

	     }

	     elseif (isset($_POST['file_type']) && $_POST['file_type']=="Credit.php") { $action = 'credit_request'; }

	     elseif ((isset($_POST['file_type']) && $_POST['file_type']!="0" && $_POST['file_type']!="Credit.php") || (isset($_POST['status']) && $_POST['status']!='0')) { $action = 'status_andor_print'; }

	     // Now go do it
	     //
	     if (isset($action)) {
	     switch ($action) {

	       case 'refresh':   // this is just a refresh from selecting an order in orders list, or
	                         // aborting a delete or credit

	         break;

	       case 'credit_request':   // Have user confirm the credit

	         // save out all post vars so they'll be available
	         // to the Credit template
	         //
	         foreach ($_POST as $k => $v) {

	           $_SESSION['pdfoc'][$k] = $v;

	         }
	         // check to see if any order(s) does not yet have a
	         // credit number. If there is one, pop up a confirmation
	         // message. If all selected orders already have
	         // credit numbers, skip the message.
	         //
	//echo $orders_query;		 
	         $orders = $db->Execute($orders_query);
	         $no_credit = 0;

	         while (!$orders->EOF) {

	           $verify_credit = $db->Execute("select * from " . TABLE_ORDERS_INVOICES . " where order_total<>0 and invoice_type in ('CR','CH')  AND orders_id = '" . $orders->fields['orders_id'] . "'");

	           if ($verify_credit->EOF) { // this order doesn't have a credit yet
	              $no_credit++;
	              break;
	           }

	           $orders->MoveNext();

	         }
	         if ($no_credit > 0) {
	              $message = PDFOC_MESSAGE_CREDIT_ARE_YOU_SURE .
	                         '<br /><a href="' . zen_href_link(FILENAME_EL_PDFOC,'form=action&action=credit_confirm') .  '">' . PDFOC_TEXT_YES . '</a>' .
	                         '<br /><a href="' . zen_href_link(FILENAME_EL_PDFOC, 'form=action&action=credit_confirm_no') . '">' . PDFOC_TEXT_NO . '</a>';

	          } else {

	             zen_redirect(FILENAME_EL_PDFOC . '?form=action&action=credit_confirm');

	          }

	          break;

	       case 'status_andor_print':   // Status update and/or printing options were specified
	       case 'credit_confirm':

	         // --- BEGIN STATUS UPDATE AND NOTIFICATION --------------------------------------------------		 
	         if ( (isset($_POST['status']) && $_POST['status']!='0') 
			      &&  ($commande_expediee==0) )			      
			 { // need to update status
			 
	         // reset orders query result to beginning
	         //
	         $orders = $db->Execute($orders_query);
	//         $comments = zen_db_prepare_input($_POST['comments']);

			$PDFOC_EMAIL_TEXT_DATE_ORDERED[2] =  'Date de commande:';
			$PDFOC_EMAIL_TEXT_DATE_ORDERED[3] =  'Fecha de pedidos:';
			$PDFOC_EMAIL_TEXT_DATE_ORDERED[4] =  'Vom:';
			$PDFOC_EMAIL_TEXT_DATE_ORDERED[5] =  'Order date:';		 
			$PDFOC_EMAIL_TEXT_DATE_ORDERED[6] =  'Data Acquisto:';		 

			 $PDFOC_EMAIL_TEXT_INVOICE_URL[2] = 'Vous pouvez consulter et télécharger votre facture détaillée en format pdf en sélectionnant ce lien:';
			 $PDFOC_EMAIL_TEXT_INVOICE_URL[3] = 'Usted puede consultar y descargar vuestra factura detallada, en formato pdf, haciendo un click aqui:';
			 $PDFOC_EMAIL_TEXT_INVOICE_URL[4] = 'Sie können Ihre detaillierte Rechnung im pdf Format herunterladen indem Sie hier klicken :';
			 $PDFOC_EMAIL_TEXT_INVOICE_URL[5] = 'You may read and download your detailled invoice by selecting this link:';
			 $PDFOC_EMAIL_TEXT_INVOICE_URL[6] = 'le facciamo presente che può consultare e scaricare il dettaglio della sua fattura  in PDF selezionando il seguente link::';
			 
			$PDFOC_EMAIL_TEXT_ORDER_NUMBER[2] =  'Numéro de commande:';  
			$PDFOC_EMAIL_TEXT_ORDER_NUMBER[3] =  'Pedido nº:';  
			$PDFOC_EMAIL_TEXT_ORDER_NUMBER[4] =  'Bestellnummer:';  
			$PDFOC_EMAIL_TEXT_ORDER_NUMBER[5] =  'Order number:';  
			$PDFOC_EMAIL_TEXT_ORDER_NUMBER[6] =  'Order number:';  

			$PDFOC_EMAIL_SIGNOFF[2] = "Cordialement,\n\n";
			$PDFOC_EMAIL_SIGNOFF[3] = "Cordialmente,\n\n";
			$PDFOC_EMAIL_SIGNOFF[4] = "Mit freundlichen Grüssen,\n\n";
			$PDFOC_EMAIL_SIGNOFF[5] = "Best regards,\n\n";
			$PDFOC_EMAIL_SIGNOFF[6] = "Distinti Saluti,\n\n";


			$PDFOC_ACROBAT[2] = "Vous pouvez télécharger gratuitement le logiciel Acrobat Reader qui vous permet d'imprimer votre facture ici :<br><br>
			http://www.adobe.fr/products/acrobat/readstep2.html";
			$PDFOC_ACROBAT[3] = "Usted puede descargar el programa Acrobat Reader gratuitamente, que le permite de imprimir su factura aqui :<br><br>
			http://www.adobe.fr/products/acrobat/readstep2.html";
			$PDFOC_ACROBAT[4] = "Damit Sie Ihre Rechnung ausdrücken können, haben Sie hier die Möglichkeit kostenlos die Software Acrobat Reader herunterzuladen :<br><br>
			http://www.adobe.fr/products/acrobat/readstep2.html";
			$PDFOC_ACROBAT[5] = "To print your invoice, you may download the Acrobat Reader Software from this link :<br><br>
			http://www.adobe.fr/products/acrobat/readstep2.html";
			$PDFOC_ACROBAT[6] = "Può scaricare gratuitamente il programma Acrobat Reader, che le permette di stampare la sua fattura, qui: <br><br>
			http://get.adobe.com/it/reader/";

			$pdfoc_subject[2] = 'Votre commande #%d a été expédiée et votre facture est prête';		
			$pdfoc_subject[3] = 'Vuestro pedido numero #%d fue enviado y vuestra factura esta lista';
			$pdfoc_subject[4] = 'Ihre Bestellung #%d ist versandt worden und Ihre Rechnung ist bereit';
			$pdfoc_subject[5] = 'Your order #%d is sent and your invoice is ready';
			$pdfoc_subject[6] = 'Il vostro ordine #%d è stato spedito e la vostra fattura é pronta.';

			 
	           while (!$orders->EOF) { // loop over all specified orders

	             $order = new order($orders->fields['orders_id']);
	             $oID = $orders->fields['orders_id'];

	 			// Be sure to replace the e-mail address in the following line with the correct one for your store:
				 			 
	             $customer_notified = 0;
				 $format_due = 0;

				 if  ( $status==3 )  
				 {
					$comments_text[2]="Votre paiement pour cette facture a été perçu.";
					$comments_text[3]="El pago realizado por esta factura ha sido cobrado.";
					$comments_text[4]="Ihre Bezahlung für diese Rechnung ist wahrgenommen worden.";
					$comments_text[5]="Your payment for this invoice was received.";						
					
				 }
				 else if ( $status==2 ) 
				 {		    
	     			$format_due = $currencies->format($order->info['total'], true, $order->info['currency'], $order->info['currency_value']) ;				

	//$format_due = $order->info['currency'];
					
					$comments_text[2]="Pour cette facture le montant restant du est de ". $format_due ."; en votre aimable rêglement.";
					$comments_text[3]="Para esta factura, el monto pendiente en vuestro amable pago es de ". $format_due;
					$comments_text[4]="Für diese Rechnung ist der restliche Betrag von ". $format_due;
					$comments_text[5]="The amount due for this invoive is ". $format_due;
				 }
				 if ( ( $status==3 ) || ( $status==2 )  )
				 {
					 $comments = $comments_text[$old_order->fields['languages_id']];		   
					 $dml_comments = "insert into " . TABLE_ORDERS_STATUS_HISTORY . " (orders_id, orders_status_id, date_added, customer_notified, comments)
								 values ('" . $oID . "', '" .$status . "', now(), '1', '#" . $comments  . "')";
					 // maintenant ce commentataire est repris automatiquement			 
				     // $db->Execute( $dml_comments );
					 
		          }		  

	             if ( ($_POST['notify'])  && (  ( $status==2 ) || ( $status==3 ) ) )
				 { // send e-mail to customer informing him/her of new order status
	//echo 'mail';exit;
	               $email_text_subject =  sprintf($pdfoc_subject[$order->info['languages_id']], $oID);  // $pdfoc_subject[] is defined in admin/includes/languages/<language>/pdfoc.php


				   $invoice_root = "http://linats.net/admin/includes/modules/pdfoc/temp_pdf/";							  
			   // $invoice_url = $invoice_root . $orders->fields['orders_id'] . "batch_orders.pdf";
			   /*
			   $invoice_query  = $db->Execute("select orders_invoices_id from orders_invoices where orders_id = '" . $orders->fields['orders_id']  . "'");
			   $invoice_id =  $invoice_query->fields['orders_invoices_id'];
			   */
	//echo  "?".$invoice_type."?";exit;		   
	 		   $invoice_id = get_invoice_id ( $orders->fields['orders_id']   , $invoice_type, $_POST['invoice_mode']=='final' );
			   $fname =   $invoice_id . '_' . $orders->fields['orders_id']  . FILENAME_PDFOC_PDF;
			   $fshortname = $fname;
			   $invoice_url = $invoice_root . $fname;


	               $from_name["fr"] = 'Lampevideoprojecteur';
	               $from_name["es"] = 'Lamparasparaproyectores';
	               $from_name["de"] = 'Alleprojektorlampen';
	               $from_name["eu"] = 'Easylamps';
	               $from_name["eu"] = 'JustProjectorLamps';
	               $from_name["it"] = 'Lampadeproiettori';
	               $from_name["bf"] = 'Easybatteries';
	               $from_name["hp"] = 'Hotprojectorlamps';
	               $from_name["rq"] = 'RienQueDesLampes';
	               $from_name["tb"] = 'TbiDirect';
	               $from_name["pl"] = 'zarowki-do-projektorow';

				   
	               $email = sprintf(PDFOC_EMAIL_SALUTATION,$order->customer['name']) . "\n\n" .
	                        $email_text_subject . ".\n\n" .  PDFOC_EMAIL_SEPARATOR .  "\n\n" .
	                        $PDFOC_EMAIL_TEXT_INVOICE_URL[$order->info['languages_id']] .  "\n\n" . '<a href="'. $invoice_url .'">'. $invoice_url .'</a> ' . "\n" .
	                        $PDFOC_EMAIL_TEXT_DATE_ORDERED[$order->info['languages_id']] . ' ' . zen_date_short($order->info['date_purchased']) . "\n\n" . $comments . "\n\n" . PDFOC_EMAIL_SEPARATOR . "\n\n" .
	                        $PDFOC_ACROBAT[$order->info['languages_id']] . "\n\n\n\n" . $PDFOC_EMAIL_IF_QUESTIONS[$order->info['languages_id']] . $PDFOC_EMAIL_SIGNOFF[$order->info['languages_id']] . $from_name[$order->info['database_code']] . "\n\n" . PDFOC_EMAIL_SEPARATOR . "\n\n" ;
							
	               $email_html['EMAIL_SUBJECT'] = "\n\n";

	               $email_html['EMAIL_MESSAGE_HTML']= sprintf(PDFOC_EMAIL_SALUTATION,$order->customer['name']) . "\n\n<br><br>" .
	                        $email_text_subject . ".\n\n<br><br>" .  PDFOC_EMAIL_SEPARATOR .  "\n\n<br><br>" .
	                        $PDFOC_EMAIL_TEXT_INVOICE_URL[$order->info['languages_id']] . '<br><br><a href="'. $invoice_url .'">'. $invoice_url .'</a>'   . '<br><br>' .
	                        $PDFOC_EMAIL_TEXT_DATE_ORDERED[$order->info['languages_id']] . ' ' . zen_date_short($order->info['date_purchased']) . '<br><br>' . $comments . "\n\n<br><br>" .  PDFOC_EMAIL_SEPARATOR . "\n\n<br><br>" .
	                        $PDFOC_ACROBAT[$order->info['languages_id']] .  '<br><br>'.  PDFOC_EMAIL_SEPARATOR . '<br><br>' . $PDFOC_EMAIL_IF_QUESTIONS[$order->info['languages_id']] .  '<br><br>' . $PDFOC_EMAIL_SIGNOFF[$order->info['languages_id']] . '<br><br>' . $from_name[$order->info['database_code']] . "\n\n<br><br>" . PDFOC_EMAIL_SEPARATOR . "\n\n<br><br>";
							
	               $from_email["fr"] = 'adv@lampevideoprojecteur.fr';
	               $from_email["es"] = 'info@lamparasparaproyectores.com';
	               $from_email["de"] = 'info@alleprojektorlampen.de';
	               $from_email["eu"] = 'info@easylamps.eu';
	               $from_email["en"] = 'info@justprojectorlamps.co.uk';
	               $from_email["it"] = 'info@lampadeproiettori.com';
	               $from_email["bf"] = 'info@easybatteries.fr';
	               $from_email["hp"] = 'info@hotprojectorlamps.fr';
	               $from_email["rq"] = 'clients@rienquedeslampes.fr';
	               $from_email["tb"] = 'info@tbi-direct.fr';
	               $from_email["pl"] = 'info@zarowki-do-projektorow.pl';  

					$PDFOC_EMAIL_IF_QUESTIONS[2] = "Pour toute question; veuillez envoyer un mail à " . $from_email[$order->info['database_code']] . " .\n\n";
					$PDFOC_EMAIL_IF_QUESTIONS[3] = "Si tuviera alguna duda por favor envianos un Email al correo :" . $from_email[$order->info['database_code']] . " .\n\n";
					$PDFOC_EMAIL_IF_QUESTIONS[4] = "Für Frage, bitte schicken Sie eine Mail an " . $from_email[$order->info['database_code']] . ".\n\n";
					$PDFOC_EMAIL_IF_QUESTIONS[5] = "If you have any questions; please send an email to " . $from_email[$order->info['database_code']] . " .\n\n";
					$PDFOC_EMAIL_IF_QUESTIONS[6] = "If you have any questions; please send an email to " . $from_email[$order->info['database_code']] . " .\n\n";
					$PDFOC_EMAIL_IF_QUESTIONS[7] = "If you have any questions; please send an email to " . $from_email[$order->info['database_code']] . " .\n\n";

					// FV BUG DESC CMDES EN SURIMPRESSION 
				   if  (  ( $order->info['payment_module_code']=="MKP_rdc"  )	
						  || ( $order->info['payment_module_code']=="MKP_amazon"  )	
				          ||  ( ( $order->info['database_code'] == "fr" ) 
							&& ( $oID > 80000 ) 
							&& ( $oID < 100000 ) ) 							
							)
					{
					   // on ne fait rien à cause BUG
					}
					else
					{	
						//if ( ( $oID==190779  ) &&  ( $order->info['database_code'] == "fr" ) )
						//if  ( $order->info['database_code'] == "fr" )
						if (false)
						{
//echo $fname;exit;
							// mailup_mail($sender, $to, $mailID, $parameters, $file, $time);
							//  '/home/yeaslmps/www/zencart_gl/admin/includes/modules/pdfoc/'.$fname;
							// $invoice_id = get_invoice_id ( $orders->fields['orders_id']
							if ( strlen($format_due) == 0 ) 
							{
							   $format_due = 0;
							}
							$param = array("num_facture" => $invoice_id, "num_cmd" => $orders->fields['orders_id'],"format_due"=>$format_due, "lien_facture"=>$invoice_url );
//							mailup_mail('', $order->customer['email_address'], 57, $param, '/home/yeaslmps/www/zencart_gl/admin/includes/modules/pdfoc/'.$fname, '' );
//							mailup_mail('', $order->customer['email_address'], 57, $param, '/home/yeaslmps/www/zencart_gl/admin/includes/modules/pdfoc/'.$fname, '' );
							mailup_mail('', $order->customer['email_address'], 57, $param, '','' );
							
						}
						else
						{
							zen_mail($order->customer['name'], $order->customer['email_address'], $email_text_subject, $email, $from_name[$order->info['database_code']], $from_email[$order->info['database_code']], $email_html);
						}
					}
	               if (SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_STATUS == '1' and SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO != '') 
				   {
	                  zen_mail('', SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO, SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT . ' ' . $email_text_subject, $email, $from_email[$order->info['database_code']] , $from_email[$order->info['database_code']] );
	               }
	               $customer_notified = '1';

	             }  // EOIF $_POST['notify']

	             //   if ($status != $order->info['orders_status'] || $customer_notified=='1') { // update order status if new status specified or if customer notified
	             //             $db->Execute("update " . TABLE_ORDERS . " set orders_status = '" . zen_db_input($status) . "', last_modified = now() where orders_id = '" . $orders->fields['orders_id'] . "'");
	             // } // EOIF $_POST['status'] != $order->info['orders_status']

	             $orders->MoveNext();

	           } // EOWHILE (!$orders->EOF)

	         } // EOIF isset($_POST['status'])

	         // --- END STATUS UPDATE AND NOTIFICATION --------------------------------------------
//echo "begin printing";
	         // --- BEGIN PRINTING ----------------------------------------------------------------
	         if ( ( ($commande_expediee==0) 
			      && (isset($_POST['file_type']) && $_POST['file_type']!="0")  
				 )
				 || ( ( $histo ) && ( $_POST['invoice_mode']=='final' )  )
				 )
			 { // time to print

	           // Basic error handling, initialization, and avoid-a-timeout setup
	           //
	           if (!is_writeable(DIR_PDFOC_PDF)) { pdfoc_message_handler('PDFOC_SET_PERMISSIONS'); }

	           $pageloop = "0";
	           $time0   = time();

               if ($premier_passage)
			   {			   
					require(DIR_PDFOC_INCLUDE . 'class.ezpdf.php');
					require(DIR_PDFOC_INCLUDE . 'templates/' . $_POST['file_type']);					
			   }
			   else
			   {
				  require(DIR_PDFOC_INCLUDE . 'templates/' . $_POST['file_type']);					
//
/*
			      $pdf=new Cezpdf();
				  $pdf->newDocument();
			      $pdf->ezPRVTcleanUp();		
*/				  
// newDocument($pageSize=array(0,0,612,792))				  
			   }
	           // Load the specified template (e.g. invoice or label). Note: $pdf is instantiated in
	           // the template file when $pageloop = 0, which is the case here.

	           $pageloop = "1";


	           $numpage = 0;
	           $numrecords = 0;
	           $nexttotal = $nextproduct = $nextproduct1 = $nextproduct2 = 0; // last two are used in combined Packing Slip and Invoice template
	           $nextcomment = $nextcomment1 = $nextcomment2 = 0; // last two are used in combined Packing Slip and Invoice template
	           $secondpage = false;

	           if ($_POST['show_comments']) { $show_comments = true; } else { $show_comments = false; }

	           // reset orders query result to beginning
	           //
	//echo $orders_query;		   
	           $orders = $db->Execute($orders_query);

			   
	           while (!$orders->EOF) { // loop over all specified orders
			   
				// si c'est une proforma on met a jour les commentaires
				if ( $_POST['invoice_mode']=='preview' && ($orders->fields['orders_status']==7) && ($_SESSION['source_db'] != 'gl')  )
				{
	               if ($premier_passage)
				   {			   				
					   require_once(DIR_WS_CLASSES . 'super_order.php');
					   $currencies = new currencies();
                   }
				   update_standard_comment ( $order_id );     
				}		 

			   
	             $order = new order($orders->fields['orders_id']);
	             $oID = $orders->fields['orders_id'];

	             if ($numpage != 0) { $pdf->EzNewPage(); }    // insert a new page into the existing pdf document (not on the first iteration)


	             // for each order, reload the specified template. The template file
	             // contains the order-specific instructions, such as printing the invoice number
	             // and order date. That's why it has to be reloaded for every order.
	             //
	             require(DIR_PDFOC_INCLUDE . 'templates/' . $_POST['file_type']);

	             $numpage++;
	             if ($_POST['file_type'] == "Labels.php") { $numrecords += $numlabel; }  elseif ($secondpage===false) { $numrecords++; }

	             if ($_POST['file_type'] == "Packing-Slip-and-Invoice.php") { $numpage++; }

	             // Send fake header to avoid timeout, got this trick from phpMyAdmin
	             //
	             $time1  = time();
	             if ($time1 >= $time0 + 30) {
	               $time0 = $time1;
	               header('X-bpPing: Pong');
	             }

	             if ($secondpage===true) {    // continue printing this order
	                continue;
	             } else {                     // finished with this order, so move to next one
	                $orders->MoveNext();
	             }

	           } // EOWHILE !$orders->EOF

	           $pdf_code = $pdf->output();  // get pdf stream for this order as a string

	           // append the pdf page for this order to the pdf file
			   // fv a modifier ..
			   // $_POST['ord_id'];
	//echo $_POST['ord_id'];exit;		
	           if ( strlen($order_id) > 0 ) 
	           {		   
			       if ( strlen($newID)>0 )
				      $ref_ord = $newID;
				   else
				      $ref_ord = $order_id;

//	echo  "?".$invoice_type."?";exit;		   
                   if ($ref_ord>0)
				   {
//				       $sql = "select invoice_type,concat(year(invoice_date),month(invoice_date)) date_facture from orders_invoices where orders_id = " . $ref_ord;
				       $sql = "select invoice_type from orders_invoices where orders_id = " . $ref_ord;
					   $iType = $db->Execute( $sql );
					   $invoice_type = $iType->fields['invoice_type'];
//					   $date_facture = $iType->fields['date_facture'];
					   
			           $invoice_id =  get_invoice_id ( $ref_ord   , $invoice_type, $_POST['invoice_mode']=='final' );
				   }   
			   
		           $fshortname =  $invoice_id . '_' . $ref_ord . FILENAME_PDFOC_PDF;
				   //
				   if ($histo)
				   {
	  				    $sql = "select invoice_type,
						        concat(year(invoice_date),'_',month(invoice_date)) date_facture, 
								orders_invoices_id
								from orders_invoices 
								where orders_id = " . $order_id;
					   $iType = $db->Execute( $sql );
					   $invoice_type = $iType->fields['invoice_type'];
					   $date_facture = $iType->fields['date_facture'];
					   $invoice_id = $iType->fields['orders_invoices_id'];					   
					   

	$dml =  "update el_batch_items set invoice_date=now() where item_id = ".$order_id;
	$db->Execute($dml);
	set_time_limit(0);
					   
					$fname =  DIR_PDFOC_PDF . $date_facture .'_' . $invoice_type .'_' . $invoice_id . '.pdf';					
				   }
				   else
				   {
					$fname =  DIR_PDFOC_PDF . $invoice_id . '_' . $ref_ord . FILENAME_PDFOC_PDF;
				   }
//echo $fname;exit;				   
				   
			   }
			   else
			   {
			       // caduque ?
		           $fname = DIR_PDFOC_PDF . $ord_id . FILENAME_PDFOC_PDF;		       
			   }
// /home/yeaslmps/www/lvp_pp/zencart_fr/vp-manuels/bl/			   
// FVVV
			    if ($_POST['douchette']==1)
				{
					$fname = "/home/yeaslmps/www/lvp_pp/zencart_fr/vp-manuels/bl/tmp.pdf";
				}
				   
	
				if (file_exists($fname)) {
					unlink ($fname);
			   }

	           if ($fp = fopen($fname,'w')) {
	             fwrite($fp,$pdf_code);
	             fclose($fp);
	           } else {
	             pdfoc_message_handler('PDFOC_FAILED_TO_OPEN');
	           }

			   
	         } // EOIF isset($_POST['file_type'])

	         // --- END PRINTING ----------------------------------------------------------------
			 


	         // Notify admin of print/update success.
	         //
	         if (isset($_POST['status']) && $_POST['status']!='0') {
	           $message .=  PDFOC_MESSAGE_STATUS_WAS_UPDATED;

	           if ($customer_notified=='1') {
	             $message .= PDFOC_MESSAGE_EMAIL_SENT;
	           } else { // add period
	             $message .= ".";
	           }
	         }

	         if (isset($_POST['file_type']) && $_POST['file_type'] != "0") {
	           $message .=  "<br />" . sprintf(PDFOC_MESSAGE_SUCCESS, $numpage, $numrecords, $fname);
	         }

	         break;

	       } // EOSWITCH $action
	     } // EOIF isset($action)
	     if ( ($commande_expediee==0) && (strlen($order_id)) )
		 {
	//echo $fname;exit;
	       if ( $status != 1 ) 
		   {
		     if ($_POST['batch_mode']==1)
			 {
			    echo "Facture produite avec ord_id ".$order_id."<br><br>";
		     }
			 else
			 {
			  	 echo '<html><body><script>this.document.location="' . $fname .'";</script></body></html>';
				 exit;		    
			 }
		   }
		   else
		   {
		     // http://127.0.0.1/sites/zencart_gl/admin/el_orders.php?oID=0&action=edit&force_db=gl
		  	 echo '<html><body><script>this.document.location="edit_frame.php?oID=' . $newID .'&force_db=gl&source_db=gl&languages_id='. $old_order->fields['languages_id'].' ";</script></body></html>';
			 exit;
		   }
		   
	//        zen_redirect(zen_href_link($fshortname));
	     }		 
	     break;   // ------------- EOF action -----------------------------------------

	    case 'deletion':   // ------------- BOF deletion -------------------------------

	     // get the currently selected orders to act upon
	     //
	     if (isset($_SESSION['pdfoc']['orders_query'])) {

	       $orders_query = $_SESSION['pdfoc']['orders_query'];

	     } else { // surely you don't want to delete ALL orders......note this doesn't
	              // protect the user if all orders really have been selected

	       pdfoc_message_handler('PDFOC_ALL_SELECTED_FOR_DELETE');

	     }
//echo $orders_query;
	     $orders = $db->Execute($orders_query);

	     while (!$orders->EOF) { // loop over all specified orders

	       $oID = zen_db_prepare_input($orders->fields['orders_id']);
//       zen_remove_order($oID, $_POST['restock']);

	       $orders->MoveNext();

	     } // EOWHILE !orders->EOF

	     // Notify admin of delete success.
	     //
	     $message = PDFOC_MESSSAGE_ORDERS_WERE_DELETED;

	     // Now reset the orders list to display all orders
	     //
//echo 'hello';

	     $orders_query = $all_orders_query;
	     $_SESSION['pdfoc']['orders_query'] = $orders_query;

	     break;    // ------------- EOF deletion --------------------------------------

	  }  // EOSWITCH

} 
else 
{ // no form submitted, just get all orders
//echo 'hello';
	    if ( isset($_SESSION['pdfoc']['orders_query'] ) )
		   $orders_query = $_SESSION['pdfoc']['orders_query'];
		else 
	       $orders_query = $all_orders_query;
		   
	    $_SESSION['pdfoc']['orders_query'] = $orders_query;

} // EOIF isset($_GET['form']
if ( ($premier_passage) && ( $commande_expediee==0) )
{ 
  $premier_passage=0; 
}

}
//  multiples validations
	
//echo $orders_query;
    if (  (  $_SESSION['source_db'] == "gl" )
	     || (  $_SESSION['source_db'] == "po" ) )
	{
    //    $from_where =  $orders_query;	
//echo 	$orders_query;exit;

$pos1 = strpos($orders_query,'from ');
$from_where = substr( $orders_query , $pos1,80000);
/*
echo $from_where;exit;
*/
	     if ( $_SESSION["what"]=='prd' )
		 {
		    $query_id = 2;
		 }
		 else if ( $_SESSION["what"]=='rc' )
		 {
		    $query_id = 3;		 
		 }
	     else if ( $_SESSION["what"]=='frs' )
		 {
		    $query_id = 2;
		 }
         else 
		 {
		    $query_id = 1;		 
		 }

	    $dml = "insert into el_query_where ( from_where_clause ) values ( '". addslashes( $from_where ) . "' ) ";
		$db->Execute($dml);
	    $where_id = mysql_insert_id() ;		
	}



// bof PDFOC orders statuses
    }
// eof if (isset($_SESSION['pull_status'])
// eof PDFOC orders statuses

//echo $orders_query;

// TESTING
//
//$message .= '<br /><br/>file_type:' . $_POST['file_type'] . '<br /><br />';
//foreach ($_POST['orderlist'] as $k => $v ) { $message .= "POST[orderlist][$k]=$v  ";  }

if ($_POST['batch_mode']==1)
{
	echo "FIN DE PROCESS pour ".$cnt_cmd." factures ." ;
    $db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);

	$dml =  "update el_batch set invoice_date=now() where batch_id=".$_POST['batch_id'];
	$db->Execute($dml);

	$dml =  "update el_batch_items set invoice_date=now() where item_id in (".$_POST['ord_id'].")";
	$db->Execute($dml);
	
	exit;
}


//echo $orders_query;

// output the html for the batch_print admin page -- note this includes php for order listing
//
require(DIR_PDFOC_INCLUDE . 'el_gestion_header.php');
require(DIR_PDFOC_INCLUDE . 'el_gestion_body.php');
//require(DIR_PDFOC_INCLUDE . 'el_gestion_footer.php');

?>
