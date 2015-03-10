<?php
/**
 *
 * @version $Id: ezpages.php, v 1.3.7 2007/04/26 11:48:12 $;
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

define( 'SUCCESS_PAGE_STATUS_UPDATED', 'Ststus strony zosta� pomy�lnie zmieniony' );
define( 'ERROR_UNKNOWN_STATUS_FLAG', 'B��d: Nieznany status' );
define( 'ERROR_PAGE_TITLE_REQUIRED', 'B��d: Wmagany tytu� strony' );
define( 'ERROR_MULTIPLE_HTML_URL', 'B��d: zdefiniowano zbyt wiele wykluczaj�cych si� warto�ci ...<br />Mo�na zdefiniowa�: Zawarto�� HTML -ALBO- link wewn�trzny -ALBO- link zewn�trzny' );
define( 'SUCCESS_PAGE_INSERTED', 'Strona zosta�a pomy�lnie dodana' );
define( 'SUCCESS_PAGE_UPDATED', 'Strona zosta�a pomy�lnie zaktualizowana' );
define( 'SUCCESS_PAGE_REMOVED', 'Strona zosta�a pomy�lnie usuni�ta' );

define( 'HEADING_TITLE', 'System stron EZ :: ' );
define( 'TEXT_INFO_PAGES_ID', 'ID: ' );
define( 'TEXT_INFO_PAGES_ID_SELECT', 'Wybierz stron� ...' );

define( 'TEXT_SORT_CHAPTER_TOC_TITLE_INFO', 'Sortuj wed�ug: ' );
define( 'TEXT_SORT_CHAPTER_TOC_TITLE', 'Rozdzia�/ST' );
define( 'TEXT_SORT_HEADER_TITLE', 'Nag��wek' );
define( 'TEXT_SORT_SIDEBOX_TITLE', 'Box' );
define( 'TEXT_SORT_FOOTER_TITLE', 'Stopka' );
define( 'TEXT_SORT_PAGE_TITLE', 'Tytu� strony' );
define( 'TEXT_SORT_PAGE_ID_TITLE', 'ID, Tytu�' );

define( 'TABLE_HEADING_ID', 'ID' );
define( 'TABLE_HEADING_PAGES', 'Strona' );
define( 'TABLE_HEADING_PAGE_OPEN_NEW_WINDOW', 'Otw�rz w nowym oknie: ' );
define( 'TABLE_HEADING_PAGE_IS_SSL', 'Strona w SSL: ' );
define( 'TABLE_HEADING_STATUS_HEADER', 'Nag�owek: ' );
define( 'TABLE_HEADING_STATUS_SIDEBOX', 'Box: ' );
define( 'TABLE_HEADING_STATUS_FOOTER', 'Stopka: ' );
define( 'TABLE_HEADING_CHAPTER', 'Rozdzia�: ' );
define( 'TABLE_HEADING_STATUS_TOC', 'ST: ' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );
define( 'TEXT_DISPLAY_NUMBER_OF_PAGES', 'Wy�wietlono od <strong>%d</strong> do <strong>%d</strong> (z <strong>%d</strong> stron)' );
define( 'IMAGE_NEW_PAGE', 'Nowa strona' );

define( 'TEXT_INFO_DELETE_INTRO', 'Czy na pewno usun�� stron�?' );

define( 'TEXT_PAGE_TITLE', 'Tytu�: ' );
define( 'TEXT_CHAPTER', 'Rozdzia�: ' );
define( 'TEXT_WARNING_MULTIPLE_SETTINGS', '<strong>OSTRZE�ENIE: Zdefiniowano wiele link�w</strong>' );
define( 'TEXT_ALT_URL', 'Wewn�trzny link URL: ' );
define( 'TEXT_ALT_URL_EXTERNAL', 'Zewn�trzny link URL: ' );
define( 'TEXT_PAGES_HTML_TEXT', 'Zawarto�� HTML: ' );
define( 'TEXT_PAGES_SCHEDULED_AT_DATE', 'Rozpocz�cie wy�wietlania: <strong>%s</strong>' );
define( 'TEXT_PAGES_EXPIRES_AT_DATE', 'Wygasa: <strong>%s</strong>');
define( 'TEXT_PAGES_EXPIRES_AT_IMPRESSIONS', 'Wygasa po: <strong>%s</strong> wy�wietleniach' );
define( 'TEXT_PAGES_STATUS_CHANGE', 'Zmiana statusu: %s' );

define( 'TEXT_PAGES_TITLE', 'Tytu� strony: ' );
define( 'TEXT_HEADER_SORT_ORDER', 'Sortowanie: ' );
define( 'TEXT_SIDEBOX_SORT_ORDER', 'Sortowanie: ' );
define( 'TEXT_FOOTER_SORT_ORDER', 'Sortowanie: ' );
define( 'TABLE_HEADING_CHAPTER_PREV_NEXT', 'Rozdzia�:&nbsp;<br />' );
define( 'TEXT_TOC_SORT_ORDER', 'Sortowanie: ' );
define( 'TEXT_HEADER_SORT_ORDER_EXPLAIN', 'Sortowanie w nag��wku oznacza kolejno�� wy�wietlania linka do strony w belce nag��wka; Warto�� sortowania powinna by� wi�ksza od zera, aby w��czy� stron� w nag��wku' );
define( 'TEXT_SIDEBOX_ORDER_EXPLAIN', 'Sortowanie w boxie oznacza kolejno�� wy�wietlania linka do strony w boxie licz�c od g�ry; Warto�� sortowania powinna by� wi�ksza od zera, aby w��czy� stron� na li�cie boxa' );
define( 'TEXT_FOOTER_ORDER_EXPLAIN', 'Sortowanie w stopce oznacza kolejno�� wy�wietlania linka do strony w belce stopki; Warto�� sortowania powinna by� wi�ksza od zera, aby w��czy� stron� w stopce' );
define( 'TEXT_TOC_SORT_ORDER_EXPLAIN', 'Sortowanie ST (Spis Tre�ci) porz�dkuje strony w spisie tre�ci dla danego rodzia�u; Sortowanie powinno by� wi�ksze od zera, aby w��czy� stron� na li�cie spisu tre�ci' );
define( 'TEXT_CHAPTER_EXPLAIN', 'Rozdzia�y s� u�ywane ��cznie z ST (Spis Tre�ci) tworz�c sortowanie dla linka Poprzedni/Nast�pny. Linki w ST s� sortowane dla danego rozdzia�u' );
define( 'TEXT_ALT_URL_EXPLAIN', 'Je�li wpiszemy tutaj link wpisana zawarto�� b�dzie pomini�ta (nie b�dzie wy�wietlana), poniewa� zostanie wykonany WEWN�TRZNY link<br />Np. link do recenzji to: index.php?main_page=reviews<br />Link do sekcji "Moje konto": index.php?main_page=account + SSL' );
define( 'TEXT_ALT_URL_EXTERNAL_EXPLAIN', 'Je�li wpiszemy tutaj link, zawarto�� b�dzie pomini�ta (nie b�dzie wyswietlana), poniewa� zostanie wykonany ZEWN�TRZNY link<br />Np. link zewn�trzny do ZenCart.pl: http://www.zencart.pl' );

define( 'TABLE_HEADING_DATE_ADDED', 'Data dodania' );

/**/
define('TABLE_HEADING_VSORT_ORDER', 'Sortowanie w boxie');
define('TABLE_HEADING_HSORT_ORDER', 'Sortowanie w stopce');
define('TEXT_INFO_PAGE_IMAGE', 'Obrazek');
define('TEXT_INFO_CURRENT_IMAGE', 'Obecny obrazek:');

?>