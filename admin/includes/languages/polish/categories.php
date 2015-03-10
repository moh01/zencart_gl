<?php
/**
 *
 * @version $Id: categories.php, v 1.3.7 2007/04/26 11:48:12 $;
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
/* Patrz funkcje wgrywane przez init_general_funcs.php */
define( 'TEXT_IMAGE_NONEXISTENT', 'BRAK OBRAZKA' );
define( 'TEXT_ATTRIBUTE_COPY_SKIPPING', '<strong>Pomini�to now� cech�</strong> ' );
define( 'TEXT_ATTRIBUTE_COPY_INSERTING', '<strong>Wstawiono now� cech� nr.:</strong> ' );
define( 'TEXT_ATTRIBUTE_COPY_UPDATING', '<strong>Zaktualizowano cech�</strong> ');
define( 'PRODUCTS_PRICE_IS_FREE_TEXT', 'Darmowy' );
define( 'PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT', 'Cena na telefon' );

/* z polish? */
define( 'TEXT_VIRTUAL_EDIT', 'Ostrze�enie: Ten produkt jest oznaczony jako wirtualny i pomija adres wysy�ki<br />Klient nie b�dzie proszony o adres wysy�ki, je�li wszystkie produkty na zam�wieniu b�d� wirtualne' );
define( 'TEXT_FREE_SHIPPING_EDIT', 'Ostrze�enie: Ten produkt posiada parametr darmowej wysy�ki. Adres wysy�ki jest wymagany<br />Wymaga dzia�aj�cego modu�u darmowej wysy�ki, je�eli wszsytkie produkty na zam�wieniu b�d� mia�y ten status' );
/* z polish - product */
define( 'TEXT_VIRTUAL_PREVIEW', 'Ostrze�enie: Ten produkt jest oznaczony jako wirtualny i pomija adres wysy�ki<br />Klient nie b�dzie proszony o adres wysy�ki, je�li wszystkie produkty na zam�wieniu b�d� wirtualne' );
define( 'TEXT_FREE_SHIPPING_PREVIEW', 'Ostrze�enie: Ten produkt posiada parametr darmowej wysy�ki. Adres wysy�ki jest wymagany<br />Wymaga dzia�aj�cego modu�u darmowej wysy�ki, je�eli wszsytkie produkty na zam�wieniu b�d� mia�y ten status' );

/* z product types */
define( 'TABLE_HEADING_PRODUCT_TYPES', 'Rodzaj(e) produktu' );

/* z product */
define( 'TEXT_PRODUCTS_NAME', 'Nazwa produktu: ' );
define( 'TEXT_PRODUCTS_MODEL', 'Model: ' );
define( 'TEXT_PRODUCTS_PRICE_INFO', 'Cena: ' );

