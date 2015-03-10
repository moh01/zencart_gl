<?php
/**
 *
 * @version $Id: options_values_manager.php, v 1.3.7 2007/04/26 11:48:12 $;
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

/* z categories */
define( 'TEXT_COPY_ATTRIBUTES_CONDITIONS', '<strong>Co zrobiæ z istniej±cymi cechami?</strong>' );
define( 'TEXT_COPY_ATTRIBUTES_DELETE', '<strong>Usuñ</strong>, potem skopiuj nowe' );
define( 'TEXT_COPY_ATTRIBUTES_UPDATE', '<strong>Zmieñ</strong> cechy/ceny, potem dodaj nowe' );
define( 'TEXT_COPY_ATTRIBUTES_IGNORE', '<strong>Pomiñ</strong> i dodaj tylko nowe' );
define( 'TABLE_HEADING_YES', 'Tak' );
define( 'TABLE_HEADING_NO', 'Nie' );

/* option name manager */
define( 'TEXT_PRODUCT_OPTIONS_INFO', '<strong>UWAGA: Edytuj cechê ¿eby ustawiæ dodatkowe parametry</strong>' );
define( 'HEADING_TITLE_OPT', 'Zarz±dzanie nazwami cech produktu' );
define( 'TEXT_OPTION_ID', 'ID cechy' );
define( 'TEXT_OPTION_NAME', 'Nazwa cechy' );
define( 'TABLE_HEADING_ID', 'ID' );
define( 'TABLE_HEADING_OPT_NAME', 'Nazwa cechy' );
define( 'TABLE_HEADING_OPT_TYPE', 'Rodzaj opcji' ); //CLR 031203 add option type column
define( 'TABLE_HEADING_OPTION_SORT_ORDER', 'Sortowanie' );
define( 'TABLE_HEADING_OPTION_VALUE_SIZE', 'Rozmiar' );
define( 'TABLE_HEADING_OPTION_VALUE_MAX', 'Maksymalnie' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );
define( 'TEXT_SORT', ' Sortowanie: ' );
define( 'TEXT_OPTION_VALUE_COMMENTS', 'Komentarze: ' );
define( 'TEXT_OPTION_VALUE_SIZE', 'Poka¿ rozmiar: ' );
define( 'TEXT_OPTION_VALUE_MAX', 'D³ugo¶æ maksymalna: ' );

define( 'TEXT_OPTION_VALUE_DELETE_ALL', '<br /><strong>Usuñ WSZYSTKIE warto¶ci cechy WSZYSTKICH produktów dla cechy</strong>' );
define( 'TEXT_INFO_OPTION_VALUE_DELETE_ALL', 'Zmieñ WSZYSTKIE produkty, które maj± conajmniej JEDN¡ warto¶æ cechy i usuñ WSZYSTKIE warto¶ci cechy dla cechy' );

define( 'TEXT_OPTION_VALUE_COPY_ALL', '<strong>Skopiuj WSZYSTKIE warto¶ci cechy do innej cechy</strong>' );
define( 'TEXT_INFO_OPTION_VALUE_COPY_ALL', 'Wszystkie warto¶ci cechy zostan± skopiowane z jednej cechy do innej' );
define( 'TEXT_SELECT_OPTION_FROM', 'Kopiuj z cechy: ' );
define( 'TEXT_SELECT_OPTION_TO', 'Kopiuj wszystkie warto¶ci do cechy: ' );

define( 'TEXT_WARNING_OF_DELETE', '<span class="alert">Ta cecha zawiera produkty i warto¶ci cech dowi±zanych do niego - nie jest bezpieczne usuwanie tej opcji.<br />UWAGA: ¯adne pliki dla tej opcji nie zostan± usuniête z serwera.</span>' );
define( 'TABLE_HEADING_PRODUCT', 'Nazwa produktu' );
define( 'TABLE_HEADING_OPT_VALUE', 'Warto¶æ cechy' );
define( 'TEXT_OK_TO_DELETE', 'Ta cecha nie zawiera produktów ani warto¶ci - mo¿na j± bezpiecznie usun±æ.' );
define( 'ATTRIBUTE_POSSIBLE_OPTIONS_NAME_WARNING_DUPLICATE', 'Mo¿liwe dodanie nazwy cechy, która ju¿ istnieje' );

