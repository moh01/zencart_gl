<?php
/**
 *
 * @version $Id: attributes_controller.php, v 1.3.7 2007/04/26 11:48:12 $;
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
define( 'TEXT_ATTRIBUTE_COPY_SKIPPING', '<strong>Pominiêto now± cechê</strong> ' );
define( 'TEXT_ATTRIBUTE_COPY_INSERTING', '<strong>Wstawiono now± cechê nr.:</strong> ' );
define( 'TEXT_ATTRIBUTE_COPY_UPDATING', '<strong>Zaktualizowano cechê</strong> ' );
define( 'TEXT_INFO_ID', ' ID ' );

/* z polish */
define( 'TEXT_PRICED_BY_ATTRIBUTES', 'Cena zale¿na od cech' );

/* z categories */
define( 'TEXT_INFO_HEADING_ATTRIBUTE_FEATURES', 'Zmiana cech dla produktu ID# ' );
define( 'TEXT_INFO_ATTRIBUTES_FEATURES_DELETE', 'Usuñ <strong>WSZYSTKIE</strong> cechy dla produktu:<br />' );
define( 'TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT', 'Kopuj cechy produktu do innego produktu z <strong>produktu</strong>:<br />ID: ' );
define( 'TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY', 'Kopuj cechy do kategorii z <strong>produktu</strong>:<br />ID: ' );
define( 'TEXT_COPY_ATTRIBUTES_CONDITIONS', '<strong>Co zrobiæ z istniej±cymi cechami?</strong>' );
define( 'TEXT_COPY_ATTRIBUTES_DELETE', '<strong>Usuñ</strong>, potem skopiuj nowe' );
define( 'TEXT_COPY_ATTRIBUTES_UPDATE', '<strong>Zmieñ</strong> cechy/ceny, potem dodaj nowe' );
define( 'TEXT_COPY_ATTRIBUTES_IGNORE', '<strong>Pomiñ</strong> i dodaj tylko nowe' );
define( 'SUCCESS_ATTRIBUTES_DELETED', 'Cechy usuniêto pomy¶lnie' );
define( 'SUCCESS_ATTRIBUTES_UPDATE', 'Cechy zaktualizowano pomy¶lnie' );

/* products to categories */
define( 'TEXT_PRODUCTS_ID', 'ID produktu: ' );
define( 'TEXT_PRODUCTS_PRICE', 'Cena produktu: ' );

/* option name manager */
define( 'HEADING_TITLE_OPT', 'Zarz±dzanie nazwami cech produktu' );
define( 'TEXT_OPTION_ID', 'ID cechy' );
define( 'TEXT_OPTION_NAME', 'Nazwa cechy' );
define( 'TABLE_HEADING_OPT_NAME', 'Nazwa cechy' );
define( 'TABLE_HEADING_OPT_TYPE', 'Rodzaj opcji' ); //CLR 031203 add option type column
define( 'TABLE_HEADING_OPTION_SORT_ORDER', 'Sortowanie' );
define( 'TABLE_HEADING_OPTION_VALUE_SIZE', 'Rozmiar' );
define( 'TABLE_HEADING_OPTION_VALUE_MAX', 'Maksymalnie' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );
define( 'TEXT_OPTION_VALUE_COMMENTS', 'Komentarze: ' );
define( 'TEXT_OPTION_VALUE_SIZE', 'Poka¿ rozmiar: ' );
define( 'TEXT_OPTION_VALUE_MAX', 'D³ugo¶æ maksymalna: ' );
define( 'TEXT_WARNING_OF_DELETE', 'Ta cecha zawiera produkty i warto¶ci cech dowi±zanych do niego - nie jest bezpieczne usuwanie tej opcji.' );
define( 'TABLE_HEADING_PRODUCT', 'Nazwa produktu' );
define( 'TABLE_HEADING_OPT_VALUE', 'Warto¶æ cechy' );
define( 'TEXT_OK_TO_DELETE', 'Ta cecha nie zawiera produktów ani warto¶ci - mo¿na j± bezpiecznie usun±æ.' );
define( 'ATTRIBUTE_POSSIBLE_OPTIONS_NAME_WARNING_DUPLICATE', 'Mo¿liwe dodanie nazwy cechy, która ju¿ istnieje' ); // Options Name Duplicate warning

