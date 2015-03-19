<?php
  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
echo '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Nouvelle pi&#232;ce</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } ">';
echo "<script language=\"javascript\" type=\"text/javascript\"><!--
								function popupInvoice(url) {
								  window.open(url,'popupWindowI','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=800,height=600,screenX=800,screenY=600,top=100,left=100')
								}
	//--></script>";
echo "<script language=\"javascript\" type=\"text/javascript\"><!--
  function popupWindow(url, features) {
    window.open(url,'popupWindow',features)
  }							
	//--></script>";
  
  if (!isset($currencies)) {
	require(DIR_WS_CLASSES . 'currencies.php');
	$currencies = new currencies();
  }
  
    $customer_db = $_GET['customer_db'];
	$customers_id = $_GET['customers_id'];
	$what = $_GET['what'];
	$languages_id = $_GET['languages_id'];
	$paiement=$_GET['paiement'];

    if (strlen($languages_id)==0)
	{
	   $languages_id = 2;
	}
	
    if (strlen($what)==0)
    {
	   $show_actions = 1;
    }	
	else
    {
	   $show_actions = 0;
    }	
	$db->connect($ext_db_server[$customer_db], $ext_db_username[$customer_db], $ext_db_password[$customer_db], $ext_db_database[$customer_db], USE_PCONNECT, false);				
	
    //	$what = 2;	
	if ( strlen($_GET['deliver_orders_id'])>0 )
	{
	   $dml = "update orders set orders_status = 3 where orders_id = " . $_GET['deliver_orders_id'];
	   $db->Execute($dml);
	}
  
    // on r&#233;cupère les informations client
				$sql = "select entry_company,
				               customers_firstname,
							   customers_lastname,
							   customers_email_address,
							   customers_telephone,
							   max_credit,
							   default_currency
	                  from address_book ab, customers c, countries
	                  where  ab.customers_id = c.customers_id
	                   and   c.customers_default_address_id =  ab.address_book_id 
					   and   entry_country_id = countries_id
					   and   c.customers_id = " . $customers_id;	
					
     			$sql1="
     				select currency from orders where 
     			customers_id = " .$customers_id;
     $recordSet = $db->Execute($sql);					
	 $recordSet1 = $db->Execute($sql1);
	 $max_credit = $recordSet->fields['max_credit'];
	 $currency = $recordSet->fields['default_currency'];
	 $customer_currency = $recordSet1->fields['currency'];
	 echo '<table>
	       <tr bgcolor="f3f3f3">
		   <td width="250">'. $recordSet->fields['entry_company'] .' ('. $customers_id . ')</td>
		   <td width="250">'. $recordSet->fields['customers_firstname']. ' '. $recordSet->fields['customers_firstname'] . '</td>
		   </tr>
	       <tr bgcolor="f3f3f3">
		   <td>'. $recordSet->fields['customers_telephone'] . '</td>
		   <td>'. $recordSet->fields['customers_email_address'] . '</td>
		   </tr>
		   <tr>
		   <td colspan="2">
		   <table width=100%>
		   <tr>';
		   
	  
	  $ETAT_COMPTE[2] = 'Etat de compte client';	  
	  $ETAT_COMPTE[5] = 'Client balance';
	  $TYPE_FACTURE[2]='Type';
      $TYPE_FACTURE[5]='Type';
	  $SHIP_TO[2]='Envoy&#233; &#224;';
      $SHIP_TO[5]='Ship to';
	  $NUM_FACTURE[2]='Num&#233;ro facture';
      $NUM_FACTURE[5]='Invoice #';
	  $REF_CMD[2]='R&#233;f. commande';
      $REF_CMD[5]='Order ref.';
	  $DATE_CMD[2]='Date cmde';
      $DATE_CMD[5]='Order Date';
	  $DATE_FACTURE[2]='Date Facture';
      $DATE_FACTURE[5]='Invoice Date';
	  $REF_PAIEMENT[2]='Ref. paiement';
      $REF_PAIEMENT[5]='Payment ref.';
	  
	  $RETARD_PAIEMENT[2]='Retard Paiement';
      $RETARD_PAIEMENT[5]='Payment Delay';
	  
	  $MONTANT_FACTURE[2]='Montant';
      $MONTANT_FACTURE[5]='Amount';
		   
      $db->connect($ext_db_server["gl"], $ext_db_username["gl"], $ext_db_password["gl"], $ext_db_database["gl"], USE_PCONNECT, false);				
		   
    if ( ($_GET['show_closed']=='0'|| $_GET['show_closed']=='1'))
	{		 
	    if ( $what!=3 )
		{
			 $typ_ticket= array("rma","relance","compta");
			 foreach ($typ_ticket as $tt) 
			 {
			   echo '<td>Ajout.. <a href="javascript:popupWindow(\'handle_ticket.php?customers_id='.$customers_id.'&type='.$tt.'&id=0\',\'height=400,screenX=400,screenY=400,top=400,left=400\')"><img border=0 src="'. $tt .'_note.gif"></td>';
			 }
			 echo '</tr></table>';					      
	         echo '</td></tr></table>';		   
        } 
	    /// affichage des tickets 
		if ( strlen($_GET['ticket_id'])>0 )
		  $ticket_condition = "t.id = " . $_GET['ticket_id'];
		else if ( $_GET['show_closed']=='1')
		  //$ticket_condition = "1 = 1";
		  $ticket_condition = "s.active = 0";		
		//else if ( $_GET['show_closed']=='0')
		  //$ticket_condition = "0 = 0";
		else if ($_GET['show_closed']=='0')
		  $ticket_condition = "s.active = 1";
		else
		$ticket_condition = "s.active = 1";
			
		$sql = " select t.id, t.ticket_type, t.date_created, t.recall_date, s.color,
		                DATEDIFF(t.recall_date,now()) rappel_dans
					from el_ticket t, el_ticket_status s
					where t.status = s.id
					and   " . $ticket_condition . " 
					and   t.customers_id = " . $customers_id .  "
					order by recall_date desc";
				 
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
		      $rappel_dans .= "j";
		   }
		   
		   echo '<br>
		         <table>
		         <tr>
				   <td bgcolor="'.$color.'">';
           if ( $what!=3 )				   
		   {
			  echo ' <a href="javascript:popupWindow(\'handle_ticket.php?id='.$id.'\',\'height=400,screenX=400,screenY=400,top=400,left=400\')">';
		   }
	       echo '<img border=0 src="'. $ticket_type .'_note.gif">';
           
           if ( $what!=3 )				   
		   {
			  echo '</a>';
		   }
		   echo  $rappel_dans . '		 
				   </td>';
				   
	       $sql = "select text_fr, n.date_created,s.color,s.label,s.id
		           from   el_ticket_note n, el_ticket_status s			   
				   where  n.ticket_id = " . $id  . " 
				   and   n.new_status_id = s.id
				   order by n.date_created, n.id";
				   
		   $recordSet2 = $db->Execute( $sql );
			while ( !$recordSet2->EOF )
			{
			   $status = $recordSet2->fields['id'];
			   echo '<td bgcolor="'. $recordSet2->fields['color'] .'" valign="top">';
			   echo '<b>'.$recordSet2->fields['label'].'</b>';
			   echo '<br>';			   
			   echo $recordSet2->fields['date_created'];
               echo '<hr>';			   			   
			   echo stripslashes($recordSet2->fields['text_fr']);
			   echo '<br><br>';			   
			   $sql3 = "select prompt,text_fr, suggestion_value
						from el_ticket_cuf, el_ticket_note
						where el_ticket_note.ticket_id = ". $id ."
						and  ticket_status_id = ". $status ."
						and  ticket_cuf_id = el_ticket_cuf.id
						order by sequence";
						
			   $recordSet3=$db->Execute($sql3);
			   while ( !$recordSet3->EOF )
			   {
				   if  ( (strlen($recordSet3->fields['suggestion_value'])+strlen($recordSet3->fields['text_fr']))>0  )
				   {
					   echo '<b>'.$recordSet3->fields['prompt'].'</b>';
					   echo '<br>';			   
					   if (strlen($recordSet3->fields['suggestion_value'])> 0)
					   {
						  echo $recordSet3->fields['suggestion_value']. ' ';
					   }
					   echo $recordSet3->fields['text_fr'];
					   echo '<br><br>';
				   }
 			       $recordSet3->MoveNext();
			   }
	     	   $recordSet2->MoveNext();			   
			}
			
			echo '</td>';	
        		// affichage des CUF cach&#233;s
			   $sql4 = "select prompt,text_fr, suggestion_value, ticket_status_id
						from el_ticket_cuf, el_ticket_note
						where el_ticket_note.ticket_id = ". $id ."
						and  ticket_cuf_id = el_ticket_cuf.id
						and  (  length(suggestion_value)>0
						        or length(text_fr)>0 )
						and  ticket_status_id  not in 
						(
                     select n.new_status_id
                     from   el_ticket_note n
      				   where  n.ticket_id = " . $id  . " 
					   and LENGTH(new_status_id) > 0
      				)
				  order by ticket_status_id, sequence";
		   $recordSet3=$db->Execute($sql4);
		   $first=0;
		   while ( !$recordSet3->EOF )
		   {
		       if ( $first == 0 )
			   {
				   echo '<td valign="top">';
				   echo '<b>Autres propri&#233;t&#233;s</b>';
	               echo '<hr>';	
				   $first = 1;
			   }
			   echo '<b>'.$recordSet3->fields['prompt'].'</b>';
			   echo '<br>';			   
			   if (strlen($recordSet3->fields['suggestion_value'])> 0)
			   {
				  echo $recordSet3->fields['suggestion_value']. ' ';
			   }
			   echo $recordSet3->fields['text_fr'];
			   echo '<br><br>';
			   $recordSet3->MoveNext();
		   }
		   if ( $first )
		   {
		      echo '</td>';
		   }			   			
		   echo  '</tr>
		         </table>';
		   $recordSet->MoveNext();
		}
	}
	
	 $couleur_reglee = "dbdaeb";
	 $couleur_non_reglee = "e7cad4";
	 $couleur_avoirs = "LightGreen"; 
      // les  libell&#233;s fonction de la langue 
     // FV 1 er fevrier 2010  on cache because les gens ne regardent pas...
     //$db->connect($ext_db_server[$customer_db], $ext_db_username[$customer_db], $ext_db_password[$customer_db], $ext_db_database[$customer_db], USE_PCONNECT, false);				
	 // if ( ( $what != 2 ) && ( $what != 3 ) )
	 if ( false )
	 {
		  echo '<br><br>';
			$sql = "SELECT o.orders_id, date_format(o.date_purchased,\"%d-%c-%Y\") date_purchased , o.delivery_name, o.customers_telephone, o.customers_email_address,
	                               o.billing_name,o.delivery_name, ot.text as order_total, s.orders_status_name,
								   o.orders_status, o.ref_info
	                        FROM       " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot, " . TABLE_ORDERS_STATUS . " s
	                        WHERE      o.customers_id = " . $customers_id . "
	                        AND        o.orders_id = ot.orders_id
	                        AND        ot.class = 'ot_total'
	                        AND        o.orders_status = s.orders_status_id
	                        AND        s.language_id = 2
							AND        o.orders_id > 80232
							AND        o.orders_status not in (3,6,7)
	                        ORDER BY   o.orders_id desc ";
		  
		 $recordSet = $db->Execute($sql);
		 $even = 0;
		 echo '<table>';
		 while ( ! $recordSet->EOF )
		 {
		    if ($even)
			{
			  $bgcolor = "#e2e1f9";		
			  $even = 0;
			}
			else
			{
			  $bgcolor = "#f1f0f8";
			  $even = 1;
			}
			$sql = " select count(1) cnt
						       from orders_products 
						       where   products_model not in('CODF','SHF','ECOF') 
							   and     orders_id = " . $recordSet->fields['orders_id'] ;
							   
	        echo '<tr bgcolor="'.$bgcolor.'">';
							   
			$rs = $db->Execute($sql);				   		
	        $nb = $rs->fields["cnt"]+2;
	        echo '<td rowspan='. $nb . '>';
	        echo $REF_CMD[$languages_id].":<b>". $recordSet->fields['orders_id'] . '/'. $recordSet->fields['ref_info']. "</b><br>&nbsp;&nbsp;&nbsp;". $DATE_CMD[$languages_id].":<b>". $recordSet->fields['date_purchased']. "</b><br>&nbsp;&nbsp;&nbsp;". $SHIP_TO[$languages_id].":<b>". $recordSet->fields['delivery_name'].'</b><br>';
			echo '&nbsp;&nbsp;<a href="javascript:if (confirm(\'Voulez vous livrer cette commande ?\')) { document.location=\'encours_detail.php?customer_db='.$customer_db.'&customers_id='.$customers_id.'&deliver_orders_id='.$recordSet->fields['orders_id'].'\';}">Livrer</a>';
			echo '</td>';
			$sql = "select * 
			       from orders_products 
			       where   products_model not in('CODF','SHF','ECOF') 
				   and     orders_id = " . $recordSet->fields['orders_id']  ."
				   order by  sort_order";
			
			$QTY_CMD[2]='Qt&#233; command.';
			$QTY_CMD[5]='Ordered Qty';
			$RELIQUAT[2]='Reliquat';
			$RELIQUAT[5]='Remaining';
			$PRODUCT[2]='Produit';
			$PRODUCT[5]='Product';
			echo '<tr><th align=left>' . $QTY_CMD[$languages_id] .' </th> <th align=left>' . $RELIQUAT[$languages_id] .' </th><th align=left>' . $PRODUCT[$languages_id] .' </th></tr>';
			
	    	$recordSetPrd = $db->Execute($sql);
			
			while ( !$recordSetPrd->EOF  )
			{
				/*if ($recordSet->fields['invoice_type'] == 'CR')
					$bgcolor = "LightGreen";*/
				echo '<tr bgcolor="'.$bgcolor.'">';
				
				echo '<td>';
				echo $recordSetPrd->fields['products_quantity'];
				echo '</td>';
				echo '<td>';
				if ( $recordSet->fields['orders_status']==1 )
				{
	    			echo $recordSetPrd->fields['products_quantity'];		
				}
				else
				{
	    			echo $recordSetPrd->fields['reliquat'];		
					
    				echo '&nbsp;&nbsp;&nbsp;<a href="javascript:popupWindow(\'' .
				    zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $recordSetPrd->fields['orders_id']  . '&orders_products_id=' . $recordSetPrd->fields['orders_products_id']  . '&target=edit_product', 'NONSSL') . '\', \'scrollbars=yes,resizable=yes,width=300,height=300,screenX=150,screenY=300,top=100,left=150\')">' .
				    zen_image(DIR_WS_IMAGES . 'icon_edit3.gif', 'Informations livraison') . '</a>';									  					
				}
				echo '</td>';
				echo '<td>';
				echo $recordSetPrd->fields['products_model'].' '.$recordSetPrd->fields['products_name'];						
				echo '</td>';
				
				echo '</tr>';
				
	    		$recordSetPrd->MoveNext();	
			}
			
			$recordSet->MoveNext();
	     }	
		 echo '</table><br><br>';
    }
    //  section des commandes  encours clients -------------------------------------
