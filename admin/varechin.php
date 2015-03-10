<?php
//echo 'vacherie de VACHERIN';
$hdr = '<tr>
       <th>DATE</th>
	   <th>Site</th>
	   <th>#</th>	   
	   <th>Name</th>
	   <th>Qty</th>
	   <th>Model</th>
	   <th>Marge 1 </th>  
	   <th>Marge 2</th>  
	   <th>Diff</th>
	   </tr>';
echo $hdr;

$cntr=0;

$rs=$db->Execute($sql);

while(!$rs->EOF)
{
  $cntr++;    
  $unit_order_price = round($rs->fields['unit_order_price'],0);
  if ( $unit_order_price >0 )
  {
	$usd_euro_rate = $rs->fields['usd_euro_rate'];
  }
  else
  {
	$usd_euro_rate = "";
  }
//    return $product_type.'|'.$original_code ;
 $prd_typ = explode('|',get_product_type($rs->fields['compatible_lamp_code']));
  $tt = $prd_typ[0];
  $original_products_code = $prd_typ[1];
  
   $check_price = explode("|",get_unit_order_price ( "eu","", $original_products_code, "" )); // ( $new_compatible_lamp_code );
   $unit_order_price = $check_price[0];
   $usd_euro_rate =  $check_price[1];
   if ( $unit_order_price > 0 )
   {
	 $margin2 = $rs->fields['final_price']-($unit_order_price/$usd_euro_rate);
	 $difference = round($products_quantity * round($rs->fields['marge']-$margin2,0));
	 $margin2 = $products_quantity * round($margin2,0);
   }
   else
   {
	 $margin2 = "";
	 $difference = "";
   }
//echo $unit_order_price.'<br>'; 
  
  
  $products_quantity = $rs->fields['products_quantity'];
  echo '<tr>
       <td>'. $rs->fields['treatment_date'] .'</td>
	   <td>'. $ext_db_name[$rs->fields['database_code']] .'</td>
	   <td>'. $rs->fields['customer'] .'</td>	   
	   <td>'. $rs->fields['orders_id'] .'</td>	   
	   <td>'. $products_quantity .'</td>
	   <td align=center>  '. $rs->fields['compatible_lamp_code'] .'</td>
	   <td align=center>'. $products_quantity * round($rs->fields['marge'],0) .'</td> 
	   <td align=center>'. $margin2 .'</td>  	 
	   <td align=center>'. $difference .'</td> 	   
	   </tr>';
  $rs->MoveNext();
}
//	   <td align=center>'.  $rs->fields['marge'] .'</td>  
  
//	   <td align=center>'. round( ( $rs->fields['marge']-$margin2 ),0) .'</td>  

?>