<?php
  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
  require('includes/common_sets.php');
  
  
  global $db;
  
 function get_countries_from_language ( $p_language_id )
 {
    
    // francais
    if ($p_language_id == 2 )
    {
        return 'in (99999,21,73,76,124,99999)'; //  belgique luxembourg 
    }  
    // espagnol
    else if ($p_language_id==3)
    {
        return 'in (99999,195,196,99999)';
    }
    // allemand
    else if ($p_language_id==4)
    {
     //   return 'in (14,81,204)';
		return 'in (99999,81,99999)';
    }
    else if ($p_language_id==5) // anglais
    {
        return 'in (99999,46,45,222,99999)';
    }		
	// italien 
    else if ($p_language_id==6)
    {
        return 'in (99999,105,182,99999)';
    }	
    else if ($p_language_id==7)
    {
        return 'in (99999,170,99999)';
    }		
    else
    {
        return 'in (99999,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,75,77,78,79,80,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,215,216,217,218,219,220,221,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,501,99999)';    
    }
 }  
  $canaux="leud,leum,lrv";
  
  $canal_label['leud']='LAMPES  DIRECT';
  $canal_label['leum']='LAMPES  MKP';
  $canal_label['lrv']='LAMPES RV';
  
  $canal_tab=explode(',',$canaux);
/*  
  $canal['peud']='LAMPES END USERS DIRECT';
  $canal['peum']='LAMPES END USERS MKP';
*/
  // tt = total
  
  $zones="fr,es,de,en,it,pl,hp,rq,Total";
  $zone_tab=explode(',',$zones);
  
  $zone_colors="#cbcbcb,#dbd9d9,#e9e8e8,#f5f3f3,#fefdfd,e5d7d7,e7fbef";
  $zone_color_tab=explode(',',$zone_colors);

  function check_canal_zone($canal,$zone,$country,$database,$payment)
  {
    $response = 1;
	global $zone_geo_values;
	  
	// on vérifie le CANAL  -----------------------

	// lampe EU Direct	----
	if ( $canal == "leud" )
	{
	   if  ( $database == "bf" )
			$response = 0;
		 
	   if ( $payment == "MKP" )
			$response = 0;
			
   	   if ( $database == "eu" )
			$response = 0;
			
	}
	// lampe EU Marketplace	----	
	if ( $canal == "leum" )
	{
	   if  ( $database == "bf" )
			$response = 0;
		 
	   if ( $payment != "MKP" )
			$response = 0;
			
   	   if ( $database == "eu" )
			$response = 0;
			
	}
	if ( 
	    ( $canal == "leum" )
		|| 
		( $canal == "leud" )
		)
	{
//echo $database .'||'. $zone . '<br>';

	if (  ( $zone != "Total" ) &&  ( $database != $zone ) )
	   {
			return 0;
	   }
    }
	// lampe EU Revendeur	----	
	if ( $canal == "lrv" )
	{
	   if  ( $database != "eu" )
			$response = 0;		 
	}
	
	// on vérifie la ZONE  -----------------------
	if ( ($zone !="Total") )
    {	
//echo '<br><br>';
///	echo '..'.$zone_geo_values[$zone].'|'. $country  .'......<br>';
        if  ( (strlen($country)>0) && ( $canal == "lrv" )  )
        {		
//			if ( ! ( strpos(  $zone_geo_values[$zone],$country ) )  )
//echo 'PPP'.$lg_id[$zone].'MMM'.$zone.'|'.get_countries_from_language($lg_id[$zone]).'|'.$country.'||'.strpos(  get_countries_from_language($zone) ,$country ).'<br><br>';
/*
	  $lg_id['fr']==2;
	  $lg_id['es']==3;
	  $lg_id['de']==4;
	  $lg_id['en']==5;
	  $lg_id['en']==6;
	  $lg_id['ex']==7;
*/
		if ($zone=="fr")
			$zn = 2;
		else if ($zone=="es")
			$zn = 3;		
		else if ($zone=="de")
			$zn = 4;				
		else if ($zone=="en")
			$zn = 5;						
		else if ($zone=="it")
			$zn = 6;								
		else if ($zone=="pl")
			$zn = 7;								
		else
			$zn = 8;											
		
			if ( ! ( strpos(  get_countries_from_language($zn),','.$country.',' ) )  )				
			{
				$response = 0;
			}		
		}
    }
	return $response; 
  }
  

   $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  
  if (strlen($_GET['year'])>0)
  {
     $add_where .= " and date_format(treatment_date,'%Y')= ".$_GET['year'];
	  if (strlen($_GET['month'])>0)
	  {
		 $add_where .= " and date_format(treatment_date,'%c')= ".$_GET['month'];     
	  }
	  if (strlen($_GET['day'])>0)
	  {
		 $add_where .= " and date_format(treatment_date,'%d')<= ".$_GET['day'];     
	  }	  
  }
  
  $sql = 'select distinct treatment_date
	  from   orders
	  where  treatment_date <> "0000-00-00"
	  and    gl_transfered = 1
	  ' . $add_where . '
	  order by treatment_date';
