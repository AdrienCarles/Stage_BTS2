<?php

class CommandeDAO extends DAO {
    
  /**
  * Constructeur
  */
  function __construct() {
      parent::__construct();
  }

  function findAll() {
      $sql = "SELECT * FROM commande";
      try {
        $sth=$this->executer($sql); 
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        die("Erreur lors de la requête SQL : " . $e->getMessage());
      }
      $commandes = array();
      foreach ($rows as $row) {
        $commandes[] = new Commande($row);
      }
      return $commandes;
  } // function findAll() 

  function find($id_commande) {
    $sql = "SELECT * FROM commande WHERE id_commande= :id_commande";
    try {
      $params = array(":id_commande" => $id_commande);
      $sth = $this->executer($sql, $params);
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $commande = null;
    if ($row) {
      $commande = new Commande($row);
    }
    return $commande;
  } // function find
}
