<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="confirmation.css">
    <link rel="stylesheet" href="cf.css">
    <style>
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
    

    
    <title>Confirmation</title>
</head>
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
    <pre>


















    <h2 class="cf">Merci de contacter à diag medical 
Pour plus d'informations contacter un Medecin
le plus proche de vous. </h2>
    <p class="cf"> Votre demande sera Bientot traitée<?php echo htmlspecialchars(@$_GET['nom']); ?></p>                                                      
                                                                 <a href="formulaire d'insrciption.php" class="logout-button">Déconnexion</a>
    </pre>
</body>
</html>
