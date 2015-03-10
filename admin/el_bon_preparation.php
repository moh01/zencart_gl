<?php

  require('includes/application_top.php');
  require('el_fonctions_gestion.php');

require_once('../../exec/php/tcpdf/config/lang/eng.php');
require_once('../../exec/php/tcpdf/tcpdf.php');

// create new PDF document
//$pdf = new TCPDF('L', PDF_UNIT, array(100.00,50.00), true, 'UTF-8', false); 
$pdf = new TCPDF('P', PDF_UNIT, A4, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 027');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setBarcode(date('Y-m-d H:i:s'));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 1));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', 1));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(4, 4, 0.2);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(FALSE);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 

//set some language-dependent strings
$pdf->setLanguageArray($l); 

// ---------------------------------------------------------

// set a barcode on the page footer

// set font
$pdf->SetFont('helvetica', '', 10);
			$sn = 81431;
// add a page
if (true)
{
    $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  

    $cnt=0;
	if ( 
		( $_GET['database_code'] != 'tous' ) &&
		  strlen( $_GET['database_code'] )> 0 )		
	{
			$wheredb =	" and    o.database_code = '".$_GET['database_code']."' ";
	}
	else
	{
			$wheredb =	"";
	}
	
	if  (strlen($_GET['enforce_orders_id'])>0)
	{
		$fromwhereclause = " from   orders o 
				where  o.orders_id = ".$_GET['enforce_orders_id'];	
	}
	else
	{
		$fromwhereclause = " from   orders o 
				where  o.treatment_date = '".$_GET['treatment_date']."'
				and o.gl_transfered in (1,2)
				" . $wheredb . "
				order by orders_id";
	}

	$sqlCnt = "select count(1) value ".$fromwhereclause;
//	$rsCnt=$db->Execute($sqlCnt);
    $cnt = exec_select ($sqlCnt);
//echo 	$sqlCnt."/".$cnt."/";exit;
	$sql = "select orders_id, customers_id, database_code ,
		    concat( delivery_company, ' ',delivery_name, ' ',  delivery_street_address , ' ',  delivery_city,  '         ', delivery_country ) addr,
			delivery_country pays,
			date_format(date_purchased,\"%Y-%c-%d\")  date_purchased".
			$fromwhereclause;
	        
//echo '888...'.$_GET['enforce_orders_id'].'...666'.$sql;exit;			
// 			where  o.orders_id in ('87577','87575','87574')	
	$rsMain = $db->Execute($sql);

	$cntr=0;
	
	while(!$rsMain->EOF)
	{
		$pdf->AddPage();
		
		$cntr++;
		
		$orders_id = $rsMain->fields['orders_id'];
		$customers_id = $rsMain->fields['customers_id'];
		$database_code = $rsMain->fields['database_code'];
		$addr = $rsMain->fields['addr'];
		$pays = $rsMain->fields['pays'];
		$date_purchased = $rsMain->fields['date_purchased'];
		
		$sql = "select transporter from bo_gl.el_batch_items where item_id = " . $orders_id  .  "   order by batch_id desc ";
		
		$rs3 = $db->Execute($sql);
		
		$transporter =  $rs3->fields['transporter'];
		
		$desc = "Site: ".$database_code. ".   Num commande : ". $orders_id. "        Date commande: ". $date_purchased . "        Date traitement: ". $_GET['treatment_date'] . '      ' . $database_code   . ':' .  $cntr . '/'. $cnt;
		$pdf->Cell(0, 0, $desc, 0, 1);
		$pdf->Ln();
//		$pdf->Cell(0, 0, $addr, 0, 1);
//		$pdf->Ln();

//		$pdf->write1DBarcode($rsMain->fields['orders_id'], 'EAN5', '', '', 12, 9, 0.4, $style, 'N');
//		$pdf->Cell(0, 0, '       ');
		$pdf->write1DBarcode('CMD '. $rsMain->fields['orders_id'] , 'C128B', '', '', 15, 8, 0.4, $style, 'N');
//$pdf->Cell(0, 0, $transporter );
		$pdf->writeHTMLCell(30, 6, 90, 16, $transporter );  		

		$pdf->Ln();
		$pdf->Cell(0, 0, "--------------------------------------------------------------------------------------------------------------------------------", 0, 1);
//		$pdf->Ln();
		{
			$sql = "select op.products_quantity,
							op.orders_id,
						    products_model, 
						    products_name description2,
						    compatible_lamp_code							
					from orders_products op, orders o
					where  op.orders_id = o.orders_id
					and  o.orders_id = ". $orders_id;

// 					and    length(compatible_lamp_code)>0
					
	//echo $sql;exit;			
/*
		and products_model not like 'MCEL%'
		and products_model not like 'OI%'		
		and products_model not like 'BC%' 
*/		
		//echo $sql;exit;		
			$rs = $db->Execute($sql);
			while(!$rs->EOF)
			{			
				$description2 = '';
				$description2 =  $rs->fields['description2'];
				
				for ($k=1;$k<=$rs->fields['products_quantity'];$k++) 
				{
	//			$description2 = get_english_lamp_label($description2,$rs->fields['prdref']);
					$pdf->Cell(0, 0, $description2, 0, 1);
					
					$pdf->Ln();

					$compatible_lamp_code = $rs->fields['compatible_lamp_code'] ;
					if (strlen($compatible_lamp_code)==0)
					{
						$warning = '! Produit NON VALIDE ...';
						$compatible_lamp_code = $rs->fields['products_model'];
					}
					else
					{
						$warning = '! Produit NON CONFIRME ...';
					}
					
					
					$sql = "select qty  
						from rv_lampe_eu.el_stock
						where lamp_code = '" . $compatible_lamp_code . "'" ;
						
					$rs2 = $db->Execute($sql);
					$stk = $rs2->fields['qty'];

					
					$sql = " select qty  
						from rv_lampe_eu.el_external_stock
						where lamp_code = '" .  $compatible_lamp_code . "'" ;
						
					$rs2 = $db->Execute($sql);
					$cs_stk = $rs2->fields['qty'];
					
					$el_stk = $stk - $cs_stk;

//					$pdf->Cell(0, 0, " Stock:". $el_stk ." ");				
//					$pdf->Cell(0, 0, " Stock CS:". $cs_stk ."  ");				
						
					$description3 = $rs->fields['products_model'] ."  >>  ". $warning . ' ' . $compatible_lamp_code . "     Stock:". $el_stk ."    Stock CS:". $cs_stk;
					$pdf->Cell(0, 0, "               ".$description3, 0, 1);				
					
					
					$pdf->Ln();
					$pdf->Cell(0, 0, "----------------------------------------------------------------------------", 0, 1);
				}
	/*			
				$pdf->Cell(0, 0, 'Item reference :'.$rs->fields['prdref'], 0, 1);
				$pdf->Image('recycle.jpg',74,5,10,0);
				$pdf->Image('poubelle.jpg',87,4,10,0);
	*/
				
				$rs->MoveNext();
			}
			$rsMain->MoveNext();
		}
		$pdf->Cell(0, 0, "             ", 0, 1);	
		$pdf->write1DBarcode('UPS', 'C128B', '', '', 15, 8, 0.4, $style, 'N');
		$pdf->Cell(0, 0, "Valider avec UPS                            ", 0, 1);		
		$pdf->Cell(0, 0, "----------------------------------------------------------------------------", 0, 1);
		
		$pdf->Cell(0, 0, "             ", 0, 1);	
		$pdf->write1DBarcode('DHL', 'C128B', '', '', 15, 8, 0.4, $style, 'N');
		$pdf->Cell(0, 0, "Valider avec DHL                            ", 0, 1);				
		$pdf->Cell(0, 0, "----------------------------------------------------------------------------", 0, 1);
		
		$pdf->Cell(0, 0, "             ", 0, 1);	
		$pdf->write1DBarcode('COLLISSIMO', 'C128B', '', '', 15, 8, 0.4, $style, 'N');
		$pdf->Cell(0, 0, "Valider avec COLLISSIMO                            ", 0, 1);						
		$pdf->Cell(0, 0, "----------------------------------------------------------------------------", 0, 1);
		
    }
}
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_027c.pdf', 'I');
?>