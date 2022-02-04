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

  function find_num_commande($num_commande) {
    $sql = "SELECT * FROM commande WHERE num_commande= :num_commande";
    try {
      $params = array(":num_commande" => $num_commande);
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
  function find_by_nom_prenom_date_commande($nom_commande, $prenom_commande, $date_commande){
    $sql = "SELECT * FROM commande WHERE nom_commande= :nom_commande AND prenom_commande = :prenom_commande AND date_commande = :date_commande";
    try {
      $params = array(
        ":nom_commande" => $nom_commande,
        ":prenom_commande" => $prenom_commande,
        ":date_commande" => $date_commande,
      );
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
  } //function find_by_nom_prenom_commande

  function find_by_date_commande($date_commande){
    $sql = "SELECT * FROM commande WHERE date_commande = :date_commande";
    try {
      $params = array(
        ":date_commande" => $date_commande,
      );
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
  } //function find_by_date_commande

  function find_max_id() {
    $sql = "SELECT * FROM commande WHERE id_commande = (SELECT MAX(id_commande) FROM commande)";
    try {
      $sth=$this->executer($sql); 
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $commande = null;
    if ($row) {
      $commande = new Commande($row);
    }
    return $commande;
} // function find_max_id() 

  function insert_commande(Commande $commande){
    $sql = "INSERT INTO `commande`(`num_commande`, `date_commande`, `total_commande`, `mode_paiement`, `nom_commande`, `prenom_commande`, `classe_commande`, `tel_commande`, `mail_commande`, `id_user`, `id_statut`)
            VALUES 
            (:num_commande, :date_commande, :total_commande, :mode_paiement, :nom_commande, :prenom_commande, :classe_commande, :tel_commande, :mail_commande, :id_user, :id_statut)";
    try{
      $params = array(
        ':num_commande'=>$commande->get_num_commande(),
        ':date_commande'=>$commande->get_date_commande(),
        ':total_commande'=>$commande->get_total_commande(),
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
  function update(Commande $commande) {
    $sql = "UPDATE commande set num_commande=:num_commande, total_commande=:total_commande, mode_paiement=:mode_paiement, nom_commande = :nom_commande, prenom_commande = :prenom_commande, classe_commande = :classe_commande, tel_commande = :tel_commande, mail_commande = :mail_commande, id_statut=:id_statut where id_commande= :id_commande";
    $params = array(
      ":id_commande" => $commande->get_id_commande(),
      ":num_commande" => $commande->get_num_commande(),
      ':total_commande' => $commande->get_total_commande(),
      ':mode_paiement' => $commande->get_mode_paiement(),
      ":nom_commande" => $commande->get_nom_commande(),
      ":prenom_commande" => $commande->get_prenom_commande(),
      ":classe_commande" => $commande->get_classe_commande(),
      ":tel_commande" => $commande->get_tel_commande(),
      ":mail_commande" => $commande->get_mail_commande(),
      ":id_statut" => $commande->get_id_statut(),
    );
    try {
      $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  } // update()

  function update_statut_id_controleur(Commande $commande) {
    $sql = "UPDATE commande set id_statut=:id_statut, id_user_controleur=:id_user_controleur where id_commande= :id_commande";
    $params = array(
      ":id_commande" => $commande->get_id_commande(),
      ":id_statut" => $commande->get_id_statut(),
      ":id_user_controleur" => $commande->get_id_user_controleur(),
    );
    try {
      $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  } // update()

  function update_statut(Commande $commande) {
    $sql = "UPDATE commande set id_statut=:id_statut where id_commande= :id_commande";
    $params = array(
      ":id_commande" => $commande->get_id_commande(),
      ":id_statut" => $commande->get_id_statut(),
    );
    try {
      $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  } // update()

  function update_prix(Commande $commande) {
    $sql = "UPDATE commande set total_commande=:total_commande where id_commande= :id_commande";
    $params = array(
      ":id_commande" => $commande->get_id_commande(),
      ":total_commande" => $commande->get_total_commande(),
    );
    try {
      $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  } // update()

}
