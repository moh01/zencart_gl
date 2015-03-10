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
//  DESCRIPTION:   Generates a pop-up window to edit    //
//  the selected order information, broken into         //
//  sections: contact, product, history, and total.     //
//  payment_mode //
//////////////////////////////////////////////////////////
// $Id: super_edit.php 27 2006-02-03 20:06:12Z BlindSide $
*/

  //_TODO merge orders code
  // 1. Set orders_id in `orders_products`
  //                     `orders_products_attributes`
  //                     `orders_products_download`
  //                     `orders_status_history` (mark w/ original order #)
  // 2. Add a new "merged" status entry
  // 3. Recalc order total
  // 4. Remove merged order's entry in `orders` table

  // SO_TODO change payment method of an order

  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'order.php');
  require('el_fonctions_gestion.php');
  
  require(DIR_WS_CLASSES . 'super_order.php');
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
 
  
  
  global $db;
  if (strlen($_GET['batch_id']>0))
  {
	$db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);
    $sql = "select item_id from el_batch_items where batch_id = ". $_GET['batch_id'];	
    $rs = $db->Execute($sql);

	$batch_items = Array();
	$cnt_cmdes = 0;
	while (!$rs->EOF)
	{
	   $cnt_cmdes++;
	   $batch_items[] = $rs->fields['item_id'];
	   $rs->MoveNext();
	}
    $les_cmdes = implode(',',$batch_items);	
  }  
  else 
  {
    echo "Paramètre d'entrée manquant";
  }

if  (  (strlen( $_SESSION['source_db'] )>0) &&  ( $_SESSION['source_db'] != 'gl' ) )
{
   $db->connect($ext_db_server[$_SESSION['source_db']], $ext_db_username[$_SESSION['source_db']], $ext_db_password[$_SESSION['source_db']], $ext_db_database[$_SESSION['source_db']], USE_PCONNECT, false);
}
  
  // temporaire
