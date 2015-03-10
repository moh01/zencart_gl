<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION:   Replaces admin/orders.php, adding    //
//  new features, navigation options, and an advanced   //
//  payment management system.                          //
//////////////////////////////////////////////////////////685
// $Id: super_orders.php 43 2006-08-29 14:05:21Z BlindSide $
*/
//_TODO add admin account id to status history record
//_TODO form verifications on edit & payment popup forms
//_TODO payment_types table interface
//_TODO popup class to build/display help or additional data in new window
//_TODO make following replacements in all SO files...
//                 <br> --> <br />
//                  <b> --> <strong>
//        zen_db_output --> zen_db_scrub_out($x)
//         zen_db_input --> zen_db_scrub_in($x, true/false)
// zen_db_prepare_input --> zen_db_scrub_in($x, true/false)

  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
  require('excel/CWorksheet.class.php');
  require('excel/CWorkbook.class.php');
$db->connect($ext_db_server[$_SESSION['source_db']], $ext_db_username[$_SESSION['source_db']], $ext_db_password[$_SESSION['source_db']], $ext_db_database[$_SESSION['source_db']], USE_PCONNECT, false);

  
if ($_POST['updating']==1)
{
//  echo  '['. $_POST['startdate'] . $_POST['enddate'];exit;

  $onglets[]='CHK_EUR_FR';
  $sites['CHK_EUR_FR']="fr,eu,gl";
  $condition['CHK_EUR_FR']="and billing_country like 'France%' and payment_module_code in('CHK','CHQ','authorizenet','cod','COD' )";
  $ligne0['CHK_EUR_FR']="Remise Chèque France en Euros";						
  $ligne1['CHK_EUR_FR']="Pour: SARL Easylamps";
  $ligne2['CHK_EUR_FR']="Banque Populaire Rives de Paris    Compte  20 21 300 70 52";
  
  $onglets[]='LDC_EUR_FR';
  $sites['LDC_EUR_FR']="fr,eu,gl";
  $condition['LDC_EUR_FR']="and billing_country like 'France%' and payment_module_code in('LDC' )";
  $ligne0['LDC_EUR_FR']="Remise d'effets papier France en Euros";												
  $ligne1['LDC_EUR_FR']="Pour: SARL Easylamps";
  $ligne2['LDC_EUR_FR']="Banque Populaire Rives de Paris    Compte  20 21 300 70 52";
  

  $onglets[]='CHK_EUR_EU';
//  $sites['CHK_EUR_EU']="fr,es,de,uk,eu,it,gl";
  $sites['CHK_EUR_EU']="fr,eu,gl";
  
  $condition['CHK_EUR_EU']="and billing_country not like 'France%'  and payment_module_code in('CHK','CHQ','authorizenet','cod') and currency='EUR'";
  $ligne0['CHK_EUR_EU']="Bordereau de remise sur l'étranger";												
  $ligne1['CHK_EUR_EU']="Pour: SARL Easylamps";
  $ligne2['CHK_EUR_EU']="Banque Populaire Rives de Paris    Compte  20 21 300 70 52";

  $onglets[]='CHK_GBP_EU';  
//  $sites['CHK_GBP_EU']="eu,uk,gl";
  $sites['CHK_GBP_EU']="gl";
  $condition['CHK_GBP_EU']="and billing_country not like 'France%'  and payment_module_code in('CHK','CHQ','authorizenet','cod') and currency='GBP'";
  $ligne0['CHK_GBP_EU']="Bordereau de remise sur l'étranger en GBP";												
  $ligne1['CHK_GBP_EU']="Pour: SARL Easylamps";
  $ligne2['CHK_GBP_EU']="HSBC Compte devise GBP N° 07850063616";

  function HeaderingExcel($filename) {
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=$filename" );
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
		header("Pragma: public");
	}

  $filename= date('d-m-y_H-i-s') . '.xls'; // Remplace la ligne précédente. Le nom du fichier est construit ainsi "jour-mois-annee_heure-minute-secondes"
  HeaderingExcel($filename);

  $workbook = new CWorkbook("-");

  $formatot4 =& $workbook->add_format();
  $formatot4->set_size(10);
  $formatot4->set_text_wrap(1);
  $formatot4->set_pattern();
  $formatot4->set_fg_color('silver');
	
$aa = 0;
	
   foreach ($onglets as $onglet)
   {
      $nb_pieces = 0;
      $les_sites = $sites[$onglet];
	  $countries = explode(',',$les_sites);
	  
	  $worksheet[$onglet] =& $workbook->add_worksheet($onglet);
	  
	  // les informations bancaires
	  $rowNum = 2;

	  $worksheet[$onglet]->write_string($rowNum,1,'Paiements en date du '.$_POST['enddate']);	
	  $rowNum++;

	  
	  $worksheet[$onglet]->write_string($rowNum,1,$ligne0[$onglet]);	
	  $rowNum++;
	  
	  $worksheet[$onglet]->write_string($rowNum,1,$ligne1[$onglet]);	
	  $rowNum++;

	  $worksheet[$onglet]->write_string($rowNum,1,$ligne2[$onglet]);	
	  $rowNum++;
	  
	  $rowNum = 10;
	      
		// entetes ----------------	
		$colNum = 1;
		
		$worksheet[$onglet]->write_string($rowNum,$colNum,'Client',$formatot4);	
		$worksheet[$onglet]->set_column($colNum, $colNum, 35);

		$colNum++;

		$worksheet[$onglet]->write_string($rowNum,$colNum,'Information Paiement',$formatot4);	
		$worksheet[$onglet]->set_column($colNum, $colNum, 35);		
		$colNum++;

		$worksheet[$onglet]->write_string($rowNum,$colNum,'Date paiement',$formatot4);	
		$worksheet[$onglet]->set_column($colNum, $colNum, 12);				
		$colNum++;

		$worksheet[$onglet]->write_string($rowNum,$colNum,'Montant',$formatot4);	
		$worksheet[$onglet]->set_column($colNum, $colNum, 12);						
		$colNum++;
			
			
		$rowNum++;	
		
	  $existing_payment = array();
	  
      foreach ($countries as $country)
	  {
		  $db->connect($ext_db_server[$country], $ext_db_username[$country], $ext_db_password[$country], $ext_db_database[$country], USE_PCONNECT, false);
		  		  
		  $sql = "select  billing_company customer, 
		                  payment_info, 
						  DATE_FORMAT(orders_date_finished, '%d/%m/%Y') orders_date_finished,  
						  payment_amount
				  from    orders 
				  where   orders_status <> 5
				  and orders_date_finished between '" . $_POST["startdate"]  . "' and '" . $_POST["enddate"] . "' " . $condition[$onglet];
//echo $sql;exit;		  
//$worksheet[$onglet]->write_string($rowNum-1+$aa,$colNum, '/'.$condition[$onglet].'/');
//$aa++;

			$orders = $db->Execute($sql);
			$list_orders_end = $orders->fields['orders_id'];
			
			
			while (!$orders->EOF) 
			{
// $worksheet[$onglet]->write_string($rowNum-1+$aa,$colNum,$country.'/'.$orders->fields['payment_info'].'/'. $existing_payment[$orders->fields['payment_info']].'/');
//$worksheet[$onglet]->write_string($rowNum-1+$aa,$colNum,'/'.$country.'/');
			
			    if ( strlen( $existing_payment[$orders->fields['payment_info']] == 0  ) )
				{
				    $existing_payment[$orders->fields['payment_info']]=$orders->fields['payment_info'];
					
				    $nb_pieces++;
				    $colNum = 1;
					
				    $worksheet[$onglet]->write_string($rowNum,$colNum,$orders->fields['customer']);
					$colNum++;

				    $worksheet[$onglet]->write_string($rowNum,$colNum,$orders->fields['payment_info']);
					$colNum++;

				    $worksheet[$onglet]->write_string($rowNum,$colNum,$orders->fields['orders_date_finished']);
					$colNum++;

				    $worksheet[$onglet]->write_number($rowNum,$colNum,$orders->fields['payment_amount']);
					$colNum++;
							
					$rowNum++;						
				}
				$orders->MoveNext();
			}		 
	  }	  
	   $sum_line = '=SUM(E12:E15)';
	  
//  $sum_line = '= '.$sum_keyword. '('.getxExcelRef($colNum).'12:'.getxExcelRef($colNum).($rowNum+2)')';  

	  $rowNum = $rowNum + 4;

	  $colNum = 3;
	  $worksheet[$onglet]->write_string($rowNum,$colNum,"Total");
	  
	  $colNum = 4;  
	  $worksheet[$onglet]->write_formula($rowNum,$colNum,$sum_line);
	 
	  $rowNum = $rowNum + 1;	 

	  $colNum = 3;
	  $worksheet[$onglet]->write_string($rowNum,$colNum,"Nb Chèques");
	  
	  $colNum = 4;  
	  $worksheet[$onglet]->write_number($rowNum,$colNum,$nb_pieces);	 
	 
   }
  
  
  // Creating a workbook
  
  
  
  // Creating the first worksheet

  $workbook->close();     
 }
 else
 {
   
   echo '<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Reporting marge journalier</title>
		<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
		</head>	
		<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } ">
		<h2>Reporting marges</h2>		
		<br><br>
		<a href="apply_margin_changes.php">Chargement "Extract Excel" marge</a>
		<br><br>
		<table border=1>
		 <tr>
		   <th colspan=4 bgcolor=#eae5e5>Saisie</th>
		   <th colspan=6>Marges</th>
		   <th colspan=3 bgcolor=#eae5e5>Actions</th>			   		
		 </tr>		   
		 <tr>
		    <th>Date <br> traitement</th>
			<th>Cnt Produits</th>
			<th>Cnt à <br>
			saisir</th>
			<th>Extract<br>
			 Excel</th>
			<th>Margin<br>
			 Entry</th>						 
			<th>fr</th>
			<th>es</th>
			<th>de</th>
			<th>en</th>
			<th>it</th>
			<th>eu</th>			
			<th>Reporting<br>
			  marges</th>
		  </tr>';
		  
   $sql = "select date_format(treatment_date,'%d-%c-%Y') date_trt, count(1) cnt_lampes, treatment_date
           from orders, orders_products
		   where orders_products.orders_id = orders.orders_id 
		   and orders.gl_transfered = 1
		   group by treatment_date
		   order by treatment_date desc
		   limit 0,60";
