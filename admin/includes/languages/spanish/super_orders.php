<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS - Version 1.0                          //
//                                                      //
//  By Frank Koehl  (fkoehl@gmail.com)                  //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  super_orders.php is based on:                       //
//  $Id: orders.php 528 2005-2-10 15:56:02Z wilt $      //
//                                                      //
//  All major code changes are enclosed between         //
//  SUPER_CODE_START and SUPER_CODE_END taglines        //
//////////////////////////////////////////////////////////
*/

// Each of these defines has a number associated with it. This
// number corresponds to the number of the status that should
// be applied when the commented action occurs.

// enter a purchase order number
define('AUTO_STATUS_PURCHASE_ORDER', '1');
// enter a check for a purchase order
define('AUTO_STATUS_PO_CHECK', '2');
// enter a standard check
define('AUTO_STATUS_CHECK', '2');
// enter a check for an underpaid order
define('AUTO_STATUS_BALANCE_CHECK', '2');
// enter a check for an overpaid order
define('AUTO_STATUS_REFUND_CHECK', '4');


define('HEADING_TITLE_ORDERS_LISTING', 'Listado de pedidos');
define('HEADING_TITLE_ORDER_DETAILS', 'Detalle del pedido - Núm. ');
define('HEADING_TITLE_SEARCH', 'ID Pedido:');
define('HEADING_TITLE_STATUS', 'Estado:');

define('TABLE_HEADING_ORDERS_ID','ID');
define('TABLE_HEADING_COMMENTS', 'Comentarios');
define('TABLE_HEADING_CUSTOMERS', 'Clientes');
define('TABLE_HEADING_ORDER_TOTAL', 'Total pedido');
define('TABLE_HEADING_DATE_PURCHASED', 'Fecha');
define('TABLE_HEADING_STATUS', 'Estado');
define('TABLE_HEADING_TYPE', 'Tipo de pedido');
define('TABLE_HEADING_ACTION', 'Acción');
define('TABLE_HEADING_QUANTITY', 'Cant.');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Modelo');
define('TABLE_HEADING_PRODUCTS', 'Productos');
define('TABLE_HEADING_TAX', 'Impuestos');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Precio (ex)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Precio (inc)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Total (ex)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Total (inc)');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Cliente notificado');
define('TABLE_HEADING_DATE_ADDED', 'Fecha añadido');

define('ENTRY_PAYMENT_DETAILS', 'Detalles del pago');
define('ENTRY_CUSTOMER_ADDRESS', 'Dirección del cliente:');
define('ENTRY_SOLD_TO', 'Vendido a:');
define('ENTRY_DELIVERY_TO', 'Enviar a:');
define('ENTRY_SHIP_TO', 'Enviar a:');
define('ENTRY_SHIPPING_ADDRESS', 'Dirección de envío:');
define('ENTRY_BILLING_ADDRESS', 'Dirección de facturación:');
define('ENTRY_PAYMENT_METHOD', 'Método de pago:');
define('ENTRY_CREDIT_CARD_TYPE', 'Credit Card Type:');
define('ENTRY_CREDIT_CARD_OWNER', 'Credit Card Owner:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Credit Card Number:');
define('ENTRY_CREDIT_CARD_CVV', 'Credit Card CVV Number:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Credit Card Expires:');
define('ENTRY_SUB_TOTAL', 'Sub-Total:');
define('ENTRY_TAX', 'Impuestos:');
define('ENTRY_SHIPPING', 'Gastos de envío:');
define('ENTRY_TOTAL', 'Total:');
define('ENTRY_DATE_PURCHASED', 'Fecha pedido:');
define('ENTRY_STATUS', 'Estado:');
define('ENTRY_DATE_LAST_UPDATED', 'Modificado el día:');
define('ENTRY_NOTIFY_CUSTOMER', '¿Avisar al cliente?');
define('ENTRY_NOTIFY_COMMENTS', '¿Añadir comentarios?');
define('ENTRY_PRINTABLE', 'Imprimir factura');
define('ENTRY_REBATE_CHECK_INFO', 'Rebate Check Info');
define('ENTRY_BALANCE_CHECK_INFO', 'Balance Check Info');

