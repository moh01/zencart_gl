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

  
if ($_POST['updating']==1)
{
//  echo  '['. $_POST['startdate'] . $_POST['enddate'];exit;

  $onglets[]='CHK_EUR_FR';
  $sites['CHK_EUR_FR']="fr,eu,gl";
  $condition['CHK_EUR_FR']="and billing_country like 'France%' and payment_module_code in('CHK','CHQ','authorizenet','cod','COD' )";
  $ligne0['CHK_EUR_FR']="Remise Chèque France en Euros";						
  $ligne1['CHK_EUR_FR']="Pour: Easylamps";
  $ligne2['CHK_EUR_FR']="Banque HSBC    Compte  07 85 47 61 087";
  
  $onglets[]='LDC_EUR_FR';
  $sites['LDC_EUR_FR']="fr,eu,gl";
  $condition['LDC_EUR_FR']="and billing_country like 'France%' and payment_module_code in('LDC' )";
  $ligne0['LDC_EUR_FR']="Remise d'effets papier France en Euros";												
  $ligne1['LDC_EUR_FR']="Pour: Easylamps";
  $ligne2['LDC_EUR_FR']="Banque HSBC    Compte  07 85 47 61 087";
  

  $onglets[]='CHK_EUR_EU';
//  $sites['CHK_EUR_EU']="fr,es,de,uk,eu,it,gl";
  $sites['CHK_EUR_EU']="fr,eu,gl";
  
  $condition['CHK_EUR_EU']="and billing_country not like 'France%'  and payment_module_code in('CHK','CHQ','authorizenet','cod') and currency='EUR'";
  $ligne0['CHK_EUR_EU']="Bordereau de remise sur l'étranger";												
  $ligne1['CHK_EUR_EU']="Pour: Easylamps";
  $ligne2['CHK_EUR_EU']="Banque HSBC    Compte  07 85 47 61 087";

  $onglets[]='CHK_GBP_EU';  
//  $sites['CHK_GBP_EU']="eu,uk,gl";
  $sites['CHK_GBP_EU']="gl";
  $condition['CHK_GBP_EU']="and billing_country not like 'France%'  and payment_module_code in('CHK','CHQ','authorizenet','cod') and currency='GBP'";
  $ligne0['CHK_GBP_EU']="Bordereau de remise sur l'étranger en GBP";												
  $ligne1['CHK_GBP_EU']="Pour: Easylamps";
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
		  		  
		  $sql = "select  concat(billing_name,' ',billing_company) customer, 
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
   $date_jour = exec_select( 'select date_format(now(),"%Y-%c-%d") value' );
   
   echo '<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Bordereaux</title>
		<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
		</head>
		<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } ">
		<form method="post">
		De:<input type="text" name="startdate" value="'.$date_jour.'"><br>
		A :<input type="text" name="enddate" value="'.$date_jour.'"><br><br>
		
		<input type="submit" value="Extraire">
		<input type="hidden" name="updating" value="1">

		       </form>
	    </body>
		</html>';
 }
?>