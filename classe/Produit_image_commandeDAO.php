<?php

class Produit_image_commandeDAO extends DAO {
    
  /**
  * Constructeur
  */
  function __construct() {
      parent::__construct();
  }

  function findAll() {
      $sql = "SELECT * FROM produit_image_commande";
      try {
        $sth=$this->executer($sql); 
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        die("Erreur lors de la requête SQL : " . $e->getMessage());
      }
      $produit_image_commandes = array();
      foreach ($rows as $row) {
        $produit_image_commandes[] = new Produit_image_commande($row);
      }
      return $produit_image_commandes;
  } // function findAll() 

}