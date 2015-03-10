<?php
/**
 *
 * @version $Id: store_manager.php, v 1.3.7 2007/04/26 11:48:12 $;
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

/* option values */
define( 'SUCCESS_PRODUCT_UPDATE_SORT_ALL', 'Sortowanie cech zosta³o pomy¶lnie zmienione dla WSZYSTKICH produktów ' );

/* wlasne */
define( 'SUCCESS_CLEAN_ADMIN_ACTIVITY_LOG', '<strong>Pomy¶lnie</strong> zaktualizowano logi aktywno¶ci Admina' );
define( 'SUCCESS_PRODUCT_UPDATE_PRODUCTS_PRICE_SORTER', '<strong>Pomy¶lnie</strong> zaktualizowano sortowanie warto¶ci cen dla produktów' );
define( 'SUCCESS_PRODUCT_UPDATE_PRODUCTS_VIEWED', '<strong>Pomy¶lnie</strong> przywrócono ogl±dalno¶æ produktów na warto¶æ 0' );
define( 'SUCCESS_PRODUCT_UPDATE_PRODUCTS_ORDERED', '<strong>Pomy¶lnie</strong> przywrócono warto¶æ sortowania produktów na warto¶æ 0' );
define( 'SUCCESS_UPDATE_COUNTER', '<strong>Pomy¶lnie</strong> zaktualizowano licznik na: ' );
define( 'SUCCESS_DB_OPTIMIZE', 'Optymalizacja bazy danych - Zoptymalizowane tabele: ' );
define( 'SUCCESS_UPDATE_ALL_MASTER_CATEGORIES_ID', '<strong>Pomy¶lnie</strong> przywrócono kategorie g³ówne dla wszystkich produktów dowi±zanych' );
define( 'ERROR_CONFIGURATION_KEY_NOT_ENTERED', '<strong>B³±d:</strong> Nie okre¶lono klucza konfiguracji lub nie wprowadzono frazy wyszukiwania... Wyszukiwanie przerwane' );
define( 'ERROR_CONFIGURATION_KEY_NOT_FOUND', '<strong>B³±d:</strong> Nie odnaleziono klucza konfiguracji ...' );

define( 'HEADING_TITLE', 'Manager sklepu' );

define( 'TABLE_CONFIGURATION_TABLE', 'Znalezione definicje STA£YCH' );
define( 'TABLE_TITLE_KEY', '<strong>Klucz:</strong>' );
define( 'TABLE_TITLE_TITLE', '<strong>Tytu³:</strong>' );
define( 'TABLE_TITLE_DESCRIPTION', '<strong>Opis:</strong>' );
define( 'TABLE_TITLE_GROUP', '<strong>Grupa:</strong>' );
define( 'TABLE_TITLE_VALUE', '<strong>Warto¶æ:</strong>' );
define( 'TEXT_INFO_CONFIGURATION_HIDDEN', ' lub, UKRYTY' );
define( 'TEXT_INFO_NO_EDIT_AVAILABLE', 'Brak mo¿liwo¶ci edycji' );

define( 'TEXT_INFO_ADMIN_ACTIVITY_LOG', '<strong>Wyczy¶æ tablicê logów aktywno¶ci Admina w bazie danych<br />OSTRZE¯ENIE: Upewnij siê, ¿e posiadasz kopiê bazy danych zanim uruchomisz ten proses!</strong><br />Tablica logów Admina przechowuje dane dotycz±ce jego aktywno¶ci, st±d mo¿e zawieraæ du¿± liczbê rekordów. Musi wiêc byæ co jaki¶ czas wyczyszczona.<br />W momencie przekroczenia 50,000 rekordów lub logów starszych ni¿ 60 dni, pojawi siê ostrze¿enie w panelu Admina informuj±ce o konieczno¶æi wyczyszczenia tej tablicy.' );

define( 'TEXT_INFO_PRODUCTS_PRICE_SORTER_UPDATE', '<strong>Zmieñ sortowanie WSZYSTKICH produktów</strong><br />na sortowanie wg. cen: ' );
define( 'TEXT_INFO_COUNTER_UPDATE', '<strong>Ustaw licznik</strong><br />na now± warto¶æ: ' );

