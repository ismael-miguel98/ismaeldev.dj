<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des informations de connexion
    $email = $_POST['email'];
    $password = $_POST['password'];

   
    $db = new mysqli("localhost", "root", "", "form");
    if ($db->connect_error) {
        die("La connexion a échoué : " . $db->connect_error);
    }

    // Requête SQL pour récupérer les informations du médecin
    $query = "SELECT * FROM medecins WHERE email='$email' AND password='$password'";
    $result = $db->query($query);

    // Vérification du résultat de la requête
    if ($result->num_rows == 1) {
        // Authentification réussie
        $_SESSION['email'] = $email;
        header("Location: tableau_de_bord.php"); // Redirection vers le tableau de bord après connexion
        exit();
    } else {
        // Identifiants incorrects
        header("Location: connexion.php?error=1"); // Redirection avec message d'erreur
        exit();
    }

    // Fermeture de la connexion à la base de données
    $db->close();
}
?>