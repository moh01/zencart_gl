<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.at/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.at/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: products_to_categories.php 2909 2006-01-29 21:29:35Z ajeh $
//

define('HEADING_TITLE', 'Artikel in mehrere Kategorien anzeigen - Link Manager ...');
define('HEADING_TITLE2', 'Kategorien / Artikel');
define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_AVAILABLE', 'Kategorien mit verlinkbaren Artikeln ...');
define('TABLE_HEADING_PRODUCTS_ID', 'Artikel ID');
define('TABLE_HEADING_PRODUCT', 'Artikelname');
define('TABLE_HEADING_MODEL', 'Bezeichnung');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TEXT_INFO_HEADING_EDIT_PRODUCTS_TO_CATEGORIES', 'ARTIKEL ZU KATEGORIE INFORMATIONEN EDITIEREN');
define('TEXT_PRODUCTS_ID', 'Artikel ID# ');
define('TEXT_PRODUCTS_NAME', 'Artikel: ');
define('TEXT_PRODUCTS_MODEL', 'Bezeichnung: ');
define('TEXT_PRODUCTS_PRICE', 'Preis: ');
define('BUTTON_UPDATE_CATEGORY_LINKS', 'Kategorie Links aktualisieren');
define('BUTTON_NEW_PRODUCTS_TO_CATEGORIES', 'Artikel verlinken');
define('TEXT_SET_PRODUCTS_TO_CATEGORIES_LINKS', 'Setze Artikel - Kategorie Links f&uuml;r: ');
define('TEXT_INFO_LINKED_TO_COUNT', '&nbsp;&nbsp;Aktuelle Anzahl verlinkter Kategorien: ');
define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER_INTRO',
    'Artikel in mehrere Kategorien anzeigen - Link Manager wurde entwickelt um schnell einen Artikel mit ein oder mehreren anderen Kategorien verlinken zu k&ouml;nnen.<br />Es k&ouml;nnen auch alle Artikel einer Kategorie mit einer anderen Kategorie verlinkt werden. Selbstverst&auml;ndlich k&ouml;nnen bestehende Links mit dieses Tool wieder gel&ouml;scht werden. (siehe Information n&auml;chster Punkt)');
define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER',
    'Zur Preisberechnung muss jeder Artikel einer Hauptkategorie zugewiesen sein, unabh&auml;ngig davon mit wievielen anderen Kategorien dieser verlinkt ist. Verwenden Sie dazu das Dropdown Feld &quot;Hauptkategorie&quot;.<br />
Der Artikel ist aktuell folgenden Kategorien zugewiesen (siehe Checkbox). Einfach Checkbox neben Kategorienamen selektieren bzw. deselektiern um Verlinkung hinzu zu f&uuml;gen bzw. zu l&ouml;schen.<br />
Zum Speichern den Button ' . BUTTON_UPDATE_CATEGORY_LINKS . ' dr&uuml;cken.<br />'
    );
define('HEADER_CATEGORIES_GLOBAL_CHANGES', 'Globale Kategorie-Link &Auml;nderungen und Hauptkategorie-ID Reset');
define('TEXT_SET_MASTER_CATEGORIES_ID', '<strong>ACHTUNG:</strong> Hauptkategorie-ID &auml;nderen bevor verlinkte Kategorien ver&auml;ndert werden!');

// copy category to category linked
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Kopiere ALLE Artikel einer Kategorie als VERLINKTE Artikel in eine andere ...</strong><br />z.B. 8 und 22 bedeutet das ALLE Artikel in Kategorie 8 zu Kategorie 22 verlinkt werden');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Selektiere ALLE Artikel einer Kategorie: ');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Mit Kategorie verlinken: ');
define('BUTTON_COPY_CATEGORY_LINKED', 'Kopiere & verlinke Artikel ');
define('WARNING_PRODUCTS_LINK_TO_CATEGORY_REMOVED', 'WARNUNG: Artikel wurde zur&uuml;ckgesetzt und ist nicht mehr Teil dieser Kategorie  ...');
define('WARNING_COPY_LINKED', 'WARNUNG: ');
define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Falsche Kategorie um Artikel aus Kategorie zu verlinken: ');
define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Falsche Kategorie um Artikel in Kategorie zu verlinken: ');
define('WARNING_NO_CATEGORIES_ID', 'Warnung: Keine Kategorie ausgew&auml;hlt ... keine &Auml;nderung gemacht');
define('SUCCESS_COPY_LINKED', 'Erfolgreiche Aktualisierung der verlinkten Artikel ... ');
define('SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Artikel aus folgender Kategorie verlinken: ');
define('SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Artikel in folgende Kategorie verlinken: ');
define('WARNING_COPY_FROM_IN_TO_LINKED', '<strong>WARNUNG: Keine &Auml;nderungen durchgef&uuml;hrt - Artikel bereits verlinkt ... </strong>');

