<?php
/**
 *
 * @version $Id: banner_manager.php, v 1.3.7 2007/04/26 11:48:12 $;
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

define( 'SUCCESS_BANNER_STATUS_UPDATED', 'Status banera zosta� zaktualizowany' );
define( 'ERROR_UNKNOWN_STATUS_FLAG', 'B��d: Nieznany status' );
define( 'SUCCESS_BANNER_ON_SSL_UPDATED', 'Powiod�o si�: Status wy�wietlania banera w po��czeniu SLL zosta� zmieniony' );
define( 'ERROR_UNKNOWN_BANNER_ON_SSL', 'B��d: Nieznany status' );
define( 'SUCCESS_BANNER_OPEN_NEW_WINDOW_UPDATED', 'Powiod�o si�: Staus otwrcia banera w nowym oknie zosta� zmieniony' );
define( 'ERROR_UNKNOWN_BANNER_OPEN_NEW_WINDOW', 'B��d: Nieznany status' );
define( 'ERROR_BANNER_TITLE_REQUIRED', 'B��d: Wymagany tytu� banera' );
define( 'ERROR_BANNER_GROUP_REQUIRED', 'B��d: Wymagana grupa banera' );
define( 'ERROR_BANNER_IMAGE_REQUIRED', 'B��d: Wymagany obraz banera' );
define( 'SUCCESS_BANNER_INSERTED', 'Baner zosta� wstawiony' );
define( 'SUCCESS_BANNER_UPDATED', 'Baner zosta� zmieniony' );
define( 'ERROR_IMAGE_IS_NOT_WRITEABLE', 'B��d: Nie mo�na usun�� obrazka' );
define( 'ERROR_IMAGE_DOES_NOT_EXIST', 'B��d: Obrazek nie istnieje' );
define( 'SUCCESS_BANNER_REMOVED', 'Banner zosta� usuni�ty' );

define( 'ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'B��d: Nie mo�na zapistywa� do katalogu wykres�w: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>' );
define( 'ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'B��d: Katalog wykres�w nie istnieje. Prosz� utworzy� katalog:  <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>' );

define( 'HEADING_TITLE', 'Zarz�dzanie banerami' );

define( 'TEXT_LEGEND_BANNER_ON_SSL', 'Poka� w SSL' );
define( 'IMAGE_ICON_BANNER_ON_SSL_ON', 'Poka� w SLL - W��czone' );
define( 'IMAGE_ICON_BANNER_ON_SSL_OFF', 'Poka� w SLL - Wy��czone' );
define( 'TEXT_LEGEND_BANNER_OPEN_NEW_WINDOWS', 'Nowe okno' );
define( 'IMAGE_ICON_BANNER_OPEN_NEW_WINDOWS_ON', 'Otw�rz w nowym oknie - W��czone' );
define( 'IMAGE_ICON_BANNER_OPEN_NEW_WINDOWS_OFF', 'Otw�rz w nowym oknie - Wy��czone' );

define( 'TEXT_BANNERS_STATUS', 'Status: ' );
define( 'TEXT_BANNERS_ACTIVE', 'Aktywny' );
define( 'TEXT_BANNERS_NOT_ACTIVE', 'Nieaktywny' );
define( 'TEXT_INFO_BANNER_STATUS', '<strong>INFORMACJA:</strong> Status banera jest aktualizowany na podstawie daty rozpocz�cia i liczby wy�wietle�' );
define( 'TEXT_BANNERS_OPEN_NEW_WINDOWS', 'Nowe okno' );
define( 'TEXT_INFO_BANNER_OPEN_NEW_WINDOWS', '<strong>UWAGA:</strong> Baner zostanie otwarty w nowym oknie' );
define( 'TEXT_BANNERS_ON_SSL', 'Baner dla SSL' );
define( 'TEXT_INFO_BANNER_ON_SSL', '<strong>UWAGA:</strong> Baner b�dzie wy�wietlany w bezpiecznym po��czeniu SSL' );
define( 'TEXT_BANNERS_TITLE', 'Tytu� banera: ' );
define( 'TEXT_BANNERS_URL', 'Link: ' );
define( 'TEXT_BANNERS_GROUP', 'Grupa: ' );
define( 'TEXT_BANNERS_NEW_GROUP', ', lub wpisz now� grup� dla banera' );
define( 'TEXT_BANNERS_IMAGE', 'Obraz: ' );
define( 'TEXT_BANNERS_IMAGE_LOCAL', ', lub wprowad� lokalny plik' );
define( 'TEXT_BANNERS_IMAGE_TARGET', 'Obrazek (Zapisz do): ' );
define( 'TEXT_BANNER_IMAGE_TARGET_INFO', '<strong>Sugerowany katalog docelowy dla obrazk�w banera na serwerze:</strong> ' . DIR_FS_CATALOG_IMAGES . 'banners/' );
define( 'TEXT_BANNERS_HTML_TEXT', 'Tekst HTML: ' );
define( 'TEXT_BANNERS_HTML_TEXT_INFO', '<strong>UWAGA: Dla baner�w HTML nie s� zliczane klikni�cia</strong>' );
define( 'TEXT_BANNERS_ALL_SORT_ORDER', 'Porz�dek sortowania - banner_box_all' );
define( 'TEXT_BANNERS_ALL_SORT_ORDER_INFO', '<strong>UWAGA: Sortowanie banners_box_all wy�wietla banery w zdefiniowanym porz�dku wed�ug ustawie� sortowania</strong>' );
define( 'TEXT_BANNERS_SCHEDULED_AT', 'Rozpocz�cie wy�wietlania: ' );
define( 'TEXT_BANNERS_EXPIRES_ON', 'Zako�czenie wy�wietlania: ' );
define( 'TEXT_BANNERS_OR_AT', ', lub po' );
define( 'TEXT_BANNERS_IMPRESSIONS', 'wy�wietleniach' );
define( 'TEXT_BANNERS_BANNER_NOTE', '<strong>Informacje o Banerze:</strong><ul><li>U�yj obrazka lub tekstu HTML jako banera - nie obu na raz.</li><li>Tekst HTML ma wy�szy priorytet ni� obrazek.</li><li>W przypadku tekstu HTML nie s� rejestrowane wy�wietlenia</li><li>Baner okre�lony �cie�k� absolutn� nie b�dzie wy�wietlany na stronach w trybie SSL</li></ul>' );
define( 'TEXT_BANNERS_INSERT_NOTE', '<strong>Informacje o Obrazku:</strong><ul><li>Katalogi w kt�rych chcesz umie�ci� obrazki musz� mie� odpowiednie uprawnienia zapisu!</li><li>Nie wype�niaj pola \'Obrazek zapisz do\' je�eli wgrywasz obrazek na serwer (np., je�eli u�ywasz lokalnego obrazka - znajduj�cego si� na dysku serwera).</li><li>Pole \'Obrazek zapisz do\' musi wskazywa� na istniej�cy katalog i ko�czy� si� slashem (np. banners/).</li></ul>' );
define( 'TEXT_BANNERS_EXPIRCY_NOTE', '<strong>Informacje o Wyga�ni�ciu:</strong><ul><li>Tylko jedno z dw�ch p�l powinno by� wype�nione</li><li>Je�eli nie chcesz aby baner wygas� automatycznie pozostaw to pole puste</li></ul>' );
define( 'TEXT_BANNERS_SCHEDULE_NOTE', '<strong>Informacje o Rozpocz�ciu:</strong><ul><li>Je�eli pole \'Rozpocz�cie dnia\' jest ustawione  emisja banera rozpocznie si� w tym dniu.</li><li>Wszystkie banery z ustawion� dat� startu emisji zaznaczone s� jako wy��czone. W��cz� si� gdy data rozpocz�cia nadejdzie.</li></ul>' );

define( 'TABLE_HEADING_BANNERS', 'Baner' );
define( 'TABLE_HEADING_GROUPS', 'Grupa' );
define( 'TABLE_HEADING_STATISTICS', 'Wy�wietle� / Klikni��' );
define( 'TABLE_HEADING_STATUS', 'Status' );
define( 'TABLE_HEADING_BANNER_OPEN_NEW_WINDOWS', 'Nowe okno' );
define( 'TABLE_HEADING_BANNER_ON_SSL', 'Poka� w SSL' );
define( 'TABLE_HEADING_BANNER_SORT_ORDER', 'Sortowanie' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );

define( 'TEXT_INFO_DELETE_INTRO', 'Czy usun�� ten baner?' );
define( 'TEXT_INFO_DELETE_IMAGE', 'Usun�� obraz banera?' );

define( 'TEXT_BANNERS_DATE_ADDED', 'Data dodania: ' );

define( 'TEXT_BANNERS_LAST_3_DAYS', 'Ostatnie 3 dni' );
define( 'TEXT_BANNERS_DATA', 'D<br />A<br />N<br />E' );

define( 'TEXT_BANNERS_BANNER_VIEWS', 'Wy�wietlenia' );
define( 'TEXT_BANNERS_BANNER_CLICKS', 'Klikni�cia' );
define( 'TEXT_BANNERS_SCHEDULED_AT_DATE', 'Rozpocz�cie wy�wietlania: <strong>%s</strong>' );
define( 'TEXT_BANNERS_EXPIRES_AT_DATE', 'Wygasa: <strong>%s</strong>');
define( 'TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Wygasa po: <strong>%s</strong> wy�wietleniach' );
define( 'TEXT_BANNERS_STATUS_CHANGE', 'Zmiana statusu: %s' );

/**/
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'B��d: Katalog nie istnieje: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'B��d: Nie mo�na zapisywa� do katalogu: %s');

?>