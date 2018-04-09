<?php
namespace newfac;
/*
 * #src\searchengine.php
 * This file is part of the newfac package.
 *
 * (c) Fabrice Thiebaut <kazuyevon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
/* filtrer les date dans le typeahead, par date entière, année/mois et année simple, transformé la date de fr vers en */
require_once __DIR__ . '/../../vendor/autoload.php';
	
// use newfac\inc\misc;
// ne fonctionne pas avec define() pour utiliser ma méthode dbConnect() de DbClass, utilise include à la place
// Warning: Use of undefined constant DSN - assumed 'DSN' (this will throw an Error in a future version of PHP) 
// in D:\webdev\newfac\web\src\classes\DbClass.php on line 21
include '../inc/misc.php';

use newfac\managers\ClientsManager;
use newfac\managers\FacturesManager;
use newfac\classes\Client;
use newfac\classes\Facture;

if(isset($_POST['query']) && isset($_POST['category'])){

	$keyword = strval($_POST['query']);
	$objectsResult = array();
	$category = strval($_POST['category']);
	
	if ($category == "nom" ||$category == "prenom") {
		$managerClients = new ClientsManager();
		$listeClients = $managerClients->getInconnu($keyword, $category);
		foreach ($listeClients as $unClient){
			$objectsResult[] = array('id' => $unClient->id(),
									'nom' => $unClient->nom(),
									'prenom' => $unClient->prenom());
		}
		echo json_encode($objectsResult);
	}
	elseif ($category == "num" || $category == "somme" || $category == "date") {
		$managerFactures = new FacturesManager();
		$listeFactures = $managerFactures->getInconnu($keyword, $category);
		foreach ($listeFactures as $uneFacture){
			$objectsResult[] = array('num' => $uneFacture->num(),
									'idclient' => $uneFacture->id_client(),
									'somme' => $uneFacture->somme(),
									'date' => $uneFacture->date());
		}
		echo json_encode($objectsResult);
	}
}
else{
	die();
}