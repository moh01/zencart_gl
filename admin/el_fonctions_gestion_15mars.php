<?php

function update_po_status ($tag_id)
{
   global $db;
   global $ext_db_server;
   global $ext_db_username;   
   global $ext_db_server;
   global $ext_db_password;
   global $ext_db_database;
   
   // FV pour débloquer...
   return 1;
   
    $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  

   $sql = "select orders_products.orders_id value 
		  from el_tag,orders_products
		  where orders_products.orders_products_id=el_tag.po_orders_products_id
		  and id = ". $tag_id;
   
   $po_orders_id = exec_select($sql);
   
//echo    $po_orders_id . '  | '.$sql.'<br>';
   
   $sql = "select count(1) value 
	        from  el_tag
			where po_orders_products_id in ( select  orders_products_id
											from orders_products
											where orders_id = ".$po_orders_id . "
											and products_model <> 'SHF' )
			and  stock_entry_date <> '0000-00-00' ";
			
//echo $sql;
			
	$produits_sortis = exec_select ($sql);

    $sql = "select sum(products_quantity) value 
	        from  bo_po.orders_products 
			where orders_id = ".$po_orders_id . "
			and products_model <> 'SHF'  ";
			
	$produits_total = exec_select ($sql);

    $sql = "select orders_status value 
	        from  bo_po.orders
			where orders_id = ".$po_orders_id ;
			
	$from_status = exec_select ($sql);
	
	
	if  ($produits_total == $produits_sortis)
	{
		if ( $from_status == 15 ) 
			$to_status = 16;
		else if ( $from_status == 17 )
			$to_status = 18;			
		else 
			$to_status = 13;
			
		$dml = "update bo_po.orders set orders_status = ". $to_status . " where orders_id = ".$po_orders_id ;
		$db ->Execute($dml);
	}
	
}


function stock_items_lookup ($po_orders_products_id)
{
   global $db;
/*
   $sql = "select count(1) value 
	        from rv_lampe_eu.el_stock_items, bo_po.el_tag
			where po_orders_products_id = ".$po_orders_products_id . "
			and  el_tag.id =  el_stock_items.id
			and  stocj";
*/
   $sql = "select count(1) value 
	        from  el_tag
			where po_orders_products_id = ".$po_orders_products_id . "
			and  stock_entry_date <> '0000-00-00' ";
			
//echo '<td>'.$sql.'</td>';			

	$cnt = exec_select($sql);		
	return $cnt;			
}


function add_field_collissimo($txt)
{
//   return utf8_encode($txt);
  return $txt;
}

