<?php
namespace newfac\devtools;
/*
 * #src\dev-tools\addfacture.php
 * This file is part of the newfac package.
 *
 * (c) Fabrice Thiebaut <kazuyevon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
require_once __dir__.'/../../vendor/autoload.php';

include 'view/viewHeader.php';
// use newfac\inc\misc;
// ne fonctionne pas avec define() pour utiliser ma méthode dbConnect() de DbClass, utilise include à la place
// Warning: Use of undefined constant DSN - assumed 'DSN' (this will throw an Error in a future version of PHP) 
// in D:\webdev\newfac\web\src\classes\DbClass.php on line 21
include '../inc/misc.php';

use newfac\managers\ClientsManager;
use newfac\managers\FacturesManager;
use newfac\classes\Client;
use newfac\classes\Facture;

if (isset($_POST['nombre'])){
	
	
	$nombre = $_POST['nombre'];
	$somme;
	$date;
	
	function generateRandomSomme() {
	$symbol = '.';
    $randomString = '';
    $randomString .= mt_rand(0, 99);
	$randomString .= $symbol;
    $randomString .= mt_rand(0, 99);

    return $randomString;
	}
	
	function generateRandomDate() {
	$symbol = '-';
    $randomString = '';
    $randomString .= mt_rand(1980, 2018);
  
	$randomString .= $symbol;
	$rand = mt_rand(1, 12);
	if (strlen($rand) == 1){$rand = '0'.$rand;}
    $randomString .= $rand;
	
	$randomString .= $symbol;
	$rand = mt_rand(1, 30);
	if (strlen($rand) == 1){$rand = '0'.$rand;}
    $randomString .= $rand;
    
    return $randomString;
	}
	
	$managerClients = new ClientsManager();
	$nbClients = (int)$managerClients->count();
	
	$managerFactures = new FacturesManager();
	
	
	for ($i=0; $i<$nombre; $i++){
		
		$id_client = (int)mt_rand(1, $nbClients);
		$somme = generateRandomSomme();
		$date = generateRandomDate();
		$facture = new Facture([	
			'idclient' => $id_client,
			'somme' => $somme,
			'date' => $date
		]);
		if(!$managerFactures->exists($id_client, $somme, $date) && $date != "0000-00-00"){
				$managerFactures->add($facture);
		}
		else 
		{
			echo "entré existantes";
		}
		
	}
?>
			<!--right-->
			<div class="col-md-9">
			<div class="alert alert-success" role="alert">Factures ajoutées</div>
<?php
	}
?>
				<div class="col-md-8">
					<label for="basic-addon1">Générateur de facture</label>
					<form action="addfacture.php" method="post">
						<div class="input-group">
							<input type="number" name="nombre" class="form-control" placeholder="Nombre de facture à générer" aria-describedby="basic-addon1">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit" value"submit">Go!</button>
							</span>
						</div>
					</form>
				</div>
				<div class="col-md-4">
				</div>
<?php	
	include 'view/viewFooter.php';