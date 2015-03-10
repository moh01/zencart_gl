<?php
  require('includes/application_top.php');
  require('el_fonctions_gestion.php');

echo '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Nouvelle pièce</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } ">';


  
  if (!isset($currencies)) {
	require(DIR_WS_CLASSES . 'currencies.php');
	$currencies = new currencies();
  }
  
echo '</body>	 
</html>';
?>	