<?php
/**
 *
 * @version $Id: products_to_categories.php, v 1.3.7 2007/04/26 11:48:12 $;
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

/* z categories */
define( 'TABLE_HEADING_MODEL', 'Model' );

/* product */
define( 'TEXT_PRODUCTS_NAME', 'Nazwa produktu: ' );
define( 'TEXT_PRODUCTS_MODEL', 'Model: ' );

/* downloads manager */
define( 'TABLE_HEADING_PRODUCTS_ID', 'ID produktu' );

/* wlasne */
define( 'WARNING_PRODUCTS_LINK_TO_CATEGORY_REMOVED', 'OSTRZE�ENIE: Produkt zostanie zresetowany i nie b�dzie wi�cej nale�a� do tej kategorii ...' );
define( 'HEADING_TITLE', 'Manager kopiowania produkt�w do wielu kategorii ...' );
define( 'HEADING_TITLE2', 'Kategorie / Produkty' );
define( 'TEXT_PRODUCTS_ID', 'ID produktu: ' );
define( 'TEXT_PRODUCTS_ID_INVALID', 'OSTRZE�ENIE: B��DNE ID PRODUKTU LUB NIE WYBRANO �ADNEGO PRODUKTU' );
define( 'TEXT_PRODUCTS_ID_NOT_REQUIRED', 'Uwaga: ID produktu nie powinno by� wstawiane, aby u�ywa� powi�zania wszystkich produkt�w z jednej kategorii do innej.<br />Mimo to, ustawienie prawid�owego ID produktu jest wy�wietlane dla wszystkich dost�pnych kategorii wraz z ich numerami.' );
define( 'TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER_INTRO', 'Manager dodawanie produkt�w do wielu kategorii zosta� pomy�lany jako szybka metoda dowi�zania produkt�w do wielu kategori na raz.<br />Mo�esz powi�za� wszystkie produkty z danej kategorii z inn� kategori� lub usun�� powi�zane produkty. (Patrz ni�ej na dodatkowe instrukcje)' );
define( 'WARNING_MASTER_CATEGORIES_ID', 'OSTRZE�ENIE: Brak kategorii g��wnej!' );
define( 'TEXT_INFO_LINKED_TO_COUNT', '&nbsp;&nbsp;Obecny numer powi�zanej kategorii: ' );
define( 'TEXT_INFO_PRODUCTS_TO_CATEGORIES_AVAILABLE', 'Kategorie z produktami, kt�re mog� zosta� powi�zane ...' );
define( 'BUTTON_UPDATE_CATEGORY_LINKS', 'Aktualizuj powi�zania kategorii' );
define( 'TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER', 'Produkty wymagaj� swojej kategorii g��wnej, kt�ra ustala dla nich m.in. w�asno�ci cenowe. Poni�ej widzisz do jak wielu kategorii mo�esz dowi�za� produkt.<br />Je�li widzisz zaznaczone pole to oznacza, �e produkt jest obecnie dowi�zany do tej kategorii. Aby doda� dowi�zanie do innej/innych kategorii zaznacz po prostu odpowiednie pola obok ich nazw. Aby usun�� istniej�ce dowi�zania odhacz to pole.<br />Kiedy ju� znaznaczysz odpowiednie pola, naci�nij ' . BUTTON_UPDATE_CATEGORY_LINKS . '<br />' );
define( 'HEADER_CATEGORIES_GLOBAL_CHANGES', 'Globalne zmiany dowi�za� kategorii i resetowanie kategorii g��wnej' );
define( 'TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Kopiuj WSZYSTKIE produkty w kategorii jako DOWI�ZANE produkty do innej kategorii ...</strong>' );
define( 'TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Wybierz wszystkie produkty z kategorii: ' );
define( 'TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Dowi�� do kategorii: ' );
define( 'BUTTON_COPY_CATEGORY_LINKED', 'Kopiuj produkty jako dowi�zane ' );
define( 'TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Usu� WSZYSTKIE produkty z kategorii, kt�ra DOWI�ZUJE produkty do innej kategorii ...</strong>' );
define( 'TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Wybierz wszystkie produkty z kategorii: ' );
define( 'TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Usu� z dowi�zane do kategorii: ' );
define( 'BUTTON_REMOVE_CATEGORY_LINKED', 'Usu� produkty jako dowi�zane ' );
define( 'TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_MASTER', '<strong>Przywr�� WSZYSTKIE produkty z wybranej kategorii do wybranej kategorii jako nowej kategorii g��wnej ...</strong>' );
define( 'TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Przywr�� ID g��wnej kategorii dla wszystkich produkt�w z kategorii: ' );
define( 'BUTTON_RESET_CATEGORY_MASTER', 'Przywr�� ID kategorii g��wnej' );

