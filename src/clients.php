<?php
namespace newfac;
/*
 * #src\clients.php
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
include './inc/misc.php';


use newfac\managers\ClientsManager;
use newfac\managers\FacturesManager;
use newfac\classes\Client;
use newfac\classes\Facture;

	$id;
	$nom;
	$prenom;
	$managerClient = new ClientsManager();
	$facturesManager = new FacturesManager();
	$clients = $managerClient->getList();
	include 'view/viewClientsHeader.php';
	foreach ($clients as $unClient)
	{
		$id = $unClient->id();
		$nom = $unClient->nom();
		$prenom = $unClient->prenom();
		//On récupère le nb total de factures par client, si 0, on désactive le lien
		$nbFactures = $facturesManager->nbFact($id);
		$montantFactures = $facturesManager->montantFact($id);
		$derniereFact = $facturesManager->lastExistsAnnee($id);
		include 'view/fragments/fragViewClients.php';
	}
	include 'view/viewClientsFooter.php';
	include 'view/viewFooter.php';