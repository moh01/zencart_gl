<?php
require_once("ezl_rtfRapport.php");
require_once("../spyc/spyc.php");

error_reporting(E_ALL);

define('REPERTOIRE_SORTIE', 'reports');
define('NOM_FICHIER_SORTIE', REPERTOIRE_SORTIE . '/' . 'bl.rtf');
define('NOM_FICHIER_FORMAT_PAGE', 'ezl_rtfFormatBonLivraison.yml');

class ezl_rtfRapport_bonLivraison extends ezl_rtfRapport {
    function __construct($langue, $numCommande) {
		global $donneesBonLivraison;
		$data = new ezl_rtfData($langue, $numCommande);
		$data->charger();
        parent::__construct($data, NOM_FICHIER_FORMAT_PAGE);
		$this->setDefaultTabWidth(2); // 2 centimètres entre les tabulations, pour l'instant c'est un compromis. Il faudrait régler ça par section ou paragraphe
		$this->prepare();
		$this->save(NOM_FICHIER_SORTIE);
    }
}

//$colWidth = ($sectionCoordonneesSociete->getLayoutWidth() - 5) / 2;

//$rtf = new ezl_rtfReport_bonLivraison();
//$rtf->sendRtf();



?>