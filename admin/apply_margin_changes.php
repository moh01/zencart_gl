<?php
  require('includes/application_top.php');
  $db->connect($ext_db_server[$_SESSION['source_db']], $ext_db_username[$_SESSION['source_db']], $ext_db_password[$_SESSION['source_db']], $ext_db_database[$_SESSION['source_db']], USE_PCONNECT, false);

function purge_char($val_in)
{
   $val =  str_replace(chr(10),'',$val_in) ;

   $val =  str_replace(chr(13),'',$val) ;
   $val =  str_replace(chr(9),'',$val) ;
   $val =  str_replace('
','',$val) ;
//   $val = str_replace (' ','',$val) ;
   $val =  str_replace(',','.',$val) ;
   
   return $val;
}
  
  $lg_code = LG_CODE;

  extract($_POST, 1);
  
  
  $order_num_index = 2;
  $lamp_code_index = 3;
  $po_price_index = 6;
  $rate_index = 7;  
  
  $first_price_index = 2;

 if (  isset($updating)   )
 {
   echo ' <hr WIDTH="100%"><br>';
   echo ' <hr WIDTH="100%"><br>';

   $lines = explode(chr(13), $question_data);
   $cntr_updates = 0;
   
   $cntr = 0;
   $order_num_index = 1;
   $order_product_index = 2;
   $lamp_code_index = 3;
   $sold_price_index = 5;     
   $po_price_index = 6;
   $rate_index = 7;  
    foreach ($lines as $line)
    {
      $cnt++;

      $flds = explode(chr(9), $line);
	  if (   ( $cnt > 1  ) && ( strlen ($flds[$order_product_index]) > 0  ) )
      {

		   $order_num = purge_char($flds[$order_num_index]);

		   $orders_products_id = purge_char($flds[$order_product_index]);

		   $lamp_code  = purge_char($flds[$lamp_code_index]);
		   $sold_price = purge_char($flds[$sold_price_index]);
		   $po_price = purge_char($flds[$po_price_index]);
		   $rate = purge_char($flds[$rate_index]);
		   
		   echo "order_num ". $order_num . '  lamp_code '. $lamp_code . '  po_price '. $po_price   .' rate  '. $lamp_code . ' <br>';
           if ($rate!=0)
		   {
				$margin =  $sold_price-$po_price/$rate ;
		   }
		   
           if ( ( $po_price > 0 ) && ( $rate > 0 ) && ( $margin <> 0 ) )
		   {
			   $dml = "update orders_products 
		             set unit_order_price = ".$po_price.",
		                 usd_euro_rate = ". $rate.",
		                 margin = ".$margin."
					 where orders_products_id = '".$orders_products_id."'";
					 
					 
				$cntr_updates++;
			    echo $dml.'<br>';
				$db->Execute($dml);
           }		   
      }
      

    } # each

   echo '<br> '. $cntr_updates  . ' valeur modifiées. <br>';
   echo ' <hr WIDTH="100%"><br>';
   echo '<html><body><script>top.document.location="el_margins.php";</script></body></html>';
   
   echo ' <hr WIDTH="100%"><br>';

  }

?>
<html>
<head>
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<link rel="stylesheet" href="le.css" type="text/css">
</head>
<body>
<div style="padding-left:10px;padding-right:10px">


   <form name="frm" method="post">
   <input type="hidden" value="1" name="updating">
   Selectionner le contenu intégral de la feuille Excel (CTRL A). <br>
   Copier dans le  presse papier (CTRL C). <br>
   Coller dans le rectangle ci-dessous (CTRL V). <br>

   <textarea  name="question_data"> </textarea><br><br> 
   Confirmer l'upload<br><br>
   <input type="submit" value="Confirmer">
</form>
</div>
</body>
</html>