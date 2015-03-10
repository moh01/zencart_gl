<?php
  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
  
  require(DIR_WS_CLASSES . 'order.php');
  global $db;  

  $desc_expression = "concat( orders_id , '   ----   ',  payment_module_code, '   ----    ' ,  customers_company ,'   ----    ',customers_name,'  |  ',customers_email_address,'  |  ', customers_country,'  |  ', customers_city ) value";
  
/*

FVV

			 if ( strpos(' '.strtoupper($order_id),'000006') 
			             || strpos(' '.strtoupper($order_id),'000003')
			             || strpos(' '.strtoupper($order_id),'000004')						 
						 || strpos(' '.strtoupper($order_id),'ALAMO')
						 || strpos(' '.strtoupper($order_id),'000009')						 )
			 {


*/  
function get_batch_id ( $database_code, $treatment_date )
{
	global $db;
	global $ext_db_database;
	
	$sql = "select  batch_id value from bo_gl.el_batch where po_database_code='". $database_code ."' and treatment_date='". $treatment_date."'";
	$batch_item_id = exec_select ($sql);
    if ($batch_item_id)
	{
		return $batch_item_id;
	}
	else
	{
		$dml = "insert into bo_gl.el_batch ( batch_name, batch_type, po_database_code, treatment_date,  po_status ,active ) 
				values ('". $treatment_date . ' - '. $database_code ."','po','". $database_code ."','". $treatment_date ."', 'uncomplete' ,1)";
				
		$db->Execute($dml);
	    $batch_item_id = mysql_insert_id();

		return $batch_item_id;		
	}
}

  // traitement spécial douchette 
  if ( strlen ($_GET["douchette_input"])>0 )
  {
	  $treatment_date = $_GET['treatment_date_douchette'];
//echo $treatment_date;exit;
	  $dblist = "fr,de,es,en,it,eu,bf,hp,rq,pl,tb";
	  $dbs=explode(",",$dblist);
	  
	  
	  $to_split=$_GET["douchette_input"];
	  $ords = explode("
",$to_split);
	   $cnt_orders_treated = 0;
	   
	   for ($i=0;$i<count($ords);$i++)
	   {
			if (strlen($ords[$i])>0)
			{
				$order_id =  get_order_id($ords[$i]);
//				echo "in ". $order_id ."<br>";			
				// on détermine ou se trouve cette commande 
				$la_base = "";

				for ($k=0;$k<count($dbs);$k++)
				{
					$sql="select 1 value from ". $ext_db_database[$dbs[$k]] .".orders where orders_id = ". $order_id;				
//echo $sql.'<br>';					
					$chk2 = exec_select ($sql);
										
					if ($chk2)
					{
						$la_base=$dbs[$k];
						
						$sql = " select  ". $desc_expression . "
						  from ". $ext_db_database[$dbs[$k]] .".orders
						  where  orders_id = ".$order_id;

 					  $description = addslashes(exec_select ($sql));
						
						$check_status = exec_select ( "select orders_status value from ". $ext_db_database[$dbs[$k]] .".orders  where orders_id = ".$order_id );
						
					}
				}				
				
				$chk1 = exec_select ( "select 1 value from bo_po.orders where orders_id = ".$order_id);
				$creation_item = 1;
				
				if ( $chk1 )
				{
					echo "Commande ". $order_id . " déjà présente dans po ";
				}
				else if (strlen($la_base)==0)
				{
					$creation_item = 0;
		
					echo "<font color=red>Commande ".$order_id." non trouvée dans les bases de données de commande.</font>";
				}
				else
				{
					// on clone
// function clonage_order ( $p_old_order_id, $p_old_db, $p_new_db, $p_customer_database_code , $p_new_customers_id, $p_new_languages_id, $p_new_status )					
				   $new_id=clonage_order ( $order_id, $la_base, "po", $la_base, 0, $languages_id, $check_status );					
				}
				// on récupère le batch_id 
				if ( $creation_item )
				{				
					// on applique l'ajout au lot
					$dml = " delete from  el_batch_items where item_id = ". $order_id; 			
					$db->Execute($dml);

					$batch_id = get_batch_id ( $la_base, $treatment_date );
					
					// $treatment_date
					$dml = " insert into el_batch_items ( batch_id, item_id, database_code, description ) 
							 values ( ". $batch_id . ",".$order_id.",'".$la_base . "','". $description ."')"; 
//echo $dml;exit;
							 
					$db->Execute($dml);

					$dml = "update bo_po.orders set treatment_date = '". $treatment_date."', gl_transfered = 1 
							where orders_id = " . $order_id;	

//echo $dml.'<br>';
							
					$db->Execute($dml);
					
					
					$cnt_orders_treated++;
					echo "<font color=green>Commande ". $order_id . " insérée pour le lot ". $la_base .'</font><br>';

					
				}
			}
	   }
	  echo '<br><br><b>'. $cnt_orders_treated.' commandes traitées </b>';	   
  }
  
  // gestion de la validation (OK)
//echo '???'.$update_type.'///'.$_GET['table_select'].'ff';
  if (($_GET['updating'])>=1)
  {
  // 73924
      $update_type = $_GET['updating'];
	  if ($update_type==18)
	  {
		  $db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);
 
	      $dml = "update el_batch set po_status = 'complete' where batch_id = ".$_GET['batch_id'];

		  $db->Execute($dml);
		  
	  }
      else if ( 
			( ($update_type==10) && (strlen($_GET['table_select2'][0])>0))
			 ||
			( ($update_type==12) && (strlen($_GET['table_select'][0])>0))
			 ||
			( ($update_type==15) && (strlen($_GET['add_order'])>0))			
			)
	  {
		if ($update_type==10)
			$selections = $_GET['table_select2'];
		else if($update_type==12)
			$selections = $_GET['table_select'];
		else if($update_type==15)
			$selections = $_GET['add_order'];

		$cntr = count( $selections );

		$db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);
				  
		$sql = "select treatment_date, po_database_code from el_batch where batch_id = ".$_GET['batch_id'];
//echo $sql;exit;
        $rs = $db->Execute($sql);
		$treatment_date = $rs->fields['treatment_date'];
		$po_database_code = $rs->fields['po_database_code'];
		
		if ($update_type==15)
		{
		    $add_order_tab = explode(',',$_GET['add_order']);
			$selections = Array(); 
			$cntr=0;
			
			for($i=0;$i<count($add_order_tab);$i++)
            {			
//	echo count($add_order_tab); exit;			

				$sql = "select 1 value from el_batch_items where batch_id = ". $_GET['batch_id'] . " and  item_id = ". $add_order_tab[$i];
			   $check_gl = exec_select ($sql);
			   $db->connect($ext_db_server['po'], $ext_db_username['po'], $ext_db_password['po'], $ext_db_database['po'], USE_PCONNECT, false);
			   $sql = "select orders_id value from orders where orders_id = ". $add_order_tab[$i];
			   
			   $check = exec_select ( $sql );
			   if ( !( $check_gl==1  ) && ! ($check > 0) )
			   { 
				   // on vérifie la préexistance de la cmde
				   $db->connect($ext_db_server[$po_database_code], $ext_db_username[$po_database_code], $ext_db_password[$po_database_code], $ext_db_database[$po_database_code], USE_PCONNECT, false);
				   $check_status = exec_select ( "select orders_status value from orders  where orders_id = ".$add_order_tab[$i] );
				   if ( $check_status > 0 )
				   {
					   // on force le rappatriement de la facture
					   $new_order=clonage_order ( $add_order_tab[$i], $po_database_code, "po", $po_database_code , 0, $languages_id, $check_status );
				   }
				   else
				   {
					  echo '<font color="red">Pb: commande '.$add_order_tab[$i].' non trouvée dans source:'.$po_database_code.'</font><br>';
				   }
			   }
			   else
			   {
				   $cntr++;
				   $selections[]=$add_order_tab[$i];
//echo "add".	$add_order_tab[$i].'<br>';		   
				   $update_type=10;			   
			   }
			   
		    }
			/*
		   if  (  !( $check_gl==1  ) && ( ( $check + $check_status ) > 0 ) )
		   {
		       $selections = Array(); 
			   $k=1;
			   $selections[]=$add_order_tab;
			   $update_type=10;
			}
			*/
		}
		
		for ($k=0;$k<$cntr;$k++)
		{
			$db->connect($ext_db_server['po'], $ext_db_username['po'], $ext_db_password['po'], $ext_db_database['po'], USE_PCONNECT, false);
			if ($update_type==10)
			{
				$dml = "update orders set treatment_date = '". $treatment_date."', gl_transfered = 1 
						where orders_id = " . $selections[$k];	
			}
			else
			{
				$dml = "update orders set  gl_transfered = 0 , treatment_date = ''
						where orders_id = " . $selections[$k];		
//echo $dml;						
			}
			
			$db->Execute($dml);

			
			if ($update_type==10)
			{
				$db->connect($ext_db_server['po'], $ext_db_username['po'], $ext_db_password['po'], $ext_db_database['po'], USE_PCONNECT, false);				  
			
				$sql = " select  ". $desc_expression . " 
				  from orders
				  where  orders_id = ".$selections[$k];

				  $rs = $db->Execute($sql);
				$desc = addslashes($rs->fields['value']);
				
				$db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);				  
				
				$dml = " insert into el_batch_items ( batch_id, item_id, database_code, description ) 
						 values ( ". $_GET['batch_id'] . ",".$selections[$k].",'".$po_database_code . "','". $desc ."')"; 
			}						
			else
			{
				$db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);				  
//echo "iii";	exit;		
				$dml = " delete from  el_batch_items
						 where item_id = ". $selections[$k] ; 			
			}			
			$db->execute($dml);
		}
	  }
	  else if (strlen($_GET['table_select'][0])>0)
	  {
		$ids = implode(',',$_GET['table_select']);
		if ($update_type==2)
		{
		   $dml = "delete 
		          from el_batch_items
				  where batch_id = ". $_GET['batch_id'] ."
				  and  item_id in ( ". $ids ." ) ";
            $db->Execute($dml);
		}
		else if ( ($update_type==3) 
		         || ($update_type==4) 
				 || ($update_type==5)  ) // 3 UPS  et  4 DHL
		{
		   if ($update_type==3)
		     $transporter='UPS';
		   else if ($update_type==4)
		     $transporter='DHL';
		   else if ($update_type==5)
		     $transporter='';
			 
		   $dml = "update el_batch_items
		           set transporter = '".$transporter."'
				   where batch_id = ". $_GET['batch_id'] ."
				   and  item_id in ( ". $ids ." ) ";
			//    and  item_id not in ( select a2.item_id from el_batch_items a2 where a2.batch_id = ". $_SESSION['current_batch'] ." )	   
            $db->Execute($dml);		
		}		
		else if ( ($update_type==8) 
		         || ($update_type==9)  ) // 3 UPS  et  4 DHL
		{
		   if ($update_type==8)
		     $sent=1;
		   else if ($update_type==9)
		     $sent=0;
			 
		   $dml = "update el_batch_items
		           set sent = '".$sent."'
				   where batch_id = ". $_GET['batch_id'] ."
				   and  item_id in ( ". $ids ." ) ";
			//    and  item_id not in ( select a2.item_id from el_batch_items a2 where a2.batch_id = ". $_SESSION['current_batch'] ." )	   
            $db->Execute($dml);		
		}				
		else if ($_GET['deplacer_vers']>0)
		{
/*		
		   $dml = "delete 
		          from el_batch_items
				  where batch_id = ". $_GET['deplacer_vers'] ."
				  and  item_id in ( ". $ids ." ) ";				  
            $db->Execute($dml);
		   $dml = "update el_batch_items
		           set batch_id = ".$_GET['deplacer_vers']."
				   where batch_id = ".$_GET['batch_id']."
				   and  item_id in ( ". $ids ." ) ";
				   
			//    and  item_id not in ( select a2.item_id from el_batch_items a2 where a2.batch_id = ". $_SESSION['current_batch'] ." )	   
            $db->Execute($dml);
*/			
		}
	  }
  }

  if ( 
       ( 
	      strlen($_GET['valider']) 
		  +  strlen($_GET['nouvelle_liste']) 
  	    )>0 
     )
  {  
	  
      if (  strlen($_GET['nouvelle_liste']) > 0 )
      {
      // récupération des informations 
		  /*
		  $lot_reporting = $_GET['lot_reporting'];
		  $lot_reporting_tab = explode('|', $lot_reporting);
		  
		  $treatment_date  = $lot_reporting_tab[0];
		  $po_database_code  = $lot_reporting_tab[1];
		  */
		  $treatment_date  = $_GET['treatment_date'];
		  $po_database_code  = $_GET['po_database_code'];
		  
	    $db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);
        $check = exec_select ("select 1 value  from el_batch where treatment_date = '".$treatment_date."' and po_database_code = '".$po_database_code."'");
		if ( $check == 1 )
		{
		    echo "<font color='red'> Un lot existe déjà pour le ".$treatment_date." pour la source : ".$po_database_code.", il a été ré-activé.</font>";
			$dml = "update el_batch 
			        set po_status = 'uncomplete'
					where treatment_date = '".$treatment_date."' and po_database_code = '".$po_database_code."'";

			$db->Execute( $dml );		

		}
		else
		{
			$dml = "insert into el_batch ( batch_name, batch_type, po_database_code, treatment_date,  po_status ,active ) 
					values ('". $treatment_date . ' - '. $po_database_code ."','po','". $po_database_code ."','". $treatment_date ."', 'uncomplete' ,1)";
//	echo $dml;exit;				
			$db->Execute( $dml );		
		}
		$_SESSION['current_batch'] = mysql_insert_id();			
		
      }
