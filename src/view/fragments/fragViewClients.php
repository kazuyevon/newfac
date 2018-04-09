<?php
namespace newfac\view\fragments;
/*
 * #src\view\fragViewClients.php
 * This file is part of the newfac package.
 *
 * (c) Fabrice Thiebaut <kazuyevon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
		if ($nbFactures != 0 && $derniereFact != date("Y")){
?>
                            <tr class="clickable-row" data-href="factures.php?idclient=<?php echo $id ?>&annee=<?php echo $derniereFact ?>">
<?php
		}elseif($nbFactures != 0) {
?>
                            <tr class="clickable-row" data-href="factures.php?idclient=<?php echo $id ?>&annee=<?php echo date("Y") ?>">
<?php
		}
		
		
		else{
?>
                            <tr>
<?php
		}
?>
								<td><?php echo $nom ?></td>
								<td><?php echo $prenom ?></td>
								<td><?php echo $nbFactures ?></td>
								<td><?php echo $montantFactures ?></td>
								<td><?php echo $derniereFact ?></td>
							</tr>