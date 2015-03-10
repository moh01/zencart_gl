<?php

  require('includes/defines.php');
  //require('el_fonctions_gestion.php');
  
echo '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Rapprochement</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } ">';

  // tous les paiements non rapprochés
  
  
  if (!isset($currencies)) {
	require(DIR_WS_CLASSES . 'currencies.php');
	$currencies = new currencies();
  }
	 $bds = array("eu","fr","es","de","en");
	 foreach ($bds as $dtb) 
	 {
		
		$res = @mysql_connect($ext_db_server["gl"], $ext_db_username["gl"] ,$ext_db_password["gl"]) or die ("probleme connexion");
		@mysql_select_db($ext_db_database["gl"],$res) or die ("probleme dans selection base");
		
		$sql = "select * from  el_log_cc_transactions where orders_id = 0 and bank_response_code='00' and database_code = '".$dtb."'";

echo $sql.'<br>';

		$transaction = $db->Execute($sql);
		while ( ! $transaction->EOF )
		{
			$paiement_identifie = 0;
	 
			$sql 	= "select * from orders where order_total*100=".$transaction->fields['amount'] . " and customers_id = " . $transaction->fields['customers_id'] ;
echo $sql.'<br>';
			$db->connect($ext_db_server[$dtb], $ext_db_username[$dtb], $ext_db_password[$dtb], $ext_db_database[$dtb], USE_PCONNECT, false);				
			
			$ord = $db->Execute($sql);
			while ( ! $ord->EOF )
			{
			   $paiement_identifie++;			
			   $ord->MoveNext();
			}
			if ( $paiement_identifie == 1 )
			{
			    $dml = "update orders set payment_info = ".$transaction->fields['authorisation_id']." ,  orders_date_finished=now() where orders_id = " . $ord->fields['orders_id'] ;
				echo $dml.'<br>';
			    $db->Execute($dml);

			    // flag  du paiement
			    $db->connect($ext_db_server["gl"], $ext_db_username["gl"], $ext_db_password["gl"], $ext_db_database["gl"], USE_PCONNECT, false);				
			    $dml = "update el_log_cc_transactions set orders_id = ". $ord->fields['orders_id'] . " where  authorisation_id = ".$transaction->fields['authorisation_id'] ;
			    $db->Execute($dml);
				
            }			
			
    	   $transaction->MoveNext();				
		}
	}
/*		 
				   $db->connect($ext_db_server["gl"], $ext_db_username["gl"], $ext_db_password["gl"], $ext_db_database["gl"], USE_PCONNECT, false);				
				   $dml = "update el_log_cc_transactions set orders_id = ". $ord->fields['orders_id'] . " where  authorisation_id = ".$transaction->fields['authorisation_id'] ;
				   $db->Execute->($dml);
*/		 
?>	