/*	  
      init_batch_items();
	  echo '
		<script language="JavaScript" type="text/javascript">
		  <!--
		  function returnParent() {
		    window.opener.location.reload(true);
		    window.opener.focus();
		    self.close();
		  }
		  //-->
		</script>
		</head>
		<!-- header_eof //-->
		<body onload="returnParent()">
		</body>
		</html>';
*/		
  }
?>  
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Gestion des listes</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body>
<br><br><br>
<form name="frm">
<input type="hidden" value=1 name='updating'>
<table width=100%>
<tr>
<td align=center>
<?php
  if ( strlen($_GET['current_batch'])>0 )
  {  
     $_SESSION['current_batch'] = $_GET['current_batch'];
  }
  else
  {  
     $_SESSION['current_batch'] = $_SESSION['selected_batch_id'];
  }  
  
/*
   $sql = "select distinct treatment_date
from   bo_po.orders 
order by treatment_date desc ";

*/
   $sql = "select distinct date(date_purchased) treatment_date
from   bo_po.orders 
order by date_purchased desc ";

   $rs = $db->Execute($sql);
   $html_td = '<select name=treatment_date_douchette>';
   while (!$rs->EOF)
   {
      $html_td .= '<option value="'.$rs->fields['treatment_date'].'">'.$rs->fields['treatment_date'];
      $rs->MoveNext();
   }   
   $html_td .= '</select>';
   
    echo '<form name="noName">';
    echo '<h2> Commandes à inclure dans les lots par douchette';
	echo $html_td. '&nbsp;&nbsp;<input type=submit value=" Enregistrer ">';
	echo '</h2>';
    echo '<textarea name="douchette_input" cols=8></textarea>';
	echo '</form>';
	echo '<hr>';

