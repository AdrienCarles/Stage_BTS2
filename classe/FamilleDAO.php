<?php

class FamilleDAO extends DAO {
    
  /**
  * Constructeur
  */
  function __construct() {
      parent::__construct();
  }

  function findAll() {
      $sql = "SELECT * FROM famille";
      try {
        $sth=$this->executer($sql); 
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        die("Erreur lors de la requête SQL : " . $e->getMessage());
      }
      $familles = array();
      foreach ($rows as $row) {
        $familles[] = new Famille($row);
      }
      return $familles;
  } // function findAll() 

  function find($id_famille) {
    $sql = "SELECT * FROM famille WHERE id_famille= :id_famille";
    try {
      $params = array(":id_famille" => $id_famille);
      $sth = $this->executer($sql, $params);
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $famille = null;
    if ($row) {
      $famille = new Famille($row);
    }
    return $famille;
  } // function find
}
