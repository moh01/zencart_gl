<?php 
	include('main.php');
	require_once('../ezl_localisation.php');
	require_once('../ezl_utile.php');
	require_once('../includes/languages/ezl_'.$langue->toString('longue_anglais').'.php');
	define('ECRAN_MARQUES' , 1); // L'écran de la liste des marques
	define('ECRAN_VIDEOPROJECTEURS_UNE_MARQUE' , 2); // L'écran de la liste des videoprojecteurs d'une même marque
	define('ECRAN_LISTE_SOLUTIONS' , 3); // L'écran d'un seul modèle de vidéoprojecteur (solution)

function ezl_faireBaliseIMG($marque, $formatTitre)
{
	$source = sprintf('../img_cstr/%s.gif', $marque);
	$titre = sprintf($formatTitre, $marque);
	$resultat = sprintf('<img width=112 height=112 VSPACE=10 HSPACE=10 title="%s" alt="%1$s" src="%2$s">', $titre, $source);
	return $resultat;
}

	if (chaine_commencePar($var, REDIRECT_LIENS_LAMPES__PREFIXE_PAGE_CONSTRUCTEURS))
		$ecran = ECRAN_MARQUES;
	else if (chaine_commencePar($var, REDIRECT_LIENS_LAMPES__PREFIXE_PAGE_VIDEOPROJECTEURS))
		$ecran = ECRAN_VIDEOPROJECTEURS_UNE_MARQUE;
	else if (chaine_commencePar($var, REDIRECT_LIENS_LAMPES__PREFIXE_PAGE_LAMPES_POUR))
		$ecran = ECRAN_LISTE_SOLUTIONS;
	else
		exit('Erreur: Lien d\'écran inconnu.');

	$liensHautEcran = sprintf('<a href="../"><font size=3>%s</font></a>', ucfirst(REDIRECT_LIENS_LAMPES__ACCUEIL));
	$codeLangueDB = $lg_code;