/* on est connecté sur gl par défaut, c'est la référence pour la gestion des listes */
   echo '<h2>Nouveau lot de reporting marge </h2>
	     Lot:';
	$db->connect($ext_db_server['po'], $ext_db_username['po'], $ext_db_password['po'], $ext_db_database['po'], USE_PCONNECT, false);

   $sql = "select distinct treatment_date
from   orders 
order by treatment_date desc ";
   $rs = $db->Execute($sql);
   echo '<select name=treatment_date>';
   while (!$rs->EOF)
   {
      echo '<option value="'.$rs->fields['treatment_date'].'">'.$rs->fields['treatment_date'];
      $rs->MoveNext();
   }   
   echo '</select>
   <select name=po_database_code>
   <option value="fr">fr
   <option value="es">es
   <option value="de">de
   <option value="en">en
   <option value="it">it
   <option value="eu">eu
   <option value="bf">bf
   <option value="hp">hpl   
   <option value="rq">rqdl 
   <option value="pl">pl-zdp    
   <option value="tb">tbi      
   </select>';
   
echo '&nbsp;&nbsp;<input type="submit" name="nouvelle_liste" value="ok">
</form>
   <br><br><br>';	
	
   echo '<h2>Lots de reporting marge en cours</h2>';
    echo '<table>';
	
	$db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);
	
    $sql = "select batch_id, batch_name, treatment_date,
                   po_database_code
		    from el_batch where active=1 
			and po_status='uncomplete'  
			order by treatment_date desc, batch_id desc
			limit 0,35";
