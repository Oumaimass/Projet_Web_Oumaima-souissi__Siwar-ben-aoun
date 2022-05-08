<?php 
    require_once('connexion.php');
    $cin = $_POST['cin'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $classe = $_POST['classe'];

    $req="UPDATE etudiant SET nom='$nom' , email='$email', prenom='$prenom', adresse='$adresse', Classe='$classe' WHERE  cin =$cin ";
    $res = $pdo->query($req);
    require_once("ModifierEtudiant.php");


?>