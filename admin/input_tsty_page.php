<?php

//echo "kkkkkkkkkkkkkkkkkkkkkkkkkkk";
  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
  
  
	 $bds = array("eu","fr","es","de","en","it","bf");
	 $cnt = 0;
 
/*
   $meta_title = "META TITLE ";

   $sous_titre1 =   " GRAND TITRE ";
   
   $sous_titre1 =   " PETIT TITRE 1 ";
   $texte1 =   " bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla ";
   $page_url = "test-test-test";
   $target_database = "fr";

   */   
 
  $target_database = $_POST['target_database']; 
  
//$target_database="fr";
  
  $page_url = $_POST['page_url'];
  
  
  $meta_title = $_POST['meta_title'];
  $meta_desc = $_POST['meta_desc'];

  
//  $sous_titre1 =   $_POST['sous_titre1'];
  
  $sous_titre1 = $_POST['sous_titre1'];
  $texte1 = $_POST['texte1'];
 //echo  $texte1;exit;
  $sous_titre2 = $_POST['sous_titre2'];
  $texte2 = $_POST['texte2'];
  
  $titre = $_POST['titre'];
  
  $titre = $titre;
  // --------------- OTHER VALUES      -----------------------
  $constructeur = $_POST['constructeur'];
 
  $type_lampe = $_POST['type_lampe'];
  $date_parution = $_POST['date_parution'];
  $produit_hote = $_POST['produit_hote'];
  $tsty_nom = $_POST['tsty_nom'];
  $tsty_ville = $_POST['tsty_ville'];
  $tsty_region = $_POST['tsty_region'];
  $tsty_sexe = $_POST['tsty_sexe'];
  
  $tsty_date = $_POST['tsty_date'];
  $tsty_note = $_POST['tsty_note'];

  $activite = $_POST['activite'];
  $date_livraison = $_POST['date_livraison'];
  
  $refprod = $produit_hote;  
  $lamp_code = $produit_hote;

//echo   'meta_title'.$sous_titre2 .'|'.$texte2.'|<br>';exit;
//echo $tsty_note.'MMMM'.$target_database.'/////'.$sous_titre2.'|||'.$ext_db_database[$target_database].'|||||';exit;  			

//$db->Execute("insert into lampe_pl.debug values('kkkk".$_POST['target_database']."')");
  
   $db->connect($ext_db_server[$target_database], $ext_db_username[$target_database], $ext_db_password[$target_database], $ext_db_database[$target_database], USE_PCONNECT, false);
   
//$db->Execute("insert into lampe_pl.debug values('llll".$_POST['target_database']."')");


			$dml = "delete from eb_articles 
				where id_page in ( select id from  `eb_pages` 
				where  urlrewrited='" . $page_url ."')";

//echo $dml;
				 
			if ($db->Execute($dml) === false)
		    {
			   die ('error '.$dml);
		    }
   

			$dml = "
				delete from  `eb_pages` 
				where  urlrewrited='" . $page_url ."'";

//echo $dml;
				 
			if ($db->Execute($dml) === false)
		    {
			   die ('error '.$dml);
		    }

			$dml = "
				INSERT INTO `eb_pages` 
				( `label`, `urlrewrited`,`urlreal`,
				  typepage, constructeur,refprod,
				  date_parution) VALUES
				( '". $page_url ."','". $page_url ."', '". $page_url ."',
				  'testimony',	'". $constructeur ."', '". $refprod ."',
					now() )";

