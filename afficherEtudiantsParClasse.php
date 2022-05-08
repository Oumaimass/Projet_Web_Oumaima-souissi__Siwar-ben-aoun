<?php

   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
   if(date("H")<18)
      $bienvenue="Bonjour et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
   else
      $bienvenue="Bonsoir et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Etudiants Par CLasse</title>
    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-JQUERY -->
<script src="./assets/dist/js/jquery.min.js"></script>
<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./assets/dist/css/jumbotron.css" rel="stylesheet">

</head>
<body onload="refresh()">
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
              <h1 class="display-4">Afficher la liste d'étudiants par groupe</h1>
              <p>Cliquer sur la liste afin de choisir une classe!</p>
            </div>
          </div>

          <!-- SCRIPT PHP -->
          <script>
            function refresh() {
                var xmlhttp = new XMLHttpRequest();
                var url = "http://localhost/miniprojetweb/afficherListClasse.php";
                //Envoie de la requete
        
          xmlhttp.open("GET",url,true);
          xmlhttp.send();
             //Traiter la reponse
             xmlhttp.onreadystatechange=function()
                    {   //alert(this.readyState+" "+this.status);
                        if(this.readyState==4 && this.status==200){
                        
                            myFunction(this.responseText);
                            alert(this.responseText);
                            console.log(this.responseText);
                            
                        }
                    }
        
        
            //Parse la reponse JSON
          function myFunction(response){
            var obj=JSON.parse(response);
                //alert(obj.success);
        
                if (obj.success==1)
                {
            var arr=obj.classe;
            var out="<select name='but' id='select' class='custom-select custom-select-sm custom-select-lg' >";          
            

            var i;
            for ( i = 0; i < arr.length; i++) {
              out+="<option id=d value="+arr[i]+">"+arr[i]+"</option>"
            }
            out +="</select><button onclick=refresh2()>submit</button>";
            

          
            
            
            document.getElementById("demo1").innerHTML=out;
               }
               else document.getElementById("demo1").innerHTML="Aucun Groupe!";
            }
            }
            </script>


<div class="container">
<div class="form-group">
<label for="classe">Choisir une classe:</label><br>

<div id="demo1"></div>
</div>
</div>  

<script>// SCRIPT POUR L'AFFICHAGE DES ETUDIANT PAR CLASSE

function refresh2() {
  var e = document.getElementById("select");
var but = e.value;
        var xmlhttp1 = new XMLHttpRequest();
        var url = "http://localhost/miniprojetweb/afficherParClasse.php?but="+but;
        //Envoie de la requete
  
	xmlhttp1.open("get",url,true);
	xmlhttp1.send();
     //Traiter la reponse
     xmlhttp1.onreadystatechange=function()
            {   //alert(this.readyState+" "+this.status);
                if(this.readyState==4 && this.status==200){
                
                    myFunction2(this.responseText);
            
                    
                }
            }


    //Parse la reponse JSON
	function myFunction2(response){
     
		var obj=JSON.parse(response);
        //alert(obj.success);

        if (obj.success==1)
        {
		var arr=obj.etudiants;
		var i;
		var out="<table class= table table-striped table-hover >"+
    "<tr>"+
         "<th>"+
             "CIN"+
         "</th>"+
         "<th>"+
             "Nom"+
         "</th>"+
         "<th>"+
             "Prénom"+
         "</th>"+
         "<th>"+
             "Email"+
         "</th>"+
         "<th>"+
             "Adresse"+
         "</th>"+
         "<th>"+
             "Classe"+
         "</th>"+
     "</tr>";
		for ( i = 0; i < arr.length; i++) {
			out+="<tr><td>"+
			arr[i].cin +
			"</td><td>"+
			arr[i].nom+
			"</td><td>"+
			arr[i].prenom+
			"</td><td>"+
			arr[i].email+
			"</td><td>"+
			arr[i].adresse+
      "</td><td>"+
			arr[i].classe+
			"</td></tr>" 
      
			
		}
		out +="</table>";
		document.getElementById("demo2").innerHTML=out;
       }
       else document.getElementById("demo2").innerHTML="Aucune Inscriptions!";

    }
}
    </script>
<div class="container">
  <div class="row">
    <div class="table-responsive">
      <div id="demo1" class="table table-striped table-hover"></div>
    </div>
    <!-- sdf -->
  </div>
</div>




<div class="container">
  <div class="row">
    <!-- LISTE DES ETUDIANT-->
    <div class="table-responsive">
    <div id="demo2" class="table table-striped table-hover"></div>
    </div>
    <!-- Bouton actualiser-->
    <button type="submit" class="btn btn-primary btn-block active" onclick=refresh2()>Actualiser</button>
  </div>
</div>

</main>

<footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
</body>
</html>