<?php
/**
 *
 * @version $Id: product_music.php, v 1.3.7 2007/04/26 11:48:12 $;
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
define( 'TEXT_IMAGE_NONEXISTENT', 'BRAK OBRAZKA' );
define( 'TEXT_ATTRIBUTE_COPY_SKIPPING', '<strong>Pominiêto now± cechê</strong> ' );
define( 'TEXT_ATTRIBUTE_COPY_INSERTING', '<strong>Wstawiono now± cechê nr.:</strong> ' );
define( 'TEXT_ATTRIBUTE_COPY_UPDATING', '<strong>Zaktualizowano cechê</strong> ');
define( 'PRODUCTS_PRICE_IS_FREE_TEXT', 'Darmowy' );

/* z categories */
define( 'HEADING_TITLE', 'Kategorie / Produkty' );
define( 'HEADING_TITLE_GOTO', 'Przejd¼ do: ' );
define( 'TABLE_HEADING_ID', 'ID' );
define( 'TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategoria / Produkt' );
define( 'TABLE_HEADING_MODEL', 'Model' );
define( 'TABLE_HEADING_PRICE', 'Cena/Promocja/Obni¿ka' );
define( 'TABLE_HEADING_QUANTITY', 'Ilo¶æ' );
define( 'TABLE_HEADING_STATUS', 'Status' );
define( 'TABLE_HEADING_CATEGORIES_SORT_ORDER', 'Sortowanie' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );
define( 'ICON_ATTRIBUTES', 'Cechy produktu' );
define( 'TEXT_CATEGORIES', 'Kategorie: ' );
define( 'TEXT_PRODUCTS', 'Produkty: ' );
define( 'TEXT_INFO_HEADING_NEW_CATEGORY', 'Nowa kategoria' );
define( 'TEXT_NEW_CATEGORY_INTRO', 'Podaj informacje dla nowej kategorii' );
define( 'TEXT_CATEGORIES_NAME', 'Nazwa kategorii: ' );
define( 'TEXT_CATEGORIES_IMAGE', 'Obrazek kategorii: ' );
define( 'TEXT_CATEGORIES_IMAGE_DIR', 'Zapisuj w katalogu: ' );
define( 'TEXT_SORT_ORDER', 'Sortowanie: ' );
define( 'TEXT_INFO_HEADING_EDIT_CATEGORY', 'Edytuj kategoriê' );
define( 'TEXT_EDIT_INTRO', 'Wprowad¼ zmiany' );
define( 'TEXT_EDIT_CATEGORIES_NAME', 'Nazwa kategorii: ' );
define( 'TEXT_EDIT_CATEGORIES_IMAGE', 'Obrazek kategorii: ' );
define( 'TEXT_EDIT_SORT_ORDER', 'Sortowanie: ' );
define( 'TEXT_INFO_HEADING_DELETE_CATEGORY', 'Usuñ kategoriê' );
define( 'TEXT_DELETE_CATEGORY_INTRO', 'Czy na pewno chces usun±æ t± kategoriê?' );
define( 'TEXT_DELETE_WARNING_CHILDS', '<strong>UWAGA:</strong> Istnieje %s podkategorii wci±¿ powi±zanych z t± kategori±!' );
define( 'TEXT_DELETE_WARNING_PRODUCTS', '<strong>UWAGA:</strong> Istnieje %s produktów wci±¿ powi±zanych z t± kategori±!' );
define( 'TEXT_INFO_HEADING_MOVE_CATEGORY', 'Przenie¶ kategoriê' );
define( 'TEXT_MOVE_CATEGORIES_INTRO', 'Wybierz kategoriê w której kategoria <strong>%s</strong> ma siê znajdowaæ' );
define( 'TEXT_MOVE', 'Przenie¶ <strong>%s</strong> do: ' );
define( 'TEXT_INFO_HEADING_DELETE_PRODUCT', 'Usuñ produkt' );
define( 'TEXT_DELETE_PRODUCT_INTRO', 'Czy na pewno chcesz ca³kowicie usun±æ ten produkt?' );
define( 'TEXT_INFO_HEADING_MOVE_PRODUCT', 'Przenie¶ produkt' );
define( 'TEXT_MOVE_PRODUCTS_INTRO', 'Wybierz kategoriê w której produkt <b>%s</b> ma siê znajdowaæ' );
define( 'TEXT_INFO_CURRENT_CATEGORIES', 'Bie¿±ce kategorie: ' );
define( 'TEXT_INFO_HEADING_COPY_TO', 'Kopiuj do' );
define( 'TEXT_INFO_COPY_TO_INTRO', 'Wybierz now± kategoriê do której chcia³by¶ skopiowaæ ten produkt' );
define( 'TEXT_INFO_CURRENT_PRODUCT', 'Obecny produkt: ' );
define( 'TEXT_HOW_TO_COPY', 'Sposób kopiowania: ' );
define( 'TEXT_COPY_AS_LINK', 'Powi±¿' );
define( 'TEXT_COPY_AS_DUPLICATE', 'Duplikuj' );
define( 'TEXT_COPY_ATTRIBUTES_ONLY', 'Tylko dla duplikowania produktów ...');
define( 'TEXT_COPY_ATTRIBUTES', 'Kopiuj cechy produktu do duplikowanego' );
define( 'TEXT_COPY_ATTRIBUTES_YES', 'Tak' );
define( 'TEXT_COPY_ATTRIBUTES_NO', 'Nie' );
define( 'TEXT_INFO_HEADING_ATTRIBUTE_FEATURES', 'Zmiana cech dla produktu ID# ' );
define( 'TEXT_PRODUCTS_ATTRIBUTES_INFO', 'Cechy produktu: ' );
define( 'TEXT_PRODUCT_ATTRIBUTES_DOWNLOADS', 'Pobieranie/Download: ' );
define( 'TEXT_INFO_ATTRIBUTES_FEATURES_DELETE', 'Usuñ <strong>WSZYSTKIE</strong> cechy dla produktu:<br />' );
define( 'TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT', 'Kopuj cechy produktu do innego produktu z <strong>produktu</strong>:<br />ID: ' );
define( 'TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY', 'Kopuj cechy do kategorii z <strong>produktu</strong>:<br />ID: ' );
define( 'TEXT_COPY_ATTRIBUTES_CONDITIONS', '<strong>Co zrobiæ z istniej±cymi cechami?</strong>' );
define( 'TEXT_COPY_ATTRIBUTES_DELETE', '<strong>Usuñ</strong>, potem skopiuj nowe' );
define( 'TEXT_COPY_ATTRIBUTES_UPDATE', '<strong>Zmieñ</strong> cechy/ceny, potem dodaj nowe' );
define( 'TEXT_COPY_ATTRIBUTES_IGNORE', '<strong>Pomiñ</strong> i dodaj tylko nowe' );
define( 'SUCCESS_ATTRIBUTES_DELETED', 'Cechy usuniêto pomy¶lnie' );
define( 'SUCCESS_ATTRIBUTES_UPDATE', 'Cechy zaktualizowano pomy¶lnie' );

