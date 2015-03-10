<?php

define('EN',   1);
define('FR',    2);
define('BL',    3);
define ('STYLE', '' );


  $tab_aut['fr']="26628|FjSBjXH6wAhH4FE7lTho1pSTA";
  $tab_aut['en']="26640|eo41zYjucZWK3nbneHMWkVL2w";
  $tab_aut['de']="26650|mBHVZx8SEwehY9kP2q8YxA3iA";
  $tab_aut['bf']="26647|G9jS3rEveBzP7taDaAG7pYFqt";
  $tab_aut['hp']="37405|6ab48ab6a2588e2e53c530e14";
  
//echo 'zut';exit;

function get_ekomi_token($site_code, $order_id)
{
// dans le Back OFFICE DE EKOMI, aller sur 
  global $tab_aut;
  
  $auth        =$tab_aut[$site_code];
  $version     = "cust-1.0.0";
  $product_ids = "";
//  echo '!!!!!!!!!!!!'.$site_code.'|||'.$auth.'<br>';
	$soap = new SoapClient('http://api.ekomi.de/v2/wsdl');
    try {
               //Il faut bien renseigner les paramètres de putOrder sinon erreur
               //$str = $soap->putOrder("26647|G9jS3rEveBzP7taDaAG7pYFqt","cust-1.0.0","79234","4168,357,189");
               $str = $soap->putOrder($auth, $version, $order_id, $product_ids);
              // var_dump( $str);
               echo '<br/>';
              // echo substr($str,22,82);
               $tab = explode(';',$str);
               //echo '<br/>';
               $chaine= explode('"',$tab[1]);
               $lien=$chaine[1];
               // return $lien;
               $tab_lien=explode('=', $lien );
//echo  $lien;
               $token = $tab_lien[1]; 	
	       return $token;
		
               }
    catch (SoapFault $e){
      $ret = $e->faultstring;
      $faults = array(
            'LoginFailed'         => 'Veuillez renseigner le champs auth',
            'TransmitFailed'      => 'Au moins, un des champs suivants: <br/>-<em><b> version</b></em>,<br/>- <em><b>order_id</b></em>, <br/>- <em><b>product_ids</b></em><br/>est mal renseigné',
            );
      return 0;
     
   
        } //end try
}
function get_ekomi_url($site_code, $order_id)
{
  global $tab_aut;

// dans le Back OFFICE DE EKOMI, aller sur 
  
  $auth        =$tab_aut[$site_code];
  $version     = "cust-1.0.0";
  $product_ids = "";
    
	$soap = new SoapClient('http://api.ekomi.de/v2/wsdl');
    try {
               //Il faut bien renseigner les paramètres de putOrder sinon erreur
               //$str = $soap->putOrder("26647|G9jS3rEveBzP7taDaAG7pYFqt","cust-1.0.0","79234","4168,357,189");
               $str = $soap->putOrder($auth, $version, $order_id, $product_ids);
              // var_dump( $str);
               echo '<br/>';
              // echo substr($str,22,82);
               $tab = explode(';',$str);
               //echo '<br/>';
               $chaine= explode('"',$tab[1]);
               $lien=$chaine[1];
               return $lien;
               }
    catch (SoapFault $e){
      $ret = $e->faultstring;
      $faults = array(
            'LoginFailed'         => 'Veuillez renseigner le champs auth',
            'TransmitFailed'      => 'Au moins, un des champs suivants: <br/>-<em><b> version</b></em>,<br/>- <em><b>order_id</b></em>, <br/>- <em><b>product_ids</b></em><br/>est mal renseigné',
            );
      return 0;
     
   
        } //end try
}
function get_product_type ( $products_model )
{
    if (strlen($products_model)==0)
	   return "";
	   
	if (substr($products_model,0,5)=="MCEL-")
	{
	   $original_code = substr( $products_model, 5, 1000 );
	   $product_type = "CM";
	   $product_type_id = 2;	   
	}
	else if (substr($products_model,0,3)=="OI-")
	{
	   $original_code = substr( $products_model, 3 , 1000 );
	   $product_type = "OI";
	   $product_type_id = 3;	   	   
	}
	else if (substr($products_model,0,5)=="BCEL-")
	{
	   $original_code = substr( $products_model, 5, 1000 );
	   $product_type = "B";	  
	   $product_type_id = 4;	   	    	   
	}
	else
	{
	   $original_code = $products_model;
	   $product_type = "OM";
	   $product_type_id = 1;	   	    	   	   
	}
//echo 	'|||'.$products_model.'||'.$product_type.'||'.$original_code;
    return $product_type;
}
function get_month_name($month_number)
{
  if ($month_number==1)
   return "janvier";
  else if ($month_number==2)
   return "février";
  else if ($month_number==3)
   return "mars";
  else if ($month_number==4)
   return "avril";
  else if ($month_number==5)
   return "mai";
  else if ($month_number==6)
   return "juin";
  else if ($month_number==7)
   return "juillet";
  else if ($month_number==8)
   return "aôut";
  else if ($month_number==9)
   return "septembre";
  else if ($month_number==10)
   return "octobre";
  else if ($month_number==11)
   return "novembre";
  else if ($month_number==12)
   return "décembre";
}
class EMAIL
{
    var $email_language = EN;

    var $sender_email_address = "contact@243149.net";

    var $sender_name = array();
//    var $receiver_email_address = "f_varon@hotmail.com";

    var $receiver_name;
    var $receiver_id;

    var $email_title = array();
    var $email_content = array();


    /*   gestion des caractères de substitution  */


    // {{{ constructor
    function EMAIL()
    {
     $this->sender_name[EN] = "Online questionnaires.";
     $this->sender_name[FR] = "Questionnaires en ligne.";
     $this->receiver_name = "";

     $this->email_title[EN] = "";
     $this->email_title[FR] = "";

     $this->email_content[EN] = "";
     $this->email_content[FR] = "";

    }

    // }}}
    // {{{ destructor

    /**
     * Destructor (the emulated type of...).  Does nothing right now,
     * but is included for forward compatibility, so subclass
     * destructors should always call it.
     *
     * See the note in the class desciption about output from
     * destructors.
     *
     * @access public
     * @return void
     */
    function _EMAIL()
    {
    }

    // }}}
    // {{{ GetEmailHeader()
    function get_email_header()
    {

$headers = "From: \"".$this->sender_name[$this->email_language]."\" <".$this->sender_email_address.">\n";
// $headers .= "To:  <".$email_send_to.">\n";
// $headers .= "return-path: <".$this->sender_email_address.">\n";

// $headers .= 'Cc: contact@cyber-sphinx.com' . "\r\n";

$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: text/HTML; charset=ISO-8859-1\n";


/*
      $headers = "MIME-Version: 1.0\r \n";
      $headers .= "Content-type: text/html; charset=iso-8859-1\r \n";
      $headers .= "From:". $this->sender_name[$this->email_language] ."<".$this->sender_email_address.">\r \n";
      $headers .= 'Cc: contact@cyber-sphinx.com' . "\r\n";
      $headers .= "Reply-To:". $this->sender_name[$this->email_language] ."<".$this->sender_email_address.">\r \n";
      $headers .= "X-Priority: 3\r \n";

//      $headers .= "X-MSMail-Priority: High\r \n";
//      $headers .= "X-Mailer:". $this->sender_name[$this->email_language];

      $headers .= "X-Mailer: PHP\n"; // mailer
      $headers .= "Return-Path: <frederic.varon@cyber-sphinx.com>\n";

*/
      return $headers;
    }
    // {{{ get_email_title()
    function get_email_title()
    {
      $title = $this->email_title[$this->email_language];

      return $title;
    }

