<?php

define('CODE_LANGUE_FRANCAIS', 2);
define('CODE_LANGUE_ESPAGNOL', 3);
define('CODE_LANGUE_ALLEMAND', 4);
define('CODE_LANGUE_ANGLAIS', 5);
define('CODE_LANGUE_ITALIEN', 6);
define('CODE_LANGUE_PORTUGAIS', 7);

$chaines_langues = array(
	CODE_LANGUE_FRANCAIS 	=>	array('courte' => 'fr', 'longue' => 'français',		'longue_anglais' => 'french'),
	CODE_LANGUE_ESPAGNOL 	=>	array('courte' => 'es', 'longue' => 'espagnol',		'longue_anglais' => 'spanish'),
	CODE_LANGUE_ALLEMAND 	=>	array('courte' => 'de', 'longue' => 'allemand',		'longue_anglais' => 'german'),
	CODE_LANGUE_ANGLAIS 	=>	array('courte' => 'en', 'longue' => 'anglais',		'longue_anglais' => 'english'),
	CODE_LANGUE_ITALIEN 	=> 	array('courte' => 'it', 'longue' => 'italien',		'longue_anglais' => 'italian'),
	CODE_LANGUE_PORTUGAIS 	=>	array('courte' => 'pg', 'longue' => 'portugais',	'longue_anglais' => 'portuguese')
);

function removeaccents($string){ 
      $string= strtr($string,  "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",
                               "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn"); 
      $string= str_replace('ß','ss',$string);
      return $string; 
} 


class ezl_langue
{
	var $lgCode = -1;

	// Initialise l'objet
	function __construct($lgCode)
	{
		$this->lgCode = $lgCode;
	}

	function __toString()
	{
		global $chaines_langues;
		return ($chaines_langues[$this->lgCode]['courte']);
	}

	function toString($type = 'courte')
	{
		global $chaines_langues;
		return ($chaines_langues[$this->lgCode][$type]);
	}
}	

class ezl_langueFrancais extends ezl_langue
{
	function __construct()
	{
		parent::__construct(CODE_LANGUE_FRANCAIS);	
	}
}

class ezl_langueAnglais extends ezl_langue
{
	function __construct()
	{
		parent::__construct(CODE_LANGUE_ANGLAIS);	
	}
}

function booleanToString($b, $traducteur = NULL)
{
	$chainePourVrai = (isset($traducteur) ? $traducteur->traduire('true', 'vrai') : 'true');
	$chainePourFaux = (isset($traducteur) ? $traducteur->traduire('false', 'faux') : 'false');
	return ($b? $chainePourVrai : $chainePourFaux);
}

function booleanTo01($b)
{
	return ($b? 1 : 0);
}

function enPHP4()
{
	return (-1 == version_compare(phpversion(), '5.0.0'));
}

function array_walk_recursive_maison($input, $nomFonction, $parametres = NULL)
{
	if (!is_array($input)) // Doit être un tableau
		trigger_error("Tableau attendu.", E_USER_ERROR);
	foreach ($input as $key => $value)
		if (is_array($value))
			array_walk_recursive_maison($value, $nomFonction, $parametres);
		else
			if (isset($parametres))
				call_user_func($nomFonction, $value, $key, $parametres);
			else	
				call_user_func($nomFonction, $value, $key);
}
function object_search_all(&$needle, &$haystack, $strict=false)
{
    $results = array();
    if (!is_array($haystack))
		trigger_error("Tableau attendu.", E_USER_ERROR);
    foreach($haystack as $k => $v)
	{
        if (($strict && $needle===$v) || (!$strict && $needle==$v))
		{
			$results[] = $k;
		}
    }
	return (count($results) == 0) ? false : $results;
}

function ezl_sansBlancs($chaine)
{
    $resultat = str_replace (' ', '', $chaine);
	return $resultat;
}

function ezl_chgBlancsEnEntite_nbsp($chaine)
{
    $resultat = str_replace (' ', '&nbsp;', $chaine);
	return $resultat;
}

class ezl_utile {
	/**
	 * indique si la chaine $chaine commence par la sous-chaine $prefixe
	 */
	public static function chaine_finitPar($chaine, $suffixe)
	{
		$posDerniereOccurence = strrpos($chaine, $suffixe);
		$resultat = (false !== $posDerniereOccurence) && ((strlen($chaine) - strlen($suffixe)) == $posDerniereOccurence);
		return $resultat;
	}

	/**
	 * Indique si la chaine finit par la sous-chaine $suffixe
	 */
	public static function chaine_commencePar($chaine, $prefixe)
	{
		$resultat = (0 === strpos($chaine, $prefixe));
		return $resultat;
	}

	/**
	 * Retourne la fin d'une chaine située après la sous-chaine $separateur
	 */
	public static function chaine_suivant($chaine, $separateur)
	{
		$resultat = false;
		$posSeparateur = strpos($chaine, $separateur);
		if ($posSeparateur !== false)
		{
			$posSuite = $posSeparateur + strlen($separateur);
			if ($posSuite < strlen($chaine))
				$resultat = substr($chaine, $posSuite);
		}
		return $resultat;
	}

	/**
	 * Retourne le début d'une chaine situé avant la sous-chaine $separateur
	 */
	public static function chaine_precedent($chaine, $separateur)
	{
		$resultat = false;
		$posSeparateur = strpos($chaine, $separateur);
		if ($posSeparateur !== false)
			$resultat = substr($chaine, 0, $posSeparateur);
		return $resultat;
	}

}

?>