define( 'TEXT_PRODUCTS_STATUS', 'Status produktu: ' );
define( 'TEXT_PRODUCT_AVAILABLE', 'Dost�pny' );
define( 'TEXT_PRODUCT_NOT_AVAILABLE', 'Niedost�pny' );
define( 'TEXT_PRODUCTS_DATE_AVAILABLE', 'Data dost�pno�ci: ' );
define( 'TEXT_PRODUCTS_MANUFACTURER', 'Producent: ' );
define( 'TEXT_PRODUCT_IS_FREE', 'Produkt darmowy: ' );
define( 'TEXT_PRODUCTS_IS_FREE_EDIT', '*Produkt jest oznaczony jako DARMOWY' );
define( 'TEXT_PRODUCT_IS_CALL', 'Cena na telefon: ' );
define( 'TEXT_PRODUCTS_IS_CALL_EDIT', '*Produkt jest oznaczony jako CENA NA TELEFON' );
define( 'TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES', 'Cena produktu zale�na od cech: ' );
define( 'TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE', 'Tak' );
define( 'TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE', 'Nie' );
define( 'TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT', '*Cena tego produktu zale�y od jego cech, wy�wietlona zostanie cena najni�sza' );
define( 'TEXT_PRODUCTS_TAX_CLASS', 'Rodzaj podatku: ' );
define( 'TEXT_PRODUCTS_PRICE_NET', 'Cena netto: ' );
define( 'TEXT_PRODUCTS_PRICE_GROSS', 'Cena brutto: ' );
define( 'TEXT_PRODUCTS_VIRTUAL', 'Produkt wirtualny: ' );
define( 'TEXT_PRODUCT_IS_VIRTUAL', 'Tak, pomi� adres wysy�ki' );
define( 'TEXT_PRODUCT_NOT_VIRTUAL', 'Nie, adres wysy�ki jest wymagany' );
define( 'TEXT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', 'Darmowa wysy�ka: ' );
define( 'TEXT_PRODUCT_IS_ALWAYS_FREE_SHIPPING', 'Tak, wysy�ka zawsze darmowa' );
define( 'TEXT_PRODUCT_NOT_ALWAYS_FREE_SHIPPING', 'Nie, zwyk�e zasady wysy�ki' );
define( 'TEXT_PRODUCTS_QTY_BOX_STATUS', 'Box liczby produkt�w: ' );
define( 'TEXT_PRODUCTS_QTY_BOX_STATUS_ON', 'Tak, wy�wietlaj box' );
define( 'TEXT_PRODUCTS_QTY_BOX_STATUS_OFF', 'Nie, nie pokazuj boxa' );
define( 'TEXT_PRODUCTS_QTY_BOX_STATUS_EDIT', 'Ostrze�enie: Nie b�dzie pokazywany box liczby sztuk, Domy�lna liczba sztuk 1' );
define( 'TEXT_PRODUCTS_QUANTITY_MIN_RETAIL', 'Minimalna liczba zamawianych produkt�w: ' );
define( 'TEXT_PRODUCTS_QUANTITY_MAX_RETAIL', 'Maksymalna liczba zamawianych produkt�w: ' );
define( 'TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT', '0 = Bez ogranicze�, 1 (Brak boxu liczby produkt�w), liczba = maksymalna ilo��' );
define( 'TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL', 'Liczba sztuk w produkcie: ' );
define( 'TEXT_PRODUCTS_MIXED', 'Liczba produkt�w Min/Sztuk Mix:');
define( 'TEXT_PRODUCTS_DESCRIPTION', 'Opis produktu: ' );
define( 'TEXT_PRODUCTS_QUANTITY', 'Dost�pna liczba produkt�w: ' );
define( 'TEXT_PRODUCTS_IMAGE', 'Obrazek produktu: ' );
define( 'TEXT_PRODUCTS_IMAGE_DIR', 'Katalog obrazka: ' );
define( 'TEXT_PRODUCTS_URL', 'Link do produktu: ' );
define( 'TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(bez http://)</small>' );
define( 'TEXT_PRODUCTS_WEIGHT', 'Waga produktu: ' );
define( 'TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_PREVIEW', '*Dla tego produktu ustawiono wy�wietlanie ceny wg. jego cech, wybrana zostanie cena najni�sza' );
define( 'TEXT_PRODUCTS_IS_FREE_PREVIEW', '*Produkt jest oznaczony jako DARMOWY' );
define( 'TEXT_PRODUCTS_IS_CALL_PREVIEW', '*Produkt jest oznaczony jako CENA NA TELEFON' );
define( 'TEXT_PRODUCTS_QTY_BOX_STATUS_PREVIEW', 'Ostrze�enie: Nie b�dzie pokazywany box liczby sztuk, Domy�lna liczba sztuk 1' );
define( 'TEXT_PRODUCT_MORE_INFORMATION', 'Po wi�cej informacji zapraszamy na <a href="http://%s" target="blank">stron� produktu</a>.' );
define( 'TEXT_PRODUCT_DATE_AVAILABLE', 'Ten produkt b�dzie dost�pny od: %s' );
define( 'TEXT_PRODUCT_DATE_ADDED', 'Ten produkt zosta� dodany do sklepu: %s' );

