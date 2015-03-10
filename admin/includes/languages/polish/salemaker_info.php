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
 * Wiêcej informacji na stronie projektu {@link http://www.zencart.pl ZenCart.pl} Zajrzyj!
 *
 *
 * @package admin
 *
 */
define( 'HEADING_TITLE', 'Obni¿ki' );
define( 'SUBHEADING_TITLE', 'U¿ywanie obni¿ek:' );
define( 'INFO_TEXT', '<ul><li>Zawsze u¿ywaj \'.\' jako separatora dziesiêtnego w warto¶ciach obni¿ek.</li><li>Wpisuj warto¶æ w tej samej walucie w jakiej wpisujesz/edytujesz produkt</li><li>W polu Warto¶æ obni¿ki mo¿esz wpisaæ warto¶æ lub procent obni¿ki lub now± cenê. (np. obni¿ka o 5.00PLN dla wszystkich cen, obni¿ka 10% dla wszystkich cen lub zmieñ wszystkie ceny na 25.00PLN)</li><li>Mo¿esz wpisaæ zakres cen, dla których bêdzie obbowi±zywa³a obni¿ka. (np. produkty o cenie miêdzy 50.00PLN a 150.00PLN)</li><li>Musisz wybraæ odpowiedni± warto¶æ dla pola "Je¶li produkt jest w promocji":<br /><ul><li><strong>Ignoruj cenê promocyjn± - Do³±cz do ceny produktu i usuñ cenê promocyjn±</strong><br />Warto¶æ obni¿ki zostanie do³±czona do ceny produktu, a nie do ceny w promocji. (np. cena regularna 10.00PLN, cena promocyjna 9.50PLN, obni¿ka wynosi 10%. Cena koñcowa produktu bêdzie wynosi³a 9.00PLN. Cena promocyjna zosta³a zignorowana.)</li><li><strong>Ignoruj warunki obni¿ek - Obni¿ka nie zostanie uwzglêdniona, je¶li istnieje promocja</strong><br />Obni¿ka nie zostanie uwzglêdniona dla produktów w promocji. Cena promocyjna zostanie taka, jakby obni¿ka nie by³a zdefiniowana. (np. cena regularna 10.00PLN, cena promocyjna 9.50PLN, obni¿ka wynosi 10%. Cena koñcowa produktu bêdzie wynosi³a 9.50PLN. Obni¿ka zosta³a zignorowana.)</li><li><strong>Do³±cz obni¿kê do ceny promocyjnej - lub do³±cz do ceny w przeciwnym przypadku</strong><br />Obni¿ka bêdzie dodana do ceny promocyjnej, je¶li taka istnieje (np. cena regularna 10.00PLN, cena promocyjna 9.50PLN, obni¿ka wynosi 10%. Cena koñcowa produktu bêdzie wynosi³a $8.55. Czyli uwzglêdniono obni¿kê 10% liczonej dla ceny promocyjnej.)</li></ul></li><li>Pozostaw pole "Pocz±tek" puste, aby obni¿ka zaczê³a obowi±zywaæ od razu.</li><li>Pozostaw pole "Koniec" puste, aby obni¿ka obowi±zywa³a ca³y czas.</li><li>Zaznacz kategorie, jesli chcesz automatycznie wybraæ wszystkie podkategorie.</li></ul>' );
define( 'TEXT_CLOSE_WINDOW', '[ zamknij ]' );

?>