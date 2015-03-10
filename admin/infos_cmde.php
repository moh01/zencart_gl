<?php

  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
  
// $bds = array("eu","fr","es","de","en","it","bf");
 $bds = array("eu","fr","es","de","en","it","bf");
// $bds = array("fr","eu");
 
 $cnt = 0;
 
  
function get_order_header ( $source_db, $orders_id )
{
  global $ext_db_name;
  global $ext_db_server;
  global $ext_db_password;
  global $ext_db_database;
  global $ext_db_username;
  
  global $db;

  /*
  $response = '<table  border=1>
        <tr>
		  <th bgcolor=#dbdef1>#</th>		
		  <th bgcolor=#dbdef1>Site</th>			  
		  <th bgcolor=#dbdef1>ID - Organisation</th>
		  <th bgcolor=#dbdef1>Qui ? Ou ?</th>
		  <th align=center bgcolor=#dbdef1>En cours Client</th>
		  <th align=center bgcolor=#dbdef1>En cours Autorisé</th>
		  <th align=center bgcolor=#dbdef1>Code paiement</th>		  
        </tr>';		
		echo '
        <tr>
		  <td>8998</td>		
		  <td>LVP</td>			  
		  <td>Ecole Jean VALGEAN</td>
		  <td>Louis Sans Peur</td>
		  <td>580</td>
		  <td>8997</td>
        </tr>	*/
  if ($source_db=="eu")
  {
		
		 $db->connect($ext_db_server[$source_db], $ext_db_username[$source_db], $ext_db_password[$source_db], $ext_db_database[$source_db], USE_PCONNECT, false);  
        $sql = "select customers_company, customers_name,  customers_telephone, 
		               customers_country, customers_id,payment_module_code
		        from orders	 where  orders_id = ". $orders_id;
				

//  echo $ext_db_server[$source_db].'/'. $ext_db_username[$source_db] .'/'. $ext_db_password[$source_db]. '/'. $ext_db_database[$source_db].'|'.  $sql;
		 
		$rs=$db->Execute($sql);
		$customers_company = $rs->fields['customers_company'];
		$customers_name = $rs->fields['customers_name'];
		$customers_telephone = $rs->fields['customers_telephone'];
		$customers_country = $rs->fields['customers_country'];
		$customers_id = $rs->fields['customers_id'];
		$payment_module_code = $rs->fields['payment_module_code'];
		
 	  $sql = "select max_credit from customers where customers_id = ".$customers_id;
	  $rs = $db->Execute($sql);
	//if ( $rs->fields['en_cours']>0 )
	  $max_credit='<B>En cours autorisé:</b>&nbsp;&nbsp;€ '.$rs->fields['max_credit'];     
      $cname = $rs->fields['customers_company'].'-'. $rs->fields['customers_name'];
	$db->connect($ext_db_server["gl"], $ext_db_username["gl"], $ext_db_password["gl"], $ext_db_database["gl"], USE_PCONNECT, false);  

	$sql = "SELECT sum(order_total) en_cours
		 FROM     orders
		 WHERE    orders_status=2 
		 and      customers_id = ". $customers_id;
		 
	$rs = $db->Execute($sql);
	
//	if ( $rs->fields['en_cours']>0 )
		$en_cours = '<B>En cours:</b>&nbsp;&nbsp; € '. $rs->fields['en_cours'];
	
	    return '<b><u>'. $orders_id .'</u></b> &nbsp;&nbsp;&nbsp; <b>Entreprise:</b> '. $customers_company.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $max_credit . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $en_cours;
  }
  else
  {
     return '';
  }
/*	
	  if ( $payment_module_code=='authorizenet')
	  {
	     if (  $source_db == "eu" )
		 {
		    $payment_module_code = "CHK VIR 30JN";
		 }
		 else
		 {
		    $payment_module_code = "cheque";		    
		 }		 
	  } 
   echo '<b> </b>'.	  
	$response .= '<tr>
		  <td bgcolor=#dbdef1>'.$orders_id.'</td>		
		  <td bgcolor=#dbdef1>'. $ext_db_name[$source_db] .'</td>			  
		  <td bgcolor=#dbdef1>'. $customers_id.' <br> '. $customers_company .'</td>
		  <td bgcolor=#dbdef1> '. $customers_name .' <br> '. $customers_telephone . ' <br> '. $customers_country .' </td>
		  <td align=center bgcolor=#dbdef1>'. $en_cours .'</td>
		  <td align=center bgcolor=#dbdef1>'.  $max_credit .'</td>
		  <td align=center bgcolor=#dbdef1>'.  $payment_module_code .'</td>		  
        </tr>';

  }
		 
	$response .=  '</table>';
	return $response;

	  */
}
function get_order_footer ( $source_db, $orders_id, $hide_footer )
{
  global $ext_db_name;
  global $ext_db_server;
  global $ext_db_password;
  global $ext_db_database;
  global $ext_db_username;
  
  global $db;

  if ($hide_footer==0)
  {
		
  	    $db->connect($ext_db_server[$source_db], $ext_db_username[$source_db], $ext_db_password[$source_db], $ext_db_database[$source_db], USE_PCONNECT, false);  
        $sql = "select *
		        from orders	 where  orders_id = ". $orders_id;
				

//  echo $ext_db_server[$source_db].'/'. $ext_db_username[$source_db] .'/'. $ext_db_password[$source_db]. '/'. $ext_db_database[$source_db].'|'.  $sql;
		 
		$rs=$db->Execute($sql);

	    $retour = '<font size=0.5>';
		$retour .= '<br><br><b>Code paiement:</b> '. $rs->fields['payment_module_code'];		
		$retour .= '<br><br><b>Adresse Facturation:</b> '. $rs->fields['billing_company'].'&nbsp;-&nbsp;'.$rs->fields['billing_name'].'&nbsp;-&nbsp;' .$rs->fields['billing_street_address'].'&nbsp;-&nbsp;' .$rs->fields['billing_suburb'].'&nbsp;-&nbsp;'. $rs->fields['billing_postcode'].'&nbsp;-&nbsp;'. $rs->fields['billing_city'].'&nbsp;-&nbsp;'. $rs->fields['billing_country'] ;		
	    $retour .= '<br><br><b>Adresse Livraison:</b> '. $rs->fields['delivery_company'].'&nbsp;-&nbsp;'.$rs->fields['delivery_name'].'&nbsp;-&nbsp;' .$rs->fields['delivery_street_address'].'&nbsp;-&nbsp;' .$rs->fields['delivery_suburb'].'&nbsp;-&nbsp;'. $rs->fields['delivery_postcode'].'&nbsp;-&nbsp;'. $rs->fields['delivery_city'].'&nbsp;-&nbsp;'. $rs->fields['delivery_country'] ;		
		$retour .= '</font>';
		
		return $retour;
  }
  else
  {
     return '';
  }
/*	
	  if ( $payment_module_code=='authorizenet')
	  {
	     if (  $source_db == "eu" )
		 {
		    $payment_module_code = "CHK VIR 30JN";
		 }
		 else
		 {
		    $payment_module_code = "cheque";		    
		 }		 
	  } 
   echo '<b> </b>'.	  
	$response .= '<tr>
		  <td bgcolor=#dbdef1>'.$orders_id.'</td>		
		  <td bgcolor=#dbdef1>'. $ext_db_name[$source_db] .'</td>			  
		  <td bgcolor=#dbdef1>'. $customers_id.' <br> '. $customers_company .'</td>
		  <td bgcolor=#dbdef1> '. $customers_name .' <br> '. $customers_telephone . ' <br> '. $customers_country .' </td>
		  <td align=center bgcolor=#dbdef1>'. $en_cours .'</td>
		  <td align=center bgcolor=#dbdef1>'.  $max_credit .'</td>
		  <td align=center bgcolor=#dbdef1>'.  $payment_module_code .'</td>		  
        </tr>';

  }
		 
	$response .=  '</table>';
	return $response;

	  */
}

