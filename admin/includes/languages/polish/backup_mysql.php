<?php
/**
 *
 * @version $Id: backup_mysql.php, v 1.3.7 2007/04/26 11:48:12 $;
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

// define the locations of the mysql utilities.  Typical location is in '/usr/bin/' ... but not on Windows servers.
// try 'c:/mysql/bin/mysql.exe' and 'c:/mysql/bin/mysqldump.exe' on Windows hosts ... change drive letter and path as needed
define( 'LOCAL_EXE_MYSQL',     '/usr/bin/mysql' );  // used for restores
define( 'LOCAL_EXE_MYSQLDUMP', '/usr/bin/mysqldump' );  // used for backups

// the following are the language definitions
define( 'HEADING_TITLE', 'Manager kopii bazy danych - MySQL' );
define( 'WARNING_NOT_SECURE_FOR_DOWNLOADS', '<span class="errorText">UWAGA: Nie w³±czono SSL. Wszystkie pobrania z tej strony nie bêd± zakodowane. Utworzenie kopii i przywracanie bazy bêd± dzia³a³y prawid³owo, ale pobieranie/wgrywanie plików z/na serwer mog± byæ ryzykowne.' );
define( 'TABLE_HEADING_TITLE', 'Tytu³' );
define( 'TABLE_HEADING_FILE_DATE', 'Data' );
define( 'TABLE_HEADING_FILE_SIZE', 'Rozmiar' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );

define( 'TEXT_INFO_HEADING_NEW_BACKUP', 'Nowa kopia bazy' );
define( 'TEXT_INFO_HEADING_RESTORE_LOCAL', 'Przywróæ lokalnie' );
define( 'TEXT_INFO_NEW_BACKUP', 'Nie przerywaj procesu tworzenia kopii, który mo¿e chwilê zaj±æ.' );
define( 'TEXT_INFO_UNPACK', '<br /><br />(po rozpakowaniu pliku)' );
define( 'TEXT_INFO_RESTORE', 'Nie przerywaj procesu przywracania bazy.<br /><br />Du¿e pliki mog± siê d³ugo wczytywaæ!<br /><br />Jesli to mozliwe u¿yj klienta mysql.<br /><br />Np:<br /><br /><strong>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </strong> %s' );
define( 'TEXT_INFO_RESTORE_LOCAL', 'Nie przerywaj procesu przywracania bazy.<br /><br />Du¿e pliki mog± siê d³ugo wczytywaæ!' );
define( 'TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Wgrywany plik musi mieæ rozszerzenie .sql (plik tekstowy).' );
define( 'TEXT_INFO_DATE', 'Data:' );
define( 'TEXT_INFO_SIZE', 'Rozmiar:' );
define( 'TEXT_INFO_COMPRESSION', 'Kompresja:' );
define( 'TEXT_INFO_USE_GZIP', 'GZIP' );
define( 'TEXT_INFO_USE_ZIP', 'ZIP' );
define( 'TEXT_INFO_SKIP_LOCKS', 'Pomiñ opcje "zablokowany" (zaznacz je¶li otrzymujesz b³±d braku dostêpu LOCK TABLES)' );
define( 'TEXT_INFO_USE_NO_COMPRESSION', 'Brak kompresji (czysty SQL)' );
define( 'TEXT_INFO_DOWNLOAD_ONLY', 'Pobierz bez wgrywania na serwer' );
define( 'TEXT_INFO_BEST_THROUGH_HTTPS', '(Bezpieczniej z po³±czeniem HTTPS)' );
define( 'TEXT_DELETE_INTRO', 'Czy na pewno usun±æ tê kopiê bazy danych?' );
define( 'TEXT_NO_EXTENSION', 'Brak' );
define( 'TEXT_BACKUP_DIRECTORY', 'Katalog kopii:' );
define( 'TEXT_LAST_RESTORATION', 'Ostatnie przywracanie:' );
define( 'TEXT_FORGET', '(pamiêtaj)' );

define( 'ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'B³±d: Katalog kopii nie istnieje. Ustaw go w pliku configure.php.' );
define( 'ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'B³±d: Katalog kopii nie ma praw zapisu.' );
define( 'ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'B³±d: B³êdny adres pobierania.' );
define( 'ERROR_CANT_BACKUP_IN_SAFE_MODE', 'B£¡D: Ten skrypt dzia³a dla w³±czonego safe_mode lub open_basedir.<br />Je¶li otrzymujesz b³±d tworz±c kopiê, zaznacz kiedy plik jest mniejszy ni¿ 200kb.' );
define( 'ERROR_EXEC_DISABLED', 'B£¡D: Polecenie "exec()" zosta³o wy³±czone na Twoim serwerze. Skrypt nie mo¿e dzia³aæ.' );
define( 'ERROR_FILE_NOT_REMOVEABLE', 'B³±d: Nie mo¿na usun±æ wybranego pliku. Mo¿esz u¿yæ klienta FTP, aby to zrobiæ.' );

define( 'SUCCESS_LAST_RESTORE_CLEARED', 'Pomy¶lnie usuniêto datê przywracania.' );
define( 'SUCCESS_DATABASE_SAVED', 'Pomy¶lnie zapisano bazê danych.' );
define( 'SUCCESS_DATABASE_RESTORED', 'Pomy¶lnie przywrócono bazê danych.' );
define( 'SUCCESS_BACKUP_DELETED', 'Pomy¶lnie usuniêto kopiê bazy danych.' );
define( 'FAILURE_DATABASE_NOT_SAVED', 'B³±d: Baza danych NIE zosta³a zapisana.' );
define( 'FAILURE_DATABASE_NOT_SAVED_UTIL_NOT_FOUND', 'B£¡D: Nie mo¿na zlokalizowaæ MYSQLDUMP. PROCES PRZERWANY.' );
define( 'FAILURE_DATABASE_NOT_RESTORED', 'B³±d: Baza danych NIE mo¿e byæ przywrócona.' );
define( 'FAILURE_DATABASE_NOT_RESTORED_FILE_NOT_FOUND', 'B³±d: Baza NIE zosta³a przywrócona. B£¡D: NIE ZNALEZIONO PLIKU: %s' );
define( 'FAILURE_DATABASE_NOT_RESTORED_UTIL_NOT_FOUND', 'B£¡D: Nie mo¿na zlokalizowaæ MYSQL. PRZYWRACANIE PRZERWANE.' );
define( 'FAILURE_BACKUP_FAILED_CHECK_PERMISSIONS', 'Tworzenie kopii zakoñczone niepowodzeniem, poniewa¿ napotkano b³±d podczas uruchamiania (mysqldump lub mysqldump.exe).<br />Je¶li masz serwer Windows 2003, mog³e¶ nie ustawiæ odpowiednich praw dostêpu dla cmd.exe..' );

// Set this to 'true' if the zip options aren't appearing while doing a backup, and you are certain that gzip support exists on your server
define( 'COMPRESS_OVERRIDE', 'false' );

?>