<?php
require_once("../includes/configure.php");
require_once("../lampes/main.php");
require_once("../ezl_utile.php");


define('AROBASE', '@');
define('NOM_FICHIER_XML_BASE_DONNEES_RAPPORT', 'ezl_rtfBaseDonneesRapport');
define('NOM_FICHIER_XML_CONTENU_COMMANDE', 'ezl_rtfDonneesCommande.xml');

$paramsFeuille = array(
	'largeurFeuille' => 21.0,
	'hauteurFeuille' => 29.7,
	'margeGauche' => 1.5,
	'margeHaut' => 1.5,
	'margeDroite' => 1.5,
	'margeBas' => 1.5);

/*
3. créer le premier rapport bon de livraison en rtf  à partir des impressions que hélène t'a imprimé 
ce rapport revevra en argument 
- la langue dans laquelle le rapport doit être imprimé  (2 francais, 3 espagnol).
- le numéro de commande 
la données pour le BL sont dans les tables suivantes
orders pour ce qui est des coordonnées du client ( prendre delivery address )
dans orders_item on trouve 
  products_model - code produit 
  products_name  - description du produit (auourd'hui elle n'est pas bonne mais demain elle le sera.
  products_quantity - la quantité du produit
*/  

class ezl_rtfData {
	var $langue;
	var $xml;
	var $numeroCommande;

    function __construct($langue, $numeroCommande) {
		$this->langue = $langue;
		$this->numeroCommande = $numeroCommande;
		$this->xml = new SimpleXMLElement(NOM_FICHIER_XML_BASE_DONNEES_RAPPORT.'_'.$langue.'.xml', NULL, true);
    }
	
	/**
	 * Définit des objets de service
	 */
  	function preparer() {
	}

	/**
	 * Retourne le nombre de lignes d'article
	 */
  	function getNbArticles() {
		$resultat = count($this->xml->commandes->commande->produit);

//		printf('Nombre d\'articles: (%d)<br/>', $resultat);
		return $resultat;
	}

	/**
	 * Définit toutes les valeurs dynamiques
	 */
  	function charger() {
		$this->chargerDB();
		$this->xml->document['date'] = date('d/m/y');
	}
	
