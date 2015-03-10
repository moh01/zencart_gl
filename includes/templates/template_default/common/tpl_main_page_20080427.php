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

  $lg_code = LG_CODE;

  if ($lg_code==3)
    $file_extension = "_es";
  else if ($lg_code==2)
    $file_extension = "";
  else if ($lg_code==4)
    $file_extension = "_de";


// the following IF statement can be duplicated/modified as needed to set additional flags
  if (in_array($current_page_base,explode(",",'list_pages_to_skip_all_right_sideboxes_on_here,separated_by_commas,and_no_spaces')) ) {
    $flag_disable_right = true;
  }


  $header_template = 'tpl_header.php';
  $footer_template = 'tpl_footer.php';
  $left_column_file = 'column_left.php';
  $right_column_file = 'column_right.php';
  $body_id = str_replace('_', '', $_GET['main_page']);

  $args = explode("_", $cPath );
  $model = $args[1];

  if ($_SESSION['customer_id'] == '')
  {
     $connected = 0;
  }
  else
  {
     $connected = 1;
  }

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

      <td colspan="2"  style="margin: 0px;padding: 0px 0px 0px 0px;">

      <MAP NAME="map1">
      <AREA 
         HREF="index.php" ALT="Accueil" TITLE="Accueil" 
         SHAPE=RECT COORDS="0,0,208,150">
      <AREA 
         HREF="index.php?main_page=privacy" ALT="Qui sommes nous ?" TITLE="Qui sommes nous ?" 
         SHAPE=RECT COORDS="210,0,350,55">
      <AREA 
         HREF="index.php?main_page=shippinginfo" ALT="Garantie" TITLE="Garantie" 
         SHAPE=RECT COORDS="210,55,350,80">
      <AREA 
         HREF="index.php?main_page=page_4" ALT="Lampes compatibles" TITLE="Lampes compatibles" 
         SHAPE=RECT COORDS="350,0,460,55">
      <AREA 
         HREF="index.php?main_page=page_2" ALT="Environnement" TITLE="Environnement" 
         SHAPE=RECT COORDS="350,55,460,80">

      <AREA 
         HREF="index.php?main_page=advanced_search" ALT="Recherche" TITLE="Recherche" 
         SHAPE=RECT COORDS="470,0,610,55">
      <AREA 
         HREF="index.php?main_page=page_3" ALT="Aide" TITLE="Aide" 
         SHAPE=RECT COORDS="470,55,610,80">

      <AREA 
         HREF="index.php?main_page=shopping_cart" ALT="Mon pannier" TITLE="Mon pannier" 
         SHAPE=RECT COORDS="480,0,720,55">
      <AREA 
         HREF="index.php?main_page=contact_us" ALT="Nous contacter" TITLE="Nous contacter" 
         SHAPE=RECT COORDS="480,55,720,80">

      </MAP>
