<?php
/**
 *
 * @version $Id: products_price_manager.php, v 1.3.7 2007/04/26 11:48:12 $;
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

/* product */
define( 'TEXT_PRODUCTS_MODEL', 'Model: ' );
define( 'TEXT_PRODUCTS_PRICE_INFO', 'Cena: ' );

define( 'TEXT_PRODUCTS_STATUS', 'Status produktu: ' );
define( 'TEXT_PRODUCT_AVAILABLE', 'Dost�pny' );
define( 'TEXT_PRODUCT_NOT_AVAILABLE', 'Niedost�pny' );
define( 'TEXT_PRODUCT_IS_FREE', 'Produkt darmowy: ' );
define( 'TEXT_PRODUCTS_IS_FREE_EDIT', '*Produkt jest oznaczony jako DARMOWY' );
define( 'TEXT_PRODUCT_IS_CALL', 'Cena na telefon: ' );
define( 'TEXT_PRODUCTS_IS_CALL_EDIT', '*Produkt jest oznaczony jako CENA NA TELEFON' );
define( 'TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES', 'Cena produktu zale�na od cech: ' );
define( 'TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE', 'Tak' );
define( 'TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE', 'Nie' );
define( 'TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT', '*Cena tego produktu zale�y od jego cech, wy�wietlona zostanie cena najni�sza' );
define( 'TEXT_PRODUCTS_TAX_CLASS', 'Rodzaj podatku: ' );
define( 'TEXT_PRODUCTS_QUANTITY_MIN_RETAIL', 'Minimalna liczba zamawianych produkt�w: ' );
define( 'TEXT_PRODUCTS_QUANTITY_MAX_RETAIL', 'Maksymalna liczba zamawianych produkt�w: ' );
define( 'TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT', '0 = Bez ogranicze�, 1 (Brak boxu liczby produkt�w), liczba = maksymalna ilo��' );
define( 'TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL', 'Liczba sztuk w produkcie: ' );
define( 'TEXT_PRODUCTS_MIXED', 'Liczba produkt�w Min/Sztuk Mix:');

/* product to categories */
define( 'TEXT_PRODUCTS_PRICE', 'Cena produktu: ' );

/* atributtes controller */
define( 'TEXT_ATTRIBUTES_INSERT_INFO', '<strong>Zdefiniuj w�asno�ci cechy, a nast�pnie naci�nij Wstaw</strong>' );

/* reviews */
define( 'TABLE_HEADING_PRODUCTS', 'Produkt' );
define( 'TABLE_HEADING_STATUS', 'Status' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );

/* featured */
define( 'TEXT_FEATURED_PRODUCT', 'Produkt polecany: ' );
define( 'TABLE_HEADING_PRODUCTS_MODEL', 'Model' );
define( 'TABLE_HEADING_AVAILABLE_DATE', 'Dost�pny' );
define( 'TABLE_HEADING_EXPIRES_DATE', 'Wa�no��' );
define( 'TEXT_INFO_HEADING_DELETE_FEATURED', 'Unuwanie produkt�w polecanych' );
define( 'TEXT_INFO_DELETE_INTRO', 'Czy chcesz usun�� informacj� o polecaniu tego produktu?' );
define( 'TEXT_INFO_DATE_ADDED', 'Data dodania:' );
define( 'TEXT_INFO_LAST_MODIFIED', 'Ostatnia modyfikacja:' );
define( 'TEXT_INFO_AVAILABLE_DATE', 'Obowi�zuje od: ' );
define( 'TEXT_INFO_EXPIRES_DATE', 'Obowi�zuje do: ' );
define( 'TEXT_INFO_STATUS_CHANGE', 'Zmiana statusu: ' );

/* specials */
define( 'TEXT_SPECIALS_PRODUCT', 'Produkt w promocji: ' );
define( 'TABLE_HEADING_PRODUCTS_PRICE', 'Cena/Promocja/Obni�ka' );
define( 'TEXT_INFO_ORIGINAL_PRICE', 'Oryginalna cena: ' );
define( 'TEXT_INFO_NEW_PRICE', 'Nowa cena: ' );

