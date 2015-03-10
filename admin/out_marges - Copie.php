<?php
// 	todo	   $objPHPExcel->getActiveSheet()->getStyle($text_cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP;
//$objPHPExcel->getActiveSheet()->getStyle($echelle)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
//$sheet->getStyle($echelle)->getAlignment()->setWrapText(true);

/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2009 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2009 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.0, 2009-08-10
 */
/// C:\sites\exec\php\phpExcel\Tests\05featuredemo.inc.php
//include "../../php/phpExcel/Tests/05featuredemo.inc.php";
$treatment_date_from = $_GET['treatment_date'];
$treatment_date_to = $_GET['treatment_date'];

 function get_countries_from_language ( $p_language_id )
 {
    
    // francais
    if ($p_language_id == 2 )
    {
        return 'in (21,73,76,124)'; //  belgique luxembourg 
    }  
    // espagnol
    else if ($p_language_id==3)
    {
        return 'in (195,196)';
    }
    // allemand
    else if ($p_language_id==4)
    {
     //   return 'in (14,81,204)';
		return 'in (81)';
    }
    else if ($p_language_id==5)
    {
        return 'in (46,45,222)';
    }		
	// italien 
    else if ($p_language_id==6)
    {
        return 'in (105)';
    }	
    // anglais
    else
    {
        return 'not in (21,73,76,195,196,81,105,46,45,222,124)';    
    }
 }  
