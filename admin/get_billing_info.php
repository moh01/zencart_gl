<?php

  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
  
	 $bds = array("eu","fr","es","de","en","it","bf","rq","pl");
	 $cnt = 0;
 
   $target_database = "gl";
   $order_products_id = $_POST['order_products_id'];
//echo    'zut'.$_POST['order_products_id'];exit;
   $db->connect($ext_db_server[$target_database], $ext_db_username[$target_database], $ext_db_password[$target_database], $ext_db_database[$target_database], USE_PCONNECT, false);
   
		$sql  = "SELECT customers_name, 
		         customers_postcode,
				 customers_city,
                 date_format( date_purchased , \"%d/%c/%Y\" ) date_purchased, 
                 orders_products.products_model, 
                 products_name, 
 				 customers_email_address,
				 left(products_model,2) type_lampe,
				 date_format( invoice_date , \"%d/%c/%Y\" ) invoice_date, 
				 database_code,
				 delivery_postcode,
				 delivery_state,
				 delivery_country,
				 languages_id,
				 customers_id
           from orders,orders_products,orders_invoices
           where orders.orders_id = orders_invoices.orders_id
           and orders.orders_id=orders_products.orders_id
		   and orders_products.orders_products_id  = " . $order_products_id . "
           order by orders.orders_id, orders_products.final_price desc";

//echo $sql.'<br>';exit;		  
 
		   $rs = $db->Execute($sql);
		   
		   $customers_name = $rs->fields["customers_name"];
		   $customers_postcode = $rs->fields["customers_postcode"];
		   $customers_city = $rs->fields["customers_city"];
		   $date_achat = $rs->fields["date_purchased"];
		   $products_model =  $rs->fields["products_model"];
		   $products_name = $rs->fields["products_name"];
		   $customers_email = $rs->fields["customers_email_address"];
		   $type_lampe = $rs->fields["type_lampe"];
		   $date_facture = $rs->fields["invoice_date"];
		   $database_code = $rs->fields["database_code"];		   
		   $date_purchased = $date_achat;		   
		   $customers_postcode = $rs->fields["delivery_postcode"];		   
		   $customers_state = $rs->fields["delivery_state"];		   
		   $customers_country = $rs->fields["delivery_country"];		   
		   $languages_id = $rs->fields["languages_id"];
		   $customers_id = $rs->fields["customers_id"];
//echo 'KKKKKKK'.$database_code;exit;		   
		if ( $database_code == "es" )
			$sql = "select customers_gender from lampe_sp.customers  where customers_id = ". $customers_id;
		else if ( $database_code == "bf" )
			$sql = "select customers_gender from pcp_eu.customers  where customers_id = ". $customers_id;	
		else if ( $database_code == "rq" )
			$sql = "select customers_gender from lampe_fr.customers  where customers_id = ". $customers_id;	
		else if ( $database_code == "hp" )
			$sql = "select customers_gender from bis_lampe_eu.customers  where customers_id = ". $customers_id;			
		else if ( $database_code == "eu" )
			$sql = "select customers_gender from rv_lampe_eu.customers  where customers_id = ". $customers_id;						
		else
			$sql = "select customers_gender from lampe_".$database_code . ".customers  where customers_id = ". $customers_id;
		
		
		$rs = $db->Execute($sql);
		$customers_gender = $rs->fields['customers_gender'];
		
		if (strlen($customers_gender)==0)
		{
			$customers_gender = 'm';
		}
			
	
		echo $customers_name 	.'|'.  $customers_postcode 	.'|'.  $customers_city 	
			.'|'.  $date_achat 	.'|'.  $products_model 	.'|'.  $products_name 	
			.'|'.  $customers_email 	.'|'.  $type_lampe 	.'|'.  $date_facture 	
			.'|'.  $database_code 	.'|'.  $date_purchased 	.'|'.  $customers_postcode 
			.'|'.  $customers_state 	.'|'.  $customers_country 	.'|'.  $languages_id.'|'.  $customers_gender;

  
?>