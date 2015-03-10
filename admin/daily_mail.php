<?php
 require('includes/application_top.php');
 require('el_fonctions_gestion.php');
 
 global $db;
  $db->connect($ext_db_server["gl"], $ext_db_username["gl"], $ext_db_password["gl"], $ext_db_database["gl"], USE_PCONNECT, false);  

   $SEND_MARGIN_EMAILS_TO = exec_select ( "select configuration_value value from configuration where configuration_key='SEND_MARGIN_EMAILS_TO'");
   $LAMPS_EMAIL_SUBJECT = exec_select ( "select configuration_value value from configuration where configuration_key='LAMPS_EMAIL_SUBJECT'");
   $LAMPS_EMAIL_BODY = exec_select ( "select configuration_value value from configuration where configuration_key='LAMPS_EMAIL_BODY'");
   $FINANCE_MARGIN_EMAIL_BODY= exec_select ( "select configuration_value value from configuration where configuration_key='FINANCE_MARGIN_EMAIL_BODY'");
   $FINANCE_MARGIN_EMAIL_SUBJECT= exec_select ( "select configuration_value value from configuration where configuration_key='FINANCE_MARGIN_EMAIL_SUBJECT'");

   
   if ( $_GET['updating']==1 )
   {
//echo 		$_GET['updating'];exit;

		 require('_obj_email.php');
		 $spam = new EMAIL;		  
		 $spam->set_email_language(2);  		   		   

		 $send_to_tab = explode(';',$_GET['send_to']);
		 
		 for($i=0;$i<count($send_to_tab);$i++)
		 {
			 $spam->set_sender_name("Sandrine",2);
			 $spam->set_sender_email_address( "sandrine@easylamps.fr" );

			 $spam->set_receiver_email_address( $send_to_tab[$i] );
				 
			 $spam->set_email_title($_GET['sujet'] ,2);
			 $spam->set_email_content($_GET['corps'],2);
		 
			$spam->send_email();
			
echo 'Email envoyé à :'. $send_to_tab[$i].'<br>';			
		}
		exit;
   }
   
   // SUBSTITUTIONS 1  ---------------------------------------
   $LAMPS_EMAIL_SUBJECT = str_replace('#1',$_GET['treatment_date'],$LAMPS_EMAIL_SUBJECT);
   
   $url_lampes = "http://linats.net/admin/margin_summary.php";
   
  $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  
  
   $sql = "select date_format(treatment_date,'%c') value from orders where treatment_date = '".$_GET['treatment_date']."'";
   $mois = exec_select ( $sql );

   $sql = "select date_format(treatment_date,'%Y') value from orders where treatment_date = '".$_GET['treatment_date']."'";
   $annee = exec_select ( $sql );

   $sql = "select date_format(treatment_date,'%d') value from orders where treatment_date = '".$_GET['treatment_date']."'";
   $jour = exec_select ( $sql );
   
   $url_lampes = "http://linats.net/admin/margin_summary.php?year=".$annee."&month=".$mois."&day=".$jour;
   
//   $url_lampes = '<a href='.$url_lampes.'>Cliquer ici</a>';
   $url_lampes = '<a href='.$url_lampes.'>'. $url_lampes .'</a>';
   
   $LAMPS_EMAIL_BODY = str_replace('#1',$url_lampes,$LAMPS_EMAIL_BODY);

   // SUBSTITUTIONS 1  ---------------------------------------
   $LAMPS_EMAIL_SUBJECT = str_replace('#1',$_GET['treatment_date'],$LAMPS_EMAIL_SUBJECT);
   
   $url_lampes = "http://linats.net/admin/margin_summary.php";
   
  $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  
  
   $sql = "select date_format(treatment_date,'%c') value from orders where treatment_date = '".$_GET['treatment_date']."'";
   $mois = exec_select ( $sql );

   $sql = "select date_format(treatment_date,'%Y') value from orders where treatment_date = '".$_GET['treatment_date']."'";
   $annee = exec_select ( $sql );

   $sql = "select date_format(treatment_date,'%d') value from orders where treatment_date = '".$_GET['treatment_date']."'";
   $jour = exec_select ( $sql );
   
   $url_lampes = "http://linats.net/admin/margin_summary.php?year=".$annee."&month=".$mois."&day=".$jour;