//echo strlen($_GET['payment_method']).'..';  
  if (  (   strlen($_GET['payment_method'])>0 
			) 
	  )
	{
	    if ( $_GET['validation_statut']==1 )
		{
		    $dml = "update orders set orders_status  = 3
					where  orders_status  = 2
					and orders_id in (" . $les_cmdes . ")";
//echo $dml .'<br>';
			$db->Execute($dml);					 		    
		}
		if (  strlen ( $_GET['orders_date_finished'] ) == 0 )
		{
		   $orders_date_finished = 'NULL';// el_format_bd('0000-00-00 00:00:00');
		}  
		else
		{
			$orders_date_finished=el_format_bd($_GET['orders_date_finished']);
		}

		if (  strlen ( $_GET['orders_date_finished2'] ) == 0 )
		{
		   $orders_date_finished2 = 'NULL';// el_format_bd('0000-00-00 00:00:00');
		   echo 'a';
		}  
		else
		{
			$orders_date_finished2=el_format_bd($_GET['orders_date_finished2']);
		}
		
		
//		echo  strlen( $_GET['payment_info'] ) ;exit;
		if ( strlen( $_GET['payment_info'] )  > 0 )
        {		
			if ( ($orders_date_finished=='0000-00-00 00:00:00') 
                 || (strlen($orders_date_finished)==0)
				 || ($orders_date_finished=='NULL')			)
			   $orders_date_finished = exec_select ( "select now()  value" );
        }		
		$orders_date_finished = $_GET['orders_date_finished'];
        $payment_amount = $_GET['payment_amount'];
		
		
	    $dml = "update orders set payment_method  = '" . $_GET['payment_method'] . "' , 
		                          payment_info  = '" . $_GET['payment_info'] . "' , 
								  orders_date_finished = '" . $orders_date_finished . "' , 
								  payment_amount = '" . $payment_amount . "' , 								  
		                          payment_info2  = '" . $_GET['payment_info2'] . "' , 
								  orders_date_finished2 = '" . $orders_date_finished2 . "' , 
								  payment_amount2 = '". $_GET['payment_amount2']. "' , 								  								  
             	                  payment_conditions_desc =  '" . $_GET['payment_conditions_desc'] . "' 
								 where orders_id in (".$les_cmdes.") ";
								 
//echo $dml .'<br>';exit;
								 $db->Execute($dml);					 
	
	echo '
		<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
		<html>
		<head>
		<title><?php echo REDIRECT; ?></title>
		<script language="JavaScript" type="text/javascript">
		  <!--
		  function returnParent() {
		    window.opener.location.reload(true);
		    window.opener.focus();
		    self.close();
		  }
		  //-->
		</script>
		</head>
		<!-- header_eof //-->
		<body onload="returnParent()">
		</body>
		</html>';
	exit;
	}
  

  
  $target = $_REQUEST['target'];  // 'contact', 'product', 'history', or 'total'
  $oID = (int)$_REQUEST['oID'];
  $batch_id = (int)$_REQUEST['batch_id'];
  
  $order = new order($oID);

  // recreate the $order->products array, adding in some extra fields
  $index = 0;
  $orders_products = $db->Execute("select orders_products_id, products_name, products_model,
                                          products_price, products_tax, products_quantity,
                                          final_price, onetime_charges,
                                          product_is_free, products_id
                                   from " . TABLE_ORDERS_PRODUCTS . "
                                   where orders_id = '" . $oID . "'");

  while (!$orders_products->EOF) {
    // convert quantity to proper decimals - account history
    if (QUANTITY_DECIMALS != 0) {
      $fix_qty = $orders_products->fields['products_quantity'];
      switch (true) {
        case (!strstr($fix_qty, '.')):
          $new_qty = $fix_qty;
        break;
        default:
          $new_qty = preg_replace('/[0]+$/', '', $orders_products->fields['products_quantity']);
        break;
      }
    } else {
      $new_qty = $orders_products->fields['products_quantity'];
    }

    $new_qty = round($new_qty, QUANTITY_DECIMALS);

    if ($new_qty == (int)$new_qty) {
      $new_qty = (int)$new_qty;
    }

    $order->products[$index] = array('qty' => $new_qty,
                                     'name' => $orders_products->fields['products_name'],
                                     'products_id' => $orders_products->fields['products_id'],
                                     'model' => $orders_products->fields['products_model'],
                                     'tax' => $orders_products->fields['products_tax'],
                                     'price' => $orders_products->fields['products_price'],
                                     'onetime_charges' => $orders_products->fields['onetime_charges'],
                                     'final_price' => $orders_products->fields['final_price'],
                                     'product_is_free' => $orders_products->fields['product_is_free'],
                                     'orders_products_id' => $orders_products->fields['orders_products_id']);

    $subindex = 0;
    $attributes = $db->Execute("select products_options, products_options_values, options_values_price,
                                       price_prefix,
                                       product_attribute_is_free
                                from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . "
                                where orders_id = '" . $oID . "'
                                and orders_products_id = '" . (int)$orders_products->fields['orders_products_id'] . "'");
    if ($attributes->RecordCount()>0) {
      while (!$attributes->EOF) {
        $order->products[$index]['attributes'][$subindex] = array('option' => $attributes->fields['products_options'],
                                                                  'value' => $attributes->fields['products_options_values'],
                                                                  'prefix' => $attributes->fields['price_prefix'],
                                                                  'price' => $attributes->fields['options_values_price'],
                                                                  'product_attribute_is_free' => $attributes->fields['product_attribute_is_free']);

        $subindex++;
        $attributes->MoveNext();
      }
    }

    $index++;
    $orders_products->MoveNext();
  }  // END while (!$orders_products->EOF) {


  if ($_POST['process'] == 1) {
    $update = array();
    switch ($target) {

      case 'payment_mode':
	    $dml = "update orders set payment_method  = '" . $_POST['payment_method'] . "' , 
             	                 payment_conditions_desc =  '" . $_POST['payment_conditions_desc'] . "' 
								 where orders_id = '" . $oID . "'";

								 $db->Execute($dml);					 
	  
/*	  
	    $dml = "update orders set payment_method  = '" . _$POST['payment_method'] . "' , 
             	                 payment_module_code =  '" . _$POST['payment_module_code'] . "' 
								 where orders_id = '" . $oID . "'";
*/
//        $db->Execute($dml);
        break;	  	
    }  // END switch ($target)
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php echo REDIRECT; ?></title>
<script language="JavaScript" type="text/javascript">
  <!--
  function returnParent() {
    window.opener.location.reload(true);
    window.opener.focus();
    self.close();
  }
  //-->
</script>
</head>
<!-- header_eof //-->
<body onload="returnParent()">
</body>
</html>
<?php
  }  // END if ($_POST['process'] == 1)
  else {
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<script language="JavaScript" type="text/javascript">
  <!--
  function closePopup() {
    window.opener.focus();
    self.close();
  }
  //-->
</script>
</head>
<!-- header_eof //-->
<body onload="self.focus()">
<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr>
<!-- body_text //-->
  <td align="center"><table border="0" cellspacing="0" cellpadding="2">
<?php
    echo '    ' . zen_draw_form('edit', 'super_edit_batch.php', '', 'get', '', true) . NL;  
  
  echo '      ' . zen_draw_hidden_field('target', $target) . NL;
  echo '      ' . zen_draw_hidden_field('process', 1) . NL;
  echo '      ' . zen_draw_hidden_field('oID', $oID) . NL;
  echo '      ' . zen_draw_hidden_field('batch_id', $batch_id) . NL;

?>
<?php
  switch ($target) {
    case 'payment_mode'; 
	    $payment_module_code = $order->info['payment_module_code'];
		$payment_method = $order->info['payment_method'];

	    $payment_conditions_code = $order->info['payment_conditions_code'];
		$payment_conditions_desc = $order->info['payment_conditions_desc'];		
		
		$payment_info =  $order->info['payment_info'];	
		$payment_amount =  $order->info['payment_amount'];	
		$orders_date_finished =  $order->info['orders_date_finished'];	

		$payment_info2 =  $order->info['payment_info2'];	
		$payment_amount2 =  $order->info['payment_amount2'];	
		$orders_date_finished2 =  $order->info['orders_date_finished2'];	

		
		if ( ($orders_date_finished=='0000-00-00 00:00:00') || (strlen($orders_date_finished)==0) )
  		   $orders_date_finished = "";

//echo 		   $orders_date_finished2;exit;
		   
		if ( ($orders_date_finished2=='0000-00-00') || (strlen($orders_date_finished2)==0) )
  		   $orders_date_finished2 = "";
		   
//echo 'a';exit;		
	    if ($_GET['cgt']==1)
		{
		
		   //  on place l'update et on 
		   $dml = "update orders set payment_conditions_desc='".$_GET['payment_conditions_desc']."' , payment_module_code = '".$_GET['payment_module_code']."',  payment_info = '".$_GET['payment_info']."' ,  payment_amount = '".$_GET['payment_amount']."'  where orders_id=".$_GET['oID'] ; 
		   $db->Execute( $dml );

		   $payment_module_code = $_GET['payment_module_code'];
    	   $payment_conditions_desc = $_GET['payment_conditions_desc'];
		   
		   // intitulés
		   $LIB_PAYMENT['CC'][2] = 'Carte de crédit';
		   $LIB_PAYMENT['CC'][3] = 'Tarjeta de credito';
		   $LIB_PAYMENT['CC'][4] = 'KreditKart';
		   $LIB_PAYMENT['CC'][5] = 'Credit Card';
		   $LIB_PAYMENT['CC'][6] = 'Carta di credito';

		   $LIB_PAYMENT['LDC'][2] = 'Lettre de change';
		   $LIB_PAYMENT['LDC'][3] = 'Lettre de change';
		   $LIB_PAYMENT['LDC'][4] = 'Lettre de change';
		   $LIB_PAYMENT['LDC'][5] = 'Lettre de change';
		   $LIB_PAYMENT['LDC'][6] = 'Lettre de change';
		   
		   
		   $LIB_PAYMENT['COD'][2] = 'Contre remboursement';
		   $LIB_PAYMENT['COD'][3] = 'Contra reembolso';
		   $LIB_PAYMENT['COD'][4] = 'Nachname';
           $LIB_PAYMENT['COD'][5] = 'Cash on delivery';
		   $LIB_PAYMENT['COD'][6] = 'Contrassegno';

		   $LIB_PAYMENT['PPL'][2] = 'Paypal';
		   $LIB_PAYMENT['PPL'][3] = 'Paypal';
		   $LIB_PAYMENT['PPL'][4] = 'Paypal';
           $LIB_PAYMENT['PPL'][5] = 'Paypal';
		   $LIB_PAYMENT['PPL'][6] = 'Paypal';
		   
		   $LIB_PAYMENT['CHQ'][2] = 'Chèque';
		   $LIB_PAYMENT['CHQ'][3] = 'Talon';
		   $LIB_PAYMENT['CHQ'][4] = 'Scheck';
		   $LIB_PAYMENT['CHQ'][5] = 'Check';
		   $LIB_PAYMENT['CHQ'][6] = 'Assegno';
		   
		   
		   $LIB_PAYMENT['VIR'][2] = 'Virement';
		   $LIB_PAYMENT['VIR'][3] = 'Transferencia';
		   $LIB_PAYMENT['VIR'][4] = 'Uberweisung';
		   $LIB_PAYMENT['VIR'][5] = 'Money order';	
		   $LIB_PAYMENT['VIR'][6] = 'Bonifico bancario';		   
		   

		   $LIB_PAYMENT['MKP_ebay'][2] = 'Ebay.';
		   $LIB_PAYMENT['MKP_ebay'][3] = 'Ebay.';
		   $LIB_PAYMENT['MKP_ebay'][4] = 'Ebay.';
		   $LIB_PAYMENT['MKP_ebay'][5] = 'Ebay.';		   
		   $LIB_PAYMENT['MKP_ebay'][6] = 'Ebay.';		   
		   
		   $LIB_PAYMENT['MKP_rdc'][2] = 'rdc.';
		   $LIB_PAYMENT['MKP_rdc'][3] = 'rdc.';
		   $LIB_PAYMENT['MKP_rdc'][4] = 'rdc.';
		   $LIB_PAYMENT['MKP_rdc'][5] = 'rdc.';		   
		   $LIB_PAYMENT['MKP_rdc'][6] = 'rdc.';		   

		   $LIB_PAYMENT['MKP_amazon'][2] = 'amazon.';
		   $LIB_PAYMENT['MKP_amazon'][3] = 'amazon.';
		   $LIB_PAYMENT['MKP_amazon'][4] = 'amazon.';
		   $LIB_PAYMENT['MKP_amazon'][5] = 'amazon.';		   
		   $LIB_PAYMENT['MKP_amazon'][6] = 'amazon.';	

		   $LIB_PAYMENT['MKP_pixmania'][2] = 'pixmania.';
		   $LIB_PAYMENT['MKP_pixmania'][3] = 'pixmania.';
		   $LIB_PAYMENT['MKP_pixmania'][4] = 'pixmania.';
		   $LIB_PAYMENT['MKP_pixmania'][5] = 'pixmania.';		   
		   $LIB_PAYMENT['MKP_pixmania'][6] = 'pixmania.';		   
		   
		   $LIB_PAYMENT['MKP_fnac'][2] = 'fnac.';
		   $LIB_PAYMENT['MKP_fnac'][3] = 'fnac.';
		   $LIB_PAYMENT['MKP_fnac'][4] = 'fnac.';
		   $LIB_PAYMENT['MKP_fnac'][5] = 'fnac.';		   
		   $LIB_PAYMENT['MKP_fnac'][6] = 'fnac.';		   

		   $LIB_PAYMENT['MKP_pm'][2] = 'price minister.';
		   $LIB_PAYMENT['MKP_pm'][3] = 'price minister.';
		   $LIB_PAYMENT['MKP_pm'][4] = 'price minister.';
		   $LIB_PAYMENT['MKP_pm'][5] = 'price minister.';		   
		   $LIB_PAYMENT['MKP_pm'][6] = 'price minister.';		   
		   
     	   $payment_method = $LIB_PAYMENT[$payment_module_code][$order->info['languages_id']];
		   
		}
	    else if ($_GET['cgt']==2)
		{
		   //  on place l'update et on 
		   $db->Execute("update orders set payment_method = '".$_GET['payment_method']."',  payment_conditions_code = '".$_GET['payment_conditions_code']."' where orders_id=".$_GET['oID'] );
		   $payment_conditions_code = $_GET['payment_conditions_code'];
		   $payment_method = $_GET['payment_method'];
                               
		   // intitulés
		   $LIB_PAYMENT['30JN'][2] = '30 jours nets.';
		   $LIB_PAYMENT['30JN'][3] = '30 dias netos.';
		   $LIB_PAYMENT['30JN'][4] = '30 Tage netto.';
		   $LIB_PAYMENT['30JN'][5] = '30 days.';
		   $LIB_PAYMENT['30JN'][6] = '30 giorni.';

		   $LIB_PAYMENT['30FM'][2] = '30 jours fin de mois.';
		   $LIB_PAYMENT['30FM'][3] = '30 dias.';
		   $LIB_PAYMENT['30FM'][4] = '30 Tage';
		   $LIB_PAYMENT['30FM'][5] = '30 days end of month';
		   $LIB_PAYMENT['30FM'][6] = '30 days dalla fine del mese';

		   $LIB_PAYMENT['45JN'][2] = '45 jours nets.';
		   $LIB_PAYMENT['45JN'][3] = '45 dias netos.';
		   $LIB_PAYMENT['45JN'][4] = '45 Tage netto.';
		   $LIB_PAYMENT['45JN'][5] = '45 days.';		
		   $LIB_PAYMENT['45JN'][6] = '45 giorni';		
		   
		   $LIB_PAYMENT['60JN'][2] = '60 jours nets.';
		   $LIB_PAYMENT['60JN'][3] = '60 dias netos.';
		   $LIB_PAYMENT['60JN'][4] = '60 Tage netto.';
		   $LIB_PAYMENT['60JN'][5] = '60 days.';		   
		   $LIB_PAYMENT['60JN'][6] = '60 giorni.';		   

		   $LIB_PAYMENT['RF'][2] = 'A réception de facture.';
		   $LIB_PAYMENT['RF'][3] = 'A recepcion de su factura.';
		   $LIB_PAYMENT['RF'][4] = 'Auf Rechnung.';
		   $LIB_PAYMENT['RF'][5] = 'Upon invoice reception.';		   
		   $LIB_PAYMENT['RF'][6] = 'All recevimento.';		   

		   
		   
     	   $payment_conditions_desc = $LIB_PAYMENT[$payment_conditions_code][$order->info['languages_id']];
//     	   $payment_conditions_desc =		   $payment_conditions_code;
		}
		else if ( strlen($_GET['payment_conditions_desc'])>0 || strlen($_GET['payment_method'])>0 )
		{
		   	  echo '
			<script language="JavaScript" type="text/javascript">
			   returnParent();
			</script>
			</body>
			</html>';
			exit;
		}
		
	    echo  '<table>';
		echo  '<input type="hidden" name="cgt">';
        // sélection 1
	    echo  '<tr><td colspan=2 bgcolor=red align=center><b>ATTENTION MODIFICATION DE '. $cnt_cmdes  . ' COMMANDES !</b></td></tr>';
		
	    echo  '<tr><td colspan=2 bgcolor=gray align=center><b>Méthode de paiement</b></td></tr>';
		$html =  "<tr><td colspan=2  align=center><select  name=\"payment_module_code\">"; 
		$html .=  '<option value="">Sélectionner une méthode';
			   			   
		$html .=  '<option value="'. $get_paiement_url . 'CC">Carte de crédit' ;
		$html .=  '<option value="'. $get_paiement_url . 'CHQ">Chèque' ;
		$html .=  '<option value="'. $get_paiement_url . 'LDC">Lettre de change' ;		
		$html .=  '<option value="'. $get_paiement_url . 'VIR">Virement' ;
		$html .=  '<option value="'. $get_paiement_url . 'COD">COD-Contre remboursement' ;		
		$html .=  '<option value="'. $get_paiement_url . 'PPL">Paypal' ;		
		$html .=  '<option value="'. $get_paiement_url . 'MKP_ebay">Mkp ebay' ;		
		$html .=  '<option value="'. $get_paiement_url . 'MKP_amazon">Mkp amazon' ;		
		$html .=  '<option value="'. $get_paiement_url . 'MKP_darty">Mkp darty' ;		
		$html .=  '<option value="'. $get_paiement_url . 'MKP_allegro">Mkp allegro' ;		
		$html .=  '<option value="'. $get_paiement_url . 'MKP_pixmania">Mkp pixmania' ;		
		$html .=  '<option value="'. $get_paiement_url . 'MKP_rdc">Mkp rdc' ;		
		$html .=  '<option value="'. $get_paiement_url . 'MKP_fnac">Mkp fnac' ;				
		$html .=  '<option value="'. $get_paiement_url . 'MKP_pm">Mkp price minister' ;		
		$html .=  '</select>';		
		$html .=  '</td></tr>';
		echo eregi_replace('"'.$payment_module_code.'"' , '"'.$payment_module_code.'" SELECTED' ,$html );
		
	    echo  '<tr><td>Description</td><td><input type="text" name="payment_method" value="'.$payment_method.'"></td></tr>';
									 
									 
	    echo  '<tr><td colspan=2 bgcolor=gray align=center><b>Conditions de paiement</b></td></tr>';
		$html =  "<tr><td colspan=2  align=center><select  name=\"payment_conditions_code\" >"; 
		$html .=  '<option value="">Sélectionner les conditions de payment';
			   			   
		$html .=  '<option value="'. $get_paiement_url . '30JN">30 jours nets' ;
		$html .=  '<option value="'. $get_paiement_url . '30FM">30 jours fin de mois' ;
		$html .=  '<option value="'. $get_paiement_url . '45JN">45 jours nets' ;
		$html .=  '<option value="'. $get_paiement_url . '60JN">60 jours nets' ;
		$html .=  '<option value="'. $get_paiement_url . 'RF">A réception de facture' ;
		$html .=  '<option value="'. $get_paiement_url . 'ORD">A réception de commande' ;		
		
		$html .=  '</select>';		
		$html .=  '</td></tr>';
		echo eregi_replace('"'.$payment_conditions_code.'"' , '"'.$payment_conditions_code.'" SELECTED' ,$html );
	    echo  '<tr><td>Description</td><td><input type="text" name="payment_conditions_desc" value="'.$payment_conditions_desc.'"></td></tr>';

	    echo  '<tr><td colspan=2 bgcolor=gray align=center><b>Ref Paiement</b></td></tr>';
	    echo  '<tr><td>Ref</td><td>
		       <input type="text" size=40 name="payment_info" value="'.$payment_info.'">
			   </td></tr>';
	    echo  '<tr><td>Date paiement</td><td>
		       <input type="text"  name="orders_date_finished" value="'.zen_date_short($orders_date_finished).'">
			   </td>
			   </tr>';

	    echo  '<tr><td>Montant paiement</td><td>
		       <input type="text"  name="payment_amount" value="'.$payment_amount.'">
			   </td>';			   
			   
		echo  '<tr><td colspan=2> &nbsp; </td>';		
		echo '</tr>';

	    echo  '<tr><td colspan=2 bgcolor=gray align=center><b>Ref paiement2</b></td></tr>';		
		
		echo  '<tr><td>Ref paiement 2 </td><td>
		       <input type="text"  name="payment_info2" size=40 value="'.$payment_info2 .'">
			   </td>';
	    echo  '</tr>';		

		
	    echo  '<tr><td>Date paiement 2 </td><td>
		       <input type="text"  name="orders_date_finished2" value="'.zen_date_short($orders_date_finished2).'">
			   </td>';
	    echo  '</tr>';
		
	    echo  '<tr><td>Montant paiement 2 </td><td>
		       <input type="text"  name="payment_amount2" value="'.$payment_amount2.'">
			   </td>';
	    echo  '</tr>';				
//		if  ( $_SESSION['admin_id']==1 )
//		{
		    echo  '<tr><td>Statut->Réglée</td>
			       <td><input type="checkbox" 
				              value=1 name="validation_statut" "'.$check_validation_statut.'"></td></tr>';		
//        }		
		echo  '</table>';
			   
	  break;

  }  // END switch ($target)
?>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '15'); ?></td>
      </tr>
      <tr>
        <td class="main" colspan="3" align="right">
          <input type="button" value="Annuler" onclick="closePopup()">
          <input type="submit" value="Valider" onclick="document.edit.submit();this.disabled=true">
        </td>
      </tr>
      </form>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->
</body>
</html>
<?php
  }  // END else
?>