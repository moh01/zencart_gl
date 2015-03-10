<!--
-------------------------------------------------------------
 Topic	 : Exemple PHP traitement de la requête de paiement
 Version : 500

 		Dans cet exemple, on affiche un formulaire HTML
		de connection à l'internaute.

-------------------------------------------------------------
-->

<!--	Affichage du header html	-->
 <?php

  include_once('/home/easylamp/www/sites/zenCart/cyberplus/cyberplus_functions.php');
  echo get_card_selection();
?>
