<?php

  require('includes/application_top.php');
  require('el_fonctions_gestion.php');

function get_ticket_value ( $ticket_id, $cuf_id  )
{
	global $db;
	
    $sql = "select text_fr value 
			from el_ticket_note
			where ticket_cuf_id='".$cuf_id."'
			and   ticket_id = ". $ticket_id;
	$response = exec_select ( $sql);
    return $response; 	
}  
  
echo '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Liste des clients</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">';

echo "<script language=\"javascript\" type=\"text/javascript\"><!--
  function popupWindow(url, features) {
    window.open(url,'popupWindow',features)
  }							
	//--></script>";


echo '</head>
<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } ">';
    echo '<form name="frm">';
	echo '<input type="button" value="Nouveaux" onClick="javascript:document.location=\'clients.php?ticket_type=rma&ticket_status=110&ticket_property=KOEL\';">';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	echo '<input type="button" value="En attente colis" onClick="javascript:document.location=\'clients.php?ticket_type=rma&ticket_status=110&ticket_property=OKEL\';">';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	echo '<input type="button" value="Colis recu attente décision" onClick="javascript:document.location=\'clients.php?ticket_type=rma&ticket_status=120\';">';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	echo '<input type="button" value="Attente réponse fournisseur" onClick="javascript:document.location=\'clients.php?ticket_type=rma&ticket_status=124\';">';
 	echo '<br><br>';
	
	//document.location.value=\'clients.php?ticket_type=rma&ticket_status=110&ticket_property=KOEL\'">&nbsp;&nbsp;&nbsp;
    $html_select = '<select name="ticket_type">
		              <option value="">
	                  <option value="rma">rma
					  <option value="relance">relance
					  <option value="compta">compta
					 </select>';
					 
    $html_select = eregi_replace('"'.$_GET['ticket_type'].'"' , '"'.$_GET['ticket_type'].'" SELECTED' ,$html_select );
					 
					 
	 echo 'Type '.$html_select;
					 
    // les états 			
    $sql = "select  id code, concat(ticket_type,' ',label) description
			from   el_ticket_status 
			order by ticket_type desc, id ";
			
	echo '&nbsp;&nbsp;&nbsp;Status&nbsp;' . get_select ($sql, 'ticket_status',$_GET['ticket_status']);
	
	// les propriétés
    $sql = "select  code, concat( el_ticket_cuf.prompt ,' ' , el_attribute_value.label_fr)  description
			from  el_ticket_status, el_ticket_cuf, el_attribute_value
			where el_ticket_cuf.ticket_status_id = el_ticket_status.id
			and suggestion_attribute_code = attribute_code
			order by el_ticket_status.ticket_type, el_ticket_status.id, el_ticket_cuf.sequence, el_attribute_value.sequence";
	
	echo '&nbsp;&nbsp;&nbsp;Propriété&nbsp;' . get_select ($sql, 'ticket_property',$_GET['ticket_property']);
	
	echo '&nbsp;&nbsp;&nbsp;&nbsp;';
	
    echo 'Site client &nbsp;&nbsp;<select name="source_db"><option value="">';

		$bds = array("eu","fr","es","de","en","it","bf","po","hp","rq","pl","tb");  						
		
			 foreach ($bds as $dtb) 
			 {
				$html_string .= '<option value="'.$dtb.'">'.$ext_db_name[$dtb];
			 }
			 $html_string .= '</select>';
			  echo eregi_replace('"'.$_GET['source_db'].'"' , '"'.$_GET['source_db'].'" SELECTED' ,$html_string );
    echo '</select">';  
			  
	echo '<br><br>';
	echo '&nbsp;&nbsp;&nbsp;ID Client &nbsp;<input type="text" name="customers_id" value="'. $_GET['customers_id'] .'" size=5>';
	echo '&nbsp;&nbsp;&nbsp;ID ticket &nbsp;<input type="text" name="ticket_id" value="'. $_GET['ticket_id'] .'" size=5>';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="on" name="today">Rappel immédiat';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="on" name="inactifs">Afficher les RMA terminés';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  value="1"  name="extended">Détail des tickets';

	echo '&nbsp;&nbsp;&nbsp;<input type="submit" value="rechercher">';
	
    echo '</form>';
	echo '<hr>';
	        
  
	if (!isset($currencies)) {
		require(DIR_WS_CLASSES . 'currencies.php');
		$currencies = new currencies();
	}
	$csts = array();
	
    if (  strlen( $_GET['inactifs'] ) > 0 )
    {
	    $add_condi = " and   s.active = 0 ";
    }
	
	if ( strlen( $_GET['source_db'] )>0 )
	{
	    $add_condi .= " and  t.database_code = '".$_GET['source_db']."'";
	}
	
	if ( $_GET['ticket_type'] ) 
	{
       	   
	   $sql = "select distinct customers_id cID
				from el_ticket t, el_ticket_status s
				where t.status = s.id  ". $add_condi  ."
				and   s.ticket_type = '" . $_GET['ticket_type'] .  "'";

				// 			
				
		$rs = $db->Execute($sql);
		$csts[]=-1;
		while ( ! $rs->EOF )
		{
		    $csts[] = $rs->fields['cID'];
		    $rs->MoveNext();
        }		
		$customers1 = implode(',',$csts);
//echo $customers;exit;		
	}
	$csts = array();
	
	if ( $_GET['ticket_status'] ) 
	{
	   $sql = "select distinct customers_id cID
				from el_ticket t, el_ticket_status s
				where t.status = s.id  ". $add_condi  ."
				and   s.id = '" . $_GET['ticket_status'] .  "'";

//echo $sql;exit;
			
		$rs = $db->Execute($sql);
		$csts[]=-1;		
		while ( ! $rs->EOF )
		{
		    $csts[] = $rs->fields['cID'];
		    $rs->MoveNext();
        }		
		$customers2 = implode(',',$csts);
//echo $customers;exit;		
	}	
    // filtre propriété 
	$csts = array();	
	if ( $_GET['ticket_property'] ) 
	{
	   $sql = "select distinct customers_id cID
				from el_ticket t, el_ticket_note n
				where n.ticket_id = t.id  ". $add_condi  ."
				and   n.suggestion_value = '" . $_GET['ticket_property'] .  "'";
			
		$rs = $db->Execute($sql);
		$csts[]=-1;		
		while ( ! $rs->EOF )
		{
		    $csts[] = $rs->fields['cID'];
		    $rs->MoveNext();
        }		
		$customers4 = implode(',',$csts);
	}	
	// ID CLIENT
	if ( $_GET['customers_id'] ) 
	{
		$customers5 = $_GET['customers_id'];	    
	}
    // application des filtres
	if ( $_GET['today'] )
	{
	   $sql = "select distinct customers_id cID
				from el_ticket t
				where   DATEDIFF(t.recall_date,now()) < 0  ". $add_condi;
			
		$rs = $db->Execute($sql);
		$csts[]=-1;		
		while ( ! $rs->EOF )
		{
		    $csts[] = $rs->fields['cID'];
		    $rs->MoveNext();
        }		
		$customers = implode(',',$csts);	   
	}

	if ( $_GET['ticket_id'] ) 
	{
       $csts = array();	
	   $sql = "select distinct customers_id cID
				from el_ticket t
				where   t.id = '" . $_GET['ticket_id'] .  "'";
			
		$rs = $db->Execute($sql);
		while ( ! $rs->EOF )
		{
		    $csts[] = $rs->fields['cID'];
		    $rs->MoveNext();
        }		
		$customers6 = implode(',',$csts);
//echo $customers ;exit;
	}		
	
    if (strlen($customers1)>0)
	{
	   $filtre = " and customers.customers_id in ( ". $customers1 .")";
	}
    if (strlen($customers2)>0)
	{
	   $filtre .= " and customers.customers_id in ( ". $customers2 .")";
	}
    if (strlen($customers3)>0)
	{
	   $filtre .= " and customers.customers_id in ( ". $customers3 .")";
	}
    if (strlen($customers4)>0)
	{
	   $filtre .= " and customers.customers_id in ( ". $customers4 .")";
	}

    if (strlen($customers5)>0)
	{
	   $filtre .= " and customers.customers_id in ( ". $customers5 .")";
	}

    if (strlen($customers6)>0)
	{
	   $filtre .= " and customers.customers_id in ( ". $customers6 .")";
	}
	
    $bds = array("eu","fr","es","de","en","it","bf");
	$customer_exists = 0;
	
		$sql = "select  distinct customers.customers_id, entry_company, entry_lastname,  entry_country_id, countries_name, customers_email_address, customers_telephone
				from    address_book, countries, customers
				where   countries.countries_id = address_book.entry_country_id 
				and     customers.customers_id = address_book.customers_id
				and     customers.customers_default_address_id = address_book.address_book_id " 
				.  $filtre  . "
                order   by 	countries_name, 	entry_company, entry_lastname ";
	
