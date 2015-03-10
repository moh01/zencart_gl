<?php
function delete_order ( $p_old_order_id )
{
   global $db;
   
   global $ext_db_server;
   global $ext_db_username;   
   global $ext_db_password;
   global $ext_db_database;
   
   
   $sql =  "select database_code value from orders where orders_id = ".  $p_old_order_id;
   $sourcedb = exec_select ( $sql );
   
//  
   
   $db->Execute("delete from orders_status_history where orders_id = " . $p_old_order_id );
   $db->Execute("delete from orders_total where orders_id = " . $p_old_order_id );
   $db->Execute("delete from orders_products where orders_id = " . $p_old_order_id );
   $db->Execute("delete from orders where orders_id = " . $p_old_order_id );
   $dml = "update orders_invoices set ref_orders_id=null where ref_orders_id = " . $p_old_order_id ;
   $db->Execute($dml);   
 //  echo $dml;exit;
   // suppresion dans la source

   if ( $sourcedb != "gl" )
   {
	   $db->connect($ext_db_server[$sourcedb], $ext_db_username[$sourcedb], $ext_db_password[$sourcedb], $ext_db_database[$sourcedb], USE_PCONNECT, false);
	   $db->Execute("delete from orders_invoices where orders_id = " . $p_old_order_id );   
   }   
   
}
function clonage_order ( $p_old_order_id, $p_old_db, $p_new_db, $p_customer_database_code , $p_new_customers_id, $p_new_languages_id, $p_new_status )
{
   global $db;
   global $currency;
   global $ext_db_server;
   global $ext_db_username;
   global $ext_db_password;
   global $ext_db_database;
   
    // recherche du nouvel ID
    $db->connect($ext_db_server[$p_new_db], $ext_db_username[$p_new_db], $ext_db_password[$p_new_db], $ext_db_database[$p_new_db], USE_PCONNECT, false);
    $maxQry = $db->Execute('select max(orders_id)+1 new_oid from orders') ; 
    $oID = $maxQry->fields['new_oid']; 		  

    // recupération des informsations à lire
    $db->connect($ext_db_server[$p_old_db], $ext_db_username[$p_old_db], $ext_db_password[$p_old_db], $ext_db_database[$p_old_db], USE_PCONNECT, false);
   
	// Duplicate order details from "orders" table
	$old_order = $db->Execute("SELECT * FROM " . TABLE_ORDERS. " WHERE orders_id = " . $p_old_order_id );

	  if ( $old_order->fields['currency'] != 'EUR' )	 
	  {  
	     
         $db->connect($ext_db_server[$old_order->fields['database_code']], $ext_db_username[$old_order->fields['database_code']], $ext_db_password[$old_order->fields['database_code']], $ext_db_database[$old_order->fields['database_code']], USE_PCONNECT, false);
		 $sql =  "select value from currencies where code='".$old_order->fields['currency']."'";
		 $recordSet = $db->Execute($sql);
		 $currency_value = $recordSet->fields['value'];
		 $db->connect($ext_db_server[$p_old_db], $ext_db_username[$p_old_db], $ext_db_password[$p_old_db], $ext_db_database[$p_old_db], USE_PCONNECT, false);
	  }
	  else
	  {
		 $currency_value = 1;
	  }
//echo 	$p_new_customers_id;exit;
       if ( $p_new_customers_id != 0 )
       {
	    
        $db->connect($ext_db_server[$p_customer_database_code], $ext_db_username[$p_customer_database_code], $ext_db_password[$p_customer_database_code], $ext_db_database[$p_customer_database_code], USE_PCONNECT, false);	
   		$sql = "select entry_company ,
   					 entry_tva_intracom,
   					 entry_street_address,
   					 entry_suburb,
   					 entry_postcode,
   					 entry_city,
   					 entry_state,
   					 countries_name,					 
   					 customers_firstname,
   					 customers_lastname,
   					 customers_email_address,
   					 customers_telephone
                     from address_book ab, customers c, countries
                     where ab.customers_id = ". $p_new_customers_id . "
                      and   ab.customers_id = c.customers_id
                      and   c.customers_default_address_id =  ab.address_book_id 
   				   and   entry_country_id = countries_id";
   				   
           $sqlCustomer = $db->Execute($sql);
   		
   		$entry_company = $sqlCustomer->fields['entry_company'];
   		$entry_tva_intracom = $sqlCustomer->fields['entry_tva_intracom'];
   		$entry_street_address = $sqlCustomer->fields['entry_street_address'];
   		$entry_suburb = $sqlCustomer->fields['entry_suburb'];
   		$entry_postcode = $sqlCustomer->fields['entry_postcode'];
   		$entry_city = $sqlCustomer->fields['entry_city'];
   		$entry_state = $sqlCustomer->fields['entry_state'];
   		$entry_country = $sqlCustomer->fields['countries_name'];
   
   		$customers_firstname = $sqlCustomer->fields['customers_firstname'];
   		$customers_lastname = $sqlCustomer->fields['customers_lastname'];
   		$customers_email_address = $sqlCustomer->fields['customers_email_address'];
   		$customers_telephone = $sqlCustomer->fields['customers_telephone'];

         // affectation des addresses pour les groupes de champ
        $customers_name = $customers_firstname . ' ' . $customers_lastname;
        $entry_tva_intracom =  $entry_tva_intracom;							 
        $customers_company =  $entry_company;
        $customers_street_address =  $entry_street_address ;
        $customers_suburb =  $entry_suburb ;
        $customers_city =  $entry_city;
        $customers_postcode =  $entry_postcode;
        $customers_state =  $entry_state;
        $customers_country =  $entry_country;
        $customers_telephone =  $customers_telephone;
        $customers_email_address =  $customers_email_address;
        $delivery_name =  $customers_name;
        $delivery_company =   $entry_company;
        $delivery_street_address =  $entry_street_address ;
        $delivery_suburb =  $entry_suburb;
        $delivery_city =  $entry_city;
        $delivery_postcode =  $entry_postcode;
        $delivery_state =  $entry_state;
        $delivery_country =  $entry_country;
        $billing_name =  $customers_name;
        $billing_company =  $entry_company;
        $billing_street_address =  $entry_street_address ;
        $billing_suburb =  $entry_suburb ;
        $billing_city =  $entry_city;
        $billing_postcode =   $entry_postcode;
        $billing_state =  $entry_state;
        $billing_country =  $entry_country;   		       
		$date_purchased="now()";
		
        $db->connect($ext_db_server[$p_old_db], $ext_db_username[$p_old_db], $ext_db_password[$p_old_db], $ext_db_database[$p_old_db], USE_PCONNECT, false);
		
       }
       else
       {
	    $p_new_customers_id = $old_order->fields['customers_id'];
        $customers_name = $old_order->fields['customers_name'];
        $entry_tva_intracom =  $old_order->fields['entry_tva_intracom'];							 
        $customers_company =  $old_order->fields['customers_company'];
        $customers_street_address = $old_order->fields['customers_street_address'];
        $customers_suburb =  $old_order->fields['customers_suburb'];
        $customers_city =  $old_order->fields['customers_city'];
        $customers_postcode =  $old_order->fields['customers_postcode'];
        $customers_state =  $old_order->fields['customers_state'];
        $customers_country =  $old_order->fields['customers_country'];
        $customers_telephone =  $old_order->fields['customers_telephone'];
        $customers_email_address = $old_order->fields['customers_email_address'];
        $delivery_name =  $old_order->fields['delivery_name'];
        $delivery_company =  $old_order->fields['delivery_company'];
        $delivery_street_address = $old_order->fields['delivery_street_address'];
        $delivery_suburb =  $old_order->fields['delivery_suburb'];
        $delivery_city =  $old_order->fields['delivery_city'];
        $delivery_postcode =  $old_order->fields['delivery_postcode'];
        $delivery_state =  $old_order->fields['delivery_state'];
        $delivery_country =  $old_order->fields['delivery_country'];
        $billing_name =  $old_order->fields['billing_name'];
        $billing_company =  $old_order->fields['billing_company'];
        $billing_street_address =  $old_order->fields['billing_street_address'];
        $billing_suburb =  $old_order->fields['billing_suburb'];
        $billing_city = $old_order->fields['billing_city'];
        $billing_postcode = $old_order->fields['billing_postcode'];
        $billing_state = $old_order->fields['billing_state'];
        $billing_country = $old_order->fields['billing_country'];	              
		
		$date_purchased = $old_order->fields['date_purchased'];
       }			 
          if ( strlen ($p_customer_database_code) == 0 )
		  {
		     $p_customer_database_code = $old_order->fields['database_code'];	              
		  }
		          
		  if ( $p_new_languages_id == 0)
		  {
		     $p_new_languages_id = $old_order->fields['languages_id'];	              
		  }
		  // traitement transformation du BL en facture 
		  if ( $old_order->fields['orders_status']==5 ) 
		  {
			  $payment_info = $old_order->fields['payment_info'];
			  $payment_amount = $old_order->fields['payment_amount'];			  
			  $orders_date_finished = $old_order->fields['orders_date_finished'];
		  }
		  
          $new_order = array('orders_id' => $oID,
                             'customers_id' => $p_new_customers_id,
                             'customers_name' => $customers_name,
                             'entry_tva_intracom' => $entry_tva_intracom,							 
                             'customers_company' => $customers_company,
                             'customers_street_address' => $customers_street_address ,
                             'customers_suburb' => $customers_suburb ,
                             'customers_city' => $customers_city,
                             'customers_postcode' => $customers_postcode,
                             'customers_state' => $customers_state,
                             'customers_country' => $customers_country,
                             'customers_telephone' => $customers_telephone,
                             'customers_email_address' => $customers_email_address,
                             'customers_address_format_id' => $old_order->fields['customers_address_format_id'],
                             'delivery_name' => $delivery_name,
                             'delivery_company' =>  $delivery_company,
                             'delivery_street_address' => $delivery_street_address ,
                             'delivery_suburb' => $delivery_suburb,
                             'delivery_city' => $delivery_city,
                             'delivery_postcode' => $delivery_postcode,
                             'delivery_state' => $delivery_state,
                             'delivery_country' => $delivery_country,
                             'delivery_address_format_id' => $old_order->fields['delivery_address_format_id'],
                             'billing_name' => $billing_name,
                             'billing_company' => $billing_company,
                             'billing_street_address' => $billing_street_address ,
                             'billing_suburb' => $billing_suburb ,
                             'billing_city' => $billing_city,
                             'billing_postcode' =>  $billing_postcode,
                             'billing_state' => $billing_state,
                             'billing_country' => $billing_country,
                             'billing_address_format_id' => $old_order->fields['billing_address_format_id'],                            
                             'payment_method' => $old_order->fields['payment_method'],
                             'payment_conditions_code' => $old_order->fields['payment_conditions_code'],							 							 
                             'payment_conditions_desc' => $old_order->fields['payment_conditions_desc'],							 
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
                             'date_purchased' => $date_purchased,
                             'orders_status' => $p_new_status,                             
                             'currency' => $old_order->fields['currency'],
                             'currency_value' => $currency_value,
                             'order_total' => $old_order->fields['order_total'],
                             'languages_id' => $p_new_languages_id,
                             'database_code' => $p_customer_database_code,							 
                             'products_tax' => $old_order->fields['products_tax'],							 							 
                             'ref_info' => $old_order->fields['ref_info'],	
                             'payment_info' => $payment_info,			
                             'payment_amount' => $payment_amount,										 
							 'orders_date_finished' => $orders_date_finished,
                             'order_tax' => $old_order->fields['order_tax']);
		  
//echo $status;exit;payment_info
		  
          // les produits --------------------------------------
          $products_cnt = 0;
          $old_products = $db->Execute("SELECT * FROM orders_products WHERE products_quantity>0 and orders_id = '" . $p_old_order_id . "'");
		  
          while (!$old_products->EOF) 
		  {
            $products_cnt++;  					  
    		$new_products[$products_cnt] = array('orders_id' => $oID,
                                              'sort_order' => $old_products->fields['sort_order'],			
                                              'products_id' => $old_products->fields['products_id'],
                                              'products_model' => $old_products->fields['products_model'],
                                              'products_name' => $old_products->fields['products_name'],
                                              'final_price' => $old_products->fields['final_price'],
                                              'products_tax' => $old_products->fields['products_tax'],
                                              'products_quantity' => $old_products->fields['products_quantity'],
                                              'products_prid' => $old_products->fields['products_prid'] );
            $old_products->MoveNext();
          }
		  /// les totaux --------------------------------------------
		  $order_total_cnt = 0;
		  $old_order_total = $db->Execute("SELECT * FROM " . TABLE_ORDERS_TOTAL . " WHERE value <> 0 and orders_id = '" . $p_old_order_id . "'");
		  while (!$old_order_total->EOF) {
			$order_total_cnt++;
			$new_order_total[$order_total_cnt] = array('orders_id' => $oID,
									 'title' => $old_order_total->fields['title'],
									 'text' => $old_order_total->fields['text'],
									 'value' => $old_order_total->fields['value'],
									 'class' => $old_order_total->fields['class'],
									 'sort_order' => $old_order_total->fields['sort_order']);

			$old_order_total->MoveNext();
		  }
   		/// insertions ---------------------------------------------------------------------------------------------------------------------------
         $db->connect($ext_db_server[$p_new_db], $ext_db_username[$p_new_db], $ext_db_password[$p_new_db], $ext_db_database[$p_new_db], USE_PCONNECT, false);
//echo $p_new_db;exit;
   		
         zen_db_perform(TABLE_ORDERS, $new_order);

		  // produits ---------------------------------------------------
		  $loop = true;
		  $iter = 1;
		  while ($loop) 
		  {
             zen_db_perform(TABLE_ORDERS_PRODUCTS, $new_products[$iter]);
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
		  if ( $old_order->fields['orders_status']==5 ) 
		  {
			  require_once(DIR_WS_CLASSES . 'super_order.php');		  
//echo 'stop';exit;			  
			  recalc_total($oID);
		  }
		  // fin des insertions -------------------------------------------------------------------------------------------------
 		  
       return $oID;
}
function get_invoice_id ( $p_order_id, $p_invoice_type, $p_force_numbering , $p_ref_orders_id=0, $p_orders_invoices_id_comment="" )
{
   global $db;
   
   $invoice_id =0;
   $sql = "select orders_invoices_id 
           from orders_invoices 
           where order_total <> 0 
		   and invoice_type = '". $p_invoice_type ."'
		   and orders_id = '" . $p_order_id  . "'";
		   
   $invoice_query  = $db->Execute( $sql );
   $invoice_id =  $invoice_query->fields['orders_invoices_id'];
   

   if ( ($invoice_id == 0) && ($p_force_numbering)   )
   {
       // récupération des trous
	   $sql = "select orders_invoices_id 
	           from orders_invoices 
	           where order_total = 0 
			   and invoice_type = '". $p_invoice_type ."'
			   order by orders_invoices_id";
			   
	   $invoice_query  = $db->Execute( $sql );
	   $invoice_id =  $invoice_query->fields['orders_invoices_id'];

       if ( $invoice_id )        
	   {	
	      $dml = "update orders_invoices 
		          set orders_id = " . $p_order_id . ", 
				      invoice_date = now(), 
					  order_total = 1
				  where orders_invoices_id = " . $invoice_id . "
				  and   invoice_type = '". $p_invoice_type ."'";

		  if ( $db->Execute( $dml )=== false )
		  {
		    echo 'Pb sql:'.$dml; exit;
		  }
				  
	   }
	   else
	   {
		   $sql = "select max(orders_invoices_id)+1 invoice_id
		           from orders_invoices 
		           where order_total <> 0
				   and invoice_type = '". $p_invoice_type ."'
				   order by orders_invoices_id";
		   $invoice_query  = $db->Execute( $sql );
		   $invoice_id =  $invoice_query->fields['invoice_id'];
		   
		   if ( $invoice_id ) 
		   {
		       $dml = "insert into orders_invoices ( orders_invoices_id ,invoice_type, orders_id, order_total, invoice_date, ref_orders_id, orders_invoices_id_comment )
			           values ( ". $invoice_id .",'".  $p_invoice_type ."',". $p_order_id. ", 1, now(), " . $p_ref_orders_id .  ", '".$p_orders_invoices_id_comment."' )";

//echo $dml.'..before<br>';					   
					   
 			  if ( $db->Execute( $dml )=== false )
			  {
			    echo 'Pb sql:'.$dml; exit;
			  }			 
//echo $dml.'..after<br>';					   
		   }
		   else
		   {
		      echo ' pb de numérotation invoice_type:'. $p_invoice_type . ' order_id:'. $p_order_id; exit;
		   }	   	   
	   }	   
   }   
   return ($invoice_id);
}
function get_select ( $sql_stmt, $name, $value, $select_attributes='' )
{
  global $db;
    $start_html =  '';
    $end_html =  '';
//echo    $select_attributes;exit;
   $recordSet = $db->Execute( $sql_stmt );

   $html =  '<select  name="'.$name.'" '. $select_attributes .'>';
   $html .= '<option value=""></option>';
   
            while (!$recordSet->EOF) {
                 $html .=  '<option ';


                 if ($value)
                 {				 
                    if ($value==$recordSet->fields['code'])
                    {					
                         $html .=  ' SELECTED ';
                    }
                 }
                    $html .=  ' value="'.$recordSet->fields['code'].'">'. stripslashes ( $recordSet->fields['description'] ) ."\n";
                 $recordSet->MoveNext();
              };
      $html .=  '</select> ';

      return $start_html . $html . $end_html;
}
function exec_select ( $sql_stmt  )
{
  global $db;
  $recordSet = $db->Execute( $sql_stmt );
  return $recordSet->fields['value'];
}
function get_list_select ( $sql_stmt, $name, $value, $select_attributes='' )
{
  global $db;
    $start_html =  '';
    $end_html =  '';
   
   $recordSet = $db->Execute( $sql_stmt );

   $html =  '<select size="10"  name="'.$name.'" '. $select_attributes .'>';
   $html .= '<option value=""></option>';
   
            while (!$recordSet->EOF) {
                 $html .=  '<option ';


                 if ($value)
                 {				 
                    if ($value==$recordSet->fields['code'])
                    {					
                         $html .=  ' SELECTED ';
                    }
                 }
                    $html .=  ' value="'.$recordSet->fields['code'].'">'. stripslashes ( $recordSet->fields['description'] ) ."\n";
                 $recordSet->MoveNext();
              };
      $html .=  '</select> ';

      return $start_html . $html . $end_html;
}

function init_batch_items()
{
   global $db;
   // on va chercher le libelle  dans GL
   $rs = $db->Execute("select batch_name from el_batch where active=1 ");
   while(!$rs->EOF)
   {
      $batches[]=$rs->fields['batch_name'];
	  $rs->MoveNext();
   }
   $batch_items = '';
   $bi = $db->Execute('select item_id 
                       from el_batch_items, el_batch 
					   where el_batch.batch_id = el_batch_items.batch_id
					   and   el_batch.active=1');
   $cntr = 0;
   while (!$bi->EOF)
   {
      $batch_items .= ',' . $bi->fields['item_id'];
	  $cntr++;
	  $bi->MoveNext();
   }
   $_SESSION['active_batch_items']=$batch_items;
   if ( count($batches) )
   {
 	  $_SESSION['active_batches'] = implode(',',$batches);
   }
//echo   'aa'. $_SESSION['active_batches'];exit;
   $_SESSION['active_batch_items_counter']=$cntr;
   $_SESSION['init_batch']=1;
   
   // on initialise   toutes les variables de session
}
// la  gestion des reliquats a trois fonction et deux modes d'appel
//  fonctions : 1 recalcul  des reliquats (sur la commande et le dernier BL)
//                     2  en intitialisant les quantités livrées par défaut (sur le dernier BL )
//                     3  en appliquant des changements aux quantités livrées (sur le dernier BL )
//   on l'appelle en deux mode
//    A initialisation du BL (1) et (2)
//    B  modification des quantités livrées (1) et (3)
function gestion_reliquats ( $p_orders_id, $p_orders_products_id=0, $p_ajout=0 , $p_init=0  )
{
   global $db;

   global $currency;
   global $ext_db_server;
   global $ext_db_username;
   global $ext_db_password;
   global $ext_db_database;
   
   // on est en mode initialisation  on décide  de ne rien livrer par défaut
   if ( $p_init )
   {
      $dml = "update orders_products 
	          set products_quantity = 0 
			  where products_model not in  ( 'SHF', 'CODF', 'ECOF', 'ESCF' , 'FRSH' )
			  and orders_id = ". $p_orders_id;
//echo $dml;	  
      $db->Execute( $dml );
   }
   else if ( $p_orders_products_id )
   {
       $dml = "update orders_products set products_quantity = products_quantity + " . $p_ajout .   " 
	                 where orders_products_id = ". $p_orders_products_id;   
//echo $dml;					 
      $db->Execute( $dml );
   }
   
   $sql = "select database_code, ref_orders_id 
           from orders_invoices, orders
		   where orders_invoices.orders_id = orders.orders_id
		   and   orders.orders_id = ". $p_orders_id;


//echo sql;	  		   

   $sf=$db->Execute($sql);
   
   
   $order_db = $sf->fields['database_code'];
   $ref_orders_id = $sf->fields['ref_orders_id'];
   
    
    // les qté commandées
    $db->connect($ext_db_server[$order_db], $ext_db_username[$order_db], $ext_db_password[$order_db], $ext_db_database[$order_db], USE_PCONNECT, false);
$sql = "select products_quantity, products_model
                            from orders_products	
                            where products_model not in  ( 'SHF', 'CODF', 'ECOF', 'ESCF' , 'FRSH' )
							and orders_id = ". $ref_orders_id;	
//echo $sql;
 	
    $qty = $db->Execute(  $sql  ) ; 
	while ( !$qty->EOF )
	{
		$qty_ordered[$qty->fields['products_model']] = $qty->fields['products_quantity'];
//echo "qo".$qty_ordered[$qty->fields['products_model']];
	    $qty->MoveNext();
	}


	
    $db->connect($ext_db_server["gl"], $ext_db_username["gl"], $ext_db_password["gl"], $ext_db_database["gl"], USE_PCONNECT, false);
    $sql = "select sum(op.products_quantity) pd, op.products_model
                            from orders_products op, orders_invoices oi, orders o
                            where op.products_model not in  ( 'SHF', 'CODF', 'ECOF', 'ESCF' , 'FRSH' )
							and o.orders_status = 5
							and op.orders_id = o.orders_id
							and oi.orders_id = o.orders_id
							and oi.ref_orders_id  = ". $ref_orders_id . "
							group by op.products_model";	
//echo $sql;							
    $qty = $db->Execute( $sql ) ; 							
	while ( ! $qty->EOF )
	{
		$qty_delivered[$qty->fields['products_model']]= $qty->fields['pd'];
	    $qty->MoveNext();
	}
	
	// on applique le reliquat à la commande initiale  ------------------------------------------------------------------------------------------
    $db->connect($ext_db_server[$order_db], $ext_db_username[$order_db], $ext_db_password[$order_db], $ext_db_database[$order_db], USE_PCONNECT, false);
	$sql = "select orders_products_id, products_model
	        from orders_products 
			where products_model not in  ( 'SHF', 'CODF', 'ECOF', 'ESCF' , 'FRSH' )
			and  orders_id = " . $ref_orders_id;
//echo $sql;
			
    $qty = $db->Execute( $sql ) ; 
	$reliquat_total = 0;
							
	while ( ! $qty->EOF )
	{
		$reliquat =  $qty_ordered[$qty->fields['products_model']]  - $qty_delivered[$qty->fields['products_model']];
		$reliquat_total = $reliquat_total + $reliquat;
		
		$dml = "update orders_products 
		        set  reliquat = ". $reliquat . "
				where orders_products_id = " . $qty->fields['orders_products_id'];
// echo $dml;				
		$db->execute($dml);
	    $qty->MoveNext();
	}
    if ( $reliquat_total == 0 ) 
	{
	   $db->Execute("update orders set orders_status = 3 where orders_id = " . $ref_orders_id );
	}
	else
	{
	   $db->Execute("update orders set orders_status = 4 where orders_id = " . $ref_orders_id );
	}
	
	
    $db->connect($ext_db_server["gl"], $ext_db_username["gl"], $ext_db_password["gl"], $ext_db_database["gl"], USE_PCONNECT, false);	
	
	// on applique le reliquat au dernier BL------------------------------------------------------------------------------------------
	$sql = "select orders_products_id, products_model
	        from orders_products 
			where products_model not in  ( 'SHF', 'CODF', 'ECOF', 'ESCF' , 'FRSH' )
			and  orders_id = " . $p_orders_id;
//echo $sql;
			
    $qty = $db->Execute( $sql ) ; 
							
	while ( ! $qty->EOF )
	{
		$reliquat =  $qty_ordered[$qty->fields['products_model']]  - $qty_delivered[$qty->fields['products_model']];
		$dml = "update orders_products 
		        set  reliquat = ". $reliquat . "
				where orders_products_id = " . $qty->fields['orders_products_id'];
// echo $dml;				
		$db->execute($dml);
	    $qty->MoveNext();
	}
	return 1;

}

function get_tickets($enforce_closed)
{
   global $db;

   if ( ( $enforce_closed == 0 ) || ( strlen($enforce_closed) == 0 ) )
   {
	   $condition = "	and   s.active = 1 ";
   }			 
   
   $sql = "select distinct customers_id
				from el_ticket t, el_ticket_status s
					where t.status = s.id " . $condition ;

   
	$rc1 = $db->Execute($sql);
	while (!$rc1->EOF)
    {	
	    $customers_id = $rc1->fields['customers_id'];
		
		$sql = " select t.id, t.ticket_type, t.date_created, t.recall_date, s.color,
		                DATEDIFF(t.recall_date,now()) rappel_dans
					from el_ticket t, el_ticket_status s
					where t.status = s.id
					" .  $condition .  " 
					and   t.customers_id = " . $customers_id .  "
					order by recall_date desc";
		$html_client = "<table><tr>";		 
		$recordSet = $db->Execute( $sql );
		while ( !$recordSet->EOF )
		{
		   $id  =  $recordSet->fields['id'];
	       $ticket_type = $recordSet->fields['ticket_type'];
	       $date_created = $recordSet->fields['date_created'];
	       $color= $recordSet->fields['color'];
		   $rappel_dans =  $recordSet->fields['rappel_dans'];
		   
		   if ( $rappel_dans <= 0 )
		   {
		      $rappel_dans = "";
		   }
		   else
		   {
		      $rappel_dans .= "j ";
		   }
		   if ( $ticket_type == "rma" )
		   {
		      $rappel_dans .= "#". $id;
		   }
		   
		   $html_client .= '<td bgcolor="'.$color.'">
				    <a href="javascript:popupWindow(\'ticket_frame.php?customers_id='. $customers_id.'&customer_db=fr&id='.$id.'\',\'height=400,width=800,screenX=400,screenY=400,top=400,left=400\')">
	    				<img border=0 src="'. $ticket_type .'_note.gif">
					</a>
			         '. $rappel_dans . '		 
				   </td>';
		    $recordSet->MoveNext();
		}
		$html_client .= "</tr></table>";		 
  	    $tickets[$customers_id] =  $html_client;
		
		$rc1->MoveNext();
	}		
	return $tickets;
} 
?>