/* option values manager */
define( 'ATTRIBUTE_POSSIBLE_OPTIONS_VALUE_WARNING_DUPLICATE', 'Mo¿liwe dodanie warto¶ci cechy, która ju¿ istnieje' ); // Options Value Duplicate warning
define( 'HEADING_TITLE_VAL', 'Zarz±dzanie warto¶ciami cech produktu' );
define( 'TABLE_HEADING_OPTION_VALUE_SORT_ORDER', 'Sortowanie domy¶lne' );

/* option values */
define( 'SUCCESS_PRODUCT_UPDATE_SORT', 'Sortowanie cech zosta³o pomy¶lnie zmienione dla produktu o ID: ' );

/* wlasne */
define( 'HEADING_TITLE_ATRIB', 'Zarz±dzanie cechami i warto¶ciami cech' );
define( 'HEADING_TITLE', 'KATEGORIA: ' );
define( 'HEADING_TITLE_ATRIB_SELECT', 'Wybierz kategoriê, aby wy¶wietliæ cechy produktów' );

define( 'TEXT_PRODUCTS_LISTING', 'Lista cech dla: ' );
define( 'TEXT_PRODUCT_IN_CATEGORY_NAME', ' - w kategorii: ' );
define( 'TEXT_INFO_ALLOW_ADD_TO_CART_NO', 'Dodawanie do koszyka zabronione' );
define( 'TEXT_ATTRIBUTES_UPDATE_SORT_ORDER', 'AKTUALIZUJ SORTOWANIE NA DOMY¦LNE' );
define( 'TEXT_ATTRIBUTES_PREVIEW', 'PODGL¡D CECH' );
define( 'TEXT_ATTRIBUTES_DELETE', 'USUÑ CECHY' );
define( 'TEXT_ATTRIBUTES_COPY_TO_PRODUCTS', 'KOPIUJ DO PRODUKTU' );
define( 'TEXT_ATTRIBUTES_COPY_TO_CATEGORY', 'KOPIUJ DO KATEGORII' );
define( 'TEXT_NO_ATTRIBUTES_DEFINED', 'Brak cech dla produktu o ID: ' );
define( 'TEXT_ATTRIBUTES_PREVIEW_DISPLAY', 'PODGL¡D CECH DLA PRODUKTU O ID: ' );
define( 'TEXT_PRODUCT_OPTIONS', '<strong>Cechy produktu:</strong>' );

define( 'LEGEND_BOX', 'Legenda: ' );
define( 'LEGEND_ATTRIBUTES_DISPLAY_ONLY', 'Tylko wy¶wietlana' );
define( 'LEGEND_ATTRIBUTES_IS_FREE', 'Darmowy' );
define( 'LEGEND_ATTRIBUTES_DEFAULT', 'Domy¶lna' );
define( 'LEGEND_ATTRIBUTE_IS_DISCOUNTED', 'Obni¿ki' );
define( 'LEGEND_ATTRIBUTE_PRICE_BASE_INCLUDED', 'Cena bazowa' );
define( 'LEGEND_ATTRIBUTES_REQUIRED', 'Wymagana' );
define( 'LEGEND_ATTRIBUTES_IMAGES', 'Obrazki' );
define( 'LEGEND_ATTRIBUTES_DOWNLOAD', 'Plik' );
define( 'LEGEND_KEYS', 'WY£/W£' );

