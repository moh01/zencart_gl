<?php
function get_product_type ( $products_model )
{
    if (strlen($products_model)==0)
	   return "";
	   
	if (substr($products_model,0,5)=="MCEL-")
	{
	   $original_code = substr( $products_model, 5, 1000 );
	   $product_type = "CM";
	}
	else if (substr($products_model,0,3)=="OI-")
	{
	   $original_code = substr( $products_model, 3 , 1000 );
	   $product_type = "OI";	   
	}
	else if (substr($products_model,0,5)=="BCEL-")
	{
	   $original_code = substr( $products_model, 5, 1000 );
	   $product_type = "B";	   	   
	}
	else
	{
	   $original_code = $products_model;
	   $product_type = "OM";	   	   	   
	}
//echo 	'|||'.$products_model.'||'.$product_type.'||'.$original_code;

    return $product_type.'|'.$original_code ;
}
// renvoie prix d'achat et taux
function display_price ( $price )
{
//   return $price;
   if ($price=='0|0|0|0')
   {
      return '';
   }
   else
   {
      $le_prix_tab = explode ( '|',$price);
	  
	  $le_prix = $le_prix_tab[0];
	  $le_taux = $le_prix_tab[1];
	  $le_stock = $le_prix_tab[2];
	  $les_appros = $le_prix_tab[3];
	  $le_stock_ext = $le_prix_tab[4];
	  
	  if ($le_prix>0)
	  {
		  if ($le_taux ==1)
		  {
			$retour =  '----€'.$le_prix;
		  }
		  else
		  {
			$retour = '----$'.$le_prix;	
		  }	
       }
	   if ( $le_stock > 0 )
	   {
			$retour .= '----stk:'.$le_stock;		   
			if ( $le_stock_ext > 0 )
			{
			   $retour .= '('.$le_stock_ext.')';
			}			
	   }
	   if ( $les_appros > 0 )
	   {
			$retour .= '----appr:'.$les_appros;		   
	   }
	   
   }
   return $retour;
}
function get_unit_order_price ( $source_db, $manufacturer, $products_model, $original_code )
{
  global $ext_db_name;
  global $ext_db_server;
  global $ext_db_password;
  global $ext_db_database;
  global $ext_db_username;
  
  global $db;
  /*
  if  (substr($products_model,0,3)!="BCEL-")
  {
      $add_where = " and products_name  not like 'BCEL%' "; 
  }
*/
	if ( $source_db == "bf")
	{
		$db->connect($ext_db_server["bf"], $ext_db_username["bf"], $ext_db_password["bf"], $ext_db_database["bf"], USE_PCONNECT, false);  
//echo 'uuuuu'.$ext_db_database.'jjjjj';	
	}
	else
	{
		$db->connect($ext_db_server["eu"], $ext_db_username["eu"], $ext_db_password["eu"], $ext_db_database["eu"], USE_PCONNECT, false);  
	}

  $sql = "select  qty
		  from el_stock 
		  where lamp_code like '". $products_model . "'
		  and length(lamp_code)>0
		  order by 1 desc";

   $rs = $db->Execute($sql);
   
   $prd_quantity = $rs->fields['qty'];
   
  $sql = "select  qty
		  from el_external_stock 
		  where lamp_code like '". $products_model . "'
		  and length(lamp_code)>0
		  order by 1 desc";

   $rs = $db->Execute($sql);
   
   $prd_external_quantity = $rs->fields['qty'];
   

//echo $prd_quantity.'  | ' . $sql.'<br>';
   
	  $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  
      $lamp_code = $products_model;
	  
	  // prix d'achat 
	  $sql = "select orders_products.final_price po_price, 
	                 orders.currency, 
					 orders_products.usd_euro_rate,
					 orders.payment_module_code,
					 orders_products.products_quantity, 
					 orders.treatment_date,
					 address_book.entry_country_id
			from orders, orders_products,customers,address_book
			where orders.orders_id = orders_products.orders_id 
			and  orders_products.products_model = '".$lamp_code."'
			and length(orders_products.products_model)>0
            and  database_code = 'po'
			and orders.customers_id not in (29,28)						
			and customers.customers_id = orders.customers_id	
			and customers.customers_default_address_id = address_book.address_book_id					
			order by orders.orders_id desc ";
			
//echo $sql.'<br>';
					
	  $rs2=$db->Execute($sql);
	  $po_price = $rs2->fields['po_price'];
	  $rate = $rs2->fields['usd_euro_rate'];
	  $payment_module_code = $rs2->fields['payment_module_code'];
	  $products_quantity = $rs2->fields['products_quantity'];
	  $entry_country_id = $rs2->fields['entry_country_id'];
	  $products_model = $lamp_code;
	  
		if ((substr($products_model,0,5)=="MCEL-")||(substr($products_model,0,3)=="OI-")||(substr($products_model,0,5)=="BCEL-"))
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
//echo 	'approach_price '. $approach_price. 'approach_price <br>';
	  
    $response = round($po_price,0) . '|' .round($rate,2) . '|' . $prd_quantity . '|'. $products_quantity.'|'.$prd_external_quantity.'|'.$approach_price;
	
    return $response;		
}
  
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

