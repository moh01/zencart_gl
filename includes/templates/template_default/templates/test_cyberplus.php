<!--
-------------------------------------------------------------
 Topic	 : Exemple PHP traitement de la requ�te de paiement
 Version : 500

 		Dans cet exemple, on affiche un formulaire HTML
		de connection � l'internaute.

-------------------------------------------------------------
-->

<!--	Affichage du header html	-->
 <?php

  include_once('/home/easylamp/www/sites/zenCart/cyberplus/cyberplus_functions.php');
  echo get_card_selection();
?>
