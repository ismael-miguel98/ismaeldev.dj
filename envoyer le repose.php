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
    $patient_name = mysqli_real_escape_string($connect, $_POST['doctor_name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $disponible = mysqli_real_escape_string($connect, $_POST['disponible']);
    $reponse = mysqli_real_escape_string($connect, $_POST['max_patients']);

    $sql = "INSERT INTO rendez_vous_patients (patient_name, email, disponible, reponse) 
            VALUES ('$patient_name', '$email', '$disponible', '$reponse')";

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
        background-image: url(stethoscope-5224535_1280.jpg);
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
        <h2>Rendez-vous Patients</h2>
        <form action="" method="post">
            <label for="doctor_name">Nom du patient:</label>
            <input type="text" id="doctor_name" name="doctor_name" required>
            
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
            
            <label for="doctor_availability">Date et l'heure:</label>
            <input type="datetime-local" id="doctor_availability" name="disponible" required>
            
            <label for="max_patients">Réponse:</label>
            <input type="text" id="max_patients" name="max_patients" required> <br>
            
            <button type="submit">ENVOYER</button>  
            <a href="GERE LES REND-VOUS.html"><input type="button"  class="custom-button" value="RETOUR"></a>
        </form>
    </div>
</body>
</html>
