<?php
namespace newfac\managers;
/*
 * #src\manager\ClientsManager.php
 * This file is part of the newfac package.
 *
 * (c) Fabrice Thiebaut <kazuyevon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use newfac\classes\db;
use newfac\classes\Client;

class ClientsManager
{
	// Instance de PDO
	private $_pdo;
  
  public function __construct()
  { 
	$pdo = new db();
	$this->_pdo = $pdo->dbConnect();
  }
  
  public function add(Client $client)
  {
    $q = $this->_pdo->prepare('INSERT INTO clients(nom, prenom) VALUES(:nom, :prenom)');
    $q->bindValue(':nom', $client->nom());
	$q->bindValue(':prenom', $client->prenom());
    $q->execute();
    
    $client->hydrate([
      'id' => $this->_pdo->lastInsertId(),
	  'nom' => 'LeBonhomme',
	  'prenom' => 'Toto',
    ]);
  }
  
  public function count()
  {
    return $this->_pdo->query('SELECT COUNT(*) FROM clients')->fetchColumn();
  }
  
  public function delete(Client $client)
  {
    $this->_pdo->exec('DELETE FROM clients WHERE id = '.$client->id());
  }
  
  public function exists($info, $info2)
  {
    if (is_int($info) && $info2 == "0") // On veut voir si tel client ayant pour id $info existe.
    {
      return (bool) $this->_pdo->query('SELECT COUNT(*) FROM clients WHERE id = '.$info)->fetchColumn();
    }
    
    // Sinon, c'est qu'on veut vérifier que le nom existe ou pas.
	//ajouter la possibilite de mettre nom et prenom
    
	$q = $this->_pdo->prepare('SELECT COUNT(*) FROM clients WHERE nom = :nom AND prenom = :prenom');
    $q->execute([':nom' => $info, ':prenom' => $info2]);
    
    return (bool) $q->fetchColumn();
  }
  
  public function getclients($info) //par id ou par nom
  {
    if (is_int($info))
    {
      $q = $this->_pdo->query('SELECT id, nom, prenom FROM clients WHERE id = '.$info);
      $donnees = $q->fetch(\PDO::FETCH_ASSOC);
      
      return new Client($donnees);
    }
    else
    {
	  $q = $this->_pdo->prepare('SELECT id, nom, prenom FROM clients WHERE nom = :nom OR prenom = :nom');
      $q->execute([':nom' => $info]);
    
      return new Client($q->fetch(\PDO::FETCH_ASSOC));
    }
  }
  
  public function getList()
  {
    $clients = [];

    $q = $this->_pdo->prepare('SELECT id, nom, prenom FROM clients ORDER BY nom');
    $q->execute();
  
	while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
    {
	    $clients[] = new Client($donnees);
    }
    return $clients;
  }
  
  public function update(Client $client)
  {
    $q = $this->_pdo->prepare('UPDATE clients SET nom = :nom, prenom = :prenom WHERE id = :id');
    
    $q->bindValue(':nom', $client->nom(), \PDO::PARAM_STR);
	$q->bindValue(':prenom', $client->prenom(), \PDO::PARAM_STR);
    $q->bindValue(':id', $client->id(), \PDO::PARAM_INT);
    $q->execute();
  }
  
  // function pour la searchbox
  public function getInconnu($keyword, $category) {
	$clients = [];
	$keyword = "{$keyword}%";
	$q = $this->_pdo->prepare('SELECT * FROM clients WHERE '.$category.' LIKE :keyword');
	$q->bindValue(':keyword', $keyword);
	$q->execute();
	
	while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
    {
	    $clients[] = new Client($donnees);
    }
    return $clients;
  }
}