//echo $dml;exit;
				 
			if ($db->Execute($dml) === false)
		    {
			   die ('error '.$dml);
		    }
            $id_page = mysql_insert_id();
			
			
			$dml = "
				update `eb_pages` 
				set idordered = ". $id_page . "				
				where id =  ". $id_page;

	
			if ($db->Execute($dml) === false)
		    {
			   die ('error '.$dml);
		    }
			// AJOUT DE L'ARTICLE META_TITLE  --------------------------------------------------------
			if ( strlen($meta_title)>0 )
			{
				$dml = "
					INSERT INTO `eb_articles` 
					( `id_page`, `type` ) 
					VALUES
					(  " . $id_page .  ", 'Meta_Title' )";
//	echo $dml .'<br>';

				if ($db->Execute($dml) === false)
				{
				   die ('error '.$dml);
				}
				$id_article = mysql_insert_id() ;

				//			echo "<br>".$dml."<br>";

				$dml = "  INSERT INTO `eb_texts` 
							( `id_article`, `format`,
							 `ordre`, `fr_text`, `en_text`,
							  `sp_text`, `it_text`, `de_text`, 
							  `dt_maj`) VALUES
							( '".$id_article ."' , 'Titre',
							 1, '".addslashes($meta_title) ."', '". addslashes($meta_title) ."',
							 '". addslashes($meta_title) ."', '". addslashes($meta_title) ."', 
							 '".addslashes($meta_title )."', now() )";
							 
//	echo "<br>".$dml."<br>";
				   if ($db->Execute($dml) === false)
				   {
					   die ('error '.$dml);
				   }
			}
			// AJOUT DE L'ARTICLE meta_desc  --------------------------------------------------------
			if ( strlen($meta_desc)>0 )
			{
//echo 'MERDUM'.$meta_desc;exit;			
			
				$dml = "
					INSERT INTO `eb_articles` 
					( `id_page`, `type` ) 
					VALUES
					(  " . $id_page .  ", 'Meta_Desc' )";
//	echo $dml .'<br>';

				if ($db->Execute($dml) === false)
				{
				   die ('error '.$dml);
				}
				$id_article = mysql_insert_id() ;

				//			echo "<br>".$dml."<br>";

				$dml = "  INSERT INTO `eb_texts` 
							( `id_article`, `format`,
							 `ordre`, `fr_text`, `en_text`,
							  `sp_text`, `it_text`, `de_text`, 
							  `dt_maj`) VALUES
							( '".$id_article ."' , 'Titre',
							 1, '".addslashes($meta_desc) ."', '". addslashes($meta_desc) ."',
							 '". addslashes($meta_desc) ."', '". addslashes($meta_desc) ."', 
							 '".addslashes($meta_desc )."', now() )";
							 
//	echo "<br>".$dml."<br>";
				   if ($db->Execute($dml) === false)
				   {
					   die ('error '.$dml);
				   }
			}
			
			// AJOUT DE L ARTICLE  MAITRE-------------------------------------------------------- 			
			$dml = "
				INSERT INTO `eb_articles` 
				( `id_page`, `type` , 
					url,	tsty_nom,	tsty_ville,
					tsty_region,	tsty_sexe,	tsty_date,
					tsty_note, date_parution, typeprod,
					constructeur, produit_hote )				
				VALUES
				(  " . $id_page .  ", 'Testimony' , 
					'".$page_url."',	'".$tsty_nom."',	'".$tsty_ville."',
					'".$tsty_region."',	'".$tsty_sexe."',	'".$tsty_date."',
					'".$tsty_note."' ,	'".$date_parution."','". $type_lampe . "',
					'".$constructeur."', '".$produit_hote."' )";
					
