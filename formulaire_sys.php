<?php
$success_message = "";
$error_message = "";

// Vérifiez si des données ont été soumises via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si tous les champs obligatoires ont été fournis
    if (isset($_POST['nom_patient'], $_POST['email_patient'], $_POST['age_patient'], $_POST['symptome']) &&
        !empty($_POST['nom_patient']) && !empty($_POST['email_patient']) && !empty($_POST['age_patient']) && !empty($_POST['symptome'])) {
        
        // Récupérez les valeurs soumises par le formulaire
        $nom_patient = $_POST['nom_patient'];
        $email_patient = $_POST['email_patient'];
        $age_patient = $_POST['age_patient'];
        $symptome = $_POST['symptome'];

        // Connectez-vous à votre base de données (assurez-vous de remplacer les valeurs par vos propres informations de connexion)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "form";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérifiez si la connexion a réussi
        if ($conn->connect_error) {
            die("La connexion a échoué : " . $conn->connect_error);
        }

        // Préparez la requête SQL pour insérer le nouveau symptôme dans la table symptome
        $sql = "INSERT INTO symptome (nom_patient, email_patient, age_patient, symptome) VALUES ('$nom_patient', '$email_patient', '$age_patient', '$symptome')";

        // Exécutez la requête SQL
        if ($conn->query($sql) === TRUE) {
            $success_message = "Le symptôme a été ajouté avec succès.";
        } else {
            $error_message = "Erreur : " . $conn->error;
        }

        // Fermez la connexion à la base de données
        $conn->close();
    } else {
        // Si un champ obligatoire n'a pas été fourni, affichez un message d'erreur
        $error_message = "Veuillez fournir tous les champs obligatoires.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="B.css">
    <title>Formulaire d'Enregistrement de Symptômes</title>
    <link rel="stylesheet" href="form.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            box-sizing: border-box;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 999;
            transition: top 0.3s; /* Ajouter une transition pour une apparence plus fluide */
        }
        .container {
            padding-top: 60px; /* Pour compenser la hauteur du header */
        }
        .form-container {
            display: none; /* Masquer le formulaire par défaut */
            margin: auto;
            max-width: 600px;
            padding: 20px;
            background-color: transparent;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .show-form {
            display: block !important; /* Forcer l'affichage du formulaire */
        }
        .toggle-btn, #voir-traitement { /* Appliquer le même style au lien et au bouton */
            background-color: #4CAF50; /* Couleur de fond */
            border: none;
            color: white;
            padding: 10px 20px; /* Espacement intérieur */
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px; /* Marge extérieure */
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s; /* Transition pour un effet de survol */
        }
        .toggle-btn:hover, #voir-traitement:hover { /* Appliquer le même style au survol */
            background-color: #45a049; /* Couleur de fond au survol */
        }
        .success-message {
            background-color: green;
            color: white;
            border: 1px solid #c3e6cb;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .error-message {
            background-color: red;
            color: black;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .footer{
            position: fixed;
            left: 0;
            bottom: 0%;
            width: 100%;
            height: 6%;
            background-color: #333;
            color: white;
            text-align: center;
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
    <button class="toggle-btn" onclick="toggleHeader()">Afficher Le Formulaire de Diagnostique du Patient</button> <!-- Bouton pour afficher le header -->

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

<div class="container">
        <div class="form-container" id="form-container">
            <h1 class="form-title">Enregistrement des symptômes</h1>
            <form action="" method="POST">
                <div class="main-user-info">
                    <div class="user-input-box">
                        <label for="nom_patient">Nom du Patient :</label>
                        <input type="text" id="nom_patient" name="nom_patient" placeholder="Entrez votre nom" required>
                        <label for="email_patient">Email du Patient :</label>
                        <input type="email" id="email_patient" name="email_patient" placeholder="Entrez votre email" required>
                    </div>
                    <div class="user-input-box">
                        <label for="age_patient">Age du Patient :</label>
                        <input type="number" id="age_patient" name="age_patient" placeholder="Entrez votre âge" required>
                    </div>
                    <div class="user-input-box">
                        <label for="symptome">Veuillez Saisir vos Symptômes :</label>
                        <textarea id="symptome" name="symptome" placeholder="Décrivez vos symptômes" required></textarea>
                    </div>
                    <div class="form-submit-btn">
                        <input type="submit" value="Enregistrer Vos Symptômes">
                        <a href="tp.php" id="voir-traitement" class="toggle-btn">Voir votre traitement recommandé</a>
                        <a href="robot_form.php" class="logout-button">Déconnexion</a>
                    </div>
                </div>
            </form>
            <hr>
            <?php if (!empty($success_message)) : ?>
                <div class="success-message"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <?php if (!empty($error_message)) : ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
        </div>
    </div>

    <script>
       function toggleHeader() {
    var header = document.getElementById('main-header');
    var formContainer = document.getElementById('form-container');
    var toggleButton = document.querySelector('.toggle-btn');

    toggleButton.style.display = 'none'; // Masquer le bouton

    if (header.style.top === '0px') {
        header.style.top = '-100px';
        formContainer.classList.remove('show-form');
    } else {
        header.style.top = '0';
        formContainer.classList.add('show-form');
    }
}

// Fonction pour afficher le contenu de tp.php lorsqu'il est cliqué
document.getElementById('voir-traitement').addEventListener('click', function() {
    window.location.href = 'tp.php';
});

    </script>
   
       
       
    
</body>
<footer class="footer">
      <p> @copy_right Formulaire_de_diagnostique_du_patient</p>
</footer>
</html>
