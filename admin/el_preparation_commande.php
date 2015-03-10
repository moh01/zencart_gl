<?php

// to do 
//  permettre d'annuler ce qui a été choisi ou validé par erreur
//  valider les sorties de stock
//  proposer 2 options de plus en fonction de ce qu'il y a en stock 
//  gestion des partiels

  require('includes/application_top.php');
  require('el_fonctions_gestion.php');  
  require('../el_admin/el_functions.php');
  if (!isset($currencies)) {
    require(DIR_WS_CLASSES . 'currencies.php');
    $currencies = new currencies();
  }  
  
  $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  

  function gen_pdf_file($order_id)
  {
		 // création du fichier PDF sur le serveur
          $fields = array("file_type" => "Invoice.php", "invoice_mode" => "preview", "address" => "delivery",
           "force_db" => "gl","startpos" => "1","show_order_date" => "1",
		   "show_comments" => "1","status" => "0","notify" => "1",
           "notify_comments" => "1","ord_id" => $order_id,"douchette" => "1");
		
          $ch = curl_init();
          curl_setopt($ch,CURLOPT_URL, "http://linats.net/admin/el_gestion.php?form=action");
          curl_setopt($ch,CURLOPT_POST, count($fields));
          curl_setopt($ch,CURLOPT_POSTFIELDS, $fields);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          $result = curl_exec($ch);
          curl_close($ch);

  
  }
  function log_error($msg)
  {
	global $db; 
	global $to_fetch_initial;
	
	if ( $_SESSION['orders_id']>0 )
	{
		$ord_id = $_SESSION['orders_id'];
	}
	else
	{
		$ord_id = 0;		
	}
	$dml = "insert bo_po.el_dispatch_holes  ( orders_id,
			dispatch_date,
			hole_comment)
			values ( ". $ord_id  . ", now(),'"."(".$to_fetch_initial .")". addslashes($msg) ."' )	"; 
	$db->Execute($dml);		
  }
  
  function show_error($msg)
  {
    log_error($msg);  
    echo $msg;
  }
  function update_context()
  {
		global $database_code;
		global $stk_database_code;
		global $country;
		global $country_code;
		global $code_produit;
		global $payment_module_code;
		global $cnt_colis;
		
		global $db;
		global $ext_db_server;
		global $ext_db_username;
		global $ext_db_password;
		global $ext_db_database;
		
		$database_code  = exec_select ( "select database_code value from bo_po.orders where orders_id = ". $_SESSION['orders_id'] ) ;
		if (strlen($database_code)>0)
		{			
  			if ( $database_code == "bf" )
			{
				$stk_database_code = "pcp_eu";
			}
			else
			{
				$stk_database_code = "rv_lampe_eu";
			}		
// 182689			
//echo $shipping_module_code;exit;
			
			$country = strtoupper( exec_select ( "select delivery_country value from bo_po.orders where orders_id = ". $_SESSION['orders_id'] ) ) ;
// echo 	'MMMMMMMMMM'. $database_code. $ext_db_database[$database_code] .'LLLLLLLLLLLL' ;		
			$db->connect($ext_db_server[$database_code], $ext_db_username[$database_code], $ext_db_password[$database_code], $ext_db_database[$database_code], USE_PCONNECT, false);  
			$country_code = get_country_code_common ( $country );
//echo $country_code.'11<br>';
			
			if (strlen($country_code)==0)
			{
				$db->connect($ext_db_server["eu"], $ext_db_username["eu"], $ext_db_password["eu"], $ext_db_database["eu"], USE_PCONNECT, false);  
				$country_code = get_country_code_common ( $country );			
//echo $country_code.'22<br>';
				
			}
			
			$code_produit = get_code_produit ( $country_code );
			$payment_module_code = strtoupper(exec_select ( "select payment_module_code value from bo_po.orders where orders_id = ". $_SESSION['orders_id'] ) ) ;
			$db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  

			$sql = 'select count(1) value
					from '. $stk_database_code .'.el_product_supply 
					where po_orders_products_id in 
						( select orders_products_id 
						  from bo_po.orders_products 
						  where orders_id = '. $_SESSION['orders_id'] . ' )
					and   (  date_format(sent_date,"%Y-%c-%d")=date_format(now(),"%Y-%c-%d")
							or  sent_date="0000-00-00" ) ';
					
			$cnt_colis = exec_select ( $sql );
		}
  }
 
	$order_changed = 0;
  
	if ( strlen ($_SESSION['orders_id'])>0 )
	{
		update_context(); //echo '<br>'.$sql.	$cnt_colis.'<br>';	
	}    
  if ($_POST['updating']=="1")
  {	
//	$database_code  = exec_select ( "select database_code value from orders where orders_id = ". $_SESSION['orders_id'] ) ;
	
	if ( strlen($database_code)==2 )
	{
		echo '<font color=green> Num commande :'.$_SESSION['orders_id'] . '</font><br>';	
	}
	
	for ($k=1; $k<=$_POST['cntcmd'];$k++)
	{
		if ( strlen($_POST['ligne_action'.$k])>0 ) 
		{
			$code_action=$_POST['ligne_action'.$k];
		}
	}
	if ( strlen($code_action)>0 )
	{
		$params = explode('|',$code_action);
		$code_action = $params[0];
		$orders_products_id = $params[1];
		$item = $params[2];
		$product_supply_id = $params[3];
		if (is_numeric($item))
		{
			$lamp_code = '';
			$tag_id = $item;
		}
		else
		{
			$lamp_code = $item;			
			$tag_id = $item;			
		}
		
		
		if ( ($code_action=='dispatch')  )
		{			
//			$dml = "update orders_products  set po_status = 'dispatched' where orders_products_id = ". $orders_products_id;
//			$db->Execute($dml);
			
			if ( strlen($lamp_code)>0 ) 
			{
				$dml = "insert into ".$stk_database_code.".el_product_supply ( po_orders_products_id , lamp_code, status  ) values ( '".$orders_products_id."','".$lamp_code."', 'dispatched' )";
				$db->Execute($dml);				
			}
			
		}
		else if ($code_action=='cancel')
		{			
			$dml = "update orders_products  set po_status = 'stand_by' where orders_products_id = ". $orders_products_id;
			$db->Execute($dml);
			
			if ( strlen ( $product_supply_id )> 0)
			{
				$dml = "delete from ".$stk_database_code.".el_product_supply 
						where id = ". $product_supply_id ;
						
				$db->Execute($dml);			
			}
/*			
			else if ( strlen ( $lamp_code )> 0)
			{
				$dml = "delete from ".$stk_database_code.".el_product_supply 
						where po_orders_products_id = ". $orders_products_id . "
						and lamp_code =  '". $lamp_code ."'
						order by id desc
						limit 0,1";
echo $dml;exit;				
						
				$db->Execute($dml);			
			}			
*/			
		}
		else if ($code_action=='reliquat')
		{			
			$dml = "update orders_products  set po_status = 'reliquat' where orders_products_id = ". $orders_products_id;
			$db->Execute($dml);		
		}
		
	 }
//	 echo implode(",", $_POST['selected_item']);
	 // création des tags
	 // on fait un redirect vers le module d'impression
     if ( strlen($_POST['cmd_codes'])	> 0 )
	 {
	   $inputs = str_replace ('
',',',$_POST['cmd_codes']);
       $inputs_tab=explode(",",$inputs);
//echo 'inputs: '. count($inputs_tab).'<br>';	   
// vérification de l'existence d'un code de CMDE

$cnt_cmd=0;

	   for ($i=0;$i<count($inputs_tab);$i++)
	   {
		  if (strpos(' '.strtoupper($inputs_tab[$i]),'RETOURCOLIS'))
		  {
			 // FVV  
			 $dml = "update bo_po.orders set po_status = '', dispatch_date='',carrier=''  where orders_id=".$_SESSION['orders_id'];
			 $db->Execute($dml);

			 $dml = "delete from rv_lampe_eu.el_product_supply  
			        where po_orders_products_id in (select orders_products_id 
												    from bo_po.orders_products
													where orders_id=".$_SESSION['orders_id'].")";
													
			 $db->Execute($dml);
			  
		  }		  
log_error('before test'.$inputs_tab[$i]);
log_error('test result '.strpos(' '.strtoupper($inputs_tab[$i]),'00000'));
		  
//echo 'input: '. $i .':'.$inputs_tab[$i].'<br>';	   
	      if (strpos(' '.strtoupper($inputs_tab[$i]),'CMD')
		             ||strpos(' '.strtoupper($inputs_tab[$i]),'00000')
					 ||strpos(" ".strtoupper($inputs_tab[$i]), 'ALTCHX') )
		  {		  
		  
			 $temp = str_replace('CMD','',$inputs_tab[$i]);
			 $temp = str_replace('cmd','',$temp);
			 $temp = str_replace(' ','',$temp);
			 $temp = str_replace(CHR(10),'',$temp);
			 $temp = str_replace(CHR(13),'',$temp);
			 $temp = str_replace('	','',$temp);
			 
			 if ( strpos(' '.strtoupper($inputs_tab[$i]),'000006') 
			             || strpos(' '.strtoupper($inputs_tab[$i]),'000003')
			             || strpos(' '.strtoupper($inputs_tab[$i]),'000004')						 
						 || strpos(' '.strtoupper($inputs_tab[$i]),'ALAMO')
						 || strpos(' '.strtoupper($inputs_tab[$i]),'000009')						 
						 || strpos(' '.strtoupper($inputs_tab[$i]),'0000010')						 )
			 {
			 // 000001013313 
				$temp = str_replace('00000','',$temp);
				$temp = floor($temp/100);
				
//				echo 'last : ' . $temp .'....';
				
			 }			 
			 else if ( strpos(' '.strtoupper($inputs_tab[$i]),'00000') )
			 {
				$temp = str_replace('00000','',$temp);			 
				if 	 (strpos(strtoupper(' '.$temp),'15')==1 )
				{
					$temp = floor($temp/100);
				}
			    else
				{
					$temp = floor($temp/10);
				}				
//				echo 'last : ' . $temp .'....';
				
			 }
			  else if ( strpos( " " . strtoupper($inputs_tab[$i]) , 'ALTCHX'   )   )
			  {	
					$numchoix = str_replace ( 'ALTCHX',"",$inputs_tab[$i]);
//echo $_SESSION['choix_alt'];
					
					$tabs_alt = explode('|',$_SESSION['choix_alt']);										
					$tab_chx = explode(';',$tabs_alt[$numchoix]);
					
					echo ' En attente de <font color=green size=3>[CHOIX ALTERNATIF ' . $numchoix . ']  en remplacement de '. $tab_chx[2] .'</font><br>';		  
					$_SESSION['alternatif']=$tab_chx[1];
//echo 	'///////'.$_SESSION['alternatif'].'///////';				
			  }
			 
//CMD 105156				 
			 $orders_id = $temp;
			 if (is_numeric($orders_id))
			 {
				if ( $_SESSION['orders_id'] != $temp)
				{
					$order_changed = 1;
				}		

				$_SESSION['orders_id'] = $temp;
			    				
				$database_code  = exec_select ( "select database_code value from bo_po.orders where orders_id = ". $_SESSION['orders_id'] ) ;
				if ( strlen($database_code)==2 )
				{
					echo '<font color=green> Num commande :'.$_SESSION['orders_id'] . '</font><br>';
					
					if ( $database_code == "bf" )
						$stk_database_code = "pcp_eu";
					else
						$stk_database_code = "rv_lampe_eu";
												
				}
				else 
				{
					$order_changed = 0;

					echo '<font color=red> Num commande :'.$_SESSION['orders_id'] . ' non trouvé comme commande à envoyer..</font><br>';
				}

				$_SESSION['lamps_tab']='';
				$_SESSION['tags_id_tab']='';
				$_SESSION['el_tags']="";
			 }
			 else
			 {
				echo '<font color=red> Num commande :'.$_SESSION['orders_id'] . '. non reconnu </font><br>';
			 }			 
		  }
		  else 
		  {
			  $to_fetch = strtoupper($inputs_tab[$i]);
			  $to_fetch_initial = strtoupper($inputs_tab[$i]);

			 if ( strpos(' '.$to_fetch,'ALAMO') )
			 {
				$to_fetch = str_replace('ALAMO','',$to_fetch);
				$to_fetch_initial = $to_fetch;
				$alamo = 1;
//echo 	'LLLLL';exit;			
//				echo 'last : ' . $temp .'....';				
			 }			 
			  
			  if ( $to_fetch == "TRANSPORTEUR" )
			  {
			$country_code = get_country_code_common ( $country );		
//echo "_________".$country_code."----------".$country.'èèèèèèèèèè';
			$sql = "select shipping_module_code value from bo_po.orders where orders_id = ". $_SESSION['orders_id'] ;
			$shipping_module_code =  exec_select ( $sql)  ;

			$sql = "select payment_module_code value from bo_po.orders where orders_id = ". $_SESSION['orders_id'] ;
			$payment_module_code =  exec_select ( $sql)  ;

			$sql = "select payment_conditions_code value from bo_po.orders where orders_id = ". $_SESSION['orders_id'] ;
			$payment_conditions_code =  exec_select ( $sql)  ;
			
			// pour GLS on en rajoute jusqu'a 5
			$sql = "SELECT COUNT(1)  value
			FROM orders
			WHERE carrier =  'GLS'
			and database_code = 'fr'
			AND DATE_FORMAT( dispatch_date,  '%d%m%Y' ) = DATE_FORMAT( NOW( ) ,  '%d%m%Y' ) ";

			$cnt_gls = exec_select ($sql);
			
// echo 'cnt_gls '. $cnt_gls.' /cnt_gls ';
			
			$seuil_gls = 4;
			
						
			if ( $cnt_gls <= $seuil_gls ) 
			{
				$check_gls = 1;
			}
			else
			{
				$check_gls = 0;			
			}
			
//echo 'jjjj'.$shipping_module_code.'|'.$sql.'kkk'; 
				if ( $shipping_module_code == "storepickup" )
				{
					$to_fetch = "RETRAIT";
					$to_fetch_initial = "RETRAIT";				
				}
			    else if ( $database_code == "bf" )
				{
					if ( $database_code == "bf" )
					{
						if ( strtoupper($country) == 'FRANCE' )
						{
							$to_fetch = "GLS";
							$to_fetch_initial = "GLS";
						}
						else
						{
							$to_fetch = "UPS";
							$to_fetch_initial = "UPS";
						}							
					}
				}									
				// exception iles canaries
				/*
SELECT payment_conditions_code,  `customers_name` ,  `customers_company` 
FROM  `orders` 
WHERE payment_conditions_code NOT LIKE  '%mkp%'
AND  `database_code` LIKE CONVERT( _utf8 'fr'
USING latin1 ) 
COLLATE latin1_swedish_ci
AND payment_conditions_code
IN (
'30JN',  'RF'
)
ORDER BY  `orders_id` DESC 		
$payment_module_code

strpos ( string $haystack , mixed $needle )		
				*/
				else if (  ( $check_gls )
				            &&
							( $database_code == "fr" )
							&&
							( strpos ( 'mkp' , ' '. $payment_module_code ) == 0 )
							&&
							( strtoupper($country) == 'FRANCE' ) 
							&&
							( 
								( $payment_conditions_code == "30JN" ) 
								|| ( $payment_conditions_code == "RF" ) 
							)
						)
				{
// && strpos ( 'mkp' , ' '. $payment_module_code ) 			
// echo 'gls'. $payment_module_code . '|| ' . strpos ( 'mkp' , ' '. $payment_module_code ) . '/ gls';				

					$to_fetch = "GLS";
					$to_fetch_initial = "GLS";					
				}
				else if ( $country_code == "IC" )
				{
					$to_fetch = "DHL";
					$to_fetch_initial = "DHL";											
//echo "<br> 	DHL DHL  DHL DHL DHL 	<br>";			
				}
				// exception COD				
				else if ( strtoupper($payment_module_code) == 'COD' )
				{
					$to_fetch = "UPS";
					$to_fetch_initial = "UPS";						
				}
				else if ( $code_produit == 'S' )
				{
					if ( $database_code == "eu" )
					{
						$to_fetch = "DHL";
						$to_fetch_initial = "DHL";												
					}
					else
					{
						// le cas spécial RQDL DOM TOM - DHL
						$sql = "select 1 value from bo_po.orders_total where title like '%DHL%'  and orders_id = ". $_SESSION['orders_id'];
						$check_special_dhl = exec_select ($sql);
						if ($check_special_dhl)
						{
							$to_fetch = "DHL";
							$to_fetch_initial = "DHL";						
						}
						else
						{
							$to_fetch = "COLLISSIMO";
							$to_fetch_initial = "COLLISSIMO";
						}
					}
				}								
				// exception nombre de colis
//				else if  (  ( $cnt_colis > 1 ) && ( $database_code != "eu"  )  )
/* 

condition sur poids du colis à requalifier.
				else if  ( $database_code != "eu"  ) 
				{
echo 'in different de EU <br>';

					$shipping_module_code  = exec_select ( "select shipping_module_code value from bo_po.orders where orders_id = ". $_SESSION['orders_id'] ) ;
//					if ($shipping_module_code!="flat")
					if  ( ($shipping_module_code!="flat") && ( strtoupper($country) == 'FRANCE' ) )
					{
						$to_fetch = "UPS";
						$to_fetch_initial = "UPS";						
					}
					else
					{
						$to_fetch = "DHL";
						$to_fetch_initial = "DHL";						
					}					
				}					
*/				
				else if ( strtoupper($country) == 'FRANCE' )
				{
					$to_fetch = "UPS";
					$to_fetch_initial = "UPS";
				}				
				else 
				// DHL
				{
					$to_fetch = "DHL";
					$to_fetch_initial = "DHL";												
				}									
			  }
			  echo   $database_code.' '.$country.' '.$payment_module_code.' '. $cnt_colis. '->'. $to_fetch ;
			  
			  if (strpos( " ". $to_fetch,'SI' ) )
			  {
				$saisie_etiquette = 1;
			  }
			  else
			  {
				$saisie_etiquette = 0;				
			  }
			  $to_fetch = str_replace("RF " ,"" ,$to_fetch);
			  if ( $to_fetch != "COLLISSIMO" )
			  {
				$to_fetch = str_replace("SI" ,"" ,$to_fetch);
			  }

			  
			  $to_fetch = str_replace(" " ,"" ,$to_fetch);
			  $to_fetch = str_replace(CHR(10) ,"" ,$to_fetch);
			  $to_fetch = str_replace(CHR(13) ,"" ,$to_fetch);
			  

			  if ( (strlen($_SESSION['alternatif'])>0) 
			        && ( ! is_numeric($to_fetch) )
					&& ( ! $saisie_etiquette ) && ( strlen($to_fetch)>0 ) 
					&&  ! (  ( $to_fetch=='UPS' ) ||  ( $to_fetch=='DHL' ) 
					||  ( $to_fetch=='COLLISSIMO' ) ||  ( $to_fetch=='GLS' ) 
					||  ( $to_fetch=='RETRAIT' )  ) )
			  {
					$sql = " select 1 value
   				              from 	".$stk_database_code.".el_stock   
								where lamp_code='". $to_fetch."'							
								and  ctr_code not in ('EIKI','ELMO','NOBO','COMPAQ','ASK','Promethean','BOXLIGHT','ELMO')";
					$chk = exec_select ( $sql );		
					if ( $chk != 1 )
					{
						$msg =  "<font color=red size=3>Attention la référence " . $stk_database_code . " / ".$to_fetch. " n'est pas reconnue ! </font>";
						show_error($msg);
					}						
					else
					{
						$msg =  "<font color=green size=3>Référence " . $stk_database_code . " / ".$to_fetch. " reconnue </font>";
						echo $msg;
					}						
					
					$dml = "insert into ".$stk_database_code.".el_product_supply ( po_orders_products_id , lamp_code, status  ) 
							values ( '".$_SESSION['alternatif']."','".strtoupper($to_fetch)."', 'dispatched' )";						
																
						$db->Execute($dml);

				    $_SESSION['alternatif'] = "";
			  }
			  else if ( is_numeric($to_fetch) )
			  {
//echo 'to fetch'.$to_fetch.'end<br>';		  exit;
			  
				 $el_tag_id = $to_fetch;
//echo 	'el_tags'.$_SESSION['el_tags'].'<br>';			 
				 if (strpos($_SESSION['el_tags'],$el_tag_id)==0)
				 {
					 $sql = "select lamp_code, exit_date from ".$stk_database_code.".el_stock_items where id = ".$el_tag_id;
					 $rs = $db->Execute($sql);
					 
					 $exit_date = $rs->fields['exit_date'];
					 $in_stock = ( !($exit_date=='0000-00-00') );
					 if ( $exit_date=='0000-00-00')
					 {
						$in_stock = 1;
					 }
					 else
					 {
						$in_stock = 0;
					 }				 
					 $lamp_code = $rs->fields['lamp_code'];				 
					 
// FVV					 if ( (strlen($lamp_code)>0) and ( $in_stock==1) )
					 if ( (strlen($lamp_code)>0)  )
					 {
						// vérification que cela fait partie de la cmde
//echo 	'..........'.$_SESSION['alternatif'].'.............';					
                        if ($in_stock==0)
						{
							log_error('étiquette marquée comme sortie du stock');
						}
						
						if ( strlen($_SESSION['alternatif'])>0 )
						{
							$orders_products_id=$_SESSION['alternatif'];
						}
						else
						{
							$check_rv  = exec_select ( "select database_code value from bo_po.orders where orders_id = ". $_SESSION['orders_id'] ) ;
							
							$lamp_to_check = $lamp_code;
							
							if ( $check_rv <> "eu" )
							{
								$lamp_to_check = str_replace ( 'MCEL-','', $lamp_to_check );
								$lamp_to_check = str_replace ( 'OI-','', $lamp_to_check );
							}
							$sql = "select orders_products_id   
									from bo_po.orders_products 
									where  orders_id = ".$_SESSION['orders_id']." 											 
									and ( compatible_lamp_code like '%". $lamp_to_check ."'
									or  products_model like '%". $lamp_to_check ."'
									or  products_model in ( select lamp_code2 from rv_lampe_eu.el_equivalence
							                     where lamp_code1 like '%". $lamp_to_check ."' )									
									or  compatible_lamp_code in ( select lamp_code2 from rv_lampe_eu.el_equivalence
							                     where lamp_code1 like '%". $lamp_to_check ."' ) )";				
												 
//	echo '<hr>'.$sql .'<hr>';						
							$orders_products_id = $db->Execute($sql)->fields['orders_products_id'];
							
						}
						
						if ($orders_products_id>0)
						{
							$sql = "select products_model 
									from bo_po.orders_products 
									where orders_products_id = ".$orders_products_id;
									
							$modele_commande = $db->Execute($sql)->fields['products_model'];
							
							if ( (   ( strpos(" ".$modele_commande,'MCEL' )>0  ) 
								|| ( strpos(" ".$modele_commande,'OI' )>0  )
								|| ( strpos(" ".$modele_commande,'BCEL' )>0  ) )
								&& ! (   ( strpos(" ".$lamp_code,'MCEL' )>0  ) 
								|| ( strpos(" ".$lamp_code,'OI' )>0  )
								|| ( strpos(" ".$lamp_code,'BCEL' )>0  ) ) )
							{
								echo '<bgsound src="2051.mp3" loop="0">';					
								$msg='<br><br><font color=red size=4> ATTENTION SURCLASSEMENT DE LAMPE '.  $modele_commande . '  COMMANDE.. </font><br>';																		
								show_error($msg);								
							}
							
							echo '<font color=green> '.  $lamp_code . '  reconnu.. </font><br>';										
							
							$_SESSION['lamps_tab'][]=$lamp_code;
							$_SESSION['tags_id_tab'][]=$el_tag_id;
							
							$dml = "insert into ".$stk_database_code.".el_product_supply
	(stock_item_id,  po_orders_products_id , status )
	values
	(". $to_fetch.",  ". $orders_products_id ." , 'dispatched') ";
							$db->Execute($dml);
							
							$check_lamp_tab[]=0;					
							$_SESSION['el_tags'] = $_SESSION['el_tags']. ','. $to_fetch_initial;						
						}
						else
						{
							$msg = '<br><br><font color="red"> Le produit : ' . $lamp_code . ' est reconnu mais ne fait pas partie des produits de cette commande . </font> <br>';
							show_error($msg);
						}
					 }
					 else if ( $in_stock==0 )
					 {
						// FVV ce cas de devrait plus se produire
						if ( strlen ($lamp_code)>0 )
						{
							$msg = '<br><br><font color=orange> '.  $lamp_code . '  reconnue  mais marquée comme sortie du stock </font><br>';										
							show_error($msg);							
						}
						else
 					    {
						
							if ($to_fetch_initial=="RF 234 SI")
							{
								echo '<bgsound src="bip.mp3" loop="0">';												
								$msg = '<br><br><font color=red>Veuillez Sélectionner le code bare du haut...</font><br>';										
							}
							else
							{
								$msg = '<br><br><font color=red> Etiquette '.  $to_fetch_initial . ' ligne non reconnue  </font><br>';										
							}
							show_error($msg);														
						}				 
					 }
					 else 
					 {
							$msg ='<font color=red> '.  $to_fetch_initial . ' ligne non reconnue  </font><br>';			
							show_error($msg);																					
					 }				 
				  }
				  if (strlen($_SESSION['alternatif'])>0)
				  {
					 $_SESSION['alternatif']="";
				  }
			  }
			  else if (  ( $to_fetch=='UPS' ) ||  ( $to_fetch=='DHL' )
					   ||  ( $to_fetch=='GLS' )  ||  ( $to_fetch=='COLLISSIMO' ) 
					   ||  ( $to_fetch=='RETRAIT' ) )
			  {
				 echo '<font color=green> Transporteur : <b>'.  $to_fetch_initial . '  reconnu </b></font><br>';
				 $carrier = $to_fetch;
			  }			  
			  else
			  {
				 echo '<font color=orange> '.  $to_fetch_initial . '/'.  $to_fetch . ' non reconnu </font><br>';
			  }
		  } // fin de la reconnaissance des lignes
		  // vérification de présence d'items sur la CMDE
	   }
//echo 'bug';exit;	
/*	  		  	   
      if ( strlen($_SESSION['orders_id'])>0 )
	  {
		  $sql = "select sum(products_quantity) cntr from orders_products where orders_id = ". $_SESSION['orders_id'] ;
		  
//echo '<br>'.$sql.'<br>';		  
		  
		  $rs = $db->Execute($sql);			  
		  $cnt_cmd = $rs->fields['cntr'];		  
	  }
*/
	}	
  }
  
  if (strlen( $_SESSION['orders_id'] )>0)
  {
	update_context();
	
	$sql = "select po_status,dispatch_date,carrier  from bo_po.orders where orders_id = ".   $_SESSION['orders_id'];
	$rs = $db->Execute($sql);
	$ord_status = $rs->fields['po_status'];
	$dispatch_date = $rs->fields['dispatch_date'];
	
    if ($ord_status=="")
	   $ord_status="Stand by";
	   
//echo 	$ord_status;exit;
    if ($dispatch_date<>'0000-00-00')
	  $cmt_carrier =	' ; expédiée le '. $dispatch_date . ' par '. $rs->fields['carrier'];
	

	echo '<h1> Commande en cours '. $_SESSION['orders_id'] . ' Status : '. $ord_status . $cmt_carrier .' /  BD : '. $database_code .'</h1>';
	$sql = "select comments from orders_status_history where orders_id=".$_SESSION['orders_id']." and comments not like '%#%' and comments not like '%paypal%'";
	
	$rsc = $db->Execute($sql);
	while(!$rsc->EOF)
	{
		$cmm .= $rsc->fields['comments'].'<br>';		
		$rsc->MoveNext();
	}
	if (strlen($cmm)>3)
	{
		if (strpos(" ".$cmm,'@')>0)
		{
		  if ($order_changed)
			echo '<bgsound src="2051.mp3" loop="0">';					
			
		  $color = "red";
		}
		else
		{
		  if ($order_changed)			
			echo '<bgsound src="2044.mp3" loop="0">';					  
			
		  $color = "orange";		  
		}		
		echo "<font size=3 color=".$color.">".$cmm."</font>";
	}
// commande Jersey 163423
// echo '||'.$country_code;exit;
	if ( ($code_produit=="S") || ( $country_code == "JE" )  )
	{
		echo '<font color=red size=3> Vente Export :  '. $country .' </font>';
//echo 	$code_produit;exit;	
	}
//echo $sql;	
  }

 
//   vérification de l'existence de la commande dans po
//   if ( strlen ( $_SESSION['orders_id'])> 0 )
//   $new_order=clonage_order ( $add_order_tab[$i], $po_database_code, "po", $po_database_code , 0, $languages_id, $check_status );
 
    	echo '
		<html>
		<head>';
		
		if ($order_changed)
		{
		  echo '<bgsound src="tennis.mp3" loop="0">';
		} 
		
		echo '
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Gestion des étiquettes stock</title>
		<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script>
function keyup(ev)
{
	if (ev.keyCode==119) //F8
	{
		clic1();
	}
	if (ev.keyCode==120) //F9
	{
		clic2();
	}
	if (ev.keyCode==121) //F10
	{
		clic3();
	}
 
}
 
 
function clic1()
{
	this.document.frm.cmd_codes.value=\'ALTCHX1\';
	this.document.frm.submit();	
}
 
function clic2()
{
	alert("Clic n°2");
}';

if ($cnt_colis>0)
{
echo '
function clic3()
{
this.document.frm.cmd_codes.value=\'TRANSPORTEUR\';
this.document.frm.submit();	
}';
}
	
echo '</script>
		
		</head>
		<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } "  onload="this.document.frm.cmd_codes.focus();"  onkeyup="keyup(event)">';
		
		echo '<hr>
		<form name="frm" method="post">
		<input type="hidden" name="updating" value=1>';		

		
		// faudait envisager d'enregistrer la ligne de cmde attachée à la référence de la boite
		
		if ( $_SESSION['orders_id']>0 )
		{
echo '<br><br><br><br>';						
			echo '<table>
					<tr><th> Num ligne  </th><th> [Etiquette / Produit]  </th><th> Code produit</th><th> Libellé produit</th><th> Action</th></tr>';
					
			$rs = $db->Execute('select orders_products_id,  products_quantity, products_name, products_model, po_status  
								from orders_products 
								where orders_id = '. $_SESSION['orders_id'] .' 
								order by orders_products_id');
								
			$display_choice = array(); 
			$cnt_choice=0;
								
		    while ( ! $rs->EOF )
			{
			
				$products_quantity = $rs->fields['products_quantity'];
				$products_name = $rs->fields['products_name'];
				$products_model = $rs->fields['products_model'];
				$po_status = $rs->fields['po_status'];
				$po_orders_products_id = $rs->fields['orders_products_id'];				

//echo 'merde'.strpos(" ".$products_name,'Pack ');exit;				
				
				if  (   strpos(" ".$products_name,'Pack ' )>0  ) 
				{
					echo '<bgsound src="siren.mp3" loop="0">';					
				}

				
				$sql2 = "select stock_item_id, lamp_code, sent_date, id 
						from  ".$stk_database_code.".el_product_supply 
						where  po_orders_products_id =  ".$po_orders_products_id . " order by id ";
// echo $sql2.'<br>';
//						where status = 'dispatched' 
//						and po_orders_products_id =  ".$po_orders_products_id;
						
//echo $sql2;exit;						
				$rs2 = $db->Execute($sql2);
				
				$first_to_send = 1;				
				
				for ( $k=0 ; $k < $products_quantity ; $k++ )
				{
					$cnt_cmd++;
				
					echo '<tr><td colspan=100><hr></td></tr>';
				
					if ( ! $rs2->EOF )
					{
						$stock_item_id  = $rs2->fields['stock_item_id'];
						$supply_lamp_code  = $rs2->fields['lamp_code'];						
				        $sent_date = $rs2->fields['sent_date'];		
						$product_supply_id = $rs2->fields['id'];
						
						$product_to_send = 1;
						$choice_proposal = 0;
						
						$rs2->MoveNext();												
					}
					else
					{
						if ( $first_to_send == 1)
						{
							$cnt_choice++;
							
							$display_choice[$cnt_choice]="[CHOIX ALTERNATIF".$cnt_choice."]";
							$choix_alt.='|'.$cnt_choice.";".$po_orders_products_id.';'.$products_model;
							
							$first_to_send = 0;				
							$choice_proposal = 1;
						}
						else
						{
							$choice_proposal = 0;
						}
					
						$stock_item_id='';
						$supply_lamp_code='';
						$product_supply_id = 0;
						$product_to_send = 0;
						
					}					
					
					
					// affichage de la ligne
//echo '||||||||'.$po_status.'.....';					
//					if  ( ( $stock_item_id > 0 ) || ( $po_status == "dispatched" )  )
					if  ( $product_to_send   )
					{
						$bgcolor="#dfdcda";
					}
					else if ( $po_status == "reliquat" )
					{
						$bgcolor="#fae8d9";
					}
					else
					{
						$bgcolor="";
					}					
					
					
					echo '<tr bgcolor='.$bgcolor.'>';
					echo '<td>'. ($k+1) . ' / '. $products_quantity . '</td>
						  ';
						  
					echo '<td align=center>';
					if  (  $stock_item_id > 0 )
					{
						echo  $stock_item_id;
					}
					else if ( strlen( $supply_lamp_code )>0 )
					{
						echo $supply_lamp_code;
					}
/*					
					else if ( ( $stock_item_id > 0 ) || ( $po_status == "dispatched" )  )
					{
						echo '<font color=red> Ne pas oublier de sortir du stock <br> manuellement cette référence: '. $products_model. '</font>';
					}
*/					
					else if ( $po_status == "reliquat" )
					{
						echo '[reliquat]';
					}
					else if ($choice_proposal)
					{
						echo "<font color=orange>".$display_choice[$cnt_choice]."</font>&nbsp;&nbsp;&nbsp;";
					}
					else
					{
						echo "&nbsp;";
					}					
					echo '</td>';
					
						  
					echo '<td>
						  '. $products_model . '</td>';

					echo '<td>
						  '. $products_name . '</td>';
						  
					// a gérer : le cas ou 
//					if  ( ( $stock_item_id > 0 ) || ( $po_status == "dispatched" ) || ( $po_status == "reliquat" )  )
					if  ( $product_to_send  || ( $po_status == "reliquat" )  )
					{
						if  (  ( $sent_date != '0000-00-00' ) && ( $po_status != "reliquat" ) )
						{
							echo '<td> Envoyé le '.$sent_date.'</td>';
							$cnt_check++;
							$cnt_deja_envoye++;
						}					
						else if ( ( $sent_date =='0000-00-00' )  || ( $po_status == "reliquat" ) )
						{
							echo '<td><select name="ligne_action'.$cnt_cmd.'" onchange="submit()">
								  <option value="">-</option>
								  <option value="cancel|'.$po_orders_products_id.'|'.$stock_item_id.'|'.$product_supply_id.'">Annuler</option>							  
								  </select></td>';							  
							$cnt_check++;							
						}
						
//echo $cnt_cmd;						
					}
					else
					{
						// vérifier présence dans le stock
						if ($stk_database_code=='rv_lampe_eu')
						{
							$sql3 = 'select sum(qty) stk, lamp_code 
							from '.$stk_database_code.'.el_stock  
							where lamp_code like "%'.ltrim(rtrim($products_model)) .'" 
							or    lamp_code in ( select lamp_code1 from rv_lampe_eu.el_equivalence
							                     where lamp_code2 like "%'.ltrim(rtrim($products_model)) .'" )
							group by lamp_code
							order by sum(qty) desc';
//echo $sql3;exit;							
						}
						else
						{
							$sql3 = "select sum(qty) stk, el_stock.lamp_code,  el_products_techdata.value bnd_code
									from pcp_eu.el_stock 
									left outer join pcp_eu.el_products_techdata 
									on el_products_techdata.datatype_code = 'code'
									and  el_products_techdata.lamp_code=el_stock.lamp_code
									where el_stock.lamp_code like '".ltrim(rtrim($products_model)) ."'
									and length(el_stock.lamp_code)>0
									group by el_stock.lamp_code
									order by el_products_techdata.value, el_stock.lamp_code";
						}
						$sup = "";
						$rs3 = $db->Execute($sql3);
						while (!$rs3->EOF)
						{
							$lamp_code = $rs3->fields['lamp_code'];
							$stk = $rs3->fields['stk'];
							if ( (strlen($rs3->fields['bnd_code'])>0) && (($rs3->fields['bnd_code'])!="NULL") )						
								$sup .= '<option value="dispatch|'.$po_orders_products_id.'|'.$lamp_code.'">Inclure dans dispatch avec '. $rs3->fields['bnd_code'].'       '. $rs3->fields['lamp_code'] .' ( '. $stk .' ) </option>';
							else
								$sup .= '<option value="dispatch|'.$po_orders_products_id.'|'.$lamp_code.'">Inclure dans dispatch avec '. $lamp_code .' ( '. $stk .' ) </option>';

							$rs3->MoveNext();
						}
						// vérifier présence dans le stock
						if ($stk_database_code=='rv_lampe_eu')
						{												
							$sql3 = 'select sum(qty) stk, lamp_code 
							from '.$stk_database_code.'.el_external_stock  
							where lamp_code like "%'.$products_model .'" 
							group by lamp_code';
							
	//echo $sql3.'<br>';

							$rs3 = $db->Execute($sql3);
							while (!$rs3->EOF)
							{
								$lamp_code = $rs3->fields['lamp_code'];
								$stk = $rs3->fields['stk'];
								$sup .= '<option value="dispatch|'.$po_orders_products_id.'|CS_'.$lamp_code.'">Inclure dans dispatch avec CS '. $lamp_code .' ( '. $stk .' ) </option>';

								$rs3->MoveNext();
							}
						}	
						if ( ($products_model=="SP400" ) || ( $products_model=="DUSTGO" ) )
						{
								$sup .= '<option value="dispatch|'.$po_orders_products_id.'|'.$products_model.'">'.$products_model.'</option>';	
								
						}
						
						
						echo '<td><select name="ligne_action'.$cnt_cmd.'" onchange="submit()">
							  <option value="">-</option>	
							  '. $sup . '
							  <option value="reliquat|'.$po_orders_products_id.'">Reliquat</option>							  
							  </select></td>';							  
// 							  <option value="dispatch|'.$po_orders_products_id.'">Inclure dans dispatch sur une autre référence</option>							  							  
							  
					}
						  
				}
				
				$rs->MoveNext();
			}
			echo '</table>';			
		}
		
		$_SESSION['choix_alt']=$choix_alt;
		
		echo '<input type="hidden" name="cntcmd" value="'.$cnt_cmd.'">';
		echo '<hr>';
		echo '<br>';
		echo '<br>';
		
		  if ( ($cnt_cmd==0) && ($ord_status!='dispatch')&&($ord_status!='partialdispatch')  )
		  {
				echo '<font color=green>Pas de commandes en cours... </font><br>';
		  }			  		  
		  else if ( ($cnt_check<$cnt_cmd) && ($ord_status!='dispatch')&&($ord_status!='partialdispatch') )
		  {
				echo '<font color=red> Le nombre de références pointées : '. $cnt_check .' est inférieur au nombre de références de la commande :'. $cnt_cmd  .'... </font><br>';
		  }			  
		  else if ( ($cnt_check>$cnt_cmd)  && ($ord_status!='dispatch')&&($ord_status!='partialdispatch')  )
		  {
				echo '<font color=red> Le nombre de références pointées  : '. $cnt_check .' est supérieur au nombre de références de la commande '. $cnt_cmd  .'... </font><br>';					
		  }
		  else
		  {
			   if ( ($ord_status!='dispatch')&&($ord_status!='partialdispatch') )
			   {
					echo '<font color=green> Le nombre de références pointées : '. $cnt_cmd  .' est égal au nombre de références de la commande
<br> Choix du transporteur..</font><br>';					
			   }
			  // 
			  require_once('el_fonctions_gestion.php');
//echo '.....'.$to_fetch.';;;;;;';exit;			  
			  if ( ( strtoupper($to_fetch) == "UPS" ) 
					|| ( strtoupper($to_fetch) == "DHL" )
					|| ( strtoupper($to_fetch) == "COLLISSIMO" )
					|| ( strtoupper($to_fetch) == "GLS" )					
					|| ( strtoupper($to_fetch) == "RETRAIT" )					)
			  {
			  
				$sql = "select id,stock_item_id, lamp_code 
				from  ".$stk_database_code.".el_product_supply 
				where sent_date = '0000-00-00'
                and  	po_orders_products_id  
				in ( select orders_products_id 
				     from bo_po.orders_products 
					 where orders_id  =  ". $_SESSION['orders_id'] . " ) ";
				
				
				$rs4 = $db->Execute($sql);
				$cntdispatch = 0;
				while (!$rs4->EOF)
				{
					$cntdispatch++;
					$id = $rs4->fields['id'];
					
					$stock_item_id = $rs4->fields['stock_item_id'];
					$lamp_code = $rs4->fields['lamp_code'];
//echo  $stock_item_id . ' '.	$lamp_code.'<br>'.$sql;	exit;			
					if ( $stock_item_id >0 )
					{
						stock_output($stock_item_id, 1, 1, 1 );						
					}
					else if ( strlen( $lamp_code)>0 )
					{
						if (strpos(' '.$lamp_code,'CS_' )>0)
						{
							$lamp_code = str_replace ( 'CS_','', $lamp_code );
							$tname = "el_external_stock";
						}
						else
						{
							$tname = "el_stock";							
						}
						
						$dml = "update ".$stk_database_code.".". $tname ." set qty=qty-1  
								where lamp_code='". $lamp_code."'
								and  ctr_code not in ('EIKI','ELMO','NOBO','COMPAQ','ASK','Promethean','BOXLIGHT','ELMO')";
//echo $dml.'<br>';								
						$db->Execute($dml);
						
						$sql = " select qty, ctr_code
								from ".$stk_database_code.".el_stock
								where lamp_code='". $lamp_code."'
								and  ctr_code not in ('EIKI','ELMO','NOBO','COMPAQ','ASK','Promethean','BOXLIGHT','ELMO')";							
//echo $sql;
								
						$rs5 = $db->Execute($sql);
						if ( $rs5->EOF )
						{
							$msg =  '<font color=red> Pas de stock modifié pour ' .  $lamp_code .' </font><br>';																			
						    show_error($msg);
						}
						else
						{
							$qty = $rs5->fields['qty'];
							$ctr_code = $rs5->fields['ctr_code'];
							echo '<font color=green> Stock modifié à ' . $qty . ' pour '. $ctr_code .' '. $lamp_code .' </font><br>';													
						}

						
					}
					
					$dml = "update  ".$stk_database_code.".el_product_supply set sent_date = now() where id = ".$id;
					$db->execute($dml);
					
					$rs4->MoveNext();
				}
				// production du BL
				$sql = "select count(1) cnt from bo_po.orders_products where orders_id = ".$_SESSION['orders_id'] ."  and po_status = 'reliquat' ";
				$rsc = $db->Execute($sql);
// echo '<br>'. $sql . '<br>';
//echo 'cnt_deja_envoye'.$cnt_deja_envoye.'<br>';
				if ($cnt_deja_envoye>0)
				{
//echo 'force_production bl <br>';				
					$check_production_bl = 1;								
				}
				else
				{
// echo 	$sql .'|'. $rsc->fields['cnt'] .']]';
					$check_production_bl = $rsc->fields['cnt'];				
				}
//echo 'check_production_bl '. $check_production_bl .'  <br>';

				
				if ( 
					(  ($database_code=="eu") 
				       ||  ($database_code=="tb")  
					   ||  ($check_production_bl>0) ) 
					   && ( strtoupper($payment_module_code) != 'COD' ) 
					   )
				{
				$sql = 'select count(1) value
						from rv_lampe_eu.el_product_supply 
						where po_orders_products_id in 
						    ( select orders_products_id 
							  from bo_po.orders_products 
							  where orders_id = '. $_SESSION['orders_id'] . ' )
						and   date_format(sent_date,"%Y-%c-%d")=date_format(now(),"%Y-%c-%d")';
				
				$cnt_today = exec_select ( $sql );
				
				if ( $cnt_today > 0 )
				{
					$customers_id = exec_select ( "select customers_id value from bo_po.orders where orders_id = " . $_SESSION['orders_id'] );
/*					
					$dml = 'delete from bo_gl.orders 
					where customers_id = '. $customers_id .' 
					and date_format(date_purchased,"%Y-%c-%d")=date_format(now(),"%Y-%c-%d") 
					and orders_status=5';
					
					$db->Execute($dml);
*/
					$db->connect($ext_db_server["gl"], $ext_db_username["gl"], $ext_db_password["gl"], $ext_db_database["gl"], USE_PCONNECT, false);  
					
					$sql = 'select orders_id value 
						from bo_gl.orders 
						where customers_id = '. $customers_id .' 
						and date_format(last_modified,"%Y-%c-%d")=date_format(now(),"%Y-%c-%d") 
						and orders_status=5';
						
					$to_del = exec_select ( $sql );
					
					if (  $to_del > 0 )
					{
						//  delete_order ( $to_del );
					}
//echo '<br><font color=red> Production de BL </font><br>';					
					$bl_order_id =  produire_double_from_po ( $_SESSION['orders_id'], 'po', "gl", $database_code ,0, 0, 5 );					
					$bl_id = get_invoice_id ( $bl_order_id, "BL", 1 );
						
					echo 'BL : '.$bl_order_id;
					$db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  
					
					
				  }
					
				}	
//echo  'cntdispatch'.$cntdispatch.'<br>';
				if  (  ($cnt_colis==0) && (!$alamo) &&  strlen($carrier)>0 )
				{
					echo "<font color=red size=3> Attention vous devez saisir le mot de passe pour forcer l'impression d'étiquette... </font>";
					$rejet_envoi = 1;
				}
				else if  ( ($cntdispatch>=1) && strlen($carrier)>0) 				// update en partiel ou total la cmde
				{
					$sql = "select count(1) cnt from bo_po.orders_products where orders_id = ".$_SESSION['orders_id'] ."  and po_status = 'reliquat' ";
					$rsc = $db->Execute($sql);
					
					$check = $rsc->fields['cnt'];
					
					if ( $check > 0 )
						$po_status = 'partialydispatched';
					else
						$po_status = 'dispatched';
						
					$dml="update bo_po.orders set carrier='".$carrier."' , po_status='".$po_status."' , dispatch_date=now() where orders_id = ".$_SESSION['orders_id'];
					$db->Execute($dml);
					
					if ( $carrier == "RETRAIT" ) 
					{
						 require('_obj_email.php');
						 $spam = new EMAIL;		  
						 $spam->set_email_language(2);  		   		   
					
						 $obj = "Votre commande de lampe ". $_SESSION['orders_id']." est prête à être récupérée .";
						 
						 $txt = "Bonjour, <br><br>
 Nous vous prions de vous rendre au 33 rue de la révolution à Montreuil pour récupérer votre matériel.<br><br>
 Le retrait de votre lampe de vidéoprojecteur peut se faire pendant les jours ouvrés entre 9h30 et 13h00 et entre 14h00 et 18 heures.<br><br>
 Bien cordialement.<br><br> ";
						 $spam->set_sender_name("Information ",2);
						 $spam->set_sender_email_address( "noanwer@linats.net" );
							 
						 $spam->set_email_title($obj,2);
						 $spam->set_email_content($txt,2);

						 $receiver_email_address =  exec_select ( "select customers_email_address value from bo_po.orders where orders_id = ". $_SESSION['orders_id'] )  ;
//echo "receiver_email_addressreceiver_email_addressreceiver_email_address".$receiver_email_address;exit;

						 $spam->set_receiver_email_address( $receiver_email_address );		

						 $spam->send_email();						 
//echo 'post sent email'.$receiver_email_address.$txt;exit;						 
					
					}
					
					$comment = 'Products prepared to be sent by '. $carrier.'; order status set to '.$po_status;

					if ($bl_id>0)
					{
						$comment .= ', picking list '. $bl_id;
					}
					$dml = "insert into  ".$ext_db_database[$database_code].".orders_status_history
							( orders_id,  comments, orders_status_id, date_added ) 
						values (  " . $_SESSION['orders_id'] . ",'". $comment ."',2, now() )";
					
					$db->Execute($dml);
					
					/*
					$dml = "update ".$ext_db_database[$database_code].".orders set orders_status = 3 where orders_id = " . $_SESSION['orders_id'] ;
					$db->Execute( $dml );		
					*/

					$dml="update bo_po.orders_products 
						  set po_status='stand_by' 
						  where po_status='reliquat' 
						  and   orders_id = ".$_SESSION['orders_id'];
//echo $dml;exit;					  
					$db->Execute($dml);

					$dml="update bo_po.orders_products 
						  set po_status='dispatched' 
						  where po_status!='reliquat' 
						  and   orders_id = ".$_SESSION['orders_id'];
						  
					$db->Execute($dml);
					
					// MAJ de la cmde source et envoi d'un mail
					
	/*				
					for ($i=0;$i<count($_SESSION['tags_id_tab']);$i++)
					{
						stock_output ( $_SESSION['tags_id_tab'][$i], 1 );
					}
	*/				
					// FVV
					// $sql = "select qty from orders_products where orders_id=". $_SESSION['orders_id']. " and  ctr_code not in ('EIKI','ELMO','NOBO','COMPAQ','ASK','Promethean','BOXLIGHT','ELMO') ";
									
					
					// ici imputer les sorties de stock  sans étiquettes
					
					
					// valider la commande 
				 }	
//				  $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  
                  $_SESSION['source_db']='po';
				  if ( ( strtoupper($to_fetch_initial) == "UPS" ) && ( ! $rejet_envoi ) )
					{
						$orders_id = $_SESSION['orders_id'];
						if ( $_SERVER['SERVER_NAME']=="127.0.0.1" )
						{
							$url = 'http://127.0.0.1/sites/zencart_gl/admin/el_one_tag.php?ord_id='.$orders_id;
						}
						else
						{
							$url = 'http://linats.net/admin/el_one_tag.php?ord_id='.$orders_id;
						}					
					
						echo '<iframe cols=30 rows=30 src="'.$url.'"> </iframe>';
					}
					else if (( strtoupper($to_fetch_initial) == "DHL" )&& ( ! $rejet_envoi ) )
					{
						$orders_id = $_SESSION['orders_id'];
						if ( $_SERVER['SERVER_NAME']=="127.0.0.1" )
						{
							$url = 'http://127.0.0.1/sites/zencart_gl/admin/el_one_tag_dhl.php?ord_id='.$orders_id;
						}
						else
						{
							$url = 'http://linats.net/admin/el_one_tag_dhl.php?ord_id='.$orders_id;
						}					
						echo '<iframe cols=30 rows=30 src="'.$url.'"></iframe> ';
					}				
					else if ( ( strtoupper($to_fetch_initial) == "COLLISSIMO" ) && ( ! $rejet_envoi ) )
					{
						$orders_id = $_SESSION['orders_id'];
						if ( $_SERVER['SERVER_NAME']=="127.0.0.1" )
						{
							$url = 'http://127.0.0.1/sites/zencart_gl/admin/el_one_tag_collissimo.php?ord_id='.$orders_id;
						}
						else
						{
							$url = 'http://linats.net/admin/el_one_tag_collissimo.php?ord_id='.$orders_id;
						}					
						echo '<iframe cols=30 rows=30 src="'.$url.'"></iframe> ';
					}								
					else if ( ( strtoupper($to_fetch_initial) == "GLS" ) && ( ! $rejet_envoi ) )
					{
						$orders_id = $_SESSION['orders_id'];
						if ( $_SERVER['SERVER_NAME']=="127.0.0.1" )
						{
							$url = 'http://127.0.0.1/sites/zencart_gl/admin/el_one_tag_gls.php?ord_id='.$orders_id;
						}
						else
						{
							$url = 'http://linats.net/admin/el_one_tag_gls.php?ord_id='.$orders_id;
						}					
						echo '<iframe cols=30 rows=30 src="'.$url.'"></iframe> ';
					}													
					else if ( ( strtoupper($to_fetch_initial) == "RETRAIT" )&& ( ! $rejet_envoi ) )
					{
						echo '<h1> placer le colis et l\'impression de la CMDE sur l\'étagère des retraits </h1>';
					}
			  }				
		  }		
		
		
		echo '<table>';
		
		echo '<br>';
		echo '<br>';
		
		if (true)
		{
//		  echo '<tr><td>Codes commandes  <b> et codes lampes </b></td></tr>';
//		  echo '<tr><td><textarea rows=10 cols=13 name=cmd_codes>'. $_POST['input_codes'] . '</textarea></td></tr>';
		  echo '<tr>
		            <td>Saisie  <b>CMD [numéro commande]</b> ou <b>[numéro de pièce en stock]</b> ou <b>[TRANSPORTEUR/UPS/DHL/COLLISSIMO/GLS] - RETRAIT</b></td>
				</tr>
				<tr>
		            <td><input type="text" name=cmd_codes value='. $_POST['input_codes'] . '></td>
				</tr>';
	    }		
		echo '</table>';		
		echo '<hr>';

		echo '<input type="submit" value="Valider">';
/*
		  if ( ( strtoupper($to_fetch) == "UPS" ) 
				|| ( strtoupper($to_fetch) == "DHL" )
				|| ( strtoupper($to_fetch) == "COLLISSIMO" ) 
				|| ( strtoupper($to_fetch) == "RETRAIT" )				
				)
		  {
			$_SESSION['orders_id']="";  
		  }
*/		
?>
<!-- body_eof //-->
<br />
</form>
<?php
	if ( ($code_produit=="S") || ( $country_code == "JE" )  )
	{
		echo '<a href="rtf/ezl_rtf_invoice.php?numCommandes='.$_SESSION['orders_id'].'&lg_code=2&source_db=po" target=_new> 
		       <font size=3>Facture A Imprimer </font>
			   </a> <br><br>';
	}
	
	if  ( ( strtoupper($payment_module_code) == 'COD' ) && ( $cnt_check > 0 ) && ($cnt_check==$cnt_cmd) )	
	{
		$sql = 'select count(1) value
				from rv_lampe_eu.el_product_supply 
				where po_orders_products_id in 
					( select orders_products_id 
					  from bo_po.orders_products 
					  where orders_id = '. $_SESSION['orders_id'] . ' )
				and   date_format(sent_date,"%Y-%c-%d")=date_format(now(),"%Y-%c-%d")';
		
		$cnt_today = exec_select ( $sql );
		
	
		$customers_id = exec_select ( "select customers_id value from bo_po.orders where orders_id = " . $_SESSION['orders_id'] );

		// création de la facture à la volée ...
		$sql = 'select 1 value 
		from bo_gl.orders
		where customers_id =  '.$customers_id . '
		and   date_format(last_modified,"%Y-%c-%d")=date_format(now(),"%Y-%c-%d")
		order by last_modified desc
		limit 0,3 ';
		
		$chkdb = exec_select ($sql);
		
		if  ( (! ($chkdb==1) ) && ( $cnt_today>0 ) )
		{
			$orders_invoices_id =  produire_double_from_po ( $_SESSION['orders_id'], 'po' , "gl", $database_code ,0, 0, 2 );	
// function produire_double_from_po ( $p_old_order_id, $p_old_db, $p_new_db, $p_customer_database_code , $p_new_customers_id, $p_new_languages_id, $p_new_status )
			
			$bl_id = get_invoice_id ( $orders_invoices_id, "DB", 1 );			
echo 'cree '.  $bl_id  .'<br>' ;// 131350;
			
			
			 $dml = "update ".$ext_db_database[$database_code].".orders set orders_status = 3 where orders_id = " . $_SESSION['orders_id'] ;
			 $db->Execute( $dml );		  				
			 
			 $dml = "delete from ".$ext_db_database[$database_code].".orders_invoices where invoice_type = 'DB' and orders_invoices_id = ". $bl_id;
			 $db->Execute($dml);
			  
			 $dml = "insert into ".$ext_db_database[$database_code].".orders_invoices ( orders_invoices_id ,invoice_type, orders_id, order_total, invoice_date, ref_orders_id )
					   values ( ". $bl_id .",'DB',". $orders_invoices_id . ", 1, now() , " .  $_SESSION['orders_id'] . " )";
//echo '<br>'. $dml.'<br>';					   
					   
			 $db->Execute($dml);
			 			 
			 
		}
		
		$sql = 'select orders_id , last_modified 
		from bo_gl.orders 
		where customers_id =  '.$customers_id . '
		and   date_format(last_modified,"%Y-%c-%d")=date_format(now(),"%Y-%c-%d")
		order by last_modified desc
		limit 0,3 ';
		
		$rs = $db->Execute($sql);
		while (!$rs->EOF)
		{
			$invoice_id = $rs->fields['orders_id'];
			
echo '
<form name="pdfoc_action" action="el_gestion.php?form=action" method="post" target=_new>
<input type="submit" name="submit_action" value="Apercu de la Facture du '. $rs->fields['last_modified'] .'"></td>
<input type="hidden" name="file_type" value="Invoice.php">
<input type="hidden" name="invoice_mode" value="preview">
<input type="hidden"  name="address" value="delivery">
<input type="hidden"  name="startpos" value="1">
<input type="hidden" name="show_order_date"  value="1">
<input type="hidden" name="show_comments" value="1">
<input type="hidden" name="show_phone" value="">
<input type="hidden" name="show_email" value="">
<input type="hidden" name="show_pay_method" value="">
<input type="hidden" name="show_cc" value="">
<input type="hidden" name="status" value="0">
<input type="hidden" name="notify" value="1">
<input type="hidden" name="force_db" value="gl">			
<input type="hidden" name="ord_id" value="'.$invoice_id.'">
<input type="hidden" name="notify_comments"  value="1">
</form>	';

gen_pdf_file($invoice_id);
			$rs->MoveNext();
			
//echo '<script>pdfoc_action.submit();</script>';
		
		}	
	}
	if   (  ( ($database_code=="eu") 
 	        ||  ($database_code=="tb")  	
			|| ($check_production_bl>0)			
			) && ( strtoupper($payment_module_code) != 'COD' ) )
	{
		$customers_id = exec_select ( "select customers_id value from bo_po.orders where orders_id = " . $_SESSION['orders_id'] );
		$sql = 'select orders_id , last_modified 
		from bo_gl.orders 
		where customers_id =  '.$customers_id . '
		and orders_status = 5 
		and   date_format(last_modified,"%Y-%c-%d")=date_format(now(),"%Y-%c-%d")
		order by last_modified desc
		limit 0,1 ';
		
		//  limit 0,3
		
		$rs = $db->Execute($sql);
		while (!$rs->EOF)
		{
			$bl_id = $rs->fields['orders_id'];
			
echo '
<form name="pdfoc_action" action="el_gestion.php?form=action" method="post" target=_new>
<input type="submit" name="submit_action" value="Apercu du BL du '. $rs->fields['last_modified'] .'"></td>
<input type="hidden" name="file_type" value="Invoice.php">
<input type="hidden" name="invoice_mode" value="preview">
<input type="hidden"  name="address" value="delivery">
<input type="hidden"  name="startpos" value="1">
<input type="hidden" name="show_order_date"  value="1">
<input type="hidden" name="show_comments" value="1">
<input type="hidden" name="show_phone" value="">
<input type="hidden" name="show_email" value="">
<input type="hidden" name="show_pay_method" value="">
<input type="hidden" name="show_cc" value="">
<input type="hidden" name="status" value="0">
<input type="hidden" name="notify" value="1">
<input type="hidden" name="force_db" value="gl">			
<input type="hidden" name="ord_id" value="'.$bl_id.'">
<input type="hidden" name="notify_comments"  value="1">
</form>	';

gen_pdf_file($bl_id);

			$rs->MoveNext();
		
		}
		// 
		if ( $bl_id>0 )
		{
			$sql = " select delivery_postcode=billing_postcode value
												 from bo_gl.orders 
												 where orders_id = " . $bl_id ;
												 
			$equal_address = exec_select ( $sql );
			
			// la liste des RV exeption qui recoivent le BL 
			$sql = " select 1 value
												 from bo_gl.orders 
												 where 
													 orders_id = " . $bl_id ."
													 and customers_id in (80019,81433, 85488,81524,82182,86301,
												    83237,81870,85804,80661,85298,85302,85301,85299,85295,85296,85297,
													84812,84813,85411,87971,88176 )";
			$except = exec_select ( $sql );
//echo $sql.$except;exit;
			
			if ($except==1)
			{
				$equal_address="1";
			}
			
/*			
			big spot 85488
elacom 81524
Audico Systems 82182 86301
Ldlc.com SARL 	83237
la meduse 81870
DARTY SAV 85804	80661	85298	85302	85301	85299	85295	85296	85297
NORETRON  84812  84813
Lyreco 	85411
ERI DIDACTIC 	87971
aic info   8817 6*/

//echo '|||'.$equal_address.'|||'.$sql;// exit;												 
			
		}

//		if ((strlen($carrier)>0))

		if ((strlen($carrier)>0)&&($equal_address=="1"))
		{
//			echo '<script>document.pdfoc_action.submit();</script>';
/*			
			$url = 'http://127.0.0.1/sites/zencart_gl/admin/print_pdfs.php?ord_id='.$orders_id;					
			echo '<iframe cols=30 rows=30 src="'.$url.'"> </iframe>';
			
*/

		 // création du fichier PDF sur le serveur
          $fields = array("file_type" => "Invoice.php", "invoice_mode" => "preview", "address" => "delivery",
           "force_db" => "fr","startpos" => "1","show_order_date" => "1","show_comments" => "1","status" => "0","notify" => "1",
           "notify_comments" => "1","ord_id" => $zf_insert_id);
		
          $ch = curl_init();
          curl_setopt($ch,CURLOPT_URL, "http://linats.net/admin/el_gestion.php?form=action");
          curl_setopt($ch,CURLOPT_POST, count($fields));
          curl_setopt($ch,CURLOPT_POSTFIELDS, $fields);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          $result = curl_exec($ch);
          curl_close($ch);

		  
echo '
<SCRIPT LANGUAGE="JavaScript">

	var objShell = new ActiveXObject("shell.application");        
	objShell.ShellExecute("C:/DOUCHETTE/batch/bl_download.cmd", "", "", "", 1);
	objShell.ShellExecute("C:/DOUCHETTE/batch/print_acrobat.cmd", "", "", "", 1);
	
</SCRIPT>';			
			
		}
	}	

?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>