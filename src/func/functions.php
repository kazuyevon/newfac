<?php
namespace newfac\func;
/*
 * #src\func\functions.php
 * This file is part of the newfac package.
 *
 * (c) Fabrice Thiebaut <kazuyevon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

function convertMois($mois){
	$moisCourantFr = "";
	switch($mois){
	case 1:
		$moisCourantFr = "Janvier";
		break;
	case 2:
		$moisCourantFr = "Février";
		break;
	case 3:
		$moisCourantFr = "Mars";
		break;
	case 4:
		$moisCourantFr = "Avril";
		break;
	case 5:
		$moisCourantFr = "Mai";
		break;
	case 6:
		$moisCourantFr = "Juin";
		break;
	case 7:
		$moisCourantFr = "Juillet";
		break;
	case 8:
		$moisCourantFr = "Août";
		break;
	case 9:
		$moisCourantFr = "Septembre";
		break;
	case 10:
		$moisCourantFr = "Ocobre";
		break;
	case 11:
		$moisCourantFr = "Novemebre";
		break;
	case 12:
		$moisCourantFr = "Décembre";
		break;

	}
	return $moisCourantFr;
}