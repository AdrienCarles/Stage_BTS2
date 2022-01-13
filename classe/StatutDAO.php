<?php

class StatutDAO extends DAO {
    
  /**
  * Constructeur
  */
  function __construct() {
      parent::__construct();
  }

  function findAll() {
      $sql = "SELECT * FROM statut";
      try {
        $sth=$this->executer($sql); 
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        die("Erreur lors de la requête SQL : " . $e->getMessage());
      }
      $statuts = array();
      foreach ($rows as $row) {
        $statuts[] = new Statut($row);
      }
      return $statuts;
  } // function findAll() 

  function find($id_statut) {
    $sql = "SELECT * FROM statut WHERE id_statut= :id_statut";
    try {
      $params = array(":id_statut" => $id_statut);
      $sth = $this->executer($sql, $params);
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $statut = null;
    if ($row) {
      $statut = new Statut($row);
    }
    return $statut;
  } // function find
}