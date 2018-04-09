<?php
namespace newfac\classes;
/*
 * #src\classes\DbClass.php
 * This file is part of the newfac package.
 *
 * (c) Fabrice Thiebaut <kazuyevon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class db
{	
	public function __construct(){
	}
	
	public function dbConnect(){
		/*unserialize() pour recupérer pour être compatible avec php 5.4.31, sinon avec php 7.2.4, il n'est pas utile.*/
		$options = unserialize(OPTIONS);
		try {
			$pdo = new \PDO(DSN, USERNAME, PASSWORD, $options);
			return $pdo;
		}
		catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
		}
	}
}