/*
				   $sql = "select distinct products_model value, products_model description 
						  from products 
						  where length(products_model)>0
						  and products_model like '%". $_GET['part_ref'] ."%' 
						  union 
						  SELECT DISTINCT concat(prd.products_model,'|',catd.categories_name) value, catd.categories_name description
						  FROM categories AS cat, categories_description AS catd, categories AS cstr, categories_description AS cstrd, products AS prd, products_description AS prdd, manufacturers AS man
						WHERE cat.categories_id = catd.categories_id
						AND 	cat.parent_id in (285,280,999)
						AND cat.parent_id = cstr.categories_id
						AND cstrd.categories_id = cstr.categories_id
						AND cstrd.language_id =2
						AND prdd.language_id =2
						AND catd.language_id =2
						AND prdd.products_id = prd.products_id
						AND prd.master_categories_id = cat.categories_id
						AND prd.manufacturers_id = man.manufacturers_id
						AND man.manufacturers_id
						IN ( 1, 4 ) 
						and catd.categories_name like '%". $_GET['part_ref'] ."%'
						ORDER BY 2";			   

*/

  require('includes/application_top.php');
//  require('includes/functions/extra_functions/super_orders_functions.php');
  require('el_fonctions_gestion.php');
  
  
  $dtb = $_GET['source_db'];  
  
