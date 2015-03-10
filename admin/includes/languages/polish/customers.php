<?php
/**
 *
 * @version $Id: customers.php, v 1.3.7 2007/04/26 11:48:12 $;
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

/* Patrz funkcje wgrywane przez init_general_funcs.php */
define( 'PLEASE_SELECT', 'Wybierz' );
define( 'TYPE_BELOW', 'Wpisz poni¿ej' );

/* wlasne */
define( 'EMAIL_CUSTOMER_STATUS_CHANGE_MESSAGE', 'Twój ststus Klienta zosta³ zaktualizowany. Dziekujemy za zakupy u nas.' );
define( 'EMAIL_CUSTOMER_STATUS_CHANGE_SUBJECT', 'Zmieniono status Klienta' );
define( 'ERROR_CUSTOMER_APPROVAL_CORRECTION1', 'Ostrze¿enie: Twój sklep posiada ustawienia potwierdzenia dodania Klienta bez mo¿liwo¶ci przegl±dania sklepu. Klient zostanie ustawiony w stan oczekiwania na potwierdzenie bez mo¿liwo¶ci przegladania sklepu' );
define( 'ERROR_CUSTOMER_APPROVAL_CORRECTION2', 'Ostrze¿enie: Twój sklep posiada ustawienia potwierdzenia dodania Klienta z mo¿liwo¶ci± przegl±dania sklepu, ale bez cen. Klient zostanie ustawiony w stan oczekiwania na potwierdzenie z mo¿liwo¶ci± przegl±dania sklepu, ale bez cen' );

define( 'HEADING_TITLE', 'Klienci' );

define( 'CUSTOMERS_AUTHORIZATION_0', 'Zatwierdzony' );
define( 'CUSTOMERS_AUTHORIZATION_1', 'Wymagane zatwierdzenie - Musi siê autoryzowaæ, aby przegl±daæ sklep' );
define( 'CUSTOMERS_AUTHORIZATION_2', 'Wymagane zatwierdzenie - Mo¿e przegl±daæ sklep, ale bez cen' );
define( 'CUSTOMERS_AUTHORIZATION_3', 'Wymagane zatwierdzenie - Mo¿e przegl±daæ sklep z cenami, ale nie mo¿e kupowaæ' );
define( 'CUSTOMERS_AUTHORIZATION', 'Status autoryzacji Klienta' );

define( 'ENTRY_NONE', 'Brak' );
define( 'CUSTOMERS_REFERRAL', 'Polecenie klienta<br />1-wszy Kupon Rabatowy' );

define( 'TABLE_HEADING_ID', 'ID' );
define( 'TABLE_HEADING_LASTNAME', 'Nazwisko' );
define( 'TABLE_HEADING_FIRSTNAME', 'Imiê' );
define( 'TABLE_HEADING_COMPANY', 'Firma' );
define( 'TABLE_HEADING_ACCOUNT_CREATED', 'Data utworzenia konta' );
define( 'TABLE_HEADING_LOGIN', 'Ostatnie logowanie' );
define( 'TABLE_HEADING_PRICING_GROUP', 'Grupa cenowa' );
define( 'TABLE_HEADING_AUTHORIZATION_APPROVAL', 'Autoryzacja' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );

define( 'TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Usuwanie klienta' );
define( 'TEXT_DELETE_INTRO', 'Czy na pewno chcesz usun±æ tego klienta?' );
define( 'TEXT_DELETE_REVIEWS', 'Usuñ %s recenzji' );

define( 'TEXT_DATE_ACCOUNT_CREATED', 'Data utworzenia konta: ' );
define( 'TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Ostatnia modyfikacja konta: ' );
define( 'TEXT_INFO_DATE_LAST_LOGON', 'Ostatnie logowanie: ' );
define( 'TEXT_INFO_NUMBER_OF_LOGONS', 'Liczba Logowañ: ' );
define( 'TEXT_INFO_NUMBER_OF_ORDERS', 'Liczba zamówieñ: ' );
define( 'TEXT_INFO_LAST_ORDER', 'Ostatnie zamówienie: ' );
define( 'TEXT_INFO_ORDERS_TOTAL', 'Razem: ' );
define( 'TEXT_INFO_COUNTRY', 'Kraj: ' );
define( 'TEXT_INFO_NUMBER_OF_REVIEWS', 'Liczba recenzji: ' );

?>