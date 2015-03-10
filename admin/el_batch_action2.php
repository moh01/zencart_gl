<?php
  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
  require(DIR_WS_CLASSES . 'order.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Gestion des listes</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body>
<form name="frm">
<br><br>
<table width=100%>
<tr>
<td align=center>
<?php
  global $db;  
function add_field($pvalue)
{
  return $pvalue.'	';
}
Function removeaccents($string){ 
   $string= strtr($string,  "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ$",
                  "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn "); 
   $string= str_replace('ß','ss',$string);
   return $string; 
   } 
function get_country_code ($country)
{

    if (substr($country,0,6) == "France" )
   	$resultat = 'FR';
    else if ( $country == "Deutschland" )
   	$resultat = 'DE';
    else if ( $country == "Österreich" )
   	$resultat = 'AT';
    else if ( $country == "Schweiz" )
   	$resultat = 'CH';
    else if ( $country == "Suisse" )
   	$resultat = 'CH';              			
    else if ( $country == "Belgique" )
   	$resultat = 'BE';    
    else if ( substr($country,0,2) =='UK' )
   	$resultat = 'GB';    						
    else if ( $country == "Luxembourg" )
   	$resultat = 'LX';    												
    else if ( $country == "Italia" )
   	$resultat = 'IT';    																		
    else if ( substr($country,0,4) =='Espa' )
      $resultat = 'ES';                   			          			
    else
      $resultat = '-';                   			          			
		   
	return $resultat;	   
}
  
  function display_date($p_date_in)
  {
    if ($p_date_in=="0000-00-00")
	 return "&nbsp;";
	else
	 return $p_date_in;
  }
  if ($_GET['ok']==1)
  {
	init_batch_items();
	  echo '
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
  }
  else if ($_GET['activate_id']>0)
  {
     $dml = "update el_batch set active=1 where batch_id = ". $_GET['activate_id'];
	 $db->Execute($dml);
  }
  else if ($_GET['inactivate_id']>0)
  {
     $dml = "update el_batch set active=0 where batch_id = ". $_GET['inactivate_id'];
	 $db->Execute($dml);
  }  
  else  if ($_GET['export_id']>0)
  {
   $sql = "select el_batch_items.item_id, el_batch_items.database_code,el_batch_items.description
                  FROM  el_batch_items 
				  WHERE   el_batch_items.batch_id = " . $_GET['export_id'] . "
				  and transporter in ('UPS')
                  ORDER BY id DESC";

    $li = $db->Execute($sql);     
	
    $items_tab_id = array();
	$items_tab_db = array();
	$items_tab_description = array();
	
	$cntr = 0;
    while (!$li->EOF)
	{
	   $cntr++;  
	   $items_tab_id[$cntr] = $li->fields['item_id'];
	   $items_tab_db[$cntr] = $li->fields['database_code'];
	   $items_tab_description[$cntr] = $li->fields['description'];
	   
	   $li->MoveNext();
    }
    $output_xml = '<?xml version="1.0" encoding="UTF-8"?>
<OpenShipments xmlns="x-schema:OpenShipments.xdr">';

	for($k=1;$k<=$cntr;$k++)
	{
      $db_code = $items_tab_db[$k];
	  $order_num = $items_tab_id[$k];
      $db->connect($ext_db_server[$db_code], $ext_db_username[$db_code], $ext_db_password[$db_code], $ext_db_database[$db_code], USE_PCONNECT, false);
      $requete = "select orders_id, order_total , 
                         delivery_name,
                  delivery_company, delivery_street_address, delivery_suburb,
                  orders_id,delivery_postcode,delivery_city,
                  delivery_country,customers_telephone,customers_email_address,
                  payment_method";
      $requete .= " from orders ";
      $requete .= " where orders_id = ".$order_num;
//echo   $requete;exit;    
	  $rs = $db->Execute($requete);
	  
	  
      $output .= add_field($rs->fields['delivery_name']);
      
      if ( strlen ( $rs->fields['delivery_company'] ) < 2  )
	  {
  			$output .= add_field("Individual");
	  }
      else
	  {	  
  			$output .=  add_field($rs->fields['delivery_company']);
  	  }	
  			
      $output .= add_field($rs->fields['delivery_street_address']);

      $output .= add_field($rs->fields['delivery_suburb']);

//      $output .= add_field($rs->fields['delivery_street_address']);
      $sql = "select comments value from orders_status_history where orders_id=".$rs->fields['orders_id'];
      $temp = exec_select ( $sql );      			
//echo $temp;exit;
	  
      $temp = ereg_replace("[^A-Za-z0-9 @&éàèù]", " ", $temp);
      $temp = str_replace(chr(13), ' ', $temp);      		            
      $temp = removeaccents($temp);
	  
      $output .= add_field($temp);
	  $comment = $temp;

      $output .= add_field($rs->fields['delivery_postcode']);

      $output .= add_field($rs->fields['delivery_city']);
      
      $country=$rs->fields['delivery_country'];           
      $output .= add_field(get_country_code($country));
	  
      $output .= add_field($rs->fields['customers_telephone']);

      $output .= add_field('');      			                    	
      $output .= add_field('ST');
      $output .= add_field('1');
      $output .= add_field('1');
      $output .= add_field('Projector lamp');
      $output .= add_field("PP");	         
      $output .= add_field("CP");      			         
      $output .= add_field($rs->fields["orders_id"]);
      $output .= add_field("33 rue de la révolution");   			         
      $output .= add_field("93100");
      $output .= add_field("MONTREUIL");
       			         
     	 if ($db_code=="fr")
		 {
             $tel_sender = "01 71 86 46 57";       			         							 
             $name_sender =   "Lampevideoprojecteur.fr";
		 }
     	 else if ($db_code=="de")
		 {							
             $tel_sender = "01 71 86 46 53";       			         							 							 
             $name_sender = "Alleprojektorlampen";
		 }								
     	 else if ($db_code=="en")
		 {							
             $tel_sender = "01 71 86 46 55";       			         							 							  							 
             $name_sender = "JustProjectorLamps";								
		 }																
     	 else if ($db_code=="it")
		 {							 							 							 
             $tel_sender = "01 71 86 46 54";       			         							 							  							 							 
             $name_sender =  "LampadeProiettori";							                    	    
		 }																								
     	 else if ($db_code=="es")
		 {							 							 							 							 
             $tel_sender = "01 71 86 46 52";       			         							 							 
             $name_sender =  "Lamparasparaproyectores";
		 }																																
     	 else if ($db_code=="eu" )
		 {							
             $tel_sender = "01 71 86 46 60";       			         							 							 							 
             $name_sender =  "Easylamps";
		 }																																
	   $output .= add_field($tel_sender);       			         						
	   $output .= add_field($name_sender);              		 
       $output .= add_field("Sarl Easylamps");       			         
       
       $output .= add_field("Y");       			         
       
       $output .= add_field("1");       			         

       $output .= add_field($rs->fields['customers_email_address']);
       $output .= add_field("");                  

       $payment_method = $rs->fields["payment_method"];
         if ( ( $payment_method == "Nachnahme" ) || ( $payment_method == 'Contra reembolso' ) || ( $payment_method == 'Contrassegno' ) )
         {
              $output .= add_field("Y");
              $output .= add_field($rs->fields["order_total"]);    
              $output .= add_field("EUR");
              $output .= add_field(""); // cash only
/*
<CashOnly>No</CashOnly>					
	    <CashierCheckorMoneyOrderOnlyIndicator>No</CashierCheckorMoneyOrderOnlyIndicator>					
	    <AddShippingChargesToCODIndicator>No</AddShippingChargesToCODIndicator>		
*/			  
		$cod_output = '<COD>				  
<Amount>'. add_field($rs->fields["order_total"]) .'</Amount>					
<Currency>EUR</Currency>					
</COD>';		
         }
         else
         {
              $output .= add_field("N");
              $output .= add_field(0);                       
              $output .= add_field("");
              $output .= add_field(""); // cash only
			  $cod_output = '';  
         }
       $output .='
';
    $addr1 = removeaccents($rs->fields['delivery_street_address']);
    $addr2 = removeaccents($rs->fields['delivery_suburb']);
	if (strlen($comment)>34)
	{
		$strt=34-strlen($addr2)-4;
		$addr2 .= ' '. substr($comment,0,34-strlen($addr2)-2);
		$addr3 = substr($comment,$strt,40);
	}
	else
	{
		$addr3 = $comment;	
	}
	
	if (strlen($rs->fields['delivery_company'])<3)
	{
	   $company = removeaccents($rs->fields['delivery_name']);	   	
	}
	else
	{
	   $company = removeaccents( $rs->fields['delivery_company'] );	
	}
	
    $output_xml .='	  
	<OpenShipment ShipmentOption="" ProcessStatus="">
		<Receiver>
			<CompanyName>'.$company.'</CompanyName>
			<ContactPerson>'.removeaccents($rs->fields['delivery_name']).'</ContactPerson>
			<AddressLine1>'.$addr1.'</AddressLine1>
			<AddressLine2>'.$addr2.'</AddressLine2>
			<AddressLine3>'.$addr3.'</AddressLine3>
			<City>'.$rs->fields['delivery_city'].'</City>
			<CountryCode>'.get_country_code($country).'</CountryCode>
			<PostalCode>'.$rs->fields['delivery_postcode'].'</PostalCode>
			<Phone>'.$rs->fields['customers_telephone'].'</Phone>
			<EmailAddress1>'.$rs->fields['customers_email_address'].'</EmailAddress1>
		</Receiver>
		<Shipper>
			<UpsAccountNumber>2A9663</UpsAccountNumber>
		</Shipper>
		<Shipment>
			<ServiceLevel>ST</ServiceLevel>
			<PackageType>CP</PackageType>
			<NumberOfPackages>1</NumberOfPackages>
			<ShipmentActualWeight>1</ShipmentActualWeight>
			<DescriptionOfGoods>Projector lamp</DescriptionOfGoods>
			<Reference1>'.$rs->fields['orders_id'].'</Reference1>
			<Reference2></Reference2>
			<BillingOption>PP</BillingOption>
			<QuantumViewNotifyDetails>
				<QuantumViewNotify>
					<NotificationEMailAddress>'.$rs->fields['customers_email_address'].'</NotificationEMailAddress>
					<NotificationRequest>5</NotificationRequest>
				</QuantumViewNotify>
				<FailureNotificationEMailAddress>ups@linats.net</FailureNotificationEMailAddress>
				<ShipperCompanyName>'.$name_sender.'</ShipperCompanyName>
				<SubjectLineOptions>SubjectLineOptions</SubjectLineOptions>
				<NotificationMessage>NotificationMessage</NotificationMessage>
			</QuantumViewNotifyDetails>
			'. $cod_output   .'
		</Shipment>
	</OpenShipment>';
	} 	
	 $output=removeaccents($output);
	 $output_xml .='
</OpenShipments>';
	 
  if ($cntr>0)
  {
  //C:\UPS\WSTD\IMPEXP\XML Auto Import\ 
	   echo '
  <SCRIPT LANGUAGE="JavaScript">
function makefile(){
	var fso;var thefile;
	fso = new ActiveXObject("Scripting.FileSystemObject");
	
	thefile=fso.CreateTextFile("C:\\\\TEMPUPS\\\\lot'.$_GET['export_id'].'.xml",true);
    thefile.writeline(document.frm.UPS.value);
	
	thefile.close();
    alert(\'Le fichier est crée.\');	
}
  </SCRIPT>';
  
	  echo '<br>EXTRACTIONS UPS<br>
       <table><tr><td>	  
	       <textarea rows="'. $cntr . '" cols="35"   name="UPS">';
	  echo $output_xml;
	  // <a href="javascript:alert('1');">test</a>
	  echo '</textarea>
	       </td><td><a href="javascript:makefile();">Impression <br> étiquettes</a></td></tr>
		   </table>
	  <br><br>';
   }
   $cntr=0;
   $output = "";
   $db_code = "gl";
   $db->connect($ext_db_server[$db_code], $ext_db_username[$db_code], $ext_db_password[$db_code], $ext_db_database[$db_code], USE_PCONNECT, false);
  
   $sql = "select el_batch_items.item_id, el_batch_items.database_code,el_batch_items.description
                  FROM  el_batch_items 
				  WHERE   el_batch_items.batch_id = " . $_GET['export_id'] . "
				  and transporter in ('DHL')				  
                  ORDER BY id DESC";
	
    $li = $db->Execute($sql);     
	
    $items_tab_id = array();
	$items_tab_db = array();
	$items_tab_description = array();
	
	$cntr = 0;
    while (!$li->EOF)
	{
	   $cntr++;  
	   $items_tab_id[$cntr] = $li->fields['item_id'];
	   $items_tab_db[$cntr] = $li->fields['database_code'];
	   $items_tab_description[$cntr] = $li->fields['description'];
	   
	   $li->MoveNext();
    }
	
	for($k=1;$k<=$cntr;$k++)
	{
       $db_code = $items_tab_db[$k];
  	   $order_num = $items_tab_id[$k];
      $db->connect($ext_db_server[$db_code], $ext_db_username[$db_code], $ext_db_password[$db_code], $ext_db_database[$db_code], USE_PCONNECT, false);
      $requete = "select orders_id, order_total, customers_id,
                         delivery_name,
                  delivery_company, delivery_street_address, delivery_suburb,
                  orders_id,delivery_postcode,delivery_city,
                  delivery_country,customers_telephone,customers_email_address,
                  payment_method, date_format(now(),'%d%m%Y') date_exped";
      $requete .= " from orders ";
      $requete .= " where orders_id = ".$order_num;
      
	  $rs = $db->Execute($requete);
	 
	  
      $output .= add_field($rs->fields['orders_id']);
      $output .= add_field("");   // Numéro de récépissé 26 8 2      
      $output .= add_field($rs->fields['date_exped']); //Date expédition 34 8 3 Format : JJMMAAAA. Par défaut date du jour
      $output .= add_field($rs->fields['customers_id']);

      if ( strlen ( $rs->fields['delivery_company'] ) < 2  )
  			$output .= add_field("Individual");
      else
  			$output .=  add_field($rs->fields['delivery_company']);


      $output .= add_field($rs->fields['delivery_street_address']);

      $output .= add_field($rs->fields['delivery_suburb']);

  		$output .= add_field('');

      $output .= add_field($rs->fields['delivery_postcode']);      
      
      $output .= add_field($rs->fields['delivery_city']);


      $country=$rs->fields['delivery_country'];           
	  
      $codepays = get_country_code($country);
      $output .= add_field($codepays);

      $output .= add_field($rs->fields['delivery_name']);
	  
      $output .= add_field($rs->fields['customers_email_address']);
  
      $output .= add_field($rs->fields['customers_telephone']);
  
      $temp = exec_select ( "select comments from orders_status_history where orders_id=". $rs->fields['orders_id'] ); 
      $temp = ereg_replace("[^A-Za-z0-9 @&éàèù]", " ", $temp);

      $temp = str_replace(chr(13), ' ', $temp);
      $output .= add_field($temp);
		$output .= add_field(""); // remarque
		$output .= add_field("1"); // nb colis
		$output .= add_field("0"); // nb  palette
		$output .= add_field("0"); // nb  palette consignées					
		$output .= add_field("1"); // 1 kg
		$output .= add_field(""); //  volume
		$output .= add_field(""); // longueur
		$output .= add_field(""); // largeur 
		$output .= add_field(""); // hauteur
		$output .= add_field(""); // date demandée
		$output .= add_field(""); // montant contre remb
		$output .= add_field(""); // devise contre rem
		$output .= add_field($rs->fields["order_total"]*100); // valeur 
		$output .= add_field('EUR'); // devise valeur 
		$output .= add_field(""); // valeur déclarée
		$output .= add_field(""); // devise valeur déclarée
		$output .= add_field("Electronic material"); // Nature marchandise
		$output .= add_field("P"); // Port payé
		$output .= add_field(""); //  Incoterm
		$output .= add_field(""); // mauvais
		$output .= add_field(""); // Unité taxable 
		$output .= add_field(""); // code préparateur
		$output .= add_field(""); // matieres dangereuses
		$output .= add_field(""); // code transporteur

		
      if ($codepays=="FR")
		   $code_produit = "N";
		else if (strpos(" 'DE', 'AT','BE','GB', 'LX','IT', 'ES' " , $codepays ) > 0 )
		   $code_produit = "U";
		else if ( strpos($codepays, " 'CH' " )>0)
		   $code_produit = "S";					   
		else 
		   $code_produit = "";

	    $output .= add_field($code_produit); // code produit					
		if ($db_code=="fr")
		 {
			$output .= add_field("LVP");       			         							 
		 }
		 else if ($db_code=="de")
		 {							
			$output .= add_field("APL");       			         							 							 
		 }								
		 else if ($db_code=="en")
		 {							
			$output .= add_field("JPL");       			         							 							  							 
		 }																
		 else if ($db_code=="it")
		 {							 							 							 
			$output .= add_field("LPI");       			         							 							  							 							 
		 }																								
		 else if ($db_code=="es")
		 {							 							 							 							 
			$output .= add_field("LPP");       			         							 							 
		 }																																
		 else if ($db_code=="eu" )
		 {							
			$output .= add_field("EL");       			         							 							 							 
		 }																															

		$output .= add_field(""); // service point			
		$output .= add_field(""); // code service point				

  
     //
     
     // $output .= add_field($rs->fields['customers_telephone']);
      

      if ( strlen ( $rs->fields['delivery_company'] ) < 2  )
  			$output .= add_field("Individual");
      else
  			$output .=  add_field($rs->fields['delivery_company']);
  			
  			

      $temp = exec_select ( "select comments from orders_status_history where orders_id=".$rs->fields['orders_id'] );      			
      $temp = ereg_replace("[^A-Za-z0-9 @&éàèù]", " ", $temp);
      $temp = str_replace(chr(13), ' ', $temp);      		            
      $output .= add_field($temp);
      
      $output .= add_field($rs->fields['delivery_postcode']);

      $output .= add_field($rs->fields['delivery_city']);
      
      $country=$rs->fields['delivery_country'];           
      $output .= add_field(get_country_code($country));

      $output .= add_field('');      			                    	
      $output .= add_field('ST');
      $output .= add_field('1');
      $output .= add_field('1');
      $output .= add_field('Projector lamp');
      $output .= add_field("PP");	         
      $output .= add_field("CP");      			         
      $output .= add_field($rs->fields["orders_id"]);
      $output .= add_field("33 rue de la révolution");   			         
      $output .= add_field("93100");
      $output .= add_field("MONTREUIL");
       			         
     	 if ($db_code=="fr")
		 {
             $output .= add_field("01 71 86 46 57");       			         							 
             $output .= add_field("Lampevideoprojecteur.fr");
		 }
     	 else if ($db_code=="de")
		 {							
             $output .= add_field("01 71 86 46 53");       			         							 							 
             $output .= add_field("Alleprojektorlampen");
		 }								
     	 else if ($db_code=="en")
		 {							
             $output .= add_field("01 71 86 46 55");       			         							 							  							 
             $output .= add_field("JustProjectorLamps");								
		 }																
     	 else if ($db_code=="it")
		 {							 							 							 
             $output .= add_field("01 71 86 46 54");       			         							 							  							 							 
             $output .= add_field("LampadeProiettori");							                    	    
		 }																								
     	 else if ($db_code=="es")
		 {							 							 							 							 
             $output .= add_field("01 71 86 46 52");       			         							 							 
             $output .= add_field("Lamparasparaproyectores");
		 }																																
     	 else if ($db_code=="eu" )
		 {							
             $output .= add_field("01 71 86 46 60");       			         							 							 							 
             $output .= add_field("Easylamps");
		 }																																
              		 
       $output .= add_field("Sarl Easylamps");       			         
       
       $output .= add_field("Y");       			         
       
       $output .= add_field("1");       			         

       $output .= add_field($rs->fields['customers_email_address']);
       $output .= add_field("");                  

       $payment_method = $rs->fields["payment_method"];
         if ( ( $payment_method == "Nachnahme" ) || ( $payment_method == 'Contra reembolso' ) )
         {
              $output .= add_field("Y");
              $output .= add_field($rs->fields["order_total"]);    
              $output .= add_field("EUR");
              $output .= add_field(""); // cash only
   
         }
         else
         {
              $output .= add_field("N");
              $output .= add_field(0);                       
              $output .= add_field("");
              $output .= add_field(""); // cash only
         }
       $output .='
';
	} 	
	 $output=removeaccents($output);
  if ($cntr>0)
  {
 echo '<br>EXTRACTIONS DHL<br>
       <table><tr><td>
       <textarea rows="5" cols="50"   name="DHL">';
 echo $output;
  echo '</textarea>
       </td><td><a href="javascript:alert(1);">Impression étiquettes</a></td></tr>
	   </table>
  <br><br>
  </form>';
   }  
  $db_code = "gl";
  $db->connect($ext_db_server[$db_code], $ext_db_username[$db_code], $ext_db_password[$db_code], $ext_db_database[$db_code], USE_PCONNECT, false);
  
	$dml = "update el_batch set export_date=now() where batch_id = " . $_GET['export_id'];
	$db->Execute($dml);
  }	

?>
<!-- body_eof //-->
<?php

  echo '<table border=1>
        <tr>
        <td>&nbsp;</th>
		   <th colspan=5 bgcolor=#eae5e5>Export des étiquette </th> 
		   <th colspan=4>Facturation automatique</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
        </tr>
        <tr>		 
		<th>Nom du lot</th><th>eu</th><th>fr</th><th>exp</th>	<th>Exporter</th>  <th>Date Export</th>   <th>fr</th><th>exp</th><th>Facturer</th><th>Date Facturation</th><th>Actif?</th><th>Action</th>
		</tr>';
  $sql = "select batch_id, batch_name, export_date, invoice_date, active
          from el_batch
		  order by batch_id desc ";
   $rs=$db->Execute($sql);
   $even=0;
   while(!$rs->EOF)
   {
      if ($even)
      {
		echo "<tr bgcolor=#eae5e5>";
	    $even = 0;
	  }
	  else
      {
		echo "<tr>";
	    $even = 1;
	  }
       $batch_id = $rs->fields["batch_id"];
	   $items_tab_id = array();
	   $items_tab_db = array();

	   $items_inv_tab_id = array();
	   $items_inv_tab_db = array();
	   
	   $sql = "select el_batch_items.item_id, el_batch_items.database_code,el_batch_items.description, 
	                  el_batch_items.sent, el_batch_items.invoice_date
	                  FROM  el_batch_items 
					  WHERE   el_batch_items.batch_id = " . $batch_id . "
	                  ORDER BY id DESC";
//echo $sql."<br>";
					  
	   $li = $db->Execute($sql);     
		
	   $cntr=0;
	   $cntr_inv=0;
	   
	   $cnt_eu=0;
	   $cnt_fr=0;
	   $cnt_ext=0;

	   $cnt_inv_eu=0;
	   $cnt_inv_fr=0;
	   $cnt_inv_ext=0;

	    while (!$li->EOF)
		{
		   if ($li->fields['database_code']!='eu')
		   {		   
			   $items_tab_id[$cntr] = $li->fields['item_id'];
			   $items_tab_db[$cntr] = $li->fields['database_code'];
			   $cntr++;  
			   if ($li->fields['database_code']=='fr')
			   {
			      $cnt_fr++;
			   }
			   else
			   {
			      $cnt_ext++;			   
			   }
//echo 'KKK'.$li->fields['invoice_date'].'kkk';			   
               if ( ($li->fields['invoice_date']=='0000-00-00' )  )
			   {
				   $items_inv_tab_id[$cntr_inv] = $li->fields['item_id'];
				   $items_inv_tab_db[$cntr_inv] = $li->fields['database_code'];
				   $cntr_inv++;  
				   if ($li->fields['database_code']=='fr')
				   {
				      $cnt_inv_fr++;
				   }
				   else
				   {
				      $cnt_inv_ext++;			   
				   }
			   }
   

           }
		   else
		   {
			   $cnt_eu++;
		   }
		   
		   $li->MoveNext();
	    }
		if 	( count($items_tab_id) )
		{
		    $ids = implode  ( ',' , $items_tab_id  );
		    $dbs = implode  ( ',' , $items_tab_db  );
			$extract=1;
	    }
		else
		{
			$extract=0;
	    }
		if 	( count($items_inv_tab_id) )
		{
		    $ids_inv = implode  ( ',' , $items_inv_tab_id  );
			$dbs_inv = implode  ( ',' , $items_inv_tab_db  );
			$invoice=1;
	    }
		else
		{
			$invoice=0;
	    }
		
		echo "<td>".stripslashes($rs->fields['batch_name'])."</td>";
	  
		if ($cnt_eu)
			echo "<td align=center>".$cnt_eu."</td>";
		else
			echo "<td>&nbsp;</td>";

		if ($cnt_fr)
			echo "<td align=center>".$cnt_fr."</td>";
		else
			echo "<td>&nbsp;</td>";

		if ($cnt_ext)
			echo "<td align=center>".$cnt_ext."</td>";
		else
			echo "<td>&nbsp;</td>";
	  
	  
      echo '<td align=center>';	  
	  if ($extract)
	     echo '<a href="el_batch_action.php?export_id='.$batch_id.'">Exporter</a>';	  
	  else
  	     echo '&nbsp;';	  		 
	  echo '</td>';
		 
      echo "<td align=center>".display_date($rs->fields['export_date'])."</td>";	  
		if ($cnt_inv_fr)
			echo "<td align=center>".$cnt_inv_fr."</td>";
		else
			echo "<td>&nbsp;</td>";

		if ($cnt_inv_ext)
			echo "<td align=center>".$cnt_inv_ext."</td>";
		else
			echo "<td>&nbsp;</td>";
		 
      echo '<td>';
	  if ($invoice)
	  {
//	  javascript:if (confirm('Voulez%20vous%20vraiment%20inactiver%20ces%20sessions?')%20)%20{%20document.frm.utis.value='';%20document.frm.submit();}
	  
		echo '<form name="pdfoc_action'.$batch_id.'" action="el_gestion.php?form=action" method="post">
			    <a href="javascript:if (confirm(\'Voulez vous vraiment Facturer cette liste?\') ) { document.pdfoc_action'.$batch_id.'.submit();}">Facturer</a>
				<input name="file_type" value="Invoice.php" type="hidden">
				<input name="invoice_mode" value="final" type="hidden">
				<input name="address" value="delivery" type="hidden">
				<input name="force_db" value="'.$dbs_inv.'" type="hidden">					
				<input name="batch_mode" value="1" type="hidden">					
				<input name="startpos" value="1" type="hidden">
				<input name="show_order_date" value="1" type="hidden">
				<input name="show_comments" value="1" type="hidden">
				<input name="show_phone" value="" type="hidden">
				<input name="show_email" value="" type="hidden">
				<input name="show_pay_method" value="" type="hidden">
				<input name="show_cc" value="" type="hidden">
				<input name="status" value="3" type="hidden">
				<input name="notify" value="1" type="hidden">
				<input name="ord_id" value="'.$ids_inv.'" type="hidden">
				<input name="notify_comments" value="1" type="hidden">
				<input name="batch_id" value="'.$batch_id.'" type="hidden">
			   </form>';
	  }
	  else
	  {
  	     echo '&nbsp;';	  
	  }
	  echo '</td>';	  	  

      echo "<td align=center>".display_date($rs->fields['invoice_date'])."</td>";
	  
	  if ( $rs->fields['active']==1)
	  {
        echo "<td align=center>Actif</td>";	  
        echo '<td align=center><a href="el_batch_action.php?inactivate_id='.$batch_id.'">Inactiver</td>';	  		
	  }
	  else
	  {
        echo "<td align=center>&nbsp;</td>";	  
        echo '<td align=center><a href="el_batch_action.php?activate_id='.$batch_id.'">Activer</td>';	  		
	  }	  
      echo "</tr>";	  
      $rs->MoveNext(); 
   }
   echo '</table>';
?>
</td>
</tr>
</table>
<br><br>
<center><input type="button"  onclick="document.location='el_batch_action?ok=1';"  value="OK"></center>
</body>
</html>