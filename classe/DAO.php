<?php
/**
* Classe mère DAO
*
* @author Adrien
*/

class DAO {
  
  protected $pdo=null; // Objet de connexion
  
  /**
  * Constructeur
  * @return PDO objet de connexion
  */
  
  function __construct() {
    // On récupère les paramètres de la base à partir des constantes de init.php
    // On construit le DSN
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
    // Création de la connexion
    try {
      $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Erreur lors de la connexion : " . $e->getMessage());
    }
    $this->pdo = $pdo;  // Renvoie l'objet de connexion
  }
  
  /**
  * Exécute une requête SQL avec ou sans requête préparée
  * 
  * @param string Requête SQL
  * @param array Paramètres de la requête
  * @return PDOStatement Résultat de la requête
  */
  protected function executer($sql, $params = null) {
    try {
      if ($params == null) {
        $sth = $this->pdo->query($sql);   // exécution directe
      } else {
        $sth = $this->pdo->prepare($sql); // requête préparée
        $sth->execute($params);
      }
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage()."\nSQL : ".$sql);
    }
    return $sth;  // Renvoie le handler du résultat de la requête de la requête SQL 
  }
  
} // Classe DAO