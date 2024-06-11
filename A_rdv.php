<?php
// Connexion à la base de données pour récupérer les rendez-vous des patients
// Assurez-vous de remplacer les informations de connexion à la base de données par les vôtres

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez si la connexion a réussi
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Récupérer les rendez-vous des patients depuis la base de données
$sql = "SELECT * FROM rendez_vous";
$result = $conn->query($sql);

$rendez_vous = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rendez_vous[] = $row;
    }
} else {
    echo "";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="c.css">
    <link rel="stylesheet" href="B.css">
    <title>Tableau de Bord Médecin</title>
    <style>
        body {
           background-image: url(cprdv.png);
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            box-sizing: border-box;
        }
        h1, h2 {
            text-align: center;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            background-color: #f2f2f2;
        }
        th {
            background-color: #f2f2f2;
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
    <h2>Rendez-vous des Patients</h2>
    <table border="1px dashed black">
        <tr>
            <th>E-mail du Patient</th>
            <th>Date du Rendez-vous</th>
            <th>Horaire du Rendez-vous</th>
        </tr>
        <?php foreach ($rendez_vous as $rdv) : ?>
            <tr>
                <td><?php echo $rdv['email_patient']; ?></td>
                <td><?php echo $rdv['date_rdv']; ?></td>
                <td><?php echo $rdv['horaire_rdv']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <form action="traitement_medecin.php" method="post">
        <pre>
                               <a href="Ardv_soumetre.php" class="submit-button">Soumettre un Rendez-vous</a>                                                                                                                                                                  <a href="Connexion_medecin.php" class="logout-button">Déconnexion</a>
              
        </pre>
    </form>
<footer class="footer">
      <p> @copy_right Tableau_De_Bord_Medecin</p>
</footer>
</body>
</html>
