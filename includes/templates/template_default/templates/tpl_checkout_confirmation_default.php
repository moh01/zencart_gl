<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_confirmation.<br />
 * Displays final checkout details, cart, payment and shipping info details.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_confirmation_default.php 4140 2006-08-15 03:37:53Z drbyte $
 */
 $lg_code = LG_CODE;
?>
<div class="centerColumn" id="checkoutConfirmDefault">

<h1 id="checkoutConfirmDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<?php if ($messageStack->size('redemptions') > 0) echo $messageStack->output('redemptions'); ?>
<?php if ($messageStack->size('checkout_confirmation') > 0) echo $messageStack->output('checkout_confirmation'); ?>
<?php if ($messageStack->size('checkout') > 0) echo $messageStack->output('checkout'); ?>

<div id="checkoutShipto" class="back">
<h2 id="checkoutConfirmDefaultBillingAddress"><?php echo HEADING_BILLING_ADDRESS; ?></h2>
<div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT) . '</a>'; ?></div>

<address><?php echo zen_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br />'); ?></address>
 
<?php
  $class =& $_SESSION['payment'];
?>

<h3 id="checkoutConfirmDefaultPayment"><?php echo HEADING_PAYMENT_METHOD; ?></h3>
<h4 id="checkoutConfirmDefaultPaymentTitle"><?php echo $GLOBALS[$class]->title; ?></h4>

<?php
  if (is_array($payment_modules->modules)) {
    if ($confirmation = $payment_modules->confirmation()) {
?>
<div class="important"><?php echo $confirmation['title']; ?></div>
<?php
    }
?>
<div class="important">
<?php
      for ($i=0, $n=sizeof($confirmation['fields']); $i<$n; $i++) {
?>
<div class="back"><?php echo $confirmation['fields'][$i]['title']; ?></div>
<div ><?php echo $confirmation['fields'][$i]['field']; ?></div>
<?php
     }
?>
      </div>
<?php
  }
?>

<br class="clearBoth" />
</div>

<?php
  if ($_SESSION['sendto'] != false) {
?>
<div id="checkoutBillto" class="forward">
<h2 id="checkoutConfirmDefaultBillingAddress"><?php echo HEADING_DELIVERY_ADDRESS; ?></h2>
<div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT) . '</a>'; ?></div>

<address><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />'); ?></address>

<?php
    if ($order->info['shipping_method']) {
?>
<h3 id="checkoutConfirmDefaultShipment"><?php echo HEADING_SHIPPING_METHOD; ?></h3>
<h4 id="checkoutConfirmDefaultShipmentTitle"><?php echo $order->info['shipping_method']; ?></h4>

<?php
    }
?>
</div>
<?php
  }
?>
<br class="clearBoth" />
<hr />
<?php
// always show comments
//  if ($order->info['comments']) {
?>

<h2 id="checkoutConfirmDefaultHeadingComments"><?php echo HEADING_ORDER_COMMENTS; ?></h2>

<div class="buttonRow forward"><?php echo  '<a href="' . zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT) . '</a>'; ?></div>

<div><?php echo (empty($order->info['comments']) ? NO_COMMENTS_TEXT : nl2br(zen_output_string_protected($order->info['comments'])) . zen_draw_hidden_field('comments', $order->info['comments'])); ?></div>
<br class="clearBoth" />
<?php
//  }
?>
<hr />

<h2 id="checkoutConfirmDefaultHeadingCart"><?php echo HEADING_PRODUCTS; ?></h2>

<div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_SHOPPING_CART, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT) . '</a>'; ?></div>
<br class="clearBoth" />

<?php  if ($flagAnyOutOfStock) { ?>
<?php    if (STOCK_ALLOW_CHECKOUT == 'true') {  ?>
<div class="messageStackError"><?php echo OUT_OF_STOCK_CAN_CHECKOUT; ?></div>
<?php    } else { ?>
<div class="messageStackError"><?php echo OUT_OF_STOCK_CANT_CHECKOUT; ?></div>
<?php    } //endif STOCK_ALLOW_CHECKOUT ?>
<?php  } //endif flagAnyOutOfStock ?>


      <table border="0" width="100%" cellspacing="0" cellpadding="0" id="cartContentsDisplay">
        <tr class="cartTableHeading">
        <th scope="col" id="ccQuantityHeading" width="30"><?php echo TABLE_HEADING_QUANTITY; ?></th>
        <th scope="col" id="ccProductsHeading"><?php echo TABLE_HEADING_PRODUCTS; ?></th>
