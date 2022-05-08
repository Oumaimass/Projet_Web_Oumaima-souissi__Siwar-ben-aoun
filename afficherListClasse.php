<?php
session_start();
if($_SESSION["autoriser"]!="oui"){
   header("location:login.php");
   exit();
}
else {
include("connexion.php");
$req="SELECT distinct Classe FROM etudiant";
$reponse = $pdo->query($req);
if($reponse->rowCount()>0) {
	$outputs["classe"]=array();

  while ($row = $reponse ->fetch(PDO::FETCH_ASSOC)) 
  {
     array_push($outputs["classe"], $row["Classe"]);
  }
// success
$outputs["success"] = 1;
echo json_encode($outputs);
} else {
$outputs["success"] = 0;
$outputs["message"] = "Pas d'étudiants";
echo json_encode($outputs);
}
}
  ?>