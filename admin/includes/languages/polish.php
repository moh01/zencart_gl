<?php
/**
 *
 * @version $Id: polish.php, v 1.3.7 2007/04/26 11:48:12 $;
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

// Global entries for the <html> tag
define( 'HTML_PARAMS','dir="ltr" lang="pl"' );

/* Patrz funkcje wgrywane przez init_general_funcs.php */
// charset for web pages and emails
define( 'CHARSET', 'iso-8859-2' );

// RedHat6.0: 'pl_PL'
// FreeBSD 4.0: 'pl_PL.ISO_8859-2'
// win32: 'polish'
//setlocale(LC_TIME, 'pl_PL.ISO_8859-2' );
setlocale( LC_TIME, 'polish'  );
define( 'DATE_FORMAT_SHORT', '%d/%m/%Y' ); // uzywane w funkcji strftime()
define( 'DATE_FORMAT_LONG', '%A %d %B, %Y' ); // uzywane w funkcji strftime()
define( 'DATE_FORMAT', 'd/m/Y' ); // uzywane w funkcji strftime()
define( 'PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s' ); // uzywane w funkcji strftime()
define( 'DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S' );
define( 'DATE_FORMAT_SPIFFYCAL', 'dd/MM/yyyy' ); // uzyj tylko 'dd', 'MM' i 'yyyy'

// Zwraca date w formacie raw
// $date ma format mm/dd/yyyy
// data raw ma format YYYYMMDD lub DDMMYYYY
function zen_date_raw( $date, $reverse = false ) {
    if ( $reverse ) {
        return substr( $date, 0, 2 ) . substr( $date, 3, 2 ) . substr( $date, 6, 4  );
    } else {
        return substr( $date, 6, 4 ) . substr( $date, 3, 2 ) . substr( $date, 0, 2  );
    }
}

