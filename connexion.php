<?php
session_start();

// Connexion à la base de données MySQL
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$nom_base_de_donnees = "form";

$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $nom_base_de_donnees);

if (!$connexion) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Vérification de l'authentification
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $nom_utilisateur = $_POST['username'];
    $mot_de_passe = $_POST['password'];

    // Utiliser des requêtes préparées pour éviter les injections SQL
    $requete = "SELECT * FROM users WHERE username=? AND password=?";
    $declaration = mysqli_prepare($connexion, $requete);
    mysqli_stmt_bind_param($declaration, "ss", $nom_utilisateur, $mot_de_passe);
    mysqli_stmt_execute($declaration);
    $resultat = mysqli_stmt_get_result($declaration);

    if (mysqli_num_rows($resultat) == 1) {
        $_SESSION['connecte'] = true;
        header("Location: formulaire_sys.php");
        exit;
    } else {
        echo "Identifiant ou mot de passe incorrect.";
    }
}
?>
