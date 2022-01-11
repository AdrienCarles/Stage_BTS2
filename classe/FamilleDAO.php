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
}