function get_flux_collissimo($order_num,$db_code)
{
      global $db;
	  $texte="";
      $requete = "select orders_id, order_total, customers_id,
                         delivery_name,
                  delivery_company, delivery_street_address, delivery_suburb,
                  orders_id,delivery_postcode,delivery_city,
                  delivery_country,customers_telephone,customers_email_address,
                  payment_method, date_format(now(),'%d%m%Y') date_exped,delivery_state";
      $requete .= " from orders ";
      $requete .= " where orders_id = ".$order_num;
     
	  $rs = $db->Execute($requete);
	 
		$texte.= '"'. $rs->fields['orders_id'].'";';                    //orders_id ou ref
		$texte.= '"'. $rs->fields['delivery_name'].'";';                // nom 
		$texte.= '"";';                                                    //prenom inclu dans le nom
		if(!empty($rs->fields['delivery_company'])){
		   $texte.='"'.$rs->fields['delivery_company'].'";';            //adresse1
		   $texte.='"'.$rs->fields['delivery_street_address'].'";';     //adresse2
		   $texte.='"'.$rs->fields['delivery_suburb'].'";';             //adresse3
		}else{
		   $texte.='"'.	$rs->fields['delivery_street_address'].'";';      //adresse1
		   $texte.='"'.	$rs->fields['delivery_suburb'].'";';              //adresse2
		   $texte.='"";';                                                 //adresse3
		}
		$sql =  "select comments value from orders_status_history where comments not like '%@%'  and comments not like '%#%' and comments not like '%paypal%'  and orders_id=". $rs->fields['orders_id'] ;
		$temp = exec_select ( $sql ); 
//echo $temp;exit;		
		$temp = ereg_replace("[^A-Za-z0-9 @&éàèù]", " ", $temp);
		
		$texte.='"'. $temp .'";';                                                  //adresse4	         
		$texte.= '"'. $rs->fields['delivery_postcode'].'";';            //code postale
		$texte.= '"'. $rs->fields['delivery_city'].'";';                //commune
		if(!empty($rs->fields['delivery_country'])){
		 $texte.='"'.get_country_code_common($rs->fields['delivery_country']).'";';  //code pays du destinataire                                    
		}else{
		   $texte.='"ZZ";';
		}
		$texte.= '"1000";';                                               //poids du colis en gramme
// 	$sql = "select comments from orders_status_history where orders_id=".$_SESSION['orders_id']." and comments not like '%#%' and comments not like '%paypal%'";

		
		$texte.= '"'. $rs->fields['customers_telephone'].'";';            // téléphone du destinataire du colis
		$texte.='"'.$temp.'"';    //pas de point virgule à la dernière ligne.    //commentaire sur le colis
		
		$output .= add_field_collissimo($texte);

        $output .='
';
  return $output;
}

  function stock_info ( $chaine_scannee, $i  )
  {
     global $db;
	 global $ext_db_server;
	 global $ext_db_username;
	 global $ext_db_password;
	 global $ext_db_database;

	 $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  
	 if (strlen($chaine_scannee)>3)
	 {
	  $to_fetch = $chaine_scannee;
	  $to_fetch = str_replace("rf " ,"" ,$to_fetch);
	  $to_fetch = str_replace(" si" ,"" ,$to_fetch);

	  $to_fetch = str_replace("RF " ,"" ,$to_fetch);
	  $to_fetch = str_replace(" SI" ,"" ,$to_fetch);
	  
	   $sql = " select lamp_code, in_stock, po_orders_products_id, print_date, consignment_stock
		from   el_tag t
		where  t.id = " . $to_fetch ;
//echo $sql.'<br>';		
		$rs=$db->Execute($sql);
		
		$sql = "select customers_company, date_purchased from orders, orders_products 
				where orders.orders_id = orders_products.orders_id
				and  orders_products_id = " . $rs->fields['po_orders_products_id'] ;
//echo $sql.'<br>';
		$rs2=$db->Execute($sql);
		if ( strlen($rs2->fields['customers_company'])>0 )
		{
			$po_info = '<br> Fournisseur : ' . $rs2->fields['customers_company']. '   Date achat : '. $rs2->fields['date_purchased']; 
		}				
		
		$consignment_stock = $rs->fields['consignment_stock'];
		if ( $consignment_stock )
		   $dsp_consignment_stock = 'CONSIGNMENT STOCK';
		else 
		   $dsp_consignment_stock = '';
		
 		echo '<font size=3>'.$to_fetch.' '.$rs->fields['lamp_code'].' En stock: '.$rs->fields['in_stock'].'  '. $dsp_consignment_stock .'  Date impression:'.$rs->fields['print_date']. $po_info .'</font><br><br>';		
	 }
		  
//		  echo $to_fetch;exit;
	
  }
  
  function stock_output ( $chaine_scannee, $i, $silent=0, $enforce_marquage_sortie=0 )
  {
// echo $chaine_scannee;exit; 
	// $enforce_marquage_sortie permet de sortir un produit une seconde fois si appelée depuis le l'écran de dispatch
     global $db;
	 global $ext_db_server;
	 global $ext_db_username;
	 global $ext_db_password;
	 global $ext_db_database;

	 
	if (strlen($chaine_scannee)>3)
	{
	  $to_fetch = $chaine_scannee;
	  $to_fetch = str_replace("rf " ,"" ,$to_fetch);
	  $to_fetch = str_replace(" si" ,"" ,$to_fetch);
	  
	  $to_fetch = str_replace("RF " ,"" ,$to_fetch);
	  $to_fetch = str_replace(" SI" ,"" ,$to_fetch);

//		$db->connect($ext_db_server["eu"], $ext_db_username["eu"], $ext_db_password["eu"], $ext_db_database["eu"], USE_PCONNECT, false);  
		$sql = "select exit_date, lamp_code, ctr_code, consignment_stock  from rv_lampe_eu.el_stock_items where id= ".$to_fetch;
//echo $sql;exit;		
		$rs=$db->Execute($sql);
		if ($rs->EOF)
		{
			echo '<font color=red>Sortie de stock non trouvée pour '. $i . ', identifiant : '. $to_fetch .'</font><br>' ; 			
		}
		else
		{
			$exit_date = $rs->fields['exit_date'];			
			$lamp_code = $rs->fields['lamp_code'];			
			$ctr_code = $rs->fields['ctr_code'];		
			$consignment_stock= $rs->fields['consignment_stock'];			
			
			if  ( ($exit_date=="0000-00-00") || ($enforce_marquage_sortie==1) )
			{
			    if ( $_GET['delete']==1 )			
				{
					$dml = "delete from  rv_lampe_eu.el_stock_items where id = ". $to_fetch;								
				}
				else
				{
					$dml = "update rv_lampe_eu.el_stock_items set exit_date = now()  where id = ". $to_fetch;								
				}
				$db->Execute($dml);
				
			    if ( $_GET['delete']==1 )			
				{
					$dml = "delete from  bo_po.el_tag where id = ". $to_fetch;								
					$db->Execute($dml);
				}
								
				$dml = "update rv_lampe_eu.el_stock set qty=qty-1  where ctr_code='". $ctr_code."' and lamp_code='". $lamp_code."'";
				$db->Execute($dml);

				$sql = "select qty
						from rv_lampe_eu.el_stock 
						where  ctr_code = '". $ctr_code . "'
						and    lamp_code  = '". $lamp_code . "'"; 		
				
				$rs2=$db->Execute($sql);
				$new_qty = $rs2->fields["qty"];
				
				
				if ($consignment_stock==1)
				{
					$dml = "update rv_lampe_eu.el_external_stock set qty=qty-1  where ctr_code='". $ctr_code."' and lamp_code='". $lamp_code."'";					
//echo $exit_date;exit;
//9088				
					
					$db->Execute($dml);
				}				
				echo '<font color=green>Sortie de stock OK '. $i . ', identifiant : '. $to_fetch .' LAMPE: '. $lamp_code . '  STOCK: ' . $new_qty  .'</font><br>' ; 							
				
			}
			else
			{
				echo $enforce_marquage_sortie.'<font color=red>Ligne de stock non trouvée pour '. $ctr_code."' and lamp_code='". $lamp_code . '</font><br>' ; 						   
			}
		}
    }
    else
    {
	   echo '<font color=red>Ligne vide pour '. $i . '</font><br>' ; 
    }	   
  }
  /* fin de la fonction  ----------------------------------------------------------------------------------------------- */
 
  function stock_input ( $chaine_scannee, $i, $silent=0, $second_entry=0 )
  {
     global $db;
	 global $ext_db_server;
	 global $ext_db_username;
	 global $ext_db_password;
	 global $ext_db_database;

	 
		 $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  
		 if (strlen($chaine_scannee)>3)
		 {
		  $to_fetch = $chaine_scannee;
		  $to_fetch = str_replace("rf " ,"" ,$to_fetch);
		  $to_fetch = str_replace(" si" ,"" ,$to_fetch);

		  $to_fetch = str_replace("RF " ,"" ,$to_fetch);
		  $to_fetch = str_replace(" SI" ,"" ,$to_fetch);

		  
//		  echo $to_fetch;exit;
		  
	   $sql = " select lamp_code products_model, in_stock, consignment_stock
	from   el_tag t
	where  t.id = " . $to_fetch ;
	
		 $rs=$db->Execute($sql);
		 
		 $products_model = $rs->fields['products_model'];
		 $in_stock = $rs->fields['in_stock'];
		 $consignment_stock = $rs->fields['consignment_stock'];
		 
//echo $consignment_stock;


		 if ( ( strlen($products_model)> 0) && ($in_stock == 0) )
		 {
			// on va chercher la marque au stock 
			$db->connect($ext_db_server["eu"], $ext_db_username["eu"], $ext_db_password["eu"], $ext_db_database["eu"], USE_PCONNECT, false);  
			$sql = "select ctr_code,  count(1) cnt from el_stock where ctr_code not in ('EIKI','ELMO','NOBO','COMPAQ','ASK','Promethean','BOXLIGHT','ELMO')  and lamp_code = '".$products_model."'  group by ctr_code";
//echo $sql;exit;			
			$rs=$db->Execute($sql);
			$ctr_code = $rs->fields['ctr_code'];
			$cnt = $rs->fields['cnt'];
			if ($cnt>0)
			{
				$stock_exists = 1;
			}
			else
			{
			    // cas bizzare PROMOTHEAN
				$sql = "select ctr_code,  count(1) cnt from el_stock where lamp_code = '".$products_model."'  group by ctr_code";
	//echo $sql;exit;			
				$rs=$db->Execute($sql);
				$ctr_code = $rs->fields['ctr_code'];
				$cnt = $rs->fields['cnt'];
				if ($cnt>0)
				{
					$stock_exists = 1;
				}
				else
				{
					$stock_exists = 0;
				}
			}
//echo $stock_exists;exit;			
			
			if ($cnt>1)
			{
				echo '<font color=red>Plusieurs possibilités de stock pour  '. $i . '  / '. $to_fetch . '  / '. $products_model .'</font><br>' ; 
			}
			else
			{
                if ($cnt==0)
				{
					$sql = "select count(distinct ctr_code) cnt 
					from el_price 
					where ctr_code not in ('EIKI','ELMO','NOBO','COMPAQ','ASK','Promethean','BOXLIGHT','ELMO')
					and   lamp_code = '".$products_model."'";
//echo $sql; exit;					
					$rs=$db->Execute($sql);
					
					$cnt = $rs->fields['cnt'];

					$sql = "select  ctr_code
					from el_price where lamp_code = '".$products_model."'";
//echo $sql; exit;					
					$rs=$db->Execute($sql);
					$ctr_code = $rs->fields['ctr_code'];

					
				}
				if ($cnt==0)
				{
					echo '<font color=red>Etiquette:'. $to_fetch .  ': le code produit   '.  $products_model .' n\'est pas reconnu dans le catalogue.</font><br>' ; 
				}
				else if ($cnt>1)
				{
					echo '<font color=red>Etiquette:'. $to_fetch .  ': plusieurs possibilités de catalogue  '. $i . '  / '. $products_model .'</font><br>' ; 
				}
				else
				{
/*				
				    if ( $_GET['external_stock']==1  )
					    $consignment_stock = 1;
					else
					    $consignment_stock = 0;
*/					
			$sql = "select 1 cnt
				from el_stock_items
				where id = ".$to_fetch;
//echo $sql;exit;			
					$rs=$db->Execute($sql);
					$cnt = $rs->fields['cnt'];
					if ($cnt==0)
					{
						$dml = " insert into el_stock_items (id, ctr_code, lamp_code, 
															entry_date, consignment_stock )
							   values ( ". $to_fetch .",'".$ctr_code."','".$products_model."', now(), ".  $consignment_stock  . "   )";
						
						 $db->Execute($dml);
					 }
					

//echo 'POST BUG <br>';
					 
					 // la mise à jour du niveau de stock
					 
					 if ( $stock_exists )
					 {
					    $dml = "update el_stock  set qty = qty  + 1 
						where ctr_code = '".$ctr_code . "' 
						and lamp_code = '". $products_model . "'"; 
					 }
					 else
					 {
					    $dml = "insert into  el_stock (qty, ctr_code, lamp_code )
						        values ( 1,  '". $ctr_code . "', '". $products_model . "')"; 					 
					 }
					 $db->Execute($dml);				
					 
					$sql = "select qty
							from el_stock 
							where  ctr_code = '". $ctr_code . "'
							and    lamp_code  = '". $products_model . "'"; 		
					
					$rs2=$db->Execute($sql);
					$new_qty = $rs2->fields["qty"];
					 if ( $consignment_stock ) 
					 {
						$sql = "select ctr_code,  count(1) cnt from el_external_stock where ctr_code not in ('EIKI','ELMO','NOBO','COMPAQ','ASK','Promethean','BOXLIGHT','ELMO')  and lamp_code = '".$products_model."'  group by ctr_code";
						
						$rs=$db->Execute($sql);
						$ctr_code = $rs->fields['ctr_code'];
						$cnt = $rs->fields['cnt'];
						
						if ($cnt>0)
						{
							$stock_exists = 1;
						}
						else
						{
							$stock_exists = 0;
						}
					 
						 if ( $stock_exists )
						 {
							$dml = "update el_external_stock  set qty = qty  + 1 
							where ctr_code = '".$ctr_code . "' 
							and lamp_code = '". $products_model . "'"; 
						 }
						 else
						 {
							$dml = "insert into  el_external_stock (qty, ctr_code, lamp_code )
									values ( 1,  '". $ctr_code . "', '". $products_model . "')"; 					 
						 }						
						 $db->Execute($dml);					 						 
					 }
					//
					 
					 $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  
					
					 $dml = " update el_tag set in_stock = 1, stock_entry_date=now()  where  id = " . $to_fetch;
					 
					 $db->Execute($dml);
					 if ($silent==0)
					 {
						echo '<font color=green>Stock  MAJ avec succès pour  '. $to_fetch . "-" . $products_model .' STOCK : ' . $new_qty . $sql  . ' </font><br>' ; 
					 }
				}
			}
			
		 }
		 else if ($in_stock == 1)
		 {
			if ($second_entry)
			{				
				//echo 'se';exit;
				if (  $consignment_stock  ) 
				{
					echo "<font color=red>ATTENTION PAS DE REPRISE  ETIQUETTE  CONSIGNMENT  STOCK ". $to_fetch . "-" . $products_model ." : </font>";
					return 0;
				}
				$db->connect($ext_db_server["eu"], $ext_db_username["eu"], $ext_db_password["eu"], $ext_db_database["eu"], USE_PCONNECT, false);  

				
				$sql = "select ctr_code,  count(1) cnt from el_stock where ctr_code not in ('EIKI','ELMO','NOBO','COMPAQ','ASK','Promethean','BOXLIGHT','ELMO')  and lamp_code = '".$products_model."'  group by ctr_code";
	//echo $sql;exit;			
				$rs=$db->Execute($sql);
				$ctr_code = $rs->fields['ctr_code'];
				$cnt = $rs->fields['cnt'];
				if ($cnt==1)
				{
					$dml = "update el_stock_items set exit_date='',reentry_date=now()
							where  id = ". $to_fetch ; 					 
					$db->Execute($dml);
				
					$dml = "update el_stock set qty=qty+1
							where  ctr_code = '". $ctr_code . "'
							and    lamp_code  = '". $products_model . "'"; 		
							
					$db->Execute($dml);				
					
					$sql = "select qty
							from el_stock 
							where  ctr_code = '". $ctr_code . "'
							and    lamp_code  = '". $products_model . "'"; 		
					
					$rs2=$db->Execute($sql);
					$new_qty = $rs2->fields["qty"];
					
//echo '22222222222'.$new_qty.'2222222222222';					 
					
					echo '<font color=green>Stock  MAJ avec succès pour  '. $to_fetch . "-" . $products_model . ' STOCK :'. $new_qty . ' </font><br>' ; 
				}
				else
				{
					echo '<font color=red>Problème rentrée en stock pour  '. $to_fetch . "-" . $products_model .' </font><br>' ; 
				}								
			}			
			else
			{
				echo '<font color=red>Produit déjà rentré en stock   pour '. $i . '  / '. $chaine_scannee.'</font><br>' ;
			}
		 }
		 else
		 {
			echo '<font color=red>Num étiquette non trouvée  pour '. $i . '  / '. $chaine_scannee.'</font><br>' ; 
		 }
	   }
	   else
	   {
		   echo '<font color=red>Ligne vide pour '. $i . '</font><br>' ; 
	   }	 
	   if ($to_fetch>0)
	   {
		   // FVV 
		   update_po_status ($to_fetch);
	   }
  }
  /* fin de la fonction  ----------------------------------------------------------------------------------------------- */

