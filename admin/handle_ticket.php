<?php
$start_time=time();  

  require('includes/application_top.php');
  require('el_fonctions_gestion.php');

//echo $start_time.'<br>'.time().'<br>';

echo '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Nouveau commentaires tiquet </title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } ">
<form name="frm">';


if ( $_GET['id']==0 )
{
   $sql = "select min(id) value from el_ticket_status where ticket_type='" .$_GET['type']."'";
   $id1 = exec_select($sql);
   
   $dml = "insert into el_ticket ( ticket_type,	date_created , customers_id,
                                   status , recall_date  )
	       values ( '" . $_GET['type'] . "', now(), ". $_GET['customers_id'] . " ,
		                           " . $id1  . ", now()  ) ";
   $db->Execute($dml);
   $ticket_id = mysql_insert_id();   
}
else
{
   $ticket_id = $_GET['id'];
}


$sql = "select * from el_ticket where id=". $ticket_id;
$recordSet = $db->Execute($sql);

$status =  $recordSet->fields['status'];
$recall_date = $recordSet->fields['recall_date'];
$type = $recordSet->fields['ticket_type'];
$database_code = $recordSet->fields['database_code'];


// enregistrement des valeurs 
if ($_GET['updating'] == 1)
{
	$sql = "select * from el_ticket_cuf where ticket_status_id =". $status . " order by sequence ";
	$recordSet = $db->Execute($sql);
    $data = 0;
    $cuf_exists = 0;
	
	while (!$recordSet->EOF)
	{
	   $cuf_exists = 1;
	   if ( ( strlen($_GET['suggestion_'.$recordSet->fields['id']]) +  strlen($_GET['text_fr_'.$recordSet->fields['id']]) )  > 0 )
	   {
	      $data = 1;
	   }
	   $sql2 = "select 1 resp from el_ticket_note where ticket_id=" . $ticket_id . "  and ticket_cuf_id=". $recordSet->fields['id'];

	   $rc2 = $db->Execute($sql2);
	   if (strlen($rc2->fields['resp']>0))
	   {
	      
	      $dml = "update el_ticket_note 
		         set text_fr='".addslashes($_GET['text_fr_'.$recordSet->fields['id']])."',
				     suggestion_value = '".addslashes($_GET['suggestion_'.$recordSet->fields['id']])."'
                 where ticket_id=".$ticket_id."
				 and   ticket_cuf_id=".$recordSet->fields['id'];
				 
		  // notification par mail
		  if ( $recordSet->fields['id'] == 24 )
		  {
		     if ( $_GET['suggestion_'.$recordSet->fields['id']] == 'OKEL' )
			 {
			    
			    $sql = "select 1 value from el_ticket_note 
		               where  suggestion_value = 'KOEL' 
					   and    ticket_id=".$ticket_id."
                       and   ticket_cuf_id=24";
					   
				$rs = $db->Execute($sql);
				$check = $rs->fields['value'];
	// objet dy refesh
//	if (  )
$lg_id['fr']=2;
$lg_id['es']=3;
$lg_id['de']=4;
$lg_id['en']=5;
$lg_id['it']=6;

$languages_id = $lg_id[$database_code];

if ($database_code=="eu")
{
   $sql = "select customers_id value from el_ticket where id = " . $_GET['id'];
   $customers_id = exec_select ( $sql );   
   $db->connect($ext_db_server["eu"], $ext_db_username["eu"], $ext_db_password["eu"], $ext_db_database["eu"], USE_PCONNECT, false);
   
   $sql = "select languages_id value
           from orders
           where orders.customers_id = ". $customers_id . " order by orders_id desc ";
    $languages_id = exec_select ( $sql );
	
   $db->connect($ext_db_server["gl"], $ext_db_username["gl"], $ext_db_password["gl"], $ext_db_database["gl"], USE_PCONNECT, false);
	
	if ( ! $languages_id )
	   $languages_id = 5;
	   
}

//echo $_SESSION["languages_id"];

				if ( $check == 1 )
				{
     				$sujet[2]="Votre procédure RMA  #NUM#";
                    $corps[2]="Bonjour,

Vous pouvez nous retourner votre matériel à l'adresse suivante:

EASYLAMPS
RMA n° #NUM#
42 bis rue du Sergent Godefroy
93100 Montreuil

soigneusement emballé comme vous l'avez reçu (emballage d'origine + carton de protection).

A réception de votre colis nous traiterons votre dossier et reviendrons vers vous sous 15-20 jours.

Bien cordialement.
";

     				$sujet[3]="Procedimiento RMA #NUM#";
                    $corps[3]="Estimado cliente,

Puede usted enviar el material que desea devolver, cuidadosamente empacado, como lo recibió (empaque original + cartón), a la siguiente dirección:

EASYLAMPS
RMA n° #NUM#
42 bis rue du Sergent Godefroy
93100 Montreuil 
Francia

A partir del momento en que recibamos su envío, trataremos su expediente y le contactaremos en un periodo de 15 a 20 días.

Atentamente
";

     				$sujet[4]="Ihr RMA-Verfahren #NUM#";
                    $corps[4]="Guten Tag, 

Bitte schicken Sie Ihr Produkt an folgende Adresse:

EASYLAMPS
RMA n°#NUM#
42 bis rue du Sergent Godefroy
93100 MONTREUIL-SOUS-BOIS
Frankreich
Bitte packen Sie das Produkt so ein wie Sie es erhalten haben 
(Originalkarton + Schutzkarton).
Sobald wir Ihr Paket erhalten haben, bearbeiten wir Ihren Auftrag und kommen innerhalb von 15-20 Tagen wieder auf Sie zurück. 

Mit freundlichen Grüssen";

     				$sujet[5]="Your RMA-Request #NUM#";
                    $corps[5]="Please return the lamp module at this address:


EASYLAMPS
RMA n°#NUM#
42 bis rue du Sergent Godefroy
93100 MONTREUIL-SOUS-BOIS
FRANCE


Send it carefully packed as you received it (original packing and protection box).

When we receive the lamp we test it and come back to you within  15 to 20 days.


Best regards.";

     				$sujet[6]="RMA n°#NUM#";
                    $corps[6]="Salve,

La preghiamo di mandare la lampada a quest'indirizzo:


SARL EASYLAMPS
RMA n°#NUM#
42 bis rue du Sergent Godefroy
93100 MONTREUIL-SOUS-BOIS
FRANCE

La mandi con cautela, imballata com'era alla ricezione e, se possibile con una protezione in piu' per evitare ogni rischio di danno. (con la scatola e l’imballaggio originale).

Appena ricevuta, noi la testeremo, e poi la restituiremo tra 15/20 giorni.

La ringraziamo.";


     				$sujet[7]="Panstwa wniosek RMA num #NUM#";
                    $corps[7]="
Prosze wyslac lampe starannie zapakowana, tak jak zostala otrzymana (oryginalne opakowanie i pudelko ochronne):


SARL EASYLAMPS
RMA nr #NUM#
42 bis rue du Sergent Godefroy
93100 MONTREUIL-SOUS-BOIS
FRANCE


Zwrocona lampe poddamy analizie a nastepnie odpowiemy na Panstwa wniosek w ciagu 15 do 20 dni.


Z powazaniem.";


$html_msg = str_replace('
','<br>',$body);

				$sql = "select customers_id, database_code 
						from el_ticket t 
						where t.id = " . $ticket_id;


		        $rs = $db->Execute( $sql );
				$cs_id = $rs->fields['customers_id'];
				$cs_db = $rs->fields['database_code'];
				
				if (  $cs_db == "eu"  )
				  $dsp_number = "RV".$ticket_id;
				else
				  $dsp_number = $ticket_id;
//echo "HELLO".$cs_db.$dsp_number;
				  
				
				$subject = str_replace('#NUM#',$dsp_number,$sujet[$languages_id]);					
				$body = str_replace('#NUM#',$dsp_number,$corps[$languages_id]);
				
				
			   $db->connect($ext_db_server[$cs_db], $ext_db_username[$cs_db], $ext_db_password[$cs_db], $ext_db_database[$cs_db], USE_PCONNECT, false);
			   
			   
				$sql = "select customers_email_address value
						from customers c 
						where customers_id = " . $cs_id ;
						
			   $email = exec_select ( $sql );
			   $from_email = str_replace("http://www.","info@",$ext_bd_root[$cs_db]);
			   
								
			   $db->connect($ext_db_server["gl"], $ext_db_username["gl"], $ext_db_password["gl"], $ext_db_database["gl"], USE_PCONNECT, false);
						
						
				
				// le email pour le client copie le responsable de site
				// instancier la commande ?
				$from_name = str_replace("http://www.","",$ext_bd_root[$cs_db]);
/*				
echo 'biz';
echo  $from_email;
echo 'baz';
echo  $email;
echo 'buz';
*/
			  // envoi client
//$email = 'fvaron@easylamps.fr';
			  
			  zen_mail($email, $email, $subject , $body , $from_name , $from_email , $html_msg, 'default');
			  /// copie  responsable
			  zen_mail($from_name , $from_email, $subject , $body , 'RMA' , $email , $html_msg, 'default');
//echo $email.$from_email;exit;			  

				//echo $sql.'/'.exec_select ( $sql );exit;
				}
			  }
		  }
	    }
	   else
	   {
	      $dml = "insert into el_ticket_note(ticket_id,ticket_cuf_id,text_fr,suggestion_value)  
		          values ( ".$ticket_id.", ".$recordSet->fields['id'].",'".addslashes($_GET['text_fr_'.$recordSet->fields['id']])."', '".addslashes($_GET['suggestion_'.$recordSet->fields['id']])."' )";	   
	   }
	   
	   $db->Execute($dml);
//	   echo $dml;exit;
	     
	   $recordSet->MoveNext();

	}
}
if ( $_GET['updating'] == 1 )
{
   $dml = "update  el_ticket 
	           set status = ". $_GET['new_status'] . ", 
			   recall_date = '". $_GET['recall_date'] . "'
		   where id = ". $ticket_id;
   $db->Execute($dml);
   
   $sql =  "select id, text_fr
            from el_ticket_note
			where new_status_id=".$status."
			and   ticket_id = ".$ticket_id;
   $rs1 = $db->Execute($sql);
   $old_id = $rs1->fields['id'];
   $text_fr = stripslashes($rs1->fields['text_fr']);
 
  
   if (strlen($old_id)>0)
   {
	   //	           set status = ". $_GET['new_status'] . ", 
	    $dml = "update el_ticket_note 
		        set text_fr = '". addslashes( $_GET['text_fr'] ) ."'
				where id = ". $rs1->fields['id'];	   
	}
	else
	{
//echo $data.'.'.	$cuf_exists;
	   if  ( ( ($data) && ($cuf_exists) ) || ( !$cuf_exists ) || (strlen($_GET['text_fr'])>0) )
	   {
/*
	   $check_before = exec_select( "select id 
		                                 from el_ticket_note 
										 where ticket_id = ". $ticket_id . "
										 and   new_status_id = ". $_GET['new_status'] );
*/										   
		   $dml = "insert into  el_ticket_note (    date_created ,
						   ticket_id ,
						   text_fr,	
						   old_status_id, 	
						   new_status_id  )
		              values ( now(),
		                      '".$ticket_id."' ,
							  '". addslashes( $_GET['text_fr'] ) ."',
		                      '".$status."' ,
		                      '".$_GET['new_status']."' 
							  )";
        }					
/*		
		else
		{
		   echo 'je suis dans le else';
		}
*/	
		
	}
