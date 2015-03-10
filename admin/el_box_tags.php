<?php

  require('includes/application_top.php');
  require('el_fonctions_gestion.php');

require_once('../../exec/php/tcpdf/config/lang/eng.php');
require_once('../../exec/php/tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF('L', PDF_UNIT, array(100.00,50.00), true, 'UTF-8', false); 

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
if (strlen($_GET['treatment_date'])>0)
{
    $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  

	$sql = "select op.orders_id,
				   products_model prdref, 
				  products_name description2 
	        from orders_products op, orders o
			where ( compatible_lamp_code like 'MCEL%' 
			        or compatible_lamp_code like 'OI%' ) 
			and  products_model not like 'MCEL%'
			and  products_model not like 'OI%'
			and  op.orders_id = o.orders_id
		    and  o.treatment_date = '" .$_GET['treatment_date']."'";
			
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
			$pdf->AddPage();
		
			// $pdf->write1DBarcode('RF 400 SI 124', 'C128B', '', '', 40, 15, 0.4, $style, 'N');
			$pdf->Cell(0, 0, '', 0, 1);
			//$pdf->Cell(0, 0, 'Projector Lamp', 0, 1);
			$pdf->write1DBarcode($sn, 'EAN5', '', '', 12, 9, 0.4, $style, 'N');
			$pdf->Cell(0, 0, 'SN : '.$rs->fields['orders_id'].'-'.$sn, 0, 1);
			$pdf->Cell(0, 0, '', 0, 1);

			$pdf->write1DBarcode('RF 234 SI', 'C128B', '', '', 15, 8, 0.4, $style, 'N');
			$description2 = $rs->fields['description2'];
			
		
			$description2 = get_english_lamp_label($description2,$rs->fields['prdref']);
			$pdf->Cell(0, 0, $description2, 0, 1);
			
			$pdf->Cell(0, 0, 'Item reference :'.$rs->fields['prdref'], 0, 1);
			$pdf->Image('recycle.jpg',74,5,10,0);
			$pdf->Image('poubelle.jpg',87,4,10,0);

			$pdf->Ln();
			
			$rs->MoveNext();
		}
    }
	else // appel depuis el_one_tag
	{
		$pdf->AddPage();
	
		$pdf->Cell(0, 0, '', 0, 1);
		//$pdf->Cell(0, 0, 'Projector Lamp', 0, 1);
		$pdf->write1DBarcode($sn, 'EAN5', '', '', 12, 9, 0.4, $style, 'N');
		$pdf->Cell(0, 0, 'SN : '.$_GET['orders_id'].'-'.$sn, 0, 1);
		$pdf->Cell(0, 0, '', 0, 1);

		$pdf->write1DBarcode('RF 234 SI', 'C128B', '', '', 15, 8, 0.4, $style, 'N');
		
		$description2 = $_GET['modified_label'];
		$pdf->Cell(0, 0, $description2, 0, 1);
			
		$pdf->Cell(0, 0, 'Item reference :'.$_GET['products_model'], 0, 1);
		$pdf->Image('recycle.jpg',74,5,10,0);
		$pdf->Image('poubelle.jpg',87,4,10,0);
	
	}


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_027c.pdf', 'I');
?>