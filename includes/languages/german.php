<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr/maleborg	http://www.zen-cart.at	2007-01-03
 * @version $Id: english.php 5454 2006-12-29 20:10:17Z drbyte $
 */

// FOLLOWING WERE moved to meta_tags.php
//define('TITLE', 'Zen Cart!');
//define('SITE_TAGLINE', 'The Art of E-commerce');
//define('CUSTOM_KEYWORDS', 'ecommerce, open source, shop, online shopping');
// END: moved to meta_tags.php

define('FOOTER_TEXT_BODY', 'Copyright &copy; ' . date('Y') . ' <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a>. Powered by <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a>');

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
@setlocale(LC_TIME, 'de_DE.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d.%m %Y'); // this is used for strftime()
define('DATE_FORMAT_LONG', '%A, %d. %B %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd.m.Y'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
  if (!function_exists('zen_date_raw')) {
function zen_date_raw($date, $reverse = false){
     if ($reverse){
         return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
         }else{
        // edit by cyaneo for german Date support - thx to hugo13
        // return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
        return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
         }
    }
  }

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR');

// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="ltr" lang="de"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'Aufrufe seit');

// Define the name of your Gift Certificate as Gift Voucher, Gift Certificate, Zen Cart Dollars, etc. here for use through out the shop
define('TEXT_GV_NAME', 'Geschenkgutschein');
define('TEXT_GV_NAMES', 'Geschenkgutscheine');

// used for redeem code, redemption code, or redemption id
define('TEXT_GV_REDEEM', 'Gutscheinnummer');

// used for redeem code sidebox
define('BOX_HEADING_GV_REDEEM', TEXT_GV_NAME);
define('BOX_GV_REDEEM_INFO', 'Gutscheinnummer: ');

// text for gender
define('MALE', 'Herr');
define('FEMALE', 'Frau');
define('MALE_ADDRESS', 'Herr');
define('FEMALE_ADDRESS', 'Frau');

// text for date of birth example
define('DOB_FORMAT_STRING', 'tt/mm/jjjj');

//text for sidebox heading links
define('BOX_HEADING_LINKS', '��[mehr]');

// categories box text in sideboxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Kategorien');

// manufacturers box text in sideboxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Hersteller');

// whats_new box text in sideboxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Neue Artikel');
define('CATEGORIES_BOX_HEADING_WHATS_NEW', 'Neue Artikel...');

define('TEXT_NO_FEATURED_PRODUCTS', 'Weitere �hnliche Artikel erscheinen in K&uuml;rze. Bitte besuchen Sie unseren Shop regelm�&szlig;ig wieder.');
define('BOX_HEADING_FEATURED_PRODUCTS', '�hnliche Artikel');
define('CATEGORIES_BOX_HEADING_FEATURED_PRODUCTS', '�hnliche Artikel...');

define('TEXT_NO_ALL_PRODUCTS', 'Weitere Artikel erscheinen in K&uuml;rze. Bitte besuchen Sie unseren Shop regelm�&szlig;ig wieder.');
define('CATEGORIES_BOX_HEADING_PRODUCTS_ALL', 'Alle Artikel...');

// quick_find box text in sideboxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Suche');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Erweiterte Suche');

// specials box text in sideboxes/specials.php
define('BOX_HEADING_SPECIALS', 'Sonderangebote');
define('CATEGORIES_BOX_HEADING_SPECIALS', 'Sonderangebote...');

// reviews box text in sideboxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Bewertungen');
define('BOX_REVIEWS_WRITE_REVIEW', 'Schreiben Sie eine Bewertung.');
define('BOX_REVIEWS_NO_REVIEWS', 'Es liegen noch keine Bewertungen vor.');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s von 5 Sternen!');

// shopping_cart box text in sideboxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Warenkorb');
define('BOX_SHOPPING_CART_EMPTY', 'Ihr Warenkorb ist leer');
define('BOX_SHOPPING_CART_DIVIDER', '&nbsp;x&nbsp;');

// order_history box text in sideboxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Bestellte Artikel');

// best_sellers box text in sideboxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Top Artikel');
define('BOX_HEADING_BESTSELLERS_IN', 'Top Artikel in<br />��');

// notifications box text in sideboxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Benachrichtigung');
define('BOX_NOTIFICATIONS_NOTIFY', 'Benachrichtigen Sie mich &uuml;ber <strong>%s</strong>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Benachrichtigen Sie mich nicht mehr &uuml;ber <strong>%s</strong>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Herstellerinformation');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Homepage');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Weitere Artikel');

// languages box text in sideboxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Sprachen');

// currencies box text in sideboxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'W�hrungen');

// information box text in sideboxes/information.php
define('BOX_HEADING_INFORMATION', 'Information');
define('BOX_INFORMATION_PRIVACY', 'Datenschutz');
define('BOX_INFORMATION_CONDITIONS', 'AGB');
define('BOX_INFORMATION_SHIPPING', 'Preise und Versand');
define('BOX_INFORMATION_CONTACT', 'Impressum &amp; Kontakt');
define('BOX_BBINDEX', 'Forum');
define('BOX_INFORMATION_UNSUBSCRIBE', 'Newsletter abbestellen');

define('BOX_INFORMATION_SITE_MAP', 'Site Map');

