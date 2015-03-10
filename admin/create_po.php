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

$easylamps_email_address = "han@easylamps.fr";
$easylamps_email_address2 = "avaron@easylamps.fr";

$easylamps_name = "Han";

//_TODO add admin account id to status history record
//_TODO form verifications on edit & payment popup forms
//_TODO payment_types table interface
//_TODO popup class to build/display help or additional data in new window
//_TODO make following replacements in all SO files...
//                 <br> --> <br />
//                  <b> --> <strong>
//      zen_db_output --> zen_db_scrub_out($x)
//      zen_db_input --> zen_db_scrub_in($x, true/false)
// 		zen_db_prepare_input --> zen_db_scrub_in($x, true/false)

function apply_product_change($add_product,$supplier_code,$prd_type,$products_model,$products_quantity,$final_price)
{
    global $source_catalog;
	global $orders_id;
	global $db;

	global $ext_db_server;
	global $ext_db_username;
	global $ext_db_password;
	global $ext_db_database;
	

	if  (  ($prd_type=='O') || ($prd_type=='OM') )
	{
		$products_name = 'OM ';
	}
	else if ( ($prd_type=='OI') && ( strlen($products_model)>0) )
	{
		$products_model = 'OI-'.$products_model;			
		$products_name = 'OI ';
	}
	else if ( (  ($prd_type=='C') || ($prd_type=='CM'  ) )  && ( strlen($products_model)>0) )
	{
		$products_model = 'MCEL-'.$products_model;						
		$products_name = 'CM ';
	}
	else if (  ( ($prd_type=='B')|| ($prd_type=='BULB'  ) )  && ( strlen($products_model)>0) )
	{
		$products_model = 'BCEL-'.$products_model;									
		$products_name = 'Bulb ';
	}			
	else if ($prd_type=='battery')
	{
		$products_name = 'Battery ';
	}
	else if ($prd_type=='charger')
	{
		$products_name = 'Charger ';
	}			
	if ( $add_product=='Confirm')
	{  
	   $po_status='confirmed';
	}
	else
	{  
	   $po_status='stand_by';
	}
	
	if  ( strpos($products_model,'|')  )
	{
		$results = explode('|',$products_model);
		$products_model = $results[0];
		$internal_supplier_code = $results[1];				
	}
	
	$sql ="select 1 value from orders_products where orders_id = ".$orders_id . "  
			 and products_model = '". $products_model ."'";
			 
	$check = exec_select($sql);
//echo $sql.$check;exit;
	// check BND ou Arclite codes
	if  ( ($supplier_code=='BND') || ($supplier_code=='AL') )
	{
		$db->connect($ext_db_server[$source_catalog], $ext_db_username[$source_catalog], $ext_db_password[$source_catalog], $ext_db_database[$source_catalog], USE_PCONNECT, false);							   
		
		$sql ="SELECT value
				FROM `el_products_techdata`
				WHERE `lamp_code` LIKE '%". $products_model ."%'
				AND `datatype_code` = 'code' ";
		$internal_supplier_code = exec_select($sql);
		$db->connect($ext_db_server['po'], $ext_db_username['po'], $ext_db_password['po'], $ext_db_database['po'], USE_PCONNECT, false);							   

	}
	
	if ( ($check==0) && (strlen($products_model)>0) && ($final_price>0) )
	{			
		if ( strlen($internal_supplier_code) > 0 )
		{
		   $products_name = '#'.$internal_supplier_code . " ". $products_name;
		}
		
		   
		$dml =" insert into orders_products
				( orders_products_id ,  orders_id , products_model, 
				  products_name  , final_price , products_quantity ,
				  po_status )
				 values 
				 ( '', ".$orders_id.",'".$products_model."',
				   '".$products_name."','". $final_price."',".$products_quantity.",
				   '" . $po_status ."'
				  ) ";
		  $db->Execute($dml);
		  $opid = mysql_insert_id(); 
		if ($currency=="EUR")
		{
			$dml = "update orders_products set usd_euro_rate = 1  where orders_products_id = ". $opid;
			$db->Execute($dml);
		} 
	}
}
  require('includes/application_top.php');
