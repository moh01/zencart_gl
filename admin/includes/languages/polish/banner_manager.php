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
 * Wiêcej informacji na stronie projektu {@link http://www.zencart.pl ZenCart.pl} Zajrzyj!
 *
 *
 * @package admin
 *
 */

define( 'SUCCESS_BANNER_STATUS_UPDATED', 'Status banera zosta³ zaktualizowany' );
define( 'ERROR_UNKNOWN_STATUS_FLAG', 'B³±d: Nieznany status' );
define( 'SUCCESS_BANNER_ON_SSL_UPDATED', 'Powiod³o siê: Status wy¶wietlania banera w po³±czeniu SLL zosta³ zmieniony' );
define( 'ERROR_UNKNOWN_BANNER_ON_SSL', 'B³±d: Nieznany status' );
define( 'SUCCESS_BANNER_OPEN_NEW_WINDOW_UPDATED', 'Powiod³o siê: Staus otwrcia banera w nowym oknie zosta³ zmieniony' );
define( 'ERROR_UNKNOWN_BANNER_OPEN_NEW_WINDOW', 'B³±d: Nieznany status' );
define( 'ERROR_BANNER_TITLE_REQUIRED', 'B³±d: Wymagany tytu³ banera' );
define( 'ERROR_BANNER_GROUP_REQUIRED', 'B³±d: Wymagana grupa banera' );
define( 'ERROR_BANNER_IMAGE_REQUIRED', 'B³±d: Wymagany obraz banera' );
define( 'SUCCESS_BANNER_INSERTED', 'Baner zosta³ wstawiony' );
define( 'SUCCESS_BANNER_UPDATED', 'Baner zosta³ zmieniony' );
define( 'ERROR_IMAGE_IS_NOT_WRITEABLE', 'B³±d: Nie mo¿na usun±æ obrazka' );
define( 'ERROR_IMAGE_DOES_NOT_EXIST', 'B³±d: Obrazek nie istnieje' );
define( 'SUCCESS_BANNER_REMOVED', 'Banner zosta³ usuniêty' );

define( 'ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'B³±d: Nie mo¿na zapistywaæ do katalogu wykresów: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>' );
define( 'ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'B³±d: Katalog wykresów nie istnieje. Proszê utworzyæ katalog:  <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>' );

define( 'HEADING_TITLE', 'Zarz±dzanie banerami' );

define( 'TEXT_LEGEND_BANNER_ON_SSL', 'Poka¿ w SSL' );
define( 'IMAGE_ICON_BANNER_ON_SSL_ON', 'Poka¿ w SLL - W³±czone' );
define( 'IMAGE_ICON_BANNER_ON_SSL_OFF', 'Poka¿ w SLL - Wy³±czone' );
define( 'TEXT_LEGEND_BANNER_OPEN_NEW_WINDOWS', 'Nowe okno' );
define( 'IMAGE_ICON_BANNER_OPEN_NEW_WINDOWS_ON', 'Otwórz w nowym oknie - W³±czone' );
define( 'IMAGE_ICON_BANNER_OPEN_NEW_WINDOWS_OFF', 'Otwórz w nowym oknie - Wy³±czone' );

define( 'TEXT_BANNERS_STATUS', 'Status: ' );
define( 'TEXT_BANNERS_ACTIVE', 'Aktywny' );
define( 'TEXT_BANNERS_NOT_ACTIVE', 'Nieaktywny' );
define( 'TEXT_INFO_BANNER_STATUS', '<strong>INFORMACJA:</strong> Status banera jest aktualizowany na podstawie daty rozpoczêcia i liczby wy¶wietleñ' );
define( 'TEXT_BANNERS_OPEN_NEW_WINDOWS', 'Nowe okno' );
define( 'TEXT_INFO_BANNER_OPEN_NEW_WINDOWS', '<strong>UWAGA:</strong> Baner zostanie otwarty w nowym oknie' );
define( 'TEXT_BANNERS_ON_SSL', 'Baner dla SSL' );
define( 'TEXT_INFO_BANNER_ON_SSL', '<strong>UWAGA:</strong> Baner bêdzie wy¶wietlany w bezpiecznym po³±czeniu SSL' );
define( 'TEXT_BANNERS_TITLE', 'Tytu³ banera: ' );
define( 'TEXT_BANNERS_URL', 'Link: ' );
define( 'TEXT_BANNERS_GROUP', 'Grupa: ' );
define( 'TEXT_BANNERS_NEW_GROUP', ', lub wpisz now± grupê dla banera' );
define( 'TEXT_BANNERS_IMAGE', 'Obraz: ' );
define( 'TEXT_BANNERS_IMAGE_LOCAL', ', lub wprowad¼ lokalny plik' );
define( 'TEXT_BANNERS_IMAGE_TARGET', 'Obrazek (Zapisz do): ' );
define( 'TEXT_BANNER_IMAGE_TARGET_INFO', '<strong>Sugerowany katalog docelowy dla obrazków banera na serwerze:</strong> ' . DIR_FS_CATALOG_IMAGES . 'banners/' );
define( 'TEXT_BANNERS_HTML_TEXT', 'Tekst HTML: ' );
define( 'TEXT_BANNERS_HTML_TEXT_INFO', '<strong>UWAGA: Dla banerów HTML nie s± zliczane klikniêcia</strong>' );
define( 'TEXT_BANNERS_ALL_SORT_ORDER', 'Porz±dek sortowania - banner_box_all' );
define( 'TEXT_BANNERS_ALL_SORT_ORDER_INFO', '<strong>UWAGA: Sortowanie banners_box_all wy¶wietla banery w zdefiniowanym porz±dku wed³ug ustawieñ sortowania</strong>' );
define( 'TEXT_BANNERS_SCHEDULED_AT', 'Rozpoczêcie wy¶wietlania: ' );
define( 'TEXT_BANNERS_EXPIRES_ON', 'Zakoñczenie wy¶wietlania: ' );
define( 'TEXT_BANNERS_OR_AT', ', lub po' );
define( 'TEXT_BANNERS_IMPRESSIONS', 'wy¶wietleniach' );
define( 'TEXT_BANNERS_BANNER_NOTE', '<strong>Informacje o Banerze:</strong><ul><li>U¿yj obrazka lub tekstu HTML jako banera - nie obu na raz.</li><li>Tekst HTML ma wy¿szy priorytet ni¿ obrazek.</li><li>W przypadku tekstu HTML nie s± rejestrowane wy¶wietlenia</li><li>Baner okre¶lony ¶cie¿k± absolutn± nie bêdzie wy¶wietlany na stronach w trybie SSL</li></ul>' );
define( 'TEXT_BANNERS_INSERT_NOTE', '<strong>Informacje o Obrazku:</strong><ul><li>Katalogi w których chcesz umie¶ciæ obrazki musz± mieæ odpowiednie uprawnienia zapisu!</li><li>Nie wype³niaj pola \'Obrazek zapisz do\' je¿eli wgrywasz obrazek na serwer (np., je¿eli u¿ywasz lokalnego obrazka - znajduj±cego siê na dysku serwera).</li><li>Pole \'Obrazek zapisz do\' musi wskazywaæ na istniej±cy katalog i koñczyæ siê slashem (np. banners/).</li></ul>' );
define( 'TEXT_BANNERS_EXPIRCY_NOTE', '<strong>Informacje o Wyga¶niêciu:</strong><ul><li>Tylko jedno z dwóch pól powinno byæ wype³nione</li><li>Je¿eli nie chcesz aby baner wygas³ automatycznie pozostaw to pole puste</li></ul>' );
define( 'TEXT_BANNERS_SCHEDULE_NOTE', '<strong>Informacje o Rozpoczêciu:</strong><ul><li>Je¿eli pole \'Rozpoczêcie dnia\' jest ustawione  emisja banera rozpocznie siê w tym dniu.</li><li>Wszystkie banery z ustawion± dat± startu emisji zaznaczone s± jako wy³±czone. W³±cz± siê gdy data rozpoczêcia nadejdzie.</li></ul>' );

define( 'TABLE_HEADING_BANNERS', 'Baner' );
define( 'TABLE_HEADING_GROUPS', 'Grupa' );
define( 'TABLE_HEADING_STATISTICS', 'Wy¶wietleñ / Klikniêæ' );
define( 'TABLE_HEADING_STATUS', 'Status' );
define( 'TABLE_HEADING_BANNER_OPEN_NEW_WINDOWS', 'Nowe okno' );
define( 'TABLE_HEADING_BANNER_ON_SSL', 'Poka¿ w SSL' );
define( 'TABLE_HEADING_BANNER_SORT_ORDER', 'Sortowanie' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );

define( 'TEXT_INFO_DELETE_INTRO', 'Czy usun±æ ten baner?' );
define( 'TEXT_INFO_DELETE_IMAGE', 'Usun±æ obraz banera?' );

define( 'TEXT_BANNERS_DATE_ADDED', 'Data dodania: ' );

define( 'TEXT_BANNERS_LAST_3_DAYS', 'Ostatnie 3 dni' );
define( 'TEXT_BANNERS_DATA', 'D<br />A<br />N<br />E' );

define( 'TEXT_BANNERS_BANNER_VIEWS', 'Wy¶wietlenia' );
define( 'TEXT_BANNERS_BANNER_CLICKS', 'Klikniêcia' );
define( 'TEXT_BANNERS_SCHEDULED_AT_DATE', 'Rozpoczêcie wy¶wietlania: <strong>%s</strong>' );
define( 'TEXT_BANNERS_EXPIRES_AT_DATE', 'Wygasa: <strong>%s</strong>');
define( 'TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Wygasa po: <strong>%s</strong> wy¶wietleniach' );
define( 'TEXT_BANNERS_STATUS_CHANGE', 'Zmiana statusu: %s' );

/**/
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'B³±d: Katalog nie istnieje: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'B³±d: Nie mo¿na zapisywaæ do katalogu: %s');

?>