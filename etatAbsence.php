<?php
   session_start();

include("connexion.php");

?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Walid SAAD">
    <meta name="generator" content="Hugo 0.88.1">
    <title>SCO-ENICAR</title>
    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-JQUERY -->
<script src="./assets/dist/js/jquery.min.js"></script>
<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>
  <body>
    
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="http://www.enicarthage.rnu.tn/">SCO-Enicar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
  
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="index.php" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="AfficherEtudiants.php">Lister tous les étudiants</a>
          <a class="dropdown-item" href="afficherEtudiantsParClasse.php">Etudiants par Groupe</a>
          <a class="dropdown-item" href="AjouterGroupe.php">Ajouter Groupe</a>
          <a class="dropdown-item" href="modifierGroupe.php">Modifier Groupe</a>
          <a class="dropdown-item" href="supprimerGroupe.php">Supprimer Groupe</a>

        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Etudiants</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="ajouterEtudiant.php">Ajouter Etudiant</a>
          <a class="dropdown-item" href="chercherEtudiant.php">Chercher Etudiant</a>
          <a class="dropdown-item" href="ModifierEtudiant.php">Modifier Etudiant</a>
          <a class="dropdown-item" href="supprimerEtudiant.php">Supprimer Etudiant</a>


        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Absences</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="saisirAbsence.php">Saisir Absence</a>
          <a class="dropdown-item" href="etatAbsence.php">État des absences pour un groupe</a>
        </div>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="deconnexion.php">Se Déconnecter </a>
      </li>

    </ul>
   
  
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" id="gp" name="gp" type="text" value=""placeholder="Saisir un groupe" aria-label="Chercher un groupe">
      <input type="button" class="btn btn-outline-success my-2 my-sm-0" value="Chercher Groupe" onclick="aller()"/>
    </form>
    <script > 
function aller(){ 
  var saisie=document.getElementById("gp").value;
  document.location.href="inf.php?classe="+saisie;}</script>
  </div>
</nav>


<main role="main">
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-4">État des absences pour un groupe</h1>
            </div>
        </div>

        <div class="container">
            <form action="etatAbsence.php" method="POST" id="myForm">
                <div class="form-group">
                    <label for="classe">Choisir un groupe:</label><br>
                    <select id="classe" name="classe" class="custom-select custom-select-sm custom-select-lg">
                        <?php
                        $sql0 = "SELECT  nom_groupe FROM Groupe";
                        $stmt0 = $pdo->prepare($sql0);
                        $stmt0->execute();
          
                        while ($cats = $stmt0->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $cats['nom_groupe']; ?>">
                                <?php echo $cats['nom_groupe']; ?>
                            </option>
                        <?php }
                        ?>
                    </select>
                    <div class="form-group">
            <label for="deb">Choisir une date de début:</label><br>
            <input type="date" id="deb" name="deb" value="2022-05-01" min="1988-02-01" max="2022-12-31">
          </div>
          <div class="form-group">
            <label for="deb">Choisir une date de fin:</label><br>
            <input type="date" id="deb1" name="deb1" value="2022-05-01" min="1988-02-01" max="2022-12-31">
          </div>

                    <button type="submit" name="afficherpar">afficher</button>
                </div>
            </form>
        </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <!--Ligne Entete-->
                        <tr>
                            <th>
                              <?php  if (isset($_POST['afficherpar'])) echo " Nom " ; ?>
                                            
                            </th>
                            <th>
                                  <?php  if (isset($_POST['afficherpar'])) echo " Classe " ; ?>
                            </th>
                            <th>
                               <?php  if (isset($_POST['afficherpar'])) echo "  Date " ; ?>
                            </th>
                            <th>
                              <?php  if (isset($_POST['afficherpar'])) echo "Module" ; ?>
                            </th>
                            <th>
                                <?php  if (isset($_POST['afficherpar'])) echo "Designation" ; ?>
                            </th>
                        </tr>
                        <?php

                        if ($_SESSION["autoriser"] != "oui") {
                            header("location:login.php");
                            exit();
                        } else {
                            if (isset($_POST['afficherpar'])) {
                               $classe = $_POST['classe'];
                              
                                $da = $_POST['deb'];
                                $daa = $_POST['deb1'];
                                $sql = "SELECT  * from absence where (classe = :classe and (date_absence between :da and :daa))";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([
                                    ':classe' => $classe,':da'=> $da,':daa'=>$daa
                                ]);
                                while ($etudiants = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $nom = $etudiants['cin'];
                                    $classe = $etudiants['classe'];
                                    $date = $etudiants['date_absence'];
                                    $module = $etudiants['module'];
                                    $description = $etudiants['description'];
                        ?>
                                    <tr>
                                        <td>
                                            <?php  echo $nom ; ?>
                                        </td>
                                        <td>
                                            <?php echo $classe ?>
                                        </td>
                                        <td>
                                            <?php echo $date ?>
                                        </td>
                                        <td>
                                            <?php echo $module ?>
                                        </td>
                                        <td>
                                            <?php echo $description ?>
                                        </td>
                                    </tr>

                        <?php
                                }
                            }
                        }
                        ?>
                    </table>
                    <br>
                </div>
            </div>
        </div>
        <script type="text/javascript"> 
        if(!!window.performance && window.performance.navigation.type == 2)
{console.log('Reloading');
    window.location.reload();}

        </script>
    </main>

    <footer class="container">
        <p>&copy; ENICAR 2021-2022</p>
    </footer>

    <script src="/assets/dist/js/inscrire.js"></script>
</body>

</html>