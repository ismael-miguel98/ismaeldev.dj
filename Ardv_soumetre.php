<?php
$success_message = "";
$error_message = "";

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez si la connexion a réussi
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Vérifiez si des données ont été soumises via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si l'e-mail du patient et le résultat de la rendez-vous ont été fournis
    if (isset($_POST['email_patient']) && isset($_POST['resultat_rdv']) && !empty($_POST['email_patient']) && !empty($_POST['resultat_rdv'])) {
        // Récupérez l'e-mail du patient et le résultat de la rendez-vous soumis par le formulaire
        $email_patient = $conn->real_escape_string($_POST['email_patient']); 
        $resultat_rdv = $conn->real_escape_string($_POST['resultat_rdv']);

        // Préparez la requête SQL pour insérer le résultat de la rendez-vous dans la table resultat_rdv_patient
        $sql = "INSERT INTO resultat_rdv_patient (email_patient, resultat_rdv) VALUES ('$email_patient', '$resultat_rdv')";

        // Exécutez la requête SQL
        if ($conn->query($sql) === TRUE) {
            $success_message = "Résultat de la rendez-vous envoyé avec succès au patient avec l'e-mail : " .$email_patient ;
        } else {
            $error_message = "Erreur lors de l'envoi du résultat de la rendez-vous : " . $conn->error;
        }

    } else {
        // Si l'e-mail du patient ou le résultat de la rendez-vous n'ont pas été fournis, stockez un message d'erreur
        $error_message = "Veuillez fournir l'e-mail du patient et le résultat de la rendez-vous.";
    }
}

// Fermez la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="c.css">
    <link rel="stylesheet" href="B.css">
    <title>Envoi du Résultat de la Rendez-vous</title>
    <style>
         body {
            background-image: url(doc.jpeg);
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .submit-button {
            display: inline;
            margin: 20px auto;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 4px;
        }
        .submit-button:hover {
            background-color: #0056b3;
        }
        .form-container {
            width: 50%;
            margin: 0 auto;
            background-color: transparent;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label, textarea, input[type="text"] {
            display: block;
            margin-bottom: 10px;
        }
        textarea, input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .logout-button {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }
        .logout-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
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
    <div class="form-container">
        <form action="" method="post">
            <label for="email_patient">E-mail du Patient :</label>
            <input type="text" id="email_patient" name="email_patient" placeholder="Entrez l'E-mail du patient">
            <label for="resultat_rdv">Résultat de la Rendez-vous :</label>
            <textarea id="resultat_rdv" name="resultat_rdv" rows="4" placeholder="Entrez le résultat de la rendez-vous"></textarea>
            <input type="submit" value="Envoyer Résultat de la Rendez-vous">      <a href="A_rdv.php" class="logout-button">Quitte</a>
            <!-- Affichage des messages de succès ou d'erreur -->
            <?php if (!empty($success_message)) : ?>
                <div class="success-message"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <?php if (!empty($error_message)) : ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
        </form>
        
    </div>
</body>
<footer class="footer">
      <p> @copy_right Rendez-vous Pour Les patients</p>
</footer>
</html>
