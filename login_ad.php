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

    // Requête SQL pour récupérer les informations de l'administrateur
    $query = "SELECT * FROM administrator WHERE email='$email' AND password='$password'";
    $result = $db->query($query);

    // Vérification du résultat de la requête
    if ($result->num_rows == 1) {
        // Authentification réussie
        $_SESSION['inscription_message_reussie'] = 'Connexion réussie';
        header("Location: MENUADMIN.HTML "); // Redirection vers le tableau de bord après connexion
        exit();
    } else {
        // Identifiants incorrects
        $_SESSION['inscription_message_erreur'] = 'Adresse email ou mot de passe incorrect';
        header("Location: MENUADMIN.HTML"); // Redirection avec message d'erreur
        exit();
    }

    // Fermeture de la connexion à la base de données
    $db->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mum.css">
    <title>Formulaire de Connexion pour l'Administrateur</title>
    <style>
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
    </style>
</head>
<body>
    <script src="nav_sp.js"></script>
    

    <!-- FORMULAIRE DE CONNEXION POUR L'ADMINISTRATEUR -->
    <div class="card">
         <link rel="stylesheet" href="indexB.css">
    <link rel="stylesheet" href="c.css">
    
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
   
    <h2>Connexion Administrateur</h2>
        <!-- SE CONNECTER -->
        <div class="login_register">
            <a href="login_ad.php" class="login" >Se Connecter</a>
        </div>

        <!-- FORMULAIRE -->
       
        <form class="form" action="" method="post">
            <input type="email" name="email" placeholder="Adresse Email" required><br>
            <input type="password" name="password" placeholder="Mot de passe" required><br>
            <button type="submit" name="login" class="login_btn">Se Connecter</button>
        </form>
        <?php 
    // Affichage du message d'inscription réussie s'il n'est pas vide
    if (!empty($inscription_message_reussie)) {
        echo '<div class="success-message">' . $inscription_message_reussie . '</div>';
    }

    // Affichage du message d'erreur s'il n'est pas vide
    if (!empty($inscription_message_erreur)) {
        echo '<div class="error-message">' . $inscription_message_erreur . '</div>';
    }
?>
        <!-- MOT DE PASSE OUBLIÉ ? -->
        <a href="password_forget.html" class="fp">Mot de passe oublié ?</a>
    <!-- Affichage des messages d'inscription -->
    <p><?php echo isset($_SESSION['inscription_message_reussie']) ? $_SESSION['inscription_message_reussie'] : ''; ?></p>
        <p><?php echo isset($_SESSION['inscription_message_erreur']) ? $_SESSION['inscription_message_erreur'] : ''; ?></p>

        <?php 
        // Suppression des messages après affichage
        unset($_SESSION['inscription_message_reussie']);
        unset($_SESSION['inscription_message_erreur']);
        ?>
    </div>

    <footer class="footer">
        <p>© Medecin_Account</p>
    </footer>
  
</body>

</html>
