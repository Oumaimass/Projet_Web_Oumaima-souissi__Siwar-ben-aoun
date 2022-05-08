<?php
   session_start();
   @$login=$_POST["login"];
   @$pass=md5($_POST["pass"]);
   @$valider=$_POST["valider"];
   $erreur="";
   if(isset($valider)){
      include("connexion.php");
      $sel=$pdo->prepare("select * from enseignant where login=? and pass=? limit 1");
      $sel->execute(array($login,$pass));
      $tab=$sel->fetchAll();
      if(count($tab)>0){
         $_SESSION["prenomNom"]=ucfirst(strtolower($tab[0]["prenom"])).
         " ".strtoupper($tab[0]["nom"]);
         $_SESSION["autoriser"]="oui";
         header("location:index.php");
      }
      else
         $erreur="Mauvais login ou mot de passe!";
   }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>SCO-ENICAR Se Connecter</title>

    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
      .erreur{
            color:#CC0000;
            margin-bottom:10px;
         }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="./assets/dist/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">  
 
<form id="myForm" class="form-signin" action=""method="post">
<a href="http://www.enicarthage.rnu.tn/"><img src="assets\Logo_ENICarthage.jpg" style="width:300px;height:150px;"></a>
  <img class="mb-4" src="./assets/brand/user-login.svg" alt="" width="72" height="72">
  <div class="erreur"><?php echo $erreur ?></div>
  <h1 class="h3 mb-3 font-weight-normal">Veuillez vous connecter</h1>
  <!-- <label for="inputEmail" class="sr-only">Email </label>-->
  <input  type="email" id="inputEmail"name="login" class="form-control" placeholder="Email address" required autofocus>
 <!-- <label for="inputPassword" class="sr-only">Mot de Passe</label>-->
  <input type="password" id="inputPassword" name ="pass" class="form-control" placeholder="Password" required>

  <input class="btn btn-lg btn-primary btn-block"  name="valider" type="submit"value="Se Connecter"/>
  <br><a href="inscription.php"> Créer un Compte</a>
  <p class="mt-5 mb-3 text-muted">&copy; SOC-Enicar 2021-2022</p>
</form>
</script>
  </body>
</html>