//echo $dml; exit;
   $db->Execute($dml);
   if ( strlen ($_GET['new_status'])  )
   {
		$status = $_GET['new_status'];
   }
   
   if ( $_GET['status_update']==0 )
   {      
	echo '
		<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
		<html>
		<head>
		<title><?php echo REDIRECT; ?></title>
		<script language="JavaScript" type="text/javascript">
		  <!--
		  function returnParent() {
		    self.top.opener.location.reload(true);
		    self.top.opener.focus();
		    self.top.close();
		  }
		  //-->
		</script>
		</head>
		<!-- header_eof //-->
		<body onload="returnParent()">
		</body>
		</html>';
    	exit;
	 }

   
	
}
echo '<input type="hidden" name="id" value="'.$ticket_id.'">';
echo '<input type="hidden" name="updating" value="1">';
echo '<input type="hidden" name="status_update" value="0">';

echo '<table>';
echo '<tr>';

echo '<th>';
echo 'Statut';
echo '</th>';
echo '<td>';
$sql = "select id code, label description from el_ticket_status where ticket_type='". $type . "' order by 1";
//echo  $sql;
echo  get_select ( $sql, "new_status", $status, 'onchange="document.frm.status_update.value=1;document.frm.submit();"' );
echo '&nbsp;&nbsp;&nbsp;Rappel<input type="text" name="recall_date" value="'.$recall_date.'">';
echo '</td>';

