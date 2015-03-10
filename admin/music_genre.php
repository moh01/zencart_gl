<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
//  $Id: music_genre.php 2331 2005-11-10 07:58:16Z drbyte $
//

  require('includes/application_top.php');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (zen_not_null($action)) {
    switch ($action) {
      case 'insert':
      case 'save':
        if (isset($_GET['mID'])) $cc_transaction_id = zen_db_prepare_input($_GET['mID']);
        $orders_id = zen_db_prepare_input($_POST['orders_id']);

        $sql_data_array = array('orders_id' => $orders_id);

        if ($action == 'insert') {
          $insert_sql_data = array('date_added' => 'now()');

          $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

          zen_db_perform('EL_LOG_CC_TRANSACTIONS', $sql_data_array);
          $cc_transaction_id = zen_db_insert_id();
        } elseif ($action == 'save') {
//          $update_sql_data = array('last_modified' => 'now()');

          $sql_data_array = $sql_data_array;
          zen_db_perform('EL_LOG_CC_TRANSACTIONS', $sql_data_array, 'update', "id = '" . (int)$cc_transaction_id . "'");
        }

        zen_redirect(zen_href_link(FILENAME_MUSIC_GENRE, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'mID=' . $cc_transaction_id));
        break;
      case 'deleteconfirm':
        // demo active test
        if (zen_admin_demo()) {
          $_GET['action']= '';
          $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
          zen_redirect(zen_href_link(FILENAME_MUSIC_GENRE, 'page=' . $_GET['page']));
        }
        $cc_transaction_id = zen_db_prepare_input($_GET['mID']);


        $db->Execute("delete from el_log_cc_transactions
                      where id = '" . (int)$cc_transaction_id . "'");


        zen_redirect(zen_href_link(FILENAME_MUSIC_GENRE, 'page=' . $_GET['page']));
        break;
    }
  }
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
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
                <td class="dataTableHeadingContent">ID Transac.</td>			  
                <td class="dataTableHeadingContent">Site</td>
                <td class="dataTableHeadingContent">Customer</td>				
                <td class="dataTableHeadingContent">Date</td>
                <td class="dataTableHeadingContent">Response</td>		
                <td class="dataTableHeadingContent">Cmde</td>						
				<td class="dataTableHeadingContent">Montant</td>		
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $music_genre_query_raw = "select * from el_log_cc_transactions order by id desc";
  $music_genre_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $music_genre_query_raw, $music_genre_query_numrows);
  $music_genre = $db->Execute($music_genre_query_raw);

  while (!$music_genre->EOF) {

    if ((!isset($_GET['mID']) || (isset($_GET['mID']) && ($_GET['mID'] == $music_genre->fields['id']))) && !isset($aInfo) && (substr($action, 0, 3) != 'new')) {

      $aInfo_array = $music_genre->fields;
      $aInfo = new objectInfo($aInfo_array);
    }

    if (isset($aInfo) && is_object($aInfo) && ($music_genre->fields['id'] == $aInfo->id)) {
      echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_MUSIC_GENRE, 'page=' . $_GET['page'] . '&mID=' . $music_genre->fields['music_genre_id'] . '&action=edit') . '\'">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_MUSIC_GENRE, 'page=' . $_GET['page'] . '&mID=' . $music_genre->fields['id'] . '&action=edit') . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $music_genre->fields['transaction_id']; ?></td>
                <td class="dataTableContent"><?php echo $music_genre->fields['database_code']; ?></td>
                <td class="dataTableContent"><?php echo $music_genre->fields['customers_id']; ?></td>
                <td class="dataTableContent"><?php echo $music_genre->fields['transmission_date']; ?></td>
                <td class="dataTableContent"><?php echo $music_genre->fields['response_code']; ?></td>
                <td class="dataTableContent"><?php echo $music_genre->fields['orders_id']; ?></td>
                <td class="dataTableContent"><?php echo $music_genre->fields['amount']/100; ?></td>


                <td class="dataTableContent" align="right">
                  <?php echo '<a href="' . zen_href_link(FILENAME_MUSIC_GENRE, 'page=' . $_GET['page'] . '&mID=' . $music_genre->fields['id'] . '&action=edit') . '">' . zen_image(DIR_WS_IMAGES . 'icon_edit.gif', ICON_EDIT) . '</a>'; ?>
                  <?php echo '<a href="' . zen_href_link(FILENAME_MUSIC_GENRE, 'page=' . $_GET['page'] . '&mID=' . $music_genre->fields['id'] . '&action=delete') . '">' . zen_image(DIR_WS_IMAGES . 'icon_delete.gif', ICON_DELETE) . '</a>'; ?>
                  <?php if (isset($aInfo) && is_object($aInfo) && ($music_genre->fields['music_genre_id'] == $aInfo->music_genre_id)) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . zen_href_link(FILENAME_MUSIC_GENRE, zen_get_all_get_params(array('mID')) . 'mID=' . $music_genre->fields['music_genre_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>
                </td>
              </tr>
<?php
    $music_genre->MoveNext();
  }
?>
              <tr>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $music_genre_split->display_count($music_genre_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_MUSIC_GENRES); ?></td>
                    <td class="smallText" align="right"><?php echo $music_genre_split->display_links($music_genre_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
                </table></td>
              </tr>
<?php
  if (empty($action)) {
?>
              <tr>
                <td align="right" colspan="2" class="smallText"><?php echo '<a href="' . zen_href_link(FILENAME_MUSIC_GENRE, 'page=' . $_GET['page'] . '&mID=' . $aInfo->music_genre_id . '&action=new') . '">' . zen_image_button('button_insert.gif', IMAGE_INSERT) . '</a>'; ?></td>
              </tr>
<?php
  }
?>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'new':
      $heading[] = array('text' => '<b>' . TEXT_HEADING_NEW_MUSIC_GENRE . '</b>');

      $contents = array('form' => zen_draw_form('music_genre', FILENAME_MUSIC_GENRE, 'action=insert', 'post', 'enctype="multipart/form-data"'));
      $contents[] = array('text' => TEXT_NEW_INTRO);
      $contents[] = array('text' => '<br>Numéro commande<br>' . zen_draw_input_field('orders_id', '',12));
      $contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . zen_href_link(FILENAME_MUSIC_GENRE, 'page=' . $_GET['page'] . '&mID=' . $_GET['mID']) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>Détail du paiement</b>');

      $contents = array('form' => zen_draw_form('music_genre', FILENAME_MUSIC_GENRE, 'page=' . $_GET['page'] . '&mID=' . $aInfo->id . '&action=save', 'post', 'enctype="multipart/form-data"'));
      // $contents[] = array('text' => TEXT_EDIT_INTRO);
      $contents[] = array('text' => '<br />Identifiant de commande<br>' . zen_draw_input_field('orders_id', $aInfo->orders_id, 12));
      $contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . zen_href_link(FILENAME_MUSIC_GENRE, 'page=' . $_GET['page'] . '&mID=' . $aInfo->music_genre_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_HEADING_DELETE_MUSIC_GENRE . '</b>');

      $contents = array('form' => zen_draw_form('music_genre', FILENAME_MUSIC_GENRE, 'page=' . $_GET['page'] . '&mID=' . $aInfo->music_genre_id . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $aInfo->orders_id . '</b>');
//      $contents[] = array('text' => '<br>' . zen_draw_checkbox_field('delete_image', '', true) . ' ' . TEXT_DELETE_IMAGE);

      if ($aInfo->products_count > 0) {
        $contents[] = array('text' => '<br>' . zen_draw_checkbox_field('delete_products') . ' ' . TEXT_DELETE_PRODUCTS);
        $contents[] = array('text' => '<br>' . sprintf(TEXT_DELETE_WARNING_PRODUCTS, $aInfo->products_count));
      }

      $contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . zen_href_link(FILENAME_MUSIC_GENRE, 'page=' . $_GET['page'] . '&mID=' . $aInfo->music_genre_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (isset($aInfo) && is_object($aInfo)) {
        $heading[] = array('text' => '<b>' . $aInfo->orders_id . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_MUSIC_GENRE, 'page=' . $_GET['page'] . '&mID=' . $aInfo->music_genre_id . '&action=edit') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . zen_href_link(FILENAME_MUSIC_GENRE, 'page=' . $_GET['page'] . '&mID=' . $aInfo->music_genre_id . '&action=delete') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_DATE_ADDED . ' ' . zen_date_short($aInfo->date_added));
//        if (zen_not_null($aInfo->last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . zen_date_short($aInfo->last_modified));
        $contents[] = array('text' => '<br>' . TEXT_PRODUCTS . ' ' . $aInfo->products_count);
      }
      break;
  }

  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
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
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
