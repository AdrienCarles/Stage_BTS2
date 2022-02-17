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

  function count_img_by_famille($id_famille){
    $sql = "SELECT * FROM image WHERE id_famille = :id_famille";
    try {
      $params = array(":id_famille" => $id_famille);
      $sth = $this->executer($sql, $params);
      $row = $sth->fetch(PDO::FETCH_ASSOC);
      $nb = $sth->rowcount();
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    return $nb;
  }

  function insert(Image $image){
      $sql = "INSERT INTO `image`(`id_famille`, `id_image`) 
              VALUES 
              (:id_famille, :id_image)";
      $params = array(
        ":id_famille" => $image->get_id_famille(),
        ":id_image" => $image->get_id_image(),
      );
      try {
        $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
      } catch (PDOException $e) {
        die("Erreur lors de la requête SQL : " . $e->getMessage());
      }
  } // insert()

  public function delete_by_famille($id_famille) {
    $sql = "DELETE FROM image where id_famille=:id_famille";
    $params = array(
      ":id_famille" => $id_famille
    );
    try {
      $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
      $nb = $sth->rowcount();
    } catch (PDOException $e) {
    throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  } // delete()
}