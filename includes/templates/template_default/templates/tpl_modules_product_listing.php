<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_product_listing.php 3241 2006-03-22 04:27:27Z ajeh $
 */
 include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_PRODUCT_LISTING));
require(   DIR_WS_INCLUDES. '/languages/' . $_SESSION['language'] . '/' . 'el_libelles.php');

$lg_code =  $_SESSION['languages_id'];

?>
<div id="productListing" style="background-color:#FFFFFF;" >
<?php
   $args = explode("_", $cPath );
   $model = $args[1];
   
   $sql = "select p.products_id from products p, products_description pd where pd.products_id = p.products_id and master_categories_id='" . $model . "'";

//   echo $sql;

 
   $check_category = $db->Execute( $sql );
   $lp_cnt = $check_category->RecordCount();
   $body_id = str_replace('_', '', $_GET['main_page']);

   if ( $body_id != "advancedsearchresult" )
   {
       echo "<table width=100% border=0><tr><td align=center>";
       echo '<h2 style="color:#7491b6">';
      if ( $lg_code == 5 )
	  {
		  if ( $lp_cnt == 1 )
	          echo 'For this projector, one option is proposed.<br><br>';
	       else
	          echo 'For this projector, '. $check_category->RecordCount(). ' options are proposed.<br>';
	  }	   
      else if ( $lg_code == 2 )
	  {
		  if ( $lp_cnt == 1 )
	          echo 'Pour ce videoprojecteur, une option vous est proposée.<br><br>';
	       else
	          echo 'Pour ce videoprojecteur, '. $check_category->RecordCount(). ' options vous sont proposées.<br>';
	  }
      else if ( $lg_code == 3 )
      {
         if ( $lp_cnt == 1 )
            echo 'Para este proyector, se les propone una opción.<br><br>';
         else if ( $lp_cnt == 2 )
            echo 'Para este proyector, se les proponen dos opciones..<br><br>';
         else if ( $lp_cnt == 3 )
            echo 'Para este proyector, se les proponen tres opciones..<br><br>';
         else 
            echo 'Para este proyector, se les proponen '. $check_category->RecordCount(). ' opciones..<br><br>';
      }	  
      else if ( $lg_code == 4 )
	  {		  
       if ( $lp_cnt == 1 )
       {
          echo 'Für diesen Projektor wird Ihnen eine Option angeboten.<br><br>';
       }
       else
       {
          echo 'Für diesen Projektor werden Ihnen '. $check_category->RecordCount(). ' Optionen angeboten.<br><br>';
       }
	 }
     echo "</h1>";
	 
	if ($_SESSION['customer_id']) {
		$customers_id = $_SESSION['customer_id'];
		$sql = "select  main_price_list_id from customers where  customers_id = " .$customers_id ;
		$customer_check = $db->Execute($sql);
		$_SESSION['main_price_list_id'] =  $customer_check->fields['main_price_list_id'];
	}
	 
     if (!$_SESSION['main_price_list_id']) 
     {
	     
	     echo  NOT_CONNECTED_HIDE .'<br>';
	 }
	 else
	 {
         echo  NOT_COMPITIVE_NOTICE .'<br>'; 
	 }
     echo  '<br>'; 	 
     echo "</td></tr></table>";
	 echo '<script language="javascript" type="text/javascript"><!--
			function popupWindow(url) {
			  window.open(url,\'popupWindow\',\'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=750,height=550,screenX=150,screenY=100,top=100,left=150\')
			}
			//--></script>
			';
   }


// only show when there is something to submit and enabled
    if ($show_top_submit_button == true) {
?>
<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_ADD_PRODUCTS_TO_CART, BUTTON_ADD_PRODUCTS_TO_CART_ALT, 'id="submit1" name="submit1"'); ?></div>
<br class="clearBoth" />
<?php
    } // show top submit
?>

<?php
/**
 * load the list_box_content template to display the products
 */
  require($template->get_template_dir('el_tpl_tabular_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/el_tpl_tabular_display.php');
  

?>


<?php
// only show when there is something to submit and enabled
    if ($show_bottom_submit_button == true) {
?>
<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_ADD_PRODUCTS_TO_CART, BUTTON_ADD_PRODUCTS_TO_CART_ALT, 'id="submit2" name="submit1"'); ?></div>
<br class="clearBoth" />
<?php
    } // show_bottom_submit_button
?>
</div>

<?php
// if ($show_top_submit_button == true or $show_bottom_submit_button == true or (PRODUCT_LISTING_MULTIPLE_ADD_TO_CART != 0 and $show_submit == true and $listing_split->number_of_rows > 0)) {
  if ($show_top_submit_button == true or $show_bottom_submit_button == true) {
?>
</form>
<?php } ?>
