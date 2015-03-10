<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=contact_us.<br />
 * Displays contact us page form.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_contact_us_default.php 4272 2006-08-26 03:10:49Z drbyte $
 */
?>
<div class="centerColumn" id="contactUsDefault">

<?php echo zen_draw_form('contact_us', zen_href_link(FILENAME_CONTACT_US, 'action=send')); ?>

<?php 
  // fv
  if (false) 
 {
   ?>
<address><?php echo nl2br(STORE_NAME_ADDRESS); ?></address>
<?php } ?>

<?php
  if (isset($_GET['action']) && ($_GET['action'] == 'success')) {
?>

<div class="mainContent success"><?php echo TEXT_SUCCESS; ?></div>

<div class="buttonRow"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>

<?php
  } else {
?>

<?php if (DEFINE_CONTACT_US_STATUS >= '1' and DEFINE_CONTACT_US_STATUS <= '2') { ?>
<div id="contactUsNoticeContent" class="content"  style="padding-left: 20px;">
<?php
/**
 * require html_define for the contact_us page
 */
  if ( strlen($_GET['contact_type'])>0 )
     $contact_type =  $_GET['contact_type'];
	 
  if ( $contact_type=='RA' )
  {
     require('includes/languages/' . $_SESSION['language'] . '/html_includes/classic/define_contact_us_ra.php');
  }
  else  if ( $contact_type=='CMM' )
  {
     require('includes/languages/' . $_SESSION['language'] . '/html_includes/classic/define_contact_us_cmm.php');
  }
  else  if ( $contact_type=='LNF' )
  {
     require('includes/languages/' . $_SESSION['language'] . '/html_includes/classic/define_contact_us_lnf.php');
  }
  else  if ( $contact_type=='NC' )
  {
     require('includes/languages/' . $_SESSION['language'] . '/html_includes/classic/define_contact_us_nc.php');
  }
  else
  {
    require($define_page);
  }
  
?>
</div>
<?php } ?>

<?php if ($messageStack->size('contact') > 0) echo $messageStack->output('contact'); ?>

<fieldset id="contactUsForm">
<legend>
<?php 
    
if ($contact_type=='RA')
{
	echo RMA_TITRE_FORMULAIRE;
}	
else if ($contact_type=='CMM')
{
	echo CMM_TITRE_FORMULAIRE;
}
else if ($contact_type=='LNF')
{
	echo LNF_TITRE_FORMULAIRE;
}
else if ($contact_type=='NC')
{
	echo NC_TITRE_FORMULAIRE;
}
else
{
	echo HEADING_TITLE;
}
 ?>
</legend>
<div class="alert forward"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
<br class="clearBoth" />

<?php
// show dropdown if set
    if (CONTACT_US_LIST !=''){
?>
<label class="inputLabel" for="send-to"><?php echo SEND_TO_TEXT; ?></label>
<?php echo zen_draw_pull_down_menu('send_to',  $send_to_array, 0, 'id="send-to"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?>
<br class="clearBoth" />
<?php
    }
?>

<label class="inputLabel" for="contactname"><?php echo ENTRY_NAME; ?></label>
<?php echo zen_draw_input_field('contactname', $name, ' size="40" id="contactname"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?>
<br class="clearBoth" />

<label class="inputLabel" for="email-address"><?php echo ENTRY_EMAIL; ?></label>
<?php echo zen_draw_input_field('email', ($error ? $_POST['email'] : $email), ' size="40" id="email-address"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?>
<br class="clearBoth" />
<?php

  if ( ( $contact_type=='NC' ) || ( $contact_type=='LNF' ) )
  {
     echo '<label class="inputLabel" for="telephone">'. NC_TELEPHONE . ' </label>';
     echo zen_draw_input_field('telephone', $_POST['telephone'], ' size="40" id="telephone"'); 
	 echo '<br class="clearBoth" />';

     echo '<label class="inputLabel" for="cstr">'. RMA_CONSTRUCTEUR . ' </label>';
     echo zen_draw_input_field('cstr', $_POST['cstr'], ' size="40" id="cstr"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; 
	 echo '<br class="clearBoth" />';

     echo '<label class="inputLabel" for="model">'. RMA_MODELE . ' </label>';
     echo zen_draw_input_field('model', $_POST['model'], ' size="40" id="model"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; 
	 echo '<br class="clearBoth" />';	 
  }  
  if  ( $contact_type=='NC' )  
  {
  
     echo '<label class="inputLabel" for="model">'. NC_PRIX . ' </label>';
     echo zen_draw_input_field('price', $_POST['price'], ' size="40" id="price"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; 
	 echo '<br class="clearBoth" />';	 
  }    
  
  if ( $contact_type=='RA' )
  {

     echo '<label class="inputLabel" for="serial-number">'. RMA_SERIAL_NUMBER . ' </label>';
     echo zen_draw_input_field('serial-number', $_POST['serial-number'], ' size="40" id="serial-number"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; 
	 echo '<br class="clearBoth" />';

     echo '<label class="inputLabel" for="cstr">'. RMA_CONSTRUCTEUR . ' </label>';
     echo zen_draw_input_field('cstr', $_POST['cstr'], ' size="40" id="cstr"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; 
	 echo '<br class="clearBoth" />';

     echo '<label class="inputLabel" for="model">'. RMA_MODELE . ' </label>';
     echo zen_draw_input_field('model', $_POST['model'], ' size="40" id="model"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; 
	 echo '<br class="clearBoth" />';	 
	 
     echo '<label class="inputLabel" for="raison_retour">'. RMA_RAISON_RETOUR . ' </label>';
	 echo '<select name="raison_retour">
	         <option value=""></option>
        	 <option value="CASSEE_TRANSIT">'. stripslashes(RMA_OPTION1) . '</option>
	         <option value="DEFECTUEUSE_SOUS_GARANTIE">'. stripslashes(RMA_OPTION2) . '</option>
			 <option value="LAMPE_NON_REQUISE">'. stripslashes(RMA_OPTION3) . '</option>
			 <option value="MAUVAISE_LAMPE">'. stripslashes(RMA_OPTION4) . '</option>
            </select>';
     echo  '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; 
	 echo '<br class="clearBoth" />';	 

     echo '<label class="inputLabel"  for="cmm">'. DESCRIPTION . '</label>';
     echo  zen_draw_input_field('cmm', $_POST['cmm'], ' size="60" id="cmm"'); 
	 echo '<br class="clearBoth" />';	 
	 
     echo '<label class="inputLabel" for="accept_condition">'. RMA_ACCEPT . ' </label>';
	 echo '<input type="checkbox" value="A" name="accept_condition"> '. RMA_ACCEPT_TEXT. '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; 
	 echo '<br class="clearBoth" />';	 
	 
   
	 }
	 else if ( (strlen($contact_type)==0) || $contact_type=="CMM" )
	 {
	    echo '<label for="enquiry">'. ENTRY_ENQUIRY . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span></label>';
	    echo  zen_draw_textarea_field('enquiry', 30, 7, '', 'id="enquiry"'); 	 
	 }
     echo ' <input type="hidden" name="contact_type" value="'. $contact_type . '">';
	 
?>


</fieldset>

<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_SEND_ALT); ?></div>
<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
<?php
  }
?>
</form>
</div>