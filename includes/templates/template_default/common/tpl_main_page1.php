<?php
/**
 * Common Template - tpl_main_page.php
 *
 * Governs the overall layout of an entire page<br />
 * Normally consisting of a header, left side column. center column. right side column and footer<br />
 * For customizing, this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * - make a directory /templates/my_template/privacy<br />
 * - copy /templates/templates_defaults/common/tpl_main_page.php to /templates/my_template/privacy/tpl_main_page.php<br />
 * <br />
 * to override the global settings and turn off columns un-comment the lines below for the correct column to turn off<br />
 * to turn off the header and/or footer uncomment the lines below<br />
 * Note: header can be disabled in the tpl_header.php<br />
 * Note: footer can be disabled in the tpl_footer.php<br />
 * <br />
 * $flag_disable_header = true;<br />
 * $flag_disable_left = true;<br />
 * $flag_disable_right = true;<br />
 * $flag_disable_footer = true;<br />
 * <br />
 * // example to not display right column on main page when Always Show Categories is OFF<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 * <br />
 * example to not display right column on main page when Always Show Categories is ON and set to categories_id 3<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '' or $cPath == '3') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php 3856 2006-06-29 02:26:33Z drbyte $
 */

// the following IF statement can be duplicated/modified as needed to set additional flags
  if (in_array($current_page_base,explode(",",'list_pages_to_skip_all_right_sideboxes_on_here,separated_by_commas,and_no_spaces')) ) {
    $flag_disable_right = true;
  }


  $header_template = 'tpl_header.php';
  $footer_template = 'tpl_footer.php';
  $left_column_file = 'column_left.php';
  $right_column_file = 'column_right.php';
  $body_id = str_replace('_', '', $_GET['main_page']);
?>
<body id="<?php echo $body_id . 'Body'; ?>"<?php if($zv_onload !='') echo ' onload="'.$zv_onload.'"'; ?>>
<?php
  if (SHOW_BANNERS_GROUP_SET1 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET1)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerOne" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>

<div id="mainWrapper">
<?php
 /**
  * prepares and displays header output
  *
  */
  require($template->get_template_dir('tpl_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_header.php');?>
  <table width="740" border="0" cellspacing="0" style="background:#ffffff;">
    <tr > 
      <td colspan="2"  style="margin: 0px;padding: 0px 0px 0px 0px;" style="background:#a6a39d;"><img src="includes/templates/template_default/images/el_haut.gif" width="740" height="84"></td>
    </tr>
    <tr> 
      <td width="28%" bgcolor="#2ca6bf" height="29"  style="margin: 0px;padding: 0px 0px 0px 0px;"><img src="includes/templates/template_default/images/customer_zone.jpg" width="209" height="34"></td>



      <td width="72%" rowspan="5"> 
        <table width="100%" height="147%" border="0" cellspacing="0">
          <tr> 
            <td width="4%">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td width="4%">&nbsp;</td>
          </tr>
          <tr> 
            <td width="4%">&nbsp;</td>
            <td bgcolor="#c12929" colspan=4> 
              <table width="100%" border="0" cellspacing="0">
                <tr> 
                  <td bgcolor="c12929" colspan=4 height=4></td>
                </tr>
                <tr> 
                  <td width="1%" height="17">&nbsp;</td>
                  <td colspan="2" height="17"><font face="Arial, Helvetica, sans-serif" color="#FFFFFF" size="3">Remplacer 
                    <b>la lampe</b> de votre videoprojecteur</font></td>
                  <td width="10%" height="17">&nbsp;</td>
                </tr>
                <tr> 
                  <td width="1%" height="15">&nbsp;</td>
                  <td width="20%" height="15">&nbsp;</td>
                  <td colspan="2" width="40%" height="15"><font face="Arial, Helvetica, sans-serif" color="#FFFFFF" size="3"><b>n'a 
                    jamais &eacute;t&eacute; aussi simple !</b></font></td>
                </tr>
                <tr> 
                  <td colspan="4"  height=4></td>
                </tr>
              </table>
            </td>
            <td width="4%">&nbsp;</td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td colspan="4" rowspan="4" style="border-right: 1px solid #666; border-left: 1px solid #999; border-bottom: 1px solid #999;"> 
              <table width="100%" border="0" cellspacing="0">
                <tr> 
                  <td rowspan="5" width="56%"><img src="includes/templates/template_default/images/el_picture.jpg" width="268" height="202"></td>
                  <td width="44%"><img src="includes/templates/template_default/images/step1.jpg" width="174" height="39"></td>
                </tr>
                <tr> 
                  <td width="44%" align="center"> 
                    <select>
                      <option value="">Choisir la marque </option>
                    </select>
                  </td>
                </tr>
                <tr> 
                  <td width="44%"><img src="includes/templates/template_default/images/step2.jpg" width="176" height="36"></td>
                </tr>
                <tr> 
                  <td width="44%" align="center"> 
                    <select>
                      <option value="">Choisir le modèle </option>
                    </select>
                  </td>
                </tr>
                <tr> 
                  <td width="44%"><img src="includes/templates/template_default/images/step3.jpg" width="176" height="38"></td>
                </tr>
                <tr> 
                  <td colspan="2"><img src="includes/templates/template_default/images/el_logos.gif" width="486" height="72"></td>
                </tr>
              </table>
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td colspan="3"><img src="includes/templates/template_default/images/secured_payment.jpg" width="300" height="64"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>


    </tr>
    <tr> 
      <td width="28%" bgcolor="#2b99b1" height="22" align="center"> 
        <input type="text" name="text2">
      </td>
    </tr>
    <tr> 
      <td align=center width="28%" bgcolor="#2b99b1" height="8"><img src="includes/templates/template_default/images/password.jpg" width="208" height="12"> 
        <input type="text" name="text">
      </td>
    </tr>
    <tr> 
      <td bgcolor="#288ba2"><img src="includes/templates/template_default/images/become_customer.jpg" width="207" height="18"> 
      </td>
    </tr>
    <tr> 
      <td height="164" width="28%"><img  VSPACE=5 HSPACE=5  src="includes/templates/template_default/images/why_el2.jpg" ></td>
    </tr>
    <tr> 
      <td colspan="2" align=center  style="background:#a6a39d; margin: 0px;padding: 0px 0px 0px 0px;"><img src="includes/templates/template_default/images/footer.jpg"></td>
    </tr>
  </table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" id="contentMainWrapper">
  <tr>
<?php
if (COLUMN_LEFT_STATUS == 0 or (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '')) {
  // global disable of column_left
  $flag_disable_left = true;
}
/*
 modifications FV
*/
  $flag_disable_left = true;
  $flag_disable_right = true;
  require(DIR_WS_MODULES . zen_get_module_directory('column_left.php'));
if (!isset($flag_disable_left) || !$flag_disable_left) {
?>

 <td id="navColumnOne" class="columnLeft" style="width: <?php echo COLUMN_WIDTH_LEFT; ?>">

<?php
 /**
  * prepares and displays left column sideboxes
  *
  */
?>
<div id="navColumnOneWrapper" style="width: <?php echo BOX_WIDTH_LEFT; ?>"><?php require(DIR_WS_MODULES . zen_get_module_directory('column_left.php')); ?></div></td>
<?php
}
?>

    <td valign="top">
<!-- bof  breadcrumb -->
<?php 
    $temp = $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); 