//	if ( false )
	
	// define
    $BALANCE_DUE[2] = 'Balance due echue ';
    $BALANCE_DUE[5] = 'Outstanding balance due  ';
    $BALANCE_T[2] = 'Balance totale due ';
    $BALANCE_T[5] = 'Total balance due ';
    $CREDIT[2] = 'Montant cr&#233;dit';
    $CREDIT[5] = 'Credit amount ';
	 //$_SESSION['currency'] = 'GBP';
    // $customer_currency = 'GBP';
      
    /*if ( $show_actions != 1)
	 	{
	 		echo '<table style="position:absolute; margin-top:40px; margin-left:150px;">
	 		<tr>
	 		<td bgcolor="#C0C0C0">'.$BALANCE_T[$languages_id].'</td>
	 		<td bgcolor="#C0C0C0" align=right>'.$currencies->format($total_du).'</td>
	 		</tr>
	 		<tr>
	 		<td bgcolor="#C0C0C0">'.$BALANCE_DUE[$languages_id].' </td>
	 		<td bgcolor="#C0C0C0" align=right> '.$currencies->format($balance_du,1,$customer_currency,$recordSet->fields['currency_value'] ).'</td>
	 		</tr>
	 		<tr>
	 		<td bgcolor="#C0C0C0">'.$CREDIT[$languages_id].'</td> 
	 		<td bgcolor="#C0C0C0" align=right>'.$currencies->format($max_credit,1,$customer_currency,$recordSet->fields['currency_value']).'</td>
	 		</table>';
    	}
*/
	if ( $what!=3 )
	{
	
	  $db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);				
	  
	  if ( $show_actions == 1 )
	  {
	      
	      $link = "encours_detail.php?customers_id=".$customers_id."&customer_db=".$customer_db."&what=2";
		  $link2 =  "encours_detail.php?customers_id=".$customers_id."&customer_db=".$customer_db."&show_closed=1";
		  $link3 = "encours_detail.php?customers_id=".$customers_id."&customer_db=".$customer_db."&show_closed=0";
	      $link4 = "encours_detail.php?customers_id=".$customers_id."&customer_db=".$customer_db."&paiement=1";

	      echo '<table><tr><td>
		        <b>Factures client</b> 
	             </td>
				 <td>
				    <table><tr><td bgcolor="'.$couleur_non_reglee.'"> &nbsp;&nbsp;&nbsp; Non r&#233;gl&#233;es &nbsp;&nbsp;&nbsp; </td></tr></table>
	             </td>
				 <td>
				    <table><tr><td bgcolor="'.$couleur_reglee.'"> &nbsp;&nbsp;&nbsp; R&#233;gl&#233;es &nbsp;&nbsp;&nbsp; </td></tr></table>
	             </td>
	             <td>
				  <table><tr><td bgcolor="'.$couleur_avoirs.'"> &nbsp;&nbsp;&nbsp; Avoirs &nbsp;&nbsp;&nbsp; </td></tr></table>
	             </td>		 
				 
				 <td>
				    <table><tr><td> &nbsp;&nbsp;&nbsp;<a href="'.$link4.'">Saisi paiement</a>  &nbsp;&nbsp;&nbsp; </td></tr></table>
	             </td>

				 <td>
				    <table><tr><td> &nbsp;&nbsp;&nbsp;<a href="'.$link.'">Etat de compte</a>  &nbsp;&nbsp;&nbsp; </td></tr></table>
	             </td>			 				 
				 <td>
				    <table><tr><td> &nbsp;&nbsp;&nbsp;<a href="'.$link.'&languages_id=5">Balance statement</a>  &nbsp;&nbsp;&nbsp; </td></tr></table>
	             </td>		
				 <td>
				    <table><tr><td> &nbsp;&nbsp;&nbsp;<a href="'.$link2.'">Montrer les RMA ferm&#233;s</a>  &nbsp;&nbsp;&nbsp; </td></tr></table>
	             </td>					 
				 <td>
				    <table><tr><td> &nbsp;&nbsp;&nbsp;<a href="'.$link3.'">Montrer les RMA ouverts</a>  &nbsp;&nbsp;&nbsp; </td></tr></table>
	             </td>
				 </tr></table>';
		}
		else
		{
	      echo '<br>
		        <table><tr><td>
		        <b>'.$ETAT_COMPTE[$languages_id].'</b> 
	             </td>			 				 
				 </tr>
				 </table>
				 <br><br>';		    
		}
	    if ( $what ==2 || $paiement ==1)
		{
		   $condition = " AND o.orders_status = 2 ";
		}
		
		$sql = "SELECT o.orders_id, o.date_purchased, o.delivery_name, o.customers_telephone, o.customers_email_address,
                               o.billing_name,o.delivery_name, ot.text as order_total, o.order_total as amount, s.orders_status_name,
								DATEDIFF(now(),oi.invoice_date)-30 retard30,
							   DATEDIFF(now(),oi.invoice_date)-60 retard60,							   
							   DATEDIFF(now(),LAST_DAY(oi.invoice_date))-30 retard30fm,
							   oi.orders_invoices_id, date_format(oi.invoice_date,\"%d-%c-%Y\") date_facture, oi.invoice_type, o.orders_status, o.ref_info,
							   o.payment_info, o.payment_amount,date_format(o.orders_date_finished,\"%d-%c-%Y\") orders_date_finished,
							   o.payment_info2, o.payment_amount2,date_format(o.orders_date_finished2,\"%d-%c-%Y\") orders_date_finished2,payment_conditions_code
                        FROM   orders_invoices oi , " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot, " . TABLE_ORDERS_STATUS . " s
                        WHERE      o.customers_id = " . $customers_id . "
						AND        oi.invoice_type in ('DB','CR','DH','CH')
						AND        oi.orders_id = o.orders_id
                        AND        o.orders_id = ot.orders_id
                        AND        ot.class = 'ot_total'
						". $condition . "
                        AND        o.orders_status = s.orders_status_id
                        AND        s.language_id = 2
                        ORDER BY   invoice_date desc ";
//echo $sql;exit;						
	
    echo '<table width=800 style="margin-top:80px;">';	
	 echo '<tr>';		 
     echo '<th>' . $TYPE_FACTURE[$languages_id] .'</th>';
     echo '<th>' . $NUM_FACTURE[$languages_id] .'</th>';	 	 	 
     echo '<th>' . $REF_CMD[$languages_id] .'</th>';	 
     echo '<th>' . $SHIP_TO[$languages_id] .'</th>';	 	 
     echo '<th>' . $DATE_FACTURE[$languages_id] .'</th>';	 
     echo '<th>' . $REF_PAIEMENT[$languages_id] .'</th>';	 	 
	 echo '<th>' . $RETARD_PAIEMENT[$languages_id] .'</th>';	 
     echo '<th>' . $MONTANT_FACTURE[$languages_id] .'</th>';
	
	 if ( $show_actions == 1 )
	 {
	     echo '<th>Detail</th>';
	     echo '<th>Montant</th>';	 
	 }
	 echo '</tr>';		 
	 $total_du = 0;
	 $recordSet = $db->Execute($sql);
	 $balance_du = 0;
	 while ( ! $recordSet->EOF )
	 {
	    if ( $recordSet->fields['orders_status']!=2 )
		{
    	    echo '<tr  bgcolor="'. $couleur_reglee .'">';
		}
		else if ($recordSet->fields['invoice_type'] == 'CR')
		{
			echo '<tr  bgcolor="LightGreen">';
			
		}
		else
		{
    	    echo '<tr bgcolor="'. $couleur_non_reglee .'">';
		}
		
	    echo '<td>';
          echo $recordSet->fields['invoice_type'];
	    echo '&nbsp;&nbsp;&nbsp;</td>';
	    echo '<td>';
          echo $recordSet->fields['orders_invoices_id'];
	    echo '&nbsp;&nbsp;&nbsp;</td>';		
	    echo '<td>';
          echo $recordSet->fields['ref_info'];
	    echo '&nbsp;&nbsp;&nbsp;</td>';		
	    echo '<td>';
          echo $recordSet->fields['delivery_name'];
	    echo '&nbsp;&nbsp;&nbsp;</td>';				
	    echo '<td>';
          echo $recordSet->fields['date_facture'];
	    echo '&nbsp;&nbsp;&nbsp;</td>';
	    echo '<td>';
		
		if ($recordSet->fields['payment_amount']!=0)
		{
		    if ( strlen($recordSet->fields['orders_date_finished']) > 0 )
			   echo $recordSet->fields['orders_date_finished'].'  ';
			   
		    if ( strlen($recordSet->fields['payment_info']) > 0 )		   
				echo $recordSet->fields['payment_info'].'  ';
			
			echo '<b>'.$currencies->format($recordSet->fields['payment_amount']).'</b>';
		}
		if ($recordSet->fields['payment_amount2']!=0)
		{
		    echo '<br><br>';
		    if ( strlen($recordSet->fields['orders_date_finished2']) > 0 )
			   echo $recordSet->fields['orders_date_finished2'].'  ';
			   
		    if ( strlen($recordSet->fields['payment_info2']) > 0 )		   
				echo $recordSet->fields['payment_info2'].'  ';
			
			echo '<b>'.$currencies->format($recordSet->fields['payment_amount2']).'</b>';
		}
		
	    echo '&nbsp;&nbsp;&nbsp;</td>';
		
		if ( $recordSet->fields['payment_conditions_code']=='60JN'  )
		   $retard = $recordSet->fields['retard60'];
		else if ( $recordSet->fields['payment_conditions_code']=='30FM'  )
		   $retard = $recordSet->fields['retard30fm'];		
		else
		   $retard = $recordSet->fields['retard30'];		
		
		/*$i = 0;
		while (isset($retard) > 0)
		{
			if ($retard > 0)
				$balance_du += $recordSet->fields['amount'];
			//echo  $recordSet->fields['amount'];
			$i++;
		}*/
		//echo $balance_du;
	
		if ($retard <= 0)   
		   $retard = "";
		else
		{
			if ($recordSet->fields['invoice_type'] == 'CR')
			   $highlight = 'bgcolor="LightGreen"';
			else
			   $highlight = 'bgcolor="Tomato"';		   
		}
		if ( $recordSet->fields['orders_status']!=2  )
		{
		   $retard = "";
		   $highlight = '';		   		   
		}
		if ($retard > 0 && $recordSet->fields['invoice_type'] == 'CR')
			$highlight = 'bgcolor="MediumSpringGreen"';
		
		echo '<td align="right" ' . $highlight . '>';
		   
        echo $retard;
        //$retard_total += $retard;
	    echo '&nbsp;&nbsp;&nbsp;</td>';
		
	    echo '<td align="right">';          
		if ( 
     		  ( $recordSet->fields['invoice_type']=="DB" ) || ( $recordSet->fields['invoice_type']=="DH"  )
		)
		{
     	  //$total_du += $recordSet->fields['currency_value']*$recordSet->fields['amount'];
//		  echo $recordSet->fields['order_total'];
  		  //echo ( $currencies->format($recordSet->fields['amount'],1,$customer_currency,$recordSet->fields['currency_value'] ));
		 // echo $currency;
		//$total_du += $recordSet->fields['amount'] * $recordSet->fields['currency_value'];
		$total_du += $recordSet->fields['amount'];
		echo $recordSet->fields['order_total'];
		$tab_facture[] = array('Montant' => $recordSet->fields['amount'], 
								'orders_id' => $recordSet->fields['orders_id'],);
		}
		else
		{
     	  $total_du -= $recordSet->fields['amount'];
		  // echo '-' . $recordSet->fields['order_total'];		  		  
		  //echo ( $currencies->format(-1*$recordSet->fields['amount']) );
//		    echo $recordSet->fields['order_total'];
   		   echo ( $currencies->format(-1*$recordSet->fields['amount'],1,$customer_currency,$recordSet->fields['currency_value'] ));
		  //echo $currency;
		//echo ( -1*$recordSet->fields['amount'] );
   		 	$tab_facture[] = array('Montant' => -1*$recordSet->fields['amount'],
   		 		'orders_id' => $recordSet->fields['orders_id'],
   		 	 );
		}
	    echo '&nbsp;&nbsp;&nbsp;</td>';
		if ($retard > 0)
			{
				
				if ( 
     		  ( $recordSet->fields['invoice_type']=="DB" ) || ( $recordSet->fields['invoice_type']=="DH" )
					)
				{
     	  			$balance_du += $recordSet->fields['amount'];
					//$balance_du = $currencies->format($balance_du,1,$customer_currency,$recordSet->fields['currency_value']);
					
					//echo ($currencies->format($recordSet->fields['amount'],1,$customer_currency,$recordSet->fields['currency_value']));
					//echo $recordSet->fields['amount'];
				}
				else
				{
					//echo $recordSet->fields['amount'];
     	  			$balance_du -= $recordSet->fields['amount'];
					//var_dump($balance_du);
					//$balance_du = $currencies->format($balance_du,1,$customer_currency,$recordSet->fields['currency_value']);	
					//var_dump($currencies->format($recordSet->fields['amount'],1,$customer_currency,$recordSet->fields['currency_value']));
					//echo ($currencies->format(-1*$recordSet->fields['amount'],1,$customer_currency,$recordSet->fields['currency_value']));	
				}	
			}
			
		//$balance_du = $recordSet->fields['amount'] + $recordSet->fields['order_total'];
		//echo $balance_du;
		
//		echo $recordSet->fields['amount'];
		//echo $retard_total;
		
 		//$balance_du[2] = "Balance_due";
 		//$balance_du[2] = "Balance_due";
		
	    if ( $show_actions == 1 )
	    {		
	      echo '<td>&nbsp;&nbsp;&nbsp;';				
     	  $link = 'includes/modules/pdfoc/temp_pdf/'. $recordSet->fields['orders_invoices_id'] .'_'. $recordSet->fields['orders_id'] .'batch_orders.pdf';	
		  echo '<a href="javascript:popupInvoice(\''.$link.'\');"  title='. $recordSet->fields['payment_conditions_code'] . '> Voir </a>';
		    echo '&nbsp;&nbsp;&nbsp;</td>';				
	        echo "<td>";

			if ( ( $recordSet->fields['orders_status']==2)  && ( $_SESSION['admin_id']!=2 ) )
			{
			
				if ($paiement == 1)
				{
					/*if ( $recordSet->fields['invoice_type']=="CR" )
						$recordSet->fields['order_total'] = $recordSet->fields['order_total'] * -1;
					
					$tab[]  = array('montant' => $recordSet->fields['order_total']);
					*/

					$hello = "montant".$recordSet->fields['orders_id'];
					echo '
					<form method=post action="">
						<input type="text" name="'.$hello.'"><br>
					
					';
					echo $_POST[$hello];

				}
				else
				{
				  echo '&nbsp;&nbsp;&nbsp;<a href="javascript:popupWindow(\'' .
				  zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $recordSet->fields['orders_id']  . '&target=payment_mode', 'NONSSL') . '\', \'scrollbars=yes,resizable=yes,width=400,height=500,screenX=150,screenY=300,top=100,left=150\')">' .
				  zen_image(DIR_WS_IMAGES . 'icon_edit3.gif', 'Informations de paiement') . '</a>';									  
				}
			}
			else
			{
	            echo '&nbsp;';		
			}
	        echo "</td>";
		}
	    echo '</tr>';
		
	    $recordSet->MoveNext();
	 }
    }
	
    if ($paiement == 1)
	{

		
		echo '
		
		<center><b> Montant_totale : </b><input type="text" name="montant" ><br>
		</center>
		<b> Reference_payement : </b> <input type="text" name="reference"><br>
		<b> customers_id : </b> <input type="text" name="customer"><br>

		<input type="submit" value="enregistrer" name="enregistrer" style="position:absolute;top:550px;margin-left:200px;"/>
		<input type="submit" value="valider" name="valider" style="position:absolute;top:550px;"/>
		
		</form>';
		
		echo $_POST[$hello];
		/*$sql = "select payment_id from orders_payment where statut=en_cours and customers_id='".$customers_id;
		$rsm = $db->Execute($sql);
		$payment_id = $rsm->fields["payment_id"];		
		*/
		//echo $payement;

		if (isset($_POST['montant']) && isset($_POST['reference']) )
		{
			if ($_POST['enregistrer'] == "enregistrer")
			{
				$_SESSION['montant'] = $_POST['montant'];
				//echo $_SESSION['montant'];
				$dml = "  INSERT INTO `orders_payment` 
								( `payment_date`, `payment_reference`,
								 `uncharged_amount`,  `amount`, `statut`, `customers_id`)
						VALUES
							( now(), '".$_POST['reference']."', 
							 '', '".$_POST['montant']."', 'en_cours', '".$_POST['customer']."')";

				echo $dml;
				$result = mysql_query($dml);
			//$sql = "select id "
			/*echo $_POST['reference'];
			echo $_POST['enregistrer'];
			echo $_POST['valider'];
			*/
			//echo $_POST['customer'];
			echo $a;

			}
			else if ($_POST['valider'] == "valider" )
			{
							
				
				$montant_total = $_SESSION['montant'];

				/*$dml = " update orders_payment 
							set payment_date = now(), payment_reference = '".$_POST['reference']."', uncharged_amount = '', amount='".$_POST['montant']."', statut='valide', customers_id='".$customers_id."' 
							where statut='en_cours' and customers_id='".$_POST['customer']."'";
				
				echo $dml;
				$result = mysql_query($dml);*/
				
			$i = count($tab_facture) - 1;
			//echo $i;
			while ($i>= 0)
			{
				//echo "je suis le ii == ".$i;
				//if (($montant_total < 0  && $tab_facture[$i]['Montant'] > $montant_total) || ($montant_total > 0))
				if (($montant_total > 0 ) && ($montant_total < $tab_facture[$i]['Montant']) && ($tab_facture[$i - 1]['Montant'] < 0))
				{
					
					echo "je suis le montant_total ".$montant_total;
					echo '<br>';
					echo  "je suis dans la facture ".$tab_facture[$i]['Montant'];
					echo '<br>';
					
					$montant_total = $montant_total - $tab_facture[$i]['Montant'];
					echo '<br>';
					echo "je suis le new totale ".$montant_total;
					echo '<br>';
				}
				else if (($montant_total < 0 ) && $tab_facture[$i]['Montant'] < $montant_total)
				{

					echo "je suis le montant_total ".$montant_total;
					echo '<br>';
					echo  "je suis dans la facture ".$tab_facture[$i]['Montant'];
					echo '<br>';
				//	echo "je suis le iii == ".$i;
				//	echo $montant_total;
					
				//	echo $tab_facture[$i - 1]['Montant'];	
				//echo $tab_facture[$i]['Montant'];
					$montant_total = $montant_total - $tab_facture[$i]['Montant'];
					//echo $montant_total;
					echo '<br>';
					echo "je suis le nouveau montant_total  ".$montant_total;
					echo '<br>';
				}
				else if (($montant_total > 0 ) && $tab_facture[$i]['Montant'] < $montant_total)
				{

					echo "je suis le nouveau montant_total ".$montant_total;
					echo '<br>';
					echo  "je suis dans la facture ".$tab_facture[$i]['Montant'];
					echo '<br>';
				//	echo "je suis le iii == ".$i;
				//	echo $montant_total;
					
				//	echo $tab_facture[$i - 1]['Montant'];	
				//echo $tab_facture[$i]['Montant'];
					$montant_total = $montant_total - $tab_facture[$i]['Montant'];
					//echo $montant_total;
					echo '<br>';
					echo "je suis le new montant_total  ".$montant_total;
					echo '<br>';
				}
				else if ($montant_total > 0 && $tab_facture[$i]['Montant'] > 0 && ($montant_total < $tab_facture[$i]['Montant']) && ($tab_facture[$i - 1]['Montant'] > 0))
				{
					//$tab_facture[$i]['Montant'] = $tab_facture[$i]['Montant'] - $montant_total;
					 
					 $tab_facture[$i]['Montant'] = $tab_facture[$i]['Montant'] - $montant_total ;
					//$rest_fact = $tab_facture[$i]['Montant'] - $montant_total;
					 $montant_total = $montant_total - $montant_total;
					echo "je suis tab_facture  ".$tab_facture[$i]['Montant'];
					echo '<br>';
					//echo "je suis le rest ".$rest_fact;
					echo '<br>';
					echo "montant_total ".$montant_total;
					echo '<br>';
				}

				$i--;
			}
			
		}

			
		//calculer le prix avec le montant totale

			//for ($_POST[])


		} 


		
		/*$dml = "  INSERT INTO `orders_payment` 
								( `payment_date`, `payment_reference`,
								 `uncharged_amount`,  `amount`)
						VALUES
							( now(), '".$_POST['reference']."', 
							 '', '".$_POST['montant']."')";

		inserer les bonne valeurs
    */
	/*
	recuperer les numero de factures des plus anciennes au plus recentes 
	apres récperer leurs order_id apres recuperer la valeur a chaque fois faire montant - balance du a chaque fois qu'il ya un num de facture

	1------recuperer le tableau des factures impayer commencer de la fin et enlever la somme qu'il faut et la somme totale
	des que j'enregistre je les mets dans un tableau je le parcours et j'enleve de ma somme.	
	calcule du montant a enlever
	*/
	//$dml = "select "

	}
    

    if ( $show_actions != 1)
	 	{
	 		echo '<table style="position:absolute;top:80px; margin-left:150px;">
	 		<tr>
	 		<td bgcolor="#C0C0C0">'.$BALANCE_T[$languages_id].'</td>
	 		<td bgcolor="#C0C0C0" align=right>'.$currencies->format($total_du,1,$customer_currency,$recordSet->fields['currency_value']).'</td>
	 		</tr>
	 		<tr>
	 		<td bgcolor="#C0C0C0">'.$BALANCE_DUE[$languages_id].' </td>
	 		<td bgcolor="#C0C0C0" align=right> '.$currencies->format($balance_du,1,$customer_currency,$recordSet->fields['currency_value'] ).'</td>
	 		</tr>
	 		<tr>
	 		<td bgcolor="#C0C0C0">'.$CREDIT[$languages_id].'</td> 
	 		<td bgcolor="#C0C0C0" align=right>'.$currencies->format($max_credit,1,$customer_currency,$recordSet->fields['currency_value']).'</td>
	 		</table>';
    	}
    echo '<table>';
	 
	 /*
	 echo '<hr>';
	 echo '<br>';
	 echo '<b>'.$total_du.'</b>';
	 
echo '</body>	 
</html>';
	  /*$customers_company = str_replace("'","",$rsc->fields['customers_company']);
				  $database_code = $rsc->fields['database_code'];
				  $customers_country = $rsc->fields['customers_country'];
				  $date_purchased =  $rsc->fields['date_purchased'];
				  
				  
				  $sql = "select max_credit 
						  from ".$ext_db_database[$database_code].".customers 
						  where customers_id = ".$coface_customers_id;
						  
				  $rsm = $db->Execute($sql);
				  $max_credit = $rsm->fields["max_credit"];
				  
				$sql = "SELECT sum(order_total) en_cours
							 FROM     orders
							 WHERE    orders_status=2 
							 and      customers_id = ". $coface_customers_id." 
							 and  database_code ='".$database_code."'" ;
					 
				$rsr = $db->Execute($sql);			
				$en_cours = $rsr->fields["en_cours"];*/
?>	