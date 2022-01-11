<?php
  // Initialisations
  require('init.php');

  $utilisateurDAO = new UtilisateurDAO();

  $messages = array(); //message d'erreur

  // Récupère le contenu du formulaire
  $nom=isset($_POST['nom']) ? $_POST['nom'] : '';
  $prenom=isset($_POST['prenom']) ? $_POST['prenom'] : '';
  $mdp=isset($_POST['mdp']) ? $_POST['mdp'] : '';
  $c_mdp=isset($_POST['c_mdp']) ? $_POST['c_mdp'] : '';
  $classe=isset($_POST['classe']) ? $_POST['classe'] : '';
  $tel=isset($_POST['tel']) ? $_POST['tel'] : '+33';
  $mail=isset($_POST['mail']) ? $_POST['mail'] : '';
  $submit=isset($_POST['submit']); // Attribue à la variable submit l'appui sur le bouton du formulaire 

  // Vérifie le user et filtre les données renrer dans le formulaire
  if ($submit){
    // NOM
    $nom = filter_input(INPUT_POST, "nom",FILTER_SANITIZE_SPECIAL_CHARS);
    if (empty(trim($nom))){ 
        $messages[] = "Le nom est obligatoire"; 
    } 
    // PRENOM
    $prenom = filter_input(INPUT_POST, "prenom",FILTER_SANITIZE_SPECIAL_CHARS);
    if (empty(trim($prenom))){ 
        $messages[] = "Le prenom est obligatoire"; 
    }
    // MOT DE PASSE
    $mdp = filter_input(INPUT_POST, "mdp",FILTER_SANITIZE_SPECIAL_CHARS);
    $c_mdp = filter_input(INPUT_POST, "c_mdp",FILTER_SANITIZE_SPECIAL_CHARS);
    if (empty(trim($mdp))){ 
      $messages[] = "Le mot de passe est obligatoire"; 
    }
    if(mb_strlen($mdp)<8){ //Si le mdp fait 8 caractères ou plus
      $messages[] = "Le mot de passe doit faire au moins 8 caractères";
    }
    if (empty(trim($c_mdp))){ 
      $messages[] = "Confirmez le mot de passe"; 
    } 
    if($mdp!=$c_mdp) { // Vérifie que les deux mots de passe corresspondent
      $messages[] = "Les mots de passe ne correspondent pas";
    }
    // CLASSE
    $classe = filter_input(INPUT_POST, "classe",FILTER_SANITIZE_SPECIAL_CHARS);

    // TELEPHONE
    $tel = filter_input(INPUT_POST, "tel",FILTER_SANITIZE_NUMBER_INT);
    if (filter_var($tel, FILTER_VALIDATE_INT) === false){
        $messages[] = "Le téléphone n'est pas un entier valide"; 
    } 
    // EMAIL
    $mail = filter_input(INPUT_POST, "mail",FILTER_SANITIZE_EMAIL);
    if (empty(trim($mail))){ 
        $messages[] = "Le mail est obligatoire"; 
    }
    if (filter_var($mail, FILTER_VALIDATE_EMAIL) === false){
        $messages[] = "Le mail n'est pas valide"; 
    } 
  }

  //Valide et enregistre dans la bdd
  if ($submit){
    if (count($messages) == 0){
      $mdp=password_hash($mdp, PASSWORD_BCRYPT); // Hash le mot de passe
      $utilisateur=new Utilisateur(array(
        "nom_user" => $nom,
        "prenom_user" => $prenom,
        "mdp_user" => $mdp,
        "classe_user" => $classe,
        "tel_user" => $tel,
        "mail_user" => $mail,
        )
      );
      $utilisateurDAO->insert($utilisateur);
      header("location: index.php");
    }
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Les Silusins</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>
<body>
  <h1>Inscription</h1>
  <?php 
    include "menu.php";
    if (count($messages) > 0) {
      echo "<ul>";
      foreach ($messages as $message) {
        echo "<li>" . $message . "</li>";
      }
      echo "</ul>";
    }
  ?>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> <!-- Formulaire -->
    <label for="nom">Nom</label><br>
    <input type="text" name="nom" id="nom" placeholder="Nom" value="<?=$nom?>"><br>
    
    <label for="prenom">Prénom</label><br>
    <input type="text" name="prenom" id="prenom" placeholder="Prénom" value="<?=$prenom?>"><br>

    <label for="mdp">Mot de Passe</label><br>
    <input type="password" name="mdp" id="mdp" placeholder="Mot de Passe" value=""><br>

    <label for="c_mdp">Confirmer le Mot de Passe</label><br>
    <input type="password" name="c_mdp" id="c_mdp" placeholder="Mot de Passe" value=""><br>

    <label for="classe">Classe</label><br>
    <input type="text" name="classe" id="classe" placeholder="Classe" value="<?=$classe?>"><br>
    
    <label for="tel">Téléphone</label><br>
    <input type="text" name="tel" id="tel" placeholder="Téléphone" value="<?=$tel?>"><br>
    
    <label for="mail">Mail</label><br>
    <input type="email" name="mail" id="mail" placeholder="Mail" value="<?=$mail?>"><br><br>

    <input type="submit" value="S'inscrire" name="submit">
  </form>   
</body>
</html>