function get_product_detail ( $source_db, $manufacturer, $products_model, $original_code, 
                              $products_quantity, $final_price, $products_name )
{
  global $ext_db_name;
  global $ext_db_server;
  global $ext_db_password;
  global $ext_db_database;
  global $ext_db_username;
  
  global $db;
  
  
  if  (substr($products_model,0,3)!="BCEL-")
  {
      $add_where = " and products_name  not like 'BCEL%' "; 
  }

	if ( $source_db == "bf")
	{
		$db->connect($ext_db_server["bf"], $ext_db_username["bf"], $ext_db_password["bf"], $ext_db_database["bf"], USE_PCONNECT, false);  
//echo 'uuuuu'.$ext_db_database.'jjjjj';	
	}
	else
	{
		$db->connect($ext_db_server["eu"], $ext_db_username["eu"], $ext_db_password["eu"], $ext_db_database["eu"], USE_PCONNECT, false);  
	}

  $sql = "select lamp_code, avg(qty) qty
		  from products_description LEFT OUTER JOIN el_stock 
		  ON lamp_code = products_name, products
		  where products.products_id = products_description.products_id
		  and length(lamp_code)>0
		  and products_name like '%". $original_code . "' ". $add_where . "
		  group by lamp_code";
		  

   $rs = $db->Execute($sql);
   while (!$rs->EOF)
   {
      $lamp_code = $rs->fields['lamp_code'];
//echo $lamp_code.$source_db.$sql;exit;
	  
		if ( $source_db == "bf")
		{
			$sql2 = "select value from pcp_eu.el_products_techdata 
					 where datatype_code = 'code'
					 and  lamp_code = '".$lamp_code."'";
			$rs2 = $db->Execute($sql2);
			$bnd_code=$rs2->fields['value'];
			if (strlen($bnd_code)>0)
			{
				$bnd_code = '<br>'.$bnd_code;
			}
		}
	  
	  $qty = $rs->fields['qty'];
	  if ( $qty==0 )
	  {
		$qty ="";
	  }
      if ( $products_model == $lamp_code)
	  {
	     $prd_quantity = $products_quantity ;
	     $prd_name = $products_name;
	     $prd_price = round($final_price,0);
		 $bgcolor='bgcolor=#dbdef1';
	  }
	  else
	  {
	     $prd_quantity = "" ;
	     $prd_name = "";
	     $prd_price = "";
		 $bgcolor='bgcolor=#fbfbef';
	  }
	  
	  $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  
	  
	  // prix d'achat 
	  $sql = "select orders_products.final_price po_price, orders.currency, orders_products.usd_euro_rate,orders.payment_module_code
			from orders, orders_products
			where orders.orders_id = orders_products.orders_id 
			and  orders_products.products_model = '".$lamp_code."'
            and  database_code = 'po'
			order by orders.orders_id desc ";
			
			
	  $rs2=$db->Execute($sql);
	  $po_price = $rs2->fields['po_price'];
	  $rate = $rs2->fields['usd_euro_rate'];
	  $payment_module_code = $rs2->fields['payment_module_code'];
	  
	  if  ( ($rs2->fields['currency']=='USD') 
	         &&
			 ($rate > 0)
	       )
	  {
		  $po_price =$po_price/$rate;
	  }
	  if ($po_price==0)
		$po_price = "";
	  else
		$po_price = round($po_price,0);
      
	  
	  //qté en appro
	  $sql="select sum(products_quantity) qty
			from orders, orders_products
			where orders.orders_id = orders_products.orders_id 
			and  orders_products.products_model = '".$lamp_code."'
            and  database_code = 'po'
			and orders.customers_id not in (29,28)						
			and orders_status = 1 ";
	  $rs2=$db->Execute($sql);
	  $appro_qty = $rs2->fields['qty'];

	  //qté en vente
	  
	  $sql="select sum(products_quantity) qty
			from orders, orders_products
			where orders.orders_id = orders_products.orders_id 
			and  orders_products.products_model = '".$lamp_code."'
            and  database_code <> 'po'
			and orders_status = 1 ";

//echo $sql.'<br>';
			
	  $rs2=$db->Execute($sql);
	  $sold_qty = $rs2->fields['qty'];
	  
  	  $db->connect($ext_db_server["gl"], $ext_db_username["gl"], $ext_db_password["gl"], $ext_db_database["gl"], USE_PCONNECT, false);  

	  // les informations RMA
	  $sql = "
		SELECT sum(products_quantity) qty
		FROM orders_products 
		WHERE products_model = '". $lamp_code ."'";

	  $rs2=$db->Execute($sql);
	  $qty_sold = $rs2->fields['qty'];

	  $sql = "
		SELECT count(1) qty
		FROM el_ticket_note
		WHERE text_fr like '%". $lamp_code ."%'";

	  $rs2=$db->Execute($sql);		
	  $qty_rma = $rs2->fields['qty'];

	  $info_rma = $qty_rma . ' / '. $qty_sold;
	  
	  $response .=
	         '<tr style="font-size:xx-small">
			  <td '. $bgcolor .' align=center><font size=0.5>'.$prd_quantity.'</font></td>		
			  <td '. $bgcolor .'><font size=0.5>'.$lamp_code.$bnd_code.'</font></td>				  
			  <td '. $bgcolor .'><font size=0.5>'.$prd_name.'</font></td>				  		  
			  <td '. $bgcolor .' align=center><font size=0.5>'.$prd_price .'</font></td>				  
			  <td '. $bgcolor .' align=center><font size=0.5>'. $po_price .'</font></td>			  
			  <td '. $bgcolor .' align=center><font size=0.5>'.  round($qty,0).'</font></td>
			  <td '. $bgcolor .' align=center><font size=0.5>'. $info_rma .'</font></td>
	        </tr>';
// 			  <td '. $bgcolor .' align=center><font size=0.5>'. $appro_qty .'</font></td>
//			  <td '. $bgcolor .' align=center><font size=0.5>'. $sold_qty .'</font></td>			  
			
// 			  <td '. $bgcolor .' align=center><font size=0.5>'.  $payment_module_code .'</font></td>			  
//echo     $response;exit;
       $rs->MoveNext();
   }

   return $response;		
}
function get_product_summary ( $source_db, $orders_id )
{
  global $ext_db_name;
  global $ext_db_server;
  global $ext_db_password;
  global $ext_db_database;
  global $ext_db_username;
  
  global $db;
    
  $response = '<table><tr><td>';
  $response .= '<table border=1>
        <tr>
		  <th bgcolor=#dbdef1><font size=0.5>Qty</font></th>		
		  <th bgcolor=#dbdef1><font size=0.5>Ref</font></th>				  
		  <th bgcolor=#dbdef1><font size=0.5>Descr</font></th>				  		  
		  <th bgcolor=#dbdef1><font size=0.5>Prix de vente</font></th>				  
		  <th bgcolor=#dbdef1><font size=0.5>Prix achat</font></th>			  
		  <th bgcolor=#dbdef1><font size=0.5>En stock</font></th>
		  <th bgcolor=#dbdef1><font size=0.5>RMA</font></th>
        </tr>';
//		  <th bgcolor=#dbdef1><font size=0.5>En cmd po</font></th>
//		  <th bgcolor=#dbdef1><font size=0.5>En cmd client</font></th>
//		  <th bgcolor=#dbdef1><font size=0.5>Paiement</font></th>
		
   $db->connect($ext_db_server[$source_db], $ext_db_username[$source_db], $ext_db_password[$source_db], $ext_db_database[$source_db], USE_PCONNECT, false);  
   $sql = "select * from orders_products 
           where products_model not in ('SHF','ECOF','CODF','ESC','FRS','TVA','DIVPRD')
		   and  length(products_model)>0
           and   orders_id = ". $orders_id;
		   
   $rs = $db->Execute($sql);	
   while (!$rs->EOF)
   {
		$products_model = $rs->fields['products_model'];
		$final_price = $rs->fields['final_price'];
		$products_quantity = $rs->fields['products_quantity'];
		$products_name = $rs->fields['products_name'];

		
		if ( $source_db == "bf")
		{
			if (substr($products_model,0,2)=="EB")
			{
			   $dash_place = strpos('-', $products_model);
			   $dash_place = strpos($products_model,'-');
			   $original_code = substr( $products_model, $dash_place+1, 10000 );
			}
			else
			{
			   $original_code =  $products_model;
			}		     
		}
		else
		{
			if (substr($products_model,0,5)=="MCEL-")
			{
			   $original_code = substr( $products_model, 5, 1000 );
//echo $original_code;exit;			   
			}
			else if (substr($products_model,0,3)=="OI-")
			{
			   $original_code = substr( $products_model, 3 , 1000 );
			}
			else if (substr($products_model,0,3)=="BCEL-")
			{
			   $original_code = $products_model;
			}
			else
			{
			   $original_code = $products_model;
			}		
		}
		$response .= get_product_detail ( $source_db, "", $products_model, $original_code, 
                              $products_quantity, $final_price, $products_name );

		
		$rs->MoveNext();
   }
		$response .= '</table>';
		$response .= '</td>
		<td>
		<table>
		<tr>
		<td>';
		
		if ($_SERVER['SERVER_NAME']=='127.0.0.1')		
			$response .= '<img src="http://127.0.0.1/sites/zencart_gl/admin/barcode/barcode.php?cmd='.$orders_id.'" width=130>';
		else
			$response .= '<img src="http://linats.net/admin/barcode/barcode.php?cmd='.$orders_id.'" width=130>';

	   $sql = "select delivery_city 
			   from orders 
			   where  orders_id = ". $orders_id;
			   
	   $rs = $db->Execute($sql);
   
		$response .= '</td>
					  </tr>
					  <tr>
						<td><font size=4>'. strtolower(substr($rs->fields['delivery_city'],0,17)) .'</font></td>
					  </tr>
					  </table>
		</td>
		</tr></table>';
		
		/*
        <tr>
		  <td>LMP94</td>		
		  <td>€ 899</td>			  		  
		  <td>€ 899</td>			  
		  <td>8</td>
		  <td>0</td>
		  <td>9</td>
		  <td>4 / 40</td>
        </tr>			
        <tr>
		  <td>OI-LMP94</td>		
		  <td>€ 899</td>			  
		  <td>8</td>_>
		  <td>0</td>
		  <td>9</td>
		  <td>4 / 30</td>
        </tr>			
        <tr>
		  <td>MCEL-LMP94</td>		
		  <td>€ 899</td>			  
		  <td>8</td>
		  <td>0</td>
		  <td>9</td>
		  <td>4 / 30</td>
        </tr>				
*/		
	
  
  return $response;
}
function get_order_summary ( $source_db, $orders_id )
{
   $response = '';
   
   $response = get_order_header ( $source_db, $orders_id );
   $response .=   '<br><br>';
   
   $response .= get_product_summary ( $source_db, $orders_id );
   //strlen($_POST['hide_footer'])

   $response .= get_order_footer ( $source_db, $orders_id ,$_POST['hide_footer']);

   return $response;
}

  $orders_id = $_POST['orders_id'];
  
  if (strlen($orders_id)==0)
	$orders_id = $_GET['orders_id'];
    
  
//echo   'oo'.$orders_id.'kkk';exit;
  $source_db = $_POST['source_db'];
  
  if (strlen($source_db)==0)
	$source_db = $_GET['source_db'];
 
  echo get_order_summary ( $source_db,$orders_id  );
?>