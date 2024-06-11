<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form";

// Récupérer tous les rendez-vous récemment créés de la base de données (par exemple, ceux créés dans les dernières 24 heures)
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

$sql = "SELECT * FROM rendez_vous WHERE DATE(date_creation) = CURDATE()";
$result = $conn->query($sql);

if ($result === false) {
    die("Erreur de requête SQL : " . $conn->error);
}

$rendez_vous_attente = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $rendez_vous_attente[] = $row;
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des rendez-vous en attente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a.button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        a.button:hover {
            background-color: #45a049;
        }

        @media only screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Liste des rendez-vous en attente</h1>
        <table>
            <thead>
                <tr>
                    <th>Nom du patient</th>
                    <th>Email du patient</th>
                    <th>Date du rendez-vous</th>
                    <th>Horaire du rendez-vous</th>
                    <th>Type de rendez-vous</th>
                    <th>Médecin souhaité</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rendez_vous_attente as $rdv) { ?>
                    <tr>
                        <td><?php echo $rdv['nom_patient']; ?></td>
                        <td><?php echo $rdv['email_patient']; ?></td>
                        <td><?php echo $rdv['date_rdv']; ?></td>
                        <td><?php echo $rdv['horaire_rdv']; ?></td>
                        <td><?php echo $rdv['type_rdv']; ?></td>
                        <td><?php echo $rdv['medecin_souhaite']; ?></td>
                        <td><a href="envoyer_rdv.php?id=<?php echo $rdv['id']; ?>" class="button">Envoyer</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="envoie_rdv_au_med.php" class="button" style="display: block; margin-top: 20px;">Retour</a>
    </div>
</body>

</html>
