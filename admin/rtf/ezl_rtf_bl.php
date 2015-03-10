<?php

//error_reporting(E_ERROR | E_PARSE);
//error_reporting(0);
//display_errors "0";
//echo 1;exit;
ini_set('display_errors', 0); 

require_once("../ezl_utile.php");
require_once("../ezl_localisation.php");

// On affecte le code ici pour écraser la valeur fournie par ezl_localisation.php
$lg_code = CODE_LANGUE_FRANCAIS;

if (array_key_exists('choixDuSite', $_POST)) {
	$changementSite = $_POST['choixDuSite'];
	switch ($changementSite) {
		case 'fr':
			$lg_code = CODE_LANGUE_FRANCAIS;
			break;
		case 'en':
			$lg_code = CODE_LANGUE_ANGLAIS;
			break;
	}
}

$lg_code = $_GET['lg_code'];
$langue = new ezl_langue($lg_code);

require_once("../includes/configure.php");
require_once("../lampes/main.php");
$source_db = $_GET['source_db'];
if (strlen($source_db)>0 )
{
  $conn->PConnect($ext_db_server[$source_db], $ext_db_username[$source_db], $ext_db_password[$source_db], $ext_db_database[$source_db], USE_PCONNECT, false);   
//echo  $source_db;exit;
}

require_once("ezl_rtfRapport_bonLivraison.php");

$numCommande = $_GET['numCommandes'];

    foreach ((array)$_GET['prdList'] as $k => $v ) {
        echo($v).'<br>';
    }

if ($numCommande)
{
	$rtf = new ezl_rtfRapport_bonLivraison($langue, $numCommande);
	$rtf->sendRtf('BL_'.$numCommande);
}

?>