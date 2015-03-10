<?php

  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
//	ini_set( "display_errors", 0);

   $colsep = "	";
   $raw_data = "Num client".$colsep."Nom client".$colsep."En cours".$colsep."-30j".$colsep."+30j
";
	
echo '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Nouvelle pièce</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">';

echo "<script language=\"javascript\" type=\"text/javascript\"><!--
  function popupWindow(url, features) {
    window.open(url,'popupWindow',features)
  }							
	//--></script>";


echo '</head>
<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } ">';


  
  if (!isset($currencies)) {
	require(DIR_WS_CLASSES . 'currencies.php');
	$currencies = new currencies();
  }

		if ( $_GET['cmp']=="hpl" )
		{
			$bds = array("rq","hp","tb");
		}
		else
		{
			$bds = array("eu","fr","es","de","en","it");		
		    echo '<a href="encours_sommaire.php?cmp=hpl">Voir HPL</a>'; 
		}
		
		
	
		 		 
		 foreach ($bds as $dtb) 
		 {
/*		 
			$sql = "select  distinct customers.customers_id, entry_company, entry_lastname,  entry_country_id, countries_name, customers.max_credit
					from    address_book, countries, customers
					where   countries.countries_id = address_book.entry_country_id 
					and     customers.customers_id = address_book.customers_id
					and     customers.customers_default_address_id = address_book.address_book_id
					order   by 	countries_name, 	entry_company, entry_lastname ";
*/
			$sql = "select  distinct customers.customers_id, entry_company, entry_lastname,  entry_country_id, countries_name, customers.max_credit
					from    address_book, countries, customers, bo_gl.orders 
					where   countries.countries_id = address_book.entry_country_id 
					and     customers.customers_id = address_book.customers_id
					and     customers.customers_id not in (31434)					
					and     customers.customers_default_address_id = address_book.address_book_id
					and     orders.customers_id = customers.customers_id 
					and     orders_status = 2 
					and     database_code='". $dtb ."'
					order   by 	countries_name, 	entry_company, entry_lastname ";
					
//echo $sql;exit;
					
		    //							and     exists ( select 1 from bo_gl.orders where  )
			

    	    $db->connect($ext_db_server[$dtb], $ext_db_username[$dtb], $ext_db_password[$dtb], $ext_db_database[$dtb], USE_PCONNECT, false);				
			$ctry = $db->Execute($sql);

			while ( ! $ctry->EOF )
			{
    		   $country_id[$ctry->fields['entry_country_id']] = $ctry->fields['entry_country_id'];
    		   $country_name[$ctry->fields['entry_country_id']] = $ctry->fields['countries_name'];
			   
			   $customer_id[$ctry->fields['customers_id']] = $ctry->fields['customers_id'];		
			   $customer_db[$ctry->fields['customers_id']] = $dtb;		
			   
			   $customer_country[$ctry->fields['customers_id']] = $ctry->fields['entry_country_id'];
			   $customer_max_credit[$ctry->fields['customers_id']] = $ctry->fields['max_credit'];

			   if (  strlen($ctry->fields['entry_company'])>1 ) 
			   {
    			   $customer_name[$ctry->fields['customers_id']] = $ctry->fields['entry_company'];
			   }
			   else
			   {
			       if ( strlen( $ctry->fields['entry_lastname'] ) > 3 )
				   {
    			     $customer_name[$ctry->fields['customers_id']] = $ctry->fields['entry_lastname'];
				   }
			   }
			   $customer_dete0[$ctry->fields['customers_id']]=0;			   
			   $customer_dete1[$ctry->fields['customers_id']]=0;
			   $customer_dete2[$ctry->fields['customers_id']]=0;
			   
//echo  $customer_name[$ctry->fields['customers_id']].'<br>';	   

			   $ctry->MoveNext();
			}
		   // calcul des encours de commande
		   $sql2 = " select sum(IF(orders.orders_status=2,orders_products.products_quantity*final_price,orders_products.reliquat*final_price)) dette, customers_id
			 from orders, orders_products
			 where orders.orders_status in (2,4)
			 and   orders.payment_module_code not like 'MKP%' 
			 and orders_products.orders_id = orders.orders_id
			 group by customers_id ";			

			$dette = $db->Execute( $sql2 );
			
			while ( ! $dette->EOF )
			{
			   $customer_dete0[$dette->fields['customers_id']] =  $dette->fields['dette'];
			   $dette->MoveNext();
		    }	
			 
		 }
	$db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);				
    // selection des montants  -30 jours 
	$sql = " select sum(IF(orders_invoices.invoice_type in ('DB','DH'),orders.order_total,-orders.order_total)) dette, orders.customers_id
	         from orders, orders_invoices
			 where orders.orders_status = 2
			 and   orders.payment_module_code not like 'MKP%' 			 
			 and invoice_type in ('DB','CR','DH','CH')
			 and orders_invoices.orders_id = orders.orders_id
			 and ( DATE_SUB(CURDATE(),INTERVAL 30 DAY) <=  orders_invoices.invoice_date   )
			 group by customers_id ";
			 
	$dette = $db->Execute( $sql );
	
	while ( ! $dette->EOF )
	{
	   $customer_dete1[$dette->fields['customers_id']] =  $dette->fields['dette'];
	   $dette->MoveNext();
    }	
			 
	// selection des montant + de 30 jours
	$sql = " select sum(IF(orders_invoices.invoice_type in('DB','DH'),orders.order_total,-orders.order_total)) dette, orders.customers_id
	         from orders, orders_invoices
			 where orders.orders_status = 2
			 and   orders.payment_module_code not like 'MKP%' 			 			 
			 and invoice_type in ('DB','CR','DH','CH')
			 and orders_invoices.orders_id = orders.orders_id			 
			 and ( DATE_SUB(CURDATE(),INTERVAL 30 DAY) >  orders_invoices.invoice_date   )
			 group by customers_id ";
			 
	$dette = $db->Execute( $sql );
	
	while ( ! $dette->EOF )
	{
	   $customer_dete2[$dette->fields['customers_id']] =  $dette->fields['dette'];
	   $dette->MoveNext();
    }	
    $tickets = get_tickets(0,1);	
	// reporting 
	 echo  '<table>';

    $totalc0 = 0;	 
    $totalc1 = 0;
	$totalc2 = 0;
	
	
	 
	 foreach ($country_id as $ctr) 
	 {
	    $new_country=1;
		
		
		
		foreach ($customer_id as $cst) 
		{
		   if (    ($customer_country[$cst]==$ctr)
                &&  (  ($customer_dete1[$cst]!=0)
				      || ($customer_dete2[$cst]!=0) 
					)
			   )
		   {
			   if ( $new_country )
			   {
                  if ( 
        				 ( $totalc1 != 0 ) || ( $totalc2 != 0 )
					  )
				  {
			    	echo  '<tr><td></td><td colspan=3><hr></td></tr>';
			    	echo  '<tr><td></td><td align=left>'.$totalc0.'</td><td align=right>'.$totalc1.'</td><td align=right>'.$totalc2.'</td></tr>';
			    	echo  '</tr>';

					$totalc0 = 0;					
					$totalc1 = 0;
					$totalc2 = 0;				     
				  }
				  echo '<tr height=30><td colspan=3></tr>';
								   
			    	echo  '<tr height=30>';
				    echo '<th align=left>'. $country_name[$ctr]. '</th>';
					echo '<th>cmd&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>';
				    echo '<th>&nbsp;&nbsp;&nbsp;-30j&nbsp;&nbsp;&nbsp;</th>';
				    echo '<th>&nbsp;&nbsp;&nbsp;+30j&nbsp;&nbsp;&nbsp;</th>';
			    	echo  '</tr>';
	                $new_country = 0;		   
			   }
		   
			   echo '<tr height=20>';
			   if (($customer_dete0[$cst]+$customer_dete1[$cst]+$customer_dete2[$cst])>$customer_max_credit[$cst] )
			   {
			     $cst_name = '<font color="red">'.substr($customer_name[$cst],0,24).'</font>';
			   }
			   else
			   {
			     $cst_name = substr($customer_name[$cst],0,24);
			   }
			   
			   $bulle = "En cours: ".($customer_dete0[$cst]+$customer_dete1[$cst]+$customer_dete2[$cst]) ." - Limite: " . $customer_max_credit[$cst];
			   echo '<td align=left><a alt="'.$bulle.'" title="'.$bulle.'" target=detail href="encours_detail.php?customers_id='.$cst.'&customer_db='.$customer_db[$cst].'">'. $cst .'&nbsp;'. $cst_name .'</a>';
			   $raw_data .= $cst.$colsep;			   
			   $raw_data .= $cst_name.$colsep;
			   if ( strlen($tickets[$cst])>0 )
			   {
			      echo '<br>';
				  echo $tickets[$cst];
			   }
			   echo '</td>';
			   // en cours  commande
               echo '<td align=left>'.$customer_dete0[$cst] .'</td>';
			   
			   if ( $customer_dete1[$cst]>1000 )
			   {
    			   echo '<td align=right><b>'.$customer_dete1[$cst].'</b></td>';
			   }
			   else
			   {
    			   echo '<td align=right>'.$customer_dete1[$cst].'</td>';
			   }
			   if ( $customer_dete2[$cst]>2000 )
			   {
    			   echo '<td align=right><b><font color=red>'.$customer_dete2[$cst].'</color></b></td>';
			   }
			   else if ( $customer_dete2[$cst]>1000 )
			   {
    			   echo '<td align=right><b><font color=blue>'.$customer_dete2[$cst].'</color></b></td>';
			   }
			   else
			   {
    			   echo '<td align=right>'.$customer_dete2[$cst].'</td>';			   
			   }
			   $totalc0 += $customer_dete0[$cst];			   
			   $totalc1 += $customer_dete1[$cst];
			   $totalc2 += $customer_dete2[$cst];
			   
			   $raw_data .= $customer_dete0[$cst].$colsep;
			   $raw_data .= $customer_dete1[$cst].$colsep;
			   $raw_data .= $customer_dete2[$cst].$colsep;
			   
			   $total0 += $customer_dete0[$cst];			   
			   $total1 += $customer_dete1[$cst];
			   $total2 += $customer_dete2[$cst];
			   
			   echo '</tr>';			   
$raw_data .= '
';			   
		   }
		}
	 }
	 // pour le dernier pays
	echo  '<tr><td></td><td colspan=3><hr></td></tr>';
	echo  '<tr><td></td><td align=left>'.$totalc0.'</td><td align=right>'.$totalc1.'</td><td align=right>'.$totalc2.'</td></tr>';
	echo  '<tr height=40><td></td><td colspan=3><hr></td></tr>';
	echo  '<tr><td></td><td colspan=3><hr></td></tr>';
	echo  '<tr><td></td><td colspan=3><hr></td></tr>';
	echo  '<tr><td></td><td align=left>'.$total0.'</td><td align=right>'.$total1.'</td><td align=right>'.$total2.'</td></tr>';
	
	echo  '</tr>';

	
	 echo '<table>';	
	 echo '<textarea rows=2 cols=2>'.str_replace(".",",",strip_tags($raw_data)).'</textarea>';
echo '</body>	 
</html>';
?>	