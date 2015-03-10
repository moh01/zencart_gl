<?php
  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
echo '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Liste emails</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } ">';

echo "<script language=\"javascript\" type=\"text/javascript\"><!--
								function popupInvoice(url) {
								  window.open(url,'popupWindowI','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=800,height=600,screenX=800,screenY=600,top=100,left=100')
								}
	//--></script>";

echo "<script language=\"javascript\" type=\"text/javascript\"><!--
  function popupWindow(url, features) {
    window.open(url,'popupWindow',features)
  }							
	//--></script>";
	$sql = 'select domain_name, contact_name from el_book';
	$rs = $db->Execute($sql);
	
    while (!$rs->EOF)
	{
	   echo $rs->fields['domain_name']. '   '.$rs->fields['contact_name']. '<br>';
	   $email_extension = '@' . str_replace (  "www.", "", $rs->fields['domain_name'] );

	   echo "<br><br>";
	   echo "contact".$email_extension;
	   
	   $contacts .=  "contact".$email_extension.'
'; 
	   
	   echo "<br>";	   
	   
	   //    for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {	       
	   
	   $associes = explode('
', $rs->fields['contact_name']);
	   for ($i = 0, $n = sizeof($associes); $i < $n; $i++) 
	   {	       	   
	       
		   $names = explode(' ', $associes[$i]);
           if (sizeof($names)==2)
		   {
			   echo "<br>";	   
$emails = "";
		       $email = strtolower($names[0]).$email_extension;
			   $emails .=  $email.'
';			   
               echo $email;
			   echo "<br>";	   
			   
		       $email = strtolower($names[1]).$email_extension;
			   $emails .=  $email.'
';			   
               echo $email;
			   echo "<br>";	   


		       $email = strtolower(substr($names[0],0,1). $names[1]).$email_extension;
			   $emails .=  $email.'
';			   
               echo $email;
			   echo "<br>";	   
			   

		       $email = strtolower( $names[0] .substr($names[1],0,1) ).$email_extension;
			   $emails .=  $email.'
';			   
               echo $email;
			   echo "<br>";	   


		       $email = strtolower($names[0].'.'. $names[1]).$email_extension;
			   $emails .=  $email.'
';			   
               echo $email;
			   echo "<br>";	   
			   
			   echo "<br>";	   
			   			   
			}
			else if (sizeof($names)==3)
		   {
		       $email = strtolower($names[2]).$email_extension;
			   $emails .=  $email.'
';			   
               echo $email;
			   echo "<br>";	   
		   
		       $email = strtolower($names[0].'-'. $names[1]. $names[2]).$email_extension;
			   $emails .=  $email.'
';			   
               echo $email;
			   echo "<br>";	   

		       $email = strtolower( substr($names[0],0,1). substr($names[0],0,1). $names[2]).$email_extension;
			   $emails .=  $email.'
';			   
               echo $email;
			   echo "<br>";	   			   
		       
		   }
			
	   }
	   $rs->MoveNext();	   
	}
	   echo "<hr>";	   
	   echo '<textarea rows=20 cols=60>';
       echo  $contacts;
	   echo '</textarea>';	
	
	   echo "<hr>";	   
	   echo '<textarea rows=20 cols=60>';
	   echo $emails;
	   echo '</textarea>';	
	echo '</body>	 
	
	</html>';
?>	