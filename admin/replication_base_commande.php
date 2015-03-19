<?php
  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
  
//$bds = array("fr");
//$bds = array("eu");
 // $bds = array("fr","eu");
// $bds = array("fr","es","de","en","it","bf","hp","rq","pl","tb","eu");
// $bds = array("fr","es","de","en","it","bf","hp","rq","pl","tb");
// $bds = array("pl","tb");
$bds = array("eu","fr","es","de","en","it","bf","hp","rq","pl","tb");
 $cnt = 0;
 
 foreach ($bds as $dtb) 
 {
	$db->connect($ext_db_server[$dtb], $ext_db_username[$dtb], $ext_db_password[$dtb], $ext_db_database[$dtb], USE_PCONNECT, false);  
	
	
	$dml = "update orders 
			set customers_countries_id = (select entry_country_id
			                     from address_book ab, customers c
			                  where c.customers_id = orders.customers_id
			                  and   ab.customers_id = c.customers_id
			                      and   c.customers_default_address_id =  ab.address_book_id  )
			where customers_countries_id=0";
    $db->Execute($dml);
	
	$dml = "update orders 
			set orders_status=1
			where orders_status=0";
			
    $db->Execute($dml);
	
    if ( ( $dtb == "eu"  ) || ( $dtb == "pl"  ) )
	{
		$dml = 'update orders
				set orders.billing_name = ""
				where orders.billing_name not like "-%"
				and length(billing_company)>3
				and languages_id = 7 '; 
		$db->Execute($dml);
	}
//735995
/// 61480   Eurotecno // bluechip 84068
    if ( $dtb == "eu"  )
	{
		$dml= 	" update orders 
					set payment_conditions_code='30FM',
						payment_conditions_desc='30 days end of Month'
					where orders.customers_id in ( select customers.customers_id
													from customers 
													where customers.max_credit > 10
													and  customers.customers_id = orders.customers_id
													and orders.languages_id=5 )
					 and  TO_DAYS(date_purchased)=TO_DAYS(now()) ";
													
		 $db->Execute($dml);	

		$dml= 	" update orders 
					set payment_conditions_code='30FM',
						payment_conditions_desc='30 jours fin de mois'
					where orders.customers_id in ( select customers.customers_id
													from customers 
													where customers.max_credit > 10
													and  customers.customers_id = orders.customers_id
													and orders.languages_id=2 ) 
					 and  TO_DAYS(date_purchased)=TO_DAYS(now()) ";
													
													
		 $db->Execute($dml);	

		$dml= 	" update orders 
					set payment_conditions_code='30FM',
						payment_conditions_desc='30 dias fin del mes'
					where orders.customers_id in ( select customers.customers_id
													from customers 
													where customers.max_credit > 10
													and  customers.customers_id = orders.customers_id
													and orders.languages_id=3 ) 
					 and  TO_DAYS(date_purchased)=TO_DAYS(now()) ";
													
													
		 $db->Execute($dml);	

		$dml= 	" update orders 
					set payment_conditions_code='30FM',
						payment_conditions_desc='30 days end of Month'
					where orders.customers_id in ( select customers.customers_id
													from customers 
													where customers.max_credit > 10
													and  customers.customers_id = orders.customers_id
													and orders.languages_id=4 ) 
					 and  TO_DAYS(date_purchased)=TO_DAYS(now()) ";													
													
		 $db->Execute($dml);	
		 
		$dml= 	" update orders 
					set payment_conditions_code='30FM',
						payment_conditions_desc='30 giorni fine mese'
					where orders.customers_id in ( select customers.customers_id
													from customers 
													where customers.max_credit > 10
													and  customers.customers_id = orders.customers_id
													and orders.languages_id=6 ) 
					 and  TO_DAYS(date_purchased)=TO_DAYS(now()) ";													
													
		 $db->Execute($dml);	
		 
		$dml= 	" update orders 
					set payment_conditions_code='30FM',
						payment_conditions_desc='Platnosc na koniec miesiaca po 30 dniach'
					where orders.customers_id in ( select customers.customers_id
													from customers 
													where customers.max_credit > 10
													and  customers.customers_id = orders.customers_id
													and orders.languages_id=7 ) 
					 and  TO_DAYS(date_purchased)=TO_DAYS(now()) ";													
													
		 $db->Execute($dml);	

		 
	}
	if ( strlen($_GET['oId'])>0 )
	{
		if ($_GET['enforce']==1)
		{
			$db->Execute('delete from bo_po.orders where orders_id = '.$_GET['oId']);
			$db->Execute('delete from bo_po.orders_total where orders_id = '.$_GET['oId']);
			$db->Execute('delete from bo_po.orders_products where orders_id = '.$_GET['oId']);			
			$db->Execute('delete from bo_po.orders_status_history where orders_id = '.$_GET['oId']);						
		}
		$addwhere = " and orders_id=".$_GET['oId'];
		if ($dtb=="eu")
		{
			$dml = "insert into bo_po.dbg values  ( 'Bug DISPATCH ||  ".$_GET['oId'] ."')";
			$db->Execute($dml);
		}
	}
	else
	{
		$addwhere = "  and    orders.date_purchased >  DATE_SUB(CURDATE(),INTERVAL 90 DAY) ";
	}
//echo 	$_GET['oId'].'|'.$addwhere;exit;
	
	$sql = "select orders_id, customers_id , 
	               languages_id,  orders_status, 
				   payment_amount, payment_info,payment_amount2, 
				   payment_info2, payment_module_code,ref_info,
				   payment_conditions_code, payment_method,
				   TO_DAYS(last_modified) date_modif,
				   TO_DAYS(now()) date_courante,
				   delivery_name, payment_conditions_desc,
				   delivery_company,
				   delivery_street_address,
					delivery_suburb,
					delivery_city,
					delivery_postcode,
					delivery_state,
					delivery_country,
					order_total,
					order_tax
	          from   orders 
			  where  orders_id not in (62185,65663)	
			  ".$addwhere."
			  order by date_purchased desc";
			  
			  
/*			  
$sql = "select orders_id, customers_id , 
languages_id,  orders_status, 
payment_amount, payment_module_code,
payment_conditions_code
from   orders 
where   orders_id <> 62185
and orders_id = 77998
order by date_purchased desc";
*/			  
	 $rs=$db->Execute($sql);
	 while (!$rs->EOF)
	 {
echo '['. $dtb.']'. $rs->fields["orders_id"].'<br>';			  
		 
//echo $rs->fields["date_modif"]. "|". $rs->fields["date_courante"];
	    $tab_database[] = $dtb;	 
	 
	    $tab_orders_id[] = $rs->fields["orders_id"];	 
		$tab_customers_id[] = $rs->fields["customers_id"];
		$tab_languages_id[] = $rs->fields["languages_id"];
		$tab_orders_status[] = $rs->fields["orders_status"];
		$tab_payment_amount[] = $rs->fields["payment_amount"];
		$tab_payment_module_code[] = $rs->fields["payment_module_code"];		
		$tab_payment_conditions_code[] = $rs->fields["payment_conditions_code"];
//echo 'date_modif'.$rs->fields["date_modif"].'date_courante'.$rs->fields["date_courante"].'<br>';		

		$checkpo = exec_select ("select 1 value from bo_po.orders where orders_id = ". $rs->fields["orders_id"] );
		if  ( ($rs->fields["date_modif"]==$rs->fields["date_courante"]) && ($checkpo) )
		{
/*
payment_conditions_code, 
payment_conditions_desc
payment_info
payment_amount
payment_info2 
payment_amount2,
ref_info
*/		
		   
			$dml = "update bo_po.orders set 
					delivery_name = '". addslashes( $rs->fields["delivery_name"]) ."',
					order_total = '". addslashes( $rs->fields["order_total"]) ."',
					order_tax = '". addslashes( $rs->fields["order_tax"]) ."',
					delivery_company= '". addslashes( $rs->fields["delivery_company"]) ."',
					delivery_street_address= '". addslashes( $rs->fields["delivery_street_address"]) ."',
					delivery_suburb= '". addslashes( $rs->fields["delivery_suburb"]) ."',
					delivery_city= '". addslashes( $rs->fields["delivery_city"]) ."',
					delivery_postcode= '". addslashes( $rs->fields["delivery_postcode"]) ."',
					delivery_state= '". addslashes( $rs->fields["delivery_state"]) ."',		
					payment_module_code =  '". addslashes( $rs->fields["payment_module_code"]) ."',	
					payment_conditions_code= '". addslashes( $rs->fields["payment_conditions_code"]) ."',
					payment_method= '". addslashes( $rs->fields["payment_method"]) ."',
					payment_info= '". addslashes( $rs->fields["payment_info"]) ."',
					payment_amount= '". addslashes( $rs->fields["payment_amount"]) ."',
					payment_conditions_desc='". addslashes( $rs->fields["payment_conditions_desc"]) ."',
					payment_info2= '". addslashes( $rs->fields["payment_info2"]) ."',
					delivery_state= '". addslashes( $rs->fields["delivery_state"]) ."',
					ref_info= '". addslashes( $rs->fields["ref_info"]) ."',
					delivery_country = '". addslashes( $rs->fields["delivery_country"]) ."'
					where orders_id =  ". $rs->fields["orders_id"];
             
			$db->Execute($dml);
			
			// les commentaires
			$dml = "delete from bo_po.orders_status_history where  orders_id = '" . $rs->fields["orders_id"] . "'";
		    $db->Execute($dml);	
			
		  $old_order_history = $db->Execute("SELECT * FROM orders_status_history WHERE orders_id = '" . $rs->fields["orders_id"] . "'");
		  
		  while (!$old_order_history->EOF) 
		  {
		    $dml = "insert into bo_po.orders_status_history ( orders_id,orders_status_id,date_added,comments )
					values ( ".$old_order_history->fields["orders_id"].",
							".$old_order_history->fields["orders_status_id"].",
							'".$old_order_history->fields["date_added"]."',
							'".addslashes($old_order_history->fields["comments"])."' )";
			
		    $db->Execute($dml);	

			$old_order_history->MoveNext();
		  }

			// les totaux de facture 
			$dml = "delete from bo_po.orders_total where  orders_id = '" . $rs->fields["orders_id"] . "'";
		    $db->Execute($dml);	
			
		  $old_order_total = $db->Execute("SELECT * FROM orders_total WHERE orders_id = '" . $rs->fields["orders_id"] . "'");
		  while (!$old_order_total->EOF) 
		  {
		    $dml = "insert into bo_po.orders_total ( orders_id, title, text, value,class,sort_order )
					values ( ".$old_order_total->fields["orders_id"].",
							'".addslashes($old_order_total->fields["title"])."',
							'".addslashes($old_order_total->fields["text"])."',
							'".$old_order_total->fields["value"]."',							
							'".$old_order_total->fields["class"]."',
							'".addslashes($old_order_total->fields["sort_order"])."' )";
			
		    $db->Execute($dml);	

			$old_order_total->MoveNext();
		  }
		  
		    $sql = "select concat(products_quantity,'|',orders_products_id,'|',products_name,'|',final_price,'|',products_tax,'|',products_model) resume 
					from orders_products 
where orders_products.products_model NOT
IN (
'SHF', 'CODF', 'ECOF', 'ESCF', 'FRSH', 'FRS','ESCC','INSUR'
)		
AND orders_id = ". $rs->fields["orders_id"];

		    $rsPrd = $db->Execute($sql);
			$tmp_prd = Array();
			while (!$rsPrd->EOF)
			{
				$tmp_prd[]=$rsPrd->fields['resume'];
				$rsPrd->MoveNext();
			}
			$tab_products[] = implode ('[',$tmp_prd);
//echo 'PRDS'.implode ('[',$tmp_prd).'<br>';			
		}
		else
		{
			$tab_products[] = "";				
		}
	    $rs->MoveNext();
//echo $dtb.'|'.$rs->fields["orders_id"].'<br>';
	 }
 }
 //
 $cnt = 0;
 $feedback = "";
 
 foreach ($tab_orders_id as $orders_id) 
 {
//echo 'in<br>';
    $customers_id = $tab_customers_id[$cnt];
	$languages_id = $tab_languages_id[$cnt];
	$orders_status = $tab_orders_status[$cnt];
	$payment_amount = $tab_payment_amount[$cnt];
	$payment_conditions_code = $tab_payment_conditions_code[$cnt];
	$payment_module_code = strtoupper($tab_payment_module_code[$cnt]);
	$payment_module_code_lower = $tab_payment_module_code[$cnt];
	$products = $tab_products[$cnt];
	
	$dtb = $tab_database[$cnt];	 

	   //  vérification des informations de statut	   
	   //  6 profomorma ou 7 annulée  
	   if ( ( $orders_status == 6  ) || ( $orders_status == 7  ) || ( $orders_status == 7  ) )
	   {
			$a_creer = 0;	      
			$feedback[] = $dtb.":rejet_statut:".$orders_id;
	   }
	   else
	   {
			$a_creer = 1;	      			
	   }
	if ( $orders_id != $_GET['oId'] )
	{
//echo 'auf rechnung 333'.$orders_id.'333';			  
	
		if ( ( $a_creer ) && ($dtb=="eu") )
		{
		   if  ($a_creer)  
		   {	      
			  if ( ( $payment_module_code=='MONEYORDER' )
					|| ( $payment_module_code=='VIR')
					|| ( $payment_module_code=='CHK')
					|| ( $payment_module_code=='CHQ')	)
			  {
				 if (  strlen($payment_conditions_code)==0
					   || ( $payment_conditions_code=='ORD' )
					)
				 {	  
					 if ( $payment_amount==0 )
					 {
						$a_creer = 0;	      			    
						$feedback[] = $dtb.":rejet_paiement:".$orders_id;				
					 }
				 }
			  }		  
		   }	   
		}
		else if ( $a_creer )
		{
			  if ( ( $payment_module_code=='CC' )
				    || ( $payment_module_code=='OGONE' )
					|| ( $payment_module_code=='COD')
					|| ( substr($payment_module_code,0,3)=='MKP')
					|| ( $payment_module_code=='PAYPAL')
					|| ( $payment_module_code=='PPL')	)
			  {
				 // c'est un paiement à la commande
			  }
			  else
			  {
//echo 'auf rechnung 444'.$orders_id.'444';			  
				 if (  strlen($payment_conditions_code)==0
					   || ( $payment_conditions_code=='ORD' )
					)
				{
					// FV prise en compte des saisies directes depuis LINATS
					if (  ( $payment_amount==0 ) && (  $payment_module_code_lower != $payment_module_code  ) )
					{
						$a_creer = 0;	      			    					
						
						$feedback[] = $dtb.":attente paiement:".$orders_id.' montant: '.$payment_amount. '  conditions:  '.$payment_module_code;							    
					}
				}
			  }
		}
	}
	  // suppression des rebonds
	  if ( $customers_id == $previous_customers_id )
	  {
 		 $feedback[] = $dtb." : rejet_bounce : ".$orders_id;						  
	     $a_creer = 0;
	  }
	  $check = 0;
	  $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  
	  
	  $sql = "select orders_status from orders where orders_id = ".$orders_id;
	  $rs=$db->Execute($sql);
	  
	  $orders_status_cible = $rs->fields['orders_status'];
	  
	  // fvvvv
	  if (  ( $orders_status_cible >= 1 )  )
	  {
		  if ( $a_creer == 1 )
		  {
		     // elle existe à l'état latent on la ranime..
		     if ( ( $orders_status_cible == 6 ) || ( $orders_status_cible == 7 ) )
			 {
				 $dml = "update orders set  treatment_date=now(), orders_status = 1 where orders_id = ". $orders_id;
				 $db->Execute($dml);
				 
  				 $feedback[] = $dtb." : order réactivée existence :".$orders_id;						  	  			 

				 $a_creer = 0;	      			    	  		    
			 }
			 else 
			 {
  				 $feedback[] = $dtb." : order non insérée cause existence :".$orders_id;						  	  			 
				 $a_creer = 0;	      			    	  		    			 
			 }
	      }	  	  
		  // else modifié pour gérer exceptions des commandes livrés ou partiellement livrées malgré les pb de paiement
		  else if  ( ( $orders_status != 3 ) && ( $orders_status != 4 ) )
		  {
			 $feedback[] = $dtb." : order à effacée existence :".$orders_id;						  	  			 
			 // mise à jour du statut de la commande
			 $dml = "update orders set orders_status = 6 where orders_status<>9 and orders_id = ". $orders_id;
			 $db->Execute($dml);
			 
			 $a_creer = 0;	      			    	  		    
	      }	  	  		  
	  }
	  
      if ( $a_creer )
	  {
		clonage_order ( $orders_id, $dtb, "po", $dtb , 0, $languages_id, $orders_status );
		echo 'clonage '.$orders_id . ' <br>';	
        // report des prix d'achat et/ou des prix déjà reportés: 
		$db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);
        // 		
		$sql = "select orders_products_id, final_price, products_model from orders_products where orders_id = ". $orders_id ;
		$rs_order_price = $db->Execute($sql);
		
        while(!$rs_order_price->EOF)
		{
			$orders_products_id = $rs_order_price->fields['orders_products_id'];
			$products_model = $rs_order_price->fields['products_model'];
			$final_price = $rs_order_price->fields['final_price'];

			$final_price = $rs_order_price->fields['final_price'];			
			
			// usd_euro_rate
			// check dans les PO
			
			$sql = "select  final_price unit_order_price, usd_euro_rate, address_book.entry_country_id , customers.customers_id
			        from orders , orders_products, customers, address_book
					where orders.orders_id = orders_products.orders_id
					and   products_model = '".$products_model . "'
					and   final_price > 0
					and   database_code = 'po'
					and    orders.customers_id not in (29,28)
					and customers.customers_id = orders.customers_id
					and customers.customers_default_address_id = address_book.address_book_id					
					order by orders_products_id desc ";
					
			
						
			$rs_po =  $db->Execute($sql);
			$unit_order_price = $rs_po->fields['unit_order_price'];
			$usd_euro_rate = $rs_po->fields['usd_euro_rate'];
			$entry_country_id = $rs_po->fields['entry_country_id'];
			$customers_id = $rs_po->fields['customers_id'];
			
			// frais d'approche fonction du type de lampe et du pays source..
			/*
SELECT address_book.entry_country_id , countries.countries_name
FROM `address_book`,countries
where address_book.entry_country_id  = countries.countries_id

188	Singapore  
1000	China (RPC)
206	Taiwan
1002	Hong Kong

188,1000,206,1002,
	
1004,41,	Central African Republic
	
222	United Kingdom
	
204	Switzerland
73	France
21	Belgium
141	Monaco

*/			
//echo "edd".$entry_country_id.'<br>';			
//echo "edd".strpos ( '188,1000,206,1002,',$entry_country_id.',' ).'<br>';	
/*
SANSHO ---- €10
IAVI ----- € 10
STAMPEDE (SP) ---- € 10
Provantage (PV) ------- € 13
PD (projection design) ---€1
SIDEV (MID) ---- €1
*/
		
			if ( $customers_id == 26 )  // SANSHO
			{
				$approach_price=10;				
			}
			else if ( $customers_id == 14 ) // IAVI
			{
				$approach_price=10;				
			}
			else if ( $customers_id == 12 ) // STAMPEDE
			{
				$approach_price=10;				
			}
			else if ( $customers_id == 13 )  // Provantage
			{
				$approach_price=13;				
				
			}
			else if ( $customers_id == 33 )  // projection Design
			{
				$approach_price=1;				
				
			}			
			else if ( $customers_id == 23 )  // sidev
			{
				$approach_price=1;	
			}			
			else if ((substr($products_model,0,5)=="MCEL-")||(substr($products_model,0,3)=="OI-")||(substr($products_model,0,5)=="BCEL-"))
			{
				$approach_price=5;
			}	
			// LO ASIE
			else if ( strpos ( '188,1000,206,1002,',$entry_country_id.',') ) 
			{				
				$approach_price=10;
			}	
			// LO US
			else if ( strpos ( '1004,41,' , $entry_country_id.','  ) ) 
			{				
				$approach_price=13;
			}	
			// EUROPE (AUTRES)			
			else if ( strpos ( '204,73,21,141,' , $entry_country_id.','  ) ) 		
			{				
				$approach_price=1;
			}	
			else
			{				
				$approach_price=5;
			}	
								
/*			
			if (!($unit_order_price>0)&&(strlen($products_model)>0))
			{
				$sql = "select  unit_order_price, usd_euro_rate 
						from orders , orders_products
						where orders.orders_id = orders_products.orders_id
						and   products_model = '".$products_model . "'
						and   unit_order_price > 0
						and   database_code <> 'po'
						order by orders_products_id desc ";
				$rs_po =  $db->Execute($sql);
						
				$unit_order_price = $rs_po->fields['unit_order_price'];
				$usd_euro_rate = $rs_po->fields['usd_euro_rate'];
						
			}
*/			
			if (($unit_order_price>0)&&(strlen($products_model)>0))
			{
			   $margin =  $final_price-$unit_order_price/$usd_euro_rate-$approach_price;
			   $dml = "update orders_products 
			           set unit_order_price = ". $unit_order_price . ", 
					   usd_euro_rate = " . $usd_euro_rate . ",
					   margin = " . $margin . "	,
					   approach_price = " . $approach_price . "							   
					   where orders_products.orders_products_id = ". $orders_products_id;
			   $db->Execute($dml);			
			}			
		    $rs_order_price->MoveNext();
		}
	  }
	  else
	  {
echo 'products'.$products.' - '.count($products).'<br>';	  
	     // on vérifie qu'il n'y a pas de modification ... FVV
		 if($products>0)
		 {
			$product_tab = explode ('[',$products);
			
			$products_model_tab = Array();
			$orders_products_id_tab = Array();
			$products_quantity_tab = Array();
			$products_name_tab = Array();
			$products_final_price_tab = Array();
			$products_tax = Array();
			
			$tmp_tab = Array();
//			$where_tab = Array();
			
			for ($i=0;$i<count($product_tab);$i++)
			{
			// PRDS1|SP400|Smart Pointer 2.4 GHz Commande de présentation sans fil avec fo|16.7100
			    $tmp_tab = explode ( '|', $product_tab[$i] );
				$products_quantity_tab[] = $tmp_tab[0];				
				$orders_products_id_tab[] = $tmp_tab[1];
				$products_name_tab[] = $tmp_tab[2];
				$products_final_price_tab[] = $tmp_tab[3];
				$products_tax[] = $tmp_tab[4];
				$products_model_tab[] = $tmp_tab[5];
				
//		        $where_tab[] = "('".$products_model_tab[$i]."',".$products_quantity_tab[$i].")";
//		        $where_tab[] = "'".$orders_products_id_tab[$i]."'";
			}
			$db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);
			for ($i=0;$i<count($product_tab);$i++)
			{
			    $check0 = exec_select ("select 1  value
							from orders 
							where orders_id = " .  $orders_id );

$sql = "select 1  value
							from orders_products 
							where source_orders_products_id = '". $orders_products_id_tab[$i] ."'
							and orders_id = " .  $orders_id;
							
				$check = exec_select ($sql );
//echo 'cccccccccccc'.$check.'mmmm'.$sql.'mmmmmmmmmm';exit;
				$checkCnt = exec_select ("select products_quantity  value
							from orders_products 
							where source_orders_products_id = '". $orders_products_id_tab[$i] ."'
							and orders_id = " .  $orders_id ." 
							limit 0,1");
							
				$checkPrice = exec_select ("select final_price  value
							from orders_products 
							where source_orders_products_id = '". $orders_products_id[$i] ."'
							and orders_id = " .  $orders_id ." 
							limit 0,1");

				$checkModel = exec_select ("select products_model  value
							from orders_products 
							where source_orders_products_id = '". $orders_products_id[$i] ."'
							and orders_id = " .  $orders_id ." 
							limit 0,1");
							
				if  ( $check0==1) 
				{
					if  ( $check != 1) 
					{
						$dml = "insert into 
								orders_products 
								( products_model, products_name, products_quantity,
								  final_price, orders_id, products_tax,
								  source_orders_products_id )
								 values ( '".$products_model_tab[$i]."','".addslashes($products_name_tab[$i])."','".$products_quantity_tab[$i]."',
										 '".$products_final_price_tab[$i]."'," . $orders_id . ", " . $products_tax[$i] . ",
										 " . $orders_products_id_tab[$i] . ")";
//echo $dml.'<br>';										 
						$db->Execute($dml);
					}
					else if  ( 
             					( $checkCnt != $products_quantity_tab[$i] )
								||
             					( $checkPrice != $products_final_price_tab[$i] )
								||
             					( $checkModel != $products_model_tab[$i] )
							 )
					{
						$dml = "update orders_products 
								set  final_price = ". $products_final_price_tab[$i] . " ,
									products_name = '". addslashes($products_name_tab[$i])."',
									products_model = '". addslashes($products_model_tab[$i])."',
								products_quantity = ". $products_quantity_tab[$i] . " 
								where orders_id = ".  $orders_id . "
								and source_orders_products_id = '".$orders_products_id_tab[$i]."'";								
//echo $dml.'<br>';										 								
						$db->Execute($dml);
					}			
					// suppression des éventuelles lignes mauvaises
					//$product_tab
				}
				$to_keep =  "'".implode($orders_products_id_tab,"','")."'";				
				$dml = "delete from orders_products where orders_id=".$orders_id. " and source_orders_products_id not in ( " . $to_keep . ")";
//echo '<br>keeeeeeeeeeeeeeeeeeep'.$dml.'<br>';										 												
			    $db->Execute($dml);           
			}
		 }
	  }
	  // suppresssion des rebonds
	  $previous_customers_id = $customers_id;
	  
		//  $p_old_order_id, $p_old_db, $p_new_db, $p_customer_database_code , $p_new_customers_id, $p_new_languages_id, $p_new_status     
	  $cnt++;
 }
// affichage des rejets:
 echo '<h2>Nature des rejets</h2>';
 foreach ($feedback as $rejet)
 {
    echo $rejet.'<br>';
 }
 // données équivalentes :
 $db->connect($ext_db_server["eu"], $ext_db_username["eu"], $ext_db_password["eu"], $ext_db_database["eu"], USE_PCONNECT, false);  
 $sql = "select ctr_code2,lamp_code2,qty
         from el_equivalence, el_stock 
		 where ctr_code1=ctr_code
		 and  lamp_code1=lamp_code";
  $rs=$db->Execute($sql);
  
   while(!$rs->EOF)
   {
		$dml = "update el_stock set qty = ". $rs->fields['qty'] . "
				where ctr_code = '". $rs->fields['ctr_code2'] . "'
				and  lamp_code = '". $rs->fields['lamp_code2'] ."'";
				
//		echo $dml.'<br>';		
		$db->Execute($dml);
		
		$rs->MoveNext();
   }
 

?>