define( 'TABLE_HEADING_ID', 'ID' );
define( 'TABLE_HEADING_OPT_PRICE_PREFIX', 'Prefiks, ' );
define( 'TABLE_HEADING_OPT_PRICE', 'Cena' );
define( 'TABLE_HEADING_OPT_WEIGHT_PREFIX', 'Prefiks, ' );
define( 'TABLE_HEADING_OPT_WEIGHT', 'Waga' );
define( 'TABLE_HEADING_OPT_SORT_ORDER', 'Sortowanie' );
define( 'TABLE_HEADING_PRICE_TOTAL', 'Razem|Po obni¿ce: Jednorazowo: ' );
define( 'TEXT_NO_PRODUCTS_SELECTED', 'Nie wybrano produktu' );

define( 'PRODUCTS_ATTRIBUTES_EDITING', 'EDYCJA WARTO¦CI CECHY' ); // title
define( 'TEXT_SAVE_CHANGES', 'ZAPISYWANIE ZMIAN: ' );
define( 'TEXT_PRICES_AND_WEIGHTS', 'Ceny i wagi' );
define( 'TABLE_HEADING_ATTRIBUTES_PRICE_ONETIME', 'Jednorazowo: ' );
define( 'TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR', 'Mno¿nik ceny: ' );
define( 'TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR_OFFSET', 'Przesuniêcie: ' );
define( 'TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR_ONETIME', 'Mno¿nik jednorazowy: ' );
define( 'TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR_OFFSET_ONETIME', 'Przesuniêcie: ' );
define( 'TABLE_HEADING_ATTRIBUTES_QTY_PRICES', 'Obni¿ka ilo¶ciowa dla cechy: ' );
define( 'TABLE_HEADING_ATTRIBUTES_QTY_PRICES_ONETIME', 'Jednorazowa obni¿ka ilo¶ciowa dla cechy: ' );
define( 'TABLE_HEADING_ATTRIBUTES_PRICE_WORDS', 'Cena za s³owo: ' );
define( 'TABLE_HEADING_ATTRIBUTES_PRICE_WORDS_FREE', ' - Darmowe s³owa: ' );
define( 'TABLE_HEADING_ATTRIBUTES_PRICE_LETTERS', 'Cena zalist: ' );
define( 'TABLE_HEADING_ATTRIBUTES_PRICE_LETTERS_FREE', ' - Darmowe listy: ' );

define( 'TEXT_ATTRIBUTES_FLAGS', 'Ustawienia<br />w³asno¶ci cech:' );
define( 'TEXT_ATTRIBUTES_DISPLAY_ONLY', 'U¿yj tylko<br />do wy¶wietlenia cech: ' );
define( 'TEXT_ATTRIBUTES_IS_FREE', 'Cecha darmowy<br />Je¶li produkt jest darmowy: ' );
define( 'TEXT_ATTRIBUTES_DEFAULT', 'Cecha domy¶lna<br />zaznaczona domy¶lnie: ' );
define( 'TEXT_ATTRIBUTE_IS_DISCOUNTED', 'Do³±cz do<br />promocji/obni¿ek: ' );
define( 'TEXT_ATTRIBUTE_PRICE_BASE_INCLUDED', 'Wstaw cenê bazow±<br />kiedy cechy zmieniaj± ceny:' );
define( 'TEXT_ATTRIBUTES_REQUIRED', 'Cecha wymagana<br />Dla tekstu: ' );

define( 'TEXT_ATTRIBUTES_IMAGE', 'Cecha - obrazek: ' );
define( 'TEXT_ATTRIBUTES_IMAGE_DIR', 'Katalog obrazka: ' );
define( 'TABLE_HEADING_DOWNLOAD', 'Produkt do pobrania: ' );
define( 'TABLE_TEXT_FILENAME', 'Nazwa pliku: ' );
define( 'TABLE_TEXT_MAX_DAYS', 'Wa¿ne dni: (0 = bez ograniczeñ) ' );
define( 'TABLE_TEXT_MAX_COUNT', 'Maksymalna liczba pobrañ: ' );