//echo $sql; exit;
	
	$rsMain=$db->Execute($sql);
	while (!$rsMain->EOF)
	{ 
       echo '
          <tr>';
		$db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);
	   $sql = "select el_batch_items.item_id, el_batch_items.database_code,  el_batch_items.description,
	                  transporter, sent
	                  FROM  el_batch_items 
					  WHERE   el_batch_items.batch_id = " . $rsMain->fields['batch_id']. "
	                  ORDER BY item_id DESC";


	    $cntr = 0;
	    $cnt_sent = 0;
		
	    $li = $db->Execute($sql);
		$cntr=0;
		
	    while (!$li->EOF)
		{
		   $cntr++;  
		   $items_tab_id[$cntr] = $li->fields['item_id'];
		   $items_tab_db[$cntr] = $li->fields['database_code'];
		   $items_tab_description[$cntr] = $li->fields['description'];
		   $items_transporter[$cntr] = $li->fields['transporter'];
		   $items_sent[$cntr] = $li->fields['sent'];		   
		   
		   if ( $li->fields['sent']==1 )
		   {
		      $cnt_sent++;
		   }
		   if (strlen($li->fields['transporter'])>0)
		   {
		      $items_transporter[$cntr] = $items_transporter[$cntr] . ' ';
		   }
		   else
		   {
		      $items_transporter[$cntr] = 'xxx  ';
		   }
		   
		   $li->MoveNext();
	    }
		echo '
		  <form name=frm'.$rsMain->fields['batch_id'].'>	
		  <input type=hidden name=updating value=1>		  		  
		  <input type=hidden name=batch_id value='.$rsMain->fields['batch_id'].'>
          <td><b>
		  <table width=80%><tr>
		  <td>
		  <h2><font color=green>'.$rsMain->fields['batch_name'].'</font></h2>
		  </td>		  
		  &nbsp;&nbsp;&nbsp;
		  <td bgcolor=#eae5e5> &nbsp;&nbsp;&nbsp;	<h2>' .  $cntr   .  ' Commandes </h2> </td>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <td> &nbsp;&nbsp;&nbsp; <a href="javascript:document.frm'.$rsMain->fields['batch_id'].'.updating.value=18;document.frm'.$rsMain->fields['batch_id'].'.submit();">	<h2> Valider  </h2> </a> </td>
		  </tr></table>
		  <br>';
		 
		  /*
		  
		  <a href="javascript:document.frm'.$rsMain->fields['batch_id'].'.updating.value=8;document.frm'.$rsMain->fields['batch_id'].'.submit();">
		  Marquer pour envoyés( '. $cnt_sent .' / '. $cntr.' )</a>
		  
		  		  <a href="javascript:document.frm'.$rsMain->fields['batch_id'].'.updating.value=9;document.frm'.$rsMain->fields['batch_id'].'.submit();">
		  Marquer pour non envoyé</a></b>

*/
		
	    echo  '<select name="table_select[]" size="'.$cntr.'" multiple="multiple">';
		for($k=1;$k<=$cntr;$k++)
		{
		       if ($items_sent[$k]>0)
			   {
					$style = 'style="background:#d6cfcf"';
			   }
			   else
			   {
					$style = '';
			   }
		/*	   
			   echo '<option  '. $style .'  value="'. $items_tab_id[$k] .'" >'. $items_transporter[$k] . $items_tab_db[$k]. ' '. $items_tab_description[$k] .'</option>
';	   */
			   echo '<option  '. $style .'  value="'. $items_tab_id[$k] .'" >'. $items_tab_description[$k] .'</option>
';	  
		} 