// information box text in sideboxes/more_information.php - were TUTORIAL_
define('BOX_HEADING_MORE_INFORMATION', 'Weitere Informationen');
define('BOX_INFORMATION_PAGE_2', 'Seite 2');
define('BOX_INFORMATION_PAGE_3', 'Seite 3');
define('BOX_INFORMATION_PAGE_4', 'Seite 4');
define('BOX_INFORMATION_PAGE_5', 'Seite 5');
define('BOX_INFORMATION_PAGE_6', 'Seite 6');
define('BOX_INFORMATION_PAGE_7', 'Seite 7');
define('BOX_INFORMATION_PAGE_8', 'Seite 8');
define('BOX_INFORMATION_PAGE_9', 'Seite 9');
define('BOX_INFORMATION_PAGE_10', 'Seite 10');
define('BOX_INFORMATION_PAGE_11', 'Seite 11');

// tell a friend box text in sideboxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Weiterempfehlung');
define('BOX_TELL_A_FRIEND_TEXT', 'Empfehlen Sie unsere Artikel weiter.');

// wishlist box text in includes/boxes/wishlist.php
define('BOX_HEADING_CUSTOMER_WISHLIST', 'Wunschzettel');
define('BOX_WISHLIST_EMPTY', 'Ihr Wunschzettel ist leer');
define('IMAGE_BUTTON_ADD_WISHLIST', 'auf meinen Wunschzettel');
define('TEXT_WISHLIST_COUNT', 'Derzeit sind %s Positionen in Ihrem Wunschzettel.');
define('TEXT_DISPLAY_NUMBER_OF_WISHLIST', 'zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Positionen Ihres Wunschzettels)');

//New billing address text
define('SET_AS_PRIMARY', 'Als Hauptanschrift verwenden');
define('NEW_ADDRESS_TITLE', 'Rechnungsadresse');

// javascript messages
define('JS_ERROR', 'Es sind Fehler aufgetreten.\n\n Bitte �ndern Sie folgendes:\n\n');

define('JS_REVIEW_TEXT', '* Ihre Texteingabe im Bericht muss mindestens ' . REVIEW_TEXT_MIN_LENGTH . ' Zeichen haben.');
define('JS_REVIEW_RATING', '* Um einen Bericht schreiben zu k&ouml;nnen, m&uuml;ssen Sie den Artikel erst bewerten.');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Bitte w�hlen Sie eine Zahlungsart aus.');

define('JS_ERROR_SUBMITTED', 'Die Seite wurde bereits &uuml;bertragen. Klicken Sie auf \"OK\" und warten Sie auf das Ende des Vorgangs.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Bitte w�hlen Sie eine Zahlungsart aus.');
define('ERROR_CONDITIONS_NOT_ACCEPTED', 'Bitte best�tigen Sie unsere AGB!');
define('ERROR_PRIVACY_STATEMENT_NOT_ACCEPTED', 'Bitte best�tigen Sie unsere AGB!');

