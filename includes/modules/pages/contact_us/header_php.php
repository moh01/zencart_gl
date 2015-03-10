<?php
/**
 * Contact Us Page
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 3230 2006-03-20 23:21:29Z drbyte $
 */
require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

$error = false;
if (isset($_GET['action']) && ($_GET['action'] == 'send')) {
  $name = zen_db_prepare_input($_POST['contactname']);
  $email_address = zen_db_prepare_input($_POST['email']);
  $enquiry = zen_db_prepare_input(strip_tags($_POST['enquiry']));

  $zc_validate_email = zen_validate_email($email_address);
  
  $validation_ok = 1;
//echo   $_POST['contact_type'];exit;
  $contact_type = $_POST['contact_type'];
  if ( $contact_type =='RA' ) 
  {
     $enquiry = 'serial-number:       '.$_POST['serial-number']. "\n\n" .
			    'Constructeur:        '.$_POST['cstr']. "\n\n" .
			    'Modèle:              '.$_POST['model']. "\n\n" .
			    'Raison retour:       '.$_POST['raison_retour']. "\n\n" .
			    'Commentaire:         '.$_POST['cmm']. "\n\n" ;
//	echo $enquiry ;exit;

    if ( !empty($_POST['serial-number']) and !empty($_POST['model'])  and !empty($_POST['raison_retour']) and !empty($_POST['accept_condition'])   )
      $validation_ok = 1;
    else
	 {
      $validation_ok = 0;
      $messageStack->add('contact', RMA_INCOMPLETE_INPUT);	  
    }
  }
  else if ( $contact_type =='LNF' ) 
  {
     $enquiry = 'Phone number:       '.$_POST['telephone']. "\n\n" .
			       'Marque      :       '.$_POST['cstr']. "\n\n" .
			       'Modèle      :       '.$_POST['model']. "\n\n";
    if ( !empty($_POST['cstr']) and !empty($_POST['model'])  )
      $validation_ok = 1;
    else
	 {
      $validation_ok = 0;
      $messageStack->add('contact', RMA_INCOMPLETE_INPUT);	  
    }			       
  }
  else if ( $contact_type =='NC' ) 
  {
     $enquiry = 'Phone number:       '.$_POST['telephone']. "\n\n" .
			       'Marque      :       '.$_POST['cstr']. "\n\n" .
			       'Modèle      :       '.$_POST['model']. "\n\n" .
			       'Prix        :       '.$_POST['price']. "\n\n" ;
    if ( !empty($_POST['cstr']) and !empty($_POST['model'])  and !empty($_POST['price'])  )
      $validation_ok = 1;
    else
	 {
      $validation_ok = 0;
      $messageStack->add('contact', RMA_INCOMPLETE_INPUT);	  
    }			       
  }  
  else
  {
    $enquiry = $_POST['enquiry'];
    if ( !empty($enquiry) and !empty($name) )
      $validation_ok = 1;
	else
      $validation_ok = 0;	   
  }
  if ( $zc_validate_email &&  $validation_ok ) {
    // auto complete when logged in
    if($_SESSION['customer_id']) {
      $sql = "SELECT customers_id, customers_firstname, customers_lastname, customers_password, customers_email_address, customers_default_address_id 
              FROM " . TABLE_CUSTOMERS . " 
              WHERE customers_id = :customersID";
      
      $sql = $db->bindVars($sql, ':customersID', $_SESSION['customer_id'], 'integer');
      $check_customer = $db->Execute($sql);
      $customer_email= $check_customer->fields['customers_email_address'];
      $customer_name= $check_customer->fields['customers_firstname'] . ' ' . $check_customer->fields['customers_lastname'];
    } else {
      $customer_email='Not logged in';
      $customer_name='Not logged in';
    }

    // use contact us dropdown if defined
    if (CONTACT_US_LIST !=''){
      $send_to_array=explode("," ,CONTACT_US_LIST);
      preg_match('/\<[^>]+\>/', $send_to_array[$_POST['send_to']], $send_email_array);
      $send_to_email= eregi_replace (">", "", $send_email_array[0]);
      $send_to_email= eregi_replace ("<", "", $send_to_email);
      $send_to_name = preg_replace('/\<[^*]*/', '', $send_to_array[$_POST['send_to']]);
    } else {  //otherwise default to EMAIL_FROM and store name
    $send_to_email = EMAIL_FROM;
    $send_to_name =  STORE_NAME;
    }

    // Prepare extra-info details
    $extra_info = email_collect_extra_info($name, $email_address, $customer_name, $customer_email);
    // Prepare Text-only portion of message
    $text_message = OFFICE_FROM . "\t" . $name . "\n" .
    OFFICE_EMAIL . "\t" . $email_address . "\n\n" .
    '------------------------------------------------------' . "\n\n" .
    strip_tags($enquiry) .  "\n\n" .
    '------------------------------------------------------' . "\n\n" .
    $extra_info['TEXT'];
    // Prepare HTML-portion of message
    $html_msg['EMAIL_MESSAGE_HTML'] = $enquiry;
    $html_msg['CONTACT_US_OFFICE_FROM'] = OFFICE_FROM . ' ' . $name . '<br />' . OFFICE_EMAIL . '(' . $email_address . ')';
    $html_msg['EXTRA_INFO'] = $extra_info['HTML'];
    // Send message
    if ( $contact_type =='RA' ) 
	  $subject = RMA_TITRE_FORMULAIRE;
	else if ( $contact_type =='CMM' ) 
	  $subject = CMM_TITRE_FORMULAIRE;	
	else if ( $contact_type =='LNF' ) 
	  $subject = LNF_TITRE_FORMULAIRE;
	else if ( $contact_type =='NC' ) 
	  $subject = NC_TITRE_FORMULAIRE;
	else
	  $subject = EMAIL_SUBJECT;
	
    zen_mail($send_to_name, $send_to_email, $subject, $text_message, $name, $email_address, $html_msg,'contact_us');

    zen_redirect(zen_href_link(FILENAME_CONTACT_US, 'action=success'));
  } else {
    $error = true;
    if (empty($name)) {
      $messageStack->add('contact', ENTRY_EMAIL_NAME_CHECK_ERROR);
    }
    if ($zc_validate_email == false) {
      $messageStack->add('contact', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }
    if (empty($enquiry)) {
      $messageStack->add('contact', ENTRY_EMAIL_CONTENT_CHECK_ERROR);
    }
  }
} // end action==send


// default email and name if customer is logged in
if($_SESSION['customer_id']) {
  $sql = "SELECT customers_id, customers_firstname, customers_lastname, customers_password, customers_email_address, customers_default_address_id 
          FROM " . TABLE_CUSTOMERS . " 
          WHERE customers_id = :customersID";
  
  $sql = $db->bindVars($sql, ':customersID', $_SESSION['customer_id'], 'integer');
  $check_customer = $db->Execute($sql);
  $email= $check_customer->fields['customers_email_address'];
  $name= $check_customer->fields['customers_firstname'] . ' ' . $check_customer->fields['customers_lastname'];
}

if (CONTACT_US_LIST !=''){
  foreach(explode(",", CONTACT_US_LIST) as $k => $v) {
    $send_to_array[] = array('id' => $k, 'text' => preg_replace('/\<[^*]*/', '', $v));
  }
}
$define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_CONTACT_US, 'false');

// include template specific file name defines

$breadcrumb->add(NAVBAR_TITLE);
?>