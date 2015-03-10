<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=shopping_cart.<br />
 * Displays shopping-cart contents
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_shopping_cart_default.php 4140 2006-08-15 03:37:53Z drbyte $
 */
$lg_code = LG_CODE;
?>
<div class="centerColumn" id="shoppingCartDefault" style="background-color:#FFFFFF;">
<?php
  if ($flagHasCartContents) {
?>

<?php
  if ($_SESSION['cart']->count_contents() > 0) {
?>
<?php
  }
?>

<h1 id="cartDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<?php if ($messageStack->size('shopping_cart') > 0) echo $messageStack->output('shopping_cart'); ?>

<?php echo zen_draw_form('cart_quantity', zen_href_link(FILENAME_SHOPPING_CART, 'action=update_product')); ?>

<?php if (!empty($totalsDisplay)) { ?>
  <div class="cartTotalsDisplay important">
<?php 
  if ($lg_code==2)
     echo str_replace('Poids: 0kgs','',$totalsDisplay); 
  else if ($lg_code==4)
     echo str_replace('Gewicht:&nbsp;0kg','',$totalsDisplay);       
?>
  </div>
  <br class="clearBoth" />
<?php } ?>

<?php  if ($flagAnyOutOfStock) { ?>

<?php    if (STOCK_ALLOW_CHECKOUT == 'true') {  ?>

<div class="messageStackError"><?php echo OUT_OF_STOCK_CAN_CHECKOUT; ?></div>

<?php    } else { ?>
<div class="messageStackError"><?php echo OUT_OF_STOCK_CANT_CHECKOUT; ?></div>

<?php    } //endif STOCK_ALLOW_CHECKOUT ?>
<?php  } //endif flagAnyOutOfStock 

// fv impression devs
$html_devis = '<form name="frm" action="devis.php" target=_new method="post">';

?>

<table  border="0" width="100%" cellspacing="0" cellpadding="0" id="cartContentsDisplay">
     <tr class="tableHeading">
        <th scope="col" id="scQuantityHeading"><?php echo TABLE_HEADING_QUANTITY; ?></th>
        <th scope="col" id="scUpdateQuantity">&nbsp;</th>
        <th scope="col" id="scProductsHeading"><?php echo TABLE_HEADING_PRODUCTS; ?></th>
        <th scope="col" id="scUnitHeading"><?php echo TABLE_HEADING_PRICE; ?></th>
        <th scope="col" id="scTotalHeading"><?php echo TABLE_HEADING_TOTAL; ?></th>
        <th scope="col" id="scRemoveHeading">&nbsp;</th>
     </tr>
         <!-- Loop through all products /-->
<?php
  $nbr=0;
  foreach ($productArray as $product) {
  $nbr++;
?>
     <tr class="<?php echo $product['rowClass']; ?>">
       <td class="cartQuantity">
<?php
  if ($product['flagShowFixedQuantity']) {
    echo $product['showFixedQuantityAmount'] . '<br /><span class="alert bold">' . $product['flagStockCheck'] . '</span><br /><br />' . $product['showMinUnits'];
  } else {
    echo $product['quantityField'] . '<br /><span class="alert bold">' . $product['flagStockCheck'] . '</span><br /><br />' . $product['showMinUnits'];
  }
  $html_devis .= '<input type="hidden" name="qte'.$nbr.'"  value="'.$product['quantity'].'">';

?>
       </td>
       <td class="cartQuantityUpdate">
<?php
  if ($product['buttonUpdate'] == '') {
    echo '' ;
  } else {
      echo $product['buttonUpdate'];
  }
?>
       </td>
       <td class="cartProductDisplay" align="center">
      <?php  echo $product['productsName'].'<br>'.$product['productsDescription']  ?>
       </td>  
       <td class="cartUnitDisplay"><?php echo $product['productsPriceEach']; ?></td>
       <td class="cartTotalDisplay"><?php echo $product['productsPrice']; ?></td>
       <td class="cartRemoveItemDisplay">
<?php
  $html_devis .= '<input type="hidden" name="code'.$nbr.'"  value="'.$product['productsName'].'">';
  $html_devis .= '<input type="hidden" name="desc'.$nbr.'"  value="'.$product['productsDescription'].'">';
  $html_devis .= '<input type="hidden" name="prixht'.$nbr.'"  value="'.$product['productsPrice'].'">';
  $html_devis .= '<input type="hidden" name="prixttc'.$nbr.'"  value="'.$product['productsPrice'].'">';



  if ($product['buttonDelete']) {
?>
           <a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART, 'action=remove_product&product_id=' . $product['id']); ?>"><?php echo zen_image($template->get_template_dir(ICON_IMAGE_TRASH, DIR_WS_TEMPLATE, $current_page_base,'images/icons'). '/' . ICON_IMAGE_TRASH, ICON_TRASH_ALT); ?></a>
<?php
  }
/*
  if ($product['checkBoxDelete'] ) {
    echo zen_draw_checkbox_field('cart_delete[]', $product['id']);
  }
*/
?>
</td>
     </tr>
<?php
  } // end foreach ($productArray as $product)