// remove category to category linked
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Entferne ALLE VERLINKTEN Artikel einer Kategorie ...</strong><br />z.B. Bei 8 und 22 werden ALLE Artikel-Links zu Kategorie 22 in Kategorie 8 entfernt');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Selektiere Alle Artikel einer Kategorie: ');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Entferne Link zu Kategorie: ');
define('BUTTON_REMOVE_CATEGORY_LINKED', 'Entferne verlinkte Artikel');
define('WARNING_REMOVE_LINKED', 'WARNUNG: ');
define('WARNING_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Nicht m&ouml;glich Artikel aus folgender Kategorie zu verlinken: ');
define('WARNING_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Nicht m&ouml;glich Artikel in diese Kategorie zu verlinken: ');
define('SUCCESS_REMOVE_LINKED', 'Verlinkte Artikel erfolgreich entfernt ... ');
define('SUCCESS_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Verlinkte Artikel aus Kategorie l&ouml;schen: ');
define('SUCCESS_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Verlinkte Artikel in diese Kategorie l&ouml;schen: ');
define('WARNING_REMOVE_FROM_IN_TO_LINKED', '<strong>WARNUNG: Keine &Auml;nderungen gemacht, keine Artikel verlinkt ... </strong>');
define('WARNING_MASTER_CATEGORIES_ID_CONFLICT', '<strong>ACHTUNG: HAUPTKATEGORIE-ID KONFLIKT!! </strong>');
define('TEXT_INFO_MASTER_CATEGORIES_ID_CONFLICT', '<strong>Hauptkategorie ID ist: </strong>');
define('TEXT_INFO_MASTER_CATEGORIES_ID_PURPOSE', 'Anmerkung: Die Hauptkategorie wird zur Preisberechnung bei verlinkten Artikeln verwendet. z.B. Sonderangebote <br />');
define('WARNING_MASTER_CATEGORIES_ID_CONFLICT_FIX', 'Um dieses Problem zu beheben werden Sie zu dem ersten Artikel, der das Problem verursacht hat, weitergeleitet. Weisen Sie eine neue Hauptkategorie-ID zu, damit die Kategorie welche Sie versuchen zu entfernen, nicht l&auml;ger die Hauptkategorie f&uuml;r diesen Artikel ist. Erst wenn alle Konflikte behoben sind kann das L&ouml;schen ausgef&uuml;hrt werden.');
define('TEXT_MASTER_CATEGORIES_ID_CONFLICT_FROM', ' Widerspr&uuml;chliche  Quellkategorie: ');
define('TEXT_MASTER_CATEGORIES_ID_CONFLICT_TO', ' Widerspr&uuml;chliche  Zielkategorie: ');
define('SUCCESS_MASTER_CATEGORIES_ID', 'Erfolgreiche Aktualisierung Artikel zu Kategorie Links ...');
define('WARNING_MASTER_CATEGORIES_ID', 'WARNUNG: Keine Hauptkategorie gesetzt!');
define('TEXT_PRODUCTS_ID_INVALID', 'WARNUNG: UNG&Uuml;LTIGE ARTIKEL-ID ODER KEIN ARTIKEL AUSGEW&Auml;HLT');
define('TEXT_PRODUCTS_ID_NOT_REQUIRED', 'Anmerkung: Eine Artikel-ID wird nicht unbedingt ben&ouml;tigt um alle Artikel einer Kategorie in eine andere Kategorie zu linken.<br />Allerdings werden bei gesetzter Artikel ID alle verf&uuml;gbaren Kategorien und deren ID angezeigt.');

// reset all products to new master_categories_id
// copy category to category linked
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_MASTER', '<strong>ALLE Artikel in der selektierten Kategorie sollen diese als Hauptkategorie verwenden ...</strong><br />z.B: Kategorie 22 zur&uuml;cksetzen bedeutet, dass ALLE Produkte in Kategorie 22, diese als HauptKategorie-ID verwenden');
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'R&uuml;cksetzen der Hauptkategorie-ID f&uuml;r ALLE Artikel in Kategorie: ');
define('BUTTON_RESET_CATEGORY_MASTER', 'Hauptkategorie-ID zur&uuml;cksetzen');
define('WARNING_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'WARNUNG: Unzul&auml;ssige Kategorie ausgew&auml;hlt ...');
define('SUCCESS_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Erfolgreiche Aktualisierung der Hauptkategorie-ID f&uuml;r alle Artikel der Kategorie: ');



?>