/* product */
/* MetaTagi */
define( 'TEXT_META_TAG_TITLE_INCLUDES', '<strong>Zaznacz, które parametry produktu maj± zostaæ do³±czone do MetaTagów:</strong>' );
define( 'TEXT_PRODUCTS_METATAGS_PRODUCTS_NAME_STATUS', '<strong>Nazwa produktu:</strong>' );
define( 'TEXT_PRODUCTS_METATAGS_TITLE_STATUS', '<strong>Tytu³:</strong>' );
define( 'TEXT_PRODUCTS_METATAGS_MODEL_STATUS', '<strong>Model:</strong>' );
define( 'TEXT_PRODUCTS_METATAGS_PRICE_STATUS', '<strong>Cena:</strong>' );
define( 'TEXT_PRODUCTS_METATAGS_TITLE_TAGLINE_STATUS', '<strong>Ogólny tytu³ strony:</strong>' );
define( 'TEXT_PRODUCTS_NAME', 'Nazwa produktu: ' );
define( 'TEXT_PRODUCTS_MODEL', 'Model: ' );
define( 'TEXT_PRODUCTS_PRICE_INFO', 'Cena: ' );
define( 'TEXT_META_TAGS_TITLE', '<strong>MetaTag Tytu³:</strong>' );
define( 'TEXT_META_TAGS_KEYWORDS', '<strong>MetaTag S³owa kluczowe:</strong>' );
define( 'TEXT_META_TAGS_DESCRIPTION', '<strong>MetaTag Opis:</strong>' );
define( 'TEXT_META_EXCLUDED', '<span class="alert">POMINIÊTE</span>' );

