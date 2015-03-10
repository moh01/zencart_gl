<?php
//shouldn't need to edit anything after this, only edit includes/defines.php
  require_once('defines.php');
  require_once('adodb.inc.php');
  require_once('functions.php');
  ADOLoadCode(DB_TYPE);
  $conn = &ADONewConnection();
  $conn->PConnect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE);
   global $userid;
  //  require_once('includes/header.php');
  //  require_once('includes/ups/upsrate.php');
?>
