<?php
session_start();

$server = "localhost";
$username = "root";
$password = "";
$dbname = "form";

// Connexion à la base de données
$connect = mysqli_connect($server, $username, $password, $dbname);

// Vérification de la connexion
if (!$connect) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Traitement du formulaire d'inscription
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['specialite']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $specialite = $_POST['specialite'];
    $password = $_POST['password'];

    // Vérification de l'unicité de l'email dans la base de données
    $query = "INSERT INTO `medecins` VALUES ('$name','$email','$specialite','$password')";

    if (mysqli_query($connect, $query)) {
        // Redirection vers la page de connexion après inscription réussie
        header("Location: Connexion_medecin.php");
        exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
    } else {
        echo "Erreur : " . mysqli_error($connect);
    }
}

// Traitement du formulaire de connexion
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête SQL pour vérifier les informations de connexion
    $query = "SELECT * FROM `medecins` WHERE `email`='$email' AND `password`='$password'";

    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) == 1) {
        // Authentification réussie, rediriger vers la page tableau_de_bord.php
        $_SESSION['email'] = $email;
        header("Location: tableau_de_bord.php");
        exit;
    } else {
        // Authentification échouée, afficher un message d'erreur
        $error_message = "Email ou mot de passe incorrect.";
    }
}

// Fermeture de la connexion
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="p.css">
    <link rel="stylesheet" href="LES_c.css">
    <link rel="stylesheet" href="c.css">
    <link rel="stylesheet" href="B.css">

    <title>Modern Login Page | AsmrProg</title>
    <style>
        .c{
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 10px 0;
        }
        .lg-left img,
        .lg-right img {
            width: 70px;
            height: auto;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #f4f4f4;
            padding: 10px 0;
            text-align: center;
        }

        header img {
            width: 70px;
            height: auto;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
        }

        .hamburger {
            display: none;
        }

        @media only screen and (max-width: 768px) {
            nav ul {
                display: none;
            }

            .hamburger {
                display: block;
                cursor: pointer;
            }

            .hamburger div {
                width: 25px;
                height: 3px;
                background-color: #333;
                margin: 5px;
            }
        }
       
    </style>
</head>

<body>
<script src="nav_sp.js"></script>
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
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="" method="POST">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                
                <input type="text" name="name"  placeholder="Name">
                <input type="email" name="email"  placeholder="Email">
                <input type="text"   name="specialite"  placeholder="Your specialist">
                <input type="password" name="password"  placeholder="Password">
                <button type="submit" value="Sing-Up"  > Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="" method="POST">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
              
                <input type="email"  name="email" placeholder="Email">
                <input type="password" name="password"    placeholder="Password">
                <a href="mot_de_passe_oublie_medecin.html">Forget Your Password?</a>
                <button type="submit" value="sign-in">Sign In</button>
                <?php if(isset($error_message)) { ?>
                    <p style="color:red;"><?php echo $error_message; ?></p>
                <?php } ?>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bonjour, DOCTEUR</h1>
                    <p>Inscrivez-vous avec vos coordonnées personnelles pour utiliser toutes les fonctionnalités du site</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Bonjour, DOCTEUR</h1>
                    <p>Inscrivez-vous avec vos coordonnées personnelles pour utiliser toutes les fonctionnalités du site</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="s.js"></script>
</body>
<footer class="footer">
      <p> @copy_right Medecins_Account</p>
</footer>
</html>