/* nowy - edycja */
define( 'TEXT_PRODUCTS_STATUS', 'Status produktu: ' );
define( 'TEXT_PRODUCT_AVAILABLE', 'Dostêpny' );
define( 'TEXT_PRODUCT_NOT_AVAILABLE', 'Niedostêpny' );
define( 'TEXT_PRODUCTS_DATE_AVAILABLE', 'Data dostêpno¶ci: ' );
define( 'TEXT_PRODUCTS_MANUFACTURER', 'Producent: ' );
define( 'TEXT_PRODUCT_IS_FREE', 'Produkt darmowy: ' );
define( 'TEXT_PRODUCTS_IS_FREE_EDIT', '*Produkt jest oznaczony jako DARMOWY' );
define( 'TEXT_PRODUCT_IS_CALL', 'Cena na telefon: ' );
define( 'TEXT_PRODUCTS_IS_CALL_EDIT', '*Produkt jest oznaczony jako CENA NA TELEFON' );
define( 'TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES', 'Cena produktu zale¿na od cech: ' );
define( 'TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE', 'Tak' );
define( 'TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE', 'Nie' );
define( 'TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT', '*Cena tego produktu zale¿y od jego cech, wy¶wietlona zostanie cena najni¿sza' );
define( 'TEXT_PRODUCTS_TAX_CLASS', 'Rodzaj podatku: ' );
define( 'TEXT_PRODUCTS_PRICE_NET', 'Cena netto: ' );
define( 'TEXT_PRODUCTS_PRICE_GROSS', 'Cena brutto: ' );
define( 'TEXT_PRODUCTS_VIRTUAL', 'Produkt wirtualny: ' );
define( 'TEXT_PRODUCT_IS_VIRTUAL', 'Tak, pomiñ adres wysy³ki' );
define( 'TEXT_PRODUCT_NOT_VIRTUAL', 'Nie, adres wysy³ki jest wymagany' );
define( 'TEXT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', 'Darmowa wysy³ka: ' );
define( 'TEXT_PRODUCT_IS_ALWAYS_FREE_SHIPPING', 'Tak, wysy³ka zawsze darmowa' );
define( 'TEXT_PRODUCT_NOT_ALWAYS_FREE_SHIPPING', 'Nie, zwyk³e zasady wysy³ki' );
define( 'TEXT_PRODUCT_SPECIAL_ALWAYS_FREE_SHIPPING', 'Specjalnie, wymaga adresu wysy³ki' );
define( 'TEXT_PRODUCTS_QTY_BOX_STATUS', 'Box liczby produktów: ' );
define( 'TEXT_PRODUCTS_QTY_BOX_STATUS_ON', 'Tak, wy¶wietlaj box' );
define( 'TEXT_PRODUCTS_QTY_BOX_STATUS_OFF', 'Nie, nie pokazuj boxa' );
define( 'TEXT_PRODUCTS_QTY_BOX_STATUS_EDIT', 'Ostrze¿enie: Nie bêdzie pokazywany box liczby sztuk, Domy¶lna liczba sztuk 1' );
define( 'TEXT_PRODUCTS_QUANTITY_MIN_RETAIL', 'Minimalna liczba zamawianych produktów: ' );
define( 'TEXT_PRODUCTS_QUANTITY_MAX_RETAIL', 'Maksymalna liczba zamawianych produktów: ' );
define( 'TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT', '0 = Bez ograniczeñ, 1 (Brak boxu liczby produktów), liczba = maksymalna ilo¶æ' );
define( 'TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL', 'Liczba sztuk w produkcie: ' );
define( 'TEXT_PRODUCTS_MIXED', 'Liczba produktów Min/Sztuk Mix:');
define( 'TEXT_PRODUCTS_DESCRIPTION', 'Opis produktu: ' );
define( 'TEXT_PRODUCTS_QUANTITY', 'Dostêpna liczba produktów: ' );
define( 'TEXT_PRODUCTS_IMAGE', 'Obrazek produktu: ' );
define( 'TEXT_PRODUCTS_IMAGE_DIR', 'Katalog obrazka: ' );
define( 'TEXT_PRODUCTS_URL', 'Link do produktu: ' );
define( 'TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(bez http://)</small>' );
define( 'TEXT_PRODUCTS_WEIGHT', 'Waga produktu: ' );
define( 'TEXT_PRODUCTS_SORT_ORDER', 'Sortowanie: ' );
define( 'TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_PREVIEW', '*Dla tego produktu ustawiono wy¶wietlanie ceny wg. jego cech, wybrana zostanie cena najni¿sza' );
define( 'TEXT_PRODUCTS_IS_FREE_PREVIEW', '*Produkt jest oznaczony jako DARMOWY' );
define( 'TEXT_PRODUCTS_IS_CALL_PREVIEW', '*Produkt jest oznaczony jako CENA NA TELEFON' );
define( 'TEXT_PRODUCTS_QTY_BOX_STATUS_PREVIEW', 'Ostrze¿enie: Nie bêdzie pokazywany box liczby sztuk, Domy¶lna liczba sztuk 1' );
define( 'TEXT_PRODUCT_MORE_INFORMATION', 'Po wiêcej informacji zapraszamy na <a href="http://%s" target="blank">stronê produktu</a>.' );
define( 'TEXT_PRODUCT_DATE_AVAILABLE', 'Ten produkt bêdzie dostêpny od: %s' );
define( 'TEXT_PRODUCT_DATE_ADDED', 'Ten produkt zosta³ dodany do sklepu: %s' );

