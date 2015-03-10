<?php
  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
echo '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Nouvelle pièce</title>
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
  
    
    $dtb = $_GET['customer_db'];
	$customers_id = $_GET['customers_id'];
	
    $dtb = "eu";
    $customers_id = 80102;
	

	 $couleur_reglee = "dbdaeb";
	 $couleur_non_reglee = "e7cad4"; 
	  
	  echo '<br><br>';
      echo '<table><tr><td>
	        <b>Commandes en cours</b> 
             </td>
			 <td>
			    <table><tr><td bgcolor="'.$couleur_non_reglee.'"> &nbsp;&nbsp;&nbsp; Non envoyées &nbsp;&nbsp;&nbsp; </td></tr></table>
             </td>
			 <td>
			    <table><tr><td bgcolor="'.$couleur_reglee.'"> &nbsp;&nbsp;&nbsp; Envoyées &nbsp;&nbsp;&nbsp; </td></tr></table>
             </td>			 
			 </tr></table>';
	  
		$sql = "SELECT o.orders_id, date_format(o.date_purchased,\"%d-%c-%Y\") date_purchased , o.delivery_name, o.customers_telephone, o.customers_email_address,
                               o.billing_name,o.delivery_name, ot.text as order_total, s.orders_status_name,
							   o.orders_status, o.ref_info
                        FROM       " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot, " . TABLE_ORDERS_STATUS . " s
                        WHERE      o.customers_id = " . $customers_id . "
                        AND        o.orders_id = ot.orders_id
                        AND        ot.class = 'ot_total'
                        AND        o.orders_status = s.orders_status_id
                        AND        s.language_id = 2
						AND        o.orders_status <> 4
                        ORDER BY   date_purchased desc ";
/*
*/						
	 echo '<table>';	
	 echo '<tr>';		 
     echo '<th>Date</th>';
     echo '<th>Num cmd</th>';	 
     echo '<th>Ref cmd</th>';	 	 
     echo '<th>Ship to</th>';	 	 
     echo '<th>Montant</th>';
 	 echo '</tr>';		 
	 
	 
	 $recordSet = $db->Execute($sql);
	 while ( ! $recordSet->EOF )
	 {
	    if ( $recordSet->fields['orders_status']!=2 )
		{
    	    echo '<tr  bgcolor="'. $couleur_reglee .'">';
		}
		else
		{
    	    echo '<tr bgcolor="'. $couleur_non_reglee .'">';
		}
		
	    echo '<td>';
          echo $recordSet->fields['date_purchased'];
	    echo '&nbsp;&nbsp;&nbsp;</td>';
	    echo '<td>';
          echo $recordSet->fields['orders_id'];
	    echo '&nbsp;&nbsp;&nbsp;</td>';		
	    echo '<td>';
          echo $recordSet->fields['ref_info'];
	    echo '&nbsp;&nbsp;&nbsp;</td>';		
	    echo '<td>';
          echo $recordSet->fields['delivery_name'];
	    echo '&nbsp;&nbsp;&nbsp;</td>';				
				
	    echo '<td align="right">';
          echo $recordSet->fields['order_total'];
	    echo '&nbsp;&nbsp;&nbsp;</td>';		
	    echo '<td>&nbsp;&nbsp;&nbsp;';				
     	  $link = 'includes/modules/pdfoc/temp_pdf/'. $recordSet->fields['orders_invoices_id'] .'_'. $recordSet->fields['orders_id'] .'batch_orders.pdf';	
		  echo '<a href="javascript:popupInvoice(\''.$link.'\');"> Voir </a>';
	    echo '&nbsp;&nbsp;&nbsp;</td>';						
	    echo '</tr>';
		
	    $recordSet->MoveNext();
	 }
	 echo '</table>';	
echo '</body>	 
</html>';
?>	