define('CATEGORY_COMPANY', 'Firmendaten');
define('CATEGORY_PERSONAL', 'Ihre pers&ouml;nlichen Angaben');
define('CATEGORY_ADDRESS', 'Anschrift');
define('CATEGORY_CONTACT', 'Wie erreichen wir Sie?');
define('CATEGORY_OPTIONS', 'Zusatz');
define('CATEGORY_PASSWORD', 'Ihr Passwort');
define('CATEGORY_LOGIN', 'Anmelden');
define('PULL_DOWN_DEFAULT', 'Bitte w�hlen Sie Ihr Land');
define('PLEASE_SELECT', 'Bitte w�hlen Sie ...');
define('TYPE_BELOW', 'Bitte w�hlen Sie unter ...');
define('ENTRY_COMPANY', 'Firmenname:');
define('ENTRY_COMPANY_ERROR', 'Bitte geben Sie einen Firmennamen ein.');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Geschlecht:');
define('ENTRY_GENDER_ERROR', 'Bitte w�hlen Sie Ihre Anrede.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Vorname:');
define('ENTRY_FIRST_NAME_ERROR', 'Ihr Vorname muss mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen haben.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Nachname:');
define('ENTRY_LAST_NAME_ERROR', 'Ihr Nachname muss mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen haben.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Geburtsdatum:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Ihr Geburtsdatum muss folgende Form haben: TT.MM.JJJJ (z. B. 21.02.1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (z. B. 21.02.1970)');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Ihre E-Mail Adresse muss mindestens' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen haben.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Ihre E-Mail Adresse scheint nicht korrekt zu sein. Bitte �ndern Sie diese.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Ihre E-Mail Adresse ist bereits registriert. Bitte melden Sie sich an oder registrieren Sie sich mit einer anderen E-Mail Adresse.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_NICK', 'Forum Nick Name:');
define('ENTRY_NICK_TEXT', '*');   // note to display beside nickname input field
define('ENTRY_NICK_DUPLICATE_ERROR', 'Der Nickname existiert bereits.');
define('ENTRY_NICK_LENGTH_ERROR', 'Der Nickname muss aus mindestens ' . ENTRY_NICK_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_STREET_ADDRESS', 'Stra�e/Nr.:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Die Stra�e/NR muss aus mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Etage/digicode:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Postleitzahl:');
define('ENTRY_POST_CODE_ERROR', 'Die Postleitzahl muss aus mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Ort:');
define('ENTRY_CUSTOMERS_REFERRAL', 'Wie wurden Sie auf uns aufmerksam?');

define('ENTRY_CITY_ERROR', 'Die Stadt muss aus mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Bundesland:');
define('ENTRY_STATE_ERROR', 'Das Bundesland muss aus mindestens ' . ENTRY_STATE_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_STATE_ERROR_SELECT', 'Bitte w�hlen Sie ein Bundesland aus dem Pulldown Men&uuml;.');
define('ENTRY_STATE_TEXT', '*');
define('JS_STATE_SELECT', '-- Bitte w�hlen --');
define('ENTRY_COUNTRY', 'Land:');
define('ENTRY_COUNTRY_ERROR', 'Bitte w�hlen Sie ein Land aus dem Pulldown Men&uuml;.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Telefon:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Die Telefonnummer muss aus mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Newsletter bestellen.');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Bestellen');
define('ENTRY_NEWSLETTER_NO', 'Abbestellen');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Passwort:');
define('ENTRY_PASSWORD_ERROR', 'Das Passwort muss aus mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Die Passwortbest�tigung stimmt nicht mit dem eingegebenen Passwort &uuml;berein.');
define('ENTRY_PASSWORD_TEXT', '* (mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen)');
define('ENTRY_PASSWORD_CONFIRMATION', 'Passwortbest�tigung:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Aktuelles Passwort:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Das Passwort muss aus mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_PASSWORD_NEW', 'Neues Passwort:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Das neue Passwort muss aus mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Die Passwortbest�tigung stimmt nicht mit dem neu eingegebenen Passwort &uuml;berein.');
define('PASSWORD_HIDDEN', '--GEHEIM--');

define('FORM_REQUIRED_INFORMATION', '* = erforderliche Informationen');
define('ENTRY_REQUIRED_SYMBOL', '*');

  // constants for use in zen_prev_next_display function
define('TEXT_RESULT_PAGE', '');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Artikel)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Bestellungen)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Bewertungen)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> neuen Produkten)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Sonderangeboten)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_FEATURED_PRODUCTS', 'zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> �hnlichen Artikel)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_ALL', 'zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Artikel)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Erste Seite');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Vorherige Seite');
define('PREVNEXT_TITLE_NEXT_PAGE', 'N�chste Seite');
define('PREVNEXT_TITLE_LAST_PAGE', 'Letzte Seite');
define('PREVNEXT_TITLE_PAGE_NO', 'Seite %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Vorherige %d Seiten');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'N�chsten %d Seiten');
define('PREVNEXT_BUTTON_FIRST', '<<Erste');
define('PREVNEXT_BUTTON_PREV', '[<<�Vorherige]');
define('PREVNEXT_BUTTON_NEXT', '[N�chste�>>]');
define('PREVNEXT_BUTTON_LAST', 'Letzte>>');

define('TEXT_BASE_PRICE', 'ab ');

define('TEXT_CLICK_TO_ENLARGE', 'gr&ouml;&szlig;eres Bild');

define('TEXT_SORT_PRODUCTS', 'Artikel sortieren ');
define('TEXT_DESCENDINGLY', 'aufsteigend');
define('TEXT_ASCENDINGLY', 'absteigend');
define('TEXT_BY', ' von ');

define('TEXT_REVIEW_BY', 'von %s');
define('TEXT_REVIEW_WORD_COUNT', '%s Worte');
define('TEXT_REVIEW_RATING', 'Bewertung: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Eingetragen: %s');
define('TEXT_NO_REVIEWS', 'Derzeit gibt es keine Bewertungen.');

define('TEXT_NO_NEW_PRODUCTS', 'Weitere neue Artikel erscheinen in K&uuml;rze. Bitte besuchen Sie unseren Shop regelm�&szlig;ig wieder.');

define('TEXT_UNKNOWN_TAX_RATE', 'Steuersatz');

define('TEXT_REQUIRED', '<span class="errorText">ben&ouml;tigt</span>');

  $warn_path = (isset($_SERVER['SCRIPT_FILENAME']) ? @dirname($_SERVER['SCRIPT_FILENAME']) : '.....');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Warnung: Das Installationsverzeichnis existiert noch: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/zc_install. Bitte entfernen Sie zu Ihrer Sicherheit dieses Verzeichnis.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Warnung: In die Konfigurationsdatei kann geschrieben werden: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/includes/configure.php. Dies stellt ein potenzielles Sicherheitsrisiko dar - bitte �ndern Sie die Schreibrechte f&uuml;r diese Datei.');
  unset($warn_path);
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Warnung: Das Verzeichnis zum Speichern der Sitzungen (Sessions) existiert nicht: ' . zen_session_save_path() . '. Bitte erstellen Sie dieses Verzeichnis, damit Sitzungen (Sessions)gespeichert werden k&ouml;nnen.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Warnung: In das Verzeichnis zum Speichern von Sitzungen (Sessions) kann nicht geschrieben werden: ' . zen_session_save_path() . '. Bitte �ndern Sie die Schreibrechte dieses Verzeichnisses.');
define('WARNING_SESSION_AUTO_START', 'Warnung: session.auto_start ist aktiviert - bitte deaktivieren Sie dieses Feature in der php.ini und starten Sie Ihren Webserver neu.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Warnung: Das Verzeichnis f&uuml;r Downloadartikel existiert nicht: ' . DIR_FS_DOWNLOAD . '. Downloadartikel funktionieren nicht, solange dieses Verzeichnis nicht erstellt wurde.');
define('WARNING_SQL_CACHE_DIRECTORY_NON_EXISTENT', 'Warnung: Das SQL-Cache Verzeichnis existiert nicht: ' . DIR_FS_SQL_CACHE . '. SQL Abfragen k&ouml;nnen nicht zwischengespeichert werden, solange dieses Verzeichnis nicht erstellt wurde.');
define('WARNING_SQL_CACHE_DIRECTORY_NOT_WRITEABLE', 'Warnung: In das Verzeichnis zum Zwischenspeichern von SQL Abfragen kann nicht geschrieben werden: ' . DIR_FS_SQL_CACHE . '. Bitte �ndern Sie die Schreibrechte dieses Verzeichnisses, damit SQL Abfragen zwischengespeichert werden k&ouml;nnen.');
define('WARNING_DATABASE_VERSION_OUT_OF_DATE', 'Ihre Datenbank braucht ein Update. Siehe Admin->Tools->Server Information (Patch-Level).');