//  $db->connect($ext_db_server[$dtb], $ext_db_username[$dtb], $ext_db_password[$dtb], $ext_db_database[$dtb], USE_PCONNECT, false);
  $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);

  // gestion de MAJ
  if ($_POST['updating']==1)
  {
	  // le changement des dates de traitement
	  if ( strlen($_GET['enforce_orders_id'])>0)
	  {
	  
		 if ($_POST['change_treatment_date']==1)
		 {
			/*
			$sql = "select orders_id value from orders_products where orders_products_id = ". $_GET['enforce_orders_id'];
			$the_order = exec_select ($sql);
			*/
			$the_order = $_GET['enforce_orders_id'];
			$sql = "select max(treatment_date) value  from orders";
			$the_treatment_date = exec_select ($sql);
			$dml = "update orders set treatment_date='".$the_treatment_date."' where orders_id = ". $the_order;
			
		    $db->Execute($dml);
echo '<font color=red>La date a été modifiée ! </font>';			
		 }
	  }
 
     for ($k=0;$k<count($_POST['orders_products_id']);$k++)
	 {
	    $opid =  $_POST['orders_products_id'][$k];
//echo 'op'.$opid.'<br>';
		$sql = "select * from orders_products where orders_products_id = " . $opid;
		
		$rsop = $db->Execute($sql);
        		
		$existing_compatible_lamp_code = $rsop->fields['compatible_lamp_code'];
		$products_model = $rsop->fields['products_model'];
		$unit_order_price = $rsop->fields['unit_order_price'];
		$approach_price = $rsop->fields['approach_price'];
		
		
		$resp = explode( "|", get_product_type($products_model) );
		$product_type = $resp[0];
		$original_code = $resp[1];
		
		if ( strlen( $_POST['equivalence'.$opid ] )>0 )
		{ 
		   $original_code = $_POST['equivalence'.$opid ];
//echo 'noc'.$original_code;		   
		}
	    if ( strlen($_POST['supp'.$opid]) > 0 )
		{
		    if ($_POST['supp'.$opid]=="S")
			{
			   $dml = "delete from orders_products where orders_products_id = " .$opid;
			   $db->Execute($dml);
			}
			else if ( ($_POST['supp'.$opid]=="A")||($_POST['supp'.$opid]=="B") )
			{
			   if ($_POST['supp'.$opid]=="A")
			     $new_status=6;
			   else
			     $new_status=9;
			   
			   $dml = "update orders 
					   set orders_status = ".$new_status."
					   where orders_id in (select orders_id from orders_products where orders_products_id = " .$opid . " )";
//echo $dml;					   
			   $db->Execute($dml);			   
			}
			else if ($_POST['supp'.$opid]=="R")
			{  			    
				 require('_obj_email.php');
				 $spam = new EMAIL;		  
				 $spam->set_email_language(2);  		   		   

                 $sql = "select products_model value from orders_products  where orders_products_id = " .$opid;
				 $products_model = exec_select ( $sql );

                 $sql = "select orders_id value from orders_products  where orders_products_id = " .$opid;
				 $orders_id = exec_select ( $sql );
				 
//echo 	$products_model;exit;
			     $dml = "update orders set gl_transfered = 2 where orders_id = ". $orders_id;
				 $db->Execute($dml);
				 
				 $spam->set_sender_name("Reporting marge",2);
				 $spam->set_sender_email_address( "noanwer@linats.net" );

//				 $spam->set_receiver_email_address( "fvaron@easylamps.fr" );
				 $spam->set_receiver_email_address( "han@easylamps.fr" );
					 
				 $spam->set_email_title('Waiting po Price for: ' .$products_model ,2);
				 $body = '<a href="http://linats.net/admin/margin_entry.php?enforce_orders_id='.$orders_id.'">Clic here to update Price</a>';
				 $spam->set_email_content($body,2);
				 
				 $spam->send_email();
				
			}			   
			
		}
	    if ( strlen($_POST['target_product'.$opid]) > 0 )
		{
		  $new_lamp_type = $_POST['target_product'.$opid];
		  
		  if ($new_lamp_type=="OM")
			$new_compatible_lamp_code = $original_code;
		  else if ($new_lamp_type=="OI")
			$new_compatible_lamp_code = "OI-".$original_code;
		  else if ($new_lamp_type=="CM")
			$new_compatible_lamp_code = "MCEL-".$original_code;
		  else if ($new_lamp_type=="B")
			$new_compatible_lamp_code = "BCEL-".$original_code;

//echo $new_compatible_lamp_code;		
			
		  // 
		  if ($existing_compatible_lamp_code!=$new_compatible_lamp_code)
		  {
		     $dml = "update orders_products set compatible_lamp_code = '". $new_compatible_lamp_code."'
			         where orders_products_id=".$opid;
//echo $dml.'<br>';			 
             $db->Execute($dml);			 
		     // on met à jour le prix d'achat au besoin
			 if ( ( $unit_order_price == 0 )
  			      && ( strlen($_POST['unit_order_price'.$opid])==0  )
				  ||  ( $_POST['unit_order_price'.$opid]==0 )  )
			 {
			   $check_price = explode("|",get_unit_order_price ( "eu","", $new_compatible_lamp_code, "" )); // ( $new_compatible_lamp_code );
			   $unit_order_price = $check_price[0];
			   $usd_euro_rate =  $check_price[1];
			   $calc_approach_price =  $check_price[5];
			   
//echo 'calc_approach_price'.	$calc_approach_price.'calc_approach_price<br>';

			   // FVV ajout du frais d'approche
			   if ($_POST['approach_price'.$opid]>0)
			   {
			     $approach_price = $_POST['approach_price'.$opid];				 			   
			   }
			   else
			   {
			     $approach_price = $calc_approach_price;			   
			   }
			   
			   if ($unit_order_price>0)
			   {
			      $dml = "update orders_products 
				          set unit_order_price =  ". $unit_order_price .",
						  approach_price = ". $approach_price . ",
						  usd_euro_rate =  ". $usd_euro_rate ."
						  where orders_products_id=".$opid;
				  $db->Execute($dml);			 
			   }
			 }
			 
			 
		  }
		  // $current_compatible_lamp_code_type = ;
		  // $new_product_type = get_product_type(
		}
//echo '/'.$_POST['unit_order_price'.$opid].'<br>';
		  
		  if ( ( $_POST['unit_order_price'.$opid] > 0 )
		       &&( ( $_POST['unit_order_price'.$opid] != $unit_order_price )
				   || ( $_POST['approach_price'.$opid] != $approach_price ) )
			   )
		  {
		          
                  if ($_POST['approach_price'.$opid]>0)
				  {
				     $add_dml = " , approach_price =  ". $_POST['approach_price'.$opid];
				  }
				  
			      $dml = "update orders_products 
						  set unit_order_price =  ". $_POST['unit_order_price'.$opid]. $add_dml  ."
			         where orders_products_id=".$opid;
				  $db->Execute($dml);
		  }
		  if ( $_POST['usd_euro_rate'.$opid] > 0 )
		  {
			      $dml = "update orders_products 
				         set usd_euro_rate =  ". $_POST['usd_euro_rate'.$opid] ."
			         where orders_products_id=".$opid;
				  $db->Execute($dml);		  
		  }
		  $sql  = "select final_price-(unit_order_price/usd_euro_rate)-approach_price new_margin,margin,products_model,final_price,products_name,orders_id 
		           from orders_products
				   where orders_products_id=".$opid;
				   
		  $rsm = $db->Execute($sql);
		  $current_margin= $rsm->fields['margin'];
		  $new_margin= $rsm->fields['new_margin'];
		  if ( round($new_margin,0)!=round($current_margin,0) )
		  {
			  if ( $new_margin < 0 )
			  {
				  if (!$pam)
				  {
					 include_once('_obj_email.php');
					 $spam = new EMAIL;
				  }
				  $spam->set_email_language(2);  				  
				  $spam->set_email_title('Marge négative de '.round($new_margin,0).' pour '. $rsm->fields['products_model'],2);
				  
				  // 
				  $spam->set_email_content ('Commande '. $rsm->fields['orders_id'] .' pour '. $rsm->fields['products_name'] . ' vendue '. round($rsm->fields['final_price'],0 ). ' Euros HT ',2) ;
//echo 'Commande '. $rsm->fields['orders_id'] .' pour '. $rsm->fields['products_name'] . ' vendue '. round($rsm->fields['final_price'],0 ). ' Euros HT ' ;exit;
				  
				  $spam->set_sender_name('Alert',2);
				  $spam->set_sender_email_address('noanswer@easylamps.fr');
				  
				  $spam->set_receiver_email_address('avaron@easylamps.fr');
				  $spam->send_email();
				  
				  $spam->set_receiver_email_address('han@easylamps.fr');				  
				  $spam->send_email();
				  
				  $spam->set_receiver_email_address('fvaron@easylamps.fr');				  
				  $spam->send_email();				  
				  
			  }			  
			  $dml = "update orders_products 
					  set margin = final_price-(unit_order_price/usd_euro_rate)-approach_price
					  where orders_products_id=".$opid."
					  and  usd_euro_rate>0";

//	echo "aa change for ".	$opid . " to  ".  $new_margin ." <br><br><br> ";
				  
			  $db->Execute($dml);		  
		  }
	 }
	 
  }
  //$conn->PConnect($ext_db_server[$dtb], $ext_db_username[$dtb], $ext_db_password[$dtb], $ext_db_database[$dtb]);
  

  		echo '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Margin Input / Picking Preparation </title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script type="text/javascript">
  function popupWindow(url, features) {
    window.open(url,\'popupWindow\',features)
  }
</script>
</head>
<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } ">
<form method="post">
<input type="hidden" name="updating" value=1>
		';

