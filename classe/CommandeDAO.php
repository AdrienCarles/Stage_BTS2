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
    $sql = "INSERT INTO `commande`(`num_commande`, `date_commande`, `total_comande`, `mode_paiement`, `nom_commande`, `prenom_commande`, `classe_commande`, `tel_commande`, `mail_commande`, `id_user`, `id_statut`)
            VALUES 
            (:num_commande, :date_commande, :total_comande, :mode_paiement, :nom_commande, :prenom_commande, :classe_commande, :tel_commande, :mail_commande, :id_user, :id_statut)";
    try{
      $params = array(
        ':num_commande'=>$commande->get_num_commande(),
        ':date_commande'=>$commande->get_date_commande(),
        ':total_comande'=>$commande->get_total_comande(),
        ':mode_paiement'=>$commande->get_mode_paiement(),
        ':nom_commande'=>$commande->get_nom_commande(),
        ':prenom_commande'=>$commande->get_prenom_commande(),
        ':classe_commande'=>$commande->get_classe_commande(),
        ':tel_commande'=>$commande->get_tel_commande(),
        ':mail_commande'=>$commande->get_mail_commande(),
        ':id_user'=>$commande->get_id_user(),
        ':id_statut'=>$commande->get_id_statut(),
      );
      $sth = $this->executer($sql, $params);
    }catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  }
}