if ((DEFINE_BREADCRUMB_STATUS == '1')&&(  strpos($temp,"::",strpos($temp,"::")+2) ) ) { 
?>
    <div id="navBreadCrumb">
     <?php 
            echo $temp;
     ?>
    </div>
<?php } ?>
<!-- eof breadcrumb -->

<?php
  if (SHOW_BANNERS_GROUP_SET3 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET3)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerThree" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>

<!-- bof upload alerts -->
<?php if ($messageStack->size('upload') > 0) echo $messageStack->output('upload'); ?>
<!-- eof upload alerts -->

<?php
 /**
  * prepares and displays center column
  *
  */
 require($body_code); ?>

<?php
  if (SHOW_BANNERS_GROUP_SET4 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET4)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerFour" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?></td>

<?php
if (COLUMN_RIGHT_STATUS == 0 or (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '')) {
  // global disable of column_right
  $flag_disable_right = true;
}
if (!isset($flag_disable_right) || !$flag_disable_right) {
?>
<td id="navColumnTwo" class="columnRight" style="width: <?php echo COLUMN_WIDTH_RIGHT; ?>">
<?php
 /**
  * prepares and displays right column sideboxes
  *
  */
?>
<div id="navColumnTwoWrapper" style="width: <?php echo BOX_WIDTH_RIGHT; ?>"><?php require(DIR_WS_MODULES . zen_get_module_directory('column_right.php')); ?></div></td>
<?php
}
?>
  </tr>
</table>

<?php
 /**
  * prepares and displays footer output
  *
  */
  require($template->get_template_dir('tpl_footer.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_footer.php');?>
</div>
<!--bof- parse time display -->
<?php
  if (DISPLAY_PAGE_PARSE_TIME == 'true') {
?>
<div class="smallText center">Parse Time: <?php echo $parse_time; ?> - Number of Queries: <?php echo $db->queryCount(); ?> - Query Time: <?php echo $db->queryTime(); ?></div>
<?php
  }
?>
<!--eof- parse time display -->
<!--bof- banner #6 display -->
<?php
  if (SHOW_BANNERS_GROUP_SET6 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET6)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerSix" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>
<!--eof- banner #6 display -->
</body>