function get_english_lamp_label($description2,$prdref)
{
        $vp_ok = 0;
		$separator = ' for ';
		$pos_pour = strpos($description2,$separator);
		if ($pos_pour>0)
		{
			$description2 = substr($description2,$pos_pour+strlen($separator),10000);
			$vp_ok = 1;			
		}
		
		$separator = ' pour ';
		$pos_pour = strpos($description2,$separator);
		if ($pos_pour>0)
		{
			$description2 = substr($description2,$pos_pour+strlen($separator),10000);
			$vp_ok = 1;			
		}

		$separator = ' für ';
		$pos_pour = strpos($description2,$separator);
		if ($pos_pour>0)
		{
			$description2 = substr($description2,$pos_pour+strlen($separator),10000);
			$vp_ok = 1;						
		}

		$separator = ' para ';
		$pos_pour = strpos($description2,$separator);
		if ($pos_pour>0)
		{
			$description2 = substr($description2,$pos_pour+strlen($separator),10000);
			$vp_ok = 1;						
		}


		$separator = ' per ';
		$pos_pour = strpos($description2,$separator);
		if ($pos_pour>0)
		{
			$description2 = substr($description2,$pos_pour+strlen($separator),10000);
			$vp_ok = 1;						
		}


		if ( $vp_ok )
		{
			$description2 = str_replace('.','',$description2);  
			$description2 = str_replace(',','',$description2);  
			$description2 = str_replace(':','',$description2);  
            $words=explode(" ",$description2);
			if (count($words)>2)
			{
				$description2 = $prdref . ' projector lamp.';  
			}
			else
			{
				$description2 = 'Lamp for '. strtoupper($description2) . ' projector.';  
			}
		}
		else
		{
			$description2 = 'Original projector lamp:  '. $prdref;  
		}
		
        return 	$description2;
}
function get_country_code_common($country)
{
    global $db;
    if (substr($country,0,6) == "France" )
   	$resultat = 'FR';
    else if ( $country == "Deutschland" )
   	$resultat = 'DE';
    else if ( $country == "Österreich" )
   	$resultat = 'AT';
    else if ( $country == "Schweiz" )
   	$resultat = 'CH';
    else if ( $country == "Suisse" )
   	$resultat = 'CH';              			
    else if ( $country == "Belgique" )
   	$resultat = 'BE';    
    else if ( substr($country,0,2) =='UK' )
   	$resultat = 'GB';    						
    else if ( $country == "Luxembourg" )
   	$resultat = 'LU';    												
    else if ( $country == "Italia" )
   	$resultat = 'IT';    																		
    else if ( strpos(strtoupper($country),"CANARIAS")>0)
   	$resultat = 'IC';    																			
    else if ( substr($country,0,4) =='Espa' )
      $resultat = 'ES';                   			          			
    else
	{
//	   $sql = "select 
//	   $rs = 
       $sql = "select countries_iso_code_2 value from countries where  countries_name='".$country."'";
       $resultat=exec_select($sql);                   			          			
	}	   
	return $resultat;	   
}
function get_code_produit($codepays)
{
      if ($codepays=="FR")
		   $code_produit = "N";		   
		else if (strpos(" 'DE', 'AT','BE','GB', 'LU','IT', 'ES', 'IE','LU','DK','FI','NL','SE','PT','LT','PL','RO','GR','HU','CY','MT',  " , $codepays ) > 0 )
		   $code_produit = "U";
		else 
		     $code_produit = "S";
			 

    return $code_produit;			 
}

Function removeaccents_common($string){ 
   $string= strtr($string,  "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ$&",
                  "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn  "); 
   $string= str_replace('ß','ss',$string);
   $string = iconv("ISO-8859-1","UTF-8",$string);
   return $string; 
   } 
