<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de Rendez-vous pour le Patient</title>
    <style>
        body {
            background-image: url(adult-4402808_1280.jpg);
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        
        header {
            background-color:black;
            width: 100%;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 50px;
        }
        
        header .logo {
            font-size: 30px;
            text-transform: uppercase;
            color: white;
        }
        
        header nav ul {
            display: flex;
        }
        
        header nav ul li a {
            display: inline-block;
            color: blue;
            padding: 5px 0;
            margin: 0 10px;
            border: 3px solid transparent;
            text-transform: uppercase;
            transition: 0.2s;
            text-decoration: none;
            color: white;
        }
        
        header nav ul li a:hover,
        header nav ul li a.active {
            border-bottom-color: dodgerblue;
        }
        
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        form {
            text-align: center;
            margin-top: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        
        input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }
        
        button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        
        .result-container {
            margin-top: 20px;
        }
        
        .result-container p {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        footer.footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: black;
            color: white;
            text-align: center;
            padding: 10px 0;
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

    <div class="container">
        <form action="" method="get">
            <label for="email_patient">Entrez l'E-mail du Patient :</label>
            <input type="text" id="email_patient" name="email_patient" placeholder="E-mail du Patient">
            <button type="submit">Rechercher</button>        <a href="rendez-vous.php" class="logout-button">Quitte</a>
        </form>
        <div class="result-container">
            <?php
            // Connexion à la base de données
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "form";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Vérifier la connexion
            if ($conn->connect_error) {
                die("La connexion a échoué : " . $conn->connect_error);
            }

            // Initialisez la variable pour stocker le résultat de la recherche
            $search_result = "";

            // Vérifiez si le formulaire a été soumis et si le champ "email_patient" est non vide
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['email_patient']) && !empty($_GET['email_patient'])) {
                // Récupérer l'e-mail du patient saisi dans le formulaire
                $email_patient = $_GET['email_patient'];

                // Préparer la requête SQL pour récupérer le résultat de la rendez-vous du patient
                $sql = "SELECT email_patient, resultat_rdv FROM resultat_rdv_patient WHERE email_patient = '$email_patient'";

                $result = $conn->query($sql);

                // Afficher le résultat de la rendez-vous du patient s'il existe
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $search_result .= "<p>Résultat de la rendez-vous pour le patient avec l'e-mail " . $row['email_patient'] . " :</p>";
                    $search_result .= "<p>" . $row['resultat_rdv'] . "</p>";
                } else {
                    $search_result = "Aucun résultat de rendez-vous trouvé pour le patient avec cet e-mail.";
                }
            }

            // Fermer la connexion à la base de données
            $conn->close();

            // Afficher le résultat de la recherche s'il existe, sinon afficher un message
            if (!empty($search_result)) {
                echo $search_result;
            } 
            ?>
        </div>
    </div>

    <footer class="footer">
        <p> © Votre Site Diag_Medical Est Sous vos services</p>
    </footer>
</body>
</html>