//echo   $url_lampes;exit; 
//   $url_lampes = '<a href='.$url_lampes.'>Cliquer ici</a>';
   $url_lampes1 = '<a href='.$url_lampes.'>'. $url_lampes .'</a>';
   
   $url_lampes = "http://linats.net/admin/margin_summary.php?year=".$annee."&month=".$mois."&day=".$jour."&montant=1";

   $url_lampes2 = '<a href='.$url_lampes.'>'. $url_lampes .'</a>';
   $LAMPS_EMAIL_BODY = str_replace('#1',$url_lampes2,$LAMPS_EMAIL_BODY);
   // Pour le reporting financier 
   $url1="http://linats.net/admin/out_marges.php?treatment_date=2012-01-06";
   

   // Pour le reporting financier -------------------------------------------------
   $FINANCE_MARGIN_EMAIL_SUBJECT = str_replace('#1',$_GET['treatment_date'],$FINANCE_MARGIN_EMAIL_SUBJECT);

   $url_finance="http://linats.net/admin/out_marges.php?treatment_date=".$_GET['treatment_date'];
   $url_finance='<a href='.$url_finance.'>'. $url_finance .'</a>';
   
   $FINANCE_MARGIN_EMAIL_BODY = str_replace('#1',$url_finance,$FINANCE_MARGIN_EMAIL_BODY);
   $FINANCE_MARGIN_EMAIL_BODY = str_replace('#2',$url_lampes2,$FINANCE_MARGIN_EMAIL_BODY);

   
   
   // AFFICHAGE DU FORMULAIRE LAMPES ---------------------------------------
   
   echo '<form name="frm" action="daily_mail.php">
   <input type="hidden" name="updating" value="1">
   <input type="hidden" name="treatment_date" value="'.$_GET['treatment_date'].'">
<table>
   <tr>
     <th> Sujet Lampes </th>  <td>  <input type=téxt name="sujet" value="'. $LAMPS_EMAIL_SUBJECT .'" size=40> </td>
   </tr>   
   <tr>
     <th> Mail Lampes </th>  <td>  <textarea name="corps" rows=7	 cols=90> ' . $LAMPS_EMAIL_BODY . ' </textarea> </td>
   </tr>   
   <tr>
   <td>
     Destinataires:
   </td>
   <td>
     <input type="text" name="send_to" size=70 value="'.$SEND_MARGIN_EMAILS_TO.'">
   </td>
   </tr>
   <tr>
     <td colspan=2> <input type="submit" value="Valider"></td>
   </tr>
   </table>
   </form>';

   
   // AFFICHAGE DU FORMULAIRE FINANCIER ---------------------------------------
   
   echo '<form name="frm2" action="daily_mail.php">
   <input type="hidden" name="updating" value="1">
   <input type="hidden" name="treatment_date" value="'.$_GET['treatment_date'].'">
<table>
   <tr>
     <th> Sujet Finances </th>  <td>  <input type=téxt name="sujet" value="'. $FINANCE_MARGIN_EMAIL_SUBJECT .'" size=40> </td>
   </tr>   
   <tr>
     <th> Mail  Finances </th>  <td>  <textarea name="corps" rows=7	 cols=90> ' . $FINANCE_MARGIN_EMAIL_BODY . ' </textarea> </td>
   </tr>   
   <tr>
   <td>
     Destinataires:
   </td>
   <td>
     <input type="text" name="send_to" size=70 value="'.$SEND_MARGIN_EMAILS_TO.'">
   </td>
   </tr>
   <tr>
     <td colspan=2> <input type="submit" value="Valider"></td>
   </tr>
   </table>
   </form>';
   
?>