//	 (orders_id,concat('  |  //',concat(customers_company,concat('  |  ',customers_name)))) orders_description
		echo '</select>';
	echo '</td>';
	echo '<td>';
    echo "&nbsp;";	
		  echo 'Reprise cmd perdue:<br>
		        <input type=text name=add_order><br>
		        <input type=submit value=valider onclick="javascript:document.frm'.$rsMain->fields['batch_id'].'.updating.value=15;document.frm'.$rsMain->fields['batch_id'].'.submit();">';
		  

/*		  
	
	echo '<center>
	      <a href="javascript:document.frm'.$rs->fields['batch_id'].'.updating.value=3;document.frm'.$rs->fields['batch_id'].'.submit();">
	      UPS
		  </a>';
	echo '&nbsp;&nbsp;&nbsp;<a href="javascript:document.frm'.$rs->fields['batch_id'].'.updating.value=4;document.frm'.$rs->fields['batch_id'].'.submit();">
	      DHL	
		  </a>';
	echo '&nbsp;&nbsp;&nbsp;<a href="javascript:document.frm'.$rs->fields['batch_id'].'.updating.value=5;document.frm'.$rs->fields['batch_id'].'.submit();" title="Aucun transposteur">
	      xxx
		  </a>
		  </center>';

	echo '<hr>';
	echo 'Déplacer vers..';
    echo get_select ( 'select batch_id code, batch_name description 
	                   from el_batch
					   where batch_id <> '. $rs->fields['batch_id'] .'
					   order by batch_id desc' , 
                      "deplacer_vers", 
					  '' , 
					  'onchange="document.frm'.$rs->fields['batch_id'].'.submit();"' );  
	echo '<hr>';
	echo 'Suppression .. <a href="javascript:document.frm'.$rs->fields['batch_id'].'.updating.value=2;document.frm'.$rs->fields['batch_id'].'.submit();"> <img border=0 src="images/icon_delete.gif"></a>';
	*/				  
	echo '</td>';
	echo '</tr>';

   echo '<tr><td align=center>
               <a href="javascript:document.frm'.$rsMain->fields['batch_id'].'.updating.value=10;document.frm'.$rsMain->fields['batch_id'].'.submit();">
			        <img height=30 width=18 src=arrow_up.gif>
			   </a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			   
               <a href="javascript:document.frm'.$rsMain->fields['batch_id'].'.updating.value=12;document.frm'.$rsMain->fields['batch_id'].'.submit();">
			        <img height=30 width=18 src=arrow_down.gif>
			   </a>		  
			   
			  </td>
	      <td align=center>
		  </td>
		  </tr>';
   $db->connect($ext_db_server['po'], $ext_db_username['po'], $ext_db_password['po'], $ext_db_database['po'], USE_PCONNECT, false);
	
    $sql = "select orders_id, treatment_date, ". $desc_expression . "
			  from orders
			  where  gl_transfered = 0 
			  and  database_code = '". $rsMain->fields['po_database_code']."'
			  order by orders_id desc 
			  limit 0,250";
			  //orders.orders_id = ".$ord_id;
			  
	$li = $db->Execute($sql);
	$cntr=0;
	
	while (!$li->EOF)
	{
	   $cntr++;  
//echo 	$li->fields['orders_id'];
	   $tab_orders_id[$cntr] = $li->fields['orders_id'];
	   $tab_description[$cntr] = $li->fields['value'];

	   $li->MoveNext();
	}
	echo '<td colspan=2>';
		echo  '<select name="table_select2[]" size="40" multiple="multiple">';
		for($k=1;$k<=$cntr;$k++)
		{
			echo '<option   value="'. $tab_orders_id[$k] .'" >'. $tab_description[$k]  .'</option>
';	   
		} 

	echo '</td>';

	echo '</tr>';
		
    echo '</form>';	

	echo '<tr>
	      <td colspan=2>
		  <hr>
		  </td>
		  </tr>';
/*	
	echo '<tr><td colspan=3>Nombre d\'éléments:'. $cntr .'</td></tr>';
	echo '<tr>
	        <td align=center>&nbsp;</td>
	        <td>&nbsp;&nbsp;&nbsp;<input type="submit" name="valider" value="OK"></td>			
	      <tr>';
*/		  
	 $rsMain->MoveNext();
   }
/*		  
	{
	   echo "&nbsp;";
	   echo '</td></tr></table>';
	}
*/	

    
		  
if  (  (strlen( $_SESSION['source_db'] )>0) &&  ( $_SESSION['source_db'] != 'gl' ) )
{
   $db->connect($ext_db_server[$_SESSION['source_db']], $ext_db_username[$_SESSION['source_db']], $ext_db_password[$_SESSION['source_db']], $ext_db_database[$_SESSION['source_db']], USE_PCONNECT, false);
}

 ?> 
<!-- body_eof //-->
</td>
</tr>
</table>
<br><br>
</body>
</html>