define( 'PRODUCTS_ATTRIBUTES_DELETE', 'USUWANIE' ); // title
define( 'TEXT_DELETE_ALL_ATTRIBUTES', 'Czy na pewno usun±æ wszystkie cechy dla produktu<br />ID: ' );
define( 'TEXT_DELETE_ATTRIBUTES_OPTION_NAME_VALUES', 'Potwierd¼ usuniêcie WSZYSTKICH cech produktu i warto¶ci cechy dla tej cechy ...' );
define( 'TEXT_INFO_PRODUCT_NAME', '<strong>Nazwa produktu:</strong> ' );
define( 'TEXT_INFO_PRODUCTS_OPTION_ID', '<strong>ID</strong> ' );
define( 'TEXT_INFO_PRODUCTS_OPTION_NAME', '<strong>Nazwa cechy:</strong> ' );

define( 'TEXT_INFO_ATTRIBUTES_FEATURE_COPY_TO', 'Wybierz produkt, do którego zostan± skopiowane wszystkie cechy:' );
define( 'TEXT_INFO_ATTRIBUTES_FEATURE_CATEGORIES_COPY_TO', 'Wybierz kategoriê, do której zostan± skopiowane wszystkie cechy:' );

define( 'TABLE_TEXT_MAX_DAYS_SHORT', 'Dni: ' );
define( 'TABLE_TEXT_MAX_COUNT_SHORT', 'Max: ' );

define( 'PRODUCTS_ATTRIBUTES_ADDING', 'DODAWANIE NOWYCH CECH' ); // title
define( 'TEXT_ATTRIBUTES_INSERT_INFO', '<strong>Zdefiniuj w³asno¶ci cechy, a nastêpnie naci¶nij Wstaw</strong>' );
define( 'TEXT_DOWNLOADS_DISABLED', 'UWAGA: Wgrywanie obrazków jest wy³±czone' );

define( 'SUCCESS_PRODUCT_UPDATE_SORT_NONE', 'Brak cech do aktualizacji sortowania dla produktu o ID: ' );
define( 'ATTRIBUTE_WARNING_DUPLICATE', 'Zduplikowana cecha - cecha nie zosta³a dodana' ); // attributes duplicate warning
define( 'ATTRIBUTE_WARNING_INVALID_MATCH', 'Cecha i warto¶æ cechy nie s± tego samego typu - Cecha nie zosta³a dodana' ); // miss matched option and options value
define( 'ATTRIBUTE_WARNING_DUPLICATE_UPDATE', 'Istnieje ju¿ taka cecha - Cecha nie zosta³a zmieniona' ); // attributes duplicate warning
define( 'ATTRIBUTE_WARNING_INVALID_MATCH_UPDATE', 'Cecha i warto¶æ cechy nie s± tego samego typu - Cecha nie zosta³a zmieniona' ); // miss matched option and options value
define( 'SUCCESS_ATTRIBUTES_DELETED_OPTION_NAME_VALUES', 'Pomy¶lnie usuniêto wszystkie warto¶ci cech dla opcji: ' );
define( 'WARNING_PRODUCT_COPY_TO_CATEGORY_NONE', 'Nie wybrano kategorii ' );

/**/
define( 'TABLE_HEADING_OPT_DISCOUNTED', 'Obni¿ki' );
define( 'TABLE_HEADING_PRICE_BASE_INCLUDED','Cena bazowa' );

define( 'TEXT_SORT', ' Sortowanie: ' );
define( 'TABLE_HEADING_OPT_DEFAULT', 'Domy¶lnie' );

define( 'TABLE_HEADING_OPTION_VALUE_ROWS', 'Wiersze' );
define( 'TABLE_HEADING_OPTION_VALUE_COMMENTS', 'Komentarze' );

define( 'TEXT_ATTRIBUTES_COPY_PRODUCTS', 'Kopiuj do produktu' );
define( 'TEXT_ATTRIBUTES_COPY_CATEGORY', 'Kopiuj do kategorii' );

define( 'TEXT_SPECIAL_PRICE', 'Cena promocyjna: ' );
define( 'TEXT_SALE_PRICE', 'Cena po obni¿ce: ' );
define( 'TEXT_FREE', 'DARMOWO' );
define( 'TEXT_CALL_FOR_PRICE', 'Cena na telefon' );

?>