//  require('includes/functions/extra_functions/super_orders_functions.php');
  require('el_fonctions_gestion.php');
  
  
  require('_obj_email.php');

  		echo '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Fast PO for '. $_GET['supplier_code'] . '</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script type="text/javascript">
  function popupWindow(url, features) {
    window.open(url,\'popupWindow\',features)
  }
</script>
</head>
<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } ">
<form>
		';
  
       $sourcedb = $_SESSION['source_db'];
  	   $db->connect($ext_db_server[$sourcedb], $ext_db_username[$sourcedb], $ext_db_password[$sourcedb], $ext_db_database[$sourcedb], USE_PCONNECT, false);
		
	   if (strlen($_GET['supplier_code'])==0)
	   {
			echo '<b>Supplier ? </b>';
			$sql="select distinct short_name code,  short_name description  from customers order by 1";
			echo get_select($sql,"supplier_code","");
			echo '<input type="submit">';
	   }
	   else 
	   {
	   
	       echo "<input type=hidden name=supplier_code value=".$_GET['supplier_code'].">";
		   echo '<table>';
		   
		   // on check les informations du fournisseur
		   $sql = "select customers_firstname, 
		                 customers_id,
						 customers_email_address,
						 customers_email_address2,
						 customers_email_address3,						 
						 source_catalog,
						 model_orders_id
				  from  customers where short_name = '".$_GET['supplier_code']."'";
		   
		   $rs = $db->Execute($sql);
		   $customers_firstname = $rs->fields['customers_firstname'];
		   $customers_id = $rs->fields['customers_id'];
		   $customers_email_address = $rs->fields['customers_email_address'];		   
//echo 'kkkk'.$customers_email_address.'kkkk';exit;		   
		   $customers_email_address2 = $rs->fields['customers_email_address2'];		   
		   $customers_email_address3 = $rs->fields['customers_email_address3'];		   

		   $source_catalog = $rs->fields['source_catalog'];		   
		   $model_orders_id = $rs->fields['model_orders_id'];		   
		   
//echo 	$customers_firstname;exit;
           $sql = "select entry_country_id value  from address_book where customers_id = ". $customers_id;
	       $countries_id = exec_select( $sql );
//echo 	$sql.'|'.$countries_id;exit;

		   if ($countries_id==73)
		   {
		     $languages_id=2;
		   }
		   else
		   {
		     $languages_id=5;
		   }
		   $orders_id = exec_select("select max(orders_id) value from orders where orders_status=7 and customers_id = ". $customers_id);
		   
           if ( $orders_id == 0)		   
		   {
		      //on  crée ici une nouvelle cmde
			  // -53 est USD HT
			    $oldID = $model_orders_id;
				$orders_id = clonage_order ( $oldID, 'gl', 'po', 'po', $customers_id, 5, 7 );				
           }
		   // récupération de la monnaie: 
		   $db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);
		   $sql = "select currency value from orders where orders_id = ". $model_orders_id;
		   $currency = exec_select ($sql);
		   
		   if ($currency=="EUR")
				$currency_symbol="€";
		   else
				$currency_symbol="$";
				
		   $db->connect($ext_db_server['po'], $ext_db_username['po'], $ext_db_password['po'], $ext_db_database['po'], USE_PCONNECT, false);
		   

		   
		   // Gestion des données en POST
		  if (strlen($_GET['confirm'])>0)
		  {
		     $dml = "update orders_products set po_status = 'confirmed' where orders_products_id = ". $_GET['confirm'];
			 $db->Execute($dml);
          }
			if ( strlen($_GET['add_remark'])>0 )
			{
			
			   $dml = "delete from orders_status_history where comments like '###%'";
			   $db->Execute($dml);

			   $remark = '###'.addslashes($_GET['add_remark']);
			   $dml = "insert into orders_status_history (orders_id,comments)  values
					   ( ". $orders_id  .",'". $remark  ."')";
					   
			   $db->Execute($dml);
			   
			}
		  if (strlen($_GET['stand_by'])>0)
		  {
		     $dml = "update orders_products set po_status = 'stand_by' where orders_products_id = ". $_GET['stand_by'];
			 $db->Execute($dml);
          }
		  if ($_GET['add_product']=="Multiple")
		  {
		  
			 $tbl = $_GET['multi_entry'];

//			 echo $_GET['muti_entry'];exit;		  
//echo '<hr>'.$_GET['multi_entry'].'<hr>';exit;			 
			 $lignes=explode(chr(13),$tbl);
//echo count($lignes);exit;
			 for ($k=0;$k<count($lignes);$k++)
			 {
				$vals = explode(chr(9),$lignes[$k]);				
				
				$qty = $vals[0];
				$qty = str_replace(' ','',$qty);
				$qty = str_replace(" ",'',$qty);				
								
				$typ = $vals[1];
				$typ = str_replace(' ','',$typ);				
				
				$mdl = $vals[2];
				$mdl = str_replace(' ','',$mdl);				
				
				$upc = $vals[3];
				$upc = str_replace(' ','',$upc);				
				$upc = str_replace(',','.',$upc);	
				$upc = str_replace('$','',$upc);					
				
//echo '<hr>'.$typ.'<hr>';
				$err="";

				if ( ! is_numeric($qty)  )
				{
					$err .= "Non numeric Format for QTY |".$qty."|".$upc."|";
				}		
				
				if ( ! is_numeric($qty) || ! is_numeric($upc) )
				{
					$err .= "Non numeric Format for QTY or PRICE |".$qty."|".$upc."|";
				}				
				if ( ! ( ($typ=="OM") || ($typ=="OI")|| ($typ=="CM")|| ($typ=="BULB")  ) )
				{
					$err .= "<br> UNKNOW TYPE :  ". $typ;
				}				
				if ( ! ( strlen($mdl)>0 ) )
				{
					$err .= "<br>EMPTY REF  <br>";
				}
			    
				if (strlen($err)>0)
				{
					echo "<font color=red>". $err . "</font><br>";
				}
				else
				{
///echo '|'.$typ.'|';				
					 apply_product_change('Confirm',$_GET['supplier_code'],$typ,$mdl,$qty,$upc);
				}				
			 }
		  }
		  if (strlen($_GET['add_product'])>0)
		  {
			$products_model = $_GET['products_model'];
			if (strlen($products_model)==0)
			{
			   $products_model = $_GET['new_product'];
			}
			$prd_type = $_GET['prd_type'];
			
			if ($prd_type=='O')
			{
				$products_name = 'OM ';
			}
			else if ( ($prd_type=='OI') && ( strlen($products_model)>0) )
			{
				$products_model = 'OI-'.$products_model;			
				$products_name = 'OI ';
			}
			else if (  ($prd_type=='C')  && ( strlen($products_model)>0) )
			{
				$products_model = 'MCEL-'.$products_model;						
				$products_name = 'CM ';
			}
			else if (  ($prd_type=='B')  && ( strlen($products_model)>0) )
			{
				$products_model = 'BCEL-'.$products_model;									
				$products_name = 'Bulb ';
			}			
			else if ($prd_type=='battery')
			{
				$products_name = 'Battery ';
			}
			else if ($prd_type=='charger')
			{
				$products_name = 'Charger ';
			}			
			if ( $_GET['add_product']=='Confirm')
			{  
			   $po_status='confirmed';
			}
			else
			{  
			   $po_status='stand_by';
			}
			
			if  ( strpos($products_model,'|')  )
			{
				$results = explode('|',$products_model);
				$products_model = $results[0];
				$internal_supplier_code = $results[1];				
            }
			
			$sql ="select 1 value from orders_products where orders_id = ".$orders_id . "  
			         and products_model = '". $products_model ."'";
					 
			$check = exec_select($sql);
//echo $sql.$check;exit;
            // check BND ou Arclite codes
			if  ( ($_GET['supplier_code']=='BND') || ($_GET['supplier_code']=='AL') )
			{
				$db->connect($ext_db_server[$source_catalog], $ext_db_username[$source_catalog], $ext_db_password[$source_catalog], $ext_db_database[$source_catalog], USE_PCONNECT, false);							   
				
				$sql ="SELECT value
						FROM `el_products_techdata`
						WHERE `lamp_code` LIKE '%". $products_model ."%'
						AND `datatype_code` = 'code' ";
				$internal_supplier_code = exec_select($sql);
				$db->connect($ext_db_server['po'], $ext_db_username['po'], $ext_db_password['po'], $ext_db_database['po'], USE_PCONNECT, false);							   

            }
			
			if ( ($check==0) && (strlen($products_model)>0) && ($_GET['final_price']>0) )
            {			
			    if ( strlen($internal_supplier_code) > 0 )
				{
				   $products_name = '#'.$internal_supplier_code . " ". $products_name;
				}
				
				   
				$dml =" insert into orders_products
						( orders_products_id ,  orders_id , products_model, 
						  products_name  , final_price , products_quantity ,
						  po_status )
						 values 
						 ( '', ".$orders_id.",'".$products_model."',
						   '".$products_name."','". $_GET['final_price']."',".$_GET['products_quantity'].",
						   '" . $po_status ."'
						  ) ";
		          $db->Execute($dml);
				  $opid = mysql_insert_id(); 
				if ($currency=="EUR")
				{
					$dml = "update orders_products set usd_euro_rate = 1  where orders_products_id = ". $opid;
					$db->Execute($dml);
				} 
			}
	      }
		   
		   echo '<tr>';
		   echo '<td colspan=2 align=center>';
		   echo '<h2>PO Entry for '. $_GET['supplier_code'] .'</h2>';		   
		   echo '</td>';
		   echo '<td>Due date &nbsp;&nbsp;';		   
		   if (strlen($_SESSION['due_date'])==0)
		   {
		       $_SESSION['due_date'] = exec_select  ("select DATE_ADD(CURDATE(),INTERVAL 7 DAY) value");
		   }
		   echo '<input type=text size=10 name="due_date" value="'. $_SESSION['due_date'] .'">';
		   echo '</td>';
		   echo '</tr>';
		   
		   echo '<tr>';
		   echo '<td colspan=2>';
		   echo '<h2>Add  product</h2>';		   
		   echo '</td>';
		   echo '<td  colspan=2>';
		   echo '<h2>PO detail </h2>';		   
		   echo '</td>';
		   echo '</tr>';

		   echo '<tr>';
		   echo '<td colspan=2>';
           echo '<table>';
			   echo '<tr>';
			   echo '<td>';
			   echo 'Referenced products';
			   echo '<br>';
			   echo 'Part of reference';		   
			   echo '<br>';
			   echo '<input type=text name=part_ref value="'.$_GET['part_ref'].'" size=3>';
			   echo '<br>';		   
			   echo '<input type=submit value=Search>';
			   echo '</td>';
			   echo '<td>';
