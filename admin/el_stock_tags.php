<?php
function get_product_type ( $products_model )
{
    if (strlen($products_model)==0)
	   return "";
	   
	if (substr($products_model,0,5)=="MCEL-")
	{
	   $original_code = substr( $products_model, 5, 1000 );
	   $product_type = "CM";
	   $product_type_id = 2;	   
	}
	else if (substr($products_model,0,3)=="OI-")
	{
	   $original_code = substr( $products_model, 3 , 1000 );
	   $product_type = "OI";
	   $product_type_id = 3;	   	   
	}
	else if (substr($products_model,0,5)=="BCEL-")
	{
	   $original_code = substr( $products_model, 5, 1000 );
	   $product_type = "B";	  
	   $product_type_id = 4;	   	    	   
	}
	else
	{
	   $original_code = $products_model;
	   $product_type = "OM";
	   $product_type_id = 1;	   	    	   	   
	}
//echo 	'|||'.$products_model.'||'.$product_type.'||'.$original_code;

    return $product_type.'|'.$original_code.'|'. $product_type_id ;
}
  require('includes/application_top.php');
  require('el_fonctions_gestion.php');

require_once('../../exec/php/tcpdf/config/lang/eng.php');
require_once('../../exec/php/tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF('L', PDF_UNIT, array(100.00,50.00), true, 'UTF-8', false); 
  $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);


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
if (strlen($_GET['stock_items'])>0)
{
    $produit_a_imprimer =  explode (',',$_GET['stock_items']);
    for($i=0;$i<count($produit_a_imprimer);$i++)
	{
		$stuff = explode('|', $produit_a_imprimer[$i]);
		$qte = $stuff[0];
		$orders_products_id = $stuff[1];

		for($k=0;$k<$qte;$k++)
		{
		   
		   $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  
		   
//echo strpos('..'.$orders_products_id,'@');exit;		   
		   if (strpos('..'.$orders_products_id,'@')>0)
		   {
		   
				$products_name = str_replace ('@','',$orders_products_id);
			    $products_model = $products_name;
				
				$orders_id = 0;
				$supplier = 0;
				
			    $products_name = str_replace("OM","",$products_name); 
			    $products_name = str_replace("CM","",$products_name); 
			    $products_name = str_replace("OI","",$products_name); 
			    $products_name = str_replace("B","",$products_name); 

				$opi = 0;
			   
		   }
		   else
		   {
		   
			   $sql ="select products_model value, products_name, orders_id  from orders_products where orders_products_id  = ". $orders_products_id;
			   $rs = $db->Execute($sql);
			   
			   $products_model = $rs->fields['value'];
			   $products_name = $rs->fields['products_name'];
			   $products_name = str_replace("OM","",$products_name); 
			   $products_name = str_replace("CM","",$products_name); 
			   $products_name = str_replace("OI","",$products_name); 
			   $products_name = str_replace("B","",$products_name); 
			   $orders_id = $rs->fields['orders_id'];
			   
			   //echo $sql;exit;		   
			   $supplier = exec_select ( "select customers_id value  from orders, orders_products 
										 where  orders_products.orders_id = orders.orders_id 
										 and orders_products.orders_products_id  = ". $orders_products_id );
			   $opi = $orders_products_id;
		   }
		   
		   // FVV  
		   $supplierSI = strpos (',44,9999,',','.$supplier.',');
//echo $supplierSI;exit;		   
		   $prd = explode ("|", get_product_type($products_model) );
			   
		   $prd_type = $prd[0];
		   $original_code = $prd[1];		   
		   $product_type_id = $prd[2];
		   
//		   echo  $products_model.'|'.$supplier.	'|'. $prd_type . '|'. $original_code.'<br>';		   
           
		   // insertion  FVV
			if ( $_GET['external_stock']==1  )
				$consignment_stock = 1;
			else
				$consignment_stock = 0;
		   
		   $dml = "insert into el_tag
    		        ( po_orders_products_id, sequence,  in_stock, print_date, lamp_code, consignment_stock )
				   value 
				    ( ". $opi . ", " . ($k+1) . ", 0, now(), '". $products_model ."', " .  $consignment_stock .  " ) ";
					
			$db->Execute($dml);
			
			$sn = mysql_insert_id();

			if ( $_GET['valide_auto']==1 )
			{
				 stock_input ( $sn, $k, 1 );
			}
			$pdf->AddPage();
		
			// $pdf->write1DBarcode('RF 400 SI 124', 'C128B', '', '', 40, 15, 0.4, $style, 'N');
			$pdf->Cell(0, 0, '', 0, 1);
			//$pdf->Cell(0, 0, 'Projector Lamp', 0, 1);
//			$pdf->write1DBarcode('RF '. $sn . ' SI', 'C128B', '', '', 15, 8, 0.4, $style, 'N');
//			$pdf->write1DBarcode($sn , 'C39E', '', '', 15, 8, 0.4, $style, 'N');
//$pdf->write1DBarcode($sn , 'UPCA', '', '', 15, 8, 0.4, $style, 'N'); // ok mais bit de parité

$pdf->write1DBarcode($sn , 'C39', '', '', 15, 8, 0.4, $style, 'N');


			$pdf->Cell(0, 0, 'SI : '. $orders_id .'-'.$sn." ".  ($k+1) .'/'. ($qte) , 0, 1);
			$pdf->Cell(0, 0, '', 0, 1);

//			$pdf->write1DBarcode('RF '. $sn . ' SI', 'C128B', '', '', 15, 8, 0.4, $style, 'N');
			$pdf->write1DBarcode($sn , 'C39E', '', '', 15, 8, 0.4, $style, 'N');
			
			
			$description2 = $original_code . " ". "F".$supplier.'B'.$product_type_id;
//echo 	$supplierSI.'ffffffffffffffffff';exit;		
			if ( strlen($supplierSI)>0 ) 
			{
				$description2 .= " educ";			
			}
			else
			{
				$description2 .= " Projector Lamp.";				
			}
			
			
			
//			$description2 = get_english_lamp_label($description2,$rs->fields['prdref']);
			$pdf->Cell(0, 0, $description2, 0, 1);
			
			$products_name = str_replace('MCEL-','',$products_name);
			$products_name = str_replace('OI-','',$products_name);
			
			$pdf->Cell(0, 0, 'Item reference :'. $original_code . " ". $products_name, 0, 1);
			if (strlen($_GET['external_stock'])>0)
			{			
				$pdf->Image('ucs.jpg',70,5,25,0);			
			}
			else
			{						
				$pdf->Image('recycle.jpg',74,5,10,0);
				$pdf->Image('poubelle.jpg',87,4,10,0);			
			}
			$pdf->Ln();
					   
		}
		$dml = "update orders_products set printed = 1  where orders_products_id = ". $opi;
		$db->Execute($dml);
        		
	}
	$pdf->Output('example_027c.pdf', 'I');
}

// ---------------------------------------------------------

//Close and output PDF document
?>