/* attributes controller */
define( 'TEXT_PRODUCT_OPTIONS', '<strong>Cechy produktu:</strong>' );

/* wlasne */
define( 'TEXT_PRODUCTS_RECORD_ARTIST', 'Artysta: ');
define( 'TEXT_PRODUCTS_RECORD_COMPANY', 'Wytwórnia p³ytowa: ' );
define( 'TEXT_PRODUCTS_MUSIC_GENRE', 'Gatunek: ' );

/* brakujace */
define( 'TEXT_COPY_MEDIA_MANAGER', 'Kopiuj razem z przypisanymi mediami' );

/**/
define( 'TEXT_SUBCATEGORIES', 'Podkategorie: ' );
define( 'TEXT_PRODUCTS_AVERAGE_RATING', '¦rednia ocena: ' );
define( 'TEXT_PRODUCTS_QUANTITY_INFO', 'Ilo¶æ: ' );
define( 'TEXT_DATE_ADDED', 'Data dodania: ' );
define( 'TEXT_DATE_AVAILABLE', 'Dostêpny od dnia: ' );
define( 'TEXT_LAST_MODIFIED', 'Ostatnia modyfikacja: ' );
define( 'TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Dodaj now± kategoriê lub produkt w tej kategorii' );

define( 'TEXT_EDIT_CATEGORIES_ID', 'ID kategorii: ' );
define( 'EMPTY_CATEGORY', 'Pusta kategoria' );

define( 'TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO','Kopiuj cechy produktu do innego produktu z kategorii:<br />' );

?>