define('TEXT_CCVAL_ERROR_INVALID_DATE', 'Das Ablaufdatum der Kreditkarte, das Sie angegeben haben, ist nicht g&uuml;ltig. Bitte &uuml;berpr&uuml;fen Sie Ihre Angaben noch einmal und wiederholen Sie den Vorgang.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Die Kreditkartennummer, die Sie angegeben haben, ist nicht g&uuml;ltig. Bitte &uuml;berpr&uuml;fen Sie Ihre Angaben noch einmal und wiederholen Sie den Vorgang.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Die ersten 4 Ziffer der Kreditkartennummer, die Sie angegeben haben, lauten: %s. Ist diese Nummer richtig, k&ouml;nnen wir diese Kreditkarte nicht akzeptieren. Bitte korrigieren Sie ggf. die eingegebene Nummer oder setzen Sie sich mit Ihren Kreditinstitut in Verbindung.');
define('BOX_INFORMATION_DISCOUNT_COUPONS', 'Aktionskupon');
define('BOX_INFORMATION_GV', TEXT_GV_NAME . ' FAQ');
define('VOUCHER_BALANCE', TEXT_GV_NAME . ' Konto: ');
define('BOX_HEADING_GIFT_VOUCHER', TEXT_GV_NAME . ' Konto');
define('GV_FAQ', TEXT_GV_NAME . ' FAQ');
define('ERROR_REDEEMED_AMOUNT', 'Herzlichen Gl&uuml;ckwunsch! Sie haben Ihren Gutschein erfolgreich eingel&ouml;st.');
define('ERROR_NO_REDEEM_CODE', 'Sie haben keinen ' . TEXT_GV_REDEEM . ' eingegeben.');
define('ERROR_NO_INVALID_REDEEM_GV', 'Falscher ' . TEXT_GV_NAME . ' ' . TEXT_GV_REDEEM);
define('TABLE_HEADING_CREDIT', 'Guthaben verf&uuml;gbar');
define('GV_HAS_VOUCHERA', 'Sie haben Guthaben auf Ihrem ' . TEXT_GV_NAME . 'konto. Wenn Sie m&ouml;chten <br />k&ouml;nnen Sie dieses Guthaben per <a class="pageResults" href="');

define('GV_HAS_VOUCHERB', '"><strong>E-Mail</strong></a> an eine andere Person senden');
define('ENTRY_AMOUNT_CHECK_ERROR', 'Sie haben nicht mehr genug Guthaben auf Ihrem Gutscheinkonto');
define('BOX_SEND_TO_FRIEND', TEXT_GV_NAME . ' versenden >>');

define('VOUCHER_REDEEMED', TEXT_GV_NAME . ' einl&ouml;sen');
define('CART_COUPON', 'Gutschein:');
define('CART_COUPON_INFO', 'Gutscheininfos');
define('TEXT_SEND_OR_SPEND','Sie haben Guthaben auf Ihrem ' . TEXT_GV_NAME . 'konto. Wenn Sie m&ouml;chten <br />k&ouml;nnen Sie dieses Guthaben durch Klick auf untenstehende Schaltfl�che an eine andere Person senden.');
define('TEXT_BALANCE_IS', 'Ihr Guthaben betr�gt: ');
define('TEXT_AVAILABLE_BALANCE', 'Ihr ' . TEXT_GV_NAME . ' Guthaben');

// payment method is GV/Discount
define('PAYMENT_METHOD_GV', 'Geschenkgutschein /Aktionskupon');
define('PAYMENT_MODULE_GV', 'GS/AK');

define('TABLE_HEADING_CREDIT_PAYMENT', 'Guthaben verf&uuml;gbar');

