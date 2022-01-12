<?php

class ProduitDAO extends DAO {
    
  /**
  * Constructeur
  */
  function __construct() {
      parent::__construct();
  }

  function findAll() {
    $sql = "SELECT * FROM produit";
    try {
      $sth=$this->executer($sql); 
      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $produits = array();
    foreach ($rows as $row) {
      $produits[] = new Produit($row);
    }
    return $produits;
  } // function findAll() 

  function find($id_produit) {
    $sql = "SELECT * FROM produit WHERE id_produit= :id_produit";
    try {
      $params = array(":id_produit" => $id_produit);
      $sth = $this->executer($sql, $params);
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $produit = null;
    if ($row) {
      $produit = new Produit($row);
    }
    return $produit;
  } // function find
}