<?php
  // If there are tax groups, display the tax columns for price breakdown
  if (sizeof($order->info['tax_groups']) > 1) {
?>
          <th scope="col" id="ccTaxHeading"><?php echo HEADING_TAX; ?></th>
<?php
  }
?>
          <th scope="col" id="ccTotalHeading"><?php echo TABLE_HEADING_TOTAL; ?></th>
        </tr>
                
<?php // now loop thru all products to display quantity and price ?>
<?php


    // fv raclette 
    $raclette_html .= $order->info['shipping_method']. '<br><br>';
    $raclette_html .= '<br>Livraison<br>'. zen_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />').'<br><br>';
    $raclette_html .= '<br>Facturation<br>'. zen_address_format($order->billing["format_id"], $order->billing, 1, " ", "<br />").'<br><br>';

     for ($i=0, $n=sizeof($order->products); $i<$n; $i++) { ?>
        <tr class="<?php echo $order->products[$i]['rowClass']; ?>">
          <td  class="cartQuantity"><?php echo $order->products[$i]['qty']; ?>&nbsp;x</td>
          <td class="cartProductDisplay" align="center">
          <?php
		     // fv
             echo $order->products[$i]['name'].'-';
			 
			  $sql = "select m.manufacturers_name,
							 cd.categories_name,
							 cstr.categories_name as constructeur
					  from products p,
						   categories_description cd,
						   categories cat,
						   manufacturers m, 
        				   categories_description as cstr
					  where m.manufacturers_id = p.manufacturers_id
					   AND cat.categories_id = cd.categories_id
					   AND cstr.categories_id = cat.parent_id			   
					  and   cd.categories_id = p.master_categories_id 
					  and   p.products_id=" . $order->products[$i]['id'];
			  $new_product_query = $db->Execute( $sql );
			  
			  include_once ('el_admin/el_functions.php');
//echo $_SESSION['languages_id'];exit;
			  $prdd = get_product_desc (  $new_product_query->fields['manufacturers_name'],
										  $new_product_query->fields['categories_name'],
										  (int)$_SESSION['languages_id'],
                                          $new_product_query->fields['constructeur'] 	  );
								  
              echo $prdd;
              $raclette_html .= '<br>Produit<br>'. $order->products[$i]['qty'] . '   ' .  $prdd ;
          ?>
          <?php  echo $stock_check[$i]; ?>

<?php // if there are attributes, loop thru them and display one per line
    if (isset($order->products[$i]['attributes']) && sizeof($order->products[$i]['attributes']) > 0 ) {
    echo '<ul class="cartAttribsList">';
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
?>
      <li><?php echo $order->products[$i]['attributes'][$j]['option'] . ': ' . nl2br($order->products[$i]['attributes'][$j]['value']); ?></li>
<?php
      } // end loop
      echo '</ul>';
    } // endif attribute-info
?>
        </td>

<?php // display tax info if exists ?>
<?php if (sizeof($order->info['tax_groups']) > 1)  { ?>
        <td class="cartTotalDisplay">
          <?php echo zen_display_tax_value($order->products[$i]['tax']); ?>%</td>
<?php    }  // endif tax info display  ?>
        <td class="cartTotalDisplay">
          <?php echo $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']);
          if ($order->products[$i]['onetime_charges'] != 0 ) echo '<br /> ' . $currencies->display_price($order->products[$i]['onetime_charges'], $order->products[$i]['tax'], 1);
?>
        </td>
      </tr>
<?php  }  // end for loopthru all products ?>
      </table>
      <hr />

<?php
  if (MODULE_ORDER_TOTAL_INSTALLED) {
    $order_totals = $order_total_modules->process();
?>
<div id="orderTotals"><?php $order_total_modules->output(); ?></div>
<?php
  }
?>

<?php
  echo zen_draw_form('checkout_confirmation', $form_action_url, 'post', 'id="checkout_confirmation" onsubmit="submitonce();"');

  if (is_array($payment_modules->modules)) {
    echo $payment_modules->process_button();
  }
?>
<?php
 // fv --
 if ( $_SESSION['languages_id'] == 3 )
   $lg_abb = "sp";
 else if ( $_SESSION['languages_id'] == 4 )
   $lg_abb = "de";
 else if ( $_SESSION['languages_id'] == 5 )
   $lg_abb = "en";


