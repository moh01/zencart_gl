<?php

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

$langue = new ezl_langue($lg_code);

require_once("../includes/configure.php");
require_once("../lampes/main.php");
require_once("ezl_rtfRapport_bonLivraison.php");

$enReprise = isset($_POST['genererRapport']);
if ($enReprise)
{
	$numCommande = $_POST['numCommandes'];
	$rtf = new ezl_rtfRapport_bonLivraison($langue, $numCommande);
	$rtf->sendRtf();
	exit();
}

afficherPage();
exit();

function chargerNumCommandes()
{
	global $conn;
	$sql = '
		select
			orders_id 
		from 
			orders
		order by
			orders_id';
	$resultat = array();
	$recordSet = &$conn->Execute($sql);      
	while (!$recordSet->EOF) {
		$resultat[] = $recordSet->fields['orders_id'];
        $recordSet->MoveNext();
	};
	return $resultat;
}

function afficherPage()
{
	global $langue;
	$html = '<html><head><title>Frontal RTF</title>';
	$html .= '<script type="text/javascript">';
	$html .= 'function relancer(event){document.forms[0].submit();}'; /*alert("hi");*/
    $html .= '</script>';
	$html .= '</head>';
	$html .= '<h1>Frontal RTF</h1>';
	$html .= '<form method="post">';
	$html .= '<select name="choixDuSite" onchange="relancer()">';
	foreach (array('fr', 'en') as $L) {
		$html .= sprintf('<option value="%s"%s>%1$s</option>', $L, ($langue == $L ? ' selected="selected"' : ''));
	}
	$html .= '</select>';
	$html .= '<br/>';
	$numCommandes = chargerNumCommandes();
	$html .= '<select name="numCommandes">';
	foreach ($numCommandes as $num) {
		$html .= sprintf('<option value="%s">%1$s</option>', $num);
	}
	$html .= '</select>';
	$html .= '<input type="submit" name="genererRapport" id="genererRapport" value="Générer rapport"/>';
	$html .= '</form>';
	$html .= '</body></html>';
	echo $html;
}


?>