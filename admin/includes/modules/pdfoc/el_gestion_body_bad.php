<?php

/*  PDF Order Center 1.0 for Zen Cart v1.2.6d  and v1.2.7d
 *  By Grayson Morris, 2006
 *  Printing sections based on Batch Print Center for osCommerce by Shaun Flanagan
 *
 * Released under the Gnu General Public License (see GPL.txt)
 *
 * pdfoc_body.php
 *
 */
  if ( $_SESSION['admin_id']==2 )
  {
      $may_change_order = 0;
  }
  else
  {
      $may_change_order = 1;    
  }
      $may_change_order = 1;    
  

//echo $may_change_order;exit;
  
  $orders_statuses = array();
  $orders_status_array = array();
  $orders_status = $db->Execute("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . $_SESSION['languages_id'] . "'");
  $orders_statuses[] = array('id' => 0, 'text' => 'None');

   
  
  while (!$orders_status->EOF) {
    $orders_statuses[] = array('id' => $orders_status->fields['orders_status_id'],'text' => $orders_status->fields['orders_status_name'] . ' [' . $orders_status->fields['orders_status_id'] . ']');
    $orders_status_array[$orders_status->fields['orders_status_id']] = $orders_status->fields['orders_status_name'];
    $orders_status->MoveNext();
  }

  $directory = DIR_PDFOC_TEMPLATES;
  $resc = opendir($directory);

  if (!$resc) {
    echo "Problem opening directory $directory. Error: $php_errormsg";
    exit;
  }

  $file_type_array = array(array('id' => '0', 'text' => PDFOC_TEXT_NONE));  // This constant is defined in admin/includes/languages/english/extra_definitions/pdfoc.php
  while ($file = readdir($resc)) {

    $ext = strrchr($file, ".");

    if ($ext == ".php") {

      $filename = str_replace('-', '_',$file);
      $filename = str_replace($ext, "",$filename);
    $fileconst = 'PDFOC_TEMPLATE_NAME_' . strtoupper($filename);
    /* look for a constant for that filename; if exists, use it, otherwise use filename */
    /* (allows language-specific names to be displayed in the dropdown menus) */
    if (defined("$fileconst"))
    {
      $filename = constant($fileconst);
    }
    else
    {
      $filename = "MISTAKE! " . $filename;        // debugging code
//      $filename = str_replace('_', " ", $filename);
    }
      $file_type_array[] = array('id' => $file,'text' => $filename);
    } // EOIF $ext

  }  // EOWHILE $file
?>
<tr>

<!--// This is the options/actions section on LH half of page //-->

  <td valign="top" width="2%"><table valign="top" border="0" cellpadding="5" cellspacing="0" width="100%">
<?php
  if ($message) {
?>
  <tr>
     <td>
      <table border="0" cellpadding="5" cellspacing="0" width="100%">
              <tr class="pdfocMessageHeaderRow">
        <td class="pdfocMessageHeaderContent" id="pdfocProgramMessage" width="50%"><?php echo PDFOC_PROGRAM_MESSAGE; ?></td>
      </tr>
              <tr class="pdfocMessageRow">
                <td class="pdfocMessageContent"><?php echo $message; ?></td>
              </tr>
      </table>
     </td>
  </tr>
  <tr>
    <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
  </tr>


<?php
  } // EOIF $message
 // echo zen_draw_form('pdfoc_deletion', FILENAME_EL_PDFOC, 'form=deletion','post','',true);

?>
    <tr>
      <td>
             &nbsp;

       <!-- FV suppression de la partie de gauche --
                  <table valign="top" border="0" cellpadding="5" cellspacing="0" width="100%">
              <tr class="dataTableRowSelected">
                <td class="dataTableHelptext"><a class="helptextPopup" id="pdfocDeleteOrdersHelptext" href="<?php echo zen_href_link(FILENAME_PDFOC,'action=refresh'); ?>"><?php echo PDFOC_HELPTEXT_ICON; ?><span><?php echo PDFOC_DELETE_ORDERS_HELPTEXT; ?></span></a></td>
                <td><input type="submit" name="delete" value="<?php echo PDFOC_DELETE_ORDERS; ?>" onclick="return confirm('<?php echo PDFOC_MESSAGE_DELETE_ARE_YOU_SURE; ?>')" /></td>
                <td><?php echo PDFOC_TEXT_RESTOCK; ?></td>
                <td><?php echo zen_draw_selection_field('restock', 'checkbox', true, (PDFOC_RESTOCK_DEFAULT=='true' ? true : false)); 
	  ?></td>
                </form>
<?php
  echo zen_draw_form('pdfoc_action', FILENAME_PDFOC, 'form=action','post','',true);
?>
                <td class="dataTableHelptext" align="right"><a class="helptextPopup" id="pdfocTextSubmitHelptext" href="<?php echo zen_href_link(FILENAME_PDFOC,'action=refresh'); ?>"><?php echo PDFOC_HELPTEXT_ICON; ?><span><?php echo PDFOC_TEXT_SUBMIT_HELPTEXT; ?></span></a></td>
                <td align="left"><input type="submit" name="submit_action" value="<?php echo PDFOC_TEXT_SUBMIT; ?>"></td>
      </tr>
           </table>
       // fin de suppression -->  

       </td>
    </tr>
    <tr>
       <td>

       &nbsp;
       <!-- FV suppression de la partie de gauche --
       site fr <input type="checkbox" name=""> 
  </form>
       // fin de suppression -->  
    
      </td>
    </tr>
 </table></td>

<!--// This is the order list section on RH half of page //-->

   <td valign="top" width="65%"><!--bof PDFOC orders statuses //-->
<?php
/*
if (is_array(zen_get_orders_status())) {
    echo '<div id="orderstatuses">';
    echo '<strong>&lt;=</strong> <a ' . (((int)$_GET['pull_status'] == 0) ? 'class="selected"': '') . 'href="' . zen_href_link(FILENAME_EL_PDFOC, 'pull_status=0'). '">' . PDFOC_TEXT_RESET . '</a>';
    foreach (zen_get_orders_status() as $value) {
        echo '<span>|</span>';
        //print_r( $value);
        echo '<a ' . (((int)$_GET['pull_status'] == $value['id']) ? 'class="selected"': '') . 'href="' . zen_href_link(FILENAME_EL_PDFOC, 'pull_status=' . $value['id']). '">' . $value['text'] . '</a>';
    }
    echo '</div>';
}
*/
?>
<!--eof PDFOC orders statuses //--><table border="0" cellpadding="3" cellspacing="0" width="100%">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">

<?php
// Split page when more results than fit on one page
//
// First: reset page when page is unknown
//
if (($_GET['page'] == '' or $_GET['page'] <= 1) and $_GET['oID'] != '') {
  $check_page = $db->Execute($orders_query);
  $check_count=1;
  if ($check_page->RecordCount() > PDFOC_ORDERLISTINGMAX_DEFAULT) {
    while (!$check_page->EOF) {
      if ($check_page->fields['orders_id'] == $_GET['oID']) {
        break;
      }
      $check_count++;
      $check_page->MoveNext();
    }
    $_GET['page'] = round((($check_count/PDFOC_ORDERLISTINGMAX_DEFAULT)+(fmod_round($check_count,PDFOC_ORDERLISTINGMAX_DEFAULT) !=0 ? .5 : 0)),0);
  } else {
    $_GET['page'] = 1;
  }
}
// get db results for the current page
// and display selected order row as such
//
//echo  $orders_query;
    $orders_split = new splitPageResults($_GET['page'], PDFOC_ORDERLISTINGMAX_DEFAULT, $orders_query, $orders_query_numrows);
    $orders = $db->Execute($orders_query);


      $heading=array();
      $contents=array();

      // Set up the top box displaying order information for the selected order in
      // the orders list below

      // Get the selected order
      //
	  if ( $orders->EOF )
		 echo '&nbsp;&nbsp;&nbsp;<a href="el_orders.php?oID=0&action=edit&force_db='.$_SESSION['source_db'].'" target=_new>Nouvelle pièce</a>';

      while (!$orders->EOF) {
        if ((!isset($_GET['oID']) || (isset($_GET['oID']) && ($_GET['oID'] == $orders->fields['orders_id']))) && !isset($oInfo)) {
          $oInfo = new objectInfo($orders->fields);
        }
        $orders->MoveNext();
      }

      if (isset($oInfo) && is_object($oInfo)) {
//echo $oInfo->orders_id;exit;

        $order = new order($oInfo->orders_id);

        // add in OTFIN stuff here: verify_credit, verify_debit
        //
        $verify_debit = $db->Execute("select * from " . TABLE_ORDERS_INVOICES . " where  order_total<>0 AND orders_id = '" . $oInfo->orders_id . "'");

        $heading[] = array('text' => '<strong>[' . $oInfo->orders_id . ']&nbsp;&nbsp;' . zen_datetime_short($order->info['date_purchased']) . '</strong>');

        // set up left-hand side of order infoBox
        //
		echo '  
<SCRIPT LANGUAGE="JavaScript">
function makefile(){
	var fso;var thefile;
	fso = new ActiveXObject("Scripting.FileSystemObject");
	
	thefile=fso.CreateTextFile("C:\\\\TEMPUPS\\\\cmd_'.$oInfo->orders_id.'.xml",true);
    thefile.writeline(document.tags.ups_xml.value);
	
	thefile.close();
    alert(\'Le fichier est crée.\');	
}
  </SCRIPT>';
        $ups_xml = get_xml_ups($oInfo->orders_id,$_SESSION['source_db']);
        $ups_xml = '   <?xml version="1.0" encoding="UTF-8"?>
						<OpenShipments xmlns="x-schema:OpenShipments.xdr">'. $ups_xml .'</OpenShipments>';

		echo '<form name="tags"> <input type="hidden" name="ups_xml" value="'.str_replace('"',"'",$ups_xml).'"></form>';

        $contents[] = array('text' => PDFOC_TEXT_DATE_ORDER_LAST_MODIFIED . ' ' . (zen_not_null($order->info['last_modified']) ? zen_date_short($order->info['last_modified']) : 'n/a'));
        $contents[] = array('text' => 'Informations pièce:&nbsp;&nbsp;&nbsp;&nbsp;'.$verify_debit->fields['invoice_type'] . ' ' . (!$verify_debit->EOF ? zen_date_short($verify_debit->fields['invoice_date']) . ' #' . $verify_debit->fields['orders_invoices_id'] : 'n/a').'  <a href="javascript:makefile()">UPS</a>  ');
        $contents[] = array('text' => '<br />Client:&nbsp;&nbsp;&nbsp;&nbsp;' .$order->customer['id'] . ' - ' . $order->customer['company']. ' - ' . $order->customer['name'] );
        $contents[] = array('text' => 'Email:&nbsp;&nbsp;&nbsp;&nbsp;' . $order->customer['email_address'] . " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tel:  ". $order->customer['telephone'] );
        $contents[] = array('text' => PDFOC_TEXT_INFO_PAYMENT_METHOD . ' '  . $order->info['payment_method'] . "&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;" . PDFOC_TEXT_INFO_SHIPPING_METHOD . ' '  . $order->info['shipping_method'] );

      $lhblock = new tableBlock($contents);
      $lhcontents = $lhblock->tableBlock($contents);

      // set up right-hand side of order infoBox
      //
//  echo   '<form name="shipping_sheet" target=_new action="ezl_rtf_bl.php?numCommandes='. $oInfo->orders_id.'&lg_code=2&source_db=eu">';

      $contents = array();
//	  $contents[] = array('text' => '</form><form name="shipping_sheet" target=_new action="ezl_rtf_bl.php?numCommandes='. $oInfo->orders_id.'&lg_code=2&source_db=eu">' );
   // ?numCommandes='. $oInfo->orders_id.'&lg_code=2&source_db=eu
 
//  $contents[] = array('text' => '<form name="shipping_sheet" target=_new action="rtf/ezl_rtf_bl.php"  method="get">' );
//  $contents[] = array('text' => '<input type="hidden" name="numCommandes" value="'.$oInfo->orders_id.'">' );
//  $contents[] = array('text' => '<input type="hidden" name="lg_code" value="2">' );
//  $contents[] = array('text' => '<input type="hidden" name="source_db" value="eu">' );
  
//<form name="pdfoc_selection" action="el_gestion.php" method="get"
      $contents[] = array('text' => '<b>' . PDFOC_TEXT_PRODUCTS_ORDERED . sizeof($order->products) . '</b>' );

      for ($i=0; $i<sizeof($order->products); $i++) 
	  {
         
		$add_checks = "";
		 
		if ( false  )
		{
		  $input_check = '&nbsp;&nbsp;<input type="checkbox" name="prdList[]"  CHECKED size=1 value="'.$order->products[$i]['model']. '">';
		  for ($j=0; $j<$order->products[$i]['qty']; $j++) 
		  {		  
			$add_checks .= $input_check;
		  }
	    }	  

		
        $contents[] = array('text' => $order->products[$i]['qty'] . '&nbsp;x&nbsp;' . $order->products[$i]['name'].$add_checks);

        if ($i > MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING and MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING != 0) {
          $contents[] = array('align' => 'left', 'text' => TEXT_MORE);
          break;
        }
      }
//	  $contents[] = array('text' =>  '<INPUT TYPE="submit" value="Produire BL">');
//	  $contents[] = array('text' =>  '</form>');
	  
      $rhblock = new tableBlock($contents);
      $rhcontents = $rhblock->tableBlock($contents);
	  
	  // FV  
      $order_status = $db->Execute("select orders_status from orders where orders_id = '" . $oInfo->orders_id . "'");	  
	  $status = $order_status->fields['orders_status'];
	  if (  $may_change_order == 0 )
	  {
	      echo '<tr>
		        <td colspan=3 align="center">';
	      echo '<a href="edit_frame.php?oID=' . $oInfo->orders_id  . '&source_db='.$_SESSION['source_db'].'&languages_id='.$languages_id.'&orders_status=' .$status . '&action=edit" target=_new>Détail pièce</a>';
          echo '</tr>';
	  }
	  else
	  {
//		  if  (   ( $_SESSION['source_db']=="gl"  )
//	           	  || (  ( $status <> 3 )  )
//			  )
          if ( true )
		  {	  
			  // FV  
		      $order_lg = $db->Execute("select languages_id, database_code from orders where orders_id = '" . $oInfo->orders_id . "'");	  
			  $languages_id = $order_lg->fields['languages_id'];

		  //  preview link	  
			  echo '</form><tr><td align="left">	  
				<form name="pdfoc_action" action="el_gestion.php?form=action" method="post" target=_new>
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
				<input type="hidden" name="force_db" value="'. $_SESSION['source_db'] .'">			
				<input type="hidden" name="ord_id" value="'.$oInfo->orders_id.'">
				<input type="hidden" name="notify_comments"  value="1">
				</form>	  </td>
			  <td>
			    <a href="edit_frame.php?oID=' . $oInfo->orders_id  . '&source_db='.$_SESSION['source_db'].'&languages_id='.$languages_id.'&orders_status=' .$status . '&action=edit" target=_new><img border=0 src="button_edit.gif"></a>';
             if (  ! ( ($_SESSION['admin_id']==2) && ($_SESSION['source_db']=="gl") ) )
			 {
    			 echo '&nbsp;&nbsp;&nbsp;<a href="el_orders.php?oID=0&action=edit&force_db='.$_SESSION['source_db'].'" target=_new>Nouvelle pièce</a>';
	         }		 
			 echo '</td>';
		  }
		  else
		  {
		      echo '</form><td> &nbsp; </td><td> 
			  &nbsp;&nbsp;&nbsp;<a href="el_orders.php?oID=0&action=edit&force_db='.$_SESSION['source_db'].'" target=_new>Nouvelle commande</a>
			  </td>';
		  }
	  
		  if  ( ( $_SESSION['source_db']!="gl"  ) && ( $status <> 3  ) && ( $_SESSION['admin_id'] <> 2  ) )
		  {
			  $choix_partiel = '<input type="radio" name="status" value="1">Bon de livraison';	  
	          if  ( $oInfo->orders_status==4 )
			  {
			    $choix = '';
			    $choix_partiel = '<input type="radio" name="status"  CHECKED value="1">Un BL';
			  }
	    	  else if  ( $_SESSION['source_db']=="eu" )
			  {
			    $choix = '
	 			<input type="radio" name="status" value="3">Facture payée &nbsp;|&nbsp;
				<input type="radio" name="status" value="2" Checked>Facture envoyée &nbsp;|&nbsp;';
			  }
			  else
			  {
			    $choix = '
	 			<input type="radio" name="status" value="3" Checked>Facture payée &nbsp;|&nbsp;
				<input type="radio" name="status" value="2">Facture envoyée &nbsp;|&nbsp;';
			  }
			  // 
			  if ( $_SESSION['source_db']!= "eu"  )
			  {
			      $chk = 'CHECKED';
			  }
			  echo '<td align="right">
				<form name="pdfoc_action" action="el_gestion.php?form=action" method="post" target=_new>'
				.  $choix . $choix_partiel .
				'<input type="submit" name="submit_action" value="Produire">&nbsp;Mail Client<input type="checkbox" '.  $chk . ' name="notify" value="1"></td>
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
				<input type="hidden" name="ord_id" value="'.$oInfo->orders_id.'">
				<input type="hidden" name="notify_comments"  value="1">
				</form>	  
			  </td></tr>';
		  }
		  else
		  {
			   $invoice_id =  get_invoice_id($oInfo->orders_id, 'DB',0);
			   $fname =   $invoice_id . '_' . $oInfo->orders_id . FILENAME_PDFOC_PDF;
		  
		     echo '<td align="right">
			         <a href="' . DIR_PDFOC_PDF .$fname.'" target=_new>Consulter la facture</a>
				    </td>
					</tr>';
		  }
 	  }

	  
//      echo zen_draw_form('pdfoc_selection', 'el_gestion.php', 'form=selection','post','',true);
	   
      $contents = array();
      $contents[] = array('text' => $lhcontents . '</td><td  colspan=2 class="infoBoxContent" valign="top">' . $rhcontents);

     } // EOIF isset($oInfo)


  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
?>
         <tr>
            <td width="100%" valign="top" colspan=3>
<?php
    $box = new box;
    echo $box->infoBox($heading, $contents);
    echo '            </td>' . "\n";
    echo '          </tr>' . "\n";

  }
?>
            </table></td>
          </tr>
          <tr>
            <td width="100%"><?php echo zen_image(DIR_WS_IMAGES . 'pixel_black.gif','','100%','2'); ?></td>
          </tr>
<!--// set up form for checkboxes for orders to select
    //-->
        <form name="pdfoc_selection" action="el_gestion.php" method="get"><input type="hidden" name="form" value="selection">
     	<tr>
               <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                 <tr class="dataTableHeadingRow">
                   <td class="dataTableContent" colspan="7"><b>
		   <?php 
         echo  'Produit&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="critere_produit" value="'.$_SESSION['critere_produit'].'">';		   
		 $html_zone =  '<select name="zone_geo">
		                  <option value="">Toutes 		 
		                  <option value="fr">France 
		                  <option value="sp">Espagne
		                  <option value="de">Allemagne
		                  <option value="uk">Royaume uni  
		                  <option value="it">Italie
		                  <option value="eu">Autres Europe
		                  <option value="ot">Monde hors Europe						  
						  <option value="un">Non précisé 
		               </select>';
			echo "&nbsp;&nbsp;Zone géographique: ";
			echo  eregi_replace('"'.$_SESSION['zone_geo'].'"' , '"'.$_SESSION['zone_geo'].'" SELECTED' ,$html_zone ); 
			
		   ?>
				   </b></td>
                   <td class="dataTableContent" colspan="7" align="right" >
	   <?php
	     if (  $_SESSION["what"]=="prd"  )
		 {
		    $query_id = 2;
		 }
		 else if (  $_SESSION["what"]=="rc"  )
		 {
		    $query_id = 3;		 
		 }	   
		if ( $_SESSION['source_db']=="gl" )
		{
			echo '<a href="../extractions/el_excel_outputs.php?query_id='.$query_id.'&where_id='.$where_id. '" target=_new>Fichier Excel</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		}
	    $htmlWhat = '<select name="what">
					  <option value="cmm">Vue commerciale
					  <option value="gl">Vue comptable
					  <option value="rc">En cours facturation
					  <option value="prd">Vue produits
					</select>';
		// 					  <option value="cmd">En cours commande					  
	    echo   eregi_replace('"'.$_SESSION['what'].'"' , '"'.$_SESSION['what'].'" SELECTED' ,$htmlWhat ); 
	   ?>
					&nbsp;&nbsp; <input type="submit" name="submit" value="Recherche" />
				   </td>
         </tr>
                 <tr>
                   <td class="dataTableContent">Données</td>
				   <?php
				   $html_string ='
                   <td class="dataTableContent">
                      <select name="source_db">';
					  
					 if ( $questionc ) 	 				 
            	       $bds = array("gl","ns");
					 else
    				   $bds = array("gl","eu","fr","es","de","en","it","bf");
					 
					  
					 foreach ($bds as $dtb) 
					 {
						$html_string .= '<option value="'.$dtb.'">'.$ext_db_name[$dtb];
					 }
                     $html_string .= '</select>';
					  echo eregi_replace('"'.$_SESSION['source_db'].'"' , '"'.$_SESSION['source_db'].'" SELECTED' ,$html_string );
                      ?>
                   </td>

                   <td class="dataTableContent">Num de cmd</td>
                   <td class="dataTableContent"><?php echo zen_draw_input_field('order_numbers',$_SESSION['order_numbers'],'size=7'); ?></td>
                   <td bgcolor=gray class="dataTableContent"><font color=white>Date..</font></td>
                   <td bgcolor=gray class="dataTableContent">
        		<?php 
					$html_select = '<select name="type_date">
					                <option value="CMD">Commande.
									<option value="FAC">Facture.
									<option value="PAY">Paiement.												
									<option value="PAN">Sans pai.																					
									</select>';
									
		            echo eregi_replace('"'.$_SESSION['type_date'].'"' , '"'.$_SESSION['type_date'].'" SELECTED' ,$html_select );						   
            		?>				   				   

					</td>				   
                   <td bgcolor=gray class="dataTableContent"><font color="white">De:</font></td>
                   <td class="dataTableContent"><script language="javascript">dateAvailable.writeControl(); dateAvailable.dateFormat="dd-MM-yyyy";</script></td>
                   <td class="dataTableContent">Montant</span></a></td>
                   <td class="dataTableContent"> <?php echo zen_draw_input_field('montant',$_SESSION['montant'],'size=7'); ?> </td>
				   
				   <td class="dataTableContent">Type Pièce</td>
				   <td class="dataTableContent">
		<?php 				 
		   $html_select = '<select name="type_piece">
						   <option value="FA">Tout sauf BL
		                   <option value="T">Tout
						   <option value="BL">BL uniquement
						   </select>';
		     echo eregi_replace('"'.$_SESSION['type_piece'].'"' , '"'.$_SESSION['type_piece'].'" SELECTED' ,$html_select );						   
		?></td>				   
				   <td class="dataTableContent">ID Pièce</td>
				   <td class="dataTableContent"><?php echo zen_draw_input_field('numero_facture',$_SESSION['numero_facture'],'size=10'); ?></td>				   
                 </tr>
                 <tr>
                 <tr>
                   <td class="dataTableContent">ID client</td>
                   <td class="dataTableContent">
                      <input type="text" name="customer_id" size="10" value="<?php echo $_SESSION['customer_id']; ?>">
                   </td>                                    
                   <td class="dataTableContent">nom, email...</td>
                   <td class="dataTableContent"><?php echo zen_draw_input_field('customer_data',$_SESSION['customer_data'],'size=10'); ?></td>
                   <td class="dataTableContent">Paiement</td>				   
                   <td class="dataTableContent">
        		<?php 
					$html_select = '<select name="type_paiement">
                                                <option value=""> 
                                                <option value="cc">Carte créd.
                                                <option value="paypal">Paypal												
												<option value="OTH">Vir. Ch.
												</select>';
									
		            echo eregi_replace('"'.$_SESSION['type_paiement'].'"' , '"'.$_SESSION['type_paiement'].'" SELECTED' ,$html_select );						   
            		?>					   
				                                
				   </td>				   				   
                   <td bgcolor=gray class="dataTableContent"><font color="white">A:</font></td>
                   <td class="dataTableContent"><script language="javascript">dateAvailable1.writeControl(); dateAvailable1.dateFormat="dd-MM-yyyy";</script></td>
				   <td class="dataTableContent">Status</td>
                   <td class="dataTableContent"><?php echo zen_draw_pull_down_menu('el_pull_status', $orders_statuses, $_SESSION['el_pull_status'] ); ?></td>
				   <td class="dataTableContent">Site/ref</td>
				   <td class="dataTableContent">
				   <?php  
                     $html_string = '<select name="site_internet">
                                     <option value="to">Tous';
									 
					 if ( $questionc )
    					$bds = array("ns");					  
					 else
						$bds = array("eu","fr","es","de","en","it","bf");					  
						
					 foreach ($bds as $dtb) 
					 {
						$html_string .= '<option value="'.$dtb.'">'.$ext_db_name[$dtb];
					 }
                     $html_string .= '</select>';
					  echo eregi_replace('"'.$_SESSION['site_internet'].'"' , '"'.$_SESSION['site_internet'].'" SELECTED' ,$html_string );
					  echo '<input type=text name="ref_cmd" value="'. $_SESSION['ref_cmd'] .'" size=3>';
                      echo '</td>';
				   ?>
				   <td class="dataTableContent">Tri</td>
				   <td class="dataTableContent">
				   <?php  
					  $html_string = '<select name="critere_tri">';					 
					  $html_string .= '<option value="">
					                   <option value="DATEFDESC">Date piece invers
                   					   <option value="DATEF">Date piece 
                   					   <option value="RETARD">Retard paiement 		
                   					   <option value="RETARDDESC">Retard paiement invers									   									   
					                   <option value="DATEPDESC">Date paiement invers
                   					   <option value="DATEP">Date paiement									   
                                       <option value="NUMFDESC">Num piece invers									   
                   					   <option value="NUMF">Num piece
                                       <option value="DATECDESC">Date cmd invers
                   					   <option value="DATEC">Date cmd 			
                   					   <option value="MONTANT">Montant									   
                   					   <option value="SOCIETEDATE">Société,date p
									   <option value="TYPEPIECE">Type de pièce
									   <option value="MOYENPAIEMENT">Moyen de paiement
									   <option value="CONDITIONSPAIEMENT">Conditions de paiement
									   <option value="SITESOURCE">Site source						   
									   ';
					  $html_string .= '</select>';
					  echo eregi_replace('"'.$_SESSION['critere_tri'].'"' , '"'.$_SESSION['critere_tri'].'" SELECTED' ,$html_string );


		   echo '<script language="javascript">
				 document.pdfoc_selection.startdate.value=\''.$_SESSION['startdate'].'\'; document.pdfoc_selection.enddate.value=\''.$_SESSION['enddate'].'\';
		         </script>';					  
				      
				   ?>
				   </td>				   
				   
                 </tr>
               </table></td>
          </tr>
          <tr>
            <td width="100%"><?php echo zen_image(DIR_WS_IMAGES . 'pixel_black.gif','','100%','2'); ?></td>
          </tr>
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="dataTableContent" colspan="5" align=left>
		<?php
//echo 'init_batch'.$_SESSION['init_batch'].'|'.$_SESSION['active_batches'];		
		  if ( strlen ( $_SESSION['active_batches'] )>0 )
		  {
		    $batches=explode(',',$_SESSION['active_batches']);
		    for($k=0;$k<count($batches);$k++)
			{
				echo '&nbsp;&nbsp;<input type="submit" name="use_selected_orders" value="+ '. $batches[$k] .'" />';
			}
		  }
          echo "&nbsp;&nbsp;&nbsp;<a href=\"javascript:popupWindow('el_gestion_batch.php','scrollbars=yes,resizable=yes,width=820,height=700,screenX=150,screenY=300,top=100,left=150');\">";
				   echo "Modification/Ajout";
				   echo "</a>";				   
          echo "&nbsp;&nbsp;&nbsp;<a href=\"javascript:popupWindow('el_batch_action.php','scrollbars=yes,resizable=yes,width=700,height=400,screenX=150,screenY=300,top=100,left=150');\">";
				   echo "Extraction/Facturation";
				   echo "</a>";				   
				   
		  ?>
				</td>
				</td>
                <td class="smallText" colspan=3 align="right" >
                <?php
echo TEXT_LEGEND . ' '
				 // ----- BOF OTFIN -----
				 . '&nbsp;&nbsp;&nbsp;&nbsp;' . zen_image(DIR_WS_IMAGES . 'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . ' Facture' .
 				 '&nbsp;&nbsp;&nbsp;&nbsp;' . zen_image(DIR_WS_IMAGES . 'icon_status_yellow.gif', IMAGE_ICON_STATUS_YELLOW, 10, 10) . ' Avoir' .
 				 '&nbsp;&nbsp;&nbsp;&nbsp;' . zen_image(DIR_WS_IMAGES . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_YELLOW, 10, 10) . ' BL' .
 				 '&nbsp;&nbsp;&nbsp;&nbsp;' . zen_image(DIR_WS_IMAGES . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_YELLOW, 10, 10) . ' Proforma' 				 
				 // ----- EOF OTFIN -----
				 ;				
                ?>				
              </tr>
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="center">
				<?php 
				 echo '<input type=checkbox name="precheck">'; 
				 //echo $_GET['precheck'];
				 ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo PDFOC_TABLE_HEADING_ORDERS_ID; ?></td>
                <td class="dataTableHeadingContent">Client</td>
<?php
   if  ( $_SESSION["what"]=="rc" )
	{
	   echo   '<td class="dataTableHeadingContent" align="center">Telephone</td>';		
	   echo   '<td class="dataTableHeadingContent" align="center">email</td>';	
	}
?>	
                <td class="dataTableHeadingContent" align="right">Total</td>
                <td class="dataTableHeadingContent" align="center">Commandé le</td>
                <td class="dataTableHeadingContent" align="center">Date pièce</td>				
                <td class="dataTableHeadingContent" align="left">Mode paiement</td>								
<?php	
    if ( $_SESSION["what"]=="prd" )
	{
	   echo   '<td class="dataTableHeadingContent" align="center">Ref</td>';		
	   echo   '<td class="dataTableHeadingContent" align="center">Description produit</td>';	
	   echo   '<td class="dataTableHeadingContent" align="center">Qté</td>';		   
	   echo   '<td class="dataTableHeadingContent" align="center">Prix</td>';		   	   
	}	
    else if ( $_SESSION["what"]=="gl" )
	{
	   echo   '<td class="dataTableHeadingContent" align="center">Payé le</td>';	
	   echo   '<td class="dataTableHeadingContent" align="center">Ref Paiement</td>';		   
	   echo   '<td class="dataTableHeadingContent" align="center">Montant Payé</td>';		   	   
	}	
    else if ( $_SESSION["what"]=="rc" )
	{
	    echo   '<td class="dataTableHeadingContent" align="center">Retard</td>';
	}
	else
	{
	    echo   '<td class="dataTableHeadingContent" align="center">Rp</td>';
	}

?>				
                <td class="dataTableHeadingContent" align="right"><?php echo PDFOC_TABLE_HEADING_STATUS; ?></td>
              </tr>

<?php

    // reset orders query result to beginning
    //
    $orders = $db->Execute($orders_query);
    $list_orders_end = $orders->fields['orders_id'];

    while (!$orders->EOF) {

      $show_status_dots = '';

      // ----- BOF OTFIN -----
      // Check if a final invoice and/ or credit has been created
      //
	  $orders_invoices_id = $orders->fields['orders_invoices_id'];
	  $invoice_type = $orders->fields['invoice_type'];
	  $invoice_date = zen_date_short($orders->fields['invoice_date']);
      $payment_info = $orders->fields['payment_info'];
	  $show_status_dots = "";

	  //icon_status_green_light.gif
		  
	  if ($invoice_type == 'DB' )	      
		 $icon_name = 'icon_status_green.gif';
	  else if ($invoice_type == 'CR' )
		 $icon_name = 'icon_status_yellow.gif';
	  else if ($invoice_type == 'PF' )
		 $icon_name = 'icon_status_red_light.gif';
	  else if ($invoice_type == 'BL' )
		 $icon_name = 'icon_status_green_light.gif';
		 
	  if ( strlen($invoice_type)>0 )
	  {
    	  $show_status_dots .=  $orders_invoices_id . '&nbsp;'. zen_image(DIR_WS_IMAGES . $icon_name , IMAGE_ICON_STATUS_YELLOW, 10, 10) . '&nbsp;'; 
      }
	  
      $linked_pieces = "";
	  
      // les elements miés
      $verify_links = $db->Execute("select * from " . TABLE_ORDERS_INVOICES . " where order_total<>0  AND ref_orders_id <> orders_id  AND  ref_orders_id = '" . $orders->fields['orders_id'] . "'");
      while ( ! $verify_links->EOF )
      {
	      $invoice_type = $verify_links->fields['invoice_type'];
		  if ($invoice_type == 'DB' )	      
			 $icon_name = 'icon_status_green.gif';
		  else if ($invoice_type == 'CR' )
			 $icon_name = 'icon_status_yellow.gif';
		  else if ($invoice_type == 'PF' )
			 $icon_name = 'icon_status_red_light.gif';
		  else if ($invoice_type == 'BL' )
			 $icon_name = 'icon_status_green_light.gif';
			 
			 
    	  $linked_pieces .= ' ' . zen_image(DIR_WS_IMAGES . $icon_name , "", 10, 10);
			 
		 $verify_links->MoveNext();
      }	  
	  $cust_id_linked = '<a href="javascript:popupWindow(\'encours_detail.php?customers_id='. $orders->fields['customers_id'] .'&customer_db='.$orders->fields['database_code'] .'\');">'. $orders->fields['customers_id']."</a>";

	  if ( strlen($orders->fields['billing_company'])>0 )
	  {
         $customer_info =  $orders->fields['billing_company']. ' - ' . $orders->fields['billing_name'];
	  }
      else
	  {	  
         $customer_info =  $orders->fields['billing_name'];
	  }	  
	  if ( strlen($customer_info) > 35 )
	  {
		$customer_info = substr($customer_info,0,35).'...';
	  }
	  
	  $customer_info = $cust_id_linked . ' - '  . $customer_info . $linked_pieces;
 	 // $customer_info .= $payment_info;
	   if ( strlen($tickets[$orders->fields['customers_id']])>0 )
	   {
		  $customer_info .=  '&nbsp;&nbsp;';
		  $customer_info .=  $tickets[$orders->fields['customers_id']];
	   }
	  
	  if (  strlen($orders->fields['ref_info'])>0  )
         $ref_info = substr($orders->fields['ref_info'],0,15) ;
      else
         $ref_info = $orders->fields['orders_id'] ;

	  $link = 'onclick="document.location.href=\'' .zen_href_link(FILENAME_EL_PDFOC, 'oID='. $orders->fields['orders_id'] .'&source_db='. $_SESSION['source_db'] .'&action=el_refresh&form=selection', 'NONSSL').'\'"';	 
      // only show orders with non-zero status (those are premature orders created by some payment methods, and are not valid orders)
      // form=selection&	  

	  if ( $orders->fields['payment_module_code']=='authorizenet')
	  {
	     if (  $orders->fields['database_code'] == "eu" )
		 {
		    $payment_code = "CHK VIR 30JN";
		 }
		 else
		 {
		    $payment_code = "CHK";		    
		 }		 
	  }
	  else
	  {
	     $payment_code = $orders->fields['payment_module_code'];
	  }
      if (isset($orders->fields['orders_status']) && $orders->fields['orders_status']>0) 
	  {
	     if  ( isset($_SESSION['selected_batch_id'])
               && ( strpos($_SESSION['selected_batch_items'], $orders->fields['orders_id'])>0 ) )
		 {
		   $linepres = ' class="dataTableRowSelectedWhois" ';
		 }	
         else if (isset($oInfo) && is_object($oInfo) && ($orders->fields['orders_id'] == $oInfo->orders_id)) 
		 {
		   $linepres = 'id="defaultSelected" class="dataTableRowSelected"';
		 }
		 else
		 {
		   $linepres = 'class="dataTableRow"';
		 }
	   echo '              <tr ' . $linepres . '  onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n" .
			'                 <td class="dataTableContent" align="right">' . zen_draw_checkbox_field("orderlist[]",$orders->fields['orders_id'],true) . 
			'</td>'  . "\n" .
			'                 <td class="dataTableContent" align="right" ' . $link .  ' >' . $show_status_dots . $ref_info . '</td>' . "\n" .
			'                 <td class="dataTableContent" ' . $link .  '>
			&nbsp;' . $customer_info . '</td>
			';
			
	    if ($_GET['what']=='rc')
		{
		   echo   '<td class="dataTableContent" align="center">' . $orders->fields['customers_telephone'] .  ' </td>';
		   echo   '<td class="dataTableContent" align="center">' . $orders->fields['customers_email_address'] .  '</td>';
		}
		
		echo '                 <td class="dataTableContent" align="right" ' . $link .  '   >' . strip_tags($orders->fields['order_total']) . '</td>' . "\n" .
			'                 <td class="dataTableContent" align="center" ' . $link .  ' >' . zen_date_short($orders->fields['date_purchased']) . '</td>' . "\n" .
			'                 <td class="dataTableContent" align="center" ' . $link .  '  >' . $invoice_date . '</td>' . "\n" .
			'                 <td class="dataTableContent" align="left"  ' . $link .  ' >' . $payment_code . '&nbsp;' . $orders->fields['payment_conditions_code'] . '</td>' . "\n" .
			'                 <td class="dataTableContent" align="center"  ' . $link .  ' >';
		    if ( $_SESSION["what"]=="prd" )
			{
			   echo $orders->fields['products_model'];
			   echo  '</td>' . "\n";
			   
			   echo  '<td class="dataTableContent" align="left"  ' . $link .  ' >';
    		   echo  $orders->fields['products_name'];	
			   echo  '</td>' . "\n";			

			   
			   echo  '<td class="dataTableContent" align="right"  ' . $link .  ' >';
    		   echo  $orders->fields['products_quantity'];	
			   echo  '</td>' . "\n";			
			   
			   echo  '<td class="dataTableContent" align="right"  ' . $link .  ' >';
    		   echo  round($orders->fields['final_price']);	
			   echo  '</td>' . "\n";						   
            }
		    else if ( $_SESSION["what"]=="gl" )
			{
			   echo zen_date_short($orders->fields['orders_date_finished']);
			   echo  '</td>' . "\n";

			   echo  '<td class="dataTableContent" align="left"  ' . $link .  ' >';
    		   echo  $orders->fields['payment_info'];	
			   echo  '</td>' . "\n";			
			   
			   echo  '<td class="dataTableContent" align="left"  ' . $link .  ' >';
    		   echo  $orders->fields['payment_amount'];	
			   echo  '</td>' . "\n";			
			   
			}
		    else if ( $_SESSION["what"]=="rc" )
			{
			//orders_date_finished
			   //echo  '<td class="dataTableContent" align="right"  ' . $link .  ' >';
    		   echo  $orders->fields['retard'];	
			   //echo  '</td>' . "\n";						   
			}			
		    else
			{
			//orders_date_finished
				echo "<a href=\"javascript:popupWindow('super_edit.php?oID=". $orders->fields['orders_id'] ."&target=payment_mode','scrollbars=yes,resizable=yes,width=400,height=400,screenX=150,screenY=300,top=100,left=150');\">";			
				if (strlen($orders->fields['payment_info'])>0)
				{
				   echo 'X';
				}
				else
				{
				   echo '-';			
				}
				echo '</a>';
			   
			}


			echo  '</td>' . "\n";
			echo  '                 <td class="dataTableContent" align="right" ' . $link .  '>' . $orders_status_array[$orders->fields['orders_status']] . '</td>' . "\n".
			'              </tr>';

			$list_orders_begin = $orders->fields['orders_id'];
	  }
      $orders->MoveNext();
    }
?>
         <input type="hidden" name="orders_begin" value="<?php echo $list_orders_begin; ?>" />
         <input type="hidden" name="orders_end" value="<?php echo $list_orders_end; ?>" />
         </form>
        <!--// show links to prev/next page of results
            //-->
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $orders_split->display_count($orders_query_numrows, PDFOC_ORDERLISTINGMAX_DEFAULT, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_ORDERS); ?></td>
                    <td class="smallText" align="right"><?php echo $orders_split->display_links($orders_query_numrows, PDFOC_ORDERLISTINGMAX_DEFAULT, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
					</tr>
                </table></td>
              </tr>

       </table></td>
     </tr>
   </table></td>
 </tr>

