<?php

  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
  if ($_GET['lamp_code']=="init_all")
  {
		init_stock_virtuel();
  }  
echo '
<html>
<head>
<link rel="stylesheet" href="le.css" type="text/css">
</head>
<body>';

  echo  get_stock_virtuel($_GET['lamp_code']);

  echo   "</body>
          </html>";
?>
