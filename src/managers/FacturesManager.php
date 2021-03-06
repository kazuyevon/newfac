<?php
namespace newfac\managers;
/*
 * #src\manager\FacturesManager.php
 * This file is part of the newfac package.
 *
 * (c) Fabrice Thiebaut <kazuyevon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use newfac\classes\db;
use newfac\classes\Facture;

class FacturesManager
{
  // Instance de PDO
  private $_pdo;
  
  public function __construct()
  {
    $this->setDb();
  }
  
  public function setDb()
  {
	$pdo = new db();
	$this->_pdo = $pdo->dbConnect();
  }
  
  public function add(Facture $facture)
  {
    $q = $this->_pdo->prepare('INSERT INTO factures(idclient, date, somme) VALUES(:id_client, :date, :somme)');
    $q->bindValue(':id_client', $facture->id_client());
	$q->bindValue(':date', $facture->date());
	$q->bindValue(':somme', $facture->somme());
    $q->execute();
    
    $facture->hydrate([
      'num' => $this->_pdo->lastInsertId(),
      'idclient' => 100,
	  'somme' => 0,
	  'date' => date("Y-m-d"),
    ]);
  }
  
  public function nbClientsJour($date)
  {
	  return $this->_pdo->query('SELECT COUNT(DISTINCT idclient) FROM factures WHERE date = '.$date)->fetchColumn();
  }
  
  public function nbClientsMois($annee, $mois)
  {
	  return $this->_pdo->query('SELECT COUNT(DISTINCT idclient) FROM factures WHERE YEAR(date) = '.$annee.' AND MONTH(date) = '.$mois)->fetchColumn();
  }
  
  public function nbClientsAnnee($annee)
  {
	  return $this->_pdo->query('SELECT COUNT(DISTINCT idclient) FROM factures WHERE YEAR(date) = '.$annee)->fetchColumn();
  }
  
  public function count()
  {
    return $this->_pdo->query('SELECT COUNT(*) FROM factures')->fetchColumn();
  }
  
  public function countJour($date)
  {
    return $this->_pdo->query('SELECT COUNT(*) FROM factures WHERE date = '.$date)->fetchColumn();
  }
  
  public function countMois($annee, $mois)
  {
    return $this->_pdo->query('SELECT COUNT(*) FROM factures WHERE YEAR(date) = '.$annee.' AND MONTH(date) = '.$mois)->fetchColumn();
  }
  
  public function countAnnee($annee)
  {
    return $this->_pdo->query('SELECT COUNT(*) FROM factures WHERE YEAR(date) = '.$annee)->fetchColumn();
  }
  
  public function somme()
  {
	return $this->_pdo->query('SELECT SUM(somme) FROM factures')->fetchColumn();  
  }
  
  public function sommeJour($date)
  {
	return $this->_pdo->query('SELECT SUM(somme) FROM factures WHERE date = '.$date)->fetchColumn();  
  }
  
  public function sommeMois($annee, $mois)
  {
	return $this->_pdo->query('SELECT SUM(somme) FROM factures WHERE YEAR(date) = '.$annee.' AND MONTH(date) = '.$mois)->fetchColumn();  
  }
  
  public function sommeAnnee($annee)
  {
	return $this->_pdo->query('SELECT SUM(somme) FROM factures WHERE YEAR(date) = '.$annee)->fetchColumn();
  }
  
  public function minSomme()
  {
	  return $this->_pdo->query('SELECT MIN(somme) FROM factures')->fetchColumn();
  }
  
  public function minSommeJour($date)
  {
	  return $this->_pdo->query('SELECT MIN(somme) FROM factures WHERE date = '.$date)->fetchColumn();
  }
  
  public function minSommeMois($annee, $mois)
  {
	  return $this->_pdo->query('SELECT MIN(somme) FROM factures WHERE YEAR(date) = '.$annee.' AND MONTH(date) = '.$mois)->fetchColumn();
  }
  
  public function minSommeAnnee($annee)
  {
	  return $this->_pdo->query('SELECT MIN(somme) FROM factures WHERE YEAR(date) = '.$annee)->fetchColumn();
  }
  
  public function maxSomme()
  {
	  return $this->_pdo->query('SELECT Max(somme) FROM factures')->fetchColumn();
  }
  
  public function maxSommeJour($date)
  {
	  return $this->_pdo->query('SELECT Max(somme) FROM factures WHERE date = '.$date)->fetchColumn();
  }
  
  public function maxSommeMois($annee, $mois)
  {
	  return $this->_pdo->query('SELECT Max(somme) FROM factures WHERE YEAR(date) = '.$annee.' AND MONTH(date) = '.$mois)->fetchColumn();
  }
  
  public function maxSommeAnnee($annee)
  {
	  return $this->_pdo->query('SELECT Max(somme) FROM factures WHERE YEAR(date) = '.$annee)->fetchColumn();
  }
  
  public function nbFact($id_client)
  {
	$nombre = $this->_pdo->query('SELECT COUNT(*) FROM factures WHERE idclient = '.$id_client)->fetchColumn();
	return $nombre;
  }
  
  public function nbFactAnnee($id_client, $annee)
  {
	$nombre = $this->_pdo->query('SELECT COUNT(*) FROM factures WHERE idclient = '.$id_client.' AND YEAR(date) = '.$annee)->fetchColumn();
	return $nombre;
  }
  
  public function montantFact($id_client)
  {
	$montant = $this->_pdo->query('SELECT SUM(somme) FROM factures WHERE idclient = '.$id_client)->fetchColumn();
	return round($montant, 2);
  }
  
  public function montantFactAnnee($id_client, $annee)
  {
	$montant = $this->_pdo->query('SELECT SUM(somme) FROM factures WHERE idclient = '.$id_client.' AND YEAR(date) = '.$annee)->fetchColumn();
	return round($montant, 2);
  }
  
  public function delete(Facture $facture)
  {
    $this->_pdo->exec('DELETE FROM factures WHERE num = '.$facture->num());
  }
  
  public function exists($info, $info2, $info3)
  {
    if (is_int($info) && $info2 == "0" && $info3 == "0") // On veut voir si tel facture ayant pour num $info existe.
    {
      return (bool) $this->_pdo->query('SELECT COUNT(*) FROM factures WHERE num = '.$info)->fetchColumn();
    }
	elseif ($info != null && $info2 != null && $info3 != null)
	{
			
		// Sinon, c'est qu'on veut vérifier que le date existe ou pas.
    
		$q = $this->_pdo->prepare('SELECT COUNT(*) FROM factures WHERE idclient = :idclient AND somme = :somme AND date = :date');
		$q->execute([':idclient' => $info, ':somme' => $info2, ':date' => $info3]);
    
    return (bool) $q->fetchColumn();
	}
  }
  
  public function existsAnnee($id_client, $annee)
  {
    // on veut vérifier qu'il existe des factures pour l'année donnée.
    
    $q = $this->_pdo->prepare('SELECT COUNT(*) FROM factures WHERE idclient = :id_client AND YEAR(date) = :annee');
    $q->execute([':id_client' => $id_client, ':annee' => $annee]);
    
    return (bool) $q->fetchColumn();
  }
  
  public function arrayExistsAnnee($id_client)
  {
    // on veut recupérer les années existantes.
    $annees = array();
    $q = $this->_pdo->prepare('SELECT DISTINCT YEAR(date) AS an FROM factures WHERE idclient = :id_client ORDER BY date');
	$q->execute([':id_client' => $id_client]);
	
	while ($an = $q->fetch(\PDO::FETCH_ASSOC))
    {
      $annees[] = $an['an'];
    }
    
    return $annees;
  }
  
   public function lastExistsAnnee($id_client)
  {
    // on veut recupérer la derniere année existante.
    $annee;
    $q = $this->_pdo->prepare('SELECT MAX(YEAR(date)) AS an FROM factures WHERE idclient = :id_client');
	$q->execute([':id_client' => $id_client]);
	
	while ($an = $q->fetch(\PDO::FETCH_ASSOC))
    {
      $annee = $an['an'];
    }
    
    return $annee;
  }
  
  public function getFacture($num)
  {
	// si $num est un int, on admet alors rechercher la facture de num $infos
	if (is_int($num))
    {
      $q = $this->_pdo->query('SELECT num, idclient, date, somme FROM factures WHERE num = '.$num);
      $donnees = $q->fetch(\PDO::FETCH_ASSOC);
      
      return new Facture($donnees);
    }
  }
  
   public function getListClientAnnee($id_client, $annee)
  {
	// Si client est 0 et annee est défini en date, on verifie que c'est une date au format 0000-00-00 uniquement et on liste toutes les factures de la date donnée
	if ($id_client == 0 && preg_match("/^[0-9]{4}(-)(0[1-9]|1[0-2])(-)(0[1-9]|[1-2][0-9]|3[0-1])$/", $annee)) {
		$factures = [];
    
		$q = $this->_pdo->prepare("SELECT num, idclient, date, somme FROM factures WHERE date = :date ORDER BY date ASC");
		$q->execute([':date' => $annee]);
    
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
		{
			$factures[] = new Facture($donnees);
		}
    
		return $factures;
	}
	// Si client est 0 et annee est défini en annee, on verifie que c'est une annee et on liste toutes les factures de la date donnée
	elseif ($id_client == 0 && (strlen($annee) == 4)) {
		$factures = [];
    
		$q = $this->_pdo->prepare("SELECT num, idclient, date, somme FROM factures WHERE YEAR(date) = :annee ORDER BY date ASC");
		$q->execute([':annee' => $annee]);
    
		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$factures[] = new Facture($donnees);
		}
    
		return $factures;
	}
	// Si client est 0 et annee est 0
	elseif ($id_client == 0 && $annee == 0) {
		$factures = [];
    
		$q = $this->_pdo->prepare("SELECT num, idclient, date, somme FROM factures ORDER BY date ASC");
		$q->execute();
    
		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$factures[] = new Facture($donnees);
		}
    
		return $factures;
	}
	// Si client est défini et annee est 0, si $id_client est un int
	elseif ($id_client != 0 && $annee == 0 && is_int($id_client)) {
		$factures = [];
    
		$q = $this->_pdo->prepare("SELECT num, idclient, date, somme FROM factures WHERE idclient = :id_client ORDER BY date ASC");
		$q->execute([':id_client' => $id_client]);
    
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
		{
			$factures[] = new Facture($donnees);
		}
    
		return $factures;
	}
	// Si client est défini et annee est défini sur annee
	else if ($id_client != 0 && is_int($id_client) && (strlen($annee) == 4)) {
		$factures = [];
    
		$q = $this->_pdo->prepare("SELECT num, idclient, date, somme FROM factures WHERE idclient = :id_client AND YEAR(date) = :annee ORDER BY date ASC");
		$q->execute([':id_client' => $id_client, ':annee' => $annee]);
    
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
		{
			$factures[] = new Facture($donnees);
		}
    
		return $factures;
	}
	// Si client est défini et annee est défini sur date, on verifie que c'est une date au format 0000-00-00 uniquement et on liste toutes les factures de la date donnée pour id_client
	else if ($id_client != 0 && is_int($id_client) && preg_match("/^[0-9]{4}(-)(0[1-9]|1[0-2])(-)(0[1-9]|[1-2][0-9]|3[0-1])$/", $annee)) {
		$factures = [];
		$this->_annee = (string)$annee;
    
		$q = $this->_pdo->prepare("SELECT num, idclient, date, somme FROM factures WHERE idclient = :id_client AND date = :date ORDER BY date ASC");
		$q->execute([':id_client' => $id_client, ':date' => $annee]);
    
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
		{
			$factures[] = new Facture($donnees);
		}
    
		return $factures;
	}
  }
  
  public function update(Facture $facture)
  {
    $q = $this->_pdo->prepare('UPDATE factures SET somme = :somme, date = :date WHERE num = :num');
    
    $q->bindValue(':somme', $facture->somme(), \PDO::PARAM_STR);
    $q->bindValue(':date', $facture->date(), \PDO::PARAM_STR);
    $q->bindValue(':num', $facture->num(), \PDO::PARAM_INT);
    $q->execute();
  }
  
  // function pour la searchbox
  public function getInconnu($keyword, $category) {
	$factures = [];
	$keyword = "{$keyword}%";
	$q = $this->_pdo->prepare('SELECT * FROM factures WHERE '.$category.' LIKE :keyword');
	$q->bindValue(':keyword', $keyword);
	$q->execute();
	
	while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
    {
	    $factures[] = new Facture($donnees);
    }
    return $factures;
  }
}