<?php
  require('includes/application_top.php');
  require('el_fonctions_gestion.php');

/*
	$coface_customers_id
	$coface_nom
	$coface_credit
	$match_easylamps
	$easylamps_limite_credit
	$easylamps_encours_credit
	$date_decision
	$etat_decision	
*/  
  $html .= '<body>';
  //echo 'taille'.strlen($_POST['coface_data']);  
  
  
  
  if (strlen($_POST['coface_data'])>0 )
  {
	$dml = "truncate table el_coface";
	$db->Execute($dml);
	
	$lignes = explode ('
',$_POST['coface_data']);
//echo 'cnt'. count($lignes);
	foreach ($lignes as $key => $ligne) 
	{
		$cols = explode ('	',$ligne);

		$coface_nom = $cols[0];
		$coface_credit= $cols[1];
		$coface_date_decision= $cols[2];
		$coface_etat_decision= $cols[3];			
		
		$coface_customers_id = str_replace(' ','',$cols[5]);

		
  	    $customers_company = "";
		$database_code = "";			  
		$max_credit = "";
		$en_cours = "";
		
//echo "numeric".is_numeric($coface_customers_id);exit;
		if ( ($coface_customers_id>0) )
		{
			$sql = "select customers_company,database_code,customers_country,date_purchased
					from  bo_gl.orders 
					where database_code in ('eu','fr', 'de','en')
					and  customers_id = ". $coface_customers_id . "
					order by date_purchased desc";
					
			$rsc = $db->Execute($sql);
			if (!$rsc->EOF)
			{
				  $customers_company = str_replace("'","",$rsc->fields['customers_company']);
				  $database_code = $rsc->fields['database_code'];
				  $customers_country = $rsc->fields['customers_country'];
				  $date_purchased =  $rsc->fields['date_purchased'];
				  
				  
				  $sql = "select max_credit 
						  from ".$ext_db_database[$database_code].".customers 
						  where customers_id = ".$coface_customers_id;
						  
				  $rsm = $db->Execute($sql);
				  $max_credit = $rsm->fields["max_credit"];
				  

				$sql = "SELECT sum(order_total) en_cours
							 FROM     orders
							 WHERE    orders_status=2 
							 and      customers_id = ". $coface_customers_id." 
							 and  database_code ='".$database_code."'" ;
					 
				$rsr = $db->Execute($sql);			
				$en_cours = $rsr->fields["en_cours"];
			}
		}
		$match_easylamps = $customers_country;
		//$database_code. " ". $customers_company;
		
		$easylamps_limite_credit = $max_credit;
		$easylamps_encours_credit = $en_cours;
		
/*		
echo $coface_nom.'<br>';
echo $coface_credit.'<br>';
echo $coface_date_decision.'<br>';
echo $coface_etat_decision.'<br>';
echo $coface_customers_id.'<br>';

echo $match_easylamps.'<br>';
echo $easylamps_limite_credit.'<br>';
echo $easylamps_encours_credit.'<br>';

*/
$coface_nom = addslashes($coface_nom);
if ($coface_customers_id!=80208)
	$match_easylamps = addslashes($match_easylamps);
else
	$match_easylamps ="";

		$dml = " insert into el_coface ( coface_nom, 
										 coface_credit, 
										 coface_date_decision,
										 coface_etat_decision, 
										 coface_customers_id, 
										 match_easylamps,
										 easylamps_limite_credit,
										 easylamps_encours_credit,
										 database_code,
										 date_purchased)
				          values (  
						              '". $coface_nom ."',
						              '". $coface_credit ."',
						              '". $coface_date_decision ."',
						              '". $coface_etat_decision ."',
						              '". $coface_customers_id."',
						              '". $match_easylamps."',
						              '". $easylamps_limite_credit."',
						              '". $easylamps_encours_credit."',
						              '". $database_code."',									  
						              '". $date_purchased."'									  
						  )";
//echo '<br>'.$dml.'<br>';
						  
			$db->Execute($dml);
			
	}
  }
  
  $html .= '<h1> Injection/Extraction Coface </h1>';
  
  $html .= '<form method="POST">';
  $html .= '<h2>Veuillez copier/coller le fichier Excel de la Coface</h2>';
  
  $rs=$db->Execute("select * from el_coface");
  
  
  while(!$rs->EOF)
  {
		$cId = (int)$rs->fields['coface_customers_id'];  
		$database_code = $rs->fields['database_code'];  
		
		$easylamps_limite_credit = $rs->fields['easylamps_limite_credit'];
   	   if ($_GET['updlinats']==1)
	   {
//echo $database_code.'in '.strlen($database_code);
		  if  ( (strlen($database_code)==2) && ($cId>0)&&($rs->fields['coface_credit']!=$rs->fields['easylamps_limite_credit']) )
		  {
		 
			 $dml = "update ".$ext_db_database[$database_code].".customers
					 set max_credit=".$rs->fields['coface_credit']."
					 where  customers_id = ".$cId;
					 
///echo 	$dml.'<br>';				 
			 $db->Execute($dml);	
			 
			 $dml = "update el_coface
					 set easylamps_limite_credit=".$rs->fields['coface_credit']."
					 where  coface_customers_id	 = ".$cId;
			 
			 $db->Execute($dml);	

			 
			 $easylamps_limite_credit = $rs->fields['coface_credit'];
		  }
	   }
		
		$content .= $rs->fields['coface_nom'].'	'.$rs->fields['coface_credit'].'	'. $rs->fields['coface_date_decision'].'	';
		$content .=  $rs->fields['coface_etat_decision'].'		'.$cId.'	'. $rs->fields['match_easylamps'].'	';
		$content .=  $easylamps_limite_credit .'	'.$rs->fields['easylamps_encours_credit'].'	'.$rs->fields['date_purchased'];
		$content .= '
';


		$rs->MoveNext();
  }
  $html .= '<textarea name=coface_data cols=80 rows=12>'.$content.'</textarea>';

//  $html .= '<br><input type=checkbox name=updlinats><b>Mise à jour de linats';

  $html .= '<br><br><input type=submit>';
  $html .= '</form>';

  $html .= '<h1> Mise a jour des informations de credit client </h1>';
  $html .= '<a href="coface_input.php?updlinats=1"> Cliquer ici pour mettre a jour linats en fonction des donnees Coface. </a>';
  
  $html .= '</body>';

echo $html;		

?>