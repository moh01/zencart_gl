<?php
/**
 *
 * @version $Id: salemaker_info.php, v 1.3.7 2007/04/26 11:48:12 $;
 *
 * @author Zen Cart Development Team
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 *
 * Modyfikacje do ZenCart.pl
 * @author Grupa ZenCart.pl <kontakt@zencart.pl>
 * @copyright Copyright &copy; 2007, ZenCart.pl
 * Wi�cej informacji na stronie projektu {@link http://www.zencart.pl ZenCart.pl} Zajrzyj!
 *
 *
 * @package admin
 *
 */
define( 'HEADING_TITLE', 'Obni�ki' );
define( 'SUBHEADING_TITLE', 'U�ywanie obni�ek:' );
define( 'INFO_TEXT', '<ul><li>Zawsze u�ywaj \'.\' jako separatora dziesi�tnego w warto�ciach obni�ek.</li><li>Wpisuj warto�� w tej samej walucie w jakiej wpisujesz/edytujesz produkt</li><li>W polu Warto�� obni�ki mo�esz wpisa� warto�� lub procent obni�ki lub now� cen�. (np. obni�ka o 5.00PLN dla wszystkich cen, obni�ka 10% dla wszystkich cen lub zmie� wszystkie ceny na 25.00PLN)</li><li>Mo�esz wpisa� zakres cen, dla kt�rych b�dzie obbowi�zywa�a obni�ka. (np. produkty o cenie mi�dzy 50.00PLN a 150.00PLN)</li><li>Musisz wybra� odpowiedni� warto�� dla pola "Je�li produkt jest w promocji":<br /><ul><li><strong>Ignoruj cen� promocyjn� - Do��cz do ceny produktu i usu� cen� promocyjn�</strong><br />Warto�� obni�ki zostanie do��czona do ceny produktu, a nie do ceny w promocji. (np. cena regularna 10.00PLN, cena promocyjna 9.50PLN, obni�ka wynosi 10%. Cena ko�cowa produktu b�dzie wynosi�a 9.00PLN. Cena promocyjna zosta�a zignorowana.)</li><li><strong>Ignoruj warunki obni�ek - Obni�ka nie zostanie uwzgl�dniona, je�li istnieje promocja</strong><br />Obni�ka nie zostanie uwzgl�dniona dla produkt�w w promocji. Cena promocyjna zostanie taka, jakby obni�ka nie by�a zdefiniowana. (np. cena regularna 10.00PLN, cena promocyjna 9.50PLN, obni�ka wynosi 10%. Cena ko�cowa produktu b�dzie wynosi�a 9.50PLN. Obni�ka zosta�a zignorowana.)</li><li><strong>Do��cz obni�k� do ceny promocyjnej - lub do��cz do ceny w przeciwnym przypadku</strong><br />Obni�ka b�dzie dodana do ceny promocyjnej, je�li taka istnieje (np. cena regularna 10.00PLN, cena promocyjna 9.50PLN, obni�ka wynosi 10%. Cena ko�cowa produktu b�dzie wynosi�a $8.55. Czyli uwzgl�dniono obni�k� 10% liczonej dla ceny promocyjnej.)</li></ul></li><li>Pozostaw pole "Pocz�tek" puste, aby obni�ka zacz�a obowi�zywa� od razu.</li><li>Pozostaw pole "Koniec" puste, aby obni�ka obowi�zywa�a ca�y czas.</li><li>Zaznacz kategorie, jesli chcesz automatycznie wybra� wszystkie podkategorie.</li></ul>' );
define( 'TEXT_CLOSE_WINDOW', '[ zamknij ]' );

?>