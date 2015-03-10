<?php
echo '
<TITLE>Tiquet d\'incident</TITLE>
<FRAMESET NAME=MSTR COLS="500,800" border=1>
  <frame name=sommaire src="show_ticket.php?id='.$_GET['id'].'">
  <frame name=detail src="encours_detail.php?what=3&ticket_id='.$_GET['id'].'&customers_id='.$_GET['customers_id'].'&customer_db='.$_GET['customer_db'].'">
</FRAMESET>
';
?>