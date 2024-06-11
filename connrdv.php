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

// Initialisation du message d'erreur de connexion
$connexion_message_erreur = "";

// Vérification de l'authentification
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['password'];

    // Utiliser des requêtes préparées pour éviter les injections SQL
    $requete = "SELECT * FROM users WHERE email=? AND password=?";
    $declaration = mysqli_prepare($connexion, $requete);
    mysqli_stmt_bind_param($declaration, "ss", $email, $mot_de_passe);
    mysqli_stmt_execute($declaration);
    $resultat = mysqli_stmt_get_result($declaration);

    if (mysqli_num_rows($resultat) == 1) {
        $_SESSION['connecte'] = true;
        header("Location: rendez-vous.php");
        exit;
    } else {
        $connexion_message_erreur = "Adresse e-mail ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="nav_sp.js"></script>
    <title>Connexion_Patient</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Muli&display=swap");

        :root {
          --highlight-color: lightblue;
        }

        * {
          box-sizing: border-box;
        }

        body {
          align-items: center;
          background-color: steelblue;
          color: #fff;
          display: flex;
          flex-direction: column;
          font-family: "Muli", sans-serif;
          height: 100vh;
          justify-content: center;
          margin: 0;
          overflow: hidden;
        }

        .container {
          background-color: rgba(0, 0, 0, 0.4);
          border-radius: 5px;
          padding: 20px 40px;
        }

        .container h1 {
          margin-bottom: 30px;
          text-align: center;
        }

        .container a {
          color: var(--highlight-color);
          text-decoration: none;
        }

        .btn {
          background-color: var(--highlight-color);
          border: 0;
          border-radius: 5px;
          cursor: pointer;
          display: inline-block;
          font: inherit;
          font-size: 1.2rem;
          padding: 15px;
          width: 100%;
        }

        .btn:focus {
          outline: 0;
        }

        .btn:active {
          transform: scale(0.98);
        }

        .text {
          margin-top: 30px;
        }

        .form-control {
          margin: 20px 0 40px;
          position: relative;
          width: 300px;
        }

        .form-control input {
          background-color: transparent;
          border: 0;
          border-bottom: 2px #fff solid;
          color: #fff;
          display: block;
          font-size: 1.2rem;
          padding: 15px 0;
          width: 100%;
        }

        .form-control input::placeholder {
          color: transparent;
        }

        .form-control input:focus,
        .form-control input:valid {
          border-bottom-color: var(--highlight-color);
          outline: 0;
        }

        .form-control label {
          left: 0;
          position: absolute;
          top: 15px;
        }

        .form-control label span {
          display: inline-block;
          font-size: 1.2rem;
          min-width: 5px;
          transition: 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .form-control input:focus + label span,
        .form-control input:valid + label span {
          color: var(--highlight-color);
          transform: translateY(-30px);
        }

        /* Styles pour le header */
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

        nav ul {
          list-style-type: none;
          margin: 0;
          padding: 0;
        }

        nav ul li {
          display: inline;
          margin-right: 10px;
        }

        nav ul li a {
          color: #fff;
          text-decoration: none;
        }

        .toggle-btn {
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

        .toggle-btn:hover {
          background-color: #45a049; /* Couleur de fond au survol */
        }
        .ismo{
    width: 20px;
    height: 20px;
    
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
    <div class="container" id="loginForm" style="display: none;">
        <h1>Se connecter</h1>
        <form action="#" method="post">
            <div class="form-control">
                <input type="email" id="m" name="email" placeholder="Enter your email" />
            </div>
            <div class="form-control">
                <input type="password" id="p" name="password" placeholder="Enter your password" />
            </div>
            <button class="btn" type="submit" name="login">Login</button>
            <p class="error-message"><?php echo $connexion_message_erreur; ?></p>
        </form>
    </div>

    <button id="toggleButton" class="toggle-btn" onclick="toggleFormAndHeader()">Voir Le Formulaire de Connexion</button>

    <script>
       function toggleFormAndHeader() {
    var form = document.getElementById('loginForm');
    var header = document.getElementById('main-header');
    var toggleButton = document.getElementById('toggleButton');

    if (form.style.display === 'none') {
        form.style.display = 'block';
        header.style.top = '0';
        toggleButton.style.display = 'none'; // Masquer le bouton
    } else {
        form.style.display = 'none';
        header.style.top = '-100px';
    }
}

    </script>
</body>
</html>
