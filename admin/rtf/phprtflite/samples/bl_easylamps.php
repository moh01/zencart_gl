<?php
require_once("../rtf/Rtf.php");

//////////////
//Font formats
$font1 = new Font(11, 'Times new Roman', '#000055');

//////////////
//Paragraph formats
$parFC = new ParFormat('center');

$parFL = new ParFormat('left');

//////////////
//Rtf document
$rtf = new Rtf();
$null = null;
//section
$sect = &$rtf->addSection();

$sect->writeText('Easylamps
33 rue de la révolution93100 Montreuil 



', new Font(14, 'Arial'), new ParFormat());


///  les lignes de produits et qtés

$products = array('ELPLP6 ', 'EJL 53');
$descriptions = array('Lampe originale pour TOSHIBA CPE 45', 'Lampe originale pour BENQ 875');
$quantites = array('1', '2');

$count = count($products);
$countCols = $count + 2;
$countRows = $count + 1;



$colWidth = ($sect->getLayoutWidth() - 5) / 2;



//table creating and rows ands columns adding
$table = &$sect->addTable();
$table->addRows(1, 1);
$table->addRows($count, -0.6);

$table->addColumn(3);
$table->addColumn(8);
$table->addColumn(2);

//borders
$table->setBordersOfCells(new BorderFormat(1, '#555555'), 1, 1, $countRows, $countCols);

//top row
$table->rotateCells('right', 1, 2, 1, $countCols - 1);
$table->setVerticalAlignmentOfCells('center', 1, 2, 1, $countCols);

$i = 2;
foreach ($products as $product) {  
  	$table->writeToCell($i, 1, $product, $font1, new ParFormat(), $null);  	

  	$table->writeToCell($i, 2, $descriptions[$i-2], $font1, new ParFormat(), $null);  	
  	$table->writeToCell($i, 3, $quantites[$i-2], $font1, new ParFormat(), $null);  	

  	$i ++;
}




$fontBold = new Font(11, 'Times new Roman', '#7A2900');
$fontBold->setBold();

$table->setDefaultAlignmentOfCells('center', 2, 2, $countRows, $countCols);
$table->setDefaultFontOfCells(new Font(11, 'Times new Roman', '#7A2900'), 2, 2, $countRows, $countCols - 1);
$table->setDefaultFontOfCells($fontBold, 2, $countCols, $countRows);

$table->writeToCell(1, $countCols, 'TOTAL', $font1, new ParFormat('center'));

$table->setBordersOfCells(new BorderFormat(1.5, '#000000'), 1 , $countCols, $countRows, $countCols);
$table->setBordersOfCells(new BorderFormat(1, '#0000ff', 'dash'), 2, $countCols, $countRows - 1, $countCols, 0, 0, 0, 1);



$rtf->sendRtf();

?>