//echo '....'.$source_catalog.'....';exit;
			   
			   echo '<select name=products_model size=6>';
			   $db->connect($ext_db_server[$source_catalog], $ext_db_username[$source_catalog], $ext_db_password[$source_catalog], $ext_db_database[$source_catalog], USE_PCONNECT, false);							   
			   
			   if ( $source_catalog=="bf" )
			   {
			   
				   $sql = "SELECT distinct lamp_code value, concat(lamp_code, ' -- ', value ) description
							FROM `el_products_techdata`
							WHERE `datatype_code` = 'code'
						  and ( lamp_code like '%". $_GET['part_ref'] ."%' 
						       or value like '%". $_GET['part_ref'] ."%' )
							   order by 1";			   			   
			   }
			   else
			   {
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
			   }
//echo $sql;			   
			   
			   $rs = $db->Execute($sql);
			   while (!$rs->EOF)
			   {  
			      echo '<option value="'.$rs->fields['value'].'">'.$rs->fields['description'];
				  $rs->MoveNext();
			   }

			   $db->connect($ext_db_server['po'], $ext_db_username['po'], $ext_db_password['po'], $ext_db_database['po'], USE_PCONNECT, false);							   			   
			   echo '</select>';
			   
			   echo '</td>';
			   echo '</tr>';

			   echo '<tr>';
			   echo '<td>';
			   echo 'Unreferenced product (<font color=red>avoid</font>)';
			   echo '</td>';
			   echo '<td>';
			   echo '<input type="text" name="new_product">';
			   echo '</td>';			   
			   echo '</tr>';
			   
			   
			   echo '<tr>';
			   echo '<td colspan=2>';
			   if ($source_catalog=="eu")
			   {
			       if ( ($_GET['supplier_code']=="GP")
				        || ($_GET['supplier_code']=="AL") )
				   {
				      $default_c = 'CHECKED';
				   }
				   echo 'Product type: &nbsp; LO<input type=radio CHECKED name=prd_type value="O"> 
				                       &nbsp; OI<input type=radio  name=prd_type value="OI"> 
									   &nbsp; LC<input type=radio  name=prd_type '. $default_c .' value="C">
									   &nbsp; B<input type=radio  name=prd_type value="B">';
			   }
			   else
			   {
				   echo 'Product type: &nbsp; Battery<input type=radio CHECKED name=prd_type value="battery"> 
				                       &nbsp; Charger<input type=radio  name=prd_type value="charger">';
			   }
			   
			   echo '</td>';
			  
			   echo '</tr>';
			   
			   echo '<tr>';			   
			   echo '<td>';
			   echo 'Qty';
			   echo '<input type=text size=2  name=products_quantity  value=1>';
			   echo '</td>';
			   echo '<td>';
			   echo 'Price( '. $currency  .')';
			   echo '<input type=text name=final_price size=2>';
			   echo '</td>';
			   echo '</tr>';

			   echo '<tr>';			   
			   echo '<td>';
			   echo '<input type=submit name=add_product value="Stand by">';
			   echo '</td>';
			   
			   echo '<td>';
			   echo '<input type=submit name=add_product value="Confirm">';
			   echo '</td>';
			   echo '</tr>';

			   echo '<tr>';			   			   
			   echo '<td colspan=2>';
			   echo '<textarea name="multi_entry" cols=24 rows=4></textarea>';
			   echo '</td>';
			   echo '</tr>';			   			   

			   echo '<tr>';			   			   
			   echo '<td>';
			   echo '&nbsp;';
			   echo '</td>';			   
			   echo '<td>';
			   echo '<input type=submit  name=add_product value="Multiple" cols=24 rows=4>  </area>';
			   echo '</td>';
			   echo '</tr>';			   
			   
			echo '</table>';
			
