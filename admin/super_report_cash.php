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
//  DESCRIPTION:   Report that displays all income for  //
//  the given date range.  Report results come solely   //
//  from the Super Orders payment system.               //
//////////////////////////////////////////////////////////
// $Id: super_report_cash.php 28 2006-02-06 15:11:28Z BlindSide $
*/

  require('includes/application_top.php');

  $company = (isset($_GET['company']) ? $_GET['company'] : false);  
  $target = (isset($_GET['target']) ? $_GET['target'] : false);
  $is_for_display = ($_GET['print_format'] == 1 ? false : true);

                      
  $csv_output = 1;
  $csv_separator = "	";
					  
  function show_detail ($date_piece, $num_piece, $code, $cst_name, $debit, $credit , $entry_country_id=0 )
  {
      global $csv_output;
      global $csv_separator;
	  
      if  (  ($debit<>0) || ($credit<>0) )
	  {
	    if ( $csv_output )
		{
	        $output =   $date_piece . $csv_separator ;
	        $output .=   $num_piece . $csv_separator ;
	        $output .=   $code . $csv_separator ;
	        $output .=   $cst_name . $csv_separator ;
	        $output .=   $debit . $csv_separator ;
	        $output .=   $credit . $csv_separator ;
//	$output .=   $entry_country_id. $csv_separator;
	        $output .=    '
';
			
			echo $output;
		}
		else
		{
	        echo '
	         <tr>
	           <td class="dataTableContent" align="left">'.  $date_piece .'</td>
	           <td class="dataTableContent" align="center">'.  $num_piece.'</td>
	           <td class="dataTableContent" align="right">'.  $code .'</td>                      
	           <td class="dataTableContent" align="left">'.  $cst_name .'</td>
	           <td class="dataTableContent" align="right">'.  $debit .'</td>
	           <td class="dataTableContent" align="right">'.  $credit .'</td>		   
	         </tr>';
		 }
	 }
  }
    /*
	
-          707060 Ventes marchandises Royaume Uni
-          708570 Frais de port Royaume Uni
-          445770 TVA collectée à 15%.


445710	ETAT TVA COLLECTEE
445720	TVA COLL ESPAGNE 16%
445730	TVA COLL ALLEMAGNE 19%
445740	TVA COLL AUTRICHE 20%
445750	TVA BELGIQUE
445760	TVA LUXEMBOURG 15%
445770	TVA COLL ROYAUME UNI 15%
445780	TVA COLL Italie 20%

  
 707000	m	19.6	VENTES DE MARCHANDISES
707010	m	16	VENTES PARTICULIER ESPAGNE 16%
707020	m	19	VENTES PARTICULIER Allemagne 19%
707030	m	20	VENTES PARTICULIER AUTRICHE 20%
707040	m	21	VENTES PARTICULIER Belgique 21%
707040	m	15	VENTES PARTICULIER UK 15%
707910	m	0	VENTES MARCHANDISES UE (facturation UE Exonération de TVA)
707920	m	e	VENTES MARCHANDISES EXPORT (facturation hors UE)



708500	p	19.6	PORT France  19.60%
708510	p	0	PORT ET FRAIS UE (facturation UE exonération TVA)
708520	p	16	PORT ESPAGNE 16%
708530	p	19	PORT ALLEMAGNE 19%
708540	p	20	PORT AUTRICHE 20 %
708550	p	21	PORT BELGIQUE 21%
708800	e	19.6	AUTRES PROD.ECO CONTRIBUTION
708900	p	e	PORT EXPORT (facturation hors UE)

21 	Belgium 	BE 	BEL 	1
73 	France 	FR 	FRA 	1
75     France-DomTom 	FR 	FRA 	1

195 	Spain 	ES 	ESP 	3
196 	Spain - Canarias, Balears, Gibraltar, Ceuta 	LK 	LKA 	1

14  	Austria  	AT  	AUT  	5
81	Germany 	DE 	DEU 	5
204 	Switzerland 	CH 	CHE 	1


57 	Denmark 	DK 	DNK 	1
72 	Finland 	FI 	FIN 	1
81	Germany 	DE 	DEU 	5
98  	Iceland 	IS 	ISL 	1
103	Ireland 	IE 	IRL 	1
105 	Italy 	IT 	ITA 	1
124 	Luxembourg 	LU 	LUX 	1
141 	Monaco 	MC 	MCO 	1
150 	Netherlands 	NL 	NLD 	1
171 	Portugal 	PT 	PRT 	1
203 	Sweden 	SE 	SWE 	1
222 	United Kingdom
500    Northern Ireland

  */

  function get_product_code ($p_product_type,$tax,$country,$short_name,$moyen_paiement,$ref_info)
  {
	 if ( ($moyen_paiement="MKP_amazon") && ( $country == 14 ) )
	 {
        $country_code = "de";		
	 }
     else if ($tax==0)
	 {
		if ( strrpos( ',14,21,57,72,81,98,103,105,124,150,171,195,197,203,222,103,21,124,67,57,72,150,203,123,117,84,175,33,170,56,190,97,189,72,67,132,117,123,',  ','.$country.',' ) > 0 )
		  $country_code = "ue";
		else
		  $country_code = "ex";		
	 }        
	 /* JAN 2012    ROMANIA 175   SLOVENIA 190    GREECE 84	 */
	 /* décembre 2013   || ($country==75) enlevé pour que les vente France DOM TOM soient considérées comme export */
     else  if ( ($country==73) || ($country==141) // france  et  monaco 
	             || ( strrpos( ',14,21,57,72,98,103,124,150,171,175,190,84,203,103,21,124,67,57,72,150,203,123,117,',  ','.$country.',' ) > 0 )
	            ) 
        $country_code = "fr";
//	else if ( ($country==195) || ($country==196)|| ($country==197) )  // espagne
//      modif FV  7 mars  c'est de l'export hors UE pour les canaries
    else if ( ($country==195) || ($country==197) )  // espagne
        $country_code = "es";
	else if ( $country=="81" ) // allemagne 
        $country_code = "de";
	else if ( $country=="105" )
        $country_code = "it";    // italie
	else if ( ($country=="222")||($country=="45")||($country=="46")||($country=="500") ) // angleterre
        $country_code = "en";
	else   
        $country_code = "ex";		
	 
     if ( $p_product_type=="ESCF" )
	 {
	    if ( $tax > 0 )
		{
		   $response = "665";
		}
		else
		{
		   $response = "665900";
		}
		
	 }
     else if ( $p_product_type=="SHF" || $p_product_type=="CODF" )
     {
        $radical = "708";
        if ( $country_code=="fr" )
           $terminaison = "500";
        else if ( $country_code=="es" )
           $terminaison = "520";
        else if ( $country_code=="de" )
           $terminaison = "530";  // $terminaison = "600";         530
        else if ( $country_code=="au" )
           $terminaison = "500";  //           $terminaison = "540";        
        else if ( $country_code=="be" )
           $terminaison = "500";  //           $terminaison = "550";        
        else if ( $country_code=="lu" )
           $terminaison = "500"; //           $terminaison = "560";
        else if ( $country_code=="it" )
           $terminaison = "581"; // $terminaison = "580";		   
        else if ( $country_code=="ue" )
           $terminaison = "510";        
        else if ( $country_code=="en" )
//           $terminaison = "570";        		   
           $terminaison = "600";        		   
        else if ( $country_code=="ie" )
           $terminaison = "500"; //           $terminaison = "599";        		   		   
        else if ( $country_code=="ex" )
           $terminaison = "900";
		   
        $response = $radical.$terminaison;

     }
     else if ( $p_product_type=="TOTALTVA" )
     {
	    $radical = "";
        if ( $country_code=="fr" )
           $response = '445710';
        else if ( $country_code=="es" )
           $response = "445721";   //$response = "445720";
        else if ( $country_code=="de" )
           $response = "445730";        
        else if ( $country_code=="au" )
           $response = '445710';//           $response = "445740";        
        else if ( $country_code=="be" )
           $response = '445710';//           $response = "445750";  
		else if ( $country_code=="en" ) // angleterre
	       $response = "445773";   // $response = "445771";    //$response = "445770";   
		else if ( $country_code=="ie" ) 
           $response = '445710';  //	        $response = "445799";   			
	    else if ( $country_code=="it" )
	        $response = "445781";      // $response = "445780";   
		    
	 }	 	 
     else if ( $p_product_type=="CLI" )
     {
//echo 	 $country;
        $market_place = strtoupper(substr($ref_info,0,3));
		
	    $radical = "";
	    // est ce que c'est un client nommé ? ( comptes clients revendeurs)
	    if ( strlen($short_name)>0)
		{
		   $response = "411".$short_name;
		}
		else if ($market_place=="EBA" )
		{
		   $response = "411EBY";
		}
		else if ($market_place=="PRI" )
		{
		   $response = "411PRM";
		}		
		else if ($market_place=="PIX" )
		{
		   $response = "411PIX";
		}				
		else if ($market_place=="AMA" )
		{
		   $response = "411AMA";
		}						
		else if ($market_place=="FNA" )
		{
		   $response = "411FNA";
		}								
		else if ($market_place=="RDC" )
		{
		   $response = "411RDC";
		}						
		else if ( strtoupper($moyen_paiement) == "CC" )
		{
		   $response = "411INT";
		}		
		else if ( strtoupper($moyen_paiement) == "PAYPAL" )
		{
		   $response = "411PAY";
		}		 // fvv		|| ($country==75)
        else if ( ($country==73) || ($country==141)  ) 
		{
		   // est ce que c'est une vente paypal
           $response = '411DIV';
		   // par défaut c'est INTERNET
		}
//        else if ( ($country==195)|| ($country==196)|| ($country==197) )  // espagne
        else if ( ($country==195) || ($country==197) )  // espagne
           $response = "411ESP";
        else if ( $country=="81" ) // allemagne 
           $response = "411ALL";        
		else if ( $country=="105" )  // italie 
            $response = "411ITA";					
		else if ( ($country=="222")||($country=="45")||($country=="46")||($country=="500")  ) // angleterre
            $response = "411ANG";					
        else  
           $response = "411EXP";  
		   
	 }	 	 	 
     else if ( $p_product_type=="ECOF" )
     {
        $response = "708800";
     }
     else
     {
        $radical = "707";
        if ( $country_code=="fr" )
           $terminaison = "000";
        else if ( $country_code=="es" )
           $terminaison = "918"; //$terminaison = "010";
        else if ( $country_code=="de" )
           $terminaison = "912";  //  $terminaison = "020";        
        else if ( $country_code=="au" )
           $terminaison = "913";        //$terminaison = "030";        
        else if ( $country_code=="be" )
           $terminaison = "914";    //$terminaison = "040";        
        else if ( $country_code=="ue" )
           $terminaison = "910";        
        else if ( $country_code=="ex" )
           $terminaison = "920";        
        else if ( $country_code=="lu" )
           $terminaison = "050";        
        else if ( $country_code=="it" )
            $terminaison = "921";           // $terminaison = "917";        
		else if ( $country_code=="en" )
           $terminaison = "926"; // $terminaison = "060";        
		else if ( $country_code=="ie" )
           $terminaison = "925";        

        $response = $radical.$terminaison;
     }
//echo		$p_product_type;
	 
//     return $response.'.'.$country;
     return $response;
  }
  
  if ($target) {
    require(DIR_WS_CLASSES . 'currencies.php');
    $currencies = new currencies();
    require(DIR_WS_CLASSES . 'super_order.php');
/*
    $sd = zen_date_raw((!isset($_GET['start_date']) ? date("m-d-Y",(time())) : $_GET['start_date']));
    $ed = zen_date_raw((!isset($_GET['end_date']) ? date("m-d-Y",(time())) : $_GET['end_date']));
*/   
    $sd = $_GET['start_date'];
    $ed = $_GET['end_date'];

  }

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/super_stylesheet.css">
<?php if ($is_for_display) { ?>
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
<?php } ?>
</head>
<?php if ($is_for_display) { ?>
<body onload="init()">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<!-- body //-->
<script language="javascript">
var StartDate = new ctlSpiffyCalendarBox("StartDate", "search", "start_date", "btnDate1", "<?php echo (($_GET['start_date'] == '') ? '' : $_GET['start_date']); ?>", scBTNMODE_CUSTOMBLUE);
var EndDate = new ctlSpiffyCalendarBox("EndDate", "search", "end_date", "btnDate2", "<?php echo (($_GET['end_date'] == '') ? '' : $_GET['end_date']); ?>", scBTNMODE_CUSTOMBLUE);
</script>
<?php } ?>

