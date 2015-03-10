<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: stats_products_viewed.php 1969 2005-09-13 06:57:21Z drbyte $
//
  require('includes/application_top.php');
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
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
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">Numéro</td>
                <td class="dataTableHeadingContent">Extraction</td>
              </tr>
<?php
 // echo '<a href="el_live_report.php" target=_new>Rapport 1 </a>';
  if (isset($_GET['page']) && ($_GET['page'] > 1)) $rows = $_GET['page'] * MAX_DISPLAY_SEARCH_RESULTS_REPORTS - MAX_DISPLAY_SEARCH_RESULTS_REPORTS;
  $rows = 0;
  $products_query_raw = "select id, name, creationdate products_viewed, name from bi_request  ";
  $products_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS_REPORTS, $products_query_raw, $products_query_numrows);
?>
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" align="right">1&nbsp;&nbsp;</td>
                <td class="dataTableContent"><?php echo '<a target=_new href="../extractions/el_facture_cmde_extract.php">Numéro de Facture/Numéro de commande</a> (' . $products->fields['name'] . ')'; ?></td>
              </tr>
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" align="right">2&nbsp;&nbsp;</td>
                <td class="dataTableContent"><?php echo '<a target=_new href="../extractions/el_operations_cartes.php?lot=1">Opérations CC/ num Facture / Num Cmde Lot 1</a> (' . $products->fields['name'] . ')'; ?></td>
              </tr>
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" align="right">2&nbsp;&nbsp;</td>
                <td class="dataTableContent"><?php echo '<a target=_new href="../extractions/el_operations_cartes.php?lot=2">Opérations CC/ num Facture / Num Cmde Lot 2</a> (' . $products->fields['name'] . ')'; ?></td>
              </tr>
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" align="right">2&nbsp;&nbsp;</td>
                <td class="dataTableContent"><?php echo '<a target=_new href="../extractions/el_receptions_cmde.php?lot=1">Réceptions de commandes fournisseurs</a> ( limité à 50 jours )'; ?></td>
              </tr>
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" align="right">2&nbsp;&nbsp;</td>
                <td class="dataTableContent"><?php echo '<a target=_new href="../extractions/el_receptions_cmde.php?lot=2">Réceptions de commandes fournisseurs</a> ( sans limite )'; ?></td>
              </tr>
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" align="right">&nbsp;&nbsp;</td>
                <td class="dataTableContent"><?php echo '<a target=_new href="../extractions/el_sorties_de_stock.php?lot=2">Sorties de stock</a> ( sans limite )'; ?></td>
              </tr>			  
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" align="right">&nbsp;&nbsp;</td>
                <td class="dataTableContent"><?php echo '<a target=_new href="../extractions/el_sorties_de_stock.php?lot=2&ucs=1">Sorties du CONSIGNEMENT STOCK </a> ( sans limite )'; ?></td>
              </tr>
			  
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" align="right">&nbsp;&nbsp;</td>
                <td class="dataTableContent"><?php echo '<a target=_new href="../extractions/el_vente_mois.php">Ventes du mois</a> '; ?></td>
              </tr>
			  
			  
<?php
?>
            </table></td>
          </tr>
          <tr>
            <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_REPORTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
                <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_REPORTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>