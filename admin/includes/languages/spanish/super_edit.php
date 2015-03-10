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
*/

// include the language file for super_orders.php since they overlap so much
//require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . 'super_orders.php');

define('HEADING_TITLE', 'Editing Order');
define('ADDING_TITLE', 'Adding a Product to Order #');

define('TABLE_HEADING_UNIT_PRICE', 'Unit Price');
define('TABLE_HEADING_TOTAL_PRICE', 'Total Price');
define('TABLE_HEADING_DELETE_COMMENTS', 'Delete?');

define('ENTRY_NAME', 'Name:');
define('ENTRY_ADDRESS', 'Address:');
define('ENTRY_POSTCODE', 'Zip Code:');
define('ENTRY_PAYMENT_METHOD_WARNING', 'Warning: Changing the payment method will remove all existing payment data!');

define('BUTTON_UPDATE_ORDER', 'Apply Order Changes');

define('TEXT_DATE_ORDER_ADD_NEW', 'Add a product...');
define('TEXT_NO_ORDER_HISTORY', 'No Order History Available');
define('TEXT_NO_VALID_PAYMENT', 'This order has an invalid payment method');

define('WARNING_STATUS_HISTORY_DELETED', 'Order status removed: ');
define('ERROR_ORDER_DOES_NOT_EXIST', 'Error: Order does not exist.');
define('SUCCESS_ORDER_UPDATED', 'Success: Order has been successfully updated.');

define('ADDPRODUCT_TEXT_CATEGORY_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_PRODUCT', 'Choose product');
define('ADDPRODUCT_TEXT_PRODUCT_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_OPTIONS', 'Choose options');
define('ADDPRODUCT_TEXT_OPTIONS_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_OPTIONS_NOTEXIST', 'No Options. Skipping...');
define('ADDPRODUCT_TEXT_CONFIRM_QUANTITY', 'Qty.');
define('ADDPRODUCT_TEXT_CONFIRM_ADD_NOW', 'Add now');
?>