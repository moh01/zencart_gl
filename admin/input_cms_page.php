<?php

  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
  
	 $bds = array("eu","fr","es","de","en","it","bf");
	 $cnt = 0;
 
/*
   $meta_title = "META TITLE ";

   $titre1 =   " GRAND TITRE ";
   
   $sous_titre1_1 =   " PETIT TITRE 1 ";
   $paragraphe_1 =   " bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla ";
   $page_url = "test-test-test";
   $target_database = "fr";

   */   
 
  $target_database = $_POST['target_database']; 
  $page_url = $_POST['page_url'];
  
  $meta_title = $_POST['meta_title'];
  $meta_description = $_POST['meta_description'];
  
  $titre1 =   $_POST['titre1'];
  
  $sous_titre1_1 = $_POST['sous_titre1_1'];
  $paragraphe_1 = $_POST['paragraphe_1'];
  
  $sous_titre1_2 = $_POST['sous_titre1_2'];
  $paragraphe_2 = $_POST['paragraphe_2'];
  
  $constructeur = $_POST['constructeur'];
  $refprod = $_POST['refprod'];
  
  $lamp_code = $_POST['lamp_code'];
  
  
   $db->connect($ext_db_server[$target_database], $ext_db_username[$target_database], $ext_db_password[$target_database], $ext_db_database[$target_database], USE_PCONNECT, false);
   
 

			$dml = "
				delete from  `eb_pages` 
				where constructeur = '". $constructeur . "'
				and  refprod = '". $refprod . "'
				and typepage='technote' ";

//echo $dml;exit;
				 
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
				  'technote',	'". $constructeur ."', '". $refprod ."',
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

//echo $dml .'<br>';
	
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
			// AJOUT DE L'ARTICLE META_DESCRIPTION  --------------------------------------------------------
			if ( strlen($meta_description)>0 )
			{
//echo 'MERDUM'.$meta_description;exit;			
			
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
							 1, '".addslashes($meta_description) ."', '". addslashes($meta_description) ."',
							 '". addslashes($meta_description) ."', '". addslashes($meta_description) ."', 
							 '".addslashes($meta_description )."', now() )";
							 
//	echo "<br>".$dml."<br>";
				   if ($db->Execute($dml) === false)
				   {
					   die ('error '.$dml);
				   }
			}
			
			// AJOUT DE L ARTICLE  MAITRE-------------------------------------------------------- 			
			$dml = "
				INSERT INTO `eb_articles` 
				( `id_page`, `type` ) 
				VALUES
				(  " . $id_page .  ", 'Autre' )";
//echo $dml .'<br>';

			if ($db->Execute($dml) === false)
			{
			   die ('error '.$dml);
			}
			$id_article = mysql_insert_id() ;

			
			// AJOUT DES CONTENUS --------------------------------------------------------			
			if ( strlen($titre1)>0 )
			{
				//			echo "<br>".$dml."<br>";

				$dml = "  INSERT INTO `eb_texts` 
							( `id_article`, `format`,
							 `ordre`, `fr_text`, `en_text`,
							  `sp_text`, `it_text`, `de_text`, 
							  `dt_maj`) VALUES
							( '".$id_article ."' , 'Titre',
							 1, '".addslashes($titre1) ."', '". addslashes($titre1) ."',
							 '". addslashes($titre1) ."', '". addslashes($titre1) ."', 
							 '".addslashes($titre1)."', now() )";
							 
//	echo "<br>".$dml."<br>";
				   if ($db->Execute($dml) === false)
				   {
					   die ('error '.$dml);
				   }
			}
			// AJOUT DES CONTENUS --------------------------------------------------------	
/*			
			if ( strlen($sous_titre1_1)>0 )
			{
				//			echo "<br>".$dml."<br>";

				$dml = "  INSERT INTO `eb_texts` 
							( `id_article`, `format`,
							 `ordre`, `fr_text`, `en_text`,
							  `sp_text`, `it_text`, `de_text`, 
							  `dt_maj`) VALUES
							( '".$id_article ."' , 'Titre',
							 1, '".addslashes($sous_titre1_1) ."', '". addslashes($sous_titre1_1) ."',
							 '". addslashes($sous_titre1_1) ."', '". addslashes($sous_titre1_1) ."', 
							 '".addslashes($sous_titre1_1)."', now() )";
							 
//	echo "<br>".$dml."<br>";
				   if ($db->Execute($dml) === false)
				   {
					   die ('error '.$dml);
				   }
			}			

			if ( strlen($titre1)>0 )
			{
				//			echo "<br>".$dml."<br>";

				$dml = "  INSERT INTO `eb_texts` 
							( `id_article`, `format`,
							 `ordre`, `fr_text`, `en_text`,
							  `sp_text`, `it_text`, `de_text`, 
							  `dt_maj`) VALUES
							( '".$id_article ."' , 'Sous-titre',
							 1, '".addslashes($titre1) ."', '". addslashes($titre1) ."',
							 '". addslashes($titre1) ."', '". addslashes($titre1) ."', 
							 '".addslashes($titre1)."', now() )";
							 
//	echo "<br>".$dml."<br>";
				   if ($db->Execute($dml) === false)
				   {
					   die ('error '.$dml);
				   }
			}
*/
			if ( strlen($paragraphe_1)>0 )
			{
				//			echo "<br>".$dml."<br>";

				$dml = "  INSERT INTO `eb_texts` 
							( `id_article`, `format`,
							 `ordre`, `fr_text`, `en_text`,
							  `sp_text`, `it_text`, `de_text`, 
							  `dt_maj`) VALUES
							( '".$id_article ."' , 'Paragraphe',
							 1, '".addslashes($paragraphe_1) ."', '". addslashes($paragraphe_1) ."',
							 '". addslashes($paragraphe_1) ."', '". addslashes($paragraphe_1) ."', 
							 '".addslashes($paragraphe_1)."', now() )";
							 
//	echo "<br>".$dml."<br>";
				   if ($db->Execute($dml) === false)
				   {
					   die ('error '.$dml);
				   }
			}			

			echo '1';
  
?>