function add_field_common($pvalue)
{
  $value = str_replace(';',' ',$pvalue);
  $value = str_replace(',',' ',$value);
  $value = str_replace(',',' ',$value);
  return $value.';';
} 
function get_flux_dhl($order_num,$db_code)
{
      global $db;
      $requete = "select orders_id, order_total, order_tax, customers_id,
                         delivery_name,
                  delivery_company, delivery_street_address, delivery_suburb,
                  orders_id,delivery_postcode,delivery_city,
                  delivery_country,customers_telephone,customers_email_address,
                  payment_method, date_format(now(),'%d%m%Y') date_exped,delivery_state";
      $requete .= " from orders ";
      $requete .= " where orders_id = ".$order_num;

	  $rs = $db->Execute($requete);
	 
	  
      $output .= add_field_common($rs->fields['orders_id']);
      $output .= add_field_common("");   // Numéro de récépissé 26 8 2      
      $output .= add_field_common($rs->fields['date_exped']); //Date expédition 34 8 3 Format : JJMMAAAA. Par défaut date du jour
      $output .= add_field_common($rs->fields['customers_id']);

      if ( strlen ( $rs->fields['delivery_company'] ) < 2  )
  			$output .= add_field_common("Individual");
      else
  			$output .=  add_field_common($rs->fields['delivery_company']);


      $output .= add_field_common($rs->fields['delivery_street_address']);

      $output .= add_field_common($rs->fields['delivery_suburb']);

  		$output .= add_field_common('');

      $output .= add_field_common($rs->fields['delivery_postcode']);      
      
      $output .= add_field_common($rs->fields['delivery_city']);


      $country=$rs->fields['delivery_country'];           
	  
      $codepays = get_country_code_common($country);
      $output .= add_field_common($codepays);
	  $contact_name = $rs->fields['delivery_name'];
//	  $output .= add_field_common(strlen($contact_name));
	  
      if (strlen($contact_name)>2)
	  {
        $output .= add_field_common($contact_name);
	  }
	  else
	  {
	        if ( strlen ( $rs->fields['delivery_company'] ) < 2  )
			{
	  			$output .= add_field_common("Individual");
			}
	        else
			{
	  			$output .=  add_field_common($rs->fields['delivery_company']);
			}
	  }
      $output .= add_field_common($rs->fields['customers_email_address']);
      if ( strlen ( $rs->fields['customers_telephone']>0 ) )
		$output .= add_field_common($rs->fields['customers_telephone']);
	  else
		$output .= add_field_common("01 01 01 01");
  

	//  pa?a - Baleares, Gibraltar, Ceuta 	LK
	//  Espa?a - Baleares 	BR
			 
		$code_produit = get_code_produit($codepays);

		//else if ( strpos(  " 'CH' ", $codepays )>0)
		//   $code_produit = "S";					   
			 
		   
		 // ,'IS'  ,'NO'
		 
      $temp = exec_select ( "select comments value from orders_status_history where comments not like '%@%'  and comments not like '%#%' and comments not like '%paypal%' and orders_id=". $rs->fields['orders_id'] ); 
      $temp = ereg_replace("[^A-Za-z0-9 @&éàèù]", " ", $temp);
	  
      $temp = str_replace(chr(13), ' ', $temp);
      $output .= add_field_common($temp);
		$output .= add_field_common(""); // remarque
		$output .= add_field_common("1"); // nb colis
		$output .= add_field_common("0"); // nb  palette
		$output .= add_field_common("0"); // nb  palette consignées					
		$output .= add_field_common("1"); // 1 kg
		$output .= add_field_common(""); //  volume
		$output .= add_field_common(""); // longueur
		$output .= add_field_common(""); // largeur 
		$output .= add_field_common(""); // hauteur
		$output .= add_field_common(""); // date demandée
		$output .= add_field_common(""); // montant contre remb
		$output .= add_field_common(""); // devise contre rem
	//	$output .= add_field_common($rs->fields["order_total"]*100); // valeur 
		$output .= add_field_common(""); // valeur 
		
	//	$output .= add_field_common('EUR'); // devise valeur 
		$output .= add_field_common(""); // valeur 	
				
		if ($code_produit=='S')
		{
			$sql2 = "select sum(products_quantity*final_price) value
					from orders_products
					where products_model<>'SHF' and  orders_id = ". $rs->fields['orders_id'];
			$valeur = round(exec_select($sql2));
					
			$output .= add_field_common($valeur); // valeur déclarée

			$output .= add_field_common("EUR"); // devise valeur déclarée
		}
		else
		{
			$output .= add_field_common(""); // valeur déclarée
			$output .= add_field_common(""); // devise valeur déclarée
		}		
		$output .= add_field_common("Electronic material"); // Nature marchandise
		$output .= add_field_common("P"); // Port payé
//  	    $output .= add_field_common('---'.$code_produit.'----'.$codepays.'----'); //  Incoterm		
		if ($code_produit=='S')
		{
			$output .= add_field_common("DDU"); //  Incoterm
		}
		else
		{
			$output .= add_field_common(""); //  Incoterm
		}
		
		$output .= add_field_common(""); // mauvais
		$output .= add_field_common(""); // Unité taxable 
		$output .= add_field_common(""); // code préparateur
		$output .= add_field_common(""); // matieres dangereuses
		$output .= add_field_common(""); // code transporteur

		
//$output .= "merdum";

	    $output .= add_field_common($code_produit); // code produit
//return($db_code);
		
		if ($db_code=="fr")
		 {
			$output .= add_field_common("LVP");       			         							 
		 }
		 else if ($db_code=="de")
		 {							
			$output .= add_field_common("APL");       			         							 							 
		 }								
		 else if ($db_code=="en")
		 {							
			$output .= add_field_common("JPL");       			         							 							  							 
		 }																
		 else if ($db_code=="it")
		 {							 							 							 
			$output .= add_field_common("LPI");       			         							 							  							 							 
		 }																								
		 else if ($db_code=="es")
		 {							 							 							 							 
			$output .= add_field_common("LPP");       			         							 							 
		 }																																
		 else if ($db_code=="eu" )
		 {							
			$output .= add_field_common("EL");       			         							 							 							 
		 }																															

		$output .= add_field_common(""); // service point			
		$output .= add_field_common(""); // code service point				
		$output .= add_field_common(""); // code service point				

		$output .= add_field_common($rs->fields["delivery_state"]); // région 
  
        $output .='
';
  return $output;
}
/*
function get_flux_gls_p($order_num,$db_code)
{
      global $db;
      $requete = "select orders_id, order_total, customers_id,
                         delivery_name,
                  delivery_company, delivery_street_address, delivery_suburb,
                  orders_id,delivery_postcode,delivery_city,
                  delivery_country,customers_telephone,customers_email_address,
                  payment_method, date_format(now(),'%d%m%Y') date_exped,delivery_state";
      $requete .= " from orders ";
      $requete .= " where orders_id = ".$order_num;

	  $rs = $db->Execute($requete);
	 
	  
      $output .= add_field_common($rs->fields['orders_id']);
      $output .= add_field_common("");   // Numéro de récépissé 26 8 2      
      $output .= add_field_common($rs->fields['date_exped']); //Date expédition 34 8 3 Format : JJMMAAAA. Par défaut date du jour
      $output .= add_field_common($rs->fields['customers_id']);

      if ( strlen ( $rs->fields['delivery_company'] ) < 2  )
  			$output .= add_field_common($rs->fields['delivery_name']);
      else
  			$output .=  add_field_common($rs->fields['delivery_company']);


      $output .= add_field_common($rs->fields['delivery_street_address']);

      $output .= add_field_common($rs->fields['delivery_suburb']);

  		$output .= add_field_common('');

      $output .= add_field_common($rs->fields['delivery_postcode']);      
      
      $output .= add_field_common($rs->fields['delivery_city']);


      $country=$rs->fields['delivery_country'];           
	  
      $codepays = get_country_code_common($country);
      $output .= add_field_common($codepays);
	  $contact_name = $rs->fields['delivery_name'];
//	  $output .= add_field_common(strlen($contact_name));
	  
      if (strlen($contact_name)>2)
	  {
        $output .= add_field_common($contact_name);
	  }
	  else
	  {
	        if ( strlen ( $rs->fields['delivery_company'] ) < 2  )
	  			$output .= add_field_common("Individual");
	        else
	  			$output .=  add_field_common($rs->fields['delivery_company']);
	  }
      $output .= add_field_common($rs->fields['customers_email_address']);
  
      $output .= add_field_common($rs->fields['customers_telephone']);
  

	//  pa?a - Baleares, Gibraltar, Ceuta 	LK
	//  Espa?a - Baleares 	BR
      if ($codepays=="FR")
		   $code_produit = "N";		   
		else if (strpos(" 'DE', 'AT','BE','GB', 'LX','IT', 'ES', 'IE','IS','LU','NO','DK','FI','NL','SE','PT','LT','PL','RO'  " , $codepays ) > 0 )
		   $code_produit = "U";
		else if ( strpos(  " 'CH' ", $codepays )>0)
		   $code_produit = "S";					   
		else 
		   $code_produit = "";
		   
      $temp = exec_select ( "select comments from orders_status_history where  comments not like '%@%' and orders_id=". $rs->fields['orders_id'] ); 
      $temp = ereg_replace("[^A-Za-z0-9 @&éàèù]", " ", $temp);
	  
      $temp = str_replace(chr(13), ' ', $temp);
      $output .= add_field_common($temp);
		$output .= add_field_common(""); // remarque
		$output .= add_field_common("1"); // nb colis
		$output .= add_field_common("0"); // nb  palette
		$output .= add_field_common("0"); // nb  palette consignées					
		$output .= add_field_common("1"); // 1 kg
		$output .= add_field_common(""); //  volume
		$output .= add_field_common(""); // longueur
		$output .= add_field_common(""); // largeur 
		$output .= add_field_common(""); // hauteur
		$output .= add_field_common(""); // date demandée
		$output .= add_field_common(""); // montant contre remb
		$output .= add_field_common(""); // devise contre rem
	//	$output .= add_field_common($rs->fields["order_total"]*100); // valeur 
		$output .= add_field_common(""); // valeur 
		
	//	$output .= add_field_common('EUR'); // devise valeur 
		$output .= add_field_common(""); // valeur 	
		
		if ($codepays=='CH')
		{
			$output .= add_field_common($rs->fields["order_total"]-25); // valeur déclarée
			$output .= add_field_common("EUR"); // devise valeur déclarée
		}
		else
		{
			$output .= add_field_common(""); // valeur déclarée
			$output .= add_field_common(""); // devise valeur déclarée
		}		
		$output .= add_field_common("Electronic material"); // Nature marchandise
		$output .= add_field_common("P"); // Port payé
//  	    $output .= add_field_common('---'.$code_produit.'----'.$codepays.'----'); //  Incoterm		
		if ($codepays == "CH")
		{
			$output .= add_field_common("DDU"); //  Incoterm
		}
		else
		{
			$output .= add_field_common(""); //  Incoterm
		}
		
		$output .= add_field_common(""); // mauvais
		$output .= add_field_common(""); // Unité taxable 
		$output .= add_field_common(""); // code préparateur
		$output .= add_field_common(""); // matieres dangereuses
		$output .= add_field_common(""); // code transporteur

		
//$output .= "merdum";

	    $output .= add_field_common($code_produit); // code produit
//return($db_code);
		
		if ($db_code=="fr")
		 {
			$output .= add_field_common("LVP");       			         							 
		 }
		 else if ($db_code=="de")
		 {							
			$output .= add_field_common("APL");       			         							 							 
		 }								
		 else if ($db_code=="en")
		 {							
			$output .= add_field_common("JPL");       			         							 							  							 
		 }																
		 else if ($db_code=="it")
		 {							 							 							 
			$output .= add_field_common("LPI");       			         							 							  							 							 
		 }																								
		 else if ($db_code=="es")
		 {							 							 							 							 
			$output .= add_field_common("LPP");       			         							 							 
		 }																																
		 else if ($db_code=="eu" )
		 {							
			$output .= add_field_common("EL");       			         							 							 							 
		 }																															

		$output .= add_field_common(""); // service point			
		$output .= add_field_common(""); // code service point				
		$output .= add_field_common(""); // code service point				

		$output .= add_field_common($rs->fields["delivery_state"]); // région 
  
        $output .='
';
  return $output;
}  
function get_flux_gls($order_num,$db_code)
{
      global $db;
      $requete = "select orders_id, order_total, customers_id,
                         delivery_name,
						 delivery_company, 
						 delivery_street_address, delivery_suburb,
                  orders_id,delivery_postcode,delivery_city,
                  delivery_country,customers_telephone,customers_email_address,
                  payment_method, date_format(now(),'%d%m%Y') date_exped,delivery_state";
      $requete .= " from orders ";
      $requete .= " where orders_id = ".$order_num;

	  $rs = $db->Execute($requete);
	 

      $output .= add_field_common("19927838");
      $output .= add_field_common("BP");
      $output .= add_field_common("");	  // Numéro de colis , si vide incrément	
      $output .= add_field_common("1");    // Poids
      $output .= add_field_common("1");    // Nb de colis
      $output .= add_field_common($rs->fields['orders_id']);    // Réf destinataire

      if (strlen($rs->fields['delivery_company'])>0)
	  {
		$output .= add_field_common($rs->fields['delivery_company']);	      	  
	  }
	  else
	  {
		$output .= add_field_common($rs->fields['delivery_name']);	      	  
	  }
	  
	  
      $output .= add_field_common($rs->fields['delivery_street_address']);

      $output .= add_field_common($rs->fields['delivery_suburb']);

	  $output .= add_field_common('');

	  
      $output .= add_field_common($rs->fields['delivery_postcode']);      
      
      $output .= add_field_common($rs->fields['delivery_city']);

      $country=$rs->fields['delivery_country'];           
      $codepays = get_country_code_common($country);
      $output .= add_field_common($codepays);

	  
      $output .= add_field_common("ref1");
      $output .= add_field_common("ref2");
	  $sql = "select comments value from orders_status_history where comments not like '%@%' and orders_id=".$rs->fields['orders_id'];
      $temp = exec_select ( $sql );      				  
      $temp = ereg_replace("[^A-Za-z0-9 @&éàèù]", " ", $temp);
      $temp = str_replace(chr(13), ' ', $temp);      		            
      $temp = removeaccents_common($temp);
      if (strlen($temp)==0)
      {
	     $temp = "-";
      }
	  $output .= add_field_common($rs->fields['delivery_name']);
	  
	  $output .= add_field_common($rs->fields['customers_telephone']);


	  $output .= add_field_common("Easylamps");
	  $output .= add_field_common("93100");
	  $output .= add_field_common("MONTREUIL");
	  $output .= add_field_common("FR");
	  
        $output .='
';
  return $output;
} 
*/  
function get_xml_ups($order_num,$db_code)
{
	  global $db;
	  
      $requete = "select orders_id, order_total , 
                         delivery_name,
                  delivery_company, delivery_street_address, delivery_suburb,
                  orders_id,delivery_postcode,delivery_city,
                  delivery_country,customers_telephone,customers_email_address,
                  payment_method,payment_module_code";
      $requete .= " from orders ";
      $requete .= " where orders_id = ".$order_num;

	  $rs = $db->Execute($requete);
	  
	  
      
      $sql = "select comments value from orders_status_history where comments not like '%@%'  and comments not like '%#%' and comments not like '%paypal%' and orders_id=".$rs->fields['orders_id'];
      $temp = exec_select ( $sql );      			
	  
      $temp = ereg_replace("[^A-Za-z0-9 @&éàèù]", " ", $temp);
      $temp = str_replace(chr(13), ' ', $temp);      		            
      $temp = removeaccents_common($temp);
	  
	  $comment = $temp;
      
      $country=$rs->fields['delivery_country'];           
       			         
     	 if ($db_code=="fr")
		 {
             $tel_sender = "01 71 86 46 57";       			         							 
             $name_sender =   "Lampevideoprojecteur.fr";
		 }
     	 else if ($db_code=="de")
		 {							
             $tel_sender = "01 71 86 46 53";       			         							 							 
             $name_sender = "Alleprojektorlampen";
		 }								
     	 else if ($db_code=="en")
		 {							
             $tel_sender = "01 71 86 46 55";       			         							 							  							 
             $name_sender = "JustProjectorLamps";								
		 }																
     	 else if ($db_code=="it")
		 {							 							 							 
             $tel_sender = "01 71 86 46 54";       			         							 							  							 							 
             $name_sender =  "LampadeProiettori";							                    	    
		 }																								
     	 else if ($db_code=="es")
		 {							 							 							 							 
             $tel_sender = "01 71 86 46 52";       			         							 							 
             $name_sender =  "Lamparasparaproyectores";
		 }																																
     	 else if ($db_code=="eu" )
		 {							
             $tel_sender = "01 71 86 46 60";       			         							 							 							 
             $name_sender =  "Easylamps";
		 }																																
     	 else if ($db_code=="hp" )
		 {							
             $tel_sender = "01 78 14 03 81";       			         							 							 							 
             $name_sender =  "HPL";
		 }																																

       $payment_method = $rs->fields["payment_method"];
	   $payment_module_code = $rs->fields["payment_module_code"];
         if ( ( $payment_module_code == "cod" ) || ( $payment_module_code == 'COD' )  )
         {
	   $cod_output = '<COD>				  
<Amount>'. $rs->fields["order_total"] .'</Amount>					
<Currency>EUR</Currency>					
</COD>';		
         }
    $addr1 = removeaccents_common($rs->fields['delivery_street_address']);
    $addr2 = removeaccents_common($rs->fields['delivery_suburb']);
	if (strlen($comment)>34)
	{
		$strt=34-strlen($addr2)-4;
		$addr2 .= ' '. substr($comment,0,34-strlen($addr2)-2);
		$addr3 = substr($comment,$strt,40);
	}
	else
	{
		$addr3 = $comment;	
	}
	
	if (strlen($rs->fields['delivery_company'])<3)
	{
	   $company = removeaccents_common($rs->fields['delivery_name']);	   	
	}
	else
	{
	   $company = removeaccents_common( $rs->fields['delivery_company'] );	
	}
	// contact 
	$contact = $rs->fields['delivery_name'];	
	if (strlen($contact)==0)
	{
		$contact = ".";		
	}
	// email 
	$email = $rs->fields['customers_email_address'];
	$email = str_replace(' ','',$email);
    
	
	if (strlen($email)==0)
	{
		$email = "noemail@linats.net";		
	}
	$place_arob = strpos(" ".$email,"@" );
	if ( ! $place_arob )
	{
		$email = "noemail@linats.net";				
	}
	if ( ! strpos(" ".$email,".",$place_arob ) )
	{
		$email = "noemail@linats.net";				
	}
	
    $output_xml .='	  
<OpenShipment ShipmentOption="" ProcessStatus="">
<Receiver>
	<CompanyName>'.$company.'</CompanyName>
	<ContactPerson>'.removeaccents_common($contact).'</ContactPerson>
	<AddressLine1>'.$addr1.'</AddressLine1>
	<AddressLine2>'.$addr2.'</AddressLine2>
	<AddressLine3>'.$addr3.'</AddressLine3>
	<City>'.removeaccents_common($rs->fields['delivery_city']).'</City>
	<CountryCode>'.get_country_code_common($country).'</CountryCode>
	<PostalCode>'.$rs->fields['delivery_postcode'].'</PostalCode>
	<Phone>'.$rs->fields['customers_telephone'].'</Phone>
	<EmailAddress1>'.removeaccents_common($email).'</EmailAddress1>
</Receiver>
<Shipper>
	<UpsAccountNumber>2A9663</UpsAccountNumber>
</Shipper>
<Shipment>
	<ServiceLevel>ST</ServiceLevel>
	<PackageType>CP</PackageType>
	<NumberOfPackages>1</NumberOfPackages>
	<ShipmentActualWeight>1</ShipmentActualWeight>
	<DescriptionOfGoods>Projector lamp</DescriptionOfGoods>
	<Reference1>'.$rs->fields['orders_id'].'</Reference1>
	<Reference2></Reference2>
	<BillingOption>PP</BillingOption>
	<QuantumViewNotifyDetails>
		<QuantumViewNotify>
			<NotificationEMailAddress>'.$rs->fields['customers_email_address'].'</NotificationEMailAddress>
			<NotificationRequest>5</NotificationRequest>
		</QuantumViewNotify>
		<FailureNotificationEMailAddress>ups@linats.net</FailureNotificationEMailAddress>
		<ShipperCompanyName>'.$name_sender.'</ShipperCompanyName>
		<SubjectLineOptions>SubjectLineOptions</SubjectLineOptions>
		<NotificationMessage>NotificationMessage</NotificationMessage>
	</QuantumViewNotifyDetails>
	'. $cod_output   .'
</Shipment>
</OpenShipment>';

		return $output_xml;
}
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
	if  (  ($p_new_db!="po") || ( $p_old_order_id < 0 ) )
	{
	    $db->connect($ext_db_server[$p_new_db], $ext_db_username[$p_new_db], $ext_db_password[$p_new_db], $ext_db_database[$p_new_db], USE_PCONNECT, false);
	    $maxQry = $db->Execute('select max(orders_id)+1 new_oid from orders') ; 
	    $oID = $maxQry->fields['new_oid']; 		  
	}
	else
	{
	    $oID = $p_old_order_id;
	}

    // recupération des informsations à lire
