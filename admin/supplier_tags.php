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

  require('includes/application_top.php');
  require('el_fonctions_gestion.php');  
  require('../el_admin/el_functions.php');
  $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  

//http://127.0.0.1/sites/zencart_gl/admin/supplier_tags.php?short_name=APO&customers_id=4&part_ref=99&products_model=LMP99&prd_type=O&orders_status=15&qty=1
if  (   ( strlen($_GET['customers_id'])>0 )
      && ( strlen($_GET['products_model'])>0 )
      && ( strlen($_GET['orders_status'])>0 )
      && ( strlen($_GET['qty'])>0 ) )
	{
		$dml = "insert into orders 
				( customers_id, orders_status,date_purchased,
					due_date, database_code )
				values 
				( ". $_GET['customers_id'] .",".$_GET['orders_status'].", now(),
				   now(), 'po'	)";
				   
		$db->Execute($dml);		
		$orders_id = mysql_insert_id();			
		
		$dml = "insert into 
		orders_products 
		( products_model, products_name, products_quantity,
		  final_price, orders_id, products_tax )
		 values ( '".$_GET['products_model']."','".$_GET['products_model']."','".$_GET['qty']."',
				 '0', ". $orders_id ." , 0 )";
									 
		$db->Execute($dml);

	}	  
   ///  
   for ($i=0;$i<count($_POST['selected_item2']);$i++)
   {
	  if (strpos($_POST['selected_item2'][$i],'|')>0)
	  {
//		 echo $_POST['selected_item2'][$i].'<br>';
		 $selected_items[]=$_POST['selected_item2'][$i];
	  }
   }
   
   for ($i=0;$i<count($_POST['selected_item']);$i++)
   {
	  if (strpos($_POST['selected_item'][$i],'|')>0)
	  {
//		 echo $_POST['selected_item'][$i].'<br>';
		 $selected_items[]=$_POST['selected_item'][$i];
	  }
   }

