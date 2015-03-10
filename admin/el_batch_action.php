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
<br><br>
<table width=100%>
<tr>
<td align=center>
<?php
  global $db;  
function add_field($pvalue)
{
  $value = str_replace(';',' ',$pvalue);
  $value = str_replace(',',' ',$value);
  $value = str_replace(',',' ',$value);
  return $value.';';
}
Function removeaccents($string){ 
   $string= strtr($string,  "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ$",
                  "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn "); 
   $string= str_replace('ß','ss',$string);
   $string = iconv("ISO-8859-1","UTF-8",$string);   
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

      $output_xml .= get_xml_ups($order_num,$db_code);
	  
	} 	
	 $output_xml .='
</OpenShipments>';

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

  	   echo '
  <SCRIPT LANGUAGE="JavaScript">
function makefile2(){
	var fso;var thefile;
	fso = new ActiveXObject("Scripting.FileSystemObject");
	
	thefile=fso.CreateTextFile("C:\\\\eticup\\\\import\\\\lot'.$_GET['export_id'].'.csv",true);
    thefile.writeline(document.frm.DHL.value);
	
	thefile.close();
    alert(\'Le fichier est crée.\');	
}
  </SCRIPT>';

    	   echo '
  <SCRIPT LANGUAGE="JavaScript">
function makefile3(){
	var fso;var thefile;
	fso = new ActiveXObject("Scripting.FileSystemObject");
	
	thefile=fso.CreateTextFile("c:\\\\gls\\\\winexpe6\\\\DAT\\\\OrIMP\\\\lot'.$_GET['export_id'].'.csv",true);
    thefile.writeline(document.frm.GLS.value);
	thefile.close();
    alert(\'Le fichier est crée.\');	
}
  </SCRIPT>';

    	   echo '
  <SCRIPT LANGUAGE="JavaScript">
function makefile4(){
	var fso;var thefile;
	fso = new ActiveXObject("Scripting.FileSystemObject");
	
	thefile=fso.CreateTextFile("c:\\\\gls\\\\SOURCE\\\\lot'.$_GET['export_id'].'.csv",true);
    thefile.writeline(document.frm.GLSDEP.value);
	thefile.close();
    alert(\'Le fichier est crée.\');	
}
  </SCRIPT>';
  
	  echo '<form name="frm">';

	  
  if ($cntr>0)
  {
  //C:\UPS\WSTD\IMPEXP\XML Auto Import\ 
	  /////////           UPS UPS  UPS UPS  UPS UPS  UPS UPS  UPS UPS  UPS UPS  UPS UPS  UPS UPS  UPS UPS 
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
       $output .= get_flux_dhl($order_num,$db_code);       
	 } 	
	 $output=removeaccents($output);
  if ($cntr>0)
  {
 echo '<br>EXTRACTIONS DHL<br>
       <table><tr><td>
       <textarea rows="5" cols="50"   name="DHL">';
 echo $output;
  echo '</textarea>
  
       </td><td><a href="javascript:makefile2();">Impression <br> étiquettes</a></td></tr>
	   </table>
  <br><br>';
  }
  /// GLS  GLS  GLS  GLS  GLS  GLS  GLS  GLS  GLS  GLS  GLS  GLS  GLS  GLS  GLS  GLS  GLS  GLS 
   $cntr=0;
   $output = "";
   $db_code = "gl";
   $db->connect($ext_db_server[$db_code], $ext_db_username[$db_code], $ext_db_password[$db_code], $ext_db_database[$db_code], USE_PCONNECT, false);
  
   $sql = "select el_batch_items.item_id, el_batch_items.database_code,el_batch_items.description
                  FROM  el_batch_items 
				  WHERE   el_batch_items.batch_id = " . $_GET['export_id'] . "
				  and transporter in ('GLS')				  
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
       $output .= get_flux_gls_p($order_num,$db_code);       
	 } 	
	 $output=removeaccents($output);
  if ($cntr>0)
  {
 echo '<br>EXTRACTIONS GLS<br>
       <table><tr><td>
       <textarea rows="5" cols="50"   name="GLS">';
 echo $output;
  echo '</textarea>
  
       </td><td><a href="javascript:makefile3();">Impression <br> étiquettes</a></td></tr>
	   </table>
  <br><br>';

  /// GLS_DEP  GLS_DEP  GLS_DEP  GLS_DEP  GLS_DEP
   $cntr=0;
   $output = "";
   $db_code = "gl";
   $db->connect($ext_db_server[$db_code], $ext_db_username[$db_code], $ext_db_password[$db_code], $ext_db_database[$db_code], USE_PCONNECT, false);
  
   $sql = "select el_batch_items.item_id, el_batch_items.database_code,el_batch_items.description
                  FROM  el_batch_items 
				  WHERE   el_batch_items.batch_id = " . $_GET['export_id'] . "
				  and transporter in ('GLS')				  
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
       $output .= get_flux_gls($order_num,$db_code);       
	 } 	
	 $output=removeaccents($output);
  if ($cntr>0)
  {
 echo '<br>EXTRACTIONS GLS DEP<br>
       <table><tr><td>
       <textarea rows="5" cols="50"   name="GLSDEP">';
 echo $output;
  echo '</textarea>
  
       </td><td><a href="javascript:makefile4();">Impression <br> étiquettes</a></td></tr>
	   </table>
  <br><br>';
 }
 echo ' </form>';
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
		<td>Boites</th>		
		   <th colspan=5 bgcolor=#eae5e5>Export des étiquette </th> 
		   <th colspan=4>Facturation automatique</th>
		   <th>&nbsp;</th>
		   <th>&nbsp;</th>
        </tr>
        <tr>		 
		<th>Nom du lot</th><th>&nbsp</th><th>eu</th><th>fr</th><th>exp</th>	<th>Exporter</th>  
		<th>Date Export</th>   <th>fr</th><th>exp</th><th>Facturer</th>
		<th>Date Facturation</th><th>Actif?</th>
		<th>Action</th>
		<th>Modification multiple</th>
		</tr>';
  $sql = "select batch_id, batch_name, export_date, invoice_date, active
          from bo_gl.el_batch
		  order by batch_id desc
          limit 0,250 ";
		  
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
			   $items_tab_id[$cntr] = $li->fields['item_id'];
			   $items_tab_db[$cntr] = $li->fields['database_code'];			   
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
		
//		echo "<td><a href='../../exec/php/tcpdf/examples/example_027c.php'>Etiq. boite</a></td>";
		echo "<td><a href='el_box_tags.php?batch_id=".$batch_id ."'>Etiq. boite</a></td>";
	  
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
// '.count(explode($ids_inv,',')).'	  
//	  javascript:if (confirm('Voulez%20vous%20vraiment%20inactiver%20ces%20sessions?')%20)%20{%20document.frm.utis.value='';%20document.frm.submit();}
	  
		echo '<form name="pdfoc_action'.$batch_id.'" action="el_gestion.php?form=action" method="post">
			    <a href="javascript:if (confirm(\'Voulez vous vraiment Facturer cette liste de factures ?\') ) { document.pdfoc_action'.$batch_id.'.submit();}">Facturer</a>
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
      echo '<td align=center><a href="super_edit_batch.php?target=payment_mode&batch_id='.$batch_id.'">Modification multiple</td>';	  		
	  
      echo "</tr>";	  
      $rs->MoveNext(); 
   }
   echo '</table>';
   init_batch_items();
   
?>
</td>
</tr>
</table>
<br><br>
<center><input type="button"  onclick="document.location='el_batch_action?ok=1';"  value="OK"></center>
</body>
</html>