<?php
require_once("connexion.php");
$cin = $_GET['cin'];

$req="select * from etudiant where (cin=$cin)";
$res = $pdo->query($req);
$etu = $res->fetch(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Ajouter Etudiant</title>
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
        <a class="navbar-brand" href="#">SCO-Enicar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="index.html" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="afficherEtudiants.php">Lister tous les étudiants</a>
                        <a class="dropdown-item" href="afficherEtudiantsParClasse.php">Etudiants par Groupe</a>
                        <a class="dropdown-item" href="#">Ajouter Groupe</a>
                        <a class="dropdown-item" href="#">Modifier Groupe</a>
                        <a class="dropdown-item" href="#">Supprimer Groupe</a>

                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Etudiants</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="ajouterEtudiant.php">Ajouter Etudiant</a>
                        <a class="dropdown-item" href="#">Chercher Etudiant</a>
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
                    <a class="nav-link" href="deconnexion.php">Se Déconnecter <span class="sr-only">(current)</span></a>
                </li>

            </ul>


            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Saisir un groupe" aria-label="Chercher un groupe">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher Groupe</button> <!-- to do  -->
            </form>
        </div>
    </nav>


    <main role="main">
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-4">Modifier les Informations de L'Etudiant !</h1>
                <p>Remplir le formulaire ci-dessous afin de modifier les informations de cet étudiant! <br>
                    
                </p>

            </div>
        </div>





        <div class="container">

            <form id="myForm" method="POST" action="Edit.php">
                
                <!--Nom-->
                <div class="form-group">
                    <label for="nom">Nom:</label><br>
                    <input type="text" id="nom" name="nom" value="<?php echo ($etu['nom']) ?>" class="form-control" required autofocus>
                </div>
                <!--Prénom-->
                <div class="form-group">
                    <label for="prenom">Prénom:</label><br>
                    <input type="text" id="prenom" name="prenom" value="<?php echo ($etu['prenom']) ?>" class="form-control" required>
                </div>
                <!--Email-->
                <div class="form-group">
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" value="<?php echo ($etu['email']) ?>" class="form-control" required>
                </div>
                <!--CIN-->
                <div class="form-group">
                    <label for="cin">CIN:</label><br>
                    <input type="text" id="cin" name="cin" value="<?php echo ($etu['cin']) ?>" class="form-control" required  />
                </div>

              

                <!--Classe-->
                <div class="form-group">
                    <label for="classe">Classe:</label><br>
                    <input type="text" id="classe" name="classe" value="<?php echo ($etu['Classe']) ?>" class="form-control" required pattern="INFO[1-3]{1}-[A-E]{1}" title="Pattern INFOX-X. Par Exemple: INFO1-A, INFO2-E, INFO3-C">
                </div>
                <!--Adresse-->
                <div class="form-group">
                    <label for="adresse">Adresse:</label><br>
                    <textarea id="adresse" value="<?php echo ($etu['adresse']) ?>" name="adresse"  rows="10" cols="30" class="form-control" required>
             </textarea>
                </div>
                <!--Bouton Ajouter-->
                <button type="submit" href="Edit.php" class="btn btn-primary btn-block">Enregistrer Modification</button>


            </form>

        </div>
    </main>


    <footer class="container">
        <p>&copy; ENICAR 2021-2022</p>
    </footer>

    <script src="/assets/dist/js/inscrire.js"></script>
</body>

</html>