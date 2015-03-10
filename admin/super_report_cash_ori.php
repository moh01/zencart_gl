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

  $target = (isset($_GET['target']) ? $_GET['target'] : false);
  $is_for_display = ($_GET['print_format'] == 1 ? false : true);

  /*
  707000	m	19.6	VENTES DE MARCHANDISES
707010	m	16	VENTES PARTICULIER ESPAGNE 16%
707020	m	19	VENTES PARTICULIER Allemagne 19%
707030	m	20	VENTES PARTICULIER AUTRICHE 20%
707040	m	21	VENTES PARTICULIER Belgique 21%
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
  */
  function get_product_code ($p_product_type,$tax,$country )
  {
     if ( $tax==19.6) 
        $country_code = "fr";
     else if ($tax==16) 
        $country_code = "es";
     else if ($tax==19) 
        $country_code = "de";
     else if ($tax==20) 
        $country_code = "au";
     else if ($tax==21) 
        $country_code = "be";
     else if ($tax==0)
     {
        if ( ($country!='Deutschland')
             && ($country!='Österreich')
             && ($country!='España')
             && ($country!='Belgique') 
           )
          $country_code = "ex";
        else
          $country_code = "ue";
     }        
     if ( $p_product_type=="SHF" || $p_product_type=="CODF" )
     {
        $radical = "708";
        if ( $country_code=="fr" )
           $terminaison = "500";
        else if ( $country_code=="es" )
           $terminaison = "520";
        else if ( $country_code=="de" )
           $terminaison = "530";        
        else if ( $country_code=="au" )
           $terminaison = "540";        
        else if ( $country_code=="be" )
           $terminaison = "550";        
        else if ( $country_code=="ue" )
           $terminaison = "510";        
        else if ( $country_code=="ex" )
           $terminaison = "900";

        $response = $radical.$terminaison;

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
           $terminaison = "010";
        else if ( $country_code=="de" )
           $terminaison = "020";        
        else if ( $country_code=="au" )
           $terminaison = "030";        
        else if ( $country_code=="be" )
           $terminaison = "040";        
        else if ( $country_code=="ue" )
           $terminaison = "910";        
        else if ( $country_code=="ex" )
           $terminaison = "920";        
        
        $response = $radical.$terminaison;
     }
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
        <td><?php echo '<a href="' . zen_href_link(FILENAME_SUPER_REPORT_CASH, 'target=' . $target) . '&start_date=' . $_GET['start_date'] . '&end_date=' . $_GET['end_date'] . '"><span class="pageHeading">' .  HEADING_TITLE . '</span></a>'; ?></td>
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
          <?php echo zen_draw_form('search', FILENAME_SUPER_REPORT_CASH, '', 'get'); ?>
          <tr>
            <td class="main">Type de rapport</td>
            <td class="main"><?php echo HEADING_DATE_RANGE; ?></td>
          </tr>
          <tr>
            <td valign="top"><table border="0" cellspacing="2" cellpadding="0">
              <tr>
                <td class="main" valign="top"><input type="radio" name="target" value="liaison" CHECKED>Liaison comptable</td>
              </tr>
              <tr>
                <td class="main" valign="top"><input type="radio" name="target" value="ecritures" >Ecritures</td>
               </tr>
            </table></td>
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
                <td class="smallText" valign="top"><br /><?php echo zen_draw_checkbox_field('print_format', 1) . HEADING_PRINT_FORMAT; ?></td>
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
?>
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
      </tr>
<?php
    $grand_count = 0;
    $grand_total = 0;
    $num_of_types = 0;

    if ($target == 'ecritures' || $target == 'liaison') {
      $ords_query = "SELECT p.orders_invoices_id, p.invoice_type, p.invoice_date, p.orders_id oid , o.* FROM orders_invoices p
                        LEFT JOIN orders o
                        ON p.orders_id = o.orders_id
                        WHERE invoice_date BETWEEN '" . $sd . "' AND DATE_ADD('" . $ed . "', INTERVAL 1 DAY)
                        ORDER BY invoice_date asc";
//echo  $ords_query;exit;                       
      $ords = $db->Execute($ords_query);
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
       if ( $ords->fields['invoice_type']=='DB' )
         $num_piece = "INT".$ords->fields['orders_invoices_id'];
       else
         $num_piece = "AINT".$ords->fields['orders_invoices_id'];
         
       if ( strlen($ords->fields['customers_company'])>0 )
         $cst_name = $ords->fields['customers_company'];
       else
         $cst_name = $ords->fields['customers_name'];
         
      $site = $ords->fields['database_code'];
      $country = $ords->fields['customers_country'];
      $postcode = $ords->fields['customers_postcode'];

      $totalttc = $ords->fields['order_total'];
      $totaltax = $ords->fields['order_tax'];
      
      $totalht = $totalttc-$totaltax;
      
      $nii = $ords->fields['entry_tva_intracom'];
      
      	

      $prd_qry = " select * from orders_products where orders_id  = " . $ords->fields['oid'];
      $prds = $db->Execute($prd_qry);
      while (!$prds->EOF)
      {
         $qty = $prds->fields['products_quantity'];
         $pprice = $prds->fields['final_price'];
         $detailht = $pprice*$qty;
         $tax = $prds->fields['products_tax'];
         $products_model  = $prds->fields['products_model'];
         
         $code = get_product_code($products_model,$tax,$country);

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
         $prds->MoveNext();
      }

      $ot_qry = " select * from orders_total where value<>0 and class in ('ot_shipping','ot_cod_fee','ot_loworderfee' ) and orders_id  = " . $ords->fields['oid'];
      $ot = $db->Execute($ot_qry);
      while (!$ot->EOF)
      {
      
         $detailht = $ot->fields['value'];
         $product_type = $ot->fields['class'];
         $products_model = $product_type;
         
         if ($product_type=='ot_shipping')
           $products_model = 'FT';
         else if ($product_type=='ot_loworderfee')
           $products_model = 'EC';
         else if ($product_type=='ot_cod_fee')
           $products_model = 'COD';
         
         
         // dans ces cas la TVA n'est pas rajoutée         
         if  ( ( $product_type ==  'ot_loworderfee' ) && ( $site == "eu" )  )
         {
            // $products_model  = 'COD';
         }
         else
         {
            $detailht = round ( $detailht / ( 1 + ( $tax / 100 ) ),2);
            //$detailht =  $tax;
         }        
         
         
         $code = get_product_code($product_type,$tax,$country);
//Famille	Article	Mt Tot HT	CP	N.I.I.


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
         $ot->MoveNext();
      }
      
          $sub_count++;
          $grand_count++;

          $sub_total += $ords->fields['payment_amount'];
          $grand_total += $ords->fields['payment_amount'];

          $ords->MoveNext();

     }  // END while (!$ords->EOF)
?>
    </table></td>
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