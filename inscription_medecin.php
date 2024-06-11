<?php
$inscription_message_reussie = ''; // Message d'inscription réussie
$inscription_message_erreur = ''; // Message d'erreur lors de l'inscription

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation des données (par exemple, vérification de la correspondance des mots de passe)
    if ($password != $confirm_password) {
        $inscription_message_erreur = "Les mots de passe ne correspondent pas.";
    } else {
        // Ajoutez ici la logique d'enregistrement du médecin dans la base de données
        
        // Par exemple :
        // Connexion à la base de données
        $db = new mysqli("localhost", "root", "", "form");
        if ($db->connect_error) {
            die("La connexion a échoué : " . $db->connect_error);
        }

        // Préparation de la requête SQL pour insérer le médecin dans la base de données
        $insert_query = "INSERT INTO medecins (email, nom, password) VALUES ('$email', '$nom', '$password')";

        // Exécution de la requête SQL
        if ($db->query($insert_query) === TRUE) {
            $inscription_message_reussie = "Inscription du médecin réussie.";
        } else {
            $inscription_message_erreur = "Erreur lors de l'inscription du médecin : " . $db->error;
        }

        // Fermeture de la connexion à la base de données
        $db->close();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="S.css">
    <title>Formulaire d'Inscription pour les Médecins</title>
</head>
<body>
    

    <!-- FORMULAIRE DE CONNEXION POUR LES MÉDECINS -->
    <div class="card">
        <link rel="stylesheet" href="B.css">
    <link rel="stylesheet" href="c.css">
    
</head>
<body>
    <header>
        <img src="th (5).jfif.jpg" alt=""  class="ismo">
        <input type="checkbox" id="nav_check" hidden>
        <nav>
            <ul>
                <li>
                    <a href="A.html" class="active">Home</a>
                </li>
                <li>
                    <a href="About.html">About_Us</a>
                </li>
                <li>
                <a href="connrdv.php">Make an appointment</a>
                </li>
                <li>
                    <a href="robot_form.php">patients_Account</a>
                </li>
                <li>
                    <a href="Connexion_medecin.php">Administrator_Medecin</a>
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

    <!-- FORMULAIRE D'INSCRIPTION POUR LES MÉDECINS -->
    <div class="card">
        <h2>Inscription Médecin</h2>

        <!-- SE CONNECTER / S'INSCRIRE -->
        <div class="login_register">
            <a href="Connexion_medecin.php" class="login" >Se Connecter</a>
            <a href="inscription_medecin.php" class="register" >S'inscrire</a>
        </div>

        <!-- FORMULAIRE -->
        <form class="form" action="" method="post">
            <input type="text" name="nom" placeholder="Nom" required><br>
            <input type="email" name="email" placeholder="Adresse Email" required><br>
            <input type="password" name="password" placeholder="Mot de passe" required><br>
            <input type="password" name="confirm_password" placeholder="Confirmer le Mot de passe" required><br>
            <button type="submit" name="register" class="login_btn">S'inscrire</button>
        </form>
        <?php 
        echo $inscription_message_reussie; // Affichage du message d'inscription réussie
        echo $inscription_message_erreur; // Affichage du message d'erreur
    ?> 

        <!-- MOT DE PASSE OUBLIÉ ? -->
        <a href="#" class="fp">Mot de passe oublié ?</a>
    </div>
   
    <footer class="footer">
        <p> @copy_right Medecin_Account</p>
  </footer>
</body>
</html>
