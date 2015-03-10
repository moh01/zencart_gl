<?php


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

$track_cnt_ups = 0;
$track_cnt_dhl = 0;
$track_cnt_collissimo = 0;

function get_ups_track($p_orders_id)
{
   // la structure du  nom du fichier est de type: 
   //   cmd_po_154238.Out
   // le fichier existe t'il ?
   
   // quel est le contenu du fichier ?
   $content = file_get_contents('../../lvp_pp/zencart_fr/vp-manuels/carriers/cmd_po_'.$p_orders_id.'.Out');
   //   						<TrackingNumber>1Z2A96636856372281</TrackingNumber>
   $pos1 = strpos ( $content, '<TrackingNumber>' );
   $pos2 = strpos ( $content, '</TrackingNumber>' );

   $tracking = substr ( $content, $pos1, $pos2-$pos1 );
      
   return $tracking;
}
function fetch_collissimo($day)
{
   // la structure du  nom du fichier est de type: 
   //   cmd_po_154238.Out
   // le fichier existe t'il ?
   
   // quel est le contenu du fichier ?
   $content = file_get_contents('../../lvp_pp/zencart_fr/vp-manuels/carriers/'. $day .'.txt');
   //   						<TrackingNumber>1Z2A96636856372281</TrackingNumber>
   $lignes=explode('
', $content );
//   echo count($lignes);exit;
  for ($i=0;$i<count($lignes);$i++)
  {
	 $ligne = $lignes[$i];
	 $num_commande = rtrim(ltrim(substr($ligne,0,11)));
	 $num_suivi =  substr($ligne,70,13);
     echo $num_commande.'|'.$num_suivi.'<br>';
	 
	 if (is_numeric($num_commande))
	 {
		apply_track_update('COLLISSIMO',$num_commande,$num_suivi,"");
	 }
  }   
   return $result;
}

	  
function apply_track_update($carrier,$order_id,$track,$status)
{
    global $source_catalog;
	global $orders_id;
	global $ext_db_database;
	global $db;
	
    global $track_cnt_ups;
	global $track_cnt_dhl;
    global $track_cnt_collissimo;
	
	
	$bds = array("eu","fr","es","de","en","it","bf","hp");
 
//echo  $carrier. '|' .$order_id. '|' .$track. '<br>';
 
	 $cnt = 0;
	 
	 foreach ($bds as $dtb) 
	 {
		$sql = "select 1 value from ".$ext_db_database[$dtb].".orders where orders_id = ".$order_id;
//		echo $sql.'<br>';
		$chk = exec_select ( $sql);
		if ($chk==1)
		{
			$chk2 = exec_select ( "select 1 value 
								   from ".$ext_db_database[$dtb].".orders_status_history
								   where  orders_id = ".$order_id ." 
								   and comments like '%::%' ");
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
					$check_url = "http://wwwapps.ups.com/etracking/tracking.cgi?&loc=fr_fr&tracknum=".$track;				
					$comment = $carrier . "  tracking number:: ".$track. " check URL::".$check_url;			
					$track_cnt_ups++;
				}
				else if ( $carrier=='DHL' )
				{
					$check_url = "http://www.dhl.com/content/g0/en/express/tracking.shtml?brand=DHL&AWB=".$track;
					$comment = $carrier . "  tracking number:: ".$track. "  check URL::".$check_url;				
					$track_cnt_dhl++;
				}								   
				else if ( $carrier=='COLLISSIMO' )
				{
					$check_url = "http://www.colissimo.fr/portail_colissimo/suivre.do?colispart=".$track;
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

  
    echo fetch_collissimo('test');
	exit;
  
  
  
    // récupération des données de collissimo .////////
	
	$day=today_leading_zeros();
//	echo $day;exit;
	
	fetch_collissimo($day);
    // récupération des données de UPS ..............////////
	
	$sql = 'select orders_id from bo_po.orders 
	        where date_format(dispatch_date,"%Y-%c-%d")=date_format(now(),"%Y-%c-%d") 
			and carrier = "UPS"';
	
	$rs = $db->Execute($sql);
	while (!$rs->EOF)
	{
		$track = get_ups_track($rs->fields['orders_id']);
		apply_track_update('UPS',$rs->fields['orders_id'],$track,"");
		
		$rs->MoveNext();
	}
  // récupération des données de DHL..............////////
//  echo get_ups_track(108513);
//  echo fetch_collissimo('20130325');
			require_once("http.class.php");
			$http =& new CHttp();
			
            $url = "http://www.station-chargeur.com/appli/v01/com/pop_extract.php?idExtraction=2944&sPasse=&ModeURL=1";
			
			$response = $http->GetRequestArguments($url, $arguments);
			$error = $http->Open($arguments);
			$error = $http->SendRequest($arguments);
			$error = $http->ReadReplyBody($body, 64000);
			

			$lignes=explode("
",$body);
//echo count($lignes);exit;			
			$tracking_seq = 2;
			$order_seq = 3;
			$status_seq = 4;			 			 
				
			 for ($k=0;$k<count($lignes);$k++)
			 {
				$vals = explode(";",$lignes[$k]);				

				$track = $vals[$tracking_seq];
				$track = str_replace(' ','',$track);
				
				$order_id = $vals[$order_seq];
				$order_id = str_replace(' ','',$order_id);				

				$status = $vals[$status_seq];
				$status = str_replace(' ','',$status);				

				
				if ( ! is_numeric($order_id)  )
				{
					echo "Non numeric Format for order_id |".$order_id."|".$k."|<br>";
				}		
				else
				{
//echo 'apply_track_update'.$track.'|<br><br>';				
//echo $order_id.$track.'<br>';
					 apply_track_update('DHL',$order_id,$track,"");
				}				
			 }
			 
//	echo 'Collissimo: ' $cnt_collissimo;		 
?>