define('TEXT_INVALID_REDEEM_COUPON', 'Ung&uuml;ltiger Aktionscode');
define('TEXT_INVALID_REDEEM_COUPON_MINIMUM', 'Der Mindestbestellwert f&uuml;r diesen Aktionskupon liegt bei %s');
define('TEXT_INVALID_STARTDATE_COUPON', 'Dieser Aktionskupon ist zurzeit nicht erh�ltlich');
define('TEXT_INVALID_FINISDATE_COUPON', 'Dieser Aktionskupon ist abgelaufen');
define('TEXT_INVALID_USES_COUPON', 'Dieser Aktionskupon kann nur');
define('TIMES', 'mal eingel&ouml;st werden');
define('TIME', 'mal eingel&ouml;st werden.');
define('TEXT_INVALID_USES_USER_COUPON', 'der Aktionskupon hat die maximale Einl&ouml;seanzahl pro Kunde erreicht.');
define('REDEEMED_COUPON', 'Aktionskupon einl&ouml;sen');
define('REDEEMED_MIN_ORDER', 'bei Bestellungen &uuml;ber');
define('REDEEMED_RESTRICTIONS', '[Artikelkategorie Einschr�nkung angewendet]');
define('TEXT_ERROR', 'Es ist ein Fehler aufgetreten.');
define('TEXT_INVALID_COUPON_PRODUCT', 'Dieser Aktionskupon ist f&uuml;r keinen der im Warenkorb befindlichen Artikel g&uuml;ltig');
define('TEXT_VALID_COUPON', 'Aktionskupon erfolgreich eingel&ouml;st');
define('TEXT_REMOVE_REDEEM_COUPON_ZONE', 'Der eingegebene Aktionskupon kann mit der ausgew�hlten Adresse nicht eingel&ouml;st werden.');

// more info in place of buy now
define('MORE_INFO_TEXT', '... weitere Infos');

// IP Address
define('TEXT_YOUR_IP_ADDRESS', 'Aus Sicherheitsgr&uuml;nden werden bei jeder Bestellung die IP-Adressen gespeichert.<br />Ihre IP Adresse lautet:');

//Generic Address Heading
define('HEADING_ADDRESS_INFORMATION', 'Adressinformation');

// cart contents
define('PRODUCTS_ORDER_QTY_TEXT_IN_CART', 'St&uuml;ck im Warenkorb:');
define('PRODUCTS_ORDER_QTY_TEXT', 'Anzahl: ');

// success messages for added to cart when display cart is off
// set to blank for no messages
// for all pages except where multiple add to cart is used:
define('SUCCESS_ADDED_TO_CART_PRODUCT', 'Der Artikel wurde in den Warenkorb gelegt ...');
// only for where multiple add to cart is used:
define('SUCCESS_ADDED_TO_CART_PRODUCTS', 'Die ausgew�hlten Artikel wurden in den Warenkorb gelegt ...');

define('TEXT_PRODUCT_WEIGHT_UNIT','kg');

// Shipping
define('TEXT_SHIPPING_WEIGHT','kg');
define('TEXT_SHIPPING_BOXES', 'Pakete');

// Discount Savings
define('PRODUCT_PRICE_DISCOUNT_PREFIX', 'Sie sparen�');
define('PRODUCT_PRICE_DISCOUNT_PERCENTAGE', '% !');
define('PRODUCT_PRICE_DISCOUNT_AMOUNT', '�weniger');

// Sale Maker Sale Price
define('PRODUCT_PRICE_SALE', 'Jetzt nur noch ');

//universal symbols
define('TEXT_NUMBER_SYMBOL', '#');

// banner_box
define('BOX_HEADING_BANNER_BOX', 'Partner');
define('TEXT_BANNER_BOX', 'Besuchen Sie auch unsere Partner ...');

// banner box 2
define('BOX_HEADING_BANNER_BOX2', 'Schon gesehen? ...');
define('TEXT_BANNER_BOX2', 'Besuchen Sie uns noch heute!');

// banner_box - all
define('BOX_HEADING_BANNER_BOX_ALL', 'Partner');
define('TEXT_BANNER_BOX_ALL', 'Besuchen Sie auch unsere Partner ...');

// boxes defines
define('PULL_DOWN_ALL', 'Bitte ausw�hlen');
define('PULL_DOWN_MANUFACTURERS', 'Alle Hersteller');
// shipping estimator
define('PULL_DOWN_SHIPPING_ESTIMATOR_SELECT', 'Bitte w�hlen');

// general Sort By
define('TEXT_INFO_SORT_BY', 'Sortiert nach: ');

// close window image popups
define('TEXT_CLOSE_WINDOW', ' - zum Schlie&szlig;en ins Bild klicken');
// close popups
define('TEXT_CURRENT_CLOSE_WINDOW', '[ Fenster schlie&szlig;en ]');

// iii 031104 added:  File upload error strings
define('ERROR_FILETYPE_NOT_ALLOWED', 'Fehler: Dateityp nicht erlaubt.');
define('WARNING_NO_FILE_UPLOADED', 'Warnung: Keine Datei hochgeladen');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Die Datei wurde erfolgreich gespeichert.');
define('ERROR_FILE_NOT_SAVED', 'Fehler: Datei nicht gespeichert.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Fehler: Auf das Ziel konnte nicht geschrieben werden.');
define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Fehler: Das Ziel existiert nicht.');
define('ERROR_FILE_TOO_BIG', 'Warnung: Die Datei ist zu gro&szlig; f�r den Upload!<br />Der Auftrag kann erteilt werden, nehmen Sie bitte mit uns Kontakt auf um den Upload erfolgreich abzuschlie&szlig;en.');
// End iii added

