<?php
namespace newfac;
/*
 * #src\factures.php
 * This file is part of the newfac package.
 *
 * (c) Fabrice Thiebaut <kazuyevon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__ . '/../vendor/autoload.php';
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

if (isset($_GET['idclient'])) {
    $id_client = (int)$_GET['idclient'];
	
	$date;
	$somme;
	$nbAchats;
	$dates;
	$sommes;
	$recupmois;
	$arraymontant;
	$arraycumul;
	$arraymoyen;
	
	$managerFactures = new FacturesManager();
	
	//on s'assure que $annee contienne une année et que l'année donnée soit listée pour le client
	if (($_GET['annee'] != '0') 
			&& (!$managerFactures->existsAnnee($id_client, $_GET['annee']))){
		//sinon on recupère l'annee d'aujoud'hui;
		//doit recuperer la derniere annee de la db
		$annee = $managerFactures->lastExistsAnnee($id_client);
		if (!isset($annee)) {
			include 'view/viewErreurFactures.php';
			include 'view/viewFooter.php';
			die();
		}
	}else
	{
		$annee = $_GET['annee'];
	}
	
	//utilise manager de client
	$managerClients = new ClientsManager();
	$client = $managerClients->getclients((int)$id_client);
	// $id = $client->id();
	$nom = $client->nom();
	$prenom = $client->prenom();
	
	//recupère liste années existantes
	$annees = array();
	$annees = $managerFactures->arrayExistsAnnee($id_client);
				
	// recupère les factures du client id_client de l'année demandé
	$factures = $managerFactures->getListClientAnnee($id_client, $annee);
	foreach ($factures as $uneFacture)
	{
		$date = $uneFacture->date();
		$somme = $uneFacture->somme();
		$dates[] = $date;
		$sommes[] = $somme;
		// enlève l'année des dates de factures du client
		$mois = substr($date,5);
		// enlève le jour des dates de factures du client
		$mois = substr($mois,0,2);
		$recupmois[] = $mois;
	}
	// crée un array de 12 mois de montant vide pour le graph
	for($i=0; $i<12; $i++){
		$arraymontant[] = 0;
	}
	
	//remplit l'annee
	$m=0;
	foreach($recupmois as $unMois){
		
		//on tente de remplir le calendrier de 12 mois avec les valeurs $sommes à leur bonne position $unMois
		//le probleme c'est que le calendrier commence à (1) alors qu'un array commence à (0).
		//-1 car decalage avec l'array qui commence à 0.
		//si la valeur n'est pas de 0, on admet qu'il y a deja une valeur, alors on les additionne
		if ($arraymontant[$unMois-1] != 0){ //$arraymontant[mois 3]
			$arraymontant[$unMois-1] = (double)round(($arraymontant[$unMois-1] + $sommes[$m]), 2);
		}else{
			$arraymontant[$unMois-1] = (double)round($sommes[$m], 2);
		}
		$m++;
	}
	/* calcule le cumul */
	$m=0;
	foreach($arraymontant as $unMontant){
		
		if ($m == 0 ){
			$arraycumul[] = $unMontant;
		}else {
			$arraycumul[] = $unMontant + $arraycumul[$m-1];
		}
		$m++;
	}
	// calcul la somme de l'annee du client
	// déjà calculé array_sum($arraymontant));
	/* $sommeTotal = $managerFactures->montantFact($id_client);*/
	
	//calcule le nb d'achat de l'année du client
	$nbAchats = $managerFactures->nbFactAnnee($id_client, $annee);
	
	//calcule le panier moyen arrondi au centime des achats pour l'afficher sur 12 mois
	for($j=0; $j<12; $j++){
		$arraymoyen[] = (float)round((array_sum($arraymontant)/$nbAchats),2);
	}
include 'view/viewFactures.php';
include 'view/viewFooter.php';
}