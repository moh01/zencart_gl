<?php
/**
 *
 * @version $Id: options_name_manager.php, v 1.3.7 2007/04/26 11:48:12 $;
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

/* categories */
define( 'TABLE_HEADING_YES', 'Tak' );
define( 'TABLE_HEADING_NO', 'Nie' );

/* option values manager */
define( 'ATTRIBUTE_POSSIBLE_OPTIONS_VALUE_WARNING_DUPLICATE', 'Mo�liwe dodanie warto�ci cechy, kt�ra ju� istnieje' ); // Options Value Duplicate warning
define( 'HEADING_TITLE_VAL', 'Zarz�dzanie warto�ciami cech produktu' );
define( 'TABLE_HEADING_OPTION_VALUE_SORT_ORDER', 'Sortowanie domy�lne' );

/* attributes controller */
define( 'HEADING_TITLE_ATRIB', 'Zarz�dzanie cechami i warto�ciami cech' );
define( 'TABLE_HEADING_OPT_PRICE_PREFIX', 'Prefiks, ' );
define( 'TABLE_HEADING_OPT_PRICE', 'Cena' );
define( 'TABLE_HEADING_OPT_WEIGHT_PREFIX', 'Prefiks, ' );
define( 'TABLE_HEADING_OPT_WEIGHT', 'Waga' );
define( 'TABLE_HEADING_OPT_SORT_ORDER', 'Sortowanie' );
define( 'PRODUCTS_ATTRIBUTES_EDITING', 'EDYCJA WARTO�CI CECHY' ); // title
define( 'TEXT_ATTRIBUTES_FLAGS', 'Ustawienia<br />w�asno�ci cech:' );
define( 'TEXT_ATTRIBUTES_FLAGS', 'Ustawienia<br />w�asno�ci cech:' );
define( 'TEXT_ATTRIBUTES_DISPLAY_ONLY', 'U�yj tylko<br />do wy�wietlenia cech: ' );
define( 'TEXT_ATTRIBUTES_IS_FREE', 'Cecha darmowy<br />Je�li produkt jest darmowy: ' );
define( 'TEXT_ATTRIBUTES_DEFAULT', 'Cecha domy�lna<br />zaznaczona domy�lnie: ' );
define( 'TEXT_ATTRIBUTE_IS_DISCOUNTED', 'Do��cz do<br />promocji/obni�ek: ' );
define( 'TEXT_ATTRIBUTE_PRICE_BASE_INCLUDED', 'Wstaw cen� bazow�<br />kiedy cechy zmieniaj� ceny:' );
define( 'TEXT_ATTRIBUTES_IMAGE', 'Cecha - obrazek: ' );
define( 'TEXT_ATTRIBUTES_IMAGE_DIR', 'Katalog obrazka: ' );
define( 'TABLE_HEADING_DOWNLOAD', 'Produkt do pobrania: ' );
define( 'TABLE_TEXT_FILENAME', 'Nazwa pliku: ' );
define( 'TABLE_TEXT_MAX_DAYS', 'Wa�ne dni: (0 = bez ogranicze�) ' );
define( 'TABLE_TEXT_MAX_COUNT', 'Maksymalna liczba pobra�: ' );
define( 'PRODUCTS_ATTRIBUTES_DELETE', 'USUWANIE' ); // title
define( 'TABLE_TEXT_MAX_DAYS_SHORT', 'Dni: ' );
define( 'TABLE_TEXT_MAX_COUNT_SHORT', 'Max: ' );
define( 'PRODUCTS_ATTRIBUTES_ADDING', 'DODAWANIE NOWYCH CECH' ); // title
define( 'TEXT_DOWNLOADS_DISABLED', 'UWAGA: Wgrywanie obrazk�w jest wy��czone' );
define( 'ATTRIBUTE_WARNING_DUPLICATE', 'Zduplikowana cecha - cecha nie zosta�a dodana' ); // attributes duplicate warning
define( 'ATTRIBUTE_WARNING_INVALID_MATCH', 'Cecha i warto�� cechy nie s� tego samego typu - Cecha nie zosta�a dodana' ); // miss matched option and options value
define( 'ATTRIBUTE_WARNING_DUPLICATE_UPDATE', 'Istnieje ju� taka cecha - Cecha nie zosta�a zmieniona' ); // attributes duplicate warning
define( 'ATTRIBUTE_WARNING_INVALID_MATCH_UPDATE', 'Cecha i warto�� cechy nie s� tego samego typu - Cecha nie zosta�a zmieniona' ); // miss matched option and options value

