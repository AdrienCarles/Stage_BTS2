<?php
  // Initialisations
  require('init.php');
  $utilisateurDAO = new UtilisateurDAO();
  //Recuperation des données entrées dans le formulaire
  $nom=isset($_POST['nom']) ? $_POST['nom'] :  "";
  $password=isset($_POST['mdp']) ? $_POST['mdp'] :  "";
  $submit=isset($_POST['submit']); // Attribue à la variable submit l'appui sur le bouton du formulaire 

  if ($submit){
    $utilisateur=new Utilisateur(array(
      "nom_user" => $nom,
      "mdp_user" => $password
    ));
    $utilisateurDAO->find_by_nom($utilisateur);
    //Si le pseudo existe verifier que le mdp correspond à celui entré
    if($nom === $utilisateur['nom_user'] && password_verify($password,$utilisateur['mdp_user'])){   
      unset($utilisateur["mdp_user"]); //Interdire l'enregistrement du mdp par le navigateur
      $_SESSION['utilisateur']=$utilisateur;
      header("Location: connecter.php"); //Redirection vers la page principale
    }
    else{
      header("Location: connexion.php"); //Si les informations ne correspondent pas rester sur la page
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
  <h1>Connexion</h1>
  <?php include "menu.php"; ?>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> <!-- Formulaire -->
    <br>
    <label for="nom">Nom</label><br>
    <input type="text" name="nom" id="nom" required><br>
    <label for="mdp">Mot de passe</label><br>
    <input type="password" name="mdp" id="mdp" required><br><br>
    <input type="submit" name="submit" value="Connexion">
  </form>
</body>
</html>