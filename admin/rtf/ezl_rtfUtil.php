<?php
require_once("phprtflite/rtf/Font.php");
require_once("phprtflite/rtf/Util.php");

define('SEPARATEUR_RETOUR_CHARIOT', "\r\n");
define('SEPARATEUR_TABULATION', "\t");

define('COULEUR_BLANC', '#FFFFFF');
define('COULEUR_NOIR', '#000000');
define('COULEUR_FOND_GRISE', '#D2D2D2');
define('COULEUR_BORDURE_GRISE', '#555555');

define('IND_POSITION','position');
define('IND_NB_LIGNES','nombre lignes');
define('IND_NB_COLONNES','nombre colonnes');
define('IND_LIGNE_DEBUT','ligne début');
define('IND_COLONNE_DEBUT','colonne début');
define('IND_LIGNE_FIN','ligne fin');
define('IND_COLONNE_FIN','colonne fin');

define('IND_ESPACE_AVANT','espace avant');
define('IND_ESPACE_APRES','espace après');
define('IND_INDENT_GAUCHE','indentation gauche');
define('IND_INDENT_DROITE','indentation droite');

define('IND_TAILLE','taille');
define('IND_NOM','nom');
define('IND_COULEUR','couleur');
define('IND_COULEUR_FOND','couleur fond');
define('IND_ALIGNEMENT','alignement');
define('IND_ALIGNEMENT_VERTICAL','alignement vertical');

define('IND_CHEMIN_DONNEES','chemin donnees');
define('IND_POLICE','police');
define('IND_BORDURE','bordure');
define('IND_PARAGRAPHE','paragraphe');

define('IND_EXCLURE','exclure');
define('IND_GAUCHE','gauche');
define('IND_HAUT','haut');
define('IND_DROITE','droite');
define('IND_BAS','bas');


$ezl_null = NULL;

class ezl_rtfPolice extends Font {
    function __construct($params = NULL) {
		$taille = 12;
		$nom = 'Arial';
		$couleur = '';
		$couleurFond = '';
		if (isset($params) && is_array($params)) {
			if (array_key_exists(IND_TAILLE, $params)) {
				$taille = $params[IND_TAILLE];
			}
			if (array_key_exists(IND_NOM, $params)) {
				$nom = $params[IND_NOM];
			}
			if (array_key_exists(IND_COULEUR, $params)) {
				$couleur = $params[IND_COULEUR];
			}
			if (array_key_exists(IND_COULEUR_FOND, $params)) {
				$couleurFond = $params[IND_COULEUR_FOND];
			}
			$this->setParams($params);
		}
	    parent::__construct($taille, $nom, $couleur, $couleurFond);
	}

    function setParams($params) {
		foreach ($params as $id => $valeur) {
			switch ($id) {
				case IND_TAILLE :
				case IND_NOM :
				case IND_COULEUR :
				case IND_INDENT_DROITE :
					// Sont pris en charge dans le constructeur seulement
					break;
				default:
					trigger_error(sprintf("(%s) n''est pas un paramètre de police reconnu.", $id), E_USER_ERROR);	
			}
		}
	}
}

class ezl_rtfParagraphe extends ParFormat{
    function __construct($params = NULL) {
		$alignement = (isset($params) && is_array($params) && array_key_exists(IND_ALIGNEMENT, $params)) ? $params[IND_ALIGNEMENT] : 'left';
        parent::__construct($alignement);
		if (isset($params) && is_array($params)) {
			$this->setParams($params);
		}
	}

    function setParams($params) {
		foreach ($params as $id => $valeur) {
			switch ($id) {
				case IND_ESPACE_AVANT :
					$this->setSpaceBefore($valeur);
					break;
				case IND_ESPACE_APRES :
					$this->setSpaceAfter($valeur);
					break;
				case IND_INDENT_GAUCHE :
					$this->setIndentLeft($valeur);
					break;
				case IND_INDENT_DROITE :
					$this->setIndentRight($valeur);
					break;
				case IND_ALIGNEMENT :
					// Sont pris en charge dans le constructeur seulement
					break;
				default:
					trigger_error(sprintf("(%s) n''est pas un paramètre de paragraphe reconnu.", $id), E_USER_ERROR);	
			}
		}
	}
}