//echo $dml .'<br>';exit;

			if ($db->Execute($dml) === false)
			{
			   die ('error '.$dml);
			}
			$id_article = mysql_insert_id() ;
			
			// cas de RQDL 
			if ( $target_database == "rq" )
			{
				$dml = "update eb_articles 
						set activite = '".$activite."', tsty_date_livraison ='".$date_livraison."'
						where id = ".$id_article;
						
				if ($db->Execute($dml) === false)
				{
				   die ('error '.$dml);
				}						
			}
			// AJOUT DES CONTENUS --------------------------------------------------------			
			if ( strlen($titre)>0 )
			{
				//			echo "<br>".$dml."<br>";

				$dml = "  INSERT INTO `eb_texts` 
							( `id_article`, `format`,
							 `ordre`, `fr_text`, `en_text`,
							  `sp_text`, `it_text`, `de_text`, `pl_text`, 
							  `dt_maj`) VALUES
							( '".$id_article ."' , 'Titre',
							 1, '".addslashes($titre) ."', '". addslashes($titre) ."',
							 '". addslashes($titre) ."', '". addslashes($titre) ."', '". addslashes($titre) ."', 
							 '".addslashes($titre)."', now() )";
							 
				   if ($db->Execute($dml) === false)
				   {
					   die ('error '.$dml);
				   }
			}			
			
			// AJOUT DES CONTENUS --------------------------------------------------------	
			if ( strlen($sous_titre1)>0 )
			{
				//			echo "<br>".$dml."<br>";

				$dml = "  INSERT INTO `eb_texts` 
							( `id_article`, `format`,
							 `ordre`, `fr_text`, `en_text`,
							  `sp_text`, `it_text`, `de_text`,  `pl_text`, 
							  `dt_maj`) VALUES
							( '".$id_article ."' , 'Sous-titre',
							 10, '".addslashes($sous_titre1) ."', '". addslashes($sous_titre1) ."',
							 '". addslashes($sous_titre1) ."', '". addslashes($sous_titre1) ."', '". addslashes($sous_titre1) ."', 
							 '".addslashes($sous_titre1)."', now() )";
							 
				   if ($db->Execute($dml) === false)
				   {
					   die ('error '.$dml);
				   }
			}			
			if ( strlen($texte1)>0 )
			{
				//			echo "<br>".$dml."<br>";

				$dml = "  INSERT INTO `eb_texts` 
							( `id_article`, `format`,
							 `ordre`, `fr_text`, `en_text`,
							  `sp_text`, `it_text`, `de_text`,  `pl_text`, 
							  `dt_maj`) VALUES
							( '".$id_article ."' , 'Paragraphe',
							 15, '".addslashes($texte1) ."', '". addslashes($texte1) ."',
							 '". addslashes($texte1) ."', '". addslashes($texte1) ."','". addslashes($texte1) ."', 
							 '".addslashes($texte1)."', now() )";
							 
				   if ($db->Execute($dml) === false)
				   {
					   die ('error '.$dml);
				   }
//echo $dml;
				   
			}			
			
			if ( strlen($sous_titre2)>0 )
			{
				//			echo "<br>".$dml."<br>";

				$dml = "  INSERT INTO `eb_texts` 
							( `id_article`, `format`,
							 `ordre`, `fr_text`, `en_text`,
							  `sp_text`, `it_text`, `de_text`,  `pl_text`, 
							  `dt_maj`) VALUES
							( '".$id_article ."' , 'Sous-titre',
							 20, '".addslashes($sous_titre2) ."', '". addslashes($sous_titre2) ."',
							 '". addslashes($sous_titre2) ."', '". addslashes($sous_titre2) ."',  '". addslashes($sous_titre2) ."', 
							 '".addslashes($sous_titre2)."', now() )";
							 
				   if ($db->Execute($dml) === false)
				   {
					   die ('error '.$dml);
				   }
			}
			if ( strlen($texte2)>0 )
			{
				//			echo "<br>".$dml."<br>";

				$dml = "  INSERT INTO `eb_texts` 
							( `id_article`, `format`,
							 `ordre`, `fr_text`, `en_text`,
							  `sp_text`, `it_text`, `de_text`, `pl_text`, 
							  `dt_maj`) VALUES
							( '".$id_article ."' , 'Paragraphe',
							 25, '".addslashes($texte2) ."', '". addslashes($texte2) ."',
							 '". addslashes($texte2) ."', '". addslashes($texte2) ."',  '". addslashes($texte2) ."', 
							 '".addslashes($texte2)."', now() )";
							 
				   if ($db->Execute($dml) === false)
				   {
					   die ('error '.$dml);
				   }
			}			
			echo '1';
  
?>