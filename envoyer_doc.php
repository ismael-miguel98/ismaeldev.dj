<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_medecin = $_POST["nom_medecin"];
    $email_medecin = $_POST["email_medecin"];
    $specialite_medecin = $_POST["specialite_medecin"];
    $password_medecin = $_POST["password_medecin"];

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

    // Préparer la requête SQL pour insérer le docteur dans la table medecins
    $requete = mysqli_prepare($connexion, "INSERT INTO medecins VALUES (?, ?, ?, ?)");

    // Vérifier la préparation de la requête
    if ($requete === false) {
        die("Erreur lors de la préparation de la requête : " . mysqli_error($connexion));
    }

    // Binder les paramètres à la requête
    mysqli_stmt_bind_param($requete, "ssss", $nom_medecin, $email_medecin, $specialite_medecin, $password_medecin);

    // Exécuter la requête
    if (mysqli_stmt_execute($requete) === true) {
        $success_message = "Docteur envoyé avec succès dans la base de données.";
    } else {
        $error_message = "Erreur lors de l'envoi du docteur dans la base de données : " . mysqli_error($connexion);
    }

    // Fermer la requête et la connexion
    mysqli_stmt_close($requete);
    mysqli_close($connexion);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="c.css">
    <link rel="stylesheet" href="B.css">
    <title>Formulaire d'envoi de docteur</title>
    <style>
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
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

        .success-message {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
        }

        .error-message {
            background-color: #f44336;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
        }

        .success-message-button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
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
   

    <div class="container">
        <h1>Envoyer un docteur</h1>
        <pre>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<label for="nom_medecin">Nom du docteur :</label>
<input type="text" id="nom_medecin" name="nom_medecin" required><br><br>
<label for="email_medecin">Email du docteur :</label>
<input type="email" id="email_medecin" name="email_medecin" required><br><br>
<label for="specialite_medecin">Spécialité :</label>
<input type="text" id="specialite_medecin" name="specialite_medecin" required><br><br>
<label for="password_medecin">Mot de passe :</label>
<input type="password" id="password_medecin" name="password_medecin" required><br><br>
<input type="submit" value="Envoyer" class="success-message-button">

                    <a href="gere les docteurs.html" class="logout-button">Quitter</a>                         
<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($success_message)) : ?>
 <div class="success-message"><?php echo $success_message; ?></div>           
<?php endif; ?>
        </pre>
        </form>
       
    </div>
    <footer class="footer">
        <p> @copy_right Envoyer Docteurs au base_de_donnees</p>
    </footer>
</body>

</html>