//		   and orders.treatment_date >  DATE_SUB(CURDATE(),INTERVAL 15 DAY)		   
// 		   and orders.orders_status not in (6,7)
		   
    $rs = $db->Execute($sql);
	
   	while (!$rs->EOF)
    {	
	    if ( strlen($bgcolor)==0)
		    $bgcolor="bgcolor=#eae5e5";
		else
		    $bgcolor="";
		
        $date_trt = $rs->fields['date_trt'];
		$treatment_date = $rs->fields['treatment_date'];
		$cnt_lampes = $rs->fields['cnt_lampes'];
		
	    $sql2 = " select count(1) to_feed
		         from orders_products
				 where unit_order_price = 0
				 and orders_id in 
				 (select orders_id 
				  from orders 
				  where treatment_date = '". $treatment_date ."' 
				  and   gl_transfered = 1 )";
//echo $sql;exit;
        $rs2 = $db->Execute($sql2);
		$to_feed = $rs2->fields['to_feed'];
		$dbs = Array('fr','es','de','en','it','eu');
        foreach ($dbs as $dtb)
		{
		    $sql = "select sum(margin) value
		         from orders_products
				 where  orders_id in 
				 (select orders_id 
				  from orders 
				  where database_code = '". $dtb ."'
				  and   gl_transfered = 1
				  and treatment_date = '". $treatment_date ."' 
				  and orders.orders_status not in (6,7) )";
				  
			$margin[$dtb] = round(exec_select( $sql ));
		}
		echo  '<tr '. $bgcolor . '>		        
			    <td><a href="el_box_tags.php?treatment_date='.$treatment_date.'">'.$date_trt.'</a></td>
				<td align=center>'. $cnt_lampes .'</td>
				<td align=center>'. $to_feed .'</td>
				<td>
				<a href="../extractions/el_margins_extract.php?source_db=po&treatment_date='. $treatment_date .'" target=_new>extract</a>
			    </td>		
				<td>
				<a href="margin_entry.php?source_db=po&treatment_date='. $treatment_date .'" target=_new>extract</a>
			    </td>												
				<td>'.$margin['fr'].'</td>
				<td>'.$margin['es'].'</td>
				<td>'.$margin['de'].'</td>
				<td>'.$margin['en'].'</td>
				<td>'.$margin['it'].'</td>
				<td>'.$margin['eu'].'</td>			
				<td><a href="out_marges.php?treatment_date='. $treatment_date .'" target="_blank">Reporting</a></td>
			  </tr>
			 <tr '. $bgcolor . '>
			   <td colspan=3 align=center>Total '.$date_trt.'</td>
			   <td colspan=6 align=center>'.($margin['fr']+$margin['es']+$margin['de']+$margin['en']+$margin['it']+$margin['eu']).'
			   <td colspan=3>&nbsp;</td>			   		
			 </tr>';
			  
		$rs->MoveNext();	  
	 }
	echo '</table>';
	echo '</body></html>';
 }
?>