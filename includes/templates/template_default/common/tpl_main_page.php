<?php
/**
 * Common Template - tpl_main_page.php
 *
 * Governs the overall layout of an entire page<br />
 * Normally consisting of a header, left side column. center column. right side column and footer<br />
 * For customizing, this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * - make a directory /templates/my_template/privacy<br />
 * - copy /templates/templates_defaults/common/tpl_main_page.php to /templates/my_template/privacy/tpl_main_page.php<br />
 * <br />
 * to override the global settings and turn off columns un-comment the lines below for the correct column to turn off<br />
 * to turn off the header and/or footer uncomment the lines below<br />
 * Note: header can be disabled in the tpl_header.php<br />
 * Note: footer can be disabled in the tpl_footer.php<br />
 * <br />
 * $flag_disable_header = true;<br />
 * $flag_disable_left = true;<br />
 * $flag_disable_right = true;<br />
 * $flag_disable_footer = true;<br />
 * <br />
 * // example to not display right column on main page when Always Show Categories is OFF<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 * <br />
 * example to not display right column on main page when Always Show Categories is ON and set to categories_id 3<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '' or $cPath == '3') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php 3856 2006-06-29 02:26:33Z drbyte $
 */

// the following IF statement can be duplicated/modified as needed to set additional flags
  if (in_array($current_page_base,explode(",",'list_pages_to_skip_all_right_sideboxes_on_here,separated_by_commas,and_no_spaces')) ) {
    $flag_disable_right = true;
  }
  require(   DIR_WS_INCLUDES. '/languages/' . $_SESSION['language'] . '/' . 'el_libelles.php');


  $header_template = 'tpl_header.php';
  $footer_template = 'tpl_footer.php';
  $left_column_file = 'column_left.php';
  $right_column_file = 'column_right.php';
  $body_id = str_replace('_', '', $_GET['main_page']);
  // echo $body_id;
  $args = explode("_", $cPath );
  $marque = $args[0];  
  $model = $args[1];


  if ($_SESSION['customer_id'] == '')
  {
     $connected = 0;
  }
  else
  {
     $connected = 1;
  }

?>
<body id="<?php echo $body_id . 'Body'; ?>"<?php if($zv_onload !='') echo ' onload="'.$zv_onload.'"'; ?>>
<?php
  if (SHOW_BANNERS_GROUP_SET1 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET1)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerOne" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>

