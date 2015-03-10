<?php
/**
 *
 * @version $Id: media_manager.php, v 1.3.7 2007/04/26 11:48:12 $;
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

define( 'TEXT_WARNING_FOLDER_UNWRITABLE', 'UWAGA: folder dla mediów ' . DIR_FS_CATALOG_MEDIA . ' nie ma praw do zapisu. Nie mo¿na zapisaæ pliku.' );
define( 'ERROR_UNKNOWN_DATA', 'B£¡D: Nieznany typ danych ... operacja przerwana' );

/* wlasne */
define( 'HEADING_TITLE_MEDIA_MANAGER', 'Manager mediów' );

define( 'TABLE_HEADING_MEDIA', 'Nazwa kolekcji' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );
define( 'TEXT_DISPLAY_NUMBER_OF_MEDIA', 'Wy¶wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> kolekcji)' );

define( 'TEXT_HEADING_NEW_MEDIA_COLLECTION', 'Nowa kolekcja' );
define( 'TEXT_NEW_INTRO', 'Wpisz dane o nowej kolekcji' );
define( 'TEXT_MEDIA_COLLECTION_NAME', 'Nazwa kolekcji' );

define( 'TEXT_HEADING_EDIT_MEDIA_COLLECTION', 'Edycja kolekcji' );
define( 'TEXT_EDIT_INTRO', 'Wprowad¼ zmiany' );
define( 'TEXT_MEDIA_EDIT_INSTRUCTIONS', 'W sekcji górnej zmieñ nazwê kolekcji a nastêpnie naci¶nij zapisz.<br /><br />W sekcji dolnej mo¿esz dodaæ lub usun±æ elementy kolekcji (pliki muzyczne, klipy itp.).' );
define( 'TEXT_ADD_MEDIA_CLIP', 'Dodaj klip' );
define( 'TEXT_MEDIA_CLIP_DIR', 'Zapisz w katalogu' );
define( 'TEXT_MEDIA_CLIP_TYPE', 'Typ mediów' );
define( 'TEXT_ADD', 'Dodaj' );

define( 'TEXT_HEADING_DELETE_MEDIA_COLLECTION', 'Usuwanie kolekcji' );
define( 'TEXT_DELETE_INTRO', 'Czy usun±æ tê kolekcjê?' );
define( 'TEXT_DELETE_PRODUCTS', 'Usun±æ produkty (klipy) zwi±zne z t± kolekcj±?' );
define( 'TEXT_DELETE_WARNING_PRODUCTS', '<strong>UWAGA:</strong> Istnieje %s produktów powi±zanych z t± kolekcj±!' );

define( 'TEXT_HEADING_ASSIGN_MEDIA_COLLECTION', 'Przypisz kolekcjê do produktu' );
define( 'TEXT_PRODUCTS_INTRO', 'U¿ywaj±c poni¿szego formularza mo¿esz przypisaæ kolekcjê do produktu lub usun±æ kolekcjê przypisan± do produktu' );
define( 'TEXT_NO_PRODUCTS', 'Brak produktów w tej kategorii' );

define( 'TEXT_DATE_ADDED', 'Data dodania: ' );
define( 'TEXT_LAST_MODIFIED', 'Ostatnia modyfikacja: ' );
define( 'TEXT_PRODUCTS', 'Produkty: ' );
define( 'TEXT_CLIPS', 'Powi±zanych klipów: ' );

?>