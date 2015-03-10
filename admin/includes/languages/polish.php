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
 * Wi�cej informacji na stronie projektu {@link http://www.zencart.pl ZenCart.pl} Zajrzyj!
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
define( 'WARNING_NO_FILE_UPLOADED', 'Ostrze�enie: Nie wybrano pliku do wgrania!' );
define( 'ERROR_FILETYPE_NOT_ALLOWED', 'B��d: Wgrywanie tego typu plik�w jest zabronione  %s' );
define( 'SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Powiod�o si�: Plik zosta� pomy�lnie zapisany %s' );
define( 'ERROR_FILE_NOT_SAVED', 'B��d: Plik nie zosta� zapisany.' );
define( 'ERROR_DESTINATION_NOT_WRITEABLE', 'B��d: Obiekt docelowy nie ma praw zapisu %s' );
define( 'ERROR_DESTINATION_DOES_NOT_EXIST', 'B��d: Obiekt docelowy nie istnieje %s' );

/* Dla klasy split_page_results.php */
define( 'PREVNEXT_BUTTON_PREV', '&lt;&nbsp;wstecz' );
define( 'PREVNEXT_BUTTON_NEXT', 'dalej&nbsp;&gt;' );
define( 'TEXT_RESULT_PAGE', 'Strona %s z %d' );

/* Patrz funkcje wgrywane przez init_general_funcs.php */
define( 'TEXT_TOP', 'g��wna' );
define( 'TEXT_NONE', '--brak--' );
define( 'TEXT_DEFAULT', 'domy�lnie' );
define( 'TEXT_MODEL', 'Model: ' );
define( 'TEXT_INFO_SET_MASTER_CATEGORIES_ID', 'B��dne ID g��wnej kategorii' );
define( 'TEXT_INFO_ID', ' ID ' );
/* prices */
define( 'PRODUCT_PRICE_DISCOUNT_PREFIX', 'Oszcz�dzasz: ' );
define( 'PRODUCT_PRICE_DISCOUNT_AMOUNT', '' );
define( 'PRODUCT_PRICE_DISCOUNT_PERCENTAGE', '%' );
define( 'PRODUCT_PRICE_SALE', 'Po obni�ce: ' );
define( 'PRODUCTS_PRICE_IS_FREE_TEXT', 'Darmowy' );
define( 'PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT', 'Cena na telefon' );
define( 'PRODUCTS_QUANTITY_MIN_TEXT_LISTING', 'Min: ' );
define( 'PRODUCTS_QUANTITY_UNIT_TEXT_LISTING', 'Sztuk: ' );
define( 'TEXT_PRODUCTS_MIX_OFF', '*Brak opcji Mix' );
define( 'TEXT_PRODUCTS_MIX_ON', '*Opcje Mix' );
define( 'PRODUCTS_QUANTITY_MAX_TEXT_LISTING', 'Max:' );
/* prices */
define( 'DEDUCTION_TYPE_DROPDOWN_0', 'Obni�ka kwotowa' );
define( 'DEDUCTION_TYPE_DROPDOWN_1', 'Obni�ka procentowa' );
define( 'DEDUCTION_TYPE_DROPDOWN_2', 'Nowa cena' );
/* html_output */
define( 'TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Wymagane</span>' );

define( 'EMAIL_SEND_FAILED', 'B��D: B��d wysy�ania emaila do: "%s" <%s> z tematem: "%s"' );
/* init_errors */
define( 'ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'B��d: Obecnie nie ma ustawionej domy�lnej waluty. Prosz� jak�� wybra�: Panel Admina->Lokalizacja->Waluty' );
define( 'ERROR_NO_DEFAULT_LANGUAGE_DEFINED', 'B��d: Obecnie nie ma ustawionego domy�lnego j�zyka. Prosz� jaki� wybra�: Panel Admina->Lokalizacja->J�zyki' );
define( 'WARNING_FILE_UPLOADS_DISABLED', 'Uwaga: Wgrywanie plik�w na serwer jest zablokowane w pliku konfiguracyjnym PHP php.ini.' );
define( 'ADMIN_DEMO_ACTIVE', 'Uwaga jeste� w trybie DEMO - Niekt�re ustawienia zosta�y wy��czone' );
define( 'ADMIN_DEMO_ACTIVE_EXCLUSION', 'Uwaga jeste� w trybie DEMO - wprowadzane zmiany nie zostan� uwzgl�dnione' );
define( 'WARNING_ADMIN_DOWN_FOR_MAINTENANCE', '<strong>OSTRZE�ENIE:</strong> Strona jest obecnie w konserwacji ...<br />UWAGA: Nie mo�esz testowa� wi�kszo�ci modu��w p�atno�ci i wysy�ki' );
define( 'ERROR_ADMIN_SECURITY_WARNING', 'Ostrze�enie: Tw�j login Admina nie jest bezpieczny... dop�ki nie zmienisz loginu Admina <admin> lub go nie usuniesz albo nie zmienisz: b�dziesz pracowa� w trybie DEMO<br />Login powienien by� zmieniony tak szybko jak to jest mo�liwe, aby zapewni� bezpiecze�swo sklepu<br />Przejd� do Narz�dzia->Administratorzy by zmieni� login i has�o.<br />Wi�cej informacji na temat bezpiecze�stwa znajdziesz w katalogu /docs' );
/* init_html_editor */
define( 'EDITOR_NONE', 'Tekstowy' );

/* header.php */
define( 'WARN_DATABASE_VERSION_PROBLEM', 'true' ); //w�/wy� pokazywanie b��d�w bazy
define( 'WARNING_DATABASE_VERSION_OUT_OF_DATE', 'Twoja baza wymaga aktualizacji. Zobacz Narz�dzia->Informacje o serwerze, any sprawdzi� wersj�.' );
define( 'ERROR_PAYMENT_MODULES_NOT_DEFINED', 'UWAGA: Nie aktywowano �adnej formy p�atno�ci. Przejd� do Modu�y->P�atno�ci.' );
define( 'ERROR_SHIPPING_MODULES_NOT_DEFINED', 'UWAGA: Nie aktywowano �adnego modu�u wysy�ki. Przejd� do Modu�y->Wysy�ka.' );
define( 'TEXT_EZPAGES_STATUS_HEADER_ADMIN', 'OSTRZE�ENIE: Nag��wek dla strony EZ w��czony tylko dla IP Admina' );
define( 'TEXT_EZPAGES_STATUS_FOOTER_ADMIN', 'OSTRZE�ENIE: Stopka dla strony EZ w��czona tylko dla IP Admina' );
define( 'TEXT_EZPAGES_STATUS_SIDEBOX_ADMIN', 'OSTRZE�ENIE: Boxy dla strony EZ w��czone tylko dla IP Admina' );
define( 'ERROR_EDITORS_FOLDER_NOT_FOUND', 'Wybrano edytor HTML w opcjach \'M�j sklep\' ale katalog edytora w katalogu \'/editors/\' nie istnieje. Wy��cz opcj� HTML lub wgraj pliki swojego edytora do katalogu \'' . DIR_WS_CATALOG . 'editors/\'' );
define( 'WARNING_ADMIN_ACTIVITY_LOG_RECORDS', 'OSTRZE�ENIE: Tabela dla log�w aktywno�ci Admina posiada wi�cej ni� 50,000 rekord�w i powinna by� wyczyszczona ... ' );
define( 'WARNING_ADMIN_ACTIVITY_LOG_DATE', 'OSTRZE�ENIE: Tabela dla log�w aktywno�ci Admina posiada rekordy starsze ni� 2 miesi�ce i powinna by� wyczyszczona ... ' );
define( 'TEXT_VERSION_CHECK_CURRENT', 'Twoja wersja ZenCart.pl wygl�da na aktualn�.' );
define( 'TEXT_VERSION_CHECK_NEW_VER', 'Dost�pna nowa wersja v' );
define( 'TEXT_VERSION_CHECK_NEW_PATCH', 'Nowa POPRAWKA jest dost�pna: v' );
define( 'TEXT_VERSION_CHECK_PATCH', 'poprawka' );
define( 'TEXT_VERSION_CHECK_DOWNLOAD', '�ci�gnij tutaj' );
define( 'SHOW_GV_QUEUE', true ); //pokazuj kolejke kuponow
// wyswietlanie naglowka
define( 'TEXT_SHOW_GV_QUEUE', '%s czeka na potwierdzenie ' );
// belka 1
define( 'DEFINE_LANGUAGE', 'Wybierz J�zyk:' );
define( 'HEADER_TITLE_TOP', 'Panel Admina' );
define( 'HEADER_TITLE_ONLINE_CATALOG', 'Sklep' );
define( 'HEADER_TITLE_SUPPORT_SITE', 'Strona Pomocy' );
define( 'HEADER_TITLE_VERSION', 'Informacje o Serwerze' );
define( 'HEADER_TITLE_LOGOFF', 'Wyloguj' );
// belka 2 (menu)
// configuration_dhtml.php
define( 'BOX_HEADING_CONFIGURATION', 'Konfiguracja' );
// catalog_dhtml.php
define( 'BOX_HEADING_CATALOG', 'Katalog Produkt�w' );
define( 'BOX_CATALOG_PRODUCT_TYPES', 'Rodzaje produkt�w' );
define( 'BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategorie/Produkty' );
define( 'BOX_CATALOG_CATEGORIES_OPTIONS_NAME_MANAGER', 'Cechy produkt�w' );
define( 'BOX_CATALOG_CATEGORIES_OPTIONS_VALUES_MANAGER', 'Warto�ci cech produkt�w' );
define( 'BOX_CATALOG_PRODUCT_OPTIONS_NAME', 'Sortowanie nazw cech' );
define( 'BOX_CATALOG_PRODUCT_OPTIONS_VALUES', 'Sortowanie warto�ci cech ' );
define( 'BOX_CATALOG_CATEGORIES_ATTRIBUTES_CONTROLLER', 'Manager cech produkt�w' );
define( 'BOX_CATALOG_PRODUCTS_PRICE_MANAGER', 'Manager cen' );
define( 'BOX_CATALOG_CATEGORIES_ATTRIBUTES_DOWNLOADS_MANAGER', 'Manager pobierania' );
define( 'BOX_CATALOG_MANUFACTURERS', 'Producenci' );
define( 'BOX_CATALOG_REVIEWS', 'Recenzje' );
define( 'BOX_CATALOG_PRODUCTS_EXPECTED', 'Produkty oczekiwane' );
define( 'BOX_CATALOG_FEATURED', 'Produkty polecane' );
define( 'BOX_CATALOG_SPECIALS', 'Promocje' );
define( 'BOX_CATALOG_SALEMAKER', 'Obni�ki' );
// customers_dhtml.php
define( 'BOX_HEADING_CUSTOMERS', 'Klienci' );
define( 'BOX_CUSTOMERS_CUSTOMERS', 'Klienci' );
define( 'BOX_CUSTOMERS_ORDERS', 'Zam�wienia' );
define( 'BOX_CUSTOMERS_GROUP_PRICING', 'Grupy cenowe' );
define( 'BOX_CUSTOMERS_PAYPAL', 'PayPal' );
// taxes_dhtml.php
define( 'BOX_HEADING_LOCATION_AND_TAXES', 'Podatki/Strefy' );
define( 'BOX_TAXES_COUNTRIES', 'Kraje' );
define( 'BOX_TAXES_ZONES', 'Wojew�dztwa' );
define( 'BOX_TAXES_GEO_ZONES', 'Strefy podatkowe' );
define( 'BOX_TAXES_TAX_CLASSES', 'Rodzaje podatk�w' );
define( 'BOX_TAXES_TAX_RATES', 'Stawki podatkowe' );
// localization_dhtml.php
define( 'BOX_HEADING_LOCALIZATION', 'Lokalizacja' );
define( 'BOX_LOCALIZATION_CURRENCIES', 'Waluty' );
define( 'BOX_LOCALIZATION_LANGUAGES', 'J�zyki' );
define( 'BOX_LOCALIZATION_ORDERS_STATUS', 'Statusy zm�wie�' );
// modules_dhtml.php
define( 'BOX_HEADING_MODULES', 'Modu�y' );
define( 'BOX_MODULES_PAYMENT', 'P�atno�ci' );
define( 'BOX_MODULES_SHIPPING', 'Wysy�ka' );
define( 'BOX_MODULES_ORDER_TOTAL', 'Zam�wienia' );
// reports_dhtml.php
define( 'BOX_HEADING_REPORTS', 'Raporty' );
define( 'BOX_REPORTS_PRODUCTS_PURCHASED', 'Najcz�ciej kupowane' );
define( 'BOX_REPORTS_PRODUCTS_VIEWED', 'Najcz�ciej wy�wietlane' );
define( 'BOX_REPORTS_PRODUCTS_LOWSTOCK', 'Brakuj�ce produkty' );
define( 'BOX_REPORTS_ORDERS_TOTAL', 'Najlepsi klienci' );
define( 'BOX_REPORTS_CUSTOMERS_REFERRALS', 'Polecenia klient�w' );
// tools_dhtml.php
define( 'BOX_HEADING_TOOLS', 'Narz�dzia' );
define( 'BOX_TOOLS_EMAIL_WELCOME', 'Email powitalny' );
define( 'BOX_TOOLS_NEWSLETTER_MANAGER', 'Newslettery' );
define( 'BOX_TOOLS_MAIL', 'Wy�lij email' );
define( 'BOX_TOOLS_TEMPLATE_SELECT', 'Szablony' );
define( 'BOX_TOOLS_LAYOUT_CONTROLLER', 'Zarz�dzanie boxami' );
define( 'BOX_TOOLS_BANNER_MANAGER', 'Manager baner�w' );
define( 'BOX_TOOLS_DEFINE_PAGES_EDITOR', 'Strony zdefiniowane' );
define( 'BOX_TOOLS_EZPAGES', 'Strony EZ' );
define( 'BOX_TOOLS_ADMIN', 'Administratorzy' );
define( 'BOX_TOOLS_WHOS_ONLINE', 'Klienci online' );
define( 'BOX_TOOLS_SERVER_INFO', 'Informacje o serwerze' );
define( 'BOX_TOOLS_STORE_MANAGER', 'Manager sklepu' );
define( 'BOX_TOOLS_DEVELOPERS_TOOL_KIT', 'Narz�dzia dla deweloper�w' );
define( 'BOX_TOOLS_SQLPATCH', 'Zapyatnia SQL' );
// gv_admin_dhtml.php
define( 'BOX_HEADING_GV_ADMIN', 'Bony/Kupony' );
define( 'BOX_GV_ADMIN_QUEUE',  'Bony oczekuj�ce' );
define( 'BOX_GV_ADMIN_MAIL', 'Wy�lij maile promocyjne' );
define( 'BOX_GV_ADMIN_SENT', 'Wys�ane bony' );
define( 'BOX_COUPON_ADMIN', 'Zarz�dzanie kuponami' );
define( 'NOT_INSTALLED_TEXT', 'Nie jest zainstalowany' );
// extras_dhtml.php
define( 'BOX_HEADING_EXTRAS', 'Multimedia' );

/* index.php */
define( 'BOX_ENTRY_COUNTER_DATE', 'Licznik wizyt wystartowa� dnia:' );
define( 'BOX_ENTRY_COUNTER', 'Liczba wizyt:' );

/* configuration.php */
define( 'ERROR_ADMIN_DEMO', 'DEMO... w�a�ciwo��(ci), kt�re chcesz ustawi� s� wy��czone w wersji demo' );
define( 'ERROR_SHIPPING_ORIGIN_ZIP', '<strong>Ostrze�enie:</strong> Nie zdefiniowano kodu pocztowego dla sklepu. Zobacz konfiguracj� opcji Wysy�ka/Pakowanie.' );
define( 'ERROR_ORDER_WEIGHT_ZERO_STATUS', '<strong>Ostrze�enie:</strong> Ustawiono darmow� wysy�k� dla wagi= 0, ale modu� darmowej wysy�ki nie jest w��czony' );
define( 'ERROR_USPS_STATUS', '<strong>Ostrze�enie:</strong> Modu� wysy�ki USPS nie posiada prawid�owych danych wej�ciowych lub jest w��czony TESTOWO i nie pracuje prawid�owo.<br />Skontaktuj si� z USPS i dokonaj aktywacji/rejestracji swojej strony. 1-800-344-7779 lub icustomercare@usps.com' );
define( 'ERROR_SHIPPING_CONFIGURATION', '<strong>B��d konfiguracji wysy�ki!</strong>' );
define( 'TITLE_KEY', 'Klucz: ' );

/* product_types.php */
define( 'TEXT_DISPLAY_NUMBER_OF_PRODUCT_TYPES', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> rodzaj�w produkt�w)' );

/* categories */
define( 'ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'B��d: Katalog obrazk�w kategorii nie istnieje: ' . DIR_FS_CATALOG_IMAGES );
define( 'ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'B��d: Katalog obrazk�w kategorii nie ma praw do zapisu: ' . DIR_FS_CATALOG_IMAGES );
define( 'TEXT_LEGEND', 'LEGENDA: ' );
define( 'TEXT_LEGEND_STATUS_OPIS', 'Status ' );
define( 'TEXT_LEGEND_STATUS_OFF', 'Wy��czone ' );
define( 'IMAGE_ICON_STATUS_OFF', 'Wy��czone' );
define( 'TEXT_LEGEND_STATUS_ON', 'W��czone ' );
define( 'IMAGE_ICON_STATUS_ON', 'W��czone' );
define( 'TEXT_LEGEND_LINKED', 'Produkt dowi�zany' );
define( 'TEXT_LEGEND_META_TAGS', 'Zdefiniowane MetaTagi:' );
define( 'TEXT_YES', 'Tak' );
define( 'TEXT_NO', 'Nie' );
define( 'TEXT_EDITOR_INFO', 'Edytor' );
define( 'TEXT_SORT_CATEGORIES_SORT_ORDER_PRODUCTS_NAME', 'Sortowanie ustalone' );
define( 'TEXT_SORT_CATEGORIES_NAME', 'Nazwa kategorii' );
define( 'TEXT_SORT_PRODUCTS_SORT_ORDER_PRODUCTS_NAME', 'Sortowanie ustalone' );
define( 'TEXT_SORT_PRODUCTS_NAME', 'Nazwa produktu' );
define( 'TEXT_SORT_PRODUCTS_MODEL', 'Model produktu' );
define( 'TEXT_SORT_PRODUCTS_QUANTITY', 'Ilo�� produkt�w+, Nazwa produktu' );
define( 'TEXT_SORT_PRODUCTS_QUANTITY_DESC', 'Ilo�� produkt�w-, Nazwa produktu' );
define( 'TEXT_SORT_PRODUCTS_PRICE', 'Cena produktu+, Nazwa produktu' );
define( 'TEXT_SORT_PRODUCTS_PRICE_DESC', 'Cena produktu-, Nazwa produktu' );
define( 'TEXT_CATEGORIES_PRODUCTS_SORT_ORDER_INFO', 'Sortowanie Kategorii/Produkt�w: ' );
define( 'HEADING_TITLE_SEARCH_DETAIL', 'Szukaj: ' );
define( 'TEXT_INFO_SEARCH_DETAIL_FILTER', 'Filtr wyszukiwania: ' );
define( 'CATEGORY_HAS_SUBCATEGORIES', 'UWAGA: Znajdujesz si� w kategorii, kt�ra zawiera inne kategorie/podkategorie<br />Nie mo�na tutaj dodawa� produkt�w. Aby doda� produkt wejd� do kategorii!' );
define( 'TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> produkt�w)' );
define( 'TEXT_IMAGES_DELETE', '<strong>Usun�� obrazek?</strong> UWAGA: Zostanie usuni�ty obrazek przypisany do produktu, obrazek NIE zostanie usuni�ty z serwera: ' );
define( 'TABLE_HEADING_YES', 'Tak' );
define( 'TABLE_HEADING_NO', 'Nie' );
define( 'BUTTON_ADD_PRODUCT_TYPES_SUBCATEGORIES_ON', 'Dodaj z podkategoriami' );
define( 'BUTTON_ADD_PRODUCT_TYPES_SUBCATEGORIES_OFF', 'Dodaj bez podkategorii' );
define( 'ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'B��d: Kategoria nie mo�e by� przeniesiona do podkategorii.' );
define( 'ERROR_CATEGORY_HAS_PRODUCTS', 'B��d: Kategoria zawiera produkty!<br /><br />Kategoria mo�e zawiera� produkty albo podkategorie ale nigdy nie razem!' );
define( 'SUCCESS_CATEGORY_MOVED', 'Powiod�o si�! Kategoria zosta�a pomy�lnie przeniesiona ...' );
define( 'ERROR_CANNOT_MOVE_CATEGORY_TO_CATEGORY_SELF', 'B��d: Nie mo�na przenie�� kategorii do samej siebie! ID#' );
define( 'TEXT_VIRTUAL_EDIT', 'Ostrze�enie: Ten produkt jest oznaczony jako wirtualny i pomija adres wysy�ki<br />Klient nie b�dzie proszony o adres wysy�ki, je�li wszystkie produkty na zam�wieniu b�d� wirtualne' );
define( 'TEXT_FREE_SHIPPING_EDIT', 'Ostrze�enie: Ten produkt posiada parametr darmowej wysy�ki. Adres wysy�ki jest wymagany<br />Wymaga dzia�aj�cego modu�u darmowej wysy�ki, je�eli wszsytkie produkty na zam�wieniu b�d� mia�y ten status' );

/* products */
define( 'BUTTON_PRODUCTS_TO_CATEGORIES', 'Wstaw produkty do kategorii' );
define( 'TEXT_INFO_ATTRIBUTES_FEATURES_UPDATES', '<strong>Aktualizuj sortowanie dla wszystkich warto�ci cech produktu</strong><br />do ich domy�lnych warto�ci sortowania:<br />' );
define( 'TEXT_MASTER_CATEGORIES_ID', 'G��wna kategoria produktu: ' );
define( 'TEXT_NEW_PRODUCT', 'Produkt znajduje si� w kategorii: &quot;%s&quot;' );
define( 'TEXT_INFO_META_TAGS_USAGE', '<strong>UWAGA:</strong> Og�lny tytu� strony zosta� zdefiniowany w pliku j�zykowym meta_tags.php.' );
define( 'TEXT_INFO_MASTER_CATEGORIES_ID', '<strong>UWAGA: Kategoria g��wna okre�la, w kt�rej kategorii znajduje si� produkt. Od tej kategorii zale�� jego cechy<br />Szczeg�lnie istotne, kiedy edytujesz produkt, kt�ry znajduje si� w obecnej kategorii, ale jest dowi�zany</strong>' );
define( 'TEXT_CATEGORIES_STATUS_INFO_OFF', '<span class="alert">*Brak ketegorii</span>' );
define( 'TEXT_PRODUCTS_STATUS_INFO_OFF', '<span class="alert">*Brak produkt�w w tej kategorii</span>' );
define( 'TEXT_VIRTUAL_PREVIEW', 'Ostrze�enie: Ten produkt jest oznaczony jako wirtualny i pomija adres wysy�ki<br />Klient nie b�dzie proszony o adres wysy�ki, je�li wszystkie produkty na zam�wieniu b�d� wirtualne' );
define( 'TEXT_FREE_SHIPPING_PREVIEW', 'Ostrze�enie: Ten produkt posiada parametr darmowej wysy�ki. Adres wysy�ki jest wymagany<br />Wymaga dzia�aj�cego modu�u darmowej wysy�ki, je�eli wszsytkie produkty na zam�wieniu b�d� mia�y ten status' );
define( 'ERROR_CANNOT_MOVE_PRODUCT_TO_CATEGORY_SELF', 'B��d: Nie mo�na przenie�� produktu do tej samej kategorii, w kt�rej obecnie si� znajduje' );
define( 'ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'B��d: Nie mo�na linkow� produkt�w do tej samej kategorii' );
define( 'TEXT_IMAGE_CURRENT', 'Aktualny obrazek: ' );
define( 'TEXT_IMAGES_OVERWRITE', '<br /><strong>Nadpisz istniej�cy obrazek:</strong> ' );
define( 'TEXT_PRODUCTS_IMAGE_MANUAL', '<br /><strong>lub wybierz istniej�cy na serwerze obrazek oraz wpisz jego nazw�, nazwa pliku:</strong> ' );

/* products to categories */
define( 'ERROR_DEFINE_PRODUCTS', 'Ostrze�enie: Brak zdefiniowanych produkt�w' );
define( 'ERROR_DEFINE_PRODUCTS_MASTER_CATEGORIES_ID', 'Ostrze�enie: Dla tego produktu nie ustawiono ID g��wnej kategorii' );
define( 'TEXT_CATEGORIES_PRODUCTS', 'Wybierz kategori� z produktami ... lub prze��cz mi�dzy produktami' );
define( 'PREV_NEXT_PRODUCT', 'Produkty: ' );
define( 'TEXT_PRICED_BY_ATTRIBUTES', 'Cena zale�na od cech' );
define( 'TEXT_PRODUCT_TO_VIEW', 'Zaznacz produkt i naci�nij Wy�wietl ...' );

/* option_name_manager */
define( 'TEXT_SHOW_OPTION_NAMES_VALUES_COPIER_OFF', 'Ukryj globalne ustawienia' );
define( 'TEXT_SHOW_OPTION_NAMES_VALUES_COPIER_ON', 'Poka� globalne ustawienia' );
define( 'TEXT_INFO_OPTION_NAMES_VALUES_COPIER_STATUS', 'Obecnie WY��CZONE s�: kopiowanie, dodawanie i usuwanie cech globalnie' );

/* option values manager */
define( 'ERROR_DEFINE_OPTION_NAMES', 'Ostrze�enie: Brak zdefiniowanych cech produkt�w' );

/* option values */
define( 'ERROR_DEFINE_OPTION_VALUES', 'Ostrze�enie: Brak zdefiniowanych warto�ci cech produkt�w' );
define( 'TEXT_UPDATE_SORT_ORDERS_OPTIONS', '<strong>Aktualizuj sortowanie dla wszystkich warto�ci cech produktu do ich domy�lnych warto�ci sortowania</strong> ' );

/* attributes controller */
define( 'TEXT_PRODUCT_EDIT', 'EDYTUJ PRODUKT' );
define( 'TEXT_PRODUCTS_PRICE_MANAGER', 'MANAGER CEN' );
define( 'TEXT_PRODUCT_WEIGHT_UNIT', 'kg' );
define( 'TEXT_ONETIME_CHARGE_SYMBOL', ' *' );

/* product price manager */
define( 'TEXT_PRODUCT_DETAILS', 'SZCZEGӣY' );
define( 'TEXT_ATTRIBUTE_EDIT', 'EDYTUJ CECHY' );

/* downloads manager */
define( 'TEXT_DISPLAY_NUMBER_OF_PRODUCTS_DOWNLOADS_MANAGER', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> plik�w)' );

/* manufactures */
define( 'TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> producent�w)' );

/* reviews */
define( 'TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> recenzji)' );

/* products expected */
define( 'TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> produkt�w oczekiwanych)' );

/* featured */
define( 'ERROR_NOTHING_SELECTED', 'Nic nie zosta�o wybrane... Nie dokonano �adnych zmian' );
define( 'TEXT_STATUS_WARNING', '<strong>UWAGA:</strong> status produkt�w zostanie automatycznie zmieniony na w��czony/wy��czony w momencie wprowadzenia daty' );
define( 'TEXT_DISPLAY_NUMBER_OF_FEATURED', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> produkt�w polecanych)' );

/* specials */
define( 'TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> promocji)' );

/* salemaker.php */
define( 'TEXT_DISPLAY_NUMBER_OF_SALES', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> obni�ek)' );

/* customers */
define( 'JS_ERROR', 'Podczas przetwarzania formularza wyst�pi�y b��dy!\nPopraw nast�puj�ce dane:\n\n' );
define( 'JS_GENDER', '* Musisz wybra� p�e�.\n' );
define( 'JS_FIRST_NAME', '* Imi� musi mie� przynajmniej ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znak�w.\n' );
define( 'JS_LAST_NAME', '* Nazwisko musi mie� przynajmniej ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znak�w.\n' );
define( 'JS_DOB', '* Data urodzenia  musi mie� format: xx/xx/xxxx (dzie�/miesi�c/rok).\n' );
define( 'JS_EMAIL_ADDRESS', '* Adres email  musi mie� przynajmniej ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znak�w.\n' );
define( 'JS_ADDRESS', '* Ulica  musi mie� przynajmniej ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znak�w.\n' );
define( 'JS_POST_CODE', '* Kod pocztowy  musi mie� ' . ENTRY_POSTCODE_MIN_LENGTH . ' znak�w.\n' );
define( 'JS_CITY', '* Miasto  musi mie� przynajmniej ' . ENTRY_CITY_MIN_LENGTH . ' znak�w.\n' );
define( 'JS_STATE', '* Musisz wybra� wojew�dztwo.\n' );
define( 'JS_STATE_SELECT', '-- Wybierz --' );
define( 'JS_ZONE', '* Dla tego kraju musisz wybra� \'Wojew�dztwo\' z rozwijanej listy.' );
define( 'JS_COUNTRY', '* Musisz wybra� \'Kraj\'.\n' );
define( 'JS_TELEPHONE', '* Nr telefonu  musi mie� przynajmniej ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znak�w.\n' );
define( 'ENTRY_NEWSLETTER_YES', 'Zapisany' );
define( 'ENTRY_NEWSLETTER_NO', 'Wypisany' );
define( 'CATEGORY_PERSONAL', 'Dane Osobowe' );
define( 'ENTRY_GENDER', 'P�e�: ' );
define( 'MALE', 'M�czyzna' );
define( 'FEMALE', 'Kobieta' );
define( 'ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">wymagane</span>' );
define( 'ENTRY_FIRST_NAME', 'Imi�: ' );
define( 'ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znak�w</span>' );
define( 'ENTRY_LAST_NAME', 'Nazwisko: ' );
define( 'ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znak�w</span>' );
define( 'ENTRY_DATE_OF_BIRTH', 'Data Urodzenia: ' );
define( 'ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(np. 21/05/1970)</span>' );
define( 'ENTRY_EMAIL_ADDRESS', 'Adres email: ' );
define( 'ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znak�w</span>' );
define( 'ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Ten adres email nie jest poprawny!</span>' );
define( 'ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Podany adres email ju� istnieje w naszej bazie!</span>' );
define( 'CATEGORY_COMPANY', 'Dane Firmy' );
define( 'ENTRY_COMPANY', 'Nazwa firmy: ' );

define( 'ENTRY_NIP', 'NIP: ' );
define( 'ENTRY_NIP_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_NIP_MIN_LENGTH . ' znak�w</span>' );
define( 'ENTRY_NIP_CHECK_ERROR', 'Wprowadzony NIP nie jest prawid�owy' );
define( 'ENTRY_NIP_ERROR_EXISTS', 'Taki NIP ju� istnieje w naszej bazie, wprowad� inny!' );

define( 'ENTRY_COMPANY_ERROR', '' );
define( 'CATEGORY_ADDRESS', 'Dane Teleadresowe' );
define( 'ENTRY_STREET_ADDRESS', 'Ulica: ' );
define( 'ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znak�w</span>' );
define( 'ENTRY_SUBURB', 'Dzielnica: ' );
define( 'ENTRY_SUBURB_ERROR', '' );
define( 'ENTRY_POST_CODE', 'kod pocztowy: ' );
define( 'ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' znak�w</span>' );
define( 'ENTRY_CITY', 'Miasto: ' );
define( 'ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' znak�w</span>' );
define( 'ENTRY_STATE', 'Wojew�dztwo: ' );
define( 'ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">wymagane</span>' );
define( 'ENTRY_COUNTRY', 'Kraj: ' );
define( 'ENTRY_COUNTRY_ERROR', '' );
define( 'CATEGORY_CONTACT', 'Dane Kontaktowe' );
define( 'ENTRY_TELEPHONE_NUMBER', 'Numer telefonu: ' );
define( 'ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znak�w</span>' );
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
define( 'TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> klient�w)' );

/* orders */
define( 'TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> zam�wie�)' );

/* group pricing */
define( 'TEXT_DISPLAY_NUMBER_OF_PRICING_GROUPS', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> grup cenowych)' );

/* countries */
define( 'TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> kraj�w)' );

/* zones */
define( 'TEXT_DISPLAY_NUMBER_OF_ZONES', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> wojew�dztw)' );

/* tax classes */
define( 'TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> rodzaj�w podatku)' );

/* tax rates */
define( 'TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> stawek podatkowych)' );

/* geo zones */
define( 'TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> stref podatkowych)' );

/* languages */
define( 'TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> dost�pnych j�zyk�w)' );
define( 'TEXT_SET_DEFAULT', 'Ustaw jako warto�� domy�ln�' );

/* currencies */
define( 'TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> dost�pnych walut)' );

/* orders status */
define( 'TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> status�w zam�wie�)' );

/* stats products purchased */
define( 'HEADING_TITLE_SEARCH_DETAIL_REPORTS', 'Szukaj produktu(�w) - [kilka rozdziel przecinkiem]' );
define( 'HEADING_TITLE_SEARCH_DETAIL_REPORTS_NAME_MODEL', 'Szukaj nazwy modelu' );

/* newsletters */
define( 'ENTRY_NOTHING_TO_SEND', 'Nie wpisano �adnej tre�ci w wiadomo�ci' );
define( 'TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> newsletter�w)' );

/* mail */
define( 'TEXT_WARNING_HTML_DISABLED', 'Uwaga: U�ywasz emaili w formie TEKSTOWEJ. Je�li chcesz wysy�a� HTML musisz w��czy� "u�yj MIME HTML" w opcjach emaila' );

/* template select */
define( 'TEXT_DISPLAY_NUMBER_OF_TEMPLATES', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> szablon�w)' );

/* banner manager */
define( 'TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> baner�w)' );

/* define pages editor */
define( 'BOX_TOOLS_DEFINE_CONDITIONS', 'Warunki korzystania' );

/* admin */
define( 'TEXT_DISPLAY_NUMBER_OF_ADMINS', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> admin�w)' );

/* gv mail */
define( 'TEXT_GV_NAME', 'Bon towarowy' );
define( 'TEXT_GV_REDEEM', 'Kod realizacji' );
define( 'TEXT_DISPLAY_NUMBER_OF_GIFT_VOUCHERS', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> wys�anych bon�w)' );

/* gv queue */
define( 'TEXT_GV_NAMES', 'Bony towarowe' );

/* coupon admin */
define( 'TEXT_DISPLAY_NUMBER_OF_COUPONS', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> kupon�w)' );
//zen_draw_date_selector
define( '_JANUARY', 'Stycze�' );
define( '_FEBRUARY', 'Luty' );
define( '_MARCH', 'Marzec' );
define( '_APRIL', 'Kwiecie�' );
define( '_MAY', 'Maj' );
define( '_JUNE', 'Czerwiec' );
define( '_JULY', 'Lipiec' );
define( '_AUGUST', 'Sierpie�' );
define( '_SEPTEMBER', 'Wrzesie�' );
define( '_OCTOBER', 'Pa�dziernik' );
define( '_NOVEMBER', 'Listopad' );
define( '_DECEMBER', 'Grudzie�' );
define( 'TEXT_DISCOUNT_COUPON', 'Kupon rabatowy' );

/* coupon restrict */
define( 'TEXT_DISPLAY_NUMBER_OF_CATEGORIES', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> kategorii)' );

/*
-----------------------------------------------------
*/
define( 'TEXT_IMAGE_OVERWRITE_WARNING','OSTRZE�ENIE: Istniej�cy obrazek zostanie nadpisany ' );
define( 'DOB_FORMAT_STRING', 'dd/mm/yyyy' );
define( 'BOX_CONFIGURATION_MYSTORE', 'M�j sklep' );
define( 'BOX_CONFIGURATION_LOGGING', 'Logi' );
define( 'BOX_CONFIGURATION_CACHE', 'Cache' );
define( 'BOX_MODULES_PRODUCT_TYPES', 'Rodzaje produkt�w' );
define( 'BOX_TOOLS_BACKUP', 'Zrzut bazy danych' );
define( 'BOX_TOOLS_CACHE', 'Kontrola cache' );
define( 'BOX_TOOLS_DEFINE_LANGUAGE', 'Definiowanie j�zyk�w' );
define( 'BOX_TOOLS_FILE_MANAGER', 'Eksplorator plik�w' );

// define pages editor files
define( 'BOX_TOOLS_DEFINE_MAIN_PAGE', 'Strona g��wna' );
define( 'BOX_TOOLS_DEFINE_CONTACT_US','Kontakt z nami' );
define( 'BOX_TOOLS_DEFINE_PRIVACY','Polityka prywatno�ci' );
define( 'BOX_TOOLS_DEFINE_SHIPPINGINFO','Wysy�ka i zwroty' );
define( 'BOX_TOOLS_DEFINE_CHECKOUT_SUCCESS','Przyj�cie zam�wienia' );
define( 'BOX_TOOLS_DEFINE_PAGE_2','Strona 2' );
define( 'BOX_TOOLS_DEFINE_PAGE_3','Strona 3' );
define( 'BOX_TOOLS_DEFINE_PAGE_4','Strona 4' );

// javascript messages
define( 'JS_OPTIONS_VALUE_PRICE', '* Nowa cecha produktu musi mie� warto��\n' );
define( 'JS_OPTIONS_VALUE_PRICE_PREFIX', '* Cena dla nowej cechy produktu musi mie� prefiks\n' );
define( 'JS_PRODUCTS_NAME', '* Nowy produkt musi mie� podan� nazw�\n' );
define( 'JS_PRODUCTS_DESCRIPTION', '* Nowy produkt musi miec podany opis\n' );
define( 'JS_PRODUCTS_PRICE', '* Nowy produkt musi mie� podan� cen�\n' );
define( 'JS_PRODUCTS_WEIGHT', '* Nowy produkt musi mie� podan� wag�\n' );
define( 'JS_PRODUCTS_QUANTITY', '* Nowy produkt musi mie� podan� ilo�� sztuk\n' );
define( 'JS_PRODUCTS_MODEL', '* Nowy produkt musi mie� podany model\n' );
define( 'JS_PRODUCTS_IMAGE', '* Nowy produkt musi mie� obrazek\n' );
define( 'JS_SPECIALS_PRODUCTS_PRICE', '* Dla tego produktu musi by� ustalona nowa cena\n' );
define( 'JS_PASSWORD', '* Has�o i Potwierdzenie Has�a musi by� identyczne i musi mie� przynajmniej ' . ENTRY_PASSWORD_MIN_LENGTH . ' znak�w.\n' );
define( 'JS_ORDER_DOES_NOT_EXIST', 'Zam�wienie nr %s nie istnieje!' );

define( 'IMAGE_ICON_STATUS_GREEN', 'W��czone' );
define( 'IMAGE_ICON_STATUS_GREEN_LIGHT', 'W��czone' );
define( 'IMAGE_ICON_STATUS_RED', 'Wy��czone' );
define( 'IMAGE_ICON_STATUS_RED_ERROR', 'B��d' );

define( 'ICON_CURRENT_FOLDER', 'Bie��cy katalog' );
define( 'ICON_FILE', 'Plik' );
//define( 'ICON_LOCKED', 'Locked' );
define( 'ICON_PREVIOUS_LEVEL', 'Poprzedni poziom' );
//define( 'ICON_UNLOCKED', 'Unlocked' );

define( 'TEXT_CACHE_CATEGORIES', 'Kategorie' );
define( 'TEXT_CACHE_MANUFACTURERS', 'Producenci' );
define( 'TEXT_CACHE_ALSO_PURCHASED', 'Modu�: zakupiono r�wnie�' );

define( 'WARNING_BACKUP_CFG_FILES_TO_DELETE', 'OSTRZE�ENIE: Te pliki powinny by� usuni�te dla bezpiecze�stwa: ' );
define( 'WARNING_INSTALL_DIRECTORY_EXISTS', 'Ostrze�enie: Istnieje katalog instalatora w lokalizacji: ' . DIR_FS_CATALOG . 'zc_install. Usu� ten katalog dla bezpiecze�stwa.' );
define( 'WARNING_CONFIG_FILE_WRITEABLE', 'Ostrze�enie: Tw�j plik: %s w includes/configure.php posiada nieprawid�owe prawa dost�pu. Ustaw w�a�ciwe (read-only, CHMOD 644 lub 444).' );

define( 'TEXT_VALID_PRODUCTS_LIST', 'Lista produkt�w' );
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
define( 'TEXT_CHARGES_WORD', 'Obliczona op�ata: ' );
define( 'TEXT_PER_WORD', '<br />Cena za s�owo: ' );
define( 'TEXT_WORDS_FREE', ' S�owo(a) darmowe ' );
define( 'TEXT_CHARGES_LETTERS', 'Obliczona op�ata: ' );
define( 'TEXT_PER_LETTER', '<br />Cena za list: ' );
define( 'TEXT_LETTERS_FREE', ' List(y) darmowe ' );
define( 'TEXT_ONETIME_CHARGES', '*op�ata jednorazowa = ' );
define( 'TEXT_ONETIME_CHARGES_EMAIL', "\t" . '*op�ata jednorazowa = ' );
define( 'TEXT_ATTRIBUTES_QTY_PRICES_HELP', 'Opcja zni�ki od ilo�ci' );
define( 'TABLE_ATTRIBUTES_QTY_PRICE_QTY','ILO��' );
define( 'TABLE_ATTRIBUTES_QTY_PRICE_PRICE','CENA' );
define( 'TEXT_ATTRIBUTES_QTY_PRICES_ONETIME_HELP', 'Opcja zni�ki od ilo�ci podlega jednorazowej op�acie' );
define( 'TEXT_INFO_SET_MASTER_CATEGORIES_ID_WARNING', '<strong>OSTRZE�ENIE:</strong> Ten produkt jest dowi�zany do wielu kategorii ale nie zosta�a ustawiona kategoria g��wna!' );

// Rich Text / HTML resources
define( 'TEXT_HTML_EDITOR_NOT_DEFINED','Je�li nie zdefiniowano edytora HTML lub wy��czono obs�ug� JavaScript mo�esz wpisa� tutaj tekst HTML r�cznie.' );
define( 'TEXT_WARNING_CANT_DISPLAY_HTML','<span class = "main">Uwaga: U�ywasz emaili w formie TEKSTOWEJ. Je�li chcesz wysy�a� HTML musisz w��czy� "u�yj MIME HTML" w opcjach emaila</span>' );
define( 'TEXT_EMAIL_CLIENT_CANT_DISPLAY_HTML',"Widzisz t� informacj� poniewa� wys�ali�my emaila w formacie HTML, kt�ry Tw�j klient emailowy nie wy�wietla." );
define( 'ENTRY_EMAIL_FORMAT_COMMENTS','Wybierz "none" or "optout" disables ALL mail, including order details' );
define( 'ENTRY_EMAIL_FORMAT_COMMENTS', 'Wybranie "brak" lub "optout" blokuje WSZYSTKIE maile, w��czaj�c szczeg�y zam�wienia' );
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