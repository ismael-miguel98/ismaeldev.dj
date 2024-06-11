<?php
session_start();

$server = "localhost";
$username = "root";
$password = "";
$dbname = "form";

// Connexion à la base de données
$connect = mysqli_connect($server, $username, $password, $dbname);

// Vérification de la connexion
if (!$connect) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Vérification des informations de connexion
if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Requête SQL pour vérifier les informations de connexion
    $query = "SELECT * FROM `medecins` WHERE `email`='$email' AND `password`='$password'";
   
    $result = mysqli_query($connect, $query);
    
    if(mysqli_num_rows($result) == 1) {
        // Authentification réussie, rediriger vers la page tableau_de_bord.php
        $_SESSION['email'] = $email;
        header("Location: tableau_de_bord.php");
        exit;
    } else {
        // Authentification échouée, afficher un message d'erreur
        echo "Email ou mot de passe incorrect.";
    }
}

// Fermeture de la connexion
mysqli_close($connect);
?>
