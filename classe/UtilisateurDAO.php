<?php

class UtilisateurDAO extends DAO {
    
    /**
    * Constructeur
    */
    function __construct() {
        parent::__construct();
    }

    function findAll() {
        $sql = "SELECT * FROM utilisateur";
        try {
          $sth=$this->executer($sql); 
          $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $utilisateurs = array();
        foreach ($rows as $row) {
          $utilisateurs[] = new Utilisateur($row);
        }
        return $utilisateurs;
    } // function findAll() 

    function find($id_user) {
      $sql = "select * from utilisateur where id_user= :id_user";
      try {
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array(":id_user" => $id_user));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
      }
      $utilisateur=null;
      if($row) {
        $utilisateur = new Utilisateur($row);
      }
      // Retourne l'objet métier
      return $utilisateur;
    } // function find()

    function find_by_nom(Utilisateur $utilisateurs) {
        $sql="SELECT * FROM utilisateur WHERE nom_user=:nom_user ";
        $params = array(
            ":nom_user" =>  $utilisateurs->get_nom_user(),        
        );
        try {
            $sth = $this->executer($sql, $params);
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
        }
        $utilisateur = null;
        if($row) {
            $utilisateur = new Utilisateur($row);  
        }
        return $utilisateur;
    } // function findByNom()
        
    function insert(Utilisateur $utilisateur)
    {
      $sql = "INSERT INTO `utilisateur`(`nom_user`, `prenom_user`, `mdp_user`, `classe_user`, `tel_user`, `mail_user`, `id_role`) 
              VALUES 
              (:nom_user, :prenom_user, :mdp_user, :classe_user, :tel_user, :mail_user, 1)";
      $params = array(
        ":nom_user" => $utilisateur->get_nom_user(),
        ":prenom_user" => $utilisateur->get_prenom_user(),
        ":mdp_user" => $utilisateur->get_mdp_user(),
        ":classe_user" => $utilisateur->get_classe_user(),
        ":tel_user" => $utilisateur->get_tel_user(),
        ":mail_user" => $utilisateur->get_mail_user(),
      );
      try {
        $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
      } catch (PDOException $e) {
        die("Erreur lors de la requête SQL : " . $e->getMessage());
      }
    } // insert()

}