function getExcelRef($xIndex) {
	if ( $xIndex == 1)
      return "A";
	else if ( $xIndex == 2)
      return "B";
    else if ( $xIndex == 3)
      return "C";
    else if ( $xIndex == 4)
      return "D";
     else if ( $xIndex == 5)
      return "E";
     else if ( $xIndex == 6)
      return "F";
     else if ( $xIndex == 7)
      return "G";
     else if ( $xIndex == 8)
      return "H";
     else if ( $xIndex == 9)
      return "I";
     else if ( $xIndex == 10)
      return "J";
     else if ( $xIndex == 11)
      return "K";
     else if ( $xIndex == 12)
      return "L";
     else if ( $xIndex == 13)
      return "M";
     else if ( $xIndex == 14)
      return "N";
     else if ( $xIndex == 15)
      return "O";
     else if ( $xIndex == 16)
      return "P";
     else if ( $xIndex == 17)
      return "Q";
     else if ( $xIndex == 18)
      return "R";
     else if ( $xIndex == 19)
      return "S";
     else if ( $xIndex == 20)
      return "T";
     else if ( $xIndex == 21)
      return "U";
     else if ( $xIndex == 22)
      return "V";
     else if ( $xIndex == 23)
      return "W";
     else if ( $xIndex == 24)
      return "X";
     else if ( $xIndex == 25)
      return "Y";
     else if ( $xIndex == 26)
      return "Z";
     else if ( $xIndex == 27)
      return "AA";
     else if ( $xIndex == 28)
      return "AB";
     else if ( $xIndex == 29)
      return "AC";
     else if ( $xIndex == 30)
      return "AD";
     else if ( $xIndex == 31)
      return "AE";
     else if ( $xIndex == 32)
      return "AF";
     else if ( $xIndex == 33)
      return "AG";
     else if ( $xIndex == 34)
      return "AH";
     else if ( $xIndex == 35)
      return "AI";
     else if ( $xIndex == 36)
      return "AJ";
     else if ( $xIndex == 37)
      return "AK";
     else if ( $xIndex == 38)
      return "AL";
     else if ( $xIndex == 39)
      return "AM";
     else if ( $xIndex == 40)
      return "AN";
     else if ( $xIndex == 41)
      return "AO";
     else if ( $xIndex == 42)
      return "AP";
     else if ( $xIndex == 43)
      return "AQ";
     else if ( $xIndex == 44)
      return "AR";
     else if ( $xIndex == 45)
      return "AS";
     else if ( $xIndex == 46)
      return "AT";
     else if ( $xIndex == 47)
      return "AU";
     else if ( $xIndex == 48)
      return "AV";
     else if ( $xIndex == 49)
      return "AW";
     else if ( $xIndex == 50)
      return "AX";
     else if ( $xIndex == 51)
      return "AY";
     else if ( $xIndex == 52)
      return "AZ";
     else if ( $xIndex == 53)
      return "BA";
     else if ( $xIndex == 54)
      return "BB";
     else if ( $xIndex == 55)
      return "BC";
     else if ( $xIndex == 56)
      return "BD";
     else if ( $xIndex == 57)
      return "BE";
     else if ( $xIndex == 58)
      return "BF";
     else if ( $xIndex == 59)
      return "BG";
     else if ( $xIndex == 60)
      return "BH";
     else if ( $xIndex == 61)
      return "BI";
     else if ( $xIndex == 62)
      return "BJ";
     else if ( $xIndex == 63)
      return "BK";
     else if ( $xIndex == 64)
      return "BL";
     else if ( $xIndex == 65)
      return "BM";
     else if ( $xIndex == 66)
      return "BN";
     else if ( $xIndex == 67)
      return "BO";
     else if ( $xIndex == 68)
      return "BP";
     else if ( $xIndex == 69)
      return "BQ";
     else if ( $xIndex == 70)
      return "BR";
     else if ( $xIndex == 71)
      return "BS";
     else if ( $xIndex == 72)
      return "BT";
     else if ( $xIndex == 73)
      return "BU";
     else if ( $xIndex == 74)
      return "BV";
     else if ( $xIndex == 75)
      return "BW";
     else if ( $xIndex == 76)
      return "BX";
     else if ( $xIndex == 77)
      return "BY";
     else if ( $xIndex == 78)
      return "BZ";
     else if ( $xIndex == 79)
      return "CA";
     else if ( $xIndex == 80)
      return "CB";
     else if ( $xIndex == 81)
      return "CC";
     else if ( $xIndex == 82)
      return "CD";
     else if ( $xIndex == 83)
      return "CE";
     else if ( $xIndex == 84)
      return "CF";
     else if ( $xIndex == 85)
      return "CG";
     else if ( $xIndex == 86)
      return "CH";
     else if ( $xIndex == 87)
      return "CI";
     else if ( $xIndex == 88)
      return "CJ";
     else if ( $xIndex == 89)
      return "CK";
     else if ( $xIndex == 90)
      return "CL";
     else if ( $xIndex == 91)
      return "CM";
     else if ( $xIndex == 92)
      return "CN";
     else if ( $xIndex == 93)
      return "CO";
     else if ( $xIndex == 94)
      return "CP";
     else if ( $xIndex == 95)
      return "CQ";
     else if ( $xIndex == 96)
      return "CR";
     else if ( $xIndex == 97)
      return "CS";
     else if ( $xIndex == 98)
      return "CT";
     else if ( $xIndex == 99)
      return "CU";
     else if ( $xIndex == 100)
      return "CV";
     else if ( $xIndex == 101)
      return "CW";
     else if ( $xIndex == 102)
      return "CX";
     else if ( $xIndex == 103)
      return "CY";
     else if ( $xIndex == 104)
      return "CZ";
     else if ( $xIndex == 105)
      return "DA";
     else if ( $xIndex == 106)
      return "DB";
     else if ( $xIndex == 107)
      return "DC";
     else if ( $xIndex == 108)
      return "DD";
     else if ( $xIndex == 109)
      return "DE";
     else if ( $xIndex == 110)
      return "DF";
     else if ( $xIndex == 111)
      return "DG";
     else if ( $xIndex == 112)
      return "DH";
     else if ( $xIndex == 113)
      return "DI";
     else if ( $xIndex == 114)
      return "DJ";
     else if ( $xIndex == 115)
      return "DK";
     else if ( $xIndex == 116)
      return "DL";
     else if ( $xIndex == 117)
      return "DM";
     else if ( $xIndex == 118)
      return "DN";
     else if ( $xIndex == 119)
      return "DO";
     else if ( $xIndex == 120)
      return "DP";
     else if ( $xIndex == 121)
      return "DQ";
     else if ( $xIndex == 122)
      return "DR";
     else if ( $xIndex == 123)
      return "DS";
     else if ( $xIndex == 124)
      return "DT";
     else if ( $xIndex == 125)
      return "DU";
     else if ( $xIndex == 126)
      return "DV";
     else if ( $xIndex == 127)
      return "DW";
     else if ( $xIndex == 128)
      return "DX";
     else if ( $xIndex == 129)
      return "DY";
     else if ( $xIndex == 130)
      return "DZ";
     else if ( $xIndex == 131)
      return "EA";
     else if ( $xIndex == 132)
      return "EB";
     else if ( $xIndex == 133)
      return "EC";
     else if ( $xIndex == 134)
      return "ED";
     else if ( $xIndex == 135)
      return "EE";
     else if ( $xIndex == 136)
      return "EF";
     else if ( $xIndex == 137)
      return "EG";
     else if ( $xIndex == 138)
      return "EH";
     else if ( $xIndex == 139)
      return "EI";
     else if ( $xIndex == 140)
      return "EJ";
     else if ( $xIndex == 141)
      return "EK";
     else if ( $xIndex == 142)
      return "EL";
     else if ( $xIndex == 143)
      return "EM";
     else if ( $xIndex == 144)
      return "EN";
     else if ( $xIndex == 145)
      return "EO";
     else if ( $xIndex == 146)
      return "EP";
     else if ( $xIndex == 147)
      return "EQ";
     else if ( $xIndex == 148)
      return "ER";
     else if ( $xIndex == 149)
      return "ES";
     else if ( $xIndex == 150)
      return "ET";
     else if ( $xIndex == 151)
      return "EU";
     else if ( $xIndex == 152)
      return "EV";
     else if ( $xIndex == 153)
      return "EW";
     else if ( $xIndex == 154)
      return "EX";
     else if ( $xIndex == 155)
      return "EY";
     else if ( $xIndex == 156)
      return "EZ";
     else if ( $xIndex == 157)
      return "FA";
     else if ( $xIndex == 158)
      return "FB";
     else if ( $xIndex == 159)
      return "FC";
     else
      return "B";
}
function set_cell_value($colNum,$cell_value)
{
   global $numLigne,$objPHPExcel;
   
   $cel_ref = getExcelRef($colNum+2).$numLigne;
   $objPHPExcel->getActiveSheet()->setCellValue($cel_ref, $cell_value);
}
function set_cell_comment($colNum,$cell_value)
{
   global $numLigne,$objPHPExcel;
   
   $cel_ref = getExcelRef($colNum+2).$numLigne;
   //$objPHPExcel->getActiveSheet()->setCellValue($cel_ref, $cell_value);
   $objPHPExcel->getActiveSheet()->getComment($cel_ref)->getText()->createTextRun($cell_value);
}