// echo $codeLangueDB;exit;
	switch ($ecran)
	{
		case ECRAN_MARQUES:
		{
			$title = sprintf(REDIRECT_LIENS_LAMPES__FORMAT_ECRAN1_TITRE, GEN_NOM_DOMAINE);
			$description = sprintf(REDIRECT_LIENS_LAMPES__FORMAT_ECRAN1_DESCRIPTION, GEN_NOM_DOMAINE);
			$keywords = REDIRECT_LIENS_LAMPES__FORMAT_ECRAN1_KEYWORDS;
			$texteCentral = sprintf(REDIRECT_LIENS_LAMPES__FORMAT_ECRAN1_BLABLA, ucfirst(GEN_NOM_DOMAINE));
			break;
		}
		case ECRAN_VIDEOPROJECTEURS_UNE_MARQUE:
		{
			$liensHautEcran .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			$liensHautEcran .= '<a href="'.REDIRECT_LIENS_LAMPES__PREFIXE_PAGE_CONSTRUCTEURS.'.html"><font size=3>'.ucwords(REDIRECT_LIENS_LAMPES__PREFIXE_PAGE_CONSTRUCTEURS).'</font></a>';
			$cstr_name = chaine_suivant($var, REDIRECT_LIENS_LAMPES__PREFIXE_PAGE_VIDEOPROJECTEURS);
			$cstr_name = strtoupper(chaine_precedent($cstr_name, '.html'));
	
			$title = sprintf(REDIRECT_LIENS_LAMPES__FORMAT_ECRAN2_TITRE, $cstr_name, GEN_NOM_DOMAINE);
			$description = sprintf(REDIRECT_LIENS_LAMPES__FORMAT_ECRAN2_DESCRIPTION, $cstr_name, GEN_NOM_DOMAINE);
			$keywords = sprintf(REDIRECT_LIENS_LAMPES__FORMAT_ECRAN2_KEYWORDS, $cstr_name);
			$texteCentral = sprintf(REDIRECT_LIENS_LAMPES__FORMAT_ECRAN2_BLABLA, ucfirst(GEN_NOM_DOMAINE));
			
			$sql = 
				 'select cat.categories_id, 
					  catd.categories_name
					   from   categories as cat,  
							  categories_description as catd
					   where  cat.categories_id = catd.categories_id
					   and    cat.parent_id =0
					   and    catd.language_id = ' . $codeLangueDB  . '
					   and    catd.categories_name <> '. sqlprep($cstr_name). '
				   order by catd.categories_name';
			
			 $recordSet = &$conn->Execute($sql);      
			 $texteCentral .=  sprintf('<br><br>%s: ', REDIRECT_LIENS_LAMPES__CONSULTEZ_NOS_OFFRES_DE);
			 while (!$recordSet->EOF)
			 {
				$abrege = ezl_sansBlancs($recordSet->fields[1]);
				$link_name = REDIRECT_LIENS_LAMPES__PREFIXE_PAGE_VIDEOPROJECTEURS . strtolower($abrege) . '.html';
				$chaineAffichee = sprintf(REDIRECT_LIENS_LAMPES__FORMAT_LAMPES_ET_MARQUE, $abrege);
				$texteCentral .= sprintf('<a style="text-decoration:underline;" href="%s">%s</a>, &nbsp;', $link_name, $chaineAffichee);
				$recordSet->moveNext();
			 }
			
			$sql = "select catd.categories_id 
					from   categories as cat, categories_description as catd 
					where  cat.categories_id = catd.categories_id
					and    cat.parent_id = 0
					and     catd.categories_name = '" . $cstr_name  . "'
					order by catd.categories_name";
			
			$cstr_id =  exec_select ($sql);
			break;
		}
		case ECRAN_LISTE_SOLUTIONS:
		{
			$video_name = chaine_suivant($var, REDIRECT_LIENS_LAMPES__PREFIXE_PAGE_LAMPES_POUR);
			$video_name = strtoupper(chaine_precedent($video_name, '.html'));
			$sql = "select catd.categories_id 
					from   categories as cat, categories_description as catd 
					where  cat.categories_id = catd.categories_id
					and     catd.categories_name = '" . $video_name  . "'
					order by catd.categories_name";
			
			$vpr_id =  exec_select ($sql);
			$sql = "select catd.categories_name 
					from   categories as cat, categories_description as catd 
					where  cat.categories_id = ". $vpr_id . "
					and    cat.parent_id = catd.categories_id";
			
			$cstr_name =  exec_select ($sql);
			$title = sprintf(REDIRECT_LIENS_LAMPES__FORMAT_ECRAN3_TITRE, $cstr_name, $video_name);
			$liensHautEcran .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			$liensHautEcran .= sprintf('<a href="%s.html"><font size=3>%s</font></a>', REDIRECT_LIENS_LAMPES__PREFIXE_PAGE_CONSTRUCTEURS, ucfirst(REDIRECT_LIENS_LAMPES__PREFIXE_PAGE_CONSTRUCTEURS));
			$liensHautEcran .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			$liensHautEcran .= sprintf('<a href="%s.html"><font size=3>%s</font></a>', REDIRECT_LIENS_LAMPES__PREFIXE_PAGE_VIDEOPROJECTEURS.strtolower($cstr_name), sprintf(REDIRECT_LIENS_LAMPES__FORMAT_LAMPES_ET_MARQUE, $cstr_name));

			$texteCentral = sprintf(REDIRECT_LIENS_LAMPES__FORMAT_ECRAN3_BLABLA, $cstr_name, $video_name, ucfirst(GEN_NOM_DOMAINE));
			$texteCentral .= '<br>';
			$texteCentral .= ezl_faireBaliseIMG($cstr_name, REDIRECT_LIENS_LAMPES__FORMAT_LES_MEILLEURS_PRIX_POUR_LAMPES);
			break;
		}
	}
		
	echo '<head>
		<title>'. $title .'</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="keywords" content=" ' . $keywords . ' " />
		<meta name="description" content="' . $description . '" />';

	if ( $ecran != ECRAN_LISTE_SOLUTIONS ) 
		echo ' <meta name="robots" content="index, follow" /> ';

	echo '<meta http-equiv="imagetoolbar" content="no" />      
    <link rel="stylesheet" type="text/css" href="../includes/templates/classic/css/stylesheet.css" />
    <link rel="stylesheet" type="text/css" href="../includes/templates/classic/css/stylesheet_css_buttons.css" />
    <link rel="stylesheet" type="text/css" media="print" href="../includes/templates/classic/css/print_stylesheet.css" />    
    </head>
   <body>
   <table align=center>
   <tr>
   <td width=660 bgcolor="white">
   ' .  $liensHautEcran  .  '
   <hr>
   <p align=center>';
   echo $texteCentral;
   echo '</p>';

	switch ($ecran)
	{
		case ECRAN_MARQUES:
		{
			$html_output .= sprintf('<h4>%s</h4>', REDIRECT_LIENS_LAMPES__VEUILLEZ_SELECTIONNER_LA_MARQUE_DE_VOTRE_VIDEOPROJECTEUR);
			$sql = 
			 "select cat.categories_id, 
				  catd.categories_name
				   from   categories as cat,  
						  categories_description as catd
				   where  cat.categories_id = catd.categories_id
				   and    cat.parent_id =0
				   and    catd.language_id = " . $codeLangueDB  . "
			   order by catd.categories_name";
			
			$recordSet = &$conn->Execute($sql);      
			
			while (!$recordSet->EOF)
			{
				$marque = ezl_sansBlancs($recordSet->fields[1]);
				$link_name = REDIRECT_LIENS_LAMPES__PREFIXE_PAGE_VIDEOPROJECTEURS . strtolower($marque) . '.html';
				$baliseIMG = ezl_faireBaliseIMG($marque, REDIRECT_LIENS_LAMPES__FORMAT_LES_MEILLEURS_PRIX_POUR_LAMPES);
				$baliseA = sprintf('<a href="%s">%s</a>', $link_name, $baliseIMG);
				$html_output .= $baliseA;
				$recordSet->moveNext();
			}
			break;
		}
		case ECRAN_VIDEOPROJECTEURS_UNE_MARQUE:
		{
			$html_output .= sprintf('<h4>%s</h4>', REDIRECT_LIENS_LAMPES__VEUILLEZ_SELECTIONNER_LE_MODELE_DE_VOTRE_VIDEOPROJECTEUR);
			
			$sql = 
			 "select cat.categories_id, 
				  catd.categories_name
				   from   categories as cat,  
						  categories_description as catd
				   where  cat.categories_id = catd.categories_id
				   and    cat.parent_id = " . $cstr_id  . "
				   and    catd.language_id = " . $codeLangueDB  . "
			   order by catd.categories_name";
			
			
			$recordSet = &$conn->Execute($sql);
			
			//echo $sql;
			
			while (!$recordSet->EOF)
			{
				$video = $recordSet->fields[1];
				$ref_ctr = $recordSet->fields[2];
				$html_output .= sprintf('%s &nbsp; %s &nbsp;<a href="%s%s.html">%4$s</a><br>', ucfirst(GEN_MOT_VIDEOPROJECTEUR), $cstr_name, REDIRECT_LIENS_LAMPES__PREFIXE_PAGE_LAMPES_POUR, $video);
				$recordSet->moveNext();
			}
			break;
		}
		case ECRAN_LISTE_SOLUTIONS:
		{
			$sql = 
				 "select prd.products_id, 
							  prdd.products_description,                      
						  cat.parent_id,
						  prd.manufacturers_id
				   from   products as prd,  
						  products_description as prdd,
						  categories as cat
				   where  prd.products_id = prdd.products_id
				   and    prd.master_categories_id = " . $vpr_id  . "
				   and    prdd.language_id = " . $codeLangueDB  . "
				   and    cat.categories_id = " . $vpr_id  . "
			   order by prd.manufacturers_id";
			
			$recordSet = &$conn->Execute($sql);
			
			$html_output .= sprintf('<h4>%s %s %s</h4>', REDIRECT_LIENS_LAMPES__NOS_SOLUTIONS_DE_LAMPES_POUR_UN_VIDEOPROJECTEUR, $cstr_name, $video_name);
			
			$html_output .= '<table>';
			
			$cntr = 0;
			while (!$recordSet->EOF)
			{
				$cntr++;
				$video = $recordSet->fields[1];
				$ctr_id = $recordSet->fields[2];
				$manu_id = $recordSet->fields[3];
				//echo $ctr_id.'-----<BR>';
				if ( $cntr > 1 )
				{
				  $html_output .= '<TR>';
				  $html_output .= '<TD colspan=3>';
				}
				
				if ( $cntr > 1)
					$html_output .=  '<hr>';
				
				$html_output .= '</TD>';
				$html_output .= '</TR>';
				$html_output .= '<TR>';
				$html_output .= '<TD>';
				$html_output .= '&nbsp;&nbsp;-&nbsp;&nbsp;'.$video .'</TD>';
				$html_output .= '<TD>';
				$html_output .= '<TD><img src="../img_cstr/lampe.jpg"  title="' . $video . '" alt="' . $video . '"></TD>';
				$html_output .= '</TR>';
				$html_output .= '<TR>';
				$html_output .= '<TD colspan=2>';
				if ( ( $manu_id == 4 ) || ( $manu_id == 1 ) )
				{
					 $html_output .= REDIRECT_LIENS_LAMPES__UNE_LAMPE_ORIGINALE_EST_CERTIFIEE_ET_GARANTIE_ETC;         
				}
				if ( $manu_id == 2 )
				{
				   $html_output .= REDIRECT_LIENS_LAMPES__TOUTES_LES_LAMPES_COMPATIBLES_REPONDENT_ETC;
				}
				if ( $manu_id == 3 )
				{
				   $html_output .= sprintf(REDIRECT_LIENS_LAMPES__FORMAT_ECRAN3_LE_BULBE_DE_LA_LAMPE_ETC, $cstr_name, $video_name);
				}
				$html_output .=  '</TD>';
				$html_output .= '</TR>';
				$recordSet->moveNext();
			}
			$html_output .= '</table>';
			$html_output .= '<BR><BR><center>';
			$url = '../index.php?main_page=index&cPath='. $ctr_id .'_'. $vpr_id;
			$source = '../includes/templates/template_default/images/'.$langue.'/consulter_tarifs.gif';
			$html_output .= sprintf('<a href="%s"><img src="%s"></a>', $url, $source);
			$html_output .= '</center>';
			break;
		}
	}

   $html_output .= '</td></TR></table></body>';

   echo $html_output;
?>
