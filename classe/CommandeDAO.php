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

  function insert_commande(Commande $commande){
    $sql = "INSERT INTO `commande`(`id_commande`, `num_commande`, `date_commande`, `total_comande`, `mode_paiement`, `nom_commande`, `prenom_commande`, `classe_commande`, `tel_commande`, `mail_commande`, `id_user`, `id_statut`
            VALUES 
            (:title, :phase, :us_release_date, :directors, :screenwriters, :producers, :status)";

  }
}
