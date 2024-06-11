<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$modDePasse = "";
$base = "form";

$connect = mysqli_connect($serveur, $utilisateur, $modDePasse, $base);

// Vérifier la connexion
if (!$connect) {
    die("La connexion a échoué: " . mysqli_connect_error());
}

// Requête SQL pour récupérer les données
$query = "SELECT * FROM rendez_vous";
$result = mysqli_query($connect, $query);

// Vérifier si la requête a réussi
if ($result) {
    // Récupération des données et affichage dans les champs du formulaire
    @$row = mysqli_fetch_assoc($result);
    @$patient_name = $row['nom'];
   @$email = $row['email'];
    @$date = $row['date'];
    @$heure = $row['heure'];
    @$Type = $row['Type'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="c.css">
    <link rel="stylesheet" href="B.css">
    <title>Afficher les rendez-vous</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
    }

    .container {
        width: 300px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="text"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    input[type="button"] {
        background-color: #007BFF;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="button"]:hover {
        background-color: #0056b3;
    }

    a {
        text-decoration: none;
    }
</style>

</head>
<body>
    <div class="container">
        <h1>Afficher les rendez-vous du Patients</h1>
        <form method="POST">
            <div class="form-group">
                <label for="patient_name">Nom du patient:</label>
                <input type="text" id="patient_name" name="nom" value="<?php echo $patient_name; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="e-mail" id="email" name="email" value="<?php echo $email; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="date">Date du rendez:</label>
                <input type="date" id="date" name="date" value="<?php echo $date; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="heure">heure du rendez-vous:</label>
                <input type="time" id="heure" name="heure" value="<?php echo $heure; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="Type">Type de rendez-vous:</label>
                <input type="text" id="Type" name="Type" value="<?php echo $Type; ?>" readonly>
            </div>
        </form>
        <a href="GERE LES REND-VOUS.html"><input type="button" name="retour" value="RETOUR  "></a>
    </div>
</body>
</html>
<?php
} else {
    echo "Erreur lors de l'exécution de la requête : " . mysqli_error($connect);
}

// Fermer la connexion
mysqli_close($connect);
?>
<footer class="footer">
      <p> @copy_right rende_de_vous Demande de Rendez-vous Du Patients</p>
</footer>