/* attributes controller */
define( 'TEXT_PRODUCT_OPTIONS', '<strong>Cechy produktu:</strong>' );

/* categories */
define( 'HEADING_TITLE', 'Kategorie / Produkty' );
define( 'HEADING_TITLE_GOTO', 'Przejd� do: ' );
define( 'TABLE_HEADING_ID', 'ID' );
define( 'TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategoria / Produkt' );
define( 'TABLE_HEADING_MODEL', 'Model' );
define( 'TABLE_HEADING_PRICE', 'Cena/Promocja/Obni�ka' );
define( 'TABLE_HEADING_QUANTITY', 'Ilo��' );
define( 'TABLE_HEADING_STATUS', 'Status' );
define( 'TABLE_HEADING_CATEGORIES_SORT_ORDER', 'Sortowanie' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );
define( 'TEXT_PRODUCTS_STATUS_ON_OF', ' w��czonych ' );
define( 'TEXT_PRODUCTS_STATUS_ACTIVE', ' aktywnych ' );
define( 'TEXT_CATEGORIES', 'Kategorie: ' );
define( 'TEXT_PRODUCTS', 'Produkty: ' );
define( 'WARNING_PRODUCTS_IN_TOP_INFO', 'OSTRZE�ENIE: Istniej� produkty w kategorii g��wnej. Jest to b��d! Produkty nale�y przenie�� do kategorii, kt�re nie zawieraj� podaktegorii. Znalezione produkty: ' );

define( 'TEXT_INFO_HEADING_STATUS_CATEGORY', 'Zmie� ststus kategorii z: ' );
define( 'TEXT_CATEGORIES_STATUS_WARNING', '<strong>OSTRZE�ENIE...</strong><br />Uwaga: Wy��czenie kategorii wy��czy r�wnie� wszystkie produkty w tej kategorii. Produkty powi�zane umieszczone w tej kategorii b�d� tak�e niedost�pne dla innych kategorii.' );
define( 'TEXT_CATEGORIES_STATUS_INTRO', 'Zmie� ststus kategorii na: ' );
define( 'TEXT_CATEGORIES_STATUS_OFF', 'WY��CZONA' );
define( 'TEXT_CATEGORIES_STATUS_ON', 'W��CZONA' );
define( 'TEXT_PRODUCTS_STATUS_INFO', 'Zmie� ststus wszystkich produkt�w na: ' );
define( 'TEXT_PRODUCTS_STATUS_OFF', 'Wy��czone' );
define( 'TEXT_PRODUCTS_STATUS_ON', 'W��czone' );
define( 'TEXT_PRODUCTS_STATUS_NOCHANGE', 'Bez zmian' );

define( 'TEXT_INFO_HEADING_NEW_CATEGORY', 'Nowa kategoria' );
define( 'TEXT_NEW_CATEGORY_INTRO', 'Podaj informacje dla nowej kategorii' );
define( 'TEXT_CATEGORIES_NAME', 'Nazwa kategorii: ' );
define( 'TEXT_CATEGORIES_DESCRIPTION', 'Opis kategorii: ' );
define( 'TEXT_CATEGORIES_IMAGE', 'Obrazek kategorii: ' );
define( 'TEXT_CATEGORIES_IMAGE_DIR', 'Zapisuj w katalogu: ' );
define( 'TEXT_CATEGORIES_IMAGE_MANUAL', '<strong>lub wybierz obrazek istniej�cy na serwerze wpisuj�c jego nazw�, nazwa pliku:</strong> ' );
define( 'TEXT_SORT_ORDER', 'Sortowanie: ' );