define( 'TEXT_INFO_HEADING_EDIT_PRODUCTS_TO_CATEGORIES', 'EDYCJA INFORMACJI O DWI�ZANIACH PRODUKT�W DO KATEGORII' );
define( 'TEXT_SET_PRODUCTS_TO_CATEGORIES_LINKS', 'Wstaw produkt do kategorii dla: ' );

define( 'TEXT_PRODUCTS_PRICE', 'Cena produktu: ' );
define( 'BUTTON_NEW_PRODUCTS_TO_CATEGORIES', 'Wybierz produkt do dowi�zania' );

/* braki */
define( 'WARNING_DUPLICATE_PRODUCTS_TO_CATEGORY_LINKED', 'Nie mo�na dowi�za� produktu do kategorii, w kt�rej ju� istnieje' );

define( 'WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Nieprawid�owa kategoria dla dowi�zania produktu z: ' );
define( 'SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Prawid�owa kategoria dla dowi�zania produktu z: ' );
define( 'WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Nieprawid�owa kategoria dla dowi�zania produktu do: ' );
define( 'SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Prawid�owa kategoria dla dowi�zania produktu do: ' );
define( 'WARNING_COPY_FROM_IN_TO_LINKED', '<strong>OSTRZE�ENIE: Nie wprowadzono zmian, produkty s� ju� dowi�zane ... </strong>' );
define( 'WARNING_COPY_LINKED', 'OSTRZE�ENIE: ' );
define( 'SUCCESS_COPY_LINKED', 'Pomy�lnnie zmieniono dowi�zane produkty ... ' );

define( 'WARNING_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Nieprawid�owa kategoria dla usuwania dowi�zania produktu z: ' );
define( 'SUCCESS_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Prawid�owa kategoria dla usuwania dowi�zania produktu z: ' );
define( 'WARNING_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Nieprawid�owa kategoria dla usuwania dowi�zania produktu do: ' );
define( 'SUCCESS_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Prawid�owa kategoria dla usuwania dowi�zania produktu z: ' );
define( 'WARNING_MASTER_CATEGORIES_ID_CONFLICT', '<strong>OSTRZE�ENIE: KONFLIKT ID G��WNYCH KATEGORII!! </strong>' );
define( 'TEXT_MASTER_CATEGORIES_ID_CONFLICT_FROM', ' Konflikt z kategori�: ' );
define( 'TEXT_MASTER_CATEGORIES_ID_CONFLICT_TO', ' Konflikt do kategorii: ' );
define( 'TEXT_INFO_MASTER_CATEGORIES_ID_PURPOSE', 'UWAGA: Kategoria g��wna jest u�ywana dla okre�lania w�asno�ci cenowych, je�li produkt jest dowi�zany do kategorii, kt�ra zawiera ceny przypisane do kategorii, np: Obni�ki<br />' );
define( 'WARNING_MASTER_CATEGORIES_ID_CONFLICT_FIX', 'Aby rozwi�za� ten problem, zostaniesz przeniesiony do pierwszego produktu, kt�ry powoduje konflikt. Zmie� ID kategorii g��wnej i spr�buj ponownie. Kiedy rozwi��esz wszystkie konflikty, b�dzie mo�na wykona� usuwanie.' );
define( 'TEXT_INFO_MASTER_CATEGORIES_ID_CONFLICT', '<strong>Kategoria g��wna ID: </strong>' );
define( 'WARNING_REMOVE_FROM_IN_TO_LINKED', '<strong>OSTRZE�ENIE: Nie dokonano zmian, brak dowi�zanych produkt�w ... </strong>' );
define( 'WARNING_REMOVE_LINKED', 'OSTRZE�ENIE: ' );

define( 'WARNING_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'OSTRZEZENIE: Wybrano b��dn� kategori� ...' );
define( 'SUCCESS_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Pomy�lnie zresetowano wszystkie produkty w nowej kategorii z kategorii g��wnej: ' );

define( 'SUCCESS_MASTER_CATEGORIES_ID', 'Pomy�lnie zaktualizowano powi�zania produkt�w w kategoriach ...' );

define( 'TABLE_HEADING_PRODUCT', 'Nazwa produktu' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );

/**/
define( 'TEXT_SET_MASTER_CATEGORIES_ID', '<strong>OSTRZE�ENIE:</strong> Musisz wprowadzi� ID kategorii g��wnej, przed zmian� dowi�zania kategorii' );
define( 'WARNING_NO_CATEGORIES_ID', 'Ostrze�enie: nie wybrano kategorii ... nie dokonano zmian' );
define( 'SUCCESS_REMOVE_LINKED', 'Pomy�lnie usuni�to produkty dowi�zane ... ' );

?>