<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
<?php
  if (!$is_for_display) {
?>
<!-- Print Header -->
        <td><?php echo '<a href="' . zen_href_link('super_report_cash.php', 'target=' . $target) . '&start_date=' . $_GET['start_date'] . '&end_date=' . $_GET['end_date'] . '"><span class="pageHeading">' .  HEADING_TITLE . '</span></a>'; ?></td>
        <td class="pageHeading" align="right"><?php echo $_GET['start_date'] . TEXT_TO . $_GET['end_date']; ?></td>
      </tr>
<!-- END Print Header -->
<?php
  }
  else {
?>
<!-- Display Header -->
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
          <tr>
          <?php echo zen_draw_form('search', 'super_report_cash.php', '', 'get'); ?>
          <tr>
            <td class="main">Type de rapport</td>
            <td class="main"><?php echo HEADING_DATE_RANGE; ?></td>
          </tr>
          <tr>
            <td valign="top"><table border="0" cellspacing="2" cellpadding="0">
              <tr>
                <td class="main" valign="top"><input type="radio" name="target" value="liaison" CHECKED>Liaison comptable</td>
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>				
				<td class="main" valign="top"><input type="radio" name="currency" value="EUR" CHECKED>EUR</td>		
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>												
				<td class="main" valign="top"><input type="radio" name="company" value="EL" CHECKED>EASYLAMPS</td>								
              </tr>
              <tr>
                <td class="main" valign="top"><input type="radio" name="target" value="ecritures" >Ecritures</td>
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>								
                <td class="main" valign="top"><input type="radio" name="currency" value="GBP">GBP</td>		
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>												
				<td class="main" valign="top"><input type="radio" name="company" value="HPL">HPL</td>												
              </tr>
              <tr>
                <td class="main" valign="top">&nbsp;</td>
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>								
                <td class="main" valign="top"><input type="radio" name="currency" value="USD">USD</td>		
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>												
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>												
              </tr>
            </table>
			</td>				
            <td><table border="0" cellspacing="2" cellpadding="0">
              <tr>
                <td class="smallText" align="left">
                  <?php echo HEADING_START_DATE . '<br />'; ?>
                  <script language="javascript">
                    StartDate.writeControl(); StartDate.dateFormat="yyyy-MM-dd";
                  </script>
                </td>
              </tr>
              <tr>
                <td class="smallText" align="left"><?php echo HEADING_END_DATE . '<br />'; ?>
                  <script language="javascript">
                    EndDate.writeControl(); EndDate.dateFormat="yyyy-MM-dd";
                  </script>
                </td>
              </tr>
            </table></td>
            <td><table border="0" cellspacing="2" cellpadding="0">
              <tr>
                <td class="smallText" valign="top"><br /><?php echo zen_draw_checkbox_field('gl_transfer', 1) . 'Transfert compta'; ?></td>
              </tr>
              <tr>
                <td class="main" valign="bottom"><br /><input type="submit" value="<?php echo BUTTON_SEARCH; ?>"></td>
              </tr>
            </table></td>
          </tr>
          </form>
        </td></table>
<?php
    if ($target && $is_for_display) {
?>
        <td align="right" valign="bottom"><table border="0" cellspacing="2" cellpadding="3">
          <tr>
            <td class="main" align="center"><?php echo HEADING_COLOR_KEY; ?></td>
          </tr>
          <tr class="paymentRow">
            <td class="dataTableContent" align="center"><?php echo TEXT_PAYMENTS; ?></td>
          </tr>
          <tr class="refundRow">
            <td class="dataTableContent" align="center"><?php echo TEXT_REFUNDS; ?></td>
          </tr>
        </table></td>
<?php
    }
?>
      </tr>
<?php
  }  // END if ($is_for_display)
