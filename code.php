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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $nom_utilisateur = $_POST['username'];
        $mot_de_passe = $_POST['password'];

        // Utiliser des requêtes préparées pour éviter les injections SQL
        $requete = "SELECT * FROM utilisateur WHERE username=? AND password=?";
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
    } elseif (isset($_POST['enregistrer'])) {
        $nom_utilisateur = $_POST['username'];
        $email = $_POST['email'];
        $mot_de_passe = $_POST['password'];

        // Vérifier si l'utilisateur existe déjà dans la base de données
        $requete_existence = ("SELECT username,email, password  FROM users  WHERE username=?");
        $declaration_existence = mysqli_prepare($connexion, $requete_existence);
        mysqli_stmt_bind_param($declaration_existence, "s", $nom_utilisateur);
        mysqli_stmt_execute($declaration_existence);
        $resultat_existence = mysqli_stmt_get_result($declaration_existence);

        if (mysqli_num_rows($resultat_existence) > 0) {
            echo "Cet utilisateur existe déjà.";
        } else {
            // Insérer un nouvel utilisateur dans la base de données
            $requete_insertion = "INSERT INTO users(username, email, password) VALUES (?, ?, ?)";
            $declaration_insertion = mysqli_prepare($connexion, $requete_insertion);
            mysqli_stmt_bind_param($declaration_insertion, "sss", $nom_utilisateur, $email, $mot_de_passe);
            
            if (mysqli_stmt_execute($declaration_insertion)) {
                $_SESSION['connecte'] = true;
                header("Location: formulaire_sys.php");
                exit;
            } else {
                echo "Erreur lors de l'inscription : " . mysqli_error($connexion);
            }
        }
    }
}
?>
