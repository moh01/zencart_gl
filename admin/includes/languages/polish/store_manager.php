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
 * Wi�cej informacji na stronie projektu {@link http://www.zencart.pl ZenCart.pl} Zajrzyj!
 *
 *
 * @package admin
 *
 */

/* option values */
define( 'SUCCESS_PRODUCT_UPDATE_SORT_ALL', 'Sortowanie cech zosta�o pomy�lnie zmienione dla WSZYSTKICH produkt�w ' );

/* wlasne */
define( 'SUCCESS_CLEAN_ADMIN_ACTIVITY_LOG', '<strong>Pomy�lnie</strong> zaktualizowano logi aktywno�ci Admina' );
define( 'SUCCESS_PRODUCT_UPDATE_PRODUCTS_PRICE_SORTER', '<strong>Pomy�lnie</strong> zaktualizowano sortowanie warto�ci cen dla produkt�w' );
define( 'SUCCESS_PRODUCT_UPDATE_PRODUCTS_VIEWED', '<strong>Pomy�lnie</strong> przywr�cono ogl�dalno�� produkt�w na warto�� 0' );
define( 'SUCCESS_PRODUCT_UPDATE_PRODUCTS_ORDERED', '<strong>Pomy�lnie</strong> przywr�cono warto�� sortowania produkt�w na warto�� 0' );
define( 'SUCCESS_UPDATE_COUNTER', '<strong>Pomy�lnie</strong> zaktualizowano licznik na: ' );
define( 'SUCCESS_DB_OPTIMIZE', 'Optymalizacja bazy danych - Zoptymalizowane tabele: ' );
define( 'SUCCESS_UPDATE_ALL_MASTER_CATEGORIES_ID', '<strong>Pomy�lnie</strong> przywr�cono kategorie g��wne dla wszystkich produkt�w dowi�zanych' );
define( 'ERROR_CONFIGURATION_KEY_NOT_ENTERED', '<strong>B��d:</strong> Nie okre�lono klucza konfiguracji lub nie wprowadzono frazy wyszukiwania... Wyszukiwanie przerwane' );
define( 'ERROR_CONFIGURATION_KEY_NOT_FOUND', '<strong>B��d:</strong> Nie odnaleziono klucza konfiguracji ...' );

define( 'HEADING_TITLE', 'Manager sklepu' );

define( 'TABLE_CONFIGURATION_TABLE', 'Znalezione definicje STA�YCH' );
define( 'TABLE_TITLE_KEY', '<strong>Klucz:</strong>' );
define( 'TABLE_TITLE_TITLE', '<strong>Tytu�:</strong>' );
define( 'TABLE_TITLE_DESCRIPTION', '<strong>Opis:</strong>' );
define( 'TABLE_TITLE_GROUP', '<strong>Grupa:</strong>' );
define( 'TABLE_TITLE_VALUE', '<strong>Warto��:</strong>' );
define( 'TEXT_INFO_CONFIGURATION_HIDDEN', ' lub, UKRYTY' );
define( 'TEXT_INFO_NO_EDIT_AVAILABLE', 'Brak mo�liwo�ci edycji' );

define( 'TEXT_INFO_ADMIN_ACTIVITY_LOG', '<strong>Wyczy�� tablic� log�w aktywno�ci Admina w bazie danych<br />OSTRZE�ENIE: Upewnij si�, �e posiadasz kopi� bazy danych zanim uruchomisz ten proses!</strong><br />Tablica log�w Admina przechowuje dane dotycz�ce jego aktywno�ci, st�d mo�e zawiera� du�� liczb� rekord�w. Musi wi�c by� co jaki� czas wyczyszczona.<br />W momencie przekroczenia 50,000 rekord�w lub log�w starszych ni� 60 dni, pojawi si� ostrze�enie w panelu Admina informuj�ce o konieczno��i wyczyszczenia tej tablicy.' );

define( 'TEXT_INFO_PRODUCTS_PRICE_SORTER_UPDATE', '<strong>Zmie� sortowanie WSZYSTKICH produkt�w</strong><br />na sortowanie wg. cen: ' );
define( 'TEXT_INFO_COUNTER_UPDATE', '<strong>Ustaw licznik</strong><br />na now� warto��: ' );

define( 'TEXT_INFO_PRODUCTS_VIEWED_UPDATE', '<strong>Przywr�� ogl�dalno�� produkt�w</strong><br />Przywr�� ogl�dalno�� produkt�w ustawiaj�c wszystkim warto�� 0: ' );

define( 'TEXT_INFO_PRODUCTS_ORDERED_UPDATE', '<strong>Przywr�� sortowanie produkt�w</strong><br />Przywr�� sortowanie produkt�w ustawiajaj�c wszystkim warto�� sortowania r�wn� 0: ' );

define( 'TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE', '<strong>Przywr�� kategorie g��wne</strong><br />dla produkt�w dowi�zanych do innych kategorii: ' );

define( 'TEXT_ORDERS_ID_UPDATE', '<strong>Przywr�� aktualne sortowanie</strong>' );
define( 'TEXT_OLD_ORDERS_ID', 'Stare ID sortowania' );
define( 'TEXT_NEW_ORDERS_ID', 'Nowe ID sortowania' );
define( 'TEXT_INFO_ORDERS_ID_UPDATE', '<strong>UWAGA: Zanim zmienisz ID aktualnego sortowania ...</strong><br /><br />Utw�rz najpierw testowe sortowanie. Nast�pnie, u�ywaj�c tego testowego sortowania wype�nij informacje obok.<br />Nowe ID sortowania dla kolejnego rzeczywistego sortowania powinno by� wprowadzone jako o 1 ni�sze.<br /><strong>Przyk�ad:</strong> Je�li chcesz zmieni� sortowanie na 1225, wpisz 1224<br /><br /><strong>OSTRZE�ENIE:</strong> Mo�esz zmienia� sortowanie tylko na wi�ksze, nie na mniejsze.<br />Je�li wi�c sortowanie jest ustawione na 25, wtedy zmie� go na 20, nast�pne sortowanie b�dzie nadal 26.' );

define( 'TEXT_CONFIGURATION_CONSTANT', '<strong>Szukaj STA�YCH konfiguracji lub plik�w je�ykowych</strong>' );
define( 'TEXT_CONFIGURATION_KEY', 'Klucz lub nazwa: ' );
define( 'TEXT_INFO_CONFIGURATION_UPDATE', '<strong>UWAGA:</strong> STA�E s� pisane wielkimi literami.<br />Pliki j�zykowe s� przeszukiwane, gdy sta�a nie zosta�a znaleziona w bazie danych.' );

define( 'TEXT_CONFIGURATION_CONSTANT_FILES', '<strong>Szukaj definicji w plikach j�zykowych</strong>' );
define( 'TEXT_CONFIGURATION_KEY_FILES', 'Szukaj tekstu: ' );
define( 'TEXT_LANGUAGE_LOOKUPS', 'Szukaj w plikach: ' );
define( 'TEXT_LANGUAGE_LOOKUP_NONE', 'Brak' );
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_LANGUAGE', 'Wszystkie pliki j�zykowe dla ' . strtoupper($_SESSION['language']) . ' - Sklep/Panel Admina' );
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG', 'G��wne pliki j�zykowe - Sklep (' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . ' [polish.php /english.php] etc.)' );
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG_TEMPLATE', 'Wszystkie pliki j�zykowe - Sklep ' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php' );
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN', 'G��wne pliki j�zykowe - Panel Admina (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . ' [polish.php /english.php] etc.)' );
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN_LANGUAGE', 'Wszystkie pliki j�zykowe - Panel Admina (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php)' );
define( 'TEXT_INFO_CONFIGURATION_UPDATE_FILES', '<strong>UWAGA:</strong> Definicje j�zykowe mog� by� wyszukiwane podaj�c zar�wno w jako ma�e jak i du�e litery' );

define( 'TEXT_INFO_DATABASE_OPTIMIZE', '<strong>Optymalizuj baz� danych</strong>, aby usun�� nadmiary w tabelach.<br />Mo�e by� uruchamiane opcjonalnie np. miesi�cznie, tygodniowo itp.<br />' );

/**/
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_ALL', 'Wszystkie pliki obecnie wybranego j�zyka - Sklep/Panel Admina' );

?>