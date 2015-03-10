<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=advanced_search_result.<br />
 * Displays results of advanced search
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_advanced_search_result_default.php 4182 2006-08-21 02:11:37Z ajeh $
 */
?>
<div class="centerColumn" id="advSearchResultsDefault">

<h1 id="advSearchResultsDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<?php
  if ($do_filter_list || PRODUCT_LIST_ALPHA_SORTER == 'true') {
//  $form = zen_draw_form('filter', zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT), 'get') . '<label class="inputLabel">' .TEXT_SHOW . '</label>';
  $form = zen_draw_form('filter', zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT), 'get');
?>
<?php echo $form; ?>
<?php
  echo zen_hide_session_id();

/* Re-Get all GET'ed variables */
      $hidden_get_variables = '';
      reset($_GET);
      while (list($key, $value) = each($_GET)) {
        if ( ($key != 'currency') && ($key != zen_session_name()) && ($key != 'x') && ($key != 'y') ) {
          $hidden_get_variables .= zen_draw_hidden_field($key, $value);
        }
      }
      echo $hidden_get_variables;

  require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_PRODUCT_LISTING_ALPHA_SORTER));
?>
</form>
<?php
  }
?>
<?php
# FV
  $keywords = $_GET['keyword'];
  $typ_module = $_GET['typ_module'];
  
//  echo $typ_module;
  include_once('el_admin/search_functions.php');
  
  if ( $_SESSION['customers_authorization'] == '0') 
     $customer = $_SESSION['customer_id'];
  
  if ( strlen ( $customer ) == 0 )
     $customer = 0;

	//  echo 	 $_SESSION['administrator'];
	 
  if ( $typ_module == "M" )
  {
     $PLO = 'true';
	 $PLC = 'true'; 
	 $POI = 'true';
	 $PBO = '';
	 $PBC = '';
  }
  else
  {
     $PLO = '';
	 $PLC = ''; 
	 $POI = '';
	 $PBO = 'true';
	 $PBC = 'true';
  }
  
  $html_output =  get_search_result(  0 , 0 , 'HRZ',   // $cstr_id,$excel,$format,
									  0,  $customer , //$plus, $customer,
									  0 , 0 , 0, //$price_list_id1 , $price_list_id2, $price_list_id3 ,
									  0 , 0 , 0, //$price_list_id4 , $price_list_id5, $price_list_id6 ,
									  $PLO , $PLC , $POI , // $PLO , $PLC , $POI ,
									  $PBO , $PBC , 0, //$PBO , $PBC , $vp_id,
									  '', $keywords , //$p_lamp_in_stock , $ref_includes 
									  1, $_SESSION['administrator'] == 1, $_SESSION['languages_id'] ); //            $appel_client_zencart = 0, $appel_admin = 0 
   echo $html_output;
		   
/**
 * Used to collate and display products from advanced search results
 */
 //require($template->get_template_dir('tpl_modules_product_listing.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_product_listing.php');

?>

<div class="buttonRow back"><?php echo '<a href="index.php?main_page=index">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div> 

</div>