?>
    </table></td>
  </tr>
<!-- END Display Header -->
<?php
  if ($target) {
	if ( $csv_output )
	{
	  echo '<textarea name="output">';
	}
  
  if ($target=='ecritures') 
  {
	  if ( $csv_output )
	  {
		  $output =  'Date pièce' . $csv_separator;
		  $output .=  'Numéro de pièce' . $csv_separator;
		  $output .=  'Compte' . $csv_separator;
		  $output .=  'Libellé' . $csv_separator;
		  $output .=  'Débit' . $csv_separator;
		  $output .=  'Crédit' . $csv_separator;
		  $output .=  '';
		  echo $output;
		}
		else
		{
		  echo '
		  <tr>
		    <td>
		    <table border="0" width="100%" cellspacing="0" cellpadding="2">
		      <tr class="dataTableHeadingRow">
		        <td class="dataTableHeadingContent" align="left">Date pièce</td>
		        <td class="dataTableHeadingContent" align="center">Numéro de pièce</td>
		        <td class="dataTableHeadingContent" align="right">Compte</td>        
		        <td class="dataTableHeadingContent" align="left">Libellé</td>
		        <td class="dataTableHeadingContent" align="right">Débit</td>
		        <td class="dataTableHeadingContent" align="right">Crédit</td>
		      </tr>';		
		}
    }
	else
    {
	  if ( $csv_output )
	  {
		  $output =  'Date pièce' . $csv_separator;
		  $output .=  'Numéro de pièce' . $csv_separator;
		  $output .=  'Nom Client' . $csv_separator;
		  $output .=  'Total TTC' . $csv_separator;
		  $output .=  'Total TVA' . $csv_separator;
		  $output .=  'Total HT' . $csv_separator;
		  $output .=  'Tx TVA' . $csv_separator;
		  $output .=  'Pays' . $csv_separator;		  
		  $output .=  'Code postal' . $csv_separator;		  
		  $output .=  'Article' . $csv_separator;		  
		  $output .=  'Mt Tot H' . $csv_separator;		  
		  $output .=  'Code compt.' . $csv_separator;		  
		  $output .=  'N.I.I.' . $csv_separator;		  
		  $output .=  'Paiement' . $csv_separator;		  		  
		  $output .=  '';
		  echo $output;
		}
		else
		{	
		  echo '
			  <tr>
			    <td>
			    <table border="0" width="100%" cellspacing="0" cellpadding="2">
			      <tr class="dataTableHeadingRow">
			        <td class="dataTableHeadingContent" align="left">Date pièce</td>
			        <td class="dataTableHeadingContent" align="center">Numéro de pièce</td>
			        <td class="dataTableHeadingContent" align="left">Nom Client</td>
			        <td class="dataTableHeadingContent" align="left">Total TTC</td>
			        <td class="dataTableHeadingContent" align="center">Total TVA</td>
			        <td class="dataTableHeadingContent" align="left">Total HT</td>
			        <td class="dataTableHeadingContent" align="right">Tx TVA</td>
			        <td class="dataTableHeadingContent" align="right">Pays</td>
			        <td class="dataTableHeadingContent" align="right">Code postal</td>
			        <td class="dataTableHeadingContent" align="right">Article</td>
			        <td class="dataTableHeadingContent" align="right">Mt Tot H</td>
			        <td class="dataTableHeadingContent" align="right">Code compt.</td>
			        <td class="dataTableHeadingContent" align="right">N.I.I.</td>
			      </tr>';
	   }
    }
	
	
    $grand_count = 0;
    $grand_total = 0;
    $num_of_types = 0;
//echo '.'.$_GET['currency'].'.';exit;
    if ($target == 'ecritures' || $target == 'liaison') 
	{
	  if ($company=='EL')
		$types = "'DB', 'CR'";
	  else
		$types = "'CH','DH'";
	  
      $ords_query = "SELECT p.orders_invoices_id, p.invoice_type, p.invoice_date, p.orders_id oid ,
                            o.* FROM orders_invoices p
                        LEFT JOIN orders o
                        ON p.orders_id = o.orders_id
                        WHERE invoice_date BETWEEN '" . $sd . "' AND DATE_ADD('" . $ed . "', INTERVAL 1 DAY)
						AND   currency = '". $_GET['currency'] ."'
						AND  invoice_type in (".$types.")
                        ORDER BY invoice_type, orders_invoices_id asc";
						
	  // prise en compte du transfert en compta 				
      //echo  $ords_query;exit;                       
      $ords = $db->Execute($ords_query);
	  
	  /*  récupération de l'information pays du client dans la base source */
	  
	  
/*
si un jour on doit séparer les factures des avoirs, on utilisera ce genre de séparateur.
      <tr>
        <td colspan="7" class="dataTableContent" align="center"><strong><?php echo zen_draw_separator() .'aa' . zen_draw_separator(); ?></strong></td>
      </tr>
*/

?>
      
<?php
     //_TODO make this into a do/while loop so that the final sub_total values can be displayed
     while (!$ords->EOF) 
     {
	     // maj du flag passé en compta
	     if ( $_GET["gl_transfer"]==1 )
		 {
		    $dml = "update orders set gl_transfered = 1 where orders_id = ".   $ords->fields['orders_id'];
			$db->Execute($dml);
		 }
	     if ( $ords->fields['customers_id']  )
		 {
    	  $database_code = $ords->fields['database_code'];

//echo $database_code.'<br>';
          
	      $db->connect($ext_db_server[$database_code], $ext_db_username[$database_code], $ext_db_password[$database_code], $ext_db_database[$database_code], USE_PCONNECT, false);
		  $sql = "select ab.entry_country_id
									FROM  customers c, address_book ab
									WHERE c.customers_id = ".  $ords->fields['customers_id']   . "
									AND c.customers_default_address_id = ab.address_book_id" ;
									
	      $ctry = $db->Execute( $sql );
		  $entry_country_id =  $ctry->fields['entry_country_id'];
		  if ($database_code=="eu")
		  {  
			  $sql = "select short_name
						FROM  customers c
						WHERE c.customers_id = ".  $ords->fields['customers_id'];
						
		      $ctry = $db->Execute( $sql );
			  $short_name =  $ctry->fields['short_name'];
		  }
		  else
		  {
		     $short_name = "";
		  }
//	  echo $entry_country_id;exit;
		  $db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);
		  }
       if ( ( $ords->fields['invoice_type']=='DB' ) || ( $ords->fields['invoice_type']=='DH' ) )
	   {
         $num_piece = "INT".$ords->fields['orders_invoices_id'];
		 $detail_credit = 0;
	   }
       else
	   {
     	 $num_piece = "AINT".$ords->fields['orders_invoices_id'];
		 $detail_credit = 1;		 
	   }
         
       if ( strlen($ords->fields['customers_company'])>0 )
         $cst_name = $ords->fields['billing_company'];
       else
         $cst_name = $ords->fields['billing_name'];
         
      $site = $ords->fields['database_code'];
      $country = $ords->fields['customers_country'];
      $postcode = $ords->fields['customers_postcode'];
      $currency_value = $ords->fields['currency_value'];
//echo $currency_value;exit;
	  
      $totalttc = round($currency_value*$ords->fields['order_total'],2);
      $totaltax = round($currency_value*$ords->fields['order_tax'],2);
      
      $totalht = $totalttc-$totaltax;
	  $date_piece = zen_date_short($ords->fields['invoice_date']);
      
      $nii = $ords->fields['entry_tva_intracom'];
      $moyen_paiement = $ords->fields['payment_module_code'];
	  $ref_info = $ords->fields['ref_info'];
      

      $prd_qry = " select * from orders_products where orders_id  = " . $ords->fields['oid'];
      $prds = $db->Execute($prd_qry);
//echo 	  $prd_qry;
	  
	  // on affiche le montant total pour le client  411CLI
		 if ( $detail_credit )
		 {
			$debit = 0;
			$credit = $totalttc;
		 }
		 else
		 {
			$debit = $totalttc;
			$credit = 0;
		 }
		 if ( $target == "ecritures" )
		 {
		     // rajout de la réf du paiement si il existe
			 if ( strlen($ords->fields['payment_info'])>0  )
			 {
			    $lib = $cst_name . ' ('.$ords->fields['payment_info'].')' ;
			 }
			 else
			 {
			    $lib =   $cst_name;			    
			 }
	    	 show_detail ($date_piece, $num_piece,  get_product_code('CLI',$tax,$entry_country_id,$short_name,$moyen_paiement,$ref_info)  , $lib, $debit, $credit,$entry_country_id ); 
	     }
      while (!$prds->EOF)
      {
         $qty = $prds->fields['products_quantity'];
         $pprice = $prds->fields['final_price'];
         $detailht =  round($currency_value*$pprice*$qty,2);
		 if (  $detailht > 0 )
		 {
			 if ( $detail_credit )
			 {
			    $debit = $detailht;
				$credit = 0;
			 }
			 else
			 {
				$debit = 0;
	    	    $credit = $detailht;
			 }
		 }
		 else
		 {
			 if ( $detail_credit == 0 )
			 {
			    $debit = -1*$detailht;
				$credit = 0;
			 }
			 else
			 {
				$debit = 0;
	    	    $credit = -1*$detailht;
			 }
		 }
		 
		 
         $tax = $prds->fields['products_tax'];
         $products_model  = $prds->fields['products_model'];
         
         $code = get_product_code($products_model,$tax,$entry_country_id,$short_name,$moyen_paiement,$ref_info);
		 if ( $target == "ecritures" )
		 {
    		 show_detail ($date_piece, $num_piece, $code, $cst_name, $debit, $credit,$entry_country_id ); 
		 }
		 else
		 {
			  if ( $csv_output )
			  {
				  $output =  zen_date_short($ords->fields['invoice_date']) . $csv_separator;
				  $output .=   $num_piece . $csv_separator;
				  $output .=  $cst_name . $csv_separator;
				  $output .=  $totalttc . $csv_separator;
				  $output .=  $totaltax . $csv_separator;
				  $output .=  $totalht . $csv_separator;
				  $output .=  $tax . $csv_separator;		  
				  $output .=  $country . $csv_separator;		  
				  $output .=  $postcode . $csv_separator;		  
				  $output .=  $products_model . $csv_separator;		  
				  $output .=  $detailht  . $csv_separator;		  
				  $output .=  $code . $csv_separator;		  
				  $output .=  $nii . $csv_separator;		  				  
				  $output .=  $moyen_paiement . $csv_separator;		  				  				  
				  $output .=  '
';
				  echo $output;
			  }
			  else
			  {
		 
	         ?>
	         <tr>
	           <td class="dataTableContent" align="left"><?php echo zen_date_short($ords->fields['invoice_date']); ?></td>
	           <td class="dataTableContent" align="center"><?php echo $num_piece ?></td>
	           <td class="dataTableContent" align="left"><?php echo $cst_name; ?></td>
	           <td class="dataTableContent" align="left"><?php echo $totalttc; ?></td>
	           <td class="dataTableContent" align="center"><?php echo $totaltax; ?></td>
	           <td class="dataTableContent" align="left"><?php echo $totalht; ?></td>
	           <td class="dataTableContent" align="right"><?php echo $tax; ?></td>
	           <td class="dataTableContent" align="right"><?php echo $country; ?></td>  
	           <td class="dataTableContent" align="right"><?php echo $postcode; ?></td>                               
	           <td class="dataTableContent" align="right"><?php echo $products_model; ?></td>
	           <td class="dataTableContent" align="right"><?php echo $detailht; ?></td>
	           <td class="dataTableContent" align="right"><?php echo $code; ?></td>           
	           <td class="dataTableContent" align="right"><?php echo $nii; ?></td>                      
	         </tr>
	         <?php
			 }
		 
		 }
         $prds->MoveNext();
      }
      
      // les taxes  445710
		 if ( $detail_credit )
		 {
			$debit = $totaltax;
			$credit = 0;
		 }
		 else
		 {
			$debit = 0;
			$credit = $totaltax;
		 }
//echo 		 get_product_code('TOTALTVA',$tax,$entry_country_id) ;exit;
		  if ( $target == "ecritures" )
		  {
    		 show_detail ($date_piece, $num_piece, get_product_code('TOTALTVA',$tax,$entry_country_id,$short_name,$moyen_paiement,$ref_info) , $cst_name, $debit, $credit, $entry_country_id ); 
          }
      
          $sub_count++;
          $grand_count++;

          $sub_total += round($currency_value*$ords->fields['payment_amount'],2);
          $grand_total += round($currency_value*$ords->fields['payment_amount'],2);

          $ords->MoveNext();

     }  // END while (!$ords->EOF)
	 if ( $csv_output )
	 {
	   echo '</textarea>';
	 }
	 else
	 {
  	  echo ' </table>';
	 }
?>
    </td>
<?php
  }  // END if ($target)
  }  
?>
<!-- body_text_eof //-->
</tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php if ($is_for_display) require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>