echo '<table>';

if (strlen($_GET['enforce_orders_id'])==0)
{
   $add_where = " and o.treatment_date = '". $_GET['treatment_date'] ."'";
}
else
{
   $add_where = " and o.orders_id in (  ". $_GET['enforce_orders_id'] ." ) ";
}



if ( 
      ( strlen($_GET['sites'])>0)
	   && ( $_GET['sites'])!='tous'
	  )
{
   $add_where .= " and o.database_code = '". $_GET['sites']."'";	
}
if ( $_GET['vacherin']==1 )
{
   $add_where .="
AND orders_products.orders_id = o.orders_id
AND orders_products.products_model not like '%MCEL%'
and orders_products.products_model not like '%OI%'
and ( orders_products.compatible_lamp_code  like '%MCEL%'
	  or orders_products.compatible_lamp_code  like '%OI%' )";

}
else if ( $_GET['vacherin']==10 )
{
	echo '<html><body><script>this.document.location="el_bon_preparation.php?treatment_date='.$_GET['treatment_date'].'&enforce_orders_id='. $_GET['enforce_orders_id'] .'&database_code='. $_GET['sites'] .'";</script></body></html>';
	exit;
}

$sql= "SELECT o.database_code,
       o.payment_module_code,
      concat('<font color=red><b>',o.customers_company,'</b></font><br>',o.customers_name) customer, 
      o.orders_id numero_commande,
	  orders_products.products_quantity,	  	  
	  orders_products.orders_products_id,	  
      orders_products.products_model, 
      orders_products.products_name, 
      orders_products.final_price ,
      orders_products.approach_price,	  
      unit_order_price, 
      usd_euro_rate, 
      margin marge,
	  compatible_lamp_code,
	  o.treatment_date,
	  o.orders_status
