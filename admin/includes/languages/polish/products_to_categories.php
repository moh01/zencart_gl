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
 * Wiêcej informacji na stronie projektu {@link http://www.zencart.pl ZenCart.pl} Zajrzyj!
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
define( 'WARNING_PRODUCTS_LINK_TO_CATEGORY_REMOVED', 'OSTRZE¯ENIE: Produkt zostanie zresetowany i nie bêdzie wiêcej nale¿a³ do tej kategorii ...' );
define( 'HEADING_TITLE', 'Manager kopiowania produktów do wielu kategorii ...' );
define( 'HEADING_TITLE2', 'Kategorie / Produkty' );
define( 'TEXT_PRODUCTS_ID', 'ID produktu: ' );
define( 'TEXT_PRODUCTS_ID_INVALID', 'OSTRZE¯ENIE: B£ÊDNE ID PRODUKTU LUB NIE WYBRANO ¯ADNEGO PRODUKTU' );
define( 'TEXT_PRODUCTS_ID_NOT_REQUIRED', 'Uwaga: ID produktu nie powinno byæ wstawiane, aby u¿ywaæ powi±zania wszystkich produktów z jednej kategorii do innej.<br />Mimo to, ustawienie prawid³owego ID produktu jest wy¶wietlane dla wszystkich dostêpnych kategorii wraz z ich numerami.' );
define( 'TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER_INTRO', 'Manager dodawanie produktów do wielu kategorii zosta³ pomy¶lany jako szybka metoda dowi±zania produktów do wielu kategori na raz.<br />Mo¿esz powi±zaæ wszystkie produkty z danej kategorii z inn± kategori± lub usun±æ powi±zane produkty. (Patrz ni¿ej na dodatkowe instrukcje)' );
define( 'WARNING_MASTER_CATEGORIES_ID', 'OSTRZE¯ENIE: Brak kategorii g³ównej!' );
define( 'TEXT_INFO_LINKED_TO_COUNT', '&nbsp;&nbsp;Obecny numer powi±zanej kategorii: ' );
define( 'TEXT_INFO_PRODUCTS_TO_CATEGORIES_AVAILABLE', 'Kategorie z produktami, które mog± zostaæ powi±zane ...' );
define( 'BUTTON_UPDATE_CATEGORY_LINKS', 'Aktualizuj powi±zania kategorii' );
define( 'TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER', 'Produkty wymagaj± swojej kategorii g³ównej, która ustala dla nich m.in. w³asno¶ci cenowe. Poni¿ej widzisz do jak wielu kategorii mo¿esz dowi±zaæ produkt.<br />Je¶li widzisz zaznaczone pole to oznacza, ¿e produkt jest obecnie dowi±zany do tej kategorii. Aby dodaæ dowi±zanie do innej/innych kategorii zaznacz po prostu odpowiednie pola obok ich nazw. Aby usun±æ istniej±ce dowi±zania odhacz to pole.<br />Kiedy ju¿ znaznaczysz odpowiednie pola, naci¶nij ' . BUTTON_UPDATE_CATEGORY_LINKS . '<br />' );
define( 'HEADER_CATEGORIES_GLOBAL_CHANGES', 'Globalne zmiany dowi±zañ kategorii i resetowanie kategorii g³ównej' );
define( 'TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Kopiuj WSZYSTKIE produkty w kategorii jako DOWI¡ZANE produkty do innej kategorii ...</strong>' );
define( 'TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Wybierz wszystkie produkty z kategorii: ' );
define( 'TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Dowi±¿ do kategorii: ' );
define( 'BUTTON_COPY_CATEGORY_LINKED', 'Kopiuj produkty jako dowi±zane ' );
define( 'TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Usuñ WSZYSTKIE produkty z kategorii, która DOWI¡ZUJE produkty do innej kategorii ...</strong>' );
define( 'TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Wybierz wszystkie produkty z kategorii: ' );
define( 'TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Usuñ z dowi±zane do kategorii: ' );
define( 'BUTTON_REMOVE_CATEGORY_LINKED', 'Usuñ produkty jako dowi±zane ' );
define( 'TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_MASTER', '<strong>Przywróæ WSZYSTKIE produkty z wybranej kategorii do wybranej kategorii jako nowej kategorii g³ównej ...</strong>' );
define( 'TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Przywróæ ID g³ównej kategorii dla wszystkich produktów z kategorii: ' );
define( 'BUTTON_RESET_CATEGORY_MASTER', 'Przywróæ ID kategorii g³ównej' );

define( 'TEXT_INFO_HEADING_EDIT_PRODUCTS_TO_CATEGORIES', 'EDYCJA INFORMACJI O DWI¡ZANIACH PRODUKTÓW DO KATEGORII' );
define( 'TEXT_SET_PRODUCTS_TO_CATEGORIES_LINKS', 'Wstaw produkt do kategorii dla: ' );

define( 'TEXT_PRODUCTS_PRICE', 'Cena produktu: ' );
define( 'BUTTON_NEW_PRODUCTS_TO_CATEGORIES', 'Wybierz produkt do dowi±zania' );

/* braki */
define( 'WARNING_DUPLICATE_PRODUCTS_TO_CATEGORY_LINKED', 'Nie mo¿na dowi±zaæ produktu do kategorii, w której ju¿ istnieje' );

define( 'WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Nieprawid³owa kategoria dla dowi±zania produktu z: ' );
define( 'SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Prawid³owa kategoria dla dowi±zania produktu z: ' );
define( 'WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Nieprawid³owa kategoria dla dowi±zania produktu do: ' );
define( 'SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Prawid³owa kategoria dla dowi±zania produktu do: ' );
define( 'WARNING_COPY_FROM_IN_TO_LINKED', '<strong>OSTRZE¯ENIE: Nie wprowadzono zmian, produkty s± ju¿ dowi±zane ... </strong>' );
define( 'WARNING_COPY_LINKED', 'OSTRZE¯ENIE: ' );
define( 'SUCCESS_COPY_LINKED', 'Pomy¶lnnie zmieniono dowi±zane produkty ... ' );

define( 'WARNING_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Nieprawid³owa kategoria dla usuwania dowi±zania produktu z: ' );
define( 'SUCCESS_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Prawid³owa kategoria dla usuwania dowi±zania produktu z: ' );
define( 'WARNING_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Nieprawid³owa kategoria dla usuwania dowi±zania produktu do: ' );
define( 'SUCCESS_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Prawid³owa kategoria dla usuwania dowi±zania produktu z: ' );
define( 'WARNING_MASTER_CATEGORIES_ID_CONFLICT', '<strong>OSTRZE¯ENIE: KONFLIKT ID G£ÓWNYCH KATEGORII!! </strong>' );
define( 'TEXT_MASTER_CATEGORIES_ID_CONFLICT_FROM', ' Konflikt z kategori±: ' );
define( 'TEXT_MASTER_CATEGORIES_ID_CONFLICT_TO', ' Konflikt do kategorii: ' );
define( 'TEXT_INFO_MASTER_CATEGORIES_ID_PURPOSE', 'UWAGA: Kategoria g³ówna jest u¿ywana dla okre¶lania w³asno¶ci cenowych, je¶li produkt jest dowi±zany do kategorii, która zawiera ceny przypisane do kategorii, np: Obni¿ki<br />' );
define( 'WARNING_MASTER_CATEGORIES_ID_CONFLICT_FIX', 'Aby rozwi±zaæ ten problem, zostaniesz przeniesiony do pierwszego produktu, który powoduje konflikt. Zmieñ ID kategorii g³ównej i spróbuj ponownie. Kiedy rozwi±¿esz wszystkie konflikty, bêdzie mo¿na wykonaæ usuwanie.' );
define( 'TEXT_INFO_MASTER_CATEGORIES_ID_CONFLICT', '<strong>Kategoria g³ówna ID: </strong>' );
define( 'WARNING_REMOVE_FROM_IN_TO_LINKED', '<strong>OSTRZE¯ENIE: Nie dokonano zmian, brak dowi±zanych produktów ... </strong>' );
define( 'WARNING_REMOVE_LINKED', 'OSTRZE¯ENIE: ' );

define( 'WARNING_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'OSTRZEZENIE: Wybrano b³êdn± kategoriê ...' );
define( 'SUCCESS_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Pomy¶lnie zresetowano wszystkie produkty w nowej kategorii z kategorii g³ównej: ' );

define( 'SUCCESS_MASTER_CATEGORIES_ID', 'Pomy¶lnie zaktualizowano powi±zania produktów w kategoriach ...' );

define( 'TABLE_HEADING_PRODUCT', 'Nazwa produktu' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );

/**/
define( 'TEXT_SET_MASTER_CATEGORIES_ID', '<strong>OSTRZE¯ENIE:</strong> Musisz wprowadziæ ID kategorii g³ównej, przed zmian± dowi±zania kategorii' );
define( 'WARNING_NO_CATEGORIES_ID', 'Ostrze¿enie: nie wybrano kategorii ... nie dokonano zmian' );
define( 'SUCCESS_REMOVE_LINKED', 'Pomy¶lnie usuniêto produkty dowi±zane ... ' );

?>