define('TEXT_BEFORE_DOWN_FOR_MAINTENANCE', 'Hinweis: Unser Shop ist wegen Wartungsarbeiten geschlossen bis (dd/mm/yy) (hh-hh): ');
define('TEXT_ADMIN_DOWN_FOR_MAINTENANCE', 'Hinweis: Unser Shop ist wegen Wartungsarbeiten geschlossen.');

define('PRODUCTS_PRICE_IS_FREE_TEXT', 'Kostenlos!');
define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT', 'F&uuml;r Preis anfragen');
define('TEXT_CALL_FOR_PRICE', 'F&uuml;r Preis anfragen');
define('TEXT_INVALID_SELECTION','Sie haben eine ung&uuml;ltige Auswahl getroffen: ');
define('TEXT_ERROR_OPTION_FOR', 'in der Option f&uuml;r:');
define('TEXT_INVALID_USER_INPUT', 'Benutzereingabe ben&ouml;tigt<br />');

// product_listing
define('PRODUCTS_QUANTITY_MIN_TEXT_LISTING', 'Minimum:');
define('PRODUCTS_QUANTITY_UNIT_TEXT_LISTING', 'St&uuml;ck:');
define('PRODUCTS_QUANTITY_IN_CART_LISTING', 'Im Warenkorb:');
define('PRODUCTS_QUANTITY_ADD_ADDITIONAL_LISTING', 'weitere hinzuf&uuml;gen:');

define('PRODUCTS_QUANTITY_MAX_TEXT_LISTING', 'Maximal:');

define('TEXT_PRODUCTS_MIX_OFF', '*gemischt: AUS');
define('TEXT_PRODUCTS_MIX_ON', '*gemischt: EIN');
define('TEXT_PRODUCTS_MIX_OFF_SHOPPING_CART', '*gemischte Attributmerkmale: AUS');
define('TEXT_PRODUCTS_MIX_ON_SHOPPING_CART', '*gemischte Attributmerkmale: EIN');
define('ERROR_MAXIMUM_QTY', 'St&uuml;ckzahl angepasst - maximale St&uuml;ckzahl wurde in den Warenkorb gelegt ');

define('ERROR_CORRECTIONS_HEADING', 'Bitte korrigieren Sie folgendes: <br />');
define('ERROR_QUANTITY_ADJUSTED', 'Fehler in der gew�hlten Menge<br />');

// Downloads Controller
define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG', 'Bemerkung: Downloads werden erst nach Best�tigung des Zahlungseingangs freigeschaltet.');
define('TEXT_FILESIZE_BYTES', ' Bytes');
define('TEXT_FILESIZE_MEGS', ' MB');

// shopping cart errors
define('ERROR_PRODUCT', 'Artikel:');
define('ERROR_PRODUCT_STATUS_SHOPPING_CART','<br />Leider ist dieses Produkt derzeit nicht in unserem Warenbestand.<br />Das Produkt wurde aus dem Warenkorb entfernt.');
define('ERROR_PRODUCT_QUANTITY_MIN', '...minimale St&uuml;ckzahl unterschritten -');
define('ERROR_PRODUCT_QUANTITY_UNITS', '...ung&uuml;ltige St&uuml;ckzahl -');
define('ERROR_PRODUCT_OPTION_SELECTION', '...ung&uuml;ltige Attributmerkmale gew�hlt -');
define('ERROR_PRODUCT_QUANTITY_ORDERED', 'Die Summe Ihrer Bestellung:');
define('ERROR_PRODUCT_QUANTITY_MAX', '...maximale St&uuml;ckzahl &uuml;berschritten -');
define('ERROR_PRODUCT_QUANTITY_MIN_SHOPPING_CART', '...minimale St&uuml;ckzahl unterschritten -');
define('ERROR_PRODUCT_QUANTITY_UNITS_SHOPPING_CART', '...ung&uuml;ltige St&uuml;ckzahl -');
define('ERROR_PRODUCT_QUANTITY_MAX_SHOPPING_CART', '...maximale St&uuml;ckzahl &uuml;berschritten -');

// error on checkout when $_SESSION['customers_id' does not exist in customers table
define('ERROR_CUSTOMERS_ID_INVALID', 'Die Kundeninformation konnte nicht verifiziert werden!<br />Bitte melden Sie sich an oder erstellen Sie Ihr Kundenkonto erneut ...');

define('TABLE_HEADING_FEATURED_PRODUCTS','�hnliche Artikel');

define('TABLE_HEADING_NEW_PRODUCTS', 'Neue Artikel im %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Kommende Artikel');
define('TABLE_HEADING_DATE_EXPECTED', 'Eingangsdatum');
define('TABLE_HEADING_SPECIALS_INDEX', 'Monatliche Sonderangebote im %s');

// meta tags special defines
define('META_TAG_PRODUCTS_PRICE_IS_FREE_TEXT','Kostenlos!');

// customer login
define('TEXT_SHOWCASE_ONLY', 'Kontakt');
// set for login for prices
define('TEXT_LOGIN_FOR_PRICE_PRICE', 'Preis nicht erh�ltlich');
define('TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE', 'F&uuml;r Preis bitte anmelden');
// set for show room only
define('TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM', '');// blank for prices or enter your own text
define('TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE_SHOWROOM', 'Nur Schauraum');

// authorization pending
define('TEXT_AUTHORIZATION_PENDING_PRICE', 'Preis nicht erh�ltlich');
define('TEXT_AUTHORIZATION_PENDING_BUTTON_REPLACE', '&Uuml;BERPR&Uuml;FUNG L�UFT');
define('TEXT_LOGIN_TO_SHOP_BUTTON_REPLACE','Im Shop anmelden');