//echo $sql;exit;	  
   $rs = $db->Execute($sql);
   	  
   while ( !$rs->EOF )
   {
     $jours[]=$rs->fields['treatment_date'];
	 $rs->MoveNext();
   }

   if ($_GET['montant']==1)
   {
      $add_select = " sum(products_quantity*margin) ";   
   }
   else
   {
      $add_select = " round(sum(products_quantity),0) ";
   }
   
  
   $html .= '<table>';
   // Les entetes canal /// 
    $html .= '<tr>';  
	$html .= '<th></th>'; 
   for($j=0;$j<count($canal_tab);$j++)
   {		
		$html .= "<th colspan=".count($zone_tab).">".  $canal_label[$canal_tab[$j]] . "</th>";
   }   
   $html .= '</tr>';

   // Les entetes zone ///      
   $html .= '<tr>';
   $html .= '<th>Date</th>';    
   for($j=0;$j<count($canal_tab);$j++)
   {
         for($k=0;$k<count($zone_tab);$k++)
		 {
			if (($canal_tab[$j]=="lrv")&&($zone_tab[$k]=="hp"))
			{
				$html .= '<th width=40 bgcolor='.$zone_color_tab[$k].'>exp</th>';
			}
			else if (($canal_tab[$j]=="lrv")&&($zone_tab[$k]=="rq"))
			{
				$html .= '<th width=40 bgcolor='.$zone_color_tab[$k].'></th>';			
			}
			else
			{
				$html .= '<th width=40 bgcolor='.$zone_color_tab[$k].'>'. $zone_tab[$k].'</th>';
			}
			
		 }
   }
   $html .= '<th width=80 bgcolor=#ecc1c1>Total tous canaux</th>';       
   $html .= '</tr>';

   
   // pour chaque date //
   for($l=0;$l<count($jours);$l++)
   {
     $sql = "SELECT sum(margin) marge,
			  ". $add_select . " qty,
			  o.customers_countries_id,
			  o.database_code, 
		      left(payment_module_code,3) payment
		FROM orders o,
		   orders_products
		WHERE o.orders_id >0
		and o.gl_transfered=1
		and products_quantity > 0
		and final_price > 0
		and unit_order_price > 0
		AND o.database_code <> 'po'
		AND orders_products.products_model NOT
IN (
'SHF', 'CODF', 'ECOF', 'ESCF', 'FRSH', 'FRS', 'SP400','DUSTGO','INSUR'
)
		AND orders_products.orders_id = o.orders_id
		and o.treatment_date = '".$jours[$l]."'
		group by o.customers_countries_id,
			  o.database_code, 
		      left(payment_module_code,3)";
			  

           $margins=Array();
           $qties=Array();
           $countries=Array();
           $databases=Array();		   
           $payments=Array();
		   
           $db->Execute($sql);
		   $rs=$db->Execute($sql);
		   
		   while(!$rs->EOF)
		   {
  		     $margins[]=$rs->fields['marge'];
		     $qties[]=$rs->fields['qty'];
		     $countries[]=$rs->fields['customers_countries_id'];
			 $databases[]=$rs->fields['database_code'];
		     $payments[]=$rs->fields['payment'];
//echo $rs->fields['customers_country'];exit;
			 $rs->MoveNext();
		   }
//echo $sql.'|'.count($margins).'<br>';
		   
		   $html .= "<tr>";
	
		   $html .= "<th>".  $jours[$l] . "</th>";
		   for($j=0;$j<count($canal_tab);$j++)
		   {
				 for($k=0;$k<count($zone_tab);$k++)
				 {
				    // on checke les CANAUX et les PAYS
					$cell_qty = "";
					for ($m=0;$m<count($margins);$m++)
					{
						if ( check_canal_zone($canal_tab[$j],$zone_tab[$k],$countries[$m],$databases[$m],$payments[$m]) )
						{
						   //$cell_qty += $margins[$m];
						   $cell_qty+=$qties[$m];
						}
					}
					if ( ($zone_tab[$k]=="rq") && ($canal_tab[$j]=="lrv") )
					{
						$html .= '<td width=40 align=center bgcolor='.$zone_color_tab[$k].'></td>';				
					}
					else
					{
						$html .= '<td width=40 align=center bgcolor='.$zone_color_tab[$k].'>'. number_format ( $cell_qty , 0 , ',' , ' ' ). '</td>';
					}				
					$total[$j][$k]+= $cell_qty;
//echo $l.'||'.$total_total[$l].'-'.	$cell_qty .'<br>';				
					if ($zone_tab[$k]<>'Total')
					{
						if  ( ! ( ($zone_tab[$k]=="rq") && ($canal_tab[$j]=="lrv") ) )
						{
							$total_total[$l]+= $cell_qty;					
//echo  $zone_tab[$k]. ' || '.	 $cell_qty ."<br>";					
							
						}
					}
				 }
//				 $total_total[$k]=
		   }
		   $html .= '<td  align=center bgcolor=#ecc1c1>'. number_format ( $total_total[$l], 0 , ',' , ' ' ). '</td>';
		   $total_total_total += $total_total[$l];

		   $html .= "</tr>";
		
   }
   // LA LIGNE DE TOTAUX ------------------------------
   $html .= "<tr>";
   $html .= "<th>Total</th>";
   for($j=0;$j<count($canal_tab);$j++)
   {
		 for($k=0;$k<count($zone_tab);$k++)
		 {
			if ( ($zone_tab[$k]=="rq") && ($canal_tab[$j]=="lrv") )
			{
				$html .= '<td width=40 align=center bgcolor='.$zone_color_tab[$k].'></td>';				
			}
			else
			{
				$html .= '<td width=40 align=center bgcolor='.$zone_color_tab[$k].'>'. number_format ( $total[$j][$k] , 0 , ',' , ' ' )   . '</td>';
			}
		 }
   }
   $html .= '<td  align=center bgcolor=#ecc1c1>'. number_format ( $total_total_total, 0 , ',' , ' ' ). '</td>';		 
   
   $html .= "</tr>";   
   $html .= '</table>';
   
   echo  $html;
?>