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
}