<?php
/**
 *
 * @version $Id: orders.php, v 1.3.7 2007/04/26 11:48:12 $;
 *
 * @author Zen Cart Development Team
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 *
 * Modyfikacje do ZenCart.pl
 * @author Grupa ZenCart.pl <kontakt@zencart.pl>
 * @copyright Copyright &copy; 2007, ZenCart.pl
 * Wiêcej informacji na stronie projektu {@link http://www.zencart.pl ZenCart.pl} Zajrzyj!
 *
 *
 * @package admin
 *
 */

/* invoice */
define( 'ENTRY_SOLD_TO', 'P£ATNIK: ' );
define( 'ENTRY_SHIP_TO', 'ODBIORCA: ' );

/* wlasne */
define( 'ERROR_ORDER_DOES_NOT_EXIST', 'B³±d: Zamówienie nie istnieje' );
define( 'SUCCESS_ORDER_UPDATED_DOWNLOAD_ON', 'Download was successfully enabled' );
define( 'SUCCESS_ORDER_UPDATED_DOWNLOAD_OFF', 'Download was successfully disabled' );

define( 'EMAIL_TEXT_COMMENTS_UPDATE', '<em>Komentarze do Twojego zamówienia:</em> ' );
define( 'EMAIL_SEPARATOR', '------------------------------------------------------' );
define( 'EMAIL_TEXT_ORDER_NUMBER', 'Numer zamówienia: ' );
define( 'EMAIL_TEXT_INVOICE_URL', 'Szczegó³y zamówienia: ' );
//define( 'EMAIL_TEXT_INVOICE_URL', 'Szczegó³owa faktura: ' );
define( 'EMAIL_TEXT_DATE_ORDERED', 'Data zamówienia: ' );
define( 'EMAIL_TEXT_STATUS_UPDATED', 'Status Twojego zamówienia zosta³ zmieniony na: ' . "\n");
define( 'EMAIL_TEXT_STATUS_LABEL', '<strong>Nowy status:</strong> %s ' . "\n\n");
define( 'EMAIL_TEXT_STATUS_PLEASE_REPLY', 'Je¿eli masz jakiekolwiek pytania odpowiedz na ten email.' . "\n");
define( 'EMAIL_TEXT_SUBJECT', 'Aktualizacja zamówienia' );
define( 'SUCCESS_ORDER_UPDATED', 'Powiod³o siê: Zamówienie zosta³o zaktualizowane.' );
define( 'WARNING_ORDER_NOT_UPDATED', 'Uwaga: Nie ma czego zmieniaæ. Zamówienie nie zosta³o zaktualizowane.' );

define( 'HEADING_TITLE', 'Zamówienia' );
define( 'ENTRY_CUSTOMER', 'Klient: ' );
define( 'TEXT_INFO_IP_ADDRESS', 'Adres IP: ' );
define( 'ENTRY_SHIPPING_ADDRESS', 'Adres wysy³ki: ' );
define( 'ENTRY_BILLING_ADDRESS', 'Adres p³atnika: ' );
define( 'ENTRY_ORDER_ID', 'Numer zamówienia: ' );
define( 'ENTRY_DATE_PURCHASED', 'Data zakupu: ' );
define( 'ENTRY_PAYMENT_METHOD', 'Sposób p³atno¶ci: ' );
define( 'ENTRY_CREDIT_CARD_TYPE', 'Rodzaj karty kredytowej: ' );
define( 'ENTRY_CREDIT_CARD_OWNER', 'W³a¶ciciel karty: ' );
define( 'ENTRY_CREDIT_CARD_NUMBER', 'Numer karty: ' );
define( 'TEXT_MASK_CC_NUMBER', 'Maskowanie numeru' );
define( 'ENTRY_CREDIT_CARD_CVV', 'Numer CVV karty: ' );
define( 'TEXT_DELETE_CVV_REPLACEMENT', 'Usuniêty' );
define( 'TEXT_DELETE_CVV_FROM_DATABASE', 'Usuñ numer CVV z bazy' );
define( 'ENTRY_CREDIT_CARD_EXPIRES', 'Data wa¿no¶ci karty: ' );
define( 'TABLE_HEADING_PRODUCTS', 'Produkt' );
define( 'TABLE_HEADING_PRODUCTS_MODEL', 'Model' );
define( 'TABLE_HEADING_TAX', 'Stawka podatku' );
define( 'TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Cena (netto)' );
define( 'TABLE_HEADING_PRICE_INCLUDING_TAX', 'Cena (brutto)' );
define( 'TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Warto¶æ (netto)' );
define( 'TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Warto¶æ (brutto)' );
define( 'TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;<span class="alert">DARMOWO</span>' );