/** PHPExcel_IOFactory */
require_once '../../php/phpExcel/Classes/PHPExcel/IOFactory.php';

/** Error reporting */
//error_reporting(E_ALL);


/** PHPExcel_RichText */
//require_once  '../../php/phpExcel/Classes/PHPExcel/RichText.php';

/** PHPExcel */
//require_once   '../../php/phpExcel/Classes/PHPExcel.php';

// Create new PHPExcel objectf
echo date('H:i:s') . " Create new PHPExcel object\n";
// $objPHPExcel = new PHPExcel// Set properties
//$objPHPExcel = $objReader->load("includes/models/reporting.xls");
$objPHPExcel = PHPExcel_IOFactory::load("includes/models/reporting3.xlsx");

//$objPHPExcel->getActiveSheet()->getHeaderFooter()->Header('&C&HPlease treat this document as confidential!');

//echo date('H:i:s') . " Set properties\n";
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

   // parametres
   $arrondi = 0;
    							 
  require('includes/application_top.php');
  $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);

  $col_indice[1]=5;  
  $col_db[1]="fr";
  $col_pdm[1]="non";

  $col_indice[2]=7;  
  $col_db[2]="fr";
  $col_pdm[2]="oui";

  $col_indice[3]=9;  
  $col_db[3]="es";
  $col_pdm[3]="non";

  $col_indice[4]=11;  
  $col_db[4]="es";
  $col_pdm[4]="oui";

  $col_indice[5]=13;  
  $col_db[5]="de";
  $col_pdm[5]="non";

  $col_indice[6]=15;  
  $col_db[6]="de";
  $col_pdm[6]="oui";

  $col_indice[7]=17;  
  $col_db[7]="en";
  $col_pdm[7]="non";

  $col_indice[8]=19;  
  $col_db[8]="en";
  $col_pdm[8]="oui";
  
  $col_indice[9]=21;  
  $col_db[9]="it";
  $col_pdm[9]="non";

  $col_indice[10]=23;  
  $col_db[10]="it";
  $col_pdm[10]="oui";
  
  $col_indice[11]=25;  
  $col_db[11]="eu";
  $col_pdm[11]="all";
  $languages_id[11]="2";

  $col_indice[12]=28;  
  $col_db[12]="eu";
  $col_pdm[12]="all";
  $languages_id[12]="3";

  $col_indice[13]=31;  
  $col_db[13]="eu";
  $col_pdm[13]="all";
  $languages_id[13]="4";

  $col_indice[14]=34;  
  $col_db[14]="eu";
  $col_pdm[14]="all";
  $languages_id[14]="5";

  $col_indice[15]=37;  
  $col_db[15]="eu";
  $col_pdm[15]="all";
  $languages_id[15]="6";

  $col_indice[16]=40;  
  $col_db[16]="eu";
  $col_pdm[16]="all";
  $languages_id[16]="000";

  
  $cnt_cols = 16;
  

  // Create a first sheet, representing sales data
  // Create a first sheet, representing sales data
