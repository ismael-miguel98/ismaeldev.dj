<?php
// Configuration de la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form";

// Connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Requête SQL pour récupérer les données
$sql = "SELECT nom_conc, e_mail_conc, message_conc FROM contacte";
$result = mysqli_query($conn, $sql);

$contacts = [];
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $contacts[] = $row;
    }
} else {
    echo "0 results";
}

// Fermeture de la connexion
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Contacts</title>
    <style>
        /* style.css */
body {
    font-family: Arial, sans-serif;
  background-image: url(stethoscope-5224535_1280.jpg);
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 50px;
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
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f4f4f9;
}

tr:hover {
    background-color: #f1f1f1;
}
.logout-button {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }
        .logout-button:hover {
            background-color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des Contacts</h1>
        <?php if (!empty($contacts)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($contact['nom_conc']); ?></td>
                            <td><?php echo htmlspecialchars($contact['e_mail_conc']); ?></td>
                            <td><?php echo htmlspecialchars($contact['message_conc']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="MENUADMIN.HTML" class="logout-button">Retour</a>
        <?php else: ?>
            <p>Aucun contact trouvé.</p>
        <?php endif; ?>
    </div>
</body>
</html>