/* wlasne */
define( 'HEADING_TITLE', 'Manager cen' );
define( 'TEXT_PRODUCT_INFO_NONE', 'Wybierz produkt z poni�szych ...' );

define( 'TEXT_PRODUCT_INFO', 'Dane produktu: ' );
define( 'TEXT_INFO_PREVIEW_ONLY', 'Tylko podgl�d ... Aktualne ceny ... Tylko podgl�d' );
define( 'TEXT_INFO_EDIT_CAUTION', '<strong>Kliknij, aby edytowa� produkt ...</strong>' );
define( 'TEXT_UPDATE_COMMIT', 'Zmie� i zastosuj zmiany widoczne na tej stronie' );
define( 'TEXT_INFO_UPDATE_REMINDER', '<strong>Edytuj informacje o produkcie i naci�nij zmie�, aby zapisa�</strong>' );
define( 'TEXT_INFO_MASTER_CATEGORIES_ID_WARNING', '<strong>Ostrze�enie:</strong> G��wna kategoria ID# %s produktu nie pasuje do obecnej kategorii ID# %s i produkt nie jest dowi�zany!' );
define( 'TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE_TO_CURRENT', 'Zmie� kategori� g��wn� ID: %s na obecn� kategori� ID: %s' );
define( 'TEXT_PRICE', 'Cena: ' );
define( 'TEXT_PRODUCT_AVAILABLE_DATE', 'Data dost�pno�ci produktu: ' );
define( 'TEXT_PRICED_BY_ATTRIBUTES', 'Cena zale�na od cech' );

define( 'TEXT_SPECIALS_PRODUCT_INFO', 'Informacje o produktach promocyjnych: ' );
define( 'TEXT_SPECIALS_SPECIAL_PRICE', 'Cena promocyjna: ' );
define( 'TEXT_SPECIALS_AVAILABLE_DATE', 'Data dost�pno�ci promocji: ' );
define( 'TEXT_SPECIALS_EXPIRES_DATE', 'Data wa�no�ci promocji: ' );
define( 'TEXT_SPECIALS_PRODUCTS_STATUS', 'Status promocji: ' );
define( 'TEXT_SPECIALS_PRODUCT_AVAILABLE', 'aktywna' );
define( 'TEXT_SPECIALS_PRODUCT_NOT_AVAILABLE', 'nieaktywna' );
define( 'TEXT_SPECIAL_DISABLED', '<strong>UWAGA: Informacje o promocji s� obecnie wy��czone, wygas�y lub nie s� aktywne</strong>' );
define( 'TEXT_SPECIALS_PRICE_TIP', '<strong>Informacje o promocjach:</strong><ul><li>Mo�esz poda� procentow� obni�k� ceny np: <strong>20%</strong></li><li>Mo�esz poda� now� cen�, separator decymalny to \'.\' np: <strong>49.99</strong></li><li>Pozostaw pole Data wa�no�ci promocji puste je�eli promocja ma obowi�zywa� ca�y czas</li></ul>' );
define( 'TEXT_SPECIALS_NO_GIFTS', 'Brak promocji dla bon�w' );

define( 'TEXT_FEATURED_PRODUCT_INFO', 'Informacje o produktach polecanych: ' );
define( 'TEXT_FEATURED_AVAILABLE_DATE', 'Dost�pny od: ' );
define( 'TEXT_FEATURED_EXPIRES_DATE', 'Wa�ny do: ' );
define('TEXT_FEATURED_PRODUCTS_STATUS', 'Status polacanych: ' );
define( 'TEXT_FEATURED_PRODUCT_AVAILABLE', 'aktywne' );
define( 'TEXT_FEATURED_PRODUCT_NOT_AVAILABLE', 'nieaktywne' );
define( 'TEXT_FEATURED_DISABLED', '<strong>UWAGA: Informacje o poleceniach (produkty polecane) s� obecnie wy��czone, wygas�y lub nie s� aktywne</strong>' );

