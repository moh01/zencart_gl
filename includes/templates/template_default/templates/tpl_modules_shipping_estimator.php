<?php
/**
 * Module Template - for shipping-estimator display
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_shipping_estimator.php 4313 2006-08-28 00:25:40Z drbyte $
 */
$lg_code = LG_CODE;
?>

<?php echo zen_draw_form('estimator', zen_href_link($show_in, '', 'NONSSL'), 'post'); ?>
<?php echo zen_draw_hidden_field('scid', $selected_shipping['id']); ?>
    <?php
  if(sizeof($quotes)) {
    if ($_SESSION['customer_id']) {
?>
<h2><?php echo CART_SHIPPING_OPTIONS; ?></h2>


<?php
    // only display addresses if more than 1
      if ($addresses->RecordCount() > 1){
?>
<label class="inputLabel"><?php echo CART_SHIPPING_METHOD_ADDRESS; ?></label>
<?php echo zen_draw_pull_down_menu('address_id', $addresses_array, $selected_address, 'onchange="return shipincart_submit(\'\');"'); ?>
<?php
      }
?>

<div class="bold back"><?php echo CART_SHIPPING_METHOD_TO; ?></div>
<address class="back"><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />'); ?></address>
<br class="clearBoth" />
<?php
    } else {
?>
<h2><?php echo CART_SHIPPING_OPTIONS; ?></h2>
<p>Les frais de livraison s'appliquent, quelque-soit le nombre de lampes commandées, pour une distribution en France métropolitaire.</p><p> Pour une estimation des frais pour une livraison en dehors de la France métropolitaine, veuillez contacter notre service commercial.</p>
<?php
    }
    if($_SESSION['cart']->get_content_type() == 'virtual'){
?>
<?php echo CART_SHIPPING_METHOD_FREE_TEXT .  ' ' . CART_SHIPPING_METHOD_ALL_DOWNLOADS; ?>
<?php
    }elseif ($free_shipping==1) {
?>
<?php echo sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)); ?>
<?php
    }else{
?>
<table width="100%" border="1" cellpadding="2" cellspacing ="2">
     <tr>
       <th scope="col" id="seProductsHeading"><?php echo CART_SHIPPING_METHOD_TEXT; ?></th>
       <th scope="col" id="seTotalHeading"><?php echo CART_SHIPPING_METHOD_RATES; ?></th>
     </tr>
<?php
      for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {
        if(sizeof($quotes[$i]['methods'])==1){
          // simple shipping method
          $thisquoteid = $quotes[$i]['id'].'_'.$quotes[$i]['methods'][0]['id'];
?>
     <tr class="<?php echo $extra; ?>">
<?php
          if($quotes[$i]['error']){
?>
         <td colspan="2"><?php echo $quotes[$i]['module']; ?>&nbsp;(<?php echo $quotes[$i]['error']; ?>)</td>
       </tr>
<?php
          }else{
            if($selected_shipping['id'] == $thisquoteid){
?>
         <td class="bold"><?php echo $quotes[$i]['module']; ?>&nbsp;(<?php echo $quotes[$i]['methods'][0]['title']; ?>)</td>
         <td class="cartTotalDisplay bold"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][0]['cost'], $quotes[$i]['tax'])); ?></td>
       </tr>
<?php
            }else{
?>
          <td><?php echo $quotes[$i]['module']; ?>&nbsp;(<?php echo $quotes[$i]['methods'][0]['title']; ?>)</td>
          <td class="cartTotalDisplay"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][0]['cost'], $quotes[$i]['tax'])); ?></td>
       </tr>
<?php
            }
          }
        } else {
          // shipping method with sub methods (multipickup)
          for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
            $thisquoteid = $quotes[$i]['id'].'_'.$quotes[$i]['methods'][$j]['id'];
?>
    <tr class="<?php echo $extra; ?>">
<?php
            if($quotes[$i]['error']){
?>
         <td colspan="2"><?php echo $quotes[$i]['module']; ?>&nbsp;(<?php echo $quotes[$i]['error']; ?>)</td>
       </tr>
<?php
            }else{
              if($selected_shipping['id'] == $thisquoteid){
?>
         <td class="bold"><?php echo $quotes[$i]['module']; ?>&nbsp;(<?php echo $quotes[$i]['methods'][$j]['title']; ?>)</td>
         <td class="cartTotalDisplay bold"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])); ?></td>
       </tr>
<?php
              }else{
?>
        <td><?php echo $quotes[$i]['module']; ?>&nbsp;(<?php echo $quotes[$i]['methods'][$j]['title']; ?>)</td>
        <td class="cartTotalDisplay"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])); ?></td>
      </tr>
<?php
              }
            }
          }
        }
      }
?>
</table>
<?php
   }
  }
?>
</form>