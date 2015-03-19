<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION:   A collection of functions            //
//  utilized throughout the Super Orders files.  Handy  //
//  for developers, normal users won't need to even     //
//  look in here.  See each funtion for a brief         //
//  description.                                        //
//////////////////////////////////////////////////////////
// $Id: super_orders_functions.php 37 2006-08-18 16:09:34Z BlindSide $
*/


/////////////////
// Function    : zen_get_payment_type_name
// Arguments   : payment code, language_id
// Return      : payment type full name
// Description : Translate a payment type code into the full name (eg. "MC" -> "Master Card")
//               This function mimics the full_type() function of the super_order class
/////////////////
function zen_get_payment_type_name($payment_type_code, $language_id = '') {
  global $db;

  if (!$language_id) $language_id = $_SESSION['languages_id'];
  $payment_type = $db->Execute("select payment_type_full from " . TABLE_SO_PAYMENT_TYPES . "
                                where payment_type_code like '" . $payment_type_code . "'
                                and language_id = '" . (int)$language_id . "' limit 1");

  return $payment_type->fields['payment_type_full'];
}


/////////////////
// Function    : zen_get_payment_types
// Arguments   : none
// Return      : array or payment types
// Description : Builds array of payment types, following the format for a Zen dropdown
/////////////////
function zen_get_payment_types() {
  global $db;

  $payment_type_array = array();
  $payment_type = $db->Execute("select * from " . TABLE_SO_PAYMENT_TYPES . "
                                where language_id = '" . $_SESSION['languages_id'] . "'
                                order by payment_type_full desc");

  while (!$payment_type->EOF) {
    $payment_type_array[] = array('id' => $payment_type->fields['payment_type_code'],
                                  'text' => $payment_type->fields['payment_type_full']);
    $payment_type->MoveNext();
  }

  return $payment_type_array;
}


/////////////////
// Function    : so_close_status
// Arguments   : orders_id
// Return      : array or false
// Description : builds 2-value array: cancel/complete status and the timestamp
//               Used when checking order status without using super_order class
/////////////////
function so_close_status($oID) {
  global $db;
  $oID = (int)$oID;
  $status = $db->Execute("SELECT date_cancelled, date_completed FROM " . TABLE_ORDERS . "
                          WHERE orders_id = " . $oID . "
                          AND (date_cancelled IS NOT NULL OR date_completed IS NOT NULL)");
  if ($status->RecordCount() == 0) {
    return false;
  }
  else {
    $close_status = array();
    if (zen_not_null($status->fields['date_cancelled'])) {
      $close_status['type'] = 'cancelled';
      $close_status['date'] = $status->fields['date_cancelled'];
    }
    elseif (zen_not_null($status->fields['date_completed'])) {
      $close_status['type'] = 'completed';
      $close_status['date'] = $status->fields['date_completed'];
    }
    else {
      $close_status['type'] = false;
      $close_status['date'] = false;
    }

    return $close_status;
  }
}


/////////////////
// Function    : get_admin_notes
// Arguments   : customers_id
// Return      : notes array or false
// Description : builds array of existing private notes about the customer, or returns false if none
/////////////////
function get_admin_notes($cID) {
  global $db;
  $admin_notes = array();

  $notes_query = $db->Execute("select * from " . TABLE_CUSTOMERS_ADMIN_NOTES . " where customers_id = '" . $cID . "'");
  if ($notes_query->RecordCount() > 0) {
    while (!$notes_query->EOF) {
      //gather info about the admin author
      $admin_data = $db->Execute("select admin_name, admin_email from " . TABLE_ADMIN . " where admin_id = '" . $notes_query->fields['admin_id'] . "'");

      $admin_notes[] = array('date' => $notes_query->fields['date_added'],
                             'name' => $admin_data->fields['admin_name'],
                             'email' => $admin_data->fields['admin_email'],
                             'notes' => $notes_query->fields['notes'],
                             'karma' => $notes_query->fields['karma']);
      $notes_query->MoveNext();
    }
    return $admin_notes;
  }
  else {
    return false;
  }
}


/////////////////
// Function    : zen_db_scrub_in
// Arguments   : string
// Return      : scrubbed string
// Description : An all-purpose string scrubber to prep data for DB input.
//               Strips whitespace, formats for HTML viewing (tags are untouched), and prevents SQL injections
/////////////////
function zen_db_scrub_in($string, $strip_tags = false) {
  if ( $string == '""' || $string == "''" || strcasecmp($string, 'null') == 0 || strcasecmp($string, 'now()') == 0 ) {
    return $string;
  }
  elseif (is_string($string)) {
    $string = trim(stripslashes($string));
    $string = nl2br($string);
    if ($strip_tags) {
      $string = strip_tags($string);
    }
    //$string = mysql_real_escape_string($string);
    $string = mysql_escape_string($string);
    return $string;
  }
  elseif (is_array($string)) {
    reset($string);
    while (list($key, $value) = each($string)) {
      if (!is_numeric($value)) $string[$key] = zen_db_scrub_in($value);
    }
    return $string;
  }
  else {
    return $string;
  }
}


/////////////////
// Function    : zen_db_scrub_out
// Arguments   : string
// Return      : unscrubbed string
// Description : used to remove slashes before displaying the string
/////////////////
function zen_db_scrub_out($string, $strip_tags = false) {
  if ($strip_tags) {
    $string = strip_tags($string);
  }
  return stripslashes($string);
}


/////////////////
// Function    : all_products_array
// Arguments   : none
// Return      : products array
// Description : builds an array of all products (all languages, enabled or disabled) for a dropdown for searches
/////////////////
function all_products_array($first_option = false, $show_price = false, $show_model = false, $show_id = false) {
  global $db, $currencies;
  if (!isset($currencies)) {
    require(DIR_WS_CLASSES . 'currencies.php');
    $currencies = new currencies();
  }
  $products_array = array();
  if ($first_option) {
    $products_array[] = array('id' => '',
                              'text' => $first_option);
  }
  $products = $db->Execute("select products_id, products_name from " . TABLE_PRODUCTS_DESCRIPTION . " order by products_name asc");
  while (!$products->EOF) {
    $display_price = zen_get_products_base_price($products->fields['products_id']);
    $products_array[] = array('id' => $products->fields['products_id'],
                              'text' => $products->fields['products_name'] .
                                        ($show_price ? ' (' . $currencies->format($display_price) . ')' : '') .
                                        ($show_model ? ' [' . $products->fields['products_model'] . ']' : '') .
                                        ($show_id ? ' [' . $products->fields['products_id'] . ']' : '') );
    $products->MoveNext();
  }
  return $products_array;
}


/////////////////
// Function    : all_payments_array
// Arguments   : none
// Return      : payments array
// Description : builds an array of each payment method attached to an order
/////////////////
function all_payments_array($first_option = false, $show_code = false) {
  global $db;
  $payments_array = array();
  if ($first_option) {
    $payments_array[] = array('id' => '',
                              'text' => $first_option);
  }

  $payments = $db->Execute("select distinct payment_method, payment_module_code from " . TABLE_ORDERS);
  while (!$payments->EOF) {
    $payments_array[] = array('id' => $payments->fields['payment_module_code'],
                              'text' => $payments->fields['payment_method'] .
                                        ($show_code ? ' [' . $payments->fields['payment_module_code'] . ']' : '') );
    $payments->MoveNext();
  }
  return $payments_array;
}


/////////////////
// Function    : all_customers_array
// Arguments   : none
// Return      : customers array
// Description : builds an array of *all* customers for a dropdown menu.
//               WARNING: Should not be used for e-mails, as it ignores newsletter preferences!
/////////////////
function all_customers_array($first_option = false, $show_email = false, $show_id = false) {
  global $db;
  $customers_array = array();
  if ($first_option) {
    $customers_array[] = array('id' => '',
                               'text' => $first_option);
  }
  $customers_sql = "select distinct customers_id, customers_email_address,
                    customers_firstname, customers_lastname
                    from " . TABLE_CUSTOMERS . "
                    order by customers_lastname, customers_firstname, customers_email_address";
  $customers = $db->Execute($customers_sql);
  while (!$customers->EOF) {
    $customers_array[] = array('id' => $customers->fields['customers_id'],
                               'text' => $customers->fields['customers_lastname'] . ', ' . $customers->fields['customers_firstname'] .
                               ($show_email ? ' (' . $customers->fields['customers_email_address'] . ')' : '') .
                               ($show_id ? ' [' . $customers->fields['customers_id'] . ']' : '') );
    $customers->MoveNext();
  }
  return $customers_array;
}


/////////////////
// Function    : zen_datetime_long
// Arguments   : a raw date
// Return      : formatted date & time
// Description : Outputs a fully expressed date string
/////////////////
function zen_datetime_long($raw_date = 'now') {
  if ( ($raw_date == '0001-01-01 00:00:00') || ($raw_date == '') ) return false;
  elseif ($raw_date == 'now') {
    $raw_date = date('Y-m-d H:i:s');
  }

  $year = (int)substr($raw_date, 0, 4);
  $month = (int)substr($raw_date, 5, 2);
  $day = (int)substr($raw_date, 8, 2);
  $hour = (int)substr($raw_date, 11, 2);
  $minute = (int)substr($raw_date, 14, 2);
  $second = (int)substr($raw_date, 17, 2);

  return strftime('%b %d, %Y %r', mktime($hour, $minute, $second, $month, $day, $year));
}


/////////////////
// Function    : zen_db_delete
// Arguments   : Zen DB table, SQL "where" parameters
// Return      : mysql_affected_rows()
// Description : Deletes a row or rows from the specified $table based on the $parameters
/////////////////
function zen_db_delete($table, $parameters) {
  global $db;

  $db->Execute('delete from ' . $table . ' where ' . $parameters);

  return mysql_affected_rows();
}


/////////////////
// Function    : recalc_total
// Arguments   : target order
// Return      : none
// Description : Reprocesses totals stored in the orders_total table for the given order.
/////////////////
function recalc_total($target_oID) {
  global $db;
  global $currencies;
  global $order;

  $ot_subtotal = 0;
  $ot_tax = 0;
  $ot_total = 0;

  $products = $db->Execute("SELECT * FROM " . TABLE_ORDERS_PRODUCTS . "
                            WHERE orders_id = '" . $target_oID . "'");

   							 
  // recalculate subtotal and tax from products in order
  while (!$products->EOF) {
    $this_subtotal = 0;
    $this_tax = 0;

    $this_subtotal = ($products->fields['final_price'] * $products->fields['products_quantity']);
    $ot_subtotal += $this_subtotal;

    // not everyone charges tax, so we check to see if it exists first
    if ($products->fields['products_tax'] > 0) {
      $this_tax = $this_subtotal * ($products->fields['products_tax'] / 100);
      $ot_tax += $this_tax;
    }

    $products->MoveNext();
  }
  // $currencies->format($order->products[$i]['attributes'][$j]['price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ')';
  $format_sub = $currencies->format($ot_subtotal, true, $order->info['currency'], $order->info['currency_value']) ;
  $format_tax = $currencies->format($ot_tax, true, $order->info['currency'], $order->info['currency_value']) ;
  
  // apply new subtotal and tax values to the record
  $db->Execute("UPDATE " . TABLE_ORDERS_TOTAL . " SET
                text = '" . $format_sub . "',
                value = '" . $ot_subtotal . "'
                WHERE orders_id = '" . $target_oID . "'
                AND class = 'ot_subtotal'");

  if ($ot_tax > 0) {
    $db->Execute("UPDATE " . TABLE_ORDERS_TOTAL . " SET
                  text = '" . $format_tax  . "',
                  value = '" . $ot_tax . "'
                  WHERE orders_id = '" . $target_oID . "'
                  AND class = 'ot_tax'");
  }

  // add up all the records for the roder ('cept ot_total of course)
  $all_totals = $db->Execute("SELECT * FROM " . TABLE_ORDERS_TOTAL . "
                              WHERE orders_id = '" . $target_oID . "'
                              ORDER BY sort_order ASC");

  while (!$all_totals->EOF) {
    $orders_total_id = $all_totals->fields['orders_total_id'];

    if ($all_totals->fields['class'] != 'ot_total') {
      if ($all_totals->fields['class'] == 'ot_gv' || $all_totals->fields['class'] == 'ot_group_pricing') {
        $ot_total -= $all_totals->fields['value'];
      }
      else {
        $ot_total += $all_totals->fields['value'];
      }
    }

    $all_totals->MoveNext();
  }

  // apply new total value
  $format_ot_total = $currencies->format($ot_total, true, $order->info['currency'], $order->info['currency_value']) ;

  $db->Execute("UPDATE " . TABLE_ORDERS_TOTAL . " SET
                text = '" . $format_ot_total . "',
                value = '" . $ot_total  . "'
                WHERE orders_id = '" . $target_oID . "'
                AND class = 'ot_total'");
  // 		$dml = "update orders set last_modified = now() where orders_id = ". $oID;
  // echo $dml;exit;		 
  // 	$db->Execute($dml);
  // FV rajout 
  $db->Execute("UPDATE " . TABLE_ORDERS . " SET
                order_tax = '" . $ot_tax . "',
                order_total = '" . $ot_total . "',
				last_modified = now()
                WHERE orders_id = '" . $target_oID . "'");

  // fv  modification du commentaire standard 
  update_standard_comment ($target_oID);
				
  //return $ot_total;
}

function update_standard_comment ($target_oID) {

  global $db;
  global $questionc;
  global $currencies;
  
  // ne s'applique pas aux PO
  if ( $_SESSION['source_db']=="po" )
    return 1;
	
  $pp = $db->Execute('select o.order_total, o.orders_status, o.languages_id, oi.invoice_type, currency, currency_value, database_code
                      from orders  o LEFT OUTER JOIN orders_invoices oi
                         ON ( o.orders_id = oi.orders_id )
					  where o.orders_id = '.  $target_oID );
					  
  $status = $pp->fields['orders_status'];
  $montant_du = $pp->fields['order_total'];

  $languages_id = $pp->fields['languages_id'];
  $invoice_type = $pp->fields['invoice_type'];
  $currency = $pp->fields['currency'];
  $database_code = $pp->fields['database_code'];
  
  if ( $status == 3 ) 
  {
    $montant_du = 0;
	$format_due = $currencies->format(0, true, $pp->fields['currency'], $pp->fields['currency_value']) ;				
  }
  else
  {
    $format_due = $currencies->format($pp->fields['order_total'], true, $pp->fields['currency'], $pp->fields['currency_value']) ;				
  }
  
	$dml_comments = "Delete from orders_status_history  where comments like '##%' or comments like '' and orders_id = ". $target_oID;
	$db->Execute( $dml_comments );

	if ($status==0)
	{
    	$status = 7;
	}
	    if ( $status != 7 )  
		{
			$comments_text[2]="Montant dû ";
			$comments_text[3]="Total a pagar ";
			$comments_text[4]="Total zu bezahlen ";
			$comments_text[5]="Amount due ";
			$comments_text[6]="Montante Dovuto";

			$comments = $comments_text[$languages_id] . $format_due;		   
			$dml_comments = "insert into " . TABLE_ORDERS_STATUS_HISTORY . " (orders_id, orders_status_id, date_added, customer_notified, comments)
      						 values ('" . $target_oID . "', '" .$status . "', now(), '0', '##" . $comments  . "')";
        }
		else if ($database_code!="tb")
		{
			$comments_text[2]="
La validité de cette facture proforma est de 15 jours.";
			if ($database_code!="eu")
			{
			$comments_text[2].=	"		
Vous pouvez enregistrer une commande correspondant à cette facture proforma: 
- Pour une commande administrative, indiquez le numéro de la facture Proforma sur le bon de commande
    vous pouvez nous adresser ce bon de commande par fax au + 33 (0)9 72 22 76 85..
- Pour un paiement par chèque ou virement, indiquez le numéro de la facture Proforma en accompagnement de votre règlement.
- Pour un paiement par carte de crédit; veuillez nous appeler pour procéder au paiement par téléphone ou créer une nouvelle commande.";
			}
			$comments_text[3]="";
			$comments_text[4]="Faxen Sie uns dieses Bestellungsformular bitte mit Firmenstempel und Unterschrift versehen an folgende Faxnummer : 0800 664 84 76";
/*			
			$comments_text[4]="Diese Proformarechnung gilt wärend 15 Tagen.

Sie können eine Bestellung aufgeben entsprechend dieser Proforma Rechnung :
- Für eine administrative Bestellung, geben Sie bitte die Nummer der Proforma Rechnung auf dem Bestellschein an
  Sie können uns den Bestellschein per fax senden  0800 664 84 76
- Bei Zahlung per Scheck oder per Überweisung, geben Sie bitte gleichzeitig die Nummer der Proformarechnung an;
- Die Bezahlung per Kreditkarte ist möglich telefonisch (0800 771 7710) oder mittels einer neuen Bestellung.";
*/
			$comments_text[5]="
This proforma invoice is valid for 15 days.";
			if ($database_code!="eu")
			{
			$comments_text[5].="
You can place an order that matches your proforma invoice:
- For public schools and institutions, write the Proforma Invoice number on your Purchase Order
    you may send your Purchase Order by fax  + 33 (0) 1 40 05 02 53.
- For a banking check or bank transfer payment; write the Proforma Invoice Number with your payment.
- For a credit card payment; call us with your credit card information or place a new order.
";
			}

			$comments_text[7]="
Waznosc faktury proforma to 15 dni.

W przypadku platnosci czekiem lub przelewem, prosze podac numer faktury proforma.
W przypadku platnosci karta kredytowa; prosze zadzwonic by dokonac platnosc przez telefon.
";
			$dml_comments = "insert into " . TABLE_ORDERS_STATUS_HISTORY . " (orders_id, orders_status_id, date_added, customer_notified, comments)
      						 values ('" . $target_oID . "', '" .$status . "', now(), '0', '##" . $comments_text[$languages_id]  . "')";
        }
//echo 	'.'.$status.'.';
//echo ','.$dml_comments.',';				 
    	$db->Execute( $dml_comments );
							 	 		  
/*	 if ( (  $invoice_type=="PF" || $invoice_type=="DB" || ( $status==7 )  ) &&  ( ( $status==3 ) || ( $status==2 ) || ( $status==5 ) || ( $status==7 ) ) )
	 {
		 
		//  ajout des coordonnées bancaires
//echo 	$invoice_type. $status.$montant_du;exit;
*/		
		if  ( ( $montant_du > 0 ) || ( $status==7 ) )
		{
          if ( ! $questionc  )
		  {
		    if ( ( $database_code != 'hp' ) && ( $database_code != 'rq' )&& ( $database_code != 'tb' ) )
			{
				$bank_text[2]="Coordonnées bancaires : 
 Easylamps   
Domiciliation : HSBC HERVET BOULOGNE 
CODE ETABLISSEMENT : 30056
CODE GUICHET :  00785
N° DE COMPTE : 07854761087 CLE RIB : 18
IBAN: FR7630056007850785476108718
BIC : CCFRFRPP";
				}
				else
				{
				$bank_text[2]="Coordonnées bancaires : 
Sarl HPL 
Domiciliation : BP RIVES PARIS-LAMARQ
CODE ETABLISSEMENT : 10207
CODE GUICHET : 00203
N° DE COMPTE : 21219603828 CLE RIB : 36

Pour les virements de l\'étranger :
IBAN : FR76 1020 7002 0321 2196 0382 836
BIC : CCBPFRPPMTG";			
				}
			
          }
			else
		  {
			$bank_text[2]="Coordonnées bancaires : 
SAS TSR Informatique  
Domiciliation : BPRIVES PARIS-LAMARCK
CODE BANQUE : 10207
CODE GUICHET :  00203
N° DE COMPTE : 21215621091 CLE RIB : 78
";
            }		
			
			if ( $database_code != 'hp' )
			{
			$bank_text[3]="
CUENTA BANCARIA		
Beneficiario: SAS Easylamps - NIF N0017299I
Domicilio: BANCO DE SANTANDER
Branch: 6601
Account nº: 2116002722
BIC : BSCHESMM
IBAN = ES80 0049 6601 8221 1600 2722
";			
			}
			else
			{
			$bank_text[3]="
CUENTA BANCARIA					
Beneficiario: Sarl HPL 
Domicilio: BP RIVES PARIS-LAMARQ 
Para los giros desde España
IBAN : FR76 1020 7002 0321 2196 0382 836
BIC : CCBPFRPPMTG
";			
			}

			$bank_text[4]="
KONTO	
SAS Easylamps - DE275139982
Domiciliation : HypoVereinsbank; Filiale München-Promenadeplatz

Account No 10309303
Bank code  700 202 70
IBAN       DE43700202700010309303
BIC        HYVEDEMMXXX
";

//echo $currency;
if ( $currency=="GBP" )
{
			$bank_text[5]=$currency."
BANKING ACCOUNT
Account holder: Easylamps SAS

Sort code:       400707
Account number:  72020025
IBAN number:     GB97MIDL 40070772020025
SWIFT:           GBMIDL22

HSBC Tottenham Court Road Branch
39 Tottenham Court Road, London, W1T 2AR";
}
else if ( $currency=="USD" )
{
			$bank_text[5]=$currency."
BANKING ACCOUNT
Sarl Easylamps 
Domiciliation: HSBC HERVET BOULOGNE
IBAN: FR76 3005 6007 8500 6360 319
BIC : CCFRFRPP";
}
else
{
			$bank_text[5]="
BANKING ACCOUNT
Sarl Easylamps 
Domiciliation: HSBC HERVET BOULOGNE
IBAN: FR7630056007850785476108718
BIC : CCFRFRPP";
}

			$bank_text[6]="
Cordinate bancarie Easylamps
Branch: 700
Account nº: 1000/67539

IBAN: IT69C0306901000100000067539
BIC: BCITITMM 

Domiciliazione: INTESA SANPAOLO
Filiale Imprese Torino San Carlo (03005)
Piazza San Carlo 156
10121 TORINO
";

			$bank_text[7]="
Dane banku:

Easylamps  
Domiciliation : HSBC FRANCE
CODE ETABLISSEMENT : 30056 
CODE GUICHET :  00785 
N° DE COMPTE : 07854761087 CLE RIB : 18 
IBAN: FR7630056007850785476108718 
BIC : CCFRFRPP
";

		
		   $dml_comments = "insert into " . TABLE_ORDERS_STATUS_HISTORY . " (orders_id, orders_status_id, date_added, customer_notified, comments)
					 values ('" . $target_oID . "', '" .$status . "', now(), '0', '##" . $bank_text[$languages_id]  . "')";
//echo 	$dml_comments;exit;				 
		   $db->Execute( $dml_comments );
}
/*					 
		}

	 
*/
	 
}
/////////////////
// Function    : update_status
// Arguments   : oID, new_status, notified(optional), comments(optional)
// Return      : none
// Description : Adds a new status entry to an order
/////////////////
function update_status($oID, $new_status, $notified = 0, $comments = '') {
  global $db;
  global $currencies;

  if ($notified == 'on') 
       $cust_notified = 1;
  else  
       $cust_notified = 0;
  $db->Execute("INSERT INTO " . TABLE_ORDERS_STATUS_HISTORY . "
                (orders_id, orders_status_id, date_added, customer_notified, comments)
                VALUES ('" . (int)$oID . "',
                '" . $new_status . "',
                now(),
                '" . $cust_notified . "',
                '" . $comments . "')");

 $dml = "UPDATE " . TABLE_ORDERS . " SET
                orders_status = '" . $new_status . "',
				last_modified=now()				
                WHERE orders_id = '" . (int)$oID . "'";				

				
  $db->Execute($dml);
				
	update_standard_comment ($oID);			
}


/////////////////
// Function    : email_latest_status
// Arguments   : oID, orders_status_array
// Return      : NONE
// Description : Sends email to customer notifying of the latest status assigned to given order
/////////////////
function email_latest_status($oID) {
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . 'order_status_email.php');
  global $db;
  $orders_status_array = array();
  $orders_status = $db->Execute("select orders_status_id, orders_status_name
                                 from " . TABLE_ORDERS_STATUS . "
                                 where language_id = '" . (int)$_SESSION['languages_id'] . "'");
  while (!$orders_status->EOF) {
    $orders_status_array[$orders_status->fields['orders_status_id']] = $orders_status->fields['orders_status_name'];
    $orders_status->MoveNext();
  }

  $customer_info = $db->Execute("SELECT customers_name, customers_email_address, date_purchased
                                 FROM " . TABLE_ORDERS . "
                                 WHERE orders_id = '" . $oID . "'");

  $status_info = $db->Execute("SELECT orders_status_id, comments
                               FROM " . TABLE_ORDERS_STATUS_HISTORY . "
                               WHERE orders_id = '" . $oID . "'
                               ORDER BY date_added Desc limit 1");

  $status = $status_info->fields['orders_status_id'];
  if (zen_not_null($status_info->fields['comments']) && $status_info->fields['comments'] != '') {
    $notify_comments = EMAIL_TEXT_COMMENTS_UPDATE . $status_info->fields['comments'] . "\n\n";
  }

  // send email to customer
  $message = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" .
  EMAIL_TEXT_ORDER_NUMBER . ' ' . $oID . "\n\n" .
  EMAIL_TEXT_INVOICE_URL . ' ' . zen_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL') . "\n\n" .
  EMAIL_TEXT_DATE_ORDERED . ' ' . zen_date_long($customer_info->fields['date_purchased']) . "\n\n" .
  strip_tags($notify_comments) .
  EMAIL_TEXT_STATUS_UPDATED . sprintf(EMAIL_TEXT_STATUS_LABEL, $orders_status_array[$status] ) .
  EMAIL_TEXT_STATUS_PLEASE_REPLY;

  $html_msg['EMAIL_CUSTOMERS_NAME']    = $customer_info->fields['customers_name'];
  $html_msg['EMAIL_TEXT_ORDER_NUMBER'] = EMAIL_TEXT_ORDER_NUMBER . ' ' . $oID;
  $html_msg['EMAIL_TEXT_INVOICE_URL']  = '<a href="' . zen_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL') .'">'.str_replace(':','',EMAIL_TEXT_INVOICE_URL).'</a>';
  $html_msg['EMAIL_TEXT_DATE_ORDERED'] = EMAIL_TEXT_DATE_ORDERED . ' ' . zen_date_long($customer_info->fields['date_purchased']);
  $html_msg['EMAIL_TEXT_STATUS_COMMENTS'] = $notify_comments;
  $html_msg['EMAIL_TEXT_STATUS_UPDATED'] = str_replace('\n','', EMAIL_TEXT_STATUS_UPDATED);
  $html_msg['EMAIL_TEXT_STATUS_LABEL'] = str_replace('\n','', sprintf(EMAIL_TEXT_STATUS_LABEL, $orders_status_array[$status] ));
  $html_msg['EMAIL_TEXT_NEW_STATUS'] = $orders_status_array[$status];
  $html_msg['EMAIL_TEXT_STATUS_PLEASE_REPLY'] = str_replace('\n','', EMAIL_TEXT_STATUS_PLEASE_REPLY);

  zen_mail($customer_info->fields['customers_name'], $customer_info->fields['customers_email_address'], EMAIL_TEXT_SUBJECT . ' #' . $oID, $message, STORE_NAME, EMAIL_FROM, $html_msg, 'order_status');

  // send extra emails
  if (SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_STATUS == '1' and SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO != '') {
    zen_mail('', SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO, SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT . ' ' . EMAIL_TEXT_SUBJECT . ' #' . $oID, $message, STORE_NAME, EMAIL_FROM, $html_msg, 'order_status_extra');
  }

  //_TODO accept an optional array of additional recipients

}


/////////////////
// Function    :
// Arguments   :
// Return      :
// Description :
/////////////////
?>