define( 'TEXT_INFO_HEADING_EDIT_CATEGORY', 'Edytuj kategori�' );
define( 'TEXT_EDIT_INTRO', 'Wprowad� zmiany' );
define( 'TEXT_EDIT_CATEGORIES_NAME', 'Nazwa kategorii: ' );
define( 'TEXT_EDIT_CATEGORIES_IMAGE', 'Obrazek kategorii: ' );
define( 'TEXT_EDIT_SORT_ORDER', 'Sortowanie: ' );
define( 'TEXT_RESTRICT_PRODUCT_TYPE', 'Przypisz do rodzaju produktu' );
define( 'TEXT_CATEGORY_HAS_RESTRICTIONS', 'Ta kategoria zosta�a przypisana do rodzaju produktu.' );

define( 'TEXT_INFO_HEADING_DELETE_CATEGORY', 'Usu� kategori�' );
define( 'TEXT_DELETE_CATEGORY_INTRO', 'Czy na pewno chces usun�� t� kategori�?' );
define( 'TEXT_DELETE_CATEGORY_INTRO_LINKED_PRODUCTS', '<strong>Ostrze�enie:</strong> Powi�zane produkty, kt�re zawiera kategoria zostan� usuni�te. Powiniene� najpierw zlikwidowa� powi�zania produkt�w np.: poprzez przeniesienie ich do kategorii g��wnej zanim usuniesz kategori�' );
define( 'TEXT_DELETE_WARNING_CHILDS', '<strong>UWAGA:</strong> Istnieje %s podkategorii wci�� powi�zanych z t� kategori�!' );
define( 'TEXT_DELETE_WARNING_PRODUCTS', '<strong>UWAGA:</strong> Istnieje %s produkt�w wci�� powi�zanych z t� kategori�!' );

define( 'TEXT_INFO_HEADING_EDIT_CATEGORY_META_TAGS', 'Definicje MetaTag�w' );
define( 'TEXT_EDIT_CATEGORIES_META_TAGS_INTRO', 'Zdefiniuj MetaTagi dla kategorii ID ' );
define( 'TEXT_EDIT_CATEGORIES_META_TAGS_TITLE', 'Tytu�: ' );
define( 'TEXT_EDIT_CATEGORIES_META_TAGS_KEYWORDS', 'S�owa kluczowe: ' );
define( 'TEXT_EDIT_CATEGORIES_META_TAGS_DESCRIPTION', 'Opis: ' );

define( 'TEXT_INFO_HEADING_MOVE_CATEGORY', 'Przenie� kategori�' );
define( 'TEXT_MOVE_CATEGORIES_INTRO', 'Wybierz kategori� w kt�rej kategoria <strong>%s</strong> ma si� znajdowa�' );
define( 'TEXT_MOVE', 'Przenie� <strong>%s</strong> do: ' );

define( 'TEXT_INFO_HEADING_DELETE_PRODUCT', 'Usu� produkt' );
define( 'TEXT_DELETE_PRODUCT_INTRO', 'Czy na pewno chcesz ca�kowicie usun�� ten produkt?' );

define( 'TEXT_INFO_HEADING_MOVE_PRODUCT', 'Przenie� produkt' );
define( 'TEXT_MOVE_PRODUCTS_INTRO', 'Wybierz kategori� w kt�rej produkt <b>%s</b> ma si� znajdowa�' );
define( 'TEXT_INFO_CURRENT_CATEGORIES', 'Bie��ce kategorie: ' );

define( 'TEXT_INFO_HEADING_COPY_TO', 'Kopiuj do' );
define( 'TEXT_INFO_COPY_TO_INTRO', 'Wybierz now� kategori� do kt�rej chcia�by� skopiowa� ten produkt' );
define( 'TEXT_INFO_CURRENT_PRODUCT', 'Obecny produkt: ' );
define( 'TEXT_HOW_TO_COPY', 'Spos�b kopiowania: ' );
define( 'TEXT_COPY_AS_LINK', 'Powi��' );
define( 'TEXT_COPY_AS_DUPLICATE', 'Duplikuj' );
define( 'TEXT_COPY_ATTRIBUTES_ONLY', 'Tylko dla duplikowania produkt�w ...');
define( 'TEXT_COPY_ATTRIBUTES', 'Kopiuj cechy produktu do duplikowanego' );
define( 'TEXT_COPY_ATTRIBUTES_YES', 'Tak' );
define( 'TEXT_COPY_ATTRIBUTES_NO', 'Nie' );

