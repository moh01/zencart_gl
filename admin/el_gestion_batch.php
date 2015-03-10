<?php
  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
  
  require(DIR_WS_CLASSES . 'order.php');
  global $db;  

//echo $_SESSION['active_batches_ids'];exit;  
  
    $desc_expression = "concat( orders_id , '   ----   ',  payment_module_code, '   ----    ' ,  customers_company ,'   ----    ',customers_name,'  |  ',customers_email_address,'  |  ', customers_country,'  |  ', customers_city ) value";


  // gestion de la validation (OK)
//echo '???'.$_GET['updating'].'///'.$_GET['table_select'].'ff';
  if ( strlen ($_GET["douchette_input"])>0 )
  {
echo "in";  
//echo $treatment_date;exit;
	  $dblist = "fr,es,de,en,it,eu,bf,hp,rq,pl,tb";
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
												
					}
				}	
				$creation_item	= 1;
				if (strlen($la_base)==0)
				{
				
					$creation_item = 0;
		
					echo "<font color=red>Commande ".$order_id." non trouvée dans les bases de données de commande.</font>";
				}
				else
				{
//					echo 'la base'.$la_base.'<br>';
				}
				if ( $creation_item )
				{				
					// on applique l'ajout au lot
/*					
					$dml = " delete from  el_batch_items where item_id = ". $order_id; 			
					$db->Execute($dml);
*/
					$batch_id = $_SESSION['active_batches_ids'];
					
					// $treatment_date
					$dml = " insert into el_batch_items ( batch_id, item_id, database_code, description ) 
							 values ( ". $batch_id . ",".$order_id.",'".$la_base . "','". $description ."')"; 
							 
//echo $dml;exit;
							 
					$db->Execute($dml);
					
					
					$cnt_orders_treated++;
					echo "<font color=green>Commande ". $order_id . " insérée pour le lot ". $la_base .'</font><br>';
					
				}
			}
			
	   }
	}

  if ($_GET['updating']>=1)
  {
      if (strlen($_GET['table_select'][0])>0)
	  {
		$ids = implode(',',$_GET['table_select']);
		if ($_GET['updating']==2)
		{
		   $dml = "delete 
		          from el_batch_items
				  where batch_id = ". $_GET['batch_id'] ."
				  and  item_id in ( ". $ids ." ) ";
            $db->Execute($dml);
		}
		else if ( ($_GET['updating']==3) 
		         || ($_GET['updating']==4)
		         || ($_GET['updating']==6) 				 
				 || ($_GET['updating']==5)  ) // 3 UPS  et  4 DHL
		{
		   if ($_GET['updating']==3)
		     $transporter='UPS';
		   else if ($_GET['updating']==4)
		     $transporter='DHL';
		   else if ($_GET['updating']==6)
		     $transporter='GLS';			 
		   else if ($_GET['updating']==5)
		     $transporter='';
			 
		   $dml = "update el_batch_items
		           set transporter = '".$transporter."'
				   where batch_id = ". $_GET['batch_id'] ."
				   and  item_id in ( ". $ids ." ) ";
			//    and  item_id not in ( select a2.item_id from el_batch_items a2 where a2.batch_id = ". $_SESSION['current_batch'] ." )	   
            $db->Execute($dml);		
		}		
		else if ( ($_GET['updating']==8) 
		         || ($_GET['updating']==9)  ) 
		{
		   if ($_GET['updating']==8)
		     $sent=1;
		   else if ($_GET['updating']==9)
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
	    $dml = "insert into el_batch ( batch_name,active ) values ('". addslashes( $_GET['nom_liste'] )." ',1)";
	    $db->Execute( $dml );
		$_SESSION['current_batch'] = mysql_insert_id();			
		
      }	  
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
/* --------------------------- CHAMP DE SAISIE DOUCHETTE ---------------------------------------------*/
    if  ( (strlen($_SESSION['active_batches_ids'])>0) && is_numeric($_SESSION['active_batches_ids']) )
	{
		echo '<form name="noName">';
		echo '<h2> Commandes à inclure dans le lot courant par douchette';
		echo '</h2>';
		echo '<textarea name="douchette_input" cols=8></textarea>';
		echo '<br><br><input type=submit value=" Enregistrer ">';
		echo '</form>';
		echo '<hr><hr>';
	}

  
/* on est connecté sur gl par défaut, c'est la référence pour la gestion des listes */
   echo '<h2>Nouvelle liste d\'envoi </h2>
	     Nom (sans apostrophes)<input type="text" name="nom_liste" size=15>
&nbsp;&nbsp;<input type="submit" name="nouvelle_liste" value="ok">
</form>
   <br><br><br>';

   echo '<h2>Listes d\'envoi actives</h2>';

    echo'<table>';
    $sql = "select batch_id, batch_name  from el_batch where batch_type='gl' and active=1 order by batch_id desc";
//echo $sql; exit;	
	$rs=$db->Execute($sql);
	while (!$rs->EOF)
	{
	
       echo '
          <tr>';
	    
	   $sql = "select el_batch_items.item_id, el_batch_items.database_code,  el_batch_items.description,
	                  transporter, sent
	                  FROM  el_batch_items 
					  WHERE   el_batch_items.batch_id = " . $rs->fields['batch_id']. "
	                  ORDER BY transporter, id DESC";
		$cntr = 0;
	    $cnt_sent = 0;
		
	    $li = $db->Execute($sql);
		$cntr=0;
	    while (!$li->EOF)
		{
		   $cntr++;  
//echo 	$li->fields['orders_id'];
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
		  <form name=frm'.$rs->fields['batch_id'].'>	
		  <input type=hidden name=updating value=1>		  		  
		  <input type=hidden name=batch_id value='.$rs->fields['batch_id'].'>
          <td><b>
		  <table><tr>
		  <td>
		  <font color=green>'.$rs->fields['batch_name'].'</font>
		  </td>		  
		  &nbsp;&nbsp;&nbsp;
		  <td bgcolor=#eae5e5>
		  <a href="javascript:document.frm'.$rs->fields['batch_id'].'.updating.value=8;document.frm'.$rs->fields['batch_id'].'.submit();">
		  Marquer pour envoyés( '. $cnt_sent .' / '. $cntr.' )</a>
		  </td>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <td>		  
		  <a href="javascript:document.frm'.$rs->fields['batch_id'].'.updating.value=9;document.frm'.$rs->fields['batch_id'].'.submit();">
		  Marquer pour non envoyé</a></b>
		  </td>		  
		  </tr></table>
		  <br>';
		
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
			   
			   echo '<option  '. $style .'  value="'. $items_tab_id[$k] .'" >'. $items_transporter[$k] . $items_tab_db[$k]. ' '. $items_tab_description[$k] .'</option>
';	   
		} 

//	 concat(orders_id,concat('  |  //',concat(customers_company,concat('  |  ',customers_name)))) orders_description
		echo '</select>';
	echo '</td>';
	echo '<td>';
	echo '<center>
	      <a href="javascript:document.frm'.$rs->fields['batch_id'].'.updating.value=3;document.frm'.$rs->fields['batch_id'].'.submit();">
	      UPS
		  </a>';
	echo '&nbsp;&nbsp;&nbsp;<a href="javascript:document.frm'.$rs->fields['batch_id'].'.updating.value=4;document.frm'.$rs->fields['batch_id'].'.submit();">
	      DHL	
		  </a>';
	echo '&nbsp;&nbsp;&nbsp;<a href="javascript:document.frm'.$rs->fields['batch_id'].'.updating.value=6;document.frm'.$rs->fields['batch_id'].'.submit();">
	      GLS	
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
					  
	echo '</td>';
	echo '</form>';	
	echo '</tr>';
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
	 $rs->MoveNext();
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
