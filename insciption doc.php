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


    $name = $_POST['name'];
    $email = $_POST['email'];
    $specialite = $_POST['specialite'];
    $password = $_POST['password'];
    
    // Vérification de l'unicité de l'email dans la base de données
    $query = "INSERT INTO `docteur`(`nom`, `email`, `specialite`, `password`) VALUES ('$name','$email','$specialite','$password')";
   
    if (mysqli_query($connect, $query)) {
       echo"le donne son enregistre";
        } else {
            echo "Erreur lors de l'inscription : " . mysqli_error($connect);
        }
 
// Fermeture de la connexion
mysqli_close($connect);
?>