/* wlasne */
define( 'TEXT_PRODUCT_OPTIONS_INFO', '<strong>UWAGA: Edytuj cech� �eby ustawi� dodatkowe parametry</strong>' );
define( 'HEADING_TITLE_OPT', 'Zarz�dzanie nazwami cech produktu' );
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
define( 'TEXT_OPTION_VALUE_COMMENTS', 'Komentarz: ' );
define( 'TEXT_OPTION_VALUE_ROWS', 'Wiersze: ' );
define( 'TEXT_OPTION_VALUE_SIZE', 'Poka� rozmiar: ' );
define( 'TEXT_OPTION_VALUE_MAX', 'D�ugo�� maksymalna: ' );
define( 'TEXT_OPTION_ATTRIBUTE_IMAGES_PER_ROW', 'Obrazki cech w wierszu: ' );
define( 'TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE', 'Styl dla cech rodzaju Radio/Checkbox: ' );
define( 'TEXT_OPTION_ATTIBUTE_MAX_LENGTH', '<strong>UWAGA: Wiersze, Rozmiar i D�ugo�� maksymalna tylko dla cech rodzaj�w tekstowych:</strong><br />' );
define( 'TEXT_OPTION_IMAGE_STYLE', '<strong>Style obrazk�w:</strong>' );
define( 'TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_0', '0= Element, Obrazek i warto�� cechy poni�ej' );
define( 'TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_1', '1= Element, Obrazek i warto�� cechy obok' );
define( 'TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_2', '2= Element, Warto�� cechy, Obrazek poni�ej' );
define( 'TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_3', '3= Element i Obrazek obok, Warto�� cechy poni�ej' );
define( 'TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_4', '4= Obrazek, Warto�� cechy i Element pionowo' );
define( 'TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_5', '5= Element, Obrazek i Warto�� cechy pionowo' );

define( 'TEXT_WARNING_BACKUP', 'Ostrze�enie: Zr�b kopi� bazy danych je�li wprwadzasz zmiany globalnie' );

define( 'TEXT_OPTION_VALUE_ADD_ALL', '<br /><strong>Dodaj WSZYSTKIE warto�ci cech dla WSZYSTKICH produkt�w posiadaj�cych t� cech�</strong>' );
define( 'TEXT_INFO_OPTION_VALUE_ADD_ALL', 'Zmie� WSZYSTKIE produkty, kt�re maj� conajmniej JEDN� warto�� cechy i dodaj warto�� cechy dla cechy' );
define( 'TEXT_SELECT_OPTION', 'Wybierz nazw� cechy: ' );
define( 'TEXT_OPTION_VALUE_ADD_PRODUCT', '<br /><strong>Dodaj WSZYSTKIE warto�ci cechy do JEDNEGO produktu dla cechy</strong>' );
define( 'TEXT_INFO_OPTION_VALUE_ADD_PRODUCT', 'Zmie� JEDEN produkt, kt�ry posiada conajmniej JEDN� warto�� cechy i dodaj WSZYSTKIE warto�ci cechy dla cechy' );
define( 'TEXT_SELECT_PRODUCT', ' Wybierz produkt ' );
define( 'TEXT_OPTION_VALUE_ADD_CATEGORY', '<br /><strong>Dodaj WSZYSTKIE warto�ci cechy do JEDNEJ kategorii dla cechy</strong>' );
define( 'TEXT_INFO_OPTION_VALUE_ADD_CATEGORY', 'Zmie� JEDN� kategori�, kt�ra zawiera produkt, kt�ry posiada conajmniej JEDN� warto�� cechy i dodaj WSZYSTKIE warto�ci cechy dla cechy' );
define( 'TEXT_SELECT_CATEGORY', ' Wybierz kategori� ' );
define( 'TEXT_COMMENT_OPTION_VALUE_ADD_ALL', '<strong>UWAGA:</strong> Sortowanie zostanie ustawione na domy�lne sortowanie dla warto�ci cech dla tych produkt�w' );