<div id="mainWrapper">
<?php
 /**
  * prepares and displays header output
  *
  */
  require($template->get_template_dir('tpl_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_header.php');
  
//  echo '<a href="'. zen_href_link($_GET['main_page'], zen_get_all_get_params(array('language', 'currency')) . 'language=en', $request_type) .'">test</a>';
  echo '
<div id="conteneur">

	<!-- Bandeau supérieur-->
	<div id="bandeauSuperieur_'. $_SESSION['languages_id'] . '">
		<ul id="drapeaux">
			<!-- 
			<li id="anglais"><a href="'. zen_href_link($_GET['main_page'], zen_get_all_get_params(array('language', 'currency')) . 'language=en', $request_type) .'" ></a></li>
			<li id="francais"><a href="'. zen_href_link($_GET['main_page'], zen_get_all_get_params(array('language', 'currency')) . 'language=fr', $request_type) .'"></a></li>
			<li id="espagnol"><a href="'. zen_href_link($_GET['main_page'], zen_get_all_get_params(array('language', 'currency')) . 'language=es', $request_type) .'"></a></li>
			<li id="allemand"><a href="'. zen_href_link($_GET['main_page'], zen_get_all_get_params(array('language', 'currency')) . 'language=de', $request_type) .'" ></a></li>
			<li id="italien"><a href="#" title="Version italienne"></a></li>
		          -->
			<li id="anglais"><a href="'. zen_href_link($_GET['main_page'], zen_get_all_get_params(array('language', 'currency')) . 'language=en', $request_type) .'" ></a></li>
			<li id="francais"><a href="'. zen_href_link($_GET['main_page'], zen_get_all_get_params(array('language', 'currency')) . 'language=fr', $request_type) .'"></a></li>
			<li id="espagnol"><a href="'. zen_href_link($_GET['main_page'], zen_get_all_get_params(array('language', 'currency')) . 'language=es', $request_type) .'"></a></li>
			<li id="allemand"><a href="'. zen_href_link($_GET['main_page'], zen_get_all_get_params(array('language', 'currency')) . 'language=de', $request_type) .'" ></a></li>
			<li id="italien"><a href="javascript:alert(\'To be coming soon\');"></a></li>
		</ul>	
	</div> ';
 
	echo '
	<script>
		var timerEffacement = null;
		var sousMenuAffiche = new Array();
		sousMenuAffiche[\'smenuInfo\']= null;

		  function hide_dropdowns(what){
			if (window.navigator.userAgent.indexOf(\'MSIE 6.0\') != -1)
			{
				var selectControls=document.getElementsByTagName("select");
				for (var i=0; i<selectControls.length; i++)
				{
			
				    if (what=="in")
					{
						selectControls[i].style.visibility=\'hidden\';
					}
					else
			        {		
					    selectControls[i].style.visibility=\'visible\';
					}
				}	
			}
		  }

		function sousMenuEstAffiche(id) 
		{
			return (sousMenuAffiche[id]	!= null);
		}

		function montrerSousMenu(id) 
		{
		//	On annule le timer si enclenché
			if (timerEffacement != null)
				annulerTimer();
		//	On efface l\'autre menu si affiché
		//	if (sousMenuEstAffiche(autreSousMenu(id)))
		//		cacherSousMenus(autreSousMenu(id));
		
            hide_dropdowns("in");
			
			if (!sousMenuEstAffiche(id))
			{
				sousMenuAffiche[id]	= document.getElementById(id);
				if (sousMenuAffiche[id])
				{
					sousMenuAffiche[id].style.display = \'block\';
				}
			}
		}

		function effacerSousMenu(id)
		{
            hide_dropdowns("out");

			if (sousMenuEstAffiche(id))
				if (timerEffacement == null)
					timerEffacement = window.setTimeout(\'cacherSousMenus("\'+id+\'")\', 150);
		}
		function cacherSousMenus(id)
		{
			if (sousMenuEstAffiche(id))
			{
				sousMenuAffiche[id].style.display = \'none\';
				sousMenuAffiche[id] = null;
			}
		}

		function annulerTimer()
		{
			if (timerEffacement != null)
			{
				window.clearTimeout(timerEffacement);
				timerEffacement = null;
			}
		}

		
	</script>
	<div id="menu">	
	<ul id="navigation">
		<li class="l5"><a href="index.php?main_page=index">'. MENU_ACCUEIL .'</a></li>
		<li class="l3">
            	<a href="#" onmouseover="montrerSousMenu(\'smenuInfo\');" onmouseout="effacerSousMenu(\'smenuInfo\');">
                	'. MENU_INFO .'
				</a>
                <div id="smenuInfo">
                    <ul class="navigation vertical">  
                        <li class="l5"><a href="index.php?main_page=privacy"  onMouseOver="montrerSousMenu(\'smenuInfo\');" onMouseOut="effacerSousMenu(\'smenuInfo\');">'. MENU_A_PROPOS .'</a></li>
    					<li class="l5"><a href="index.php?main_page=page_6"  onMouseOver="montrerSousMenu(\'smenuInfo\');" onMouseOut="effacerSousMenu(\'smenuInfo\');">'. MENU_SAV .'</a></li>
    					<li class="l5"><a href="index.php?main_page=conditions"  onMouseOver="montrerSousMenu(\'smenuInfo\');" onMouseOut="effacerSousMenu(\'smenuInfo\');">'. MENU_CGV .'</a></li>						
                        <li class="l5"><a href="index.php?main_page=page_2"  onMouseOver="montrerSousMenu(\'smenuInfo\');" onMouseOut="effacerSousMenu(\'smenuInfo\');">'. MENU_ENVIRONNEMENT .'</a></li>';

				 if ( $_SESSION['customer_id']  )
				 {
                 echo '<li class="l5"><a href="index.php?main_page=shippinginfo"  onMouseOver="montrerSousMenu(\'smenuInfo\');" onMouseOut="effacerSousMenu(\'smenuInfo\');">'. MENU_FRAIS .'</a></li>';
//				 echo '<li class="l5"><a href="index.php?main_page=conditions"  onMouseOver="montrerSousMenu(\'smenuInfo\');" onMouseOut="effacerSousMenu(\'smenuInfo\');">'. MENU_CGV .'</a></li>';
				 }	
                    echo '<li class="l5"><a href="index.php?main_page=contact_us&contact_type=CMM"  onMouseOver="montrerSousMenu(\'smenuInfo\');" onMouseOut="effacerSousMenu(\'smenuInfo\');">'. MENU_REMARQUES .'</a></li>						
						 </ul>
                </div>	
		</li>		
		<li class="l3"><a href="index.php?main_page=contact_us">'. MENU_CONTACT .'</a></li>
		<li class="l5"><a href="index.php?main_page=page_4">'. MENU_INFO_LAMPE .'</a></li>		
		<li class="l3"><a href="index.php?main_page=shopping_cart">'. MENU_PANIER .'</a></li>
		<li class="l3"><a href="index.php?main_page=account">'. MENU_COMPTE .'</a></li>
	</ul>	
	</div>

	<div id="panneauCentral">
 	<!-- Bandeau latéral gauche --> ';	
	
//                       <li class="l5"><a href="index.php?main_page=page_7"  onMouseOver="montrerSousMenu(\'smenuInfo\');" onMouseOut="effacerSousMenu(\'smenuInfo\');">'. MENU_CHANGEMENT .'</a></li>
//                        <li class="l5"><a href="index.php?main_page=page_8"  onMouseOver="montrerSousMenu(\'smenuInfo\');" onMouseOut="effacerSousMenu(\'smenuInfo\');">'. MENU_DUREE .'</a></li>						
    if  ( $current_page_base!="advanced_search_result" )
	{
	    if ( ! $_SESSION['customer_id']  )
		{
	      if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass']))
		  {
		     $username = $_COOKIE['cookname'];
		     $password = $_COOKIE['cookpass'];
		  }

	  
		echo '<div  id="panneauLateralGauche">
				<div id="panneauLatG_login">
					<h2 style=" font-size: 12pt; ">'. INVITE_LOG .'</h2>
					<form name="login"  action="index.php?main_page=login&amp;action=process&amp" method="post">
						<label for="email_address" style=" font-size: 9pt; ">'. USERNAME .'</label>
						<input name="email_address" value="' . $username . '" size="27" type="text"/>
						<br/>
						<label for="password" style=" font-size: 9pt; ">'. PWD .'</label>
						<input name="password" size="27"  value="' . $password . '"   type="password"/>
						<button class="okRond" onclick="submit();"></button>
						<br/>
						<input align="right" name="remember" type="checkbox"/>
						<label id="memoriserMotDePasse" for="memoriserMotDePasse" style=" font-size: 10pt; ">'. REMEMBER_PWD .'</label>
						<p style=" font-size: 11pt; "><a class="lienSimple" href="index.php?main_page=password_forgotten">'. PWD_OUBLIE .'</a></p>
					</form>
				</div>
				<div id="panneauLatG_ouvrirCompte">
					<h2><a href="index.php?main_page=login" ><span style="color: rgb(255, 105, 0); font-size: 12pt; ">' .  OUVRIR_COMPTE . '</span></a></h2>
					<a class="lienSimple" href="index.php?main_page=contact_us" style=" font-size: 10pt; " >' .  CONTACT_CONSEILLER . '</a>
				</div>

			';
		}
		else
		{
	      
            $customers_id = $_SESSION['customer_id'];
            $sql = "select entry_company, customers.customers_email_address, main_price_list_id 
			       from address_book, customers
 				   where 	customers_default_address_id = address_book.address_book_id 
				   and      customers.customers_id = " .$customers_id ;
				   $customer_check = $db->Execute($sql);
	        $entry_company = $customer_check->fields['entry_company'];
	        $entry_email = $customer_check->fields['customers_email_address'];
		    $main_price_list_id = $customer_check->fields['main_price_list_id']; 		
		
		echo '<div  id="panneauLateralGauche">
				<div id="panneauLatG_login">
					<table align=left><tr valign=center align=center><td><font style=" font-size: 10pt; ">'. $entry_email .' </font> </td><td width=80><a href="index.php?main_page=logoff"> <img src="includes/templates/template_default/images/button_disconnect.gif" alt="'.MENU_DECONNECTER.'"></a></td></tr></table><br>';
        if ( $_SESSION['administrator'] )
		   echo '<br><B>Mode administrateur</B>';
		   
        if ( ! $main_price_list_id )
		   echo '<br><B>'. WAITING_VALIDATION .'</B>';
		   
		if ($_SESSION['cart']->count_contents()>0)
	    {
		   echo 	'<br>
		            <a class="lienSimple" href="index.php?main_page=shopping_cart" style=" font-size: 10pt; " >' .  VOTRE_PANIER1 .'<br>'. $_SESSION['cart']->count_contents() . ' ' . VOTRE_PANIER2 . '&nbsp;&nbsp;&gt;&gt;</a>
					<br><br>';
	    }	
        else
        {
		   echo '<br><br><br><br>';
        }		
		   echo 	'<h3 style=" font-size: 12pt; "><a href="index.php?main_page=account_edit">'. CHANGER_EMAIL .'&nbsp;&nbsp;&gt;&gt;</a></h3>
	 				 <h3 style=" font-size: 12pt; "><a href="index.php?main_page=account">'. INFORMATIONS_COMPTE .'&nbsp;&nbsp;&gt;&gt;</a></h3>
	                 <h3 style=" font-size: 12pt; "><a href="index.php?main_page=account_history">'. HISTORIQUE .'&nbsp;&nbsp;&gt;&gt;</a></h3>  ';  		
				
		echo  '</div>
				<div id="panneauLatG_ouvrirCompte">
				    <br><br>
					<a class="lienSimple" href="index.php?main_page=contact_us&contact_type=RA" style=" font-size: 10pt; " >' .  DEMANDE_DE_RETOUR . '&nbsp;&nbsp;&gt;&gt;</a>
				</div>
			';
		}		
		echo '				<div id="panneauLatG_bas">
					<div id="panneauLatG_bulbes_'. $_SESSION['languages_id'] .'">
						<a href="index.php?main_page=page_4#BC">'.CLIQUEZ_ICI . '</a>
					</div>
					<div id="panneauLatG_lampesOI_'. $_SESSION['languages_id'] .'">
						<a href="index.php?main_page=page_5">'. CLIQUEZ_ICI .'</a>
					</div>
				</div>
			</div>';
		
    } //  current_page_base!="advancedSearhR
   //        width:734px;	
   if (  ! strpos( $_SERVER['HTTP_USER_AGENT'],'MSIE 6.0' )  && $current_page_base!="advanced_search_result"  )
     $width_stmt = 'width:734px;';
	
   
		   if (! $model && ( $current_page_base == 'index'  )  )		   
		     echo '<div id="contenuDroit"  style="background-color:#FFFFFF;height:435px;'.  $width_stmt .'">';
		   else
		     echo '<div id="contenuDroit"  style="background-color:#FFFFFF;'.  $width_stmt .'">';
		
    $temp = $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); 
	$temp = str_replace('advanced_search', 'index', $temp );
if ((DEFINE_BREADCRUMB_STATUS == '1')&&(  strpos($temp,"::",strpos($temp,"::")+2) ) ) { 
    ECHO '<div id="navBreadCrumb2">';
    echo '&nbsp;' . $temp;
    ECHO '</div>';
    ECHO '<hr style="border:1px dotted #009;" >';
} 
// <!-- eof breadcrumb -->

		
   if (! $model && ( $current_page_base == 'index'  )  )
   {
   //  
   echo '	<div id="contenuDroit_haut" bgcolor=white>
                <h2>'. SLOGAN1 . '<em style="font-size: 14pt;">'. SLOGAN2 .'</em>'. SLOGAN3.'<br>'. SLOGAN4.'<em style="font-size: 14pt;">'. SLOGAN5.'</em></h2>
			</div>
			<div id="contenuDroit_rechercher_' . $_SESSION['languages_id'] . '">			
				<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. RECHERCHE_VIDEO .'</h2>';


     if ( $connected )
     {
     }
     else
     {
     }
     ?>

	 
         <?php
         if ( ( $body_id=="index" ) && ! $model )
		 {
		 }         
         ?>
<?php
		// echo '	<div  style="float: right;"><img src="satis.gif"> </div>';

/*
 modifications FV
*/
  $flag_disable_left = true;
  $flag_disable_right = true;
  require(DIR_WS_MODULES . zen_get_module_directory('column_left.php'));
if (!isset($flag_disable_left) || !$flag_disable_left) {
?>

 <td id="navColumnOne" class="columnLeft" style="width: <?php echo COLUMN_WIDTH_LEFT; ?>">

<?php
 /**
  * prepares and displays left column sideboxes
  *
  */
?> 
<div id="navColumnOneWrapper" style="width: <?php echo BOX_WIDTH_LEFT; ?>"><?php  require(DIR_WS_MODULES . zen_get_module_directory('column_left.php')); ?></div></td>
<?php
}
?>


<?php
  if (SHOW_BANNERS_GROUP_SET3 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET3)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerThree" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>

<!-- bof upload alerts -->
<?php if ($messageStack->size('upload') > 0) echo $messageStack->output('upload'); ?>
<!-- eof upload alerts -->

<?php
 /**
  * prepares and displays center column
  *
  */
}  //   !	$model
if ( ($model) || ( $current_page_base != 'index' )  )
 {
   require($body_code);   
 }
 else
 {
    // sélection de la  marque  -----------------------------------------------------
  echo'
	<form name="frm">
	<ul id="rechecheModele">
	<li id="rech_marque">
	<select name="categ" onchange="document.location=this.value;"> 
	<option value="">'.CHOIX_CONSTRUCTEUR;
	
	   $sql = 'select cat.categories_id, catd.categories_name 
		  from   categories as cat, categories_description as catd 
		  where  cat.categories_id = catd.categories_id
		  and    catd.language_id= 2
		  and    cat.parent_id = 0
		  order by catd.categories_name';

      $categories_lookup = $db->Execute($sql);
      
      while (!$categories_lookup->EOF) 
      {
	     $sel = "";
		 if ( $marque )
		 {
			if ( $marque == $categories_lookup->fields['categories_id'])
			{
				 $sel .=  ' SELECTED ';
			}
		 }
	  
         $html .=  '<option value="index.php?main_page=index&amp;cPath='. $categories_lookup->fields['categories_id'] .'"  '. $sel .'>'.  $categories_lookup->fields['categories_name'] ;
         $categories_lookup->MoveNext();
      }
	  echo $html;
	  
     // sélection du modèle ---------------------------------------------------------------------------------------------
	 $html = "";
      echo '</select>
	        </li>
			<li id="rech_modele">
			<select name="subCateg" onchange="document.location=this.value;"> 
			   <option value="">'.CHOIX_VIDEOPROJECTEUR;
	  if ( $marque )
	  {
		  $sql = 'select cat.categories_id, catd.categories_name 
				  from   categories as cat, categories_description as catd 
				  where  cat.categories_id = catd.categories_id
				  and    catd.language_id= 2
				  and    cat.parent_id = ' . $marque . '
				  order by catd.categories_name';

			  $subcategories_lookup = $db->Execute($sql);
			  
			  while (!$subcategories_lookup->EOF) 
			  {
				 $html .=  '<option value="index.php?main_page=index&amp;cPath='.$marque . '_'.   $subcategories_lookup->fields['categories_id'] . '">'.  $subcategories_lookup->fields['categories_name'] ;
				 $subcategories_lookup->MoveNext();
			  }
			  echo $html;
				  
	  }
	  echo   '
            </select> 
			</li>
			<li id="rech_soumettre">
				<a>' . COMMANDER  . '</a>
			</li>
			</ul>
			<br></form>';
	
 }
 
if (!	$model && ( $current_page_base == 'index' ) )
{

 ?>




      <?php      
//echo $body_id; 
      if ( ( $body_id=="index" ) && ! $model )
	  {
      }

 
if ( ($body_id=="login") ||  ($body_id=="checkoutconfirmation") ||  ($body_id=="conditions") 
       ||  ($body_id=="checkoutshipping") ||  ($body_id=="checkoutpayment") 
       || ($body_id=="contactus")  
       || ($body_id=="shippinginfo") || ($body_id=="accounthistoryinfo")  ) 
{
    if  ( ($body_id=="login") || ($body_id=="checkoutconfirmation")   )
    {
    }
    else if  ( ($body_id=="page4")  )
    {
    }
    else if  ( ($body_id=="conditions")  )
    {
    }
    else
    {
    }
    $tmp_output = '<br>
				<img  VSPACE=5 HSPACE=5  height='. $height .' width=80 src="includes/templates/template_default/images/empty.gif" >';

}
echo '
    </div>
	<div id="contenuDroit_bas">
				<div id="contenuDroit_RechercheReference">
					<h2>'.RECHERCHE_REF.'</h2>
					<form name="rechercheParReference"  action="index.php?main_page=advanced_search_result" method="get">
						<input name="keyword"  size="10"  type="text" value="'.INVITE_SAISIE_REFERENCE.'"   onfocus="if (this.value == \''. INVITE_SAISIE_REFERENCE .'\') this.value = \'\';"/>				
						<button class="okRond" onclick="submit();"></button>
					    <input type=HIDDEN name="main_page" value="advanced_search_result">
						<input type=HIDDEN name="search_in_description" value="1">
						<input type=HIDDEN name="typ_module" value="M" >						
					</form>	

					
					<p style=" font-size: 10pt; ">'. TROUVE_PAS .' <a href="index.php?main_page=contact_us&contact_type=LNF"  style=" font-size: 10pt;">'. CLIQUEZ_ICI .'</a></p>
				</div>
				<div id="contenuDroit_FraisLivraison">';
  if ( $_SESSION['customer_country_id']==73 ) 
     /*
     echo '<script language="javascript" type="text/javascript"><!--
			function popupWindow(url) {
			  window.open(url,\'popupWindow\',\'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=550,height=550,screenX=150,screenY=100,top=100,left=150\');
			}
            //--></script>
			<p ><em style=" font-size: 10pt; ">'. FRAIS_LIVRAISON .'</em> &nbsp;&nbsp; <a href="javascript:popupWindow(\'frais_livraison.htm\');">'. CLIQUEZ_ICI .'</a></p>';
			*/
		echo '<p ><em style=" font-size: 10pt; ">'. FRAIS_LIVRAISON .'</em> &nbsp;&nbsp; <a href="index.php?main_page=shippinginfo">'. CLIQUEZ_ICI .'</a></p>';
  else
    echo   '<p > &nbsp;</p>';
	
  echo '			<p style=" font-size: 10pt; ">'. LIVRAISON_EUROPE1 .' <em>'. LIVRAISON_EUROPE2 .'</em></p>
				</div>
			</div>';
  }  // $model			
?>
		</div>
	</div>
<?php 	
if (!	$model && ( $current_page_base == 'index' ) )
{
  echo 
	'<!-- Pied de page -->
	<div id="piedDePage">
		<a href="javascript:window.external.addfavorite(\'http://www.easylamps.eu/\',\'easylamps.eu\')" class="lienFin">' . AJOUTER_FAVORIS . '</a>
		<span>|</span>
		<a href="mailto:?subject=http://www.easylamps.eu/" class="lienFin">' . ENVOYER_AMIS . '</a>
	</div>
</div>';
} // model
?>
<?php
  if ( $current_page_base == 'create_account_success' )
  {
  }
  if ( $current_page_base == 'checkout_success' )
  {
  }

  
  if (SHOW_BANNERS_GROUP_SET4 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET4)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerFour" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>
<?php
if (COLUMN_RIGHT_STATUS == 0 or (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '')) {
  // global disable of column_right
  $flag_disable_right = true;
}
if (!isset($flag_disable_right) || !$flag_disable_right) {
?>
<td id="navColumnTwo" class="columnRight" style="width: <?php echo COLUMN_WIDTH_RIGHT; ?>">
<?php
 /**
  * prepares and displays right column sideboxes
  *
  */
?>
<div id="navColumnTwoWrapper" style="width: <?php echo BOX_WIDTH_RIGHT; ?>"><?php require(DIR_WS_MODULES . zen_get_module_directory('column_right.php')); ?></div></td>
<?php
}
?>


<?php
 /**
  * prepares and displays footer output
  *
  */
  require($template->get_template_dir('tpl_footer.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_footer.php');?>
</div>
<!--bof- parse time display -->
<?php
  if (DISPLAY_PAGE_PARSE_TIME == 'true') {
?>
<div class="smallText center">Parse Time: <?php echo $parse_time; ?> - Number of Queries: <?php echo $db->queryCount(); ?> - Query Time: <?php echo $db->queryTime(); ?></div>
<?php
  }
?>
<!--eof- parse time display -->
<!--bof- banner #6 display -->
<?php
  if (SHOW_BANNERS_GROUP_SET6 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET6)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerSix" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }

  if ( $_SESSION['customer_id'] == 1 )
  {
    echo '<script language="javascript" type="text/javascript">
<!--
   function popupWindow(url) {
     window.open(url,\'popupWindow\',\'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=1000,height=600,screenX=150,screenY=100,top=100,left=150\')
   }
//--></script>

   <a href="javascript:popupWindow(\'show_file.php?file_name='. $_GET['main_page'] .'.php\');" > Cliquez ici pour modifier les libelles de cette page </a>';
   if ( $_GET['main_page'] == "index" )   
   {
    echo '<br><br><a href="javascript:popupWindow(\'show_file.php?file_type=base\');" > Cliquez ici pour modifier les libelles affichés sur toutes les pages </a>';
   } 
   if ( $_GET['main_page'] == "checkout_shipping" )   
   {
    echo '<br><br><a href="javascript:popupWindow(\'show_file.php?file_type=shipping&file_name=zones.php\');" > Cliquez ici pour modifier les libelles du module shipping </a>';
   } 
   if  ( ( $_GET['main_page'] == "checkout_payment" )  ||  ( $_GET['main_page'] == "checkout_confirmation" ) )  
   {
    echo '<br><br><a href="javascript:popupWindow(\'show_file.php?file_type=payment&file_name=cc.php\');" > Cliquez ici pour modifier les libelles de credit card </a>';
    echo '<br><br><a href="javascript:popupWindow(\'show_file.php?file_type=payment&file_name=cod.php\');" > Cliquez ici pour modifier les libelles de cod </a>';
    echo '<br><br><a href="javascript:popupWindow(\'show_file.php?file_type=payment&file_name=moneyorder.php\');" > Cliquez ici pour modifier les libelles de money_order </a>';	

    echo '<br><br><a href="javascript:popupWindow(\'show_file.php?file_type=order_total&file_name=ot_shipping.php\');" > Cliquez ici pour modifier les libelles sous total shipping </a>';
    echo '<br><br><a href="javascript:popupWindow(\'show_file.php?file_type=order_total&file_name=ot_subtotal.php\');" > Cliquez ici pour modifier les libelles sous total - total intermediare   </a>';
    echo '<br><br><a href="javascript:popupWindow(\'show_file.php?file_type=order_total&file_name=ot_tax.php\');" > Cliquez ici pour modifier les libelles sous total tax </a>';	
    echo '<br><br><a href="javascript:popupWindow(\'show_file.php?file_type=order_total&file_name=ot_total.php\');" > Cliquez ici pour modifier les libelles de total  </a>';		
   }    
   echo '<br><br><a href="javascript:popupWindow(\'show_file.php?file_type=define&file_name='. $_GET['main_page'] .'\');" > Cliquez ici pour modifier le fichier defines </a>';

  }  
  
  
?>
<!--eof- banner #6 display -->
</body>