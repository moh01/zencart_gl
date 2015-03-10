<?php

/*  PDF Order Center 1.0 for Zen Cart v1.2.6d  and v1.2.7d
 *  By Grayson Morris, 2006
 *  Printing sections based on Batch Print Center for osCommerce by Shaun Flanagan
 *
 * Released under the Gnu General Public License (see GPL.txt)
 *
 * Invoice.php
 *
 */
 
    global $ext_db_database;


if ($pageloop == "0") {   // initialize pdf settings

  $pdf = new Cezpdf(A4,portrait); // change for your desired paper / orientation

  $pdf->selectFont(DIR_PDFOC_FONTS . 'Helvetica.afm');
  $pdf->setFontFamily(DIR_PDFOC_FONTS . 'Helvetica.afm');

  // Note: units are 72 * inches
  
  define('PDFOC_LEFT_MARGIN','30');
  define('PDFOC_BOTTOM_MARGIN','100');

  // The small indents in the Sold to: & Ship to: text blocks
  define('PDFOC_TEXT_BLOCK_INDENT', '10');
//  define('PDFOC_SOLD_TO_COLUMN_START','198');
//  define('PDFOC_SHIP_TO_COLUMN_START','388');
  define('PDFOC_SOLD_TO_COLUMN_START','388');
  define('PDFOC_SHIP_TO_COLUMN_START','40');


  // This changes the 'Total - Subtotal - Tax - Shipping' text block
  // position. For example, if you increase the font size, you'll need to
  // tweak this value in order to prevent the text from clashing together.
  define('PDFOC_PRODUCT_TOTAL_TITLE_COLUMN_START','400');
  define('PDFOC_RIGHT_MARGIN','30');

  define('PDFOC_LINE_LENGTH', '552');

  // If you have attributes for certain products, you can have the text wrap
  // or force it onto on one line. Set to true for wrap, false for single line.
  define('PDFOC_PRODUCT_ATTRIBUTES_TEXT_WRAP', false);

  // Vertical spacing between sections
  define('PDFOC_SECTION_DIVIDER', '15');

  // Product table settings
  define('PDFOC_TABLE_HEADER_FONT_SIZE', '10');
  define('PDFOC_TABLE_HEADER_FONT_SIZE_BIG', '12');  
  define('PDFOC_TABLE_HEADER_BKGD_COLOR', PDFOC_DARK_GREY);
  define('PDFOC_PRODUCT_TABLE_HEADER_WIDTH', '547');

  // Simulate cell padding in HTML tables
  define('PDFOC_PRODUCT_TABLE_BOTTOM_MARGIN', '2');
  define('PDFOC_PRODUCT_TABLE_LEFT_MARGIN', '2');

  // Height of the product listing rectangles
  define('PDFOC_PRODUCT_TABLE_ROW_HEIGHT', '13');

  // The column sizes are where the product listing columns start on the
  // PDF page. If you increase TABLE HEADER FONT SIZE, you'll
  // need to tweak these values to prevent text from clashing together.
  define('PDFOC_PRODUCTS_COLUMN_SIZE', '255');
  define('PDFOC_PRODUCT_LISTING_BKGD_COLOR',PDFOC_GREY);
  define('PDFOC_MODEL_COLUMN_SIZE', '110');
  define('PDFOC_TAX_COLUMN_SIZE', '40');
  define('PDFOC_PRICING_COLUMN_SIZES', '60');
  


} else {  // print out an invoice

  //
  // libellés --------------------------------------------------------------------------------------------------------------------

    $PDFOC_TEXT_COMMENTS[2] = 'Notes:';
    $PDFOC_TEXT_COMMENTS[3] = 'Notas:';  
    $PDFOC_TEXT_COMMENTS[4] = 'Anme.:';
    $PDFOC_TEXT_COMMENTS[5] = 'Remarks:';  
    $PDFOC_TEXT_COMMENTS[6] = '-';  
    $PDFOC_TEXT_COMMENTS[7] = 'Uwaga:';  

	$PDFOC_ENTRY_INVOICE[2] =  'FACTURE';
	$PDFOC_ENTRY_INVOICE[3] =  'FACTURA';
	$PDFOC_ENTRY_INVOICE[4] =  'RECHNUNG';
	$PDFOC_ENTRY_INVOICE[5] =  'INVOICE';
    $PDFOC_ENTRY_INVOICE[6] =  'FATTURA';
    $PDFOC_ENTRY_INVOICE[7] =  'FAKTURA';

	$PDFOC_ENTRY_CREDIT[2] =  'AVOIR';
	$PDFOC_ENTRY_CREDIT[3] =  'CREDITO';
	$PDFOC_ENTRY_CREDIT[4] =  'GUTHABEN';
	$PDFOC_ENTRY_CREDIT[5] =  'CREDIT';
	$PDFOC_ENTRY_CREDIT[6] =  'ACCREDITO';
	$PDFOC_ENTRY_CREDIT[7] =  'KREDYT';

	$PDFOC_ENTRY_PROFORMAT[2] =  'PROFORMA';
	$PDFOC_ENTRY_PROFORMAT[3] =  'PROFORMA';
	$PDFOC_ENTRY_PROFORMAT[4] =  'PROFORMA';
	$PDFOC_ENTRY_PROFORMAT[5] =  'PROFORMA';
	$PDFOC_ENTRY_PROFORMAT[6] =  'PROFORMA';
	$PDFOC_ENTRY_PROFORMAT[7] =  'PROFORMA';

	$PDFOC_ENTRY_COMMANDE[2] =  'COMMANDE';
	$PDFOC_ENTRY_COMMANDE[3] =  'PEDIDO';
	$PDFOC_ENTRY_COMMANDE[4] =  'BESTELLUNG';
	$PDFOC_ENTRY_COMMANDE[5] =  'ORDER';
	$PDFOC_ENTRY_COMMANDE[6] =  'ORDINE';
	$PDFOC_ENTRY_COMMANDE[7] =  'ZAMÓWIENIE';

	$PDFOC_ENTRY_BL[2] =  'BL';
	$PDFOC_ENTRY_BL[3] =  'ORDEN DE 
EXPEDICION';
//    $PDFOC_ENTRY_BL[3] =  'ORD. DE EXPED.';
	$PDFOC_ENTRY_BL[4] =  'LIEFERSCHEIN';
	$PDFOC_ENTRY_BL[5] =  'PACKING 
   LIST';
	$PDFOC_ENTRY_BL[6] =  'D.D.T';
	$PDFOC_ENTRY_BL[7] =  'LIST 
PRZEWOZOWY';

	$PDFOC_ENTRY_PHONE[2] =  'Téléphone:';
	$PDFOC_ENTRY_PHONE[3] =  'Teléfono:';
	$PDFOC_ENTRY_PHONE[4] =  'Telefonnummer:';
	$PDFOC_ENTRY_PHONE[5] =  'Phone:';
	$PDFOC_ENTRY_PHONE[6] =  'Numero Telefono:';	
	$PDFOC_ENTRY_PHONE[7] =  'Nr telefonu:';	
	
/*
	$PDFOC_ENTRY_PAYMENT_METHOD[2] =  'Méthode de paiement:';
	$PDFOC_ENTRY_PAYMENT_METHOD[3] =  'Método de pago:';
	$PDFOC_ENTRY_PAYMENT_METHOD[4] =  'Zahlungsart:';
	$PDFOC_ENTRY_PAYMENT_METHOD[5] =  'Payment method:';
*/
	$PDFOC_PAYMENT_CONDITIONS[2] =  'Conditions de paiement:';
	$PDFOC_PAYMENT_CONDITIONS[3] =  'Fecha de pago:';
	$PDFOC_PAYMENT_CONDITIONS[4] =  'Bezahlungsdatum :';
	$PDFOC_PAYMENT_CONDITIONS[5] =  'Payment conditions:';
	$PDFOC_PAYMENT_CONDITIONS[6] =  'Condizioni di pagamento:';
	$PDFOC_PAYMENT_CONDITIONS[7] =  'Warunki platnosci:';

	
	$PDFOC_ENTRY_SHIPPING[2] =  'Livraison:';
	$PDFOC_ENTRY_SHIPPING[3] =  'Envío:';
	$PDFOC_ENTRY_SHIPPING[4] =  'Versand:';
	$PDFOC_ENTRY_SHIPPING[5] =  'Shipping:';
	$PDFOC_ENTRY_SHIPPING[6] =  'Shipping:';
	$PDFOC_ENTRY_SHIPPING[7] =  'Wysylki:';

	$PDFOC_PAYMENT_METHOD[2] =  'Moyen de paiement:';
	$PDFOC_PAYMENT_METHOD[3] =  'Método de pago:';
	$PDFOC_PAYMENT_METHOD[4] =  'Zahlungsweise:';
	$PDFOC_PAYMENT_METHOD[5] =  'Payment method:';
	$PDFOC_PAYMENT_METHOD[6] =  'Mezzo di pagamento:';
	$PDFOC_PAYMENT_METHOD[7] =  'Srodek platnosci:';
	
	$PDFOC_ENTRY_SHIP_TO[2] =  'Adresse de livraison:';
	$PDFOC_ENTRY_SHIP_TO[3] =  'Dirección de Envío:';
	$PDFOC_ENTRY_SHIP_TO[4] =  'Versandadresse:';

//echo  $order->info['orders_status']. 'b';exit;
  if ( (  $order->info['orders_status']==7 ) && (  $order->info['database_code']=="dee" ) )
  {

  //  on reprend 
  $addressparts0 = explode("\n", zen_address_format($order->billing['format_id'], $order->billing, 1, '', " \n"));
  
	  $entetefax="Fax
An:	Alleprojektorlampen
Fax: 0800 664 84 76

Von:	".stripslashes($addressparts0[0])."
Datum:	" .zen_date_short($order->info['date_purchased']) . "

_________________________________________________________________

Betrifft:	BESTELLUNG
Seiten:	2


Kommentare: 
_________________________________________________________________

";
	  
	  $y = $pdf->ezText($entetefax,PDFOC_COMPANY_HEADER_FONT_SIZE);
	  $y -= 10;

	  // logo image (x offset from left, y offset from bottom, width, height)
	  // pour site rv 
	  //	$pdf->addJpegFromFile(DIR_PDFOC_TEMPLATES . 'invoicelogo_de.jpg',420,769,124,46);	 
//  $pdf = new Cezpdf(A4,portrait);
//	  $secondpage = true;
	  $pdf->ezNewPage();
  }

	
	if (  $order->info['database_code'] != "po" )
	{	
		$PDFOC_ENTRY_SHIP_TO[5] =  'Shipping Address:';	
	}	
	
	$PDFOC_ENTRY_SHIP_TO[6] =  'Indirizzo di consegna:';
	$PDFOC_ENTRY_SHIP_TO[7] =  'Adres do wysylki:';

	$PDFOC_ENTRY_SOLD_TO[2] =  'Adresse de facturation:';
	$PDFOC_ENTRY_SOLD_TO[3] =  'Dirección  de Pago:';
	$PDFOC_ENTRY_SOLD_TO[4] =  'Rechnungsadresse:';
	if (  $order->info['database_code'] != "po" )
	{
		$PDFOC_ENTRY_SOLD_TO[5] =  'Billing Address:';
	}
	$PDFOC_ENTRY_SOLD_TO[6] =  'Indirizzo di Fatturazion:';	
	$PDFOC_ENTRY_SOLD_TO[7] =  'Adres, na ktory wystawiana jest faktura:';	
	
	$PDFOC_ENTRY_SUBTOTAL[2] =  'Sous-Total:';
	$PDFOC_ENTRY_SUBTOTAL[3] =  'Subtotal:';
	$PDFOC_ENTRY_SUBTOTAL[4] =  'Zwischensumme:';
	$PDFOC_ENTRY_SUBTOTAL[5] =  'Subtotal:';
	$PDFOC_ENTRY_SUBTOTAL[6] =  'Imponibile:';
	$PDFOC_ENTRY_SUBTOTAL[7] =  'Razem:';
	
//	echo '.'.$order->info['orders_status'].'.';exit;
	if ( $order->info['orders_status']!=5 )
	{
		$PDFOC_ENTRY_TAX[2] =  'TVA:';
		$PDFOC_ENTRY_TAX[3] =  'IVA:';
		$PDFOC_ENTRY_TAX[4] =  'MwSt:';
		$PDFOC_ENTRY_TAX[5] =  'VAT:';
		$PDFOC_ENTRY_TAX[6] =  'IVA:';		
		$PDFOC_ENTRY_TAX[7] =  'VAT:';				
	}
	
	$PDFOC_TABLE_HEADING_COMMENTS[2] =  'Notes:';
	$PDFOC_TABLE_HEADING_COMMENTS[3] =  'Notas:';
	$PDFOC_TABLE_HEADING_COMMENTS[4] =  'Anmerkungen:';
	$PDFOC_TABLE_HEADING_COMMENTS[5] =  'Remarks:';
	$PDFOC_TABLE_HEADING_COMMENTS[6] =  'Remarks:';	
	$PDFOC_TABLE_HEADING_COMMENTS[7] =  'Uwaga:';	
	
	if ( $order->info['orders_status']!=5 )
	{	
		$PDFOC_TABLE_HEADING_PRICE_EXCLUDING_TAX[2] =  'Prix UT HT';
		$PDFOC_TABLE_HEADING_PRICE_EXCLUDING_TAX[3] =  'Precio s/i';
		$PDFOC_TABLE_HEADING_PRICE_EXCLUDING_TAX[4] =  'Preis Ex/Mw';
		$PDFOC_TABLE_HEADING_PRICE_EXCLUDING_TAX[5] =  'Price wt/tax';
		$PDFOC_TABLE_HEADING_PRICE_EXCLUDING_TAX[6] =  'Prezzo Unitario';		
		$PDFOC_TABLE_HEADING_PRICE_EXCLUDING_TAX[7] =  'Cena jednost.';		
		
    }
	else
	{	
		$PDFOC_TABLE_HEADING_PRICE_EXCLUDING_TAX[2] =  'Reliquat';
		$PDFOC_TABLE_HEADING_PRICE_EXCLUDING_TAX[3] =  'A enviar';
		$PDFOC_TABLE_HEADING_PRICE_EXCLUDING_TAX[4] =  '-';
		$PDFOC_TABLE_HEADING_PRICE_EXCLUDING_TAX[5] =  'To be sent';
		$PDFOC_TABLE_HEADING_PRICE_EXCLUDING_TAX[6] =  'Da Inviare';		
		$PDFOC_TABLE_HEADING_PRICE_EXCLUDING_TAX[7] =  'do wyslania';				
    }
	
	
	$PDFOC_TABLE_HEADING_PRODUCTS_MODEL[2] =  'Référence';
	$PDFOC_TABLE_HEADING_PRODUCTS_MODEL[3] =  'Modelo';
	$PDFOC_TABLE_HEADING_PRODUCTS_MODEL[4] =  'Referenz';
	$PDFOC_TABLE_HEADING_PRODUCTS_MODEL[5] =  'Reference';
	$PDFOC_TABLE_HEADING_PRODUCTS_MODEL[6] =  'Referenze';
	$PDFOC_TABLE_HEADING_PRODUCTS_MODEL[7] =  'Oznaczenie';
	
	$PDFOC_TABLE_HEADING_PRODUCTS[2] =  'Quantité et Désignation';
	$PDFOC_TABLE_HEADING_PRODUCTS[3] =  'Productos';
	$PDFOC_TABLE_HEADING_PRODUCTS[4] =  'Anzahl und Bezeichnung';
	$PDFOC_TABLE_HEADING_PRODUCTS[5] =  'Qty and Description';
	$PDFOC_TABLE_HEADING_PRODUCTS[6] =  'Quantità e designazione'; 
	$PDFOC_TABLE_HEADING_PRODUCTS[7] =  'Ilosc / oznaczenie'; 
	
	if ( $order->info['orders_status']!=5 )
	{
		$PDFOC_TABLE_HEADING_TAX[2] =  'TVA';
		$PDFOC_TABLE_HEADING_TAX[3] =  'IVA';
		$PDFOC_TABLE_HEADING_TAX[4] =  'Mwst';
		$PDFOC_TABLE_HEADING_TAX[5] =  'VAT';
		$PDFOC_TABLE_HEADING_TAX[6] =  'IVA';		
		$PDFOC_TABLE_HEADING_TAX[7] =  'VAT';				
	}
	if ( $order->info['orders_status']!=5 )
	{	
		$PDFOC_TABLE_HEADING_TOTAL_EXCLUDING_TAX[2] =  'Total HT';
		$PDFOC_TABLE_HEADING_TOTAL_EXCLUDING_TAX[3] =  'Total s/i';
		$PDFOC_TABLE_HEADING_TOTAL_EXCLUDING_TAX[4] =  'Total Ex.Mw';
		$PDFOC_TABLE_HEADING_TOTAL_EXCLUDING_TAX[5] =  'Total wt/tax';
		$PDFOC_TABLE_HEADING_TOTAL_EXCLUDING_TAX[6] =  'Totale (P x Q)';		
		$PDFOC_TABLE_HEADING_TOTAL_EXCLUDING_TAX[7] =  'Cena Netto';		
		
	}
	else
	{	
		$PDFOC_TABLE_HEADING_TOTAL_EXCLUDING_TAX[2] =  'Quantité';
		$PDFOC_TABLE_HEADING_TOTAL_EXCLUDING_TAX[3] =  'Cantidad';
		$PDFOC_TABLE_HEADING_TOTAL_EXCLUDING_TAX[4] =  'Anzahl';
		$PDFOC_TABLE_HEADING_TOTAL_EXCLUDING_TAX[5] =  'Quantity';
		$PDFOC_TABLE_HEADING_TOTAL_EXCLUDING_TAX[6] =  'Quantità';		
		$PDFOC_TABLE_HEADING_TOTAL_EXCLUDING_TAX[7] =  'ilosc';		
		
	}
	

	$PDFOC_TABLE_HEADING_TOTAL_INCLUDING_TAX[2] =  'Total TTC';
	$PDFOC_TABLE_HEADING_TOTAL_INCLUDING_TAX[3] =  'Total c/i';
	$PDFOC_TABLE_HEADING_TOTAL_INCLUDING_TAX[4] =  'Total In.Mw';
	$PDFOC_TABLE_HEADING_TOTAL_INCLUDING_TAX[5] =  'Total tax included';
	$PDFOC_TABLE_HEADING_TOTAL_INCLUDING_TAX[6] =  'Totale da Pagare';	
	$PDFOC_TABLE_HEADING_TOTAL_INCLUDING_TAX[7] =  'Razem z VAT';	

	$PDFOC_TEXT_INVOICE_DATE[2] = 'Date de facture:';
	$PDFOC_TEXT_INVOICE_DATE[3] = 'Fecha de Factura:';
	$PDFOC_TEXT_INVOICE_DATE[4] = 'Rechnungsdatum:';
	$PDFOC_TEXT_INVOICE_DATE[5] = 'Invoice date:';
	$PDFOC_TEXT_INVOICE_DATE[6] = 'Data della Fattura:';
	$PDFOC_TEXT_INVOICE_DATE[7] = 'Data faktury:';
	
	$PDFOC_TEXT_DATE[2] = 'Date:';
	$PDFOC_TEXT_DATE[3] = 'Fecha:';
	$PDFOC_TEXT_DATE[4] = 'Vom:';
	$PDFOC_TEXT_DATE[5] = 'Date:';
	$PDFOC_TEXT_DATE[6] = 'Data:';	
	$PDFOC_TEXT_DATE[7] = 'Data:';	

	$PDFOC_TEXT_CREDIT_DATE[2] = 'Date de l\'avoir:';
	$PDFOC_TEXT_CREDIT_DATE[3] = 'Fecha:';
	$PDFOC_TEXT_CREDIT_DATE[4] = 'Vom:';
	$PDFOC_TEXT_CREDIT_DATE[5] = 'Credit note date:';
	$PDFOC_TEXT_CREDIT_DATE[6] = 'Data dell\' Accredito:';
	$PDFOC_TEXT_CREDIT_DATE[7] = 'Data przyznania kredytu:';

	$PDFOC_TEXT_INVOICE_NUMBER[2] = 'Numéro de facture:';
	$PDFOC_TEXT_INVOICE_NUMBER[3] = 'Factura nº:';
	$PDFOC_TEXT_INVOICE_NUMBER[4] = 'Rechnung:';
	$PDFOC_TEXT_INVOICE_NUMBER[5] = 'Invoice number:';
	$PDFOC_TEXT_INVOICE_NUMBER[6] = 'Numero della Fattura:';
	$PDFOC_TEXT_INVOICE_NUMBER[7] = 'Numer faktury:';

	$PDFOC_TEXT_NUMBER[2] = 'Numéro:';
	$PDFOC_TEXT_NUMBER[3] = 'Nº:';
	$PDFOC_TEXT_NUMBER[4] = 'Nummer:';
	$PDFOC_TEXT_NUMBER[5] = 'Number:';
	$PDFOC_TEXT_NUMBER[6] = 'Numero:';	
	$PDFOC_TEXT_NUMBER[7] = 'Numer:';	
	
	$PDFOC_TEXT_CREDIT_NUMBER[2] = 'Numéro de l\'avoir:';
	$PDFOC_TEXT_CREDIT_NUMBER[3] = 'Nº:';
	$PDFOC_TEXT_CREDIT_NUMBER[4] = 'Nummer:';
	$PDFOC_TEXT_CREDIT_NUMBER[5] = 'Credit note number:';	
	$PDFOC_TEXT_CREDIT_NUMBER[6] = 'Numero dell\' Accredito:';	
	$PDFOC_TEXT_CREDIT_NUMBER[7] = 'Numer kredytu:';	
	
	$PDFOC_TEXT_CUSTOMER_NUMBER[2] = 'Numéro de client:';
	$PDFOC_TEXT_CUSTOMER_NUMBER[3] = 'Cliente Nº:';
	$PDFOC_TEXT_CUSTOMER_NUMBER[4] = 'Kundennummer:';
	$PDFOC_TEXT_CUSTOMER_NUMBER[5] = 'Customer number:';	
	$PDFOC_TEXT_CUSTOMER_NUMBER[6] = 'Numero cliente:';		
	$PDFOC_TEXT_CUSTOMER_NUMBER[7] = 'Numer Klienta:';		
   
	$PDFOC_TEXT_ORDER_DATE[2] = 'Date de commande:';
	$PDFOC_TEXT_ORDER_DATE[3] = 'Fecha de pedido:';
	$PDFOC_TEXT_ORDER_DATE[4] = 'Datum:';
	$PDFOC_TEXT_ORDER_DATE[5] = 'Order date:';
	$PDFOC_TEXT_ORDER_DATE[6] = 'Data ordine:';
	$PDFOC_TEXT_ORDER_DATE[7] = 'Data zamówienia:';
	
	$PDFOC_TEXT_ORDER_NUMBER[2] = 'Ref. commande:';
	$PDFOC_TEXT_ORDER_NUMBER[3] = 'Pedido:';
	$PDFOC_TEXT_ORDER_NUMBER[4] = 'Bestellung:';
	$PDFOC_TEXT_ORDER_NUMBER[5] = 'Order Ref:';
	$PDFOC_TEXT_ORDER_NUMBER[6] = 'Numero ordine:';	
	$PDFOC_TEXT_ORDER_NUMBER[7] = 'Zamowienie Nr:';	

	$PDFOC_EMAIL_TEXT_DATE_ORDERED[2] =  'Date de commande:';
	$PDFOC_EMAIL_TEXT_DATE_ORDERED[3] =  'Fecha de pedidos:';
	$PDFOC_EMAIL_TEXT_DATE_ORDERED[4] =  'Datum:';
	$PDFOC_EMAIL_TEXT_DATE_ORDERED[5] =  'Order date:';
	$PDFOC_EMAIL_TEXT_DATE_ORDERED[6] =  'Data ordine:';
	$PDFOC_EMAIL_TEXT_DATE_ORDERED[7] =  'Data zamowienia:';


	$PDFOC_TEXT_EASYLAMPS_ORDER_NUMBER[2] =  'Ref. commande Easylamps:';  
	$PDFOC_TEXT_EASYLAMPS_ORDER_NUMBER[3] =  'Pedido nº Easylamps:';  
	$PDFOC_TEXT_EASYLAMPS_ORDER_NUMBER[4] =  'Easylamps Bestellnummer:';  
	$PDFOC_TEXT_EASYLAMPS_ORDER_NUMBER[5] =  'Easylamps Order number:';  
	$PDFOC_TEXT_EASYLAMPS_ORDER_NUMBER[6] =  'Numero ordine Easylamps:';  
	$PDFOC_TEXT_EASYLAMPS_ORDER_NUMBER[7] =  'Zamowienie Nr Easylamps:';  
	
	$PDFOC_TEXT_TVA_NUMBER[2] = 'V/Id CEE:';
	$PDFOC_TEXT_TVA_NUMBER[3] = 'NIF-CIF-V/Id CEE:';
	$PDFOC_TEXT_TVA_NUMBER[4] = 'V/Id CEE:';
	$PDFOC_TEXT_TVA_NUMBER[5] = 'EEC V/Id:';
	$PDFOC_TEXT_TVA_NUMBER[6] = 'Intracomunitari:';
	$PDFOC_TEXT_TVA_NUMBER[7] = 'Numer NIP';

	
	//echo '.'.$order->info['orders_status'].'.';exit;
  $currencies = new currencies();

  // company name and details pulled from the my store address and phone number
  // in admin configuration mystore
  if ( $order->info['database_code'] == "fr" )
  {
     $store_address = "Lampevideoprojecteur - Tel: 01 71 86 46 66
SAS Easylamps - 33 rue de la Révolution
93100 Montreuil - France
SIRET : 489 702 514 00048   INTRACOM : FR 68 489 702 514 ";
  }
  else if ( $order->info['database_code'] == "bf" )
  {
     $store_address = "SAS Easylamps - Easybatteries
33 rue de la Révolution
93100 Montreuil - France
SIRET : 489 702 514 00048   INTRACOM : FR 68 489 702 514";
  }  
  else if ( $order->info['database_code'] == "hp" )
  {
     $store_address = "HPL SARL - Hotprojectorlamps
47 rue Marcel Dassault
92100 BOULOGNE BILLANCOURT
SIREN : 753 563 220   INTRACOM : FR09753563220";
  }    
  else if ( $order->info['database_code'] == "tb" )
  {
     $store_address = "HPL SARL - TBI
47 rue Marcel Dassault
92100 BOULOGNE BILLANCOURT
SIREN : 753 563 220   INTRACOM : FR09753563220";
  }      
  else if ( $order->info['database_code'] == "rq" )
  {
     $store_address = "HPL SARL - Rienquedeslampes
47 rue Marcel Dassault
92100 BOULOGNE BILLANCOURT
SIREN : 753 563 220   INTRACOM : FR09753563220";
  }    
  else if ( $order->info['database_code'] == "pl" )
  {
     $store_address = "SAS Easylamps - zarowki-do-projektorow.pl  
33 rue de la Révolution
93100 Montreuil - Francja
SIRET : 489 702 514 00048   numeru VAT : FR 68 489 702 514";
  }    
  else if ( $order->info['database_code'] == "es" )
  {
     $store_address = "SAS Easylamps - Lamparasparaproyectores  
Calle Gardoqui n°3 - 6° A Dpto. N°1.
48008 Bilbao, España. 
NIF N0017299I   INTRACOM : FR 68 489 702 514";
  }
  else  if (  
             ( $order->info['database_code'] == "eu" ) 
			 || ( $order->info['database_code'] == "po" )  )
  {
     if ( $order->info['languages_id'] == 3 )
	 {
     $store_address = "SAS Easylamps
33 rue de la Révolution
93100 Montreuil - France
NIF N0017299I   INTRACOM : FR 68 489 702 514";
     }
     else if ( $order->info['languages_id'] == 4 )
	 {
     $store_address = "SAS Easylamps
33 rue de la Révolution
93100 Montreuil - France
DE275139982";
     }	 
	 else
	 {
     $store_address = "SAS Easylamps
33 rue de la Révolution
93100 Montreuil - France
SIRET : 489 702 514 00048   INTRACOM : FR 68 489 702 514";	 
	 }	 
  }  
  else  if ( $order->info['database_code'] == "de" )
  {
     $store_address = "AlleProjektorLampen - SAS Easylamps  
Libanonstrasse 85
70186 Stuttgart  
DE275139982";
  }  
  else  if ( $order->info['database_code'] == "en" )
  {
/*  
     $store_address = "SAS Easylamps - JustProjectorLamps  
33 rue de la Révolution
93100 Montreuil  - France
SIRET : 489 702 514 00048   INTRACOM : FR 68 489 702 514";
*/
     $store_address = "JustProjectorLamps -  Gemini Business Center    
136- 140 Old Shoreham Road Hove -  
East Sussex   BN3 7BD - UK -  VAT N°: GB 113 4856 27 
SAS Easylamps  -  33 rue de la Révolution -  93100 Montreuil  
INTRACOM : FR 68 489 702 514";
  }  
else if ( $order->info['database_code'] == "it" )
{
    $check_tax  = $db->Execute("select order_tax, entry_tva_intracom from orders where  orders_id = '" . $orders->fields['orders_id'] . "'");
	
	if ( ( $check_tax->fields['order_tax'] == 0 ) && ( strlen($check_tax->fields['entry_tva_intracom'])>0 ) )
	{
		$store_address = "SAS Easylamps – Lampadeproiettori
33 rue de la Révolution
93100 Montreuil - Francia
SIRET: 489 702 514 00022	P.IVA INTRACOMUNITARI: FR 68 489 702 514";
	}
	else
	{
		$store_address = "Lampadeproiettori - Easylamps 
Via Monte Baldo, 10 
37069 Villafranca di Verona 
P.IVA INTRACOMUNITARI: IT00144209996";	
	}
}
else if ( $order->info['database_code'] == "ns" )
{
    $store_address = "SAS TSR Informatique 
40 rue Baudin - APT 6101
92400 COURBEVOIE
 
SIRET: 788 573 475 00019";
}
  $y = $pdf->ezText($store_address,PDFOC_COMPANY_HEADER_FONT_SIZE);
  $y -= 10;

  // logo image (x offset from left, y offset from bottom, width, height)
  // pour site rv 
  //   $pdf->addJpegFromFile(DIR_PDFOC_TEMPLATES . 'invoicelogo.jpg',360,765,150,68);
  if ( $order->info['database_code'] == "fr" )
    $pdf->addJpegFromFile(DIR_PDFOC_TEMPLATES . 'invoicelogo.jpg',420,769,124,46);	
  if ( $order->info['database_code'] == "bf" )  
    $pdf->addJpegFromFile(DIR_PDFOC_TEMPLATES . 'logo_eb.jpg',420,769,167,70);	
  else if ( $order->info['database_code'] == "hp" )     
	$pdf->addJpegFromFile(DIR_PDFOC_TEMPLATES . 'hpl_logo.jpg',420,769,167,70);	
  else if ( $order->info['database_code'] == "tb" )     
	$pdf->addJpegFromFile(DIR_PDFOC_TEMPLATES . 'tbi_logo.jpg',420,769,167,50);		
  else if ( $order->info['database_code'] == "es" )
    $pdf->addJpegFromFile(DIR_PDFOC_TEMPLATES . 'invoicelogo_es.jpg',420,769,124,46);
  else if ( $order->info['database_code'] == "pl" )
    $pdf->addJpegFromFile(DIR_PDFOC_TEMPLATES . 'invoicelogo_pl.jpg',420,769,124,46);	
  else if ( $order->info['database_code'] == "de" )
    $pdf->addJpegFromFile(DIR_PDFOC_TEMPLATES . 'invoicelogo_de.jpg',420,769,124,46);
  else if  ( ( $order->info['database_code'] == "eu" ) || ( $order->info['database_code'] == "po" ) )
    $pdf->addJpegFromFile(DIR_PDFOC_TEMPLATES . 'invoicelogo_el.jpg',360,765,150,68);
  else if ( $order->info['database_code'] == "en" )
    $pdf->addJpegFromFile(DIR_PDFOC_TEMPLATES . 'invoicelogo_uk.jpg',420,769,124,46);
  else if ( $order->info['database_code'] == "it" )
    $pdf->addJpegFromFile(DIR_PDFOC_TEMPLATES . 'invoicelogo_it.jpg',420,769,124,46);
  else if ( $order->info['database_code'] == "rq" )
    $pdf->addJpegFromFile(DIR_PDFOC_TEMPLATES . 'rqdl_logo.jpg',420,769,124,46);

  
  // extra info boxes to be used by staff (comment out if not desired)
  //$pdf->setStrokeColor(0,0,0);
  //$pdf->setLineStyle(1);
  //$pdf->roundedRectangle(470,730,85,85,10,$f=0);
  //$pdf->rectangle(535,748,10,10);
  //$pdf->rectangle(535,769,10,10);
  
  //$pdf->rectangle(535,790,10,10);
  //$pdf->addText(480,790,PDFOC_GENERAL_FONT_SIZE,'Bank');
  //$pdf->addText(480,769,PDFOC_GENERAL_FONT_SIZE,'Post');
  //$pdf->addText(480,748,PDFOC_GENERAL_FONT_SIZE,'Sale');


  // line after header
  //
  $pdf->setLineStyle(1);
  $pdf->line(PDFOC_LEFT_MARGIN,$y,PDFOC_LINE_LENGTH,$y);

    // search the db to see if this order already has an invoice
    //
	if ( ! $questionc  )
	{
		$sql = "select * from ".$ext_db_database['gl'].".orders_invoices 
				where  order_total<>0 
				AND orders_id = '" . $orders->fields['orders_id'] . "'";
	}
	else
	{
		$sql = "select * from orders_invoices where  order_total<>0 AND orders_id = '" . $orders->fields['orders_id'] . "'";
	}
	
//echo $sql;exit;	
    $verify_debit = $db->Execute($sql);

	$lib_numero = $PDFOC_TEXT_INVOICE_NUMBER[$order->info['languages_id']];
	$lib_date = $PDFOC_TEXT_INVOICE_DATE[$order->info['languages_id']];
	//  
	$affiche_bl = 0;
    if ( (!$verify_debit->EOF) || (  $order->info['orders_status']==7 ) )
	{  
	  
	  $orders_invoices_id_comment = $verify_debit->fields['orders_invoices_id_comment'];
	  
      if (  ( $verify_debit->fields['invoice_type'] == "DB" ) || ( $verify_debit->fields['invoice_type'] == "DH" ) )
	  {
		  $invoice_id = 'INT'.$verify_debit->fields['orders_invoices_id'];
	      $invoice_date = zen_date_short($verify_debit->fields['invoice_date']);
	      $lib_type = $PDFOC_ENTRY_INVOICE[$order->info['languages_id']];
//echo $invoice_date;exit;		  
	  }
	  else if ( ( $verify_debit->fields['invoice_type'] == "CR" ) || ( $verify_debit->fields['invoice_type'] == "CH" ) )
	  {
	      $invoice_id = 'AVINT'.$verify_debit->fields['orders_invoices_id'];
	      $invoice_date = zen_date_short($verify_debit->fields['invoice_date']);

		   $lib_numero = $PDFOC_TEXT_CREDIT_NUMBER[$order->info['languages_id']];
		   $lib_date = $PDFOC_TEXT_CREDIT_DATE[$order->info['languages_id']];
    	   $lib_type = $PDFOC_ENTRY_CREDIT[$order->info['languages_id']];	  
      }
	  else if (  $order->info['orders_status']==7 )
	  {
    	    $invoice_id = 'PRF'.$oID;
	        $invoice_date = zen_date_short($order->info['date_purchased']);
       	    $lib_type = $PDFOC_ENTRY_PROFORMAT[$order->info['languages_id']];	       
	  }
	  else if ( $verify_debit->fields['invoice_type'] == "BL" )
	  {
    	  	$affiche_bl = 1;

    	    $invoice_id = 'BL'.$verify_debit->fields['orders_invoices_id'];
	        $invoice_date = zen_date_short($verify_debit->fields['invoice_date']);			  
       	    $lib_type = $PDFOC_ENTRY_BL[$order->info['languages_id']];	       	  

   		    $lib_numero = $PDFOC_TEXT_NUMBER[$order->info['languages_id']];
		    $lib_date = $PDFOC_TEXT_DATE[$order->info['languages_id']];
			
	  }
	}
	else
	{
       $lib_type = $PDFOC_ENTRY_COMMANDE[$order->info['languages_id']];	       	  
  	   $invoice_id = 'n/a';
	   $invoice_date = 'n/a';
	}
//echo $lib_type;exit;	
	    
  // document identifier
  //
  $pdf->ezSetY($y - 45);
  //  $cx = (PDFOC_SOLD_TO_COLUMN_START-10-$pdf->getTextWidth(PDFOC_GIANT_FONT_SIZE,PDFOC_ENTRY_INVOICE))*0.5;
//  echo $pdf->getTextWidth(PDFOC_GIANT_FONT_SIZE,$lib_type);exit;
//  if ( 
//  $cx = (PDFOC_SOLD_TO_COLUMN_START+170-$pdf->getTextWidth(PDFOC_GIANT_FONT_SIZE,$lib_type))*0.5;
  $cx = (PDFOC_SOLD_TO_COLUMN_START+170-120)*0.5;
  
  $pdf->ezText($lib_type,PDFOC_GIANT_FONT_SIZE, array('aleft'=>$cx));

  //left rounded rectangle around "sold to" info
  //
  $pdf->ezSetY($y);
  $pdf->setStrokeColor(0,0,0);
  $pdf->setLineStyle(1);
  $pdf->roundedRectangle(PDFOC_SOLD_TO_COLUMN_START-10,595,180,120,10,$f=0);


  // move down into rectangle
  //
  $y = $y - 30;
  
  // "sold to" info in left rectangle
  $pdf->addText(PDFOC_SOLD_TO_COLUMN_START,$y,PDFOC_SUB_HEADING_FONT_SIZE,"<b>" . $PDFOC_ENTRY_SOLD_TO[$order->info['languages_id']] . "</b>");

  $pos = $y-10;
  $indent = PDFOC_SOLD_TO_COLUMN_START + PDFOC_TEXT_BLOCK_INDENT;

  // print billing address in "sold to" box
  $addressparts = explode("\n", zen_address_format($order->billing['format_id'], $order->billing, 1, '', " \n"));
  if (PDFOC_SHIP_FROM_COUNTRY == $addressparts[count($addressparts)-1]) 
  { // don't print country if national delivery; only works for address formats #2, #4, and #5
     $addressparts[count($addressparts)-1] = '';
  }
  foreach($addressparts as $addresspart) {
    $pdf->addText($indent,$pos -=PDFOC_GENERAL_LEADING,9,stripslashes($addresspart));
  }

  // right rounded rectangle around "ship to" info
  $pdf->setStrokeColor(0,0,0);
  $pdf->setLineStyle(1);
  if (  $order->info['database_code'] != "po" ) 
  {
	  $pdf->roundedRectangle(PDFOC_SHIP_TO_COLUMN_START-10,595,180,120,10,$f=0);

	  // ship to info in right rectangle
	  $pdf->addText(PDFOC_SHIP_TO_COLUMN_START,$y,PDFOC_SUB_HEADING_FONT_SIZE,"<b>" . $PDFOC_ENTRY_SHIP_TO[$order->info['languages_id']] . "</b>");

	  $pos = $y-10;
	  $indent = PDFOC_SHIP_TO_COLUMN_START + PDFOC_TEXT_BLOCK_INDENT;

	  // print deliver address in "ship to" box
	  $addressparts = explode("\n", zen_address_format($order->delivery['format_id'], $order->delivery, 1, '', " \n"));
	  /*
	  if (PDFOC_SHIP_FROM_COUNTRY == $addressparts[count($addressparts)-1]) { // don't print country if national delivery; only works for address formats #2, #4, and #5
	     $addressparts[count($addressparts)-1] = '';
	  }
	  */
	  foreach($addressparts as $addresspart) {
	    $pdf->addText($indent,$pos -=PDFOC_GENERAL_LEADING,9,stripslashes($addresspart));
	  }
  }
  // divider between addresses and order information
  $pos -= PDFOC_SECTION_DIVIDER;
  $pdf->ezSetY($pos - 60 );
  
  // ----- BOF OTFIN (On-the-Fly Invoice Numbering) -----
  //
  // This section creates a new invoice id (if no invoice has previously been
  // generated for this order) OR retrieves the existing invoice id.
  //
  // Note: This implies that there can be only one invoice per order id. The
  // assumption here is that if something changes about an order (the customer
  // adds an item after you've sent the invoice, for example), the order
  // is cancelled, a 100% refund is issued on paper (see admin/invoice_credit.php),
  // and a new order is created with the updated order data.

  // check whether this is a quote or the final invoice (don't generate invoice
  // number unless it is final invoice)
  //

/*
    if ($_POST['invoice_mode']=='final' && $verify_debit->EOF) { // no invoice exists for this order, so create one now

      // read out order total and tax values
      $otx = $db->Execute("select value from " . TABLE_ORDERS_TOTAL . " where class = 'ot_tax' and orders_id = '" . $orders->fields['orders_id'] . "'");
      $ott = $db->Execute("select value from " . TABLE_ORDERS_TOTAL . " where class = 'ot_total' and orders_id = '" . $orders->fields['orders_id'] . "'");

      $ot[0] = $otx->fields['value'];
      $ot[1] = $ott->fields['value'];

      // record this invoice in invoices table, then read back out to get newly created invoice id
      $db->Execute("insert into " . TABLE_ORDERS_INVOICES . " (orders_id, invoice_date, invoice_type, order_tax, order_total) values ('". $orders->fields['orders_id'] . "', now(), 'DB', '" . $ot[0] . "', '" . $ot[1] . "')");
      $verify_debit = $db->Execute("select * from " . TABLE_ORDERS_INVOICES . " where invoice_type = 'DB' AND order_total<>0 AND orders_id = '" . $orders->fields['orders_id'] . "'");

    } // EOIF $_POST['invoice_mode']=='final' && $verify_debit->EOF
*/
	

  // invoice number
// $p_customer_database_code
//  echo 'dtb'.$order->info['database_code'];exit;
    if (  $order->info['database_code'] != "po" )
	{	
	  $pdf->ezText("<b>" . $lib_numero . " </b>" . $invoice_id .'  '.$orders_invoices_id_comment.' ',PDFOC_SUB_HEADING_FONT_SIZE);
	  
	  // invoice date
	  $pos = $pdf->ezText("<b>" . $lib_date . " </b>" . $invoice_date,PDFOC_SUB_HEADING_FONT_SIZE);
	  $pdf->ezSetY($pos - 10);
	  
	  // customer number
	  $pos = $pdf->ezText("<b>" .$PDFOC_TEXT_CUSTOMER_NUMBER[$order->info['languages_id']] . " </b>" . $orders->fields['customers_id'] ,PDFOC_SUB_HEADING_FONT_SIZE);   
	  //  $pdf->ezSetY($pos - 10);
	}

/*	
echec
	
	if ($_SERVER['SERVER_NAME']=='127.0.0.1')		
			$img = DIR_WS_ADMIN.'/barcode/barcode.php?cmd=888788&mode=jpg';
		else
			$img = '<img src="http://linats.net/admin/barcode/barcode.php?cmd='.$orders_id.'" width=130>';
			
    //$pdf->addJpegFromFile(DIR_PDFOC_TEMPLATES . 'invoicelogo_de.jpg',360,489,124,46);
	$pdf->addJpegFromFile($img,360,489,124,46);
	//$pdf->write1DBarcode('COLLISSIMO', 'C128B', '', '', 15, 8, 0.4, $style, 'N');

*/

  	if ( $order->customer['entry_tva_intracom'] )
	{
	    $pos =  $pdf->ezText("<b>" . $PDFOC_TEXT_TVA_NUMBER[$order->info['languages_id']] . " </b>" . $order->customer['entry_tva_intracom'],PDFOC_SUB_HEADING_FONT_SIZE);
	}
	


  // order number
  $pdf->ezSetY($pos - 10);
  if (strlen($order->info['ref_info'])>0)
    $ref_text =  $order->info['ref_info'];
  else
    $ref_text =  $orders->fields['orders_id'];
	  
  $pos = $pdf->ezText("<b>" . $PDFOC_TEXT_ORDER_NUMBER[$order->info['languages_id']] . " </b>" . $ref_text ,PDFOC_SUB_HEADING_FONT_SIZE);

  if  ( ( $orders->fields['orders_id'] != $ref_text ) &&  ( $order->info['database_code'] != "ns" ) )
  {
     $pos = $pdf->ezText("<b>" . $PDFOC_TEXT_EASYLAMPS_ORDER_NUMBER[$order->info['languages_id']] . " </b>" . $orders->fields['orders_id']);
  }  
  // order date
  if ($_POST['show_order_date']) {
    $pos =  $pdf->ezText("<b>" . $PDFOC_TEXT_ORDER_DATE[$order->info['languages_id']] . " </b>" . zen_date_short($order->info['date_purchased']),PDFOC_SUB_HEADING_FONT_SIZE);
  }
  
    $pdf->ezSetY($pos - 10);
   // payment method
//echo   $order->info['payment_method'];exit;
  	if ( strlen($order->info['payment_method'])>0 )
	{
       $pos =  $pdf->ezText("<b>" .$PDFOC_PAYMENT_METHOD[$order->info['languages_id']] . " </b>" . $order->info['payment_method'] ,PDFOC_SUB_HEADING_FONT_SIZE);   
    
	}
	if ( ( $order->info['languages_id'] == 4 ) && ( $verify_debit->fields['invoice_type'] == "DB" )  )
	{
       $pos =  $pdf->ezText("<b>Lieferdatum</b>:" . $invoice_date ,PDFOC_SUB_HEADING_FONT_SIZE);   		
	}
	
//echo 	$order->info['payment_conditions_desc'];exit;
  	if ( strlen($order->info['payment_conditions_desc'])>0 )
	{
       $pos =  $pdf->ezText("<b>" .$PDFOC_PAYMENT_CONDITIONS[$order->info['languages_id']] . " </b>" . $order->info['payment_conditions_desc'] ,PDFOC_SUB_HEADING_FONT_SIZE);   
    }

	// ------ EOF OTFIN ------

  
  // divider between invoice data and order data
//  $pos -= PDFOC_SECTION_DIVIDER;
//  $pdf->ezSetY($pos);



  // phone and e-mail: displays blank lines if turned off so as to maintain layout
  if ($_POST['show_phone'] || $_POST['show_email'] ) {

    if ($_POST['show_phone']) {
      if ($order->customer['telephone']!='') {
        $pos = $pdf->ezText("<b>" . $PDFOC_ENTRY_PHONE[$order->info['languages_id']] . "</b> " . $order->customer['telephone'],PDFOC_GENERAL_FONT_SIZE);
      } else {
        $pos = $pdf->ezText("");
      }
    }
    if ($_POST['show_email']) {
      if ($order->customer['email_address']!='') {
        $pos = $pdf->ezText("<b>" . PDFOC_ENTRY_EMAIL . "</b> " .$order->customer['email_address'],PDFOC_GENERAL_FONT_SIZE);
      } else {
        $pos = $pdf->ezText("");
      }
    }

  } else {

    $pos = $pdf->ezText("");
    $pos = $pdf->ezText("");

  } // EOIF $_POST['show_phone']


  // divider between email and payment method
  $pos -= PDFOC_SECTION_DIVIDER;
  $pdf->ezSetY($pos);
 
  // payment method
  if ($_POST['show_pay_method']) {
  
    $pos = $pdf->ezText("<b>" . $PDFOC_ENTRY_PAYMENT_METHOD[$order->info['languages_id']] . "</b> " . $order->info['payment_method'],PDFOC_GENERAL_FONT_SIZE);

    if ($order->info['payment_method'] == PDFOC_PAYMENT_TYPE) {
    
      $pos = $pdf->ezText("<b>" . PDFOC_ENTRY_PAYMENT_TYPE . "</b> " . $order->info['cc_type'],PDFOC_GENERAL_FONT_SIZE);
      $pos = $pdf->ezText("<b>" . PDFOC_ENTRY_CC_OWNER . "</b> " . $order->info['cc_owner'],PDFOC_GENERAL_FONT_SIZE);

      if ($_POST['show_cc']) {
        $pos = $pdf->ezText("<b>" . PDFOC_ENTRY_CC_NUMBER . "</b> " . $order->info['cc_number'],PDFOC_GENERAL_FONT_SIZE);
      }
		
	$pos = $pdf->ezText("<b>" . PDFOC_ENTRY_CC_EXP . "</b> " . $order->info['cc_expires'],PDFOC_GENERAL_FONT_SIZE);
	
    } // EOIF $order->info['payment_method']

  } // EOIF $_POST['show_pay_method']

  $pos -= PDFOC_SECTION_DIVIDER;
 
  // products , model etc table layout
  PDFOC_change_color(PDFOC_TABLE_HEADER_BKGD_COLOR);
  $pdf->filledRectangle(PDFOC_LEFT_MARGIN,$pos-PDFOC_PRODUCT_TABLE_ROW_HEIGHT,PDFOC_PRODUCT_TABLE_HEADER_WIDTH,PDFOC_PRODUCT_TABLE_ROW_HEIGHT);

  $x = PDFOC_LEFT_MARGIN + PDFOC_PRODUCT_TABLE_LEFT_MARGIN;
  $pos = ($pos-PDFOC_PRODUCT_TABLE_ROW_HEIGHT) + PDFOC_PRODUCT_TABLE_BOTTOM_MARGIN;

  PDFOC_change_color(PDFOC_GENERAL_FONT_COLOR);

  $pdf->ezSetY($pos+PDFOC_PRODUCT_TABLE_ROW_HEIGHT);
  $pdf->ezText($PDFOC_TABLE_HEADING_PRODUCTS[$order->info['languages_id']],PDFOC_TABLE_HEADER_FONT_SIZE, array('aleft'=>$x));
  $x += PDFOC_PRODUCTS_COLUMN_SIZE;
  
  $pdf->ezSetY($pos+PDFOC_PRODUCT_TABLE_ROW_HEIGHT);
  $pdf->ezText($PDFOC_TABLE_HEADING_PRODUCTS_MODEL[$order->info['languages_id']],PDFOC_TABLE_HEADER_FONT_SIZE, array('aleft'=>$x));
  $x += PDFOC_MODEL_COLUMN_SIZE;
  
  $pdf->ezSetY($pos+PDFOC_PRODUCT_TABLE_ROW_HEIGHT);
  if ( $order->info['orders_status']!=5 )
  {
    $pdf->ezText($PDFOC_TABLE_HEADING_TAX[$order->info['languages_id']] . " (%)",PDFOC_TABLE_HEADER_FONT_SIZE, array('aleft'=>$x));
  }
  $x += PDFOC_TAX_COLUMN_SIZE;
  
  $pdf->ezSetY($pos+PDFOC_PRODUCT_TABLE_ROW_HEIGHT);
  $x += PDFOC_PRICING_COLUMN_SIZES;
  
  $pdf->ezText($PDFOC_TABLE_HEADING_PRICE_EXCLUDING_TAX[$order->info['languages_id']],PDFOC_TABLE_HEADER_FONT_SIZE,array('justification'=> 'right','aright'=>$x));
  $pdf->ezSetY($pos+PDFOC_PRODUCT_TABLE_ROW_HEIGHT);
/*    
  $x += PDFOC_PRICING_COLUMN_SIZES;
  $pdf->ezText(PDFOC_TABLE_HEADING_PRICE_INCLUDING_TAX,PDFOC_TABLE_HEADER_FONT_SIZE,array('justification'=> 'right','aright'=>$x));
  $pdf->ezSetY($pos+PDFOC_PRODUCT_TABLE_ROW_HEIGHT);
*/  
  $x += PDFOC_PRICING_COLUMN_SIZES;
  
  $pdf->ezText($PDFOC_TABLE_HEADING_TOTAL_EXCLUDING_TAX[$order->info['languages_id']],PDFOC_TABLE_HEADER_FONT_SIZE,array('justification'=> 'right','aright'=>$x));
  $pdf->ezSetY($pos+PDFOC_PRODUCT_TABLE_ROW_HEIGHT);
/*  
  $x += PDFOC_PRICING_COLUMN_SIZES;
  $pdf->ezText(PDFOC_TABLE_HEADING_TOTAL_INCLUDING_TAX,PDFOC_TABLE_HEADER_FONT_SIZE,array('justification'=> 'right','aright'=>$x));
*/

  $pos -= PDFOC_PRODUCT_TABLE_BOTTOM_MARGIN;

  // Sort through the products
  $cnt_products = 0;
  for ($i = $nextproduct, $n = sizeof($order->products); $i < $n; $i++) {
  /*
			         $order->products[$i]['model'] != "SHF" 
				  && $order->products[$i]['model'] != "CODF" 
				  && $order->products[$i]['model'] != "ECOF" 
				  && $order->products[$i]['model'] != "ESCF" 
				  && $order->products[$i]['model'] != "FRSH" 
*/				  

     if (!( (  $verify_debit->fields['invoice_type'] == "BL"  )
	       &&  (		   ( $order->products[$i]['model']=="SHF" )
                ||	( $order->products[$i]['model']=="CODF" )
				||	( $order->products[$i]['model']=="ECOF" )
				||	( $order->products[$i]['model']=="ESCF" )
				||	( $order->products[$i]['model']=="FRSH" )
				||	( $order->products[$i]['model']=="SHF" )
				) ))
    {				
	    // check whether too far down page to print more products; assume enough margin
	    // to account for a product with wrapped text and a couple of attributes
	    //
	    if ($pos < PDFOC_BOTTOM_MARGIN) {
	       $secondpage = true;
	       return;
	    }

	    $prod_str = $order->products[$i]['qty'] . " x " . $order->products[$i]['name'];

	    PDFOC_change_color(PDFOC_PRODUCT_LISTING_BKGD_COLOR);
	    $pdf->filledRectangle(PDFOC_LEFT_MARGIN,$pos-PDFOC_PRODUCT_TABLE_ROW_HEIGHT,PDFOC_PRODUCT_TABLE_HEADER_WIDTH,PDFOC_PRODUCT_TABLE_ROW_HEIGHT);

	    $x = PDFOC_LEFT_MARGIN + PDFOC_PRODUCT_TABLE_LEFT_MARGIN;
	    $pos = ($pos-PDFOC_PRODUCT_TABLE_ROW_HEIGHT) + PDFOC_PRODUCT_TABLE_BOTTOM_MARGIN;

	    PDFOC_change_color(PDFOC_GENERAL_FONT_COLOR);
	    $truncated_str = $pdf->addTextWrap($x,$pos,PDFOC_PRODUCTS_COLUMN_SIZE,PDFOC_TABLE_HEADER_FONT_SIZE,$prod_str);

	    $pdf->ezSetY($pos+PDFOC_PRODUCT_TABLE_ROW_HEIGHT-PDFOC_PRODUCT_TABLE_BOTTOM_MARGIN);
	    $x += PDFOC_PRODUCTS_COLUMN_SIZE;
		
	    $pdf->ezText(pdfoc_html_cleanup($order->products[$i]['model']),PDFOC_TABLE_HEADER_FONT_SIZE,array('aleft'=>$x));
	    $pdf->ezSetY($pos+PDFOC_PRODUCT_TABLE_ROW_HEIGHT-PDFOC_PRODUCT_TABLE_BOTTOM_MARGIN);

	    $x += PDFOC_MODEL_COLUMN_SIZE;
	    if ( $order->info['orders_status']!=5 )
		{
	      $pdf->ezText("   " . pdfoc_html_cleanup(zen_display_tax_value($order->products[$i]['tax']).' %'),PDFOC_TABLE_HEADER_FONT_SIZE,array('aleft'=>$x));
		}
	    $pdf->ezSetY($pos+PDFOC_PRODUCT_TABLE_ROW_HEIGHT-PDFOC_PRODUCT_TABLE_BOTTOM_MARGIN);
	    $x += PDFOC_TAX_COLUMN_SIZE;
		
	    $x += PDFOC_PRICING_COLUMN_SIZES;
	    if ( $order->info['orders_status']!=5 )
		{
	     	$pdf->ezText(pdfoc_html_cleanup($currencies->format($order->products[$i]['final_price'], true, $order->info['currency'], $order->info['currency_value'])),PDFOC_TABLE_HEADER_FONT_SIZE,array('justification'=> 'right','aright'=>$x));
		}
		else
		{
	     	$pdf->ezText(pdfoc_html_cleanup( $order->products[$i]['reliquat'] ),PDFOC_TABLE_HEADER_FONT_SIZE,array('justification'=> 'right','aright'=>$x));
		}
		
	    $pdf->ezSetY($pos+PDFOC_PRODUCT_TABLE_ROW_HEIGHT-PDFOC_PRODUCT_TABLE_BOTTOM_MARGIN);
/*
	    $x += PDFOC_PRICING_COLUMN_SIZES;	
		$pdf->ezText(pdfoc_html_cleanup($currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value'])),PDFOC_TABLE_HEADER_FONT_SIZE,array('justification'=> 'right', 'aright'=>$x));
	    $pdf->ezSetY($pos+PDFOC_PRODUCT_TABLE_ROW_HEIGHT-PDFOC_PRODUCT_TABLE_BOTTOM_MARGIN);
	  */
	    $x += PDFOC_PRICING_COLUMN_SIZES;
	    if ( $order->info['orders_status']!=5 )
		{	
		   $pdf->ezText(pdfoc_html_cleanup($currencies->format($order->products[$i]['final_price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value'])),PDFOC_TABLE_HEADER_FONT_SIZE,array('justification'=> 'right','aright'=>$x));
		}
		else
		{
	     	$pdf->ezText(pdfoc_html_cleanup( $order->products[$i]['qty'] ),PDFOC_TABLE_HEADER_FONT_SIZE,array('justification'=> 'right','aright'=>$x));
			$cnt_products += $order->products[$i]['qty'];
		}

		
	    $pdf->ezSetY($pos+PDFOC_PRODUCT_TABLE_ROW_HEIGHT-PDFOC_PRODUCT_TABLE_BOTTOM_MARGIN);
/*	
	    $x += PDFOC_PRICING_COLUMN_SIZES;
		$pdf->ezText(pdfoc_html_cleanup($currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value'])),PDFOC_TABLE_HEADER_FONT_SIZE,array('justification'=> 'right','aright'=>$x));
	   */
		$pos -= PDFOC_PRODUCT_TABLE_BOTTOM_MARGIN;

	    if ($truncated_str) {
		
		PDFOC_change_color(PDFOC_PRODUCT_LISTING_BKGD_COLOR);
		$pdf->filledRectangle(PDFOC_LEFT_MARGIN,$pos-PDFOC_PRODUCT_TABLE_ROW_HEIGHT,PDFOC_PRODUCT_TABLE_HEADER_WIDTH,PDFOC_PRODUCT_TABLE_ROW_HEIGHT);
		$pos = ($pos-PDFOC_PRODUCT_TABLE_ROW_HEIGHT) + PDFOC_PRODUCT_TABLE_BOTTOM_MARGIN;
		PDFOC_change_color(PDFOC_GENERAL_FONT_COLOR);
		$reset_x = PDFOC_LEFT_MARGIN + PDFOC_PRODUCT_TABLE_LEFT_MARGIN;
		$pdf->addText($reset_x,$pos,PDFOC_TABLE_HEADER_FONT_SIZE,$truncated_str);
		$pos -= PDFOC_PRODUCT_TABLE_BOTTOM_MARGIN;
		
	    } // EOIF $truncated_str
		
	    if ( ($k = sizeof($order->products[$i]['attributes'])) > 0) {

	      for ($j = 0; $j < $k; $j++) {

	        $attrib_string = '<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
	        
	        if ($order->products[$i]['attributes'][$j]['price'] != '0') {
	          $attrib_string .= ' (' . $order->products[$i]['attributes'][$j]['prefix'] .
	          pdfoc_html_cleanup($currencies->format($order->products[$i]['attributes'][$j]['price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value'])) . ')';
	        }
			
	        $attrib_string .= '</i>';
		  PDFOC_change_color(PDFOC_PRODUCT_LISTING_BKGD_COLOR);
		  $pdf->filledRectangle(PDFOC_LEFT_MARGIN,$pos-PDFOC_PRODUCT_TABLE_ROW_HEIGHT,PDFOC_PRODUCT_TABLE_HEADER_WIDTH,PDFOC_PRODUCT_TABLE_ROW_HEIGHT);
		  $pos = ($pos-PDFOC_PRODUCT_TABLE_ROW_HEIGHT) + PDFOC_PRODUCT_TABLE_BOTTOM_MARGIN;
		  PDFOC_change_color(PDFOC_GENERAL_FONT_COLOR);
		  $reset_x = PDFOC_LEFT_MARGIN + PDFOC_PRODUCT_TABLE_LEFT_MARGIN;

	        if (PDFOC_PRODUCT_ATTRIBUTES_TEXT_WRAP) {
	          $wrapped_str = $pdf->addTextWrap($reset_x,$pos,PDFOC_PRODUCTS_COLUMN_SIZE,PDFOC_PRODUCT_ATTRIBUTES_FONT_SIZE,$attrib_string);
	        } else {
	          $pdf->addText($reset_x,$pos,PDFOC_PRODUCT_ATTRIBUTES_FONT_SIZE,$attrib_string);
	        }

	        $pos -= PDFOC_PRODUCT_TABLE_BOTTOM_MARGIN;
		  			
	        if ($wrapped_str) {
	        
		    PDFOC_change_color(PDFOC_PRODUCT_LISTING_BKGD_COLOR);
		    $pdf->filledRectangle(PDFOC_LEFT_MARGIN,$pos-PDFOC_PRODUCT_TABLE_ROW_HEIGHT,PDFOC_PRODUCT_TABLE_HEADER_WIDTH,PDFOC_PRODUCT_TABLE_ROW_HEIGHT);
		    $pos = ($pos-PDFOC_PRODUCT_TABLE_ROW_HEIGHT) + PDFOC_PRODUCT_TABLE_BOTTOM_MARGIN;
		    PDFOC_change_color(PDFOC_GENERAL_FONT_COLOR);
		    $pdf->addText($reset_x,$pos,PDFOC_PRODUCT_ATTRIBUTES_FONT_SIZE,$wrapped_str);
		    $pos -= PDFOC_PRODUCT_TABLE_BOTTOM_MARGIN;
		    
		  } // EOIF $wrapped_str
		  
		} // EOFOR $j = 0
		
	    } // EOIF $k = sizeof(...
    }    
    $nextproduct++;

  } // EOFOR $i = 0

  $pos -= 1.5; // to match LineStyle below

  // line under Totals column
  //
  $pdf->setLineStyle(1.5);
  $tx = $x -  PDFOC_PRICING_COLUMN_SIZES + 15;
  $pdf->line($tx,$pos,$x+13,$pos);  // tweak this value to match end of your table

  $pos -= PDFOC_SECTION_DIVIDER;
  
  if ( $order->info['orders_status']!=5 )
  {	
  
	  for ($i = $nexttotal, $n = sizeof($order->totals); $i < $n; $i++) {
		
	    // check whether too far down page to print more totals
	    //
	    if ($pos < PDFOC_BOTTOM_MARGIN) {
	       $secondpage = true;
	       return;
	    }

	    $pdf->ezSetY($pos+PDFOC_PRODUCT_TOTALS_LEADING);
	    $x -= PDFOC_PRICING_COLUMN_SIZES;
		//['sort_order'] == 250   $order_totals[$i]['sort_order'] == 250 )
		if ( $order->totals[$i]['class'] == 'ot_total' )
		{
		   $bold_begin = "<b>";
		   $bold_end = "</b>";	   
		}
		else
		{
		   $bold_begin = "";
		   $bold_end = "";	  	
		}
		
	    $pdf->ezText( $bold_begin. pdfoc_html_cleanup(strip_tags($order->totals[$i]['title'])) . $bold_end ,PDFOC_TABLE_HEADER_FONT_SIZE,array('justification'=> 'right','aright'=>$x));
	    $x += PDFOC_PRICING_COLUMN_SIZES;
	    $pdf->ezSetY($pos+PDFOC_PRODUCT_TOTALS_LEADING);
	    $pdf->ezText(pdfoc_html_cleanup( $bold_begin. pdfoc_html_cleanup(strip_tags($order->totals[$i]['text'])) . $bold_end),PDFOC_TABLE_HEADER_FONT_SIZE,array('justification'=> 'right','aright'=>$x));
//    $pdf->addText($x,$pos,PDFOC_PRODUCT_TOTALS_FONT_SIZE,pdfoc_html_cleanup($order->totals[$i]['text']), $order->info['currency_value']);

	    $pos -=PDFOC_PRODUCT_TOTALS_LEADING;
	    $nexttotal++;
	  } // EOFOR $i = $nexttotal
  }
  else
  {
	 $pdf->ezSetY($pos+PDFOC_PRODUCT_TOTALS_LEADING);     
	 $pdf->ezText(pdfoc_html_cleanup( '<b>' . $cnt_products . '</b>'),PDFOC_TABLE_HEADER_FONT_SIZE,array('justification'=> 'right','aright'=>$x));  
  }
  
  $sql = "select order_total value  from orders where database_code='it' and length(entry_tva_intracom)=0 and products_tax=0  and orders_id=".$orders->fields['orders_id'];
  $show_it_footer=exec_select($sql);
  
  // TVA italie adm
  if ( $show_it_footer > 0 )
  {
	  $texte_loi = "IVA italiana da versare a cura del cessionario ai sensi dell’art. 17-ter del DPR 633/72";
	//$pdf->addText  

	  $pdf->roundedRectangle(   30,    20,  530,38   ,    10,$f=0);
	//  $pdf->addText(PDFOC_SOLD_TO_COLUMN_START,$y,PDFOC_SUB_HEADING_FONT_SIZE,"<b>" . $PDFOC_ENTRY_SOLD_TO[$order->info['languages_id']] . "</b>");
	  $pdf->addText(40, 45   ,PDFOC_SUB_HEADING_FONT_SIZE,"<b>" . $texte_loi . "</b>");
	  $montantTVA = round($show_it_footer*0.22,2);
	  $pdf->addText(40, 35   ,PDFOC_SUB_HEADING_FONT_SIZE,"<b>" .'              IVA da Versare :    ' . $montantTVA. " Euros </b>");
  
	 //                                    L  l
  }
  
  $pos -= PDFOC_SECTION_DIVIDER;
//  $pdf->ezText(pdfoc_html_cleanup( $bold_begin. pdfoc_html_cleanup(strip_tags($texte_loi)) . $bold_end),PDFOC_TABLE_HEADER_FONT_SIZE,array('justification'=> 'left','aright'=>$x));
  



  if ($show_comments) {  // print out all comments for this order
  
    $innum = $orders->fields['orders_id'];
    $orders_comments = $db->Execute("select comments,date_added from " . TABLE_ORDERS_STATUS_HISTORY . " where  comments  like '#%' and orders_id = '" . (int)$innum . "' order by date_added desc");

	if ($orders_comments->RecordCount()>0) {
		
	  // resume printing comments where we left off,
	  // if page was split 	
	  for ($i=0; $i<$nextcomment; $i++)
	  {
		  $orders_comments->MoveNext();
	  }
      while (!$orders_comments->EOF) {
    
        if(zen_not_null($orders_comments->fields['comments'])) {

			// check whether too far down page to print more comments
		    //
		    if ($pos < PDFOC_BOTTOM_MARGIN) {
		       $secondpage = true;
		       return;
		    }
          $pdf->ezSetY($pos);
          $cy = $pdf->ezText(zen_date_short($orders_comments->fields['date_added']) ,7); // 7 is font size here
          $pdf->ezText("<b>". $PDFOC_TEXT_COMMENTS[$order->info['languages_id']] . "</b>",PDFOC_COMMENTS_FONT_SIZE);
          $cx = $pdf->getTextWidth(PDFOC_COMMENTS_FONT_SIZE,PDFOC_TEXT_COMMENTS) + PDFOC_LEFT_MARGIN;
          $pdf->ezSetY($cy);
          $y = $pdf->ezText(pdfoc_html_cleanup($orders_comments->fields['comments']),PDFOC_COMMENTS_FONT_SIZE, array('aleft'=>$cx+10));
          $pos = ($y -5);
        
        }  // EOIF zen_not_null
      
        $orders_comments->MoveNext();
        $nextcomment++;
      } // EOWHILE $orders_comments
    
    } // EOIF $orders_comments->RecordCount()

  } // EOIF $show_comments

  // this invoice has been completed, so restore $secondpage and $nextproduct, etc
  $secondpage = false;
  $nextproduct = $nexttotal = $nextcomment = 0;

  // To help you see how elements line up, uncomment the line below to print out a
  // grid over the invoice.
  //require(DIR_PDFOC_INCLUDE . 'templates/' . 'grid.php');

} // EOIF $pageloop
?>