FROM orders o,
   orders_products
WHERE o.orders_id >0
AND o.database_code <> 'po'
AND orders_products.orders_id = o.orders_id
AND products_model NOT
IN (
'SHF', 'CODF', 'ECOF', 'ESCF', 'FRSH', 'FRS', 'SP400','DUSTGO','INSUR','CODF'
)
" . $add_where  . "
and o.gl_transfered in (1,2)
ORDER BY o.orders_id";

// 163734
//echo $sql;

if ( $_GET['vacherin']==1 )
{
   include_once('varechin.php');
   exit;
}
else if ( $_GET['vacherin']==10 )
{
   include_once('daily_mail.php');
   exit;
}

$rs = $db->Execute($sql);


$hdr = '<tr>
       <th>CMDE</th><th>Who ?</th><th>Qty</th><th>Model</th><th>What ?</th><th align="center">Sold Price</th><th>&nbsp;</th><th>Bought Price</th><th>Rate</th>
	   <th>Equivalence</th><th><input type=submit value="Save"></th>
	   </tr>
	   <tr>
        <td colspan=20>
		  <hr>
		</td>';
echo $hdr;

$cntr=0;
 
while(!$rs->EOF)
{
  $cntr++;
  if ($cntr==5)
  {
     $cntr=0;
	 echo $hdr;
  }
    
  $unit_order_price = round($rs->fields['unit_order_price'],0);
  if ( $unit_order_price >0 )
  {
	$usd_euro_rate = $rs->fields['usd_euro_rate'];
  }
  else
  {
	$usd_euro_rate = "";
  }
  
  
  echo '<input type="hidden" name="orders_products_id[]" value="'.$rs->fields['orders_products_id'].'">';
  echo '<tr>';

  echo '<td><b>';  
  echo $ext_db_name[$rs->fields['database_code']];  
  echo '</b><br>';
  if ( strlen($_GET['enforce_orders_id'])>0 )
  {
     echo $rs->fields['treatment_date'];
	 echo '<br>';
  }
  echo $rs->fields['numero_commande'];
	if ( true )
	{
		echo '<a href="javascript:popupWindow(\'' .
		 zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $rs->fields['numero_commande'] . '&target=edit_product&orders_products_id=0', 'NONSSL') . '\', \'scrollbars=yes,resizable=yes,width=400,height=400,screenX=150,screenY=300,top=100,left=150\')">	'.	  
		  '<img  border=0 width=10 src="newitem.gif"></a>';
	}

  echo '</td>';

  echo '<td>';
  echo $rs->fields['customer']; 
  echo '<br>';
  echo $rs->fields['payment_module_code'];  
  echo '</td>';

  $products_quantity = $rs->fields['products_quantity'];
  
  if ( $products_quantity>1 )
  {
	echo '<td  align="right" bgcolor=#e9e2e2>';
  }
  else
  {
	echo '<td align="right">';
  }
  
  echo $products_quantity;  
  echo '</td>';
  
  $products_model = $rs->fields['products_model'];
  
  echo '<td bgcolor=#e9e2e2>';
  echo $products_model;  
  echo '</td>';

  echo '<td>';
  echo $rs->fields['products_name'];
  
	if ( true )
	{
		echo '<a href="javascript:popupWindow(\'' .
		 zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $rs->fields['numero_commande'] . '&target=edit_product&orders_products_id=' . $rs->fields['orders_products_id']. '', 'NONSSL') . '\', \'scrollbars=yes,resizable=yes,width=400,height=400,screenX=150,screenY=300,top=100,left=150\')">	'.	  
		  '<img  border=0 width=10 src="images/icon_edit3.gif"></a>';
	}
	echo '</td>' . "\n";
 
  echo '</td>';

  echo '<td align="center">';
  echo '€ '.round($rs->fields['final_price'],0);  
  echo '</td>';
  
  $tab_resp = Array();
  
  $tab_resp = explode('|',get_product_type($products_model));
  $product_type = $tab_resp[0];
  $original_code = $tab_resp[1];

  $compatible_lamp_code = $rs->fields['compatible_lamp_code'];
  $orders_status = $rs->fields['orders_status'];
  
  if (strlen($compatible_lamp_code)>0)
  {
	  $tab_resp = Array();
	  
	  $tab_resp = explode('|',get_product_type($compatible_lamp_code));
	  $compatible_product_type = $tab_resp[0];
	  $compatible_original_code = $tab_resp[1];
//echo $compatible_lamp_code.'||'. $original_code .'||'.  $compatible_original_code .'||<br>';
	  if ( $original_code != $compatible_original_code  )
	  {
		 $display_compatible_code=$compatible_original_code;
		 $reference_compatible_code=$compatible_original_code;
	//	 $sql = "select ";
	  }
	  else
	  {
		 $display_compatible_code="";
		 $reference_compatible_code=$original_code;
	  }
  }
  else
  {
		 $display_compatible_code="";
		 $reference_compatible_code=$original_code;  
		 $compatible_product_type = "ZZ";
//		 $compatible_original_code = "ZZ";
  }
