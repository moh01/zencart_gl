<?php

  $id_tab=explode('|',$_GET['ids']);
  
   if ($_SERVER['SERVER_NAME']=='127.0.0.1')
   {   
	 $root= 'http://127.0.0.1/sites/zencart_gl/admin/';
   }
   else
   {
	 $root= 'http://linats.net/admin/';
   }
	 
     $cntr=0;
	 foreach ($id_tab as $oId) 
	 {
		include($root.'el_orders.php?show_stock=1&action=edit&oID='.$oId.'&force_db='.$_GET['db']);
		echo '
			<STYLE TYPE="text/css">
				 HR.breakhere {page-break-after: always}
			</STYLE>';
		echo '  <HR CLASS="breakhere"/> ';
	 }
  
 /* 
  include('http://127.0.0.1/sites/zencart_gl/admin/el_orders.php?show_stock=1&action=edit&oID=604359&source_db=gl');  

echo '  
<STYLE TYPE="text/css">
     P.breakhere {page-break-after: always}
</STYLE>';

  echo '  <hr CLASS="breakhere"/> ';

  include('http://127.0.0.1/sites/zencart_gl/admin/el_orders.php?show_stock=1&action=edit&oID=604359&source_db=gl');
  
  */
  
?>