//echo 'podb'.$p_old_db;exit;	   	
    $db->connect($ext_db_server[$p_old_db], $ext_db_username[$p_old_db], $ext_db_password[$p_old_db], $ext_db_database[$p_old_db], USE_PCONNECT, false);
   
	// Duplicate order details from "orders" table
	$old_order = $db->Execute("SELECT * FROM " . TABLE_ORDERS. " WHERE orders_id = " . $p_old_order_id );

	  if ( $p_new_db=="po" ) 
	  {
	     $currency_value = $old_order->fields['currency_value'];
		 if ( ( $p_old_order_id < 0 ) 
		      && ( $old_order->fields['currency'] != 'EUR') )
		 {
			$db->connect($ext_db_server[$p_new_db], $ext_db_username[$p_new_db], $ext_db_password[$p_new_db], $ext_db_database[$p_new_db], USE_PCONNECT, false);		 
			$sql =  "select value from currencies where code='".$old_order->fields['currency']."'";
			$recordSet = $db->Execute($sql);
			$currency_value = $recordSet->fields['value'];
			$db->connect($ext_db_server[$p_old_db], $ext_db_username[$p_old_db], $ext_db_password[$p_old_db], $ext_db_database[$p_old_db], USE_PCONNECT, false);			
		 }
	  }
	  else if ( $old_order->fields['currency'] != 'EUR' )	 
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
   					 customers_telephone,
					 entry_country_id
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
		$customers_countries_id = $sqlCustomer->fields['entry_country_id'];

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
        $customers_countries_id = $old_order->fields['customers_countries_id'];	  

		
		  if ( $p_new_db=="po" )
		  {
			$date_purchased = $old_order->fields['date_purchased'];
		  }
		  else
		  {
			$date_purchased = "now()";
		  }
		  
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
			  $payment_info2 = $old_order->fields['payment_info2'];
			  $payment_amount2 = $old_order->fields['payment_amount2'];			  			  
		  }
		  
		  $treatment_date = "now()";
		  $products_tax = $old_order->fields['products_tax'];
		  
		  if ( $products_tax==0 )
		  {
			$products_tax = exec_select ( "select max(products_tax) value from orders_products where orders_id = ".$oID );
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
                             'products_tax' => $products_tax,							 							 
                             'ref_info' => $old_order->fields['ref_info'],	
                             'payment_info' => $payment_info,			
                             'payment_amount' => $payment_amount,			
                             'payment_info2' => $payment_info2,			
                             'payment_amount2' => $payment_amount2,										 							 
							 'orders_date_finished' => $orders_date_finished,
                             'order_tax' => $old_order->fields['order_tax'],
							 'treatment_date' => 'now()',
							 'customers_countries_id' =>$customers_countries_id);
