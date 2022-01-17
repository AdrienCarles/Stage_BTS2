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

  function find_by_id_famille($id_famille) {
    $sql = "SELECT * FROM image WHERE id_famille = :id_famille";
    try {
      $params = array(":id_famille" => $id_famille);
      $sth=$this->executer($sql, $params); 
      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $images = array();
    foreach ($rows as $row) {
      $images[] = new Image($row);
    }
    return $images;
  } // function find_by_id_famille() 

  function find($id_image) {
    $sql = "SELECT * FROM image WHERE id_image= :id_image";
    try {
      $params = array(":id_image" => $id_image);
      $sth = $this->executer($sql, $params);
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $image = null;
    if ($row) {
      $image = new Image($row);
    }
    return $image;
  } // function find
}