<?php
$serveur = "localhost";
$utilisateur = "root";
$modDePasse = "";
$base = "medical_center";

// Connexion à la base de données
$connect = mysqli_connect($serveur, $utilisateur, $modDePasse, $base);

// Vérification de la connexion
if (!$connect) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}


    $n = $_POST['doctor_name'];
    $e = $_POST['email'];
    $s = $_POST['specialty'];
    $p = $_POST['disponible'];
    $m=$_POST['max_patients'];
    // Vérification de l'unicité de l'email dans la base de données
    $query = "INSERT INTO `rendez_vous_docteur`(`doctor_name`, `email`, `specialty`, `disponibilite`, `max_patients`)
     VALUES ('$n','$e','$s','$p','$m')";
   
    if (mysqli_query($connect, $query)) {
       echo'<!DOCTYPE html>
       <html lang="en">
       <head>
           <meta charset="UTF-8">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
          
           <link rel="stylesheet" href="rd d.css">
       </head>
       <body>
           <div class="container">
           <center><h1>Merci Docteur!</h1></center>
         
               
<center><img src="R.png" alt="" 
width="60"></center>
             
<div class="t"><a href="gere les rende vous.html"> <input type="BUTTON" >RETOUR</a></div>
                
               </form>
           </div>
       </body>';
        } else {
            echo "Erreur lors de l'inscription : " . mysqli_error($connect);
        }
 
// Fermeture de la connexion
mysqli_close($connect);
?>