// Options Name Duplicate warning
define( 'ERROR_OPTION_VALUES_COPIED', 'B³±d - Nie mo¿na kopiowaæ tych samych warto¶ci cech i cech! ' );
define( 'SUCCESS_OPTION_VALUES_COPIED', 'Kopiowanie pomy¶lne! ' );
define( 'ERROR_OPTION_VALUES_NONE', 'B³±d - Nic nie skopiowano! ' );

/* attributes controller */
define( 'TABLE_HEADING_OPT_PRICE_PREFIX', 'Prefiks, ' );
define( 'TABLE_HEADING_OPT_PRICE', 'Cena' );
define( 'TABLE_HEADING_OPT_WEIGHT_PREFIX', 'Prefiks, ' );
define( 'TABLE_HEADING_OPT_WEIGHT', 'Waga' );
define( 'TABLE_HEADING_OPT_SORT_ORDER', 'Sortowanie' );
define( 'PRODUCTS_ATTRIBUTES_EDITING', 'EDYCJA WARTO¦CI CECHY' ); // title
define( 'TEXT_ATTRIBUTES_FLAGS', 'Ustawienia<br />w³asno¶ci cech:' );
define( 'TEXT_ATTRIBUTES_FLAGS', 'Ustawienia<br />w³asno¶ci cech:' );
define( 'TEXT_ATTRIBUTES_DISPLAY_ONLY', 'U¿yj tylko<br />do wy¶wietlenia cech: ' );
define( 'TEXT_ATTRIBUTES_IS_FREE', 'Cecha darmowy<br />Je¶li produkt jest darmowy: ' );
define( 'TEXT_ATTRIBUTES_DEFAULT', 'Cecha domy¶lna<br />zaznaczona domy¶lnie: ' );
define( 'TEXT_ATTRIBUTE_IS_DISCOUNTED', 'Do³±cz do<br />promocji/obni¿ek: ' );
define( 'TEXT_ATTRIBUTE_PRICE_BASE_INCLUDED', 'Wstaw cenê bazow±<br />kiedy cechy zmieniaj± ceny:' );
define( 'TEXT_ATTRIBUTES_IMAGE', 'Cecha - obrazek: ' );
define( 'TEXT_ATTRIBUTES_IMAGE_DIR', 'Katalog obrazka: ' );
define( 'TABLE_HEADING_DOWNLOAD', 'Produkt do pobrania: ' );
define( 'TABLE_TEXT_FILENAME', 'Nazwa pliku: ' );
define( 'TABLE_TEXT_MAX_DAYS', 'Wa¿ne dni: (0 = bez ograniczeñ) ' );
define( 'TABLE_TEXT_MAX_COUNT', 'Maksymalna liczba pobrañ: ' );
define( 'PRODUCTS_ATTRIBUTES_DELETE', 'USUWANIE' ); // title
define( 'TABLE_TEXT_MAX_DAYS_SHORT', 'Dni: ' );
define( 'TABLE_TEXT_MAX_COUNT_SHORT', 'Max: ' );
define( 'PRODUCTS_ATTRIBUTES_ADDING', 'DODAWANIE NOWYCH CECH' ); // title
define( 'TEXT_DOWNLOADS_DISABLED', 'UWAGA: Wgrywanie obrazków jest wy³±czone' );
define( 'ATTRIBUTE_WARNING_DUPLICATE', 'Zduplikowana cecha - cecha nie zosta³a dodana' ); // attributes duplicate warning
define( 'ATTRIBUTE_WARNING_INVALID_MATCH', 'Cecha i warto¶æ cechy nie s± tego samego typu - Cecha nie zosta³a dodana' ); // miss matched option and options value
define( 'ATTRIBUTE_WARNING_DUPLICATE_UPDATE', 'Istnieje ju¿ taka cecha - Cecha nie zosta³a zmieniona' ); // attributes duplicate warning
define( 'ATTRIBUTE_WARNING_INVALID_MATCH_UPDATE', 'Cecha i warto¶æ cechy nie s± tego samego typu - Cecha nie zosta³a zmieniona' ); // miss matched option and options value

