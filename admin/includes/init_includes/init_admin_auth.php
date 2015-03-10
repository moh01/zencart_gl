<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_admin_auth.php 3001 2006-02-09 21:45:06Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
//echo '.'.$_GET['form'].'.';exit;
// fv circonstances exeptionnelles pour bypasser la verification
$bypass_verification=0;
if  ( 
     ($_GET['form']=="action")
	 &&
	 ($_POST['ord_id']>0)
	 )
{
   $bypass_verification = 1;
}
// autre excepton pour la base commande 
if ( (strpos('...'.$_SERVER['REQUEST_URI'],'replication_base_commande.php')>0)
     || (strpos('...'.$_SERVER['REQUEST_URI'],'infos_cmde.php')>0)
     || (strpos('...'.$_SERVER['REQUEST_URI'],'tracker_dhl_automate.php')>0)
     || (strpos('...'.$_SERVER['REQUEST_URI'],'hors_delais_po.php')>0)
     || (strpos('...'.$_SERVER['REQUEST_URI'],'stock_detail.php')>0)	 
     || (strpos('...'.$_SERVER['REQUEST_URI'],'tracker_dhl_automate0.php')>0)	 
	 || (  ( 
	         (strpos('...'.$_SERVER['REQUEST_URI'],'margin_entry.php')>0)
              ||
	         (strpos('...'.$_SERVER['REQUEST_URI'],'margin_summary.php')>0)
              ||
	         (strpos('...'.$_SERVER['REQUEST_URI'],'input_cms_page.php')>0)			 
              ||
	         (strpos('...'.$_SERVER['REQUEST_URI'],'input_tsty_page.php')>0)			 
              ||
	         (strpos('...'.$_SERVER['REQUEST_URI'],'get_billing_info.php')>0)			 
              ||
	         (strpos('...'.$_SERVER['REQUEST_URI'],'supplier_tags.php')>0)
              ||
	         (strpos('...'.$_SERVER['REQUEST_URI'],'el_stock_tags.php')>0)
              ||
	         (strpos('...'.$_SERVER['REQUEST_URI'],'out_marges.php')>0)
              ||
	         (strpos('...'.$_SERVER['REQUEST_URI'],'el_orders.php')>0)
              ||
	         (strpos('...'.$_SERVER['REQUEST_URI'],'isuper_orders.php')>0)
             )			//  79.91.219.169
	          && ( 
			   ( $_SERVER['REMOTE_ADDR']=="127.0.0.1" ) 
					|| ( $_SERVER['REMOTE_ADDR']=="93.17.75.108" ) 
					|| ( 1 == 1 ) 					
			   )
	    )	 
    )
{
   $bypass_verification = 1;
}
else
{
//	echo $_SERVER['REQUEST_URI'].' || '. $_SERVER['REMOTE_ADDR'].' || '.strpos('...'.$_SERVER['REQUEST_URI'],'el_orders.php') . '||';
}

//echo $_SERVER['REQUEST_URI'];exit;
//echo strpos ($_SERVER['REQUEST_URI'] , 'rapprochement_cc.php');exit;
if ( strpos ($_SERVER['REQUEST_URI'] , 'rapprochement_cc.php')>0 )
{
   $bypass_verification = 1;   
}

if ($bypass_verification==0 )
{

  if (!(basename($PHP_SELF) == FILENAME_LOGIN . '.php')) {
    if (!isset($_SESSION['admin_id'])) {
      if (!(basename($PHP_SELF) == FILENAME_PASSWORD_FORGOTTEN . '.php')) {
        zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
      }
    }
  }

  if ((basename($PHP_SELF) == FILENAME_LOGIN . '.php') and (substr_count(dirname($PHP_SELF),'//') > 0 or substr_count(dirname($PHP_SELF),'.php') > 0)) {
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
 }
?>