// text pricing
define('TEXT_CHARGES_WORD', 'Kalkulierte Geb&uuml;hr:');
define('TEXT_PER_WORD', '<br />Preis pro Wort: ');
define('TEXT_WORDS_FREE', ' Wort(e) frei ');
define('TEXT_CHARGES_LETTERS', 'Kalkulierte Geb&uuml;hr:');
define('TEXT_PER_LETTER', '<br />Preis pro Buchstabe: ');
define('TEXT_LETTERS_FREE', ' Buchstabe(n) frei ');
define('TEXT_ONETIME_CHARGES', '*einmalige Geb&uuml;hr = ');
define('TEXT_ONETIME_CHARGES_EMAIL', "\t" . '*einmalige Geb&uuml;hr = ');
define('TEXT_ONETIME_CHARGES_BASKET', "-&nbsp;einmalige Geb&uuml;hren");
define('TEXT_ATTRIBUTES_QTY_PRICES_HELP', 'Option f&uuml;r Mengenrabatte');
define('TABLE_ATTRIBUTES_QTY_PRICE_QTY', 'STK');
define('TABLE_ATTRIBUTES_QTY_PRICE_PRICE', 'PREIS');
define('TEXT_ATTRIBUTES_QTY_PRICES_ONETIME_HELP', 'Option f&uuml;r einmalige Geb&uuml;hren f&uuml;r Mengenrabatte');

// textarea attribute input fields
define('TEXT_MAXIMUM_CHARACTERS_ALLOWED',' maximale Buchstaben erlaubt');
define('TEXT_REMAINING','restliche');