//  echo    implode(",",$selected_items);exit;
  if ($_POST['updating']=="1")
  {
//	 echo implode(",", $_POST['selected_item']);
	 // création des tags
	 // on fait un redirect vers le module d'impression
	 
     if ( strlen($_POST['input_codes'])	> 0 )
	 {
	   $inputs = str_replace ('
',',',$_POST['input_codes']);
       $inputs_tab=explode(",",$inputs);
       

	   for ($i=0;$i<count($inputs_tab);$i++)
	   {
	      stock_input( $inputs_tab[$i],$i ); 
	   }
	}
	else if   ( strlen($_POST['re_input_codes']) > 0 )
	{
	   $inputs = str_replace ('
',',',$_POST['re_input_codes']);
       $inputs_tab=explode(",",$inputs);
       

	   for ($i=0;$i<count($inputs_tab);$i++)
	   {
	      stock_input( $inputs_tab[$i],$i, 0, 1 ); 
	   }
	}
	else if   ( strlen($_POST['stock_info']) > 0 )
	{
	   $inputs = str_replace ('
',',',$_POST['stock_info']);
       $inputs_tab=explode(",",$inputs);
       

	   for ($i=0;$i<count($inputs_tab);$i++)
	   {
	      stock_info( $inputs_tab[$i],$i ); 
	   }
	}
    else if ( strlen($_POST['output_codes'])	> 0 )
	 {
	   $outputs = str_replace ('
',',',$_POST['output_codes']);
       $outputs_tab=explode(",",$outputs);
       

	   for ($i=0;$i<count($outputs_tab);$i++)
	   {
	      stock_output( $outputs_tab[$i],$i ); 
	   }
	}	
	else if(strlen($selected_items)>0)
	{
		echo '<html><body><script>top.document.location="el_stock_tags.php?stock_items='.implode(",", $selected_items).'&external_stock='.$_POST['external_stock'].'";</script></body></html>';
	}	
	else if(strlen($_POST['selected_item_avec_validation'])>0)
	{
		echo '<html><body><script>top.document.location="el_stock_tags.php?stock_items='.implode(",", $_POST['selected_item_avec_validation']).'&valide_auto=1&external_stock='.$_POST['external_stock'].'";</script></body></html>';
	}
	
  }
    	echo '
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Gestion des étiquettes stock</title>
		<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
		</head>
		<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } ">
		<form name="frm" method="post">';
		
		echo '<a href="supplier_tags.php?short_name=open"> View open orders </a><hr>';
		echo 'select supplier ';
		$sql = 'select short_name, customers_id  from customers order by 1';
		$rs = $db->Execute($sql);
		while ( !$rs->EOF)
		{
		   echo '<a href=supplier_tags.php?short_name='.$rs->fields['short_name'].'>'.$rs->fields['short_name']."(".$rs->fields['customers_id'].')</a>&nbsp;&nbsp;&nbsp;&nbsp;';
		   $rs->MoveNext();
		}		
		echo '<hr>';
	    echo '<a href=supplier_tags.php?input_stock=1>Stock entry</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

	    echo '<a href=supplier_tags.php?output_stock=1>Stock output</a>&nbsp;&nbsp;&nbsp;&nbsp;';
		
	    echo '<a href=supplier_tags.php?input_stock=2>Stock re-entry</a>&nbsp;&nbsp;&nbsp;&nbsp;';

	    echo '<a href=supplier_tags.php?stock_info=1>Stock info</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

	    echo '<a href=supplier_tags.php?output_stock=1&delete=1>Suppression</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		
		echo '<table>';
		
		echo '<hr>';
		
if (strlen($_GET['short_name'])>0)
{
		echo 'Consignement STOCK <input type=checkbox value=1 name=external_stock>';
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
}		
echo 	'	<input type="submit" value="Valider">';
if (strlen($_GET['short_name'])>0)
{
	echo '<hr>Demande une validation CODE BARRE pour entrée en stock 
		<br><br><hr>';		
}		
		echo 	'<input type="hidden" value="1" name="updating">
		<input type="hidden" value="'.$_GET['short_name'].'" name="short_name">';
		
        if (strlen($_GET['short_name'])>0)
		{
		    if ( 
				 (strlen($_GET['part_ref'])>0)
				 &&
				 (strlen($_GET['products_model'])==0)
				)
			{
				$add_where = " and 0=1 ";
			}
			
			if ( $_GET['short_name']=="open")
			{
				// 
				$add_where = "and o.orders_status not in (13,14,15,16,17,18) ";							
			}
			else
			{
				$add_where = "and o.customers_id in ( select customers_id from customers where short_name = '". $_GET['short_name']."' )";										
			}
			
			$sql = "select op.orders_id, 
					op.orders_products_id, 
					op.products_quantity, 
					op.products_name,
					op.products_model,
					op.printed,
					 date_format( date_purchased , \"%d/%c/%Y\" )  date_purchased,
					o.ref_info,
					o.orders_status,
					o.due_date,
					address_book.entry_company
					from orders o, orders_products op,customers,address_book
					where o.orders_id = op.orders_id
					".$add_where."
					and o.database_code ='po'
					and  op.products_model <> 'SHF'
					and o.customers_id = customers.customers_id
					and address_book.address_book_id = customers.customers_default_address_id					
					order by op.orders_id desc
					limit 0,800";

            $customers_id = exec_select ("select customers_id value from customers where short_name = '". $_GET['short_name']."' ");					
			
			$rs = $db->Execute($sql);
			$current_order = 0;
			while(!$rs->EOF)
			{
			    
		//		echo $rs->fields['el_stock_item_id'];
				if ( $rs->fields['printed'] == 0 )
				{
					$checked = "CHECKED";
                    $bgcolor = "white";					
				}
				else
				{
					$checked = "UNCHECKED";
                    $bgcolor = "#bcc0c1";
					
				}
				if ( $rs->fields['orders_id'] != $current_order )
				{
					echo '<tr>   <td colspan=10> <hr> </td>  </tr>';
					$current_order = $rs->fields['orders_id'];
					$new_order = 1;
					$closed=0;					
				}
				else
				{
					$new_order = 0;				
				}
				
				echo '<tr bgcolor='. $bgcolor . '>';
				
				$ref_info=$rs->fields['ref_info'];
				$orders_status=$rs->fields['orders_status'];
				$due_date=$rs->fields['due_date'];
				
				if ( $new_order )
				{				
					echo '<td>'. $rs->fields['entry_company'] .'<br>&nbsp; #'. $rs->fields['orders_id'] .' &nbsp; </td>';
				}
				else
				{
					echo '<td>&nbsp;&nbsp; </td>';
				}				
				
				//    ----
				if  ( ( $new_order ) && (  ($orders_status==13) || ($orders_status==14)  ) )
				{
				   $closed=1;									
				   if  (strlen($ref_info)>0)
				   {
					   $close_date = exec_select ("select close_date value from el_pos where pos_id=". $ref_info );
					   echo "<td bgcolor=f4f3f3>Closed on ".$close_date."</td>";
				   }
				   else
				   {
					   echo "<td bgcolor=f4f3f3>Closed </td>";
				   }				   
				   
				}
				else if  ( $orders_status>=15  )
				{
				   if ( ( $orders_status==15 ) || ( $orders_status==17 ) )
						$closed=0;													   
					else
						$closed=1;									
						
					
				   if  ( ( $orders_status==15 ) || ( $orders_status==16 ) )
				   {
					   echo "<td bgcolor=f4f3f3>RMA</td>";
				   }
				   else  if ( ( $orders_status==17 ) || ( $orders_status==18 ) )
				   {
					   echo "<td bgcolor=f4f3f3>Reliquat </td>";
				   }				   
				}				
 				else if ( ( $new_order ) && ( strlen($ref_info)>0 ) )
				{						
				   $due_date = exec_select ("select due_date value from el_pos where pos_id=". $ref_info );				     
				   echo '<td bgcolor=f4f3f3>ESY-PO-'.$_GET['short_name'].'-'. $ref_info.' <br>Due on:'.  $due_date .'</td>';				
				}
				else if ( $new_order )
				{
				   if ( $due_date <> '0000-00-00' )
				   {
					  echo '<td>Due on:'.  $due_date .'</td>';				
				   }
				   else
				   {
					  echo '<td>&nbsp;</td>';				
				   }				   
				}
				else
				{
					echo '<td>&nbsp;</td>';
				}								
				
				echo '<td>'.$rs->fields['date_purchased']. '</td>';
// fvv
				$in_stock = stock_items_lookup ($rs->fields['orders_products_id']);
				if ( ( $in_stock <> $rs->fields['products_quantity'] ) && ( $in_stock <> 0  ) )
				{
					$bgcolor="bgcolor=#fbe8e5";
				}
//echo 'in stock'. $in_stock . '  | '; 				
				// 
//				if ( 

				echo '<td '. $bgcolor . '>&nbsp;&nbsp;&nbsp;<b>'. $in_stock. '|'. $rs->fields['products_quantity']. '</b> * '. $rs->fields['products_model']. ' (' .$rs->fields['products_name']. ') </td>';


//				echo '<td><input type="checkbox" '. $checked .' name="selected_item[]" value="'.$rs->fields['products_quantity'].'|'.$rs->fields['orders_products_id'].'"></td>';
				if (!$closed)
				{
					echo '<td>'.$rs->fields['products_quantity'].'<input type="checkbox"  name="selected_item[]" value="'.$rs->fields['products_quantity'].'|'.$rs->fields['orders_products_id'].'"></td>';
//					echo '<td><input type="radio"  name="selected_item_avec_validation[]" value="'.$rs->fields['products_quantity'].'|'.$rs->fields['orders_products_id'].'"></td>';
					if ( ($rs->fields['products_quantity']-$in_stock)>0)
					{
						echo '<td>
								<select  name="selected_item2[]">
								 <option></option>';
								 
					   for ($i=1;$i<=$rs->fields['products_quantity']-$in_stock;$i++)
					   {
						  echo 			'<option value='.$i.'|'.$rs->fields['orders_products_id'].'>'.$i.'</option>';
					   }
								 
						echo '</select>
							  </td>';
					}
					else
					{
						echo '<td>&nbsp;</td>';
					}
//					value="'.$i.'|'.$rs->fields['orders_products_id'].'"></td>';
				}
				else
				{
					echo '<td>&nbsp;</td>';
					echo '<td>&nbsp;</td>';
				}
				
				echo '</tr>';
				$rs->MoveNext();
			}
		}
		else if ($_GET['input_stock']==1)
		{
		  echo '<tr><td>Codes Stock Inputs  <b>ENTREES DE STOCK</b></td></tr>';
		  echo '<tr><td><textarea rows=10 cols=13 name=input_codes>'. $_POST['input_codes'] . '</textarea></td></tr>';
	    }
		else if ($_GET['input_stock']==2)
		{
		  echo '<tr><td>Codes Stock Inputs  <b>RE-ENTREES DE STOCK</b></td></tr>';
		  echo '<tr><td><textarea rows=10 cols=13 name=re_input_codes>'. $_POST['input_codes'] . '</textarea></td></tr>';
	    }		
		else if ($_GET['output_stock']==1)
		{
		  if ( $_GET['delete']==1 )
		  {
			echo '<tr><td>Codes Stock Outputs  <b>SUPPRESSION DE STOCK</b></td></tr>';		  		  
		  }
		  else
		  {
			echo '<tr><td>Codes Stock Outputs  <b>SORTIES DE STOCK</b></td></tr>';		  
		  }
		  echo '<tr><td><textarea rows=10 cols=13 name=output_codes>'. $_POST['output_codes'] . '</textarea></td></tr>';
	    }
		else if ($_GET['stock_info']==1)
		{
		  echo '<tr><td>Codes pour informations Stock  <b>INFORMATIONS DE STOCK</b></td></tr>';
		  echo '<tr><td><textarea rows=10 cols=13 name=stock_info>'. $_POST['stock_info'] . '</textarea></td></tr>';
	    }
		echo '</table>';
		echo '</form>';

		if ( 
		      (strlen($_GET['short_name'])>0)
			  && ($_GET['short_name']!="open" )
			  )
		{
		
			// affichage des produits --------------------------------------------------------
		   echo '<hr>';	   
		   $source_catalog = "eu";
		   
		   echo '<form name=frm2 method=get>';
		   echo '<input type=hidden  name=short_name  value='.$_GET['short_name'].' >';	   
		   echo '<input type=hidden  name=customers_id  value='.$customers_id.' >';	   
		   
		   echo '<table>';		
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
			   $sql = "select distinct products_name value, products_name description 
					  from rv_lampe_eu.products_description
					  where length(products_name)>0
					  and products_name like '%". $_GET['part_ref'] ."%' 
					  order by 1";			   
		   }
//echo $sql;			   
		   
		   $rs = $db->Execute($sql);
		   while (!$rs->EOF)
		   {  
			  echo '<option value="'.$rs->fields['value'].'">'.$rs->fields['description'];
			  $rs->MoveNext();
		   }
		   echo '</select>';
		   
		echo '</td>';
		echo '</td>';		
		echo '</tr>';
		echo '<tr>';
		echo '<td colspan=10>';
		echo '&nbsp;&nbsp;';
		echo '<br><br>'
		;
		echo '<table>
		      <tr>
			  <td>Status</td> ';
		echo '<td>Rma <input type=radio CHECKED name=orders_status value="15"> 
		          <br><br>
			  	Reliquat<input type=radio name=orders_status value="17"></td>
			   <td> &nbsp;&nbsp;Qty<input type=text name=qty value=1>
			  </td>';

		echo '<td>&nbsp;&nbsp;';
		echo '<input type=submit value="Créer le produit">';
		echo '</td>';
		echo '</tr>';
		echo '</table>';
		   
		echo '</form>';
		
		echo '<hr>';	 		
	}
?>
<!-- body_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>