    function get_email_content()
    {
      $content = $this->email_content[$this->email_language];
      $content = str_replace('[EMAIL]',$this->receiver_email_address , $content);
      $content = str_replace('[ID]',$this->receiver_id, $content);


      return $content;
    }
    function send_email()
    {
      $email_send_to = '<'. $this->receiver_email_address."> \r \n";
//echo 	 '$email_send_to.'.$email_send_to.'$email_send_to.'; exit;
// Return-Path: me <me@mine.com>\r\n
//     mail($email_send_to, $this->get_email_title() , $this->get_email_content() , $this->get_email_header() ,  '-f  Return-Path: frederic.varon@cyber-sphinx.com  \r\n'  );
       mail($email_send_to, $this->get_email_title() , $this->get_email_content() , $this->get_email_header()  );

    }
    function set_email_language($p_language)
    {
      $this->email_language=$p_language; 
    }
    function set_email_content($p_content , $p_language )
    {
      $this->email_content[$p_language] = STYLE . "<BODY>". $p_content. "</BODY>"; 
    }
    function set_email_title($p_title , $p_language )
    {
      $this->email_title[$p_language] = $p_title; 
    }
    function set_receiver_email_address($p_receiver_email_address)
    {
      $this->receiver_email_address=$p_receiver_email_address; 
    }    
    function set_receiver_name($p_receiver_name)
    {
      $this->receiver_name=$p_receiver_name; 
    } 
    function set_receiver_id($p_receiver_id)
    {
      $this->receiver_id=$p_receiver_id; 
    }   
    function set_sender_email_address($p_sender_email_address)
    {
      $this->sender_email_address=$p_sender_email_address; 
    }
    function set_sender_name($p_sender_name , $p_language )
    {
      $this->sender_name[$p_language] = $p_sender_name; 
    }
}


// 21453 21483
    /// mail aux clients; satisfaction clientèle.
	if ($_SERVER['SERVER_NAME']=="127.0.0.1")
	{
	 define('DB_SERVER_EU', 'localhost');
     define('DB_SERVER_USERNAME_EU', 'root');
     define('DB_SERVER_PASSWORD_EU', '');
     define('DB_DATABASE_EU', 'rv_lampe_eu');

	 define('DB_SERVER_FR', 'localhost');
     define('DB_SERVER_USERNAME_FR', 'root');
     define('DB_SERVER_PASSWORD_FR', '');
     define('DB_DATABASE_FR', 'lampe_fr');

     define('DB_SERVER', 'localhost');
     define('DB_SERVER_USERNAME', 'root');
     define('DB_SERVER_PASSWORD','');
     define('DB_DATABASE', 'bo_gl');
	 
	}
	else
	{
	 define('DB_SERVER_EU', 'localhost');
     define('DB_SERVER_USERNAME_EU', 'lampe_batterie');
     define('DB_SERVER_PASSWORD_EU', 'abidjan51');
     define('DB_DATABASE_EU', 'rv_lampe_eu');

	 define('DB_SERVER_FR', 'localhost');
     define('DB_SERVER_USERNAME_FR', 'lampe_batterie');
     define('DB_SERVER_PASSWORD_FR', 'abidjan51');
     define('DB_DATABASE_FR', 'lampe_fr');
	 
     define('DB_SERVER', 'localhost');
     define('DB_SERVER_USERNAME', 'lampe_batterie');
     define('DB_SERVER_PASSWORD', 'abidjan51');
     define('DB_DATABASE', 'bo_gl');
	 
	}
	
//echo DB_SERVER_USERNAME;
    $res = @mysql_connect(DB_SERVER, DB_SERVER_USERNAME ,DB_SERVER_PASSWORD) or die ("probleme connexion");
    @mysql_select_db(DB_DATABASE,$res) or die ("probleme dans selection base");
          
//    $sql = "update el_raclette set order_total=" . ( $amount/100 ) . "  where customers_id=".$customer_id;
//    $id = mysql_query ( $sql , $res );
//  $sites_cible = "'hp'";

  $sites_cible = "'fr','en','de','es','it','bf','hp'";

