<?php
/**
 *
 * @version $Id: sqlpatch.php, v 1.3.7 2007/04/26 11:48:12 $;
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

define( 'HEADING_TITLE', 'Wykonywanie zapyta� SQL' );
define( 'HEADING_WARNING', 'ZR�B KOPI� BAZY DANYCH ZANIM URUCHOMISZ TUTAJ ZAPYTANIE' );
define( 'HEADING_WARNING2', 'UWAGA Uruchamiasz ten skrypt na w�asn� odpowiedzialno��!<br />ZenCart.pl nie daje gwarancji i ponosi odpowiedzialno�ci za prawid�owe funkcjonowanie zapyta� SQL!' );

define( 'TEXT_QUERY_RESULTS', 'Wynik zapytania:' );
define( 'TEXT_ENTER_QUERY_STRING', 'Wpisz zapytanie<br />do wykonania:&nbsp;&nbsp;<br /><br />Upewnij si�, �e polecenie<br />jest zako�czone �rednikiem ;' );
define( 'HEADING_WARNING_INSTALLSCRIPTS', 'UWAGA: Skrypt ZenCart.pl do aktualizacji bazy danych NIE powinien by� uruchamiany na tej stronie.<br />Wgraj nowy katalog <strong>zc_install</strong> i uruchom w tym katalogu skrypt aktualizacji bazy danych.' );

define( 'TEXT_QUERY_FILENAME', 'Wgraj plik: ' );

define( 'SQLPATCH_HELP_TEXT1', 'Ten modu� SQL pozwala na to, �eby zainstalowa� poprawk� systemu uruchamiaj�c j� tutaj poprzez wklejenie kodu SQL bezpo�rednio w pole tekstowe, lub przez wgranie pliku SQL.' );
define( 'SQLPATCH_HELP_TEXT2', 'Kiedy przygotowujesz skrypt do uruchomienia tutaj nie u�ywaj w zapytaniach prefiksu dla tabel, poniewa� to narzedzie automatycznie wstawia prefiks, zgodnie z ustawieniami sklepu w pliku konfiguracyjnym admin/includes/configure.php (definicja DB_PREFIX).' );
define( 'SQLPATCH_HELP_TEXT3', 'Wpisywane komendy mog� by� wpisywane lub wgrywane tylko w podanych formatach i musz� by� pisane z du�ych liter:<br /><ul><li>DROP TABLE IF EXISTS</li><li>CREATE TABLE</li><li>INSERT INTO</li><li>INSERT IGNORE INTO</li><li>ALTER TABLE</li><li>UPDATE (pojedyncza tabela)</li><li>UPDATE IGNORE (pojedyncza tabela)</li><li>DELETE FROM</li><li>DROP INDEX</li><li>CREATE INDEX</li><li>SELECT</li></ul>' );
define( 'SQLPATCH_HELP_TEXT4', '<h2>Metody zaawansowane</h2><br />Podane poni�ej metody s�u�� do powi�zania wielu wierszy kodu w jedno zapytanie:<br />Aby uruchomi� kilka blok�w kodu jako jedno polecenie, musisz wpisa� "<code>#NEXT_X_ROWS_AS_ONE_COMMAND:xxx</code>".<br />Parser potraktuje xxx komend jako jedno zapytanie.<br />Je�li wykonasz takie polecenie w phpMyAdmin lub podobnym, linia "#NEXT..." zostanie zignorowana i polecenie zostanie wykonane prawid�owo.<br /><br /><strong>UWAGA: </strong>SELECT.... FROM... i LEFT JOIN wymagaj�, aby "FROM" lub "LEFT JOIN" by�y w jednym wierszu.<br /><br /><em><strong>Przyk�ady:</strong></em><ul><li><code>#NEXT_X_ROWS_AS_ONE_COMMAND:4<br />SET @t1=0;<br />SELECT (@t1:=configuration_value) as t1 <br />FROM configuration<br />WHERE configuration_key = \'KEY_NAME_HERE\';<br />UPDATE product_type_layout SET configuration_value = @t1 WHERE configuration_key = \'KEY_NAME_TO_CHECK_HERE\';<br /> DELETE FROM configuration WHERE configuration_key = \'KEY_NAME_HERE\';<br />&nbsp;</li><li>#NEXT_X_ROWS_AS_ONE_COMMAND:1<br />INSERT INTO tablename<br />(col1, col2, col3, col4)<br />SELECT col_a, col_b, col_3, col_4<br />FROM table2;<br />&nbsp;</li><li>#NEXT_X_ROWS_AS_ONE_COMMAND:1<br />INSERT INTO table1<br />(col1, col2, col3, col4 )<br />SELECT p.othercol_a, p.othercol_b, po.othercol_c, pm.othercol_d<br />FROM table2 p, table3 pm<br />LEFT JOIN othercol_f po<br />ON p.othercol_f = po.othercol_f<br />WHERE p.othercol_f = pm.othercol_f;</li></ul></code>' );
define( 'TEXT_CLOSE_WINDOW', '[ zamknij ]' );

define( 'ERROR_NOTHING_TO_DO', 'B��d: Brak zapytania lub pliku' );
define( 'REASON_TABLE_ALREADY_EXISTS', 'Nie mo�na utworzy� tabeli <strong>%s</strong> poniewa� taka ju� istnieje' );
define( 'REASON_TABLE_DOESNT_EXIST', 'Nie mo�na usun�� tabeli <strong>%s</strong> poniewa� taka nie istnieje.' );
define( 'REASON_TABLE_NOT_FOUND', 'Nie mo�na odnale�� tabeli <strong>%s</strong>.' );
define( 'REASON_CONFIG_KEY_ALREADY_EXISTS', 'Nie mo�na wstawi� klucza configuration_key "<strong>%s</strong>" poniewa� taki ju� istnieje.' );
define( 'REASON_COLUMN_ALREADY_EXISTS', 'Nie mo�na doda� kolumny <strong>%s</strong> poniewa� taka ju� istnieje.' );
define( 'REASON_COLUMN_DOESNT_EXIST_TO_DROP', 'Nie mo�na usun�� kolumny <strong>%s</strong> poniewa� taka nie istnieje.' );
define( 'REASON_COLUMN_DOESNT_EXIST_TO_CHANGE', 'Nie mo�na zmieni� kolumny <strong>%s</strong> poniewa� taka nie istnieje.' );
define( 'REASON_PRODUCT_TYPE_LAYOUT_KEY_ALREADY_EXISTS', 'Nie mo�na wstawi� klucza dla rodzaju produkt�w configuration_key "<strong>%s</strong>" poniewa� taki ju� istnieje' );
define( 'REASON_INDEX_DOESNT_EXIST_TO_DROP', 'Nie mo�na usun�� z tabeli <strong>%s</strong> indeksu <strong>%s</strong> poniewa� taki nie istnieje.' );
define( 'REASON_PRIMARY_KEY_DOESNT_EXIST_TO_DROP','Nie mo�na usun�� klucza podtawowego tabeli <strong>%s</strong> poniewa� taki nie istnieje.' );
define( 'REASON_INDEX_ALREADY_EXISTS', 'Nie mo�na doda� indeksu <strong>%s</strong> do tabeli <strong>%s</strong> poniewa� taki ju� istnieje.' );
define( 'REASON_PRIMARY_KEY_ALREADY_EXISTS', 'Nie mo�na doda� klucza podstawowego dla tabeli <strong>%s</strong> poniewa� klucz podstawowoy ju� istnieje dla tej tabeli.' );
define( 'REASON_NO_PRIVILEGES', 'U�ytkownik '.DB_SERVER_USERNAME.'@'.DB_SERVER.' nie posiada uprawnie� %s do tabeli '.DB_DATABASE. '.' );

?>