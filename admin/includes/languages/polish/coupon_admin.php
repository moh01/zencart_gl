<?php
/**
 *
 * @version $Id: coupon_admin.php, v 1.3.7 2007/04/26 11:48:12 $;
 *
 * @author Zen Cart Development Team
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 *
 * Modyfikacje do ZenCart.pl
 * @author Grupa ZenCart.pl <kontakt@zencart.pl>
 * @copyright Copyright &copy; 2007, ZenCart.pl
 * Wi�cej informacji na stronie projektu {@link http://www.zencart.pl ZenCart.pl} Zajrzyj!
 *
 *
 * @package admin
 *
 */

/* mail */
define( 'ERROR_NO_CUSTOMER_SELECTED', 'B��d: Nie wybrano odbiorc�w maila' );
define( 'NOTICE_EMAIL_SENT_TO', 'Informacja: Email wys�ano do: %s' );
define( 'ERROR_NO_SUBJECT', 'B��d: Nie wpisano tematu' );
define( 'TEXT_CUSTOMER', 'Klienci: ' );
define( 'TEXT_FROM', 'Nadawca: ' );
define( 'TEXT_SUBJECT', 'Temat: ' );
define( 'TEXT_MESSAGE', 'Wiadomo�� tekstowa: ' );

/* gv mail */
define( 'TEXT_RICH_TEXT_MESSAGE', 'Wiadomo�� formatowana: ' );

/* wlasne */
define( 'TEXT_TO_REDEEM', 'Mo�esz zrealizowa� ten kupon podczas zamawiania. Wpisz kod kuponu w polu i kliknij na przycisk realizacji.' );
define( 'TEXT_VOUCHER_IS', 'Kod kuponu ' );
define( 'TEXT_REMEMBER', 'Nie zgub kodu kuponu! Upewnij si�, �e kod ten przechowujesz w bezpiecznym miejscu.' );
define( 'TEXT_VISIT', 'Odwied� nas na %s' );

define( 'ERROR_DISCOUNT_COUPON_WELCOME', 'Kupon rabatowy NIE mo�e zosta� wy��czony. Ten Kupon rabatowy jest Kuponem powitalnym<br /><br />Zmie� w�asno�ci dla Kuponu powitalnego zanim b�dziesz usuwa�. Patrz Panel Admina->Konfiguracja->Bony/Kupony' );
define( 'SUCCESS_COUPON_DISABLED', 'Powiod�o si�! Kupon rabatowy zosta� w��czony ...' );
define( 'ERROR_DISCOUNT_COUPON_DUPLICATE', 'OSTRZE�ENIE! Istniej� takie same kupony ... Kopiowanie zako�czone dla kodu kuponu: ' );
define( 'SUCCESS_COUPON_DUPLICATE', 'Powiod�o si�! Kupon rabatowy zosta� zduplikowany ...<br /><br />Sprawd� nazw� i daty dla tego Kuponu ...' );
define( 'ERROR_NO_COUPON_NAME', 'Brak nazwy kuponu ' );
define( 'ERROR_NO_COUPON_AMOUNT', 'Brak warto�ci kuponu' );
define( 'ERROR_COUPON_EXISTS', 'Kupon o takim kodzie ju� istnieje' );

define( 'HEADING_TITLE', 'Kupony rabatowe' );
define( 'CUSTOMER_ID', 'ID Klienta' );
define( 'CUSTOMER_NAME', 'Klient' );
define( 'IP_ADDRESS', 'Adres IP' );
define( 'REDEEM_DATE', 'Data realizacji' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );
define( 'COUPON_NAME', 'Nazwa kuponu' );
define( 'TEXT_REDEMPTIONS', 'Wykup' );
define( 'TEXT_REDEMPTIONS_TOTAL', 'W sumie' );
define( 'TEXT_REDEMPTIONS_CUSTOMER', 'Dla tego Klienta' );
define( 'TEXT_COUPON', 'Nazwa kuponu: ' );

define( 'TEXT_COUPON_ANNOUNCE', 'Pragniemy zaproponowa� Ci Kupon rabatowy' );

define( 'COUPON_ZONE_RESTRICTION', 'Restrykcje kuponu dla strefy: ' );
define( 'COUPON_DESC', 'Opis kuponu<br />(widoczny dla Klienta)' );
define( 'COUPON_AMOUNT', 'Warto�� kuponu' );
define( 'COUPON_MIN_ORDER', 'Minimalne zam�wienie dla kuponu' );
define( 'COUPON_FREE_SHIP', 'Darmowa wysy�ka' );
define( 'TEXT_FREE_SHIPPING', 'Darmowa wysy�ka' );
define( 'TEXT_NO_FREE_SHIPPING', 'Brak darmowej wysy�ki' );
define( 'COUPON_CODE', 'Kod kuponu' );
define( 'COUPON_USES_COUPON', 'U�ycia dla kuponu' );
define( 'COUPON_USES_USER', 'U�ycia dla Klienta' );
define( 'COUPON_STARTDATE', 'Data pocz�tku' );
define( 'COUPON_FINISHDATE', 'Data ko�ca' );
define( 'COUPON_BUTTON_CONFIRM', 'Potwierd�' );
define( 'COUPON_BUTTON_CANCEL', 'Rezygnuj' );

