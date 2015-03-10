<?php
echo '
<TITLE>'. $_GET['oID'] . '</TITLE>
<FRAMESET NAME=MSTR ROWS="5%,95%" border=0>
  <frame name=menu src="menu.php?oID='.$_GET['oID'].'&orders_status=' .$_GET['orders_status'] . '&force_db='.$_GET['force_db'].'&source_db='.$_GET['source_db'].'&languages_id='.$_GET['languages_id'].'">
  <frame name=contenu src="el_orders.php?action=edit&oID='.$_GET['oID'].'&force_db='.$_GET['force_db'].'&source_db='.$_GET['source_db'].'">
</FRAMESET>
';
?>