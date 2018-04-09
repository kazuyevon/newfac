<?php
namespace newfac\devtools;
/*
 * #src\dev-tools\addclient.php
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
include __dir__.'/../inc/misc.php';

use newfac\managers\ClientsManager;
use newfac\classes\Client;

if (isset($_POST['nombre'])){
	
	
	$nombre = $_POST['nombre'];
	$noms;
	$prenom;
	
	function generateRandomNom($length) {
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}
	function generateRandomPrenom($length) {
		$characters = 'abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}
	
	$managerClients = new ClientsManager();
	
	for ($i=0; $i<$nombre; $i++){
		
		$nom = generateRandomNom(10);
		$prenom = generateRandomPrenom(5);
		$client = new Client([
			'nom' => $nom,
			'prenom' => $prenom
		]);
		if (!$managerClients->exists($nom, $prenom))
		{
			$managerClients->add($client);
		}
		else 
		{
			echo "entré existantes";
		}
	}
?>
			<!--right-->
			<div class="col-md-9">
			<div class="alert alert-success" role="alert">Clients ajoutés</div>
<?php
}
?>
				<div class="col-md-8">
				<label for="basic-addon1">Générateur de client</label>
					<form action="addclient.php" method="post">
						<div class="input-group">
							<input type="number" name="nombre" class="form-control" placeholder="Nombre de client à générer" aria-describedby="basic-addon1">
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