// echo date('H:i:s') . " Add some data\n";


$objPHPExcel->setActiveSheetIndex(0);
	 $numLigne = 6;

$cel_ref = getExcelRef(1).$numLigne;
$objPHPExcel->getActiveSheet()->setCellValue($cel_ref, $treatment_date_from);

//echo '?'.$ts_id.'?';
  for ($k=1;$k<=$cnt_cols;$k++)
  {
	 $numLigne = 6;
	 $add_where = "";
	 if ( $col_pdm[$k] == "non" )
	 {
		$add_where = 	"	and payment_module_code not like 'MKP%' ";
	 }
	 if ( $col_pdm[$k] == "oui" )
	 {
		$add_where = 	"	and payment_module_code like 'MKP%' ";
	 }
	 if ( $col_db[$k] == "eu" )
	 {
		$add_where = 	" and customers_countries_id " . get_countries_from_language ( $languages_id[$k] );
	 }
	   

     $sql = "SELECT products_quantity*sum(margin) marge,
			  sum(products_quantity) qty,
		      o.orders_id numero_commande, 
		      orders_products.products_model, 
		      orders_products.products_name, 
		      avg(orders_products.final_price) prix_vendu, 
		      avg(unit_order_price/usd_euro_rate) prix_achat_unitaire,
			  o.payment_module_code,
			  o.customers_company
		FROM orders o,
		   orders_products
		WHERE o.orders_id >0
		and o.gl_transfered=1
		and products_quantity > 0
		and final_price > 0
		and unit_order_price > 0
		AND o.database_code <> 'po'
		AND orders_products.orders_id = o.orders_id
		AND orders_products.products_model NOT
IN (
'SHF', 'CODF', 'ECOF', 'ESCC','ESCF', 'FRSH', 'FRS', 'SP400','DUSTGO','INSUR'
)		
		and o.treatment_date between '".$treatment_date_from."' and '".$treatment_date_to."'
		and o.database_code = '".$col_db[$k]."'
		". $add_where . "
		group by       orders_products.products_model, 
		      orders_products.products_name,o.payment_module_code,
			  o.customers_company
		order by avg(margin) 		";
//echo $sql;exit;		
//		and o.orders_status not in (6,7)
//echo "<br>".$sql."<br>";
/*
		and exists (select 1 from el_batch_items, el_batch  
		            where el_batch.batch_id = el_batch.batch_id 
					and el_batch.batch_name like '".$treatment_date_from ."%'
					and el_batch_items.item_id = o.orders_id)

*/					
	 $rs = $db->Execute($sql);
	 while (! $rs->EOF )
	 {   
	 	set_cell_value($col_indice[$k], round($rs->fields["marge"]));
		$comment='CMD '.$rs->fields["numero_commande"].' 
'.$rs->fields["products_model"].' 
PV '.round($rs->fields["prix_vendu"]) . '
PA '.round($rs->fields["prix_achat_unitaire"]) . '
'.$rs->fields["payment_module_code"].'
/';
        if ( round($rs->fields["marge"]) < 30 )
		{
			set_cell_comment($col_indice[$k],$comment);
		}
	 	set_cell_value($col_indice[$k]+1, round($rs->fields["qty"]));
		
		if ( $col_db[$k] == "eu" )
		{
			set_cell_value($col_indice[$k]+2, $rs->fields["customers_company"]);		    
		}
		$rs->MoveNext();
		$numLigne++;		
	 }
  }

// $objPHPExcel = PHPExcel_IOFactory::load("05featuredemo.xlsx");

//echo date('H:i:s') . " Write to Excel  format\n";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$filename='../outputs/'.$treatment_date_from.'_'.$treatment_date_to.'.xlsx';
$objWriter->save($filename);
echo '<html><body><script>top.document.location="'. $filename .'";</script></body></html>';
// Echo done
echo date('H:i:s') . " Done writing files.\r\n";
?>