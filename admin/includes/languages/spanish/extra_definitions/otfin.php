<?php
/*  On-the-Fly Invoice Numbering for Zen Cart v1.2.6d
 *  by Grayson Morris, 2006
 *  based on a program written by Paul Mathot
 *
 * admin/includes/languages/english/otfin.php
 *
 */

define('OTFIN_IMAGE_ORDERS_INVOICE_QUOTE', 'Quote'); // alt text for quote button on admin/orders.php
define('OTFIN_IMAGE_ORDERS_INVOICE_FINAL', 'Crear factura definitiva'); // alt text for invoice button on admin/orders.php
define('OTFIN_IMAGE_ORDERS_INVOICE_VIEW_CREDIT', 'View credit'); // alt text for credit button on admin/orders.php
define('OTFIN_IMAGE_ORDERS_INVOICE_CREATE_CREDIT', 'Devolución'); // alt text for credit button on admin/orders.php
define('OTFIN_TEXT_DATE_DEBIT_INVOICE_CREATED', 'Fecha factura:'); // shown on admin/orders.php
define('OTFIN_TEXT_DATE_CREDIT_INVOICE_CREATED', 'Fecha devolución:'); // shown on admin/orders.php
define('OTFIN_ENTRY_INVOICE_ID', 'Número de factura:');  // printed in invoice
define('OTFIN_ENTRY_INVOICE_DATE', 'Fecha factura:');  // printed in invoice
define('OTFIN_ENTRY_CREDIT_INVOICE', 'CREDIT INVOICE'); // title on credit invoice
define('OTFIN_ENTRY_FINAL_INVOICE', 'FACTURA FINAL'); // title on final invoice
define('OTFIN_ENTRY_QUOTE', 'PRICE QUOTE'); // title on quote
define('OTFIN_LEGEND_CREDIT', 'Credit'); // in legend for orders list
define('OTFIN_LEGEND_INVOICE', 'Factura'); // in legend for orders list
define('OTFIN_ENTRY_AMOUNT_CREDITED', 'Amount Credited:'); // printed in invoice
define('OTFIN_ENTRY_NEW_BALANCE', 'New Balance'); // printed in invoice
define('OTFIN_TEXT_ARE_YOU_SURE', 'Create credit invoice? Once the credit invoice number is assigned, it cannot be deleted.'); // printed in credit button popup

define('OTFIN_ERROR_UNKNOWN_DURING_CREATE', 'An unknown error occurred during invoice id creation.');
define('OTFIN_ERROR_NO_DEBIT_EXISTS', 'No debit invoice exists for this order; you cannot create a credit.');
define('OTFIN_ERROR_USER_CONFIRM_NO', 'No credit invoice has been created.');

// Settings for the invoice, credit, label, packing slip, etc.
//
$otfin_credit_ot[0]='Subtotal:';
$otfin_credit_ot[1]='Gastos de envío:';
$otfin_credit_ot[2]='Impuestos:';
$otfin_credit_ot[3]='Total:';
define('OTFIN_CURRENCY_SYMBOL', '€');
?>
