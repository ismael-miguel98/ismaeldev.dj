<?php
$serveur = "localhost";
$utilisateur = "root";
$modDePasse = "";
$base = "form";

$connect = mysqli_connect($serveur, $utilisateur, $modDePasse, $base);

if (!$connect) {
    die("Connexion échouée : " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_name = mysqli_real_escape_string($connect, $_POST['patient_name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $nom_docteur = mysqli_real_escape_string($connect, $_POST['nom']);
    $date_rendez_vous = mysqli_real_escape_string($connect, $_POST['date']);
    $time_rendez_vous = mysqli_real_escape_string($connect, $_POST['time']);

    $sql = "INSERT INTO rendez_vous_docteurs (patient_name, email, nom_docteur, date_rendez_vous, time_rendez_vous) 
            VALUES ('$patient_name', '$email', '$nom_docteur', '$date_rendez_vous', '$time_rendez_vous')";

    if (mysqli_query($connect, $sql)) {
        echo "Nouveau rendez-vous créé avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . mysqli_error($connect);
    }

    mysqli_close($connect);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Rendez-vous - Docteurs</title>
    <link rel="stylesheet" href="rd d.css">
    <style>
         body{
            background-image: url(_f1c4937d-399a-4723-a061-9abacb529e00.jpeg);
         }
        .custom-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50; /* Green */
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }
        .custom-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Rendez-vous Docteurs</h2>
        <form action="" method="post">
            <label for="patient_name">Nom Docteur:</label>
            <input type="text" id="patient_name" name="patient_name" required>
            
            <label for="email">Email du Docteur:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="type_de_rende_vous">Avec vous:</label>
            <input type="text" id="nom" name="nom" required>
            
            <label for="date_rendez_vous">Date de rendez-vous:</label>
            <input type="date" id="date" name="date" required>
            
            <label for="time_rendez_vous">Heure de rendez-vous:</label>
            <input type="time" id="time" name="time" required> <br>
            
            <button type="submit">Envoyer au docteur</button>
            <a href="GERE LES REND-VOUS.html"><input type="button"  class="custom-button" value="RETOUR"></a>
        </form>
    </div>
</body>
</html>
