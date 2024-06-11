<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "form";

// Connexion à la base de données
$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Initialisation des variables
$email = "";
$password = "";
$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modifier_patient"])) {
    // Récupérer les données du formulaire
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Vérifier si l'email existe dans la base de données
    $requete_verif = "SELECT * FROM users WHERE email = '$email'";
    $resultat_verif = mysqli_query($connexion, $requete_verif);

    if (mysqli_num_rows($resultat_verif) == 0) {
        $error_message = "Aucun patient trouvé avec cet email.";
    } else {
        // Préparer la requête SQL pour mettre à jour le patient dans la table users
        $requete = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = mysqli_prepare($connexion, $requete);

        // Vérifier la préparation de la requête
        if ($stmt === false) {
            $error_message = "Erreur lors de la préparation de la requête : " . mysqli_error($connexion);
        }

        // Binder les paramètres à la requête
        mysqli_stmt_bind_param($stmt, "ss", $password, $email);

        // Exécuter la requête
        if (mysqli_stmt_execute($stmt) === false) {
            $error_message = "Erreur lors de la mise à jour du patient : " . mysqli_error($connexion);
        } else {
            $success_message = "Le mot de passe du patient a été mis à jour avec succès.";
        }

        // Fermer la requête
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="c.css">
    <link rel="stylesheet" href="B.css">
    <title>Modifier Patient</title>
    <style>
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            background-color: #f44336;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
        }

        .success-message {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
        }

        .logout-button {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }

        .logout-button:hover {
            background-color: red;
        }
    </style>
</head>



<body>
    <script src="nav_sp.js"></script>
    <div class="container">
        <h1>Modifier Patient</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="email">Email :</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br>
            <label for="password">Nouveau mot de passe :</label>
            <input type="password" id="password" name="password" value="<?php echo $password; ?>"><br>
            <input type="submit" value="Modifier" name="modifier_patient">
        </form>

        <?php if (!empty($error_message)) : ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <?php if (!empty($success_message)) : ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
    </div>
    <pre>                                                <a href="gere les patients.html" class="logout-button">Quitter</a></pre>
</body>
<footer class="footer">
    <p> @copy_right Modifier Patients au  base_de_donnees</p>
</footer>
</html>