class ezl_rtfBordure extends BorderFormat{
	var $gauche, $haut, $droite, $bas;
    function __construct($params = NULL) {
		$this->gauche = true;
		$this->haut = true;
		$this->droite = true;
		$this->bas = true;	
		$taille = 1;
		$couleur = COULEUR_NOIR;
		if (isset($params) && is_array($params)) {
			if (array_key_exists(IND_TAILLE, $params)) {
				$taille = $params[IND_TAILLE];
			}
			if (array_key_exists(IND_COULEUR, $params)) {
				$couleur = $params[IND_COULEUR];
			}
			$this->setParams($params);
		}
	    parent::__construct($taille, $couleur);
	}
	
	function setParams($params) {
		foreach ($params as $id => $valeur) {
			switch ($id) {
				case IND_TAILLE :
				case IND_COULEUR :
					// Sont pris en charge dans le constructeur seulement
					break;
				case IND_EXCLURE :
					$this->gauche = ! in_array(IND_GAUCHE, $valeur);
					$this->haut = ! in_array(IND_HAUT, $valeur);
					$this->droite = ! in_array(IND_DROITE, $valeur);
					$this->bas = ! in_array(IND_BAS, $valeur);
					break;
				default:
					trigger_error(sprintf("(%s) n''est pas un paramètre de bordure reconnu.", $id), E_USER_ERROR);	
			}
		}
	}
}

class ezl_rtfZoneTable {
	var $ligneDebut, $colonneDebut, $nbLignes, $nbColonnes;
    function __construct($ligneDebut = 1, $colonneDebut = 1, $nbLignes = 1, $nbColonnes = 1) {
		$this->ligneDebut = $ligneDebut;
		$this->colonneDebut = $colonneDebut; 
		$this->nbLignes = $nbLignes;
		$this->nbColonnes = $nbColonnes;
	}

    function getLigneDebut() {
		return $this->ligneDebut;
	}

    function getColonneDebut() {
		return $this->colonneDebut;
	}

    function setLigneDebut($valeur) {
		$this->ligneDebut = $valeur;
	}

    function setColonneDebut($valeur) {
		$this->colonneDebut = $valeur;
	}

    function getNbLignes() {
		return $this->nbLignes;
	}

    function getNbColonnes() {
		return $this->nbColonnes;
	}

    function setNbLignes($valeur) {
		$this->nbLignes = $valeur;
	}

    function setNbColonnes($valeur) {
		$this->nbColonnes = $valeur;
	}

    function getLigneFin() {
		return $this->ligneDebut + $this->nbLignes - 1;
	}

    function getColonneFin() {
		return $this->colonneDebut + $this->nbColonnes - 1;
	}

    function setLigneFin($valeur) {
		$this->nbLignes = $valeur - $this->ligneDebut + 1;
	}

    function setColonneFin($valeur) {
		$this->nbColonnes = $valeur - $this->colonneDebut + 1;
	}

    function setParamsPosition($params) {
		foreach ($params as $id => $valeur) {
			switch ($id) {
				case IND_NB_LIGNES :
					$this->setNbLignes($valeur);
					break;
				case IND_NB_COLONNES :
					$this->setNbColonnes($valeur);
					break;
				case IND_LIGNE_DEBUT :
					$this->setLigneDebut($valeur);
					break;
				case IND_COLONNE_DEBUT :
					$this->setColonneDebut($valeur); 
					break;
				case IND_LIGNE_FIN :
					$this->setLigneFin($valeur);
					break;
				case IND_COLONNE_FIN :
					$this->setColonneFin($valeur);
					break;
				default:
					trigger_error(sprintf("(%s) n''est pas un paramètre de position reconnu.", $id), E_USER_ERROR);	
			}
		}	
	}

