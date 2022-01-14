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

  function find_by_id_commande($id_commande) {
    $sql = "SELECT * FROM produit_image_commande WHERE id_commande= :id_commande";
    try {
      $params = array(":id_commande" => $id_commande);
      $sth = $this->executer($sql, $params);
      $row = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $produit_image_commande = null;
    if($row) {
      $produit_image_commande = new Produit_image_commande($row);
    }
    return $produit_image_commande;
  } // function find


  function insert_produit_image_commande(Produit_image_commande $produit_image_commande) {
    $sql = "INSERT INTO `produit_image_commande`(`id_produit`, `id_famille`, `id_image`, `id_commande`, `quantite`, `message`) 
            VALUES 
            (:id_produit,:id_famille,:id_image,:id_commande,:quantite,:message)";
    try{
      $params = array(
        ':id_produit'=>$produit_image_commande->get_id_produit(),
        ':id_famille'=>$produit_image_commande->get_id_famille(),
        ':id_image'=>$produit_image_commande->get_id_image(),
        ':id_commande'=>$produit_image_commande->get_id_commande(),
        ':quantite'=>$produit_image_commande->get_quantite(),
        ':message'=>$produit_image_commande->get_message(),
      );
      $sth = $this->executer($sql, $params);
    }catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  } // function insert_produit_image_commande() 
}