//echo $products_tax;exit;		  
		  
          // les produits --------------------------------------
          $products_cnt = 0;
          $old_products = $db->Execute("SELECT * FROM orders_products WHERE products_quantity>0 and orders_id = '" . $p_old_order_id . "'");
		  
		  if  ( ($p_new_db=="po")  &&  ($p_old_db!="gl") )
		  {
		     
		     $sql = "select sum(final_price) value FROM orders_products WHERE products_quantity>0  and products_model in ('ESCF','ESCC') and orders_id = '" . $p_old_order_id . "'";		     
//echo $sql.'<br>';
		     $la_reduction = exec_select ( $sql );

			 if ( $la_reduction > 0)
			 {
				$sql = "select count(products_quantity) value FROM orders_products WHERE products_model not in ('SHF','CODF','ECOF','ESCF','ESCC','FRSH','FRS') and orders_id = '" . $p_old_order_id . "'";		     
//echo $sql.'<br>';
			    $cnt_products = exec_select ( $sql);
				if ( $cnt_products > 0)
					$la_reduction = $la_reduction/$cnt_products;
				else
					$la_reduction = 0;	
					
			 }
		  }
		  		  
				  
          while (!$old_products->EOF) 
		  {
		    if  ( ($p_new_db=="po")  &&  ($p_old_db!="gl") )
			{
			   $k = $old_products->fields['products_quantity'];
			   $products_model = $old_products->fields['products_model'];
			   // 'SHF','CODF','ECOF','ESCF','FRSH','FRS'
			   if (  ( $products_model != 'SHF' ) 
			         && ( $products_model != 'CODF' ) 
			         && ( $products_model != 'ECOF' ) 
			         && ( $products_model != 'ESCF' )
			         && ( $products_model != 'ESCC' ) 					 
			         && ( $products_model != 'FRSH' ) 
			         && ( $products_model != 'FRS' ) )
				{
			            $products_cnt++;  					  				
			    		$new_products[$products_cnt] = array('orders_id' => $oID,
			                                              'sort_order' => $old_products->fields['sort_order'],			
			                                              'products_id' => $old_products->fields['products_id'],
			                                              'products_model' => $old_products->fields['products_model'],
			                                              'products_name' => $old_products->fields['products_name'],
			                                              'final_price' => $old_products->fields['final_price']-$la_reduction,
			                                              'products_tax' => $old_products->fields['products_tax'],
			                                              'products_quantity' => $old_products->fields['products_quantity'],
			                                              'products_prid' => $old_products->fields['products_prid'] );
				
/*				
				   for ($iter=1; $iter<=$k; $iter++ )
				   {
			            $products_cnt++;  					  
			    		$new_products[$products_cnt] = array('orders_id' => $oID,
			                                              'sort_order' => $old_products->fields['sort_order'],			
			                                              'products_id' => $old_products->fields['products_id'],
			                                              'products_model' => $old_products->fields['products_model'],
			                                              'products_name' => $old_products->fields['products_name'],
			                                              'final_price' => $old_products->fields['final_price']-$la_reduction,
			                                              'products_tax' => $old_products->fields['products_tax'],
			                                              'products_quantity' => 1,
			                                              'products_prid' => $old_products->fields['products_prid'] );
				   }
*/				 
				
				}			        			
			}
			else
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
			}
            $old_products->MoveNext();
          }
		  /// les totaux --------------------------------------------
		  $order_total_cnt = 0;
		  $sql = "SELECT * FROM " . TABLE_ORDERS_TOTAL . " WHERE value <> 0 and orders_id = '" . $p_old_order_id . "'";
		  $old_order_total = $db->Execute( $sql );
//echo $sql.'<br>';		  
		  while (!$old_order_total->EOF) {
			$order_total_cnt++;
//echo $order_total_cnt.'<br>';			
			$new_order_total[$order_total_cnt] = array('orders_id' => $oID,
									 'title' => $old_order_total->fields['title'],
									 'text' => $old_order_total->fields['text'],
									 'value' => $old_order_total->fields['value'],
									 'class' => $old_order_total->fields['class'],
									 'sort_order' => $old_order_total->fields['sort_order']);

			$old_order_total->MoveNext();
		  }
			  
		  /// les commentaires --------------------------------------------
/*
orders_status_history_id,
orders_id,
orders_status_id,
date_added,
comments 
*/		  
		  $order_history_cnt = 0;		  
		  $old_order_history = $db->Execute("SELECT * FROM orders_status_history WHERE orders_id = '" . $p_old_order_id . "'");
		  
		  while (!$old_order_history->EOF) {
			$order_history_cnt++;
			$new_order_history[$order_history_cnt] = array('orders_id' => $oID,
									 'orders_status_id' => $old_order_history->fields['orders_status_id'],
									 'date_added' => $old_order_history->fields['date_added'],
									 'comments' => $old_order_history->fields['comments'],
									 'customer_notified' => $old_order_history->fields['customer_notified']);

			$old_order_history->MoveNext();
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
		  // history -------------------------------------
		  if ($order_history_cnt>0)
		  {
			  $loop = true;
			  $iter = 1;
			  while ($loop) 
			  {
				 zen_db_perform('orders_status_history', $new_order_history[$iter]);
				 $iter++;
				 if ( $iter > $order_history_cnt )
					 $loop = false;
			  }		  
		  }
		  // totaux -------------------------------------
		  $loop = true;
		  $iter = 1;		  
		  while ($loop) 
		  {
			 zen_db_perform(TABLE_ORDERS_TOTAL, $new_order_total[$iter]);
//echo 'zut'.	$iter . '<br>';		 exit;
			 $iter++;
			 if ( $iter > $order_total_cnt )
				 $loop = false;
		  }		  

//echo 'stop';exit;			  		  
		  if ( $old_order->fields['orders_status']==5 ) 
		  {
			  require_once(DIR_WS_CLASSES . 'super_order.php');		  
			  recalc_total($oID);
		  }
		  // fin des insertions -------------------------------------------------------------------------------------------------
//echo "merde";exit;		  
 		  
       return $oID;
}
// -----------------------------------------------------------------------------------------------------------------
function produire_double_from_po ( $p_old_order_id, $p_old_db, $p_new_db, $p_customer_database_code , $p_new_customers_id, $p_new_languages_id, $p_new_status )
{
   global $db;
   global $currency;
   global $ext_db_server;
   global $ext_db_username;
   global $ext_db_password;
   global $ext_db_database;
   
    // recherche du nouvel ID	
	if  (  ($p_new_db!="po") || ( $p_old_order_id < 0 ) )
	{
	    $db->connect($ext_db_server[$p_new_db], $ext_db_username[$p_new_db], $ext_db_password[$p_new_db], $ext_db_database[$p_new_db], USE_PCONNECT, false);
	    $maxQry = $db->Execute('select max(orders_id)+1 new_oid from orders') ; 
	    $oID = $maxQry->fields['new_oid']; 		  
	}
	else
	{
	    $oID = $p_old_order_id;
	}

    // recupération des informsations à lire
//echo 'podb'.$p_old_db;exit;	   	
    $db->connect($ext_db_server[$p_old_db], $ext_db_username[$p_old_db], $ext_db_password[$p_old_db], $ext_db_database[$p_old_db], USE_PCONNECT, false);
   
	// Duplicate order details from "orders" table
	$old_order = $db->Execute("SELECT * FROM " . TABLE_ORDERS. " WHERE orders_id = " . $p_old_order_id );

	  if ( $p_new_db=="po" ) 
	  {
	     $currency_value = $old_order->fields['currency_value'];
		 if ( ( $p_old_order_id < 0 ) 
		      && ( $old_order->fields['currency'] != 'EUR') )
		 {
			$db->connect($ext_db_server[$p_new_db], $ext_db_username[$p_new_db], $ext_db_password[$p_new_db], $ext_db_database[$p_new_db], USE_PCONNECT, false);		 
			$sql =  "select value from currencies where code='".$old_order->fields['currency']."'";
			$recordSet = $db->Execute($sql);
			$currency_value = $recordSet->fields['value'];
			$db->connect($ext_db_server[$p_old_db], $ext_db_username[$p_old_db], $ext_db_password[$p_old_db], $ext_db_database[$p_old_db], USE_PCONNECT, false);			
		 }
	  }
	  else if ( $old_order->fields['currency'] != 'EUR' )	 
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
   					 customers_telephone,
					 entry_country_id
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
		$customers_countries_id = $sqlCustomer->fields['entry_country_id'];

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
        $customers_countries_id = $old_order->fields['customers_countries_id'];	  

		
		  if ( $p_new_db=="po" )
		  {
			$date_purchased = $old_order->fields['date_purchased'];
		  }
		  else
		  {
			$date_purchased = "now()";
		  }
		  
       }			 
          if ( strlen ($p_customer_database_code) == 0 )
		  {
		     $p_customer_database_code = $old_order->fields['database_code'];	              
		  }
		          
		  if ( $p_new_languages_id == 0)
		  {
		     $p_new_languages_id = $old_order->fields['languages_id'];	              
		  }
		  $payment_info = $old_order->fields['payment_info'];
		  $payment_amount = $old_order->fields['payment_amount'];			  
		  $orders_date_finished = $old_order->fields['orders_date_finished'];
		  $payment_info2 = $old_order->fields['payment_info2'];
		  $payment_amount2 = $old_order->fields['payment_amount2'];			  
		  
		  $treatment_date = "now()";
		  
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
                             'date_purchased' =>$old_order->fields['date_purchased'],
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
                             'payment_info2' => $payment_info2,			
                             'payment_amount2' => $payment_amount2,										 							 
							 'orders_date_finished' => $orders_date_finished,
                             'order_tax' => $old_order->fields['order_tax'],
							 'treatment_date' => 'now()',
							 'customers_countries_id' =>$customers_countries_id);
		  