/*		   
		   
		   echo '<tr>';
		   echo '<td>';
		   echo 'Quantity';		   
		   echo '<br>';
		   echo '<input type=text width=1 value=1>';
		   echo '<br>';		   
		   echo '<input type=submit value=Search>';
		   echo '</td>';
		   echo '<td>';
		   echo '<select size=6>';
		   echo '<option>.............</option>';
		   echo '</select>';
		   echo '</td>';
		   echo '</tr>';
*/		   
		   echo '</td>';
		   
		   echo '<td>';
		   if ($languages_id==2)
				$subject = " Commande #".$orders_id . " par Easylamps.";
		   else
				$subject = " Supply #".$orders_id . " from Easylamps.";
		   
		   echo  '<b> '. $subject . '</b>';
		   $html .= '<br><br>';

		   if ($languages_id==2)
				$html .= 'Bonjour  '. $customers_firstname . ',<br><br>
Nous avons le plaisir de vous confirmer une commande pour la liste des biens suivante,
<br><br>';				
		   else
				$html .= 'Dear  '. $customers_firstname . ',<br><br>
We have the pleasure in confirming you the goods listed,
<br><br>';

		    $html .= '<table border="1">';
			  
			$html .= '<tr>';

			$html .= '<th align=center>';
			$html .= '&nbsp;';
			$html .= '</th>';
			
			  
			$html .= '<th align=center>';
			$html .= 'Qty';
			$html .= '</th>';
			  
			$html .= '<th widh="30">';
			$html .= 'Pd Code - Easylamps Reference';
			$html .= '</th>';
			  
			$html .= '<th widh="50">';
			$html .= 'Pd Description / Remark  ';			  
			$html .= '</th>';

			$html .= '<th align=center>';
			$html .= 'Unit price';			  
			$html .= '</th>';

			$html .= '<th>';
			$html .= '&nbsp;';			  
			$html .= '</th>';
			  
			$html .= '</tr>';			  
			  
            $sql = " select orders_products_id ,  products_model, 
							products_name  , final_price , products_quantity ,
							po_status 
					 from orders_products 
					 where orders_id = ".$orders_id ."
					 order by po_status ";
					 
			 $rs = $db->Execute($sql);

			$mail_html = $html;			  
			 
			 while(!$rs->EOF)
			 {
			    $row_html = "";
			    $po_status = $rs->fields['po_status'];
				
				if ($source_catalog=="eu")
				{
					$exists=exec_select ( "select 1 value from rv_lampe_eu.el_stock where lamp_code='".$rs->fields['products_model']."'");
					
					if  ( ($exists==0) && ( $rs->fields['products_model'] != 'SHF' ) )
					{
						$cstr="";
						$sql="  SELECT DISTINCT cstrd.categories_name value
								FROM rv_lampe_eu.categories AS cat, 
									rv_lampe_eu.categories_description AS catd, 
									rv_lampe_eu.categories AS cstr, 
									rv_lampe_eu.categories_description AS cstrd, 
									rv_lampe_eu.products AS prd, 
									rv_lampe_eu.products_description AS prdd, 
									rv_lampe_eu.manufacturers AS man
								WHERE cat.categories_id = catd.categories_id
								AND (
								cat.parent_id =0
								OR 0 =0
								)
								AND cat.parent_id = cstr.categories_id
								AND cstrd.categories_id = cstr.categories_id
								AND cstrd.language_id =2
								AND prdd.language_id =2
								AND catd.language_id =2
								AND prdd.products_id = prd.products_id
								AND prd.master_categories_id = cat.categories_id
								AND prd.manufacturers_id = man.manufacturers_id
								AND man.manufacturers_id
								IN ( 1, 4, 2, 5, 3, 6 ) 
								AND (
								prdd.products_name LIKE  '".$rs->fields['products_model']."'
								) ";
								
						$cstr=exec_select($sql);
						
//echo $sql.'|'.$cstr.'|<br>'; exit;

						if (strlen($cstr)>0)
						{
							$dml = "insert into rv_lampe_eu.el_stock  (ctr_code, lamp_code, qty)
									values ( '".$cstr."','".$rs->fields['products_model']."',0 )";
//echo $dml;exit;									
							$db->Execute($dml);	
							$exists = 1;							
						}							
					}
				}
				else
				{
					$exists=1;
				}
			    if ($po_status=='confirmed')
				{
				   $color='#d4eee6';
				   $confirm_label='Put on hold';
				   $confirm_url='create_po.php?supplier_code='.$_GET['supplier_code'].'&stand_by='.$rs->fields['orders_products_id'];				   
				}
				else
				{
				   $color='#ebe9e9';
				   $confirm_label='Confirm';				   
				   $confirm_url='create_po.php?supplier_code='.$_GET['supplier_code'].'&confirm='.$rs->fields['orders_products_id'];				   				   
				}				
				  $row_html .= '<tr>';

				  $row_html .=  '<td  bgcolor="'.$color.'" align=center>';
				  
				  $to_replace1 = "<a href=\"javascript:this.document.location='create_po.php?supplier_code=". $_GET['supplier_code'] . "';popupWindow('super_edit.php?oID=".$orders_id."&amp;target=edit_product&amp;orders_products_id=".$rs->fields['orders_products_id']."', 'scrollbars=yes,resizable=yes,width=400,height=400,screenX=150,screenY=300,top=100,left=150');\"> <img src=\"images/icon_edit3.gif\" border=\"0\"></a>";
				  
				  $row_html .=  $to_replace1;
				  $row_html .=  '</td>';

				  
				  $row_html .=  '<td  bgcolor='.$color.' align=center>';
				  $row_html .=  $rs->fields['products_quantity'];
				  $row_html .=  '</td>';
				  
				  if  ($exists)
					$row_html .=  '<td  widh="30" bgcolor='.$color.'>';
				  else
					$row_html .=  '<td  widh="30" bgcolor=orange>';
				  
				  $row_html .=  $rs->fields['products_model'];
				  $row_html .=  '</td>';
				  
				  $row_html .=  '<td   widh="50" bgcolor='.$color.'>';
				  $row_html .=  $rs->fields['products_name'];
				  $row_html .=  '</td>';

				  $row_html .=  '<td  bgcolor='.$color.' align=center>';
				  $row_html .=  $currency_symbol.'&nbsp;'.round($rs->fields['final_price'],2);			  
				  $row_html .=  '</td>';

				  $row_html .=  '<td bgcolor='.$color.'>';
				  $to_replace2 =  '&nbsp;<a href="'.$confirm_url.'">'.$confirm_label.'</a>';			  
				  $row_html .=  $to_replace2;
				  $row_html .=  '</td>';
				  
				  $row_html .=  '</tr>';			  
				  
				  if ($po_status=='confirmed')
				  {
				     $total_qty += $rs->fields['products_quantity'];				  
				     $total += $rs->fields['products_quantity'] * $rs->fields['final_price'];
				  }
				  $rs->MoveNext();				
			      if ($po_status=='confirmed')
				  {				  
		             $mail_row_html = str_replace($to_replace1,'',$row_html);
		             $mail_row_html = str_replace($to_replace2,'',$mail_row_html);
				  }
				 $mail_html .= $mail_row_html;
				 
				 $html .= $row_html;
				  
			 }
			  
