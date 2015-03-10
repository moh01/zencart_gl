<?php
/**
 *
 * @version $Id: developers_tool_kit.php, v 1.3.7 2007/04/26 11:48:12 $;
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

/* store manager */
define( 'SUCCESS_PRODUCT_UPDATE_PRODUCTS_PRICE_SORTER', '<strong>Pomy�lnie</strong> zaktualizowano sortowanie warto�ci cen dla produkt�w' );
define( 'ERROR_CONFIGURATION_KEY_NOT_ENTERED', '<strong>B��d:</strong> Nie okre�lono klucza konfiguracji lub nie wprowadzono frazy wyszukiwania... Wyszukiwanie przerwane' );
define( 'ERROR_CONFIGURATION_KEY_NOT_FOUND', '<strong>B��d:</strong> Nie odnaleziono klucza konfiguracji ...' );

define( 'TABLE_CONFIGURATION_TABLE', 'Znalezione definicje STA�YCH' );
define( 'TABLE_TITLE_KEY', '<strong>Klucz:</strong>' );
define( 'TABLE_TITLE_TITLE', '<strong>Tytu�:</strong>' );
define( 'TABLE_TITLE_DESCRIPTION', '<strong>Opis:</strong>' );
define( 'TABLE_TITLE_GROUP', '<strong>Grupa:</strong>' );
define( 'TABLE_TITLE_VALUE', '<strong>Warto��:</strong>' );
define( 'TEXT_INFO_CONFIGURATION_HIDDEN', ' lub, UKRYTY' );
define( 'TEXT_INFO_NO_EDIT_AVAILABLE', 'Brak mo�liwo�ci edycji' );

define( 'TEXT_INFO_PRODUCTS_PRICE_SORTER_UPDATE', '<strong>Zmie� sortowanie WSZYSTKICH produkt�w</strong><br />na sortowanie wg. cen: ' );
define( 'TEXT_CONFIGURATION_CONSTANT', '<strong>Szukaj STA�YCH konfiguracji lub plik�w j�zykowych</strong>' );
define( 'TEXT_CONFIGURATION_KEY', 'Klucz lub nazwa: ' );
define( 'TEXT_INFO_CONFIGURATION_UPDATE', '<strong>UWAGA:</strong> STA�E s� pisane wielkimi literami.<br />Pliki j�zykowe s� przeszukiwane, gdy sta�a nie zosta�a znaleziona w bazie danych.' );
define( 'TEXT_LANGUAGE_LOOKUPS', 'Szukaj w plikach: ' );

/* wlasne */
define( 'TEXT_INFO_SEARCHING', 'Wyszukiwanie ' );
define( 'TEXT_INFO_FILES_FOR', ' plik�w ... dla: ' );
define( 'TEXT_INFO_MATCHES_FOUND', 'Znaleziono pasuj�ce linki: ' );

define( 'HEADING_TITLE', 'Narz�dzia dla developer�w' );

define( 'TEXT_LOOKUP_NONE', 'Brak' );
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_LANGUAGE', 'Wszystkie pliki j�zykowe dla ' . strtoupper($_SESSION['language']) . ' - Sklep/Panel Admina' );
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG', 'G��wne pliki j�zykowe - Sklep (' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . ' [polish.php /english.php] etc.)' );
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG_TEMPLATE', 'Wszystkie pliki j�zykowe - Sklep ' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php' );
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN', 'G��wne pliki j�zykowe - Panel Admina (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . ' [polish.php /english.php] etc.)' );
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN_LANGUAGE', 'Wszystkie pliki j�zykowe - Panel Admina (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php)' );
define( 'TEXT_INFO_CONFIGURATION_UPDATE_FILES', '<strong>UWAGA:</strong> Definicje j�zykowe mog� by� wyszukiwane podaj�c zar�wno w jako ma�e jak i du�e litery' );

define( 'TEXT_FUNCTION_CONSTANT', '<strong>Szukaj funkcji lub element�w w plikach funkcji</strong>' );
define( 'TEXT_FUNCTION_LOOKUPS', 'Szukaj w plikach funkcji: ' );
define( 'TEXT_FUNCTION_LOOKUP_CURRENT', 'Wszystkie pliki funkcji - Sklep/Panel Admina' );
define( 'TEXT_FUNCTION_LOOKUP_CURRENT_CATALOG', 'Wszystkie pliki funkcji - Sklep' );
define( 'TEXT_FUNCTION_LOOKUP_CURRENT_ADMIN', 'Wszystkie pliki funkcji - Panel Admina' );

define( 'TEXT_CLASS_CONSTANT', '<strong>Szukaj klas lub element�w w plikach klas</strong>' );
define( 'TEXT_CLASS_LOOKUPS', 'Szukaj w plikach klas: ' );
define( 'TEXT_CLASS_LOOKUP_CURRENT', 'Wszystkie pliki klas - Sklep/Panel Admina' );
define( 'TEXT_CLASS_LOOKUP_CURRENT_CATALOG', 'Wszystkie pliki klas - Sklep' );
define( 'TEXT_CLASS_LOOKUP_CURRENT_ADMIN', 'Wszystkie pliki klas - Panel Admina' );

define( 'TEXT_TEMPLATE_CONSTANT', '<strong>Szukaj ement�w szablonu</strong>' );
define( 'TEXT_TEMPLATE_LOOKUPS', 'Szukaj w plikach szablonu: ' );
define( 'TEXT_TEMPLATE_LOOKUP_CURRENT', 'Wszystkie pliki szablonu - /templates /sideboxes /pages etc.' );
define( 'TEXT_TEMPLATE_LOOKUP_CURRENT_TEMPLATES', 'Wszystkie pliki szablonu - /templates' );
define( 'TEXT_TEMPLATE_LOOKUP_CURRENT_SIDEBOXES', 'Wszystkie pliki szablonu - /sideboxes' );
define( 'TEXT_TEMPLATE_LOOKUP_CURRENT_PAGES', 'Wszystkie pliki szablonu - /pages' );

define( 'TEXT_ALL_FILES_CONSTANT', '<strong>Przeszukuj wszystkie pliki</strong>' );
define( 'TEXT_ALL_FILES_LOOKUPS', 'Szukaj w plikach: ' );
define( 'TEXT_ALL_FILES_LOOKUP_CURRENT', 'Wszystkie pliki - Sklep/Panel Admina' );
define( 'TEXT_ALL_FILES_LOOKUP_CURRENT_CATALOG', 'Wszystkie pliki - Sklep' );
define( 'TEXT_ALL_FILES_LOOKUP_CURRENT_ADMIN', 'Wszystkie pliki - Panel Admina' );
     
/**/
define( 'TEXT_LANGUAGE_LOOKUP_CURRENT_ALL', 'Wszystkie pliki obecnie wybranego j�zyka - Sklep/Panel Admina' );

?>