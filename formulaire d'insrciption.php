<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Initialisation des messages d'erreur et de succès
$error_msg = "";
$success_msg = "";

// Vérification si les données ont été envoyées via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Requête SQL pour insérer les données dans la table de contact
    $sql = "INSERT INTO contacte (nom_conc, e_mail_conc, message_conc) VALUES ('$nom', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        $success_msg = "Demande enregistrée avec succès. Merci de contacter notre site.";
    } else {
        $error_msg = "Une erreur s'est produite lors de l'enregistrement de la demande : " . $conn->error;
    }
}

// Fermeture de la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="B.css">
    <link rel="stylesheet" href="c.css">
    <title>Formulaire de Contact</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: #f00;
            text-align: center;
        }

        .success-message {
            color: #008000;
            text-align: center;
        }
    </style>
</head>
<header id="main-header">

<input type="checkbox" id="nav_check" hidden>
<nav>
    <ul>
        <li>
            <a href="A.html">Home</a>
        </li>
        <li>
            <a href="About.html">About_us</a>
        </li>
        <li>
                <a href="formulaire d'insrciption.php">conctact</a>
            </li>
    
        <li>
        <a href="connrdv.php">Make an appointment</a>
        </li>
        <li>
                <a href="robot_form.php">patients_Account</a>
         </li>
         <li>
                <a href="Connexion_medecin.php">Medecin_Account</a>
            </li>
            <li>
                <a href="login_ad.php">Administrator_diag_Medical</a>
            </li>
    </ul>
</nav>
<label for="nav_check" class="hamburger">
    <div></div>
    <div></div>
    <div></div>
</label>
</header>
<body>
    <div class="container">
        <h2>Contactez-nous</h2>
        <div class="error-message"><?php echo $error_msg; ?></div>
        <div class="success-message"><?php echo $success_msg; ?></div>
        <form action="" method="post">
            <label for="nom">Nom :</label><br>
            <input type="text" id="nom" name="nom" required><br>
            
            <label for="email">Email :</label><br>
            <input type="email" id="email" name="email" required><br>
            
            <label for="message">Message :</label><br>
            <textarea id="message" name="message" rows="4" required></textarea><br>
            
            <input type="submit" value="Envoyer">
        </form>
    </div>
</body>
<footer class="footer">
      <p> @copy_right conctact Diag Medical</p>
</footer>
</html>
