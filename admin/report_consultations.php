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
*/

  require('includes/application_top.php');

  require('el_fonctions_gestion.php');

  $company = (isset($_GET['company']) ? $_GET['company'] : false);  
  $target = (isset($_GET['target']) ? $_GET['target'] : false);
  $is_for_display = ($_GET['print_format'] == 1 ? false : true);

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
                      
					  
  $csv_output = 1;
  $csv_separator = "	";
					  
  
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
   $sql = "SELECT MIN( DATE( DATE_SUB( FROM_UNIXTIME( whos_online_bckp.time_entry ) , INTERVAL WEEKDAY( FROM_UNIXTIME( whos_online_bckp.time_entry ) ) -0
DAY ) ) )  value
FROM rv_lampe_eu.whos_online_bckp";

    $date_stat = exec_select($sql);
    echo "Date démarrage statistiques:".$date_stat."<br>";

  if (!$is_for_display) {
?>
<!-- Print Header -->
        <td><?php echo '<a href="' . zen_href_link('report_consultations.php', 'target=' . $target) . '&start_date=' . $_GET['start_date'] . '&end_date=' . $_GET['end_date'] . '"><span class="pageHeading">' .  HEADING_TITLE . '</span></a>'; ?></td>
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
          <?php 
		  echo zen_draw_form('search', 'report_consultations.php', '', 'get'); 
		  $radio_html = '  
          <tr>
            <td class="main">Type de rapport</td>
            <td class="main"><?php echo HEADING_DATE_RANGE; ?></td>
          </tr>
          <tr>
            <td valign="top"><table border="0" cellspacing="2" cellpadding="0">
              <tr>
                <td class="main" valign="top"><input type="radio" name="target" value="RV" CHECKED>Revendeur</td>
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>				
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>												
              </tr>
              <tr>
                <td class="main" valign="top"><input type="radio" name="target" value="RVP">Revendeur / pays </td>
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>				
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>												
              </tr>			  
              <tr>
                <td class="main" valign="top"><input type="radio" name="target" value="fr" >End User fr</td>
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>								
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>												
              </tr>
              <tr>
                <td class="main" valign="top"><input type="radio" name="target" value="en" >End User en</td>
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>								
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>												
              </tr>
              <tr>
                <td class="main" valign="top"><input type="radio" name="target" value="de" >End User de</td>
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>								
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>												
              </tr>
              <tr>
                <td class="main" valign="top"><input type="radio" name="target" value="it" >End User it</td>
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>								
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>												
              </tr>
              <tr>
                <td class="main" valign="top"><input type="radio" name="target" value="es" >End User es</td>
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>								
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>												
              </tr>
			  
              <tr>
                <td class="main" valign="top">&nbsp;</td>
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>								
				<td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>												
              </tr>
            </table>';
			$radio_html = str_replace ( 'value="'.$target.'"',  'value="'.$target.'" CHECKED', $radio_html);
			
			echo $radio_html;
			
			?>
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
                <td class="smallText" valign="top"><br />
				<?php 
				echo '&nbsp;';
				echo zen_draw_checkbox_field('norebuild', 1) . 'Sans recalcul'; 
				?></td>
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
  
  if (true) 
  {
	  if ( $csv_output )
	  {
	      if ( ($target=="fr") || ($target=="en") ||  ($target=="de")||  ($target=="it")||  ($target=="es")||  ($target=="fr") )
		  {
				  $output =  'Constructeur' . $csv_separator;
				  $output .=  'Code lampe' . $csv_separator;
				  $output .=  'Consultations' . $csv_separator;
				  $output .=  'Ventes LO' . $csv_separator;
				  $output .=  'Ventes OI' . $csv_separator;
				  $output .=  'Ventes LC' . $csv_separator;
				  $output .=  'Ventes Total' . $csv_separator;
				  $output .=  'Marge LO' . $csv_separator;
				  $output .=  'Marge OI' . $csv_separator;
				  $output .=  'Marge LC' . $csv_separator;
				  $output .=  'Ordre Tri' . $csv_separator;
				  $output .=  'Prix TTC LO' . $csv_separator;
				  $output .=  'Prix TTC OI' . $csv_separator;
				  $output .=  'Prix TTC LC' . $csv_separator;
				  $output .=  'Prix V16 LO' . $csv_separator;
				  $output .=  'Prix V16 OI' . $csv_separator;
				  $output .=  'Prix V16 LC' . $csv_separator;				  
				  $output .= '
';		  
		  }
		  else
		  {
				  $output =  'Code Lampe' . $csv_separator;
				  $output .=  'Consultations' . $csv_separator;
				  if ($target == "RVP" )
				  {
					$output .=  'Pays' . $csv_separator;
				  }		  		  
				  $output .=  'Ventes LO' . $csv_separator;
				  $output .=  'Ventes OI LC';		  
				  $output .= '
		';		  
		  }
		  
		  echo $output;
		}
    }
	
	
    $grand_count = 0;
    $grand_total = 0;
    $num_of_types = 0;

    if ( ($target == "RV" ) || ( $target == "RVP" ) )
	{
		$db->connect($ext_db_server["eu"], $ext_db_username["eu"], $ext_db_password["eu"], $ext_db_database["eu"], USE_PCONNECT, false);  
		if (!( $_GET['norebuild']==1))
		{
			$ddl = " drop table if exists whos_online_digest ";
			$db->Execute($ddl);

//					and date_format(invoice_date,"%Y-%c-%d")
			
			$ddl = "  create table whos_online_digest
					as 
					select  
					'eu' database_code,
					date(date_sub(from_unixtime(whos_online_bckp.time_entry),INTERVAL WEEKDAY(from_unixtime(whos_online_bckp.time_entry)) -0 DAY)) date_selection,
					customer_id,
					full_name,
					 last_page_url ref_lampe , count(1) lampe_selectionnee, 
					 countries_name
					from  whos_online_bckp, customers, address_book, countries
					where last_page_url like '[%'
					and full_name not like '%uest%'
					and full_name not like '%pider%'
					and customers.customers_id = whos_online_bckp.customer_id
					and customers_default_address_id=address_book.address_book_id
					and address_book.entry_country_id = countries.countries_id
					and date(date_sub(from_unixtime(whos_online_bckp.time_entry),INTERVAL WEEKDAY(from_unixtime(whos_online_bckp.time_entry)) -0 DAY)) between '".$sd."' AND '".$ed."'
					group by date_selection,customer_id,full_name, last_page_url,countries_name
					order by date_selection ";
// $sd . "' AND '" . $ed 					
//echo $ddl;exit;	
				
			$db->Execute($ddl);



			$ddl = " alter table whos_online_digest add lampe varchar(30); ";
			$db->Execute($ddl);

			$ddl = "alter table whos_online_digest add vp_id integer;";
			$db->Execute($ddl);

			$ddl = "alter table whos_online_digest add manufacturer varchar(30);";
			$db->Execute($ddl);



			$ddl = "update whos_online_digest
	set vp_id = SUBSTRING(ref_lampe,2,LOCATE(']',ref_lampe)-2);";
			$db->Execute($ddl);

			$ddl = "update whos_online_digest
	set manufacturer = SUBSTRING(ref_lampe,LOCATE(']',ref_lampe)+1,LOCATE('-',ref_lampe)-LOCATE(']',ref_lampe)-1);";
			$db->Execute($ddl);


			$ddl = "update whos_online_digest
	set lampe=
	( 
	select distinct products_model  
	from products 
	where master_categories_id=vp_id 
	and manufacturers_id in (1,5) 
	limit 0,1
	);";
			$db->Execute($ddl);

			$ddl = "alter table whos_online_digest
	drop column ref_lampe;";
			$db->Execute($ddl);


			$ddl = "alter table whos_online_digest
	drop column vp_id;";
			$db->Execute($ddl);
			
			$ddl = " drop table if exists whos_online_digest2 ";
			$db->Execute($ddl);		
			
			$ddl = " drop table if exists whos_online_digest2 ";
			$db->Execute($ddl);		
			
			if ($target == "RVP" )
			{
				$addon = ",countries_name";
			}
			else
			{
				$addon = "";
			}
			
			$ddl = " create table whos_online_digest2
					as 
					select   	lampe ". $addon .", sum(lampe_selectionnee) cnt
					from    whos_online_digest
					where  lampe is not null 
					and length(lampe)>0
					group by lampe  ". $addon ."
					order by sum(lampe_selectionnee) desc";
					
			$db->Execute($ddl);		
			
		}
		$rs = $db->Execute("select lampe  ". $addon ."  ,cnt from whos_online_digest2");
		
		while( !$rs->EOF )
		{
			echo $rs->fields['lampe'].$csv_separator;
			
			echo $rs->fields['cnt'].$csv_separator;
			
			if ($target == "RVP" )
			{
				echo $rs->fields['countries_name'].$csv_separator;
				$add_where =  " and customers_country = '" . $rs->fields['countries_name']."'";
			}
			$sql = "select sum(products_quantity) value 
			from rv_lampe_eu.orders_products,orders 
			where orders.orders_id = orders_products.orders_id 
			".$add_where."
			and date_purchased between '" . $sd . "' AND '" . $ed . "'
			and products_model like '".ltrim(rtrim($rs->fields['lampe'])) ."'";
			
//echo $sql;	exit;
			$ventes = exec_select ( $sql );
			
			echo $ventes.$csv_separator;	
			
			// les ventes autres -----------------------------------------
			$sql = "select sum(products_quantity) value 
			from rv_lampe_eu.orders_products,orders 
			where orders.orders_id = orders_products.orders_id 
			".$add_where."
			and date_purchased between '" . $sd . "' AND '" . $ed . "'
			and products_model like '%".ltrim(rtrim($rs->fields['lampe'])) ."'
			and products_model not like '".ltrim(rtrim($rs->fields['lampe'])) ."'";
			
//echo $sql;	exit;
			$ventes_autres = exec_select ( $sql );
			
			echo $ventes_autres.$csv_separator;	
		
			
			echo '
';
			$rs->MoveNext();
		}
		}
		else if ( ($target=="fr") || ($target=="en") ||  ($target=="de")||  ($target=="it")||  ($target=="es") )
		{

		$db->connect($ext_db_server[$target], $ext_db_username[$target], $ext_db_password[$target], $ext_db_database[$target], USE_PCONNECT, false);  
//echo $ext_db_database[$target]; exit;		

		if (!( $_GET['norebuild']==1))
		{
//echo 'MMMMMMMMMMMMMMMMMMMMMMMMM';exit;
		$ddl = " drop table if exists whos_online_bckp2 ";
			$db->Execute($ddl);

//					and date_format(invoice_date,"%Y-%c-%d")
			
			$ddl = "create table whos_online_bckp2
					as 
					select  
					date(date_sub(from_unixtime(whos_online_bckp.time_entry),INTERVAL WEEKDAY(from_unixtime(whos_online_bckp.time_entry)) -0 DAY)) date_selection,
					 last_page_url
					from  whos_online_bckp
					where full_name not like '%pider%'
					and full_name not like '%bot%'
					and last_page_url like '%prf.html%'
 					and date(date_sub(from_unixtime(whos_online_bckp.time_entry),INTERVAL WEEKDAY(from_unixtime(whos_online_bckp.time_entry)) -0 DAY)) between '".$sd."' AND '".$ed."'					
					";
//echo $ddl;exit;								
					
			$db->Execute($ddl);

			$ddl = "alter table whos_online_bckp2 add page_url varchar(255)";
			$db->Execute($ddl);

			$ddl = "update whos_online_bckp2
					set page_url=last_page_url";
			$db->Execute($ddl);

			$ddl = "update whos_online_bckp2 
					set page_url = replace ( page_url, '/lampe-','')";
			$db->Execute($ddl);

			$ddl = "update whos_online_bckp2 
					set page_url = replace ( page_url, '/site_v4_fr','')";
			$db->Execute($ddl);
			
			

			$ddl = "update whos_online_bckp2 
					set page_url = replace ( page_url, '/lampada-','')";
			$db->Execute($ddl);

			$ddl = "update whos_online_bckp2 
					set page_url = replace ( page_url, '/lampara-','')";
			$db->Execute($ddl);
			
			$ddl = "update whos_online_bckp2 
					set page_url = replace ( page_url, '-lamp','')";
			$db->Execute($ddl);

			$ddl = "update whos_online_bckp2 
					set page_url = replace ( page_url, '-beamerlampe','')";
			$db->Execute($ddl);

			
			
			if ( ($target=="en") || ($target=="de") )
			{
				$ddl = "update whos_online_bckp2 
						set page_url = substring(page_url,2)";
						
				$db->Execute($ddl);
			}
			
			$ddl = "update whos_online_bckp2 
					set page_url = substring(page_url,1,LOCATE('-lprf.html',page_url)-1) 
					where page_url like '%-lprf.html%' ";
			$db->Execute($ddl);

			$ddl = "update whos_online_bckp2 
					set page_url = substring(page_url,1,LOCATE('-vprf.html',page_url)-1) 
					where page_url like '%-vprf.html%' ";
			$db->Execute($ddl);
			
			
			$ddl = "update whos_online_bckp2 
					set page_url = replace ( page_url, '-vprf.html','')";
			$db->Execute($ddl);

			$ddl = "alter table whos_online_bckp2 add manufacturer varchar(30)";
			$db->Execute($ddl);

			$ddl = "alter table whos_online_bckp2 add vp varchar(30)";
			$db->Execute($ddl);

			$ddl = "alter table whos_online_bckp2 add lampe varchar(30)";
			$db->Execute($ddl);

			$ddl = "update whos_online_bckp2 set lampe=substring(page_url,LOCATE('/',page_url)+1) 
					where last_page_url like '%lprf.html%' ";
			$db->Execute($ddl);


			$ddl = "update whos_online_bckp2 set vp=substring(page_url,LOCATE('/',page_url)+1) 
					where last_page_url like '%vprf.html%' ";
			$db->Execute($ddl);


			$ddl = "update whos_online_bckp2 
					set manufacturer=substring(page_url,1,LOCATE('/',page_url)-1)";
			$db->Execute($ddl);

			
			$ddl = "update whos_online_bckp2	
					set lampe=(select ref_constructeur_composant from el_v_composants where libelle_produit=vp limit 0,1)
					where length(vp)>0";
					
			$db->Execute($ddl);
			
			$ddl = " drop table if exists whos_online_digest2 ";
			$db->Execute($ddl);
// vente LO vente_lo
// vente OI vente_oi
// vente LC  vente_lc
// vente total  vente_all
// derniere marge LO  marge_lo
// derniere marge OI  marge_oi
// derniere marge LC  marge_lc
// ratio vente/visite (calcul)    ratio 
// ratio inverse vente/visite (calcul) ratio_inverse
// ratio inverse visite (calcul)  ratio_visite_inverse
// ordre_tri

			
			$ddl = " create table whos_online_digest2
					as 
					select  manufacturer, 	lampe, count(1) cnt,
					        12345 vente_lo,12345 vente_oi,12345 vente_lc,
							12345 vente_all,12345 marge_lo,12345 marge_oi,
							12345 marge_lc,12.345 ratio,
							12.345 ratio_inverse, 12.345 ratio_visite, 12.345 ordre_tri,
							12345 prix_lo,12345 prix_oi,12345 prix_lc,
							12345 prix_v16_lo,12345 prix_v16_oi,12345 prix_v16_lc
					from whos_online_bckp2
					where length(lampe)>0
					group by manufacturer, lampe 
					order by count(1) desc
					limit 0,300";
					
			$db->Execute($ddl);		
//echo 	$ddl;exit;		
			$addon = "";
			// section commune
		}
// ajouter rownum sur le lot de 300 + clické&s
// vente LO vente_lo
// vente OI vente_oi
// vente LC  vente_lc
// vente total  vente_all
// derniere marge LO  marge_lo
// derniere marge OI  marge_oi
// derniere marge LC  marge_lc
// ratio vente/visite (calcul)    ratio 
// ratio inverse vente/visite (calcul) ratio_inverse
// ratio inverse visite (calcul)  ratio_visite_inverse
// ordre_tri

		// sélection pour calcul
		
		$dml = "update whos_online_digest2 
				 set vente_lo=0,vente_oi=0,vente_lc=0,
				vente_all=0,marge_lo=0,marge_oi=0,
				marge_lc=0,ratio=0,ratio_inverse=0, 
				ratio_visite=0, ordre_tri=0,
				prix_lo=0,prix_oi=0,prix_lc=0";
				
		$db->Execute($dml);
					
		  	
		$rs = $db->Execute("select manufacturer,lampe  ". $addon ."  ,cnt from whos_online_digest2");
		
		$cnt_max = 0;
		
		while( !$rs->EOF )
		{
			
			
			$cnt = $rs->fields['cnt'];
			if (! $cnt_max )
			   $cnt_max = $cnt;
			   
			$sql = "select sum(products_quantity) value 
			from orders_products,orders 
			where orders.orders_id = orders_products.orders_id 
			".$add_where."
			and date_purchased between '" . $sd . "' AND '" . $ed . "'			
			and products_model like '".ltrim(rtrim($rs->fields['lampe'])) ."'";
			
//echo $sql;	exit;
			$vente_lo = exec_select ( $sql );
			
			$sql = "select sum(products_quantity) value 
			from orders_products,orders 
			where orders.orders_id = orders_products.orders_id 
			".$add_where."
			and date_purchased between '" . $sd . "' AND '" . $ed . "'			
			and products_model like '".ltrim(rtrim($rs->fields['lampe'])) ."'";
			
//echo $sql;	exit;
			$vente_lo = exec_select ( $sql );


			$sql = "select sum(products_quantity) value 
			from orders_products,orders 
			where orders.orders_id = orders_products.orders_id 
			".$add_where."
			and date_purchased between '" . $sd . "' AND '" . $ed . "'			
			and products_model like 'OI-".ltrim(rtrim($rs->fields['lampe'])) ."'";
			
//echo $sql;	exit;
			$vente_oi = exec_select ( $sql );
			

			$sql = "select sum(products_quantity) value 
			from orders_products,orders 
			where orders.orders_id = orders_products.orders_id 
			".$add_where."
			and date_purchased between '" . $sd . "' AND '" . $ed . "'			
			and products_model like 'MCEL-".ltrim(rtrim($rs->fields['lampe'])) ."'";
			
//echo $sql;	exit;
			$vente_lc = exec_select ( $sql );
			
			
			$vente_all = $vente_lo + $vente_oi + $vente_lc;
			
		    $ratio = $vente_all / $cnt;
			if ($ratio>1)
			{
				$ratio = 1;
			}

			$ratio_inverse = 1 - $ratio;
			$ratio_visite_inverse = $cnt / $cnt_max;
			
			$ordre_tri= $ratio_inverse + $ratio_visite_inverse;
			
			
// ordre_tri			
			
			$liste["fr"]=1;
			$tva["fr"]=1.196;

			$liste["en"]=8;
			$tva["en"]=887/865;

			$liste["de"]=3;
			$tva["de"]=1.19;

			$liste["es"]=2;
			$tva["es"]=1.21;

			$liste["it"]=9;
			$tva["it"]=1.21;
			
			// 12
			
			$sql = "select min(price) value 
			        from rv_lampe_eu.el_price
					where price_list_id=". $liste[$target] ."
					and lamp_code = '". $rs->fields['lampe'] ."'";
//echo $sql; exit;
			$prix_lo = exec_select($sql);

			
			// ----------- LO ------------------------
			if ( $prix_lo > 0  )
			{
				$sql = "select  final_price unit_order_price, usd_euro_rate, address_book.entry_country_id 
						from bo_po.orders , bo_po.orders_products, bo_po.customers, bo_po.address_book
						where orders.orders_id = orders_products.orders_id
						and   products_model = '". $rs->fields['lampe'] . "'
						and   final_price > 0
						and   database_code = 'po'
						and    orders.customers_id not in (29,28)
						and customers.customers_id = orders.customers_id
						and customers.customers_default_address_id = address_book.address_book_id					
						order by orders_products_id desc ";
							
				$rs_po =  $db->Execute($sql);

				$unit_order_price = $rs_po->fields['unit_order_price'];
				$usd_euro_rate = $rs_po->fields['usd_euro_rate'];
				

				if ($usd_euro_rate)
					$marge_lo=round($prix_lo-$unit_order_price/$usd_euro_rate);				
				else
					$marge_lo=0;
				
				$prix_lo = round($prix_lo*$tva[$target],0);				
			}
			else
			{
				$marge_lo=0;
				$prix_lo=0;			
			}
			
			// ----------- OI ------------------------
			$sql = "select min(price) value 
			        from rv_lampe_eu.el_price
					where price_list_id=". $liste[$target] ."
					and lamp_code = 'OI-". $rs->fields['lampe'] ."'";

			$prix_oi = exec_select($sql);

			if ( $prix_oi > 0  )
			{
				$sql = "select  final_price unit_order_price, usd_euro_rate, address_book.entry_country_id 
						from bo_po.orders , bo_po.orders_products, bo_po.customers, bo_po.address_book
						where orders.orders_id = orders_products.orders_id
						and   products_model = 'OI-". $rs->fields['lampe'] . "'
						and   final_price > 0
						and   database_code = 'po'
						and    orders.customers_id not in (29,28)
						and customers.customers_id = orders.customers_id
						and customers.customers_default_address_id = address_book.address_book_id					
						order by orders_products_id desc ";
							
				$rs_po =  $db->Execute($sql);
				$unit_order_price = $rs_po->fields['unit_order_price'];
				$usd_euro_rate = $rs_po->fields['usd_euro_rate'];
				if ($usd_euro_rate)
					$marge_oi=round($prix_oi-$unit_order_price/$usd_euro_rate);
				else
					$marge_oi=0;
				
				$prix_oi = round($prix_oi*$tva[$target],0);				
			}
			else
			{
				$marge_oi=0;
				$prix_oi=0;			
			}
			
			// ----------- LC ------------------------
			$sql = "select min(price) value 
			        from rv_lampe_eu.el_price
					where price_list_id=". $liste[$target] ."
					and lamp_code = 'MCEL-". $rs->fields['lampe'] ."'";

			$prix_lc = exec_select($sql);

			if ( $prix_lc > 0  )
			{
				$sql = "select  final_price unit_order_price, usd_euro_rate, address_book.entry_country_id 
						from bo_po.orders , bo_po.orders_products, bo_po.customers, bo_po.address_book
						where orders.orders_id = orders_products.orders_id
						and   products_model = 'MCEL-". $rs->fields['lampe'] . "'
						and   final_price > 0
						and   database_code = 'po'
						and    orders.customers_id not in (29,28)
						and customers.customers_id = orders.customers_id
						and customers.customers_default_address_id = address_book.address_book_id					
						order by orders_products_id desc ";
							
				$rs_po =  $db->Execute($sql);
				$unit_order_price = $rs_po->fields['unit_order_price'];
				$usd_euro_rate = $rs_po->fields['usd_euro_rate'];

				if ($usd_euro_rate)
					$marge_lc=round($prix_lc-$unit_order_price/$usd_euro_rate);
				else
					$marge_lc=0;
				
				$prix_lc = round($prix_lc*$tva[$target],0);
				
			}
			else
			{
				$marge_lc=0;
				$prix_lc=0;			
			}
			
			// prix v16  LO OI LC
			$sql = "select min(price) value 
			        from rv_lampe_eu.el_price
					where price_list_id=12
					and lamp_code = '". $rs->fields['lampe'] ."'";

			$prix_v16_lo = exec_select($sql);
			if ($prix_v16_lo>0)
				$prix_v16_lo = round($prix_v16_lo*$tva[$target],0);				
			else
				$prix_v16_lo = 0;				
			

			$sql = "select min(price) value 
			        from rv_lampe_eu.el_price
					where price_list_id=12
					and lamp_code = 'OI-". $rs->fields['lampe'] ."'";

			$prix_v16_oi = exec_select($sql);
			if ($prix_v16_oi>0)
				$prix_v16_oi = round($prix_v16_oi*$tva[$target],0);				
			else
				$prix_v16_oi = 0;				
			

			$sql = "select min(price) value 
			        from rv_lampe_eu.el_price
					where price_list_id=12
					and lamp_code = 'MCEL-". $rs->fields['lampe'] ."'";

			$prix_v16_lc = exec_select($sql);
			if ($prix_v16_lc>0)
				$prix_v16_lc = round($prix_v16_lc*$tva[$target],0);				
			else
				$prix_v16_lc = 0;				
			
			$dml = "update whos_online_digest2 
					set vente_lo='". $vente_lo  ."',vente_oi='". $vente_oi  ."',vente_lc='". $vente_lc  ."',
					vente_all='". $vente_all  ."',marge_lo='". $marge_lo  ."',marge_oi='". $marge_oi  ."',
					marge_lc='". $marge_lc  ."',ratio='". $ratio  ."',ratio_inverse='". $ratio_inverse  ."', 
					ratio_visite='". $ratio_visite  ."', ordre_tri='". $ordre_tri  ."',
					prix_lo='". $prix_lo  ."',prix_oi='". $prix_oi  ."',prix_lc='". $prix_lc ."',
					prix_v16_lo='". $prix_v16_lo  ."',prix_v16_oi='". $prix_v16_oi  ."',prix_v16_lc='". $prix_v16_lc ."'					
					where lampe ='". $rs->fields['lampe']."'";
					
			$db->Execute($dml);
			
			
/*			
			// les ventes autres -----------------------------------------
			$sql = "select sum(products_quantity) value 
			from rv_lampe_eu.orders_products,orders 
			where orders.orders_id = orders_products.orders_id 
			".$add_where."
			and orders_status in (2,3)
			and date_purchased between '" . $sd . "' AND '" . $ed . "'
			and products_model like '%".ltrim(rtrim($rs->fields['lampe'])) ."'
			and products_model not like '".ltrim(rtrim($rs->fields['lampe'])) ."'";
			
//echo $sql;	exit;
			$ventes_autres = exec_select ( $sql );
			
			echo $ventes_autres.$csv_separator;	
		    */
			
			$rs->MoveNext();
		}


       		 
		// sélection pour affichage 
		$rs = $db->Execute("select manufacturer,lampe,cnt,
					vente_lo,vente_oi,vente_lc,vente_all,
					marge_lo,marge_oi,
					marge_lc,ordre_tri,
					prix_lo,prix_oi,prix_lc,
					prix_v16_lo,prix_v16_oi,prix_v16_lc					
		from whos_online_digest2
		order by ordre_tri desc");
		
		while( !$rs->EOF )
		{

			echo $rs->fields['manufacturer'].$csv_separator;
			echo $rs->fields['lampe'].$csv_separator;			
			echo $rs->fields['cnt'].$csv_separator;
			echo $rs->fields['vente_lo'].$csv_separator;
			echo $rs->fields['vente_oi'].$csv_separator;
			echo $rs->fields['vente_lc'].$csv_separator;
			echo $rs->fields['vente_all'].$csv_separator;
			echo $rs->fields['marge_lo'].$csv_separator;
			echo $rs->fields['marge_oi'].$csv_separator;
			echo $rs->fields['marge_lc'].$csv_separator;
			echo $rs->fields['ordre_tri'].$csv_separator;
			echo $rs->fields['prix_lo'].$csv_separator;
			echo $rs->fields['prix_oi'].$csv_separator;
			echo $rs->fields['prix_lc'].$csv_separator;;
			echo $rs->fields['prix_v16_lo'].$csv_separator;
			echo $rs->fields['prix_v16_oi'].$csv_separator;
			echo $rs->fields['prix_v16_lc'];
			
			echo '
';
			$rs->MoveNext();
		}
		echo '</textarea>';
		
/*		
		$ddl = " alter table whos_online_digest2 add nb_sales integer(4) ";
		$db->Execute($ddl);		

update 	whos_online_digest2 add 	
		echo 'fin';
		exit; */
		
	}
	echo '</textarea>';
		
/*		
		$ddl = " alter table whos_online_digest2 add nb_sales integer(4) ";
		$db->Execute($ddl);		

update 	whos_online_digest2 add 	
		echo 'fin';
		exit; */
		
	}
    // END if ($target)
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