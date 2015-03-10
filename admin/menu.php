<?php
  require('includes/application_top.php');
  global $db;
  echo '
	<HTML>
	<HEAD><TITLE>Bienvenue.</TITLE>
	<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
	<Body>
  <form name="pdfoc_action" action="el_gestion.php?form=action" method="post" target=contenu><a href="el_orders.php?action=edit&oID='.$_GET['oID'].'" target="contenu">
        &nbsp;&nbsp;&nbsp;Edition 
        </a>';
  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';        
  echo '			
			<input type="submit" name="submit_action" value="Apercu de la pièce"></td>
			<input type="hidden" name="file_type" value="Invoice.php">
			<input type="hidden" name="invoice_mode" value="preview">
			<input type="hidden"  name="address" value="delivery">
			<input type="hidden"  name="startpos" value="1">
			<input type="hidden" name="show_order_date"  value="1">
			<input type="hidden" name="show_comments" value="1">
			<input type="hidden" name="show_phone" value="">
			<input type="hidden" name="show_email" value="">
			<input type="hidden" name="show_pay_method" value="">
			<input type="hidden" name="show_cc" value="">
			<input type="hidden" name="status" value="0">
			<input type="hidden" name="notify" value="1">
			<input type="hidden" name="ord_id" value="'.$_GET['oID'].'">
			<input type="hidden" name="notify_comments"  value="1">';
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';        
echo '<a target=contenu href="rtf/ezl_rtf_bl.php?numCommandes='.$_GET['oID'].'&lg_code='.$_GET['languages_id'].'&source_db='.$_GET['source_db'].'">Bon de livraison Word</a>';
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';        
echo '<a target=contenu href="rtf/ezl_rtf_invoice.php?numCommandes='.$_GET['oID'].'&lg_code='.$_GET['languages_id'].'&source_db='.$_GET['source_db'].'">Facture Word</a>';
echo '</form>';
if ( $_SESSION['source_db']!="gl" )
{
   $status = $_GET['orders_status'];
	if ( ( $status != 2 ) || ( $status != 3 ) )
   {
      if ( $status == 1 )
	  {
	    $choix  = '
		<input type="radio" name="status" value="3">Facture payée &nbsp;|&nbsp;
		<input type="radio" name="status" value="2" Checked>Facture envoyée &nbsp;&nbsp;';
      }
	   echo '   
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<form name="pdfoc_action" action="el_gestion.php?form=action" method="post" target=_top>
				' . $choix . '
			    <input type="radio" name="status"  CHECKED value="1">Un BL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				<input type="submit" name="submit_action" value="Produire">
				<input type="hidden" name="file_type" value="Invoice.php">
				<input type="hidden" name="invoice_mode" value="final">
				<input type="hidden"  name="address" value="delivery">
				<input type="hidden"  name="startpos" value="1">
				<input type="hidden" name="show_order_date"  value="1">
				<input type="hidden" name="show_comments" value="1">
				<input type="hidden" name="show_phone" value="">
				<input type="hidden" name="show_email" value="">
				<input type="hidden" name="show_pay_method" value="">
				<input type="hidden" name="show_cc" value="">			
				<input type="hidden" name="ord_id" value="'.$_GET['oID'].'">
				<input type="hidden" name="notify_comments"  value="1">
				</form>	  ';
    }
}
/*
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="encourscmd_client.php" target=contenu>En cours commande client</a>';
//echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mail_info_cmde.php?orders_id='.$_GET['oID'].'&source_db='.$_GET['source_db'].'" target=contenu>Entete cmd mail</a>';
*/
//echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="infos_cmde.php?orders_id='.$_GET['oID'].'&source_db='.$_GET['source_db'].'" target=contenu>Entete cmd ma//il</a>';
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="el_orders.php?show_stock=1&action=edit&oID='.$_GET['oID'].'&source_db='.$_GET['source_db'].'" target=contenu>Avec Infos Stock</a>';

echo '<hr></body>
</html>';
        
?>