//echo $sql;exit;	
		 foreach ($bds as $dtb) 
		 {
    	    $db->connect($ext_db_server[$dtb], $ext_db_username[$dtb], $ext_db_password[$dtb], $ext_db_database[$dtb], USE_PCONNECT, false);				
			$ctry = $db->Execute($sql);
			while ( ! $ctry->EOF )
			{
			   $customer_exists = 1;
			   
    		   $country_id[$ctry->fields['entry_country_id']] = $ctry->fields['entry_country_id'];
    		   $country_name[$ctry->fields['entry_country_id']] = $ctry->fields['countries_name'];
			   
			   $customer_id[$ctry->fields['customers_id']] = $ctry->fields['customers_id'];		
			   $customer_db[$ctry->fields['customers_id']] = $dtb;		
			   
			   $customer_country[$ctry->fields['customers_id']] = $ctry->fields['entry_country_id'];

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
			   $customers_telephone[$ctry->fields['customers_id']]=$ctry->fields['customers_telephone'];
			   $customers_email_address[$ctry->fields['customers_id']]=$ctry->fields['customers_email_address'];
			   
			   
			   $customer_dete1[$ctry->fields['customers_id']]=0;
			   $customer_dete2[$ctry->fields['customers_id']]=0;
			   
//echo  $customer_name[$ctry->fields['customers_id']].'<br>';	   

			   $ctry->MoveNext();
			}
		 }
	$db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);				
    // selection des montants  -30 jours 
	$sql = " select sum(IF(orders_invoices.invoice_type='DB',orders.order_total,-orders.order_total)) dette, orders.customers_id
	         from orders, orders_invoices
			 where orders.orders_status = 2
			 and invoice_type in ('DB','CR')
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
	$sql = " select sum(IF(orders_invoices.invoice_type='DB',orders.order_total,-orders.order_total)) dette, orders.customers_id
	         from orders, orders_invoices
			 where orders.orders_status = 2
			 and invoice_type in ('DB','CR')
			 and orders_invoices.orders_id = orders.orders_id
			 and ( DATE_SUB(CURDATE(),INTERVAL 30 DAY) >  orders_invoices.invoice_date   )
			 group by customers_id ";
			 
	$dette = $db->Execute( $sql );
	
	
	while ( ! $dette->EOF )
	{
	   $customer_dete2[$dette->fields['customers_id']] =  $dette->fields['dette'];
	   $dette->MoveNext();
    }	
   
    $tickets = get_tickets( (strlen($_GET['inactifs'])>0)  );	
	if ( $_GET['extended']==1)
	{
		$rma_ids = get_rma_ids( (strlen($_GET['inactifs'])>0)  );			
	}
	// reporting 
	 echo  '<table>';

    $totalc1 = 0;
	$totalc2 = 0;
	
	if ($customer_exists)
	{
	 
	 foreach ($country_id as $ctr) 
	 {
	    $new_country=1;
		
		
		$filtreDette = 0;
		$filtreTicket = 1;
		
		foreach ($customer_id as $cst) 
		{		
		   if (    ($customer_country[$cst]==$ctr)
                &&
				  (
    			    (
	     				(  
					      ( ($customer_dete1[$cst]!=0) || ($customer_dete2[$cst]!=0) )
						   || !$filtreDette
						)
				   )
				   &&
				   (
	     				(  
					      ( strlen($tickets[$cst])>0 )
						   || !$filtreTicket
						)				      
				   )
				  )
				  
			   )			   
		   {
			   if ( $new_country )
			   {
                  if ( 
        				 ( $totalc1 != 0 ) || ( $totalc2 != 0 )
					  )
				  {
/*				  
			    	echo  '<tr><td></td><td colspan=2><hr></td></tr>';
			    	echo  '<tr><td></td><td align=right>'.$totalc1.'</td><td align=right>'.$totalc2.'</td></tr>';
			    	echo  '</tr>';
*/					
					$totalc1 = 0;
					$totalc2 = 0;				     
				  }
				  echo '<tr height=30><td colspan=3></tr>';
								   
			    	echo  '<tr height=30>';
				    echo '<th align=left>'. $country_name[$ctr]. '</th>';
				    echo '<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>';
				    echo '<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>';					
				    echo '<th>&nbsp;&nbsp;&nbsp;-30j&nbsp;&nbsp;&nbsp;</th>';
				    echo '<th>&nbsp;&nbsp;&nbsp;+30j&nbsp;&nbsp;&nbsp;</th>';
			    	echo  '</tr>';
	                $new_country = 0;		   
			   }
		   
			   echo '<tr height=20>';
			   echo '<td align=left><a target=_new href="encours_detail.php?customers_id='.$cst.'&customer_db='.$customer_db[$cst].'">'. $cst .'&nbsp;'.$customer_name[$cst].'</a>';
			   if ( strlen($tickets[$cst])>0 )
			   {
			      echo '<br>';
				  echo $tickets[$cst];
				  if ($_GET['extended']==1)
				  {
					  $rma_ids_all[] = $rma_ids[$cst][0];
					  $cst_ids_all[] = $cst;					  
				  }
			   }
			   echo '</td>';
			   echo '<td align=left>&nbsp;&nbsp;&nbsp;'.$customers_telephone[$cst].'&nbsp;&nbsp;&nbsp;</td>';
			   echo '<td align=left>&nbsp;&nbsp;&nbsp;'.$customers_email_address[$cst].'&nbsp;&nbsp;&nbsp;</td>';

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
			   $totalc1 += $customer_dete1[$cst];
			   $totalc2 += $customer_dete2[$cst];
			   
			   $total1 += $customer_dete1[$cst];
			   $total2 += $customer_dete2[$cst];
			   
			   echo '</tr>';			   
		   }
		}
	 }
	}
	 // pour le dernier pays
	 /*
	echo  '<tr><td></td><td colspan=2><hr></td></tr>';
	echo  '<tr><td></td><td align=right>'.$totalc1.'</td><td align=right>'.$totalc2.'</td></tr>';
	echo  '<tr height=40><td></td><td colspan=2><hr></td></tr>';
	echo  '<tr><td></td><td colspan=2><hr></td></tr>';
	echo  '<tr><td></td><td colspan=2><hr></td></tr>';
	echo  '<tr><td></td><td align=right>'.$total1.'</td><td align=right>'.$total2.'</td></tr>';
	echo  '</tr>';
	*/

	
	 echo '</table>';	
	 
	 // en cas de demande étendue...
	 if ( $_GET["extended"]==1 )
	 {
		echo '<table>';

		echo '<tr>
			 <th>
				&nbsp;
			  </th>
			  <th>
				Product reference
			  </th>
			  <th>
				serial number
			  </th>
			  <th>
				description
			  </th>
			  <th>
				request
			  </th>
			  <th>
				easylamps RMA
			  </th>
			  <th>
				commentaire
			  </th>					  
			  </tr>';
		$cnt=0;
/*
echo '||||||';
foreach ($rma_ids_all as $key => $val) {
    echo "$key = $val\n<br>";
}
echo '------';
*/
		
		arsort($rma_ids_all);
		
		
		
//		for ($i=0;$i<count($rma_ids_all);$i++)
		foreach ($rma_ids_all as $key => $rma_id) 
		{
			//echo $rma_ids_all[$i].'<br>';
			
			if ($rma_id>0)
			{
				$sql = "select orders_products.products_model, orders_products.products_name
						from   bo_gl.el_ticket_note, bo_gl.orders_invoices, bo_gl.orders_products
						where el_ticket_note.ticket_id	= ".$rma_id ."
						and   el_ticket_note.ticket_cuf_id	= 4
						and   orders_invoices.orders_invoices_id = el_ticket_note.text_fr
						and   orders_products.orders_id = orders_invoices.orders_id 
						order by final_price desc ";
				
				$rs = $db->Execute($sql); 
				// 				
				$sql2 = "select text_fr 
									  from el_ticket_note 
									  where el_ticket_note.ticket_id	= ".$rma_id ."
									  and el_ticket_note.ticket_cuf_id	= 2 ";
									  
				// $cmm1 = exec_select ( $sql );
				$rs2 = $db->Execute($sql2);
				$cmm1 = strip_tags($rs2->fields['text_fr']);
					  
				$serial = get_ticket_value( $rma_id , 42  );
				$ser=explode(';',$serial);
				
				for ($k=0;$k<count($ser);$k++)
				{
					if (strlen($rs->fields['products_model'])>0)
					{
						$cnt++;
						echo '<tr>';
						echo  
						'<td>
							'.$cnt.'
						  </td>
						  <td>
							'. $rs->fields['products_model'] .'
						  </td>
						  <td>
							' . $ser[$k] .'
						  </td>
						  <td>
							Not working
						  </td>
						  <td>
							NEW LAMP
						  </td>
						  <td>
							' . $rma_id . '
						  </td>					  
						  <td>
							' . $cmm1 . '
						  </td>';
						
						echo '</tr>';					
						//echo '<td>'.$rma_ids_all[$i]. '</td><td>'.$rs->fields['products_model'] . '</td><td>' . $rs->fields['products_name']. '</td>';
					}
				}
				
				// 2 10 11
			}
		}
		echo '</table>';
		
	 }
echo '</body>	 
</html>';
?>	