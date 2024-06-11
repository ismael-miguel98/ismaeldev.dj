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
$query = "SELECT * FROM rendez_vous_docteurs";
$result = mysqli_query($connect, $query);

// Vérifier si la requête a réussi
if ($result) {
    // Récupération des données et affichage dans les champs du formulaire
    $row = mysqli_fetch_assoc($result);
    $patient_name = $row['patient_name'];
    $email = $row['email'];
    $nom_docteur = $row['nom_docteur'];
    $date_rendez_vous = $row['date_rendez_vous'];
    $time_rendez_vous = $row['time_rendez_vous'];
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
        <h1>Afficher les rendez-vous</h1>
        <form method="POST">
            <div class="form-group">
                <label for="patient_name">Nom du patient:</label>
                <input type="text" id="patient_name" name="patient_name" value="<?php echo $patient_name; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="nom_docteur">Nom du docteur:</label>
                <input type="text" id="nom_docteur" name="nom_docteur" value="<?php echo $nom_docteur; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="date_rendez_vous">Date du rendez-vous:</label>
                <input type="text" id="date_rendez_vous" name="date_rendez_vous" value="<?php echo $date_rendez_vous; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="time_rendez_vous">Heure du rendez-vous:</label>
                <input type="text" id="time_rendez_vous" name="time_rendez_vous" value="<?php echo $time_rendez_vous; ?>" readonly>
            </div>
        </form>
        <a href="tableau_de_bord.php"><input type="button" name="retour" value="RETOUR  "></a>
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
      <p> @copy_right rende_de_vous Envoyer par l'Administrator_diag_Medical</p>
</footer>