echo $html;
		      $html = '</table>';
			  
		   $html .= '<br><br>';
if ( $languages_id ==2 )
{
           $html .= 'Soit une commande de  <b> '. $total_qty . '</b> produit(s) pour un montant total de <b>'.$currency_symbol.' '. $total . '</b>.';			  
}
else
{
           $html .= 'This order holds  <b> '. $total_qty . '</b> item(s) for a  total amount of <b>'.$currency_symbol.' '. $total . '</b>.';			  
}
		   $html .= '<br><br>';
echo $html;

        $remark = exec_select ("select comments value from orders_status_history where orders_id = ".$orders_id ." and comments like '###%' ");
		$remark = str_replace('###','',$remark);
		$remark = stripslashes($remark);
		
		
        echo '<textarea name="add_remark" rows=3 cols=50>'. $remark . '</textarea><br><br>';
if ( $languages_id ==2 )		
{   
		   echo  'Bien cordialement,<br>
Han';
}
else
{   
		   echo  'Thanks and best regards,<br>
Han';
}

		$mail_html .= $html;
		
		if (strlen($remark)>0)
		{
			$mail_html .= '<br>'.$remark.'<br><br>';
		}

if ( $languages_id ==2 )		
{   
		   $mail_html .=  'Bien cordialement,<br>
Han';
}
else
{   
		   $mail_html .=  'Thanks and best regards,<br>
Han';
}
		
		if (strlen($_GET['confirm_send'])>0)
		{
		  $spam = new EMAIL;
		  $spam->set_email_language(2);  		   		   
		  
		  $spam->set_sender_name($easylamps_name,2);
		  $spam->set_sender_email_address($easylamps_email_address);
		  $spam->set_email_title($subject,2);
		  $spam->set_email_content($mail_html,2);

		  if ($_GET['confirm_send']=="Send to supplier")
		  {
			$spam->set_receiver_email_address($customers_email_address);
			$spam->send_email();			
			echo '<br><br><font color=red>Email sent to '.$customers_email_address.' </font><br>';			
			
			if ( strlen($customers_email_address2)>0 )
			{
				$spam->set_receiver_email_address($customers_email_address2);
				$spam->send_email();			
				echo '<br><br><font color=red>Email sent to '.$customers_email_address2.' </font><br>';			
			}

			if ( strlen($customers_email_address3)>0 )
			{
				$spam->set_receiver_email_address($customers_email_address3);
				$spam->send_email();			
				echo '<br><br><font color=red>Email sent to '.$customers_email_address3.' </font><br>';			
			}
			
		  }

		  $spam->set_receiver_email_address($easylamps_email_address);
		  $spam->send_email();
		  echo '<font color=red>Email sent to '.$easylamps_email_address .' </font><br>';

		  $spam->set_receiver_email_address($easylamps_email_address2);
		  $spam->send_email();
		  echo '<font color=red>Email sent to '.$easylamps_email_address2 .' </font><br>';
		  		  
				  
		  		  
//echo "aaa";exit;		  
          $dml = "update orders set orders_status=1, due_date='". $_GET['due_date']."'  where orders_id = ". $orders_id ;
		  $db->Execute ($dml);
		  
		  $dml = "delete from  orders_products where po_status='stand_by' and orders_id = ". $orders_id ;
		  $db->Execute ($dml);
		  
	//	  recalc_total($orders_id );
		  

		}
			  if ( ($_GET['confirm_send']!="Send to supplier")
			       && ($_GET['confirm_send']!="Send to Han") )
			  {
				
					echo "<hr>";
					
					echo '<tr>';
					echo '<td colspan=2></td>';
					echo '<td colspan=2 align=right>';
					echo '<input type=submit name="confirm_send" value="Send to supplier">';
					echo "&nbsp;&nbsp;&nbsp;";
					echo '<input type=submit name="confirm_send" value="Send to Han">';
					echo '</td>';
					echo '</tr>';
			}
		   else
		   {
			 echo '<a href="javascript:window.close()">[ Close [x] ]</a>';
		   }
	
//echo 	$mail_html;
			  
		   echo '</td>';
		   echo '</tr>';		   
		   
		   echo '</table>';
		   
	   }
echo '</form>';
echo '</body>';
?>