echo '</tr>';
// recup cmm
  
   $sql =  "select id, text_fr
            from el_ticket_note
			where new_status_id=".$status."
			and   ticket_id = ".$ticket_id;

//echo $sql;
			
   $rs1 = $db->Execute($sql);
   $old_id = $rs1->fields['id'];
   $text_fr = stripslashes($rs1->fields['text_fr']);
 
echo '<tr>';
echo '<th>';
echo 'Commentaire';
echo '</th>';
echo '<td>';
echo '<input type="text" value="'. $text_fr .'"  name="text_fr" size=55>';
echo '</td>';

$sql = "select * from el_ticket_cuf where ticket_status_id =". $status . " order by sequence ";
$recordSet = $db->Execute($sql);
echo '</tr></table>';
echo '<hr>';
echo '<table>';
while (!$recordSet->EOF)
{
   echo '<tr>
         <th>';
   echo $recordSet->fields['prompt'];
   echo '</th>';

$sql = "select * from el_ticket_note where ticket_id =". $ticket_id . " and ticket_cuf_id =". $recordSet->fields['id']	;
$rs3 = $db->Execute($sql);
$txt = stripslashes($rs3->fields['text_fr']);
$suggestion_value =  stripslashes($rs3->fields['suggestion_value']);

   echo '<td>';
   // 	suggestion_value
   if ( strlen( $recordSet->fields['suggestion_attribute_code'])==0 )
   {
		echo '<input type="text"  name="text_fr_'.$recordSet->fields['id'].'"  value="'.$txt.'" size=45>'.$recordSet->fields['hint'];
   }
   else 
   {
        // on cree un select 
	    $sql = "select code, label_fr description from el_attribute_value where attribute_code = '". $recordSet->fields['suggestion_attribute_code'] ."'";
        echo  get_select ( $sql, "suggestion_".$recordSet->fields['id'], $suggestion_value );
		echo '<input type="text"  name="text_fr_'.$recordSet->fields['id'].'"  value="'.$txt.'" size=20>'.$recordSet->fields['hint'];
   }
   
   echo '</td>
         </tr>';
   
   $recordSet->MoveNext();
}
echo '<td>';
echo '&nbsp;';
echo '</td>';

echo '<td>';
echo '<input type="submit" value="OK">';
echo '</td>';


echo '</tr>';
echo '</table>';
echo '
</form>
</body>	 
</html>';
 echo time();
?>	