define( 'TEXT_INFO_HEADING_ATTRIBUTE_FEATURES', 'Zmiana cech dla produktu ID# ' );
define( 'TEXT_PRODUCTS_ATTRIBUTES_INFO', 'Cechy produktu: ' );
define( 'TEXT_PRODUCT_ATTRIBUTES_DOWNLOADS', 'Pobieranie/Download: ' );
define( 'TEXT_INFO_ATTRIBUTES_FEATURES_DELETE', 'Usu� <strong>WSZYSTKIE</strong> cechy dla produktu:<br />' );
define( 'TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT', 'Kopuj cechy produktu do innego produktu z <strong>produktu</strong>:<br />ID: ' );
define( 'TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY', 'Kopuj cechy do kategorii z <strong>produktu</strong>:<br />ID: ' );

define( 'TEXT_COPY_ATTRIBUTES_CONDITIONS', '<strong>Co zrobi� z istniej�cymi cechami?</strong>' );
define( 'TEXT_COPY_ATTRIBUTES_DELETE', '<strong>Usu�</strong>, potem skopiuj nowe' );
define( 'TEXT_COPY_ATTRIBUTES_UPDATE', '<strong>Zmie�</strong> cechy/ceny, potem dodaj nowe' );
define( 'TEXT_COPY_ATTRIBUTES_IGNORE', '<strong>Pomi�</strong> i dodaj tylko nowe' );

define( 'SUCCESS_ATTRIBUTES_DELETED', 'Cechy usuni�to pomy�lnie' );
define( 'SUCCESS_ATTRIBUTES_UPDATE', 'Cechy zaktualizowano pomy�lnie' );

define( 'ERROR_CANNOT_ADD_PRODUCT_TYPE', 'Ten rodzaj produkt�w nie mo�e by� dodany do tej kategorii. Sprawd� ograniczenia kategorii.' );

/**/
define( 'TEXT_SUBCATEGORIES', 'Podkategorie: ' );
define( 'TEXT_PRODUCTS_AVERAGE_RATING', '�rednia ocena: ' );
define( 'TEXT_PRODUCTS_QUANTITY_INFO', 'Ilo��: ' );
define( 'TEXT_DATE_ADDED', 'Data dodania: ' );
define( 'TEXT_DATE_AVAILABLE', 'Dost�pny od dnia: ' );
define( 'TEXT_LAST_MODIFIED', 'Ostatnia modyfikacja: ' );
define( 'TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Dodaj now� kategori� lub produkt w tej kategorii' );

define( 'TEXT_EDIT_CATEGORIES_ID', 'ID kategorii: ' );
define( 'EMPTY_CATEGORY', 'Pusta kategoria' );

define( 'TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO','Kopiuj cechy produktu do innego produktu z kategorii:<br />' );

define( 'TEXT_SHIPPING_INFO', 'Dla <strong>produkt�w wirtualnych</strong> nie musisz ustawia� rodzaju wysy�ki i nie wymaga si� adresu wysy�ki np. dla: Bon�w towarowych, etc.<br />' . '<strong>Zawsze darmowa wysy�ka</strong> nie wymaga wybierania rodzaju wysy�ki, ale wymaga adresu wysy�ki<br />' . '<strong>Pobieranie</strong> podobnie jak produkty wirtualne - Inne opcje wysy�ki musz� by� wybrane<br />' );
define( 'TEXT_ANY_TYPE', 'Ka�dy rodzaj' );

?>