define('TEXT_ICON_LEGEND', 'Leyenda:');
define('TEXT_BILLING_SHIPPING_MISMATCH', 'La dirección de envío y facturación son distintas ');
define('TEXT_CLICK_TO_EMAIL', '(Click on address to email)');
define('TEXT_INFO_HEADING_DELETE_ORDER', 'Borrar pedido');
define('TEXT_INFO_DELETE_INTRO', 'Borrar pedido ¿seguro?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Añadir los productos al catálogo');
define('TEXT_DATE_ORDER_CREATED', 'Fecha creado:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Modificado:');
define('TEXT_INFO_PAYMENT_METHOD', 'Método de pago');
define('TEXT_PAID', 'Pagado');
define('TEXT_UNPAID', 'No pagado');
define('TEXT_ALL_ORDERS', 'Todos los pedidos');
define('TEXT_NO_ORDER_HISTORY', 'No Order History Available');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Actualización del pedido');
define('EMAIL_TEXT_ORDER_NUMBER', 'Número de pedido:');
define('EMAIL_TEXT_INVOICE_URL', 'Detalle:');
define('EMAIL_TEXT_DATE_ORDERED', 'Fecha pedido:');
define('EMAIL_TEXT_COMMENTS_UPDATE', '<em>Comentarios: </em>');
define('EMAIL_TEXT_STATUS_UPDATED', 'Su pedido ha cambiado de estado:' . "\n");
define('EMAIL_TEXT_STATUS_LABEL', '<strong>Nuevo estado:</strong> %s' . "\n\n");
define('EMAIL_TEXT_STATUS_PLEASE_REPLY', 'Por favor, responda a este email si tiene alguna consulta.' . "\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Error: El pedido no existe.');
define('SUCCESS_ORDER_UPDATED', 'Pedido actualizado.');
define('WARNING_ORDER_NOT_UPDATED', 'Aviso: No hay nada para cambiar.');

define('ENTRY_ORDER_ID','Pedido núm.');
define('TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;<span class="alert">GRATIS</span>');

define('TEXT_DOWNLOAD_TITLE', 'Estado de las descargas');
define('TEXT_DOWNLOAD_FILENAME', 'Fichero');
define('TEXT_DOWNLOAD_MAX_DAYS', 'Días');
define('TEXT_DOWNLOAD_MAX_COUNT', 'Cuenta');

define('TEXT_DOWNLOAD_AVAILABLE', 'Disponible');
define('TEXT_DOWNLOAD_EXPIRED', 'Caducado');
define('TEXT_DOWNLOAD_MISSING', 'No está en nuestro servidor');

// SUPER_CODE_START
define('TEXT_NEW_WINDOW', ' (nueva ventana)');
define('IMAGE_SHIPPING_LABEL', 'Etiqueta destinatario');
define('ICON_ORDER_DETAILS', 'Mostrar los detalles del pedido');
define('ICON_ORDER_EDIT', 'Editar pedido');
define('ICON_ORDER_INVOICE', 'Mostrar factura' . TEXT_NEW_WINDOW);
define('ICON_ORDER_PACKINGSLIP', 'Mostrar albarán' . TEXT_NEW_WINDOW);
define('ICON_ORDER_SHIPPING_LABEL', 'Mostrar etiqueta destinatario' . TEXT_NEW_WINDOW);
define('ICON_ORDER_DELETE', 'Borrar pedido');
define('MINI_ICON_ORDERS', 'Mostrar los pedidos del cliente');
define('MINI_ICON_INFO', 'Mostrar el perfil del cliente');

define('BUTTON_TO_LIST', 'Listado de pedidos');
define('BUTTON_SPLIT', 'Split Packing Slip');
define('SELECT_ORDER_LIST', 'Ir al pedido:');

define('TABLE_HEADING_PAYMENT_METHOD', 'Método de pago');
define('PURCHASE_ORDER_NUMBER', 'PO Number:');
define('PURCHASE_ORDER_DATE_INVOICED', 'Date Invoiced:');
define('PURCHASE_ORDER_LAST_MODIFIED','Last Modified:');

define('CHECK_NUMBER', 'Check Number:');
define('CHECK_NAME', 'Name on Check:');
define('CHECK_AMOUNT', 'Check Amount:');
define('CHECK_DATE_POSTED', 'Date Posted:');
define('CHECK_LAST_MODIFIED', 'Last Modified:');

define('SUCCESS_PO_INSERTED', 'Purchase Order information successfully submitted.');
define('ERROR_PO_MISSING', 'Purchase order number missing.  Please enter the PO number.');
define('SUCCESS_CHECK_INSERTED', 'Check information successfully submitted.');
define('ERROR_CHECK_MISSING', 'Check information missing.  Please enter the check number, name on the check, and the amount.');

define('AUTO_COMMENTS_PO', 'Purchase Order received in our office.  PO #');
define('AUTO_COMMENTS_CHECK', 'Check received in our office.  Check #');
define('AUTO_COMMENTS_IMBALANCE_ALERT', "\nWARNING: Your check value does not match the order total!");
define('AUTO_COMMENTS_BALANCE_CHECK', "Additional check received for outstanding balance.\nCheck #");
define('AUTO_COMMENTS_REFUND_CHECK', "Refund check released for payment overage.\nCheck #");
// SUPER_CODE_END
?>