	/**
	 * Charge les données de DB
	 */
  	function chargerDB() {
		global $conn;
/*		
		$sql = "select max(packing_sheet_id) from order_packing_sheet where orders_id = ". $this->numeroCommande;
		$packing_sheet_id = exec_select($sql);
		if ( !$packing_sheet_id )
		{

			$sql = "select max(packing_sheet_id)+1 from order_packing_sheet";
			$packing_sheet_id = exec_select($sql);	


			
			$dml = " insert into order_packing_sheet (orders_id, packing_sheet_id) 
				      values ( " . $this->numeroCommande . "," .  $packing_sheet_id  . " )";
				  
			$conn->Execute($dml);
		}	
*/
    $this->xml->document['numero'] = $packing_sheet_id;

		$sql = "select orders_invoices_id from orders_invoices where invoice_type='BL' and orders_id = ". $this->numeroCommande;
		$bl_id = exec_select($sql);

		
      $this->xml->document['numero'] = $bl_id;

		$sql = "select orders_invoices_id from orders_invoices where invoice_type='DB' and orders_id = ". $this->numeroCommande;
		$orders_id = exec_select($sql);

		$sql = "select concat(day(invoice_date),'-',month(invoice_date),'-',year(invoice_date))  from orders_invoices where invoice_type='DB' and orders_id = ". $this->numeroCommande;
		$orders_date = exec_select($sql);

      $this->xml->document['numero_facture'] = $orders_id;
      $this->xml->document['numero_facture2'] = "INVOICE:".$orders_id;
	  
      $this->xml->document['date_facture'] = $orders_date;
      
      
      
		$commande = $this->xml->commandes->addChild('commande');
		$commande->addAttribute('numero', $this->numeroCommande);
		$sqlCommande = sprintf(
		 'select
		 	delivery_name, 
			delivery_company, 
			delivery_street_address, 
			delivery_suburb, 
			delivery_city, 
			delivery_postcode, 
			delivery_state, 
			delivery_country,
		 	billing_name, 
			billing_company, 
			billing_street_address, 
			billing_suburb, 
			billing_city, 
			billing_postcode, 
			billing_state, 
			billing_country,
			date_purchased,
			customers_id, 
			ref_info
			from 
				orders
			where 
				orders_id = %d', $this->numeroCommande);
		// 			DATE_FORMAT(date_purchased,'%e/%c/%Y') date_purchased

		$recordSet = &$conn->Execute($sqlCommande);
		$client = $this->xml->client[0];
		$client['numero'] = $recordSet->fields['customers_id'];
		if (!$recordSet->EOF) {
			$client->livraison->entreprise = utf8_encode(removeaccents($recordSet->fields['delivery_company']));		
			$client->livraison->nom = utf8_encode(removeaccents($recordSet->fields['delivery_name']));
			
			$client->livraison->adresse->rue = utf8_encode(removeaccents($recordSet->fields['delivery_street_address']));
			$client->livraison->adresse->codepostal = utf8_encode(removeaccents($recordSet->fields['delivery_postcode']));			
			$client->livraison->adresse->ville = utf8_encode(removeaccents($recordSet->fields['delivery_city']));
			$client->livraison->adresse->pays = utf8_encode(removeaccents($recordSet->fields['delivery_country']));
			
/*			

FV pour régler les PB de douane

			$client->livraison->nom2 = utf8_encode(removeaccents($recordSet->fields['billing_name']));			
			$client->livraison->adresse->rue2 = utf8_encode(removeaccents($recordSet->fields['billing_street_address']));
			$client->livraison->adresse->codepostal2 = utf8_encode(removeaccents($recordSet->fields['billing_postcode']));			
			$client->livraison->adresse->ville2 = utf8_encode(removeaccents($recordSet->fields['billing_city']));
			$client->livraison->adresse->pays2 = utf8_encode(removeaccents($recordSet->fields['billing_country']));
*/
			$client->livraison->nom2 = utf8_encode(removeaccents($recordSet->fields['delivery_name']));			
			$client->livraison->adresse->rue2 = utf8_encode(removeaccents($recordSet->fields['delivery_street_address']));
			$client->livraison->adresse->codepostal2 = utf8_encode(removeaccents($recordSet->fields['delivery_postcode']));			
			$client->livraison->adresse->ville2 = utf8_encode(removeaccents($recordSet->fields['delivery_city']));
			$client->livraison->adresse->pays2 = utf8_encode(removeaccents($recordSet->fields['delivery_country']));

//			$client->livraison->ref = $this->numeroCommande ;			
			$client->livraison->ref = utf8_encode(removeaccents($recordSet->fields['ref_info']));


		}

		$sqlArticles = sprintf(
		 'select
			op.products_model,
			op.products_name,
			op.products_quantity,
			op.final_price,
			op.reliquat
			from 
				orders as o,  
				orders_products as op
			where 
				o.orders_id = %d
                and   op.products_model not in (\'CODF\',\'SHF\',\'ECOF\')						
				and op.orders_id = %1$d
			order by
				op.sort_order, op.products_name', $this->numeroCommande);
		   
		$recordSet = &$conn->Execute($sqlArticles);      
		$nbTotalArticles = 0;
		$total_price = 0;
		
		while (!$recordSet->EOF)
		{
			$ligneProduit = $recordSet->fields['products_name'];
			$produit=$commande->addChild('produit');
			$produit->addAttribute('nom', removeaccents($recordSet->fields['products_name']));
			$produit->addAttribute('quantite_nom', $recordSet->fields['products_quantity'] .' x '. removeaccents($recordSet->fields['products_name']));			
			$produit->addAttribute('model', removeaccents($recordSet->fields['products_model']));
			$nbArticles = intval($recordSet->fields['products_quantity']);
			$produit->addAttribute('quantity', $nbArticles);
			$produit->addAttribute('final_price', round($nbArticles *  $recordSet->fields['final_price'],2));			
			//$produit->addAttribute('ref_info', removeaccents($recordSet->fields['ref_info']));
			$produit->addAttribute('reliquat', removeaccents($recordSet->fields['reliquat']));

			$total_price += $nbArticles * $recordSet->fields['final_price'];						
			$nbTotalArticles += $nbArticles;
			
			$recordSet->moveNext();
		}
		$commande->addAttribute('nbTotalArticles', $nbTotalArticles);
		$commande->addAttribute('total_price','Total EUR '. round($total_price,2) );

		file_put_contents(NOM_FICHIER_XML_CONTENU_COMMANDE, $this->xml->asXML()); 
	}

	/**
	 * Fournit une chaine à partir du contenu d'un élément
	 */
  	function simpleXMLelementAChaine($element) {
		// Le contenu texte éventuel de l'élément
		$resultat = array();
		if (0 != strlen(strval($element))) {
			$resultat[] = strval($element);
		}
		// La valeur texte de ses descendants directs
		foreach ($element->children() as $child) {
			if (0 != strlen(strval($child))) {
				$resultat[] = strval($child);
			}
		}
		return implode(SEPARATEUR_RETOUR_CHARIOT, $resultat);
	}

	/**
	 * Retourne le préfixe de concaténation se trouvant éventuellement devant le chemin XPath. 
	 * à savoir:
	 * +
	 */
  	static function pathEstPrefixe($path, &$prefixe, &$remplacement) {
		$scenarii = array(
			'+[\t\t]' => SEPARATEUR_TABULATION.SEPARATEUR_TABULATION,
			'+[\t]' => SEPARATEUR_TABULATION,
			'+' => ''
			);
		$resultat = false;
		$prefixe = NULL;
		$remplacement = '';
		foreach ($scenarii as $pre => $rep) {
			if (ezl_utile::chaine_commencePar($path, $pre)) {
				$resultat = true;
				$prefixe = $pre;
				$remplacement = $rep;
				break;
			}
		}	
		return $resultat;
	}

	/**
	 * Retire du début du path les éventuels préfixes de concaténation (voir ci dessus). 
	 */
  	static function pathSansPrefixe($path) {
		$resultat = $path;
		$prefixe = NULL;
		$remplacement = '';
		if (ezl_rtfData::pathEstPrefixe($path, $prefixe, $remplacement)) {
			$resultat = ezl_utile::chaine_suivant($resultat, $prefixe);
		}
		return $resultat;
	}

	/**
	 * Recherche la ou les valeurs correspondant au ou aux chemins xpaths fournis
	 */
  	function &getValeur($paths, $nbLignes, $nbColonnes) {
		// On prépare un tableau avec toutes les valeurs de la zone, initialisées à vide
		$resultat = array_fill(0, $nbLignes, array_fill(0, $nbColonnes, NULL));
/*
		foreach ($valeursZone as $iLigne => $valeursLigne) {
			$valeursZone[$iLigne] = array_fill($this->getColonneDebut(), $this->getNbColonnes(),'');
		}
*/
		if (! is_array($paths)) {
			$paths = array($paths);
		}
		$valeursRequeteXPath = array();
		$nbTotalValeurs = 0;
		foreach ($paths as $p) {
			// Si la chaiine contient un @, le path concerne un attribut au lieu d'un élément
			$valeurEstAttribut = (false !== strpos($p, AROBASE));
			if ($valeurEstAttribut) {
				$cheminElement = ezl_utile::chaine_precedent($p, '/'.AROBASE);
				$nomAttribut = ezl_utile::chaine_suivant($p, AROBASE);
				$elements = $this->xml->xpath(ezl_rtfData::pathSansPrefixe($cheminElement));
			}
			else {
				$elements = $this->xml->xpath(ezl_rtfData::pathSansPrefixe($p));
			}
/*			
			printf('Retour pour la requête %s:', $p); 			
			echo '<br/>';
			print_r($elements);
			echo '<br/>';
*/
			// La requête XPATH retourne un tableau d'éléments de type SimpleXMLElement
			// Pour chacun de ces éléments, on prend le ou les contenu chaine de l'élément supposé présent
			$valeursChaines = array();
			foreach ($elements as $element) {
				if ($valeurEstAttribut) {
					$valeursChaines[] = strval($element[$nomAttribut]);
				}
				else { // Si ce sont les sous-éléments qui sont recherchés, $element est alors un tableau
					$valeursChaines[] = ezl_rtfData::simpleXMLelementAChaine($element);
				}
			}
/*
			printf('Pour la requête (%s):', $p); 			
			echo '<br/>';
			print_r($valeursChaines);
			echo '<br/>';
*/			
			$valeursRequeteXPath[$p] = $valeursChaines;
			$nbTotalValeurs += count($valeursChaines);
		}

		// Répartition des valeurs
		// Cas: Le nombre de cellules est égal à 1: --> toutes les valeurs dans la même cellule
		if ((1 == $nbLignes) && (1 == $nbColonnes)) {
			$contenuCellule = '';
			$premierPath = true;
			foreach ($valeursRequeteXPath as $path => &$valeurs) {
				$valeurs = implode(SEPARATEUR_RETOUR_CHARIOT, $valeurs);
				if ($premierPath) {
					$premierPath = false;
				} else {
					if (ezl_rtfData::pathEstPrefixe($path, $prefixe, $remplacement)) {
						$contenuCellule .= $remplacement;
					} else {
						$contenuCellule .= SEPARATEUR_RETOUR_CHARIOT;
					}	
				}
				$contenuCellule .= $valeurs;
			}
			$resultat[0][0] = $contenuCellule;//implode(SEPARATEUR_RETOUR_CHARIOT, $valeursRequeteXPath);
		}
		// Cas: Le nombre total de valeurs fournies par tous les paths correspond au nombre de cellules: --> 1 valeur par cellule
		elseif ($nbTotalValeurs == ($nbLignes * $nbColonnes)) {
			$valeursPathCourant = reset($valeursRequeteXPath);
			$valeurCourante = reset($valeursPathCourant);
			for ($iColonne = 0 ; $iColonne < $nbColonnes ; $iColonne++) {
				for ($iLigne = 0 ; $iLigne < $nbLignes ; $iLigne++) {
					$resultat[$iLigne][$iColonne] = $valeurCourante;
					$valeurCourante = next($valeursPathCourant);
					if (false === $valeurCourante) {
						$valeursPathCourant = next($valeursRequeteXPath);
						if (false !== $valeursPathCourant) {
							$valeurCourante = reset($valeursPathCourant);
						}	
					}	
				}	
			}
		}
		else {
			trigger_error(sprintf('Le cas d\'une zone de dimensions (%d, %d), pour (%d) valeurs est non traité.',$nbLignes,$nbColonnes, $nbTotalValeurs), E_USER_ERROR);
		}
		return $resultat;
	}
}
?>