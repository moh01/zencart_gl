<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION:   Replaces admin/orders.php, adding    //
//  new features, navigation options, and an advanced   //
//  payment management system.                          //
//////////////////////////////////////////////////////////685
// $Id: super_orders.php 43 2006-08-29 14:05:21Z BlindSide $
*/

$easylamps_email_address = "han@easylamps.fr";
$easylamps_email_address2 = "avaron@easylamps.fr";

$easylamps_name = "Han";

//_TODO add admin account id to status history record
//_TODO form verifications on edit & payment popup forms
//_TODO payment_types table interface
//_TODO popup class to build/display help or additional data in new window
//_TODO make following replacements in all SO files...
//                 <br> --> <br />
//                  <b> --> <strong>
//      zen_db_output --> zen_db_scrub_out($x)
//      zen_db_input --> zen_db_scrub_in($x, true/false)
// 		zen_db_prepare_input --> zen_db_scrub_in($x, true/false)

$track_cnt = 0;

function apply_batch ($flow,$carrier)
{
	global $track_cnt;
		  if (true)
		  {		  
			 $tbl = $flow;

//			 echo $_GET['muti_entry'];exit;		  
//echo '<hr>'.$_GET['multi_entry'].'<hr>';exit;			 
			 $lignes=explode(chr(13),$tbl);
//echo count(		$lignes );exit;	 
//echo count($lignes);exit;

			 if ($carrier=='UPS')
			 {
				$tracking_seq = 0;
				$order_seq = 1;
				$status_seq = 2;			 
			 }
			 else if ($carrier=='DHL')
			 {
				$tracking_seq = 2;
				$order_seq = 3;
				$status_seq = 4;			 			 
			 }			 
			 else if ($carrier=='COLLISSIMO')
			 {
				$tracking_seq = 2;
				$order_seq = 3;
				$status_seq = 4;			 			 
			 }
			 
			 for ($k=0;$k<count($lignes);$k++)
			 {
				$vals = explode(chr(9),$lignes[$k]);				

				$track = $vals[$tracking_seq];
				$track = str_replace(' ','',$track);
				
				$order_id = $vals[$order_seq];
				$order_id = str_replace(' ','',$order_id);				

				$status = $vals[$status_seq];
				$status = str_replace(' ','',$status);				

				
/*				
				$mdl = $vals[2];
				$mdl = str_replace(' ','',$mdl);				
				
				$upc = $vals[3];
				$upc = str_replace(' ','',$upc);				
//echo '<hr>'.$typ.'<hr>';
				$err="";
*/
				if ( ! is_numeric($order_id)  )
				{
					echo "Non numeric Format for order_id |".$order_id."|".$k."|<br>";
				}		
				else
				{
//echo 'apply_track_update'.$track.'|<br><br>';				
					 apply_track_update($_GET['carrier'],$order_id,$track,$status);
				}				
			 }
		  }
		echo  "<br><font color=orange> Nombre de modification appliquées : ". $track_cnt ."</font><br><br>";
}		  
function apply_track_update($carrier,$order_id,$track,$status)
{
    global $source_catalog;
	global $orders_id;
	global $ext_db_database;
	global $db;
    global $track_cnt;
	
	$bds = array("eu","fr","es","de","en","it","bf","hp","rq","hp");
 
	 $cnt = 0;
	 $track_cnt=0;
	 
	 foreach ($bds as $dtb) 
	 {
		$sql = "select 1 value from ".$ext_db_database[$dtb].".orders where orders_id = ".$order_id;
//		echo $sql.'<br>';
		$chk = exec_select ( $sql);
		if ($chk==1)
		{
			if ( $carrier=='UPS' )
			{
				$chk2 = exec_select ( "select 1 value 
									   from ".$ext_db_database[$dtb].".orders_status_history
									   where  orders_id = ".$order_id ." 
									   and comments like '%::%'
									   and ( ( comments like '%Delivered%' )
									          or ( comments like '%Livré%' ) 
											) ");
			}
			else
			{
				$chk2 = exec_select ( "select 1 value 
									   from ".$ext_db_database[$dtb].".orders_status_history
									   where  orders_id = ".$order_id ." 
									   and comments like '%::%' ");
			}								   
			// if (!$chk2)
			if (!$chk2)
			{
				
				$dml = 'delete from '.$ext_db_database[$dtb].'.orders_status_history
						where orders_id = '. $order_id .'
						and comments like "%::%"
						and date_format(date_added,"%Y-%c-%d")=date_format(now(),"%Y-%c-%d")';
				$db->Execute($dml);			
				if ( $carrier=='UPS' )
				{
					$comment = $carrier . "  tracking number:: ".$track. " status::".$status. "  check URL:: http://www.ups.com";				
				}
				else
				{
					$check_url = "http://www.dhl.com/content/g0/en/express/tracking.shtml?brand=DHL&AWB=".$track;
					$comment = $carrier . "  tracking number:: ".$track. "  check URL::".$check_url;				
				}								   
//echo $comment;exit;
				
		//echo 	$comment.'<br>';
				
					$dml = "insert into  ".$ext_db_database[$dtb].".orders_status_history
							( orders_id,  comments, orders_status_id, date_added ) 
						values (  " . $order_id . ",'". $comment ."',2, now() )";
					
					$db->Execute($dml);			
					
				echo 'track :: '.$track.'<br>';
				
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
  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
  
  
 
  		echo '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Traquing for '. $_GET['carrier'] . '</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script type="text/javascript">
  function popupWindow(url, features) {
    window.open(url,\'popupWindow\',features)
  }
</script>
</head>
<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } ">

		';
		
		if ( $_POST['updating']==1 && strlen($_POST['brouillard'])>0)
		{
//echo $_POST['brouillard'];exit;
		
			apply_batch($_POST['brouillard'],$_GET['carrier']);
		}
       $sourcedb = $_SESSION['source_db'];
  	   $db->connect($ext_db_server[$sourcedb], $ext_db_username[$sourcedb], $ext_db_password[$sourcedb], $ext_db_database[$sourcedb], USE_PCONNECT, false);
		
	   if (strlen($_GET['carrier'])==0)
	   {
			echo '<form name=frm>';
			echo '<b>Transporteur ? </b>';
			$sql="select 'UPS' code,  'UPS' description  
			      union 
				  select 'DHL' code,  'DHL' description
			      union 
				  select 'COLLISSIM0' code,  'COLLISSIM0' description";
				  
			echo get_select($sql,"carrier","");
			echo '<input type="submit">';
	   }
	   else 
	   {
			echo '<form name=frm method=POST>';	   
	       echo "<input type=hidden name=updating   value=1>";			
	       echo "<input type=hidden name=carrier value=".$_GET['carrier'].">";
		   echo '<table>';
		  
		  echo 'Copier-coller le contenu  du fichier Excel dans ce champ<br><br>';
		  echo '<textarea name=brouillard rows=3 cols=70> </textarea>';
		  
		  echo '<br><br><input type=submit value="Soumettre">';		  
		  
		  
			echo '</table>';
			
		   echo '</td>';
		   
		   echo '<td>';
	}
	
echo $html;		
echo '</form>';
echo '</body>';
?>