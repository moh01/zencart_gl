<?php
//include static defines
  include_once(dirname(__FILE__).'/defines_static.php');

// *****************************
// * Database section
// *****************************

/*
if ( $_SERVER['SERVER_NAME'] == 'www.justprojectorlamps.com' )
{
  define('DB_SERVER', 'mysql5-12');
  define('DB_SERVER_USERNAME', 'easylamp_en');
  define('DB_SERVER_PASSWORD', 'abidjan');
  define('DB_DATABASE', 'easylamp_en');

}
else if ( $_SERVER['SERVER_NAME'] == '127.0.0.1' )
{
  define('DB_SERVER', 'localhost');
  define('DB_SERVER_USERNAME', 'root');
  define('DB_SERVER_PASSWORD', '');
  define('DB_DATABASE', 'zencart_eu');
}
else
{
  define('DB_SERVER', 'mysql5-11');
  define('DB_SERVER_USERNAME', 'easylamp_dev');
  define('DB_SERVER_PASSWORD', 'gilles');
  define('DB_DATABASE', 'easylamp_dev');
}
*/
include_once('../includes/configure.php');

		
//where the mysql server resides

// this defines the url root ( used in create_test ) 
define('URL_ROOT', '');
//  define('URL_ROOT', 'http://127.0.0.1/sphinx/');

//type of database.
//access = microsoft access
//ado = generic ado
//ado_access = access using ado
//vfp = visual foxpro
//ibase = interbase
//mssql = microsoft sql
//mysql = mysql
//mysqlt =  mysql with transaction support
//oci8 = oracle 8
//odbc = generic odbc
//oracle = oracle 7 or 8
//postgres = postgreSQL (experimental)
//sybase = sybase (experimental)
  define('DB_TYPE', 'mysql');

  //ADODB_CACHE_DIR needs to be set to a path that exists,
  // the web server has read/write access to, and
  // should not be viewable to others
  if (file_exists('/tmp/session')) {
      $ADODB_CACHE_DIR='/tmp/session';
  } elseif(file_exists('/windows/temp')) {
      $ADODB_CACHE_DIR='/windows/temp';
  } elseif(file_exists('/temp')) {
      $ADODB_CACHE_DIR='/temp';
  };
  
  
// *****************************
// * Form behavior section
// *****************************

//whether to highlight active fields in forms.
  define('FIELD_HIGHLIGHT', '1');

//the colors to highlight with for FIELD_HIGHLIGHT.  You _WANT_ offcolor to be the same as the normal textbox background color.
  define('FIELD_HIGHLIGHT_ON_COLOR', '#FFFF99');
  define('FIELD_HIGHLIGHT_OFF_COLOR', '#FFFFFF');

//whether enter key tabs to next field or submits form.
  define('FIELD_TAB', '1');

//whether text boxes have their contents selected when the field is highlighted.
  define('FIELD_AUTO_SELECT', '1');



// *****************************
// * Login section
// *****************************

//whether to allow internal users to login to this site
  define('ALLOW_LOGIN_INTERNAL', '1');

//whether to allow external customers to login to this site
  define('ALLOW_LOGIN_CUSTOMER', '1');

//whether to allow external vendors to login to this site
  define('ALLOW_LOGIN_VENDOR', '1');

//whether logins are case-sensitive.  Default 0, is case-sensitive
  define('LOGIN_CASE_INSENSITIVE', '0');

?>
