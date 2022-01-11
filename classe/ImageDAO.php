<?php

class ImageDAO extends DAO {
    
    /**
    * Constructeur
    */
    function __construct() {
        parent::__construct();
    }

    function findAll() {
        $sql = "SELECT * FROM image";
        try {
          $sth=$this->executer($sql); 
          $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $images = array();
        foreach ($rows as $row) {
          $images[] = new Image($row);
        }
        return $images;
      } // function findAll() 
}