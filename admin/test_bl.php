<?php

  require('includes/application_top.php');
  require('el_fonctions_gestion.php');

function apply_track_update($carrier,$order_id,$track,$status)
{
    global $source_catalog;
	global $orders_id;
	global $ext_db_database;
	global $ext_bd_root;
	global $db;
	
    global $track_cnt_ups;
	global $track_cnt_dhl;
    global $track_cnt_collissimo;
	
	
	$bds = array("eu","fr","es","de","en","it","bf","hp","rq","hp");
 
//echo  $carrier. '|' .$order_id. '|' .$track. '<br>';
 
	 $cnt = 0;
	 
	 foreach ($bds as $dtb) 
	 {
		$sql = "select 1 value from ".$ext_db_database[$dtb].".orders where orders_id = ".$order_id;
echo $carrier.'111111'.$sql.'<br>';
		$chk = exec_select ( $sql);
		if ($chk==1)
		{
			$sql2 = "select 1 value 
								   from ".$ext_db_database[$dtb].".orders_status_history
								   where  orders_id = ".$order_id ." 
								   and comments like '%::%' ";		
								   
								   
			$chk2 = exec_select ( $sql2 );
			
//echo $carrier.'JJ'. $chk2  .'2222'.$sql2.'<br>';
			
			// if (!$chk2)
//			if (true)			
			if (!$chk2)
			{				
				$dml = 'delete from '.$ext_db_database[$dtb].'.orders_status_history
						where orders_id = '. $order_id .'
						and comments like "%::%"
						and date_format(date_added,"%Y-%c-%d")=date_format(now(),"%Y-%c-%d")';
				$db->Execute($dml);			

				$sql1 = "select languages_id value from ".$ext_db_database[$dtb].".orders where orders_id = ".$order_id;
				$languages_id = exec_select($sql1);
				
				
				if ( $carrier=='UPS' )
				{				
					// Lien en fonction de la langue
					if($languages_id == '2')					
						{$check_url = "http://wwwapps.ups.com/etracking/tracking.cgi?&loc=fr_fr&tracknum=".$track;	}					
					else if($languages_id == '5')					
						{$check_url = "http://wwwapps.ups.com/etracking/tracking.cgi?&loc=en_en&tracknum=".$track;	}										
					else if($languages_id == '6')					
						{$check_url = "http://wwwapps.ups.com/etracking/tracking.cgi?&loc=it_it&tracknum=".$track;	}					
					else if($languages_id == '3')					
						{$check_url = "http://wwwapps.ups.com/etracking/tracking.cgi?&loc=es_es&tracknum=".$track;	}					
					else if($languages_id == '4')					
						{$check_url = "http://wwwapps.ups.com/etracking/tracking.cgi?&loc=de_de&tracknum=".$track;	}					
					
					
					$comment = $carrier . "  tracking number:: ".$track. " check URL::".$check_url;			
					$track_cnt_ups++;
				}
				else if ( $carrier=='DHL' )
				{
					if($languages_id == '2')
						{$check_url = "http://www.dhl.com/content/g0/en/express/tracking.shtml?brand=DHL&AWB=".$track;}
					
					else if($languages_id == '5')					
						{$check_url = "http://www.dhl.com/content/g0/en/express/tracking.shtml?brand=DHL&AWB=".$track;	}
					
					else if($languages_id == '6')					
						{$check_url = "http://www.dhl.it/content/it/it/express/ricerca.shtml?brand=DHL&AWB=".$track;	}
					
					else if($languages_id == '3')					
						{$check_url = "http://www.dhl.es/services_es/seg_3dd/integra/SeguimientoDocumentos.aspx?codigo=".$track . "&anno=".date("Y")."&lang=sp";	}
					
					else if($languages_id == '4')					
						{$check_url =
						"http://www.dhl.de/content/de/de/express/sendungsverfolgung/express-suchergebnisse.cache.html?lang=de&searchType=tracking&trackingEngine=international&AWB=".$track; }
					
					$comment = $carrier . "  tracking number:: ".$track. "  check URL::".$check_url;				
					$track_cnt_dhl++;
				}								   
				else if ( $carrier=='COLLISSIMO' )
				{
					//$check_url = "http://www.colissimo.fr/portail_colissimo/suivre.do?colispart=".$track;
					
					if ( $languages_id == '2')					
						{$check_url = "http://www.colissimo.fr/portail_colissimo/suivre.do?colispart=".$track;	}
					else 					
						{$check_url = "http://www.colissimo.fr/portail_colissimo/suivre.do?language=en_EN&parcelnumber=".$track;	}
					
					$comment = $carrier . "  tracking number:: ".$track. "  check URL::".$check_url;				
					$track_cnt_collissimo++;					
				}								   

//echo $comment;exit;				
		//echo 	$comment.'<br>';
				
					$dml = "insert into  ".$ext_db_database[$dtb].".orders_status_history
							( orders_id,  comments, orders_status_id, date_added ) 
						values (  " . $order_id . ",'". $comment ."',2, now() )";
					
					$db->Execute($dml);			
					
				echo 'track :: '.$track.'<br>';
				
				
		// l'envoie de l'email au clients 

				
				
//				echo $sql.'|'.$rs->fields['delivery_street_address'];
				
		// Parametres
		
/* FV on ne reconduit pas pour l'instant		
				

				$sql2 = 'select configuration_value from '.$ext_db_database[$dtb].'.configuration where configuration_key = "ALTERNATIVE_TEXT"';
				$rs2 = $db->Execute($sql2);
				$ALTERNATIVE_TEXT = $rs2->fields['configuration_value'];
				
				$sql3 = 'select  configuration_value from '.$ext_db_database[$dtb].'.configuration where configuration_key = "URL_IMAGE_MAIL"';
				$rs3 = $db->Execute($sql3);
				$URL_IMAGE_MAIL = $rs3->fields['configuration_value'];
				
				$sql4 = 'select  configuration_value from '.$ext_db_database[$dtb].'.configuration where configuration_key = "IMAGE_LINK"';
				$rs4 = $db->Execute($sql4);
				$IMAGE_LINK = $rs4->fields['configuration_value'];
				
				$sql5 = 'select  configuration_value from '.$ext_db_database[$dtb].'.configuration where configuration_key = "MAIL_IMAGE_WIDTH"';
				$rs5 = $db->Execute($sql5);
				$MAIL_IMAGE_WIDTH = (int)$rs5->fields['configuration_value'];
				echo "  </br> lien: ";
				echo 	$IMAGE_LINK;
				echo "</br>";
				echo $ALTERNATIVE_TEXT. ' '. $dtb.'  le lien de l image  '.$IMAGE_LINK.$sql2;
*/				
				

				include_once('_obj_email.php');

				$sql = "select orders_id , customers_name, customers_email_address, delivery_street_address , delivery_city , delivery_postcode , delivery_state , delivery_country , languages_id, customers_id from ".$ext_db_database[$dtb].".orders where orders_id = ".$order_id;
				$rs = $db->Execute($sql);
				
				$commande_id =$rs->fields['orders_id'];
				$street = $rs->fields['delivery_street_address'];
				$city = $rs->fields['delivery_city'];
				$postcode = $rs->fields['delivery_postcode'];
				$country = $rs->fields['delivery_country'];
				$languages_id = $rs->fields['languages_id'];
				$customers_email_address = $rs->fields['customers_email_address'];
				$customers_id = $rs->fields['customers_id'];
				
//echo 'lg'.	$languages_id ;			
                // février 2014 ajout des bons de livraison
				$sql = 'select orders_invoices.orders_invoices_id, orders.orders_id 
		from bo_gl.orders , bo_gl.orders_invoices 
		where customers_id =  '.$customers_id . '
		and orders_status = 5 
		and orders_invoices.orders_id = orders.orders_id
		and date_format(last_modified,"%Y-%c-%d")=date_format(now(),"%Y-%c-%d")		
		order by last_modified ';
		
//echo $sql;exit;		
				$rs2 = $db->Execute($sql);
				// 22995_622801batch_orders.pdf
				// http://linats.net/admin/includes/modules/pdfoc/temp_pdf/22995_622801batch_orders.pdf
/*
  	    enregistrement(s) à partir de l'enregistrement n°   
en mode   et répéter les en-têtes à chaque groupe de  	    
Textes complets
orders_id	last_modified	orders_invoices_id
622801	2014-02-12 16:01:15	22995

*/				
				$bls = '';
				
				while (!$rs2->EOF)
				{
					$orders_invoices_id = $rs2->fields['orders_invoices_id'];
					$orders_id_bl = $rs2->fields['orders_id'];
					
					$fname="pdfoc/temp_pdf/".$orders_invoices_id."_". $orders_id_bl."batch_orders.pdf";
					if (file_exists(DIR_FS_ADMIN . "/includes/modules/" . $fname )) 
					{
						$bls .= "<a href=http://linats.net/admin/includes/modules/".$fname.">";
						
						
						$PDFOC_ENTRY_BL[2] = 'Bon de livraison';
						$PDFOC_ENTRY_BL[3] =  'Orden de expedicion';
						$PDFOC_ENTRY_BL[4] =  'Lieferschein';
						$PDFOC_ENTRY_BL[5] =  'Packing list';
						$PDFOC_ENTRY_BL[6] =  'D.D.T';					
						
						$bls .=	 $PDFOC_ENTRY_BL[$languages_id]. "  " . $orders_id_bl ."</a><br>";
						
					}
					else 
					{
					   // rien  à faire
					}
					
					$rs2->MoveNext();
				}
//echo $bls . '<br><br><br><br>';
				if($languages_id == '2'){    //fr
				  $title = "Envoi de votre commande n°: ".$commande_id."";
				  $corps = "
					<p>Ch&egrave;r(e) client(e),</p>
					<p> Nous avons le plaisir de vous confirmer l'envoi de votre colis.</p>
					<p> Votre colis a &eacute;t&eacute; expidit&eacute; par  ".$carrier." sous le num&eacute;ro: ".$track." &agrave; l'adresse suivante:  </p><p>
					".$street.", ".$postcode.", 
					".$city.", ".$country.". </p>
					<p>Vous pouvez suivre l'acheminement de votre colis, jusqu'&agrave; sa livraison sur le lien: </br> 
					<a href=".$check_url.">".$check_url."</a></p>												
					<p>Pour toute demande ou question sur l'acheminement de ce colis, veuillez communiquer directement avec ".$carrier." </p>	
					" . $bls . "
					<p> Nous vous remercions pour votre confiance.</p>										
					";	
				}				
				else if($languages_id == '5'){ //en
					$title = "Sending of your order n°: ".$commande_id."";	
					$corps = "
					<p>Dear Customer, </p>
					<p> We are pleased to inform you that your package has been dispatched.  </p>
					<p> Your package has been shipped by   ".$carrier." with reference N°: ".$track." to the following address:  </p><p>
					".$street.", ".$postcode.", 
					".$city.", ".$country.". </p>
					<p>Follow the delivery of your package through the following link: </br> 
					<a href=".$check_url.">".$check_url."</a></p>													
					<p>For any request or question about the delivery, please contact directly  ".$carrier." </p>					
					" . $bls . "					
					<p> We thank you for your business.</p>
					";	
				}				
				else if($languages_id == '3')
				{ // es
				$title = " Envio de su pedido n°: ".$commande_id."";
				$corps = "
					<p>Estimado cliente,</p>
					<p> Tenemos el placer confirmarle el envio de su pedido</p>
					<p> Su pedido ha sido expedido por   ".$carrier." con el n&uacute;mero: ".$track." a la direcci&oacute;n siguiente  </p><p>
					".$street.", ".$postcode.", 
					".$city.", ".$country.". </p>
					<p>usted puede rastrear su paquete hasta su entrega en el siguiente enlace: </br> 
					<a href=".$check_url.">".$check_url."</a></p>											
					<p>Para cualquier informaci&oacute;n sobre la expedici&oacute;n de su pedido, le ruego se ponga en contacto con  ".$carrier." </p>			
					" . $bls . "					
					<p> Gracias por su confianza.</p>
					";	
					
				}				
				else if($languages_id == '4'){ // de
				  $title = "Lieferung Ihrer Bestellung n°: ".$commande_id."";
				  $corps = "
					<p>Sehr geehrter Kunde,</p>
					<p> wir sind froh den Versand Ihrer Betellung zu best&auml;tigen..</p>
					<p> Ihr Paket wurde von  ".$carrier." mit der Tracking-Nummer: ".$track." zur folgenden Adresse abgeschickt:  </p><p>
					".$street.", ".$postcode.", 
					".$city.", ".$country.". </p>
					<p>Sie k&ouml;nnen die Paketzustellung bis lieferung mit diesem Link folgen: </br> 
					<a href=".$check_url.">".$check_url."</a></p>												
					<p>Wenn Sie weitere Fragen oder Anfrage &uuml;ber die Zustellung haben, bitte nehmen Sie direkt mit ".$carrier." </p>				
					" . $bls . "					
					<p> Wir bedanken uns f&uuml;r ihr Vertrauen.</p>
					";	
				}				
				else if($languages_id == '6')
				{ //It
				  $title = "Invio il tuo ordine n°: ".$commande_id."";
				  $corps = "
					<p>Gentile cliente,</p>
					<p> Abbiamo il piacere di confermarle la spedizione del pacco.</p>
					<p> Il suo pacco è stato spedito tramite ".$carrier." con il numero di rintracciabilit&agrave;: ".$track." al seguente indirizzo:  </p><p>
					".$street.", ".$postcode.", 
					".$city.", ".$country.". </p>
					<p>Pu&ograve; seguire lo stato della spedizione, con questo link: </br> 
					<a href=".$check_url.">".$check_url."</a></p>											
					<p> Per ulteriori domande o chiarimenti sullo stato della spedizione, la preghiamo di mettersi in contatto direttamente con ".$carrier." </p>		
					" . $bls . "					
					<p> La ringraziamo per aver scelto i nostri servizi.</p>
					";	
				}
						
				$mail = new EMAIL;
				
//echo $title. '<br>' . 	$corps.'<br><br>';			
//echo $ext_bd_root[$dtb]. '  dtb  '.$dtb;exit;
				
				$mail->set_sender_name(str_replace('http://www.','',$ext_bd_root[$dtb]),1 );
				$mail->set_sender_email_address('info@'.str_replace('http://www.','',$ext_bd_root[$dtb]));
				$mail->set_email_title($title,1);
				$mail->set_email_language=1;
				
//				$mail->set_receiver_name('Fred');		
//				$mail->set_receiver_email_address('frederic.varon@cyber-sphinx.com');

				$mail->set_receiver_email_address($customers_email_address);
				
				// a tester 
				
				$mail->set_email_content($corps,1);
				if ( strpos($customers_email_address,'amazon')==0 )
				{

					$mail->send_email();
					$mail->set_receiver_email_address('frederic.varon@cyber-sphinx.com');
					$mail->send_email();					
				}
/*				
				echo '</br> Bonsoir';
				echo '<hr>';
				echo $title;
				echo '<hr>';
				echo $corps;
				echo '<hr>';
*/				
//exit;				
				
				$comment = $carrier . "  tracking number :: ".$track;
				$dml = "insert into  ".$ext_db_database[$database_code].".orders_status_history
						( orders_id,  comments, orders_status_id, date_added ) 
					values (  " . $order_id . ",'". $comment ."',2, now() )";
				
				$db->Execute($dml);	
				$track_cnt++;
			}
		}
	 }  
}  


  apply_track_update('UPS',"187002","test");
  
?>