//  if ($
//echo 'roc'.  $reference_compatible_code.'<br>';
  
//echo 'clc'. $compatible_product_type .'<br>';
  
  echo '<td>';
  $select_html = '<select size=5 name="target_product'.$rs->fields['orders_products_id'].'">';
  $select_html .= '<option value="OM">....OM'.display_price(get_unit_order_price('eu','',$reference_compatible_code,''));
  $select_html .= '<option value="CM">....CM'.display_price(get_unit_order_price('eu','','MCEL-'.$reference_compatible_code,''));
  $select_html .= '<option value="OI">....OI'.display_price(get_unit_order_price('eu','','OI-'.$reference_compatible_code,''));
  $select_html .= '<option value="B">....B'.display_price(get_unit_order_price('eu','','BCEL-'.$reference_compatible_code,''));
  $select_html .= '<option value="N">....';
  $select_html .= '</select>';
  // ( $source_db, $manufacturer, $products_model, $original_code )
  // à remplacer style="background-color:#e9e2e2;" 
  //     value="'.round($rs->fields['usd_euro_rate'],2).'">';
  // echo   str_replace('"'. $product_type .'"','"'. $product_type .'" style="background-color:#e9e2e2;"',$select_html);  
  $select_html =   str_replace('"'. $product_type .'">....','"'. $product_type .'">  ',$select_html);