// include template specific meta tags defines
if ( $template_dir != '' ) {
	if ( file_exists( DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/meta_tags.php' ) ) {
	    $template_dir_select = $template_dir . '/';
	} else {
	    $template_dir_select = '';
	}
}

/**********  MOJ DEBUG  **********/
$debugOutput .= '<span style="color: #575757; font-size: 12px; font-weight: bold;">LG_POLISH: </span><span style="color: #ff6600; font-size: 12px; font-weight: bold;">' . DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'meta_tags.php' . '</span><br />';
require( DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'meta_tags.php' );
//die(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'meta_tags.php' );

/* Dla klasy shopping_cart.php */
define( 'WARNING_NO_FILE_UPLOADED', 'Ostrze¿enie: Nie wybrano pliku do wgrania!' );
define( 'ERROR_FILETYPE_NOT_ALLOWED', 'B³±d: Wgrywanie tego typu plików jest zabronione  %s' );
define( 'SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Powiod³o siê: Plik zosta³ pomy¶lnie zapisany %s' );
define( 'ERROR_FILE_NOT_SAVED', 'B³±d: Plik nie zosta³ zapisany.' );
define( 'ERROR_DESTINATION_NOT_WRITEABLE', 'B³±d: Obiekt docelowy nie ma praw zapisu %s' );
define( 'ERROR_DESTINATION_DOES_NOT_EXIST', 'B³±d: Obiekt docelowy nie istnieje %s' );

/* Dla klasy split_page_results.php */
define( 'PREVNEXT_BUTTON_PREV', '&lt;&nbsp;wstecz' );
define( 'PREVNEXT_BUTTON_NEXT', 'dalej&nbsp;&gt;' );
define( 'TEXT_RESULT_PAGE', 'Strona %s z %d' );

/* Patrz funkcje wgrywane przez init_general_funcs.php */
define( 'TEXT_TOP', 'g³ówna' );
define( 'TEXT_NONE', '--brak--' );
define( 'TEXT_DEFAULT', 'domy¶lnie' );
define( 'TEXT_MODEL', 'Model: ' );
define( 'TEXT_INFO_SET_MASTER_CATEGORIES_ID', 'B³êdne ID g³ównej kategorii' );
define( 'TEXT_INFO_ID', ' ID ' );
/* prices */
define( 'PRODUCT_PRICE_DISCOUNT_PREFIX', 'Oszczêdzasz: ' );
define( 'PRODUCT_PRICE_DISCOUNT_AMOUNT', '' );
define( 'PRODUCT_PRICE_DISCOUNT_PERCENTAGE', '%' );
define( 'PRODUCT_PRICE_SALE', 'Po obni¿ce: ' );
define( 'PRODUCTS_PRICE_IS_FREE_TEXT', 'Darmowy' );
define( 'PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT', 'Cena na telefon' );
define( 'PRODUCTS_QUANTITY_MIN_TEXT_LISTING', 'Min: ' );
define( 'PRODUCTS_QUANTITY_UNIT_TEXT_LISTING', 'Sztuk: ' );
define( 'TEXT_PRODUCTS_MIX_OFF', '*Brak opcji Mix' );
define( 'TEXT_PRODUCTS_MIX_ON', '*Opcje Mix' );
define( 'PRODUCTS_QUANTITY_MAX_TEXT_LISTING', 'Max:' );
/* prices */
define( 'DEDUCTION_TYPE_DROPDOWN_0', 'Obni¿ka kwotowa' );
define( 'DEDUCTION_TYPE_DROPDOWN_1', 'Obni¿ka procentowa' );
define( 'DEDUCTION_TYPE_DROPDOWN_2', 'Nowa cena' );
/* html_output */
define( 'TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Wymagane</span>' );

define( 'EMAIL_SEND_FAILED', 'B£¡D: B³±d wysy³ania emaila do: "%s" <%s> z tematem: "%s"' );
/* init_errors */
define( 'ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'B³±d: Obecnie nie ma ustawionej domy¶lnej waluty. Proszê jak±¶ wybraæ: Panel Admina->Lokalizacja->Waluty' );
define( 'ERROR_NO_DEFAULT_LANGUAGE_DEFINED', 'B³±d: Obecnie nie ma ustawionego domy¶lnego jêzyka. Proszê jaki¶ wybraæ: Panel Admina->Lokalizacja->Jêzyki' );
define( 'WARNING_FILE_UPLOADS_DISABLED', 'Uwaga: Wgrywanie plików na serwer jest zablokowane w pliku konfiguracyjnym PHP php.ini.' );
define( 'ADMIN_DEMO_ACTIVE', 'Uwaga jeste¶ w trybie DEMO - Niektóre ustawienia zosta³y wy³±czone' );
define( 'ADMIN_DEMO_ACTIVE_EXCLUSION', 'Uwaga jeste¶ w trybie DEMO - wprowadzane zmiany nie zostan± uwzglêdnione' );
define( 'WARNING_ADMIN_DOWN_FOR_MAINTENANCE', '<strong>OSTRZE¯ENIE:</strong> Strona jest obecnie w konserwacji ...<br />UWAGA: Nie mo¿esz testowaæ wiêkszo¶ci modu³ów p³atno¶ci i wysy³ki' );
define( 'ERROR_ADMIN_SECURITY_WARNING', 'Ostrze¿enie: Twój login Admina nie jest bezpieczny... dopóki nie zmienisz loginu Admina <admin> lub go nie usuniesz albo nie zmienisz: bêdziesz pracowaæ w trybie DEMO<br />Login powienien byæ zmieniony tak szybko jak to jest mo¿liwe, aby zapewniæ bezpieczeñswo sklepu<br />Przejd¼ do Narzêdzia->Administratorzy by zmieniæ login i has³o.<br />Wiêcej informacji na temat bezpieczeñstwa znajdziesz w katalogu /docs' );
/* init_html_editor */
define( 'EDITOR_NONE', 'Tekstowy' );

/* header.php */
define( 'WARN_DATABASE_VERSION_PROBLEM', 'true' ); //w³/wy³ pokazywanie b³êdów bazy
define( 'WARNING_DATABASE_VERSION_OUT_OF_DATE', 'Twoja baza wymaga aktualizacji. Zobacz Narzêdzia->Informacje o serwerze, any sprawdziæ wersjê.' );
define( 'ERROR_PAYMENT_MODULES_NOT_DEFINED', 'UWAGA: Nie aktywowano ¿adnej formy p³atno¶ci. Przejd¼ do Modu³y->P³atno¶ci.' );
define( 'ERROR_SHIPPING_MODULES_NOT_DEFINED', 'UWAGA: Nie aktywowano ¿adnego modu³u wysy³ki. Przejd¼ do Modu³y->Wysy³ka.' );
define( 'TEXT_EZPAGES_STATUS_HEADER_ADMIN', 'OSTRZE¯ENIE: Nag³ówek dla strony EZ w³±czony tylko dla IP Admina' );
define( 'TEXT_EZPAGES_STATUS_FOOTER_ADMIN', 'OSTRZE¯ENIE: Stopka dla strony EZ w³±czona tylko dla IP Admina' );
define( 'TEXT_EZPAGES_STATUS_SIDEBOX_ADMIN', 'OSTRZE¯ENIE: Boxy dla strony EZ w³±czone tylko dla IP Admina' );
define( 'ERROR_EDITORS_FOLDER_NOT_FOUND', 'Wybrano edytor HTML w opcjach \'Mój sklep\' ale katalog edytora w katalogu \'/editors/\' nie istnieje. Wy³±cz opcjê HTML lub wgraj pliki swojego edytora do katalogu \'' . DIR_WS_CATALOG . 'editors/\'' );
define( 'WARNING_ADMIN_ACTIVITY_LOG_RECORDS', 'OSTRZE¯ENIE: Tabela dla logów aktywno¶ci Admina posiada wiêcej ni¿ 50,000 rekordów i powinna byæ wyczyszczona ... ' );
define( 'WARNING_ADMIN_ACTIVITY_LOG_DATE', 'OSTRZE¯ENIE: Tabela dla logów aktywno¶ci Admina posiada rekordy starsze ni¿ 2 miesi±ce i powinna byæ wyczyszczona ... ' );
define( 'TEXT_VERSION_CHECK_CURRENT', 'Twoja wersja ZenCart.pl wygl±da na aktualn±.' );
define( 'TEXT_VERSION_CHECK_NEW_VER', 'Dostêpna nowa wersja v' );
define( 'TEXT_VERSION_CHECK_NEW_PATCH', 'Nowa POPRAWKA jest dostêpna: v' );
define( 'TEXT_VERSION_CHECK_PATCH', 'poprawka' );
define( 'TEXT_VERSION_CHECK_DOWNLOAD', '¦ci±gnij tutaj' );
define( 'SHOW_GV_QUEUE', true ); //pokazuj kolejke kuponow
// wyswietlanie naglowka
define( 'TEXT_SHOW_GV_QUEUE', '%s czeka na potwierdzenie ' );
// belka 1
define( 'DEFINE_LANGUAGE', 'Wybierz Jêzyk:' );
define( 'HEADER_TITLE_TOP', 'Panel Admina' );
define( 'HEADER_TITLE_ONLINE_CATALOG', 'Sklep' );
define( 'HEADER_TITLE_SUPPORT_SITE', 'Strona Pomocy' );
define( 'HEADER_TITLE_VERSION', 'Informacje o Serwerze' );
define( 'HEADER_TITLE_LOGOFF', 'Wyloguj' );
// belka 2 (menu)
// configuration_dhtml.php
define( 'BOX_HEADING_CONFIGURATION', 'Konfiguracja' );
// catalog_dhtml.php
define( 'BOX_HEADING_CATALOG', 'Katalog Produktów' );
define( 'BOX_CATALOG_PRODUCT_TYPES', 'Rodzaje produktów' );
define( 'BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategorie/Produkty' );
define( 'BOX_CATALOG_CATEGORIES_OPTIONS_NAME_MANAGER', 'Cechy produktów' );
define( 'BOX_CATALOG_CATEGORIES_OPTIONS_VALUES_MANAGER', 'Warto¶ci cech produktów' );
define( 'BOX_CATALOG_PRODUCT_OPTIONS_NAME', 'Sortowanie nazw cech' );
define( 'BOX_CATALOG_PRODUCT_OPTIONS_VALUES', 'Sortowanie warto¶ci cech ' );
define( 'BOX_CATALOG_CATEGORIES_ATTRIBUTES_CONTROLLER', 'Manager cech produktów' );
define( 'BOX_CATALOG_PRODUCTS_PRICE_MANAGER', 'Manager cen' );
define( 'BOX_CATALOG_CATEGORIES_ATTRIBUTES_DOWNLOADS_MANAGER', 'Manager pobierania' );
define( 'BOX_CATALOG_MANUFACTURERS', 'Producenci' );
define( 'BOX_CATALOG_REVIEWS', 'Recenzje' );
define( 'BOX_CATALOG_PRODUCTS_EXPECTED', 'Produkty oczekiwane' );
define( 'BOX_CATALOG_FEATURED', 'Produkty polecane' );
define( 'BOX_CATALOG_SPECIALS', 'Promocje' );
define( 'BOX_CATALOG_SALEMAKER', 'Obni¿ki' );
// customers_dhtml.php
define( 'BOX_HEADING_CUSTOMERS', 'Klienci' );
define( 'BOX_CUSTOMERS_CUSTOMERS', 'Klienci' );
define( 'BOX_CUSTOMERS_ORDERS', 'Zamówienia' );
define( 'BOX_CUSTOMERS_GROUP_PRICING', 'Grupy cenowe' );
define( 'BOX_CUSTOMERS_PAYPAL', 'PayPal' );
// taxes_dhtml.php
define( 'BOX_HEADING_LOCATION_AND_TAXES', 'Podatki/Strefy' );
define( 'BOX_TAXES_COUNTRIES', 'Kraje' );
define( 'BOX_TAXES_ZONES', 'Województwa' );
define( 'BOX_TAXES_GEO_ZONES', 'Strefy podatkowe' );
define( 'BOX_TAXES_TAX_CLASSES', 'Rodzaje podatków' );
define( 'BOX_TAXES_TAX_RATES', 'Stawki podatkowe' );
// localization_dhtml.php
define( 'BOX_HEADING_LOCALIZATION', 'Lokalizacja' );
define( 'BOX_LOCALIZATION_CURRENCIES', 'Waluty' );
define( 'BOX_LOCALIZATION_LANGUAGES', 'Jêzyki' );
define( 'BOX_LOCALIZATION_ORDERS_STATUS', 'Statusy zmówieñ' );
// modules_dhtml.php
define( 'BOX_HEADING_MODULES', 'Modu³y' );
define( 'BOX_MODULES_PAYMENT', 'P³atno¶ci' );
define( 'BOX_MODULES_SHIPPING', 'Wysy³ka' );
define( 'BOX_MODULES_ORDER_TOTAL', 'Zamówienia' );
// reports_dhtml.php
define( 'BOX_HEADING_REPORTS', 'Raporty' );
define( 'BOX_REPORTS_PRODUCTS_PURCHASED', 'Najczê¶ciej kupowane' );
define( 'BOX_REPORTS_PRODUCTS_VIEWED', 'Najczê¶ciej wy¶wietlane' );
define( 'BOX_REPORTS_PRODUCTS_LOWSTOCK', 'Brakuj±ce produkty' );
define( 'BOX_REPORTS_ORDERS_TOTAL', 'Najlepsi klienci' );
define( 'BOX_REPORTS_CUSTOMERS_REFERRALS', 'Polecenia klientów' );
// tools_dhtml.php
define( 'BOX_HEADING_TOOLS', 'Narzêdzia' );
define( 'BOX_TOOLS_EMAIL_WELCOME', 'Email powitalny' );
define( 'BOX_TOOLS_NEWSLETTER_MANAGER', 'Newslettery' );
define( 'BOX_TOOLS_MAIL', 'Wy¶lij email' );
define( 'BOX_TOOLS_TEMPLATE_SELECT', 'Szablony' );
define( 'BOX_TOOLS_LAYOUT_CONTROLLER', 'Zarz±dzanie boxami' );
define( 'BOX_TOOLS_BANNER_MANAGER', 'Manager banerów' );
define( 'BOX_TOOLS_DEFINE_PAGES_EDITOR', 'Strony zdefiniowane' );
define( 'BOX_TOOLS_EZPAGES', 'Strony EZ' );
define( 'BOX_TOOLS_ADMIN', 'Administratorzy' );
define( 'BOX_TOOLS_WHOS_ONLINE', 'Klienci online' );
define( 'BOX_TOOLS_SERVER_INFO', 'Informacje o serwerze' );
define( 'BOX_TOOLS_STORE_MANAGER', 'Manager sklepu' );
define( 'BOX_TOOLS_DEVELOPERS_TOOL_KIT', 'Narzêdzia dla deweloperów' );
define( 'BOX_TOOLS_SQLPATCH', 'Zapyatnia SQL' );
// gv_admin_dhtml.php
define( 'BOX_HEADING_GV_ADMIN', 'Bony/Kupony' );
define( 'BOX_GV_ADMIN_QUEUE',  'Bony oczekuj±ce' );
define( 'BOX_GV_ADMIN_MAIL', 'Wy¶lij maile promocyjne' );
define( 'BOX_GV_ADMIN_SENT', 'Wys³ane bony' );
define( 'BOX_COUPON_ADMIN', 'Zarz±dzanie kuponami' );
define( 'NOT_INSTALLED_TEXT', 'Nie jest zainstalowany' );
// extras_dhtml.php
define( 'BOX_HEADING_EXTRAS', 'Multimedia' );

/* index.php */
define( 'BOX_ENTRY_COUNTER_DATE', 'Licznik wizyt wystartowa³ dnia:' );
define( 'BOX_ENTRY_COUNTER', 'Liczba wizyt:' );

/* configuration.php */
define( 'ERROR_ADMIN_DEMO', 'DEMO... w³a¶ciwo¶æ(ci), które chcesz ustawiæ s± wy³±czone w wersji demo' );
define( 'ERROR_SHIPPING_ORIGIN_ZIP', '<strong>Ostrze¿enie:</strong> Nie zdefiniowano kodu pocztowego dla sklepu. Zobacz konfiguracjê opcji Wysy³ka/Pakowanie.' );
define( 'ERROR_ORDER_WEIGHT_ZERO_STATUS', '<strong>Ostrze¿enie:</strong> Ustawiono darmow± wysy³kê dla wagi= 0, ale modu³ darmowej wysy³ki nie jest w³±czony' );
define( 'ERROR_USPS_STATUS', '<strong>Ostrze¿enie:</strong> Modu³ wysy³ki USPS nie posiada prawid³owych danych wej¶ciowych lub jest w³±czony TESTOWO i nie pracuje prawid³owo.<br />Skontaktuj siê z USPS i dokonaj aktywacji/rejestracji swojej strony. 1-800-344-7779 lub icustomercare@usps.com' );
define( 'ERROR_SHIPPING_CONFIGURATION', '<strong>B³±d konfiguracji wysy³ki!</strong>' );
define( 'TITLE_KEY', 'Klucz: ' );

/* product_types.php */
define( 'TEXT_DISPLAY_NUMBER_OF_PRODUCT_TYPES', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> rodzajów produktów)' );

/* categories */
define( 'ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'B³±d: Katalog obrazków kategorii nie istnieje: ' . DIR_FS_CATALOG_IMAGES );
define( 'ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'B³±d: Katalog obrazków kategorii nie ma praw do zapisu: ' . DIR_FS_CATALOG_IMAGES );
define( 'TEXT_LEGEND', 'LEGENDA: ' );
define( 'TEXT_LEGEND_STATUS_OPIS', 'Status ' );
define( 'TEXT_LEGEND_STATUS_OFF', 'Wy³±czone ' );
define( 'IMAGE_ICON_STATUS_OFF', 'Wy³±czone' );
define( 'TEXT_LEGEND_STATUS_ON', 'W³±czone ' );
define( 'IMAGE_ICON_STATUS_ON', 'W³±czone' );
define( 'TEXT_LEGEND_LINKED', 'Produkt dowi±zany' );
define( 'TEXT_LEGEND_META_TAGS', 'Zdefiniowane MetaTagi:' );
define( 'TEXT_YES', 'Tak' );
define( 'TEXT_NO', 'Nie' );
define( 'TEXT_EDITOR_INFO', 'Edytor' );
define( 'TEXT_SORT_CATEGORIES_SORT_ORDER_PRODUCTS_NAME', 'Sortowanie ustalone' );
define( 'TEXT_SORT_CATEGORIES_NAME', 'Nazwa kategorii' );
define( 'TEXT_SORT_PRODUCTS_SORT_ORDER_PRODUCTS_NAME', 'Sortowanie ustalone' );
define( 'TEXT_SORT_PRODUCTS_NAME', 'Nazwa produktu' );
define( 'TEXT_SORT_PRODUCTS_MODEL', 'Model produktu' );
define( 'TEXT_SORT_PRODUCTS_QUANTITY', 'Ilo¶æ produktów+, Nazwa produktu' );
define( 'TEXT_SORT_PRODUCTS_QUANTITY_DESC', 'Ilo¶æ produktów-, Nazwa produktu' );
define( 'TEXT_SORT_PRODUCTS_PRICE', 'Cena produktu+, Nazwa produktu' );
define( 'TEXT_SORT_PRODUCTS_PRICE_DESC', 'Cena produktu-, Nazwa produktu' );
define( 'TEXT_CATEGORIES_PRODUCTS_SORT_ORDER_INFO', 'Sortowanie Kategorii/Produktów: ' );
define( 'HEADING_TITLE_SEARCH_DETAIL', 'Szukaj: ' );
define( 'TEXT_INFO_SEARCH_DETAIL_FILTER', 'Filtr wyszukiwania: ' );
define( 'CATEGORY_HAS_SUBCATEGORIES', 'UWAGA: Znajdujesz siê w kategorii, która zawiera inne kategorie/podkategorie<br />Nie mo¿na tutaj dodawaæ produktów. Aby dodaæ produkt wejd¼ do kategorii!' );
define( 'TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> produktów)' );
define( 'TEXT_IMAGES_DELETE', '<strong>Usun±æ obrazek?</strong> UWAGA: Zostanie usuniêty obrazek przypisany do produktu, obrazek NIE zostanie usuniêty z serwera: ' );
define( 'TABLE_HEADING_YES', 'Tak' );
define( 'TABLE_HEADING_NO', 'Nie' );
define( 'BUTTON_ADD_PRODUCT_TYPES_SUBCATEGORIES_ON', 'Dodaj z podkategoriami' );
define( 'BUTTON_ADD_PRODUCT_TYPES_SUBCATEGORIES_OFF', 'Dodaj bez podkategorii' );
define( 'ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'B³±d: Kategoria nie mo¿e byæ przeniesiona do podkategorii.' );
define( 'ERROR_CATEGORY_HAS_PRODUCTS', 'B³±d: Kategoria zawiera produkty!<br /><br />Kategoria mo¿e zawieraæ produkty albo podkategorie ale nigdy nie razem!' );
define( 'SUCCESS_CATEGORY_MOVED', 'Powiod³o siê! Kategoria zosta³a pomy¶lnie przeniesiona ...' );
define( 'ERROR_CANNOT_MOVE_CATEGORY_TO_CATEGORY_SELF', 'B³±d: Nie mo¿na przenie¶æ kategorii do samej siebie! ID#' );
define( 'TEXT_VIRTUAL_EDIT', 'Ostrze¿enie: Ten produkt jest oznaczony jako wirtualny i pomija adres wysy³ki<br />Klient nie bêdzie proszony o adres wysy³ki, je¶li wszystkie produkty na zamówieniu bêd± wirtualne' );
define( 'TEXT_FREE_SHIPPING_EDIT', 'Ostrze¿enie: Ten produkt posiada parametr darmowej wysy³ki. Adres wysy³ki jest wymagany<br />Wymaga dzia³aj±cego modu³u darmowej wysy³ki, je¿eli wszsytkie produkty na zamówieniu bêd± mia³y ten status' );

/* products */
define( 'BUTTON_PRODUCTS_TO_CATEGORIES', 'Wstaw produkty do kategorii' );
define( 'TEXT_INFO_ATTRIBUTES_FEATURES_UPDATES', '<strong>Aktualizuj sortowanie dla wszystkich warto¶ci cech produktu</strong><br />do ich domy¶lnych warto¶ci sortowania:<br />' );
define( 'TEXT_MASTER_CATEGORIES_ID', 'G³ówna kategoria produktu: ' );
define( 'TEXT_NEW_PRODUCT', 'Produkt znajduje siê w kategorii: &quot;%s&quot;' );
define( 'TEXT_INFO_META_TAGS_USAGE', '<strong>UWAGA:</strong> Ogólny tytu³ strony zosta³ zdefiniowany w pliku jêzykowym meta_tags.php.' );
define( 'TEXT_INFO_MASTER_CATEGORIES_ID', '<strong>UWAGA: Kategoria g³ówna okre¶la, w której kategorii znajduje siê produkt. Od tej kategorii zale¿± jego cechy<br />Szczególnie istotne, kiedy edytujesz produkt, który znajduje siê w obecnej kategorii, ale jest dowi±zany</strong>' );
define( 'TEXT_CATEGORIES_STATUS_INFO_OFF', '<span class="alert">*Brak ketegorii</span>' );
define( 'TEXT_PRODUCTS_STATUS_INFO_OFF', '<span class="alert">*Brak produktów w tej kategorii</span>' );
define( 'TEXT_VIRTUAL_PREVIEW', 'Ostrze¿enie: Ten produkt jest oznaczony jako wirtualny i pomija adres wysy³ki<br />Klient nie bêdzie proszony o adres wysy³ki, je¶li wszystkie produkty na zamówieniu bêd± wirtualne' );
define( 'TEXT_FREE_SHIPPING_PREVIEW', 'Ostrze¿enie: Ten produkt posiada parametr darmowej wysy³ki. Adres wysy³ki jest wymagany<br />Wymaga dzia³aj±cego modu³u darmowej wysy³ki, je¿eli wszsytkie produkty na zamówieniu bêd± mia³y ten status' );
define( 'ERROR_CANNOT_MOVE_PRODUCT_TO_CATEGORY_SELF', 'B³±d: Nie mo¿na przenie¶æ produktu do tej samej kategorii, w której obecnie siê znajduje' );
define( 'ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'B³±d: Nie mo¿na linkowæ produktów do tej samej kategorii' );
define( 'TEXT_IMAGE_CURRENT', 'Aktualny obrazek: ' );
define( 'TEXT_IMAGES_OVERWRITE', '<br /><strong>Nadpisz istniej±cy obrazek:</strong> ' );
define( 'TEXT_PRODUCTS_IMAGE_MANUAL', '<br /><strong>lub wybierz istniej±cy na serwerze obrazek oraz wpisz jego nazwê, nazwa pliku:</strong> ' );

/* products to categories */
define( 'ERROR_DEFINE_PRODUCTS', 'Ostrze¿enie: Brak zdefiniowanych produktów' );
define( 'ERROR_DEFINE_PRODUCTS_MASTER_CATEGORIES_ID', 'Ostrze¿enie: Dla tego produktu nie ustawiono ID g³ównej kategorii' );
define( 'TEXT_CATEGORIES_PRODUCTS', 'Wybierz kategoriê z produktami ... lub prze³±cz miêdzy produktami' );
define( 'PREV_NEXT_PRODUCT', 'Produkty: ' );
define( 'TEXT_PRICED_BY_ATTRIBUTES', 'Cena zale¿na od cech' );
define( 'TEXT_PRODUCT_TO_VIEW', 'Zaznacz produkt i naci¶nij Wy¶wietl ...' );

/* option_name_manager */
define( 'TEXT_SHOW_OPTION_NAMES_VALUES_COPIER_OFF', 'Ukryj globalne ustawienia' );
define( 'TEXT_SHOW_OPTION_NAMES_VALUES_COPIER_ON', 'Poka¿ globalne ustawienia' );
define( 'TEXT_INFO_OPTION_NAMES_VALUES_COPIER_STATUS', 'Obecnie WY£¡CZONE s±: kopiowanie, dodawanie i usuwanie cech globalnie' );

/* option values manager */
define( 'ERROR_DEFINE_OPTION_NAMES', 'Ostrze¿enie: Brak zdefiniowanych cech produktów' );

/* option values */
define( 'ERROR_DEFINE_OPTION_VALUES', 'Ostrze¿enie: Brak zdefiniowanych warto¶ci cech produktów' );
define( 'TEXT_UPDATE_SORT_ORDERS_OPTIONS', '<strong>Aktualizuj sortowanie dla wszystkich warto¶ci cech produktu do ich domy¶lnych warto¶ci sortowania</strong> ' );

/* attributes controller */
define( 'TEXT_PRODUCT_EDIT', 'EDYTUJ PRODUKT' );
define( 'TEXT_PRODUCTS_PRICE_MANAGER', 'MANAGER CEN' );
define( 'TEXT_PRODUCT_WEIGHT_UNIT', 'kg' );
define( 'TEXT_ONETIME_CHARGE_SYMBOL', ' *' );

/* product price manager */
define( 'TEXT_PRODUCT_DETAILS', 'SZCZEGÓ£Y' );
define( 'TEXT_ATTRIBUTE_EDIT', 'EDYTUJ CECHY' );

/* downloads manager */
define( 'TEXT_DISPLAY_NUMBER_OF_PRODUCTS_DOWNLOADS_MANAGER', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> plików)' );

/* manufactures */
define( 'TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> producentów)' );

/* reviews */
define( 'TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> recenzji)' );

/* products expected */
define( 'TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> produktów oczekiwanych)' );

/* featured */
define( 'ERROR_NOTHING_SELECTED', 'Nic nie zosta³o wybrane... Nie dokonano ¿adnych zmian' );
define( 'TEXT_STATUS_WARNING', '<strong>UWAGA:</strong> status produktów zostanie automatycznie zmieniony na w³±czony/wy³±czony w momencie wprowadzenia daty' );
define( 'TEXT_DISPLAY_NUMBER_OF_FEATURED', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> produktów polecanych)' );

/* specials */
define( 'TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> promocji)' );

/* salemaker.php */
define( 'TEXT_DISPLAY_NUMBER_OF_SALES', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> obni¿ek)' );

/* customers */
define( 'JS_ERROR', 'Podczas przetwarzania formularza wyst±pi³y b³êdy!\nPopraw nastêpuj±ce dane:\n\n' );
define( 'JS_GENDER', '* Musisz wybraæ p³eæ.\n' );
define( 'JS_FIRST_NAME', '* Imiê musi mieæ przynajmniej ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaków.\n' );
define( 'JS_LAST_NAME', '* Nazwisko musi mieæ przynajmniej ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaków.\n' );
define( 'JS_DOB', '* Data urodzenia  musi mieæ format: xx/xx/xxxx (dzieñ/miesi±c/rok).\n' );
define( 'JS_EMAIL_ADDRESS', '* Adres email  musi mieæ przynajmniej ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaków.\n' );
define( 'JS_ADDRESS', '* Ulica  musi mieæ przynajmniej ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaków.\n' );
define( 'JS_POST_CODE', '* Kod pocztowy  musi mieæ ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaków.\n' );
define( 'JS_CITY', '* Miasto  musi mieæ przynajmniej ' . ENTRY_CITY_MIN_LENGTH . ' znaków.\n' );
define( 'JS_STATE', '* Musisz wybraæ województwo.\n' );
define( 'JS_STATE_SELECT', '-- Wybierz --' );
define( 'JS_ZONE', '* Dla tego kraju musisz wybraæ \'Województwo\' z rozwijanej listy.' );
define( 'JS_COUNTRY', '* Musisz wybraæ \'Kraj\'.\n' );
define( 'JS_TELEPHONE', '* Nr telefonu  musi mieæ przynajmniej ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaków.\n' );
define( 'ENTRY_NEWSLETTER_YES', 'Zapisany' );
define( 'ENTRY_NEWSLETTER_NO', 'Wypisany' );
define( 'CATEGORY_PERSONAL', 'Dane Osobowe' );
define( 'ENTRY_GENDER', 'P³eæ: ' );
define( 'MALE', 'Mê¿czyzna' );
define( 'FEMALE', 'Kobieta' );
define( 'ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">wymagane</span>' );
define( 'ENTRY_FIRST_NAME', 'Imiê: ' );
define( 'ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaków</span>' );
define( 'ENTRY_LAST_NAME', 'Nazwisko: ' );
define( 'ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaków</span>' );
define( 'ENTRY_DATE_OF_BIRTH', 'Data Urodzenia: ' );
define( 'ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(np. 21/05/1970)</span>' );
define( 'ENTRY_EMAIL_ADDRESS', 'Adres email: ' );
define( 'ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaków</span>' );
define( 'ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Ten adres email nie jest poprawny!</span>' );
define( 'ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Podany adres email ju¿ istnieje w naszej bazie!</span>' );
define( 'CATEGORY_COMPANY', 'Dane Firmy' );
define( 'ENTRY_COMPANY', 'Nazwa firmy: ' );

define( 'ENTRY_NIP', 'NIP: ' );
define( 'ENTRY_NIP_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_NIP_MIN_LENGTH . ' znaków</span>' );
define( 'ENTRY_NIP_CHECK_ERROR', 'Wprowadzony NIP nie jest prawid³owy' );
define( 'ENTRY_NIP_ERROR_EXISTS', 'Taki NIP ju¿ istnieje w naszej bazie, wprowad¼ inny!' );

define( 'ENTRY_COMPANY_ERROR', '' );
define( 'CATEGORY_ADDRESS', 'Dane Teleadresowe' );
define( 'ENTRY_STREET_ADDRESS', 'Ulica: ' );
define( 'ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaków</span>' );
define( 'ENTRY_SUBURB', 'Dzielnica: ' );
define( 'ENTRY_SUBURB_ERROR', '' );
define( 'ENTRY_POST_CODE', 'kod pocztowy: ' );
define( 'ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaków</span>' );
define( 'ENTRY_CITY', 'Miasto: ' );
define( 'ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' znaków</span>' );
define( 'ENTRY_STATE', 'Województwo: ' );
define( 'ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">wymagane</span>' );
define( 'ENTRY_COUNTRY', 'Kraj: ' );
define( 'ENTRY_COUNTRY_ERROR', '' );
define( 'CATEGORY_CONTACT', 'Dane Kontaktowe' );
define( 'ENTRY_TELEPHONE_NUMBER', 'Numer telefonu: ' );
define( 'ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaków</span>' );
define( 'ENTRY_FAX_NUMBER', 'Numer faksu: ' );
define( 'ENTRY_FAX_NUMBER_ERROR', '' );
define( 'CATEGORY_OPTIONS', 'Opcje' );
define( 'ENTRY_EMAIL_PREFERENCE', 'Preferowany format emaila: ' );
define( 'ENTRY_EMAIL_HTML_DISPLAY', 'HTML' );
define( 'ENTRY_EMAIL_TEXT_DISPLAY', 'TEXT' );
define( 'ENTRY_NEWSLETTER', 'Newsletter: ' );
define( 'ENTRY_NEWSLETTER_ERROR', '' );
define( 'ENTRY_PRICING_GROUP', 'Grupa cenowa: ' );

define( 'SORTOWANIE_ASC_KROTKIE', 'Rosn.' );
define( 'SORTOWANIE_DESC_KROTKIE', 'Mal.' );
define( 'TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> klientów)' );

/* orders */
define( 'TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> zamówieñ)' );

/* group pricing */
define( 'TEXT_DISPLAY_NUMBER_OF_PRICING_GROUPS', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> grup cenowych)' );

/* countries */
define( 'TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> krajów)' );

/* zones */
define( 'TEXT_DISPLAY_NUMBER_OF_ZONES', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> województw)' );

/* tax classes */
define( 'TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> rodzajów podatku)' );

/* tax rates */
define( 'TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> stawek podatkowych)' );

/* geo zones */
define( 'TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> stref podatkowych)' );

/* languages */
define( 'TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> dostêpnych jêzyków)' );
define( 'TEXT_SET_DEFAULT', 'Ustaw jako warto¶æ domy¶ln±' );

/* currencies */
define( 'TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> dostêpnych walut)' );

/* orders status */
define( 'TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> statusów zamówieñ)' );

/* stats products purchased */
define( 'HEADING_TITLE_SEARCH_DETAIL_REPORTS', 'Szukaj produktu(ów) - [kilka rozdziel przecinkiem]' );
define( 'HEADING_TITLE_SEARCH_DETAIL_REPORTS_NAME_MODEL', 'Szukaj nazwy modelu' );

/* newsletters */
define( 'ENTRY_NOTHING_TO_SEND', 'Nie wpisano ¿adnej tre¶ci w wiadomo¶ci' );
define( 'TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> newsletterów)' );

/* mail */
define( 'TEXT_WARNING_HTML_DISABLED', 'Uwaga: U¿ywasz emaili w formie TEKSTOWEJ. Je¶li chcesz wysy³aæ HTML musisz w³±czyæ "u¿yj MIME HTML" w opcjach emaila' );

/* template select */
define( 'TEXT_DISPLAY_NUMBER_OF_TEMPLATES', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> szablonów)' );

/* banner manager */
define( 'TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> banerów)' );

/* define pages editor */
define( 'BOX_TOOLS_DEFINE_CONDITIONS', 'Warunki korzystania' );

/* admin */
define( 'TEXT_DISPLAY_NUMBER_OF_ADMINS', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> adminów)' );

/* gv mail */
define( 'TEXT_GV_NAME', 'Bon towarowy' );
define( 'TEXT_GV_REDEEM', 'Kod realizacji' );
define( 'TEXT_DISPLAY_NUMBER_OF_GIFT_VOUCHERS', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> wys³anych bonów)' );

/* gv queue */
define( 'TEXT_GV_NAMES', 'Bony towarowe' );

/* coupon admin */
define( 'TEXT_DISPLAY_NUMBER_OF_COUPONS', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> kuponów)' );
//zen_draw_date_selector
define( '_JANUARY', 'Styczeñ' );
define( '_FEBRUARY', 'Luty' );
define( '_MARCH', 'Marzec' );
define( '_APRIL', 'Kwiecieñ' );
define( '_MAY', 'Maj' );
define( '_JUNE', 'Czerwiec' );
define( '_JULY', 'Lipiec' );
define( '_AUGUST', 'Sierpieñ' );
define( '_SEPTEMBER', 'Wrzesieñ' );
define( '_OCTOBER', 'Pa¼dziernik' );
define( '_NOVEMBER', 'Listopad' );
define( '_DECEMBER', 'Grudzieñ' );
define( 'TEXT_DISCOUNT_COUPON', 'Kupon rabatowy' );

/* coupon restrict */
define( 'TEXT_DISPLAY_NUMBER_OF_CATEGORIES', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> kategorii)' );

/*
-----------------------------------------------------
*/
define( 'TEXT_IMAGE_OVERWRITE_WARNING','OSTRZE¯ENIE: Istniej±cy obrazek zostanie nadpisany ' );
define( 'DOB_FORMAT_STRING', 'dd/mm/yyyy' );
define( 'BOX_CONFIGURATION_MYSTORE', 'Mój sklep' );
define( 'BOX_CONFIGURATION_LOGGING', 'Logi' );
define( 'BOX_CONFIGURATION_CACHE', 'Cache' );
define( 'BOX_MODULES_PRODUCT_TYPES', 'Rodzaje produktów' );
define( 'BOX_TOOLS_BACKUP', 'Zrzut bazy danych' );
define( 'BOX_TOOLS_CACHE', 'Kontrola cache' );
define( 'BOX_TOOLS_DEFINE_LANGUAGE', 'Definiowanie jêzyków' );
define( 'BOX_TOOLS_FILE_MANAGER', 'Eksplorator plików' );

// define pages editor files
define( 'BOX_TOOLS_DEFINE_MAIN_PAGE', 'Strona g³ówna' );
define( 'BOX_TOOLS_DEFINE_CONTACT_US','Kontakt z nami' );
define( 'BOX_TOOLS_DEFINE_PRIVACY','Polityka prywatno¶ci' );
define( 'BOX_TOOLS_DEFINE_SHIPPINGINFO','Wysy³ka i zwroty' );
define( 'BOX_TOOLS_DEFINE_CHECKOUT_SUCCESS','Przyjêcie zamówienia' );
define( 'BOX_TOOLS_DEFINE_PAGE_2','Strona 2' );
define( 'BOX_TOOLS_DEFINE_PAGE_3','Strona 3' );
define( 'BOX_TOOLS_DEFINE_PAGE_4','Strona 4' );

// javascript messages
define( 'JS_OPTIONS_VALUE_PRICE', '* Nowa cecha produktu musi mieæ warto¶æ\n' );
define( 'JS_OPTIONS_VALUE_PRICE_PREFIX', '* Cena dla nowej cechy produktu musi mieæ prefiks\n' );
define( 'JS_PRODUCTS_NAME', '* Nowy produkt musi mieæ podan± nazwê\n' );
define( 'JS_PRODUCTS_DESCRIPTION', '* Nowy produkt musi miec podany opis\n' );
define( 'JS_PRODUCTS_PRICE', '* Nowy produkt musi mieæ podan± cenê\n' );
define( 'JS_PRODUCTS_WEIGHT', '* Nowy produkt musi mieæ podan± wagê\n' );
define( 'JS_PRODUCTS_QUANTITY', '* Nowy produkt musi mieæ podan± ilo¶æ sztuk\n' );
define( 'JS_PRODUCTS_MODEL', '* Nowy produkt musi mieæ podany model\n' );
define( 'JS_PRODUCTS_IMAGE', '* Nowy produkt musi mieæ obrazek\n' );
define( 'JS_SPECIALS_PRODUCTS_PRICE', '* Dla tego produktu musi byæ ustalona nowa cena\n' );
define( 'JS_PASSWORD', '* Has³o i Potwierdzenie Has³a musi byæ identyczne i musi mieæ przynajmniej ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaków.\n' );
define( 'JS_ORDER_DOES_NOT_EXIST', 'Zamówienie nr %s nie istnieje!' );

define( 'IMAGE_ICON_STATUS_GREEN', 'W³±czone' );
define( 'IMAGE_ICON_STATUS_GREEN_LIGHT', 'W³±czone' );
define( 'IMAGE_ICON_STATUS_RED', 'Wy³±czone' );
define( 'IMAGE_ICON_STATUS_RED_ERROR', 'B³±d' );

define( 'ICON_CURRENT_FOLDER', 'Bie¿±cy katalog' );
define( 'ICON_FILE', 'Plik' );
//define( 'ICON_LOCKED', 'Locked' );
define( 'ICON_PREVIOUS_LEVEL', 'Poprzedni poziom' );
//define( 'ICON_UNLOCKED', 'Unlocked' );

define( 'TEXT_CACHE_CATEGORIES', 'Kategorie' );
define( 'TEXT_CACHE_MANUFACTURERS', 'Producenci' );
define( 'TEXT_CACHE_ALSO_PURCHASED', 'Modu³: zakupiono równie¿' );

define( 'WARNING_BACKUP_CFG_FILES_TO_DELETE', 'OSTRZE¯ENIE: Te pliki powinny byæ usuniête dla bezpieczeñstwa: ' );
define( 'WARNING_INSTALL_DIRECTORY_EXISTS', 'Ostrze¿enie: Istnieje katalog instalatora w lokalizacji: ' . DIR_FS_CATALOG . 'zc_install. Usuñ ten katalog dla bezpieczeñstwa.' );
define( 'WARNING_CONFIG_FILE_WRITEABLE', 'Ostrze¿enie: Twój plik: %s w includes/configure.php posiada nieprawid³owe prawa dostêpu. Ustaw w³a¶ciwe (read-only, CHMOD 644 lub 444).' );

define( 'TEXT_VALID_PRODUCTS_LIST', 'Lista produktów' );
define( 'TEXT_VALID_PRODUCTS_ID', 'ID produktu' );
define( 'TEXT_VALID_PRODUCTS_NAME', 'Nazwa produktu' );
define( 'TEXT_VALID_PRODUCTS_MODEL', 'Model produktu' );
define( 'TEXT_VALID_CATEGORIES_LIST', 'Lista kategorii' );
define( 'TEXT_VALID_CATEGORIES_ID', 'ID kategorii' );
define( 'TEXT_VALID_CATEGORIES_NAME', 'Nazwa kategorii' );

// Min and Units
  define( 'PRODUCTS_QUANTITY_IN_CART_LISTING','W koszyku:' );
  define( 'PRODUCTS_QUANTITY_ADD_ADDITIONAL_LISTING','Dodaj dodatkowe:' );

// text pricing
define( 'TEXT_CHARGES_WORD', 'Obliczona op³ata: ' );
define( 'TEXT_PER_WORD', '<br />Cena za s³owo: ' );
define( 'TEXT_WORDS_FREE', ' S³owo(a) darmowe ' );
define( 'TEXT_CHARGES_LETTERS', 'Obliczona op³ata: ' );
define( 'TEXT_PER_LETTER', '<br />Cena za list: ' );
define( 'TEXT_LETTERS_FREE', ' List(y) darmowe ' );
define( 'TEXT_ONETIME_CHARGES', '*op³ata jednorazowa = ' );
define( 'TEXT_ONETIME_CHARGES_EMAIL', "\t" . '*op³ata jednorazowa = ' );
define( 'TEXT_ATTRIBUTES_QTY_PRICES_HELP', 'Opcja zni¿ki od ilo¶ci' );
define( 'TABLE_ATTRIBUTES_QTY_PRICE_QTY','ILO¦Æ' );
define( 'TABLE_ATTRIBUTES_QTY_PRICE_PRICE','CENA' );
define( 'TEXT_ATTRIBUTES_QTY_PRICES_ONETIME_HELP', 'Opcja zni¿ki od ilo¶ci podlega jednorazowej op³acie' );
define( 'TEXT_INFO_SET_MASTER_CATEGORIES_ID_WARNING', '<strong>OSTRZE¯ENIE:</strong> Ten produkt jest dowi±zany do wielu kategorii ale nie zosta³a ustawiona kategoria g³ówna!' );

// Rich Text / HTML resources
define( 'TEXT_HTML_EDITOR_NOT_DEFINED','Je¶li nie zdefiniowano edytora HTML lub wy³±czono obs³ugê JavaScript mo¿esz wpisaæ tutaj tekst HTML rêcznie.' );
define( 'TEXT_WARNING_CANT_DISPLAY_HTML','<span class = "main">Uwaga: U¿ywasz emaili w formie TEKSTOWEJ. Je¶li chcesz wysy³aæ HTML musisz w³±czyæ "u¿yj MIME HTML" w opcjach emaila</span>' );
define( 'TEXT_EMAIL_CLIENT_CANT_DISPLAY_HTML',"Widzisz tê informacjê poniewa¿ wys³ali¶my emaila w formacie HTML, który Twój klient emailowy nie wy¶wietla." );
define( 'ENTRY_EMAIL_FORMAT_COMMENTS','Wybierz "none" or "optout" disables ALL mail, including order details' );
define( 'ENTRY_EMAIL_FORMAT_COMMENTS', 'Wybranie "brak" lub "optout" blokuje WSZYSTKIE maile, w³±czaj±c szczegó³y zamówienia' );
define( 'ENTRY_EMAIL_NONE_DISPLAY','Nigdy' );
define( 'ENTRY_EMAIL_OPTOUT_DISPLAY','Opted Out of Newsletters' ); //po co?

  define( 'BUTTON_PRODUCTS_TO_CATEGORIES_ALT', 'Kopiuj produkt do wielu kategorii' );

/**********  MOJ DEBUG  **********/
$debugOutput .= '<span style="color: #575757; font-size: 12px; font-weight: bold;">LG_POLISH: </span><span style="color: #ff6600; font-size: 12px; font-weight: bold;">' . DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . FILENAME_EMAIL_EXTRAS . '</span><br />';
require( DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . FILENAME_EMAIL_EXTRAS );

/**********  MOJ DEBUG  **********/
$debugOutput .= '<span style="color: #575757; font-size: 12px; font-weight: bold;">LG_POLISH: </span><span style="color: #ff6600; font-size: 12px; font-weight: bold;">' . zen_get_file_directory( DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/', FILENAME_OTHER_IMAGES_NAMES, 'false' ) . '</span><br />';
include( zen_get_file_directory( DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/', FILENAME_OTHER_IMAGES_NAMES, 'false' ) );

?>