define( 'TEXT_ADD_ADDITIONAL_DISCOUNT', 'Dodaj <strong>' . DISCOUNT_QTY_ADD . '</strong> pustych p�l obni�ek: ' );
define( 'TEXT_BLANKS_INFO', 'Wszystkie puste pola (0) zostan� usuni�te po zmianie' );
define( 'TEXT_INFO_NO_DISCOUNTS', 'Nie zdefiniowano obni�ek ilo�ciowych' );
define( 'TEXT_PRODUCTS_MIXED_DISCOUNT_QUANTITY', 'Obni�ki ilo�ciowe uwzgl�dniaj� cechy MIX' );

define( 'TEXT_DISCOUNT_TYPE_INFO', 'Informacje o obni�kach' );
define( 'TEXT_DISCOUNT_TYPE', 'Rodzaj obni�ki: ' );
define( 'TEXT_DISCOUNT_TYPE_FROM', 'Obni�ka naliczana od: ' );
define( 'DISCOUNT_TYPE_DROPDOWN_0', 'Brak' );
define( 'DISCOUNT_TYPE_DROPDOWN_1', 'Procentowo' );
define( 'DISCOUNT_TYPE_DROPDOWN_2', 'Nowa cena' );
define( 'DISCOUNT_TYPE_DROPDOWN_3', 'Od ceny' );
define( 'DISCOUNT_TYPE_FROM_DROPDOWN_0', 'Cena' );
define( 'DISCOUNT_TYPE_FROM_DROPDOWN_1', 'Promocja' );
define( 'TEXT_PRODUCTS_DISCOUNT_QTY_TITLE', 'Poziom obni�ki' );
define( 'TEXT_PRODUCTS_DISCOUNT_QTY', 'Minimalna ilo��' );
define( 'TEXT_PRODUCTS_DISCOUNT_PRICE', 'Warto�� obni�ki' );
define( 'TEXT_PRODUCTS_DISCOUNT_PRICE_EACH_TAX', 'Kalkulacja<br />Cena: &nbsp; Cena z podatkiem: ' );
define( 'TEXT_PRODUCTS_DISCOUNT_PRICE_EXTENDED_TAX', 'Dla zadanej ilo�ci<br />Cena: &nbsp; Cena z podatkiem: ' );
define( 'TEXT_PRODUCTS_DISCOUNT_PRICE_EACH', 'Obliczona cena jednostkowa: ' );
define( 'TEXT_PRODUCTS_DISCOUNT_PRICE_EXTENDED', 'Cena og�lna: ' );
define( 'TEXT_PRODUCTS_DISCOUNT', 'Obni�ka' );

define( 'PRODUCT_UPDATE_SUCCESS', 'Pomy�lnie zmieniono w�a�ciwo�ci produktu!' );
define( 'PRODUCT_WARNING_UPDATE', 'Wprowad� zmiany i naci�nij zmie�, aby zapisa�' );
define( 'PRODUCT_WARNING_UPDATE_CANCEL', 'Zmiany nie zosta�y zapisane ...' );
define( 'HEADING_TITLE_PRODUCT_SELECT', 'Wybierz kategori� zawieraj�c� produkty, aby wy�wietli� informacje o cenach...' );

/**/
define( 'TABLE_HEADING_PRODUCTS_PERCENTAGE', 'Procentowo' );
define( 'TEXT_INFO_PERCENTAGE', 'Procentowo:' );
define( 'TEXT_SPECIAL_PRICE', 'Cena promocyjna: ' );
define( 'TEXT_SALE_PRICE', 'Cena po obni�ce: ' );
define( 'TEXT_FREE', 'DARMOWO' );
define( 'TEXT_CALL_FOR_PRICE', 'Cena na telefon' );
define('TEXT_PRODUCTS_DISCOUNT_TYPE','Typ obni�ki');
define('TEXT_EACH','ka�dy');
define('TEXT_EXTENDED','razem');
define('TEXT_INFO_MASTER_CATEGORIES_CURRENT', ' Obecna kategoria ID# %s nie pasuje do kategorii g��wnej ID# %s');

?>