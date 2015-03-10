<?php			
  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
  
	 require('_obj_email.php');
	 $spam = new EMAIL;		  
	 $spam->set_email_language(2);  		   		   
  
  global $db;
  $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  

  $sql = "
	select *
	from bo_po.orders
	WHERE orders_id >203429
	AND DATE_SUB(CURDATE(),INTERVAL 40 DAY)>=date_purchased
	AND orders_status NOT 
	IN ( 13, 14, 15, 16, 17, 18 ) 	";

    $rs=$db->Execute($sql);
	
	while (!$rs->EOF)
	{
	   $orders_id = $rs->fields['orders_id'];

	   $sql = "select count(1) value 
				from  el_tag
				where po_orders_products_id in ( select  orders_products_id
												from orders_products
												where orders_id = ".$orders_id . "
												and products_model <> 'SHF' )
				and  stock_entry_date <> '0000-00-00' ";
				
				
		$produits_sortis = exec_select ($sql);

		$sql = "select sum(products_quantity) value 
				from  bo_po.orders_products 
				where orders_id = ". $orders_id . "
				and products_model <> 'SHF'	
				and products_model <> 'ECOF'		";
				
		 $produits_total = exec_select($sql);
		
		 $a_recevoir = $produits_total - $produits_sortis;
		 if ( $a_recevoir > 0 )
		 {
			 $obj = $a_recevoir . " lampes non recues, PO  fermé : " . $rs->fields['customers_company'] ;
			 $txt .= " PO order fermé cause délais : " . $rs->fields['customers_company']. "<br> Po Number:". $orders_id."<br>";
			 $txt .= " Date enregistrement: " . $rs->fields['date_purchased']. "<br>";
			 $txt .= " Nombre de produits commandés: " . $produits_total . "<br>";
			 $txt .= " Nombre de produits reçus: " . $produits_sortis. "<br>";
			
//	echo '<br><br>'. $obj. '|'. $txt .'<br><br>';	
			 $spam->set_sender_name("Alerter",2);
			 $spam->set_sender_email_address( "noanwer@linats.net" );

	//				 $spam->set_receiver_email_address( "fvaron@easylamps.fr" );
			 $spam->set_receiver_email_address( "fvaron@easylamps.fr" );
				 
			 $spam->set_email_title($obj,2);
			 $spam->set_email_content($txt,2);

			 $spam->set_receiver_email_address( "fvaron@easylamps.fr" );			 
			 $spam->send_email();

			 $spam->set_receiver_email_address( "han@easylamps.fr" );			 
			 $spam->send_email();
			 
		 }
		 $dml = "update orders 
				 set orders_status = 13
				 where orders_id = ". $orders_id;
				 
				 
		 $db->Execute($dml); 		 
		 
//echo $dml;

		if ( $a_recevoir > 0 )
		{
			exit;
		}
		 
		 $rs->MoveNext();
	}

   
//echo    $po_orders_id . '  | '.$sql.'<br>';
   

  
?>