define( 'TEXT_OPTION_VALUE_DELETE_ALL', '<br /><strong>Usu� WSZYSTKIE warto�ci cechy WSZYSTKICH produkt�w dla cechy</strong>' );
define( 'TEXT_INFO_OPTION_VALUE_DELETE_ALL', 'Zmie� WSZYSTKIE produkty, kt�re maj� conajmniej JEDN� warto�� cechy i usu� WSZYSTKIE warto�ci cechy dla cechy' );
define( 'TEXT_OPTION_VALUE_DELETE_PRODUCT', '<br /><strong>Usu� WSZYSTKIE warto�ci cechy dla JEDNEGO produktu dla cechy</strong>' );
define( 'TEXT_INFO_OPTION_VALUE_DELETE_PRODUCT', 'Zmie� JEDEN produkt, kt�ry posaida conajmniej JEDN� warto�� cechy i usu� WSZYSTKIE warto�ci cechy dla cechy' );
define( 'TEXT_OPTION_VALUE_DELETE_CATEGORY', '<br /><strong>Usu� WSZYSTKIE warto�ci cechy JEDNEJ Kategorii dla cechy</strong>' );
define( 'TEXT_INFO_OPTION_VALUE_DELETE_CATEGORY', 'Zmie� JEDN� kategori�, kt�ra zawiera produkt, kt�ry posiada conajmniej JEDN� warto�� cechy i usu� WSZYSTKIE warto�ci cech dla cechy' );
define( 'TEXT_COMMENT_OPTION_VALUE_DELETE_ALL', '<strong>UWAGA:</strong> Wszystkie cechy i ich warto�ci zostan� usuni�te dla wybranych produkt�w.' );

define( 'TEXT_OPTION_VALUE_COPY_ALL', '<strong>Skopiuj WSZYSTKIE warto�ci cechy do innej cechy</strong>' );
define( 'TEXT_INFO_OPTION_VALUE_COPY_ALL', 'Wszystkie warto�ci cechy zostan� skopiowane z jednej cechy do innej' );
define( 'TEXT_SELECT_OPTION_FROM', 'Kopiuj z cechy: ' );
define( 'TEXT_SELECT_OPTION_TO', 'Kopiuj do cechy: ' );

define( 'TEXT_WARNING_OF_DELETE', 'Ta cecha zawiera produkty i warto�ci cech dowi�zanych do niego - nie jest bezpieczne usuwanie tej opcji.' );
define( 'TABLE_HEADING_PRODUCT', 'Nazwa produktu' );
define( 'TABLE_HEADING_OPT_VALUE', 'Warto�� cechy' );
define( 'TEXT_OK_TO_DELETE', 'Ta cecha nie zawiera produkt�w ani warto�ci - mo�na j� bezpiecznie usun��.<br />Wszystkie warto�ci cechy dla tej cechy zostan� usuni�te.' );

define( 'ATTRIBUTE_POSSIBLE_OPTIONS_NAME_WARNING_DUPLICATE', 'Mo�liwe dodanie nazwy cechy, kt�ra ju� istnieje' ); // Options Name Duplicate warning
define( 'ERROR_PRODUCTS_OPTIONS_VALUES', 'OSTRZE�ENIE: Nie znaleziono produkt�w ... Brak zmian' );
define( 'SUCCESS_PRODUCTS_OPTIONS_VALUES', 'Pomy�lnie zaktualizowano cechy ' );
define( 'ERROR_OPTION_VALUES_COPIED', 'B��d - Nie mo�na kopiowa� warto�ci cechy do tej samej cechy! ' );
define( 'SUCCESS_OPTION_VALUES_COPIED', 'Kopiowanie pomy�lne! ' );
define( 'ERROR_OPTION_VALUES_NONE', 'B��d - Kopiowanie z cechy, kt�ra nie ma zdefiniowanych warto�ci cechy. Nic nie skopiowano! ' );

/**/
define( 'TABLE_HEADING_OPT_DISCOUNTED', 'Obni�ki' );
define( 'TABLE_HEADING_OPT_DEFAULT', 'Domy�lna' );
define( 'TABLE_HEADING_OPTION_VALUE_ROWS', 'Wiersze' );
define( 'TABLE_HEADING_OPTION_VALUE_COMMENTS', 'Komentarze' );


?>