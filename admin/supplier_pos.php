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

  
  if ($_POST['updating']=="1")
  {
	 if ( count($_POST['close_order'])>0 )
	 {
	   $inputs = str_replace ('
',',',$_POST['close_order']);

	   $ord_input=implode(",",$inputs);
	   
		$dml = "update orders set orders_status=14 where orders_id in (".$ord_input.")";
		$db->Execute($dml);		
		
		$ref_order = exec_select("select ref_info value from orders where  orders_id in (".$ord_input.")" );
		if (strlen($ref_order)>0)
		{
			$dml = "update el_pos set close_date=now() where pos_id=".$ref_order;
			$db->Execute($dml);				
		}
		
	 }
	 
	 
     if (count($_POST['validate_order'])>0)
	 {
	   $inputs = str_replace ('
',',',$_POST['validate_order']);
       $inputs_tab=explode(",",$inputs);
	   
	   $ord_input=implode(",",$inputs);
	   
	   $customers_id = exec_select ( "select customers_id value from orders where orders_id in (".$ord_input.")" );
	   
	   $dml = "insert into el_pos
			( customers_id , orders_status,
			 creation_date , due_date , close_date ) 
			values 
			(  ". $customers_id ." , orders_status,
			 now() , '". $_POST['due_date'] ."' , null ) 
			 ";
			 
		$db->Execute($dml);
		$po_id = mysql_insert_id();			

		$dml = "update orders set orders_status=10, due_date='".$_POST['due_date']."', ref_info='".$po_id."' where orders_id in (".$ord_input.") ";
		$db->Execute($dml);
		
		echo '<br><br>';
		echo "Le PO  a imprimer sur le carton est :  <br><br><br>
		      <hr>
			  ESY-PO-".$_GET['short_name']."-". $po_id ."<hr>";
			  
	    echo '<a href="supplier_pos.php?short_name='.$_GET['short_name'].'">Retour</a>';
		exit;
/*
	   for ($i=0;$i<count($inputs_tab);$i++)
	   {
	      stock_input( $inputs_tab[$i],$i ); 
	   }
*/	   
	 }
  
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
	else if(strlen($_POST['selected_item'])>0)
	{
//echo $_POST['external_stock'];exit;	
		echo '<html><body><script>top.document.location="el_stock_tags.php?stock_items='.implode(",", $_POST['selected_item']).'&external_stock='.$_POST['external_stock'].'";</script></body></html>';
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
		<title>Gestion des POs</title>
		<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
		</head>
		<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } ">';
		echo 'select supplier ';
		$sql = 'select short_name, customers_id  from customers order by 1';
		$rs = $db->Execute($sql);
		while ( !$rs->EOF)
		{
		   echo '<a href=supplier_pos.php?short_name='.$rs->fields['short_name'].'>'.$rs->fields['short_name']."(".$rs->fields['customers_id'].')</a>&nbsp;&nbsp;&nbsp;&nbsp;';
		   $rs->MoveNext();
		}		
		echo '<br>';

		echo '<hr>';
		
		echo  '<a href="supplier_pos.php"> Pending Orders </a>';
		
		echo '<hr>
		<form name="frm" method="post">';
		
		echo '<table>';
		
		
		$due_date = exec_select  ("select DATE_ADD(CURDATE(),INTERVAL 7 DAY) value");
				
		if (strlen(strlen($_GET['short_name'])==0))
		{
			$sql = "select address_book.entry_company,count(orders_products.products_quantity) cnt,orders.customers_id
					from orders, orders_products, customers,address_book
					where orders_status not in (13,14,15,16,17,18)
					and orders.customers_id = customers.customers_id
					and orders_products.orders_id = orders.orders_id
					and orders.database_code='po'
					and address_book.address_book_id = customers.customers_default_address_id
					group by address_book.entry_company,orders.customers_id
					order by count(orders_products.products_quantity) desc ";
					
			$rs = $db->Execute($sql); 
			
			echo '<table>';
			echo '<tr>';
			echo '<th align=left>Supplier</th>';
			echo '<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>';			
			echo '<th>Cnts open</th>';
			echo '<th>Late</th>';
			echo '</tr>';			
			
			while(!$rs->EOF)
			{
				echo '<tr>';
				echo '<td>'. $rs->fields['entry_company'].'</td>';
				echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
				
				echo '<td td align=center>'. $rs->fields['cnt'].'</td>';
				

				$sql = "select count(orders_products.products_quantity) value
					from orders, orders_products, customers
					where orders_status not in (13,14,15,16,17,18)
					and customers.customers_id = '". $rs->fields['customers_id'] ."'
					and orders.customers_id = customers.customers_id
					and orders_products.orders_id = orders.orders_id
					and orders.database_code='po'
					and due_date < DATE_ADD(CURDATE(),INTERVAL -15 DAY) 
					group by customers.customers_id";
			    
				$late = exec_select ( $sql );
				
				echo '<td align=center bgcolor=#fbe8e5>'. $late .'</td>';
				echo '</tr>';				
				$rs->MoveNext();
			}
			echo '</table>';			

			echo '<hr>';
			
			
		    $sql = "select products_name, products_quantity, products_model, 
					   address_book.entry_company,orders_status.orders_status_name,  final_price,date_purchased
			from orders, orders_products, customers,orders_status,address_book
			where orders.orders_status  in (15,16,17,18)
			and orders_status.language_id=2
			and   orders_status.orders_status_id = orders.orders_status
			and orders.customers_id = customers.customers_id
			and orders_products.orders_id = orders.orders_id
			and orders.database_code='po'
			and date_purchased < DATE_ADD(CURDATE(),INTERVAL 15 DAY) 
			and address_book.address_book_id = customers.customers_default_address_id
			order by date_purchased desc ";

			$rs=$db->Execute($sql);

			echo '<table>';
			echo '<tr>';
			echo '<th>Created on</td>';											
			echo '<th>Supplier</td>';								
			echo '<th>Status</td>';				
			echo '<th>Qty</td>';				
			echo '<th>Product</td>';
			echo '<th>Price</td>';
			echo '</tr>';			
			
			while(!$rs->EOF)
			{
				echo '<tr>';
			    echo '<td  align=left>'. $rs->fields['date_purchased'].'&nbsp;&nbsp;&nbsp;</td>';												
			    echo '<td  align=left>'. $rs->fields['entry_company'].'</td>';								
			    echo '<td  align=center bgcolor=eae5e4>'. $rs->fields['orders_status_name'].'</td>';				
				echo '<td  align=center>'. $rs->fields['products_quantity'].'</td>';				
				echo '<td  align=left>'. $rs->fields['products_model'].' | ' . $rs->fields['products_name'] .'</td>';
				echo '<td align=center bgcolor=#fbe8e5>'. round($rs->fields['final_price']) .'</td>';
				// javascript:popupWindow('http://127.0.0.1/sites/zencart_gl/admin/super_edit.php?oID=38509&target=edit_product&orders_products_id=66559', 'scrollbars=yes,resizable=yes,width=400,height=400,screenX=150,screenY=300,top=100,left=150')
				echo '</tr>';				
				$rs->MoveNext();
			}
			echo '</table>';			
			
		}
        else if (strlen($_GET['short_name'])>0)
		{
			echo 	'Validation due Date <input type="text" size=10 name="due_date" value="'.$due_date.'">'; 	
			echo 	'	<input type="submit" value="Valider">';
			echo 	'<input type="hidden" value="1" name="updating">
			<input type="hidden" value="'.$_GET['short_name'].'" name="short_name">';		
		
			$sql = "select op.orders_id, 
					op.orders_products_id, 
					op.products_quantity, 
					op.products_name,
					op.products_model,
					op.printed,
					 date_format( date_purchased , \"%d/%c/%Y\" )  date_purchased,
					o.ref_info,
					o.orders_status,
					o.due_date
					from orders o, orders_products op
					where o.orders_id = op.orders_id
					and o.database_code ='po'
					and  op.products_model not in ('SHF', 'ECOF')
					and o.customers_id in ( select customers_id from customers where short_name = '". $_GET['short_name']."' )				
					order by op.orders_id desc 
					limit 0,550";
					
//echo $sql;exit;		

			
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
					echo '<td>&nbsp; #'. $rs->fields['orders_id'] .' &nbsp; </td>';
				}
				else
				{
					echo '<td>&nbsp;&nbsp; </td>';
				}
				
				
				if  ( ( $new_order ) && (  ($orders_status==13) || ($orders_status==14)  ) )
				{
				   $closed=1;	
				   if (strlen($ref_info)>0)
				   {
					   $close_date = exec_select ("select close_date value from el_pos where pos_id=". $ref_info );
					   echo "<td bgcolor=c2f8dc>
					   Closed on ".$close_date."</td>";					   
				   }
				   else
				   {
					   echo "<td bgcolor=c2f8dc>Closed </td>";					   
				   }
				   if ( $due_date != "0000-00-00" )
						echo "<td bgcolor=c2f8dc>
					   Due on ".$due_date."</td>";
				   else
						echo "<td bgcolor=c2f8dc> Due </td>";
				   
				   
				}
 				else if ( ( $new_order ) && ( strlen($ref_info)>0 ) )
				{						
					echo '<td bgcolor=c2f8dc> Close <input type="checkbox"  name="close_order[]" value="'.$rs->fields['orders_id'].'"></td>';
					
				    if ( $due_date != "0000-00-00" )
						echo "<td bgcolor=c2f8dc>
					   Due on ".$due_date."</td>";
				    else
						echo "<td bgcolor=c2f8dc>
					   Due </td>";
					
				}
				else if ( $new_order )
				{
					echo '<td bgcolor=c2f8dc> Validate <input type="checkbox"  name="validate_order[]" value="'.$rs->fields['orders_id'].'"></td>';
					echo '<td bgcolor=c2f8dc>Close <input type="checkbox"  name="close_order[]" value="'.$rs->fields['orders_id'].'"</td>';
				}
				else
				{
					echo '<td>&nbsp;</td>';
					echo '<td>&nbsp;</td>';
				}
				
				echo '<td>'.$rs->fields['date_purchased']. '</td>';

				$in_stock = stock_items_lookup ($rs->fields['orders_products_id']);
				if ( ( $in_stock <> $rs->fields['products_quantity'] ) && ( $in_stock <> 0  ) )
				{
					$bgcolor="bgcolor=#fbe8e5";
				}
//echo 'in stock'. $in_stock . '  | '; 				
				// 
//				if ( 

				echo '<td '. $bgcolor . '>&nbsp;&nbsp;&nbsp;<b>'. $in_stock. '|'. $rs->fields['products_quantity']. '</b> *'. $rs->fields['products_model']. ' (' .$rs->fields['products_name']. ') </td>';


//				echo '<td><input type="checkbox" '. $checked .' name="selected_item[]" value="'.$rs->fields['products_quantity'].'|'.$rs->fields['orders_products_id'].'"></td>';
//				echo '<td><input type="checkbox"  name="selected_item[]" value="'.$rs->fields['products_quantity'].'|'.$rs->fields['orders_products_id'].'"></td>';
//				echo '<td><input type="radio"  name="selected_item_avec_validation[]" value="'.$rs->fields['products_quantity'].'|'.$rs->fields['orders_products_id'].'"></td>';

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
		  echo '<tr><td>Codes Stock Outputs  <b>SORTIES DE STOCK</b></td></tr>';
		  echo '<tr><td><textarea rows=10 cols=13 name=output_codes>'. $_POST['output_codes'] . '</textarea></td></tr>';
	    }
		else if ($_GET['stock_info']==1)
		{
		  echo '<tr><td>Codes pour informations Stock  <b>INFORMATIONS DE STOCK</b></td></tr>';
		  echo '<tr><td><textarea rows=10 cols=13 name=stock_info>'. $_POST['stock_info'] . '</textarea></td></tr>';
	    }
		
		echo '</table>';
?>
<!-- body_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>