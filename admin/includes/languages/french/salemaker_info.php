<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: salemaker_info.php 1105 2005-04-04 22:05:35Z birdbrain $
//

  define('HEADING_TITLE', 'Salemaker');
  define('SUBHEADING_TITLE', 'Salemaker: Trucs et Astuces');
  define('INFO_TEXT', '<ul>
                      <li>
                        Utilisez toujours un \'.\' point d&eacute;cimal pour la d&eacute;duction et la Gamme de Prix.
                      </li>
                      <li>
                        Entrez des montants dans la devise utilis&eacute;e pour cr&eacute;er ou &eacute;diter un Produit.
                      </li>
                      <li>
                        Dans les champs de d&eacute;duction, indiquez un Montant ou un Pourcentage &agrave; d&eacute;duire,
                        ou un prix de remplacement. (ex: d&eacute;duire 5.00 EUR de tous les prix, d&eacute;duire 10% de
                        tous les prix, ou changer tous les prix &agrave; 25.00 EUR)
                      </li>
                      <li>
                        Entrer une Gamme de Prix affectera la gamme des prix concern&eacute;s. (ex:
                        les produits de 50.00 EUR &agrave; 150.00 EUR)
                      </li>
                      <li>
                        Vous devez indiquez l\'action &agrave; accomplir si un Produit est en Promotion <i>et</i> et assujetti &agrave; Cette Vente:
						<ul>
                          <li>
                            <strong>Ignorer la Promotion - Appliquer au prix de vente du Produit et remplacer la Promotion</strong><br>
							Le nouveau prix sera appliqu&eacute; au prix original du Produit.
                            (ex: prix original = 10.00 EUR, prix promotionnel = 9.50 EUR. et SaleCondition est une remise de 10%.
							Le prix Final Affich&eacute; du produit sera de 9.00 EUR. Le Prix Promotionnel est ignor&eacute;.)
                          </li>
                          <li>
                            <strong>Ignorer SaleCondition - Pas de Salemaker lorsque le Produit est en Promotion</strong><br>
                            Les Produits en Promotion ne sont pas concern&eacute;s. Le Prix des Promotions sera affich&eacute; comme
                            si aucune condition sp&eacute;cifique n\'&eacute;tait retenue. (ex: Prix Boutique = 10.00 EUR, Prix Promotionnel = 9.50 EUR,
                            et SaleCondition est une remise de 10%. Le prix Final Affich&eacute; du produit sera de 9.50 EUR.
                            La SalesCondition est ignor&eacute;e.)
                          </li>
                          <li>
                            <strong>Appliquer SaleDeduction aux Promotions - ou Appliquer aux Prix de la Boutique</strong><br>
                            La salededuction sera appliqu&eacute; aux Prix Promotionnels. Un Prix Compil&eacute; sera affich&eacute;.
                            (ex: Prix Boutique = 10.00 EUR, Prix Promotionnel = 9.50 EUR, et SaleCondition est une remise de 10%.
                            Le prix Final Affich&eacute; final sera de 8.55 EUR. Il s\'agit d\'une remise de 10% sur le prix promotionnel.)
                          </li>
                        </ul>
                      </li>
                      <li>
                        Laisser le champ vide pour la Date de D&eacute;but lancera la SaleMaker d&egrave;s Validation.
                      </li>
                      <li>
                        Laissez le champ vide pour la Date de Fin si cette SaleMaker ne poss&egrave;de pas de limite de temps.</li>
                      <li>
                        Cocher une Cat&eacute;gorie incluera automatiquement les Sous-Cat&eacute;gories.
                      </li>
                    </ul>');
  define('TEXT_CLOSE_WINDOW', '[ Fermer [x] ]');
?>