<img src="includes/templates/template_default/images/el_haut.jpg" border=0  usemap="#map1"  width="740" height="84"></td>
    </tr>
    <tr> 
      <td width="28%" bgcolor="#ff9600" height="29"  style="margin: 0px;padding: 0px 0px 0px 0px;" valign="top">
    <?php
     if ( $connected )
     {
       echo '<a href="index.php?main_page=login"><img src="includes/templates/template_default/images/espace_client0.gif" border=0></a>';
     }
     else
     {
       echo '<a href="index.php?main_page=login"><img src="includes/templates/template_default/images/espace_client.gif" border=0></a>';
     }
     ?>
     </td>
      <td width="72%" rowspan="7" valign="top" > 
        <table width="100%"  border="0" cellspacing="0" >
          <tr style="background-image:url(includes/templates/template_default/images/brdst1.jpg);"> 
            <td width="4%">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td width="4%">&nbsp;</td>
          </tr>
          <tr> 
            <td width="4%">&nbsp;</td>
            <?php
            if ( (  ($body_id=="login") && (  $_SESSION['cart']->count_contents() > 0 ) ) ||  ($body_id=="checkoutconfirmation") || ($body_id=="checkoutpayment") || ($body_id=="checkoutshipping") )
            {
              if ($body_id=="login")
              {
                 $img = 'order_step1'. $file_extension .'.jpg';
              }
              else if ($body_id=="checkoutshipping")
              {
                 $img = 'order_step2'. $file_extension .'.jpg';
              }
              else if ($body_id=="checkoutpayment")
              {
                 $img = 'order_step3'. $file_extension .'.jpg';
              }
              else if ($body_id=="checkoutconfirmation")
              {
                 $img = 'order_step4'. $file_extension .'.jpg';
              }
              echo '
            <td  colspan=4> 
                <img src="includes/templates/template_default/images/'. $img .'">                
                 ';            
            }
            else if ( ( $body_id=="index" ) && ! $model )
            {
              if ( $lg_code == 4 )
              {
                echo '
                  <td  style="background-image:url(includes/templates/template_default/images/titre_bckg.jpg);"  colspan=4> 
                    <table width="100%"  border="0" cellspacing="0">
                      <tr> 
                        <td  colspan=4 height=4></td>
                      </tr>
                      <tr> 
                        <td width="1%" height="17">&nbsp;</td>
                        <td colspan="2" height="17"><font face="Arial, Helvetica, sans-serif" color="#FFFFFF" size="4">Die </font>
                          <font face="Arial, Helvetica, sans-serif" color="#FFFFFF" size="4"><b>Lampe</b></font><font face="Arial, Helvetica, sans-serif" color="#FFFFFF" size="4"> Ihres Projektors  zu ersetzen </font></td>
                        <td width="10%" height="17">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td width="1%" height="15">&nbsp;</td>
                        <td width="20%" height="15">&nbsp;</td>
                        <td colspan="2" width="40%" height="15"><font face="Arial, Helvetica, sans-serif" color="#FFFFFF" size="4"><b>
                           war noch nie so einfach! </b></font></td>
                      </tr>
                      <tr> 
                        <td colspan="4"  height=4></td>
                      </tr>
                    </table>
                      ';

              }
              else
              {
                echo '
                  <td  style="background-image:url(includes/templates/template_default/images/titre_bckg.jpg);"  colspan=4> 
                    <table width="100%"  border="0" cellspacing="0">
                      <tr> 
                        <td  colspan=4 height=4></td>
                      </tr>
                      <tr> 
                        <td width="1%" height="17">&nbsp;</td>
                        <td colspan="2" height="17"><font face="Arial, Helvetica, sans-serif" color="#FFFFFF" size="4">Remplacer </font>
                          <font face="Arial, Helvetica, sans-serif" color="#FFFFFF" size="4"><b>la lampe</b></font><font face="Arial, Helvetica, sans-serif" color="#FFFFFF" size="4"> de votre videoprojecteur</font></td>
                        <td width="10%" height="17">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td width="1%" height="15">&nbsp;</td>
                        <td width="20%" height="15">&nbsp;</td>
                        <td colspan="2" width="40%" height="15"><font face="Arial, Helvetica, sans-serif" color="#FFFFFF" size="4"><b>n\'a 
                          jamais &eacute;t&eacute; aussi simple !</b></font></td>
                      </tr>
                      <tr> 
                        <td colspan="4"  height=4></td>
                      </tr>
                    </table>
                      ';
              }
            }
            else
            {           
              echo '
            <td  colspan=4 "> 
                 ';  
            }

              ?> 
            </td>

            <td width="4%">&nbsp;</td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
         <?php
         if ( ( $body_id=="index" ) && ! $model )
           echo '<td colspan="4" rowspan="4" style="border-right: 1px solid #666; border-left: 1px solid #999; border-bottom: 1px solid #999;"> ';
         else
           echo '<td colspan="4" rowspan="4"> ';
         
         ?>
            <table width=100% height="280"><tr><td valign=top>
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

<!-- bof  breadcrumb -->
<?php 
    $temp = $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); 