    function actualiserVariables($nomsVariables, $valeursVariables) {
		foreach($this as $nomPropriete => &$valeurPropriete) {
			if (is_string($valeurPropriete)) {
				$variablesRemplacees = str_replace($nomsVariables, $valeursVariables, $valeurPropriete);
				$expressionCalculPHP = sprintf('return %s;', $variablesRemplacees);
				$valeurCalculee = intval(eval($expressionCalculPHP));
				$valeurPropriete = $valeurCalculee;
			}
		}
	}
}

class ezl_rtfFormatZoneTable extends ezl_rtfZoneTable{
	var $formats;
    function __construct($formats = NULL) {
		parent::__construct();
		if (isset($formats)) {
			if (!is_array($formats)) {
				trigger_error('Tableau attendu', E_USER_ERROR);	
			}	
			if (array_key_exists(IND_POSITION, $formats)) {
				$this->setParamsPosition($formats[IND_POSITION]);
			}		
			$this->formats = $formats;
		}
		else
			$this->formats = array();
	}

  	function definirSurTable($table, $donnees) {
		foreach ($this->formats as $nomFormat => $valeurFormat) {
			switch ($nomFormat) {
				case IND_BORDURE:
					$bordure = new ezl_rtfBordure($valeurFormat);
					$table->setBordersOfCells($bordure, $this->ligneDebut, $this->colonneDebut, $this->getLigneFin(), $this->getColonneFin(), $bordure->gauche, $bordure->haut, $bordure->droite, $bordure->bas);
					break;
				case IND_COULEUR_FOND: 
					$table->setBackGroundOfCells($valeurFormat, $this->ligneDebut, $this->colonneDebut, $this->getLigneFin(), $this->getColonneFin());
					break;
/*					$table->setDefaultAlignmentOfCells($valeurFormat, $this->ligneDebut, $this->colonneDebut, $this->getLigneFin(), $this->getColonneFin());
					break;*/
				case IND_ALIGNEMENT_VERTICAL:
					$table->setVerticalAlignmentOfCells($valeurFormat, $this->ligneDebut, $this->colonneDebut, $this->getLigneFin(), $this->getColonneFin());
					break;
				case IND_POSITION:
				case IND_POLICE:
				case IND_PARAGRAPHE:
				case IND_ALIGNEMENT:
					break;
/*				case IND_POLICE:
//					trigger_error(sprintf("Classe de format : (%s), taille (%d), nomFormat (%s), (%s)", get_class($format), $format->size, $format->font, $format->fontColor), E_USER_ERROR);
					// Attention, si on met $format directement dans l'appel à setDefaultFontOfCells, ça plante
					$police = new ezl_rtfPolice($format);
					$table->setDefaultFontOfCells($police, $this->ligneDebut, $this->colonneDebut, $this->getLigneFin(), $this->getColonneFin());
					break;
*/					

				case IND_CHEMIN_DONNEES:
					$paramsPolice = array_key_exists(IND_POLICE, $this->formats) ? $this->formats[IND_POLICE] : NULL;
					$police = new ezl_rtfPolice($paramsPolice);
					$paramsFormatParagraphe = array_key_exists(IND_PARAGRAPHE, $this->formats) ? $this->formats[IND_PARAGRAPHE] : NULL;
					$formatParagraphe = new ezl_rtfParagraphe($paramsFormatParagraphe);
					$this->remplir($table, $donnees, $valeurFormat, $police, $formatParagraphe);
					break;
				default:
					trigger_error(sprintf("(%s) n''est pas un nom de format reconnu.",$nomFormat), E_USER_ERROR);	
			}
		}			
	}

  	function remplir($table, $donnees, $xpaths, $police, $formatParagraphe) {
		$valeursZone = $donnees->getValeur($xpaths, $this->getNbLignes(), $this->getNbColonnes());
/*		echo '<br/>';
		var_dump($valeursZone);
*/		
		for ($iLigne = $this->getLigneDebut(); $iLigne <= $this->getLigneFin(); $iLigne++) {
			for ($iColonne = $this->getColonneDebut(); $iColonne <= $this->getColonneFin(); $iColonne++) {
				$table->writeToCell($iLigne, $iColonne, $valeursZone[$iLigne - $this->getLigneDebut()][$iColonne - $this->getColonneDebut()], $police, $formatParagraphe);
			}
		}
	}
}

?>