/* wlasne */
define( 'ATTRIBUTE_POSSIBLE_OPTIONS_VALUE_WARNING_DUPLICATE', 'Mo¿liwe dodanie warto¶ci cechy, która ju¿ istnieje' ); // Options Value Duplicate warning

define( 'TEXT_INFO_FROM', ' z: ' );
define( 'TEXT_INFO_TO', ' do: ' );
define( 'ERROR_OPTION_VALUES_COPIED_MISMATCH', 'B³±d: Cecha i warto¶ci cechy nie pasuj± do siebie' );
define( 'ERROR_OPTION_VALUES_COPIED_MISMATCH_PRODUCTS_ID', 'B³±d: Brak cechy/Warto¶ci dla produktu o ID#' );

define( 'ERROR_OPTION_VALUES_DELETE_MISMATCH', 'B³±d: Cecha i warto¶ci cechy nie pasuj± do siebie' );
define( 'SUCCESS_OPTION_VALUES_DELETE', 'Sukces: Usuniêto: ' );

define( 'HEADING_TITLE_VAL', 'Zarz±dzanie warto¶ciami cech produktu' );
define( 'TABLE_HEADING_OPTION_VALUE_SORT_ORDER', 'Sortowanie domy¶lne' );

define( 'TEXT_SELECT_OPTION_VALUES_TO_CATEGORIES_ID', 'Pozostaw puste dla WSZYSTKICH produktów lub<br />wpisz ID kategorii' );
define( 'TEXT_SELECT_OPTION_FROM_PRODUCTS_ID', 'Domy¶lna nowa warto¶æ z produktu o ID# lub pozostaw puste dla braku domy¶lnej warto¶ci cechy: ' );
define( 'TEXT_SELECT_OPTION_VALUES_FROM', 'Warto¶æ cechy do zmiany: ' );
define( 'TEXT_SELECT_OPTION_VALUES_TO', 'Warto¶æ cechy do dodania: ' );

define( 'TEXT_SELECT_DELETE_OPTION_FROM', 'Cecha do zmiany: ' );
define( 'TEXT_SELECT_DELETE_OPTION_VALUES_FROM', 'Warto¶æ cechy do zmiany: ' );

define( 'TEXT_OPTION_VALUE_COPY_OPTIONS_TO', '<strong>Skopiuj Cechê/Warto¶æ do produktów, które posiadaj± cechê ...</strong>' );
define( 'TEXT_INFO_OPTION_VALUE_COPY_OPTIONS_TO', 'Wybierz cechê i warto¶æ, które obecnie istniej± dla produktu lub produktów, aby dodaæ do wszystkich produktów, albo produktów z wybranej kategorii, która posiada dan± cechê.<br /><strong>Przyk³ad:</strong> Dodaj cechê: Kolor, Warto¶æ: czerwony do wszystkich produktów, posiadaj±cych cechê: Sprzêt<br /><strong>Przyk³ad:</strong> Dodaj cechê: Kolor, Warto¶æ: zielony jako domy¶ln± z produktu o ID: 15 do wszystkich produktów, posiadaj±cych cechê: Sprzêt<br /><strong>Przyk³ad:</strong> Dodaj cechê: Kolor, Warto¶æ: zielony jako domy¶ln± z produktu o ID: 15 do wszystkich produktów, posiadaj±cych cechê: Sprzêt z kateegorii o ID: 1' );
define( 'TEXT_SELECT_OPTION_FROM_ADD', 'Cecha do dodania: ' );
define( 'TEXT_SELECT_OPTION_VALUES_FROM_ADD', 'Warto¶æ cechy do dodania: ' );
define( 'TEXT_SELECT_OPTION_TO_ADD_TO', 'Cecha do dodania do: ' );

/**/
define('HEADING_TITLE_ATRIB', 'Cechy produktów');

define( 'TABLE_HEADING_OPT_DISCOUNTED', 'Obni¿ki' );
define( 'TABLE_HEADING_OPT_DEFAULT', 'Domy¶lna' );
define( 'TABLE_HEADING_OPTION_VALUE_ROWS', 'Wiersze' );
define( 'TABLE_HEADING_OPTION_VALUE_COMMENTS', 'Komentarze' );

?>