define( 'COUPON_NAME_HELP', 'Kr�tka nazwa kuponu' );
define( 'COUPON_DESC_HELP', 'Opis kuponu dla Klienta' );
define( 'COUPON_AMOUNT_HELP', 'Warto�� obni�ki dla kuponu. Wpisz warto�� lub obni�k� procentow� %' );
define( 'COUPON_MIN_ORDER_HELP', 'Minimalne zam�wienie, dla kt�rego obowi�zuje kupon' );
define( 'COUPON_FREE_SHIP_HELP', 'Kupon powoduje, �e zam�wienie b�dzie wys�ane darmowo. Uwaga! Nie uwzgl�dnia coupon_amount, ale respektuje minimaln� kwot� zam�wienia' );
define( 'COUPON_CODE_HELP', 'Mo�esz wpisa� sw�j w�asny kod lub pozostawi� puse dla automatycznego generowania kodu.' );
define( 'COUPON_USES_COUPON_HELP', 'Maksymalna liczba okreslj�ca ile razy kupon mo�e by� u�yty. Pozostaw puste dla braku limit�w.' );
define( 'COUPON_USES_USER_HELP', 'Maksymalna liczba okre�laj�ca ile razy Klient mo�e u�y� kuponu. Pozostaw puste dla braku limit�w.' );
define( 'COUPON_STARTDATE_HELP', 'Data, od kt�rej b�dzie obowi�zywa� kupon' );
define( 'COUPON_FINISHDATE_HELP', 'Data wa�no�ci kuponu' );
define( 'TEXT_COUPON_ZONE_RESTRICTION', 'Restrykcje dla strefy. Klienci z zaznaczonej stefy b�d� mogli realizowa� ten kupon, inni nie.' );
define( 'COUPON_BUTTON_PREVIEW', 'Podgl�d' );

define( 'TEXT_COUPON_ACTIVE', 'Kupony aktywne' );
define( 'TEXT_COUPON_INACTIVE', 'Kupony nieaktywne' );
define( 'TEXT_COUPON_ALL', 'Wszystkie kupony' );
define( 'TEXT_COUPON_STATUS_ACTIVE', 'Aktywny' );
define( 'TEXT_COUPON_STATUS_INACTIVE', 'Nieaktywny' );
define( 'HEADING_TITLE_STATUS', 'Status: ' );
define( 'COUPON_ACTIVE', 'Status' );
define( 'COUPON_START_DATE', 'Starts' );
define( 'COUPON_EXPIRE_DATE', 'Wa�no��' );

define( 'TEXT_CONFIRM_DELETE', 'Czy na pewno usun�� ten kupon?' );

define( 'TEXT_COUPON_NEW', 'U�yj NOWEGO kodu Kuponu rabatowego: ' );
define( 'TEXT_CONFIRM_COPY', 'Czy na pewno chcesz skopiowa� ten Kupon rabatowy do innego?' );

define( 'TEXT_SEE_RESTRICT', 'Rastrykcje uwzgl�dniono' );
define( 'TEXT_UNLIMITED', 'Brak limitu' );
define( 'COUPON_PRODUCTS', 'Dopuszczalna lista produkt�w' );
define( 'COUPON_CATEGORIES', 'Dopuszczalna lista kategorii' );
define( 'DATE_CREATED', 'Data utworzenia' );
define( 'DATE_MODIFIED', 'Ostatnia modyfikacja' );

/**/
define('TOP_BAR_TITLE', 'Statystyki');
define( 'TEXT_SELECT_CUSTOMER', 'Wybierz Klienta' );
define( 'TEXT_ALL_CUSTOMERS', 'Do wszystkich Klient�w' );
define( 'TEXT_NEWSLETTER_CUSTOMERS', 'Do wszystkich subskrybent�w');
define('TEXT_IN_CASE', ' w przypadku, kiedy masz problemy. ');

define('TEXT_ENTER_CODE', ' i wpisz kod ');

//define('COUPON_VALUE', 'Coupon Value');
define('VOUCHER_NUMBER_USED', 'Liczba u�y�');
define('TEXT_HEADING_NEW_COUPON', 'Utw�rz nowy Kupon rabatowy');
define('TEXT_NEW_INTRO', 'Wprowd� dane dla nowego Kuponu rabatowego.<br />');

define('COUPON_PRODUCTS_HELP', 'Lista ID produkt�w, kt�re b�d� uwzgl�dniane dla tego kuponu. Pozostaw puste je�li brak restrykcji.');
define('COUPON_CATEGORIES_HELP', 'Lista ID kategorii, kt�re b�d� uwzgl�dniane dla tego kuponu. Pozostaw puste je�li brak restrykcji.');
define('COUPON_BUTTON_BACK', 'Wstecz');

?>