// Shipping Estimator
define('CART_SHIPPING_OPTIONS', 'Voraussichtlicher Versand:');
define('CART_SHIPPING_OPTIONS_LOGIN', 'Bitte melden Sie sich <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '"><u>hier</u></a> an, um Ihre pers&ouml;nlichen Versandkosten anzuzeigen.');
define('CART_SHIPPING_METHOD_TEXT', 'Versandarten:');
//define('CART_SHIPPING_METHOD_RATES', 'S�tze:');
define('CART_SHIPPING_METHOD_RATES', '');
define('CART_SHIPPING_METHOD_TO', 'Versand an: ');
define('CART_SHIPPING_METHOD_TO_NOLOGIN', 'Versand an: <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '"><u>anmelden</u></a>');
define('CART_SHIPPING_METHOD_FREE_TEXT', 'kostenloser Versand');
define('CART_SHIPPING_METHOD_ALL_DOWNLOADS', '- Downloads');
define('CART_SHIPPING_METHOD_RECALCULATE', 'neu berechnen');
define('CART_SHIPPING_METHOD_ZIP_REQUIRED', 'true');
define('CART_SHIPPING_METHOD_ADDRESS', 'Adresse:');
define('CART_OT', 'Voraussichtliche Versandkosten:');
define('CART_OT_SHOW', 'true'); // set to false if you don't want order totals
define('CART_ITEMS', 'im Warenkorb: ');
define('CART_SELECT', 'w�hlen Sie');
define('ERROR_CART_UPDATE', 'Bitte aktualisieren Sie Ihre Bestellung ...<br />');
define('IMAGE_BUTTON_UPDATE_CART', 'aktualisieren');
define('EMPTY_CART_TEXT_NO_QUOTE', 'Oops! Ihre Sitzung wurde unterbrochen� Aktualisieren Sie bitte Ihren Warenkorb f&uuml;r die Versandart');

// multiple product add to cart
define('TEXT_PRODUCT_LISTING_MULTIPLE_ADD_TO_CART', 'Anzahl: ');
define('TEXT_PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART', 'Anzahl: ');
define('TEXT_PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART', 'Anzahl: ');
define('TEXT_PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART', 'Anzahl: ');   
//moved SUBMIT_BUTTON_ADD_PRODUCTS_TO_CART to button_names.php as BUTTON_ADD_PRODUCTS_TO_CART_ALT

// discount qty table
define('TEXT_HEADER_DISCOUNT_PRICES_PERCENTAGE', 'Abzug f&uuml;r Mengenrabatt');
define('TEXT_HEADER_DISCOUNT_PRICES_ACTUAL_PRICE', 'Preis abz&uuml;glich Mengenrabatt');
define('TEXT_HEADER_DISCOUNT_PRICES_AMOUNT_OFF', 'Abzug f&uuml;r Mengenrabatt');
define('TEXT_FOOTER_DISCOUNT_QUANTITIES', '* Rabatte k&ouml;nnen abh�ngig von den unteren Optionen variieren');
define('TEXT_HEADER_DISCOUNTS_OFF', 'Keine Rabatte m&ouml;glich ...');

// sort order titles for dropdowns
define('PULL_DOWN_ALL_RESET','- ZUR&Uuml;CKSTELLEN - ');
define('TEXT_INFO_SORT_BY_PRODUCTS_NAME', 'Artikelname');
define('TEXT_INFO_SORT_BY_PRODUCTS_NAME_DESC', 'Artikelname - absteigend');
define('TEXT_INFO_SORT_BY_PRODUCTS_PRICE', 'Preis - aufsteigend');
define('TEXT_INFO_SORT_BY_PRODUCTS_PRICE_DESC', 'Preis - absteigend');
define('TEXT_INFO_SORT_BY_PRODUCTS_MODEL', 'Artikelnummer');
define('TEXT_INFO_SORT_BY_PRODUCTS_DATE_DESC', 'Erstelldatum - aufsteigend');
define('TEXT_INFO_SORT_BY_PRODUCTS_DATE', 'Erstelldatum - absteigend');
define('TEXT_INFO_SORT_BY_PRODUCTS_SORT_ORDER', 'Standardansicht');

// downloads module defines
define('TABLE_HEADING_DOWNLOAD_DATE', 'g&uuml;ltig bis');
define('TABLE_HEADING_DOWNLOAD_COUNT', 'verbleibend');
define('HEADING_DOWNLOAD', 'Um Ihre Dateien herunterzuladen, klicken Sie bitte auf den Download Button und w�hlen Sie "Ziel speichern unter".');
define('TABLE_HEADING_DOWNLOAD_FILENAME','Dateiname');
define('TABLE_HEADING_PRODUCT_NAME','Artikel');
define('TABLE_HEADING_BYTE_SIZE','Dateigr&ouml;&szlig;e');
define('TEXT_DOWNLOADS_UNLIMITED', 'Unbegrenzt');
define('TEXT_DOWNLOADS_UNLIMITED_COUNT', '--- *** ---');

// misc
define('COLON_SPACER', ':&nbsp;&nbsp;');

// table headings for cart display and upcoming products
define('TABLE_HEADING_QUANTITY', 'St&uuml;ck');
define('TABLE_HEADING_PRODUCTS', 'Artikelname');
define('TABLE_HEADING_TOTAL', 'Summe');

// create account - login shared
define('TABLE_HEADING_PRIVACY_CONDITIONS', 'Datenschutz');
define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', 'Bitte best�tigen Sie Ihr Einverst�ndniss mit unseren Datenschutzbestimmungen, indem Sie die Checkbox aktivieren. Die Datenschutzbestimmungen k&ouml;nnen Sie <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><span class="pseudolink">hier</span></a> nachesen.');
define('TEXT_PRIVACY_CONDITIONS_CONFIRM', 'Ich habe die Datenschutzbestimmungen gelesen und akzeptiert.');
define('TABLE_HEADING_ADDRESS_DETAILS', 'Ihre Adresse');
define('TABLE_HEADING_PHONE_FAX_DETAILS', 'Ihre Kontaktinformationen');
define('TABLE_HEADING_DATE_OF_BIRTH', 'Bitte geben Sie Ihr Geburtsdatum an');
define('TABLE_HEADING_LOGIN_DETAILS', 'Sichern Sie Ihre Informationen mit einem Passwort');
define('TABLE_HEADING_REFERRAL_DETAILS', 'Wie wurden Sie auf unseren Shop aufmerksam?');
define('ENTRY_EMAIL_PREFERENCE','Gew�nschtes E-mail Format');
define('ENTRY_EMAIL_HTML_DISPLAY','HTML');
define('ENTRY_EMAIL_TEXT_DISPLAY','nur TEXT');
define('EMAIL_SEND_FAILED','Fehler: E-Mail wurde nicht an: "%s" <%s> versendet. Betreff: "%s"');

define('DB_ERROR_NOT_CONNECTED', 'Fehler: Es konnte keine Verbindung mit der Datenbank hergestellt werden');

// EZ-PAGES Alerts
define('TEXT_EZPAGES_STATUS_HEADER_ADMIN', 'WARNING: EZ-PAGES HEADER - Darf nur vom Admin ge&ouml;ffnet werden ');
define('TEXT_EZPAGES_STATUS_FOOTER_ADMIN', 'WARNING: EZ-PAGES FOOTER - Darf nur vom Admin ge&ouml;ffnet werden ');
define('TEXT_EZPAGES_STATUS_SIDEBOX_ADMIN', 'WARNING: EZ-PAGES SIDEBOX - Darf nur vom Admin ge&ouml;ffnet werden ');

// extra product listing sorter
define('TEXT_PRODUCTS_LISTING_ALPHA_SORTER', '');
define('TEXT_PRODUCTS_LISTING_ALPHA_SORTER_NAMES', 'Artikelname beginnt mit ...');
define('TEXT_PRODUCTS_LISTING_ALPHA_SORTER_NAMES_RESET', '-- Zur&uuml;ckstellen --');

///////////////////////////////////////////////////////////
// include email extras
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_EMAIL_EXTRAS)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_EMAIL_EXTRAS);

// include template specific header defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_HEADER)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_HEADER);

// include template specific button name defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_BUTTON_NAMES)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_BUTTON_NAMES);

// include template specific icon name defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_ICON_NAMES)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_ICON_NAMES);

// include template specific other image name defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_OTHER_IMAGES_NAMES)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_OTHER_IMAGES_NAMES);

// credit cards
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_CREDIT_CARDS)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select. FILENAME_CREDIT_CARDS);

// include template specific whos_online sidebox defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_WHOS_ONLINE . '.php')) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_WHOS_ONLINE . '.php');

// include template specific meta tags defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/meta_tags.php')) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'meta_tags.php');

// END OF EXTERNAL LANGUAGE LINKS
?>