define( 'TEXT_DOWNLOAD_AVAILABLE', 'Pobieranie' );
define( 'TEXT_DOWNLOAD_EXPIRED', 'Wa¿no¶æ' );
define( 'TEXT_DOWNLOAD_MISSING', 'Brak na serwerze' );
define( 'IMAGE_ICON_STATUS_CURRENT', 'Status - dostêpne' );
define( 'IMAGE_ICON_STATUS_EXPIRED', 'Status - wa¿ne' );
define( 'IMAGE_ICON_STATUS_MISSING', 'Status - pominiête' );
define( 'TEXT_DOWNLOAD_TITLE', 'Ststus zamówienia pobierania' );
define( 'TEXT_DOWNLOAD_STATUS', 'Status' );
define( 'TEXT_DOWNLOAD_FILENAME', 'Plik' );
define( 'TEXT_DOWNLOAD_MAX_DAYS', 'Dni' );
define( 'TEXT_DOWNLOAD_MAX_COUNT', 'Pobrañ' );

define( 'TABLE_HEADING_DATE_ADDED', 'Data dodania' );
define( 'TABLE_HEADING_CUSTOMER_NOTIFIED', 'Klient poinformowany' );
define( 'TABLE_HEADING_STATUS', 'Status' );
define( 'TABLE_HEADING_COMMENTS', 'Komentarze' );
define( 'TEXT_NO_ORDER_HISTORY', 'Brak historii zamówienia' );

define( 'ENTRY_STATUS', 'Status: ' );
define( 'ENTRY_NOTIFY_CUSTOMER', 'Poinformuj klienta: ' );
define( 'ENTRY_NOTIFY_COMMENTS', 'Do³±cz komentarze: ' );

define( 'HEADING_TITLE_SEARCH', 'ID zamówienia: ' );
define( 'HEADING_TITLE_STATUS', 'Status zamówienia: ' );
define( 'TEXT_ALL_ORDERS', 'Wszystkie zamówienia' );
define( 'TEXT_BILLING_SHIPPING_MISMATCH', 'Adres P³atnika i adres Wysy³ki nie s± takie same ' );

define( 'TABLE_HEADING_ORDERS_ID', 'ID' );
define( 'TABLE_HEADING_PAYMENT_METHOD', 'P³atno¶æ<br />Wysy³ka' );
define( 'TABLE_HEADING_CUSTOMERS', 'Klient' );
define( 'TABLE_HEADING_ORDER_TOTAL', 'Warto¶æ zamówienia' );
define( 'TABLE_HEADING_DATE_PURCHASED', 'Data zakupu' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );

define( 'TEXT_INFO_HEADING_DELETE_ORDER', 'Usuñ zamówienie' );
define( 'TEXT_INFO_DELETE_INTRO', 'Czy jeste¶ pewien ¿e chcesz usun±æ to zamówienie?' );
define( 'TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Przywróæ produkty z zamówienia do sklepu' );

define( 'TEXT_DATE_ORDER_CREATED', 'Data z³o¿enia zamówienia: ' );
define( 'TEXT_DATE_ORDER_LAST_MODIFIED', 'Ostatnia modyfikacja: ' );
define( 'TEXT_INFO_PAYMENT_METHOD', 'Sposób p³atno¶ci: ' );
define( 'ENTRY_SHIPPING', 'Wysy³ka: ' );
define( 'TEXT_MORE', '... wiêcej' );

/**/
define('TABLE_HEADING_TYPE', 'Rodzaj zamówienia');
define('TABLE_HEADING_QUANTITY', 'Ilo¶æ');

define('TABLE_HEADING_TOTAL', 'Suma');

define('ENTRY_DELIVERY_TO', 'Dostarczyæ do:');
define('ENTRY_SUB_TOTAL', 'Podsuma:');
define('ENTRY_TAX', 'Podatek:');
define('ENTRY_TOTAL', 'Suma:');
define('ENTRY_DATE_LAST_UPDATED', 'Data ostatniej zmiany:');
define('ENTRY_PRINTABLE', 'Wydrukuj fakturê');

define('TEXT_PAID', 'Zap³acono');
define('TEXT_UNPAID', 'Niezap³acono');

?>