//echo $status;exit;payment_info
		  $tax = $old_order->fields['products_tax'];		  
		  
          // les produits --------------------------------------
          $products_cnt = 0;
          $old_products = $db->Execute("SELECT * FROM orders_products WHERE products_quantity>0 and orders_id = '" . $p_old_order_id . "'");
		  
		  if  ( ($p_new_db=="po")  &&  ($p_old_db!="gl") )
		  {
		     
		     $sql = "select sum(final_price) value FROM orders_products WHERE products_quantity>0  and products_model in ('ESCF','ESCC') and orders_id = '" . $p_old_order_id . "'";		     
//echo $sql.'<br>';
		     $la_reduction = exec_select ( $sql );

			 if ( $la_reduction > 0)
			 {
				$sql = "select count(products_quantity) value FROM orders_products WHERE products_model not in ('SHF','CODF','ECOF','ESCF','ESCC','FRSH','FRS') and orders_id = '" . $p_old_order_id . "'";		     
//echo $sql.'<br>';
			    $cnt_products = exec_select ( $sql);
				if ( $cnt_products > 0)
					$la_reduction = $la_reduction/$cnt_products;
				else
					$la_reduction = 0;	
					
			 }
		  }
		  		  
		  $somme_reliquat = 0;			  
		  $somme_produits = 0;
		  
          while (!$old_products->EOF) 
		  {
		    if  ( true )
			{
			   $k = $old_products->fields['products_quantity'];
			   $products_model = $old_products->fields['products_model'];
			   // 'SHF','CODF','ECOF','ESCF','FRSH','FRS'
			   if (  ( $products_model != 'SHF' ) 
			         && ( $products_model != 'CODF' ) 
			         && ( $products_model != 'ECOF' ) 
			         && ( $products_model != 'ESCF' )
			         && ( $products_model != 'ESCC' ) 					 
			         && ( $products_model != 'FRSH' ) 
			         && ( $products_model != 'FRS' ) )
				{
			            $products_cnt++;  			
// FV 
$sql = 'select count(1) value
		from rv_lampe_eu.el_product_supply 
		where po_orders_products_id='. $old_products->fields['orders_products_id'] . ' 
		and   date_format(sent_date,"%Y-%c-%d")=date_format(now(),"%Y-%c-%d")';
		
//echo $sql.'<br>';

	$products_quantity	= exec_select( $sql);

$sql = 'select count(1) value
		from rv_lampe_eu.el_product_supply 
		where po_orders_products_id='. $old_products->fields['orders_products_id'] . ' 
		and   date_format(sent_date,"%Y-%c-%d")<>date_format(now(),"%Y-%c-%d")';

	$anterieurs	= exec_select( $sql);
		
	$reliquat =  $old_products->fields['products_quantity']-$products_quantity-$anterieurs;
	$somme_reliquat += $reliquat;
	
	$somme_produits = $somme_produits + $products_quantity;
//echo $sql.'<br>';		
			    		$new_products[$products_cnt] = array('orders_id' => $oID,
			                                              'sort_order' => $old_products->fields['sort_order'],			
			                                              'products_id' => $old_products->fields['products_id'],
			                                              'products_model' => $old_products->fields['products_model'],
			                                              'products_name' => $old_products->fields['products_name'],
			                                              'final_price' => $old_products->fields['final_price']-$la_reduction,
			                                              'products_tax' => $old_products->fields['products_tax'],
			                                              'products_quantity' => $products_quantity,
			                                              'reliquat' => $reliquat,														  
			                                              'products_prid' => $old_products->fields['products_prid'] );				
														  
						$montantHT+=$products_quantity*($old_products->fields['final_price']-$la_reduction);
						
				}			        			
			}
            $old_products->MoveNext();
          }
		  // la reprise des frais sur les lignes de commande d'origine
		  
		 $sql = "select * from ".$ext_db_database[$p_customer_database_code] .".orders_products  
				where orders_id = ".  $p_old_order_id ." 
				and orders_products.products_model 
				IN (
				'SHF', 'CODF', 'ECOF', 'ESCF', 'FRSH', 'FRS','ESCC'
				)";
				
          $ord_products = $db->Execute($sql);
		  
          while (!$ord_products->EOF) 
		  {
		    if  ( true )
			{
//echo 'prd'.$ord_products->fields['products_model'].'<br>';			
			   $products_quantity = $ord_products->fields['products_quantity'];
			   $final_price = $ord_products->fields['final_price'];
			   $products_model = $ord_products->fields['products_model'];
			   // 'SHF','CODF','ECOF','ESCF','FRSH','FRS'
				$products_cnt++;
				if ( $products_model == 'ECOF' )
				{
					$products_quantity = $somme_produits;
					$final_price = 0.15;
				}
				if ( $products_model == 'SHF' )
				{
					 $sql = "select 1 value from bo_po.orders where orders_id=". $oID ." and po_status='partialydispatched'";
					 $chkDispatch = exec_select($sql);
				}
				else
				{
					 $chkDispatch = 0;
				}				
				if ( $chkDispatch == 0)
				{
					$new_products[$products_cnt] = array('orders_id' => $oID,
													  'sort_order' => $ord_products->fields['sort_order'],			
													  'products_id' => $ord_products->fields['products_id'],
													  'products_model' => $ord_products->fields['products_model'],
													  'products_name' => $ord_products->fields['products_name'],
													  'final_price' => $final_price,
													  'products_tax' => $ord_products->fields['products_tax'],
													  'products_quantity' => $products_quantity,
													  'reliquat' => 0,														  
													  'products_prid' => $ord_products->fields['products_prid'] );		

					$montantHT+=$products_quantity*$final_price;		
				}
				
			}
            $ord_products->MoveNext();
          }
		  
//exit;		  
		  /// les totaux --------------------------------------------
/*		  
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
*/		  

		$old_order_total = $db->Execute("SELECT * FROM " . TABLE_ORDERS_TOTAL . " WHERE value <> 0 and orders_id = '" . $p_old_order_id . "'");
		
		
		// -- gérer l'éventuelle absence de totaux...
		$order_total_cnt=0;
		
		// totaux -------------------------------------
