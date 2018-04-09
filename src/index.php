<?php
namespace newfac;
/*
 * #src\index.php
 * This file is part of the newfac package.
 *
 * (c) Fabrice Thiebaut <kazuyevon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
require_once __DIR__ . '/../vendor/autoload.php';

// use newfac\view\viewHeader;
include 'view/viewHeader.php';

// use newfac\inc\misc;
// ne fonctionne pas avec define() pour utiliser ma méthode dbConnect() de DbClass, utilise include à la place
// Warning: Use of undefined constant DSN - assumed 'DSN' (this will throw an Error in a future version of PHP) 
// in D:\webdev\newfac\web\src\classes\DbClass.php on line 21
include 'inc/misc.php';
// include 'func/functions.php';

use newfac\managers\ClientsManager;
use newfac\managers\FacturesManager;

$jourCourant = date("d");
$moisCourant = date("m");
$moisCourantFr = func\convertMois($moisCourant);
$semaineCourante = date("W");
$anneeCourante = date("Y");
$dateCourant = $anneeCourante."-".$moisCourant."-".$jourCourant;
$dateCouranteFr = $jourCourant."-".$moisCourant."-".$anneeCourante;

$managerClient = new ClientsManager();
$facturesManager = new FacturesManager();
$nbClients = $managerClient->count();

$nbClientsJour = $facturesManager->nbClientsJour($dateCourant);
$totaFacturesJour = $facturesManager->countJour($dateCourant);
$sommeTotalFacturesJour = round($facturesManager->sommeJour($dateCourant), 2);
$minSommeTotalJour = round($facturesManager->minSommeJour($dateCourant), 2);
$maxSommeTotalJour = round($facturesManager->maxSommeJour($dateCourant), 2);

$totaFacturesSemaine = $facturesManager->count();
$sommeTotalFacturesSemaine = round($facturesManager->somme(), 2);
$minSommeTotalSemaine = round($facturesManager->minSomme(), 2);
$maxSommeTotalSemaine = round($facturesManager->maxSomme(), 2);

$nbClientsMois = $facturesManager->nbClientsMois($anneeCourante, $moisCourant);
$totaFacturesMois = $facturesManager->countMois($anneeCourante, $moisCourant);
$sommeTotalFacturesMois = round($facturesManager->sommeMois($anneeCourante, $moisCourant), 2);
$minSommeTotalMois = round($facturesManager->minSommeMois($anneeCourante, $moisCourant), 2);
$maxSommeTotalMois = round($facturesManager->maxSommeMois($anneeCourante, $moisCourant), 2);

$totaFacturesTrimestre = $facturesManager->count();
$sommeTotalFacturesTrimestre = round($facturesManager->somme(), 2);
$minSommeTotalTrimestre = round($facturesManager->minSomme(), 2);
$maxSommeTotalTrimestre = round($facturesManager->maxSomme(), 2);

$nbClientsAnnee = $facturesManager->nbClientsAnnee($anneeCourante);
$totaFacturesAnnee = $facturesManager->countAnnee($anneeCourante);
$sommeTotalFacturesAnnee = round($facturesManager->sommeAnnee($anneeCourante), 2);
$minSommeTotalAnnee = round($facturesManager->minSommeAnnee($anneeCourante), 2);
$maxSommeTotalAnnee = round($facturesManager->maxSommeAnnee($anneeCourante), 2);


// use newfac\view\viewIndex;
include 'view/viewIndex.php';
// use newfac\view\viewFooter;
include 'view/viewFooter.php';