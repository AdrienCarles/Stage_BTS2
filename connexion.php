<?php
  require("header.php");

  $messages = array(); //message d'erreur
  $nom_user = " ";
  $utilisateurDAO = new UtilisateurDAO();
  //Recuperation des données entrées dans le formulaire
  $submit=isset($_POST['submit']); // Attribue à la variable submit l'appui sur le bouton du formulaire 

  if ($submit){
    $nom=isset($_POST['nom']) ? $_POST['nom'] :  "";
    $password=isset($_POST['mdp']) ? $_POST['mdp'] :  "";
    $utilisateur=new Utilisateur(array(
      "nom_user" => $nom,
      "mdp_user" => $password
    ));
    $utilisateur=$utilisateurDAO->find_by_nom($utilisateur);
    //Si le pseudo existe verifier que le mdp correspond à celui entré
    if(null !== $utilisateur){
      $nom_user = $utilisateur->get_nom_user();
    }
    if($nom ===  $nom_user && password_verify($password, $utilisateur->get_mdp_user())){   
      $_SESSION['utilisateur']=$utilisateur;
      header("Location: connecter.php"); //Redirection vers la page principale
    }
    else{
      $messages[] ="Nom ou Mots de passe Inconnus";
      //header("Location: connexion.php?erreur=1"); //Si les informations ne correspondent pas rester sur la page
    }
  }

?>
<h1>Connexion</h1>
<?php 
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
  <input type="text" name="nom" id="nom" required><br>
  <label for="mdp">Mot de passe</label><br>
  <input type="password" name="mdp" id="mdp" required><br><br>
  <input type="submit" name="submit" value="Connexion">
</form>
<?php
  require("footer.php");
?>