//			try {		  
		  $loop = true;
		  
 //         if ( $order_total_cnt>0 )
		  if (!$old_order_total->EOF)
		  {
		  
					  $iter = 1;
			  $ot_coupon_exists = 0;
	          while (!$old_order_total->EOF) 
			  {  
			    // gestion specifique des frais de port, COD et eco-contribution --
	            if (  ( $old_order_total->fields['class']=='ot_shipping' )
	                 || ( $old_order_total->fields['class']=='ot_cod_fee' )
	                 || ( $old_order_total->fields['class']=='ot_coupon' )					 
	                 || ( $old_order_total->fields['class']=='ot_loworderfee' ) )
	            {
	                 // $p_product_type=="ot_shipping" || $p_product_type=="ot_cod_fee"
					 $new_name = strip_tags( $old_order_total->fields['title'] );
					 $new_name  = str_replace ( ":","",$new_name);
					 
					 
					 // on check sur PO si par hasard c'est pas déjà envoyés
					 $sql = "select 1 value from bo_po.orders where orders_id=". $oID ." and po_status='partialydispatched'";
					 $chkDispatch = exec_select($sql);
					 
	                 if (  ( $old_order_total->fields['class'] == 'ot_shipping' ) && ( $chkDispatch==0) )					 
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
					 else if ( $old_order_total->fields['class'] == 'ot_loworderfee'  )
					 {
					   $new_model = 'ECOF';
	    			   $new_name  = "Eco-contribution"; 
					 }
					 $new_price = $old_order_total->fields['value'];				 				 				 
					 if ( $old_order->fields['database_code'] != 'eu' )
					 {
	    			    $new_price = round ( $new_price / ( 1 + ( $tax / 100 ) ),2);
				     }	
					 if ( $old_order_total->fields['class'] == 'ot_shipping'  )
					 {
					    $sql = "SELECT count(1) cnt FROM " . TABLE_ORDERS_TOTAL . " WHERE class='ot_coupon' and orders_id =" . $oID ;
//ECHO $sql;exit;						
						$rs3 = $db->Execute($sql);
						
						$ot_coupon_exists = $rs3->fields['cnt'];
					 }
					 if ( 
					       ! (
  						      (  ( $old_order_total->fields['class'] == 'ot_coupon'  ) )
						        || 
						      (   ( ( $old_order_total->fields['class'] == 'ot_shipping'  ) && (  $ot_coupon_exists==1 )  ) )
							 )
						  )
					{
					 
						 $totalht += $new_price;
						 
						 $products_cnt++;  					  				 
						 $new_products[$products_cnt] = array('orders_id' => $oID,
			                                              'products_id' => -1,
			                                              'products_model' => $new_model,
			                                              'products_name' => $new_name,
			                                              'final_price' => $new_price,
			                                              'products_tax' => $tax,
			                                              'products_quantity' => 1,
														  'sort_order'=>$products_cnt*100,
			                                              'products_prid' => -1 );
														  
						$montantHT+=$new_price;												  
														  
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
//echo '<br>new cnt '. $order_total_cnt;				   
	               $new_order_total[$order_total_cnt] = array('orders_id' => $oID,
	                                        'title' => $new_title,
	                                        'text' => $old_order_total->fields['text'],
	                                        'value' => $old_order_total->fields['value'],
	                                        'class' => $old_order_total->fields['class'],
	                                        'sort_order' => $old_order_total->fields['sort_order']);
	            }
	            $old_order_total->MoveNext();
	          }
// Fv suite à plantage					  
				  //  if ( $old_order->fields['orders_status']==5 ) 

		}
			else
			{
				$chk = exec_select ( "select 1 value from bo_gl.orders_total where orders_id = ".$oID );
				if ($chk != 1)
				{
					$dml = "INSERT INTO bo_gl.orders_total  (
							`orders_total_id` ,
							`orders_id` ,
							`title` ,
							`text` ,
							`value` ,
							`class` ,
							`sort_order`
							)
							VALUES (
							NULL , ".$oID.", 'Total TTC:', '&euro;&nbsp;209,48', '209.4794', 'ot_total', '2'
							)";
					$db->Execute($dml);
				}
				
			}
		  // produits ---------------------------------------------------
   		 /// insertions ---------------------------------------------------------------------------------------------------------------------------
		 //echo $p_new_db;exit;
         $db->connect($ext_db_server[$p_new_db], $ext_db_username[$p_new_db], $ext_db_password[$p_new_db], $ext_db_database[$p_new_db], USE_PCONNECT, false);   		
         zen_db_perform(TABLE_ORDERS, $new_order);
		  
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
//echo count($new_order_total);  
          $order_total_cnt = count($new_order_total);
			
		  while (($loop)&&($order_total_cnt>0)) 
		  {
//echo '<br> iter '. $iter . ' iter ';		  
			 zen_db_perform(TABLE_ORDERS_TOTAL, $new_order_total[$iter]);
			 
			 
			 $iter++;
			 if ( $iter > $order_total_cnt )
				 $loop = false;
		  }		  
		  
			
//			catch (Exception $e)
//			{
//			}	
//			}
		  
		  // fin des insertions -------------------------------------------------------------------------------------------------
//$somme_reliquat
//$p_customer_database_code 		  
		  // modification du statut de la commande source pour envoyée
		  if ($somme_reliquat == 0 )		  
		  {
			 $dml = "update ".$ext_db_database[$p_customer_database_code].".orders set orders_status = 3 where orders_id = " . $oID ;
			 $db->Execute( $dml );		  
		  }
		  else
		  {
			 $dml = "update ".$ext_db_database[$p_customer_database_code].".orders set orders_status = 4 where orders_id = " . $oID ;
			 $db->Execute( $dml );		 		  
		  }
		  
		  if ( true )
		  {
			  // recalc total ne donne que des zero...
//			  require_once(DIR_WS_CLASSES . 'super_order.php');		  
//			  recalc_total($oID);
			  // &euro;&nbsp;24,15	24.1500	
			  $montantHT = round($montantHT,2);
			  $dml = "update orders_total 
					  set value=".$montantHT.",
						  text= '&euro;&nbsp;".str_replace(".",",",$montantHT)."'
					  where class='ot_subtotal'
					  and orders_id = ". $oID ;
//echo $dml;					  
			  $db->Execute($dml);
			  
		  }		  
		 // update du prix HT
/*		 
		 $dml = "update ".$ext_db_database[$p_customer_database_code].".orders_total set orders_status = 4 where orders_id = " . $oID ;
		 $db->Execute( $dml );				  
*/
       return $oID;
}
//-----------------------------------------------------------------------------------------------------------------
function get_invoice_id ( $p_order_id, $p_invoice_type, $p_force_numbering , $p_ref_orders_id=0, $p_orders_invoices_id_comment="" )
{
   global $db;
   
   $invoice_id =0;
   $sql = "select orders_invoices_id 
           from bo_gl.orders_invoices 
           where order_total <> 0 
		   and invoice_type = '". $p_invoice_type ."'
		   and orders_id = '" . $p_order_id  . "'";
		   
   $invoice_query  = $db->Execute( $sql );
   $invoice_id =  $invoice_query->fields['orders_invoices_id'];
   

   if ( ($invoice_id == 0) && ($p_force_numbering)   )
   {
       // récupération des trous
	   $sql = "select orders_invoices_id 
	           from bo_gl.orders_invoices 
	           where order_total = 0 
			   and invoice_type = '". $p_invoice_type ."'
			   order by orders_invoices_id";
			   
	   $invoice_query  = $db->Execute( $sql );
	   $invoice_id =  $invoice_query->fields['orders_invoices_id'];

       if ( $invoice_id )        
	   {	
	      $dml = "update bo_gl.orders_invoices 
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
		           from bo_gl.orders_invoices 
		           where order_total <> 0
				   and invoice_type = '". $p_invoice_type ."'
				   order by orders_invoices_id";
		   $invoice_query  = $db->Execute( $sql );
		   $invoice_id =  $invoice_query->fields['invoice_id'];
		   
		   if ( $invoice_id ) 
		   {
		       $dml = "insert into bo_gl.orders_invoices ( orders_invoices_id ,invoice_type, orders_id, order_total, invoice_date, ref_orders_id, orders_invoices_id_comment )
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
function init_stock_quantities()
{
   global $db;
   $_SESSION['init_quantities']=1;
}
function init_batch_items()
{
   global $db;
   // on va chercher le libelle  dans GL
   $sql = "select batch_name from el_batch where active=1 and batch_type='gl'";
   $rs = $db->Execute($sql);
   while(!$rs->EOF)
   {
      $batches[]=$rs->fields['batch_name'];
	  $rs->MoveNext();
   }
   $batch_items = '';
   $sql = "select item_id 
                       from el_batch_items, el_batch 
					   where el_batch.batch_id = el_batch_items.batch_id
					   and   batch_type = 'gl'
					   and   el_batch.active=1";
					   
   $bi = $db->Execute($sql);
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

function get_tickets($enforce_closed,$first_only=0)
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
        if ( $first_only )
		{
			$sql .= ' limit 0,3 ';
		}
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
// permet de récupérer les RMAS
function get_rma_ids($enforce_closed)
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
					and t.ticket_type = 'rma'
					" .  $condition .  " 
					and   t.customers_id = " . $customers_id .  "
					order by recall_date desc";

		$html_client = "<table><tr>";		 
		$recordSet = $db->Execute( $sql );
		while ( !$recordSet->EOF )
		{
		   $rma_ids[$customers_id][] = $recordSet->fields['id'];
		   $recordSet->MoveNext();
		}		
		$rc1->MoveNext();
	}		
//echo 'out'.count($rma_ids).'--zout';exit;	
	return $rma_ids;
} 
?>