//echo 'cpt'.$compatible_product_type.'<br>';
  if (strlen($compatible_product_type)>0)
  {
	$select_html =   str_replace('"'. $compatible_product_type .'"','"'. $compatible_product_type .'" style="background-color:#e9e2e2;"',$select_html);  
  }
  echo $select_html;
  
  echo '</td>';
  
  if ( strlen($compatible_lamp_code)> 0 )
  {
    if ($unit_order_price==0)
		$bgcol = 'bgcolor=orange'; 
	else
		$bgcol = ''; 	
  }
  else
  {
	$bgcol = 'bgcolor=yellow'; 
  }
  
  echo '<td '. $bgcol .'  align=center>';
  if ($usd_euro_rate==1)
    $symbol = "€";
  else
   $symbol = "$";
   
  if  ( ( strlen($compatible_product_type)>0 ) && ( $compatible_product_type != 'ZZ' ) )
  {
	$uop = $unit_order_price;
  }
  else
  {
	$uop = 0;
  }
  // 
  $approach_price = $rs->fields['approach_price'];
  
  echo $symbol.'<input type="text" size=3 name="unit_order_price'. $rs->fields['orders_products_id'] .'" value="'.$uop.'">';
  echo "<br>";
  if ($approach_price==0)
	echo '<font color=orange>Appr.€</font>';
  else
	echo 'Appr.€';
  
  echo '<input type="text" size=1 name="approach_price'. $rs->fields['orders_products_id'] .'" value="'.$approach_price.'"> ';
  echo '</td>';

  echo '<td '. $bgcol .'>';
  echo '<input type="text" size=3 name="usd_euro_rate'.$rs->fields['orders_products_id'].'" value="'.round($usd_euro_rate,2).'">';   
  echo '</td>';

  echo '<td '. $bgcol .' align=center>';
  echo '<input type="text" size=15 name="equivalence'.$rs->fields['orders_products_id'].'" value="'. $display_compatible_code .'">';   
  echo '</td>';

  echo '<td '. $bgcol .' align=center>';
  echo 'Suppr ('. $orders_status . ')
        <select  name="supp'.$rs->fields['orders_products_id'].'">
<option value="">
<option value="A">Annuler
<option value="B">ré Activer
<option value="S">Suppress
<option value="R">Enter Later
</select>';   
  echo '</td>';

  
  echo '</tr>';
  
  echo '<tr>
        <td colspan=20>
		  <hr>
		</td>';
		
  echo '</tr>';
  $rs->MoveNext();
}
  echo '</table>';
if (strlen($_GET['enforce_orders_id'])>0)
{
//	echo '<input type="hidden" name="change_treatment_date" value="1">';

	echo '<center><input type="checkbox" name="change_treatment_date" UNCHECKED value="1">Change treatment date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
//<input type="checkbox" name="notify_easylamps"  value="1">Notify Easylamps</center><br>';
	
}
echo '<center> <input type=submit value="Enregistrer"> </center>';

/*
$info_cmde  = "";
echo '<td></td><td></td><td><input type=text></td>';
echo '</tr>';
echo '</table>';
*/
		echo '</form>';
echo '</body>';
?>