//echo $_SESSION['raclette'];
 
 if ( !$_SESSION['raclette'] && 
     ( (  ($GLOBALS[$class]->title=="Carte de Crédit") )
      || (  ($GLOBALS[$class]->title=="Kreditkarte") )
      || (  ($GLOBALS[$class]->title=="Credit Card") )      
      || (  ($GLOBALS[$class]->title=="Tarjeta de Crédito") )	  
     )
	)
 {

     /// FV raclettes
    $dml = "delete from el_raclette
            where customers_id = ". $_SESSION['customer_id'] ;
            
    $db->Execute( $dml );
    $raclette_html =  str_replace ( "'" , '' ,  $raclette_html );
    
    $dml = "insert into el_raclette ( customers_id , confirmation_time , order_content  )
            values ( ". $_SESSION['customer_id'] . ", now() , '" .  $raclette_html  . "' ) ";
            
    $db->Execute( $dml );

       // echo '<div class="buttonRow back">' . TITLE_CONTINUE_CHECKOUT_PROCEDURE . '<br />' . TEXT_CONTINUE_CHECKOUT_PROCEDURE . '></div>');
//       $parm="merchant_id=038862749811111";  // Cyberplus   DEMO
//       $parm="merchant_id=014102450311111";  // ElysNet     DEMO
       $parm="merchant_id=048970251400023";  // ElysNet     EasyLamps PRODUCTION
      $parm="$parm merchant_country=fr";
      $new_total = $order->info['total']*100;
//      $new_total = 1000;
      $parm="$parm amount=".$new_total;

      $parm="$parm currency_code=978";


      // Initialisation du chemin du fichier pathfile (à modifier)
          //   ex :
          //    -> Windows : $parm="$parm pathfile=c:\\repertoire\\pathfile";
          //    -> Unix    : $parm="$parm pathfile=/home/repertoire/pathfile";

        // Cette variable est facultative. Si elle n'est pas renseignée,
        // l'API positionne la valeur à "./pathfile".

      // $parm="$parm pathfile=chemin_du_fichier_pathfile";
      // $parm="$parm pathfile=./cyberplus/param/pathfile";
      $parm="$parm pathfile=./elysnet/param/pathfile";

      //    Si aucun transaction_id n'est affecté, request en génère
      //    un automatiquement à partir de heure/minutes/secondes
      //    Référez vous au Guide du Programmeur pour
      //    les réserves émises sur cette fonctionnalité
      //
      //    $parm="$parm transaction_id=123456";



      //    Affectation dynamique des autres paramètres
      //       Les valeurs proposées ne sont que des exemples
      //       Les champs et leur utilisation sont expliqués dans le Dictionnaire des données
      //
      //       $parm="$parm normal_return_url=http://www.maboutique.fr/cgi-bin/call_response.php";
      //    $parm="$parm cancel_return_url=http://www.maboutique.fr/cgi-bin/call_response.php";
      //    $parm="$parm automatic_response_url=http://www.maboutique.fr/cgi-bin/call_autoresponse.php";
      //    $parm="$parm language=fr";
      //    $parm="$parm payment_means=CB,2,VISA,2,MASTERCARD,2";
      //    $parm="$parm header_flag=no";

          $parm="$parm language=".$lg_abb;
          $parm="$parm payment_means=VISA,2,MASTERCARD,2";

          $parm="$parm capture_day=5";
          $parm="$parm capture_mode=VALIDATION";
      //    $parm="$parm bgcolor=";
      //    $parm="$parm block_align=";
      //    $parm="$parm block_order=";
      //    $parm="$parm textcolor=";
      //  
	  //
	 require(   DIR_WS_INCLUDES. '/languages/' . $_SESSION['language'] . '/' . 'el_libelles.php');

//      if ( $lg_code==4 )
//          $parm="$parm receipt_complement='<font size=5 color=#ff6900><b>Bitte gehen Sie auf Alleprojektorlampen.com zurück, dies wird Ihre Bestellung in unseren Systemen validieren...</b></font>'";
//      else
      $parm="$parm receipt_complement='<font size=5 color=#ff6900><b>" . RETOUR_BOUTIQUE . "</b></font>'";

      $parm="$parm caddie=";
      $cid = $_SESSION['customer_id'];
      $parm="$parm customer_id=$cid";
      $parm="$parm customer_email=test@email.com";
      //    $parm="$parm customer_ip_address=";
      //      $parm="$parm data=NO_RESPONSE_PAGE";
      //    $parm="$parm return_context=";
      //    $parm="$parm target=";
          $parm="$parm order_id=";


      //    Les valeurs suivantes ne sont utilisables qu'en pré-production
      //    Elles nécessitent l'installation de vos fichiers sur le serveur de paiement
      //
      //       $parm="$parm normal_return_logo=";
      //       $parm="$parm cancel_return_logo=";
      //       $parm="$parm submit_logo=";
      //       $parm="$parm logo_id=logo_lampevideoprojecteur.jpg";
      //       temporaire
           $parm="$parm logo_id=lampe.jpg";

      //       $parm="$parm logo_id2=";
      //       $parm="$parm advert=logo_elysnet.gif";
      //       $parm="$parm background_id=";
      //       $parm="$parm templatefile=";


      //    insertion de la commande en base de données (optionnel)
      //    A développer en fonction de votre système d'information

      // Initialisation du chemin de l'executable request (à modifier)
      // ex :
      // -> Windows : $path_bin = "c:\\repertoire\\bin\\request";
      // -> Unix    : $path_bin = "/home/repertoire/bin/request";
      //

      // $path_bin = "chemin_du_fichier_request";
      // $path_bin = "C:\\Sites\\zenCart\\cgi-bin\\request";
      $path_bin = "./elysnet/bin/request";


      // Appel du binaire request

      $result=exec("$path_bin $parm");

      // sortie de la fonction : $result=!code!error!buffer!
      //     - code=0   : la fonction génère une page html contenue dans la variable buffer
      //     - code=-1  : La fonction retourne un message d'erreur dans la variable error

      //On separe les differents champs et on les met dans une variable tableau

      $tableau = explode ("!", "$result");

      // récupération des paramètres

      $code = $tableau[1];
      $error = $tableau[2];
      $message = $tableau[3];

      //  analyse du code retour

      if (( $code == "" ) && ( $error == "" ) )
      {
         print ("<BR><CENTER>erreur appel request</CENTER><BR>");
         print ("executable request non trouve $path_bin");
      }

      // Erreur, affiche le message d'erreur

      else if ($code != 0){
         print ("<center><b><h2>Erreur appel API de paiement.</h2></center></b>");
         print ("<br><br><br>");
         print (" message erreur : $error <br>");
      }

      // OK, affiche le formulaire HTML
      else {
        echo '</form>';
        if ($_SESSION['languages_id']==2)
        {
           $select_text = ' Pour procéder au paiement,
                    <br>sélectionner l\'icône correspondant
                    <br> à la carte de crédit utilisée.';
        }
        else if ($_SESSION['languages_id']==3)
        {
           $select_text = ' Para proceder al pago,
                    <br>seleccione el icono correspondiente
                    <br> a la tarjeta de crédito utilizada.';
        }
        else if ($_SESSION['languages_id']==4)
        {
           $select_text = ' Um die Bezahlung vorzunehmen, 
                    <br>klicken Sie bitte auf das Bild 
                    <br>das Ihrer Kredit Karte entspricht.';
        }
        else if ($_SESSION['languages_id']==5)
        {
           $select_text = ' To process to payment, 
                    <br>click on the picture showing
                    <br>your credit card.';
        }

        echo '<table bgcolor=#FF6900 width=100%>
                <tr>
                <td align="center" valign="center">
                   ' .  $select_text  . '
                </td>
                <td align="right" valign="center">
                '. $message .'
                </td>
              </table>';

/*
        echo '</form>';
        echo '<div class="buttonRow forward">';
        echo $message;
        echo '</div>';
        echo '<div class="buttonRow back">Pour procéder au paiement,
              <br>sélectionner l\'icône correspondant
              <br> à la carte de crédit utilisée. </div>';
*/

      }
 }
 else
 {
   ?>

<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_CONFIRM_ORDER, BUTTON_CONFIRM_ORDER_ALT, 'name="btn_submit" id="btn_submit"') ;?></div>
</form>
<div class="buttonRow back"><?php echo TITLE_CONTINUE_CHECKOUT_PROCEDURE . '<br />' . TEXT_CONTINUE_CHECKOUT_PROCEDURE; ?></div>

   <?php
 }
?>

</div>