if ((DEFINE_BREADCRUMB_STATUS == '1')&&(  strpos($temp,"::",strpos($temp,"::")+2) ) ) { 
?>
    <div id="navBreadCrumb2">
     <?php 
            echo $temp;
     ?>
    </div>
    <hr style="border:1px dotted #009;" >
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



            </td></tr></table>
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
            <td colspan="5"><img src="includes/templates/template_default/images/secured_payment.jpg"></td>
          </tr>
        </table>
      </td>


    </tr>
    <tr> 
<form name="login" action="index.php?main_page=login&amp;action=process" method="post">
      <td width="28%" bgcolor="#ff9600" height="22" align="left"> 
<?php
   if (!$connected)
   {
      echo '    
       <table><tr><td width=12>&nbsp;</td>
                  <td align="left"> <input type="text" style= "background-color: #ffc366; "  size=20 name="email_address"></td>
                  <td width=20> &nbsp; </td>
              </tr>
       </table> ';
   }
   else
   {
      echo '&nbsp;&nbsp;&nbsp;';
   }
?>
      </td>
    </tr>
    <tr> 
      <td align=left width="28%" bgcolor="#ff9600" height="8">
<?php
   if (!$connected)
   {
      echo '    
        <img src="includes/templates/template_default/images/mot_de_passe.gif"> ';
   }
   else
   {
      if ( $_SESSION['cart']->count_contents()>0)
         if ($lg_code==2)
            echo '&nbsp;&nbsp;<font color=white>Votre panier contient '.$_SESSION['cart']->count_contents(). ' lampe(s)</font>'; 
         else if ($lg_code==3)
            echo '&nbsp;&nbsp;<font color=white>Su Cesta contiene '.$_SESSION['cart']->count_contents(). ' lámpara(s)</font>'; 
         else if ($lg_code==4)
            echo '&nbsp;&nbsp;<font color=white>Ihr Warenkorb enthält '.$_SESSION['cart']->count_contents(). ' Lampe(n)</font>'; 
      else
         echo '&nbsp;&nbsp;&nbsp; ';
   }
?>       
      </td>
    </tr>
    <tr> 
      <td align=left width="28%" bgcolor="#ff9600" height="8">
<?php
   if (!$connected)
   {
      echo '    
       <table><tr><td width=12>&nbsp;</td>
                  <td align="left"> <input  style= "background-color: #ffc366; "  type="password" name="password"  size=20></td>
                  <td width=20 valign=center><input type="image"  name="submit" src="includes/templates/template_default/images/login.gif"> </td>
              </tr>
       </table>   
           ';
   }
   else
   {
      echo '&nbsp;&nbsp;&nbsp;';
   }
?>
</form>
      </td>
    </tr>
    <tr> 
      <td height=18 bgcolor="#ff8900">
<?php
   if (!$connected)
   {
      echo '    
       <a href="index.php?main_page=login"><img src="includes/templates/template_default/images/devenir_client.gif" border="0"></a>
           ';
   }
   else
   {
      echo '&nbsp;&nbsp;&nbsp;';
   }
?>
      </td>
    </tr>
    <tr> 
      <td bgcolor="#ff8900"> 
        &nbsp;
      </td>
    </tr>

    <tr> 
      <?php      
//echo $body_id; 
      if ( ( $body_id=="index" ) && ! $model )
         echo '<td  width="28%" height="99%">';
      else
         echo '<td  width="28%" height="99%"  style="background-image:url(includes/templates/template_default/images/left_bg'. $file_extension .'.gif);"  >';

      if ($body_id=="page4")
      {
         echo ' <table>
                 <tr>
                   <td>
                     <img  VSPACE=10 HSPACE=1  src="includes/templates/template_default/images/lampecpt' . $lg_code . '.jpg" >
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <img  VSPACE=10 HSPACE=1  src="includes/templates/template_default/images/bubextrait' . $lg_code . '.jpg" >
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <img  VSPACE=10 HSPACE=1  src="includes/templates/template_default/images/bulbcpt'. $lg_code .'.jpg" >
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <img  VSPACE=5 HSPACE=5 height=220  width=80  src="includes/templates/template_default/images/empty.gif" >
                   </td>
                 </tr>
                </table>';

      }
      else
      {
         echo '  <img  VSPACE=5 HSPACE=5  src="includes/templates/template_default/images/why_el2.jpg" > ';

      }
 
if ( ($body_id=="login") ||  ($body_id=="checkoutconfirmation") ||  ($body_id=="conditions") 
       ||  ($body_id=="checkoutshipping") ||  ($body_id=="checkoutpayment") 
       || ($body_id=="contactus")  
       || ($body_id=="shippinginfo") || ($body_id=="accounthistoryinfo")  ) 
{
    if  ( ($body_id=="login") || ($body_id=="checkoutconfirmation")   )
    {
      $height=400;
    }
    else if  ( ($body_id=="page4")  )
    {
      $height=300;
    }
    else if  ( ($body_id=="conditions")  )
    {
      $height=5200;
    }
    else
    {
      $height=200;
    }

    echo '<br>
        <img  VSPACE=5 HSPACE=5  height='. $height .' width=80 src="includes/templates/template_default/images/empty.gif" >';
}
?>

      </td>
    </tr>
    <tr> 
      <td colspan="2" align=center  style="background:#a6a39d; margin: 0px;padding: 0px 0px 0px 0px;">
      <MAP NAME="map2">
      <AREA 
         HREF="index.php?main_page=conditions" ALT="Informations légales" TITLE="Informations légales" 
         SHAPE=RECT COORDS="0,0,200,30">
      </MAP>
      <img border=0 src="includes/templates/template_default/images/footer.jpg" usemap="#map2">
      </td>
    </tr>
  </table>

<?php
  if (SHOW_BANNERS_GROUP_SET4 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET4)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerFour" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>
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