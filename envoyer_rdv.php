<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form";

// Vérification si des données ont été soumises via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération de l'e-mail du patient à envoyer
    $email_patient = $_POST['email_patient'];

    // Connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Mise à jour du champ "envoye" à "1" pour les rendez-vous en attente (date_rdv dans le futur)
    $sql = "UPDATE rendez_vous SET envoye='1' WHERE email_patient='$email_patient' AND date_creation > NOW()";

    if ($conn->query($sql) === TRUE) {
        echo "Les rendez-vous ont été envoyés avec succès.";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envoyer demande de rendez-vous</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
}

form {
    margin-top: 20px;
}

label {
    display: block;
    font-weight: bold;
}

input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.btn {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}

    </style>
</head>

<body>
    <div class="container">
        <h1>Envoyer demande de rendez-vous aux médecins</h1>
        <form action="" method="post">
            <label for="email_patient">Email du patient :</label><br>
            <input type="email" id="email_patient" name="email_patient" required><br>

            <input type="submit" value="Envoyer demande" class="btn">
        </form>
    </div>
</body>

</html>