?>
       <!-- Finished loop through all products /-->
      </table>

<div id="cartSubTotal"><?php echo SUB_TITLE_SUB_TOTAL; ?> <?php echo $cartShowTotal; ?></div>
<br class="clearBoth" />

<!--bof shopping cart buttons-->
<div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_CHECKOUT, BUTTON_CHECKOUT_ALT) . '</a>'; ?></div>
<div class="buttonRow back"><a href="index.php?main_page=index"> <?php echo  zen_image_button(BUTTON_IMAGE_CONTINUE_SHOPPING, BUTTON_CONTINUE_SHOPPING_ALT) . '</a>'; ?></div>
<?php
// show update cart button
  if (false) {
?>
<div class="buttonRow back"><?php echo zen_image_submit(ICON_IMAGE_UPDATE, ICON_UPDATE_ALT); ?></div>
<?php
  } else { // don't show update button below cart
?>
<?php
  } // show checkout button
?>

<!--eof shopping cart buttons-->
</form>

<br class="clearBoth" />
<?php
    // DISPLAY_PRICE_WITH_TAX
    // 73,75
    // zen_get_tax_rate( 1, $_SESSION['customer_country_id'] ) 
    
//    echo '<a href="test.php?'. zen_get_tax_rate( 1 ) .'" target=_new>test</a><br><br>';
   $sql = "select customers_default_address_id  from customers  where customers_id = ". $_SESSION['customer_id'];

   $addr = $db->Execute($sql);
   $addr_id = $addr->fields['customers_default_address_id'];
   
   $html_devis .= '<input type="hidden" name="addr_boutique"  value="'. STORE_NAME_ADDRESS .'">';   

  
     $html_devis .= '<input type="hidden" name="languages_id"  value="'. $_SESSION['languages_id'] .'">';   

     $html_devis .= '<input type="hidden" name="nb_lignes"  value="'. $nbr .'">';   
     $html_devis .= '<input type="hidden" name="addr_client"  value="'.zen_address_label($_SESSION['customer_id'], $addr_id, true, '', "|").'">';

     $html_devis .= '<a href="javascript:document.frm.submit()"> -- </a>';
     $html_devis .= '</form>';
   
     echo $html_devis;

       switch (true) {
      case (SHOW_SHIPPING_ESTIMATOR_BUTTON == '1'):
?>

<div class="buttonRow back"><?php echo '<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_SHIPPING_ESTIMATOR) . '\')">' .
 zen_image_button(BUTTON_IMAGE_SHIPPING_ESTIMATOR, BUTTON_SHIPPING_ESTIMATOR_ALT) . '</a>'; ?></div>

<?php
      break;
      case (SHOW_SHIPPING_ESTIMATOR_BUTTON == '2'):
/**
 * load the shipping estimator code if needed
 */
?>
      <?php require(DIR_WS_MODULES . zen_get_module_directory('shipping_estimator.php')); ?>

<?php
        break;
      }
?>
<?php
  } else {
?>

<h2 id="cartEmptyText"><?php echo TEXT_CART_EMPTY; ?></h2>


<?php
  }
?>

</div>