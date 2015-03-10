<?php
require_once("phprtflite/rtf/Rtf.php");
require_once("ezl_rtfData.php");
require_once("ezl_rtfUtil.php");
require_once("../ezl_utile.php");

define('LARGEUR_IMPRIMABLE', 18);
define('IND_ZONES','zones');
define('IND_LARGEUR_COLONNES','largeur colonnes');
define('IND_HAUTEUR_LIGNES','hauteur lignes');

class ezl_rtfRapport extends Rtf {
	const largeurUtile = LARGEUR_IMPRIMABLE; // 18 cms: largeur utile pour un A4
	var $nomFichierParametres;
	var $section;
	var $contenu;
	var $formats = NULL;

    function __construct(&$contenu, $nomFichierParametres) {
        parent::__construct();
		$this->nomFichierParametres = $nomFichierParametres;
		$this->preparerObjetsInternes();
		$this->chargerParametresFormatage();
		$this->preparerFeuille();
		$this->contenu = $contenu;
		$this->section = $this->addSection();
		$this->ajouterLesTables();
    }

	/**
	 * Définit des objets de service
	 */
  	function preparerObjetsInternes() {
	}

	/**
	 * Ajoure à la section donnée un paragraphe vide pour l'espacement
	 */
  	function chargerParametresFormatage() {
		$this->formats = Spyc::YAMLLoad($this->nomFichierParametres);
		/*$yaml = Spyc::YAMLDump($formats, 2);
		file_put_contents(NOM_FICHIER_FORMAT_PAGE, $yaml);*/
	}

	/**
	 * Ajoure à la section donnée un paragraphe vide pour l'espacement
	 */
  	function preparerFeuille() {
		global $paramsFeuille;
		$this->setPaperWidth($paramsFeuille['largeurFeuille']);
		$this->setPaperHeight($paramsFeuille['hauteurFeuille']);
		$this->setMargins($paramsFeuille['margeGauche'], $paramsFeuille['margeHaut'], $paramsFeuille['margeDroite'], $paramsFeuille['margeBas']);
	}

	/**
	 * Ajoure à la section donnée un paragraphe vide pour l'espacement
	 */
  	function insererUnParagrapheEspace(&$sect) {
		$fontSmall = new Font(3);
		$parBlack = new ParFormat();
		$parBlack->setSpaceBefore(0.1);
		$sect->emptyParagraph($fontSmall, $parBlack);
	}

	/**
	 * Ajoute un table et son contenu
	 */
  	function ajouterUneTable($section, $formats) {
		// Création de la table
		$nouvelleTable =& $section->addTable();

		// Lignes
		$nbTotalLignes = 0;
		foreach ($formats[IND_HAUTEUR_LIGNES] as $hauteur) {
			if (ezl_utile::chaine_finitPar($hauteur, '*')) {
//				printf('Chaine de hauteur de ligne (%s) se termine par *.<br//>', $hauteur);
				$nbLignesArticles = $this->contenu->getNbArticles();
				// Il s'agit de la hauteur des lignes d'articles, à répéter donc
				for ($i = 0 ; $i < $nbLignesArticles; $i++) {
					$nouvelleTable->addRow(floatval($hauteur));
					$nbTotalLignes++;
				}	
			}
			else {
				$nouvelleTable->addRow($hauteur);
				$nbTotalLignes++;
			}	
		}
	
		// Colonnes		
		$nbTotalColonnes = count($formats[IND_LARGEUR_COLONNES]);
		foreach ($formats[IND_LARGEUR_COLONNES] as $largeur) {  
			$nouvelleTable->addColumn($largeur);
		}
		// Formats et remplissage
		foreach ($formats[IND_ZONES] as $nomZone => $defZone) {
			$zone = new ezl_rtfFormatZoneTable($defZone);
			$zone->actualiserVariables(array(IND_NB_LIGNES, IND_NB_COLONNES), array($nbTotalLignes, $nbTotalColonnes));
			$zone->definirSurTable($nouvelleTable, $this->contenu);
		}
	}

	/**
	 * Ajoute la section de tout le haut de la feuille
	 */
  	function ajouterLesTables() {
		$premiereTable = true;
		foreach ($this->formats as $nomTable => $formatsTable) {
			if ( ! $premiereTable) {
				$this->insererUnParagrapheEspace($this->section);
			}	
			$this->ajouterUneTable($this->section, $formatsTable);
			$premiereTable = false;
		}
//		$this->tableSectionHaut->mergeCells(1, 1, 2, 1);
	}
}

?>