define( 'TEXT_INFO_PRODUCTS_VIEWED_UPDATE', '<strong>Przywróæ ogl±dalno¶æ produktów</strong><br />Przywróæ ogl±dalno¶æ produktów ustawiaj±c wszystkim warto¶æ 0: ' );

define( 'TEXT_INFO_PRODUCTS_ORDERED_UPDATE', '<strong>Przywróæ sortowanie produktów</strong><br />Przywróæ sortowanie produktów ustawiajaj±c wszystkim warto¶æ sortowania równ± 0: ' );

define( 'TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE', '<strong>Przywróæ kategorie g³ówne</strong><br />dla produktów dowi±zanych do innych kategorii: ' );

define( 'TEXT_ORDERS_ID_UPDATE', '<strong>Przywróæ aktualne sortowanie</strong>' );
define( 'TEXT_OLD_ORDERS_ID', 'Stare ID sortowania' );
define( 'TEXT_NEW_ORDERS_ID', 'Nowe ID sortowania' );
define( 'TEXT_INFO_ORDERS_ID_UPDATE', '<strong>UWAGA: Zanim zmienisz ID aktualnego sortowania ...</strong><br /><br />Utwórz najpierw testowe sortowanie. Nastêpnie, u¿ywaj±c tego testowego sortowania wype³nij informacje obok.<br />Nowe ID sortowania dla kolejnego rzeczywistego sortowania powinno byæ wprowadzone jako o 1 ni¿sze.<br /><strong>Przyk³ad:</strong> Je¶li chcesz zmieniæ sortowanie na 1225, wpisz 1224<br /><br /><strong>OSTRZE¯ENIE:</strong> Mo¿esz zmieniaæ sortowanie tylko na wiêksze, nie na mniejsze.<br />Je¶li wiêc sortowanie jest ustawione na 25, wtedy zmieñ go na 20, nastêpne sortowanie bêdzie nadal 26.' );

define( 'TEXT_CONFIGURATION_CONSTANT', '<strong>Szukaj STA£YCH konfiguracji lub plików je¿ykowych</strong>' );
define( 'TEXT_CONFIGURATION_KEY', 'Klucz lub nazwa: ' );
define( 'TEXT_INFO_CONFIGURATION_UPDATE', '<strong>UWAGA:</strong> STA£E s± pisane wielkimi literami.<br />Pliki jêzykowe s± przeszukiwane, gdy sta³a nie zosta³a znaleziona w bazie danych.' );

define( 'TEXT_CONFIGURATION_CONSTANT_FILES', '<strong>Szukaj definicji w plikach jêzykowych</strong>' );
define( 'TEXT_CONFIGURATION_KEY_FILES', 'Szukaj tekstu: ' );
define( 'TEXT_LANGUAGE_LOOKUPS', 'Szukaj w plikach: ' );
define( 'TEXT_LANGUAGE_LOOKUP_NONE', 'Brak' );
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_LANGUAGE', 'Wszystkie pliki jêzykowe dla ' . strtoupper($_SESSION['language']) . ' - Sklep/Panel Admina' );
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG', 'G³ówne pliki jêzykowe - Sklep (' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . ' [polish.php /english.php] etc.)' );
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG_TEMPLATE', 'Wszystkie pliki jêzykowe - Sklep ' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php' );
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN', 'G³ówne pliki jêzykowe - Panel Admina (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . ' [polish.php /english.php] etc.)' );
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN_LANGUAGE', 'Wszystkie pliki jêzykowe - Panel Admina (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php)' );
define( 'TEXT_INFO_CONFIGURATION_UPDATE_FILES', '<strong>UWAGA:</strong> Definicje jêzykowe mog± byæ wyszukiwane podaj±c zarówno w jako ma³e jak i du¿e litery' );

define( 'TEXT_INFO_DATABASE_OPTIMIZE', '<strong>Optymalizuj bazê danych</strong>, aby usun±æ nadmiary w tabelach.<br />Mo¿e byæ uruchamiane opcjonalnie np. miesiêcznie, tygodniowo itp.<br />' );

/**/
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_ALL', 'Wszystkie pliki obecnie wybranego jêzyka - Sklep/Panel Admina' );

?>