// $sites_cible = "'fr'";
  
  $sql  = "SELECT customers_email_address, 
                 date_format( date_purchased , \"%d/%c/%Y\" ), 
                 products_model, 
                 products_name, 
                 orders.orders_id, 
                 orders_products.orders_products_id,
                 date_format(DATE_ADD(CURDATE(),INTERVAL 7 DAY) , \"%d/%c/%Y\" ) date_limite,
				 database_code,
				 languages_id,
				 DATEDIFF(orders_invoices.invoice_date,orders.date_purchased)
           from orders,orders_products,orders_invoices
		   where  orders.database_code in (".$sites_cible.")
		   and  products_model not in ('ECOF','SHF','CODF')
           and orders_invoices.invoice_type in ('DB','DH')
		   and payment_module_code in ('cc','cod','paypal','moneyorder','authorizenet')
           and DATEDIFF(orders_invoices.invoice_date,orders.date_purchased)<10
           and orders.orders_id = orders_invoices.orders_id
           and orders.orders_id=orders_products.orders_id
		   and orders.date_purchased > '2011-08-01'		   
		   and products_model NOT IN ('SP400','DUSTGO')
		   and orders_invoices.invoice_date <  DATE_SUB(CURDATE(),INTERVAL 14 DAY)				   
           and orders_invoices.invoice_date >  DATE_SUB(CURDATE(),INTERVAL 15 DAY)		   
           and not exists (select 1 from el_ticket where orders.customers_id = el_ticket.customers_id)		 
           order by orders.orders_id, orders_products.final_price desc";
		   
//                        and orders_invoices.invoice_date >  DATE_SUB(CURDATE(),INTERVAL 15 DAY)


//echo $sql;exit;
		   //		   and orders.orders_id=62537
//            and not exists (select 1 from el_ticket where orders.customers_id = el_ticket.customers_id)
		   
//		   and 0=1
//           where  orders.database_code in ('fr','en','de')
//             where  orders.database_code in ('fr','en','de','es')                      
//
//           and orders_invoices.invoice_date >  DATE_SUB(CURDATE(),INTERVAL 15 DAY)
//           and orders_invoices.invoice_date <  DATE_SUB(CURDATE(),INTERVAL 14 DAY)

  $id = mysql_query($sql, $res);
  $current_invoice = 0;
  
  $spam = new EMAIL;
  $spam->set_email_language(2);  


  
  while (mysql_fetch_row($id))
    {
	
     $customers_email_address   = mysql_result($id,$row,0);
     $date_purchased  = stripslashes(@mysql_result($id,$row,1));
     $products_model  = stripslashes(@mysql_result($id,$row,2));
     $products_name  = stripslashes(@mysql_result($id,$row,3));
     $orders_id=stripslashes(@mysql_result($id,$row,4));
     $orders_products_id=stripslashes(@mysql_result($id,$row,5));
     $date_limite = stripslashes(@mysql_result($id,$row,6));
	 $database_code = stripslashes(@mysql_result($id,$row,7));
	 $languages_id = stripslashes(@mysql_result($id,$row,8));
	 $temps_livraison = stripslashes(@mysql_result($id,$row,9));
	 	 
     $sender["en"]="JustProjectorLamps.co.uk";  
     $sender["fr"]="LampeVideoProjecteur.fr";  
	 $sender["de"]="AlleProjektorLampen.de";  	 
     $sender["es"]="LamparasParaProyectores.es";  
     $sender["it"]="LampadeProiettori.com";  

     $sender["hp"]="HotProjectorLamps";  
	 
	 
	 if ( $languages_id ==2 )
	 {
		$sender["bf"]="Easybatteries.fr";  
		$sender_email["bf"]="info@easybatteries.fr";  
	 }
	 else if ( $languages_id ==3 )
	 {
		$sender["bf"]="Easybatteries.es";  
		$sender_email["bf"]="info@easybatteries.es";  		
	 }

     $sender_email["en"]="info@justprojectorlamps.fr";  
     $sender_email["fr"]="info@lampevideoprojecteur.fr";  
     $sender_email["de"]="info@alleprojektorlampen.de";  
     $sender_email["es"]="info@lamparasparaproyectores.es";  
     $sender_email["it"]="info@lampadeproiettori.com";  
     $sender_email["hp"]="info@hotprojectorlamps.fr";  
	 
//     $spam->set_sender_email_address('info@lampevideoprojecteur.

	 $spam->set_sender_name($sender[$database_code],2);
	 $spam->set_sender_email_address($sender_email[$database_code]);
	 
     
     if ( $orders_id !=  $current_invoice )
     {
        $current_invoice = $orders_id;
        echo $products_name;
        echo '<br>';
		if (  ($database_code=="fr") || ($database_code=="hp") )
		{
			if ($database_code=="fr")
			{
				$eKomi=1;
				if ($eKomi)
				{
					// $url = get_ekomi_url("fr", $orders_products_id);
					$token  = get_ekomi_token("fr", $orders_products_id);
					$url = "https://ssl3.ovh.net/~questionc/exec/assessment/show.php?container_doi=964d44&ts_doi=7ac745&ref_id=".$orders_products_id.'&ek_ci='. $token.'=26628';

					$nb_questions = 8;						
				}
				else
				{
					$url = "https://ssl3.ovh.net/~questionc/exec/assessment/show.php?container_doi=964d44&ts_doi=7ac745&ref_id=".$orders_products_id;
					$nb_questions = 8;			
				}
			}
			else
			{
				$url = get_ekomi_url("hp", $orders_products_id);
//				$url2 = get_ekomi_url	("fr", $orders_products_id);
				
//echo 'in'.	$url . "|" . $url2 .'<br>';		
				
				$nb_questions = 3;									
			}			
		
        $spam->set_email_title ("Répondez à ". $nb_questions ." questions et recevez un mois d'extension de garantie pour votre ".$products_name,2);
        $spam->set_email_content ( "
Bonjour,
<br>
<br>
Dans le cadre de sa politique d'amélioration des services offerts aux clients, Lampevideoprojecteur.fr vous propose de répondre, en moins d'une minute, à un questionnaire de satisfaction en ligne.<br>
<br>
En remerciement, si vous répondez à ce questionnaire avant le ".$date_limite. ",  nous vous ferons bénéficier d'une <b>extension de garantie de 1 mois</b> sur le produit :". $products_name . " que vous avez achetée  le ". $date_purchased . ".
<br><br>
Pour répondre au questionnaire, veuillez cliquer sur ce lien : <br> 
<a href='". $url ."'>
". $url ."</a> 
<br><br>
Si ce dernier lien ne fonctionne pas veuillez copier ce lien et le coller dans la barre d'adresse de votre navigateur Internet.
<br><br>
Nous vous remercions de votre attention et nous vous prions de recevoir nos plus sincères salutations.
<br><br>
Le service client de ".$sender[$database_code] ,2);
        }
		else if ($database_code=="en")
		{
			$eKomi=0;
			if ( get_product_type($products_model)!= "OM" )
			{
//echo '<br>'.get_product_type($products_model).'|'.	$products_model.'<br>';		
				$eKomi = 1;
			}
			if ($eKomi)
			{
				$url = get_ekomi_url("en", $orders_products_id);
				$nb_questions = 3;						
			}
			else
			{
			//
				$url = "https://ssl3.ovh.net/~questionc/exec/assessment/show.php?container_doi=8ab7d2&ts_doi=828867&ref_id=".$orders_products_id;
				$nb_questions = 8;			
			}
        $spam->set_email_title ("Answer " . $nb_questions . " questions and get a guarantee extension for your ".$products_name,2);
        $spam->set_email_content ( "
Dear customer,
<br>
<br>
As part of the customer service policy improvement, Justprojectorlamps.co.uk puts an online satisfaction survey forward, that you can answer within one minute.
<br>
In gratitude, if you answer this questionnaire before ".$date_limite. ", you will receive a month guarantee extension on the product:". $products_name . ", you have bought on ". $date_purchased . ".
<br><br>
To answer the questionnaire, please click on the following link:
<br><br>
<a href=". $url .">
".$url ."
</a>
<br><br>
If the link does not work, please copy and paste it on your browser's address bar.
<br><br>
Many thanks for your attention,
<br><br>
Sincerely yours,
<br><br>
Justprojectorlamps.co.uk, Customer Service",2);
        }		
		else if ($database_code=="de")
		{
			$eKomi=0;
			if  (  ( get_product_type($products_model)!= "OM" ) || ( $orders_products_id == 176477 ) ) 
			{
				$eKomi = 1;
			}
			if ($eKomi)
			{
				$url = get_ekomi_url("de", $orders_products_id);
				$nb_questions = 3;						
			}
			else
			{
				$url = "https://ssl3.ovh.net/~questionc/exec/assessment/show.php?ts_doi=8ab7d2&container_doi=962881&ref_id=".$orders_products_id;
				$nb_questions = 8;			
			}
		
        $spam->set_email_title ("Füllen Sie einfach unseren Fragebogen aus und Sie erhalten als Dankeschön eine einmonatige Garantieverlängerung Ihrer ".$products_name . " !",2);
        $spam->set_email_content ( "
Sehr geehrte/r Herr/Frau…, 
<br>
<br>
Im Rahmen der von uns angestrebten Verbesserungunseres Kundendienstes und Services  bittet Alleprojektorlampen.de Sie , unseren Online-Zufriedenheitsfragebogen auszufüllen, dessen Beantwortung weniger als eine Minute in Anspruch nimmt. 
<br>
<br>
Wenn Sie diesen Fragebogen vor dem ". $date_limite." beantworten, erhalten Sie als Dankeschön  eine Garantieverlängerung von einem Monat auf das Produkt: ". $products_name . ", das Sie am ". $date_purchased . " gekauft haben.
<br>
<br>
Um diesen Fragebogen auszufüllen, klicken Sie bitte auf diesen Link:
<br><br>
<a href=".$url.">
".$url."</a>
<br><br>
Falls dieser Link nicht funktioniert, kopieren Sie ihn bitte und fügen Sie ihn in die Adressleiste Ihres Browsers ein.
<br><br>
Vielen Dank für Ihre Unterstützung.
<br><br>
Mit freundlichen Grüßen
<br><br>
Kundendienst Alleprojektorlampen.de",2);
        }
		else if ($database_code=="es")		
		{
        $spam->set_email_title ("Responde a las 8 preguntas y recibe una extensión de garantía de un mes para su  ".$products_name,2);
        $spam->set_email_content ( "
Hola,
<br>
<br>
Como parte de su política de mejora de los servicios a los clientes,  Lamparasparaproyectores.es le propone de responder, en menos de un  minuto, a una encuesta de satisfacción en línea.
<br>
En agradecimiento, si responde a este cuestionario antes del  ".$date_limite. ",  recibirá una <b>extensión de garantia</b> de 1 mes para el  producto : ". $products_name . " que compró el ". $date_purchased . ".
<br><br>
Para responder al cuestionario, por favor haga clic en este enlace: <br> 
<a href='https://ssl3.ovh.net/~questionc/exec/assessment/show.php?container_doi=a50b78&ts_doi=96ec91&ref_id=".$orders_products_id."'>
https://ssl3.ovh.net/~questionc/exec/assessment/show.php?container_doi=a50b78&ts_doi=96ec91&ref_id=".$orders_products_id."</a> 
<br><br>
Si el enlace no funciona, por favor copia el enlace  y pegalo en la  barra de direcciones de su navegador.
<br><br>
Gracias por su atención.
<br><br>
Atentamente.
<br><br>
El servicio al Cliente Lamparasparaproyectores.es
",2);
        } 		
		else if ($database_code=="it")		
		{
        $spam->set_email_title ("Rispondete a 8 domande e ricevete un mese di estensione della garanzia della vostra Lampada originale per  ".$products_name,2);
        $spam->set_email_content ( "
Buongiorno,
<br>
<br>
Nell’ambito della sua politica di miglioramento dei servizi offerti ai clienti, Lampadeproiettori.com vi propone di rispondere, in meno di un minuto, a un questionario di gradimento online.
<br>
Per ringraziarvi, se rispondete a questo questionario prima del ".$date_limite. ", vi offriremo un mese di estensione della garanzia.
<br><br>
Per rispondere al questionario, cliccare sul seguente link: <br> 
<a href='https://ssl3.ovh.net/~questionc/exec/assessment/show.php?container_doi=a8aec4&ts_doi=992c80&ref_id=".$orders_products_id."'>
https://ssl3.ovh.net/~questionc/exec/assessment/show.php?container_doi=a8aec4&ts_doi=992c80&ref_id=".$orders_products_id."</a> 
<br><br>
Se il link non funziona, basta copiare l’intero indirizzo e incollarlo nella barra degli indirizzi del vostro navigatore Internet.
<br><br>
Ringraziandovi per la vostra attenzione, vi inviamo i nostri più cordiali saluti.
<br><br>
Il servizio clienti di Lampadeproiettori.com
",2);
		}
		else if (  ($database_code=="bf")&& ($languages_id==2) )
		{
		
		// on regarde la composition du panier 
		$sql = "select count(1) from orders_products  where  ( products_model like 'CG%' or products_model like 'EB%')  and orders_id =".$current_invoice ;
	    $id2 = mysql_query($sql, $res);
  
        mysql_fetch_row($id2);
		$cnt   = mysql_result($id2,0,0);
			
	    $url2 = "https://ssl3.ovh.net/~questionc/exec/assessment/show.php?ts_doi=9b3b6b&container_doi=a9e11d&ref_id=".$orders_products_id;

		if ( $cnt == 1)
		{
		   $choix_sondage = "";
		   if (substr($products_model,0,2)=="EB")
		   {
			  $doi = "9b47ac";
		   }		 
		   else if (substr($products_model,0,2)=="CG")
		   {
			  $doi = "9b53ed";
		   }		 		  
		   $url1 = "https://ssl3.ovh.net/~questionc/exec/assessment/show.php?ts_doi=".$doi."&container_doi=a9e11d&ref_id=".$orders_products_id;
		   
           $choix_sondage = "
Si vous êtes utilisateur de l'ordinateur concerné par cette commande, sélectionnez le lien suivant:<br>
<a href=".$url1.">".$url1."</a>
<br><br>
Si vous n'êtes pas utilisateur de l'ordinateur concerné par cette commande, sélectionnez le lien suivant:<br>
<a href=".$url2.">".$url2."</a>
";		   
		}
		else
		{
           $choix_sondage = "
Pour répondre au sondage, sélectionnez le lien suivant:<br>
<a href=".$url2.">".$url2."</a>
";		   
		   
		}
		// fvv 
		if ( $temps_livraison > 2 )
			$eKomi=0;		
		else
			$eKomi=1;
			
//echo 	$eKomi . '///<br>';		
		
		if ($eKomi)
		{
			$url = get_ekomi_url("bf", $orders_products_id);
			
           $choix_sondage = "
Pour répondre au sondage, sélectionnez le lien suivant:<br>
<a href=".$url.">".$url."</a>
";		   
			
			$nb_questions = 3;						
		}
		else
		{
			$nb_questions = 8;			
		}

        $spam->set_email_title ("Répondez à  " . $nb_questions .  " questions sur votre achat de ". $products_name ." et gagnez une extension de garantie !",2);

// En remerciement, si vous répondez à ce questionnaire avant le ".$date_limite.", nous vous ferons bénéficier d'un bon de réduction  couvrant les frais de port pour votre prochain achat sur le site Easybatteries.fr.		
        $content = "
Bonjour,
<br><br>
Dans le cadre de sa politique d'amélioration des services offerts aux clients, easybatteries.fr vous propose de répondre, en moins d'une minute, à un questionnaire de satisfaction en ligne.
<br><br>
En remerciement, si vous répondez à ce questionnaire avant le ".$date_limite.", nous vous ferons bénéficier d'une extension de garantie de deux mois sur votre ". $products_name . ".
<br><br>
". $choix_sondage ."
<br><br>
Si cela ne fonctionne pas veuillez copier le lien et le coller dans la barre d'adresse de votre navigateur Internet.
<br><br>
Bien cordialement.
<br><br>
Le service client de Easybatteries.fr.";


        $spam->set_email_content ($content,2);
		}
		 		
     $spam->set_receiver_email_address($customers_email_address);
//$spam->set_receiver_email_address('f_varon@hotmail.com');
     $spam->send_email();
//exit;	 
flush();				
        $orders_list .= ','.$orders_id.'<br>';     
     }
     $row += 1 ;
  } 
     $spam->set_receiver_email_address('fvaron@easylamps.fr');
     $spam->set_email_title('rapport chaine de nuit',2);     
     $spam->set_email_content($orders_list,2);
     $spam->send_email();
  
exit;

	$lib['LO5']="Module original complet : support original et ampoule originale ";
	$lib['LO9']="Module original complet : support original et ampoule originale ";
	$lib['OI5']="Module Original Inside complet : support compatible et ampoule originale ";	
	$lib['LC5']="Module compatible complet : support compatible et ampoule compatible ";
	$lib['BC5']="Ampoule seule compatible :  ampoule compatible ";	

	$lib2['LO5']="Lampe originale  ";
	$lib2['LO9']="Lampe originale  ";
	$lib2['OI5']="Lampe original inside ";	
	$lib2['LC5']="Lampe compatible ";
	$lib2['BC5']="Bulbe compatible ";	
	
	$lib3['LO']=" lampes originales  ";
	$lib3['OI']=" lampes 'original inside'";	
	$lib3['LC']=" lampes compatibles ";
	$lib3['BC']=" ampoules compatibles ";	
	
	$lib4['LO']="lampe-originales";
	$lib4['OI']="lampes-original-inside";	
	$lib4['LC']="lampes-compatibles";
	$lib4['BC']="ampoules-compatibles";	
	
	//$decallages=array(130,127,124,121,118,115,112,109,106,103,100,97,94,91,88,85,82,79,76,73,70,67,64,61,58,55,52,49,46,43,40,37,34,31,28,25,22,19,16,13,10,7);
    $decallages=array(40,70,100,130,160);

//	$decallages=array(130,127,124,121,118);
	for($dec=0;$dec<sizeof($decallages);$dec++)
	{
// 	$decallage = 130;
	    $decallage=$decallages[$dec];
	    $row1=0;
		
		$ref_price_list_id = 1;

	    $res = @mysql_connect(DB_SERVER_EU, DB_SERVER_USERNAME_EU ,DB_SERVER_PASSWORD_EU) or die ("probleme connexion");
	    @mysql_select_db(DB_DATABASE_EU,$res) or die ("probleme dans selection base");
		
	    $news_lampes_ctr_code = array();
	    $news_lampes_ref_vp = array();
	    $news_lampes_ref_lampe = array();
		$news_lampes_prix_lampe = array();

		
		// date des nouveautés ; suppression des  nouveautés existantes pour cette date///
		$sql = "select  last_day(DATE_SUB(CURDATE(),INTERVAL " . $decallage  .  " DAY)),
		                DATE_SUB(last_day(DATE_SUB(CURDATE(),INTERVAL " . $decallage  .  " DAY)),INTERVAL 15 DAY)";
		$id = mysql_query($sql, $res);
		$date_parution=mysql_result($id,0,0);
		$date_parution_type=mysql_result($id,0,1);
//echo 	$date_parution_type;exit;   
		///----------------  NOUVEAUTES ------------------------------------------------------------------
		//  ---------------------------------------------------------------------- ----------------------------------------------------------------------
		//  création de VP ; les constructeurs.  ----------------------------------------------------------------------
		$sql = "select  cstrd.categories_name, cstrd.categories_id, count(vp.categories_id),
				date_format(DATE_SUB(CURDATE(),INTERVAL " . $decallage  .  " DAY) , \"%d/%c/%Y\" ),
				DATE_SUB(CURDATE(),INTERVAL " . $decallage  .  " DAY),
				MONTH(DATE_SUB(CURDATE(),INTERVAL " . $decallage  .  " DAY)),
				YEAR(DATE_SUB(CURDATE(),INTERVAL " . $decallage  .  " DAY))
		        from categories_description cstrd,  categories vp
		        where cstrd.categories_id = vp.parent_id
				and cstrd.categories_name in ( select ctr_code from el_seo_manufacturers )
				and year(vp.date_added)=year(DATE_SUB(CURDATE(),INTERVAL " . $decallage  .  " DAY))
				and month(vp.date_added)=month(DATE_SUB(CURDATE(),INTERVAL " . $decallage  .  " DAY))
				group by cstrd.categories_name, cstrd.categories_id";
		$id = mysql_query($sql, $res);
	    
		while (mysql_fetch_row($id))
	    {
//echo $sql."<br>";exit;
		
	       $ctr_name   = mysql_result($id,$row1,0);	
	       $ctr_id   = mysql_result($id,$row1,1);
		   $creation_nb =  mysql_result($id,$row1,2);
		   $date_dispo = mysql_result($id,$row1,3);
		   $date_ref = mysql_result($id,$row1,4);
		   $month = mysql_result($id,$row1,5);
		   $year = mysql_result($id,$row1,6);
		   
		   $today = date("m.d.Y");    
		   $titre[$row1] = $creation_nb." nouvelles lampes ". $ctr_name ." disponibles en ". get_month_name($month). ' ' . $year;
		   $ctr_code[$row1]=$ctr_name;
		   
		   // FVV
//echo $titre[$row1].'<br>'.$row1."<br>";
		   $sql2 = "select vpd.categories_name, vpd.categories_id , date_format( vp.date_added , \"%d/%c/%Y\" )
		            from categories_description vpd,  categories vp
		        where  vp.parent_id = " . $ctr_id . "
				and   vpd.categories_id = vp.categories_id
				and year(vp.date_added)=year(DATE_SUB(CURDATE(),INTERVAL " . $decallage  .  " DAY))
				and month(vp.date_added)=month(DATE_SUB(CURDATE(),INTERVAL " . $decallage  .  " DAY))";
//echo "<br>".$sql2."<br>";
				
			$row2 = 0;	
			$id2 = mysql_query($sql2, $res);
		    $cnt_news_lampes = 0;
			
			while ( (mysql_fetch_row($id2)) && ($row2<=4) )
		    {
		        $nom_vp   = mysql_result($id2,$row2,0);
		        $id_vp   = mysql_result($id2,$row2,1);
		        $date_dispo   = mysql_result($id2,$row2,2);
			
			    $sous_titre[$row1][$row2]="lampe videoprojecteur ". $nom_vp;
echo "sous_titre".$sous_titre[$row1][$row2]."<br>";
			    $row3 = 0;
				$texte[$row1][$row2]="Cette référence de vidéoprojecteur est enregistrée au catalogue le :".$date_dispo.'<br><br>';
				$texte[$row1][$row2].="Les lampes de remplacement  pour ce videoprojecteur sont:<br>";
				
			   $sql3 = "select prd.products_model, man.manufacturers_name, prdd.products_name
			            from products prd,  manufacturers man, products_description prdd
						where  prd.master_categories_id = " . $id_vp . "
						and prdd.products_id = prd.products_id 
						and man.manufacturers_id = prd.manufacturers_id";
echo "<br>".$sql3."<br>";

				$id3 = mysql_query($sql3, $res);
				while ( (mysql_fetch_row($id3))  )
			    {
				
			        $products_model   = mysql_result($id3,$row3,0);
			        $manufacturers_name   = mysql_result($id3,$row3,1);
			        $lamp_code = mysql_result($id3,$row3,2);
					
					if  ( ( $manufacturers_name == "LO5" )	|| ( $manufacturers_name == "LO9" )	)						
						$texte[$row1][$row2].=  "<a href='".$ctr_name."/".$lamp_code."-lprf.html'>Lampe " . $lamp_code.  ".</a> - ". $lib[$manufacturers_name];
					else 
						$texte[$row1][$row2].= "Lampe " . $lamp_code . ' - ' . $lib[$manufacturers_name];					
                    					
					$sql4 = "select price
					         from el_price
							 where price_list_id =" . $ref_price_list_id."
							 and lamp_code = '".$lamp_code."'
							 and ctr_code = '".$ctr_name."'";

					$products_price=0;		 
					$id4 = mysql_query($sql4, $res);
					if ( mysql_fetch_row($id4) )
					{
				        $products_price   = mysql_result($id4,0,0);
						if ( $products_price>0 )		 
						{
							$texte[$row1][$row2].= " vendue sur le site lampevideoprojecteur.fr à un prix attractif de " . $products_price. ' € hors taxes';
						}
					}				
					$texte[$row1][$row2].= '.<br>';
					//-----------------
					
					$cnt_news_lampes++;
					$typ_lamp = substr($manufacturers_name,0,2);
					
					$news_lampes_ctr_code[$typ_lamp][]=$ctr_name;
					$news_lampes_ref_vp[$typ_lamp][]=$nom_vp; 				
					$news_lampes_ref_lampe[$typ_lamp][]=$lamp_code; 
					$news_lampes_prix_lampe[$typ_lamp][]=$products_price; 
					
					$row3++;
				   
				}
echo $texte[$row1][$row2];									
				$row2++;		    
	        }	   		
	   	    $row += 1;				
	   	    $row1 += 1;
		}		
		//  ici l'insertion
		//echo $row2;		
		echo "<br><br>";
	    $res = @mysql_connect(DB_SERVER_FR, DB_SERVER_USERNAME_FR ,DB_SERVER_PASSWORD_FR) or die ("probleme connexion");
	    @mysql_select_db(DB_DATABASE_FR,$res) or die ("probleme dans selection base");

		for($k=0;$k<sizeof($titre);$k++)
		{
			// suppression des articles pour cette date de parution
			$dml = "delete  FROM `eb_texts` 
			        WHERE id_article 
					in (select id 
					    from eb_articles 
						where ltrim(rtrim(constructeur))='".$ctr_code[$k]."'
						and type = 'Actualité'
						and date_parution='".$date_parution."')";
			$id = mysql_query ( $dml  , $res );


			$dml = "delete  FROM `eb_articles` 
			        WHERE  ltrim(rtrim(constructeur))='".$ctr_code[$k]."'
				    and type = 'Actualité'
					and date_parution='".$date_parution."'";
//echo $dml;exit;					
			$id = mysql_query ( $dml  , $res );
		
		    $url = "nouvelles-lampes-videoprojecteurs-".$ctr_code[$k]."-au-".$date_parution.".html";
			echo $titre[$k];
			$dml = "
				INSERT INTO `eb_articles` 
				( `id_page`, `type`,
				 `constructeur`, `typeprod`, `publi`,
				  `ordre`, `dt_maj`,date_parution,
	         	   url	  ) VALUES
				(  1, 'Actualité',
				 '".$ctr_code[$k]."', '', 0,
				  4, now(), '".$date_parution."',
				  '".$url."')";

		    $id = mysql_query ( $dml  , $res );
			$id_article = mysql_insert_id() ;
				  
			echo "<br>".$dml."<br>";


			$dml = "  INSERT INTO `eb_texts` 
						( `id_article`, `format`,
						 `ordre`, `fr_text`, `en_text`,
						  `sp_text`, `it_text`, `de_text`, 
						  `dt_maj`) VALUES
						( '".$id_article ."' , 'Titre',
						 1, '".$titre[$k] ."', '',
						 '', '', 
						 '', now() )";
						 
			echo "<br>".$dml."<br>";
		    $id = mysql_query ( $dml  , $res );
			
			for($l=0;$l<sizeof($sous_titre[$k]);$l++)
			{
				$dml = "  INSERT INTO `eb_texts` 
							( `id_article`, `format`,
							 `ordre`, `fr_text`, `en_text`,
							  `sp_text`, `it_text`, `de_text`, 
							  `dt_maj`) VALUES
							( '".$id_article ."' , 'Sous-titre',
							 ". ($l+1).", '".addslashes($sous_titre[$k][$l])."', '',
							 '', '', 
							 '', now() )";
							 
				echo "<br>".$dml."<br>";
			    $id = mysql_query ( $dml  , $res );
			
				echo '<br>';			
				echo $sous_titre[$k][$l];
				$dml = "  INSERT INTO `eb_texts` 
							( `id_article`, `format`,
							 `ordre`, `fr_text`, `en_text`,
							  `sp_text`, `it_text`, `de_text`, 
							  `dt_maj`) VALUES
							( '".$id_article ."' , 'Paragraphe',
							 ".($l+1).", '".addslashes($texte[$k][$l])."', '',
							 '', '', 
							 '', now() )";
							 
				echo "<br>".$dml."<br>";
			    $id = mysql_query ( $dml  , $res );
				
				echo '<br>';

				echo $texte[$k][$l];
			}
		}
		$sous_titre=array();
		$texte=array();
					
        //  FVV
		$type_lampes = array('LO','OI','LC','BC');
		$current_cstr="";
		$ctr_num=0;
		$titre = array();
		$sous_titre = array();
		$texte = array();		
		for ($h=0;$h<4;$h++)
		{
		   $typ_lamp=$type_lampes[$h];
		   $ctr_num = 0;
		   //$news_lampes_ctr_code
		   $current_cstr="";		   
		   $ctr_num=0;
		   for ($i=0;$i<sizeof($news_lampes_ctr_code[$typ_lamp]);$i++)
		   {
				// suppression des articles pour cette date de parution
				$dml = "delete  FROM `eb_texts` 
				        WHERE id_article 
						in (select id 
						    from eb_articles 
							where ltrim(rtrim(typeprod))='".$typ_lamp."'
							and type = 'Actualité'
							and date_parution='".$date_parution_type."')";
				$id = mysql_query ( $dml  , $res );


				$dml = "delete  FROM `eb_articles` 
				        WHERE  ltrim(rtrim(typeprod))='".$typ_lamp."'
					    and type = 'Actualité'
						and date_parution='".$date_parution_type."'";
//echo $dml;exit;					
				$id = mysql_query ( $dml  , $res );
				
				
				
		      if (strlen($news_lampes_ctr_code[$typ_lamp][$i])>0 )
			  {
			    if ($news_lampes_ctr_code[$typ_lamp][$i]!= $current_cstr)
				{
					$ctr_num++;
					$current_cstr=$news_lampes_ctr_code[$typ_lamp][$i];				
					$sous_titre[$typ_lamp][$ctr_num]="Nouvelles lampes ".$current_cstr;
				}
				
				$texte[$typ_lamp][$ctr_num].= 'Lampe pour videoprojecteur:'. $news_lampes_ref_vp[$typ_lamp][$i];
				$texte[$typ_lamp][$ctr_num].= '; référence lampe :'. $news_lampes_ref_lampe[$typ_lamp][$i];
				if ( $news_lampes_prix_lampe[$typ_lamp][$i]>0 )
				{
				   $texte[$typ_lamp][$ctr_num].= ' à un prix de :'. $news_lampes_prix_lampe[$typ_lamp][$i]. ' € ';
				}
				$texte[$typ_lamp][$ctr_num].= "<br>";
			  }
		   }
		   
		   
		   if (strlen($sous_titre[$typ_lamp][1])>0)
		   {	   
	            $url = 'nouveautes-'.$lib4[$typ_lamp].'-au-'.$date_parution_type;
			  
				$dml = "
					INSERT INTO `eb_articles` 
					( `id_page`, `type`,
					 `constructeur`, `typeprod`, `publi`,
					  `ordre`, `dt_maj`,date_parution,
		         	   url	  ) VALUES
					(  1, 'Actualité',
					 '', '". $typ_lamp ."', 0,
					  4, now(), '".$date_parution_type."',
					  '".$url."')";

			    $id = mysql_query ( $dml  , $res );
				$id_article = mysql_insert_id() ;
					  
				echo "<br>".$dml."<br>";

				$titre = 'Nouvelles '. $lib3[$typ_lamp]." au ".$date_parution_type;

				$dml = "  INSERT INTO `eb_texts` 
							( `id_article`, `format`,
							 `ordre`, `fr_text`, `en_text`,
							  `sp_text`, `it_text`, `de_text`, 
							  `dt_maj`) VALUES
							( '".$id_article ."' , 'Titre',
							 1, '".addslashes($titre) ."', '',
							 '', '', 
							 '', now() )";
							 
				echo "<br>".$dml."<br>";
			    $id = mysql_query ( $dml  , $res );
				
			  
			  for($j=1;$j<=sizeof($sous_titre[$typ_lamp]);$j++)
			  {
			     echo '<br>';
				 echo $sous_titre[$typ_lamp][$j];
			     echo '<br>';			 
				 echo $texte[$typ_lamp][$j];
				 
					$dml = "  INSERT INTO `eb_texts` 
								( `id_article`, `format`,
								 `ordre`, `fr_text`, `en_text`,
								  `sp_text`, `it_text`, `de_text`, 
								  `dt_maj`) VALUES
								( '".$id_article ."' , 'Sous-titre',
								 ". ($j).", '".addslashes($sous_titre[$typ_lamp][$j])."', '',
								 '', '', 
								 '', now() )";
								 
					echo "<br>".$dml."<br>";
				    $id = mysql_query ( $dml  , $res );
				
					echo '<br>';			
					echo $sous_titre[$k][$l];
					$dml = "  INSERT INTO `eb_texts` 
								( `id_article`, `format`,
								 `ordre`, `fr_text`, `en_text`,
								  `sp_text`, `it_text`, `de_text`, 
								  `dt_maj`) VALUES
								( '".$id_article ."' , 'Paragraphe',
								 ".($j).", '".addslashes($texte[$typ_lamp][$j])."', '',
								 '', '', 
								 '', now() )";
								 
					echo "<br>".$dml."<br>";
				    $id = mysql_query ( $dml  , $res );
					
					echo '<br>';
				 
			  }
		   }
		}
		$titre = array();
		$sous_titre = array();
		$texte = array();		
	  /*
		
	    $res = @mysql_connect(DB_SERVER_EU, DB_SERVER_USERNAME_EU ,DB_SERVER_PASSWORD_EU) or die ("probleme connexion");
	    @mysql_select_db(DB_DATABASE_EU,$res) or die ("probleme dans selection base");
		
		$cnt_news_lampes = 0;
		
		$news_lampes_ctr_code = array();
		$news_lampes_ref_vp = array();
		$news_lampes_ref_lampe = array();
		$news_lampes_prix_lampe = array();
		
		///----------------  NOUVEAUX PRIX ------------------------------------------------------------------
		//  ---------------------------------------------------------------------- ----------------------------------------------------------------------
		//  création de VP ; les constructeurs.  ----------------------------------------------------------------------
		$sql = "select  cstrd.categories_name, cstrd.categories_id, count(el_price.lamp_code),
				date_format( DATE_SUB(CURDATE(),INTERVAL " . $decallage  .  " DAY) , \"%d/%c/%Y\" ) 
		        from categories_description cstrd,  el_price 
		        where el_price.price_list_id = ". $ref_price_list_id  ."
				and el_price.ctr_code = cstrd.categories_name
				and cstrd.categories_name in ( select ctr_code from el_seo_manufacturers )
				and year(el_price.date_created)=year(DATE_SUB(CURDATE(),INTERVAL " . $decallage  .  " DAY))
				and week(el_price.date_created)=week(DATE_SUB(CURDATE(),INTERVAL " . $decallage  .  " DAY))
				group by cstrd.categories_name, cstrd.categories_id";

				
		$id = mysql_query($sql, $res);
	    $row=0;
		$cnt_news_lampes=0;
		while (mysql_fetch_row($id))
	    {
	       $ctr_name   = mysql_result($id,$row,0);	
	       $ctr_id   = mysql_result($id,$row,1);
		   $creation_nb =  mysql_result($id,$row,2);
		   $date_dispo = mysql_result($id,$row,3);
		   
		   $today = date("m.d.Y");    
		   $titre[$row] = $creation_nb." baisses de prix sur les  lampes de videoprojecteur ". $ctr_name ." au ". $date_dispo;
		   $ctr_code[$row] = $ctr_name;
		   
//	   echo $titre.'<br>';
		   $sql2 = "select lamp_code, manufacturers_name, el_price.price
		            from  el_price, products_description prdd, products prd, manufacturers man
		        where   el_price.price_list_id = ". $ref_price_list_id  ."
				and el_price.ctr_code = '" . $ctr_name . "'
				and el_price.lamp_code = prdd.products_name
				and prdd.products_id = prd.products_id
				and man.manufacturers_id = prd.manufacturers_id
				and year(el_price.date_created)=year(DATE_SUB(CURDATE(),INTERVAL " . $decallage  .  " DAY))
				and week(el_price.date_created)=week(DATE_SUB(CURDATE(),INTERVAL " . $decallage  .  " DAY))";
			$row2 = 0;	
			$id2 = mysql_query($sql2, $res);
				
			while ( (mysql_fetch_row($id2)) && ($row2<=5) )
		    {
		        $lamp_code   = mysql_result($id2,$row2,0);
		        $lamp_type   = mysql_result($id2,$row2,1);
		        $price   = mysql_result($id2,$row2,2);
				
				$cnt_news_lampes++;
				
				$typ_lamp = substr($lamp_type,0,2);
				
				$news_lampes_ctr_code[$typ_lamp][$cnt_news_lampes]=$ctr_name;
				$news_lampes_ref_lampe[$typ_lamp][$cnt_news_lampes]=$lamp_code; 
				$news_lampes_prix_lampe[$typ_lamp][$cnt_news_lampes]=$price; 
				
			    
			    $sous_titre[$row][$row2]="Lampe ". $lamp_code . " nouveau prix de ". $price . " € hors taxes ";

			    $row3 = 0;
				
				$texte[$row][$row2] = $lib2[$lamp_type];
				$texte[$row][$row2] .= " , ". $lamp_code . " s'adapte aux videoprojecteurs suivants :";

				$cnt_news_lampes++;
				$typ_lamp = substr($lamp_type,0,2);
				
				$cnt_news_lampes++;
				$news_lampes_ctr_code[$typ_lamp][$cnt_news_lampes]=$ctr_name;
				$news_lampes_ref_lampe[$typ_lamp][$cnt_news_lampes]=$lamp_code; 
				$news_lampes_prix_lampe[$typ_lamp][$cnt_news_lampes]=$price; 
				
			   $sql3 = "select catd.categories_name
			            from products prd,  products_description prdd, categories_description catd
						where  prdd.products_id = prd.products_id 
						and prdd.products_name = '". $lamp_code . "'
						and catd.categories_id = prd.master_categories_id ";
//echo $sql3;exit;					
				$id3 = mysql_query($sql3, $res);
				
				while ( (mysql_fetch_row($id3))  )
			    {
				
			        $vp_name   = mysql_result($id3,$row3,0);
					$texte[$row][$row2].=", ". $vp_name;

					$row3++;			   
				}
				$row2++;		    
	        }	   		
				
	   	    $row += 1;			
		}		
		
	    $res = @mysql_connect(DB_SERVER_FR, DB_SERVER_USERNAME_FR ,DB_SERVER_PASSWORD_FR) or die ("probleme connexion");
	    @mysql_select_db(DB_DATABASE_FR,$res) or die ("probleme dans selection base");
		
		for($k=0;$k<sizeof($titre);$k++)
		{
//echo "k".$k;	
		
			echo $titre[$k];
		    $url = "baisses-de-prix-lampes-".$ctr_code[$k]."-au-".$date_parution.".html";
			
			$dml = "
				INSERT INTO `eb_articles` 
				( `id_page`, `type`,
				 `constructeur`, `typeprod`, `publi`,
				  `ordre`, `dt_maj`,date_parution,
	               url	  ) VALUES
				(  1, 'Actualité',
				 '".$ctr_code[$k]."', '', 0,
				  4, now(), '".$date_parution."',
				  '".$url."')";

		    $id = mysql_query ( $dml  , $res );
			$id_article = mysql_insert_id() ;
				  
			echo "<br>".$dml."<br>";


			$dml = "  INSERT INTO `eb_texts` 
						( `id_article`, `format`,
						 `ordre`, `fr_text`, `en_text`,
						  `sp_text`, `it_text`, `de_text`, 
						  `dt_maj`) VALUES
						( '".$id_article ."' , 'Titre',
						 1, '".$titre[$k] ."', '',
						 '', '', 
						 '', now() )";
						 
			echo "<br>".$dml."<br>";
		    $id = mysql_query ( $dml  , $res );
			
			for($l=0;$l<sizeof($sous_titre[$k]);$l++)
			{
				$dml = "  INSERT INTO `eb_texts` 
							( `id_article`, `format`,
							 `ordre`, `fr_text`, `en_text`,
							  `sp_text`, `it_text`, `de_text`, 
							  `dt_maj`) VALUES
							( '".$id_article ."' , 'Sous-titre',
							 ". ($l+1).", '".addslashes($sous_titre[$k][$l])."', '',
							 '', '', 
							 '', now() )";
							 
				echo "<br>".$dml."<br>";
			    $id = mysql_query ( $dml  , $res );
			
				echo '<br>';			
				echo $sous_titre[$k][$l];
				$dml = "  INSERT INTO `eb_texts` 
							( `id_article`, `format`,
							 `ordre`, `fr_text`, `en_text`,
							  `sp_text`, `it_text`, `de_text`, 
							  `dt_maj`) VALUES
							( '".$id_article ."' , 'Paragraphe',
							 ".($l+1).", '".addslashes($texte[$k][$l])."', '',
							 '', '', 
							 '', now() )";
							 
				echo "<br>".$dml."<br>";
			    $id = mysql_query ( $dml  , $res );
				
				echo '<br>';

				echo $texte[$k][$l];
			}
		}					
		// une annonce  pour les types de lampes // hausses de prix //
		$sous_titre=array();
		$texte=array();
					

		$type_lampes = array('LO','OI','LC','BC');
		$current_cstr="";
		$ctr_num=0;
		$titre=array();
		
		for ($h=0;$h<4;$h++)
		{
		   $typ_lamp=$type_lampes[$h];
		   $ctr_num = 0;
		   for ($i=1;$i<=$cnt_news_lampes;$i++)
		   {
		      if (strlen($news_lampes_ctr_code[$typ_lamp][$i])>0 )
			  {
			    if ($news_lampes_ctr_code[$typ_lamp][$i]!= $current_cstr)
				{
					$ctr_num++;
					$current_cstr=$news_lampes_ctr_code[$typ_lamp][$i];				
					$sous_titre[$typ_lamp][$ctr_num]="Baisses de prix pour lampes ".$current_cstr;
				}
				$texte[$typ_lamp][$ctr_num] = 'Référence produit :'. $news_lampes_ref_lampe[$typ_lamp][$i];
				if ( $news_lampes_prix_lampe[$typ_lamp][$i]>0 )
				{
				   $texte[$typ_lamp][$ctr_num].= ' proposée à nouveau prix compétitif de :'. $news_lampes_prix_lampe[$typ_lamp][$i]. ' € ';
				}
				$texte[$typ_lamp][$ctr_num].= "<br>";
			  }
		   }
		   
		   if (strlen($sous_titre[$typ_lamp][1])>0)
		   {	   
	            $url = 'baisses-de-prix-'.$lib4[$typ_lamp].'-au-'.$date_parution;
			  
				$dml = "
					INSERT INTO `eb_articles` 
					( `id_page`, `type`,
					 `constructeur`, `typeprod`, `publi`,
					  `ordre`, `dt_maj`,date_parution,
		         	   url	  ) VALUES
					(  1, 'Actualité',
					 '', '". $typ_lamp ."', 0,
					  4, now(), '".$date_parution."',
					  '".$url."')";

			    $id = mysql_query ( $dml  , $res );
				$id_article = mysql_insert_id() ;
					  
				echo "<br>".$dml."<br>";

				$titre = 'Baisses de prix  '. $lib3[$typ_lamp]." au ".$date_parution;

				$dml = "  INSERT INTO `eb_texts` 
							( `id_article`, `format`,
							 `ordre`, `fr_text`, `en_text`,
							  `sp_text`, `it_text`, `de_text`, 
							  `dt_maj`) VALUES
							( '".$id_article ."' , 'Titre',
							 1, '".addslashes($titre) ."', '',
							 '', '', 
							 '', now() )";
							 
				echo "<br>".$dml."<br>";
			    $id = mysql_query ( $dml  , $res );
				
			  
			  for($j=1;$j<=sizeof($sous_titre[$typ_lamp]);$j++)
			  {
			     echo '<br>';
				 echo $sous_titre[$typ_lamp][$j];
			     echo '<br>';			 
				 echo $texte[$typ_lamp][$j];
				 
					$dml = "  INSERT INTO `eb_texts` 
								( `id_article`, `format`,
								 `ordre`, `fr_text`, `en_text`,
								  `sp_text`, `it_text`, `de_text`, 
								  `dt_maj`) VALUES
								( '".$id_article ."' , 'Sous-titre',
								 ". ($j).", '".addslashes($sous_titre[$typ_lamp][$j])."', '',
								 '', '', 
								 '', now() )";
								 
					echo "<br>".$dml."<br>";
				    $id = mysql_query ( $dml  , $res );
				
					echo '<br>';			
					echo $sous_titre[$k][$l];
					$dml = "  INSERT INTO `eb_texts` 
								( `id_article`, `format`,
								 `ordre`, `fr_text`, `en_text`,
								  `sp_text`, `it_text`, `de_text`, 
								  `dt_maj`) VALUES
								( '".$id_article ."' , 'Paragraphe',
								 ".($j).", '".addslashes($texte[$typ_lamp][$j])."', '',
								 '', '', 
								 '', now() )";
								 
					echo "<br>".$dml."<br>";
				    $id = mysql_query ( $dml  , $res );
					
					echo '<br>';			 
			  }
		   }
		}
		*/
    }	
	
    // envoi de mail à l'administrateur.. 
     $spam->set_receiver_email_address('fvaron@easylamps.fr');
     $spam->set_email_title('rapport chaine de nuit',2);     
     $spam->set_email_content($orders_list,2);
     $spam->send_email();
?>  