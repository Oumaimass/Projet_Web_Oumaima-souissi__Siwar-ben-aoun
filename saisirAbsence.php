<?php
include('connexion.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">Select Classe: 

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Saisir Absence</title>
    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-JQUERY -->
<script src="./assets/dist/js/jquery.min.js"></script>
<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet">

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
        <h1 class="display-4">Signaler l'absence pour tout un groupe</h1>
      </div>
    </div>

    <div class="container">
      <?php

      if ($_SESSION["autoriser"] != "oui") {
        header("location:login.php");
        exit();
      } else {
        if (isset($_POST['ajouter'])) {
          $date = trim($_POST['deb']);
          $classe = trim($_POST['classe']);
          $module = trim($_POST['module']);
          $desc = trim($_POST['desc']);
          $cin= trim($_POST['cin']);
          $sql = "INSERT INTO absence (cin, classe, module, date_absence, description) values (:cin, :classe, :module, :date, :description)";
          $stmt = $pdo->prepare($sql);
          $stmt->execute([         
            ':date' => $date,
            ':classe' => $classe,
            ':module' => $module,
            ':description' => $desc,
            ':cin' => $cin,
          ]);
          $erreur = "Ajout effectué";
        }
      }
      ?>

      <div class="container">
        <form action="saisirAbsence.php" method="POST" id="myForm">
          <div class="form-group">
            <label for="deb">Choisir une date:</label><br>
            <input type="date" id="deb" name="deb" value="2022-05-01" min="1988-02-01" max="2022-12-31">
          </div>

            <label for="classe">choisir Classe:</label>
            <select name="classe" id="classe" class="custom-select custom-select-sm custom-select-lg">
              <?php
              $sql0 = "SELECT * FROM Groupe";
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
            <label for="module">donner un module:</label><br>
            <input id="module" name="module" class="custom-select custom-select-sm custom-select-lg" type="text" placeholder="Module">
              </div>
            <label for="nom">Choisir le cin de l'étudiant:</label><br>
            <select id="cin" name="cin" class="custom-select custom-select-sm custom-select-lg" type="text" placeholder="cin de l'étudiant">
              <?php
              $sql1 = "SELECT * FROM etudiant";
              $stmt1 = $pdo->prepare($sql1);
              $stmt1->execute();
              while ($cat = $stmt1->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $cat['cin']; ?>">
                  <?php echo $cat['cin']; ?>
                </option>
              <?php }
              ?>
            </select>
            <div class="form-group">

            <label for="desc">choisir une désignation :</label><br>
            <select id="desc" name="desc" class="custom-select custom-select-sm custom-select-lg" type="text" placeholder="Description" class="custom-select custom-select-sm custom-select-lg">
            <option value="avec justification">avec justification</option>
            <option value="sans justification">sans justification</option>
            
          </select>
          </div>
          <button type="submit" name="ajouter" value="ajouter" class="btn btn-primary btn-block">Valider</button>
        </form>
      </div>
    </div>
  </main>

<footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
</body>
</html>